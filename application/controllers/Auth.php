<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_model');
    }

    public function index() {
        $this->load->view('auth/login');
    }

    public function register_admin() {
        $this->load->view('auth/register_admin');
    }

    public function register() {
        $this->load->view('auth/register');
    }

    public function register_karyawan() {
        $this->load->view('auth/register_karyawan');
    }

    public function process_login()
    {
     $email = $this->input->post('email', true);
     $password = $this->input->post('password', true);
     $data = [ 'email' => $email, ];
     $query = $this->m_model->getwhere('user', $data);
     $result = $query->row_array();
   
     if (!empty($result) || md5($password) === $result['password']) {
      $data = [
       'logged_in' => TRUE,
       'email' => $result['email'],
       'username' => $result['username'],
       'role' => $result['role'],
       'id' => $result['id'],
      ];
      $this->session->set_userdata($data);
      if ($this->session->userdata('role') == 'admin') {
       redirect(base_url()."admin");
      } elseif($this->session->userdata('role') == 'karyawan'){
       redirect(base_url()."employee") ;
      }
    else {
       redirect(base_url()."auth");
      }
     } else {
      redirect(base_url()."auth");
     }
    }

    public function process_register_karyawan() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|regex_match[/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/]');
        $this->form_validation->set_rules('password', 'Password', 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register'); 
        } else {
            // Hash the password
            $hashed_password = md5($this->input->post('password'));

            // Define user data
            $data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $hashed_password,
                'role' => 'karyawan', // Set role to 'karyawan'
                'image' => 'user.png' // Assuming you want to set a default image
            ];

            // Insert user data into the 'user' table
            $this->db->insert('user', $data);
            // Mengganti $this->db->insert menjadi $this->m_model->insert

            // Redirect to the login page
            redirect(base_url('auth'));
        }
    }

    public function process_register_admin() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|regex_match[/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/]');
        $this->form_validation->set_rules('password', 'Password', 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register_admin');
        } else {
            // Hash the password
            $hashed_password = md5($this->input->post('password'));

            // Define user data
            $data = [
                'username' => $this->input->post('username'),
                'nama_depan' => $this->input->post('nama_depan'),
                'nama_belakang' => $this->input->post('nama_belakang'),
                'email' => $this->input->post('email'),
                'password' => $hashed_password,
                'role' => 'admin', // Set role to 'admin'
                'image' => 'User.png' // Assuming you want to set a default image
            ];

            // Insert user data into the 'user' table
            $this->db->insert('user', $data);// Mengganti $this->db->insert menjadi $this->m_model->insert

            // Redirect to the login page
            redirect(base_url('auth'));
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}

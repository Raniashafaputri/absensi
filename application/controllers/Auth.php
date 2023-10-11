<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

 function __construct()
 {
  parent::__construct();
  $this->load->model('m_model');
  $this->load->helper('my_helper');
 }

 public function index()
 {
  $this->load->view('auth/login');
 }

 public function register_admin() { 
 
  $this->load->view('auth/register_admin');
 }

 public function register() { 
 
  $this->load->view('auth/register');
 }

 public function aksi_register() 
    { 
        $email = $this->input->post('email', true); 
        $username = $this->input->post('username', true); 
        $password = md5($this->input->post('password', true)); 
        $nama_depan = $this->input->post('nama_depan', true); 
        $nama_belakang = $this->input->post('nama_belakang', true); 
        $role = 'karyawan'; 
 
        
 
        $data = [ 
            'email' => $email, 
            'username' => $username, 
            'password' => $password, 
            'role' => $role, 
            'nama_depan' => $nama_depan, 
            'nama_belakang' => $nama_belakang, 
            
        ]; 
 
        $table = 'users'; 
 
        $this->db->insert($table, $data); 
 
        if ($this->db->affected_rows() > 0) { 
            // Registrasi berhasil 
            $this->session->set_userdata([ 
                'logged_in' => TRUE, 
                'email' => $email, 
                'username' => $username, 
                'role' => $role, 
                'nama_depan' => $nama_depan, 
                'nama_belakang' => $nama_belakang, 
             
            ]); 
            redirect(base_url() . "auth"); 
        } else { 
            // Registrasi gagal 
            redirect(base_url() . "auth/register"); 
        } 
    }

    public function aksi_login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $data = ['email' => $email];
        $query = $this->m_model->getwhere('users', $data);
        $result = $query->row_array();

        if (!empty($result) && md5($password) === $result['password']) {
            $data = [
                'logged_in' => true,
                'email' => $result['email'],
                'username' => $result['username'],
                'role' => $result['role'],
                'id' => $result['id'],
            ];
            $this->session->set_userdata($data);
            if ($this->session->userdata('role') == 'karyawan') {
                $this->session->set_flashdata('berhasil_login', 'Selamat datang diaplikasi absensi.');
                redirect(base_url() . 'karyawan');
            } elseif ($this->session->userdata('role') == 'admin') {
				redirect(base_url() . "admin");
			} else {
                $this->session->set_flashdata('gagal_login', 'Silahkan periksa email dan password anda.');
                redirect(base_url() . 'auth');
            }
        } else {
            $this->session->set_flashdata('gagal_login_i', 'Akun atau Password anda kosong!');
            redirect(base_url() . 'auth');
        }
    }


}
?>
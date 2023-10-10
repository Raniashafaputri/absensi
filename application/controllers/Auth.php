<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

 function __construct()
 {
  parent::__construct();
  $this->load->model('m_model');
//   $this->load->helper('my_helper');
 }

 public function index()
 {
  $this->load->view('auth/login');
 }

 public function Register()
 {
  $this->load->view('auth/Register');
 }

 public function Register_admin()
 {
  $this->load->view('auth/Register_admin');
 }


 public function aksi_Register() {
    // Ambil data dari formulir register
    $username = $this->input->post('username');
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    
    // Set role menjadi "karyawan"
    $role = "karyawan";

    // Validasi input
    $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[admin.username]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admin.email]');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() === FALSE) {
        // Jika validasi gagal, tampilkan kembali halaman register dengan pesan kesalahan
        $this->load->view('register');
    } else {
        // Hash password menggunakan password_hash() yang lebih aman
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Simpan data pengguna ke dalam database, termasuk kolom role
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'role' => $role // Kolom role
        );

        // Gantilah 'user' dengan nama tabel yang sesuai
        $this->db->tambah_data('user', $data);

        // Redirect ke halaman login atau tampilkan pesan sukses
        redirect(base_url('auth'));
    }
}

public function Aksi_Register_admin() {
    // Ambil data dari formulir register
    $username = $this->input->post('username');
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    
    // Set role menjadi "admin"
    $role = "admin";

    // Validasi input
    $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[admin.username]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admin.email]');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() === FALSE) {
        // Jika validasi gagal, tampilkan kembali halaman register dengan pesan kesalahan
        $this->load->view('register');
    } else {
        // Hash password menggunakan password_hash() yang lebih aman
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Simpan data pengguna ke dalam database, termasuk kolom role
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'role' => $role // Kolom role
        );

        // Gantilah 'user' dengan nama tabel yang sesuai
        $this->db->tambah_data('user', $data);

        // Redirect ke halaman login atau tampilkan pesan sukses
        redirect(base_url('auth'));
    }
}


   
}
?>
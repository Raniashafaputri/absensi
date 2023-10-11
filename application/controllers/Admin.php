<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
    }
    public function index()
    {
        // Mengisi data yang diperlukan untuk tampilan
        // $data = array(
        //     'title' => 'Dashboard Karyawan', // Judul halaman
        //     'content' => 'Selamat datang di dashboard karyawan.', // Konten halaman
        // );

        // Menampilkan tampilan (sesuaikan dengan nama tampilan Anda)
        $this->load->view('admin/index');
    }
}
?>

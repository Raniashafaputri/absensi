<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
 function __construct()
 {
  parent::__construct();
        // load model dan libry yang di perlukan 
  $this->load->model('m_model');
  $this->load->library('form_validation');
 
 }

 public function index()
 {
  $this->load->view('employee/index');
 }

    public function dashboard()
    {
        $this->load->view('employee/dashboard');
    }
    public function tambah_absen()
    {
        $this->load->view('employee/tambah_absen');
    }
    public function izin()
    {
        $this->load->view('employee/izin');
    }
    public function history()
    {
        $this->load->model('Absensi_model');
        $data['absensi'] = $this->Absensi_model->getAbsensi();
        $this->load->view('employee/history', $data);
    }

}
?>

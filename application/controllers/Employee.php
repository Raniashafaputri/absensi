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
    public function ubah_absen()
    {
        $this->load->view('employee/ubah_absen');
    }

    public function save_absensi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $current_datetime = date('Y-m-d H:i:s');

        $data = [
            'kegiatan' => $this->input->post('kegiatan'),
            'date' => $current_datetime,
            'jam_masuk' => $current_datetime,
            'jam_pulang' => $current_datetime,
        ];

        $this->load->model('Absensi_model');
        $this->Absensi_model->createAbsensi($data);

        redirect('Employee/history');
    }


    public function izin()
    {
        $this->load->view('Employee/izin');
    }

    public function simpan_Izin()
    {
        $id = $this->session->userdata('id');
        // Tangkap data yang dikirimkan melalui POST
        $keterangan_izin = $this->input->post('keterangan_izin');
        $tanggal_sekarang = date('Y-m-d'); // Mendapatkan tanggal hari ini
    
        // Load model yang diperlukan untuk menyimpan data izin
        $this->load->model('Izin_model');
    
        // Siapkan data izin yang akan disimpan
     $data = [
    'id_karyawan' => $id,  // Gunakan variabel $id_karyawan yang mengandung ID karyawan yang sedang login
    'kegiatan' => '-',
    'status' => 'true',
    'keterangan_izin' => $this->input->post('keterangan_izin'),
    'jam_masuk' => '00:00:00', // Mengosongkan jam_masuk
    'jam_pulang' => '00:00:00', // Mengosongkan jam_pulang
    'date' => $tanggal_sekarang, // Menyimpan tanggal izin
    ];

        // Panggil model untuk menyimpan data izin
        $this->Izin_model->simpanIzin($data);
    
        // Setelah selesai, Anda bisa mengarahkan pengguna kembali ke halaman "history"
        redirect('Employee/history');
    }
    

    public function history()
    {
        $this->load->model('Absensi_model');
        $data['absensi'] = $this->Absensi_model->getAbsensi();
        $this->load->view('employee/history', $data);
    }
    public function hapus($id)
{
    $this->m_model->delete('absensi', 'id', $id);
    $this->session->set_flashdata(
        'berhasil_menghapus',
        'Data berhasil dihapus.'
    );
    redirect(base_url('employee/history'));
}

}
?>

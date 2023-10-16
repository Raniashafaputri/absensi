<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // load model dan library yang diperlukan
        $this->load->model('m_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('employee/index');
    }
    public function edit_profil()
    {
        $this->load->view('employee/edit_profil');
    }

    public function dashboard()
    {
        $this->load->view('employee/dashboard');
    }

    public function tambah_absen()
    {
        $this->load->view('employee/tambah_absen');
    }

    public function ubah_absen($id)
{
    $data['absen'] = $this->m_model->get_by_id('absensi', 'id', $id)->result();
    $this->load->view('employee/ubah_absen', $data);
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

        redirect('Employee/history'); // Ubah "employee" menjadi "Employee"
    }

    public function izin()
    {
        $this->load->view('employee/izin');
    }

    public function simpan_izin()
    {
        $id = $this->session->userdata('id');
        $keterangan_izin = $this->input->post('keterangan_izin');
        $tanggal_sekarang = date('Y-m-d');

        $this->load->model('Izin_model');

        $data = [
            'id_karyawan' => $id,
            'kegiatan' => '-',
            'status' => 'true',
            'keterangan_izin' => $keterangan_izin,
            'jam_masuk' => '00:00:00',
            'jam_pulang' => '00:00:00',
            'date' => $tanggal_sekarang,
        ];

        $this->Izin_model->simpanIzin($data);

        redirect('Employee/history'); // Ubah "employee" menjadi "Employee"
    }

    public function pulang($absen_id)
    {
        if ($this->session->userdata('role') === 'employees') {
            $this->karyawan_model->setAbsensiPulang($absen_id);

            // Set pesan sukses
            $this->session->set_flashdata('success', 'Jam pulang berhasil diisi.');

            // Panggil fungsi JavaScript untuk menampilkan SweetAlert2
            echo '<script>showSweetAlert("Jam pulang berhasil diisi.");</script>';
        }
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
        redirect('Employee/history'); // Ubah "employee" menjadi "Employee"
    }

	public function profile() {
        $data['users'] = $this->m_model->get_by_id('users', 'id', $this->session->userdata('id'));
        $this->load->view('employee/profile', $data);
    }


    public function aksi_ubah_absensi()
    {
        $id_karyawan = $this->session->userdata('id');
        $data = [
       'kegiatan' => $this->input->post('kegiatan'),
      ];
       $eksekusi=$this->Absensi_model->update_data
        ('absensi', $data, array('id'=>$this->input->post('id')));
        if($eksekusi)
        {
            $this->session->set_flashdata('berhasil_update', 'Berhasil mengubah kegiatan');
            redirect(base_url('employee/history'));
        }
        else
        {
            redirect(base_url('employee/ubah_absensi/'.$this->input->post('id')));
        }
    }
    public function upload_image($field_name)
    {
        $config['upload_path'] = './images/user/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 30000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field_name)) {
            $error = array('error' => $this->upload->display_errors());
            return array(false, $error);
        } else {
            $data = $this->upload->data();
            $file_name = $data['file_name'];
            return array(true, $file_name);
        }
    }
}
?>


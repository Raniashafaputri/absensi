<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the necessary models and libraries
        $this->load->model('absensi_model'); // Use proper capitalization
        $this->load->model('Absensi_model'); // Load the Absensi_model
        $this->load->model('Izin_model'); // Load the Izin_model
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
        $data['absen'] = $this->absensi_model->get_by_id('absensi', 'id', $id)->result();
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

        $this->Absensi_model->createAbsensi($data); // Use the Absensi_model

        redirect('Employee/history'); // Correct the URL to 'Employee/history'
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

        $data = [
            'id_karyawan' => $id,
            'kegiatan' => '-',
            'status' => 'true',
            'keterangan_izin' => $keterangan_izin,
            'jam_masuk' => '00:00:00',
            'jam_pulang' => '00:00:00',
            'date' => $tanggal_sekarang,
        ];

        $this->Izin_model->simpanIzin($data); // Use the Izin_model

        redirect('Employee/history'); // Correct the URL to 'Employee/history'
    }

    public function pulang($absen_id)
    {
        if ($this->session->userdata('role') === 'employees') {
            // You need to define the 'setAbsensiPulang' method in the model (karyawan_model) for this to work
            $this->karyawan_model->setAbsensiPulang($absen_id);

            // Set a success message using CodeIgniter's session flashdata
            $this->session->set_flashdata('success', 'Jam pulang berhasil diisi.');

            // You should avoid directly echoing JavaScript, use view and controller for better structure
        }
    }

    public function history()
    {
        $data['absensi'] = $this->Absensi_model->getAbsensi(); // Use the Absensi_model
        $this->load->view('employee/history', $data);
    }

    public function hapus($id)
    {
        $this->absensi_model->delete('absensi', 'id', $id);
        $this->session->set_flashdata(
            'berhasil_menghapus',
            'Data berhasil dihapus.'
        );
        redirect('Employee/history'); // Correct the URL to 'Employee/history'
    }

    public function profile()
    {
        $data['akun'] = $this->absensi_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
        $this->load->view('employee/profile', $data);
    }

    public function edit_profile()
    {
        $password_baru = $this->input->post('password_baru');
        $konfirmasi_password = $this->input->post('konfirmasi_password');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $nama_depan = $this->input->post('nama_depan');
        $nama_belakang = $this->input->post('nama_belakang');

        $data = array(
            'email' => $email,
            'username' => $username,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
        );

        if (!empty($password_baru)) {
            if ($password_baru === $konfirmasi_password) {
                $data['password'] = md5($password_baru);
                $this->session->set_flashdata('ubah_password', 'Berhasil mengubah password');
            } else {
                $this->session->set_flashdata('kesalahan_password', 'Password baru dan Konfirmasi password tidak sama');
                redirect(base_url('employee/profile'));
            }
        }

        $this->session->set_userdata($data);
        $update_result = $this->absensi_model->update_data('user', $data, array('id' => $this->session->userdata('id')));

        if ($update_result) {
            $this->session->set_flashdata('update_akun', 'Data berhasil diperbarui');
            redirect(base_url('employee/profile'));
        } else {
            $this->session->set_flashdata('gagal_update', 'Gagal memperbarui data');
            redirect(base_url('employee/profile'));
        }
    }

    public function edit_image()
    {
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];

        // Jika ada image yang diunggah
        if ($image) {
            $kode = round(microtime(true) * 1000);
            $file_name = $kode . '_' . $image;
            $upload_path = './images/user/' . $file_name;
            $this->session->set_flashdata('berhasil_ubah_foto', 'Foto berhasil diperbarui.');
            if (move_uploaded_file($image_temp, $upload_path)) {
                // Hapus image lama jika ada
                $old_file = $this->absensi_model->get_karyawan_image_by_id($this->input->post('id'));
                if ($old_file && file_exists('./images/user/' . $old_file)) {
                    unlink('./images/user/' . $old_file);
                }

                $data = [
                    'image' => $file_name
                ];
            } else {
                // Gagal mengunggah image baru
                redirect(base_url('employee/ubah_image/' . $this->input->post('id')));
            }
        } else {
            // Jika tidak ada image yang diunggah
            $data = [
                'image' => 'User.png'
            ];
        }

        // Eksekusi dengan model ubah_data
        $eksekusi = $this->absensi_model->ubah_data('user', $data, array('id' => $this->input->post('id')));

        if ($eksekusi) {
            redirect(base_url('employee/profile'));
        } else {
            redirect(base_url('employee/ubah_image/' . $this->input->post('id')));
        }
    }

    public function aksi_ubah_absensi()
    {
        // Make sure you've loaded the Absensi_model at the beginning of your controller
        $this->load->model('Absensi_model');
    
        $data = [
            'kegiatan' => $this->input->post('kegiatan'),
        ];
        
        $id = $this->input->post('id');
        
        // Use a try-catch block to handle errors during the update
        try {
            $this->load->model('Absensi_model'); // Pastikan model dimuat
            $eksekusi = $this->Absensi_model->update_data('absensi', $data, ['id' => $id]);
        
            if ($eksekusi) {
                $this->session->set_flashdata('berhasil_update', 'Berhasil mengubah kegiatan');
                redirect(base_url('employee/history'));
            } else {
                redirect(base_url('employee/ubah_absen/' . $id));
            }
        } catch (Exception $e) {
            // Handle the error, e.g., log it, display an error message, or redirect to an error page.
            echo 'Error: ' . $e->getMessage();
            // Implement proper error handling here
        }
    }
    public function aksi_menu_izin() {
        if ($this->session->userdata('role') === 'karyawan') {
            $user_id = $this->session->userdata('id');
            $this->form_validation->set_rules('keterangan', 'Keterangan Izin', 'required');
  
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('employee/izin');
            } else {
                $data = array(
                    'id_karyawan' => $user_id,
                    'keterangan' => $this->input->post('keterangan'), // Mengambil data dari form input
                );

                // Memanggil fungsi untuk menambahkan izin
                $this->Absensi_model->addIzin($data);
                // Redirect ke halaman history_absen
                redirect('employee/history');
            }
        } else {
            redirect('employee/izin');
        }
    }

    }
?>

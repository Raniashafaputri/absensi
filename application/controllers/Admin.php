<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model dan library yang diperlukan
        $this->load->model('user_model');
        $this->load->helper('my_helper');
        $this->load->model('Admin_model');
        $this->load->model('m_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $user_id = $this->session->userdata('id');
        $data['user'] = $this->Admin_model->getuserByID($user_id);
        $id_admin = $this->session->userdata('id');
        $data['absen'] = $this->m_model->get_data('absensi')->result();
        $data['pengguna'] = $this->m_model->get_data('user')->num_rows();
        $data['karyawan'] = $this->m_model->get_karyawan_rows();
        $data['absensi_num'] = $this->m_model->get_absensi_count();
        $this->load->view('admin/dashboard', $data);
    }


    public function profile(){
        $this->load->view('admin/profile');
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
				redirect(base_url('karyawan/profile'));
			}
		}

		$this->session->set_userdata($data);
		$update_result = $this->m_model->update_data('user', $data, array('id' => $this->session->userdata('id')));

		if ($update_result) {
			$this->session->set_flashdata('update_user', 'Data berhasil diperbarui');
			redirect(base_url('karyawan/profile'));
		} else {
			$this->session->set_flashdata('gagal_update', 'Gagal memperbarui data');
			redirect(base_url('karyawan/profile'));
		}
	}

	public function edit_foto() {
		$config['upload_path'] = './assets/images/user/'; // Lokasi penyimpanan gambar di server
		$config['allowed_types'] = 'jpg|jpeg|png'; // Tipe file yang diizinkan
		$config['max_size'] = 5120; // Maksimum ukuran file (dalam KB)
	
		$this->load->library('upload', $config);
	
		if ($this->upload->do_upload('userfile')) {
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
	
			// Update nama file gambar baru ke dalam database untuk user yang sesuai
			$user_id = $this->session->userdata('id'); // Ganti ini dengan cara Anda menyimpan ID user yang sedang login
			$current_image = $this->m_model->get_current_image($user_id); // Dapatkan nama gambar saat ini
	
			if ($current_image !== 'User.png') {
				// Hapus gambar saat ini jika bukan 'User.png'
				unlink('./assets/images/user/' . $current_image);
			}
	
			$this->m_model->update_image($user_id, $file_name); // Gantilah 'm_model' dengan model Anda
			$this->session->set_flashdata('berhasil_ubah_foto', 'Foto berhasil diperbarui.');

	
			// Redirect atau tampilkan pesan keberhasilan
			redirect('karyawan/profile'); // Gantilah dengan halaman yang sesuai
		} else {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error_profile', $error['error']);
			redirect('karyawan/profile');
			// Tangani kesalahan unggah gambar
		}
	}


    public function karyawan()
	{
        $data['user'] = $this->m_model->getDataKaryawan();

		$this->load->view('admin/karyawan', $data);
	}

    public function export_karyawan() {
        // Ambil data karyawan untuk diekspor
        $data['karyawan'] = $this->Admin_model->exportKaryawan();

        // Lakukan proses ekspor data karyawan di sini (contoh: export ke Excel atau CSV)
        // ...

        // Redirect kembali ke halaman daftar karyawan setelah selesai ekspor
        redirect('admin/karyawan');
    }
    
    public function rekapPerHari() {
		$tanggal = $this->input->get('tanggal');
        $data['perhari'] = $this->Admin_model->getPerHari($tanggal);
        $this->load->view('admin/rekap_harian', $data);
    }
    
    public function rekapPerMinggu() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
    
        if ($start_date && $end_date) {
            $data['perminggu'] = $this->Admin_model->getRekapPerMinggu($start_date, $end_date);
        } else {
            $data['perminggu'] = []; // Or handle this according to your needs if dates are missing
        }
    
        $this->load->view('admin/rekap_mingguan', $data);
    }
     
  // $data['absensi'] = $this->Admin_model->getPerMinggu();        
    
    
    // public function rekap_mingguan($tanggal_awal, $tanggal_akhir) {
    //     // Ambil data rekap mingguan berdasarkan tanggal awal dan akhir
    //     $data['rekap_mingguan'] = $this->admin_model->getRekapMingguan($tanggal_awal, $tanggal_akhir);

    //     // Tampilkan halaman rekap mingguan dengan data
    //     $this->load->view('admin/rekap_mingguan', $data);   

    // }
   
    public function rekap_bulanan() {
        $bulan = $this->input->get('bulan');
    
        if (empty($bulan)) {
            // Handle the case where "bulan" is missing or empty
            // For example, you can set a default value or show an error message.
            $data['error_message'] = "Bulan is missing or invalid.";
        } else {
            // Get data from the model
            $data['rekap_bulanan'] = $this->Admin_model->getRekapBulanan($bulan);
            $data['rekap_harian'] = $this->Admin_model->getRekapHarianByBulan($bulan);
        }
    
        // Load the view
        $this->load->view('admin/rekap_bulanan', $data);
        
    }

    public function export_mingguan()
    {
        $raw_start_date = $this->input->get('start_date');
        $raw_end_date = $this->input->get('end_date');
        $start_date = date('Y-m-d', strtotime($raw_start_date));
        $end_date = date('Y-m-d', strtotime($raw_end_date));
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'Rekap Mingguan');
        $sheet->mergeCells('A1:G1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama');
        $sheet->setCellValue('C3', 'Kegiatan');
        $sheet->setCellValue('D3', 'Tanggal');
        $sheet->setCellValue('E3', 'Jam Masuk');
        $sheet->setCellValue('F3', 'Jam Pulang');
        $sheet->setCellValue('G3', 'Keterangan');

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        $data = $this->Admin_model->getRekapPerMinggu($start_date, $end_date);
        $no = 1;
        $numrow = 4;
        foreach ($data as $row) {
           
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $row->username);
            $sheet->setCellValue('C' . $numrow, $row->kegiatan);
            $sheet->setCellValue('D' . $numrow, $row->date);
            $sheet->setCellValue('E' . $numrow, $row->jam_masuk);
            $sheet->setCellValue('F' . $numrow, $row->jam_pulang);
            // $sheet->setCellValue('G' . $numrow, !$row->keterangan_izin ? 'Masuk' : $row->keterangan_izin );
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('Rekap Mingguan');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="Rekap Mingguan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // public function export_mingguan()
    // {
    //     $raw_start_date = $this->input->get('start_date');
    //     $raw_end_date = $this->input->get('end_date');
    //     $start_date = date('Y-m-d', strtotime($raw_start_date));
    //     $end_date = date('Y-m-d', strtotime($raw_end_date));
    
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $style_col = [
    //         'font' => ['bold' => true],
    //         'alignment' => [
    //             'horizontal' =>
    //                 \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    //             'vertical' =>
    //                 \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    //         ],
    //         'borders' => [
    //             'top' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'right' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'bottom' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'left' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //         ],
    //     ];

    //     $style_row = [
    //         'font' => ['bold' => true],
    //         'alignment' => [
    //             'vertical' =>
    //                 \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    //         ],
    //         'borders' => [
    //             'top' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'right' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'bottom' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //             'left' => [
    //                 'borderStyle' =>
    //                     \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //         ],
    //     ];

    //     $sheet->setCellValue('A1', 'Rekap Mingguan');
    //     $sheet->mergeCells('A1:G1');
    //     $sheet
    //         ->getStyle('A1')
    //         ->getFont()
    //         ->setBold(true);

    //     $sheet->setCellValue('A3', 'No');
    //     $sheet->setCellValue('B3', 'Nama');
    //     $sheet->setCellValue('C3', 'Kegiatan');
    //     $sheet->setCellValue('D3', 'Tanggal');
    //     $sheet->setCellValue('E3', 'Jam Masuk');
    //     $sheet->setCellValue('F3', 'Jam Pulang');
    //     $sheet->setCellValue('G3', 'Keterangan');

    //     $sheet->getStyle('A3')->applyFromArray($style_col);
    //     $sheet->getStyle('B3')->applyFromArray($style_col);
    //     $sheet->getStyle('C3')->applyFromArray($style_col);
    //     $sheet->getStyle('D3')->applyFromArray($style_col);
    //     $sheet->getStyle('E3')->applyFromArray($style_col);
    //     $sheet->getStyle('F3')->applyFromArray($style_col);
    //     $sheet->getStyle('G3')->applyFromArray($style_col);

    //     $data = $this->Admin_model->getRekapPerMinggu($start_date, $end_date);

    //     $no = 1;
    //     $numrow = 4;
    //     foreach ($data as $row) {
    //         $sheet->setCellValue('A' . $numrow, $no);
    //         $sheet->setCellValue('B' . $numrow, $row->username);
    //         $sheet->setCellValue('C' . $numrow, $row->kegiatan);
    //         $sheet->setCellValue('D' . $numrow, $row->date);
    //         $sheet->setCellValue('E' . $numrow, $row->jam_masuk);
    //         $sheet->setCellValue('F' . $numrow, $row->jam_pulang);
    //         $sheet->setCellValue('G' . $numrow, $row->keterangan_izin);

    //         $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
    //         $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
    //         $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
    //         $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
    //         $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
    //         $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
    //         $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

    //         $no++;
    //         $numrow++;
    //     }

    //     $sheet->getColumnDimension('A')->setWidth(5);
    //     $sheet->getColumnDimension('B')->setWidth(25);
    //     $sheet->getColumnDimension('C')->setWidth(25);
    //     $sheet->getColumnDimension('D')->setWidth(20);
    //     $sheet->getColumnDimension('E')->setWidth(30);
    //     $sheet->getColumnDimension('F')->setWidth(30);
    //     $sheet->getColumnDimension('G')->setWidth(30);

    //     $sheet->getDefaultRowDimension()->setRowHeight(-1);

    //     $sheet
    //         ->getPageSetup()
    //         ->setOrientation(
    //             \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
    //         );

    //     $sheet->setTitle('Rekap Mingguan');

    //     header(
    //         'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    //     );
    //     header('Content-Disposition: attachment; filename="Rekap Mingguan.xlsx"');
    //     header('Cache-Control: max-age=0');

    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save('php://output');
    // }

    public function export_bulanan()
    {
        $bulan = $this->input->get('bulan');
		$absensi = $this->Admin_model->GetBulanan($bulan);
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        
        $sheet->setCellValue('A1', 'Rekap Bulanan');
        $sheet->mergeCells('A1:G1');
        $sheet
        ->getStyle('A1')
        ->getFont()
        ->setBold(true);
        
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama');
        $sheet->setCellValue('C3', 'Kegiatan');
        $sheet->setCellValue('D3', 'Tanggal');
        $sheet->setCellValue('E3', 'Jam Masuk');
        $sheet->setCellValue('F3', 'Jam Pulang');
        $sheet->setCellValue('G3', 'Keterangan');
        
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        
        $bulanan = $this->Admin_model->getBulanan($bulan);
        
        $no = 1;
        $numrow = 4;
        foreach ($bulanan as $data) {
            $sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $data->username);
			$sheet->setCellValue('C' . $numrow, $data->kegiatan);
			$sheet->setCellValue('D' . $numrow, $data->date);
			$sheet->setCellValue('E' . $numrow, $data->jam_masuk);
			$sheet->setCellValue('F' . $numrow, $data->jam_pulang);
			$sheet->setCellValue('G' . $numrow, $data->keterangan_izin);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('Rekap Bulanan');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Rekap Bulanan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function export_harian()
    {
		$tanggal = $this->input->get('tanggal');
    	
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'Rekap Harian');
        $sheet->mergeCells('A1:G1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama');
        $sheet->setCellValue('C3', 'Kegiatan');
        $sheet->setCellValue('D3', 'Tanggal');
        $sheet->setCellValue('E3', 'Jam Masuk');
        $sheet->setCellValue('F3', 'Jam Pulang');
        $sheet->setCellValue('G3', 'Keterangan');

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        $harian = $this->Admin_model->getPerHari($tanggal);

        $no = 1;
        $numrow = 4;
        foreach ($harian as $data) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->username);
            $sheet->setCellValue('C' . $numrow, $data->kegiatan);
            $sheet->setCellValue('D' . $numrow, $data->date);
            $sheet->setCellValue('E' . $numrow, $data->jam_masuk);
            $sheet->setCellValue('F' . $numrow, $data->jam_pulang);
            $sheet->setCellValue('G' . $numrow, $data->keterangan_izin);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->setTitle('Rekap Harian');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="Rekap Harian.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    public function hapusKaryawan($id)
    {
        // Hapus semua catatan terkait dari tabel 'absensi'
        $this->db->where('id_karyawan', $id);
        $this->db->delete('absensi');

        // Hapus pengguna dari tabel 'user'
        $this->db->where('id', $id);
        $this->db->delete('user');

        // Setelah penghapusan berhasil, Anda dapat mengirim respons sukses atau melakukan pengalihan ke halaman lain.
        redirect('admin/karyawan'); // Contoh pengalihan ke halaman daftar karyawan
    }


}
?>

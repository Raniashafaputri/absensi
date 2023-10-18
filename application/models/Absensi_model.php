<?php

class Absensi_model extends CI_Model
{
    public function createAbsensi($data)
    {
        // Menambahkan data absensi baru ke database
        $this->db->insert('absensi', $data);
    }

    public function getAbsensi()
    {
        // Mengambil data absensi dari tabel 'absensi'
        $query = $this->db->get('absensi');

        // Mengembalikan hasil query dalam bentuk array
        return $query->result_array();
    }

    public function addIzin($data) {
        // Fungsi ini digunakan untuk menambahkan izin.
        // Anda dapat mengisi date saat ini sebagai date izin.
        // Anda juga perlu mengatur status ke "izin" dan jam masuk serta jam pulang ke NULL.
    
        $data = array(
            'id_karyawan' => $data['id_karyawan'], // Menggunakan data dari parameter
            'keterangan_izin' => $data['keterangan'],      // Menggunakan data dari parameter
            'date' => date('Y-m-d'),
            'kegiatan' => '-',
            'jam_masuk' => '-',
            'jam_pulang' => '-',
            'status' => 'Izin'
        );
    
        // Selanjutnya, masukkan data ini ke tabel "absensi".
        $this->db->insert('absensi', $data);
    }
    public function updateAbsensi($id, $data)
    {
        // Mengubah data absensi berdasarkan ID
        $this->db->where('id', $id);
        $this->db->update('absensi', $data);
    }

    public function deleteAbsensi($id)
    {
        // Menghapus data absensi berdasarkan ID
        $this->db->where('id', $id);
        $this->db->delete('absensi');
    }
    public function update_data($table, $data, $where) {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }
    public function getAbsensiById($absen_id) {
        return $this->db->get_where('absensi', array('id' => $absen_id))->row();
    }      

   // get karyawan
    public function get_karyawan($table)
    {
    return $this->db->where('role', 'karyawan')
                    ->get($table);
    }
    function get_absensi_by_karyawan($id_karyawan) {
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->get('absensi')->result();
    }
    public function image_akun()
    {
        $id_karyawan = $this->session->akundata('id');
        $this->db->select('image');
        $this->db->from('users');
        $this->db->where('id_karyawan');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->image;
        } else {
            return false;
        }
    }
    public function get_by_id($table, $id_column, $id) { 
        $data = $this->db->where($id_column, $id)->get($table); 
        return $data; 
    }

}

?>

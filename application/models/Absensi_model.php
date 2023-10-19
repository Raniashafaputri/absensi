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
    function delete($table, $field, $id)
    {
        $data = $this->db->delete($table, array($field => $id));
        return $data;
    }
    function get_data($table){
        return $this->db->get($table);
    }
    public function addAbsensi($data) {
        // Fungsi ini digunakan untuk menambahkan data absensi.
        // Anda dapat mengisi date dan jam masuk sesuai dengan waktu saat ini.
        // Anda juga harus mengatur status ke "belum Pulang".
        $data['date'] = date('Y-m-d');
        $data['jam_masuk'] = date('H:i:s');
        $data['status'] = 'Belum Pulang';
        $data['keterangan_izin'] = '-';
    
        // Selanjutnya, masukkan data ini ke tabel "absensi".
        $this->db->insert('absensi', $data);
    
        // Kembalikan ID dari data yang baru saja ditambahkan
        return $this->db->insert_id();
    }
    public function updateAbsensi($absen_id, $data) {
        // Perbarui data absensi berdasarkan $absen_id
        $this->db->where('id', $absen_id);
        $this->db->update('absensi', $data);
    }
    public function setAbsensiPulang($absen_id) {
        // Set zona waktu ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');
    
        // Fungsi ini digunakan untuk mengisi jam pulang dan mengubah status menjadi "pulang".
        $data = array(
            'jam_pulang' => date('H:i:s'), // Mengambil waktu saat ini dalam format 24-jam
            'status' => 'Pulang'
        );
    
        // Ubah data absensi berdasarkan absen_id.
        $this->db->where('id', $absen_id);
        $this->db->update('absensi', $data);
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

    // Fungsi untuk memperbarui informasi profil pengguna
    public function updateProfile($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('User', $data);
    }
    public function getuserByID($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }
    public function getUserByEmail($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->row();
    }
    // Fungsi untuk menghapus pengguna berdasarkan ID
    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('User');
    }

    public function updateUserFoto($user_id, $foto)
    {
        $data = ['foto' => $foto];
        $this->db->where('id', $user_id);
        $this->db->update('User', $data);
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
    public function ubah_data($table, $data, $where) { 
        $this->db->update($table, $data, $where); 
        return $this->db->affected_rows(); 
    }
    public function get_karyawan_image_by_id($id) 
    { 
        $this->db->select('image'); 
        $this->db->from('user'); 
        $this->db->where('id', $id); 
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

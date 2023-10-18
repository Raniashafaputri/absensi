<?php

class M_model extends CI_Model{
    function get_data($table){
        return $this->db->get($table);
    }

    function getwhere($table, $data)
    {
        return $this->db->get_where($table, $data);
    }
    function delete($table, $field, $id)
    {
        $data = $this->db->delete($table, array($field => $id));
        return $data;
    }

    function tambah_data($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function get_by_id($table, $id_column, $id) { 
        $data = $this->db->where($id_column, $id)->get($table); 
        return $data; 
    }

    public function ubah_data($table, $data, $where) { 
        $this->db->update($table, $data, $where); 
        return $this->db->affected_rows(); 
    }

        public function register_user($data) {
            // Masukkan data ke dalam tabel 'users' dan kembalikan hasilnya
            return $this->db->insert('users', $data);
        }  
            // Metode untuk mengupdate data
            public function update_data($data) {
                // Lakukan proses pembaruan data di sini
                $this->db->where('kolom_kunci', $data['nilai_kunci']);
                $this->db->update('nama_tabel', $data);
            }
            public function getDataKaryawan() {
                // Gantilah 'histori_karyawan' dengan nama tabel histori karyawan Anda.
                $this->db->select('*');
                $this->db->from('user');
                $this->db->where('role', 'karyawan');
                $query = $this->db->get();
        
                // Kembalikan data dalam bentuk array.
                return $query->result();
            }
            public function getPerHari($tanggal)
            {
                $this->db->select('absensi.*, user.username');
                $this->db->from('absensi');
                $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
                $this->db->where('date', $tanggal);
                $query = $this->db->get();
                return $query->result();
            }
         
        }
?>
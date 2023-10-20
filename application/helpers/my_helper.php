<?php
function panggil_username($id)
{
    $ci = &get_instance();
    $ci->load->database();
    $result = $ci->db->where('id', $id)->get('user');
    foreach ($result->result() as $c) {
        $stmt = $c->username;
        return $stmt;
    }

    function tampil_nama_karawan_byid($id)
    {
        $ci = &get_instance();
        $ci->load->database();
        $result = $ci->db->where('id', $id)->get('user');
        foreach ($result->result() as $c) {
            $stmt = $c->nama_depan . ' ' . $c->nama_belakang;
            return $stmt;
        }
    }

    function get_username_by_id_karyawan($id_karyawan)
    {
        $ci = &get_instance();
        $ci->load->database();
        
        // Query untuk mengambil username dari tabel user berdasarkan id_karyawan
        $query = $ci->db->select('username')
                        ->where('id_karyawan', $id_karyawan)
                        ->get('user');

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->username;
        } else {
            return 'Username not found';
        }
    }
}
?>

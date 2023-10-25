<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function registeruser($data)
    {
        $this->db->insert('user', $data);
    }

    public function getuserByID($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }


    public function getKaryawan() { 
        $query = $this->db->get('user');
        return $query->result_array();
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

    public function getRekapPerMinggu($start_date, $end_date) {
        $this->db->select('absensi.*, user.username');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
        $this->db->where('date >', $start_date);
        $this->db->where('date <', $end_date);
        $query = $this->db->get();
        return $query->result();
    }



    // public function getRekapMingguan() {
    //     $query = $this->db->query("SELECT WEEK(tanggal) as minggu, COUNT(*) as total_absensi FROM absensi GROUP BY minggu");
    //     return $query->result_array();
    // }

    public function getRekapBulanan($bulan) {
        $this->db->select('MONTH(date) as bulan, COUNT(*) as total_absensi');
        $this->db->from('absensi');
        $this->db->where('MONTH(date)', $bulan); // Menyaring data berdasarkan bulan
        $this->db->group_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getRekapHarianByBulan($bulan) {
        $this->db->select('absensi.id, absensi.date, absensi.kegiatan, absensi.id_karyawan, absensi.jam_masuk, absensi.jam_pulang, absensi.status');
        $this->db->from('absensi');
        $this->db->where('MONTH(absensi.date)', $bulan);
        $query = $this->db->get();
        return $query->result_array();
    }   
    public function getBulanan($bulan)
    {
        $this->db->select("absensi.*, user.username");
        $this->db->from("absensi");
        $this->db->join("user", "absensi.id_karyawan = user.id", "left");
        $this->db->where("DATE_FORMAT(date, '%m') = ", $bulan); // Perbaikan di sini
        $query = $this->db->get();
        return $query->result();
    }

    }

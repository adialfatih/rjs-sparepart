<?php
class Sparepart_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_spareparts($search = null, $start = 0, $length = 10) {
        $this->db->select('kode, nama_sparepart as nama, kategori, lokasi_gudang as lokasi, stok, stok_minimum as minimum');
        
        if ($search) {
            $this->db->like('kode', $search);
            $this->db->or_like('nama_sparepart', $search);
            $this->db->or_like('kategori', $search);
        }
        
        $this->db->limit($length, $start);
        $query = $this->db->get('spareparts');
        return $query->result_array();
    }

    public function count_all() {
        return $this->db->count_all('spareparts');
    }

    public function count_filtered($search = null) {
        if ($search) {
            $this->db->like('kode', $search);
            $this->db->or_like('nama_sparepart', $search);
            $this->db->or_like('kategori', $search);
        }
        return $this->db->get('spareparts')->num_rows();
    }
}
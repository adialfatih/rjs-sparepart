<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apis extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Memuat database library CodeIgniter
        //$this->load->database();
    }

    public function get_spareparts_by_category() {
        // Set header untuk memberitahu browser bahwa respons adalah JSON
        header('Content-Type: application/json');

        // Ambil kategori dari parameter GET
        // Menggunakan $this->input->get() adalah cara aman di CI3
        $category = $this->input->get('category', TRUE); // TRUE untuk XSS filtering

        $spareparts = [];

        if (!empty($category)) {
            // Gunakan Query Builder CodeIgniter untuk keamanan dan kemudahan
            $this->db->distinct(); // SELECT DISTINCT
            $this->db->select('nama_sparepart'); // Memilih kolom nama_sparepart
            $this->db->like('kategori_sp', $category); // WHERE kategori_sparepart LIKE '%category%'
            $query = $this->db->get('table_sparepart'); // FROM detil_pembelian

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $spareparts[] = $row->nama_sparepart;
                }
            }
        }

        // Keluarkan array sebagai JSON
        echo json_encode($spareparts);
    }
}
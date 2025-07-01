<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Endpoint JSON: job pending untuk printer-bot
    public function pending() {
        header('Content-Type: application/json');
        $query = $this->db->get_where('table_cetak', array('status_cetak' => 'pending'));
        echo json_encode($query->result());
    }

    // Tandai job selesai setelah berhasil cetak
    public function mark_done($id) {
        header('Content-Type: application/json');
        $this->db->where('id', $id);
        $this->db->update('table_cetak', array('status_cetak' => 'done'));
        echo json_encode(array('status' => 'success', 'id' => $id));
    }

    // Endpoint terima job baru (POST)
    public function add_job() {
        header('Content-Type: application/json');

        $file_name = $this->input->post('file_name');
        if (!$file_name) {
            echo json_encode(array('status' => 'error', 'message' => 'file_name required'));
            return;
        }

        $this->db->insert('table_cetak', array('file_name' => $file_name));
        echo json_encode(array('status' => 'success'));
    }

    // View: daftar file + tombol cetak
    public function daftar() {
        // Anggap daftar file PDF di folder /public/pdf/
        $dir = FCPATH . 'public/pdf/';
        $data['pdf_files'] = [];

        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                    $data['pdf_files'][] = $file;
                }
            }
        }

        $this->load->view('daftar_cetak', $data);
    }
}

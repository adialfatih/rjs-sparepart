<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcode_generator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ciqrcode'); // Memanggil library wrapper kita
    }

    public function index() {
        $this->load->view('qrcode_view');
    }

    public function generate() {
        // Pastikan folder qrcode ada
        $qr_dir = FCPATH.'public/qrcode/';
        if (!is_dir($qr_dir)) {
            mkdir($qr_dir, 0755, true);
        }

        $qrtext = $this->input->post('qrcode');
        
        if(empty($qrtext)) {
            echo json_encode(['error' => 'Kode QR tidak boleh kosong']);
            return;
        }

        // Nama file unik
        $filename = 'qr_'.$qrtext.'.png';
        $filepath = $qr_dir.$filename;

        // Parameter untuk generate QR Code
        $params = array(
            'data' => $qrtext,
            'level' => 'H', // L, M, Q, H (Low to High)
            'size' => 10,
            'savename' => $filepath
        );
        
        // Generate QR Code
        $this->ciqrcode->generate($params);

        // Return path relatif untuk ditampilkan
        echo json_encode([
            'success' => true,
            'image_url' => base_url('public/qrcode/'.$filename)
        ]);
    }
}
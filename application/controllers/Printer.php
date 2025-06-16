<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
        // if($this->session->userdata('login_form') != "bot-as1563sd1123sfasda2389asff53afhafaf670fa"){
        //     redirect(base_url('login'));
        // }
    }
    
    function index(){ 
        
    } //end
    public function thermal()
    {
        $text = "=== STRUK PEMBELIAN ===\n";
        $text .= "Produk A  x2  Rp20.000\n";
        $text .= "Produk B  x1  Rp15.000\n";
        $text .= "-----------------------\n";
        $text .= "TOTAL    Rp35.000\n";
        $text .= "Terima kasih!\n";

        // Kirim data ke print bridge (localhost:8000)
        $url = 'http://localhost:8081/print';

        $data = json_encode(['text' => $text]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);

        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            echo "Curl Error: " . $err;
        } else {
            echo $result;
        }
    }
    public function cetak() {
    // Data yang akan dikirim ke NodeJS
    $data = [
      "nama_resto" => "Restoran Enak Sekali",
      "items" => [
        ["menu" => "Nasi Goreng", "qty" => 2, "harga" => 15000],
        ["menu" => "Teh Manis", "qty" => 1, "harga" => 5000]
      ],
      "total" => 35000
    ];

    // Konversi ke JSON
    $json_data = json_encode($data);

    // Kirim ke NodeJS
    $ch = curl_init('http://localhost:8081/print');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json',
      'Content-Length: ' . strlen($json_data)
    ]);

    $result = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
      echo "CURL Error: $error";
    } else {
      echo $result; // "Print success" atau "Print failed"
    }
  }
}
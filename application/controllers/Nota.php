<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nota extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->library('pdf');
        if($this->session->userdata('login_form') != "bot-as1563sd1123sfasda2389asff53afhafaf670fa"){
            //redirect(base_url('login'));
        }
    }
    public function cetak($id_pesanan)
    {
        
        // Dummy data, nanti diganti query dari database
        $pesanan = [
            'nama_customer' => 'Andi Wijaya',
            'tanggal_pesan' => '2025-06-09',
            'menu' => [
                ['kode_menu' => 'M001', 'nama_menu' => 'Ayam Bakar', 'qty' => 1, 'harga' => 15000],
                ['kode_menu' => 'M002', 'nama_menu' => 'Es Teh', 'qty' => 2, 'harga' => 3000],
            ]
        ];

        $total = 0;
        //
        $pdf = new FPDF('P','mm',array(58,100)); // Panjang bisa dinamis
        $pdf->AddPage();
        $pdf->SetMargins(2, 2, 0);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, 'NOTA PEMESANAN', 1, 1, 'L');

        $pdf->Ln(0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 4, 'Nama: Ronaldo', 0, 1, 'L');
        $pdf->Cell(0, 4, 'Tgl : 2 Mei 2025, 22:00', 0, 1, 'L');

        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(14, 5, 'Kode', 1, 0, 'C');
        $pdf->Cell(20, 5, 'Menu', 1, 0, 'C');
        $pdf->Cell(8, 5, 'Qty', 1, 0, 'C');
        $pdf->Cell(16, 5, 'Harga', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 8);
        $total = 0;

        foreach ($pesanan['menu'] as $menu) {
            $subtotal = $menu->harga * $menu->qty;
            $total += $subtotal;

            $pdf->Cell(14, 5, $menu->kode_menu, 1, 0, 'C');
            $pdf->Cell(20, 5, substr($menu->nama_menu, 0, 12), 1, 0, 'L'); // max 12 char
            $pdf->Cell(8, 5, $menu->qty, 1, 0, 'C');
            $pdf->Cell(16, 5, number_format($subtotal, 0, ',', '.'), 1, 1, 'R');
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(42, 6, 'TOTAL BAYAR', 1, 0, 'R');
        $pdf->Cell(16, 6, number_format($total, 0, ',', '.'), 1, 1, 'R');

        $pdf->Ln(4);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 6, 'Terima Kasih :)', 0, 1, 'C');

        

        // Simpan ke folder public
        $filename = 'nota_' . $id_pesanan . '.pdf';
        $output_path = FCPATH . 'public/' . $filename;

        //$pdf->Output('F', $output_path); // simpan ke file
        $pdf->Output(); // untuk preview

        //echo 'Nota disimpan di: ' . base_url('public/' . $filename);
    }
}

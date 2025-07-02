<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nota extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->library('pdf');
    }

    public function qrcode(){
        //$this->load->library('mypdf');
        $kodeinit = $this->uri->segment(3);
        $kodesp = $this->uri->segment(4);
        $nama_file = "Cetak_sparepart_".$kodesp."_".$kodeinit."";
        $cek = $this->db->query("SELECT kodesp FROM stok_sparepart WHERE kodesp='$kodesp'")->num_rows();
        if($cek > 0){
            $cek2 = $this->db->query("SELECT * FROM stok_sparepart WHERE kodesp='$kodesp' GROUP BY qrcode");
            $jumlah_qr = $cek2->num_rows();
            if($jumlah_qr == 1){
                //jika qr hanya 1 model
                $tulisanKode = $cek2->row('qrcode');
                $tulisanKode2 = ''.$kodeinit.'-'.$cek2->row('qrcode');
                $gambar = "qr_".$tulisanKode.".png";
                $pdf = new FPDF('L','mm', array(40,30));

                $pdf->AddPage();
                $pdf->SetMargins(0,0,0);
                $pdf->SetAutoPageBreak(false);
                $pdf->SetFont('Arial', 'B', 12);
                $qr_width = 20; // mm
                $x_qr = (40 - $qr_width) / 2;
                $y_qr = 3;
                $thisUrl = "".base_url()."";
                $pdf->Image(''.$thisUrl.'public/qrcode/'.$gambar.'', $x_qr, $y_qr, $qr_width, $qr_width, 'PNG');
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(0, $qr_width + 3 ); // atur posisi XY manual, tepat di bawah QR
                $pdf->MultiCell(40, 5, $tulisanKode2, 0, 'C'); // pakai MultiCell agar tidak trigger auto page break

                $pdf->AddPage();
                $pdf->SetMargins(0,0,0);
                $pdf->SetAutoPageBreak(false);
                $pdf->SetFont('Arial', 'B', 12);
                $qr_width = 20; // mm
                $x_qr = (40 - $qr_width) / 2;
                $y_qr = 3;
                $thisUrl = "".base_url()."";
                $pdf->Image(''.$thisUrl.'public/qrcode/'.$gambar.'', $x_qr, $y_qr, $qr_width, $qr_width, 'PNG');
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(0, $qr_width + 3 ); // atur posisi XY manual, tepat di bawah QR
                $pdf->MultiCell(40, 5, $tulisanKode2, 0, 'C'); // pakai MultiCell agar tidak trigger auto page break

                $pdf->AddPage();
                $pdf->SetMargins(0,0,0);
                $pdf->SetAutoPageBreak(false);
                $pdf->SetFont('Arial', 'B', 12);
                $qr_width = 20; // mm
                $x_qr = (40 - $qr_width) / 2;
                $y_qr = 3;
                $thisUrl = "".base_url()."";
                $pdf->Image(''.$thisUrl.'public/qrcode/'.$gambar.'', $x_qr, $y_qr, $qr_width, $qr_width, 'PNG');
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(0, $qr_width + 3 ); // atur posisi XY manual, tepat di bawah QR
                $pdf->MultiCell(40, 5, $tulisanKode2, 0, 'C'); // pakai MultiCell agar tidak trigger auto page break

                $filename = ''.$nama_file.'.pdf';
                $output_path = FCPATH . 'public/pdf/' . $filename;

                $pdf->Output('F', $output_path); // simpan ke file
                //end testing 1 gambar
            } else {
                $array_gambar = array();
                $tulisanKode = $cek2->row('qrcode');
                $tulisanKode2 = ''.$kodeinit.'-'.$cek2->row('qrcode');
                $gambar = "qr_".$tulisanKode.".png";
                $pdf = new FPDF('L','mm', array(40,30));

                foreach($cek2->result() as $val){
                    //$thisQr = "qr_".$val->qrcode.".png";
                    $tulisanKode = $val->qrcode;
                    $tulisanKode2 = ''.$kodeinit.'-'.$tulisanKode;
                    $gambar = "qr_".$tulisanKode.".png";
                    $pdf->AddPage();
                    $pdf->SetMargins(0,0,0);
                    $pdf->SetAutoPageBreak(false);
                    $pdf->SetFont('Arial', 'B', 12);
                    $qr_width = 20; // mm
                    $x_qr = (40 - $qr_width) / 2;
                    $y_qr = 3;
                    $thisUrl = "".base_url()."";
                    $pdf->Image(''.$thisUrl.'public/qrcode/'.$gambar.'', $x_qr, $y_qr, $qr_width, $qr_width, 'PNG');
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->SetXY(0, $qr_width + 3 ); // atur posisi XY manual, tepat di bawah QR
                    $pdf->MultiCell(40, 5, $tulisanKode2, 0, 'C'); // pakai MultiCell agar tidak trigger auto page break

                }
                $filename = ''.$nama_file.'.pdf';
                $output_path = FCPATH . 'public/pdf/' . $filename;

                $pdf->Output('F', $output_path); // simpan ke file
            }
            $response = [
                'status' => 'success',
                'message' => 'Berhasil menyimpan dalam antrian cetak'
            ];
            $this->data_model->saved('table_cetak',[
                'file_name' => $filename,
            ]);
            echo json_encode($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Sparepart Kosong'
            ];
            echo json_encode($response);
        }
        
       
        
        //$pdf->Output(); // untuk preview
    }
    
}

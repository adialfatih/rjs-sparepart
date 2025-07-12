<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data2 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
        if($this->session->userdata('login_form') != "spare-as1563sd1123sfasda2389asff53afhafaf670fa"){
            redirect(base_url('login'));
        }
        date_default_timezone_set("Asia/Jakarta");
    }
    
    function index(){ 
        
    } //end

    function pemakaian(){
        $id = $this->input->get('sp', TRUE);
        if($id == "sp"){
            $qry = $this->db->query("SELECT * FROM riwayat_pemakaian WHERE departement='Spinning' ORDER BY tanggal_pakai DESC");
        } else {
            $qry = $this->db->query("SELECT * FROM riwayat_pemakaian WHERE departement='Weaving' ORDER BY tanggal_pakai DESC");
        }
        if($qry->num_rows() > 0){
            $no=1;
            foreach($qry->result() as $val){
                $cdsp = $val->kodesp;
                $id = $val->id_rwytpakai;
                $spr = $this->data_model->get_byid('table_sparepart',['kodesp'=>$cdsp])->row_array();
                $txt = "".$spr['nama_sparepart']." tanggal ".date('d M Y', strtotime($val->tanggal_pakai))."";
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".date('d M Y', strtotime($val->tanggal_pakai))."</td>";
                echo "<td>".strtoupper($val->operator)."</td>";
                echo "<td>".$spr['nama_sparepart']."</td>";
                echo "<td>".$val->qrcode."</td>";
                echo "<td>".$val->jumlah_sp." ".$spr['satuan_pemakaian']."</td>";
                echo "<td>".$val->no_mc."</td>";
                echo "<td>".$val->jml_balik_sp."</td>";
                ?>
                <td>
                    <button class="btn btn-icon btn-primary" onclick="viewPemakaian('<?=$id;?>')">
                        <span class="material-icons">search</span>
                    </button>
                    <button class="btn btn-icon btn-danger" onclick="hpsPemakaian('<?=$id;?>','<?=$txt;?>')">
                        <span class="material-icons">close</span>
                    </button>
                </td>
                <?php
                echo "</tr>";
                $no++;
            }
        }
    } //end
    function showpakai(){
        $id = $this->input->get('id', TRUE);
        $akses = $this->session->userdata('akses');
        $ck = $this->data_model->get_byid('riwayat_pemakaian',['id_rwytpakai'=>$id]);
        if($ck->num_rows() == 1){
            $kdsp = $ck->row("kodesp");
            $codepakai = $ck->row("codepakai");
            $ti = $ck->row("tanggal_input");
            $lg = $ck->row("user_login");
            $spr = $this->data_model->get_byid('table_sparepart',['kodesp'=>$kdsp])->row_array();
            ?>
            <table>
                <tr>
                    <td style="width:200px;">Departement</td>
                    <td>: <strong>Gudang <?=$ck->row("departement");?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">Tanggal Pakai</td>
                    <td>: <strong><?=date('d M Y', strtotime($ck->row("tanggal_pakai")));?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">Operator</td>
                    <td>: <strong><?=strtoupper($ck->row("operator"));?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">Kategori</td>
                    <td>: <strong><?=$spr['kategori_sp'];?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">Sparepart</td>
                    <td>: <strong><?=$spr['nama_sparepart'];?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">QR Code</td>
                    <td>: <strong><?=$ck->row("qrcode");?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">Jumlah Ambil</td>
                    <td>: <strong><?=$ck->row("jumlah_sp"). " " .$spr['satuan_pemakaian'];?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">Mesin</td>
                    <td>: <strong><?=$ck->row("no_mc");?></strong></td>
                </tr>
                <?php
                if($ck->row("balik_sp")=="null"){
                    $spb = "<font style='color:red;'>Tidak ada</font>";
                } 
                if($ck->row("balik_sp")=="reuseable"){
                    $spb = "Ada - Bisa Dipakai" .$ck->row("jml_balik_sp"). " ".$spr['satuan_pemakaian'];
                } 
                if($ck->row("balik_sp")=="rusak"){
                    $spb = "Ada - Rusak " .$ck->row("jml_balik_sp"). " ".$spr['satuan_pemakaian'];
                } 
                ?>
                <tr>
                    <td style="width:200px;">Sparepart Bekas</td>
                    <td>: <strong><?=$spb;?></strong></td>
                </tr>
                <?php if($akses=="admin"){?>
                <tr>
                    <td style="width:200px;">Rincian Item</td>
                    <td>
                        <table border="1">
                            <tr>
                                <td>Nama</td>
                                <td>Supplier</td>
                                <td>Harga</td>
                            </tr>
                            <?php
                            $dtp = $this->db->query("SELECT codeinput,harga_satuan,codepakai FROM stok_sparepart_pakai WHERE codepakai='$codepakai'");
                            $total=0;
                            foreach($dtp->result() as $r){
                                $ci = $r->codeinput;
                                $id_detilpem = $this->db->query("SELECT id_detilpem,codeinput FROM riwayat_tarik WHERE codeinput='$ci'")->row("id_detilpem");
                                $kodebeli = $this->db->query("SELECT id_detilpem,kode_beli FROM detil_pembelian WHERE id_detilpem='$id_detilpem'")->row("kode_beli");
                                $supp = $this->db->query("SELECT supp,kode_beli FROM pembelian WHERE kode_beli='$kodebeli'")->row("supp");
                                echo "<tr>";
                                echo "<td>".$spr['nama_sparepart']."</td>";
                                echo "<td>".strtoupper($supp)."</td>";
                                echo "<td>Rp. ".number_format($r->harga_satuan)."</td>";
                                echo "</tr>";
                                $total+=$r->harga_satuan;
                            }
                            if($dtp->num_rows() > 1){
                                echo "<tr>";
                                echo "<td colspan='2'>Total</td>";
                                echo "<td>Rp. ".number_format($total)."</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                
                <?php } ?>
                <tr>
                    <td colspan="2" style="font-size:12px;text-align:right;">
                        Di input oleh : <strong><?=ucwords($lg);?></strong> tanggal <strong><?=date('d M Y', strtotime($ti));?></strong> jam <strong><?=date('H:i', strtotime($ti));?></strong>
                    </td>
                </tr>
            </table>
            <?php
        } else {
            echo "Token Error..";
        }
    }
    function hpspakai(){
        $id = $this->input->get('id', TRUE);
        $ck = $this->data_model->get_byid('riwayat_pemakaian',['id_rwytpakai'=>$id]);
        if($ck->num_rows() == 1){
            $codepakai = $ck->row("codepakai");
            $dt = $this->data_model->get_byid('stok_sparepart_pakai',['codepakai'=>$codepakai])->result();
            foreach($dt as $val){
                $this->data_model->saved('stok_sparepart',[
                    'idstok'    => $val->idstok,
                    'kodesp'    => $val->kodesp,
                    'qrcode'    => $val->qrcode,
                    'codeinput' => $val->codeinput,
                    'lokasi'    => $val->lokasi,
                    'penempatan'=> $val->penempatan,
                    'harga_satuan'=> $val->harga_satuan
                ]);
            }
            $this->data_model->delete('stok_sparepart_pakai','codepakai',$codepakai);
            $this->data_model->delete('stok_sparepart_rusak','codepakai',$codepakai);
            $this->data_model->delete('stok_sparepart_bekas','codepakai',$codepakai);
            $this->data_model->delete('riwayat_pemakaian','id_rwytpakai',$id);
            $response = [
                'status' => 200,
                'msg' => 'Stok di kembalikan ke gudang'
            ];
        } else {
            $response = [
                'status' => 500,
                'msg' => 'Token Error'
            ];
        }
        echo json_encode($response);
    }
    function showqrthis(){
        $kdsp = $this->input->get('kdsp', TRUE);
        $barcode = $this->db->query("SELECT DISTINCT qrcode FROM stok_sparepart WHERE kodesp='$kdsp'");
        if($barcode->num_rows() == 1){
            $showQR = $barcode->row("qrcode");
            ?>
            <div style="width:100%;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:5px;">
                <img src="<?=base_url('public/qrcode/qr_'.$showQR.'.png');?>" alt="Scan Code">
                <span style="font-size:20px;"><?=$showQR;?></span>
            </div>
            <?php
        } else {
            //$showQR = "Ada ".$barcode->num_rows()." Kode";
            echo '<div style="width:100%;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:15px;">';
            foreach($barcode->result() as $val){
                $showQR = $val->qrcode;
                ?><div style="width:100%;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:5px;"><img src="<?=base_url('public/qrcode/qr_'.$showQR.'.png');?>" alt="Scan Code <?=$showQR;?>"><span style="font-size:20px;"><?=$showQR;?></span></div><?php
            }
            echo '</div>';
        }
    }
}
?>
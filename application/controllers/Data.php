<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller
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
    function simpanPembelian(){
        $tglDatang = $this->input->post('tglDatang', TRUE);
        $tglNota = $this->input->post('tglNota', TRUE);
        $nomorNota = $this->input->post('nomorNota', TRUE);
        $supp = $this->input->post('supp', TRUE);
        $divisiId = $this->input->post('divisiId', TRUE);
        $namaSpare = $this->input->post('namaSpare', TRUE);
        $jmlPcs = $this->input->post('jmlPcs', TRUE);
        $hrgPcs = $this->input->post('hrgPcs', TRUE);
        $hrgPcs = preg_replace('/[^0-9]/', '', $hrgPcs);
        //$keteranganss = $this->input->post('keteranganss', TRUE);
        $codebeli = $this->input->post('codebeli', TRUE);
        $fromdata = $this->input->post('fromdata', TRUE);
        if($codebeli == "0" || $codebeli == 0){
            $codebeli2 = $this->data_model->acakKode(23);
        }
        
        if($tglDatang!="" && $tglNota!="" && $nomorNota!="" && $supp!="" && $divisiId!="" && $codebeli!="" && $fromdata!=""){
            if($fromdata=="simpandata"){
                if($codebeli == "0"){
                    if($namaSpare!="" && $jmlPcs!="" && $hrgPcs!="" && intval($jmlPcs)>0 && intval($hrgPcs)>0){
                        $this->data_model->saved('pembelian',[
                            'tgl_datang' => $tglDatang,
                            'tgl_nota' => $tglNota,
                            'no_nota_sj' => strtoupper($nomorNota),
                            'supp' => strtolower($supp),
                            'untuk' => $divisiId,
                            'tgl_input' => date('Y-m-d H:i:s'),
                            'yginput' => $this->session->userdata('username'),
                            'kode_beli' => $codebeli2
                        ]);
                        $x = explode('-', $jmlPcs);
                        if(count($x) == 2){
                            $xQTY = $x[0];
                            $xSatuan = $x[1];
                        } else {
                            $xQTY = $x[0];
                            $xSatuan = "Pcs";
                        }
                        $total_harga = $hrgPcs * $xQTY;
                        $this->data_model->saved('detil_pembelian',[
                            'kode_beli' => $codebeli2,
                            'nama_sparepart' => strtolower($namaSpare),
                            'qty' => $xQTY,
                            'satuan' => $xSatuan,
                            'harga_qty' => $hrgPcs,
                            'total_harga' => $total_harga,
                            'lokasi' => 'Kantor'
                        ]);
                        $response = [
                            'status' => 'success',
                            'message' => 'Pembelian '.$namaSpare.'',
                            'kode_beli' => $codebeli2,
                            'newCsrfHash' => $this->security->get_csrf_hash()
                        ];
                    } else {
                        $xtx = $namaSpare." - ".$jmlPcs." - ". $hrgPcs;
                        $response = [
                            'status' => 'error',
                            'message' => "Masukan item sparepart dengan benar!",
                            'kode_beli' => '0',
                            'newCsrfHash' => $this->security->get_csrf_hash()
                        ];
                    }
                } else {
                    $this->data_model->updatedata('kode_beli',$codebeli,'pembelian',[
                        'tgl_datang' => $tglDatang,
                        'tgl_nota' => $tglNota,
                        'no_nota_sj' => strtoupper($nomorNota),
                        'supp' => strtolower($supp),
                        'untuk' => $divisiId,
                    ]);
                    $response = [
                        'status' => 'success',
                        'message' => 'Update data pembelian',
                        'kode_beli' => $codebeli,
                        'newCsrfHash' => $this->security->get_csrf_hash()
                    ];
                }
                //$cekItem = $this->data_model->get_byid('')
            } else {
                //jika di klik add item
                if($codebeli == "0"){
                    if($namaSpare!="" && $jmlPcs!="" && $hrgPcs!="" && intval($jmlPcs)>0 && intval($hrgPcs)>0){
                        $this->data_model->saved('pembelian',[
                            'tgl_datang' => $tglDatang,
                            'tgl_nota' => $tglNota,
                            'no_nota_sj' => strtoupper($nomorNota),
                            'supp' => strtolower($supp),
                            'untuk' => $divisiId,
                            'tgl_input' => date('Y-m-d H:i:s'),
                            'yginput' => $this->session->userdata('username'),
                            'kode_beli' => $codebeli2
                        ]);
                        $x = explode('-', $jmlPcs);
                        if(count($x) == 2){
                            $xQTY = $x[0];
                            $xSatuan = $x[1];
                        } else {
                            $xQTY = $x[0];
                            $xSatuan = "Pcs";
                        }
                        $total_harga = $hrgPcs * $xQTY;
                        $this->data_model->saved('detil_pembelian',[
                            'kode_beli' => $codebeli2,
                            'nama_sparepart' => strtolower($namaSpare),
                            'qty' => $xQTY,
                            'satuan' => $xSatuan,
                            'harga_qty' => $hrgPcs,
                            'total_harga' => $total_harga,
                            'lokasi' => 'Kantor'
                        ]);
                        $response = [
                            'status' => 'success',
                            'message' => 'pembelian Item '.$namaSpare,
                            'kode_beli' => $codebeli2,
                            'newCsrfHash' => $this->security->get_csrf_hash()
                        ];
                    } else {
                        $response = [
                            'status' => 'error',
                            'message' => 'Masukan item sparepart dengan benar.!',
                            'kode_beli' => '0',
                            'newCsrfHash' => $this->security->get_csrf_hash()
                        ];
                    }
                } else {
                    $x = explode('-', $jmlPcs);
                    if(count($x) == 2){
                        $xQTY = $x[0];
                        $xSatuan = $x[1];
                    } else {
                        $xQTY = $x[0];
                        $xSatuan = "Pcs";
                    }
                    $total_harga = $hrgPcs * $xQTY;
                    $this->data_model->saved('detil_pembelian',[
                        'kode_beli' => $codebeli,
                        'nama_sparepart' => strtolower($namaSpare),
                        'qty' => $xQTY,
                        'satuan' => $xSatuan,
                        'harga_qty' => $hrgPcs,
                        'total_harga' => $total_harga,
                        'lokasi' => 'Kantor'
                    ]);
                    $response = [
                        'status' => 'success',
                        'message' => 'Menambah pembelian item '.$namaSpare,
                        'kode_beli' => $codebeli,
                        'newCsrfHash' => $this->security->get_csrf_hash()
                    ];
                }
            }
            
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Anda tidak mengisi data dengan benar',
                'kode_beli' => '0',
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response);
    } //end
    function detilPembelian(){
        $kd = $this->input->get('kd', TRUE);
        $html = '';
        $cek = $this->data_model->get_byid('detil_pembelian',['kode_beli'=>$kd]);
        $dto = $this->db->query("SELECT tgl_input,yginput,kode_beli FROM pembelian WHERE kode_beli=?",[$kd])->row_array();
        $yginput = ucwords($dto['yginput']);
        $tglinput = date('d M Y H:i', strtotime($dto['tgl_input']));
        if($cek->num_rows() > 0){
            $html .= '<table><thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sparepart</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th></th>
                        </tr></thead><tbody>
            ';
            $no=1;
            $allHarga=0;
            foreach($cek->result() as $val){
                $nama_sparepart = ucwords($val->nama_sparepart);
                $qty_sparepart = number_format($val->qty);
                $sat_sparepart = $val->satuan;
                $hrg_sparepart = number_format($val->harga_qty);
                $ttl_sparepart = number_format($val->total_harga);
                $todata = $val->id_detilpem."_".$nama_sparepart."_".$qty_sparepart."_".$sat_sparepart."";
                $allHarga+=$val->total_harga;
                $html .= '<tr>
                            <td>'.$no.'</td>
                            <td>'.$nama_sparepart.'</td>
                            <td>'.$qty_sparepart.' '.$sat_sparepart.'</td>
                            <td>Rp. '.$hrg_sparepart.'</td>
                            <td>Rp. '.$ttl_sparepart.'</td>
                            <td><a href="javascript:void(0);" style="color:red;text-decoration:none;" onclick="hapusSparepart(\''.$todata.'\')">Hapus</a></td>
                        </tr>
                ';
                $no++;
            }
            $html .= '<tr><td></td><td></td><td></td><td></td><td><strong>Rp. '.number_format($allHarga).'</strong></td><td></td></tr></tbody>
            <tfoot>
                <tr>
                    <td colspan="6" style="font-size:12px;">Diinput oleh : <strong>'.$yginput.'</strong>, tanggal : <strong>'.$tglinput.'</strong></td>
                </tr>
            </tfoot>
            </table>';
            
            $response = [
                'status' => 'success',
                'message' => $cek->num_rows(),
                'html' => $html,
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        } else {
            $response = [
                'status' => 'success',
                'message' => '0 data',
                'html' => '',
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response);
    } //end

    function showPembelian(){
        $cek = $this->db->query("SELECT * FROM pembelian ORDER BY idpemb DESC");
        if($cek->num_rows() > 0){
            foreach($cek->result() as $val){
                $kode = $val->kode_beli;
                $ttl = $this->db->query("SELECT SUM(total_harga) AS ttl FROM detil_pembelian WHERE kode_beli = ? ", [$kode])->row("ttl");
                if($val->untuk == "Gudang Weaving"){
                    $sty = '<span class="status-badge danger">Weaving</span>';
                } else {
                    if($val->untuk == "Gudang Spinning"){
                        $sty = '<span class="status-badge success">Spinning</span>';
                    } else {
                        $sty = $val->untuk;
                    }
                }
                ?>
                <tr>
                    <td data-order="<?=$val->tgl_datang;?>"><?=date('d M Y', strtotime($val->tgl_datang));?></td>
                    <td data-order="<?=$val->tgl_nota;?>"><?=date('d M Y', strtotime($val->tgl_nota));?></td>
                    <td data-order="<?=$val->tgl_input;?>"><?=date('d M Y', strtotime($val->tgl_input));?></td>
                    <td><?=$val->no_nota_sj;?></td>
                    <td>Rp. <?=number_format($ttl);?></td>
                    <td><?=strtoupper($val->supp);?></td>
                    <td><?=$sty;?></td>
                    <td>
                        <button class="btn btn-success btn-sm" onclick="showModalPembelian('<?=$kode;?>')">
                            <span class="material-icons">file_open</span>
                        </button>
                    </td>
                </tr>
                <?php
            }
        } 
    } //end

    function bukaPembelian(){
        $kd = $this->input->get('kode', TRUE);
        $cek = $this->data_model->get_byid('pembelian',['kode_beli'=>$kd]);
        if($cek->num_rows() == 1){
            $dt = $cek->row_array();
            $tgl_datang = $dt['tgl_datang'];
            $tgl_nota   = $dt['tgl_nota'];
            $no_nota_sj = $dt['no_nota_sj'];
            $supp       = strtoupper( $dt['supp']);
            $untuk      = $dt['untuk'];
            $tgl_input  = $dt['tgl_input'];
            $kode_beli  = $dt['kode_beli'];
            $yginput    = $dt['yginput'];
            $response   = [
                'status' => 'success',
                'message' => 'Kode ditemukan',
                'tgl_datang' => $tgl_datang,
                'tgl_nota' => $tgl_nota,
                'no_nota_sj' => $no_nota_sj,
                'supp' => $supp,
                'untuk' => $untuk,
                'tgl_input' => $tgl_input,
                'kode_beli' => $kode_beli,
                'yginput' => $yginput
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Token Error..!!',
            ];
        }
        echo json_encode($response);
    } //end

    function showReadyKantor(){
        $kd = $this->input->get('sp', TRUE);
        if($kd == "tarikwv"){
            $qry = $this->data_model->get_byid('v_onkantor', ['untuk'=>'Gudang Weaving']);
        } else {
            $qry = $this->data_model->get_byid('v_onkantor', ['untuk'=>'Gudang Spinning']);
        }
        if($qry->num_rows() > 0){
            foreach($qry->result() as $key => $val){
                $no = $key + 1;
                ?>
                <tr>
                    <td><?=$no;?></td>
                    <td><?=strtoupper($val->nama_sparepart);?></td>
                    <td><?=number_format($val->qty);?></td>
                    <td><?=$val->satuan;?></td>
                    <td data-order="<?=$val->tgl_datang;?>"><?=date('d M Y',strtotime($val->tgl_datang));?></td>
                    <td><button type="button" class="btn btn-primary" onclick="tarikGudang('<?=$kd;?>','<?=$val->id_detilpem;?>')">Tarik</button></td>
                </tr>
                <?php 
            }
        }
    } //end
    function hapusItemSp(){
        $kd = $this->input->get('id', TRUE);
        $code_beli = $this->data_model->get_byid('detil_pembelian',['id_detilpem'=>$kd])->row("kode_beli");
        $this->db->query("DELETE FROM detil_pembelian WHERE id_detilpem=?", [$kd]);
        $response = [
            'status' => 'success',
            'message' => $code_beli
        ];
        echo json_encode($response);
    }
    function showItemSatuan(){
        $id = $this->input->get('id', TRUE);
        $cek = $this->data_model->get_byid('v_onkantor',['id_detilpem'=>$id]);
        if($cek->num_rows() == 1){
            $namaItem = strtoupper($cek->row("nama_sparepart"));
            $qty = $cek->row("qty");
            $satuan = $cek->row("satuan");
            $tgl_datang = date('d M Y', strtotime($cek->row("tgl_datang")));
            $html = '- '.$namaItem.' '.$qty.' '.$satuan.'<br>- Tanggal Kedatangan : '.$tgl_datang.'';

            $response = [
                'status' => 'success',
                'idpemb' => $id,
                'html' => $html,
            ];
        } else {
            $response = [
                'status' => 'error',
                'idpemb' => '0',
                'html' => '<font>Data tidak Ditemukan</font>',
            ];
        }
        
        echo json_encode($response);
    } //end
}
?>
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
        $noppn = $this->input->post('noppn', TRUE);
        $nopph = $this->input->post('nopph', TRUE);
        $nilaippn = $this->data_model->parseInputForm($noppn);
        $nilaipph = $this->data_model->parseInputForm($nopph);
        $dibayarOleh = $this->input->post('dibayarOleh', TRUE);
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
                            'untuk' => 'kantor',
                            'tgl_input' => date('Y-m-d H:i:s'),
                            'yginput' => $this->session->userdata('username'),
                            'kode_beli' => $codebeli2,
                            'ppn' => $nilaippn,
                            'pph' => $nilaipph,
                            'pph_tanggung' => $dibayarOleh=='pembeli' ? 'pembeli':'penjual'
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
                            'lokasi' => 'Kantor',
                            'untuk_divisi' => $divisiId
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
                        'untuk' => 'kantor',
                        'ppn' => $nilaippn,
                        'pph' => $nilaipph,
                        'pph_tanggung' => $dibayarOleh=='pembeli' ? 'pembeli':'penjual'
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
                            'untuk' => 'kantor',
                            'tgl_input' => date('Y-m-d H:i:s'),
                            'yginput' => $this->session->userdata('username'),
                            'kode_beli' => $codebeli2,
                            'ppn' => $nilaippn,
                            'pph' => $nilaipph,
                            'pph_tanggung' => $dibayarOleh=='pembeli' ? 'pembeli':'penjual'
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
                            'lokasi' => 'Kantor',
                            'untuk_divisi' => $divisiId
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
                        'lokasi' => 'Kantor',
                        'untuk_divisi' => $divisiId
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
        $dto = $this->db->query("SELECT tgl_input,yginput,kode_beli,ppn,pph,pph_tanggung FROM pembelian WHERE kode_beli=?",[$kd])->row_array();
        $yginput = ucwords($dto['yginput']);
        $nilai_ppn = $dto['ppn'];
        $nilai_pph = $dto['pph'];
        $pph_tgng = $dto['pph_tanggung'];
        if($pph_tgng == "pembeli"){
            $plsmns = "+";
        } else {
            $plsmns = "-";
        }
        $tglinput = date('d M Y H:i', strtotime($dto['tgl_input']));
        if($cek->num_rows() > 0){
            $html .= '<table><thead>
                        <tr>
                            <th>No</th>
                            <th>GD</th>
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
                if($val->untuk_divisi=="Gudang Spinning"){ $gdv="Spinning"; } else {
                    if($val->untuk_divisi=="Gudang Weaving") { $gdv="Weaving"; } else {
                        $gdv = $val->untuk_divisi;
                    }
                }
                $qty_sparepart = number_format($val->qty);
                $sat_sparepart = $val->satuan;
                $hrg_sparepart = number_format($val->harga_qty);
                $ttl_sparepart = number_format($val->total_harga);
                $todata = $val->id_detilpem."_".$nama_sparepart."_".$qty_sparepart."_".$sat_sparepart."";
                $allHarga+=$val->total_harga;
                $html .= '<tr>
                            <td>'.$no.'</td>
                            <td>'.$gdv.'</td>
                            <td>'.$nama_sparepart.'</td>
                            <td>'.$qty_sparepart.' '.$sat_sparepart.'</td>
                            <td>Rp. '.$hrg_sparepart.'</td>
                            <td>Rp. '.$ttl_sparepart.'</td>
                            <td><a href="javascript:void(0);" style="color:red;text-decoration:none;" onclick="hapusSparepart(\''.$todata.'\')">Hapus</a></td>
                        </tr>
                ';
                $no++;
            }
            $nominal_pph1 = ($nilai_pph * $allHarga) / 100;
            $nominal_pph = round($nominal_pph1);
            $harga_plus_ppn = $allHarga + $nilai_ppn;
            if($pph_tgng == "pembeli"){
                $harga_sudah_pph = $harga_plus_ppn + $nominal_pph;
            } else {
                $harga_sudah_pph = $harga_plus_ppn - $nominal_pph;
            }
            $html .= '<tr><td colspan="5"><strong>Total Harga Barang</strong></td><td><strong>Rp. '.number_format($allHarga).'</strong></td><td></td></tr>';
            if($nilai_ppn > 0){
            $html .= '
            <tr>
                <td colspan="4">Nilai PPN</td>
                <td></td>
                <td>Rp. '.number_format($nilai_ppn).'</td>
                <td></td>
            </tr>';
            }
            if($nilai_pph > 0){
            $html .='
            <tr>
                <td colspan="4">Presentase PPH</td>
                <td></td>
                <td>'.$plsmns.' '.number_format($nilai_pph).'% (Rp. '.number_format($nominal_pph).')</td>
                <td></td>
            </tr>'; }
            if($nilai_pph > 0 || $nilai_ppn > 0){ 
            $html .='
            <tr>
                <td colspan="4"><strong>Tagihan Akhir</strong></td>
                <td></td>
                <td><strong>Rp. '.number_format($harga_sudah_pph).'</strong></td>
                <td></td>
            </tr>'; } $html .='
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" style="font-size:12px;">Diinput oleh : <strong>'.$yginput.'</strong>, tanggal : <strong>'.$tglinput.'</strong>,&nbsp;&nbsp; <a href="javascript:void(0);" style="color:red;" onclick="hapusPembelian(\''.$kd.'\')">Hapus pembelian</a></td>
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
                //$ttl2 = $ttl + $val->ppn;
                ?>
                <tr>
                    <td data-order="<?=$val->tgl_datang;?>"><?=date('d M Y', strtotime($val->tgl_datang));?></td>
                    <td data-order="<?=$val->tgl_nota;?>"><?=date('d M Y', strtotime($val->tgl_nota));?></td>
                    <td data-order="<?=$val->tgl_input;?>"><?=date('d M Y', strtotime($val->tgl_input));?></td>
                    <td><?=$val->no_nota_sj;?></td>
                    <td>Rp. <?=number_format($val->ppn);?></td>
                    <td><?=$val->pph;?> %</td>
                    <td>Rp. <?=number_format($ttl);?></td>
                    <td><?=strtoupper($val->supp);?></td>
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
            $ppn        = $dt['ppn'];
            $pph        = $dt['pph'].'%';
            $pph_tanggung= $dt['pph_tanggung'];
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
                'yginput' => $yginput,
                'ppn' => number_format($ppn,0,',','.'),
                'pph' => $pph,
                'pph_tanggung' => $pph_tanggung
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
            $qry = $this->data_model->get_byid('v_onkantor2', ['untuk_divisi'=>'Gudang Weaving']);
            $tipedata = 1;
        }
        if($kd == "tariksp"){
            $qry = $this->data_model->get_byid('v_onkantor2', ['untuk_divisi'=>'Gudang Spinning']);
            $tipedata = 1;
        } 
        if($kd == "rtarikwv"){
            $qry = $this->data_model->get_byid('riwayat_tarik', ['tujuan'=>'Weaving']);
            $tipedata = 2;
        } 
        if($kd == "rtariksp"){
            $qry = $this->data_model->get_byid('riwayat_tarik', ['tujuan'=>'Spinning']);
            $tipedata = 2;
        }
        if($tipedata==1){
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
        } else {
            if($qry->num_rows() > 0){
                foreach($qry->result() as $key => $val){
                    $no = $key + 1;
                    $kdsp = $val->kodesp;
                    $id = $val->id_rwtyk;
                    $rrow = $this->data_model->get_byid('table_sparepart', ['kodesp'=>$kdsp])->row_array();
                    ?>
                    <tr>
                        <td><?=$no;?></td>
                        <td data-order="<?=$val->tanggal_tarik;?>"><?=date('d M Y',strtotime($val->tanggal_tarik));?></td>
                        <td><?=$val->yg_narik;?></td>
                        <td><?=$rrow['kategori_sp'];?></td>
                        <td><?=$rrow['nama_sparepart'];?></td>
                        <td data-order="<?=$val->satuan_pcs;?>"><?=$val->satuan_pcs;?></td>
                        <td><?=$rrow['satuan_pemakaian'];?></td>
                        <td><button type="button" class="btn btn-primary" onclick="viewDetil('<?=$id;?>')">View</button></td>
                    </tr>
                    <?php 
                }
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
    function hapusPembelian(){
        $kd = $this->input->get('id', TRUE);
        //$code_beli = $this->data_model->get_byid('detil_pembelian',['id_detilpem'=>$kd])->row("kode_beli");
        $this->db->query("DELETE FROM detil_pembelian WHERE kode_beli=?", [$kd]);
        $this->db->query("DELETE FROM pembelian WHERE kode_beli=?", [$kd]);
        $response = [
            'status' => 'success',
            'message' => "Kode : 211"
        ];
        echo json_encode($response);
    }
    function showItemSatuan(){
        $id = $this->input->get('id', TRUE);
        $cek = $this->data_model->get_byid('v_onkantor2',['id_detilpem'=>$id]);
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
    function simpan_tarikan(){
        $idDetilPem         = $this->input->post('idDetilPem', TRUE);
        $detil              = $this->db->query("SELECT id_detilpem,qty,harga_qty FROM detil_pembelian WHERE id_detilpem='$idDetilPem'");
        $jmlAsli            = $detil->row("qty");
        $harga_qty          = $detil->row("harga_qty");
        $kategoriSparepart  = $this->input->post('kategoriSparepart', TRUE);
        $namaSparepart      = $this->input->post('namaSparepart', TRUE);
        $locid              = $this->input->post('locid', TRUE);
        $qr_code_data       = $this->input->post('qr_code_data', TRUE);
        $tujuanGudang       = $this->input->post('tujuanGudang', TRUE);
        $pcsid              = $this->input->post('pcsid', TRUE);
        $kode_input         = $this->data_model->acakKode(13);
        $jmlSudahTarik      = $this->db->query("SELECT SUM(satuan_pcs) AS jml FROM riwayat_tarik WHERE id_detilpem='$idDetilPem'")->row("jml");
        $jmlBisaTarik       = $jmlAsli - $jmlSudahTarik;
        //$struktur_barang = $this->convertUnits($dusid, $packid, $pcsid);
        if($idDetilPem!="" && $kategoriSparepart!="" && $namaSparepart!="" && $locid!="" && $qr_code_data!="" && $tujuanGudang!="" && $pcsid!=""){
            $ex = explode('-', $pcsid);
            if(count($ex) == 2){
                $_jumlah = intval($ex[0]);
                $_satuan = ucfirst($ex[1]);
            } else {
                $_jumlah = intval($pcsid);
                $_satuan = "Pcs";
            }
            if($_jumlah > 0 AND $_jumlah<=$jmlBisaTarik){
                $_kat = strtolower($kategoriSparepart);
                $_SP = strtolower($namaSparepart);
                $cek = $this->data_model->get_byid('table_sparepart',['kategori_sp'=>$_kat, 'nama_sparepart'=>$_SP]);
                if($cek->num_rows() == 1){
                    $kode_SP = $cek->row("kodesp");
                } else {
                    $kode_SP = $this->data_model->acakKode(9);
                    $this->data_model->saved('table_sparepart', [
                        'kategori_sp' => strtoupper($_kat),
                        'nama_sparepart' => strtoupper($_SP),
                        'kodesp' => $kode_SP,
                        'satuan_pemakaian' => $_satuan
                    ]);
                }
                for ($i=0; $i <$_jumlah ; $i++) { 
                    $this->data_model->saved('stok_sparepart', [
                        'kodesp' => $kode_SP,
                        'qrcode' => $qr_code_data,
                        'codeinput' => $kode_input,
                        'lokasi' => $tujuanGudang,
                        'penempatan' => $locid,
                        'harga_satuan' => $harga_qty
                    ]);
                }
                $this->data_model->saved('riwayat_tarik', [
                    'id_detilpem' => $idDetilPem,
                    'tujuan' => $tujuanGudang,
                    'kodesp' => $kode_SP,
                    'tanggal_tarik' => date('Y-m-d'),
                    'tanggal_input' => date('Y-m-d H:i:s'),
                    'satuan_pcs' => $_jumlah,
                    'penempatan' => $locid,
                    'kode_qr' => $qr_code_data,
                    'yg_narik' => $this->session->userdata('nama'),
                    'codeinput' => $kode_input,
                ]);
                $response = [
                    'status' => 'success',
                    'message' => 'Menarik data sparepart ke '.$tujuanGudang.'',
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
                $jmlSudahTarik2 = $this->db->query("SELECT SUM(satuan_pcs) AS jml FROM riwayat_tarik WHERE id_detilpem='$idDetilPem'")->row("jml");
                if($jmlSudahTarik2>=$jmlAsli){
                    $this->data_model->updatedata('id_detilpem',$idDetilPem,'detil_pembelian',['lokasi'=>$tujuanGudang]);
                }
            } else {
                $msg = "Minimal tarik 1 dan maksimal tarik".$jmlBisaTarik."";
                $response = [
                    'status' => 'error',
                    'message' => $msg,
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Ada data yang masih kosong.!',
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response); 
    }
    function convertUnits($dus, $pack, $pcs) {
        // Validasi input
        if ($pcs <= 0) { return "0-0-0"; } 
        else {
        // Minimal harus ada pcs
        // Hitung pcs per pack (harus bulat)
        $pcsPerPack = 0;
        if ($pack > 0) {
            $pcsPerPack = floor($pcs / $pack);
            if ($pcsPerPack === 0) { $pcsPerPack = 1; } // Minimal 1 pcs per pack
        } else {
            // Jika tidak ada pack, langsung return pcs saja
            return "0-0-".$pcs;
        }
        
        // Hitung pack per dus (harus bulat)
        $packPerDus = 0;
        if ($dus > 0) {
            $packPerDus = floor($pack / $dus);
            if ($packPerDus === 0) { $packPerDus = 1; } // Minimal 1 pack per dus
        } else {
            // Jika tidak ada dus, return perbandingan pack-pcs saja
            return "0-1-".$packPerDus;
        }
        
        // Return format dus-pack-pcs
        return "1-".$packPerDus."-".$pcsPerPack.""; }
    }

    function showDataStok(){
        $show = $this->input->get('sp', TRUE);
        if($show=="stoksp"){
            $initial_kode = "SP";
            $record = $this->db->query("SELECT * FROM `table_sparepart` WHERE kodesp IN (SELECT kodesp FROM stok_sparepart WHERE lokasi='Spinning')");
            $record2 = $this->db->query("SELECT * FROM `table_sparepart` WHERE kodesp NOT IN (SELECT kodesp FROM stok_sparepart WHERE lokasi='Spinning') AND depart IN ('all','Spinning')");
            $lokasi = "Spinning";
        } else {
            $initial_kode = "WV";
            $record = $this->db->query("SELECT * FROM `table_sparepart` WHERE kodesp IN (SELECT kodesp FROM stok_sparepart WHERE lokasi='Weaving')");
            $record2 = $this->db->query("SELECT * FROM `table_sparepart` WHERE kodesp NOT IN (SELECT kodesp FROM stok_sparepart WHERE lokasi='Weaving') AND depart IN ('all','Weaving')");
            $lokasi = "Weaving";
        }
        if($record->num_rows() > 0){
            $no=1;
            foreach ($record->result() as $key => $value) {
                $kdsp = $value->kodesp;
                $jml_stok = $this->db->query("SELECT COUNT(idstok) AS jml FROM stok_sparepart WHERE kodesp='$kdsp'")->row("jml");
                $barcode = $this->db->query("SELECT DISTINCT qrcode FROM stok_sparepart WHERE kodesp='$kdsp' AND lokasi='$lokasi'");
                if($barcode->num_rows() == 1){
                    $showQR = $barcode->row("qrcode");
                } else {
                    $showQR = "Ada ".$barcode->num_rows()." Kode";
                }
                $counting = $this->db->query("SELECT file_name FROM table_cetak WHERE file_name LIKE '%$kdsp%'")->num_rows();
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$value->kategori_sp."</td>";
                ?>
                <td>
                    <a href="javascript:void(0);" style="text-decoration:none;font-weight:bold;color:blue;" onclick="showToUpdate('<?=$kdsp;?>')"><?=$value->nama_sparepart;?></a>
                </td>
                <?php
                //echo "<td>".$value->nama_sparepart."</td>";
                echo "<td>".number_format($jml_stok)."</td>";
                echo "<td>".$value->satuan_pemakaian."</td>";
                //echo "<td>".$showQR."</td>";
                ?>
                <td>
                    <a href="javascript:void(0);" style="text-decoration:none;font-weight:bold;color:blue;" onclick="showqr('<?=$kdsp;?>')"><?=$showQR;?></a>
                </td>
                <td>
                    <a href="javascript:void(0);" style="text-decoration:none;" class="btn btn-primary" onclick="saveAndPrint('<?=$initial_kode;?>','<?=$kdsp;?>')">
                        Cetak Barcode <?=$counting>0 ? '('.$counting.')':'';?>
                    </a>
                </td>
                <?php
                echo "</tr>";
                $no++;
            }
            foreach ($record2->result() as $key => $value2) {
                $kdsp = $value2->kodesp;
                $jml_stok = $this->db->query("SELECT COUNT(idstok) AS jml FROM stok_sparepart WHERE kodesp='$kdsp'")->row("jml");
                $barcode = $this->db->query("SELECT DISTINCT qrcode FROM stok_sparepart WHERE kodesp='$kdsp' AND lokasi='$lokasi'");
                if($barcode->num_rows() == 1){
                    $showQR = $barcode->row("qrcode");
                } else {
                    $showQR = "";
                }
                $counting = $this->db->query("SELECT file_name FROM table_cetak WHERE file_name LIKE '%$kdsp%'")->num_rows();
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$value2->kategori_sp."</td>";
                ?>
                <td>
                    <a href="javascript:void(0);" style="text-decoration:none;font-weight:bold;color:blue;" onclick="showToUpdate('<?=$kdsp;?>')"><?=$value2->nama_sparepart;?></a>
                </td>
                <?php
                //echo "<td>".$value2->nama_sparepart."</td>";
                echo "<td>".number_format($jml_stok)."</td>";
                echo "<td>".$value2->satuan_pemakaian."</td>";
                //echo "<td>".$showQR."</td>";
                ?>
                <td>
                    <a href="javascript:void(0);" style="text-decoration:none;font-weight:bold;color:blue;" onclick="showqr('<?=$kdsp;?>')"><?=$showQR;?></a>
                </td>
                <td>
                </td>
                <?php
                echo "</tr>";
                $no++;
            }
            
        }
    } //end

    function showDetilPenarikan(){
        $id = $this->input->get('id', TRUE);
        $akses = $this->session->userdata('akses');
        $yg_login = $this->session->userdata('username');
        $cek = $this->data_model->get_byid('riwayat_tarik', ['id_rwtyk'=>$id]);
        if($cek->num_rows() == 1){
            $id_tarik       = $cek->row("id_rwtyk");
            $id_detilpem    = $cek->row("id_detilpem");
            $dt1            = $this->data_model->get_byid('detil_pembelian',['id_detilpem'=>$id_detilpem])->row_array();
            $item           = strtoupper($dt1['nama_sparepart']);
            $cdbl           = $dt1['kode_beli'];
            $qty            = $dt1['qty'];
            $satuan         = $dt1['satuan'];
            $harga_qty      = $dt1['harga_qty'];
            $total_harga    = $dt1['total_harga'];
            $lokasi         = $dt1['lokasi'];
            $untuk_divisi   = $dt1['untuk_divisi'];
            $pembelian      = $this->data_model->get_byid('pembelian',['kode_beli'=>$cdbl])->row_array();
            ?>
            <div style="width:100%;background:#ccc;display:flex;flex-direction:column;gap:5px;padding:15px;border-radius:4px;margin-bottom:15px;">
                <table>
                    <tr>
                        <td style="font-size:20px;" colspan="2">Data Pembelian</td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Nama Item</td>
                        <td><strong><?=$item;?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Jumlah Pembelian</td>
                        <td><strong><?=$qty;?></strong> <?=$satuan;?></td>
                    </tr>
                    <?php if($akses=="admin"){?>
                    <tr>
                        <td style="width:200px;">Harga per Satuan</td>
                        <td>Rp. <strong><?=number_format($harga_qty);?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Harga Total</td>
                        <td>Rp. <strong><?=number_format($total_harga);?></strong></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td style="width:200px;">Lokasi sekarang</td>
                        <td><strong><?=$lokasi;?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Divisi</td>
                        <td><strong><?=$untuk_divisi;?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Tanggal Datang</td>
                        <td><strong><?=date('d M Y', strtotime($pembelian['tgl_datang']));?></strong></td>
                    </tr>
                    <?php if($akses=="admin"){?>
                    <tr>
                        <td style="width:200px;">Tanggal Nota</td>
                        <td><strong><?=date('d M Y', strtotime($pembelian['tgl_nota']));?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Nomor Nota</td>
                        <td><strong><?=$pembelian['no_nota_sj'];?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Supplier</td>
                        <td><strong><?=strtoupper($pembelian['supp']);?></strong></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2" style="font-size:13px;text-align:right;">
                            Diinput oleh : <strong><?=ucfirst($pembelian['yginput']);?></strong> pada tanggal <strong><?=date('d M Y', strtotime($pembelian['tgl_input']));?></strong> jam <strong><?=date('H:i', strtotime($pembelian['tgl_input']));?></strong>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="width:100%;background:#ccc;display:flex;flex-direction:column;gap:5px;padding:15px;border-radius:4px;margin-bottom:15px;">
                <table>
                    <tr>
                        <td style="font-size:20px;" colspan="2">Data Penarikan Ke Gudang <?=$cek->row("tujuan");?></td>
                    </tr>
                    <?php
                    $kodesp = $cek->row("kodesp");
                    $sp = $this->data_model->get_byid('table_sparepart',['kodesp'=>$kodesp])->row_array();
                    $yg_narik = $cek->row("yg_narik");
                    ?>
                    <tr>
                        <td style="width:200px;">Tanggal Tarik</td>
                        <td><strong><?=date('d M Y', strtotime($cek->row("tanggal_tarik")));?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Kategori</td>
                        <td><strong><?=$sp['kategori_sp'];?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Nama Item</td>
                        <td><strong><?=$sp['nama_sparepart'];?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Jumlah Tarik</td>
                        <td><strong><?=$cek->row("satuan_pcs");?></strong> <?=$sp['satuan_pemakaian'];?></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Penempatan</td>
                        <td><strong><?=$cek->row("penempatan");?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">QR Code</td>
                        <td><strong><?=$cek->row("kode_qr");?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:13px;text-align:right;">
                            Ditarik oleh : <strong><?=$yg_narik;?></strong> pada tanggal <strong><?=date('d M Y', strtotime($cek->row("tanggal_input")));?></strong> jam <strong><?=date('H:i', strtotime($cek->row("tanggal_input")));?></strong>. <a href="javascript:void(0);" onclick="hapusProsesTarik('<?=$yg_narik;?>','<?=$id_tarik;?>')" style="text-decoration:none;color:red;">Hapus / Batal Tarik</a>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tableRetur"></div>
            <div style="width:100%;background:#ccc;display:flex;flex-direction:column;gap:5px;padding:15px;border-radius:4px;margin-bottom:15px;">
                <input type="hidden" name="idrwytk" id="idrwytkid" value="<?=$id_tarik;?>">
                <input type="hidden" name="iddetilpem" id="iddetilpemid" value="<?=$id_detilpem;?>">
                <table>
                    <tr>
                        <td style="font-size:20px;" colspan="2">Input Retur</td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Jumlah Retur</td>
                        <td><input type="number" style="width:300px;padding:10px;outline:none;border:1px solid #ccc;border-radius:4px;" placeholder="Masukan jumlah retur" id="jmlReturId"></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Alasan Retur</td>
                        <td><textarea style="width:100%;padding:10px;outline:none;border:1px solid #ccc;border-radius:4px;" placeholder="Masukan keterangan atau alasan retur item" id="textReturId"></textarea></td>
                    </tr>
                </table>
            </div>
            <?php
        } else {
            echo "Token Error..!";
        }
    }
    function hapsPenarikan(){
        $id             = $this->input->get('id', TRUE);
        $inputanDari    = strtolower($this->input->get('inputanDari', TRUE));
        $thislogin      = strtolower($this->session->userdata('nama'));
        $akses          = strtolower($this->session->userdata('akses'));
        if($thislogin == $inputanDari || $akses=="admin"){
            $dt = $this->data_model->get_byid('riwayat_tarik', ['id_rwtyk'=>$id]);
            if($dt->num_rows() == 1){
                $codeinput = $dt->row("codeinput");
                $id_detilpem = $dt->row("id_detilpem");
                $cek = $this->data_model->get_byid("stok_sparepart_pakai",['codeinput'=>$codeinput])->num_rows();
                if($cek == 0){
                    $this->data_model->delete('stok_sparepart','codeinput', $codeinput);
                    $this->data_model->delete('riwayat_tarik','id_rwtyk', $id);
                    $this->data_model->updatedata('id_detilpem',$id_detilpem,'detil_pembelian',['lokasi'=>'Kantor']);
                    $response = [
                        'status' => 200,
                        'message' => 'Stok yang ditarik di kembalikan ke kantor.'
                    ];
                } else {
                    $response = [
                        'status' => 500,
                        'message' => 'Anda tidak bisa menghapus stok penarikan yang sudah terpakai.!'
                    ];
                }
            } else {
                $response = [
                    'status' => 500,
                    'message' => 'Generate token gagal.!'
                ];
            }
        } else {
            $response = [
                'status' => 500,
                'message' => 'Anda tidak bisa menghapus inputan dari '.ucfirst($inputanDari).''
            ];
        }
        echo json_encode($response); 
    } //end of function
    function returPenarikan(){
        $id1            = $this->input->get('id1', TRUE);
        $id2            = $this->input->get('id2', TRUE);
        $jml            = $this->input->get('jml', TRUE);
        $txt            = $this->input->get('txt', TRUE);
        $thislogin      = strtolower($this->session->userdata('nama'));
        $cek = $this->data_model->get_byid('riwayat_tarik', ['id_rwtyk'=>$id1]);
        if($cek->num_rows() == 1){
            $codeinput = $cek->row("codeinput");
            $cekReady  = $this->data_model->get_byid('stok_sparepart', ['codeinput'=>$codeinput])->num_rows();
            if($jml<=$cekReady){
                $stok_sp = $this->db->query("SELECT * FROM stok_sparepart WHERE codeinput='$codeinput' LIMIT $jml");
                $allar = array();
                foreach($stok_sp->result() as $val){
                    $indata = "".$val->idstok."-".$val->kodesp."-".$val->qrcode."-".$val->codeinput."-".$val->lokasi."-".$val->penempatan."-".$val->harga_satuan."";
                    $allar[] = $indata;
                    $this->data_model->delete('stok_sparepart','idstok',$val->idstok);
                }
                $data_retur = implode(',', $allar);
                $this->data_model->saved('riwayat_tarik_retur',[
                    'id_rwtyk' => $id1,
                    'tgl_input' => date('Y-m-d H:i:s'),
                    'yg_input' => $thislogin,
                    'jmlretur' => $jml,
                    'keterangan' => $txt,
                    'data_retur' => $data_retur
                ]);
                $response = [
                    'status' => 200,
                    'message' => 'Meretur '.$jml.' item'
                ];
            } else {
                $response = [
                    'status' => 500,
                    'message' => 'Anda tidak bisa meretur sebanyak '.$jml.''
                ];
            }
        } else {
            $response = [
                'status' => 500,
                'message' => 'Anda tidak bisa menghapus inputan dari '.ucfirst($inputanDari).''
            ];
        }
        echo json_encode($response);
    } //end of function
    function returPenarikandata(){
        $id = $this->input->get('id', TRUE);
        $cek = $this->data_model->get_byid('riwayat_tarik_retur',['id_rwtyk'=>$id]);
        if($cek->num_rows() > 0){
            ?>
            <div style="width:100%;background:#ccc;display:flex;flex-direction:column;gap:5px;padding:15px;border-radius:4px;margin-bottom:15px;">
                <table>
                    <tr>
                        <td style="font-size:20px;" colspan="6">Data Retur</td>
                    </tr>
                    <tr>
                        <td>No</td>
                        <td>Tanggal</td>
                        <td>Retur</td>
                        <td>Keterangan</td>
                        <td>Yang Retur</td>
                        <td></td>
                    </tr>
                    <?php
                    $no=1;
                    foreach($cek->result() as $t){
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".date('d M Y', strtotime($t->tgl_input))."</td>";
                        echo "<td>".$t->jmlretur."</td>";
                        echo "<td>".$t->keterangan."</td>";
                        echo "<td>".$t->yg_input."</td>";
                        ?>
                        <td><a href="javascript:void(0);" onclick="hpsReturan('<?=$t->id_rtr;?>','<?=$t->id_rwtyk;?>')" style="text-decoration:none;color:red;">Hapus</a></td>
                        <?php
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </table>
            </div>
            <?php
        } else {
            echo "";
        }
    }
    function btlRetur(){
        $id = $this->input->get('id', TRUE);
        $cek = $this->data_model->get_byid('riwayat_tarik_retur',['id_rtr'=>$id])->row_array();
        $list = $cek['data_retur'];
        $x = explode(',', $list);
        for ($i=0; $i <count($x) ; $i++) { 
            $xx = explode('-', $x[$i]);
            $this->data_model->saved('stok_sparepart',[
                'idstok' => $xx[0],
                'kodesp' => $xx[1],
                'qrcode' => $xx[2],
                'codeinput' => $xx[3],
                'lokasi' => $xx[4],
                'penempatan' => $xx[5],
                'harga_satuan' => $xx[6]
            ]);
        }
        $this->data_model->delete('riwayat_tarik_retur','id_rtr',$id);
        $response = [
                'status' => 200,
                'message' => 'Mengembalikan barang ke stok sparepart'
        ];
        
        echo json_encode($response);
    }
}
?>
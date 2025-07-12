<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller
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

  function inputStok(){
        $tujuan  = $this->input->post('tujuanGudang', TRUE);
        $kat     = strtoupper($this->input->post('kat', TRUE));
        $nmsp    = strtoupper($this->input->post('nmsp', TRUE));
        $hrg_input = $this->input->post('hrg', TRUE);
        $hrg_clean = preg_replace('/[^0-9,]/', '', $hrg_input);
        $hrg_final = str_replace(',', '.', $hrg_clean);
        $pcs     = $this->input->post('pcs', TRUE);
        $loc     = $this->input->post('loc', TRUE);
        $qrcode2 = $this->input->post('qrcode2', TRUE);
        $qrcode = $this->input->post('qrcode', TRUE);
        $codeinput  = $this->data_model->acakKode(13);
        $x = explode('-', $pcs);
        if(count($x) == 2){
            $_jml = floatval($x[0]);
            $_sat = $x[1];
        } else {
            $_jml = floatval($pcs);
            $_sat = "Pcs";
        }
        if($_jml > 0){
            $cekSP = $this->data_model->get_byid('table_sparepart',['kategori_sp'=>$kat, 'nama_sparepart'=>$nmsp]);
            if($cekSP->num_rows() == 1){
                $kode_SP  = $cekSP->row("kodesp");
            } else {
                $kode_SP  = $this->data_model->acakKode(11);
                $this->data_model->saved('table_sparepart',[
                    'kategori_sp'      => $kat,
                    'nama_sparepart'   => $nmsp,
                    'kodesp'           => $kode_SP,
                    'satuan_pemakaian' => $_sat
                ]);
            }
            for ($i=0; $i < intval($_jml) ; $i++) { 
                $this->data_model->saved('stok_sparepart',[
                    'kodesp'      => $kode_SP,
                    'qrcode'      => $qrcode,
                    'codeinput'   => $codeinput,
                    'lokasi'      => $tujuan,
                    'penempatan'  => $loc,
                    'harga_satuan'=> $hrg_final
                ]);
            }
            $this->data_model->saved('riwayat_nambah_stok',[
                'username'      => $this->session->userdata('username'),
                'tanggal_input' => date('Y-m-d H:i:s'),
                'kodesp'        => $kode_SP,
                'jumlah'        => intval($_jml),
                'qrcode'        => $qrcode,
                'codeinput'     => $codeinput,
                'lokasi'        => $tujuan,
                'penempatan'    => $loc,
                'harga_satuan'  => $hrg_final
            ]);
            $msg = "Tambah Stok ".$_jml." ".$_sat." ".$nmsp." ";
            $response = [
                'statusCode' => 200,
                'msg' => $msg,
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        } else {
            $response = [
                'statusCode' => 501,
                'msg' => 'Jumlah input minimal adalah 1',
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response);
  }
  
  function use_sparepart(){
        $dep          = $this->input->get('dep', TRUE);
        $decodedText = trim($this->input->get('decodedText', TRUE));
        if($dep == "Spinning"){
            $qry = "SELECT kodesp,qrcode,lokasi,harga_satuan FROM stok_sparepart WHERE qrcode='$decodedText' AND lokasi='Spinning'";
            $qry2 = "SELECT kodesp,qrcode,lokasi,harga_satuan FROM stok_sparepart WHERE qrcode='$decodedText' AND lokasi='Spinning' LIMIT 1";
        } else {
            if($dep == "Weaving"){
                $qry = "SELECT kodesp,qrcode,lokasi,harga_satuan FROM stok_sparepart WHERE qrcode='$decodedText' AND lokasi='Weaving'";
                $qry2 = "SELECT kodesp,qrcode,lokasi,harga_satuan FROM stok_sparepart WHERE qrcode='$decodedText' AND lokasi='Weaving' LIMIT 1";
            } else {
                $qry = "notfound";
                $qry2 = "notfound";
            }
        }
        if($qry == "notfound"){
            echo 'Error.! Departement Not Found';  
        } else {
            $dt       = $this->db->query($qry2)->row_array();
            $jml_stok = $this->db->query($qry)->num_rows();
            if($jml_stok > 0){
                $kode_SP = $dt['kodesp'];
                $lokasi  = $dt['lokasi'];
                $sparepart = $this->data_model->get_byid('table_sparepart',['kodesp'=>$kode_SP])->row_array();
                $nmsp = $sparepart['nama_sparepart'];
                $kat = $sparepart['kategori_sp'];
                $pcs = $sparepart['satuan_pemakaian'];
                ?>
                <input type="hidden" id="qrCodeScan" value="<?=$decodedText;?>">
                <input type="hidden" id="stokAsli" value="<?=$jml_stok;?>">
                <div style="width:100%;display:flex;flex-direction:column;gap:5px;margin-top:30px;align-items:flex-start;justify-content:flex-start;text-align:left;">
                    <span>Nama Sparepart : <strong><?=$nmsp;?></strong></span>
                    <span>Kategori : <strong><?=$kat;?></strong></span>
                    <?php if($jml_stok>0){?>
                    <span>Sisa Stok : <strong><?=$jml_stok;?></strong> <?=$pcs;?></span>
                    <?php } else { ?>
                    <span style="color:red;">Sisa Stok : <strong><?=$jml_stok;?></strong> <?=$pcs;?></span>
                    <?php } ?>
                    <label for="tglPakai" style="margin-top:15px;">Tanggal Pemakaian</label>
                    <input type="date" class="iptform" placeholder="Masukan Tanggal Pemakaian" id="tglPakai" value="<?=date('Y-m-d');?>">
                    <label for="jmlPakai" style="margin-top:15px;">Jumlah Pengambilan</label>
                    <input type="number" class="iptform" placeholder="Masukan jumlah yang di ambil" id="jmlPakai">
                    <label for="nmOpt">Nama Operator</label>
                    <input type="text" class="iptform" placeholder="Masukan operator yang ambil" id="nmOpt">
                    <label for="nomc">Nomor Mesin</label>
                    <input type="text" class="iptform" placeholder="Masukan nomor mesin" id="nomc">
                    <label for="bekas">Item Bekas</label>
                    <select name="bekas" id="bekas" class="iptform">
                        <option value="null">Tidak ada</option>
                        <option value="rusak">Ada - Rusak</option>
                        <option value="reuseable">Ada - Bisa Digunakan Lagi</option>
                    </select>
                    <label for="jmlitembekas">Jumlah Item Bekas</label>
                    <input type="number" class="iptform" value="0" id="jmlitembekas">
                    <label for="ket">Keterangan (opsional)</label>
                    <textarea name="ket" id="ket" placeholder="Masukan keterangan / catatan khusus" class="iptform"></textarea>
                    <span style="font-size:13px;">Anda login sebagai : <strong><?=ucfirst($this->session->userdata('username'));?></strong></span>
                    <?php if($jml_stok>0){?>
                    <button style="width:100%;margin-top:15px;" onclick="simpanPemakaian()">Simpan</button>
                    <?php } ?>
                    
                </div>
                <?php
            } else {
                echo "Kode tidak ditemukan. Atau stok dengan kode tersebut telah habis. ".$decodedText;
            }
        }
       
  }
  function save_pemakaian(){
        $qrcode     = trim($this->input->get('qrcode', TRUE));
        $stokAsli   = trim($this->input->get('stokAsli', TRUE));
        $jmlPakai   = trim($this->input->get('jmlPakai', TRUE));
        $tglPakai   = trim($this->input->get('tglPakai', TRUE));
        if($tglPakai == "null"){
            $newTgl = date('Y-m-d H:i:s');
        } else {
            $newTgl = $tglPakai." ".date('H:i:s')."";
        }
        $nmOpt      = trim($this->input->get('nmOpt', TRUE));
        $nomc       = trim($this->input->get('nomc', TRUE));
        $dep        = trim($this->input->get('dep', TRUE));
        $jmlitembekas= trim($this->input->get('jmlitembekas', TRUE));
        $nomc       = strtoupper($nomc);
        $nomc       = str_replace(' ', '', $nomc);
        if (preg_match('/^([A-Z])(\d{1,2})$/', $nomc, $matches)) {
            $huruf = $matches[1];
            $angka = str_pad($matches[2], 2, '0', STR_PAD_LEFT);
            $nomc  = $huruf . $angka;
        }
        $bekas      = trim($this->input->get('bekas', TRUE));
        $ket        = $this->input->get('ket', TRUE);
        $username   = $this->session->userdata('username');
        $codePakai  = $this->data_model->acakKode(13);
        $jmlOnStok  = $this->db->query("SELECT COUNT(qrcode) AS jml FROM stok_sparepart WHERE qrcode='$qrcode'")->row("jml");
        if($qrcode!="" && $stokAsli!="" && $jmlPakai!="" && $nmOpt!="" && $nomc!="" && $bekas!="" && $username!=""){
            if($jmlPakai>0 && $jmlPakai <= $stokAsli && $jmlPakai <= $jmlOnStok){
                $kode_SP = $this->db->query("SELECT kodesp,qrcode FROM stok_sparepart WHERE qrcode='$qrcode' LIMIT 1")->row("kodesp");
                $this->data_model->saved('riwayat_pemakaian',[
                    'tanggal_pakai' => $newTgl,
                    'tanggal_input' => date('Y-m-d H:i:s'),
                    'user_login'    => $username,
                    'departement'   => $dep,
                    'kodesp'        => $kode_SP,
                    'qrcode'        => $qrcode,
                    'no_mc'         => $nomc,
                    'jumlah_sp'     => $jmlPakai,
                    'codepakai'     => $codePakai,
                    'operator'      => $nmOpt,
                    'keterangan'    => $ket,
                    'balik_sp'      => $bekas,
                    'jml_balik_sp'  => $bekas=='null' ? '0':$jmlitembekas
                ]);
                $all_pakai = $this->db->query("SELECT * FROM stok_sparepart WHERE qrcode='$qrcode' ORDER BY idstok LIMIT $jmlPakai");
                foreach($all_pakai->result() as $val){
                    $idstok         = $val->idstok;
                    $kodesp         = $val->kodesp;
                    $qrcode         = $val->qrcode;
                    $codeinput      = $val->codeinput;
                    $lokasi         = $val->lokasi;
                    $penempatan     = $val->penempatan;
                    $harga_satuan   = $val->harga_satuan;
                    $this->data_model->saved('stok_sparepart_pakai',[
                        'idstok'        => $idstok,
                        'kodesp'        => $kodesp,
                        'qrcode'        => $qrcode,
                        'codeinput'     => $codeinput,
                        'lokasi'        => $lokasi,
                        'penempatan'    => $penempatan,
                        'harga_satuan'  => $harga_satuan,
                        'codepakai'     => $codePakai
                    ]);
                    $this->db->query("DELETE FROM stok_sparepart WHERE idstok='$idstok'");
                    if($bekas == "reuseable"){
                        $this->data_model->saved('stok_sparepart_bekas',[
                            'kodesp'        => $kodesp,
                            'qrcode'        => $qrcode,
                            'codeinput'     => $codePakai,
                            'lokasi'        => $dep,
                            'penempatan'    => $dep,
                            'harga_satuan'  => 0,
                            'codepakai'     => $codePakai
                        ]);
                    } else {
                        if($bekas == "rusak"){
                            $this->data_model->saved('stok_sparepart_rusak',[
                                'kodesp'        => $kodesp,
                                'qrcode'        => $qrcode,
                                'codeinput'     => $codePakai,
                                'lokasi'        => $dep,
                                'penempatan'    => $dep,
                                'harga_satuan'  => 0,
                                'codepakai'     => $codePakai
                            ]);
                        }
                    }
                }
                
                $response = [
                    'statusCode' => 200,
                    'msg' => 'success'
                ];
            } else {
                $response = [
                    'statusCode' => 501,
                    'msg' => 'Minimal pemakaian adalah 1, maksimal '.$stokAsli.''
                ];
            }
        } else {
            $response = [
                'statusCode' => 501,
                'msg' => 'Anda tidak mengisi data dengan benar'
            ];
        }
        echo json_encode($response);
  }
  function deluserbaru(){
        $id      = $this->input->post('idusers', TRUE);
        $cekusername = $this->data_model->get_byid('akses_user',['sha1(iduser)'=>$id]);
        if($cekusername->num_rows() == 1){
            $iduser = $cekusername->row("iduser");
            $this->db->query("DELETE FROM akses_user WHERE iduser='$iduser'");
            $response = [
                'status' => 'success',
                'msg' => 'User dihapus dari akses login',
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        } else {
            $response = [
                'status' => 'error',
                'msg' => 'Token Error',
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response);
  }

  function inputuserbaru(){
        $nama      = trim($this->input->post('namauser', TRUE));
        $username  = trim($this->input->post('usernameid', TRUE));
        $hakakses  = trim($this->input->post('hakakses', TRUE));
        $pass      = trim($this->input->post('passwordid', TRUE));
        if($nama!="" && $username!="" && $hakakses!="" && $pass!=""){
            $cekusername = $this->data_model->get_byid('akses_user',['username'=>$username]);
            if($cekusername->num_rows() == 0){
                $this->data_model->saved('akses_user',[
                    'username'  => strtolower($username),
                    'password'  => sha1($pass),
                    'nama_user' => strtoupper($nama),
                    'akses'     => $hakakses,
                ]);
                $response = [
                    'status' => 'success',
                    'msg' => 'Username dan password bisa digunakan untuk login',
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'msg' => 'Username sudah digunakan.!',
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'msg' => 'Anda harus mengisi semua data dengan benar.!',
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response);
  } //end

}
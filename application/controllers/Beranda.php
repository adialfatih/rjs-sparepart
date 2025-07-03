<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
      $this->load->model('data_model');
      if($this->session->userdata('login_form') != "spare-as1563sd1123sfasda2389asff53afhafaf670fa"){
        redirect(base_url('login'));
      }
  }
   
  function index2(){ 
        $this->load->view('main_dashboard', $data);
  } //end
  function index(){ 
        $akses = $this->session->userdata('akses');
        $data = array(
            'title'         => 'Welcome To Dashboard',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'navigasi'      => 'dashboard',
            'navigasi2'      => ''
        );
        if($akses == "satpam"){ $this->load->view('pages/pemakaian_awal'); } else {
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('beranda_view', $data); 
        $this->load->view('part/main_js', $data);}
  } //end
  function kesp(){ 
        $akses = $this->session->userdata('akses');
        //$qr = $this->data_model->get_byid('v_onkantor', ['untuk'=>'Gudang Spinning']);
        $data = array(
            'title'         => 'Tarik Item Ke Spinning',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'navigasi'      => 'sparepart',
            'navigasi2'     => 'tariksp'
            //'qrdata'        => $qr
        );
        if($akses == "satpam"){ $this->load->view('pages/pemakaian_awal'); } else {
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('pages/tarik_sparepart', $data); 
        $this->load->view('part/main_js2', $data); }
  } //end
  function kewv(){ 
        $akses = $this->session->userdata('akses');
        //$qr = $this->data_model->get_byid('v_onkantor', ['untuk'=>'Gudang Weaving']);
        $data = array(
            'title'         => 'Tarik Item Ke Weaving',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'navigasi'      => 'sparepart',
            'navigasi2'     => 'tarikwv'
           //'qrdata'        => $qr
        );
        if($akses == "satpam"){ $this->load->view('pages/pemakaian_awal'); } else {
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('pages/tarik_sparepart', $data); 
        $this->load->view('part/main_js2', $data); }
  } //end
  function stokwv(){ 
        $akses = $this->session->userdata('akses');
        //$qr = $this->data_model->get_byid('v_onkantor', ['untuk'=>'Gudang Weaving']);
        $data = array(
            'title'         => 'Stok Sparepart Weaving',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'navigasi'      => 'gudang',
            'navigasi2'     => 'stokwv'
           //'qrdata'        => $qr
        );
        if($akses == "satpam"){ $this->load->view('pages/pemakaian_awal'); } else {
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('pages/stok_sparepart', $data); 
        $this->load->view('part/main_js3', $data); }
  } //end
  function stoksp(){ 
        $akses = $this->session->userdata('akses');
        //$qr = $this->data_model->get_byid('v_onkantor', ['untuk'=>'Gudang Weaving']);
        $data = array(
            'title'         => 'Stok Sparepart Weaving',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'navigasi'      => 'gudang',
            'navigasi2'     => 'stoksp'
           //'qrdata'        => $qr
        );
        if($akses == "satpam"){ $this->load->view('pages/pemakaian_awal'); } else {
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('pages/stok_sparepart', $data); 
        $this->load->view('part/main_js3', $data); }
  } //end

  function cobascan(){
      $this->load->view('pages/scan_view', $data);
  }
  function pemakaian(){
      $this->load->view('pages/pemakaian_awal');
  }
  function pemakaian_sp(){
      $this->load->view('pages/pemakaian_sp');
  }
  function pemakaian_wv(){
      $this->load->view('pages/pemakaian_wv');
  }

  
    
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Showpage extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
      $this->load->model('data_model');
      if($this->session->userdata('login_form') != "spare-as1563sd1123sfasda2389asff53afhafaf670fa"){
        redirect(base_url('login'));
      }
  }
  
  function index(){ 
        
  } //end
  function rwyt_kesp(){ 
        $akses = $this->session->userdata('akses');
        //$qr = $this->data_model->get_byid('v_onkantor', ['untuk'=>'Gudang Spinning']);
        $data = array(
            'title'         => 'Riwayat Tarik Ke Spinning',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'navigasi'      => 'sparepart',
            'navigasi2'     => 'rtariksp',
            'navigasi3'     => 'rtariksp'
        );
        if($akses == "satpam"){ $this->load->view('pages/pemakaian_awal'); } else {
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('pages/rwyttarik_sparepart', $data); 
        $this->load->view('part/main_js2', $data); }
  } //end
  function rwyt_kewv(){ 
        $akses = $this->session->userdata('akses');
        //$qr = $this->data_model->get_byid('v_onkantor', ['untuk'=>'Gudang Weaving']);
        $data = array(
            'title'         => 'Riwayat Tarik Ke Weaving',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'navigasi'      => 'sparepart',
            'navigasi2'     => 'rtarikwv',
            'navigasi3'     => 'rtarikwv'
        );
        if($akses == "satpam"){ $this->load->view('pages/pemakaian_awal'); } else {
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('pages/rwyttarik_sparepart', $data); 
        $this->load->view('part/main_js2', $data); }
  } //end
  function loginuser(){
        $akses = $this->session->userdata('akses');
        //$qr = $this->data_model->get_byid('v_onkantor', ['untuk'=>'Gudang Weaving']);
        $data = array(
            'title'         => 'Data User Akses',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'navigasi'      => 'user-login',
            'records'       => $this->data_model->get_record('akses_user')
        );
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('pages/user_view', $data); 
        $this->load->view('part/main_js4', $data);
  }
  function pemakaian(){ 
        $akses = $this->session->userdata('akses');
        $uri = $this->uri->segment(2);
        $data = array(
            'title'         => 'Pemakaian Sparepart',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'navigasi'      => 'pemakaian',
            'navigasi2'     => $uri
        );
        if($akses == "satpam"){ $this->load->view('pages/pemakaian_awal'); } else {
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('pages/pemakaian_view', $data); 
        $this->load->view('part/main_js5', $data); }
  } //end
  
    
}
?>
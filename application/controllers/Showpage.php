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
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('pages/rwyttarik_sparepart', $data); 
        $this->load->view('part/main_js2', $data);
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
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        $this->load->view('pages/rwyttarik_sparepart', $data); 
        $this->load->view('part/main_js2', $data);
  } //end
  
    
}
?>
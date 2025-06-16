<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sparepart extends CI_Controller
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
        //$this->load->view('main_dashboard', $data);
        echo "Token Error. (43)";
  } //end
  function pembelian(){ 
        $akses = $this->session->userdata('akses');
        $nmsp  = array();
        $dts   = $this->db->query("SELECT DISTINCT nama_sparepart FROM `detil_pembelian`");
        if($dts->num_rows() > 0){
          foreach($dts->result() as $vl){
              $nmsp[] = '"'.strtoupper($vl->nama_sparepart).'"';
          }
          $im_sp = implode(',',$nmsp);
        } else {
          $im_sp = '"Belum ada data"';
        }
        $data  = array(
            'title'         => 'Pembelian Sparepart',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'navigasi'      => 'sparepart',
            'navigasi2'     => 'pembelian',
            'im_data'       => $im_sp,
            'supplier'      => $this->db->query("SELECT DISTINCT supp FROM `pembelian`")
        );
        $this->load->view('part/main_header', $data);
        $this->load->view('part/left_nav', $data);
        if($akses == "admin"){
            $this->load->view('pages/pembelian', $data); 
        } else {
            $this->load->view('pages/blocked', $data); 
        }
        $this->load->view('part/main_js', $data);
  } //end

  
    
}
?>
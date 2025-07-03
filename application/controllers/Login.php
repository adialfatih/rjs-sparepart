<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
      $this->load->model('data_model');
      date_default_timezone_set("Asia/Jakarta");
  }
   
  function index(){ 
        $this->session->sess_destroy();
        $this->load->view('login_form2');
  } //end

  function actlogin(){
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $password2 = sha1($password);
        if($username!="" && $password!=""){
            $cek_login = $this->data_model->get_byid('akses_user',['username'=>$username,'password'=>$password2]);
            if($cek_login->num_rows() == 1){
                $dt = $cek_login->row_array();
                $data_session = array(
                    'id'        => $dt['iduser'],
                    'nama'      => $dt['nama_user'],
                    'username'  => $dt['username'],
                    'password'  => $dt['password'],
                    'akses'     => $dt['akses'],
                    'login_form'=> 'spare-as1563sd1123sfasda2389asff53afhafaf670fa'
                );
                $this->session->set_userdata($data_session);
                $response = [
                    'status' => 'success',
                    'tipeLogin' => $dt['akses'],
                    'message' => 'Login berhasil.',
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'username' => $username,
                    'password' => $password2,
                    'message' => 'Username password tidak cocok!',
                    'newCsrfHash' => $this->security->get_csrf_hash()
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Login gagal!',
                'username' => $username,
                'password' => $password2,
                'newCsrfHash' => $this->security->get_csrf_hash()
            ];
        }
        echo json_encode($response);
  } //emd
}
?>
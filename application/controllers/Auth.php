<?php

class Auth extends CI_Controller{

    function __construct(){
        parent::__construct();

        $this->load->model('M_auth');

    }

    function index(){
        $this->load->view('auth/v_auth');
    }

    function auth_process(){
        $username = $this->input->post('username');
        $password = $this->input->post('pass');
        $where = array(
            'aktif'     => 't',
            'username' => $username,
            'pass'      => md5($password),
            );
        $cek = $this->M_auth->cek_auth("tuser",$where)->num_rows();
        if($cek > 0){
            $this->db->trans_start();
            $session_kode = array(
                'lastin'        => 'now()' 
            );
            $wheresession = array(
                'username' => $username,
            );
            $this->M_auth->sessionkodeup($wheresession, $session_kode);
            $result = $this->M_auth->datauser($username);
            $data_session = array(
                'username'  => $username,
                'status'    => "online",
                'in'        => TRUE,
                'id'        => $result->id,
                'namafull'  => $result->namafull,
                'alamat'    => $result->nik,
                'phone'     => $result->class,
            );

            $this->session->set_userdata($data_session);
            $this->db->trans_complete();
            redirect('landingpage');

        }else{
            $this->session->set_flashdata('messagelogin', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
                Username dan Password tidak ditemukan.
              </div>');
            redirect('auth');
        }
    }
    
    function logout(){
         $username = $this->session->userdata('username');
         $session_kode = array(
                'lastout'       => 'now()'
            );
            $wheresession = array(
                'username' => $username,
            );
            $this->M_auth->sessionkodeup($wheresession, $session_kode);
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}

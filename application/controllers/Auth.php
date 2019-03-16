<?php

class Auth extends CI_Controller{

    function __construct(){
        parent::__construct();
        
        $this->load->model('Unimodel');

    }

    function index(){
        $this->load->view('auth/v_auth');
    }

    function auth_process(){
        $username = $this->input->post('username');
        $password = $this->input->post('pass');
        $where = array(
            'aktif'     => '1',
            'username'  => $username,
            'password'  => $password,
            );
        $cek = $this->Unimodel->cek_auth("t_user",$where)->num_rows();
        if($cek > 0){
            $this->db->trans_start();
            $session_kode = array(
                'lastlogin' => 'now()' 
            );
            $wheresession = array(
                'username' => $username,
            );
            $this->Unimodel->sessionkodeup($wheresession, $session_kode);
            $result = $this->Unimodel->datauser($username);
            $data_session = array(
                'username'  => $username,
                'status'    => "online",
                'in'        => TRUE,
                'id'        => $result->id,
                'nama'      => $result->nama,
                'alamat'    => $result->alamat,
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
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}

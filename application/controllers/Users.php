<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public $table       = 'tuser';
    public $judul       = 'Users';
    public $aktifgrup   = 'users';
    public $aktifmenu   = 'users';
    public $foldername  = 'users';
    public $indexpage   = 'users/v_users';

    function __construct() {
        parent::__construct();
        include(APPPATH.'libraries/sessionakses.php');
        $title      = $this->judul;
    }

    public function index(){
        $data['title']      = $this->judul;
        $data['aktifgrup']  = $this->aktifgrup;
        $data['aktifmenu']  = $this->aktifmenu;
        $title      = $this->judul;
        $this->load->view($this->indexpage, $data);  
    }

    public function setView(){
        $result     = $this->Dbhelper->getdata($this->table);
        $list       = array();
        $no         = 1;

        foreach ($result as $r) {

            $row    = array(
                        "no"        => $no,
                        "username"	=> $r->username,
                        "pass"    	=> '***',
                        "namafull"	=> $r->namafull,
                        "alamat"	=> $r->alamat,
                        "phone"		=> $r->phone,
                        "action"    => btnud($r->id)
                        
            );

            $list[] = $row;
            $no++;
        }   
        echo json_encode(array('data' => $list));
    }

    public function tambah()
    {
        $data = array(
                'useri'     => $this->session->userdata('nama_user'),
                'username'  => ien($this->input->post('username')),
                'pass'      => md5($this->input->post('pass')),
                'namafull'  => ien($this->input->post('namafull')),
                'aktif'     => 't',
                'alamat'    => ien($this->input->post('alamat')),
                'phone'     => ien($this->input->post('phone')),
            );
        $insert = $this->Dbhelper->save($this->table,$data);
        echo json_encode(array("sukses" => TRUE));
    }

    public function edit()
    {
        $where = array(
            'id' => $this->input->post('id'),
            );

        $data = $this->Dbhelper->edit($this->table,$where);
        echo json_encode($data);
    }

    public function update()
    {
        $data = array(
                'dateu'     =>'now()',
                'useru'     => $this->session->userdata('nama_user'),
                'username'  => ien($this->input->post('username')),
                'pass'      => md5($this->input->post('passbaru')),
                'namafull'  => ien($this->input->post('namafull')),
                'aktif'     => 't',
                'alamat'    => ien($this->input->post('alamat')),
                'phone'     => ien($this->input->post('phone')),
            );
        $where = array(
            'id' => $this->input->post('id')
            );
        $this->Dbhelper->update($this->table,$data,$where);
        echo json_encode(array("sukses" => TRUE));
    }

    public function hapus()
    {
        $getpath = array(
            'id' => $this->input->post('id'),
            ); 
        $path = '.'.$this->Dbhelper->getdataw($this->table,$getpath)->gambar;
        
        @unlink($path);
        
        $where = array(
            'id' => $this->input->post('id'),
            );

        $this->Dbhelper->delete($this->table,$where);
        echo json_encode(array("sukses" => TRUE));
    }

    

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Elementteks extends CI_Controller {
    
    public $table       = 't_config_text';
    public $judul       = 'Element Teks';
    public $aktifgrup   = 'master';
    public $aktifmenu   = 'elementteks';
    public $foldername  = 'elementteks';
    public $indexpage   = 'elementteks/v_elementteks';
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
        $result     = $this->Unimodel->getdata($this->table);
        $list       = array();
        $no         = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"        => $no,
                        "kode"      => $r->kode,
                        "judul"     => $r->judul,
                        "teks"      => $r->teks,
                        "ket"       => $r->ket,
                        "action"    => btnud($r->id)
                        
            );
            $list[] = $row;
            $no++;
        }   
        echo json_encode(array('data' => $list));
    }

    public function tambah()
    {
        $d['useri']     = $this->session->userdata('nama');
        $d['judul']     = $this->input->post('judul');
        $d['teks']      = $this->input->post('teks');
        $d['ket']       = $this->input->post('ket');
        $d['slug']      = slug($this->input->post('judul'));

        $insert = $this->Unimodel->save($this->table,$d);

        $r['sukses'] = ($insert > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }

    public function edit()
    {
        $w['id'] = $this->input->post('id');
        $data = $this->Unimodel->edit($this->table,$w);
        echo json_encode($data);
    }

    public function update()
    {
        $d['useri']     = $this->session->userdata('username');
        $d['judul']     = $this->input->post('judul');
        $d['teks']      = $this->input->post('teks');
        $d['ket']       = $this->input->post('ket');
        $d['slug']      = slug($this->input->post('judul'));

        $w['id'] = $this->input->post('id');
        $update = $this->Unimodel->update($this->table,$d,$w);
        $r['sukses'] = ($update > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }

    public function hapus()
    {   
        $w['id'] = $this->input->post('id');
        $delete = $this->Unimodel->delete($this->table,$w);
        $r['sukses'] = ($delete > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }
    
}
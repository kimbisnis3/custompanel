<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Artikel extends CI_Controller {
    
    public $table       = 'm_artikel';
    public $judul       = 'Artikel';
    public $aktifgrup   = 'artikel';
    public $aktifmenu   = 'artikel';
    public $foldername  = 'artikel';
    public $indexpage   = 'artikel/v_artikel';
    function __construct() {
        parent::__construct();
        // include(APPPATH.'libraries/sessionakses.php');
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
            if ($r->artikel_image == NULL ){
                $gambar = "(Noimage)";
            } else {
                $gambar = "<img style='max-width : 30px;' src='.".$r->artikel_image."'>";
            }
            $row    = array(
                        "no"                => $no,
                        "artikel_kode"      => $r->artikel_kode,
                        "artikel_judul"     => $r->artikel_judul,
                        "artikel_subjudul"  => $r->artikel_subjudul,
                        "artikel_artikel"   => $r->artikel_artikel,
                        "artikel_image"     => $gambar,
                        "artikel_ket"       => $r->artikel_ket,
                        "action"            => btnud($r->artikel_id)
                        
            );
            $list[] = $row;
            $no++;
        }   
        echo json_encode(array('data' => $list));
    }

    public function tambah()
    {
        $d['artikel_useri']     = $this->session->userdata('nama_user');
        $d['artikel_judul']     = $this->input->post('artikel_judul');
        $d['artikel_artikel']   = $this->input->post('artikel_artikel');
        $d['artikel_ket']       = $this->input->post('artikel_ket');
        $d['artikel_slug']      = slug($this->input->post('artikel_judul'));

        $insert = $this->Unimodel->save($this->table,$d);

        $r['sukses'] = ($insert > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }

    public function tambahfile()
    {   
        $config['upload_path'] = './uploads/'.$this->foldername;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = '*';
        $config['file_name'] = slug($this->input->post('artikel_judul'));
        $path = substr($config['upload_path'],1);
        $this->upload->initialize($config);
        
        if ( ! $this->upload->do_upload('artikel_image')){
            $d['artikel_useri']     = $this->session->userdata('nama_user');
            $d['artikel_judul']     = $this->input->post('artikel_judul');
            $d['artikel_artikel']   = $this->input->post('artikel_artikel');
            $d['artikel_ket']       = $this->input->post('artikel_ket');
            $d['artikel_slug']      = slug($this->input->post('artikel_judul'));
            $insert = $this->Unimodel->save($this->table,$d);
        }else{
            $d['artikel_useri']     = $this->session->userdata('nama_user');
            $d['artikel_judul']     = $this->input->post('artikel_judul');
            $d['artikel_artikel']   = $this->input->post('artikel_artikel');
            $d['artikel_ket']       = $this->input->post('artikel_ket');
            $d['artikel_slug']      = slug($this->input->post('artikel_judul'));
            $d['artikel_image']    = $path.'/'.$this->upload->data('file_name');
           
            $insert = $this->Unimodel->save($this->table,$d);
        }
        $r['sukses'] = ($insert > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }
    public function edit()
    {
        $w['artikel_id'] = $this->input->post('id');
        $data = $this->Unimodel->edit($this->table,$w);
        echo json_encode($data);
    }
    public function update()
    {
        $d['artikel_useri']     = $this->session->userdata('nama_user');
        $d['artikel_dateu']     = 'now()';
        $d['artikel_judul']     = $this->input->post('artikel_judul');
        $d['artikel_artikel']   = $this->input->post('artikel_artikel');
        $d['artikel_ket']       = $this->input->post('artikel_ket');
        $d['artikel_slug']      = slug($this->input->post('artikel_judul'));

        $w['artikel_id'] = $this->input->post('artikel_id');
        $update = $this->Unimodel->update($this->table,$d,$w);
        $r['sukses'] = ($update > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }
    function updatefile(){
        $config['upload_path'] = './uploads/'.$this->foldername;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = '*';
        $config['file_name'] = slug($this->input->post('artikel_judul'));
        $path =  substr($config['upload_path'],1);
        $this->upload->initialize($config);
        $pathfile   = $this->input->post('path');
        $ext        = substr($pathfile, -3);
        if ( ! $this->upload->do_upload('artikel_image')){
        
                @rename("$pathfile",'.'.$path.'/'.$this->upload->data('file_name').'.'.$ext);
                
                $d['artikel_useru']     = $this->session->userdata('nama_user');
                $d['artikel_dateu']     = 'now()';
                $d['artikel_judul']     = $this->input->post('artikel_judul');
                $d['artikel_artikel']   = $this->input->post('artikel_artikel');
                $d['artikel_ket']       = $this->input->post('artikel_ket');
                $d['artikel_slug']      = slug($this->input->post('artikel_judul'));
                $d['artikel_image']     = $path.'/'.$this->upload->data('file_name').'.'.$ext ;

                $w['artikel_id'] = $this->input->post('artikel_id');
                $update = $this->Unimodel->update($this->table,$d,$w);
        }else{
                @unlink("$pathfile");
                $d['artikel_useru']     = $this->session->userdata('nama_user');
                $d['artikel_dateu']     = 'now()';
                $d['artikel_judul']     = $this->input->post('artikel_judul');
                $d['artikel_artikel']   = $this->input->post('artikel_artikel');
                $d['artikel_ket']       = $this->input->post('artikel_ket');
                $d['artikel_slug']      = slug($this->input->post('artikel_judul'));
                $d['artikel_image']     = $path.'/'.$this->upload->data('file_name');

                $w['artikel_id'] = $this->input->post('artikel_id');
                $update = $this->Unimodel->update($this->table,$d,$w);
        }
        $r['sukses'] = ($update > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }
    public function hapus()
    {
        $w['artikel_id'] = $this->input->post('id');
        $sql = "SELECT artikel_image FROM m_artikel WHERE artikel_id = {$this->input->post('id')}";
        $path = $this->db->query($sql)->row()->artikel_image;
        
        @unlink('.'.$path);
        
        $w['artikel_id'] = $this->input->post('id');
        $delete = $this->Unimodel->delete($this->table,$w);
        $r['sukses'] = ($delete > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }
    
}
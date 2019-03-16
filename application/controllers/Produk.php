<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produk extends CI_Controller {
    
    public $table       = 'm_produk';
    public $judul       = 'Produk';
    public $aktifgrup   = 'produk';
    public $aktifmenu   = 'produk';
    public $foldername  = 'produk';
    public $indexpage   = 'produk/v_produk';
    function __construct() {
        parent::__construct();
        include(APPPATH.'libraries/sessionakses.php');
        $title      = $this->judul;
    }
    public function index(){
        $data['title']      = $this->judul;
        $data['aktifgrup']  = $this->aktifgrup;
        $data['aktifmenu']  = $this->aktifmenu;
        $data['ktgproduk']  = $this->Unimodel->getdata('m_ktgproduk');
        $title      = $this->judul;
        $this->load->view($this->indexpage, $data);  
    }

    public function setView(){
        $sql        = "SELECT
                        m_produk.*,
                        m_ktgproduk.judul AS kategori
                    FROM
                        m_produk
                    JOIN m_ktgproduk ON m_ktgproduk.id = m_produk.ref_ktgproduk
                    WHERE
                        m_ktgproduk.aktif = 1";
        $result     = $this->Unimodel->que_all($sql);
        $list       = array();
        $no         = 1;
        foreach ($result as $r) {
            if ($r->image == NULL ){
                $gambar = "(Noimage)";
            } else {
                $gambar = "<img style='max-width : 30px;' src='.".$r->image."'>";
            }
            $row    = array(
                        "no"        => $no,
                        "kode"      => $r->kode,
                        "judul"     => $r->judul,
                        "kategori"  => $r->kategori,
                        "subjudul"  => $r->subjudul,
                        "artikel"   => $r->artikel,
                        "image"     => $gambar,
                        "ket"       => $r->ket,
                        "aktif"     => aktif($r->aktif),
                        "action"    => btnuda($r->id)
                        
            );
            $list[] = $row;
            $no++;
        }   
        echo json_encode(array('data' => $list));
    }

    public function getKtg(){
        $data = $this->Unimodel->getdata('m_ktgproduk');
        echo json_encode($data);
    }

    public function tambahfile()
    {   
        $config['upload_path'] = './uploads/'.$this->foldername;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = '*';
        $config['file_name'] = slug($this->input->post('judul'));
        $path = substr($config['upload_path'],1);
        $this->upload->initialize($config);
        
        if ( ! $this->upload->do_upload('image')){
            $d['useri']     = $this->session->userdata('username');
            $d['ref_ktgproduk']= $this->input->post('ref_ktgproduk');
            $d['judul']     = $this->input->post('judul');
            $d['artikel']   = $this->input->post('artikel');
            $d['ket']       = $this->input->post('ket');
            $d['slug']      = slug($this->input->post('judul'));
            $insert = $this->Unimodel->save($this->table,$d);
        }else{
            $d['useri']     = $this->session->userdata('username');
            $d['ref_ktgproduk']= $this->input->post('ref_ktgproduk');
            $d['judul']     = $this->input->post('judul');
            $d['artikel']   = $this->input->post('artikel');
            $d['ket']       = $this->input->post('ket');
            $d['slug']      = slug($this->input->post('judul'));
            $d['image']    = $path.'/'.$this->upload->data('file_name');
           
            $insert = $this->Unimodel->save($this->table,$d);
        }
        $r['sukses'] = ($insert > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }
    public function edit()
    {
        $w['id'] = $this->input->post('id');
        $data = $this->Unimodel->edit($this->table,$w);
        echo json_encode($data);
    }

    function updatefile(){
        $config['upload_path'] = './uploads/'.$this->foldername;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = '*';
        $config['file_name'] = slug($this->input->post('judul'));
        $path =  substr($config['upload_path'],1);
        $this->upload->initialize($config);
        $pathfile   = $this->input->post('path');
        $ext        = substr($pathfile, -3);
        if ( ! $this->upload->do_upload('image')){
        
                @rename("$pathfile",'.'.$path.'/'.$this->upload->data('file_name').'.'.$ext);
                
                $d['useru']     = $this->session->userdata('username');
                $d['ref_ktgproduk']= $this->input->post('ref_ktgproduk');
                $d['judul']     = $this->input->post('judul');
                $d['artikel']   = $this->input->post('artikel');
                $d['ket']       = $this->input->post('ket');
                $d['slug']      = slug($this->input->post('judul'));
                $d['image']     = $path.'/'.$this->upload->data('file_name').'.'.$ext ;

                $w['id'] = $this->input->post('id');
                $update = $this->Unimodel->update($this->table,$d,$w);
        }else{
                @unlink("$pathfile");
                $d['useru']     = $this->session->userdata('username');
                $d['ref_ktgproduk']= $this->input->post('ref_ktgproduk');
                $d['judul']     = $this->input->post('judul');
                $d['artikel']   = $this->input->post('artikel');
                $d['ket']       = $this->input->post('ket');
                $d['slug']      = slug($this->input->post('judul'));
                $d['image']     = $path.'/'.$this->upload->data('file_name');

                $w['id'] = $this->input->post('id');
                $update = $this->Unimodel->update($this->table,$d,$w);
        }
        $r['sukses'] = ($update > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }

    public function hapus()
    {
        $w['id'] = $this->input->post('id');
        $sql = "SELECT image FROM {$this->table} WHERE id = {$this->input->post('id')}";
        $path = $this->db->query($sql)->row()->image;
        
        @unlink('.'.$path);
        
        $w['id'] = $this->input->post('id');
        $delete = $this->Unimodel->delete($this->table,$w);
        $r['sukses'] = ($delete > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }

    public function aktif()
    {
        $sql = "SELECT aktif FROM {$this->table} WHERE id = {$this->input->post('id')}";
        $s = $this->db->query($sql)->row()->aktif;

        $s == 1 ? $status = 0 : $status =1;

        $d['aktif'] = $status;
        $w['id'] = $this->input->post('id');   
        $update = $this->Unimodel->update($this->table,$d,$w);
        $r['sukses'] = ($update > 0) ? 'success' : 'fail' ;
        echo json_encode($r);
    }
    
}
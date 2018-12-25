<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {
    
    public $table       = 'fartikel';
    public $foldername  = 'artikel';
    public $indexpage   = 'artikel/v_artikel';

    function __construct() {
        parent::__construct();
        //include(APPPATH.'libraries/sessionakses.php');
    }

    public function index(){

        $this->load->view($this->indexpage, $data);  
    }

    function setView(){
        $this->datatables->select('id,judul,artikel,ket');
        $this->datatables->from('fartikel');
        $this->datatables->add_column('option', btnud("$1"), 'id');
        return print_r($this->datatables->generate());
    }

    public function tambah()
    {
        $data = array(
                'useri'     => $this->session->userdata('nama_user'),
                'judul'     => ien($this->input->post('judul')),
                'subjudul'  => ien($this->input->post('subjudul')),
                'artikel'   => ien($this->input->post('artikel')),
                'ket'       => ien($this->input->post('ket')),
                'slug'      => slug($this->input->post('judul')),
            );
        $insert = $this->Unimodel->save($this->table,$data);
        echo json_encode(
            array(
                "message" => "sukses",
                "affected"=> $insert
            ));
    }

    public function tambahfile()
    {   
        $nmfile = $this->input->post('judul');
        $config['upload_path'] = './uploads/'.$this->foldername;
        $config['allowed_types'] = '*';
        $config['file_name'] = slug($nmfile);
        $path = substr($config['upload_path'],1);
        $slug = slug($this->input->post('judul'));
        $this->upload->initialize($config);
        
        if ( ! $this->upload->do_upload('gambar')){
            $data = array(
                    'useri'     => $this->session->userdata('nama_user'),
                    'judul'     => ien($this->input->post('judul')),
                    'subjudul'  => ien($this->input->post('subjudul')),
                    'artikel'   => ien($this->input->post('artikel')),
                    'ket'       => ien($this->input->post('ket')),
                    'slug'      => $slug,
                    
                    );

            $insert = $this->Unimodel->save($this->table,$data);
        }else{
            $data = array(
                    'useri' => $this->session->userdata('nama_user'),
                    'judul'     => ien($this->input->post('judul')),
                    'subjudul'  => ien($this->input->post('subjudul')),
                    'artikel'   => ien($this->input->post('artikel')),
                    'ket'       => ien($this->input->post('ket')),
                    'slug'      => $slug,
                    'gambar'    => $path.'/'.$this->upload->data('file_name'),
                    );
           
            $insert = $this->Unimodel->save($this->table,$data);
        }
        echo json_encode(array("sukses" => TRUE));
    }

    public function edit()
    {
        $where = array(
            'id' => $this->input->post('id'),
            );

        $data = $this->Unimodel->edit($this->table,$where);
        echo json_encode($data);
    }

    public function update()
    {
        $data = array(
                'dateu'     =>'now()',
                'useru'     => $this->session->userdata('nama_user'),
                'judul'     => ien($this->input->post('judul')),
                'subjudul'  => ien($this->input->post('subjudul')),
                'artikel'   => ien($this->input->post('artikel')),
                'ket'       => ien($this->input->post('ket')),
                'slug'      => slug($this->input->post('judul')),
            );
        $where = array(
            'id' => $this->input->post('id')
            );
        $this->Unimodel->update($this->table,$data,$where);
        echo json_encode(array("sukses" => TRUE));
    }

    

}

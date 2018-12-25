<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dummydb extends CI_Controller {

    function __construct() {
        parent::__construct();
        //include(APPPATH.'libraries/sessionakses.php');
        $title      = $this->judul;
    }

    public function index(){
        $data['title']      = $this->judul;
        $data['aktifgrup']  = $this->aktifgrup;
        $data['aktifmenu']  = $this->aktifmenu;
        $title      = $this->judul;
        $this->load->view($this->indexpage, $data);  
    }

    function insert(){
        $jumlah_data = 500;
        for ($i=1;$i<=$jumlah_data;$i++){
            $data   =   array(
                "judul"     =>  "Judul Ke-".$i,
                "artikel"   =>  "artikel ke-".$i,
                "ket"       =>  '089699935552');
            $this->db->insert('fartikel',$data); 
        }
        echo $i.' Data Berhasil Di Insert';
    }

    

}

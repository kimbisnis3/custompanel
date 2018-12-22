<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasiltes extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['sioin'] == TRUE)
        {
        }
        else
        {
            $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
            redirect('auth');
        }

        $this->load->model('Hr/M_hasiltes');
        $this->load->model('Hr/M_detailhasiltes');
        $this->load->helper('id_date');
        $this->load->helper('lulus');
        $this->load->helper('setuju');
        $this->load->model('M_sidebar'); 
    }

    public function index(){
        $data['title']      = 'Hasil Tes';
        $data['aktifgrup']  = '';
        $data['aktifmenu']  = 'hasiltes';
        $sess_ref_div = $this->session->userdata('ref_div');
        $data['pertanyaan']  = $this->M_hasiltes->getpertanyaan();
        $data['pertanyaanuser']  = $this->M_hasiltes->getpertanyaanuser($sess_ref_div);
        $data['lowongan']  = $this->M_hasiltes->getlowongan();

        $title      = 'Hasil Tes';

        $ref_access_user = $this->session->userdata('ref_access_user');
        $get_ref_action_user = $this->T_akses->getaccessuser($title);
        $ref_action_user    = $get_ref_action_user->id;

        $get_i          = $this->T_akses->getopsi_i($ref_access_user,$ref_action_user);

        $i  = $get_i->i ;

        $i_button   = "style = 'display : '";

        if ($i == 't') {
            $data['get_i_button'] = $i_button ;
        } else {
            $data['get_i_button'] =  "style = 'display : none'";
        };

        $this->load->view('Hr/hasiltes/v_hasiltes', $data); 
    }

    public function detailtes($id){
        $data['title']      = 'Hasil Tes';
        $data['aktifgrup']  = '';
        $data['aktifmenu']  = 'hasiltes';
        $sess_ref_div = $this->session->userdata('ref_div');
        $data['datapelamar']  = $this->M_detailhasiltes->getdatapelamar($id);
        $data['lowongan']  = $this->M_hasiltes->getlowongan();

        $title      = 'Hasil Tes';

        $ref_access_user = $this->session->userdata('ref_access_user');
        $get_ref_action_user = $this->T_akses->getaccessuser($title);
        $ref_action_user    = $get_ref_action_user->id;

        $get_i          = $this->T_akses->getopsi_i($ref_access_user,$ref_action_user);
        $get_u          = $this->T_akses->getopsi_u($ref_access_user,$ref_action_user);
        $get_d          = $this->T_akses->getopsi_d($ref_access_user,$ref_action_user);
        $get_o          = $this->T_akses->getopsi_o($ref_access_user,$ref_action_user);

        $i  = $get_i->i ;
        $u  = $get_u->u ;
        $d  = $get_d->d ;
        $o  = $get_o->o ;

        $i_button   = "style = 'display : '";
        $u_button   = "style = 'display : '";
        $d_button   = "style = 'display : '";
        $o_button   = "style = 'display : '";

        if ($i == 't') {
            $data['get_i_button'] = $i_button ;
        } else {
            $data['get_i_button'] =  "style = 'display : none'";
        };

        if ($u == 't') {
            $data['get_u_button'] = $u_button ;
        } else {
            $data['get_u_button'] =  "style = 'display : none'";
        };

        if ($d == 't') {
            $data['get_d_button'] = $d_button ;
        } else {
            $data['get_d_button'] =  "style = 'display : none'";
        };

        if ($o == 't') {
            $data['get_o_button'] = $o_button ;
        } else {
            $data['get_o_button'] =  "style = 'display : none'";
        };

        $this->load->view('Hr/hasiltes/v_detailtes', $data); 
    }

    public function setView(){
        $awal   = date('Y-m-d', strtotime($this->input->post('awal')));
        $akhir  = date('Y-m-d', strtotime($this->input->post('akhir')));

        $result     = $this->M_hasiltes->getSemua($awal, $akhir);
        $list       = array();
        $no         = 1;

        $title      = 'Hasil Tes';

        $ref_access_user = $this->session->userdata('ref_access_user');
        $get_ref_action_user = $this->T_akses->getaccessuser($title);
        $ref_action_user    = $get_ref_action_user->id;

        $get_i          = $this->T_akses->getopsi_i($ref_access_user,$ref_action_user);
        $get_u          = $this->T_akses->getopsi_u($ref_access_user,$ref_action_user);
        $get_d          = $this->T_akses->getopsi_d($ref_access_user,$ref_action_user);
        $get_o          = $this->T_akses->getopsi_o($ref_access_user,$ref_action_user);

        $i  = $get_i->i ;
        $u  = $get_u->u ;
        $d  = $get_d->d ;
        $o  = $get_o->o ;

        $i_button   = "style = 'display : '";
        $u_button   = "style = 'display : '";
        $d_button   = "style = 'display : '";
        $o_button   = "style = 'display : '";

        if ($i == 't') {
            $get_i_button = $i_button ;
        } else {
            $get_i_button =  "style = 'display : none'";
        };

        if ($u == 't') {
            $get_u_button = $u_button ;
        } else {
            $get_u_button =  "style = 'display : none'";
        };

        if ($d == 't') {
            $get_d_button = $d_button ;
        } else {
            $get_d_button =  "style = 'display : none'";
        };

        if ($o == 't') {
            $get_o_button = $o_button ;
        } else {
            $get_o_button =  "style = 'display : none'";
        };

        foreach ($result as $r) {
            $row    = array(
                        "no"        => $no,
                        "kode"      => $r->kode,
                        "nama"      => $r->nama,
                        "tglmasuk"      => id_date($r->tglmasuk),
                        "tgltes"      => id_date($r->tgltes),
                        "posisi"      => $r->posisi,
                        "arahan"      => $r->arahan,
                        "rekomendasihr"      => $r->rekhr,
                        "rekomendasidir"       => $r->rekdir,
                        "lulus"         => lulus($r->lulus),
                        "lulususer"     => lulus($r->lulususer),
                        "approvaldir"   => setuju($r->approvaldir),
                        "action"        => "
                        <a href='javascript:void(0)' class='btn btn-sm btn-info' data-toggle='tooltip' data-placement='top' title='Detail' onclick='detail(".$r->id.")' ><i class='glyphicon glyphicon-eye-open'></i></a>
                        <a href='javascript:void(0)' class='btn btn-sm btn-primary' data-toggle='tooltip' data-placement='top' title='Penilaian HR' onclick='lulus_hr(".$r->id.")' ".$get_u_button."><i class='glyphicon glyphicon-paperclip'></i></a>
                        <a href='javascript:void(0)' class='btn btn-sm btn-success ' data-toggle='tooltip' data-placement='top' title='Penilaian User' onclick='lulus_user(".$r->id.")' ><i class='glyphicon glyphicon-paperclip'></i></a>
                        <a href='javascript:void(0)' class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='top' title='Void' onclick='hapus(".$r->id.")' ".$get_d_button."><i class='glyphicon glyphicon-trash'></i></a>"
                        
            );

            $list[] = $row;
            $no++;
        }   
        echo json_encode(array('data' => $list));
    }

    public function setViewHr($id){
        $getkode    = $this->M_hasiltes->getkode($id);
        $kode       = $getkode->kode;
        $result     = $this->M_hasiltes->getSemuaHr($kode);
        $list       = array();
        $no         = 1;
        foreach ($result as $r) {

            $row    = array(
                        "no"        => $no,
                        "pertanyaan"      => $r->pertanyaan,
                        "jawaban"      => "
                        <input style = 'display : none ;' name='kodez[]' value='".$r->kode."' form='form-ubah-jawaban'></input>
                        <input style = 'display : none ;' name='ref_pertanyaanz[]' value='".$r->ref_pertanyaan."' form='form-ubah-jawaban'></input>
                        <input style = 'display : none' name='ref_hasilz[]'></input>
                        <input class='input-md form-control' witdh = '100%' name='jawabanz[]' value='".$r->jawaban."' form='form-ubah-jawaban'></input>
                        "
                        
            );
            
            $list[] = $row; 
            $no++;
        }  
        echo json_encode(array('data' => $list));
    }

    public function setViewHrDataOnly($id){
        $getkode    = $this->M_hasiltes->getkode($id);
        $kode       = $getkode->kode;
        $result     = $this->M_hasiltes->getSemuaHr($kode);
        $list       = array();
        $no         = 1;
        foreach ($result as $r) {

            $row    = array(
                        "no"        => $no,
                        "pertanyaan"      => $r->pertanyaan,
                        "jawaban"      => $r->jawaban
                        
            );
            
            $list[] = $row; 
            $no++;
        }  
        echo json_encode(array('data' => $list));
    }

    public function setViewUser($id){
        $getkode    = $this->M_hasiltes->getkode($id);
        $kode       = $getkode->kode;
        $sess_ref_div = $this->session->userdata('ref_div');
        $result     = $this->M_hasiltes->getSemuaUser($kode,$sess_ref_div);
        $list       = array();
        $no         = 1;
        foreach ($result as $r) {

            $row    = array(
                        "no"        => $no,
                        "pertanyaan"      => $r->pertanyaan,
                        "jawaban"      => "
                        <input style = 'display : none ;' name='kodeuserz[]' value='".$r->kode."' form='form-ubah-jawaban-user'></input>
                        <input style = 'display : none ;' name='ref_pertanyaanuserz[]' value='".$r->ref_pertanyaan."' form='form-ubah-jawaban-user'></input>
                        <input style = 'display : none' name='ref_hasiluserz[]'></input>
                        <input class='input-md form-control' witdh = '100%' name='jawabanuserz[]' value='".$r->jawaban."' form='form-ubah-jawaban-user'></input>
                        "
                        
            );
            
            $list[] = $row; 
            $no++;
        }  
        echo json_encode(array('data' => $list));
    }

    public function setViewUserDataOnly($id){
        $getkode    = $this->M_hasiltes->getkode($id);
        $kode       = $getkode->kode;
        $sess_ref_div = $this->session->userdata('ref_div');
        $result     = $this->M_hasiltes->getSemuaUser($kode,$sess_ref_div);
        $list       = array();
        $no         = 1;
        foreach ($result as $r) {

            $row    = array(
                        "no"        => $no,
                        "pertanyaan"      => $r->pertanyaan,
                        "jawaban"      => $r->jawaban
                        
            );
            
            $list[] = $row; 
            $no++;
        }  
        echo json_encode(array('data' => $list));
    }

    public function tambahdetail(){

    $data    = array();
    $temp = count($this->input->post('ref_pertanyaan'));

    for($i=0; $i<$temp; $i++){

    $ref_hasil  =   $this->input->post('ref_hasil');

    $ref_pertanyaan  =   $this->input->post('ref_pertanyaan');
    $jawaban        =   $this->input->post('jawaban');
    $data[] = array(
        'ref_hasil'=>$ref_hasil[$i],
        'ref_pertanyaan'=>$ref_pertanyaan[$i],
        'jawaban' =>$jawaban[$i], 
     );
    }

    $insert = count($data);

    if($insert)
            {
            $this->db->insert_batch('xhasiltesd', $data);
            echo json_encode(array("sukses" => TRUE));
            }

    return $insert;
    echo json_encode(array("sukses" => TRUE));
    }

    public function tambahdetailuser(){

    $data    = array();
    $temp = count($this->input->post('ref_pertanyaanuser'));

    for($i=0; $i<$temp; $i++){

    $ref_hasil  =   $this->input->post('ref_hasiluser');

    $ref_pertanyaan  =   $this->input->post('ref_pertanyaanuser');
    $jawaban        =   $this->input->post('jawabanuser');
    $data[] = array(
        'ref_hasil'=>$ref_hasil[$i],
        'ref_pertanyaan'=>$ref_pertanyaan[$i],
        'jawaban' =>$jawaban[$i], 
     );
    }

    $insert = count($data);

    if($insert)
            {
            $this->db->insert_batch('xhasiltesd', $data);
            echo json_encode(array("sukses" => TRUE));
            }

    return $insert;
    echo json_encode(array("sukses" => TRUE));
    } 

    public function ubah_penilaian(){

    $data    = array();
    $temp = count($this->input->post('ref_pertanyaanz'));

    for($i=0; $i<$temp; $i++){
    $kodez  =   $this->input->post('kodez');
    $ref_pertanyaanz  =   $this->input->post('ref_pertanyaanz');
    $jawabanz        =   $this->input->post('jawabanz');
    $data[] = array(
        'kode' => $kodez[$i],
        'ref_pertanyaan'=>$ref_pertanyaanz[$i],
        'jawaban' =>$jawabanz[$i], 
     );
    }

    $insert = count($data);

    if($insert)
            {
            $this->db->update_batch('xhasiltesd', $data, 'kode');
            echo json_encode(array("sukses" => TRUE));
            }

    return $insert;
    echo json_encode(array("sukses" => TRUE));
    
    }

    public function ubah_penilaian_user(){

    $data    = array();
    $temp = count($this->input->post('ref_pertanyaanuserz'));

    for($i=0; $i<$temp; $i++){
    $kodeuserz  =   $this->input->post('kodeuserz');
    $ref_pertanyaanuserz  =   $this->input->post('ref_pertanyaanuserz');
    $jawabanuserz        =   $this->input->post('jawabanuserz');
    $data[] = array(
        'kode' => $kodeuserz[$i],
        'ref_pertanyaan'=>$ref_pertanyaanuserz[$i],
        'jawaban' =>$jawabanuserz[$i], 
     );
    }

    $insert = count($data);

    if($insert)
            {
            $this->db->update_batch('xhasiltesd', $data, 'kode');
            echo json_encode(array("sukses" => TRUE));
            }

    return $insert;
    echo json_encode(array("sukses" => TRUE));
    
    }

    public function delete_penilaian(){

    $kodez  =   $this->input->post('kodez');
    $kode   = $kodez;
    $data = $kode;
    $this->db->where_in('kode', $data);
    $this->db->delete('xhasiltesd');
    echo json_encode(array("sukses" => TRUE));
    
    }

    public function delete_penilaian_user(){

    $kodez  =   $this->input->post('kodeuserz');
    $kode   = $kodez;
    $data = $kode;
    $this->db->where_in('kode', $data);
    $this->db->delete('xhasiltesd');
    echo json_encode(array("sukses" => TRUE));
    
    }

    public function getkode($id)
    {   
        $data = $this->M_hasiltes->getkode($id);
        echo json_encode($data);
    }

    public function getshowtombol($id)
    {   
        $data   = $this->M_hasiltes->getkode($id);
        $kodexhasil   = $data->kode;
        $kode   = $this->M_hasiltes->getshowtombol($kodexhasil);
        $kodex   = $kode->jumlah;
        if (($kodex) == '0'){
            echo json_encode(array("show" => TRUE));
        }else {
            echo json_encode(array("noshow" => TRUE));
        }
    }

    public function getshowtomboluser($id)
    {   
        $data   = $this->M_hasiltes->getkode($id);
        $kodexhasil   = $data->kode;
        $kode   = $this->M_hasiltes->getshowtomboluser($kodexhasil);
        $kodex   = $kode->jumlah;
        if (($kodex) == '0'){
            echo json_encode(array("show" => TRUE));
        }else {
            echo json_encode(array("noshow" => TRUE));
        }
    }

    public function pertanyaan()
    {
        $data = $this->M_hasiltes->getpertanyaan();
        echo json_encode($data);
    }

    public function lulus_hr($id)
    {
        //$getarahan = $this->M_hasiltes->getarahan($id);
        $data = $this->M_hasiltes->lulus_hr($id);
        echo json_encode($data);
    }

    public function lulus_hr_update() 
    {
        $rekomendasihr      = $this->input->post('rekomendasihr');
        $lulus      = $this->input->post('lulus');

        $rekomendasihrpost  = "";
        $luluspost      = "";

        if ($rekomendasihr == "") {
            $rekomendasihrpost = NULL;
        }else {
            $rekomendasihrpost = $rekomendasihr;
        };
        if ($lulus == "") {
            $luluspost = NULL;
        }else {
            $luluspost = $lulus;
        };

        $data = array(
                'useru' => $this->session->userdata('nama_user'),
                'dateu' => 'now()',
                'teshr' => $this->input->post('teshr'),
                'rekomendasihr' => $rekomendasihrpost,
                'lulus' => $luluspost
            );
        $where = array(
            'id' => $this->input->post('id')
            );
        $this->M_hasiltes->lulus_hr_update($where,$data);
        echo json_encode(array("sukses" => TRUE));
    }

    public function load_pelamar()
    {
        $result = $this->M_hasiltes->load_pelamar();
        $list       = array();
        $no         = 1;

        foreach ($result as $r) {
            $row    = array(
                        "no"        => $no,
                        "nama"      => $r->nama,
                        "posisi"      => $r->posisi,
                        "arahan"      => $r->arahan,
                        "tglmasuk"      => id_date($r->tglmasuk),
                        "tgltes"      => id_date($r->tgltes),
                        "action"        => "
                        <input style = 'display : none  ;' name='idpelamar[]' value='".$r->id."' form='form-tambah-pelamar'></input>
                        <a href='javascript:void(0)' class='btn btn-sm btn-success'  data-placement='top' title='Tambahkan' onclick='tambahpelamar(".$r->id.")'><i class='fa fa-check'></i></a>"
                        
            );

            $list[] = $row;
            $no++;
        }   
        echo json_encode(array('data' => $list));

    }

    public function tambahpelamar($id) {
        $data = array(
                'useru' => $this->session->userdata('nama_user'),
                'ref_jadwaltesd' => $id
            );
        $this->M_hasiltes->tambahpelamar($data);
        echo json_encode(array("sukses" => TRUE));
    }

    public function simpanpelamar() {

    $data    = array();
    $temp = count($this->input->post('idpelamar'));

    for($i=0; $i<$temp; $i++){
    $idpelamar  =   $this->input->post('idpelamar');
    $data[] = array(
        'ref_jadwaltesd' => $idpelamar[$i]
     );
    }

    $insert = count($data);

    if($insert)
            {
            $this->db->insert_batch('xhasiltes', $data);
            echo json_encode(array("sukses" => TRUE));
            }

    return $insert;
    echo json_encode(array("sukses" => TRUE));
    }

    public function lulus_user_update() 
    {
        $lulususer      = $this->input->post('lulususer');

        $lulususerpost      = "";

        if ($lulususer == "") {
            $lulususerpost = NULL;
        }else {
            $lulususerpost = $lulususer;
        };
        $data = array(
                'useru' => $this->session->userdata('nama_user'),
                'dateu' => 'now()',
                'lulususer' => $lulususerpost,
                'tesuser' => $this->input->post('tesuser')
            );
        $where = array(
            'id' => $this->input->post('id')
            );
        $this->M_hasiltes->lulus_user_update($where,$data);
        echo json_encode(array("sukses" => TRUE));
    }

    public function komentarhr() 
    {
        $data = array(
                'komentarhr' => $this->input->post('komentarhr')
            );
        $where = array(
            'id' => $this->input->post('id-for-getkode')
            );
        $this->M_hasiltes->update($where,$data);
        echo json_encode(array("sukses" => TRUE));
    }

    public function komentaruser() 
    {
        $data = array(
                'komentaruser' => $this->input->post('komentaruser')
            );
        $where = array(
            'id' => $this->input->post('id-for-getkode')
            );
        $this->M_hasiltes->update($where,$data);
        echo json_encode(array("sukses" => TRUE));
    }

    public function koresponden() 
    {
        $data = array(
                'koresponden' => $this->input->post('koresponden')
            );
        $where = array(
            'id' => $this->input->post('id-for-getkode')
            );
        $this->M_hasiltes->update($where,$data);
        echo json_encode(array("sukses" => TRUE));
    }

    public function load_approval($id)
    {
        $data = $this->M_hasiltes->getapproval($id);
        echo json_encode($data);
    }

    public function approvaldir() 
    {
        $rekomendasidir      = $this->input->post('rekomendasidir');

        $rekomendasidirpost      = "";

        if ($rekomendasidir == "") {
            $rekomendasidirpost = NULL;
        }else {
            $rekomendasidirpost = $rekomendasidir;
        };

        $data = array(
                'approvaldir' => $this->input->post('approvaldir'),
                'rekomendasidir' => $rekomendasidirpost,
                'disposisi' => $this->input->post('disposisi'),
            );
        $where = array(
            'id' => $this->input->post('id')
            );
        $this->M_hasiltes->update($where,$data);
        echo json_encode(array("sukses" => TRUE));
    }

    public function penempatan() 
    {
        $rekomendasihr      = $this->input->post('disarankan');
        $kesediaan      = $this->input->post('kesediaan');

        $rekomendasihrpost  = "";
        $kesediaanpost      = "";

        if ($rekomendasihr == "") {
            $rekomendasihrpost = NULL;
        }else {
            $rekomendasihrpost = $rekomendasihr;
        };
        if ($kesediaan == "") {
            $kesediaanpost = NULL;
        }else {
            $kesediaanpost = $kesediaan;
        };

        $data = array(
                'rekomendasihr' => $rekomendasihrpost,
                'kesediaan' => $kesediaanpost
            );
        $where = array(
            'id' => $this->input->post('id')
            );
        $this->M_hasiltes->update($where,$data);
        echo json_encode(array("sukses" => TRUE));
    }

    function getaskhr($id)
    {
        $getrefhasil    = $this->M_hasiltes->getkode($id);
        $refhasil       = $getrefhasil->kode;
        $result         = $this->M_hasiltes->getpertanyaanhrx();
        $list       = array();
        $no         = 1;
        foreach ($result as $r) {
            $row    = array(
                        "ref_hasil"=> "<input style = 'display :   ;' name='ref_hasil[]' value='".$refhasil."' form='form-ask-hr' id='checkelementhr'></input>",
                        "ref_pertanyaan"=> "<input style = 'display :   ;' name='ref_pertanyaan[]' value='".$r->kode."' form='form-ask-hr'></input>",
                        "pertanyaan"=> $r->pertanyaan,

            );
            
            $list[] = $row; 
            $no++;
        }  
        echo json_encode(array('data' => $list));
    }

    function getask($id)
    {
        $getrefhasil    = $this->M_hasiltes->getkode($id);
        $refhasil       = $getrefhasil->kode;
        $getkodepelamar = $this->M_hasiltes->getkodepelamar($id);
        $kodepelamar    = $getkodepelamar->kodepelamar;
        $getarahan      = $this->M_hasiltes->getarahan($kodepelamar);
        $arahan         = $getarahan->arahan;
        $result         = $this->M_hasiltes->getpertanyaanuserx($arahan);
        $list       = array();
        $no         = 1;
        foreach ($result as $r) {
            $row    = array(
                        "ref_hasiluser"=> "<input style = 'display :   ;' name='ref_hasiluser[]' value='".$refhasil."' form='form-ask' id='checkelement'></input>",
                        "ref_pertanyaanuser"=> "<input style = 'display :   ;' name='ref_pertanyaanuser[]' value='".$r->kode."' form='form-ask'></input>",
                        "pertanyaan"=> $r->pertanyaan,

            );
            
            $list[] = $row; 
            $no++;
        }  
        echo json_encode(array('data' => $list));
    }

    #void data
    public function hapus($id)
    {
        $data = array(
            'void' => 't', 
            );

        $where = array(
            'id' => $id
            );

        $this->M_hasiltes->update($where,$data);
        echo json_encode(array("sukses" => TRUE));
    }

    public function printf($id)
    {
        $data['title']      = ' ';

        $idhasil   = $id;
        $kodehasil = $this->M_hasiltes->getkodehasil($idhasil);
        $kode = "$kodehasil->kode";
        $data['identitas']     = $this->M_hasiltes->getidentitas($kode);
        $data['hasiltes']     = $this->M_hasiltes->getcetak($kode);
        $this->load->view('Hr/hasiltes/p_hasiltes',$data);
    }

    function printhr($id){

        $data['title']      = 'Ringkasan Hasil Wawancara HRD';
        $kodehasil = $this->M_hasiltes->getkodehasil($id);
        $kode = "$kodehasil->kode";
        $data['identitas']     = $this->M_hasiltes->getidentitas($kode);
        $data['komentar']     = $this->M_hasiltes->getkomentar($kode);
        $data['diterima']     = $this->M_hasiltes->getkomentar($kode);
        $data['interview']     = $this->M_hasiltes->getsemuahr($kode);
        $this->load->view('Hr/hasiltes/p_hasiltes',$data);
    }

    function printuser($id){

        $data['title']      = 'Ringkasan Hasil Wawancara User';
        $kodehasil = $this->M_hasiltes->getkodehasil($id);
        $kode = "$kodehasil->kode";
        $data['identitas']     = $this->M_hasiltes->getidentitas($kode);
        $data['komentar']     = $this->M_hasiltes->getkomentaruser($kode);
        $data['diterima']     = $this->M_hasiltes->getkomentaruser($kode);
        $data['interview']     = $this->M_hasiltes->getcetakuser($kode);
        $this->load->view('Hr/hasiltes/p_hasiltes',$data);
    }


}

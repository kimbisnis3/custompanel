<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hasiltes extends CI_Model{

    function __construct() {
        parent::__construct();
        
    }

    function getpertanyaan(){
        $sql    = 
        "SELECT
            minterview.id,
            minterview.kode,
            minterview.pertanyaan
        FROM
            minterview 
        WHERE 
            minterview.hr IS TRUE
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getpertanyaanuser($sess_ref_div){
        $sql    = 
        "SELECT
            minterview.id,
            minterview.kode,
            minterview.pertanyaan
        FROM
            minterview 
        WHERE 
            minterview.ref_div = '$sess_ref_div'
        AND 
            minterview.hr IS NOT TRUE
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getlowongan(){
        $sql    = 
        "SELECT
            mjabatan.kode,
            mjabatan.nama posisi
        FROM
            mjabatan 
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getapproval($id){
        $sql    = 
        "SELECT
            xhasiltes.rekomendasidir,
            xhasiltes.approvaldir,
            xhasiltes.rekomendasihr,
            xhasiltes.disposisi,
            xhasiltes.id,
            xhasiltes.kesediaan,
            rekhr.nama rekhr,
            rekdir.nama rekdir,
            mjabatan.nama posisi
        FROM
            xhasiltes
        LEFT OUTER JOIN xjadwaltesd ON xjadwaltesd. ID = xhasiltes.ref_jadwaltesd
        LEFT OUTER JOIN xjadwaltes ON xjadwaltes.kode = xjadwaltesd.ref_jadwal
        LEFT OUTER JOIN xpelamar ON xpelamar.kode = xjadwaltesd.ref_pelamar
        LEFT OUTER JOIN mjabatan ON mjabatan.kode = xpelamar.ref_lowongan
        LEFT OUTER JOIN mjabatan rekhr ON rekhr.kode = xhasiltes.rekomendasihr
        LEFT OUTER JOIN mjabatan rekdir ON rekdir.kode = xhasiltes.rekomendasidir

        WHERE
            xhasiltes.id = '$id'";

        $query = $this->db->query($sql);
        return $query->row();
    }

    function getSemua($awal, $akhir){
        $sql    = 
        "SELECT
            xpelamar.nama,
            xpelamar.tglmasuk,
            mjabatan.nama posisi,
            arahan.nama arahan,
            xhasiltes.kode,
            xhasiltes. ID,
            xhasiltes.lulus,
            xhasiltes.lulususer,
            xhasiltes.rekomendasihr,
            rekhr.nama rekhr,
            xhasiltes.rekomendasidir,
            rekdir.nama rekdir,
            xhasiltes.approvaldir,
            xjadwaltes.tgltes
        FROM
            xhasiltes
        LEFT OUTER JOIN xjadwaltesd ON xjadwaltesd. ID = xhasiltes.ref_jadwaltesd
        LEFT OUTER JOIN xjadwaltes ON xjadwaltes.kode = xjadwaltesd.ref_jadwal
        LEFT OUTER JOIN xpelamar ON xpelamar.kode = xjadwaltesd.ref_pelamar
        LEFT OUTER JOIN mjabatan ON mjabatan.kode = xpelamar.ref_lowongan
        LEFT OUTER JOIN mjabatan arahan ON arahan.kode = xpelamar.arahan
        LEFT OUTER JOIN mjabatan rekhr ON rekhr.kode = xhasiltes.rekomendasihr
        LEFT OUTER JOIN mjabatan rekdir ON rekdir.kode = xhasiltes.rekomendasidir
        WHERE
            xjadwaltesd.hadir IS TRUE
        AND 
            xhasiltes.void IS NOT TRUE
        AND
            tgltes 
        BETWEEN 
            '$awal' and '$akhir'
        ORDER BY 
            xjadwaltes.tgltes ASC
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getSemuaHr($kode)
    {
        $sql    = 
        "SELECT
            minterview.pertanyaan,
            xhasiltesd.kode,
            xhasiltesd.id,
            xhasiltesd.jawaban,
            xhasiltesd.ref_pertanyaan,
            xhasiltes.kode kodehasil
        FROM
            xhasiltesd
        LEFT OUTER JOIN xhasiltes ON xhasiltes.kode = xhasiltesd.ref_hasil
        LEFT OUTER JOIN minterview ON minterview.kode = xhasiltesd.ref_pertanyaan
        WHERE
            xhasiltesd.ref_hasil = '$kode'
        AND
            minterview.hr IS TRUE
        ORDER BY 
            xhasiltesd.ref_pertanyaan ASC";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getSemuaUser($kode,$sess_ref_div)
    {
        $sql    = 
        "SELECT
            minterview.pertanyaan,
            xhasiltesd.jawaban,
            xhasiltesd.id,
            xhasiltesd.kode,
            xhasiltesd.ref_pertanyaan,
            xhasiltes.kode kodehasil
        FROM
            xhasiltesd
        LEFT OUTER JOIN xhasiltes ON xhasiltes.kode = xhasiltesd.ref_hasil
        LEFT OUTER JOIN minterview ON minterview.kode = xhasiltesd.ref_pertanyaan
        WHERE
            xhasiltesd.ref_hasil = '$kode'
        AND
            minterview.ref_div ='$sess_ref_div'
        ORDER BY 
            xhasiltesd.ref_pertanyaan ASC";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getkode($id)
    {
        $sql    = 
        "SELECT
            xhasiltes.kode
        FROM
            xhasiltes
        WHERE
            xhasiltes.id = '$id'";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getkodehasil($id)
    {
        $sql    = 
        "SELECT
            xhasiltes.kode
        FROM
            xhasiltes
        WHERE
            xhasiltes.id = '$id'";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getshowtombol($kodexhasil)
    {
        $sql    = 
        "SELECT
            COUNT (xhasiltesd.ref_hasil) jumlah
        FROM
            xhasiltesd
        LEFT OUTER JOIN minterview on minterview.kode = xhasiltesd.ref_pertanyaan
        WHERE
            xhasiltesd.ref_hasil = '$kodexhasil' and minterview.hr IS TRUE";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getkodepelamar($id)
    {
        $sql    = 
        "SELECT
            xpelamar.kode kodepelamar
        FROM
            xhasiltes
        LEFT OUTER JOIN xjadwaltesd on xjadwaltesd.id = xhasiltes.ref_jadwaltesd
        LEFT OUTER JOIN xpelamar on xpelamar.kode = xjadwaltesd.ref_pelamar
        WHERE
            xhasiltes.id = '$id'";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getshowtomboluser($kodexhasil)
    {
        $sql    = 
        "SELECT
            COUNT (xhasiltesd.ref_hasil) jumlah
        FROM
            xhasiltesd
        LEFT OUTER JOIN minterview on minterview.kode = xhasiltesd.ref_pertanyaan
        WHERE
            xhasiltesd.ref_hasil = '$kodexhasil' and minterview.hr IS NOT TRUE";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getarahan($kodepelamar)
    {
        $sql    = 
        "SELECT
            xpelamar.arahan
        FROM
            xpelamar
        WHERE
            xpelamar.kode = '$kodepelamar'";

        $query = $this->db->query($sql);
        return $query->row();
    }

    function getpertanyaanhrx(){
        $sql    = 
        "SELECT
            minterview.id,
            minterview.kode,
            minterview.pertanyaan
        FROM
            minterview 
        WHERE 
            minterview.hr IS TRUE
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getpertanyaanuserx($arahan){
        $sql    = 
        "SELECT
            minterview.id,
            minterview.kode,
            minterview.pertanyaan
        FROM
            minterview 
        WHERE 
            minterview.ref_jabatan = '$arahan'
        AND 
            minterview.hr IS NOT TRUE
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function save($data)
    {
        $this->db->insert('xpelamar', $data);
    }

    public function savedetail($data)
    {
        $this->db->insert('xhasiltesd', $data);
    }

    public function getarahanbyid($id)
    {
        $sql    = 
        "SELECT
            xpelamar.arahan
        FROM
            xpelamar
        WHERE
            xpelamar.id = '$id'";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function edit($id)
    {
       $sql    = 
        "SELECT
            *
        FROM
            xpelamar
        WHERE
            xpelamar.id = '$id'";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function lulus_hr($id)
    {
     $query = $this->db->query("SELECT * from xhasiltes 
        where xhasiltes.id='$id'");
       return $query->row(); 
    }

    public function lulus_hr_update($where, $data)
    {
     $this->db->update('xhasiltes', $data, $where);
    }

    public function lulus_user($id)
    {
     $query = $this->db->query("SELECT * from xhasiltes 
        where xhasiltes.id='$id'");
       return $query->row(); 
    }

    public function lulus_user_update($where, $data)
    {
     $this->db->update('xhasiltes', $data, $where);
    }

    public function update($where, $data)
    {
        $this->db->update('xhasiltes', $data, $where);
    }

    public function selectid()
    {
        $sql    = 
        "SELECT
            xjadwaltesd.id
        FROM
            xjadwaltesd";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function load_pelamar()
    {
        $sql    = 
        "SELECT
            xjadwaltesd.*,
            xpelamar.nama,
            xpelamar.tglmasuk,
            mjabatan.nama posisi,
            arahan.nama arahan,
            xjadwaltes.tgltes
        FROM
            xjadwaltesd
        LEFT OUTER JOIN xjadwaltes ON xjadwaltes.kode = xjadwaltesd.ref_jadwal
        LEFT OUTER JOIN xpelamar ON xpelamar.kode = xjadwaltesd.ref_pelamar
        LEFT OUTER JOIN mjabatan ON mjabatan.kode = xpelamar.ref_lowongan
        LEFT OUTER JOIN mjabatan arahan ON arahan.kode = xpelamar.arahan
        WHERE
            xjadwaltesd.hadir IS TRUE
        AND 
            xjadwaltes.void IS NOT TRUE
        AND xjadwaltesd. ID NOT IN (
            SELECT
                xhasiltes.ref_jadwaltesd
            FROM
                xhasiltes
            WHERE
                xhasiltes.ref_jadwaltesd = xjadwaltesd. ID
            AND xhasiltes.void IS NOT TRUE
        )";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function tambahpelamar($data)
    {
        $this->db->insert('xhasiltes', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('xpelamar');
    }

    public function void($id)
    {
        $sql    = 
        "
        UPDATE xpelamar
        SET xpelamar.void = 't'
        WHERE xpelamar.id = '$id'";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getidentitas($kode)
    {
        $sql    = 
        "SELECT
            xpelamar.nama,
            mjabatan.nama posisi
        FROM
            xhasiltes
        LEFT OUTER JOIN xpelamar ON xpelamar.kode = xhasiltes.ref_pelamar
        LEFT OUTER JOIN mjabatan ON mjabatan.kode = xpelamar.ref_lowongan
        WHERE
            xhasiltes.kode = '$kode'";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getkomentar($kode)
    {
        $sql    = 
        "SELECT
            xhasiltes.komentarhr komentar,
            xhasiltes.lulus diterima
        FROM
            xhasiltes
        WHERE
            xhasiltes.kode = '$kode'";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getkomentaruser($kode)
    {
        $sql    = 
        "SELECT
            xhasiltes.komentaruser komentar,
            xhasiltes.lulususer diterima
        FROM
            xhasiltes
        WHERE
            xhasiltes.kode = '$kode'";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getcetakuser($kode)
    {
        $sql    = 
        "SELECT
            minterview.pertanyaan,
            xhasiltesd.kode,
            xhasiltesd.id,
            xhasiltesd.jawaban,
            xhasiltesd.ref_pertanyaan,
            xhasiltes.kode kodehasil
        FROM
            xhasiltesd
        LEFT OUTER JOIN xhasiltes ON xhasiltes.kode = xhasiltesd.ref_hasil
        LEFT OUTER JOIN minterview ON minterview.kode = xhasiltesd.ref_pertanyaan
        WHERE
            xhasiltesd.ref_hasil = '$kode'
        AND
            minterview.hr IS NOT TRUE
        ORDER BY 
            xhasiltesd.ref_pertanyaan ASC";

        $query = $this->db->query($sql);
        return $query->result();
    }




}
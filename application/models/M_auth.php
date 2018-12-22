<?php

class M_auth extends CI_Model{

  function cek_auth($tuser,$where){

    return $this->db->get_where($tuser,$where);

  }

      public function datauser($username)
        {
        $sql    = 
        "SELECT
            tuser.*
        FROM
            tuser
        WHERE 
            tuser.username='$username'
        ";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function sessionkodeup($wheresession, $session_kode)
    {
        $this->db->update('tuser', $session_kode, $wheresession);
    }
}

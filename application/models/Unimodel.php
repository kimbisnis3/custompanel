<?php
class Unimodel extends CI_Model{
   

    function que_all($sql)
    {
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getdata($table)
    {
        $query = $this->db->get($table);
        return $query->result();
    }

    function getdatawall($table,$where)
    {
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->result();
    }

    function getdataw($table,$where)
    {
        $query = $this->db->get($table,$where);
        return $query->row();
    }

    function save($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    function edit($table,$where)
    {
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->row();
    }

    function update($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    function delete($table, $where)
    {
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    function cek_auth($tuser,$where)
    {
        return $this->db->get_where($tuser,$where);
    }

    public function datauser($username)
    {
        $sql    = 
        "SELECT
            t_user.*
        FROM
            t_user
        WHERE 
            t_user.username='$username'
        ";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function sessionkodeup($wheresession, $session_kode)
    {
        $this->db->update('t_user', $session_kode, $wheresession);
    }


}
?>
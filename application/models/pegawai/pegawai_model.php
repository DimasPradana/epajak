<?php
class Pegawai_model extends CI_Model {
    function __construct() 
    { 
        parent::__construct();
        $this->load->database();
    }  


    function data_user($namauser)
    {
        $query=$this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status FROM tbuser WHERE Nama='$namauser'");
        return $query->result();
    }

    
    
}
<?php
class Daerah extends CI_Model {
    function __construct() 
    { 
        parent::__construct();
        $this->load->database();
    }  


    function data_provinsi()
    {
        $query=$this->db->query("SELECT kode,nama FROM provinsi");
        return $query->result();
    }



    
    
}
<?php
class Bendahara_model extends CI_Model {
    function __construct() 
    { 
        parent::__construct();
        $this->load->database();
    }  

    public function daftarbayar()
    {
        $this->db->select('NoBayar,Nomor_SKPRD,NamaWP,KeteranganPajak,JumlahPajak,Denda,Penyetor');              
        $this->db->order_by("NoBayar", "desc");
        $query=$this->db->get('tandabayar');
        return $query->result();

    } 
    





    
    
}
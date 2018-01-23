<?php
class Tbuser extends CI_Model {
    function __construct() 
    { 
        parent::__construct();
        $this->load->database();
    } 

    public function loaddatauser() {  
        $this->db->select('Nomor,Nama,Email,Password,StatusUser,Wewenang');
        $query=$this->db->get('tbuser');
        return $query->result();
    }


    function insertuser($Nama,$Email,$Password,$StatusUser,$Wewenang)
    {

        $data_kategori = array ('Nama' => $Nama,'Email' => $Email,'Password' => $Password,'StatusUser' => $StatusUser,'Wewenang' => $Wewenang);
        return $this->db->insert('tbuser',$data_kategori);
    }

    function updateuser($Nama,$Email,$StatusUser,$Wewenang) 
    {
        $data = array ('Email'=>$Email,'StatusUser'=>$StatusUser,'Wewenang'=>$Wewenang);
        $this->db->where('Nama', $Nama);
        $this->db->update('tbuser', $data);
    }

    function updatepassworduser($Nama,$Password) 
    {
        $data = array ('Password'=>$Password);
        $this->db->where('Nama', $Nama);
        $this->db->update('tbuser', $data);
    }



 
    
}
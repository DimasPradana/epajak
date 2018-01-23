<?php
class Grafik extends CI_Model {
    function __construct() 
    { 
        parent::__construct();
        $this->load->database();
    } 

    public function lapskp() {  
        $this->db->select('keterangan,saldoawal,jumlah');
        $query=$this->db->get('lapskp2');
        return $query->result();
    }

    public function lapspt_all() {  
        $this->db->select('NoID,JenisPajak,NamaPajak,TanggalEntri,NPWPD,NamaWP,Bulan,Tahun,KeteranganPajak,JumlahPajak,DataEntri,Verifikator');
        $query=$this->db->get('laporanspt');
        return $query->result();
    }

    public function tampil_sptall($num, $offset)
    {
        $this->db->select('NoID,JenisPajak,NamaPajak,TanggalEntri,NPWPD,NamaWP,Bulan,Tahun,KeteranganPajak,JumlahPajak,DataEntri,Verifikator');
        $data = $this->db->get('laporanspt', $num, $offset);
        return $data->result();
    }    

    public function data($number,$offset){
        return $query = $this->db->get('laporanspt',$number,$offset)->result();       
    }

    public function data2($number,$offset){
        return $query = $this->db->get('lapskpall',$number,$offset)->result();       
    }    

    function jumlah_data(){
        return $this->db->get('laporanspt')->num_rows();
    }

    function jumlah_data2(){
        return $this->db->get('lapskpall')->num_rows();
    }




 
    
}
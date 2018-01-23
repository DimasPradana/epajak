<?php
class Npwpd extends CI_Model {
    function __construct() 
    { 
        parent::__construct();
        $this->load->database();
    } 

    function cari_data_npwpd($NPWPD)
    {
        $query=$this->db->query("SELECT NoID,ContactPerson,NPWPD,NamaWP,Kabupaten,Kelurahan,Provinsi,Kecamatan,AlamatWP,Status FROM npwpd WHERE NPWPD='$NPWPD'");
        return $query->result();
    } 


    function data_npwpd($aktif)
    {
        $query=$this->db->query("SELECT NoID,ContactPerson,NPWPD,NamaWP,Kabupaten,Kelurahan,Provinsi,Kecamatan,AlamatWP,Status FROM npwpd WHERE Status='$aktif'");
        return $query->result();
    }

    function data_npwpd2($aktif)
    {
        $query=$this->db->query("SELECT NoID,ContactPerson,NPWPD,NamaWP,Kabupaten,Kelurahan,Provinsi,Kecamatan,AlamatWP,Status FROM npwpd WHERE Status='$aktif' order by NamaWP asc");
        return $query->result();
    }

    public function jumlah_cari_produk_jenis($status)
    {
        $this->load->database();
        $query = $this->db->query("select * from npwpd where status='$status'");
        return $query->num_rows();
    }

    public function cari_produk_jenis($limit, $offset,$status)
    {
        $this->db->select('NoID,ContactPerson,NPWPD,NamaWP,Kabupaten,Kelurahan,Provinsi,Kecamatan,AlamatWP,Status');
        $this->db->where("Status",$status);
        $query=$this->db->get('npwpd', $offset, $limit);
        return $query->result();

    }

    public function cari_produk_jenis2($status)
    {
        $this->db->select('NoID,ContactPerson,NPWPD,NamaWP,Kabupaten,Kelurahan,Provinsi,Kecamatan,AlamatWP,Status');
        $this->db->where("Status",$status);
        $query=$this->db->get('npwpd');
        return $query->result();

    }    

    function cari_npwpd($limit, $offset,$npwpd,$nama,$alamat,$status)
    {
        $this->db->select('NoID,ContactPerson,NPWPD,NamaWP,Kabupaten,Kelurahan,Provinsi,Kecamatan,AlamatWP,Status');
        $this->db->where("Status",$status);
        $this->db->like("NPWPD",$npwpd);
        $this->db->like("NamaWP",$nama);
        $this->db->like("AlamatWP",$alamat);
        $query=$this->db->get('npwpd', $offset, $limit);
        return $query->result();
    }

    public function jumlah_cari_npwpd_aktif($npwpd,$nama,$alamat,$status)
    {
        $this->load->database();
        $query = $this->db->query("select NoID,ContactPerson,NPWPD,NamaWP,Kabupaten,Kelurahan,Provinsi,Kecamatan,AlamatWP,Status from npwpd where status='$status' and NPWPD like '%$npwpd%' and NamaWP like '%$nama%' and AlamatWP like '%$alamat%'");
        return $query->num_rows();
    }

    function nonpwpd()
    {
        $query=$this->db->query("select lpad(IFNULL(MAX(NoID),0)+1,4,'0') nomor FROM npwpd");
        return $query->result();
    }


    function carikodekab($kab)
    {
        $query=$this->db->query("select kodekab FROM kab where namakab='$kab'");
        return $query->result();
    }


    function carikodekec($kec)
    {
        $query=$this->db->query("select kodekec from kecamatan where namakec='$kec'");
        return $query->result();
    }

    function carikodekel($kec,$kel)
    {
        $query=$this->db->query("select kodekel from kecamatan where namakel='$kel' and namakec='$kec'");
        return $query->result();
    }   

    function insertnpwpd($NoID,$NPWPD,$NamaWP,$AlamatWP,$Provinsi,$Kabupaten,$Kecamatan,$Kelurahan)
    {

        $data_kategori = array ('NoID' => $NoID,'NPWPD' => $NPWPD,'NamaWP' => $NamaWP,'AlamatWP' => $AlamatWP,'Provinsi' => $Provinsi,'Kabupaten' => $Kabupaten,'Kecamatan'=>$Kecamatan,'Kelurahan'=>$Kelurahan);
        return $this->db->insert('npwpd',$data_kategori);
    } 

    function updatestatusnpwpd($NPWPD,$Status,$NamaWP,$AlamatWP) 
    {


        $data = array ('Status'=>$Status,'NamaWP'=>$NamaWP,'AlamatWP'=>$AlamatWP);

        $this->db->where('NPWPD', $NPWPD);
        $this->db->update('npwpd', $data);
    }

    
}
<?php
class Sptpd_model extends CI_Model {
    function __construct() 
    { 
        parent::__construct();
        $this->load->database();
    }  

    function insertsptpd($JenisPajak,$NamaPajak,$TanggalTerbit,$Bulan,$Tahun,$NPWPD,$NamaWP,$DataEntri,$TanggalEntri,$ObyekPajak,$RuasJalan,$KeteranganPajak,$Luas,$Lama,$Jumlah,$BatasWaktu,$Sisi,$JumlahPajak,$TotalNilai_SebelumPajak)
    {

        $data_kategori = array ('JenisPajak'=>$JenisPajak, 'NamaPajak'=> $NamaPajak,'TanggalTerbit'=> $TanggalTerbit,'Bulan'=> $Bulan,'Tahun'=> $Tahun,'NPWPD'=> $NPWPD,'NamaWP'=> $NamaWP,'DataEntri'=> $DataEntri,'TanggalEntri'=> $TanggalEntri,'ObyekPajak'=>$ObyekPajak,'RuasJalan'=>$RuasJalan,'KeteranganPajak'=>$KeteranganPajak,'Luas'=>$Luas,'Lama'=>$Lama,'Jumlah'=>$Jumlah,'BatasWaktu'=>$BatasWaktu,'Sisi'=>$Sisi,'JumlahPajak'=>$JumlahPajak,'TotalNilai_SebelumPajak'=>$TotalNilai_SebelumPajak);
        return $this->db->insert('sptpd',$data_kategori);
    } 

    function updateverifikasisptpd($Verifikasi,$NoID,$Verifikator,$TanggalVerifikasi) 
    {
        $data = array ('Verifikasi'=>$Verifikasi,'Verifikator'=>$Verifikator,'TanggalVerifikasi'=>$TanggalVerifikasi);
        $this->db->where('NoID', $NoID);
        $this->db->update('sptpd', $data);
    }   

    function editsptpd($NoID,$KeteranganPajak,$JumlahPajak) 
    {
        $data = array ('KeteranganPajak'=>$KeteranganPajak,'JumlahPajak'=>$JumlahPajak);
        $this->db->where('NoID', $NoID);
        $this->db->update('sptpd', $data);
    } 

    function editlunassptpd($NoID) 
    {
        $data = array ('Lunas'=>1);
        $this->db->where('NoID', $NoID);
        $this->db->update('sptpd', $data);
    } 


    function get_jenispajak()
    {
        /*    dimas
        **    
        **    update jenis pajak ke kode rekening Sen 04 Des 2017 09:53:46  WIB
        */
        //$query=$this->db->query("SELECT koderekening,uraian,pajak FROM koderekening WHERE pajak=1");
        $query=$this->db->query("SELECT koderekening,uraian,pajak FROM koderekening WHERE pajak=0");
        return $query->result();
    }

    function get_namajenispajak($kodepajak)
    {
        $query=$this->db->query("SELECT uraian FROM koderekening WHERE koderekening='$kodepajak'");
        return $query->result();
    }

    public function terbilang($x){
        $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($x < 12)
        return " " . $abil[$x];
        elseif ($x < 20)
        return $this->terbilang($x - 10) . " belas";
        elseif ($x < 100)
        return $this->terbilang($x / 10) . " puluh" . $this->terbilang($x % 10);
        elseif ($x < 200)
        return " seratus" . $this->terbilang($x - 100);
        elseif ($x < 1000)
        return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
        elseif ($x < 2000)
        return " seribu" . $this->terbilang($x - 1000);
        elseif ($x < 1000000)
        return $this->terbilang($x / 1000) . " ribu" . $this->terbilang($x % 1000);
        elseif ($x < 1000000000)
        return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);
        //DIMAS UPDATE 18 SEPTEMBER 2017
        elseif ($x < 10000000000)
        return $this->terbilang($x / 1000000000) . " miliar" . $this->terbilang($x % 1000000000);
        /*    dimas
        **    
        **    update terbilang untuk PPJ Sen 04 Des 2017 10:13:10  WIB
        */
        // elseif ($x < 1000000)
        // return $this->terbilang($x / 1000) . " juta" . $this->terbilang($x % 1000);
        // elseif ($x < 20000000)
        // return $this->terbilang($x / 10000) . " puluh juta" . $this->terbilang($x % 10000);
        // elseif ($x < 200000000)
        // return $this->terbilang($x / 100000) . " ratus juta" . $this->terbilang($x % 100000);
        // elseif ($x < 2000000000)
        // return $this->terbilang($x / 1000000000) . " milyar" . $this->terbilang($x % 1000000000);
    }

    function get_bulan()
    {
        $query=$this->db->query("SELECT NoID,namabulan FROM bulan order by NoID asc");
        return $query->result();
    }

    function get_tahun()
    {
        $query=$this->db->query("SELECT distinct(Tahun) as Tahun FROM sptpd");
        return $query->result();
    }    


    function jumlah_cari_sptpd($verifikasi,$aktif)
    {
        $query=$this->db->query("SELECT NoID,JenisPajak,NamaPajak,TanggalTerbit,Bulan,Tahun,NPWPD,NamaWP,DataEntri,TanggalEntri,Verifikasi,Aktif,ObyekPajak,RuasJalan,KeteranganPajak,JumlahPajak,Verifikator,NoSPTLama FROM sptpd WHERE Aktif=".$aktif." and Verifikasi=".$verifikasi);
        return $query->num_rows();
    }

    public function cari_sptpd($DataEntri,$nomorspt,$jenis,$bulan,$tahun,$verifikasi,$aktif,$lunas,$NoSPTLama=null)
    {
        $this->db->select('NoID,JenisPajak,NamaPajak,TanggalTerbit,Bulan,Tahun,NPWPD,NamaWP,DataEntri,TanggalEntri,Verifikasi,Aktif,ObyekPajak,RuasJalan,KeteranganPajak,JumlahPajak,Verifikator,NoSPTLama');
        $this->db->like("NoID",$nomorspt);
        $this->db->like("JenisPajak",$jenis);
        $this->db->like("Bulan",$bulan); 
        $this->db->like("Tahun",$tahun);  
        $this->db->like("DataEntri",$DataEntri); 
        $this->db->like("NoSPTLama",$NoSPTLama);        
        $this->db->where("Aktif",$aktif);
        $this->db->where("Verifikasi",$verifikasi);     
        $this->db->where("Lunas",$lunas);                           
        $this->db->order_by("NoID", "desc");
        $query=$this->db->get('sptpd');
        return $query->result();

    }

    public function jumlah_cari_sptpd_belum($nomorspt,$jenis,$bulan,$tahun,$verifikasi,$aktif)
    {
        $this->load->database();
        $query = $this->db->query("select NoID,JenisPajak,NamaPajak,TanggalTerbit,Bulan,Tahun,NPWPD,NamaWP,DataEntri,TanggalEntri,Verifikasi,Aktif,ObyekPajak,RuasJalan,KeteranganPajak,JumlahPajak,Verifikator from sptpd where Verifikasi=$verifikasi and NoSPT like '%$nomorspt%' and JenisPajak like '%$jenis%' and Tahun = '$tahun' and Bulan='$bulan'");
        return $query->num_rows();
    }

    function data_ruasjalan()
    {
        $query=$this->db->query("SELECT NoID,kodezona,ruasjalan FROM zona_strategis order by NoID asc");
        return $query->result();
    }

    function cari_data_sptpd($SPTPD)
    {
        $query=$this->db->query("SELECT NoID,JenisPajak,NamaPajak,TanggalTerbit,Bulan,Tahun,NPWPD,NamaWP,DataEntri,TanggalEntri,Verifikasi,Aktif,ObyekPajak,RuasJalan,KeteranganPajak,JumlahPajak,Verifikator FROM sptpd WHERE NoID='$SPTPD'");
        return $query->result();
    } 



    
    
}

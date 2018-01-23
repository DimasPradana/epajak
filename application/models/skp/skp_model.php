<?php
class Skp_model extends CI_Model {
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

    public function cari_skp($DataEntri,$nomorskp,$nomorsptpd,$verifikasi,$aktif,$lunas)
    {
        $this->db->select('TahunSPTPD,Verifikator,TanggalVerifikasi,NamaWP,Nomor_SKPRD,Tanggal_Terbit,Bulan,Tahun,Nomor_SPTPD,KeteranganPajak,JumlahPajak,DataEntri,TanggalEntri,JenisPajak,NamaPajak,Verifikasi,Aktif');
        $this->db->like("Nomor_SKPRD",$nomorskp);
        $this->db->like("Nomor_SPTPD",$nomorsptpd);         
        $this->db->where("Aktif",$aktif);
        $this->db->where("Verifikasi",$verifikasi);
        $this->db->where("Lunas",$lunas);  
        $this->db->where("DataEntri",$DataEntri);               
        $this->db->order_by("Nomor_SKPRD", "desc");
        $query=$this->db->get('view_skp');
        return $query->result();

    } 

    function get_nobayar()
    {
        $query=$this->db->query("select max(NoBayar) as max from skp");
        return $query->result();
    }

    function updatebayar($Nomor_SKPRD,$NoBayar,$TglBayar,$Penyetor,$Denda) 
    {
        $data = array ('NoBayar'=>$NoBayar,'TglBayar'=>$TglBayar,'Penyetor'=>$Penyetor,'Denda'=>$Denda,'Lunas'=>1);
        $this->db->where('Nomor_SKPRD', $Nomor_SKPRD);
        $this->db->update('skp', $data);
    }    

    function updatebayar2($Nomor_SKPRD,$Penyetor,$Denda) 
    {
        $data = array ('Denda'=>$Denda,'Penyetor'=>$Penyetor);
        $this->db->where('Nomor_SKPRD', $Nomor_SKPRD);
        $this->db->update('skp', $data);
    }    


    function updateverifikasiskp_NonAktif($NoSKP) 
    {
        $data = array ('Aktif'=>0, 'Verifikasi'=>0,'Verifikator'=>null,'TanggalVerifikasi'=>null,'Nomor_SPTPD'=>null, 'Nomor_SPTPD_Lama'=>null);
        $this->db->where('Nomor_SKPRD', $NoSKP);
        $this->db->update('skp', $data);
    }       



    function updateverifikasiskp_Aktif2($NoSKP,$Verifikator,$TanggalVerifikasi) 
    {
        



        $data = array ('Verifikasi'=>1,'Verifikator'=>$Verifikator,'TanggalVerifikasi'=>$TanggalVerifikasi);
        $this->db->where('Nomor_SKPRD', $NoSKP);
        $this->db->where('Verifikasi', 0);
        $this->db->update('skp', $data);

       



    }   

    function updateverifikasiskp_Aktif($NoSKP,$NoSPTPD,$Verifikator,$TanggalVerifikasi) 
    {
        

        if($NoSPTPD<>"")
        {
            $this->db->select('Nomor_SKPRD,Nomor_SPTPD');
            $this->db->where("Nomor_SPTPD",$NoSPTPD);
            $query=$this->db->get('carisptpd_skp');

            if($query->num_rows<>0)
            {
                echo "<script>alert('Nomor SPTPD tidak diketemukan atau sudah digunakan');</script>";
            }
            else
            {
                $data = array ('Verifikasi'=>1,'Verifikator'=>$Verifikator,'TanggalVerifikasi'=>$TanggalVerifikasi);
                $this->db->where('Nomor_SKPRD', $NoSKP);
                $this->db->update('skp', $data);
            }
        }
        else
        {
            echo "<script>alert('Nomor SPTPD tidak diketemukan atau sudah digunakan');</script>";
        }        



    }     

    function insertskp($Tanggal_Terbit,$Bulan,$Tahun,$Nomor_SPTPD,$DataEntri,$TanggalEntri,$MasaTgl1,$MasaTgl2)
    {

        $data_kategori = array ('masa1'=>$MasaTgl1,'masa2'=>$MasaTgl2, 'Tanggal_Terbit'=>$Tanggal_Terbit,'Bulan'=>$Bulan,'Tahun'=>$Tahun,'Nomor_SPTPD'=>$Nomor_SPTPD,'DataEntri'=>$DataEntri,'TanggalEntri'=>$TanggalEntri);
        return $this->db->insert('skp',$data_kategori);
    }     


    function get_jenispajak()
    {
        $query=$this->db->query("SELECT koderekening,uraian,pajak FROM koderekening WHERE pajak=1");
        return $query->result();
    }



    function get_bulan()
    {
        $query=$this->db->query("SELECT NoID,namabulan FROM bulan order by NoID asc");
        return $query->result();
    }

    function get_tahun()
    {
        $query=$this->db->query("SELECT distinct(Tahun) as Tahun FROM skp");
        return $query->result();
    }    





    
    
}
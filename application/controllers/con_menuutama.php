<?php
class Con_menuutama extends CI_Controller{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('index');
    }

    public function logout() 
    {
        session_start();
        $this->load->view('index');
        session_destroy();
    }



    public function operasibendahara() 
    {
        if($this->input->post('verifikasiskp') ) 
        {
            $SKPAktif= $this->input->post('SKPAktif');
            $VerifikatorAktif= $this->input->post('VerifikatorAktif');
            $TglVeriAktif= $this->input->post('TglVeriAktif');

            $this->load->model('skp/skp_model');
            $this->skp_model->updateverifikasiskp_Aktif2($SKPAktif,$VerifikatorAktif,$TglVeriAktif);

            $this->bendahara();

        }

        elseif($this->input->post('Refresh') ) 
        {
            $this->bendahara();
        }

        elseif($this->input->post('cetak2') ) 
        {

            $this->load->model('skp/skp_model');
            $this->load->model('sptpd/sptpd_model');

            $Denda = $this->input->post('Dendadatapembayaran');  
            $SKPCari = $this->input->post('NoSKPdatapembayaran');

            $NoUrut = $this->input->post('NoBayardatapembayaran');

            $this->db->select('Nomor_SPTPD,TglBayar,Penyetor');
            $this->db->where("Nomor_SKPRD",$SKPCari);
            $query=$this->db->get('skp');

            foreach ($query->result() as $value) 
            {
                $Nomor_SPTPD =$value->Nomor_SPTPD;
                $TglBayar=$value->TglBayar;
                $Penyetor=$value->Penyetor;
            }

            $this->db->select('JumlahPajak,NPWPD,NamaWP,KeteranganPajak,Bulan,Tahun,JenisPajak,ObyekPajak');
            $this->db->where("NoID",$Nomor_SPTPD);
            $query2=$this->db->get('sptpd');

            foreach ($query2->result() as $value2) 
            {
                $JumlahPajak =$value2->JumlahPajak;
                $NPWPD=$value2->NPWPD;
                $NamaWP=$value2->NamaWP;
                $KeteranganPajak=$value2->KeteranganPajak;
                $Bulan=$value2->Bulan;
                $Tahun=$value2->Tahun;
                $JenisPajak=$value2->JenisPajak;
                $ObyekPajak=$value2->ObyekPajak;
            }

            $this->db->select('NoID,RekeningInduk');
            $this->db->where("NoID",$ObyekPajak);
            $query212=$this->db->get('tarif_dasar_pajak');

            foreach ($query212->result() as $value212) {
                $RekeningInduk = $value212->RekeningInduk;   
            } 



            $data['RekeningInduk']=$RekeningInduk;

            $data['buktibayar']=$NoUrut;
            $data['JumlahBayar']=$JumlahPajak+$Denda;

            $data['NoBayar']=$NoUrut;


            $data['JenisPajak']=$JenisPajak;
            $data['terbilang']=ucwords($this->sptpd_model->terbilang($JumlahPajak+$Denda));

            $data['NPWPD']=$NPWPD;
            $data['NamaWP']=$NamaWP;
            $data['KeteranganPajak']=$KeteranganPajak;
            $data['Masa']=$Bulan." ".$Tahun;
            $data['JumlahPajak']=$JumlahPajak;
            $data['Denda']=$Denda;
            $data['TglBayar']=date('d-m-Y',strtotime($TglBayar));            


            $data['Denda']=$Denda;

            $data['Penyetor']=$this->input->post('penyetordatapembayaran');

            $this->skp_model->updatebayar2($SKPCari,$this->input->post('penyetordatapembayaran'),$Denda);



            $output = $this->load->view('bendahara/bendahara_cetak',$data);            
        }        

        elseif($this->input->post('cetak') ) 
        {


            $data['Penyetor']=$this->input->post('penyetor');

            $TglBayar = $this->input->post('tglbayar');
            $Penyetor = $this->input->post('penyetor');
            $Denda = $this->input->post('Denda');  
            $SKPCari = $this->input->post('SKPCari');  


            $this->load->model('skp/skp_model');
            $this->load->model('sptpd/sptpd_model');

            $nomax= $this->skp_model->get_nobayar();

            foreach( $nomax as $_nomax)
            {
                $nomor= $_nomax->max;
            }  

            $nomor=(int)$nomor; 

            $nomor++;

            $NoUrut=str_pad($nomor, 7, '0', STR_PAD_LEFT);

            $this->skp_model->updatebayar($SKPCari,$NoUrut,$TglBayar,$Penyetor,$Denda);


            $this->db->select('Nomor_SPTPD');
            $this->db->where("Nomor_SKPRD",$SKPCari);
            $query=$this->db->get('skp');

            foreach ($query->result() as $value) 
            {
                $Nomor_SPTPD =$value->Nomor_SPTPD;
            }

            $this->db->select('JumlahPajak,NPWPD,NamaWP,KeteranganPajak,Bulan,Tahun,JenisPajak,ObyekPajak');
            $this->db->where("NoID",$Nomor_SPTPD);
            $query2=$this->db->get('sptpd');

            foreach ($query2->result() as $value2) 
            {
                $JumlahPajak =$value2->JumlahPajak;
                $NPWPD=$value2->NPWPD;
                $NamaWP=$value2->NamaWP;
                $KeteranganPajak=$value2->KeteranganPajak;
                $Bulan=$value2->Bulan;
                $Tahun=$value2->Tahun;
                $JenisPajak=$value2->JenisPajak;
                $ObyekPajak=$value2->ObyekPajak;
            }

            $this->sptpd_model->editlunassptpd($Nomor_SPTPD);

            $this->db->select('NoID,RekeningInduk');
            $this->db->where("NoID",$ObyekPajak);
            $query212=$this->db->get('tarif_dasar_pajak');

            foreach ($query212->result() as $value212) {
                $RekeningInduk = $value212->RekeningInduk;   
            }        

            $data['RekeningInduk']=$RekeningInduk;

            $data['NoBayar']=$NoUrut;

            $data['buktibayar']=$NoUrut;
            $data['JumlahBayar']=$JumlahPajak+$Denda;

            $data['JenisPajak']=$JenisPajak;
            $data['terbilang']=ucwords($this->sptpd_model->terbilang($JumlahPajak+$Denda));

            $data['NPWPD']=$NPWPD;
            $data['NamaWP']=$NamaWP;
            $data['KeteranganPajak']=$KeteranganPajak;
            $data['Masa']=$Bulan." ".$Tahun;
            $data['JumlahPajak']=$JumlahPajak;
            $data['Denda']=$Denda;
            $data['TglBayar']=date('d-m-Y',strtotime($TglBayar));

            $output = $this->load->view('bendahara/bendahara_cetak',$data);


        }
    }

    public function hitungdenda($no="",$tglbayar="")
    {
        if($no<>"")
        {

            $this->db->select('Nomor_SPTPD,masa1,masa2');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->Nomor_SPTPD;
                    $masa1 =$value->masa1;
                    $masa2 =$value->masa2;
                }

                $this->db->select('BatasWaktu,TanggalTerbit,JumlahPajak,JenisPajak');
                $this->db->where("NoID",$data);
                $query2=$this->db->get('sptpd');

                foreach ($query2->result() as $value2) 
                {
                    $BatasWaktu =$value2->BatasWaktu;
                    $TanggalTerbit=$value2->TanggalTerbit;
                    $JumlahPajak=$value2->JumlahPajak;
                    $JenisPajak=$value2->JenisPajak;
                }
                /*    dimas
                 **    
                 **    update jenis pajak menjadi kode rekening Sen 04 Des 2017 09:45:45  WIB
                 */
                if($JenisPajak=="4.1.1.08.01" or $JenisPajak=="4.1.1.02.05" or $JenisPajak=="4.1.2.02.01")
                    //if($JenisPajak=="4.1.1.08")

                {
                    $data="0";
                }
                else
                {

                    if($masa2=="")
                    {
                        $awal  = date_create($tglbayar);
                        $akhir = date_create($TanggalTerbit); // waktu sekarang
                        $diff  = date_diff( $awal, $akhir );
                        /*    dimas
                         **    
                         **    update denda Min 03 Des 2017 04:20:07  WIB
                         */
                        /*$selisih=($diff->days)/30;
                          $selisih=(int)$selisih;*/
                        $selisih=$diff->days;
                        $selisih=(int)$selisih;
                        $prosendenda = $selisih * 0.02;
                        $denda=$prosendenda*$JumlahPajak;
                        $denda=(int)$denda;                    
                        $data=$denda;

                    }
                    else
                    {

                        $awal  = date_create($tglbayar);
                        $akhir = date_create($masa2); // waktu sekarang
                        $diff  = date_diff( $awal, $akhir );
                        /*    dimas
                         **    
                         **    update denda Min 03 Des 2017 04:20:25  WIB
                         */
                        /*$selisih=($diff->days)/30;
                          $selisih=(int)$selisih;
                          $prosendenda = $selisih * 0.02;
                          $denda=$prosendenda*$JumlahPajak;
                          $denda=(int)$denda;
                          $data=$denda;*/
                        $selisih=$diff->format('%MM');
                        $selisih=(int)$selisih;
                        $prosendenda = $selisih*0.02;
                        $denda=$prosendenda*$JumlahPajak;
                        $denda=(int)$denda;
                        $data=$denda;
                    }
                }
            }
            else
            {
                $data="0";
            }            
        }
        else
        {
            $data="0";
        }
        echo $data;

    }


    public function keteranganku($no="")
    {
        if($no<>"")
        {

            $this->db->select('Nomor_SPTPD');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",0);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->Nomor_SPTPD;
                }

                $this->db->select('KeteranganPajak');
                $this->db->where("NoID",$data);
                $query2=$this->db->get('sptpd');

                foreach ($query2->result() as $value2) 
                {
                    $data =$value2->KeteranganPajak;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }


    public function keterangan2($no="")
    {
        if($no<>"")
        {

            $this->db->select('Nomor_SPTPD');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->Nomor_SPTPD;
                }

                $this->db->select('KeteranganPajak');
                $this->db->where("NoID",$data);
                $query2=$this->db->get('sptpd');

                foreach ($query2->result() as $value2) 
                {
                    $data =$value2->KeteranganPajak;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }


    public function caribataswaktu2($no="")
    {
        if($no<>"")
        {

            $this->db->select('Nomor_SPTPD');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->Nomor_SPTPD;
                }

                $this->db->select('BatasWaktu,TanggalTerbit');
                $this->db->where("NoID",$data);
                $query2=$this->db->get('sptpd');

                foreach ($query2->result() as $value2) 
                {
                    $BatasWaktu =$value2->BatasWaktu;
                    $TanggalTerbit =$value2->TanggalTerbit;
                }

                if($BatasWaktu=="")
                {
                    $data=$TanggalTerbit;
                }
                else
                {
                    $data=$BatasWaktu;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }  


    public function jumlahpajakku($no="")
    {
        if($no<>"")
        {

            $this->db->select('Nomor_SPTPD');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",0);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->Nomor_SPTPD;
                }

                $this->db->select('JumlahPajak');
                $this->db->where("NoID",$data);
                $query2=$this->db->get('sptpd');

                foreach ($query2->result() as $value2) 
                {
                    $data =$value2->JumlahPajak;
                    $data=number_format($data,2,",",".");
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }  



    public function jumlahpajak2($no="")
    {
        if($no<>"")
        {

            $this->db->select('Nomor_SPTPD');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->Nomor_SPTPD;
                }

                $this->db->select('JumlahPajak');
                $this->db->where("NoID",$data);
                $query2=$this->db->get('sptpd');

                foreach ($query2->result() as $value2) 
                {
                    $data =$value2->JumlahPajak;
                    $data=number_format($data,2,",",".");
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }



    public function caritglterbitku($no="")
    {
        if($no<>"")
        {

            $this->db->select('Tanggal_Terbit');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",0);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->Tanggal_Terbit;
                }

            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }


    public function caritglterbit2($no="")
    {
        if($no<>"")
        {

            $this->db->select('Nomor_SPTPD,masa1');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->Nomor_SPTPD;
                    $masa1 =$value->masa1;
                }



                $this->db->select('TanggalTerbit');
                $this->db->where("NoID",$data);
                $query2=$this->db->get('sptpd');

                foreach ($query2->result() as $value2) 
                {
                    $data =$value2->TanggalTerbit;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }

    public function caridataentriku($no="")
    {
        if($no<>"")
        {

            $this->db->select('DataEntri');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",0);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->DataEntri;
                }

            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }

    public function cariwpku($no="")
    {
        if($no<>"")
        {

            $this->db->select('Nomor_SPTPD');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",0);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->Nomor_SPTPD;
                }

                $this->db->select('NamaWP');
                $this->db->where("NoID",$data);
                $query2=$this->db->get('sptpd');

                foreach ($query2->result() as $value2) 
                {
                    $data =$value2->NamaWP;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }


    public function cariwp2($no="")
    {
        if($no<>"")
        {

            $this->db->select('Nomor_SPTPD');
            $this->db->where("Nomor_SKPRD",$no);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $this->db->where("Lunas",0);
            $query=$this->db->get('skp');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->Nomor_SPTPD;
                }

                $this->db->select('NamaWP');
                $this->db->where("NoID",$data);
                $query2=$this->db->get('sptpd');

                foreach ($query2->result() as $value2) 
                {
                    $data =$value2->NamaWP;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }

    public function tulis_keterangan($kode) 
    {

        $teks= explode("c",$kode);

        $kodeobyek=$teks[0];
        $koderuas=$teks[1];
        $sisi=$teks[2];
        $luas=$teks[3];
        $jumlahsatuan=$teks[4];
        $jumlahreklame=$teks[5];
        $nilaipajak=$teks[6];
        $lebar=$teks[7];


        if($kodeobyek=="" || $kodeobyek==-1)
        {
            $kodeobyek="0";
        }

        if($koderuas=="" || $koderuas==-1)
        {
            $koderuas="0";
        }

        if($sisi=="")
        {
            $sisi="0";
        }

        if($luas=="")
        {
            $luas="0";
        }

        if($jumlahsatuan=="")
        {
            $jumlahsatuan="0";
        }        


        if($jumlahreklame=="")
        {
            $jumlahreklame="0";
        }

        if($nilaipajak=="")
        {
            $nilaipajak="0";
        }

        $this->db->select('ObyekPajak,Zona1,Zona2,Zona3,NJOP,Prosentase,SatuanMasa,RekeningInduk,JenisPajak');
        $this->db->where("NoID",$kodeobyek);
        $query=$this->db->get('tarif_dasar_pajak');

        if($query->num_rows<>0)
        {
            foreach ($query->result() as $value) 
            {
                $obyekpajak = $value->ObyekPajak;
                $Zona1 = $value->Zona1;
                $Zona2 = $value->Zona2;
                $Zona3 = $value->Zona3;
                $NJOP= $value->NJOP;
                $Prosentase=$value->Prosentase;
                $SatuanMasa=$value->SatuanMasa;
                $RekeningInduk=$value->RekeningInduk;
                $JenisPajak=$value->JenisPajak;
            }
        }
        else
        {
            $obyekpajak="";
            $Zona1 = 0;
            $Zona2 = 0;
            $Zona3 = 0;
            $NJOP= 0;
            $Prosentase=0;
            $SatuanMasa="";
            $RekeningInduk="";
            $JenisPajak="";
        }


        if($JenisPajak=="")
        {
            $obyekpajak= "";
            $ruasjalan="";
        }
        else
        {
            if($koderuas<>"0")
            {
                $this->db->select('ruasjalan,kodezona');
                $this->db->where("NoID",$koderuas);
                $query=$this->db->get('zona_strategis');


                foreach ($query->result() as $value) 
                {

                    if($value->kodezona=="1")
                    {
                        $nilaistrategis=$Zona1;
                    }
                    elseif($value->kodezona=="2")
                    {
                        $nilaistrategis=$Zona2;
                    }
                    elseif($value->kodezona=="3")
                    {
                        $nilaistrategis=$Zona3;
                    }
                    else
                    {
                        $nilaistrategis=0;
                    }

                    $totalreklame=(($nilaistrategis+$NJOP)*$Prosentase)/100;

                    $ruasjalan = " di ". $value->ruasjalan." = ".$sisi." sisi x Rp ". number_format($totalreklame,2,",",".")." x panjang ". number_format($luas,2,",",".") ." m x lebar " . number_format($lebar,2,",",".") ." m x ". $jumlahsatuan ." ".$SatuanMasa." x ".$jumlahreklame." unit";
                }


            }
            else
            {

                $this->db->select('JenisPajak');
                $this->db->where("NoID",$kodeobyek);
                $query2=$this->db->get('tarif_dasar_pajak');

                foreach ($query2->result() as $value2) 
                {
                    $JenisPajak=$value2->JenisPajak;
                }



                if($JenisPajak=="Pajak Air Tanah" ||  $JenisPajak=="Pajak Mineral Bukan Logam dan Batuan")
                {
                    $ruasjalan=" (".$jumlahsatuan ." ".$SatuanMasa." x Rp ".number_format($NJOP,2,",",".")." x ".$Prosentase." %)";
                }
                // elseif($JenisPajak=="Pajak Hotel" || $JenisPajak=="Pajak Restoran" || $JenisPajak=="Pajak Hiburan" || $JenisPajak=="Pajak Parkir") //DIMAS 18 SEPTEMBER 2017
                elseif($JenisPajak=="Pajak Hotel" || $JenisPajak=="Pajak Restoran" || $JenisPajak=="Pajak Hiburan" || $JenisPajak=="Pajak Parkir" || $JenisPajak =="Pajak Penerangan Jalan")
                {
                    $ruasjalan=" (Rp ".number_format($nilaipajak,2,",",".")." x ".$Prosentase." %)";
                }
                elseif($JenisPajak=="Retribusi Pemakaian Kekayaan Daerah" )
                {
                    $ruasjalan=" = Rp ".number_format($nilaipajak,2,",",".");
                }
                else
                {
                    $ruasjalan="";
                } 


            }

            //echo $obyekpajak.$ruasjalan;
        }

        echo $obyekpajak.$ruasjalan;


    } 


    public function add_null($kode) 
    {
        echo $kode;
    }    

    public function add_ruas($kode) 
    {
        if($kode!="4.1.1.04")
        {
            $data="<option value=-1>- Ruas Jalan -</option>";
        }
        else
        {
            $this->db->select('NoID,kodezona,ruasjalan');
            $this->db->order_by("NoID", "asc");
            $query=$this->db->get('zona_strategis');

            $data = "<option value=-1>- Ruas Jalan -</option>";
            foreach ($query->result() as $value) {
                $data .= "<option value='".$value->NoID."'>".$value->ruasjalan."</option>";
            }

        }

        echo $data;

    }    



    public function add_njop($kode) 
    {
        if($kode==-1)
        {
            $data=0;
        }
        else
        {
            $this->db->select('NJOP');
            $this->db->where("NoID",$kode);
            $query=$this->db->get('tarif_dasar_pajak');

            foreach ($query->result() as $value) {
                $data= $value->NJOP;
            }

        }

        echo $data;

    }    


    public function carinilaistrategis2($kode) 
    {

        $teks= explode("c",$kode);

        $this->db->select('kodezona');
        $this->db->where("NoID",$teks[1]);
        $query=$this->db->get('zona_strategis');

        foreach ($query->result() as $value) {
            $kodezona= $value->kodezona;
        }  


        if($query->num_rows==0)   
        {
            $data=0;
        }  
        else
        {

            $kodeobyek= $teks[0];



            $this->db->select('Zona1,Zona2,Zona3');
            $this->db->where("NoID",$kodeobyek);
            $query=$this->db->get('tarif_dasar_pajak');

            if($kodezona==1 && $query->num_rows<>0)
            {
                foreach ($query->result() as $value) {
                    $data= $value->Zona1;
                } 
            }
            elseif ($kodezona==2 && $query->num_rows<>0) 
            {
                foreach ($query->result() as $value) {
                    $data= $value->Zona2;
                }
            }
            elseif ($kodezona==3 && $query->num_rows<>0)
            {
                foreach ($query->result() as $value) {
                    $data= $value->Zona3;
                }
            }
            else
            {
                $data=0;
            }

        }  




        echo $data;

    }

    public function carinilaistrategis($kode) 
    {
        if($kode==-1)
        {
            $data=0;
        }
        else
        {



            $this->db->select('kodezona');
            $this->db->where("NoID",$kode);
            $query=$this->db->get('zona_strategis');

            foreach ($query->result() as $value) 
            {
                $data= $value->kodezona;
            } 


        }

        echo $data;

    }


    public function add_satuan($kodepajak) 
    {
        if($kodepajak==-1)
        {
            $data="";
        }
        else
        {
            $this->db->select('NoID,SatuanMasa');
            $this->db->where("NoID",$kodepajak);
            $query=$this->db->get('tarif_dasar_pajak');

            foreach ($query->result() as $value) {
                $data= $value->SatuanMasa;
            }            
        }

        echo $data;

    }


    public function add_prosentase($kodepajak) 
    {
        if($kodepajak==-1)
        {
            $data=0;
        }
        else
        {
            $this->db->select('NoID,Prosentase');
            $this->db->where("NoID",$kodepajak);
            $query=$this->db->get('tarif_dasar_pajak');

            foreach ($query->result() as $value) {
                $data= $value->Prosentase;
            }            
        }

        echo $data;

    }

    public function add_objek($koderek) 
    {

        $this->db->select('NoID,JenisPajak,ObyekPajak,Prosentase,NilaiSatuan,SatuanMasa,NJOP,RekeningInduk,Zona1,Zona2,Zona3');
        $this->db->like("RekeningInduk",$koderek);
        $this->db->order_by("ObyekPajak", "asc");
        $query=$this->db->get('tarif_dasar_pajak');

        $data = "<option value=-1>- Obyek Pajak -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->NoID."'>".$value->ObyekPajak."</option>";
        }





        echo $data;
    }


    public function tulisnol()
    {
        echo 0;
    }

    public function cariwp212($npwp="") 
    {
        if($npwp<>"")
        {

            $this->db->select('NamaWP');
            $this->db->where("NPWPD",$npwp);
            $this->db->where("Status","Terverifikasi");
            $query=$this->db->get('npwpd');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->NamaWP;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    } 

    public function cariwp($sptpd="") 
    {
        if($sptpd<>"")
        {

            $this->db->select('NamaWP');
            $this->db->where("NoID",$sptpd);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $query=$this->db->get('sptpd');

            if($query->num_rows<>0)
            {

                foreach ($query->result() as $value) 
                {
                    $data =$value->NamaWP;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    } 


    public function cariketerangan($sptpd="") 
    {
        if($sptpd<>"")
        {

            $this->db->select('KeteranganPajak');
            $this->db->where("NoID",$sptpd);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $query=$this->db->get('sptpd');

            if($query->num_rows<>0)
            {
                foreach ($query->result() as $value) 
                {
                    $data =$value->KeteranganPajak;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    } 

    public function carijumlahpajak($sptpd="") 
    {
        if($sptpd<>"")
        {

            $this->db->select('JumlahPajak');
            $this->db->where("NoID",$sptpd);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $query=$this->db->get('sptpd');

            if($query->num_rows<>0)
            {
                foreach ($query->result() as $value) 
                {
                    $data = number_format($value->JumlahPajak,2,",",".");
                }
            }
            else
            {
                $data="0";
            }            
        }
        else
        {
            $data="0";
        }
        echo $data;
    }     

    public function caritanggalterbit($sptpd="") 
    {
        if($sptpd<>"")
        {

            $this->db->select('TanggalTerbit');
            $this->db->where("NoID",$sptpd);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $query=$this->db->get('sptpd');

            if($query->num_rows<>0)
            {
                foreach ($query->result() as $value) 
                {
                    $data = $value->TanggalTerbit;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }

    public function caritanggalmasa2($sptpd="") 
    {
        if($sptpd<>"")
        {

            $this->db->select('BatasWaktu');
            $this->db->where("NoID",$sptpd);
            $this->db->where("Verifikasi",1);
            $this->db->where("Aktif",1);
            $query=$this->db->get('sptpd');

            if($query->num_rows<>0)
            {
                foreach ($query->result() as $value) 
                {
                    $data = $value->BatasWaktu;
                }
            }
            else
            {
                $data="";
            }            
        }
        else
        {
            $data="";
        }
        echo $data;
    }    


    public function loadbendahara() 
    {
        $this->load->library('session');
        $namauser=$this->session->userdata('Nama');



        $this->load->model('pegawai/pegawai_model');
        $data['listdata'] = $this->pegawai_model->data_user($namauser);

        $data['Nama'] = $this->session->userdata('Nama');

        $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
        if ($q->num_rows() == 1) 
        {
            $wewenang=$q->row()->Wewenang;
        }

        $this->load->view('header/header',$data);




        $menuku="";

        $wewenang_reporteditor=substr($wewenang,0,1);

        if($wewenang_reporteditor==1)
        {
            $menuku .="Report Editor, ";
            $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
        }
        else
        {
            $data['menure']="";      
        }

        $wewenang_manajemenuser=substr($wewenang,1,1);

        if($wewenang_manajemenuser==1)
        {
            $menuku .="Manajemen User, ";
            $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
        }
        else
        {
            $data['menumu']="";      
        }

        $wewenang_npwp=substr($wewenang,2,1);

        if($wewenang_npwp==1)
        {
            $menuku .="Pendaftaran NPWPD, ";
            $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
        }
        else
        {
            $data['menunpwp']="";      
        }

        $wewenang_spt=substr($wewenang,3,1);

        if($wewenang_spt==1)
        {
            $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
            $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
        }
        else
        {
            $data['menuspt']="";      
        }       

        $wewenang_skp=substr($wewenang,4,1);

        if($wewenang_skp==1)
        {
            $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
            $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
        }
        else
        {
            $data['menuskp']="";      
        }

        $wewenang_bendahara=substr($wewenang,5,1);

        if($wewenang_bendahara==1)
        {
            $menuku .="Bendahara, ";
            $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
        }
        else
        {
            $data['menubendahara']="";      
        }    

        $wewenang_dash=substr($wewenang,6,1);

        if($wewenang_dash==1)
        {
            $menuku .="Dashboard, ";
            $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
        }
        else
        {
            $data['menudash']="";      
        }    

        $wewenang_hapusspt=substr($wewenang,7,1);

        if($wewenang_hapusspt==1)
        {
            $menuku .="Hapus SPT, ";


            $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

        }
        else
        {
            $data['hapusspt']="";      
        }   

        $wewenang_verispt=substr($wewenang,8,1);

        if($wewenang_verispt==1)
        {
            $menuku .="Verifikasi SPT, ";


            $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['verispt']="";      
        }     

        $wewenang_veriskp=substr($wewenang,9,1);

        if($wewenang_veriskp==1)
        {
            $menuku .="Verifikasi SKP, ";


            $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['veriskp']="";      
        }               

        $this->load->model('skp/skp_model');

        $data['daftarbayar'] = $this->skp_model->daftarbayar();


        $data["menuku"]=$menuku;
        $this->load->view('menu',$data);








        $this->load->view('bendahara/bendahara',$data);
        $this->load->view('header/footer',$data);

        $this->load->library('session');
        $data = array('data'=>$namauser); //set it
        $this->session->set_userdata($data);


    }


    public function bendahara() 
    {
        $this->load->library('session');
        $namauser=$this->session->userdata('Nama');



        $this->load->model('pegawai/pegawai_model');
        $data['listdata'] = $this->pegawai_model->data_user($namauser);

        $data['Nama'] = $this->session->userdata('Nama');

        $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
        if ($q->num_rows() == 1) 
        {
            $wewenang=$q->row()->Wewenang;
        }

        $this->load->view('header/header',$data);


        $menuku="";

        $wewenang_reporteditor=substr($wewenang,0,1);

        if($wewenang_reporteditor==1)
        {
            $menuku .="Report Editor, ";
            $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
        }
        else
        {
            $data['menure']="";      
        }

        $wewenang_manajemenuser=substr($wewenang,1,1);

        if($wewenang_manajemenuser==1)
        {
            $menuku .="Manajemen User, ";
            $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
        }
        else
        {
            $data['menumu']="";      
        }

        $wewenang_npwp=substr($wewenang,2,1);

        if($wewenang_npwp==1)
        {
            $menuku .="Pendaftaran NPWPD, ";
            $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
        }
        else
        {
            $data['menunpwp']="";      
        }

        $wewenang_spt=substr($wewenang,3,1);

        if($wewenang_spt==1)
        {
            $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
            $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
        }
        else
        {
            $data['menuspt']="";      
        }       

        $wewenang_skp=substr($wewenang,4,1);

        if($wewenang_skp==1)
        {
            $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
            $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
        }
        else
        {
            $data['menuskp']="";      
        }

        $wewenang_bendahara=substr($wewenang,5,1);

        if($wewenang_bendahara==1)
        {
            $menuku .="Bendahara, ";
            $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
        }
        else
        {
            $data['menubendahara']="";      
        }    

        $wewenang_dash=substr($wewenang,6,1);

        if($wewenang_dash==1)
        {
            $menuku .="Dashboard, ";
            $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
        }
        else
        {
            $data['menudash']="";      
        }    

        $wewenang_hapusspt=substr($wewenang,7,1);

        if($wewenang_hapusspt==1)
        {
            $menuku .="Hapus SPT, ";


            $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

        }
        else
        {
            $data['hapusspt']="";      
        }   

        $wewenang_verispt=substr($wewenang,8,1);

        if($wewenang_verispt==1)
        {
            $menuku .="Verifikasi SPT, ";


            $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['verispt']="";      
        }     

        $wewenang_veriskp=substr($wewenang,9,1);

        if($wewenang_veriskp==1)
        {
            $menuku .="Verifikasi SKP, ";


            $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['veriskp']="";      
        }               



        $this->load->model('skp/skp_model');

        $data['daftarbayar'] = $this->skp_model->daftarbayar();

        $data["menuku"]=$menuku;
        $this->load->view('menu',$data);





        $this->load->view('bendahara/bendahara',$data);
        $this->load->view('header/footer',$data);

        $this->load->library('session');
        $data = array('data'=>$namauser); //set it
        $this->session->set_userdata($data);
    }       


    public function skp() 
    {
        $this->load->library('session');
        $namauser=$this->session->userdata('Nama');



        $this->load->model('pegawai/pegawai_model');
        $data['listdata'] = $this->pegawai_model->data_user($namauser);

        $this->load->model('skp/skp_model');




        $data['skpbelum'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),'','',1,1,0);
        //$data['skpsudah'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),'','',1,1);


        $data['Nama'] = $this->session->userdata('Nama');

        $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
        if ($q->num_rows() == 1) 
        {
            $wewenang=$q->row()->Wewenang;
        }

        $this->load->view('header/header',$data);


        $menuku="";

        $wewenang_reporteditor=substr($wewenang,0,1);

        if($wewenang_reporteditor==1)
        {
            $menuku .="Report Editor, ";
            $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
        }
        else
        {
            $data['menure']="";      
        }

        $wewenang_manajemenuser=substr($wewenang,1,1);

        if($wewenang_manajemenuser==1)
        {
            $menuku .="Manajemen User, ";
            $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
        }
        else
        {
            $data['menumu']="";      
        }

        $wewenang_npwp=substr($wewenang,2,1);

        if($wewenang_npwp==1)
        {
            $menuku .="Pendaftaran NPWPD, ";
            $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
        }
        else
        {
            $data['menunpwp']="";      
        }

        $wewenang_spt=substr($wewenang,3,1);

        if($wewenang_spt==1)
        {
            $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
            $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
        }
        else
        {
            $data['menuspt']="";      
        }       

        $wewenang_skp=substr($wewenang,4,1);

        if($wewenang_skp==1)
        {
            $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
            $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
        }
        else
        {
            $data['menuskp']="";      
        }

        $wewenang_bendahara=substr($wewenang,5,1);

        if($wewenang_bendahara==1)
        {
            $menuku .="Bendahara, ";
            $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
        }
        else
        {
            $data['menubendahara']="";      
        }    

        $wewenang_dash=substr($wewenang,6,1);

        if($wewenang_dash==1)
        {
            $menuku .="Dashboard, ";
            $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
        }
        else
        {
            $data['menudash']="";      
        }      

        $wewenang_hapusspt=substr($wewenang,7,1);

        if($wewenang_hapusspt==1)
        {
            $menuku .="Hapus SPT, ";


            $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

        }
        else
        {
            $data['hapusspt']="";      
        }   

        $wewenang_verispt=substr($wewenang,8,1);

        if($wewenang_verispt==1)
        {
            $menuku .="Verifikasi SPT, ";


            $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['verispt']="";      
        } 

        $wewenang_veriskp=substr($wewenang,9,1);

        if($wewenang_veriskp==1)
        {
            $menuku .="Verifikasi SKP, ";


            $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['veriskp']="";      
        }                   



        $data["menuku"]=$menuku;
        $this->load->view('menu',$data);




        $this->load->view('skp/skp',$data);
        $this->load->view('header/footer',$data);

        $this->load->library('session');
        $data = array('data'=>$namauser); //set it
        $this->session->set_userdata($data);
    }


    public function sptpd() 
    {
        $this->load->library('session');
        $namauser=$this->session->userdata('Nama');
        $data['Nama'] = $this->session->userdata('Nama');



        $this->load->model('pegawai/pegawai_model');
        $data['listdata'] = $this->pegawai_model->data_user($namauser);

        $this->load->model('sptpd/sptpd_model');
        $data['jenispajak'] = $this->sptpd_model->get_jenispajak();
        $data['bulan'] = $this->sptpd_model->get_bulan();
        $data['tahun'] = $this->sptpd_model->get_tahun();


        $this->load->model('npwpd/npwpd');
        $data['npwpdbaru'] = $this->npwpd->data_npwpd2("Terverifikasi");


        //$data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',0,1);
        //$data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',1,1);


        $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
        if ($q->num_rows() == 1) 
        {
            $wewenang=$q->row()->Wewenang;
        }

        $this->load->view('header/header',$data);


        $menuku="";

        $wewenang_reporteditor=substr($wewenang,0,1);

        if($wewenang_reporteditor==1)
        {
            $menuku .="Report Editor, ";
            $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
        }
        else
        {
            $data['menure']="";      
        }

        $wewenang_manajemenuser=substr($wewenang,1,1);

        if($wewenang_manajemenuser==1)
        {
            $menuku .="Manajemen User, ";
            $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
        }
        else
        {
            $data['menumu']="";      
        }

        $wewenang_npwp=substr($wewenang,2,1);

        if($wewenang_npwp==1)
        {
            $menuku .="Pendaftaran NPWPD, ";
            $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
        }
        else
        {
            $data['menunpwp']="";      
        }

        $wewenang_spt=substr($wewenang,3,1);

        if($wewenang_spt==1)
        {
            $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
            $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
        }
        else
        {
            $data['menuspt']="";      
        }       

        $wewenang_skp=substr($wewenang,4,1);

        if($wewenang_skp==1)
        {
            $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
            $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
        }
        else
        {
            $data['menuskp']="";      
        }

        $wewenang_bendahara=substr($wewenang,5,1);

        if($wewenang_bendahara==1)
        {
            $menuku .="Bendahara, ";
            $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
        }
        else
        {
            $data['menubendahara']="";      
        }    

        $wewenang_dash=substr($wewenang,6,1);

        if($wewenang_dash==1)
        {
            $menuku .="Dashboard, ";
            $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
        }
        else
        {
            $data['menudash']="";      
        }   


        $wewenang_hapusspt=substr($wewenang,7,1);

        if($wewenang_hapusspt==1)
        {
            $menuku .="Hapus SPT, ";


            $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";
        }
        else
        {
            $data['hapusspt']="";      
        }    

        $wewenang_verispt=substr($wewenang,8,1);

        if($wewenang_verispt==1)
        {
            $menuku .="Verifikasi SPT, ";


            $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";

            $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd('','','','','',0,1,0);
            $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd('','','','','',1,1,0);
        }
        else
        {
            $data['verispt']=""; 
            $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',0,1,0);
            $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',1,1,0);     
        } 

        $wewenang_veriskp=substr($wewenang,9,1);

        if($wewenang_veriskp==1)
        {
            $menuku .="Verifikasi SKP, ";


            $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['veriskp']="";      
        }   



        $data["menuku"]=$menuku;
        $this->load->view('menu',$data);



        $this->load->view('sptpd/sptpd',$data);
        $this->load->view('header/footer',$data);

        $this->load->library('session');
        $data = array('data'=>$namauser,'nosptbelum'=>$this->input->post('SPTPDbelum')); //set it
        $this->session->set_userdata($data);


    }    

    public function operasiskp() 
    {

        if($this->input->post('TambahSKP') ) 
        {
            $TglSKPBaru = $this->input->post('tglterbitSKPbaru');
            $DataEntriSKPBaru = $this->input->post('dataentriSKPbaru');
            $TglEntriSKPBaru = $this->input->post('tglentriSKPbaru');

            $SPTPDBaru = $this->input->post('SPTPDBaru');

            $MasaTgl1 = $this->input->post('MasaTgl1');
            $MasaTgl2 = $this->input->post('MasaTgl2');

            $d = date_parse_from_format("Y-m-d", $TglSKPBaru);
            $Bulan= $d["month"];

            $this->db->select('namabulan');
            $this->db->where("NoID",$Bulan);
            $query=$this->db->get('bulan');

            foreach ($query->result() as $value) {
                $NamaBulanBaru = $value->namabulan;
            }

            $TahunBaru= $d["year"];

            $this->load->model('skp/skp_model');
            $this->skp_model->insertskp($TglSKPBaru,$NamaBulanBaru,$TahunBaru,$SPTPDBaru,$DataEntriSKPBaru,$TglEntriSKPBaru,$MasaTgl1,$MasaTgl2);



            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');



            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('skp/skp_model');



            $data['skpbelum'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),'','',1,1,0);
            //$data['skpsudah'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),'','',1,1);

            $data['Nama'] = $this->session->userdata('Nama');

            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            } 

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['veriskp']="";      
            }   



            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);




            $this->load->view('skp/skp',$data);
            $this->load->view('header/footer',$data);

            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);

        }
        elseif($this->input->post('verifikasiskp') ) 
        {
            $TglSKPBaru = $this->input->post('tglterbitSKPbaru');
            $DataEntriSKPBaru = $this->input->post('dataentriSKPbaru');
            $TglEntriSKPBaru = $this->input->post('tglentriSKPbaru');

            $SPTPDAktif = $this->input->post('SPTPDAktif');

            $SKPAktif = $this->input->post('SKPAktif');

            $VerifikatorAktif = $this->input->post('VerifikatorAktif');
            $TglVeriAktif = $this->input->post('TglVeriAktif');

            $this->load->model('skp/skp_model');

            $this->skp_model->updateverifikasiskp_Aktif($SKPAktif,$SPTPDAktif,$VerifikatorAktif,$TglVeriAktif);

            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');



            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('skp/skp_model');

            //$data['jenispajak'] = $this->skp_model->get_jenispajak();
            //$data['bulan'] = $this->skp_model->get_bulan();
            //$data['tahun'] = $this->skp_model->get_tahun();


            //$this->load->model('npwpd/npwpd');
            //$data['npwpdbaru'] = $this->npwpd->data_npwpd2("Terverifikasi");


            $data['skpbelum'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),'','',1,1,0);
            //$data['skpsudah'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),'','',1,1);

            $data['Nama'] = $this->session->userdata('Nama');

            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }     

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['veriskp']="";      
            }           

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);




            $this->load->view('skp/skp',$data);
            $this->load->view('header/footer',$data);

            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);

        }
        elseif($this->input->post('HapusSKP') ) 
        {
            $NoSKPHapus=$this->input->post('SKPHapus');

            $this->load->model('skp/skp_model');

            $this->skp_model->updateverifikasiskp_NonAktif($NoSKPHapus);

            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');



            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('skp/skp_model');

            //$data['jenispajak'] = $this->skp_model->get_jenispajak();
            //$data['bulan'] = $this->skp_model->get_bulan();
            //$data['tahun'] = $this->skp_model->get_tahun();


            //$this->load->model('npwpd/npwpd');
            //$data['npwpdbaru'] = $this->npwpd->data_npwpd2("Terverifikasi");


            $data['skpbelum'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),'','',1,1,0);
            //$data['skpsudah'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),'','',1,1);


            $data['Nama'] = $this->session->userdata('Nama');

            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }    

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['veriskp']="";      
            }            

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);




            $this->load->view('skp/skp',$data);
            $this->load->view('header/footer',$data);

            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);
        }
        elseif($this->input->post('caridataskpbelum') ) 
        {

            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');

            $SKPBelum=$this->input->post('SKPBelum');
            $SPTPDBelum=$this->input->post('SPTPDBelum');


            $this->load->model('skp/skp_model');

            $data['skpbelum'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),$SKPBelum,$SPTPDBelum,1,1,0);
            //$data['skpsudah'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),'','',1,1);


            $data['Nama'] = $this->session->userdata('Nama');

            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }   

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['veriskp']="";      
            }            

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);




            $this->load->view('skp/skp',$data);
            $this->load->view('header/footer',$data);

            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);
        }
        elseif($this->input->post('caridataskpsudah') ) 
        {
            $SKPSudah=$this->input->post('SKPSudah');
            $SPTPDSudah=$this->input->post('SPTPDSudah');

            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');


            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('skp/skp_model');

            $data['skpbelum'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),'','',1,1,0);
            //$data['skpsudah'] = $this->skp_model->cari_skp($this->session->userdata('Nama'),$SKPSudah,$SPTPDSudah,1,1);

            $data['Nama'] = $this->session->userdata('Nama');

            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }     

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['veriskp']="";      
            }          

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);




            $this->load->view('skp/skp',$data);
            $this->load->view('header/footer',$data);

            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);
        }
        else
        {
            $this->skp();
        }


    }


    public function operasisptpd() 
    {
        if($this->input->post('Refreshdatasptpdbelum') ) 
        {
            $this->sptpd();
        }
        elseif($this->input->post('EditSPT') ) 
        {
            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');




            $NoSPTPDEdit=$this->input->post('SPTPDEdit');
            $KeteranganEdit=$this->input->post('KeteranganEdit');
            $JumlahEdit=$this->input->post('JumlahEdit');



            $this->load->model('sptpd/sptpd_model');

            $this->sptpd_model->editsptpd($NoSPTPDEdit,$KeteranganEdit,$JumlahEdit);

            $this->sptpd();

        }
        elseif($this->input->post('caridatasptpdbelum') ) 
        {
            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');




            $SPTPDbelum = $this->input->post('SPTPDbelum');
            $JenisPajakbelum = $this->input->post('jenispajakbelum');
            $Bulanbelum = $this->input->post('bulanbelum1');
            $Tahunbelum = $this->input->post('tahunbelum');
            $SPTPDlamabelum = $this->input->post('SPTPDlamabelum');

            $SPTPDaktif = $this->input->post('SPTPDaktif');
            $JenisPajakaktif = $this->input->post('jenispajakaktif');
            $Bulanaktif = $this->input->post('bulanaktif');
            $Tahunaktif = $this->input->post('tahunaktif');

            $this->load->library('session');
            $data = array('data'=>$namauser,'nosptbelum'=>$SPTPDbelum,'nosptaktif'=>$SPTPDaktif); //set it
            $this->session->set_userdata($data);


            if ($JenisPajakbelum=="- Jenis Pajak -")
            {
                $JenisPajakbelum="";
            }
            if ($Bulanbelum=="- Bulan -")
            {
                $Bulanbelum="";
            }
            if ($Tahunbelum=="- Tahun -")
            {
                $Tahunbelum="";
            }

            if ($JenisPajakaktif=="- Jenis Pajak -")
            {
                $JenisPajakaktif="";
            }
            if ($Bulanaktif=="- Bulan -")
            {
                $Bulanaktif="";
            }
            if ($Tahunaktif=="- Tahun -")
            {
                $Tahunaktif="";
            }

            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);            

            $this->load->model('sptpd/sptpd_model');
            $data['jenispajak'] = $this->sptpd_model->get_jenispajak();
            $data['bulan'] = $this->sptpd_model->get_bulan();
            $data['tahun'] = $this->sptpd_model->get_tahun();

            $this->load->model('npwpd/npwpd');
            $data['npwpdbaru'] = $this->npwpd->data_npwpd2("Terverifikasi");



            //$data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),$SPTPDbelum,$JenisPajakbelum,$Bulanbelum,$Tahunbelum,0,1);
            //$data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),$SPTPDaktif,$JenisPajakaktif,$Bulanaktif,$Tahunaktif,1,1);


            $data['nosptbelum'] =  $this->session->userdata('nosptbelum');
            $data['nosptaktif'] =  $this->session->userdata('nosptaktif');


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $data['Nama']=$namauser;

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }            


            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";

                $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd('',$SPTPDbelum,$JenisPajakbelum,$Bulanbelum,$Tahunbelum,0,1,0,$SPTPDlamabelum);
                $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd('',$SPTPDaktif,$JenisPajakaktif,$Bulanaktif,$Tahunaktif,1,1,0);

            }
            else
            {
                $data['verispt']=""; 
                $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),$SPTPDbelum,$JenisPajakbelum,$Bulanbelum,$Tahunbelum,0,1,0,$SPTPDlamabelum);
                $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),$SPTPDaktif,$JenisPajakaktif,$Bulanaktif,$Tahunaktif,1,1,0);

            } 

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['veriskp']="";      
            }                 

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);

            $data['Nama'] = $this->session->userdata('Nama');
            $this->load->view('sptpd/sptpd',$data);
            $this->load->view('header/footer',$data);

            $this->load->library('session');
            $data = array('data'=>$namauser,'nosptbelum'=>$this->input->post('SPTPDbelum')); //set it
            $this->session->set_userdata($data);

        }
        if($this->input->post('caridatasptpdaktif') ) 
        {
            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');



            $SPTPDbelum = $this->input->post('SPTPDbelum');
            $JenisPajakbelum = $this->input->post('jenispajakbelum');
            $Bulanbelum = $this->input->post('bulanbelum1');
            $Tahunbelum = $this->input->post('tahunbelum');

            $SPTPDaktif = $this->input->post('SPTPDaktif');
            $JenisPajakaktif = $this->input->post('jenispajakaktif');
            $Bulanaktif = $this->input->post('bulanaktif');
            $Tahunaktif = $this->input->post('tahunaktif');
            $SPTPDlamaaktif = $this->input->post('SPTPDlamaaktif');


            $this->load->library('session');
            $data = array('data'=>$namauser,'nosptbelum'=>$SPTPDbelum,'nosptaktif'=>$SPTPDaktif); //set it
            $this->session->set_userdata($data);


            if ($JenisPajakbelum=="- Jenis Pajak -")
            {
                $JenisPajakbelum="";
            }
            if ($Bulanbelum=="- Bulan -")
            {
                $Bulanbelum="";
            }
            if ($Tahunbelum=="- Tahun -")
            {
                $Tahunbelum="";
            }



            if ($JenisPajakaktif=="- Jenis Pajak -")
            {
                $JenisPajakaktif="";
            }
            if ($Bulanaktif=="- Bulan -")
            {
                $Bulanaktif="";
            }
            if ($Tahunaktif=="- Tahun -")
            {
                $Tahunaktif="";
            }

            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);            

            $this->load->model('sptpd/sptpd_model');
            $data['jenispajak'] = $this->sptpd_model->get_jenispajak();
            $data['bulan'] = $this->sptpd_model->get_bulan();
            $data['tahun'] = $this->sptpd_model->get_tahun();

            $this->load->model('npwpd/npwpd');
            $data['npwpdbaru'] = $this->npwpd->data_npwpd2("Terverifikasi");       



            //$data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),$SPTPDbelum,$JenisPajakbelum,$Bulanbelum,$Tahunbelum,0,1);
            //$data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),$SPTPDaktif,$JenisPajakaktif,$Bulanaktif,$Tahunaktif,1,1);



            $data['nosptbelum'] =  $this->session->userdata('nosptbelum');
            $data['nosptaktif'] =  $this->session->userdata('nosptaktif');


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $data['Nama']=$namauser;

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }   


            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";

                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";



            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";

                $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd('',$SPTPDbelum,$JenisPajakbelum,$Bulanbelum,$Tahunbelum,0,1,0);
                $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd('',$SPTPDaktif,$JenisPajakaktif,$Bulanaktif,$Tahunaktif,1,1,0,$SPTPDlamaaktif);

            }
            else
            {
                $data['verispt']=""; 
                $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),$SPTPDbelum,$JenisPajakbelum,$Bulanbelum,$Tahunbelum,0,1,0);
                $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),$SPTPDaktif,$JenisPajakaktif,$Bulanaktif,$Tahunaktif,1,1,0,$SPTPDlamaaktif);

            }                 

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['veriskp']="";      
            }   


            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);
            $data['Nama'] = $this->session->userdata('Nama');

            $this->load->view('sptpd/sptpd',$data);
            $this->load->view('header/footer',$data);


        }

        if($this->input->post('tambahbarusptpd') ) 
        {
            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');




            $this->load->model('sptpd/sptpd_model');

            $JenisPajakBaru = $this->input->post('jenispajakbaru');


            $TanggalTerbitBaru = $this->input->post('tglterbitbaru');

            $d = date_parse_from_format("Y-m-d", $TanggalTerbitBaru);
            $Bulan= $d["month"];

            $this->db->select('namabulan');
            $this->db->where("NoID",$Bulan);
            $query=$this->db->get('bulan');

            foreach ($query->result() as $value) {
                $NamaBulanBaru = $value->namabulan;
            }

            $TahunBaru= $d["year"];

            $NPWPDBaru = $this->input->post('npwpdbaru');


            $this->db->select('NamaWP');
            $this->db->where("NPWPD",$NPWPDBaru);
            $query=$this->db->get('npwpd');

            foreach ($query->result() as $value) {
                $NamaWPBaru = $value->NamaWP;
            }

            $DataEntriBaru = $this->input->post('dataentribaru');

            $TanggalEntriBaru = $this->input->post('tglentribaru');

            $KodeObyekBaru = $this->input->post('kodeobyekbaru');



            $KodeRuasJalanBaru = $this->input->post('koderuasjalanbaru');

            $KeteranganPajakBaru = $this->input->post('keteranganpajakbaru');



            $NJOPBaru=$this->input->post('NJOPbaru');

            $ProsentaseBaru=$this->input->post('prosentasebaru');




            $JumlahSatuanBaru = $this->input->post('jumlahsatuanbaru');



            $JumlahBaru = $this->input->post('jumlahreklamebaru');

            $satuan=$this->input->post('satuanbaru');



            $this->db->select('JenisPajak');
            $this->db->where("NoID",$KodeObyekBaru);
            $query=$this->db->get('tarif_dasar_pajak');

            if($query->num_rows<>0)
            {
                foreach ($query->result() as $value) 
                {
                    $JenisPajak=$value->JenisPajak;
                }
            }
            else
            {
                $JenisPajak="";
            }

            $Jenis=substr($JenisPajak,0,7);

            if($Jenis=="Reklame")
            {

                if($satuan=="tahun" || $satuan=="hari" || $satuan=="minggu" || $satuan=="bulan")

                {
                    //error

                    if($satuan=="tahun")
                    {
                        $timer="+".$JumlahSatuanBaru." year";
                    }
                    elseif($satuan=="hari")
                    {
                        $timer="+".$JumlahSatuanBaru." day";
                    }
                    elseif($satuan=="minggu")
                    {
                        $timer="+".$JumlahSatuanBaru." week";
                    }
                    else
                    {
                        $timer="+".$JumlahSatuanBaru." month";
                    }

                    $bataswaktu = strtotime ( $timer , strtotime ($TanggalTerbitBaru));

                    $bataswaktu = date ( 'Y-m-d' , $bataswaktu );

                    //echo $JumlahSatuanBaru;

                }
                else
                {
                    $bataswaktu=$TanggalEntriBaru;
                }

                $sisibaru=$this->input->post('sisibaru');
                $LuasBaru = $this->input->post('luasbaru');
                $Lebar = $this->input->post('lebarbaru');

                $NilaiStrategisBaru=$this->input->post('nilaistrategisbaru');


                $totalreklame=(($NilaiStrategisBaru)*$ProsentaseBaru)/100;

                $total=$sisibaru*$totalreklame*$LuasBaru*$Lebar*$JumlahBaru;


                $this->sptpd_model->insertsptpd($JenisPajakBaru,$JenisPajak,$TanggalTerbitBaru,$NamaBulanBaru,$TahunBaru,$NPWPDBaru,$NamaWPBaru,$DataEntriBaru,$TanggalEntriBaru,$KodeObyekBaru,$KodeRuasJalanBaru,$KeteranganPajakBaru,$LuasBaru,$JumlahSatuanBaru,$JumlahBaru,$bataswaktu,$sisibaru,$total,null);

            }
            else
            {
                $NilaiPajakBaru=$this->input->post('nilaipajakbaru');

                if($JenisPajak=="Pajak Air Tanah" ||  $JenisPajak=="Pajak Mineral Bukan Logam dan Batuan")
                {
                    $total=($JumlahSatuanBaru*$NJOPBaru*$ProsentaseBaru)/100;
                    $this->sptpd_model->insertsptpd($JenisPajakBaru,$JenisPajak,$TanggalTerbitBaru,$NamaBulanBaru,$TahunBaru,$NPWPDBaru,$NamaWPBaru,$DataEntriBaru,$TanggalEntriBaru,$KodeObyekBaru,null,$KeteranganPajakBaru,null,$JumlahSatuanBaru,null,null,null,$total,null);

                }
                // elseif($JenisPajak=="Pajak Hotel" || $JenisPajak=="Pajak Restoran" || $JenisPajak=="Pajak Hiburan" || $JenisPajak=="Pajak Parkir") // DIMAS UPDATE 18 SEPTEMBER 2017
                elseif($JenisPajak=="Pajak Hotel" || $JenisPajak=="Pajak Restoran" || $JenisPajak=="Pajak Hiburan" || $JenisPajak=="Pajak Parkir" || $JenisPajak == "Pajak Penerangan Jalan")
                {
                    $total=($NilaiPajakBaru*$ProsentaseBaru)/100;
                    $this->sptpd_model->insertsptpd($JenisPajakBaru,$JenisPajak,$TanggalTerbitBaru,$NamaBulanBaru,$TahunBaru,$NPWPDBaru,$NamaWPBaru,$DataEntriBaru,$TanggalEntriBaru,$KodeObyekBaru,null,$KeteranganPajakBaru,null,null,null,null,null,$total,$NilaiPajakBaru);

                }
                elseif($JenisPajak=="Retribusi Pemakaian Kekayaan Daerah" )
                {
                    $total=$NilaiPajakBaru;
                    $this->sptpd_model->insertsptpd($JenisPajakBaru,$JenisPajak,$TanggalTerbitBaru,$NamaBulanBaru,$TahunBaru,$NPWPDBaru,$NamaWPBaru,$DataEntriBaru,$TanggalEntriBaru,$KodeObyekBaru,null,$KeteranganPajakBaru,null,null,null,null,null,$total,$NilaiPajakBaru);

                }
                else
                {
                    $total=0;
                } 


            }

            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('sptpd/sptpd_model');
            $data['jenispajak'] = $this->sptpd_model->get_jenispajak();
            $data['bulan'] = $this->sptpd_model->get_bulan();
            $data['tahun'] = $this->sptpd_model->get_tahun();


            $this->load->model('npwpd/npwpd');
            $data['npwpdbaru'] = $this->npwpd->data_npwpd2("Terverifikasi");


            //$data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',0,1);
            //$data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',1,1);


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $data['Nama']=$namauser;

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }        


            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";

                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";



            }
            else
            {
                $data['hapusspt']="";      
            }     

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";

                $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd('','','','','',0,1,0);
                $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd('','','','','',1,1,0);
            }
            else
            {
                $data['verispt']=""; 
                $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',0,1,0);
                $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',1,1,0);   
            }   

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['veriskp']="";      
            }   


            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);

            $data['Nama'] = $this->session->userdata('Nama');

            $this->load->view('sptpd/sptpd',$data);
            $this->load->view('header/footer',$data);

            $this->load->library('session');
            $data = array('data'=>$namauser,'nosptbelum'=>$this->input->post('SPTPDbelum')); //set it
            $this->session->set_userdata($data);



        }  
        if($this->input->post('verifikasisptpd') ) 
        {

            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');




            $NoSPTPDAktif=$this->input->post('SPTPDAktif');

            $VerifikatorAktif=$this->input->post('VerifikatorAktif');
            $TanggalVerifikasiAktif=$this->input->post('TanggalVerifikasiAktif');

            $this->load->model('sptpd/sptpd_model');

            $this->sptpd_model->updateverifikasisptpd(1,$NoSPTPDAktif,$VerifikatorAktif,$TanggalVerifikasiAktif);

            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('sptpd/sptpd_model');
            $data['jenispajak'] = $this->sptpd_model->get_jenispajak();
            $data['bulan'] = $this->sptpd_model->get_bulan();
            $data['tahun'] = $this->sptpd_model->get_tahun();


            $this->load->model('npwpd/npwpd');
            $data['npwpdbaru'] = $this->npwpd->data_npwpd2("Terverifikasi");


            //$data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',0,1);
            //$data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',1,1);


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $data['Nama']=$namauser;

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }      


            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";

                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";



            }
            else
            {
                $data['hapusspt']="";      
            }    

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";

                $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd('','','','','',0,1,0);
                $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd('','','','','',1,1,0);

            }
            else
            {
                $data['verispt']=""; 
                $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',0,1,0);
                $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',1,1,0);

            }   

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['veriskp']="";      
            }                        

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);
            $data['Nama'] = $this->session->userdata('Nama');

            $this->load->view('sptpd/sptpd',$data);
            $this->load->view('header/footer',$data);

            $this->load->library('session');
            $data = array('data'=>$namauser,'nosptbelum'=>$this->input->post('SPTPDbelum')); //set it
            $this->session->set_userdata($data);


        }

        if($this->input->post('HapusSPTPD') ) 
        {

            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');




            $NoSPTPDHapus=$this->input->post('SPTPDHapus');


            $this->load->model('sptpd/sptpd_model');

            $this->sptpd_model->updateverifikasisptpd(0,$NoSPTPDHapus,null,null);

            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('sptpd/sptpd_model');
            $data['jenispajak'] = $this->sptpd_model->get_jenispajak();
            $data['bulan'] = $this->sptpd_model->get_bulan();
            $data['tahun'] = $this->sptpd_model->get_tahun();


            $this->load->model('npwpd/npwpd');
            $data['npwpdbaru'] = $this->npwpd->data_npwpd2("Terverifikasi");


            //$data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',0,1);
            //$data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',1,1);


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $data['Nama']=$namauser;

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }   


            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";

                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";



            }
            else
            {
                $data['hapusspt']="";      
            }      

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";

                $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd('','','','','',0,1,0);
                $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd('','','','','',1,1,0);


            }
            else
            {
                $data['verispt']=""; 
                $data['sptpdbelum'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',0,1,0);
                $data['sptpdsudah'] = $this->sptpd_model->cari_sptpd($this->session->userdata('Nama'),'','','','',1,1,0);


            }  

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['veriskp']="";      
            }           


            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);

            $data['Nama'] = $this->session->userdata('Nama');

            $this->load->view('sptpd/sptpd',$data);
            $this->load->view('header/footer',$data);

            $this->load->library('session');
            $data = array('data'=>$namauser,'nosptbelum'=>$this->input->post('SPTPDbelum')); //set it
            $this->session->set_userdata($data);

        }



    }

    public function gambar2($kode)
    {
        //$height = isset($_GET['height']) ? mysql_real_escape_string($_GET['height']) : '74';    
        //$width = isset($_GET['width']) ? mysql_real_escape_string($_GET['width']) : '1'; //1,2,3,dst
        $height=30;
        $width=1;

        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $barcodeOPT = array('text' => $kode, 'barHeight'=> $height, 'factor'=>$width,);         
        $renderOPT = array();
        $render = Zend_Barcode::factory('Code25interleaved', 'image', $barcodeOPT, $renderOPT)->render();
    }



    public function gambar7($kode)
    {
        //$height = isset($_GET['height']) ? mysql_real_escape_string($_GET['height']) : '74';    
        //$width = isset($_GET['width']) ? mysql_real_escape_string($_GET['width']) : '1'; //1,2,3,dst
        $height=20;
        $width=1;

        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $barcodeOPT = array('text' => $kode, 'barHeight'=> $height, 'factor'=>$width,);         
        $renderOPT = array();
        $render = Zend_Barcode::factory('Code25interleaved', 'image', $barcodeOPT, $renderOPT)->render();
    }


    public function gambar($kode)
    {
        //$height = isset($_GET['height']) ? mysql_real_escape_string($_GET['height']) : '74';    
        //$width = isset($_GET['width']) ? mysql_real_escape_string($_GET['width']) : '1'; //1,2,3,dst
        $height=40;
        $width=2;

        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $barcodeOPT = array('text' => $kode, 'barHeight'=> $height, 'factor'=>$width,);         
        $renderOPT = array();
        $render = Zend_Barcode::factory('Code25interleaved', 'image', $barcodeOPT, $renderOPT)->render();
    }

    public function gambar4($kode)
    {
        //$height = isset($_GET['height']) ? mysql_real_escape_string($_GET['height']) : '74';    
        //$width = isset($_GET['width']) ? mysql_real_escape_string($_GET['width']) : '1'; //1,2,3,dst
        $height=30;
        $width=2;

        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $barcodeOPT = array('text' => $kode, 'barHeight'=> $height, 'factor'=>$width,);         
        $renderOPT = array();
        $render = Zend_Barcode::factory('Code25interleaved', 'image', $barcodeOPT, $renderOPT)->render();
    }

    public function gambar3($kode)
    {
        //$height = isset($_GET['height']) ? mysql_real_escape_string($_GET['height']) : '74';    
        //$width = isset($_GET['width']) ? mysql_real_escape_string($_GET['width']) : '1'; //1,2,3,dst
        $height=95;
        $width=1;

        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $barcodeOPT = array('text' => $kode, 'barHeight'=> $height, 'factor'=>$width,);         
        $renderOPT = array();
        $render = Zend_Barcode::factory('Code25interleaved', 'image', $barcodeOPT, $renderOPT)->render();
    }    



    public function sptpd_cetak($no) 
    {
        $this->load->model('sptpd/sptpd_model');
        $data['sptpd']=$no;

        $this->db->select('JenisPajak,TanggalTerbit,Bulan,Tahun,NPWPD,NamaWP,KeteranganPajak,JumlahPajak,BatasWaktu,ObyekPajak');
        $this->db->where("NoID",$no);
        $query=$this->db->get('sptpd');

        foreach ($query->result() as $value) {
            $JenisPajak = $value->JenisPajak;
            $TanggalTerbit = $value->TanggalTerbit;
            $Bulan = $value->Bulan;
            $Tahun = $value->Tahun;
            $NPWPD = $value->NPWPD;
            $NamaWP = $value->NamaWP;    
            $KeteranganPajak=$value->KeteranganPajak; 
            $JumlahPajak=$value->JumlahPajak;   
            $BatasWaktu=$value->BatasWaktu;
            $ObyekPajak=$value->ObyekPajak;    
        }

        $Jenis=substr($JenisPajak,0,5);

        if($Jenis=="4.1.1")
        {
            $Judul="SURAT PEMBERITAHUAN PAJAK DAERAH (SPTPD)";
        }
        else
        {
            $Judul="SURAT PEMBERITAHUAN RETRIBUSI DAERAH (SPTRD)";
        }



        $this->db->select('NoID,RekeningInduk');
        $this->db->where("NoID",$ObyekPajak);
        $query2=$this->db->get('tarif_dasar_pajak');

        foreach ($query2->result() as $value2) {
            $RekeningInduk = $value2->RekeningInduk;   
        }        

        $data['RekeningInduk']=$RekeningInduk;
        $data['Judul']=$Judul;
        $data['TanggalTerbit']=date("d F Y", strtotime($TanggalTerbit));
        $data['MasaPajak']=$Bulan." ".$Tahun;
        $data['NPWPD']=$NPWPD;
        $data['NamaWP']=$NamaWP;


        $this->db->select('uraian');
        $this->db->where("koderekening",$JenisPajak);
        $query2=$this->db->get('koderekening');

        foreach ($query2->result() as $value2) {
            $JenisPajak2 = $value2->uraian;
        }

        $this->db->select('AlamatWP');
        $this->db->where("NPWPD",$NPWPD);
        $query3=$this->db->get('npwpd');

        foreach ($query3->result() as $value3) {
            $AlamatWP = $value3->AlamatWP;
        }

        $data['AlamatWP']=$AlamatWP;



        $data['JenisPajak']=$JenisPajak;

        $data['KeteranganPajak']=$KeteranganPajak;

        $data['Judul2']=$JenisPajak2;

        if($BatasWaktu=="")
        {
            $BatasWaktu="";
        }
        else
        {
            $BatasWaktu=date("d-m-Y", strtotime($BatasWaktu));
        }

        $data['BatasWaktu']=$BatasWaktu;

        $data['Tahun']=$Tahun;

        $data['JumlahPajak']=number_format($JumlahPajak,0,",",".");

        $data['terbilang']=ucwords($this->sptpd_model->terbilang($JumlahPajak));

        $output = $this->load->view('sptpd/sptpd_cetak',$data);

    }  







    public function skp_cetak($no) 
    {
        //$this->load->model('skp/skp_model');
        $this->load->model('sptpd/sptpd_model');
        $data['skp']=$no;

        $this->db->select('Nomor_SKPRD,Nomor_SPTPD,masa1,masa2');
        $this->db->where("Nomor_SKPRD",$no);
        $query=$this->db->get('skp');  

        foreach ($query->result() as $value) {
            $Nomor_SPTPD = $value->Nomor_SPTPD;
            $masa1 = $value->masa1;
            $masa2 = $value->masa2;
        }

        $this->db->select('TanggalTerbit,BatasWaktu,JenisPajak,Bulan,Tahun,NPWPD,NamaWP,KeteranganPajak,JumlahPajak,ObyekPajak');
        $this->db->where("NoID",$Nomor_SPTPD);
        $query2=$this->db->get('sptpd'); 

        foreach ($query2->result() as $value2) {
            $TanggalTerbit = $value2->TanggalTerbit;
            $BatasWaktu = $value2->BatasWaktu;
            $JenisPajak = $value2->JenisPajak;
            $Bulan = $value2->Bulan;
            $Tahun = $value2->Tahun;
            $NPWPD = $value2->NPWPD;
            $NamaWP = $value2->NamaWP;
            $KeteranganPajak=$value2->KeteranganPajak;
            $JumlahPajak=$value2->JumlahPajak;
            $ObyekPajak=$value2->ObyekPajak;
        } 


        $this->db->select('NoID,RekeningInduk');
        $this->db->where("NoID",$ObyekPajak);
        $query212=$this->db->get('tarif_dasar_pajak');

        foreach ($query212->result() as $value212) {
            $RekeningInduk = $value212->RekeningInduk;   
        }        

        $data['RekeningInduk']=$RekeningInduk;



        $Jenis=substr($JenisPajak,0,5);

        if($Jenis=="4.1.1")
        {
            $Judul="SURAT KETETAPAN PAJAK DAERAH (SKP-DAERAH)";
        }
        else
        {
            $Judul="SURAT KETETAPAN RETRIBUSI DAERAH (SKR-DAERAH)";
        } 

        $data['Masa']=date("d/m/Y", strtotime($masa1))." s/d ". date("d/m/Y", strtotime($masa2));

        //if($BatasWaktu=="")
        //{

        //    $data['Masa']=date("d/m/Y", strtotime($TanggalTerbit))." s/d ". date("d/m/Y", strtotime($TanggalTerbit));
        //}   
        //else
        //{
        //    $data['Masa']=date("d/m/Y", strtotime($TanggalTerbit))." s/d ". date("d/m/Y", strtotime($BatasWaktu)) ;
        //} 

        $this->db->select('AlamatWP');
        $this->db->where("NPWPD",$NPWPD);
        $query3=$this->db->get('npwpd');

        foreach ($query3->result() as $value3) {
            $AlamatWP = $value3->AlamatWP;
        }




        $data['AlamatWP']=$AlamatWP;        

        $data['Judul']=$Judul;
        $data['Bulan']=$Bulan;
        $data['Tahun']=$Tahun;

        $data['NPWPD']=$NPWPD;
        $data['NamaWP']=$NamaWP;
        $data['JenisPajak']=$JenisPajak;
        $data['KeteranganPajak']=$KeteranganPajak;
        $data['JumlahPajak']=number_format($JumlahPajak,0,",",".");

        $data['terbilang']=ucwords($this->sptpd_model->terbilang($JumlahPajak));


        //$data['datanpwpd']=$this->npwpd->cari_data_npwpd($no);
        $output = $this->load->view('skp/skp_cetak',$data);
    }

    public function npwpd_cetak($no) 
    {
        $this->load->model('npwpd/npwpd');
        $data['npwpd']=$no;
        $data['datanpwpd']=$this->npwpd->cari_data_npwpd($no);
        $output = $this->load->view('npwpd/npwpd_cetak',$data);
    }    


    public function login() 
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        if($this->input->post('submit') ) 
        {
            $namauser = $this->input->post('namauser'); 
            $password = $this->input->post('password'); 
            $passwordx = md5($password); 
            $this->load->library('session');

            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$namauser."' and `Password`='".$passwordx."'");
            if ($q->num_rows() == 1) 
            { 
                $status = $q->row()->Status;
                $namauser = $q->row()->Nama;
                $statususer=$q->row()->StatusUser;

                $wewenang=$q->row()->Wewenang;

                if($status==1)
                {
                    if($statususer<>'guest')
                    {
                        $this->session->set_userdata('Nama',$namauser);
                        $data['Nama'] = $namauser;

                        $this->dashboard();

                        $data = array('data'=>$namauser); //set it
                        $this->session->set_userdata($data);  
                    }
                    else
                    {

                    }
                }
                else
                {
                    $this->load->view('error');
                }
            }
            else
            { 
                $this->load->view('error');
            }

        }
    }

    public function login2() 
    {
        $this->load->library('session');
        $namauser=$this->session->userdata('Nama');
        $data['Nama'] = $this->session->userdata('Nama');
        $data['StatusUser'] = $this->session->userdata('StatusUser');
        $this->load->model('pegawai/pegawai_model');
        $data['listdata'] = $this->pegawai_model->data_user($namauser);
        $this->load->view('header/header',$data);
        $this->load->view('pegawai/index',$data);
        $this->load->view('header/footer',$data);
        $this->load->library('session');
        $data = array('data'=>$namauser); //set it
        $this->session->set_userdata($data);
    }

    public function report()
    {
        $this->load->library('session');
        $namauser=$this->session->userdata('Nama');
        $data['Nama'] = $this->session->userdata('Nama');

        $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
        if ($q->num_rows() == 1) 
        {
            $wewenang=$q->row()->Wewenang;
        }

        $this->load->view('header/header',$data);


        $menuku="";

        $wewenang_reporteditor=substr($wewenang,0,1);

        if($wewenang_reporteditor==1)
        {
            $menuku .="Report Editor, ";
            $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
        }
        else
        {
            $data['menure']="";      
        }

        $wewenang_manajemenuser=substr($wewenang,1,1);

        if($wewenang_manajemenuser==1)
        {
            $menuku .="Manajemen User, ";
            $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
        }
        else
        {
            $data['menumu']="";      
        }

        $wewenang_npwp=substr($wewenang,2,1);

        if($wewenang_npwp==1)
        {
            $menuku .="Pendaftaran NPWPD, ";
            $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
        }
        else
        {
            $data['menunpwp']="";      
        }

        $wewenang_spt=substr($wewenang,3,1);

        if($wewenang_spt==1)
        {
            $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
            $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
        }
        else
        {
            $data['menuspt']="";      
        }       

        $wewenang_skp=substr($wewenang,4,1);

        if($wewenang_skp==1)
        {
            $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
            $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
        }
        else
        {
            $data['menuskp']="";      
        }

        $wewenang_bendahara=substr($wewenang,5,1);

        if($wewenang_bendahara==1)
        {
            $menuku .="Bendahara, ";
            $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
        }
        else
        {
            $data['menubendahara']="";      
        }    

        $wewenang_dash=substr($wewenang,6,1);

        if($wewenang_dash==1)
        {
            $menuku .="Dashboard, ";
            $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
        }
        else
        {
            $data['menudash']="";      
        }     

        $wewenang_hapusspt=substr($wewenang,7,1);

        if($wewenang_hapusspt==1)
        {
            $menuku .="Hapus SPT, ";


            $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

        }
        else
        {
            $data['hapusspt']="";      
        }   

        $wewenang_verispt=substr($wewenang,8,1);

        if($wewenang_verispt==1)
        {
            $menuku .="Verifikasi SPT, ";


            $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['verispt']="";      
        }         

        $wewenang_veriskp=substr($wewenang,9,1);

        if($wewenang_veriskp==1)
        {
            $menuku .="Verifikasi SKP, ";


            $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['veriskp']="";      
        }       

        $data["menuku"]=$menuku;
        $this->load->view('menu',$data);







        $this->load->view('reporteditor/report',$data);
        $this->load->view('header/footer',$data);
        $this->load->library('session');
        $data = array('data'=>$namauser); //set it
        $this->session->set_userdata($data);
    }

    public function operasimanajemen()
    {
        if($this->input->post('inputuser') ) 
        {
            //$namauserinput = $this->input->post('namauserinput'); 
            //$emailuserinput = $this->input->post('emailuserinput'); 

            $this->load->helper(array('form', 'url'));

            $this->load->library('form_validation');

            $this->form_validation->set_rules('namauserinput', 'Username', 'required');

            $this->form_validation->set_rules('emailuserinput', 'Email', 'required|valid_email');

            $this->form_validation->set_rules('passworduserinput', 'Password', 'required');
            $this->form_validation->set_rules('passwordulanguserinput', 'Password Confirmation', 'required|matches[passworduserinput]');


            if ($this->form_validation->run() == FALSE)
            {
                echo "<script>alert('Data yang anda masukkan tidak lengkap, atau penulisan nama user, email, dan password salah');</script>";
                $this->manajemen();
            }
            else
            {

                $namauserinput = $this->input->post('namauserinput'); 
                $emailuserinput = $this->input->post('emailuserinput'); 
                $passworduserinput = $this->input->post('passworduserinput');
                $passwordx = md5($passworduserinput);
                $statusinput = $this->input->post('statusinput'); 

                $reinput = $this->input->post('reinput');

                if($reinput==1)
                {
                    $reinput=1;
                }
                else
                {
                    $reinput=0;
                }

                $muinput = $this->input->post('muinput');

                if($muinput==1)
                {
                    $muinput=1;
                }
                else
                {
                    $muinput=0;
                }    

                $npwpinput = $this->input->post('npwpinput');

                if($npwpinput==1)
                {
                    $npwpinput=1;
                }
                else
                {
                    $npwpinput=0;
                }    

                $sptinput = $this->input->post('sptinput');

                if($sptinput==1)
                {
                    $sptinput=1;
                }
                else
                {
                    $sptinput=0;
                }  

                $skpinput = $this->input->post('skpinput');

                if($skpinput==1)
                {
                    $skpinput=1;
                }
                else
                {
                    $skpinput=0;
                }    

                $bendaharainput = $this->input->post('bendaharainput');

                if($bendaharainput==1)
                {
                    $bendaharainput=1;
                }
                else
                {
                    $bendaharainput=0;
                }   

                $dashboardinput = $this->input->post('dashboardinput');

                if($dashboardinput==1)
                {
                    $dashboardinput=1;
                }
                else
                {
                    $dashboardinput=0;
                } 

                $hapussptdinput = $this->input->post('hapussptdinput');

                if($hapussptdinput==1)
                {
                    $hapussptdinput=1;
                }
                else
                {
                    $hapussptdinput=0;
                }  

                $verisptinput = $this->input->post('verisptinput');

                if($verisptinput==1)
                {
                    $verisptinput=1;
                }
                else
                {
                    $verisptinput=0;
                }     

                $veriskpinput = $this->input->post('veriskpinput');

                if($veriskpinput==1)
                {
                    $veriskpinput=1;
                }
                else
                {
                    $veriskpinput=0;
                }                                   

                $wewenang=$reinput.$muinput.$npwpinput.$sptinput.$skpinput.$bendaharainput.$dashboardinput.$hapussptdinput.$verisptinput.$veriskpinput;

                $this->load->model('tbuser/tbuser');   

                $this->tbuser->insertuser($namauserinput,$emailuserinput,$passwordx,$statusinput,$wewenang); 

                $this->manajemen();                                                                        


            }



        }    
        elseif($this->input->post('EditUser') ) 
        {
            $namauseredit = $this->input->post('namauseredit'); 
            $emailuseredit = $this->input->post('emailuseredit'); 
            $statusedit = $this->input->post('statusedit'); 

            $reedit = $this->input->post('reedit'); 
            if($reedit==1)
            {
                $reedit=1;
            }
            else
            {
                $reedit=0;
            }

            $muedit = $this->input->post('muedit');

            if($muedit==1)
            {
                $muedit=1;
            }
            else
            {
                $muedit=0;
            }    

            $npwpedit = $this->input->post('npwpedit');

            if($npwpedit==1)
            {
                $npwpedit=1;
            }
            else
            {
                $npwpedit=0;
            }    

            $sptedit = $this->input->post('sptedit');

            if($sptedit==1)
            {
                $sptedit=1;
            }
            else
            {
                $sptedit=0;
            }  

            $skpedit = $this->input->post('skpedit');

            if($skpedit==1)
            {
                $skpedit=1;
            }
            else
            {
                $skpedit=0;
            }    

            $bendaharaedit = $this->input->post('bendaharaedit');

            if($bendaharaedit==1)
            {
                $bendaharaedit=1;
            }
            else
            {
                $bendaharaedit=0;
            }   

            $dashboardedit = $this->input->post('dashboardedit');

            if($dashboardedit==1)
            {
                $dashboardedit=1;
            }
            else
            {
                $dashboardedit=0;
            }  

            $hapussptdedit = $this->input->post('hapussptdedit');

            if($hapussptdedit==1)
            {
                $hapussptdedit=1;
            }
            else
            {
                $hapussptdedit=0;
            } 

            $verisptedit = $this->input->post('verisptedit');

            if($verisptedit==1)
            {
                $verisptedit=1;
            }
            else
            {
                $verisptedit=0;
            }    

            $veriskpedit = $this->input->post('veriskpedit');

            if($veriskpedit==1)
            {
                $veriskpedit=1;
            }
            else
            {
                $veriskpedit=0;
            }                    

            $wewenang=$reedit.$muedit.$npwpedit.$sptedit.$skpedit.$bendaharaedit.$dashboardedit.$hapussptdedit.$verisptedit.$veriskpedit;

            $this->load->model('tbuser/tbuser');   

            $this->tbuser->updateuser($namauseredit,$emailuseredit,$statusedit,$wewenang); 

            $this->manajemen();                                                                        



        }     
        elseif($this->input->post('EditPasswordUser') ) 
        {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('passworduseredit', 'Password', 'required');
            $this->form_validation->set_rules('passwordulanguseredit', 'Password Confirmation', 'required|matches[passworduseredit]');


            if ($this->form_validation->run() == FALSE)
            {
                echo "<script>alert('Data password yang anda masukkan tidak cocok');</script>";
                $this->manajemen();
            }
            else
            {
                $namausereditpassword = $this->input->post('namausereditpassword'); 
                $passworduseredit = $this->input->post('passworduseredit');
                $passwordx = md5($passworduseredit);

                $this->load->model('tbuser/tbuser');   

                $this->tbuser->updatepassworduser($namausereditpassword,$passwordx); 

                $this->manajemen();  

            }



        }    
        else
        {
            $this->manajemen();
        }     
    }

    public function manajemen()
    {
        $this->load->library('session');
        $namauser=$this->session->userdata('Nama');
        $data['Nama'] = $this->session->userdata('Nama');

        $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
        if ($q->num_rows() == 1) 
        {
            $wewenang=$q->row()->Wewenang;
        }

        $this->load->view('header/header',$data);


        $menuku="";

        $wewenang_reporteditor=substr($wewenang,0,1);

        if($wewenang_reporteditor==1)
        {
            $menuku .="Report Editor, ";
            $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
        }
        else
        {
            $data['menure']="";      
        }

        $wewenang_manajemenuser=substr($wewenang,1,1);

        if($wewenang_manajemenuser==1)
        {
            $menuku .="Manajemen User, ";
            $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
        }
        else
        {
            $data['menumu']="";      
        }

        $wewenang_npwp=substr($wewenang,2,1);

        if($wewenang_npwp==1)
        {
            $menuku .="Pendaftaran NPWPD, ";
            $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
        }
        else
        {
            $data['menunpwp']="";      
        }

        $wewenang_spt=substr($wewenang,3,1);

        if($wewenang_spt==1)
        {
            $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
            $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
        }
        else
        {
            $data['menuspt']="";      
        }       

        $wewenang_skp=substr($wewenang,4,1);

        if($wewenang_skp==1)
        {
            $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
            $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
        }
        else
        {
            $data['menuskp']="";      
        }

        $wewenang_bendahara=substr($wewenang,5,1);

        if($wewenang_bendahara==1)
        {
            $menuku .="Bendahara, ";
            $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
        }
        else
        {
            $data['menubendahara']="";      
        }    

        $wewenang_dash=substr($wewenang,6,1);

        if($wewenang_dash==1)
        {
            $menuku .="Dashboard, ";
            $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
        }
        else
        {
            $data['menudash']="";      
        }   

        $wewenang_hapusspt=substr($wewenang,7,1);

        if($wewenang_hapusspt==1)
        {
            $menuku .="Hapus SPT, ";


            $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

        }
        else
        {
            $data['hapusspt']="";      
        }   

        $wewenang_verispt=substr($wewenang,8,1);

        if($wewenang_verispt==1)
        {
            $menuku .="Verifikasi SPT, ";


            $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['verispt']="";      
        }         

        $wewenang_veriskp=substr($wewenang,9,1);

        if($wewenang_veriskp==1)
        {
            $menuku .="Verifikasi SKP, ";


            $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>'>";
        }
        else
        {
            $data['veriskp']="";      
        }   



        $data["menuku"]=$menuku;
        $this->load->view('menu',$data);

        $this->load->model('tbuser/tbuser');

        $data["user"]=$this->tbuser->loaddatauser();

        $this->load->view('manajemen/manajemen',$data);
        $this->load->view('header/footer',$data);
        $this->load->library('session');
        $data = array('data'=>$namauser); //set it
        $this->session->set_userdata($data);
    }

    public function dashboard($id=NULL)
    {
        $this->load->library('session');
        $namauser=$this->session->userdata('Nama');
        $data['Nama'] = $this->session->userdata('Nama');
        $data['StatusUser'] =  $this->session->userdata('StatusUser');

        $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
        if ($q->num_rows() == 1) 
        {
            $wewenang=$q->row()->Wewenang;
        }

        $this->load->view('header/header',$data);


        $menuku="";

        $wewenang_reporteditor=substr($wewenang,0,1);

        if($wewenang_reporteditor==1)
        {
            $menuku .="Report Editor, ";
            $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
        }
        else
        {
            $data['menure']="";      
        }

        $wewenang_manajemenuser=substr($wewenang,1,1);

        if($wewenang_manajemenuser==1)
        {
            $menuku .="Manajemen User, ";
            $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
        }
        else
        {
            $data['menumu']="";      
        }

        $wewenang_npwp=substr($wewenang,2,1);

        if($wewenang_npwp==1)
        {
            $menuku .="Pendaftaran NPWPD, ";
            $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
        }
        else
        {
            $data['menunpwp']="";      
        }

        $wewenang_spt=substr($wewenang,3,1);

        if($wewenang_spt==1)
        {
            $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
            $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
        }
        else
        {
            $data['menuspt']="";      
        }       

        $wewenang_skp=substr($wewenang,4,1);

        if($wewenang_skp==1)
        {
            $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
            $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
        }
        else
        {
            $data['menuskp']="";      
        }

        $wewenang_bendahara=substr($wewenang,5,1);

        if($wewenang_bendahara==1)
        {
            $menuku .="Bendahara, ";
            $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
        }
        else
        {
            $data['menubendahara']="";      
        }    

        $wewenang_dash=substr($wewenang,6,1);

        if($wewenang_dash==1)
        {
            $menuku .="Dashboard, ";
            $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
        }
        else
        {
            $data['menudash']="";      
        }    

        $wewenang_hapusspt=substr($wewenang,7,1);

        if($wewenang_hapusspt==1)
        {
            $menuku .="Hapus SPT, ";


            $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

        }
        else
        {
            $data['hapusspt']="";      
        }   

        $wewenang_verispt=substr($wewenang,8,1);

        if($wewenang_verispt==1)
        {
            $menuku .="Verifikasi SPT, ";


            $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['verispt']="";      
        }         

        $wewenang_veriskp=substr($wewenang,9,1);

        if($wewenang_veriskp==1)
        {
            $menuku .="Verifikasi SKP, ";


            $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>'>";
        }
        else
        {
            $data['veriskp']="";      
        }             

        $data["menuku"]=$menuku;
        $this->load->view('menu',$data);    

        $this->load->model('grafik/grafik');

        $data["lapskp"]=$this->grafik->lapskp();


        $this->load->database();
        $jumlah_data = $this->grafik->jumlah_data();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'con_menuutama/dashboard';
        $config['total_rows'] = $jumlah_data;        
        $this->pagination->initialize($config); 
        $data["lapspt_all"]=$this->grafik->data(5,$this->uri->segment(3));

        $this->load->database();
        $jumlah_data = $this->grafik->jumlah_data2();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'con_menuutama/dashboard';
        $config['total_rows'] = $jumlah_data;        
        $this->pagination->initialize($config); 
        $data["lapskpall"]=$this->grafik->data2(5,$this->uri->segment(3));        

        //$data["lapspt_all"]=$this->grafik->lapspt_all();

        $this->load->view('dashboard/dashboard',$data);
        $this->load->view('header/footer',$data);
        $this->load->library('session');
        $data = array('data'=>$namauser); //set it
        $this->session->set_userdata($data);
    }


    public function npwpd($id=null)
    {
        $this->load->library('session');
        $namauser=$this->session->userdata('Nama');
        $data['Nama'] = $this->session->userdata('Nama');


        $this->load->model('pegawai/pegawai_model');
        $data['listdata'] = $this->pegawai_model->data_user($namauser);

        $this->load->model('daerah/daerah');
        $data['prov'] = $this->daerah->data_provinsi();

        $this->load->model('npwpd/npwpd');
        $data['nomorku'] = $this->npwpd->nonpwpd();



        $limit = 10;
        $data['offset'] = $this->uri->segment(3);
        $data['limit'] = $limit;
        $data['jumlah_produk']=$this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
        $config['base_url'] = base_url().'con_menuutama/npwpd';
        $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Selanjutnya';
        $config['prev_link'] = 'Sebelumnya';
        $this->pagination->initialize($config);
        $data['halaman'] = $this->pagination->create_links();
        $data['npwpd_terverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'Terverifikasi');



        $this->load->model('npwpd/npwpd');
        $limit = 10;
        $data['offset'] = $this->uri->segment(3);
        $data['limit'] = $limit;
        $data['jumlah_produk2']=$this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
        $config['base_url'] = base_url().'con_menuutama/npwpd';
        $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Selanjutnya';
        $config['prev_link'] = 'Sebelumnya';
        $this->pagination->initialize($config);
        $data['halaman2'] = $this->pagination->create_links();
        $data['npwpd_belumterverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'BelumTerverifikasi');


        $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$namauser."'");
        if ($q->num_rows() == 1) 
        {
            $wewenang=$q->row()->Wewenang;
        }

        $this->load->view('header/header',$data);


        $menuku="";

        $wewenang_reporteditor=substr($wewenang,0,1);

        if($wewenang_reporteditor==1)
        {
            $menuku .="Report Editor, ";
            $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
        }
        else
        {
            $data['menure']="";      
        }

        $wewenang_manajemenuser=substr($wewenang,1,1);

        if($wewenang_manajemenuser==1)
        {
            $menuku .="Manajemen User, ";
            $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
        }
        else
        {
            $data['menumu']="";      
        }

        $wewenang_npwp=substr($wewenang,2,1);

        if($wewenang_npwp==1)
        {
            $menuku .="Pendaftaran NPWPD, ";
            $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
        }
        else
        {
            $data['menunpwp']="";      
        }

        $wewenang_spt=substr($wewenang,3,1);

        if($wewenang_spt==1)
        {
            $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
            $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
        }
        else
        {
            $data['menuspt']="";      
        }       

        $wewenang_skp=substr($wewenang,4,1);

        if($wewenang_skp==1)
        {
            $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
            $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
        }
        else
        {
            $data['menuskp']="";      
        }

        $wewenang_bendahara=substr($wewenang,5,1);

        if($wewenang_bendahara==1)
        {
            $menuku .="Bendahara, ";
            $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
        }
        else
        {
            $data['menubendahara']="";      
        }    

        $wewenang_dash=substr($wewenang,6,1);

        if($wewenang_dash==1)
        {
            $menuku .="Dashboard, ";
            $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
        }
        else
        {
            $data['menudash']="";      
        }           

        $wewenang_hapusspt=substr($wewenang,7,1);

        if($wewenang_hapusspt==1)
        {
            $menuku .="Hapus SPT, ";


            $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

        }
        else
        {
            $data['hapusspt']="";      
        }   

        $wewenang_verispt=substr($wewenang,8,1);

        if($wewenang_verispt==1)
        {
            $menuku .="Verifikasi SPT, ";


            $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
        }
        else
        {
            $data['verispt']="";      
        }         

        $wewenang_veriskp=substr($wewenang,9,1);

        if($wewenang_veriskp==1)
        {
            $menuku .="Verifikasi SKP, ";


            $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>'>";
        }
        else
        {
            $data['veriskp']="";      
        }     

        $data["menuku"]=$menuku;
        $this->load->view('menu',$data);

        $this->load->model('tbuser/tbuser');





        $this->load->view('npwpd/npwpd',$data);
        $this->load->view('header/footer',$data);
        $this->load->library('session');
        $data = array('data'=>$namauser); //set it
        $this->session->set_userdata($data);
    }


    function add_kab($prov)
    {
        $queryprov = $this->db->get_where('provinsi',array('nama'=>$prov));
        foreach ($queryprov->result() as $value) {
            $kodeprov=$value->kode;
        }


        $query = $this->db->get_where('kab',array('kodeprov'=>$kodeprov));
        $data = "<option value=''>-Kabupaten/Kota-</option>";
        foreach ($query->result() as $value2) {
            $data .= "<option value='".$value2->namakab."'>".$value2->namakab."</option>";
        }
        echo $data;
    }

    function add_kec($kab)
    {
        $querykab = $this->db->get_where('kab',array('namakab'=>$kab));
        foreach ($querykab->result() as $value) {
            $kodekab=$value->kodekab;
        }



        $query=$this->db->query("SELECT distinct kodekec,namakec FROM kecamatan where kodekab='$kodekab'");

        $data = "<option value=''>-Kecamatan-</option>";
        foreach ($query->result() as $value2) {
            $data .= "<option value='".$value2->namakec."'>".$value2->namakec."</option>";
        }
        echo $data;
    }

    function add_kel($kec)
    {
        $querykab = $this->db->get_where('kecamatan',array('namakec'=>$kec));
        foreach ($querykab->result() as $value) {
            $kodekec=$value->kodekec;
        }



        $query=$this->db->query("SELECT distinct kodekel,namakel FROM kecamatan where kodekec='$kodekec'");

        $data = "<option value=''>-Kelurahan-</option>";
        foreach ($query->result() as $value2) {
            $data .= "<option value='".$value2->namakel."'>".$value2->namakel."</option>";
        }
        echo $data;
    }


    public function operasinpwpd() 
    {
        if($this->input->post('Refresh') ) 
        {
            $this->npwpd();
        }

        elseif($this->input->post('caridatanpwpdaktif') ) 
        {
            $NPWPD = $this->input->post('NPWPDaktif');
            $NamaWP = $this->input->post('NamaNPWPDaktif');
            $AlamatWP = $this->input->post('AlamatNPWPDaktif');



            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');
            $data['Nama'] = $this->session->userdata('Nama');
            $data['StatusUser'] =  $this->session->userdata('StatusUser');

            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('daerah/daerah');
            $data['prov'] = $this->daerah->data_provinsi();

            $this->load->model('npwpd/npwpd');

            $this->load->model('npwpd/npwpd');
            $data['nomorku'] = $this->npwpd->nonpwpd();



            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk']=$this->npwpd->jumlah_cari_npwpd_aktif($NPWPD,$NamaWP,$AlamatWP,'Terverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_npwpd_aktif($NPWPD,$NamaWP,$AlamatWP,'Terverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();
            $data['npwpd_terverifikasi'] = $this->npwpd->cari_npwpd($this->uri->segment(3),$limit,$NPWPD,$NamaWP,$AlamatWP,'Terverifikasi');



            $this->load->model('npwpd/npwpd');
            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk2']=$this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman2'] = $this->pagination->create_links();
            $data['npwpd_belumterverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'BelumTerverifikasi');


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }        

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>'>";
            }
            else
            {
                $data['veriskp']="";      
            }        

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);


            $this->load->view('npwpd/npwpd',$data);
            $this->load->view('header/footer',$data);
            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);
        }
        elseif($this->input->post('caridatanpwpdtidakaktif') ) 
        {



            $NPWPD = $this->input->post('NPWPDtidakaktif');
            $NamaWP = $this->input->post('NamaNPWPDtidakaktif');
            $AlamatWP = $this->input->post('AlamatNPWPDtidakaktif');



            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');
            $data['Nama'] = $this->session->userdata('Nama');

            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('daerah/daerah');
            $data['prov'] = $this->daerah->data_provinsi();   

            $this->load->model('npwpd/npwpd');         

            $this->load->model('npwpd/npwpd');
            $data['nomorku'] = $this->npwpd->nonpwpd();


            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk']=$this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();
            $data['npwpd_terverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'Terverifikasi');




            $this->load->model('npwpd/npwpd');
            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk2']=$this->npwpd->jumlah_cari_npwpd_aktif($NPWPD,$NamaWP,$AlamatWP,'BelumTerverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_npwpd_aktif($NPWPD,$NamaWP,$AlamatWP,'BelumTerverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman2'] = $this->pagination->create_links();
            $data['npwpd_belumterverifikasi'] = $this->npwpd->cari_npwpd($this->uri->segment(3),$limit,$NPWPD,$NamaWP,$AlamatWP,'BelumTerverifikasi');


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }            

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>'>";
            }
            else
            {
                $data['veriskp']="";      
            }   

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);


            $this->load->view('npwpd/npwpd',$data);
            $this->load->view('header/footer',$data);
            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);



        }
        elseif($this->input->post('TambahBaru') ) 
        {
            $NamaWP = $this->input->post('NamaNPWPD_inputbaru');
            $AlamatWP = $this->input->post('AlamatNPWPD_inputbaru');
            $ProvWP = $this->input->post('prov');
            $KabWP = $this->input->post('kab');
            $KecWP = $this->input->post('kec');
            $KelWP = $this->input->post('kel');

            $this->load->model('npwpd/npwpd');
            $nourut_ = $this->npwpd->nonpwpd();
            foreach( $nourut_ as $_nourut_)
            {
                $nourut=$_nourut_->nomor;
            }

            $this->load->model('npwpd/npwpd');
            $kab_ = $this->npwpd->carikodekab($KabWP);
            foreach( $kab_ as $_kab_)
            {
                $kab=$_kab_->kodekab;
            }


            $this->load->model('npwpd/npwpd');
            $kec_ = $this->npwpd->carikodekec($KecWP);
            foreach( $kec_ as $_kec_)
            {
                $kec=$_kec_->kodekec;
            } 


            $this->load->model('npwpd/npwpd');
            $kel_ = $this->npwpd->carikodekel($KecWP,$KelWP);
            foreach( $kel_ as $_kel_)
            {
                $kel=$_kel_->kodekel;
            }  

            $this->npwpd->insertnpwpd($nourut,$kab.".".$kec.".".$kel.".000-".$nourut.".0",$NamaWP,$AlamatWP,$ProvWP,$KabWP,$KecWP,$KelWP);         


            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');
            $data['Nama'] = $this->session->userdata('Nama');

            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('daerah/daerah');
            $data['prov'] = $this->daerah->data_provinsi();

            $this->load->model('npwpd/npwpd');
            $data['nomorku'] = $this->npwpd->nonpwpd();

            $this->load->model('npwpd/npwpd');
            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk']=$this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();
            $data['npwpd_terverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'Terverifikasi');



            $this->load->model('npwpd/npwpd');
            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk2']=$this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman2'] = $this->pagination->create_links();
            $data['npwpd_belumterverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'BelumTerverifikasi');


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }          

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>'>";
            }
            else
            {
                $data['veriskp']="";      
            }      

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);


            $this->load->view('npwpd/npwpd',$data);
            $this->load->view('header/footer',$data);
            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);

        }
        elseif($this->input->post('AktifkanNPWPD') ) 
        {
            $NPWPDAktif = $this->input->post('NPWPDAktif');
            $NamaWPAktif = $this->input->post('NamaWPAktif');
            $AlamatWPAktif = $this->input->post('AlamatWPAktif');

            $this->load->model('npwpd/npwpd');
            $this->npwpd->updatestatusnpwpd($NPWPDAktif,'Terverifikasi',$NamaWPAktif,$AlamatWPAktif);

            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');
            $data['Nama'] = $this->session->userdata('Nama');


            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('daerah/daerah');
            $data['prov'] = $this->daerah->data_provinsi();

            $this->load->model('npwpd/npwpd');
            $data['nomorku'] = $this->npwpd->nonpwpd();



            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk']=$this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();
            $data['npwpd_terverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'Terverifikasi');



            $this->load->model('npwpd/npwpd');
            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk2']=$this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman2'] = $this->pagination->create_links();
            $data['npwpd_belumterverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'BelumTerverifikasi');


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }        

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>'>";
            }
            else
            {
                $data['veriskp']="";      
            }   

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);


            $this->load->view('npwpd/npwpd',$data);
            $this->load->view('header/footer',$data);
            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);

        }
        elseif($this->input->post('EditNPWPD') ) 
        {


            $NPWPDEdit = $this->input->post('NPWPDEdit');
            $NamaWPEdit = $this->input->post('NamaWPEdit');
            $AlamatWPEdit = $this->input->post('AlamatWPEdit');

            $this->load->model('npwpd/npwpd');
            $this->npwpd->updatestatusnpwpd($NPWPDEdit,'Terverifikasi',$NamaWPEdit,$AlamatWPEdit);

            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');
            $data['Nama'] = $this->session->userdata('Nama');


            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('daerah/daerah');
            $data['prov'] = $this->daerah->data_provinsi();

            $this->load->model('npwpd/npwpd');
            $data['nomorku'] = $this->npwpd->nonpwpd();



            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk']=$this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();
            $data['npwpd_terverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'Terverifikasi');



            $this->load->model('npwpd/npwpd');
            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk2']=$this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman2'] = $this->pagination->create_links();
            $data['npwpd_belumterverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'BelumTerverifikasi');


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }       

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>'>";
            }
            else
            {
                $data['veriskp']="";      
            }        

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);


            $this->load->view('npwpd/npwpd',$data);
            $this->load->view('header/footer',$data);
            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);            
        }

        elseif($this->input->post('HapusNPWPD') ) 
        {


            $NPWPDHapus = $this->input->post('NPWPDHapus');
            $NamaWPHapus = $this->input->post('NamaWPHapus');
            $AlamatWPHapus = $this->input->post('AlamatWPHapus');

            $this->load->model('npwpd/npwpd');
            $this->npwpd->updatestatusnpwpd($NPWPDHapus,'BelumTerverifikasi',$NamaWPHapus,$AlamatWPHapus);

            $this->load->library('session');
            $namauser=$this->session->userdata('Nama');
            $data['Nama'] = $this->session->userdata('Nama');


            $this->load->model('pegawai/pegawai_model');
            $data['listdata'] = $this->pegawai_model->data_user($namauser);

            $this->load->model('daerah/daerah');
            $data['prov'] = $this->daerah->data_provinsi();

            $this->load->model('npwpd/npwpd');
            $data['nomorku'] = $this->npwpd->nonpwpd();



            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk']=$this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('Terverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();
            $data['npwpd_terverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'Terverifikasi');



            $this->load->model('npwpd/npwpd');
            $limit = 10;
            $data['offset'] = $this->uri->segment(3);
            $data['limit'] = $limit;
            $data['jumlah_produk2']=$this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
            $config['base_url'] = base_url().'con_menuutama/npwpd';
            $config['total_rows'] = $this->npwpd->jumlah_cari_produk_jenis('BelumTerverifikasi');
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['halaman2'] = $this->pagination->create_links();
            $data['npwpd_belumterverifikasi'] = $this->npwpd->cari_produk_jenis($this->uri->segment(3),$limit,'BelumTerverifikasi');


            $q = $this->db->query("SELECT Nomor,Nama,Email,Password,StatusUser,Status,Wewenang FROM `tbuser` WHERE `Nama`='".$this->session->userdata('Nama')."'");
            if ($q->num_rows() == 1) 
            {
                $wewenang=$q->row()->Wewenang;
            }

            $this->load->view('header/header',$data);


            $menuku="";

            $wewenang_reporteditor=substr($wewenang,0,1);

            if($wewenang_reporteditor==1)
            {
                $menuku .="Report Editor, ";
                $data['menure']="<a href='". base_url()."con_menuutama/report'>Report Editor</a>";
            }
            else
            {
                $data['menure']="";      
            }

            $wewenang_manajemenuser=substr($wewenang,1,1);

            if($wewenang_manajemenuser==1)
            {
                $menuku .="Manajemen User, ";
                $data['menumu']="<a href='". base_url()."con_menuutama/manajemen'>Manajemen User</a>";
            }
            else
            {
                $data['menumu']="";      
            }

            $wewenang_npwp=substr($wewenang,2,1);

            if($wewenang_npwp==1)
            {
                $menuku .="Pendaftaran NPWPD, ";
                $data['menunpwp']="<a href='". base_url()."con_menuutama/npwpd'>Pendaftaran NPWPD</a>";
            }
            else
            {
                $data['menunpwp']="";      
            }

            $wewenang_spt=substr($wewenang,3,1);

            if($wewenang_spt==1)
            {
                $menuku .="Surat Pemberitahuan Pajak Daerah (SPTPD), ";
                $data['menuspt']="<a href='". base_url()."con_menuutama/sptpd'>Surat Pemberitahuan Pajak Daerah (SPTPD)</a>";
            }
            else
            {
                $data['menuspt']="";      
            }       

            $wewenang_skp=substr($wewenang,4,1);

            if($wewenang_skp==1)
            {
                $menuku .="Surat Ketetapan Pajak Daerah (SKP), ";
                $data['menuskp']="<a href='". base_url()."con_menuutama/skp'>Surat Ketetapan Pajak Daerah (SKP)</a>";
            }
            else
            {
                $data['menuskp']="";      
            }

            $wewenang_bendahara=substr($wewenang,5,1);

            if($wewenang_bendahara==1)
            {
                $menuku .="Bendahara, ";
                $data['menubendahara']="<a href='".base_url()."con_menuutama/loadbendahara'><i class='glyphicon glyphicon-credit-card'></i> Bendahara</a>";
            }
            else
            {
                $data['menubendahara']="";      
            }    

            $wewenang_dash=substr($wewenang,6,1);

            if($wewenang_dash==1)
            {
                $menuku .="Dashboard, ";
                $data['menudash']="<a href='".base_url()."con_menuutama/dashboard'><i class='glyphicon glyphicon-dashboard'></i> Dashboard</a>";
            }
            else
            {
                $data['menudash']="";      
            }            

            $wewenang_hapusspt=substr($wewenang,7,1);

            if($wewenang_hapusspt==1)
            {
                $menuku .="Hapus SPT, ";


                $data['hapusspt']="<input type='submit' name='HapusSPTPD' value='Non Aktifkan SPTPD' class='btn btn-danger btn-md'>";

            }
            else
            {
                $data['hapusspt']="";      
            }   

            $wewenang_verispt=substr($wewenang,8,1);

            if($wewenang_verispt==1)
            {
                $menuku .="Verifikasi SPT, ";


                $data['verispt']="<input type='submit' name='verifikasisptpd' value='Aktifkan' class='btn btn-info btn-md'>";
            }
            else
            {
                $data['verispt']="";      
            }         

            $wewenang_veriskp=substr($wewenang,9,1);

            if($wewenang_veriskp==1)
            {
                $menuku .="Verifikasi SKP, ";


                $data['veriskp']="<input type='submit' name='verifikasiskp' value='Aktifkan' class='btn btn-info btn-md'>'>";
            }
            else
            {
                $data['veriskp']="";      
            }    

            $data["menuku"]=$menuku;
            $this->load->view('menu',$data);


            $this->load->view('npwpd/npwpd',$data);
            $this->load->view('header/footer',$data);
            $this->load->library('session');
            $data = array('data'=>$namauser); //set it
            $this->session->set_userdata($data);            
        }        

    }


}
?>

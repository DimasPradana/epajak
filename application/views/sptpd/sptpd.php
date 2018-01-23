<!DOCTYPE html>
<html>
  <head>
  	<link href='<?php echo base_url();?>assets/halamanutama/gambar/icon.png' rel='shortcut icon'>
    <title>e-Pajak Daerah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/pegawai/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="<?php echo base_url();?>assets/pegawai/css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url(); ?>assets/pegawai/js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            $("#npwpdbaru").change(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/cariwp212/"+$(this).val();
                $('#namawpbaru').load(url);   
                return false;
            }) 

            $("#npwpdbaru").keyup(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/cariwp212/"+$(this).val();
                $('#namawpbaru').load(url);   
                return false;
            }) 

            $("#jenispajakbaru").change(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_objek/"+$(this).val();
                var url2 = "";
                var url3 = "<?php echo base_url(); ?>con_menuutama/add_null/0";
                $('#obyekpajakbaru').load(url);   
                $('#kodeobyekbaru').val(url2);   
                $('#zonabaru').load(url3); 
                $('#nilaistrategisbaru').load(url3); 
                $('#koderuasjalanbaru').val(url2);


                var obyekpajak=$('#kodeobyekbaru').val();
                var ruasjalan =$('#ruasjalanbaru').val();
                var sisi=$('#sisibaru').val();
                var luas=$('#luasbaru').val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url4="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url4);




                return false;
            }) 

            $("#jenispajakbaru").keyup(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_objek/"+$(this).val();
                var url2 = "";
                var url3 = "<?php echo base_url(); ?>con_menuutama/add_null/0";
                $('#obyekpajakbaru').load(url);  
                $('#kodeobyekbaru').val(url2);
                $('#zonabaru').load(url3);  
                $('#nilaistrategisbaru').load(url3);  
                $('#koderuasjalanbaru').val(url2); 



                var obyekpajak=$('#kodeobyekbaru').val();
                var ruasjalan =$('#ruasjalanbaru').val();
                var sisi=$('#sisibaru').val();
                var luas=$('#luasbaru').val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url4="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url4);


                return false;
            })

            $("#jenispajakbaru").change(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_ruas/"+$(this).val();
                $('#ruasjalanbaru').load(url);                
                return false;
            }) 

            $("#jenispajakbaru").keyup(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_ruas/"+$(this).val();
                $('#ruasjalanbaru').load(url);                
                return false;
            })            

                         
            $("#obyekpajakbaru").change(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_prosentase/"+ $(this).val();
                $('#prosentasebaru').load(url);                 
                return false;
            }) 

            //$("#obyekpajakbaru").change(function (){            
            //    document.getElementById("jumlahsatuanbaru").disabled = true;                
            //    return false;
            //}) 

            //$("#obyekpajakbaru").keyup(function (){            
            //    document.getElementById("jumlahsatuanbaru").disabled = true;                 
            //    return false;
            //})                         

            $("#obyekpajakbaru").keyup(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_prosentase/"+ $(this).val();
                $('#prosentasebaru').load(url);                 
                return false;
            }) 

            $("#obyekpajakbaru").change(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_satuan/"+ $(this).val();
                $('#satuanbaru').load(url);                 
                return false;
            }) 

            $("#obyekpajakbaru").keyup(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_satuan/"+ $(this).val();
                $('#satuanbaru').load(url);                 
                return false;
            }) 

            $("#ruasjalanbaru").change(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/carinilaistrategis/"+ $(this).val();
                $('#zonabaru').load(url); 

               return false;
            }) 

            $("#ruasjalanbaru").keyup(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/carinilaistrategis/"+ $(this).val();
                $('#zonabaru').load(url);                 
                return false;
            }) 

            $("#obyekpajakbaru").change(function (){            
                var url = $(this).val(); 
                $('#kodeobyekbaru').val(url); 

                var obyekpajak=$(this).val();
                var ruasjalan = $('#koderuasjalanbaru').val();
                var sisi =$('#sisibaru').val();
                var luas=$('#luasbaru').val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url2="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url2);

                if(url==1 || url==2 || url==3 || url==4 || url==5 || url==6 || url==7 || url==8 || url==9 || url==10 || url==11 || url==12 || url==13 || url==42 || url==92)
                {
                    document.getElementById("nilaipajakbaru").disabled = false;                   
                    document.getElementById("sisibaru").disabled = true;
                    document.getElementById("luasbaru").disabled = true;
                    document.getElementById("lebarbaru").disabled = true;
                    document.getElementById("ruasjalanbaru").disabled = true;
                    document.getElementById("jumlahreklamebaru").disabled = true;
                    document.getElementById("jumlahsatuanbaru").disabled = true;

                    
                }
                else
                {

                    if(url==74 || url==75 || url==76 || url==77 || url==43 || url==44 || url==45 || url==46 || url==47 || url==48 || url==49 || url==50 || url==51 || url==52 || url==53 || url==54 || url==55 || url==56 || url==57 || url==58 || url==59 || url==60 || url==61 || url==62 || url==63 || url==64 || url==65 || url==66 || url==67 || url==68 || url==69 || url==70 || url==71 || url==72 || url==73)
                    {                        
                        document.getElementById("nilaipajakbaru").disabled = true;
                        document.getElementById("sisibaru").disabled = true;
                        document.getElementById("luasbaru").disabled = true;
                        document.getElementById("lebarbaru").disabled = true;
                        document.getElementById("ruasjalanbaru").disabled = true;
                        document.getElementById("jumlahreklamebaru").disabled = true;                        
                        document.getElementById("jumlahsatuanbaru").disabled = false;
                    }
                    else
                    {
                        if(url==78 || url==79 || url==80 || url==81 || url==82 || url==83 || url==84 || url==85 || url==86 || url==87 || url==88 || url==89 || url==90 || url==91)
                        {
                            document.getElementById("nilaipajakbaru").disabled = false;
                            document.getElementById("sisibaru").disabled = true;
                            document.getElementById("luasbaru").disabled = true;
                            document.getElementById("lebarbaru").disabled = true;
                            document.getElementById("ruasjalanbaru").disabled = true;
                            document.getElementById("jumlahreklamebaru").disabled = true;                        
                            document.getElementById("jumlahsatuanbaru").disabled = true;
                        }
                        else
                        {
                            document.getElementById("nilaipajakbaru").disabled = true;
                            document.getElementById("sisibaru").disabled = false;
                            document.getElementById("luasbaru").disabled = false;
                            document.getElementById("lebarbaru").disabled = false;
                            document.getElementById("ruasjalanbaru").disabled = false;
                            document.getElementById("jumlahreklamebaru").disabled = false;                        
                            document.getElementById("jumlahsatuanbaru").disabled = false;                            
                        }
                        
                    }
                }

                return false;
            }) 

            $("#obyekpajakbaru").keyup(function (){            
                var url =  $(this).val();
                $('#kodeobyekbaru').val(url);   

                var obyekpajak=$(this).val();
                var ruasjalan = $('#koderuasjalanbaru').val();
                var sisi =$('#sisibaru').val();
                var luas=$('#luasbaru').val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url2="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url2);

                if(url==1 || url==2 || url==3 || url==4 || url==5 || url==6 || url==7 || url==8 || url==9 || url==10 || url==11 || url==12 || url==13 || url==42 || url==92)
                {
                    document.getElementById("nilaipajakbaru").disabled = false;                   
                    document.getElementById("sisibaru").disabled = true;
                    document.getElementById("luasbaru").disabled = true;
                    document.getElementById("lebarbaru").disabled = true;
                    document.getElementById("ruasjalanbaru").disabled = true;
                    document.getElementById("jumlahreklamebaru").disabled = true;
                    document.getElementById("jumlahsatuanbaru").disabled = true;

                    
                }
                else
                {

                    if(url==74 || url==75 || url==76 || url==77 || url==43 || url==44 || url==45 || url==46 || url==47 || url==48 || url==49 || url==50 || url==51 || url==52 || url==53 || url==54 || url==55 || url==56 || url==57 || url==58 || url==59 || url==60 || url==61 || url==62 || url==63 || url==64 || url==65 || url==66 || url==67 || url==68 || url==69 || url==70 || url==71 || url==72 || url==73)
                    {                        
                        document.getElementById("nilaipajakbaru").disabled = true;
                        document.getElementById("sisibaru").disabled = true;
                        document.getElementById("luasbaru").disabled = true;
                        document.getElementById("lebarbaru").disabled = true;
                        document.getElementById("ruasjalanbaru").disabled = true;
                        document.getElementById("jumlahreklamebaru").disabled = true;                        
                        document.getElementById("jumlahsatuanbaru").disabled = false;
                    }
                    else
                    {
                        if(url==78 || url==79 || url==80 || url==81 || url==82 || url==83 || url==84 || url==85 || url==86 || url==87 || url==88 || url==89 || url==90 || url==91)
                        {
                            document.getElementById("nilaipajakbaru").disabled = false;
                            document.getElementById("sisibaru").disabled = true;
                            document.getElementById("luasbaru").disabled = true;
                            document.getElementById("lebarbaru").disabled = true;
                            document.getElementById("ruasjalanbaru").disabled = true;
                            document.getElementById("jumlahreklamebaru").disabled = true;                        
                            document.getElementById("jumlahsatuanbaru").disabled = true;
                        }
                        else
                        {
                            document.getElementById("nilaipajakbaru").disabled = true;
                            document.getElementById("sisibaru").disabled = false;
                            document.getElementById("luasbaru").disabled = false;
                            document.getElementById("lebarbaru").disabled = false;
                            document.getElementById("ruasjalanbaru").disabled = false;
                            document.getElementById("jumlahreklamebaru").disabled = false;                        
                            document.getElementById("jumlahsatuanbaru").disabled = false;                            
                        }                       
                    }
                }

                return false;
            }) 

            $("#ruasjalanbaru").keyup(function (){            
                var text1 = $('#kodeobyekbaru').val();




                var text2 = $(this).val();

                var gab=text1+";"+text2;

                var url = "<?php echo base_url(); ?>con_menuutama/carinilaistrategis2/"+ text1+"c"+text2;
                $('#nilaistrategisbaru').load(url);

                $('#koderuasjalanbaru').val(text2);



                var obyekpajak=$('#kodeobyekbaru').val();
                var ruasjalan =$(this).val();
                var sisi =$('#sisibaru').val();
                var luas=$('#luasbaru').val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url2="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url2);
                
                return false;
            })   

            $("#ruasjalanbaru").change(function (){            
                var text1 = $('#kodeobyekbaru').val();
                var text2 = $(this).val();

                var gab=text1+";"+text2;

                var url = "<?php echo base_url(); ?>con_menuutama/carinilaistrategis2/"+ text1+"c"+text2;
                $('#nilaistrategisbaru').load(url);

                $('#koderuasjalanbaru').val(text2);


                var obyekpajak=$('#kodeobyekbaru').val();
                var ruasjalan =$(this).val();
                var sisi =$('#sisibaru').val();
                var luas=$('#luasbaru').val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url2="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url2);

                
                return false;
            })  

            $("#obyekpajakbaru").change(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_njop/"+ $(this).val();
                $('#NJOPbaru').load(url);                 
                return false;
            }) 

            $("#obyekpajakbaru").keyup(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_njop/"+ $(this).val();
                $('#NJOPbaru').load(url);                 
                return false;
            })             

            $("#sisibaru").change(function (){            

                var obyekpajak=$('#kodeobyekbaru').val();
                var ruasjalan =$('#ruasjalanbaru').val();
                var sisi=$(this).val();
                var luas=$('#luasbaru').val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url2="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url2);
                 
                return false;
            }) 


            $("#luasbaru").change(function (){            

                var obyekpajak=$('#kodeobyekbaru').val();
                var ruasjalan =$('#ruasjalanbaru').val();
                var sisi=$('#sisibaru').val();
                var luas =$(this).val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url2="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url2);
                 
                return false;
            }) 


            $("#lebarbaru").change(function (){            

                var obyekpajak=$('#kodeobyekbaru').val();
                var ruasjalan =$('#ruasjalanbaru').val();
                var sisi=$('#sisibaru').val();
                var luas =$('#luasbaru').val();
                var lebar=$(this).val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url2="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url2);
                 
                return false;
            }) 


            $("#jumlahsatuanbaru").change(function (){            

                var obyekpajak=$('#kodeobyekbaru').val();
                var ruasjalan =$('#ruasjalanbaru').val();
                var sisi=$('#sisibaru').val();
                var luas =$('#luasbaru').val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$(this).val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url2="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url2);
                 
                return false;
            }) 



            $("#jumlahreklamebaru").change(function (){            

                var obyekpajak=$('#kodeobyekbaru').val();
                var ruasjalan =$('#ruasjalanbaru').val();
                var sisi=$('#sisibaru').val();
                var luas =$('#luasbaru').val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$(this).val();
                var nilaipajak=$('#nilaipajakbaru').val();
                var url2="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url2);
                 
                return false;
            })


            $("#nilaipajakbaru").change(function (){            

                var obyekpajak=$('#kodeobyekbaru').val();
                var ruasjalan =$('#ruasjalanbaru').val();
                var sisi=$('#sisibaru').val();
                var luas =$('#luasbaru').val();
                var lebar=$('#lebarbaru').val();
                var jumlahsatuan =$('#jumlahsatuanbaru').val();
                var jumlah=$('#jumlahreklamebaru').val();
                var nilaipajak=$(this).val();
                var url2="<?php echo base_url(); ?>con_menuutama/tulis_keterangan/"+ obyekpajak+"c"+ruasjalan+"c"+sisi+"c"+luas+"c"+jumlahsatuan+"c"+jumlah+"c"+nilaipajak+"c"+lebar;
                $('#keteranganpajakbaru').load(url2);
                 
                return false;
            })            


        });

        $(document).on("click", ".open-AddBookDialog1", function () {
          var sptpdaktif = $(this).data('sptpdaktif');
          $(".modal-body #SPTPDAktif").val( sptpdaktif );
          var tglterbitaktif = $(this).data('tglterbitaktif');
          $(".modal-body #TglTerbitAktif").val( tglterbitaktif );  
          var jumlahpajakaktif = $(this).data('jumlahpajakaktif');
          $(".modal-body #JumlahPajakAktif").val( jumlahpajakaktif );   
          var bulanaktif = $(this).data('bulanaktif');
          $(".modal-body #BulanTerbitAktif").val( bulanaktif ); 
          var tahunaktif = $(this).data('tahunaktif');
          $(".modal-body #TahunTerbitAktif").val( tahunaktif );     
          var wpaktif = $(this).data('wpaktif');
          $(".modal-body #WajibPajakAktif").val( wpaktif );  
          var keteranganaktif = $(this).data('keteranganaktif');
          $(".modal-body #KeteranganAktif").val( keteranganaktif );  
          var dataentriaktif = $(this).data('dataentriaktif');
          $(".modal-body #DataEntriAktif").val( dataentriaktif );  
          var tanggalentriaktif = $(this).data('tanggalentriaktif');
          $(".modal-body #TanggalEntriAktif").val( tanggalentriaktif );  


        });


        $(document).on("click", ".open-AddBookDialog2", function () {
          var sptpdhapus = $(this).data('sptpdhapus');
          $(".modal-body #SPTPDHapus").val( sptpdhapus );  
          var keteranganhapus = $(this).data('keteranganhapus');
          $(".modal-body #KeteranganHapus").val( keteranganhapus );  
          var wphapus = $(this).data('wphapus');
          $(".modal-body #WPHapus").val( wphapus );  


        });

        $(document).on("click", ".open-AddBookDialog0", function () {
          var sptpdedit = $(this).data('sptpdedit');
          $(".modal-body #SPTPDEdit").val( sptpdedit );  
          var keteranganedit = $(this).data('keteranganedit');
          $(".modal-body #KeteranganEdit").val( keteranganedit );  
          var wpedit = $(this).data('wpedit');
          $(".modal-body #WPEdit").val( wpedit );  
          var jumlahpajakedit = $(this).data('jumlahpajakedit');
          $(".modal-body #JumlahEdit").val( jumlahpajakedit );  

        });        


    </script>






  </head>
  <body>

    <?php echo form_open_multipart('con_menuutama/operasisptpd') ?>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-10">


            <div class="row">
                <div class="col-md-12 panel-warning">
                    <div class="content-box-header panel-heading">
              <div class="panel-title ">Selamat Datang <?php echo $Nama; ?></div>
                    </div>
                    <div class="content-box-large box-with-header">
              <div class="row">
                <div class="col-sm-6">

                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="Nama" type="text" class="form-control input-lg" value="<?php echo $Nama; ?>" placeholder="Nama User" readonly>
                  </div>
                  <br>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <textarea class="form-control" rows="3" id="comment" readonly><?php echo $menuku; ?></textarea>
                  </div>                  
                </div>
                <div class="col-sm-6">
                  <img src="<?php echo base_url();?>assets/spt.png" alt="user" style="width:100%;height:160px;">
                </div>
              </div>
                        <br /><br />
                    </div>
                </div>
            </div>

        <div class="row">
          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">SPTPD</div>
            </div>
            <div class="content-box-large box-with-header">


              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">SPTPD Belum Ditetapkan</a></li>
                <li><a data-toggle="tab" href="#menu1">SPTPD Sudah Ditetapkan</a></li>
              </ul>

              <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                  <br>
                  <br>

                  <div class="row">
                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                        <input name="SPTPDbelum" type="text" class="form-control" placeholder="Nomor SPTPD" value="<?php if(isset($nosptbelum)) echo "$nosptbelum";?>">
                      </div>
                      <br>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
                        <select name="jenispajakbelum" class="form-control" id="jenispajakbelum">
                          <option>- Jenis Pajak -</option>
                            <?php foreach($jenispajak as $_jenispajak){
                              echo "<option value='".$_jenispajak->koderekening."'>".$_jenispajak->uraian."</option>";
                            } ?>
                        </select>
                      </div> 
                      <br>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        <select name="bulanbelum1" class="form-control" id="bulanbelum1">
                          <option>- Bulan -</option>
                            <?php foreach($bulan as $_bulan){
                              echo "<option value='".$_bulan->namabulan."'>".$_bulan->namabulan."</option>";
                            } ?>
                        </select>
                      </div>                      
                      <br>                       
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <select name="tahunbelum" class="form-control" id="tahunbelum">
                          <option>- Tahun -</option>
                            <?php foreach($tahun as $_tahun){
                              echo "<option value='".$_tahun->Tahun."'>".$_tahun->Tahun."</option>";
                            } ?>
                        </select>
                      </div>                      
                      <br> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                        <input name="SPTPDlamabelum" type="text" class="form-control" placeholder="Nomor SPTPD Lama">
                      </div>
                      <br>



                      <input type="submit" name="caridatasptpdbelum" value="Cari Data SPTPD" class="btn btn-primary btn-md">
                      <input type="submit" name="Refreshdatasptpdbelum" value="Refresh" class="btn btn-success btn-md">
                      <input type="submit" data-toggle="modal" data-target="#tambahdataSPTPD" name="TambahDataSPTPD" value="Tambah Data SPTPD" class="btn btn-success btn-md">

                      <br>
                      <br>
                    </div>
                  </div>  

                  <table class="table table-hover">
                        <thead>
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="15%">  
                            <col width="10%">  
                            <col width="20%"> 
                            <col width="6%"> 
                            <col width="19%"> 
                          <tr>
                            <th>SPTPD</th>
                            <th>SPTPD Lama</th>
                            <th>Keterangan</th>
                            <th>Masa</th>
                            <th>Wajib Pajak</th>
                            <th>Jumlah Pajak</th>
                            <th>Data Entri</th>
                            <th>Edit</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach( $sptpdbelum as $_sptpdbelum){
                        ?>
                          <tr>
                            <td><font size="2"><?php echo str_pad($_sptpdbelum->NoID, 4, '0', STR_PAD_LEFT)."/431.302.2.2/".$_sptpdbelum->Tahun ;?></font></td>
                            <td><font size="2"><?php echo $_sptpdbelum->NoSPTLama;?></font></td>
                            <td><font size="2"><?php echo $_sptpdbelum->KeteranganPajak;?></font></td>
                            <td><font size="2"><?php echo $_sptpdbelum->Bulan;?> <?php echo $_sptpdbelum->Tahun;?></font></td>
                            <td><font size="2"><?php echo $_sptpdbelum->NamaWP;?></font></td>
                            <td><font size="2"><?php echo number_format($_sptpdbelum->JumlahPajak,2,",",".");?></font></td>
                            <td><font size="2"><?php echo $_sptpdbelum->DataEntri;?></font></td>                            
                            <td><button type="button" data-toggle="modal" data-target="#modaledit" data-jumlahpajakedit='<?php echo $_sptpdbelum->JumlahPajak;?>' data-sptpdedit='<?php echo $_sptpdbelum->NoID;?>' data-keteranganedit='<?php echo $_sptpdbelum->KeteranganPajak;?>' data-wpedit='<?php echo $_sptpdbelum->NamaWP;?>' class="open-AddBookDialog0 btn btn-warning btn-s"><span class="glyphicon glyphicon-pencil"></span></button> <button type="button" data-toggle="modal" data-target="#modalaktifkan" data-tanggalentriaktif='<?php echo $_sptpdbelum->TanggalEntri;?>' data-dataentriaktif='<?php echo $_sptpdbelum->DataEntri;?>' data-keteranganaktif='<?php echo $_sptpdbelum->KeteranganPajak;?>' data-wpaktif='<?php echo $_sptpdbelum->NamaWP;?>' data-tahunaktif='<?php echo $_sptpdbelum->Tahun;?>' data-bulanaktif='<?php echo $_sptpdbelum->Bulan;?>' data-sptpdaktif='<?php echo $_sptpdbelum->NoID;?>' data-jumlahpajakaktif='<?php echo number_format($_sptpdbelum->JumlahPajak,2,",",".");?>' data-tglterbitaktif='<?php echo $_sptpdbelum->TanggalTerbit;?>' class="open-AddBookDialog1 btn btn-info btn-s"><span class="glyphicon glyphicon-ok"></span></button> <a href="<?=base_url()?>con_menuutama/sptpd_cetak/<?php echo $_sptpdbelum->NoID;?>" target="_blank" class="btn btn-primary btn-s" role="button"><span class="glyphicon glyphicon-print"></span></a></td>
                          </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                  </table>
                  



                </div>
                <div id="menu1" class="tab-pane fade">
                  <br>
                  <br>

                  <div class="row">
                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                        <input name="SPTPDaktif" type="text" class="form-control" placeholder="Nomor SPTPD" value="<?php if(isset($nosptaktif)) echo "$nosptaktif";?>">
                      </div>
                      <br>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
                        <select name="jenispajakaktif" class="form-control" id="jenispajakaktif">
                          <option>- Jenis Pajak -</option>
                            <?php foreach($jenispajak as $_jenispajak){
                              echo "<option value='".$_jenispajak->koderekening."'>".$_jenispajak->uraian."</option>";
                            } ?>
                        </select>
                      </div> 
                      <br> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        <select name="bulanaktif" class="form-control" id="bulanaktif">
                          <option>- Bulan -</option>
                            <?php foreach($bulan as $_bulan){
                              echo "<option value='".$_bulan->namabulan."'>".$_bulan->namabulan."</option>";
                            } ?>
                        </select>
                      </div>                      
                      <br>  


                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <select name="tahunaktif" class="form-control" id="tahunaktif">
                          <option>- Tahun -</option>
                            <?php foreach($tahun as $_tahun){
                              echo "<option value='".$_tahun->Tahun."'>".$_tahun->Tahun."</option>";
                            } ?>
                        </select>
                      </div>                      
                      <br> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                        <input name="SPTPDlamaaktif" type="text" class="form-control" placeholder="Nomor SPTPD Lama">
                      </div>
                      <br>


                      <input type="submit" name="caridatasptpdaktif" value="Cari Data SPTPD" class="btn btn-primary btn-md">
                      <input type="submit" name="Refreshdatasptpdbelum" value="Refresh" class="btn btn-success btn-md">
                      <br>
                      <br>
                    </div>
                  </div>  


                  <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>SPTPD</th>
                            <th>SPTPD Lama</th>
                            <th>Keterangan</th>
                            <th>Bulan Terbit</th>
                            <th>Wajib Pajak</th>
                            <th>Jumlah Pajak</th>
                            <th>Verifikator</th>
                            <th>Edit</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach( $sptpdsudah as $_sptpdsudah){
                        ?>
                          <tr>
                            <td><font size="2"><?php echo str_pad($_sptpdsudah->NoID, 4, '0', STR_PAD_LEFT)."/431.302.2.2/".$_sptpdsudah->Tahun;?></font></td>
                            <td><font size="2"><?php echo $_sptpdsudah->NoSPTLama;?></font></td>
                            <td width="20px"><font size="2"><?php echo $_sptpdsudah->KeteranganPajak;?></font></td>
                            <td><font size="2"><?php echo $_sptpdsudah->Bulan;?> <?php echo $_sptpdsudah->Tahun;?></font></td>
                            <td><font size="2"><?php echo $_sptpdsudah->NamaWP;?></font></td>
                            <td><font size="2"><?php echo number_format($_sptpdsudah->JumlahPajak,2,",",".");?></font></td> 
                            <td><font size="2"><?php echo $_sptpdsudah->Verifikator;?></font></td>                           
                            <td><button type='button' data-toggle='modal' data-target='#modalhapus' data-wphapus='<?php echo $_sptpdsudah->NamaWP;?>' data-sptpdhapus='<?php echo $_sptpdsudah->NoID;?>' data-keteranganhapus='<?php echo $_sptpdsudah->KeteranganPajak;?>' class='open-AddBookDialog2 btn btn-danger btn-s'><span class="glyphicon glyphicon-trash"></span></button></td>
                          </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                  </table>





                </div>
              </div>


            <br /><br />
          </div>
          </div>
        </div>


		  </div>
		</div>
    </div>





  <div class="modal fade" id="tambahdataSPTPD" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Data SPTPD</h4>
        </div>
        <div class="modal-body">

        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home1">Data SPTPD</a></li>
          <li><a data-toggle="tab" href="#menu11">Rincian SPTPD</a></li>
        </ul>

        <div class="tab-content">
          <div id="home1" class="tab-pane fade in active">
            <br>

            <label for="jenispajakbaru">Jenis Pajak</label>          
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
              <select name="jenispajakbaru" class="form-control" id="jenispajakbaru">
              <option>- Jenis Pajak -</option>
              <?php foreach($jenispajak as $_jenispajak){
                echo "<option value='".$_jenispajak->koderekening."'>".$_jenispajak->uraian."</option>";
              } ?>
              </select>
            </div> 
            <br>
            <label for="tglterbitbaru">Tanggal Terbit</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
              <input name="tglterbitbaru" type="text" class="form-control" placeholder="tahun-bulan-hari" value='<?php echo date('Y-m-d');?>'>
            </div> 
            <br>
            <label for="npwpdbaru">NPWPD</label>    
            <div class="row">
              <div class="col-sm-5">
              <div class="form-group">
                <textarea class="form-control" rows="1" id="npwpdbaru" name="npwpdbaru" placeholder="NPWPD"></textarea>
              </div> 
              <br>



              </div>
              <div class="col-sm-7">

              <div class="form-group">
                <textarea class="form-control" rows="1" id="namawpbaru" name="namawpbaru" placeholder="Nama WP" disabled></textarea>
              </div> 

              <br>   

              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label for="dataentribaru">Data Entri</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input name="dataentribaru" value="<?php echo $Nama; ?>" type="text" class="form-control" placeholder="Data Entri" readonly>
                </div> 
              </div>
              <div class="col-sm-6">
                <label for="tglentribaru">Tanggal Entri</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <input name="tglentribaru" value='<?php echo date('Y-m-d');?>' type="text" class="form-control" placeholder="Tanggal Entri" readonly>
                   <!-- <input name="tglentribaru" value='<?php echo date('Y-m-d');?>' type="text" class="form-control" placeholder="Tanggal Entri"> // DIMAS UPDATE 19 SEPTEMBER 2017  -->
                </div>                 
              </div>
            </div>
            <br>
            <hr>
            <div class="form-group">
              <label for="keteranganpajakbaru">Keterangan Pajak</label>              
              <textarea class="form-control" rows="4" id="keteranganpajakbaru" name="keteranganpajakbaru" placeholder="Keterangan Pajak"></textarea>
            </div>             


          </div>

          <div id="menu11" class="tab-pane fade">
            <br>
            <label for="obyekpajakbaru">Obyek Pajak</label>
            <div class="row">
              <div class="col-sm-3">

              <div class="input-group">
                <input name="kodeobyekbaru" id="kodeobyekbaru" type="text" class="form-control" placeholder="Kode" readonly>
              </div>               




              </div>  
              <div class="col-sm-9">

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-inbox"></i></span>
                <select name="obyekpajakbaru" class="form-control" id="obyekpajakbaru">
                <option value=-1>- Obyek Pajak -</option>
                </select>
              </div> 



              </div>
            </div>

            <br>

            <div class="row">
              <div class="col-sm-6">

              <div class="form-group">
                <label for="nilaipajakbaru">Nilai Pajak</label>             
                <textarea class="form-control" rows="1" id="nilaipajakbaru" name="nilaipajakbaru" placeholder="Nilai Pajak">0</textarea>
              </div> 


              </div>
              <div class="col-sm-6">
              <div class="form-group">
                <label for="prosentasebaru">Prosentase Pajak</label>             
                <textarea class="form-control" rows="1" id="prosentasebaru" name="prosentasebaru" placeholder="Prosentase Pajak" readonly>0</textarea>
              </div> 

              </div>
            </div>
 
            <hr>
             

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                <label for="jumlahsatuanbaru">Jumlah Satuan</label>                
                  <textarea class="form-control" rows="1" id="jumlahsatuanbaru" name="jumlahsatuanbaru" placeholder="Jumlah Satuan">1</textarea>
                </div>                 
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                <label for="satuanbaru">Satuan</label>              
                  <textarea class="form-control" rows="1" id="satuanbaru" name="satuanbaru" placeholder="Satuan" readonly></textarea>
                </div>                
              </div>
            </div>

            <hr>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                <label for="sisibaru">Sisi</label>               
                  <textarea class="form-control" rows="1" id="sisibaru" name="sisibaru" placeholder="Sisi">0</textarea>
                </div>                 
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                <label for="luasbaru">Panjang</label>
                  <textarea class="form-control" rows="1" id="luasbaru" name="luasbaru" placeholder="Panjang">0</textarea>
                </div>                
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                <label for="luasbaru">Lebar</label>
                  <textarea class="form-control" rows="1" id="lebarbaru" name="lebarbaru" placeholder="Lebar">0</textarea>
                </div>                
              </div>              
            </div>
            <br>
            <label for="ruasjalanbaru">Ruas Jalan</label>
            <div class="row">
              <div class="col-sm-3">

              <div class="input-group">
                <input name="koderuasjalanbaru" id="koderuasjalanbaru" type="text" class="form-control" placeholder="Kode" readonly>
              </div> 


              </div>
              <div class="col-sm-9">

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                <select name="ruasjalanbaru" class="form-control" id="ruasjalanbaru">
                <option value=-1>- Ruas Jalan -</option>
                </select>
              </div> 


              </div>              
            </div>


            

            <br> 

            <div class="row">
              <div class="col-sm-6">

              <label for="zonabaru">Kode Zona</label>
              <div class="form-group">
                <textarea class="form-control" rows="1" id="zonabaru" name="zonabaru" placeholder="Kode Zona" readonly>0</textarea>
              </div> 



              </div>
              <div class="col-sm-6">
              <label for="nilaistrategisbaru">Nilai Strategis</label>
              <div class="form-group">
                <textarea class="form-control" rows="1" id="nilaistrategisbaru" name="nilaistrategisbaru" placeholder="Nilai Strategis" readonly>0</textarea>
              </div> 
            

              </div>


          </div>

          <br>

            <div class="row">
              <div class="col-sm-6">


              <div class="form-group">
              <label for="NJOPbaru">NJOP</label>              
                <textarea class="form-control" rows="1" id="NJOPbaru" name="NJOPbaru" placeholder="NJOP" readonly>0</textarea>
              </div> 

              </div>
              <div class="col-sm-6">

              <div class="form-group">
              <label for="jumlahreklamebaru">Jumlah Reklame</label>
              
                <textarea class="form-control" rows="1" id="jumlahreklamebaru" name="jumlahreklamebaru" placeholder="Jumlah Reklame">0</textarea>
              </div> 

              </div>

            </div>               

              <br>  

        </div>


            


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="tambahbarusptpd" value="Tambah" class="btn btn-primary btn-md">

        </div>
      </div>
    </div>
  </div>  
  </div>  



  <div class="modal fade" id="modalaktifkan" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Verifikasi SPTPD</h4>
        </div>
        <div class="modal-body">

        <div class="row">
          <div class="col-sm-8">
            <div class="form-group">
              <label for="usr">No. SPTPD</label>
              <input name="SPTPDAktif" id="SPTPDAktif" type="text" class="form-control" placeholder="No. SPTPD" readonly>
            </div>
          </div>
          <div class="col-sm-4">

            <div class="form-group">
              <label for="usr">Jumlah Pajak</label>
              <input name="JumlahPajakAktif" id="JumlahPajakAktif" type="text" class="form-control" placeholder="Jumlah Pajak" readonly>
            </div>


          </div>
        </div>


        <div class="row">
          <div class="col-sm-4">

            <div class="form-group">
              <label for="usr">Tanggal Terbit</label>
              <input name="TglTerbitAktif" id="TglTerbitAktif" type="text" class="form-control" placeholder="Tanggal Terbit" readonly>
            </div>

          </div>
          <div class="col-sm-4">

            <div class="form-group">
              <label for="usr">Bulan</label>
              <input name="BulanTerbitAktif" id="BulanTerbitAktif" type="text" class="form-control" placeholder="Bulan" readonly>
            </div>

          </div>
          <div class="col-sm-4">

            <div class="form-group">
              <label for="usr">Tahun</label>
              <input name="TahunTerbitAktif" id="TahunTerbitAktif" type="text" class="form-control" placeholder="Tahun" readonly>
            </div>


          </div>
        </div>

        <div class="form-group">
            <label for="usr">Wajib Pajak</label>
            <input name="WajibPajakAktif" id="WajibPajakAktif" type="text" class="form-control" placeholder="Wajib Pajak" readonly>
        </div>

        <div class="form-group">
            <label for="jumlahreklamebaru">Keterangan</label>              
            <textarea class="form-control" rows="3" id="KeteranganAktif" name="KeteranganAktif" placeholder="Keterangan" readonly></textarea>
        </div>         

        <div class="row">
          <div class="col-sm-6">

            <div class="form-group">
                <label for="usr">Data Entri</label>
                <input name="DataEntriAktif" id="DataEntriAktif" type="text" class="form-control" placeholder="Data Entri" readonly>
            </div>

          </div>
          <div class="col-sm-6">

            <div class="form-group">
                <label for="usr">Tanggal Entri</label>
                <input name="TanggalEntriAktif" id="TanggalEntriAktif" type="text" class="form-control" placeholder="Tanggal Entri" readonly>
                 <!-- <input name="TanggalEntriAktif" id="TanggalEntriAktif" type="text" class="form-control" placeholder="Tanggal Entri"> DIMAS UPDATE 19 SEPTEMBER 2017 -->
            </div>

          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-6">

            <div class="form-group">
                <label for="usr">Verifikator</label>
                <input name="VerifikatorAktif" id="VerifikatorAktif" type="text" class="form-control" placeholder="Verifikator">
            </div>

          </div>
          <div class="col-sm-6">

            <div class="form-group">
                <label for="usr">Tanggal Verifikasi</label>
                <input name="TanggalVerifikasiAktif" id="TanggalVerifikasiAktif" type="text" class="form-control" placeholder="Tanggal Verifikasi" value="<?php echo date('Y-m-d');?>">
            </div>

          </div>
        </div>   
        <hr>
        <h4><b><font color=blue>Perhatian</color></b></h4>
        <p><font color=black>Sebelum proses verifikasi data SPTPD anda lakukan, terlebih dahulu cek berkas SPTPD anda terlebih dahulu.</color></p>


            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <?php echo $verispt; ?>
        </div>
      </div>
      
    </div>
  </div> 


  <div class="modal fade" id="modalhapus" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Non Aktifkan SPTPD</h4>
        </div>
        <div class="modal-body">

        <div class="form-group">
          <label for="usr">No. SPTPD</label>
          <input name="SPTPDHapus" id="SPTPDHapus" type="text" class="form-control" placeholder="No. SPTPD" readonly>
        </div>
        <div class="form-group">
          <label for="usr">Nama Wajib Pajak</label>
          <input name="WPHapus" id="WPHapus" type="text" class="form-control" placeholder="Nama Wajib Pajak" readonly>
        </div>

        <div class="form-group">
            <label for="jumlahreklamebaru">Keterangan</label>              
            <textarea class="form-control" rows="3" id="KeteranganHapus" name="KeteranganHapus" placeholder="Keterangan" readonly></textarea>
        </div>               
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <?php echo $hapusspt; ?>
        </div>
      </div>
      
    </div>
  </div>



  <div class="modal fade" id="modaledit" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Data SPTPD</h4>
        </div>
        <div class="modal-body">

        <div class="form-group">
          <label for="usr">No. SPTPD</label>
          <input name="SPTPDEdit" id="SPTPDEdit" type="text" class="form-control" placeholder="No. SPTPD" readonly>
        </div>
        <div class="form-group">
          <label for="usr">Nama Wajib Pajak</label>
          <input name="WPEdit" id="WPEdit" type="text" class="form-control" placeholder="Nama Wajib Pajak" readonly>
        </div>

        <div class="form-group">
            <label for="jumlahreklamebaru">Keterangan</label>              
            <textarea class="form-control" rows="3" id="KeteranganEdit" name="KeteranganEdit" placeholder="Keterangan"></textarea>
        </div>

        <div class="form-group">
          <label for="usr">Jumlah Pajak</label>
          <input name="JumlahEdit" id="JumlahEdit" type="text" class="form-control" placeholder="Jumlah Pajak">
        </div>                       
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="EditSPT" value="Edit SPTPD" class="btn btn-warning btn-md">
        </div>
      </div>
      
    </div>
  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="<?php echo base_url();?>assets/pegawai/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/pegawai/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/pegawai/js/custom.js"></script>
  </body>
</html>

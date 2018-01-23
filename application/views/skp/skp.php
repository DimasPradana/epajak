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

    <script src="<?php echo base_url(); ?>assets/pegawai/js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#SPTPDBaru").keyup(function (){            
                var url ="<?php echo base_url(); ?>con_menuutama/caritanggalterbit/"+ $(this).val();
                $('#TglTerbitSPTBaru').load(url);   
                var url2 ="<?php echo base_url(); ?>con_menuutama/carijumlahpajak/"+ $(this).val();
                $('#JumlahPajakBaru').load(url2); 
                var url3 ="<?php echo base_url(); ?>con_menuutama/cariketerangan/"+ $(this).val();
                $('#KeteranganSPTBaru').load(url3); 
                var url4 ="<?php echo base_url(); ?>con_menuutama/cariwp/"+ $(this).val();
                $('#WPSPTPDBaru').load(url4);

                var url5 ="<?php echo base_url(); ?>con_menuutama/caritanggalterbit/"+ $(this).val();
                $('#MasaTgl1').load(url5);

                var url6 ="<?php echo base_url(); ?>con_menuutama/caritanggalmasa2/"+ $(this).val();
                $('#MasaTgl2').load(url6);                


                return false;
            })  
        });

        $(document).on("click", ".open-AddBookDialog1", function () {
          var skpaktif = $(this).data('skpaktif');
          $(".modal-body #SKPAktif").val( skpaktif ); 
          var jumlahpajak = $(this).data('jumlahpajak');
          $(".modal-body #JumlahPajakAktif").val( jumlahpajak );   

          var tglterbitaktif = $(this).data('tglterbitaktif');
          $(".modal-body #TanggalterbitAktif").val( tglterbitaktif );
          var bulanaktif = $(this).data('bulanaktif');
          $(".modal-body #BulanAktif").val( bulanaktif );
          var tahunaktif = $(this).data('tahunaktif');
          $(".modal-body #TahunAktif").val( tahunaktif );

          var dataentriaktif = $(this).data('dataentriaktif');
          $(".modal-body #DataEntriAktif").val( dataentriaktif );
          var tglentriaktif = $(this).data('tglentriaktif');
          $(".modal-body #TglEntriAktif").val( tglentriaktif );

          var sptpdaktif = $(this).data('sptpdaktif');
          $(".modal-body #SPTPDAktif").val( sptpdaktif ); 
          
          var keteranganaktif = $(this).data('keteranganaktif');
          $(".modal-body #KeteranganSPTAktif").val( keteranganaktif );        

          var namawpaktif = $(this).data('namawpaktif');
          $(".modal-body #wpAktif").val( namawpaktif );                          

        });


        $(document).on("click", ".open-AddBookDialog0", function () {
          var skphapus = $(this).data('skphapus');
          $(".modal-body #SKPHapus").val( skphapus ); 
          var jumlahpajakhapus = $(this).data('jumlahpajakhapus');
          $(".modal-body #JumlahPajakHapus").val( jumlahpajakhapus );   

          var tglterbithapus = $(this).data('tglterbithapus');
          $(".modal-body #TanggalterbitHapus").val( tglterbithapus );  
          var bulanhapus = $(this).data('bulanhapus');
          $(".modal-body #BulanHapus").val( bulanhapus );  
          var tahunhapus = $(this).data('tahunhapus');
          $(".modal-body #TahunHapus").val( tahunhapus );  

          var keteranganhapus = $(this).data('keteranganhapus');
          $(".modal-body #KeteranganHapus").val( keteranganhapus ); 
          var wphapus = $(this).data('wphapus');
          $(".modal-body #wpHapus").val( wphapus ); 


        });



    </script>        


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <?php echo form_open_multipart('con_menuutama/operasiskp') ?>

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
                  <img src="<?php echo base_url();?>assets/skp.png" alt="user" style="width:100%;height:160px;">
                </div>
              </div>
						<br /><br />
					</div>
		  		</div>
		  	</div>


        <div class="row">
          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">SKP</div>
            </div>
            <div class="content-box-large box-with-header">

            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">SKP</a></li>
            </ul>

            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                <br>
                <br>  

                  <div class="row">
                    <div class="col-sm-5">

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                        <input name="SKPBelum" type="text" class="form-control" placeholder="Nomor SKP">
                      </div>
                      <br>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                        <input name="SPTPDBelum" type="text" class="form-control" placeholder="Nomor SPTPD">
                      </div>
                      <br>

                      <input type="submit" name="caridataskpbelum" value="Cari Data SKP" class="btn btn-primary btn-md">
                      <input type="submit" name="Refresh" value="Refresh" class="btn btn-success btn-md">
                      <input type="submit" data-toggle="modal" data-target="#tambahskp" name="TambahDataSKP" value="Tambah Data SKP" class="btn btn-success btn-md">

                      <br>
                      <br>
                    </div>
                  </div> 
                  <br>
                  <table class="table table-hover" width="100%">
                    <thead>
                      <tr>
                        <th width="15%">No. SKP</th>
                        <th width="10%">Bulan</th>
                        <th width="5%">Tahun</th>
                        <th width="15%">No. SPTPD</th>
                        <th width="20%">Uraian Pajak</th>
                        <th width="10%">Jumlah</th>
                        <th width="10%">Data Entri</th>
                        <th width="30%">Edit</th>
                      </tr>
                    </thead>
                    <tbody>                                                     
                        <tbody>
                        <?php
                        foreach( $skpbelum as $_skpbelum){
                        ?>
                          <tr>
                            <td><font size="2"><?php echo str_pad($_skpbelum->Nomor_SKPRD, 4, '0', STR_PAD_LEFT)."/431.302.2.3/".$_skpbelum->Tahun ;?></font></td>
                            <td><font size="2"><?php echo $_skpbelum->Bulan;?></font></td>
                            <td><font size="2"><?php echo $_skpbelum->Tahun;?></font></td>
                            <td><font size="2"><?php echo str_pad($_skpbelum->Nomor_SPTPD, 4, '0', STR_PAD_LEFT)."/431.302.2.2/".$_skpbelum->TahunSPTPD ;?></font></td>
                            <td><font size="2"><?php echo $_skpbelum->KeteranganPajak;?></font></td>
                            <td><font size="2"><?php echo number_format($_skpbelum->JumlahPajak,2,",",".");?></font></td>
                            <td><font size="2"><?php echo $_skpbelum->DataEntri;?></font></td>                            
                            <td><a href="<?=base_url()?>con_menuutama/skp_cetak/<?php echo $_skpbelum->Nomor_SKPRD;?>" target="_blank" class="btn btn-primary btn-xs" role="button">Cetak</a> <button type="button" data-toggle="modal" data-target="#modalhapus0" data-wphapus='<?php echo $_skpbelum->NamaWP;?>' data-keteranganhapus='<?php echo $_skpbelum->KeteranganPajak;?>' data-tahunhapus='<?php echo $_skpbelum->Tahun;?>' data-bulanhapus='<?php echo $_skpbelum->Bulan;?>' data-tglterbithapus='<?php echo $_skpbelum->Tanggal_Terbit;?>' data-jumlahpajakhapus='<?php echo number_format($_skpbelum->JumlahPajak,2,",",".");?>' data-skphapus='<?php echo $_skpbelum->Nomor_SKPRD;?>' class="open-AddBookDialog0 btn btn-danger btn-xs">Hapus</button></td>
                          </tr>
                        <?php
                        }
                        ?>
                        </tbody>
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
                        <input name="SKPSudah" type="text" class="form-control" placeholder="Nomor SKP">
                      </div>
                      <br>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                        <input name="SPTPDSudah" type="text" class="form-control" placeholder="Nomor SPTPD">
                      </div>
                      <br>

                      <input type="submit" name="caridataskpsudah" value="Cari Data SKP" class="btn btn-primary btn-md">
                      <input type="submit" name="Refresh" value="Refresh" class="btn btn-success btn-md">
                      <br>
                      <br>
                    </div>
                  </div> 
                  <br>              
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No. SKP</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>No. SPTPD</th>
                        <th>Uraian Pajak</th>
                        <th>Jumlah</th>
                        <th>Verifikator</th>
                        <th>Tgl. Verifkasi</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tbody>
                        <?php
                        foreach( $skpsudah as $_skpsudah){
                        ?>
                          <tr>
                            <td><font size="2"><?php echo str_pad($_skpsudah->Nomor_SKPRD, 4, '0', STR_PAD_LEFT)."/431.302.2.3/".$_skpsudah->Tahun ;?></font></td>
                            <td><font size="2"><?php echo $_skpsudah->Bulan;?></font></td>
                            <td><font size="2"><?php echo $_skpsudah->Tahun;?></font></td>
                            <td><font size="2"><?php echo str_pad($_skpsudah->Nomor_SPTPD, 4, '0', STR_PAD_LEFT)."/431.302.2.2/".$_skpsudah->TahunSPTPD;?></font></td>
                            <td width="150"><font size="2"><?php echo $_skpsudah->KeteranganPajak;?></font></td>
                            <td><font size="2"><?php echo number_format($_skpsudah->JumlahPajak,2,",",".");?></font></td>
                            <td><font size="2"><?php echo $_skpsudah->Verifikator;?></font></td> 
                            <td><font size="2"><?php echo $_skpsudah->TanggalVerifikasi;?></font></td>                           
                            <td><button type="button" data-toggle="modal" data-target="#modalhapus" data-wphapus='<?php echo $_skpsudah->NamaWP;?>' data-keteranganhapus='<?php echo $_skpsudah->KeteranganPajak;?>' data-tahunhapus='<?php echo $_skpsudah->Tahun;?>' data-bulanhapus='<?php echo $_skpsudah->Bulan;?>' data-tglterbithapus='<?php echo $_skpsudah->Tanggal_Terbit;?>' data-jumlahpajakhapus='<?php echo number_format($_skpsudah->JumlahPajak,2,",",".");?>' data-skphapus='<?php echo $_skpsudah->Nomor_SKPRD;?>' class="open-AddBookDialog2 btn btn-danger btn-xs">N</button></td>
                          </tr>
                        <?php
                        }
                        ?>
                        </tbody>
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





  <div class="modal fade" id="tambahskp" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Data SKP</h4>
        </div>
        <div class="modal-body">


        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home1">Data SKP</a></li>
          <li><a data-toggle="tab" href="#menu11">Data SPTPD</a></li>
        </ul>

        <div class="tab-content">
          <div id="home1" class="tab-pane fade in active">

            <br>
            <label for="tglterbitbaru">Tanggal Terbit</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
              <input name="tglterbitSKPbaru" id="tglterbitSKPbaru" type="text" class="form-control" placeholder="tahun-bulan-hari" value='<?php echo date('Y-m-d');?>'>
            </div> 
            <br>
            <div class="row">
              <div class="col-sm-6">
                <label for="dataentribaru">Data Entri</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input name="dataentriSKPbaru" value="<?php echo $Nama; ?>" type="text" class="form-control" placeholder="Data Entri" readonly>
                </div> 
              </div>
              <div class="col-sm-6">
                <label for="tglentribaru">Tanggal Entri</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <input name="tglentriSKPbaru" value='<?php echo date('Y-m-d');?>' type="text" class="form-control" placeholder="Tanggal Entri" readonly>
                </div>                 
              </div>
            </div>


          </div>
          <div id="menu11" class="tab-pane fade">
            <br>
            <div class="form-group">
              <label for="usr">No. SPTPD</label>
              <input name="SPTPDBaru" id="SPTPDBaru" type="text" class="form-control" placeholder="No. SPTPD">
            </div>     
            <hr>
            <div class="form-group">
              <label for="usr">Nama Wajib Pajak</label>
              <textarea class="form-control" rows="1" id="WPSPTPDBaru" name="WPSPTPDBaru" placeholder="Nama Wajib Pajak" readonly></textarea>
            </div>             
            <br>
            <div class="row">
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="usr">Tanggal Terbit</label>
                  <textarea class="form-control" rows="1" id="TglTerbitSPTBaru" name="TglTerbitSPTBaru" placeholder="Tanggal Terbit" readonly></textarea>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="usr">Jumlah Pajak</label>
                  <textarea class="form-control" rows="1" id="JumlahPajakBaru" name="JumlahPajakBaru" placeholder="Jumlah Pajak" readonly></textarea>                
                </div>                
              </div>
            </div>
            <br>
            <div class="form-group">
                <label for="jumlahreklamebaru">Keterangan</label>              
                <textarea class="form-control" rows="3" id="KeteranganSPTBaru" name="KeteranganSPTBaru" placeholder="Keterangan" readonly></textarea>
            </div>                                
            <div class="form-group">
              <label for="usr">MasaSKP</label>
              <div class="row">
                <div class="col-sm-6">
                  <textarea name="MasaTgl1" rows="1" id="MasaTgl1" type="text" class="form-control" placeholder="Tanggal Masa 1"></textarea>
                </div>
                <div class="col-sm-6">
                  <textarea name="MasaTgl2" rows="1" id="MasaTgl2" type="text" class="form-control" placeholder="Tanggal Masa 2"></textarea>
                </div>                
              </div>
            </div>
          </div>
        </div>




        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="TambahSKP" value="Tambah Data SKP" class="btn btn-success btn-md">
        </div>
      </div>
    </div>
  </div>








  <!-- Modal -->
  <div class="modal fade" id="modalhapus0" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Non Aktifkan SKP</h4>
        </div>
        <div class="modal-body">

        <div class="row">
          <div class="col-sm-8">
          <div class="form-group">
            <label for="usr">No. SKP</label>
            <input name="SKPHapus" id="SKPHapus" type="text" class="form-control" placeholder="No. SKP" readonly>
          </div> 
          </div>
          <div class="col-sm-4">
          <div class="form-group">
            <label for="usr">Jumlah Pajak</label>
            <input name="JumlahPajakHapus" id="JumlahPajakHapus" type="text" class="form-control" placeholder="Jumlah Pajak" readonly>
          </div>             
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-4">
            <label for="usr">Tanggal Terbit</label>
            <input name="TanggalterbitHapus" id="TanggalterbitHapus" type="text" class="form-control" placeholder="Tanggal Terbit" readonly>            
          </div>
          <div class="col-sm-4">
            <label for="usr">Bulan</label>
            <input name="BulanHapus" id="BulanHapus" type="text" class="form-control" placeholder="Bulan" readonly>              
          </div>
          <div class="col-sm-4">
            <label for="usr">Tahun</label>
            <input name="TahunHapus" id="TahunHapus" type="text" class="form-control" placeholder="Tahun" readonly>              
          </div>
        </div>   
        <hr>  
        <div class="form-group">
          <label for="jumlahreklamebaru">Keterangan</label>              
          <textarea class="form-control" rows="3" id="KeteranganHapus" name="KeteranganHapus" placeholder="Keterangan" readonly></textarea>
        </div> 
        <br>
        <div class="form-group">
          <label for="usr">Nama Wajib Pajak</label>
          <input name="wpHapus" id="wpHapus" type="text" class="form-control" placeholder="Nama Wajib Pajak" readonly>
        </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="HapusSKP" value="Non Aktifkan SKP" class="btn btn-danger btn-md">
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
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
            $("#SKPCari").keyup(function (){            
                var url ="<?php echo base_url(); ?>con_menuutama/cariwp2/"+ $(this).val();
                $('#WP').load(url);   
                var url ="<?php echo base_url(); ?>con_menuutama/caritglterbit2/"+ $(this).val();
                $('#TglTerbit').load(url);  



                var url ="<?php echo base_url(); ?>con_menuutama/jumlahpajak2/"+ $(this).val();
                $('#JumlahPajak').load(url);

                var url ="<?php echo base_url(); ?>con_menuutama/keterangan2/"+ $(this).val();
                $('#Keterangan').load(url);

                var url ="<?php echo base_url(); ?>con_menuutama/caribataswaktu2/"+ $(this).val();
                $('#BatasWaktu').load(url);   

                              var tglbayar=$('#tglbayar').val();
              var SKPCari=$('#SKPCari').val();

              var url ="<?php echo base_url(); ?>con_menuutama/hitungdenda/"+ SKPCari+"/"+tglbayar;

              $('#Denda').load(url);             
               

                return false;
            })  




            $("#SKPAktif").keyup(function (){            
                var url ="<?php echo base_url(); ?>con_menuutama/cariwpku/"+ $(this).val();
                $('#wpAktif').load(url); 
                var url ="<?php echo base_url(); ?>con_menuutama/jumlahpajakku/"+ $(this).val();
                $('#JumlahPajakAktif').load(url); 
                var url ="<?php echo base_url(); ?>con_menuutama/caridataentriku/"+ $(this).val();
                $('#DataEntriAktif').load(url);  
                var url ="<?php echo base_url(); ?>con_menuutama/caritglterbitku/"+ $(this).val();
                $('#TglSKPAktif').load(url); 
                var url ="<?php echo base_url(); ?>con_menuutama/keteranganku/"+ $(this).val();
                $('#KeteranganSPTAktif').load(url);                                    
                return false;
            })

            $("#SKPAktif").change(function (){            
                var url ="<?php echo base_url(); ?>con_menuutama/cariwpku/"+ $(this).val();
                $('#wpAktif').load(url); 
                var url ="<?php echo base_url(); ?>con_menuutama/jumlahpajakku/"+ $(this).val();
                $('#JumlahPajakAktif').load(url); 
                var url ="<?php echo base_url(); ?>con_menuutama/caridataentriku/"+ $(this).val();
                $('#DataEntriAktif').load(url); 
                var url ="<?php echo base_url(); ?>con_menuutama/caritglterbitku/"+ $(this).val();
                $('#TglSKPAktif').load(url);
                var url ="<?php echo base_url(); ?>con_menuutama/keteranganku/"+ $(this).val();
                $('#KeteranganSPTAktif').load(url);                                                                  
                return false;
            })              

        });

        $(document).on("click", ".open-AddBookDialog2", function () {
          var denda = $(this).data('denda');
          $(".modal-body #Dendadatapembayaran").val( denda ); 
          var jumlahpajak = $(this).data('jumlahpajak');
          $(".modal-body #JumlahBayardatapembayaran").val( jumlahpajak ); 
          var keterangan = $(this).data('keterangan');
          $(".modal-body #Keterangandatapembayaran").val( keterangan ); 
          var namawp = $(this).data('namawp');
          $(".modal-body #NamaWPdatapembayaran").val( namawp ); 
          var noskp = $(this).data('noskp');
          $(".modal-body #NoSKPdatapembayaran").val( noskp ); 
          var nobayar = $(this).data('nobayar');
          $(".modal-body #NoBayardatapembayaran").val( nobayar ); 
          var penyetor = $(this).data('penyetor');
          $(".modal-body #penyetordatapembayaran").val( penyetor ); 
                   


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

    <?php echo form_open_multipart('con_menuutama/operasibendahara') ?>

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
                  <img src="<?php echo base_url();?>assets/bendahara.png" alt="user" style="width:100%;height:160px;">
                </div>
              </div>
            <br /><br />
          </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">Bendahara</div>
            </div>
            <div class="content-box-large box-with-header">
              <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#cetakbukti">Cetak Bukti Pembayaran</button>
              <input type="submit" name="Refresh" value="Refresh" class="btn btn-success btn-md">
            </div>


            <br /><br />
          </div>

          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">Data Pembayaran</div>
            </div>
            <div class="content-box-large box-with-header">

                   <!-- dimas
                       
                       hide table pembayaran Sel 05 Des 2017 09:25:01  WIB
                   -->                    

                  <!--<table class="table table-hover" width="100%">
                    <thead>
                      <tr>
                        <th width="10%">No.Bayar</th>
                        <th width="10%">No.SKP</th>
                        <th width="15%">Nama WP</th>
                        <th width="25%">Keterangan</th>
                        <th width="20%">Jumlah</th>
                        <th width="10%">Denda</th>
                        <th width="10%">Cetak</th>
                      </tr>
                    </thead>
                    <tbody>                                                     
                        <tbody>
                        <?php
                        foreach( $daftarbayar as $_daftarbayar){
                        ?>
                          <tr>
                            <td><font size="2"><?php echo $_daftarbayar->NoBayar;?></font></td>
                            <td><font size="2"><?php echo $_daftarbayar->Nomor_SKPRD;?></font></td>
                            <td><font size="2"><?php echo $_daftarbayar->NamaWP;?></font></td>
                            <td><font size="2"><?php echo $_daftarbayar->KeteranganPajak;?></font></td>
                            <td><font size="2"><?php echo number_format($_daftarbayar->JumlahPajak,2,",",".") ;?></font></td>
                            <td><font size="2"><?php echo number_format($_daftarbayar->Denda,2,",",".") ;?></font></td>                          
                            <td><button type="button" data-toggle="modal" data-target="#datapembayaran" data-penyetor='<?php echo $_daftarbayar->Penyetor;?>' data-denda='<?php echo $_daftarbayar->Denda;?>' data-jumlahpajak='<?php echo $_daftarbayar->JumlahPajak;?>'  data-keterangan='<?php echo $_daftarbayar->KeteranganPajak;?>'  data-namawp='<?php echo $_daftarbayar->NamaWP;?>' data-nobayar='<?php echo $_daftarbayar->NoBayar;?>' data-noskp='<?php echo $_daftarbayar->Nomor_SKPRD;?>' class="open-AddBookDialog2 btn btn-primary btn-xs">Cetak</button></td>
                          </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </tbody>
                  </table>
                  -->



            </div>


            <br /><br />
          </div>


          </div>
        </div>












      </div>
    </div>
    </div>


<div id="datapembayaran" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Pembayaran</h4>
      </div>
      <div class="modal-body">

      <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
              <label for="usr">No.Bayar</label>
              <input name="NoBayardatapembayaran" id="NoBayardatapembayaran" type="text" class="form-control" placeholder="No.Bayar" readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
              <label for="usr">No.SKP</label>
              <input name="NoSKPdatapembayaran" id="NoSKPdatapembayaran" type="text" class="form-control" placeholder="No.SKP" readonly>
            </div>
        </div>
      </div>
            <div class="form-group">
              <label for="usr">Nama Wajib Pajak</label>
              <input name="NamaWPdatapembayaran" id="NamaWPdatapembayaran" type="text" class="form-control" placeholder="Nama Wajib Pajak" readonly>
            </div>
            <div class="form-group">
                <label for="jumlahreklamebaru">Keterangan</label>              
                <textarea class="form-control" rows="3" id="Keterangandatapembayaran" name="Keterangandatapembayaran" placeholder="Keterangan" readonly></textarea>
            </div> 
      <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
              <label for="usr">Jumlah</label>
              <input name="JumlahBayardatapembayaran" id="JumlahBayardatapembayaran" type="text" class="form-control" placeholder="Jumlah Bayar" readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
              <label for="usr">Denda</label>
              <input name="Dendadatapembayaran" id="Dendadatapembayaran" type="text" class="form-control" placeholder="Denda">
            </div>
        </div>
      </div>
            <div class="form-group">
              <label for="usr">Penyetor</label>
              <input name="penyetordatapembayaran" id="penyetordatapembayaran" type="text" class="form-control" placeholder="Nama Penyetor">
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <input type="submit" name="cetak2" value="Cetak" class="btn btn-info btn-md">
      </div>
    </div>

  </div>
</div>







  <div class="modal fade" id="cetakbukti" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cetak Bukti Pembayaran</h4>
        </div>
        <div class="modal-body">


        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home1">Data Pembayaran</a></li>
          <li><a data-toggle="tab" href="#menu11">Data SKP</a></li>
        </ul>

        <div class="tab-content">
          <div id="home1" class="tab-pane fade in active">
            <br>
            <div class="row">
              <div class="col-sm-6">
                <label for="tglterbitbaru">Tanggal Bayar</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <input name="tglbayar" id="tglbayar" type="text" class="form-control" placeholder="tahun-bulan-hari" value='<?php echo date('Y-m-d');?>'>
                </div> 
              </div>
              <div class="col-sm-6">
                <label for="dataentribaru">Penyetor</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input name="penyetor" id="penyetor" type="text" class="form-control" placeholder="Penyetor">
                </div>                 
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <label for="tglterbitbaru">Denda</label>
                <div class="form-group">
                  <textarea class="form-control" rows="1" id="Denda" name="Denda" placeholder="Denda">0</textarea>
                </div> 
              </div>
              <div class="col-sm-6">                
              </div>
            </div>            


          </div>
          <div id="menu11" class="tab-pane fade">
            <br>
            <div class="form-group">
              <label for="usr">No. SKP</label>
              <input name="SKPCari" id="SKPCari" type="text" class="form-control" placeholder="No. SKP">
            </div>     
            <hr>
            <div class="form-group">
              <label for="usr">Nama Wajib Pajak</label>
              <textarea class="form-control" rows="1" id="WP" name="WP" placeholder="Nama Wajib Pajak" readonly></textarea>
            </div>             
            <br>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="usr">Tanggal Terbit</label>
                  <textarea class="form-control" rows="1" id="TglTerbit" name="TglTerbit" placeholder="Tanggal Terbit" readonly></textarea>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="usr">Batas Waktu</label>
                  <textarea class="form-control" rows="1" id="BatasWaktu" name="BatasWaktu" placeholder="Batas Waktu" readonly></textarea>
                </div>
              </div>              
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="usr">Jumlah Pajak</label>
                  <textarea class="form-control" rows="1" id="JumlahPajak" name="JumlahPajak" placeholder="Jumlah Pajak" readonly></textarea>                
                </div>                
              </div>
            </div>
            <br>
            <div class="form-group">
                <label for="jumlahreklamebaru">Keterangan</label>              
                <textarea class="form-control" rows="3" id="Keterangan" name="Keterangan" placeholder="Keterangan" readonly></textarea>
            </div>                                


          </div>
        </div>




        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="cetak" value="Cetak Bukti Pembayaran" class="btn btn-info btn-md">
        </div>
      </div>
    </div>
  </div>






    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/pegawai/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/pegawai/js/custom.js"></script>
  </body>
</html>
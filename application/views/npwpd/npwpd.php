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
            $("#prov").change(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_kab/"+$(this).val();
                $('#kab').load(url);
                var url = "<?php echo base_url(); ?>con_menuutama/add_kec/null";
                $('#kec').load(url);
                var url = "<?php echo base_url(); ?>con_menuutama/add_kel/null";
                $('#kel').load(url);                
                return false;
            })   


            $("#kab").change(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_kec/"+$(this).val();
                $('#kec').load(url);
                var url = "<?php echo base_url(); ?>con_menuutama/add_kel/null";
                $('#kel').load(url);  
                return false;
            })       

            $("#kec").change(function (){            
                var url = "<?php echo base_url(); ?>con_menuutama/add_kel/"+$(this).val();
                $('#kel').load(url); 
                return false;
            })    
        });

        $(document).on("click", ".open-AddBookDialog1", function () {
          var NPWPDAktif = $(this).data('npwpdaktif');
          $(".modal-body #NPWPDAktif").val( NPWPDAktif );
          var NamaWPAktif = $(this).data('namawpaktif');
          $(".modal-body #NamaWPAktif").val( NamaWPAktif );
          var AlamatWPAktif = $(this).data('alamatwpaktif');
          $(".modal-body #AlamatWPAktif").val( AlamatWPAktif );
        });

        $(document).on("click", ".open-AddBookDialog2", function () {
          var NPWPDEdit = $(this).data('npwpdedit');
          $(".modal-body #NPWPDEdit").val( NPWPDEdit );
          var NamaWPEdit = $(this).data('namawpedit');
          $(".modal-body #NamaWPEdit").val( NamaWPEdit );
          var AlamatWPEdit = $(this).data('alamatwpedit');
          $(".modal-body #AlamatWPEdit").val( AlamatWPEdit );
        });

        $(document).on("click", ".open-AddBookDialog3", function () {
          var NPWPDHapus = $(this).data('npwpdhapus');
          $(".modal-body #NPWPDHapus").val( NPWPDHapus );
          var NamaWPHapus = $(this).data('namawphapus');
          $(".modal-body #NamaWPHapus").val( NamaWPHapus );
          var AlamatWPHapus = $(this).data('alamatwphapus');
          $(".modal-body #AlamatWPHapus").val( AlamatWPHapus );
        });



    </script>







  </head>
  <body>

    <?php echo form_open_multipart('con_menuutama/operasinpwpd') ?>

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
                  <img src="<?php echo base_url();?>assets/npwp.png" alt="user" style="width:100%;height:160px;">
                </div>
              </div>
						<br /><br />
					</div>
		  		</div>
		  	</div>


        <div class="row">
          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">Data NPWPD</div>
            </div>
            <div class="content-box-large box-with-header">





              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">NPWPD Aktif</a></li>
                <li><a data-toggle="tab" href="#menu1">NPWPD Belum Terverifikasi</a></li>
              </ul>

              <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                  <br>
                  <br>
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                        <input name="NPWPDaktif" type="text" class="form-control input-lg" placeholder="Nomor NPWPD">
                      </div>
                      <br>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                        <input name="NamaNPWPDaktif" type="text" class="form-control input-lg" placeholder="Nama Wajib Pajak">
                      </div>
                      <br>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input name="AlamatNPWPDaktif" type="text" class="form-control input-lg" placeholder="Alamat Wajib Pajak">
                      </div>
                      <br>
                      <input type="submit" name="caridatanpwpdaktif" value="Cari Data NPWPD" class="btn btn-primary btn-md">
                      <input type="submit" name="Refresh" value="Refresh" class="btn btn-success btn-md">
                      <br>
                      <br>
                    </div>
                  </div>                      
                  <table class="table table-hover">
                        <thead>
                          <col width="5%">
                          <col width="10%">
                          <col width="30%">
                          <col width="40%">  
                          <col width="15%">                          
                          <tr>
                            <th>No.</th>
                            <th>NPWPD</th>
                            <th>Nama WP</th>
                            <th>Alamat WP</th>
                            <th>Edit</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                        $no=1;
                        if(!empty($offset)){
                             $no = ($offset+1);
                        }
                        foreach( $npwpd_terverifikasi as $_npwpd_terverifikasi){
                        ?>
                          <tr>
                            <td><font size="2"><?php echo $no;?></font></td>
                            <td><font size="2"><?php echo $_npwpd_terverifikasi->NPWPD;?></font></td>
                            <td><font size="2"><?php echo $_npwpd_terverifikasi->NamaWP;?></font></td>
                            <td><font size="2"><?php echo $_npwpd_terverifikasi->AlamatWP;?></font></td>
                            <td><button type="button" data-toggle="modal" data-target="#modaledit" data-alamatwpedit='<?php echo $_npwpd_terverifikasi->AlamatWP;?>' data-namawpedit='<?php echo $_npwpd_terverifikasi->NamaWP;?>' data-npwpdedit='<?php echo $_npwpd_terverifikasi->NPWPD;?>' class="open-AddBookDialog2 btn btn-warning btn-s"><span class="glyphicon glyphicon-pencil"></span></button> <button type="button" data-toggle="modal" data-target="#modalhapus" data-alamatwphapus='<?php echo $_npwpd_terverifikasi->AlamatWP;?>' data-namawphapus='<?php echo $_npwpd_terverifikasi->NamaWP;?>' data-npwpdhapus='<?php echo $_npwpd_terverifikasi->NPWPD;?>'  class="open-AddBookDialog3 btn btn-danger btn-s"><span class="glyphicon glyphicon-trash"></span></button> <a href="<?=base_url()?>con_menuutama/npwpd_cetak/<?php echo $_npwpd_terverifikasi->NPWPD;?>" target="_blank" class="btn btn-primary btn-s" role="button"><span class="glyphicon glyphicon-print"></span></a></td>
                          </tr>
                        <?php
                        $no++;
                        }
                        ?>
                        </tbody>
                  </table>
                  <p>
                    <?php
                    echo $halaman;
                    ?>
                  </p>
                  <p>
                    <?php
                    echo "Total Data : ".$jumlah_produk;
                    ?>
                  </p>
                </div>
                <div id="menu1" class="tab-pane fade">
                  <br>
                  <br>
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                        <input name="NPWPDtidakaktif" type="text" class="form-control input-lg" placeholder="Nomor NPWPD">
                      </div>
                      <br>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                        <input name="NamaNPWPDtidakaktif" type="text" class="form-control input-lg" placeholder="Nama Wajib Pajak">
                      </div>
                      <br>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input name="AlamatNPWPDtidakaktif" type="text" class="form-control input-lg" placeholder="Alamat Wajib Pajak">
                      </div>
                      <br> 
                      <input type="submit" name="caridatanpwpdtidakaktif" value="Cari Data NPWPD" class="btn btn-primary btn-md">
                      <input type="submit" name="Refresh" value="Refresh" class="btn btn-success btn-md">
                      <input type="submit" data-toggle="modal" data-target="#tambahdataNPWPD" name="TambahDataNPWPD" value="Tambah Data NPWPD" class="btn btn-success btn-md">


                      <br>
                      <br>
                    </div>
                  </div>                      
                  <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>NPWPD</th>
                            <th>Nama WP</th>
                            <th>Alamat WP</th>
                            <th>Edit</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                        $no=1;
                        if(!empty($offset)){
                             $no = ($offset+1);
                        }
                        foreach( $npwpd_belumterverifikasi as $_npwpd_belumterverifikasi){
                        ?>
                          <tr>
                            <td><font size="2"><?php echo $no;?></font></td>
                            <td><font size="2"><?php echo $_npwpd_belumterverifikasi->NPWPD;?></font></td>
                            <td><font size="2"><?php echo $_npwpd_belumterverifikasi->NamaWP;?></font></td>
                            <td><font size="2"><?php echo $_npwpd_belumterverifikasi->AlamatWP;?></font></td>
                            <td><button type="button" data-toggle="modal" data-target="#modalaktifkan" data-alamatwpaktif='<?php echo $_npwpd_belumterverifikasi->AlamatWP;?>' data-namawpaktif='<?php echo $_npwpd_belumterverifikasi->NamaWP;?>' data-npwpdaktif='<?php echo $_npwpd_belumterverifikasi->NPWPD;?>' class="open-AddBookDialog1 btn btn-info btn-s"><span class="glyphicon glyphicon-ok"></span></button></td>
                          </tr>
                        <?php
                        $no++;
                        }
                        ?>
                        </tbody>
                  </table>
                  <p>
                    <?php
                    echo $halaman2;
                    ?>
                  </p>
                  <p>
                    <?php
                    echo "Total Data : ".$jumlah_produk2;
                    ?>
                  </p>

                </div>
              </div>                  
          </div>
          </div>
        </div>
		  </div>
		</div>
    </div>


  <div class="modal fade" id="tambahdataNPWPD" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Data NPWPD</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="usr">No. Urut</label>

            <?php foreach($nomorku as $_nomorku_){
            ?>
              <input name="NoUrut" type="text" class="form-control" placeholder="No. Urut" value="<?php echo $_nomorku_->nomor;?>" readonly>
            <?php
            } 
            ?>


            
          </div>          
          <div class="form-group">
            <label for="usr">Nama Wajib Pajak</label>
            <input name="NamaNPWPD_inputbaru" type="text" class="form-control" placeholder="Nama Wajib Pajak">
          </div>
          <div class="form-group">
            <label for="pwd">Alamat Wajib Pajak</label>
            <input name="AlamatNPWPD_inputbaru" type="text" class="form-control" placeholder="Alamat Wajib Pajak">
          </div>
          <div class="form-group">
            <label for="prov">Provinsi Wajib Pajak</label>
            <select name="prov" class="form-control" id="prov">
              <option>-Provinsi-</option>
                <?php foreach($prov as $_prov){
                  echo "<option value='".$_prov->nama."'>".$_prov->nama."</option>";
                } ?>
            </select>
          </div>         
          <div class="form-group">
            <label for="kab">Kabupaten/Kota Wajib Pajak</label>
            <select name="kab" class="form-control" id="kab">
              <option value=''>-Kabupaten/Kota-</option>
            </select>
          </div>
          <div class="form-group">
            <label for="kec">Kecamatan Wajib Pajak</label>
            <select name="kec" class="form-control" id="kec">
              <option value=''>-Kecamatan-</option>
            </select>
          </div>
          <div class="form-group">
            <label for="kel">Kelurahan Wajib Pajak</label>
            <select name="kel" class="form-control" id="kel">
              <option value=''>-Kelurahan-</option>
            </select>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="TambahBaru" value="Simpan" class="btn btn-primary btn-md">

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
          <h4 class="modal-title">Aktifkan NPWPD</h4>
        </div>
        <div class="modal-body">

        <div class="form-group">
          <label for="usr">NPWPD</label>
          <input name="NPWPDAktif" id="NPWPDAktif" type="text" class="form-control" placeholder="NPWPD" readonly>
        </div>

        <div class="form-group">
          <label for="usr">Nama WP</label>
          <input name="NamaWPAktif" id="NamaWPAktif" type="text" class="form-control" placeholder="Nama WP" readonly>
        </div> 

        <div class="form-group">
          <label for="usr">Alamat WP</label>
          <input name="AlamatWPAktif" id="AlamatWPAktif" type="text" class="form-control" placeholder="Alamat WP" readonly>
        </div>                
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="AktifkanNPWPD" value="Aktifkan" class="btn btn-info btn-md">
        </div>
      </div>
      
    </div>
  </div>



  <div class="modal fade" id="modaledit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit NPWPD</h4>
        </div>
        <div class="modal-body">

        <div class="form-group">
          <label for="usr">NPWPD</label>
          <input name="NPWPDEdit" id="NPWPDEdit" type="text" class="form-control" placeholder="NPWPD" readonly>
        </div>

        <div class="form-group">
          <label for="usr">Nama WP</label>
          <input name="NamaWPEdit" id="NamaWPEdit" type="text" class="form-control" placeholder="Nama WP">
        </div> 

        <div class="form-group">
          <label for="usr">Alamat WP</label>
          <input name="AlamatWPEdit" id="AlamatWPEdit" type="text" class="form-control" placeholder="Alamat WP">
        </div>                
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="EditNPWPD" value="Edit Data" class="btn btn-warning btn-md">
        </div>
      </div>
      
    </div>
  </div>



  <div class="modal fade" id="modalhapus" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Non Aktifkan NPWPD</h4>
        </div>
        <div class="modal-body">

        <div class="form-group">
          <label for="usr">NPWPD</label>
          <input name="NPWPDHapus" id="NPWPDHapus" type="text" class="form-control" placeholder="NPWPD" readonly>
        </div>

        <div class="form-group">
          <label for="usr">Nama WP</label>
          <input name="NamaWPHapus" id="NamaWPHapus" type="text" class="form-control" placeholder="Nama WP" readonly>
        </div> 

        <div class="form-group">
          <label for="usr">Alamat WP</label>
          <input name="AlamatWPHapus" id="AlamatWPHapus" type="text" class="form-control" placeholder="Alamat WP" readonly>
        </div>                
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="HapusNPWPD" value="Non Aktifkan NPWPD" class="btn btn-danger btn-md">
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
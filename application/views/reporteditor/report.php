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
  </head>
  <body>

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
                  <img src="<?php echo base_url();?>assets/report.png" alt="user" style="width:100%;height:160px;">
                </div>
              </div>
						<br /><br />
					</div>
		  		</div>
		  	</div>

        <div class="row">
          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">Report Editor</div>
            </div>
               <!-- <div>
                    <a href="http://localhost/reportico/run.php?project=epajak&password=epajak&execute_mode=MENU&project_password=epajak&xmlin=spt_all.xml">Cetak Laporan SPT</a>
                </div>-->
                <div class="content-box-large box-with-header">
                    <button type="button" class="btn btn-info btn-md"  onclick="window.open('<?php base_url() ?>/epajak/reportico/run.php?project=epajak&execute_mode=MENU&project_password=epajak')">Cetak Laporan SPT</button>
                    <button type="button" class="btn btn-info btn-md"  onclick="window.open('<?php base_url() ?>/epajak/reportico/run.php?project=epajak&execute_mode=MENU&project_password=epajak')">Cetak Laporan SKP Penetapan</button>
                    <button type="button" class="btn btn-info btn-md"  onclick="window.open('<?php base_url() ?>/epajak/reportico/run.php?project=epajak&execute_mode=MENU&project_password=epajak')">Cetak Laporan SKP Penagihan</button>
                </div>
            <br /><br />
          </div>
          </div>
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
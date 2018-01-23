<!DOCTYPE html>
<html class="full" lang="en">
<!-- Make sure the <html> tag is set to the .full CSS class. Change the background image in the full.css file. -->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href='<?php echo base_url();?>assets/halamanutama/gambar/icon.png' rel='shortcut icon'>

    <title>e-Pajak Daerah</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/halamanutama/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/halamanutama/css/the-big-picture.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <?php echo form_open_multipart('con_menuutama/login') ?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">e-Pajak Daerah</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#myModal">Tentang</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <img src="<?php echo base_url();?>assets/halamanutama/gambar/situbondo.png" alt="" style="position:relative;" width="15%" height="15%" align="left" /><font color="#ffffff"><h4>Pemerintah Kabupaten Situbondo</h4>
                <p>Badan Pendapatan, Pengelolaan Keuangan dan Aset Daerah<br>Jl. PB Sudirman No.1 Situbondo<br>Telp. (0338) 671916</i></p></font>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-6">


            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input name="namauser" type="text" class="form-control input-lg" placeholder="Nama User" required>
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input name="password" type="password" class="form-control input-lg" placeholder="Password" required>
            </div>
            <br>




            <div class="row">
              <div class="col-sm-9"><font color="#ffffff"><p>Untuk pengguna wajib pajak, silahkan masukkan Nama User dengan Nomor NPWPD dan Password.<br>Untuk pendaftaran wajib pajak atau user silahkan datang ke kantor BPPKAD Kabupaten Situbondo.</p></font></div>
              <div class="col-sm-3"><input type="submit" name="submit" value="Login" class="btn btn-primary btn-block"></div>

            </div>

            
            


          </div>
          <div class="col-sm-3"></div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tentang Aplikasi</h4>
        </div>
        <div class="modal-body">
          <img src="<?php echo base_url();?>assets/halamanutama/gambar/situbondo.png" alt="" style="position:relative;" width="20%" height="20%"/>
          <br>
          <br>
          <p>Web ini dibangun oleh Badan Pendapatan, Pengelolaan Keuangan dan Aset Daerah Kabupaten Situbondo, untuk memudahkan wajib pajak dalam menyelesaikan kewajibannya terkait pajak daerah.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/halamanutama/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/halamanutama/js/bootstrap.min.js"></script>

</body>

</html>

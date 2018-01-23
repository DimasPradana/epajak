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
                  <img src="<?php echo base_url();?>assets/dashboard.png" alt="user" style="width:100%;height:160px;">
                </div>
              </div>
						<br /><br />
					</div>
		  		</div>
		  	</div>

        <div class="row">
          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">Dashboard</div>
            </div>
            <div class="content-box-large box-with-header">


            <div class="row">
              <div class="col-sm-6">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Keterangan</th>
                    <!--<th>Saldo Awal</th>--> <!--dimas hide saldo awal-->
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                foreach( $lapskp as $_lapskp){
                ?>

                  <tr>
                    <td><?php echo $_lapskp->keterangan;?></td>
                    <!--<td>Rp <?php echo number_format($_lapskp->saldoawal,2,",",".");?></td>--> <!--dimas hide saldo awal-->
                    <td style="text-align:right">Rp <?php echo number_format($_lapskp->jumlah,2,",",".");?></td>
                  </tr>

                  <?php
                  }
                  ?>
                </tbody>
              </table>



              </div>
              <div class="col-sm-6">
              </div>
            </div>

            <br /><br />
          </div>
          </div>
        </div> 



        <div class="row">
          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">Laporan SPTPD</div>
            </div>
            <div class="content-box-large box-with-header">

            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Sudah Diverifikasi</a></li>
              <li><a data-toggle="tab" href="#menu1">Sudah Lunas</a></li>
              <li><a data-toggle="tab" href="#menu2">Dihapus</a></li>
            </ul>

            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">

              <br>

              <!--
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#cetakspt" style="display:none">Cetak Laporan SPTPD</button>
              -->
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#cetakspt">Cetak Laporan SPTPD</button>
              <br>
              <br>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th width="5%">No.SPTPD</th>
                    <th width="10%">Nama Pajak</th>
                    <th width="20%">NPWPD</th>
                    <th width="20%">Nama WP</th>
                    <th width="25%">Uraian</th>
                    <th width="15%">Jumlah</th>
                    <th width="5%">Tampilkan</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                foreach( $lapspt_all as $_lapspt_all){
                ?>

                  <tr>
                    <td><font size="2"><?php echo $_lapspt_all->NoID;?></font></td>
                    <td><font size="2"><?php echo $_lapspt_all->NamaPajak;?></font></td>
                    <td><font size="2"><?php echo $_lapspt_all->NPWPD;?></font></td>
                    <td><font size="2"><?php echo $_lapspt_all->NamaWP;?></font></td>
                    <td><font size="2"><?php echo $_lapspt_all->KeteranganPajak;?></font></td>
                    <td><font size="2">Rp <?php echo number_format($_lapspt_all->JumlahPajak,2,",",".");?></font></td>
                    <td><button type="button" data-toggle="modal" data-target="#modaltampilkanspt" data-jumlahpajakedit='<?php echo $_sptpdbelum->JumlahPajak;?>' class="open-AddBookDialog0 btn btn-info btn-s"><span class="glyphicon glyphicon-search"></span></button></td>
                  </tr>

                  <?php
                  }
                  ?>


                </tbody>
              </table>
              
              <br/>
              <?php 
              echo $this->pagination->create_links();
              ?>

              </div>
              <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
              </div>
              <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
              </div>
            </div>


            <br /><br />
          </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">Laporan SKP</div>
            </div>
            <div class="content-box-large box-with-header">


            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home1">Sudah Lunas</a></li>
              <li><a data-toggle="tab" href="#menu11">Dihapus</a></li>
            </ul>

            <div class="tab-content">
              <div id="home1" class="tab-pane fade in active">

              <br>

              <!--
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#cetakspt" style="display:none">Cetak Laporan SKP</button>
              -->
              <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#cetakspt">Cetak Laporan SKP</button>
              <br>
              <br>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th width="5%">No.SKP</th>
                    <th width="5%">No.SPTPD</th>
                    <th width="5%">Bulan</th>
                    <th width="5%">Tahun</th>
                    <th width="45%">Uraian</th>
                    <th width="15%">Jumlah</th>
                    <th width="15%">Denda</th>
                    <th width="5%">Tampilkan</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                foreach( $lapskpall as $_lapskpall){
                ?>

                  <tr>
                    <td><font size="2"><?php echo $_lapskpall->Nomor_SKPRD;?></font></td>
                    <td><font size="2"><?php echo $_lapskpall->Nomor_SPTPD;?></font></td>
                    <td><font size="2"><?php echo $_lapskpall->Bulan;?></font></td>
                    <td><font size="2"><?php echo $_lapskpall->Tahun;?></font></td>
                    <td><font size="2"><?php echo $_lapskpall->KeteranganPajak;?></font></td>
                    <td><font size="2">Rp <?php echo number_format($_lapskpall->JumlahPajak,2,",",".");?></font></td>
                    <td><font size="2">Rp <?php echo number_format($_lapskpall->Denda,2,",",".");?></font></td>
                    <td><button type="button" data-toggle="modal" data-target="#modaltampilkanspt" data-jumlahpajakedit='<?php echo $_sptpdbelum->JumlahPajak;?>' class="open-AddBookDialog0 btn btn-info btn-s"><span class="glyphicon glyphicon-search"></span></button></td>
                  </tr>

                  <?php
                  }
                  ?>


                </tbody>
              </table>
              
              <br/>
              <?php 
              echo $this->pagination->create_links();
              ?>






              </div>
              <div id="menu11" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
              </div>
            </div>

            <br /><br />
          </div>
          </div>
        </div>





		  </div>
		</div>
    </div>





  <div class="modal fade" id="cetakspt" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cetak Laporan SPTPD</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post" action="<?php echo base_url('con_menuutama/skp_cetak');?>">

        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home2">Per Hari</a></li>
          <li><a data-toggle="tab" href="#menu12">Per Bulan</a></li>
          <li><a data-toggle="tab" href="#menu22">Per Tahun</a></li>
        </ul>

        <div class="tab-content">
          <div id="home2" class="tab-pane fade in active">

          <br>
          <br>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="usr">Antara tanggal</label>
                <input type="text" class="form-control" id="usr" value="<?php echo date("Y-m-d"); ?>">
              </div>             
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="usr">Sampai dengan tanggal</label>
                <input type="text" class="form-control" id="usr" value="<?php echo date("Y-m-d"); ?>">
              </div>            
            </div>
          </div> 








          </div>
          <div id="menu12" class="tab-pane fade">
          <br>
          <br>


          <div class="row">
            <div class="col-sm-6">

              <div class="form-group">
                <label for="sel1">Bulan</label>
                <select class="form-control" id="sel1">
                  <option>Januari</option>
                  <option>Februari</option>
                  <option>Maret</option>
                  <option>April</option>
                  <option>Mei</option>
                  <option>Juni</option>
                  <option>Juli</option>  
                  <option>Agustus</option>    
                  <option>September</option>  
                  <option>Oktober</option>
                  <option>November</option>   
                  <option>Desember</option> 
                </select>
              </div> 

            </div>
            <div class="col-sm-6">
              
              <div class="form-group">
                <label for="usr">Tahun</label>
                <input type="text" class="form-control" id="usr" value="<?php echo date("Y"); ?>">
              </div>

            </div>
          </div> 





          </div>
          <div id="menu22" class="tab-pane fade">

          <br>
          <br>
          
            <div class="form-group">
              <label for="usr">Tahun</label>
              <input type="text" class="form-control" id="usr" value="<?php echo date("Y"); ?>">
            </div>

          </div>
        </div>    



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="cetak" value="Cetak Laporan" class="btn btn-info btn-md">
        </div>
      </div>
    </div>
  </div>




  <div id="modaltampilkanspt" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SPTPD</h4>
        </div>
        <div class="modal-body">
          
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="usr">No.SPTPD</label>
              <input type="text" class="form-control" id="usr">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="usr">Tgl.Entri</label>
              <input type="text" class="form-control" id="usr">
            </div>
          </div>
        </div> 

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="usr">Jenis Pajak</label>
              <input type="text" class="form-control" id="usr">
            </div>
          </div>
          <div class="col-sm-8">
            <div class="form-group">
              <label for="usr">Nama Pajak</label>
              <input type="text" class="form-control" id="usr">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="usr">NPWPD</label>
              <input type="text" class="form-control" id="usr">
            </div>
          </div>
          <div class="col-sm-8">
            <div class="form-group">
              <label for="usr">Nama Wajib Pajak</label>
              <input type="text" class="form-control" id="usr">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="comment">Keterangan</label>
          <textarea class="form-control" rows="5" id="comment"></textarea>
        </div> 

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="usr">Masa Pajak (Bulan)</label>
              <input type="text" class="form-control" id="usr">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="usr">Tahun</label>
              <input type="text" class="form-control" id="usr">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="usr">Jumlah (Rp)</label>
          <input type="text" class="form-control" id="usr">
        </div>                 
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

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
        $(document).on("click", ".open-AddBookDialog", function () {
          var namaedit = $(this).data('namaedit');
          $(".modal-body #namauseredit").val( namaedit );

          var emailedit = $(this).data('emailedit');
          $(".modal-body #emailuseredit").val( emailedit );

 

          var statusedit = $(this).data('statusedit');
          $(".modal-body #statusedit").val( statusedit );         

          var str = $(this).data('wewenangedit');

          var reeditv=str.slice(0,1);
          if(reeditv==1)
          {
            $(".modal-body #reedit").attr('checked', 'checked');  
          }
          else
          {
            $(".modal-body #reedit").removeAttr('checked');              
          }

          var mueditv=str.substring(1, 2);
          if(mueditv==1)
          {
            $(".modal-body #muedit").attr('checked', 'checked');  
          }
          else
          {
            $(".modal-body #muedit").removeAttr('checked');               
          }       

          var npwpeditv=str.substring(2, 3);
          if(npwpeditv==1)
          {
            $(".modal-body #npwpedit").attr('checked', 'checked');  
          }
          else
          {
            $(".modal-body #npwpedit").removeAttr('checked');             
          }           
          
          var spteditv=str.substring(3, 4);
          if(spteditv==1)
          {
            $(".modal-body #sptedit").attr('checked', 'checked');  
          }
          else
          {
            $(".modal-body #sptedit").removeAttr('checked');               
          } 

          var skpeditv=str.substring(4, 5);
          if(skpeditv==1)
          {
            $(".modal-body #skpedit").attr('checked', 'checked');  
          }
          else
          {
            $(".modal-body #skpedit").removeAttr('checked');              
          } 

          var bendaharaeditv=str.substring(5, 6);
          if(bendaharaeditv==1)
          {
            $(".modal-body #bendaharaedit").attr('checked', 'checked');  
          }
          else
          {
            $(".modal-body #bendaharaedit").removeAttr('checked');            
          } 

          var dashboardeditv=str.substring(6, 7);
          if(dashboardeditv==1)
          {
            $(".modal-body #dashboardedit").attr('checked', 'checked');  
          }
          else
          {
            $(".modal-body #dashboardedit").removeAttr('checked');              
          } 

          var hapussptdeditv=str.substring(7, 8);
          if(hapussptdeditv==1)
          {
            $(".modal-body #hapussptdedit").attr('checked', 'checked');  
          }
          else
          {
            $(".modal-body #hapussptdedit").removeAttr('checked');              
          } 

          var verispteditv=str.substring(8, 9);
          if(verispteditv==1)
          {
            $(".modal-body #verisptedit").attr('checked', 'checked');  
          }
          else
          {
            $(".modal-body #verisptedit").removeAttr('checked');              
          } 

          var veriskpeditv=str.substring(9, 10);
          if(veriskpeditv==1)
          {
            $(".modal-body #veriskpedit").attr('checked', 'checked');  
          }
          else
          {
            $(".modal-body #veriskpedit").removeAttr('checked');              
          } 

        });


        $(document).on("click", ".open-AddBookDialog1", function () {
          var namaedit1 = $(this).data('namaedit1');
          $(".modal-body #namausereditpassword").val( namaedit1 );

          var emailedit1 = $(this).data('emailedit1');
          $(".modal-body #emailusereditpassword").val( emailedit1 );


          var password = $(this).data('password');
          $(".modal-body #passwordusereditlama").val( password );



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

    <?php echo form_open_multipart('con_menuutama/operasimanajemen') ?>    

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
                  <img src="<?php echo base_url();?>assets/user.png" alt="user" style="width:100%;height:160px;">
                </div>
              </div>
						<br /><br />
					</div>
		  		</div>
		  	</div>

        <div class="row">
          <div class="col-md-12 panel-warning">
            <div class="content-box-header panel-heading">
              <div class="panel-title ">Manajemen User</div>
            </div>
            <div class="content-box-large box-with-header">


            <div class="row">
              <div class="col-sm-8">

              <input type="submit" data-toggle="modal" data-target="#modaltambah" value="Tambah Data User" class="btn btn-primary btn-md">
              <input type="submit" name="Refresh" value="Refresh" class="btn btn-success btn-md">
              <br>
              <hr>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no=1;
                if(!empty($offset)){
                $no = ($offset+1);
                }
                foreach( $user as $_user){
                ?>

                  <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $_user->Nama;?></td>
                    <td><?php echo $_user->Email;?></td>
                    <td><button type="button" data-toggle="modal" data-target="#modaledit" data-wewenangedit='<?php echo $_user->Wewenang;?>' data-statusedit='<?php echo $_user->StatusUser;?>' data-emailedit='<?php echo $_user->Email;?>' data-namaedit='<?php echo $_user->Nama;?>' class="open-AddBookDialog btn btn-warning btn-xs">Edit</button> <button type="button" data-toggle="modal" data-password='<?php echo $_user->Password;?>' data-emailedit1='<?php echo $_user->Email;?>' data-namaedit1='<?php echo $_user->Nama;?>' data-target="#modaleditpassword" class="open-AddBookDialog1 btn btn-danger btn-xs">Edit Password</button></td>
                  </tr>

                <?php
                $no++;
                }
                ?>
                </tbody>
              </table>



              </div>
              <div class="col-sm-4">
              <h4><b><font color=blue>Perhatian</color></b></h4>
              <p><font color=black>Sebelum mengedit wewenang user,tekanlah terlebih dahulu tombol Refresh. Kemudian tekanlah tombol Edit untuk mengedit wewenang user.</color></p>
              </div>
            </div>


            <br /><br />
          </div>
          </div>
        </div>   

		  </div>
		</div>
    </div>



  <div class="modal fade" id="modaltambah" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Data User</h4>
        </div>
        <div class="modal-body">


        <div class="row">
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Nama User</label>
            <input name="namauserinput" type="text" class="form-control" placeholder="Nama User">
          </div>  


          </div>
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Email</label>
            <input name="emailuserinput" type="text" class="form-control" placeholder="Email" value="data@inputpajak.go.id">
          </div> 
            
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Password</label>
            <input name="passworduserinput" type="password" class="form-control" placeholder="Password">
          </div>  


          </div>
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Ulangi Password</label>
            <input name="passwordulanguserinput" type="password" class="form-control" placeholder="Password">
          </div> 
            
          </div>
        </div>

        <div class="form-group">
          <label for="sel1">Status User</label>
          <input name="statusinput" type="text" class="form-control" placeholder="Status User" value="admin" readonly>
        </div>   

        <div class="row">
          <div class="col-sm-6">

          <div class="checkbox">
            <label><input type="checkbox" name="reinput" value="1">Report Editor</label>
          </div>  

          <div class="checkbox">
            <label><input type="checkbox" name="muinput" value="1">Manajemen User</label>
          </div>


          <div class="checkbox">
            <label><input type="checkbox" name="npwpinput" value="1">NPWPD</label>
          </div>

          <div class="checkbox">
            <label><input type="checkbox" name="sptinput" value="1">SPTPD</label>
          </div>  

          <div class="checkbox">
            <label><input type="checkbox" name="skpinput" value="1">SKP</label>
          </div>          


          </div>
          <div class="col-sm-6">


  
            

          <div class="checkbox">
            <label><input type="checkbox" name="bendaharainput" value="1">Bendahara</label>
          </div> 


          <div class="checkbox">
            <label><input type="checkbox" name="dashboardinput" value="1">Dashboard</label>
          </div>  

          <div class="checkbox">
            <label><input type="checkbox" name="hapussptdinput" value="1">Hapus SPTPD</label>
          </div>   

          <div class="checkbox">
            <label><input type="checkbox" name="verisptinput" value="1">Verifikasi SPTPD</label>
          </div>

          <div class="checkbox">
            <label><input type="checkbox" name="veriskpinput" value="1">Verifikasi SKP</label>
          </div>                           

          </div>
        </div>             



                    
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="inputuser" value="Simpan Data" class="btn btn-primary btn-md">
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
          <h4 class="modal-title">Edit Data User</h4>
        </div>
        <div class="modal-body">

        <div class="row">
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Nama User</label>
            <input name="namauseredit" id="namauseredit" type="text" class="form-control" placeholder="Nama User" readonly>
          </div>  


          </div>
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Email</label>
            <input name="emailuseredit" id="emailuseredit" type="text" class="form-control" placeholder="Email">
          </div> 
            
          </div>
        </div>


        <div class="form-group">
          <label for="sel1">Status User</label>
          <input name="statusedit" id="statusedit" type="text" class="form-control" placeholder="Status User" readonly>
        </div>   

        <div class="row">
          <div class="col-sm-6">

          <div class="checkbox">
            <label><input type="checkbox" name="reedit" id="reedit" value="1" checked="checked">Report Editor</label>
          </div>  

          <div class="checkbox">
            <label><input type="checkbox" name="muedit" id="muedit" value="1" checked="checked">Manajemen User</label>
          </div>


          <div class="checkbox">
            <label><input type="checkbox" name="npwpedit" id="npwpedit" value="1" checked="checked">NPWPD</label>
          </div>

          <div class="checkbox">
            <label><input type="checkbox" name="sptedit" id="sptedit" value="1" checked="checked">SPTPD</label>
          </div>          

          <div class="checkbox">
            <label><input type="checkbox" name="skpedit" id="skpedit" value="1" checked="checked">SKP</label>
          </div>

          </div>
          <div class="col-sm-6">


    
            

          <div class="checkbox">
            <label><input type="checkbox" name="bendaharaedit" id="bendaharaedit" value="1" checked="checked">Bendahara</label>
          </div> 


          <div class="checkbox">
            <label><input type="checkbox" name="dashboardedit" id="dashboardedit" value="1" checked="checked">Dashboard</label>
          </div> 

          <div class="checkbox">
            <label><input type="checkbox" name="hapussptdedit" id="hapussptdedit" value="1" checked="checked">Hapus SPTPD</label>
          </div>        


          <div class="checkbox">
            <label><input type="checkbox" name="verisptedit" id="verisptedit" value="1" checked="checked">Verifikasi SPTPD</label>
          </div>   


          <div class="checkbox">
            <label><input type="checkbox" name="veriskpedit" id="veriskpedit" value="1" checked="checked">Verifikasi SKP</label>
          </div>                         
                    

          </div>
        </div>             

               
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="EditUser" value="Edit Data" class="btn btn-warning btn-md">
        </div>
      </div>
      
    </div>
  </div>




  <div class="modal fade" id="modaleditpassword" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Password</h4>
        </div>
        <div class="modal-body">

        <div class="row">
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Nama User</label>
            <input name="namausereditpassword" id="namausereditpassword" type="text" class="form-control" placeholder="Nama User" readonly>
          </div>  


          </div>
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Email</label>
            <input name="emailusereditpassword" id="emailusereditpassword" type="text" class="form-control" placeholder="Email" readonly>
          </div> 
            
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Password Lama</label>
            <input name="passwordusereditlama" id="passwordusereditlama" type="password" class="form-control" placeholder="Password" readonly>
          </div>  


          </div>
          <div class="col-sm-6">           
          </div>
        </div>
             
        <div class="row">
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Password</label>
            <input name="passworduseredit" id="passworduseredit" type="password" class="form-control" placeholder="Password">
          </div>  


          </div>
          <div class="col-sm-6">
          <div class="form-group">
            <label for="usr">Ulangi Password</label>
            <input name="passwordulanguseredit" id="passwordulanguseredit" type="password" class="form-control" placeholder="Password">
          </div> 
            
          </div>
        </div>
               
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="EditPasswordUser" value="Edit Password" class="btn btn-danger btn-md">
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
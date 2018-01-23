<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/pegawai/bootstrap/css/bootstrap.min.css">
  <script src="<?php echo base_url(); ?>assets/pegawai/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/pegawai/bootstrap/js/bootstrap.min.js"></script>


<script type="text/javascript">
function printDiv(divName)
{
var printContents = document.getElementById(divName).innerHTML;
var originalContents = document.body.innerHTML;
document.body.innerHTML = printContents;
window.print();
document.body.innerHTML = originalContents;
}
</script>

<style>


div.absolute {
    
    top: 5px;
    right: 10000px;
    position: absolute;

}


    body {
        height: 842px;
        width: 700px;
        /* to centre page on screen*/

    }

.parent {
  position: relative;
  top: 0;
  left: 0;
}
.image1 {
  position: relative;
  top: 0;
  left: 0;
}
.image2 {
  position: absolute;
  top: 8px;
  left: 520px;
}



</style>

</head>

<div id="printableArea">

<body>

<div class="parent">
<img class="image1" src="<?php echo base_url();?>assets/logofull.jpg" width="100%" height="121" align="center">
<?php
$npwpd2=$npwpd;
$npwpd2=str_replace(".","",$npwpd2);
$npwpd2=str_replace("-","",$npwpd2);
?>
<img class="image2" src="<?php echo base_url();?>con_menuutama/gambar3/<?php echo $npwpd2;?>">
</div>

<h2 align="center">Data NPWPD</h2>
<br>
<table border="0" width="100%">
    <tbody>
        <?php
            foreach( $datanpwpd as $_datanpwpd){
        ?>
      	<tr>
        	<td>Nomor NPWPD</td>
        	<td>: <?php echo $_datanpwpd->NPWPD;?></td>
      	</tr>
      	<tr>
        	<td>Nama Wajib Pajak</td>
        	<td>: <?php echo $_datanpwpd->NamaWP;?></td>
      	</tr>
      	<tr>
        	<td>Alamat</td>
        	<td>: <?php echo $_datanpwpd->AlamatWP;?></td>
      	</tr>
      	<tr>
        	<td>Provinsi</td>
        	<td>: <?php echo $_datanpwpd->Provinsi;?></td>
      	</tr>
      	<tr>
        	<td>Kabupaten</td>
        	<td>: <?php echo $_datanpwpd->Kabupaten;?></td>
      	</tr>
      	<tr>
        	<td>Kecamatan</td>
        	<td>: <?php echo $_datanpwpd->Kecamatan;?></td>
      	</tr>
      	<tr>
        	<td>Kelurahan</td>
        	<td>: <?php echo $_datanpwpd->Kelurahan;?></td>
      	</tr>   
      	<tr>
        	<td><b>Status</b></td>
        	<td>: <b><?php echo $_datanpwpd->Status;?></b></td>
      	</tr>       	   	
    </tbody>
</table>
<br>
<br>
<table border="0" width="100%">
    <tbody>
	    <tr>
	        <th width="50%"></th>
	        <th width="50%"></th>
	    </tr>
      	<tr>
        	<td align="center">Situbondo, <?php echo date('d-m-Y');?></td>
        	<td align="center">Mengetahui,</td>
      	</tr> 
      	<tr>
        	<td></td>
        	<td align="center">a.n Kepala Badan Pendapatan, Pengelolaan</td>
      	</tr>
      	<tr>
        	<td></td>
        	<td align="center">Keuangan dan Aset Daerah</td>
      	</tr>   
      	<tr>
        	<td><br><br><br></td>
        	<td></td>
      	</tr>
      	<tr>
        	<td><br><br><br></td>
        	<td></td>
      	</tr>
      	<tr>
        	<td align="center"><u><b><?php echo $_datanpwpd->NamaWP;?></b></u></td>
        	<td align="center"><u><b>H. LUTFI ZAKARIA</b></u></td>
      	</tr>
      	<tr>
        	<td align="center"></td>
        	<td align="center">NIP. 19640227 199211 1 001</td>
      	</tr>      	       	      	       	   	       	  
    </tbody>
</table>

<?php
}
?>

</body>
</div>
<button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" >Cetak NPWPD</button>
<br>
</html>

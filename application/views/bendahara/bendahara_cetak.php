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
    
    top: 10px;
    right: 700px;
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
  position: absolute;
  top: 0;
  left: 0;
}
.image2 {
  position: absolute;
  top: 10px;
  left: 600px;
}

p.small {
    line-height: 130%;
}

</style>


</head>


<div id="printableArea">

<body>
<div class="parent">
<img class="image1" src="<?php echo base_url();?>assets/logofull2.jpg" width="30%" height="50" align="center">
<img class="image2" src="<?php echo base_url();?>con_menuutama/gambar7/<?php echo $buktibayar;?>">
</div>
<br>
<h5 align="center"><b>TANDA BUKTI PEMBAYARAN</b></h5>
<p class="small"><font size="2">Bendahara Penerimaan/ Bendahara Penerimaan Pembantu telah terima uang sebesar <b><?php echo number_format($JumlahBayar,2,",",".");?></b></font><br>
<font size="2">Dengan Huruf <b>(<?php echo $terbilang;?>)</b></font><br>
<font size="2">Dari : <b>(<?php echo $NPWPD;?>) <?php echo $NamaWP;?></b>   Masa Pajak : <b>(<?php echo $Masa;?>)</b></font><br>
<font size="2">Tanggal disetor uang : <b><?php echo $TglBayar;?></b></font>     <font size="2">No.Pembayaran : <b><?php echo $NoBayar;?></b></font></p>
  <table border="1" width="100%">
    <thead>
      <tr>
        <th align="center"><font size="2">Kode</font></font></th>
        <th align="center"><font size="2">Uraian Pajak Daerah</font></th>
        <th align="center"><font size="2">Jumlah</font></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td align="center"><font size="2"><?php echo $RekeningInduk;?></font></td>
        <td><font size="2"><?php echo $KeteranganPajak;?></font></td>
        <td align="center"><font size="2"><?php echo number_format($JumlahPajak,0,",",".") ;?></font></td>
      </tr>
      <tr>
        <td align="center"><font size="2"></font></td>
        <td><font size="2">Denda</font></td>
        <td align="center"><font size="2"><?php echo number_format($Denda,0,",",".") ;?></font></td>
      </tr>
    </tbody>
  </table>
<table border="0" width="100%">
    <tbody>
      <tr>
          <th width="50%"></th>
          <th width="50%"></th>
      </tr>
        <tr>
          <td align="center"><font size="2">Bendahara Penerimaan</font></td>
          <td align="center"><font size="2">Pembayar/ Penyetor</font></td>
        </tr> 
        <tr>
          <td align="center"><font size="2">Badan Pendapatan, Pengelolaan Keuangan & Aset Daerah</font></td>
          <td align="center"><font size="2"></font></td>
        </tr>  
        <tr>
          <td><font size="2"><br></font></td>
          <td><font size="2"></font></td>
        </tr>
        <tr>
          <td align="center"><font size="2"><b><u>(N. NURHAYATI, S.Sos)</u></b></font></td>
          <td align="center"><font size="2"><b><u>(<?php echo $Penyetor;?>)</u></b></font></td>
        </tr>
        <tr>
          <td align="center"><font size="2"><b>NIP. 19710714 199202 2 002</b></font></td>
          <td align="center"><font size="2"></font></td>
        </tr>                                             
    </tbody>
</table>

<p class="small"><font size="1">Lembar Asli : Wajib Pajak</font><br>
<font size="1">Salinan 1   : Bendahara Penerimaan</font><br>
<font size="1">Salinan 2   : Sub Bidang Penagihan</font><br>
<font size="1">Salinan 3   : Sub Bidang Pelaporan</font></p>

</body>

</div>
<button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" >Cetak Bukti Pembayaran</button>
<br>


</html>

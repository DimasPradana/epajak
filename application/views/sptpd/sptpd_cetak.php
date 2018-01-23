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
  position: relative;
  top: 0;
  left: 0;
}
.image2 {
  position: absolute;
  top: 10px;
  left: 530px;
}



</style>






</head>

<div id="printableArea">

<body>
<div class="parent">
<img class="image1" src="<?php echo base_url();?>assets/logofull.jpg" width="100%" height="121" align="center">
<img class="image2" src="<?php echo base_url();?>con_menuutama/gambar/<?php echo $sptpd;?>">
</div>
<h4 align="center"><b><?php echo $Judul;?></b></h4>
<h4 align="center" style="text-transform:uppercase"><b><?php echo $Judul2;?></b></h4>
<h4 align="center" style="text-transform:uppercase"><b>(berdasarkan UU. No.28 Tahun 2009)</b></h4>
<br>
  <table border="0">
    <tbody>
      <tr>
        <td>Nomor Berkas</td>
        <td>:</td>
        <td><?php echo str_pad($sptpd, 4, '0', STR_PAD_LEFT)."/431.302.2.2/".$Tahun ;?></td>
      </tr>
      <tr>
        <td>Tanggal Terbit</td>
        <td>:</td>
        <!-- <td><?php echo $TanggalTerbit;?></td><?php echo date('d&#45;m&#45;Y');?> -->
				<td><?php echo date('d-m-Y');?></td>>
      </tr>
      <tr>
        <td>Masa Pajak</td>
        <td>:</td>
        <td><?php echo $MasaPajak;?></td>
      </tr> 
      <tr>
        <td>Nomor NPWPD</td>
        <td>:</td>
        <td><?php echo $NPWPD;?></td>
      </tr>
      <tr>
        <td>Nama Wajib Pajak</td>
        <td>:</td>
        <td><?php echo $NamaWP;?></td>
      </tr>      
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?php echo $AlamatWP;?></td>
      </tr>
      
    </tbody>
  </table>
  <table border="1" width="100%">
    <thead>
      <tr>
        <th align="center">Kode Rekening</th>
        <th align="center">Uraian Pajak Daerah</th>
        <th align="center">Jumlah (Rp)</th>
        <th align="center">Batas Waktu</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td align="center"><?php echo $RekeningInduk;?></td>
        <td><?php echo $KeteranganPajak;?></td>
        <td align="center"><?php echo $JumlahPajak;?></td>
        <td align="center"><?php echo $BatasWaktu;?></td>
      </tr>

      <tr>
        <td colspan="4">Dengan Huruf : <?php echo $terbilang;?> Rupiah</td>  

      </tr>

    </tbody>
  </table>
  <h5><b>KETERANGAN :</b></h5>
  <p>Demikian formulir ini diisi dengan sebenar-benarnya dan apabila terdapat ketidak benaran dalam pemenuhan kewajiban pengisian SPTPD ini, kami bersedia dikenakan sanksi sesuai Peraturan Daerah yang berlaku.</p>
  <h5><b>ALASAN KEBERATAN WAJIB PAJAK :</b></h5>
  <br>
  <br>
<table border="0" width="100%">
    <tbody>
      <tr>
          <th width="50%"></th>
          <th width="50%"></th>
      </tr>
        <tr>
            <td align="center">Petugas,</td>
            <!--<td align="center">Situbondo, <?php echo date('d-m-Y');?></td>-->
            <td align="center">Situbondo, <?php echo "29-12-2017"?></td> <!--DIMAS UPDATE  19 SEPTEMBER 2017-->
          </tr> 
        <tr>
          <td></td>
          <td align="center">Wajib Pajak / Kuasa</td>
        </tr>
        <tr>
          <td></td>
          <td align="center"></td>
        </tr>   
        <tr>
          <td><br></td>
          <td></td>
        </tr>
        <tr>
          <td><br></td>
          <td></td>
        </tr>
        <tr>
          <td align="center">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
          <td align="center">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
        </tr>
        <tr>
          <td align="center"></td>
          <td align="center"></td>
        </tr>                                             
    </tbody>
</table>

</body>

</div>
<button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" >Cetak SPTPD</button>
<br>
</html>

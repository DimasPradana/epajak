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

hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
} 


div.absolute {

    top: 5px;
    right: 10000px;
    position: absolute;

}


    body {
        height: 842px;
        width: 700px;
        position: absolute;
        left: 0px;
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
<img class="image2" src="<?php echo base_url();?>con_menuutama/gambar/<?php echo $skp;?>
</div>
<!--<h4 align="center"><b><?php echo $Judul;?></b></h4>--> <!--dimas update show laporan-->
<h4 align="center"><b>ini namanya judul kakak</b></h4>
  <table border="0">

    <tbody>
      <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td><?php echo $Masa;?></td>
      </tr>
      <tr>
        <td>No. SKP/RD</td>
        <td>:</td>
        <td><?php echo $Bulan;?> / <?php echo $Tahun;?></td>
      </tr>     
      <tr>
        <td>Wajib Pajak</td>
        <td>:</td>
        <td><?php echo str_pad($skp, 4, '0', STR_PAD_LEFT)."/431.302.2.3/".$Tahun ;?></td>
      </tr> 
      <tr>
        <td>Uraian </td>
        <td>:</td>
        <td>(<?php echo $NPWPD;?>) <?php echo $NamaWP;?></td>
      </tr>   
      <tr>
        <td>Ketetapan</td>
        <td>:</td>
        <td><?php echo $AlamatWP;?></td>
      </tr>                              
      <tr>
        <td>Terbayar</td>
        <td>:</td>
        <td><?php echo $AlamatWP;?></td>
      </tr>                              
      <tr>
        <td>Masa Pajak</td>
        <td>:</td>
        <td><?php echo $AlamatWP;?></td>
      </tr>                              
    </tbody>

  </table>
<h1>LAPORAN SKP DAERAH</h1>
  <table border="1" width="100%">
    <thead>
      <tr>
        <th align="center" width="20%">Kode Rekening</th>
        <th align="center" width="60%">Uraian Pajak Daerah</th>
        <th align="center" width="20%">Jumlah (Rp)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td align="center"><?php echo $RekeningInduk;?></td>
        <td><font size="2"><?php echo $KeteranganPajak;?></font></td>
        <td align="center"><?php echo $JumlahPajak;?></td>
      </tr>
      <tr>
        <td></td>
        <td><b>Jumlah ketetapan pokok pajak</b></td>  
        <td align="center"><b><?php echo $JumlahPajak;?></b></td>
      </tr>      
      <tr>
        <td></td>
        <td><b>Jumlah Keseluruhan</b></td>  
        <td align="center"><b><?php echo $JumlahPajak;?></b></td>
      </tr> 
      <tr>
        <td colspan="3"><font size="2">Dengan Huruf : <?php echo $terbilang;?> Rupiah</font></td>  

      </tr>

    </tbody>
  </table>
  <h5><b><u>PERHATIAN :</u></b></h5>
  <ol>
    <li><font size="2">Harap penyetoran dilakukan pada Bank Jatim Rekening Bendahara Penerimaan BPPKAD No.Rek 0291011896</font></li>
    <li><font size="2">Apabila SKP-Daerah ini tidak atau kurang dibayar lewat waktu paling lama 30 hari setelah SKP-Daerah diterima atau (tanggal jatuh tempo) dikenakan sanksi administrasi berupa bunga sebesar 2% per bulan.</font></li>
  </ol> 
<table border="0" width="100%">
    <tbody>
      <tr>
          <th width="30%"></th>
          <th width="70%"></th>
      </tr>

        <tr>
          <td align="center"></td>
          <td align="center">Situbondo, <?php echo date('d-m-Y');?></td>
        </tr> 
        <tr>
          <td></td>
          <td align="center">a.n Kepala Badan Pendapatan, Pengelolaan Keuangan dan Aset Daerah</td>
        </tr> 
        <tr>
          <td></td>
          <td align="center">Kepala Bidang Pendataan dan Penetapan Pajak</td>
        </tr>  
        <tr>
          <td></td>
          <td align="center">dan Retribusi Daerah</td>
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
          <td align="center"><u><b></b></u></td>
          <td align="center"><u><b>H. LUTFI ZAKARIA</b></u></td>
        </tr>
        <tr>
          <td align="center"></td>
          <td align="center">NIP. 19640227 199211 1 001</td>
        </tr>                                             
    </tbody>
</table>
<hr>
<table border="0" width="100%">
    <tbody>
      <tr>
          <th width="50%"></th>
          <th width="50%"></th>
      </tr>

        <tr>
          <td><b><font size="2"><u>TANDA TERIMA</u></b></font></td>
          <td align="center"><font size="2">Situbondo, <?php echo date('d-m-Y');?></font></td>
        </tr> 
        <tr>
          <td>
            <table border="0">
              <tbody> 
                <tr>
                  <td><font size="2">No. Berkas</font></td>
                  <td><font size="2">:</font></td>
                  <td><font size="2"><?php echo $skp;?></font></td>
                </tr>                              
              </tbody>
            </table>
          </td>
          <td align="center"><font size="2">Yang menerima,</font></td>
        </tr>   
        <tr>
          <td>
            <table border="0">
              <tbody> 
                <tr>
                  <td><font size="2">Nama WP</font></td>
                  <td><font size="2">:</font></td>
                  <td><font size="2"><?php echo $NamaWP;?></font></td>
                </tr>                              
              </tbody>
            </table>
          </td>
          <td></td>
        </tr>  
        <tr>
          <td>
            <table border="0">
              <tbody> 
                <tr>
                  <td><font size="2">NPWPD</font></td>
                  <td><font size="2">:</font></td>
                  <td><font size="2"><?php echo $NPWPD;?></font></td>
                </tr>                              
              </tbody>
            </table>
          </td>
          <td></td>
        </tr>   
        <tr>
          <td>
            <table border="0">
              <tbody> 
                <tr>
                  <td><font size="2">Alamat</font></td>
                  <td><font size="2">:</font></td>
                  <td><font size="2"><?php echo $AlamatWP;?></font></td>
                </tr>                              
              </tbody>
            </table>
          </td>
          <td align="center"><font size="2">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</font></td>
        </tr>                          

    </tbody>
</table>


</body>

</div>
<button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" >Cetak SKP</button>
<br>
</html>


<?php
class Laporan extends CI_Controller{
  function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $this->load->view('laporan/laporan_view');
  }

  //public function logout() 
  //{
    //session_start();
    //$this->load->view('index');
    //session_destroy();
  //}

  public function cetak_skp_all()
  {
    echo "halo ini skp all";
  }

  public function cetak_spt_all()
  {
    echo "halo ini spt all";
  }
}

?>

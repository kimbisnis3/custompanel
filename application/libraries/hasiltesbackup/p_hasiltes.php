<title><?php echo $title; ?></title>
<?php
  $this->load->view('template/head');
  $this->load->helper('id_date');
  $this->load->helper('indonesian_date');
  ?>
<style>
.konten {
  margin-top: 20px;
}
body {
  width: 90%;
  margin: 0 auto;
}
table {
  margin-bottom: 0px;
}
#table {
  border: 1px solid black;
}
#table th {
  background-color: #c8ccd1;
}
th, td {
    border: 1px solid black;
}
tr th {
  text-align: center;
}
img {
  width: 90%;
}
hr {
  border: 2px solid #0000BF;
}
@media print{@page {size: portrait;}}
</style>
<div class="konten">
<body onload="window.print();">
<table>
  <tr>
    <th rowspan="4" style="width: 10%"><img src="<?php echo base_url('assets/utra.png'); ?>"></th>
    <th colspan="2" rowspan="2" style="text-align: center; color: #0000BF; font-size: 20px;">PT GUWATIRTA SEJAHTERA</th>
    <td style="width: 10%;">No Doc</td>
    <td></td>
  </tr>
  <tr>
    <td style="width: 10%;">Revisi</td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2" style="text-align: center; font-size: 18px;"><?php echo $title; ?></td>
    <td> Tanggal Cetak</td>
    <td style="width: 10%;"><?php echo indonesian_date(date("Y-m-d")) ; ?></td>
  </tr>
  <tr>
    <td >Halaman</td>
    <td></td>
  </tr>
</table>

<hr>
<div class="row">
  <div class="col-md-4">
<table id="table" class="table table-striped table-bordered">
  <?php 
      foreach ($identitas as $t) { ?>
  <tr>
    <td>Posisi</td>
    <td> : </td>
    <td><?php echo $t->posisi; ?></td>
  </tr>
  <tr>
    <td>Nama Calon</td>
    <td> : </td>
    <td><?php echo $t->nama; ?></td>
  </tr>
  <?php } ?>
</table>
</div>
</div>
<table id="table" cellspacing="0" witdh="100%" class="table table-striped table-bordered">
        <tr>
        <th>No</th>
        <th>FAKTOR YANG DINILAI</th>
        <th>URAIAN</th>
        </tr>
        </thead>
        <tbody> 
      <?php 
      $no=1;
      foreach ($interview as $t) { ?>
        
       <tr>
       <td width="2%"><?php echo $no ?>.</td>
       <td><?php echo $t->pertanyaan; ?></td>
       <td><?php echo $t->jawaban; ?></td>
       </tr>

      <?php $no++;} ?>
      <tr>
        <td colspan="3"></td>
      </tr>
      <tr>
        <td colspan="3">Hasil Penilaian Akhir : </td>
      </tr>
      <tr>
      <?php foreach ($komentar as $t) { ?>
        <td colspan="3">Komentar : <?php echo $t->komentar; ?> </td>
      <?php } ?>
      </tr>
      <tr>
      <?php foreach ($diterima as $t) { ?>
      <?php 
        $d = '';
        $diterima = $t->diterima ;
      ?>
      <?php if ($diterima == 't') {
        $d = 'Diterima';
      } elseif ($diterima == 'f') {
        $d = 'Tidak Diterima';
      } ?>
        <td colspan="3">Disarankan Untuk :<b> <?php echo $d; ?></b></td>
      <?php } ?>
      </tr>
  </tbody>
</table>
<br>
<div class="container-fluid" style="width: 80%;">
  <!--
<table class="pull-left">
  <tr>
    <td><div  style="visibility: hidden;">Karanganyar, <?php echo indonesian_date(date("Y-m-d")) ; ?></div></td>
  </tr>
  <tr>
    <td style="text-align: center">Pewawancara</td>
  </tr>
  <tr>
    <td style="height: 10%; padding: 15%;"></td>
  </tr>
  <tr>
    <td style="height: 10%; padding: 7%;"></td>
  </tr>
</table>
-->
<table class="pull-right">
  <tr>
    <td>Karanganyar, <?php echo indonesian_date(date("Y-m-d")) ; ?></td>
  </tr>
  <tr>
    <td style="text-align: center">Pewawancara</td>
  </tr>
  <tr>
    <td style="height: 15%; padding: 15%;"></td>
  </tr>
  <tr>
    <td style="height: 15%; padding: 7%;"></td>
  </tr>
</table>
</div>
</body>
</div>
<script src="<?php echo base_url('assets/lte/plugins/jQuery/jQuery-2.2.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/lte/dist/js/de.js')?>"></script>
<script src="<?php echo base_url('assets/lte/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/lte/dist/js/app.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.15/se-1.2.2/datatables.min.js"></script>
<?php
  $this->load->view('template/head');
  $this->load->view('template/topbar');
  $this->load->view('template/sidebar');
  ?>

<section class="content-header">
  <h1>
  <?php echo $title; ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>
<!-- MODAL INPUT-->
<!-- Modal -->

<?php
$this->load->view('template/js');
?> 
        

  </body>
</html>
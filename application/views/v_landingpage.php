<?php
  $this->load->view('template/head');
  $this->load->view('template/topbar');
  $this->load->view('template/sidebar');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1 class="title">
    <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active title"><?php echo $title; ?></li>
    </ol>
  </section>
  
</div>
<?php
  $this->load->view('template/js');
?>

</body>
</html>
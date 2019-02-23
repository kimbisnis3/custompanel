<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b></b>
  </div>
  <strong>Copyright &copy; 2018 <a href="">My Panel </a>.</strong> All rights reserved.
</footer>
</div>
<div class="control-sidebar-bg"></div>
<script src="<?php echo base_url() ?>assets/lte/plugins/jQuery/jQuery-2.2.3.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/dist/js/demo.js"></script>
<script src="<?php echo base_url(); ?>assets/lte/plugins/notify/bootstrap-notify.js"></script>
<script src="<?php echo base_url() ?>assets/lte/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/lte/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/lte/dist/js/app.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/ajaxupload/jquery.ajaxfileupload.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/lte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/lte/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/lte/plugins/pace/pace.js"></script>
<script src="<?php echo base_url() ?>assets/lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('') ?>assets/universe/universe.js"></script>  -->
<script type="text/javascript">
	$(function() {
	    CKEDITOR.replace('artikelx')
	})
	function showNotif(title, msg, jenis) {
	    $.notify({
	        title: '<strong>' + title + '</strong>',
	        message: msg
	    }, {
	        type: jenis,
	        z_index: 2000,
	        allow_dismiss: true,
	        delay: 10,
	        animate: {
	            enter: 'animated fadeInDown',
	            exit: 'animated fadeOutUp'
	        },
	    }, );
	};
	$(".<?php echo $aktifgrup ?>").addClass("active");
	$(".<?php echo $aktifmenu ?>").addClass("active");
</script>
     
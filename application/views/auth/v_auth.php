<!DOCTYPE html>
<html>
	<title>GOPANEL</title>
	<?php
	$this->load->view('template/head');
	?>
	<!--tambahkan custom css disini-->

	<style type="text/css">
		body {
			background:#9adea9 ; 
		}
	</style>
	<link rel="stylesheet" href="<?php echo base_url('assets/lte/plugins/datatables/dataTables.bootstrap.css')?>">
	<!-- Date Picker -->
	<link href="<?php echo base_url('assets/lte/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
	<!-- Daterange picker -->
	<link href="<?php echo base_url('assets/lte/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet" type="text/css" />
	<!-- bootstrap wysihtml5 - text editor -->
	<link href="<?php echo base_url('assets/lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" />
	<head>
		<style>
		</style>
	</head>
</head>
<body class="hold-transition">
<div class="login-box">
	<div class="login-logo">
		<b>GO PANEL</b> <br>
	</div>
	<!-- /.login-logo -->
	<div>
		<?php echo $this->session->flashdata('messagelogin');?>
	</div>
	<div class="login-box-body">

		<p class="login-box-msg">Login</p><br>
		<form action="<?php echo base_url('auth/auth_process'); ?>" method="post">
			<div class="form-group has-feedback">
				<input type="text" name="username" class="form-control" placeholder="Username">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="pass" class="form-control" placeholder="Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
			<!--
				<div class="col-xs-8">
				<?php echo $this->session->flashdata('message');?>
				</div>-->
				<!-- /.col -->
				<div class="col-xs-12">
					<button type="submit" class="btn btn-success btn-block btn-flat btn-lg">Masuk</button>
				</div>
				<div>
				</div>
				<!-- /.col -->
			</div>
		</form>
		<hr>
		<!-- /.social-auth-links -->
		<a href="#"></a><br>
	</div>
	<!-- /.login-box-body -->
</div>
</body>
<!-- /.content -->
<script src="<?php echo base_url('assets/lte/plugins/jQuery/jQuery-2.2.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/lte/dist/js/de.js')?>"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/lte/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- lte App -->
<script src="<?php echo base_url('assets/lte/dist/js/app.min.js') ?>" type="text/javascript"></script>
</script>
<script>
$( ".contacs" ).addClass( "active" );
</script>
<script>
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
</script>
<?php
$this->load->view('template/sidebar_theme');
?>
<script>
$(document).ready(function(){
setTimeout(function() {
$('.alrt-success').fadeOut('fast');
}, 2000); // <-- time in milliseconds
});
</script>
</html>
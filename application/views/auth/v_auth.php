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

<script type="text/javascript"></script>
</html>
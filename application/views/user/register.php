<div class="col-md-6 m-t-lg">
   <div class="panel panel-white">
	<div class="panel-body">
	<div class="login-box">
		<a href="index.html" class="logo-name text-lg text-center">Rainbow's Junction</a>
		<p class="text-center m-t-md">Create a New Account</p>
		<?php if(isset($accountRegistered)){?><div class="alert alert-success"> <?php echo $accountRegistered; ?></div> <?php } ?>
		<form id="regForm" name="regForm" class="m-t-md" action="<?php base_url();?>register" method="post">
			<div class="form-group">
				<input value="<?php echo set_value('first_name'); ?>" type="text" class="form-control" placeholder="First Name" name="first_name" required>
				<?php echo form_error('first_name', '<div class="error-alert">', '</div>'); ?>
			</div>
			<div class="form-group">
				<input value="<?php echo set_value('last_name'); ?>" type="text" class="form-control" placeholder="Last Name" name="last_name" required>
				<?php echo form_error('last_name', '<div class="error-alert">', '</div>'); ?>
			</div>
			<div class="form-group">
				<input value="<?php echo set_value('email'); ?>" type="email" class="form-control" id="email" placeholder="Email" name="email" required>
				<?php echo form_error('email', '<div class="error-alert">', '</div>'); ?>
			</div>
			<div class="form-group">
				<input value="<?php echo set_value('password'); ?>" type="password" class="form-control" id="password" placeholder="Password" name="password" required>
				<?php echo form_error('password', '<div class="error-alert">', '</div>'); ?>
			</div>
			<div class="form-group">
				<input value="<?php echo set_value('password2'); ?>" type="password" class="form-control" placeholder="Password Confirm" name="password2" required>
				<?php echo form_error('password2', '<div class="error-alert">', '</div>'); ?>
			</div>
			<label>
				<input value="<?php echo set_value('userAgreement'); ?>" name="userAgreement" type="checkbox"> Agree the terms and policy
				<?php echo form_error('userAgreement', '<div class="error-alert">', '</div>'); ?>
			</label>
			<button type="submit" class="btn btn-success btn-block m-t-xs" name="btn_register">Submit</button>
			<p class="text-center m-t-xs text-sm">Already have an account?</p>
			<a href="<?php echo base_url();?>login" class="btn btn-default btn-block m-t-xs">Login</a>
		</form>
	   <p class="text-center m-t-xs text-sm">2016 &copy;  by Rainbow's Junction.</p>
	</div>
	</div>
	</div>
</div>
<?php
$this->load->view('layout/sidebar_right');
$this->load->view('layout/footer');
?>   
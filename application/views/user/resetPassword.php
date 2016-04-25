
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Dashboard - Leadmentor</title>
		<meta name="description" content="overview & stats" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->
		<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	deepakmanwal -->
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css" />

		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->


		<!-- page specific plugin styles -->
		<!--fonts-->

		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-fonts.css" /> <!-- DDeepak amnwal -->

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
		<!--[if lt IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<!--inline styles related to this page-->

		<!--ace settings handler-->

		<script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>
	</head>
	

	<body class="login-layout">
	
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div class="center">
									<h1>
										<i class="icon-leaf green"></i>
										<span class="red">LMS</span>
										<span class="white">Application</span>
									</h1>
									<h4 class="blue">&copy; LeadMentor</h4>
								</div>
							</div>

							<div class="space-6"></div>

							<div class="row-fluid">
								<div class="position-relative">
									
									<div id="forgot-box" class="forgot-box <?php echo ($viewPage=='Forgot')?'visible':'';?> widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header red lighter bigger">
													<i class="icon-key"></i>
													Reset Password
												</h4>

												<div class="space-6"></div>
												<p>
													Enter your New Password
												</p>

												<form action="<?php echo base_url('user/reset_password');?>" method="post" id="resetForm">
													<fieldset>
													<div class="control-group">
														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" class="span12" placeholder="New password" name="resetPassword" id="resetPassword"/>
																<i class="icon-lock"></i>
															</span>
														</label>
														<?php if(form_error('resetPassword')){?>
															<span class="help-inline"><?php echo "<font color=red>".form_error('resetPassword')."</font>" ;?></span>
															<?php }?>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" id="confirmPassword" class="span12" placeholder="Confirm New password" name="confirmPassword"/>
																<input type="hidden" value="<?php if(isset($loggeduserId)){echo $loggeduserId;}?>" name="userID">
																<i class="icon-lock"></i>
															</span>
														</label>

														<div class="clearfix">
														<?php if(form_error('confirmPassword')){?>
															<span class="help-inline"><?php echo "<font color=red>".form_error('confirmPassword')."</font>" ;?></span>
															<?php }?>
													<button type="submit"  class="width-35 pull-right btn btn-small btn-danger" name="submitResetPassword">
																<i class="icon-lightbulb"></i>
																Reset!
															</button>
														</div>
														</div>
													</fieldset>
												</form>
											</div><!--/widget-main-->
										</div><!--/widget-body-->
									</div><!--/forgot-box-->

								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->

		<!-- basic scripts -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
		<script type="text/javascript">
		//window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery-1.9.1.min.js'>\x3C/script>");
		</script>


		<!-- page specific plugin scripts -->
		<script>
		 $(function(){
		
			 $('#resetForm').validate({
				errorElement: 'span',
				errorClass: 'help-inline',
				focusInvalid: false,
				rules: {
					
					resetPassword: {
						required: true,
						minlength: 5
					},
					confirmPassword: {
						required: true,
						minlength: 5,
						equalTo: "#resetPassword"
					}
					
				},
		
				messages: {
					registerPassword: {
						required: "Please provide password.",
						minlength: "Please specify a secure Password."
					}
				},
		
				invalidHandler: function (event, validator) { //display error alert on form submit   
					$('.alert-error', $('.login-form')).show();
				},
		
				highlight: function (e) {
					$(e).closest('.control-group').removeClass('info').addClass('error');
				},
		
				success: function (e) {
					$(e).closest('.control-group').removeClass('error').addClass('info');
					$(e).remove();
				},
		
				errorPlacement: function (error, element) {
					//console.log(error[0]['innerHTML']);
					if(element.is(':checkbox') || element.is(':radio')) {
						var controls = element.closest('.controls');
						if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
						else error.insertAfter(element.nextAll('.lbl').eq(0));
					} 
					else if(element.is('.chzn-select')) {
						error.insertAfter(element.nextAll('[class*="chzn-container"]').eq(0));
					}
					else error.insertAfter(element);
				},
		
				submitHandler: function (form) {
				form.submit();
				},
				invalidHandler: function (form) {
				}
			});  
		}); 
		</script>
		</script>

		<!-- inline scripts related to this page -->
		
		<script type="text/javascript">
		
function show_box(id) {
 $('.widget-box.visible').removeClass('visible');
 $('#'+id).addClass('visible');
}

		</script>

	</body>
</html>

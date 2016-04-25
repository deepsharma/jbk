 <div class="col-md-6 m-t-lg">
 <div class="profile-timeline">
                            <ul class="list-unstyled">
							<div class="panel panel-white">
								<div class="panel-body">
                                    <li class="timeline-item">
                                        <div class="panel panel-white">
                                            <div class="panel-body">
                                                <div class="login-box">
													<a href="index.html" class="logo-name text-lg text-center">Rainbow's Junction</a>
													<p class="text-center m-t-md">Please Enter Your Login Details.</p>
													<form  name="loginForm" id="loginForm" class="m-t-md" action="<?php echo base_url();?>login" method="post">
														<div class="form-group">
															<input  value="<?php echo set_value('email'); ?>" type="email" class="form-control" placeholder="Email" name="email" required>
															
															<?php echo form_error('email', '<div class="error-alert">', '</div>'); ?>
														</div>
														<div class="form-group">
															<input value="<?php echo set_value('pwd'); ?>" type="password" class="form-control" placeholder="Password" name="pwd" required>
															<?php echo form_error('pwd', '<div class="error-alert">', '</div>'); ?>
														</div>
														<button type="submit" class="btn btn-success btn-block" name="">Login</button>
														<a href="forgot.html" class="display-block text-center m-t-md text-sm">Forgot Password?</a>
														<p class="text-center m-t-xs text-sm">Do not have an account?</p>
														<a href="<?php echo base_url()?>register" class="btn btn-default btn-block m-t-md">Create an account</a>
													</form>
													<p class="text-center m-t-xs text-sm">2016 &copy;  by Rainbow's Junction.</p>
												</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
            <!-- container ends-->
<?php
$this->load->view('layout/sidebar_right');
$this->load->view('layout/footer');
?>            
                   
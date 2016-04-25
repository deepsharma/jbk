<!-- Modal box-->
				<div id="changePasswordModal" class="modal hide fade">
					<div class="modal-header">
						<button class="close" data-dismiss="modal"><i class="icon-remove" style="font-size:14px;"></i></button>
						<h4>Change Password <span class="leadCountTxt"></span>?</h4>
					</div>
					<div class="modal-body">
					<table>
					<tr><td>Old Password</td><td><input type="password"  id="oldPassword" value=""></td><td><span style="color:red;" id="ErroroldPassword"></span></td><tr>
					<tr><td>New Password</td><td><input type="password"  id="newPassword" value=""></td><td><span style="color:red;" id="ErrornewPassword"></span></td><tr>
					<tr><td>Confirm New Password</td><td><input type="password"  id="confirmPassword" value=""></td><td><span style="color:red;" id="ErrorconfirmPassword"></span></td><tr>
					</table>				
					</div>
					<div class="modal-footer">
						<button class="btn btn-mini btn-info" type="button" onclick="changePassword()">Change Password</button>
						<button class="btn btn-mini" type="button" data-dismiss="modal">Cancel</button>
					</div>
				</div>
				<!-- success Modal box starts-->

				<div id="successChangePasswordModal" class="modal hide fade">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="icon-remove" style="font-size:18px;"></i></button>		
				<h2>Password Successfully Changed ..</h2>
				</div>

				</div>

<!-- success Modal box ends-->
					<script>
						$('#changePassword').on('click',function()
						{
							$('#oldPassword').val('');
							$('#newPassword').val('');
							$('#confirmPassword').val('');
							$("#changePasswordModal").modal('show');
							
						});
						function changePassword()
						{
							var error=0;
							var baseurl="<?php echo base_url();?>";
							var oldPassword=$("#oldPassword").val();
							var newPassword=$("#newPassword").val();
							var confirmPassword=$("#confirmPassword").val();
							var dataString = 'oldPassword='+ oldPassword;
							$('#ErroroldPassword').text('');
							$('#ErrornewPassword').text('');
							$('#ErrorconfirmPassword').text('');
							if(!oldPassword)
							{
								$('#ErroroldPassword').text('Please Enter Old Password');
								error++;
							}
							else if(oldPassword.length<6)
							{
								$('#ErroroldPassword').text('Password must be at least 6 character long');
								error++;
							}
							 if(!newPassword)
							{
								$('#ErrornewPassword').text('Please Enter New Password');
								error++;
							}
							 else if(newPassword.length<6)
							{
								$('#ErrornewPassword').text('Password must be at least 6 character long');
								error++;
							}
							 if(!confirmPassword)
							{
								$('#ErrorconfirmPassword').text('Please Enter Confirm New Password');
								error++;
							}
							 else if(confirmPassword.length<6)
							{
								$('#ErrorconfirmPassword').text('Password must be at least 6 character long');
								error++;
							}
							
							if(error==0)
							{	
							$.post(baseurl+'user/checkPassword',dataString,function(data){
											
											if(data=='error')
											{
												$('#ErroroldPassword').text('Old Password Do not Match');
												error++;
											
											}
											if(newPassword!=confirmPassword)
											{
												$('#ErrorconfirmPassword').text('New Password And confirmPassword Do not Match');
												error++;
												return;
											}
											if(error==0)
											{
												var dataString1 = 'newPassword='+ newPassword;
												$.post(baseurl+'user/changePassword',dataString1,function(data)
												{
														$("#changePasswordModal").modal('hide');
														$('#successChangePasswordModal').modal('show');
														setTimeout(function(){$("#successChangePasswordModal").modal('hide');//window.location.reload();
														},1600);
												});
												$("#changePasswordModal").modal('hide');
											}
										});
							}
						}
						</script>
			<!-- Modal box-->
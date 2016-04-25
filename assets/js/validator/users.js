 $(function(){
		
		$.validator.addMethod("check_alphanum", function(value, element) {
			return this.optional(element) || /^[a-z0-9-_ \-]+$/i.test(value);
		}, "This field must contain only letters, numbers,or dashes.");
		$.validator.addMethod("check_valid_url", function(value, element) {
			return this.optional(element) || /^(?:(ftp|http|https):\/\/)?(?:[\w-]+\.)+[a-z]{2,6}$/i.test(value);
		}, "please provide valid url.");
	
			$('#loginForm').validate({
				errorElement: 'div',
				errorClass: 'error-alert',
				focusInvalid: false,
				rules: {
					 email: {
						required: true,
						email: true
					},
					pwd: {
						required: true,
						minlength: 5
					}
				},
		
				messages: {
					email: {
						required: "Please provide a email.",
						email: "Please provide a valid email."
					},
					pwd: {
						required: "Please provide a password.",
						minlength: "Please provide a password of minimum 5 character."
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
					if(element.is(':checkbox') || element.is(':radio')) {
						var controls = element.closest('.controls');
						if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
						else error.insertAfter(element.nextAll('.lbl').eq(0));
					} 
					else error.insertAfter(element);
				},
		
				submitHandler: function (form) {
				form.submit();
				},
				invalidHandler: function (form) {
				}
			});
			
			
			 $('#regForm').validate({
				errorElement: 'div',
				errorClass: 'error-alert',
				focusInvalid: false,
				rules: {
					first_name: {
						required: true,
						minlength: 2
					},
					last_name: {
						required: true,
						check_alphanum:true,
						minlength: 2
					},
					email: {
						required: true,
						email: true,
						remote: {
							type: 'post',
							url:base_url+'user/checkDuplicateEmail',
							data: {
								'email': function () { return $('#email').val(); }
							},
							dataType: 'json'						
						}
					},
					password: {
						required: true,
						minlength: 5
					},
					password2: {
						required: true,
						minlength: 5,
						equalTo:"#password"
					}
					
				},
		
				messages: {
					regname: {
						required: "Please provide a name.",
						minlength: "Please provide name of minimum 2 character."
					},
					compname: {
						required: "Please provide a enterprise name.",
						minlength: "Please provide enterprise of minimum 2 character."
					},compurl: {
						required: "Please provide a url.",
						check_valid_url: "Please provide a valid url.",
						remote: "Enterprise domain already in use."
					},email: {
						required: "Please provide a email.",
						email: "Please provide a valid email.",
						remote:"Email is already in use."
					},
					regpwd: {
						required: "Please provide password.",
						minlength: "Please provide password of minimum 5 character."
					},
					password2: {
						required: "Please provide password.",
						minlength: "Please provide password of minimum 5 character.",
						equalTo:"Password and confirm password does not match"
					}
				},
		
				invalidHandler: function (event, validator) { //display error alert on form submit   
					$('.alert-error', $('.login-form')).show();
				},
		
				highlight: function (e) {
					$(e).closest('.control-group').removeClass('info').addClass('error');
				},
				
				success: function (e) {
					$(e).closest('.form-group').removeClass('error-alert');
					$(e).remove();
				},
		
				errorPlacement: function (error, element) {
					//$(element).find('.error-aleart').remove();
					
					//$("#compurl-error").remove();
					if(element.is(':checkbox') || element.is(':radio')) {
						var controls = element.closest('.controls');
						if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
						else error.insertAfter(element.nextAll('.lbl').eq(0));
					} 
					else error.insertAfter(element);
				},
		
				submitHandler: function (form) {
				form.submit();
				},
				invalidHandler: function (form) {
				}
			}); 
			
			/* function for change password form*/
			
			$('#changepassword').validate({
				errorElement: 'div',
				errorClass: 'error-aleart',
				focusInvalid: false,
				rules: {
					 password: {
						required: true,
						minlength: 5
					},
					pwd_confirm: {
						required: true,
						minlength: 5,
						equalTo: "#password"
					}
				},
		
				messages: {
					password: {
						required: "Please provide a password.",
						email: "Please provide a valid email."
					},
					pwd_confirm: {
						required: "Please provide confirm password.",
						minlength: "Please provide a confirm password of minimum 5 character.",
						equalTo:"Password and confirm password does not match"
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
					if(element.is(':checkbox') || element.is(':radio')) {
						var controls = element.closest('.controls');
						if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
						else error.insertAfter(element.nextAll('.lbl').eq(0));
					} 
					else error.insertAfter(element);
				},
		
				submitHandler: function (form) {
				form.submit();
				},
				invalidHandler: function (form) {
				}
			});
			/* function for change password form*/
						
		}); 
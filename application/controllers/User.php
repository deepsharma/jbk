<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel','',TRUE);
		$this->load->model('categorymodel','',TRUE);
		$this->load->library('layout');
		//$this->config->load('email');
		$this->load->config('email', TRUE);
		$this->load->helper('form');
	}
	function index()
	{
		if($this->session->userdata('loggedIn'))
		{
			redirect('home','refresh');
		}
		else
		{
			/* $data=array();
			if($this->input->cookie('userEmail'))
			{
				$data=array('userEmail'=>$this->input->cookie('userEmail'),'password'=>$this->input->cookie('password'));
			}
			$this->load->view('user/login',$data); */
			redirect('login','refresh');
		}
	}
	function login()
	{
		$data['viewPage'] = 'Login';
		if($this->session->userdata('loggedIn'))
		{
			redirect('home','refresh');
		}		
		else
		{
			$data=array();
			
			if($this->input->cookie('userEmail'))
			{
				$data=array('userEmail'=>$this->input->cookie('userEmail'),'password'=>$this->input->cookie('password'));
			}
			
			$this->form_validation->set_rules('email', 'User Email', 'trim|required|xss_clean');
				$this->form_validation->set_rules('pwd', 'Password', 'trim|required|xss_clean|callback_checkLoginDetails');
				
				if($this->form_validation->run() == FALSE)
				{
				
				}
				else
				{
					redirect('home' , 'refresh');
				}
			
			$data['left_category_menu']=$this->categorymodel->getAllCategory();
			$this->layout->view('user/login',$data);
		}
	}
	function checkLoginDetails($password)
	{
		
		$userEmail = $this->input->post('email');
		//Checking user Exists or Not//
		$userExists = $this->usermodel->checkExists($userEmail);
		if(!$userExists)
		{
			$this->form_validation->set_message('checkLoginDetails', 'Invalid UserName or Password');
			return FALSE;
		}
		
		$userActivated = $this->usermodel->isActivated($userEmail);
		if(!$userActivated)
		{
			$this->form_validation->set_message('checkLoginDetails', 'Sorry, Your Account Not Activated Yet!');
			return FALSE;
		}
		$result = $this->usermodel->login($userEmail, $password);
		
		if($result>=1)
		{
			$sessionArray = array();
			foreach($result as $row)
			{
				$sessionArray = array(
				'id' => $row->id,
				'first_name' => $row->first_name,
				'last_name' => $row->last_name,
				'userLevel' => $row->user_level_id,
				'userEmail' => $row->email,
				'user_type' => $row->user_type
				);
				
				if($this->input->post('rememberMe'))
				{
					$userEmailCookie=array(
								'name'	=>	'userEmail',
								'value'	=>	$userEmail,
								'expire'=>	3600*24*7
								);
					delete_cookie("userEmail");
					$this->input->set_cookie($userEmailCookie);
					$passwordCookie=array(
								'name'	=>	'password',
								'value'	=>	$password,
								'expire'=>	3600*24*7
								);
					delete_cookie("password");
					$this->input->set_cookie($passwordCookie);
				}
				$this->session->set_userdata('loggedIn', $sessionArray);	
			}
			return TRUE;
		}
		else if($result=='accessDenied')
		{
			$this->form_validation->set_message('checkLoginDetails', 'Permission Denied! Please contact to Administrator');
			return false;
		}
 		else
		{
			$this->form_validation->set_message('checkLoginDetails', 'Incorrect Email/Password Combination');
			return false;
		}
	
	}
	
	function register()
	{		
		$data['viewPage'] = 'Register';
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[password2]');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|xss_clean');		
		$this->form_validation->set_rules('userAgreement', 'User Agreement', 'callback_userAgreement');		
		if($this->form_validation->run())
		{
			$userData = $this->usermodel->insertUserDetails();
			/* $userData['activationPeriod'] = $this->config->item('emailActivationExpire') / 3600;
			$userData['siteName'] = $this->config->item('webSiteName');
			$this->send_email('activate',$userData['userEmail'],$userData);
			$data['accountRegistered']='Registered successfully check your mail to activate account!'; */
			//return TRUE;
			$data['accountRegistered']='Registered successfully check your mail to activate account!';
		}
		else
		{
			//return FALSE;
			
		}
		$data['left_category_menu']=$this->categorymodel->getAllCategory();
		$this->layout->view('user/register',$data);
	}
	
	function userAgreement() 
	{
		if (isset($_POST['userAgreement']))
		{
			return true;
		} 
		else{
			$this->form_validation->set_message('userAgreement', 'Please read and accept user Agreement.');
			return false;
			}
			
	}
	
	function checkDuplicateEmail() 
	{
		if (isset($_POST['email']))
		{
			
			if($this->usermodel->checkExists($_POST['email'])){
				echo json_encode(false);die;
			}
			else{
				echo json_encode(true);die;
			}
		} 
			
	}
	
	function logout()
	{
		$this->session->unset_userdata('loggedIn');
		redirect('login', 'refresh');
	}
	
	function send_email($type, $email, &$data)
	{
		
		//print_r($data);
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		
		$this->email->initialize($config);
		
		$from = $this->config->item('webMasterEmail','email');
		//$this->email->from();
		//sub=sprintf($this->config->item('emailSubject'),$this->config->item('webSiteName'));
		$this->email->from($from);
		$this->email->reply_to('');
		$this->email->to($email);
		$this->email->bcc('founders@meetuniv.com,gantavya@webinfomart.com');
		$this->email->subject(sprintf($this->config->item('emailSubject','email'),$this->config->item('webSiteName','email')));
		$this->email->message($this->load->view('email/'.$type.'_html',$data,true));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt',$data,true));
		$this->email->send();
	}

	function activate($id='',$activationId='')
	{
		$result=$this->usermodel->activate_user($id, $activationId);
		if($result=="success")
		{
		$this->session->set_flashdata('accountActivated', 'Your account has been successfuly activated');
		redirect('login', 'refresh');
		} 
		else{
		$this->session->set_flashdata('accountActivated', 'Try again with correct information. account not activated');
		redirect('login', 'refresh');
		}
	}
	
	//Manage Users//
	function manageUsers()
	{
		$data['loggedUser']=$this->session->userdata('loggedIn');
		$orgId = $data['loggedUser']['organizationId'];
		$userId = $data['loggedUser']['id'];
		if(!($this->session->userdata('loggedIn')))
		{
			redirect('login','refresh');
		}
		else if($data['loggedUser']['userLevel']!=$this->config->item('MasterAdmin') && $data['loggedUser']['userLevel']!=$this->config->item('Admin'))
		{
			redirect('home','refresh');
		}
		
		if($this->input->post('submitCreateUser'))
		{
			$this->form_validation->set_rules('name', 'User Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.userEmail]|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]|xss_clean');	
			$this->form_validation->set_message('is_unique', 'Email Already Registered!');
			//$this->form_validation->set_rules('userAgreement', 'User Agreement', 'callback_userAgreement');
			if($this->form_validation->run())
			{
				$data['createdUserId'] = $this->usermodel->saveUser($orgId,$userId);
				$data['uploadError'] = $this->usermodel->upload_profile_pic($data['createdUserId']);
				$loggedIn=$this->session->userdata('loggedIn');
				$data['bcc']=$loggedIn['userEmail'];
				$data['userEmail'] = $this->input->post('email');
				$data['userName'] = $this->input->post('name');
				$data['userPassword'] = $this->input->post('password');
				$data['siteName'] = $this->config->item('webSiteName','email');
				$this->send_user_email('createUser',$data);
			
			}
		}
		if($this->input->post('submitUpdateUser'))
		{
			$this->form_validation->set_rules('name', 'User Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]|xss_clean');	
			$this->form_validation->set_message('is_unique', 'Email Already Registered!');
			//$this->form_validation->set_rules('userAgreement', 'User Agreement', 'callback_userAgreement');
			if($this->form_validation->run())
			{
				$data['updateUser'] = $this->usermodel->updateUser($orgId,$this->input->post('updateUserId'));
				$data['uploadError'] = $this->usermodel->upload_profile_pic($this->input->post('updateUserId'));
			}
		}
		if($data['loggedUser']['userLevel']==$this->config->item('MasterAdmin'))
		{
			$data['users'] = $this->usermodel->getAllUsers();
		}
		else if($data['loggedUser']['userLevel']==$this->config->item('Admin'))
		{
			$data['users'] = $this->usermodel->getAllUsersByOrg($orgId);
		}
		$data['userPercentage'] = intval($this->usermodel->getUserPercentage($orgId));
		$data['createPermission'] = $this->usermodel->checkUserCreatePermission($orgId);  //gives package Details of Organization
		
		$data['active'] = 'manageUsers';
		$this->layout->view('user/manageusers',$data);
	}
	function deleteUser()
	{
		echo $data['deleteUser'] = $this->usermodel->deleteUser();
		exit;
	}
	function banUser()
	 {
	  echo $data['banUser'] = $this->usermodel->banUser();
	  exit;
	 }
	//End Manage Users//
	
	function send_user_email($type,$data)//manage user email
	{
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		 $from = $this->config->item('webMasterEmail','email');
		$this->email->from($from);
		$this->email->reply_to('');
		$this->email->to($data['userEmail']);
		$this->email->bcc($data['bcc']);
		$this->email->subject(sprintf($this->config->item('templateCreate','email'),$this->config->item('webSiteName','email')));
		$this->email->message($this->load->view('email/'.$type.'_html',$data,true));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt',$data,true));
		$this->email->send();
		
	}
	
	function forgotPassword()
	{
		
		$data['viewPage'] = 'Forgot';
		 if(isset($_POST['forgotPassword']))
		{
			$this->form_validation->set_rules('forgotPasswordEmail', 'Email', 'trim|required|xss_clean|valid_email');
			if($this->form_validation->run())
			{
				$Userdata=$this->usermodel->isEmailExist();
				if(!empty($Userdata))
				{
					$userId=$Userdata[0]['id'];
					$userName=$Userdata[0]['userName'];
					$userEmail=$Userdata[0]['userEmail'];				
					$Userdata = array(
						'id'		=> $userId,
						'userName'		=> $userName,
						'userEmail'			=> $userEmail,
						'siteName'			=> $this->config->item('webSiteName','email'),
						'newPasswordKey'	=> md5(rand().microtime()),
					); 
					$this->usermodel->setPasswordKey($userId, $Userdata['newPasswordKey']);
					$this->sendForgotEmail('forgot_password',$Userdata);
					$this->session->set_flashdata('forgotPasswordSuccessMsg', 'Success! Password reset link is mailed to you please check ur mail');
					redirect('login','refresh');
				}
				else{
				 $data['forgotEmailError']='Oops!something went Wrong! Email does not exist!';
				}
			}
		} 
		$this->load->view('user/login',$data);
	}
	
		function sendForgotEmail($type,$data)//Forgot password email
		{
			$this->load->library('email');
			$config['protocol'] = 'sendmail';
			$config['mailtype'] = 'html';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$this->email->initialize($config);
			$from = $this->config->item('webMasterEmail','email');
			$this->email->from($from);
			$this->email->reply_to('');
			$this->email->to($data['userEmail']);
			$this->email->subject(sprintf($this->config->item('resetPassword','email'),$this->config->item('webSiteName','email')));
			$this->email->message($this->load->view('email/'.$type.'_html',$data,true));
			$this->email->set_alt_message($this->load->view('email/'.$type.'-txt',$data,true));
			$this->email->send();
		
	}
	// function reset_password()
	// {
	// $userId		= $this->uri->segment(3);
	// $newPassKey	= $this->uri->segment(4);
	// $data['viewPage'] = 'Forgot';
		
			// if(isset($_POST['submitResetPassword']))
					// {
						// $this->form_validation->set_rules('resetPassword', 'New Password', 'trim|required|xss_clean');
						// $this->form_validation->set_rules('confirmPassword', 'Confirm new Password', 'trim|required|xss_clean|matches[resetPassword]');
						// if ($this->form_validation->run())
						// {
						// $this->session->set_flashdata('forgotPasswordSuccess', 'Your password is successfully changed');
						// $this->usermodel->resetPassword($_POST['userID'],$_POST['resetPassword']);
						// redirect('login','refresh');
						// }
						
					// }
			// $canReset=$this->usermodel->canResetPassword($userId,$newPassKey,900);
			
			// if(!$canReset)
			// {
				// $this->session->set_flashdata('forgotPasswordLinkExpired', 'This link is Expired or invalid');
				// redirect('user/forgotPassword','refresh');
			// }
	// $data['loggeduserId']=$userId;
	// $this->load->view('user/resetPassword',$data);
	
	// }
	function reset_password()
	{
			$data['viewPage'] = 'Forgot';
			$userId		= $this->uri->segment(3);
			$newPassKey	= $this->uri->segment(4);
			
			 if(isset($_POST['submitResetPassword']))
					{ 
						$this->form_validation->set_rules('resetPassword', 'New Password', 'trim|required|xss_clean');
						$this->form_validation->set_rules('confirmPassword', 'Confirm new Password', 'trim|required|xss_clean|matches[resetPassword]');
						if ($this->form_validation->run())
						{
							$this->usermodel->resetPassword($_POST['userID'],$_POST['resetPassword']);
							$this->session->set_flashdata('forgotPasswordSuccess', 'Your password is successfully changed');
							redirect('login','refresh');
						}			
				}
					$canReset=$this->usermodel->canResetPassword($userId,$newPassKey,172800);
					if(!$canReset)
					{ 
						$this->session->set_flashdata('forgotPasswordLinkExpired', '<div class="alert alert-danger">This link is Expired or invalid</div>');
						redirect('users/forgotPassword','refresh');
					}
				$data['loggeduserId']=$userId;
				$this->load->view('user/resetPassword',$data);
	}
	
	function checkPassword()
	{
		$loggedUser=$this->session->userdata('loggedIn');
		$orgId=$loggedUser['organizationId'];
		$id=$loggedUser['id'];
		$oldPassword=md5($_POST['oldPassword']);
		$dbPassword=$this->usermodel->checkIsPasswordSame($oldPassword,$orgId,$id);
		if(isset($dbPassword))
		{
			if($dbPassword==$oldPassword)
			{
				echo "correct";exit;
			}
			else
			{
				echo "error";exit;
			}
		}
	}
	
	function changePassword()
	{
		if(!$this->session->userdata('loggedIn'))
		{
			redirect('login','refresh');
		}
		$loggedUser=$this->session->userdata('loggedIn');
		$orgId=$loggedUser['organizationId'];
		$id=$loggedUser['id'];
		$newPassword=md5($_POST['newPassword']);
		$this->usermodel->upadateNewPassword($newPassword,$orgId,$id);
		// email
		$data['newPassword']=$_POST['newPassword'];
		$data['userEmail']=$loggedUser['userEmail'];
		$data['siteName'] = $this->config->item('webSiteName','email');
		$this->Changed_password_send_email('changePassword',$data['userEmail'],$data);
		// email
	}
	
	function Changed_password_send_email($type, $email, &$data)
	{
		//print_r($data);
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		
		$this->email->initialize($config);
		$from = $this->config->item('webMasterEmail','email');
		$this->email->from($from);
		$this->email->reply_to('');
		$this->email->to($email);
		$this->email->subject(sprintf($this->config->item('changedPassword','email'),$this->config->item('webSiteName','email')));
		$this->email->message($this->load->view('email/'.$type.'_html',$data,true));
		//$this->email->set_alt_message($this->load->view('email/'.$type.'-txt',$data,true));
		$this->email->send();
	}
}
?>
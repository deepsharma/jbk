<?php

 class Usermodel extends CI_Model
 { 
	public $masterAdminLevel=1;
	public $adminLevel=2;
	function __construct()
	{
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . '../uploads/user_pic/');
		$this->load->database();
	}
	function login($userEmail, $password)
	{
		$ip= getenv('REMOTE_ADDR');
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('email = ' . "'" . $userEmail . "'");
		$this -> db -> where('password = ' . "'" . MD5($password) . "'");
		$this -> db -> where('status','Active');						//active status value is 1
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)		
		 {	
			return $query->result();		
		 }		
		 else		
		 {			
			return false;		
		 }
	}
	function checkExists($userEmail)
	{
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('email',$userEmail);
		$query = $this->db->get();
		$user = $query->row();
		return (isset($user->id))?true:false;
	}
	function isActivated($userEmail)//checking for account activation
	{
		$this->db->select('status');
		$this->db->from('users');
		$this->db->where('email',$userEmail);
		$query=$this->db->get();
		$user=$query->row();
		if (isset($user->status)){
		return $user->status;
		}
		else{
		return false;
		}
		
	}
	function insertUserDetails()
	{
		
		$activationKey = md5(rand().microtime());
		$userData = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'email' => $this->input->post('email'),
						'password' => md5($this->input->post('password2')),
						'user_level_id' => '2',
						'status' => 'Active',
						'activation_code' => $activationKey
						);
		$this->db->insert('users',$userData);
		$userId = $this->db->insert_id();
		return $userId;
	}
	function activate_user($id, $activationId)
	{
			
			$data = array('accountActivated' => '1');
			$this->db->where('id', $id);
			$this->db->where('activationKey', $activationId);
			$this->db->update('users',$data);
			return 'success'; 
	
	}
	function getAllUsers()
	{
		$usersId = array($this->config->item('MasterAdmin'));
		$this->db->select('*');
		$this->db->from('users');
		//$this->db->where('organizationId',$orgId);
		//$this->db->where('userStatus',1);
		$this->db->where_not_in('userlevel',$usersId);
		$data = $this->db->get();
		$currentUsers = $data->result();
		if($currentUsers)
			return $currentUsers;
		else
			return false;
	}
	function getAllUsersByOrg($orgId)
	{
		$usersId = array($this->config->item('MasterAdmin'),$this->config->item('Admin'));
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('organizationId',$orgId);
		$this->db->where('userStatus','1');
		$this->db->where_not_in('userlevel',$usersId);
		$data = $this->db->get();
		$currentUsers = $data->result();
		
		
		
		
		if($currentUsers)
			return $currentUsers;
		else
			return false;
	}
	function checkUserCreatePermission($orgId)
	{
		$query = $this->db->get_where("organization",array('id'=>$orgId));
		$org = $query->row();
		//print_r($org);
		$packageId = $org->package;
		$query = $this->db->get_where('package',array('id'=>$packageId));
		$packageDetails = $query->row();
		$query = $this->db->get_where('usage',array('organizationId'=>$orgId));
		$usage = $query->row();
		//echo $packageDetails->userCount." ".$usage->users;
		return ($packageDetails->userCount > $usage->users)?TRUE:FALSE;
	}
	function getUserPercentage($orgId)
	{
		$query = $this->db->get_where("organization",array('id'=>$orgId));
		$org = $query->row();
		//print_r($org);
		$packageId = $org->package;
		$query = $this->db->get_where('package',array('id'=>$packageId));
		$packageDetails = $query->row();
		$query = $this->db->get_where('usage',array('organizationId'=>$orgId));
		$usage = $query->row();
		//echo $packageDetails->userCount." ".$usage->users;
		$total = $packageDetails->userCount;
		$usagevalue = $usage->users;
		return $usagevalue*100/$total;
	}
	function getUserRole($userLevel)
	{
		$this->db->select('*');
		$this->db->where('userLevelId',$userLevel);
		$this->db->from('usersLevel');
		$query = $this->db->get();
		$rs = $query->row();
		return $rs->userLevel;
		
	}
	function saveUser($orgId,$userId)
	{
		$userStatus = ($this->input->post('ban_user'))?'0':'1';
		$data = array(
				'userName' => $this->input->post('name'),
				'password' => md5($this->input->post('password')),
				'userEmail' => $this->input->post('email'),
				'userPhone' => $this->input->post('mobile'),
				'userLevel' => $this->input->post('role'),
				'userCreatedById' => $userId,
				'userStatus' => $userStatus,
				'accountActivated' => '1',
				'organizationId' => $orgId
				);
		$this->db->insert('users',$data);
		$userId = $this->db->insert_id();
		$this->db->set('users',"users + 1",FALSE);
		$this->db->where('organizationId',$orgId);
		$this->db->update('usage');
		return $userId;
	}
	function updateUser($orgId,$userId)
	{
		$userStatus = ($this->input->post('ban_user'))?'0':'1';
		$data = array(
				'userName' => $this->input->post('name'),
				'userEmail' => $this->input->post('email'),
				'userPhone' => $this->input->post('phone'),
				'userCreatedById' => $userId,
				'userStatus' => $userStatus,
				'accountActivated' => '1',
				'organizationId' => $orgId
				);
				
		if($this->input->post('password'))
		{
			$data['password'] = md5($this->input->post('password'));
		}
		$this->db->where('id',$userId);
		$this->db->update('users',$data);
		return true;
	}
	function upload_profile_pic($userId)
	{
		
		$config	=	array(
						'allowed_types'	=> 'jpg|jpeg|gif|png',
						'upload_path'	=>	$this->gallery_path,
						'file_name'		=>	'img_'.$userId
							);
		//print_r($_FILES['profile_pic']);
		
		if($_FILES['profile_pic']['name']!='')									//file is selected
		{
			$this->load->library('upload',$config);
			$this->upload->overwrite	=	true;
			//var_dump($this->upload->do_upload('profile_pic'));
			//var_dump($this->upload->display_errors());
			if(!$this->upload->do_upload('profile_pic'))
			{
			//$this->session->set_flashdata('upload_error','error on uploading image');
			return $this->upload->display_errors();
			}
			else
			{
				$image_data=$this->upload->data();
				$config	=	array(
								'source_image'	=>	$image_data['full_path'],
								'create_thumb'	=>	true,
								'new_image'		=>	$this->gallery_path. '/thumbs',
								'mantain_ration'=>	true,
								'width'			=>	200,
								'height'		=>	200
								);
				$this->load->library('image_lib',$config);
				$this->image_lib->resize();
				$data['thumb_image_name'] = $image_data['raw_name'].'_thumb'.$image_data['file_ext'];
				if($image_data['file_name']!="")
				{
					$save=array(
								'userImagePath'=>$image_data['file_name']// thumbnil image $data['thumb_image_name']
								);
					$this->db->where('id',$userId);
					$this->db->update('users',$save);
				}
				
				return "SUCCESS"; 					//Returning Success full saving of profile pic and profile data
			} 
		}
	}
	function deleteUser()
	{
		$id = $this->input->post('id');
		$data = array('userStatus' => '0');
		$this->db->where('id', $id);
		$query=$this->db->update('users',$data);
		return ($query)?true:false;	
	}
	function banUser()// unlocking ban user
	{
		$id = $this->input->post('id');
		$data = array('userStatus' => '1');
		$this->db->where('id', $id);
		$query=$this->db->update('users',$data);
		return ($query)?true:false;	
	}
	function isEmailExist()// check for forgot password if email exist;
	{
		$email=$this->input->post('forgotPasswordEmail');
		$this->db->select('*');
		$this->db->where('userEmail',$email);
		$this->db->from('users');
		$query = $this->db->get();
		$data=$query->result_array();
		return ($data)?$data:false;
		
	}
	function setPasswordKey($userId, $newPassKey)
	{
		$this->db->set('newPasswordKey', $newPassKey);
		$this->db->set('newPasswordRequested', date('Y-m-d H:i:s'));
		$this->db->where('id', $userId);
		$this->db->update('users');
		return $this->db->affected_rows() > 0;
	}
	
	// function canResetPassword($userId, $newPassKey, $expirePeriod = 900)// 15*60=900 i.e 15 minuts
	// {
		// $this->db->select('1', FALSE);
		// $this->db->where('id', $userId);
		// $this->db->where('newPasswordKey', $newPassKey);
		// $this->db->where('UNIX_TIMESTAMP(newPasswordRequested) >', time() - $expirePeriod);
		// $query = $this->db->get('users');
		// return $query->num_rows() == 1;
	// }
	function canResetPassword($userId, $newPassKey, $expirePeriod = 172800)// 172800=48 hours
	{
		$this->db->select('1', FALSE);
		$this->db->where('id', $userId);
		$this->db->where('newPasswordKey', $newPassKey);
		$this->db->where('UNIX_TIMESTAMP(newPasswordRequested) >', time() - $expirePeriod);
		$query = $this->db->get('users');
		return $query->num_rows() == 1;
	}
	function resetPassword($userId,$password)
	{
		//$password=$this->post('resetPassword');
		$this->db->set('password', md5($password));
		$this->db->where('id', $userId);
		$query=$this->db->update('users');
		return  ($query)?true:false;
	}
	function getLastRecord($userId)
	{
		$this->db->select('*');
		$this->db->from('notes');
		$this->db->where('userId',$userId);
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$data = $this->db->get();
		$result = array();
			if($data->num_rows())
			{
				$notes = $data->row()->notes;
				$result['lastVisit'] = $this->ToHumanReadable($data->row()->statusTime);
				$result['notes'] = $notes;
			}
			else
			{
				$result['lastVisit'] = "N/A";
				$result['notes'] = "N/A";
			}
		return $result;
	}
	function ToHumanReadable($timestamp)
	{
		date_default_timezone_set("Asia/Kolkata");
		$difference = time() - strtotime($timestamp);
		$periods = array("sec", "min", "hour", "day", "week", "month", "years", "decade");
		$lengths = array("60","60","24","7","4.35","12","10");

		if ($difference > 0) { // this was in the past
			$ending = "ago";
		} else { // this was in the future
			$difference = -$difference;
			$ending = "to go";
		}       
		for($j = 0; $difference >= $lengths[$j]; $j++) $difference /= $lengths[$j];
		$difference = round($difference);
		if($difference != 1) $periods[$j].= "s";
		$text = $difference." ".$periods[$j]." ".$ending;
		return $text;
	}
	
	function getUsesDetailsByOrg($orgId)
	{
		$this->db->select("*");
		$this->db->from('usage');
		$this->db->where('organizationId',$orgId);
		
		return $this->db->get()->row();
	}
	function getPackageDetailsByOrg($orgId)
	{
		$this->db->select('package');
		$this->db->from('organization');
		$this->db->where('id',$orgId);
		$pack = $this->db->get()->row()->package;
		
		$data = $this->db->get_where('package',array('id'=>$pack));
		
		return $data->row();
	}
	function checkIsPasswordSame($password,$orgId,$id)
	{
		$this->db->select('password');
		$this->db->from('users');
		$this->db->where('id',$id);
		$this->db->where('organizationId',$orgId);
		$data = $this->db->get();
		$getData=$data->result();
		return isset($getData)?$getData[0]->password:false;
	}
	function upadateNewPassword($newPassword,$orgId,$id)
	{
		$data = array('password' => $newPassword);
		$this->db->where('id', $id);
		$this->db->where('organizationId', $orgId);
		$query=$this->db->update('users',$data);
		return ($query)?true:false;	
	}
 }
 ?>
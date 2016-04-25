<?php

 class Categorymodel extends CI_Model
 { 
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function getAllCategory()
	{
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('status','active');
		$data = $this->db->get();
		$getData=$data->result_array();
		$categoryDataArray=array();
		if(!empty($getData)){
			foreach($getData as $categoryData)
			{
				if($categoryData['category_type']=='Talent'){
					$categoryDataArray['Talent'][]=$categoryData;
				}
				else if($categoryData['category_type']=='Competetion'){
					$categoryDataArray['Competetion'][]=$categoryData;
				}
				else if($categoryData['category_type']=='Event'){
					$categoryDataArray['Event'][]=$categoryData;
				}
				
			}
			
		}
		return $categoryDataArray;
	}
	
 }
 ?>
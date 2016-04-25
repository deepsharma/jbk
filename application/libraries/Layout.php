<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Layout 
{
    public $head = 'layout/head';
    public $header = 'layout/header';
    public $sidebar_left = 'layout/sidebar_left';
	function __construct()
	{
		$this->lt =& get_instance();	
		
	}
	function view($view ='', $data ='')//load view in controller with layout
	{
	
		$this->lt->load->view($this->head,$data);
		$this->lt->load->view($this->header,$data);
		$this->lt->load->view($this->sidebar_left,$data);
		$this->lt->load->view($view, $data);
		
	}
}
?>
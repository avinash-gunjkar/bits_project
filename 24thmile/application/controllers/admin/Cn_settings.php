<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_settings extends CI_Controller {

	public $session_user;
	public $viewFilePath ="backend/settings/";
	public $redirectPath = "admin/settings";
	public function __construct()
	{
		parent::__construct();
                
                
		//$this->load->model('settins_model','MODEL',true);
		
		
	}
	
	public function general()
	{	
		$app_id ='24';
		$this->session_user = checkAdminSession($app_id);
		
		if($this->input->post()){
			$settings = $this->input->post('settings');
			
			foreach($settings as $key=>$val){
				
				$this->db->set('setting_value', $val);
				$this->db->where('setting_name', $key);
				$this->db->update('tbl_settings');
			}
		
		}

		$data['page_title'] = "General Settings";
		$data['list'] = getGlobalValues();
		$data['page'] = $this->viewFilePath.'general';
		$this->load->view('backend/layout_main', $data);
	}
	public function social()
	{	
		$app_id ='25';
		$this->session_user = checkAdminSession($app_id);

		if($this->input->post()){
			$socials = $this->input->post('settings');
			
			foreach($socials as $key=>$row){
				
				$this->db->set('social_value', $row['social_value']);
				$this->db->where('social_id', $row['social_id']);
				$this->db->update('tbl_social');
			}
		
		}

		$data['page_title'] = "Social Settings";
		$data['list'] = getSocialLinks();
		$data['page'] = $this->viewFilePath.'social';
		$this->load->view('backend/layout_main', $data);
	}
	

	
}
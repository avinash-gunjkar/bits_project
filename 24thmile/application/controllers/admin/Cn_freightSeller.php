<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_freightSeller extends CI_Controller {

    public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='2';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model ('User_model', 'USER', TRUE);
		$this->load->model ('app_previlages');
		
	}
	
	public function index()
	{	$data['user_list'] = $this->USER->getList(['2']);
		$data['page'] = 'backend/freight-seller/index';
		$this->load->view('backend/layout_main', $data);
	}
	




	public function changeStatus()
	{
		$id = $this->input->post('id');
                
                if(empty($id)){
                     echo json_encode(array('status'=>0,'msg'=>"User details not found."));	
                     die;
                }
		$isActive = $this->input->post('isActive');
		$role = 2;
		$dbOject = array(
						'isActive' => $isActive, 
						'updated_at' => date("Y-m-d H:i:s") 
						);
	
		$mesg_sub = $isActive == 1 ? 'Activated' : 'Deactivated';
		$user_data = $this->USER->getRecord($role,$id);	
		$msg = $user_data->firstname.' '.$user_data->lastname.' '.$mesg_sub ;	
		if($this->USER->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
                         die;
		}else{
                    $msg = "Error";
			 echo json_encode(array('status'=>0,'msg'=>$msg));	
                          die;
		}

	}
	
	
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_freightForwarder extends CI_Controller {

    public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='1';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model ('User_model', 'USER', TRUE);
		$this->load->model ('app_previlages');
		
	}
	
	public function index()
	{	$data['user_list'] = $this->USER->getList(['3']);
		$data['page'] = 'backend/freight-forwarder/index';
		$this->load->view('backend/layout_main', $data);
	}
	
        
        
	public function edit($id)
	{ 
		if($this->input->post() && $this->input->is_ajax_request()){
			$user_id = $this->input->post('user_id');
			$user_name = $this->input->post('user_name');
			$user_description = $this->input->post('user_description');
			// $isActive = $this->input->post('isActive');
			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'name' => $user_name,
								'description' => $user_description, 
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->USER->update($user_id,$dbOject)){
				$msg = 'User '.$user_name .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$user_name)); 
				return true;
			}else{
				$msg = 'User '.$user_name .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$user_name)); 
				return true;
			}
		}

		$user_data = $this->USER->getRecord($id);
		$user_profile = $this->USER->getUserProfile($id);
		//print_r($user_profile);die;
		if($user_data){
			$data['modules'] = $this->USER->getModules();
			$data['roles'] = $this->USER->getRoles();
			$data['user_data'] = $user_data;
			$data['user_profile'] = $user_profile;
			$data['page'] = 'backend/user/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['modules'] = $this->USER->getModules();
			$data['roles'] = $this->USER->getRoles();
			$data['user_profile'] = $user_profile;
			$data['page'] = 'backend/user/edit';
			$this->load->view('backend/layout_main', $data);
		}
	}


	public function changeStatus()
	{
		$id = $this->input->post('id');
                
                if(empty($id)){
                     echo json_encode(array('status'=>0,'msg'=>"User details not found."));	
                     die;
                }
		$isActive = $this->input->post('isActive');
		$role = 3;
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Role_model', 'ROLE', TRUE);
		
	}
	
	public function index()
	{	$data['role_list'] = $this->ROLE->getList();
		$data['page'] = 'backend/role/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$role_name = $this->input->post('role_name');
			$role_description = $this->input->post('role_description');

			if(!$role_name){
				$err = "Role Name is Not provided";
			}
			if(!$role_description){
				$err = "Role Description is Not provided";
			}
			if(empty($err) && $err==''){
				$dbOject = array(
								'name' => $role_name,
								'description' => $role_description,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->ROLE->insert($dbOject)){
					$msg = "Role <b>".$role_name ."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$role_name)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/role/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$role_id = $this->input->post('role_id');
			$role_name = $this->input->post('role_name');
			$role_description = $this->input->post('role_description');
			// $isActive = $this->input->post('isActive');
			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'name' => $role_name,
								'description' => $role_description, 
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->ROLE->update($role_id,$dbOject)){
				$msg = 'Role '.$role_name .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$role_name)); 
				return true;
			}else{
				$msg = 'Role '.$role_name .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$role_name)); 
				return true;
			}
		}

		$role_data = $this->ROLE->getRecord($id);
		//print_r($role_profile);die;
		if($role_data){
			$data['modules'] = $this->ROLE->getModules();
			$data['role_data'] = $role_data;
			$data['page'] = 'backend/role/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['modules'] = $this->ROLE->getModules();
			$data['role_data'] = $role_data;
			$data['page'] = 'backend/role/edit';
			$this->load->view('backend/layout_main', $data);
		}
	}


	public function changeStatus()
	{
		$id = $this->input->post('id');
		$isActive = $this->input->post('isActive');

		$dbOject = array(
						'isActive' => $isActive, 
						'updated_at' => date("Y-m-d H:i:s") 
						);
	
		$mesg_sub = $isActive == 1 ? 'Activated' : 'Deactivated';
		$role_data = $this->ROLE->getRecord($id);	
		$msg = $role_data['firstname'].' '.$role_data['lastname'].' '.$mesg_sub ;	
		if($this->ROLE->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
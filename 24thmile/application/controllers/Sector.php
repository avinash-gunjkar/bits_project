<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sector extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='14';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Sector_model', 'SECTOR', TRUE); 
		
	}
	
	public function index()
	{	$data['sector_list'] = $this->SECTOR->getList();
		$data['page'] = 'backend/sector/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$sector_name = $this->input->post('sector_name');
			$sector_description = $this->input->post('sector_description');

			if(!$sector_name){
				$err = "Sector Name is Not provided";
			}
			if(!$sector_description){
				$err = "Sector Description is Not provided";
			}
			if(empty($err) && $err==''){
				$dbOject = array(
								'name' => $sector_name,
								'description' => $sector_description,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->SECTOR->insert($dbOject)){
					$msg = "Sector <b>".$sector_name ."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$sector_name)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/sector/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$sector_id = $this->input->post('sector_id');
			$sector_name = $this->input->post('sector_name');
			$sector_description = $this->input->post('sector_description');
			// $isActive = $this->input->post('isActive');
			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'name' => $sector_name,
								'description' => $sector_description, 
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->SECTOR->update($sector_id,$dbOject)){
				$msg = 'Sector '.$sector_name .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$sector_name)); 
				return true;
			}else{
				$msg = 'Sector '.$sector_name .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$sector_name)); 
				return true;
			}
		}

		$sector_data = $this->SECTOR->getRecord($id);
		if($sector_data){
			$data['sector_data'] = $sector_data;
			$data['page'] = 'backend/sector/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			 

			$data['page'] = 'backend/sector/edit';
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
		$sector_data = $this->SECTOR->getRecord($id);	
		$msg = $sector_data['name'].' '.$mesg_sub ;	
		if($this->SECTOR->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dimension extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();

                $app_id ='';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model ('Dimension_model', 'DIMENSION', TRUE);
		$this->load->model ('Container_model', 'CONTAINER', TRUE);
		$this->load->model ('Sector_model', 'SECTOR', TRUE);
	}
	
	public function index()	
	{
		$dimension_name = $this->DIMENSION->getcontainerNameWithDimensionList();
		$data['dimension_list'] = $dimension_name;
		$data['page'] = 'backend/dimension/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{
		$err='';
		$msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$dimension_name = $this->input->post('name');
			$sector_id = $this->input->post('sector_id');
			$unit_id = $this->input->post('unit_id');

			if(!$dimension_name){
				$err = "Dimension Type is Not provided";
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'unit_id' => $unit_id,
								'sector_id' => $sector_id,
								'name' => $dimension_name,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->DIMENSION->insert($dbOject)){
					$msg = "Dimension <b>".$dimension_name."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$dimension_name)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['sector_list'] = $this->SECTOR->getList(true);
		$data['container_list'] = $this->CONTAINER->getList();
		$data['page'] = 'backend/dimension/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$dimension_id = $this->input->post('dimension_id');
			$container_id = $this->input->post('container_id');
			$dimension_name = $this->input->post('name');

			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
							'unit_id' => $unit_id,
							'sector_id' => $sector_id,
							'name' => $dimension_name,
							'isActive' => $isActive, 
							'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->DIMENSION->update($dimension_id,$dbOject)){
				$msg = 'Dimension '.$dimension_name .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$dimension_name)); 
				return true;
			}else{
				$msg = 'Dimension '.$dimension_name .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$dimension_name)); 
				return true;
			}
		}

		$data['container_list'] = $this->CONTAINER->getList();
		$data['sector_list'] = $this->SECTOR->getList();
		$dimension_data = $this->DIMENSION->getRecord($id);

		if($dimension_data){
			$data['dimension_data'] = $dimension_data;
			$data['page'] = 'backend/dimension/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/dimension/edit';
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
		$dimension_data = $this->DIMENSION->getRecord($id);	
		$msg = $dimension_data['name'].' '.$mesg_sub ;	
		if($this->DIMENSION->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
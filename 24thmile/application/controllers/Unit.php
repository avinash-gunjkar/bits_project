<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Unit_model', 'UNIT', TRUE); 
		
	}
	
	public function index()
	{	$data['unit_list'] = $this->UNIT->getList();
		$data['page'] = 'backend/unit/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$unit_type = $this->input->post('unit_type');

			if(!$unit_type){
				$err = "Unit type is not provided";
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'type' => $unit_type,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->UNIT->insert($dbOject)){
					$msg = "Unit <b> ".$unit_type." </b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$unit_type)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/unit/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$unit_id = $this->input->post('unit_id');
			$unit_type = $this->input->post('unit_type');

			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'type' => $unit_type,
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->UNIT->update($unit_id,$dbOject)){
				$msg = 'Unit '.$unit_type .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$unit_type)); 
				return true;
			}else{
				$msg = 'Unit '.$unit_type .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$unit_type)); 
				return true;
			}
		}

		$unit_data = $this->UNIT->getRecord($id);
		if($unit_data){
			$data['unit_data'] = $unit_data;
			$data['page'] = 'backend/unit/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/unit/edit';
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
	
		$msg_sub = $isActive == 1 ? 'Activated' : 'Deactivated';
		$unit_data = $this->UNIT->getRecord($id);	
		$msg = $unit_data['type'].' '.$msg_sub ;	
		if($this->UNIT->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
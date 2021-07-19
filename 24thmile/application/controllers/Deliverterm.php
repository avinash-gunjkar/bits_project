<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deliverterm extends CI_Controller {
        public $session_user;
	public function __construct()
	{
		parent::__construct();

                $app_id ='11';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Deliver_term_model', 'DELIVERTERM', TRUE); 
		
	}
	
	public function index()	{
		// echo "okk";die;
		$data['deliverterm_list'] = $this->DELIVERTERM->getList();
		$data['page'] = 'backend/deliver_term/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$deliverterm_name = $this->input->post('deliverterm_name');
			$deliverterm_description = $this->input->post('deliverterm_description');

			if(!$deliverterm_name){
				$err = "Deliver Term Name is Not Provided";
			}
			if(!$deliverterm_description){
				$err = "Deliver Term Description is Not Provided";
			}
			if(empty($err) && $err==''){
				$dbOject = array(
								'name' => $deliverterm_name,
								'description' => $deliverterm_description,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->DELIVERTERM->insert($dbOject)){
					$msg = "Company <b>".$deliverterm_name ."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$deliverterm_name)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/deliver_term/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 		
		if($this->input->post() && $this->input->is_ajax_request()){
			$deliverterm_id = $this->input->post('deliverterm_id');
			$deliverterm_name = $this->input->post('deliverterm_name');
			$deliverterm_description = $this->input->post('deliverterm_description');
			// $isActive = $this->input->post('isActive');
			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}
			

			$dbOject = array(
								'name' => $deliverterm_name,
								'description' => $deliverterm_description, 
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->DELIVERTERM->update($deliverterm_id,$dbOject)){
				$msg = 'Deliver Term '.$deliverterm_name .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$deliverterm_name)); 
				return true;
			}else{
				$msg = 'Deliver Term '.$deliverterm_name .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$deliverterm_name)); 
				return true;
			}
		}

		$deliverterm_data = $this->DELIVERTERM->getRecord($id);
		if($deliverterm_data){
			$data['deliverterm_data'] = $deliverterm_data;
			$data['page'] = 'backend/deliver_term/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/deliver_term/edit';
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
		$deliverterm_data = $this->DELIVERTERM->getRecord($id);	
		$msg = $deliverterm_data['name'].' '.$mesg_sub ;	
		if($this->DELIVERTERM->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
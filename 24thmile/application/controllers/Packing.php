<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packing extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='13';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Packing_model', 'PACKING', TRUE); 
		
	}
	
	public function index()
	{	
		$data['packing_list'] = $this->PACKING->getList();
		$data['page'] = 'backend/packing/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$packing_type = $this->input->post('packing_type');

			if(!$packing_type){
				$err = "Packing Type is Not provided";
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'type' => $packing_type,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->PACKING->insert($dbOject)){
					$msg = "Packing <b>".$packing_type	 ."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$packing_type)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/packing/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$packing_id = $this->input->post('packing_id');
			$packing_type = $this->input->post('packing_type');
// print_r($this->input->post());die;
			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'type' => $packing_type,
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->PACKING->update($packing_id,$dbOject)){
				$msg = 'Packing '.$packing_type .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$packing_type)); 
				return true;
			}else{
				$msg = 'Packing '.$packing_type .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$packing_type)); 
				return true;
			}
		}

		$packing_data = $this->PACKING->getRecord($id);
		if($packing_data){
			$data['packing_data'] = $packing_data;
			$data['page'] = 'backend/packing/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/packing/edit';
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
		$packing_data = $this->PACKING->getRecord($id);	
		$msg = $packing_data['type'].' '.$mesg_sub ;	
		if($this->PACKING->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
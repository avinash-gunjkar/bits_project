<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends CI_Controller {

     public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Contract_model', 'CONTRACT', TRUE); 
		
	}
	
	public function index()
	{	$data['contract_list'] = $this->CONTRACT->getList();
		$data['page'] = 'backend/contract/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$contract_type = $this->input->post('contract_type');

			if(!$contract_type){
				$err = "Contract Type is Not provided";
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'type' => $contract_type,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->CONTRACT->insert($dbOject)){
					$msg = "Container <b>".$contract_type	 ."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$contract_type)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/contract/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$contract_id = $this->input->post('contract_id');
			$contract_type = $this->input->post('contract_type');
// print_r($this->input->post());die;
			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'type' => $contract_type,
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->CONTRACT->update($contract_id,$dbOject)){
				$msg = 'Contract '.$contract_type .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$contract_type)); 
				return true;
			}else{
				$msg = 'Contract '.$contract_type .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$contract_type)); 
				return true;
			}
		}

		$contract_data = $this->CONTRACT->getRecord($id);
		if($contract_data){
			$data['contract_data'] = $contract_data;
			$data['page'] = 'backend/contract/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/contract/edit';
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
		$contract_data = $this->CONTRACT->getRecord($id);	
		$msg = $contract_data['type'].' '.$mesg_sub ;	
		if($this->CONTRACT->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
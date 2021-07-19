<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rate extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Rate_model', 'RATE', TRUE); 
		
	}
	
	public function index()
	{	$data['rate_list'] = $this->RATE->getList();
		$data['page'] = 'backend/rate/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$rate_type = $this->input->post('rate_type');

			if(!$rate_type){
				$err = "Rate Type is Not provided";
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'type' => $rate_type,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->RATE->insert($dbOject)){
					$msg = "Rate <b>".$rate_type	 ."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$rate_type)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/rate/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$rate_id = $this->input->post('rate_id');
			$rate_type = $this->input->post('rate_type');

			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'type' => $rate_type,
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->RATE->update($rate_id,$dbOject)){
				$msg = 'Rate '.$rate_type .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$rate_type)); 
				return true;
			}else{
				$msg = 'Rate '.$rate_type .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$rate_type)); 
				return true;
			}
		}

		$rate_data = $this->RATE->getRecord($id);
		if($rate_data){
			$data['rate_data'] = $rate_data;
			$data['page'] = 'backend/rate/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/rate/edit';
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
		$rate_data = $this->RATE->getRecord($id);	
		$msg = $rate_data['type'].' '.$mesg_sub ;	
		if($this->RATE->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
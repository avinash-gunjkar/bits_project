<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mode extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();
                
                $app_id ='12';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Mode_model', 'MODE', TRUE); 
		
	}
	
	public function index()
	{	$data['mode_list'] = $this->MODE->getList();
		$data['page'] = 'backend/mode/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$mode_type = $this->input->post('mode_type');

			if(!$mode_type){
				$err = "Mode type is not provided";
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'type' => $mode_type,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->MODE->insert($dbOject)){
					$msg = "Mode <b> ".$mode_type." </b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$mode_type)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/mode/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$mode_id = $this->input->post('mode_id');
			$mode_type = $this->input->post('mode_type');

			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'type' => $mode_type,
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->MODE->update($mode_id,$dbOject)){
				$msg = 'Mode '.$mode_type .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$mode_type)); 
				return true;
			}else{
				$msg = 'Mode '.$mode_type .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$mode_type)); 
				return true;
			}
		}

		$mode_data = $this->MODE->getRecord($id);
		if($mode_data){
			$data['mode_data'] = $mode_data;
			$data['page'] = 'backend/mode/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/mode/edit';
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
		$mode_data = $this->MODE->getRecord($id);	
		$msg = $mode_data['type'].' '.$mesg_sub ;	
		if($this->MODE->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
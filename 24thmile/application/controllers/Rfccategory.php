<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rfccategory extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Rfc_category_model', 'RFCCATEGORY', TRUE); 
		
	}
	
	public function index()	{
		// echo "okk";die;
		$data['rfccategory_list'] = $this->RFCCATEGORY->getList();
		$data['page'] = 'backend/rfc_category/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$rfc_category_name = $this->input->post('rfc_category_name');

			if(!$rfc_category_name){
				$err = "Rfc category Name is Not Provided";
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'rfc_category_name' => $rfc_category_name,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->RFCCATEGORY->insert($dbOject)){
					$msg = "Company <b>".$rfc_category_name ."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$rfc_category_name)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/rfc_category/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 		
		if($this->input->post() && $this->input->is_ajax_request()){
			$rfc_category_id = $this->input->post('rfc_category_id');
			$rfc_category_name = $this->input->post('rfc_category_name');
			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}
			

			$dbOject = array(
								'rfc_category_name' => $rfc_category_name,
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->RFCCATEGORY->update($rfc_category_id,$dbOject)){
				$msg = 'Rfc category '.$rfc_category_name .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$rfc_category_name)); 
				return true;
			}else{
				$msg = 'Rfc category '.$rfc_category_name .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$rfc_category_name)); 
				return true;
			}
		}

		$rfccategory_data = $this->RFCCATEGORY->getRecord($id);
		if($rfccategory_data){
			$data['rfccategory_data'] = $rfccategory_data;
			$data['page'] = 'backend/rfc_category/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/rfc_category/edit';
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
		$rfccategory_data = $this->RFCCATEGORY->getRecord($id);	
		$msg = $rfccategory_data['rfc_category_name'].' '.$mesg_sub ;	
		if($this->RFCCATEGORY->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

    public $session_user;
	public function __construct()
	{
		parent::__construct();

                $app_id ='17';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model ('Document_model', 'DOCUMENT', TRUE); 
		
	}
	
	public function index()
	{	$data['document_list'] = $this->DOCUMENT->getList();
		$data['page'] = 'backend/document/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$document_name = $this->input->post('document_name');

			if(!$document_name){
				$err = "Container Type is Not provided";
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'name' => $document_name,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->DOCUMENT->insert($dbOject)){
					$msg = "Container <b>".$document_name	 ."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$document_name)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/document/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$document_id = $this->input->post('document_id');
			$document_name = $this->input->post('document_name');

			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'name' => $document_name,
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->DOCUMENT->update($document_id,$dbOject)){
				$msg = 'Document '.$document_name .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$document_name)); 
				return true;
			}else{
				$msg = 'Document '.$document_name .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$document_name)); 
				return true;
			}
		}

		$document_data = $this->DOCUMENT->getRecord($id);
		if($document_data){
			$data['document_data'] = $document_data;
			$data['page'] = 'backend/document/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/document/edit';
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
		$document_data = $this->DOCUMENT->getRecord($id);	
		$msg = $document_data['name'].' '.$mesg_sub ;	
		if($this->DOCUMENT->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
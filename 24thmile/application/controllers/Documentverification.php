<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentverification extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();

                 $app_id ='';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model ('Documentverification_model', 'DOCUMENTVERIFICATION', TRUE); 
		$this->load->model ('Companydocumentverification_model', 'COMPANYDOCUMENTVERIFICATION', TRUE); 
		//$this->load->model ('Sellerdocumentverification_model', 'SELLERDOCUMENTVERIFICATION', TRUE); 
		
	}
	
	public function index()
	{	
		$data['documentverification_list'] = $this->DOCUMENTVERIFICATION->getList();
		$data['companydocumentverification_list'] = $this->COMPANYDOCUMENTVERIFICATION->getList();
		$selectedItemList = $this->COMPANYDOCUMENTVERIFICATION->getSelectedIdList();
		$selected_arr = array();
		foreach ($selectedItemList as $selectedItem) {
			array_push($selected_arr, $selectedItem['document_id']);
			
		}

		$data['checked_document_id'] = $selected_arr;

		$data['page'] = 'backend/document_verification/company_kyc';
		$this->load->view('backend/layout_main', $data);
	}
 

	function getSelectedDocumentsIsArray(){
		$data = $this->COMPANYDOCUMENTVERIFICATION->getSelectedIdListDetails();
		echo json_encode($data);
	}

	public function companyAddDocuments()
	{
		$err =array();
		$this->COMPANYDOCUMENTVERIFICATION->truncate();
		
		if($this->input->post() && $this->input->is_ajax_request()){
		

			$document_arr = $this->input->post('document');
	
			if(empty($err)){
				$dbOject = array(
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
			
				foreach($document_arr as $document_list){
			        $dbOject['document_id'] = $document_list;
			        $this->COMPANYDOCUMENTVERIFICATION->insert($dbOject); 
			    } 
				
				redirect(base_url('backend/documentverification/company_kyc', 'refresh'));

			}
		}
	}

	// public function sellerAddDocuments()
	// {
	// 	$data['documentverification_list'] = $this->DOCUMENTVERIFICATION->getList();
	// 	$data['sellerdocumentverification_list'] = $this->SELLERDOCUMENTVERIFICATION->getList();
	// 	$selectedItemList = $this->SELLERDOCUMENTVERIFICATION->getSelectedIdList();
	// 	$selected_arr = array();
	// 	foreach ($selectedItemList as $selectedItem) {
	// 		array_push($selected_arr, $selectedItem['document_id']);
			
	// 	}

	// 	$data['checked_document_id'] = $selected_arr;

	// 	$err =array();
	// 	if($this->input->post() && $this->input->is_ajax_request()){

	// 		$this->SELLERDOCUMENTVERIFICATION->truncate();

	// 		$document_arr = $this->input->post('document');
	
	// 		if(empty($err)){
	// 			$dbOject = array(
	// 							'created_at' => date("Y-m-d H:i:s"),
	// 							'updated_at' => date("Y-m-d H:i:s")
	// 							);
			
	// 			foreach($document_arr as $document_list){
	// 		        $dbOject['document_id'] = $document_list;
	// 		        $this->SELLERDOCUMENTVERIFICATION->insert($dbOject); 
	// 		    } 
				
	// 			redirect(base_url('backend/documentverification/seller_kyc', 'refresh'));

	// 		}
	// 	}

	// 	$data['page'] = 'backend/document_verification/seller_kyc';
	// 	$this->load->view('backend/layout_main', $data);
	// }

	// public function edit($id)
	// { 
		
	// 	if($this->input->post() && $this->input->is_ajax_request()){
	// 		$document_id = $this->input->post('document_id');
	// 		$document_name = $this->input->post('document_name');

	// 		if ($this->input->post('isActive') == 'on') {
	// 			$isActive = 1;
	// 		}
	// 		else{
	// 			$isActive = 0;
	// 		}

	// 		$dbOject = array(
	// 							'name' => $document_name,
	// 							'isActive' => $isActive, 
	// 							'updated_at' => date("Y-m-d H:i:s")
	// 						);

	// 		if($this->DOCUMENTVERIFICATION->update($document_id,$dbOject)){
	// 			$msg = 'Document '.$document_name .' updated successfully.';
	// 			echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$document_name)); 
	// 			return true;
	// 		}else{
	// 			$msg = 'Document '.$document_name .' failed to updated.';				
	// 			echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$document_name)); 
	// 			return true;
	// 		}
	// 	}

	// 	$documentverification_data = $this->DOCUMENTVERIFICATION->getRecord($id);
	// 	if($documentverification_data){
	// 		$data['documentverification_data'] = $documentverification_data;
	// 		$data['page'] = 'backend/document_verification/edit';
	// 		$this->load->view('backend/layout_main', $data);
	// 	}else{
	// 		$data['page'] = 'backend/document_verification/edit';
	// 		$this->load->view('backend/layout_main', $data);
	// 	}
	// }


	// public function changeStatus()
	// {
	// 	$id = $this->input->post('id');
	// 	$isActive = $this->input->post('isActive');

	// 	$dbOject = array(
	// 					'isActive' => $isActive, 
	// 					'updated_at' => date("Y-m-d H:i:s") 
	// 					);
	
	// 	$mesg_sub = $isActive == 1 ? 'Activated' : 'Deactivated';
	// 	$documentverification_data = $this->DOCUMENTVERIFICATION->getRecord($id);	
	// 	$msg = $documentverification_data['name'].' '.$mesg_sub ;	
	// 	if($this->DOCUMENTVERIFICATION->update($id,$dbOject)){			
	// 		echo json_encode(array('status'=>1,'msg'=>$msg));
	// 	}else{
	// 		 echo json_encode(array('status'=>0,'msg'=>$msg));			 
	// 	}

	// }
}
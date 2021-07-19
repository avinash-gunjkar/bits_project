<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sectorwisedocument extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='18';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Sectorwisedocument_model', 'SECTORWISEDOCUMENT', TRUE); 
		// $this->load->model ('Companydocumentverification_model', 'COMPANYDOCUMENTVERIFICATION', TRUE); 
		$this->load->model ('Sector_model', 'SECTOR', TRUE); 
		$this->load->model ('Document_model', 'DOCUMENT', TRUE); 
		
	}
	
	public function index()
	{	
		// echo "ok";die;
		$data['sector_wise_document_list'] = $this->DOCUMENT->getList();
		$data['companydocumentverification_list'] = $this->SECTORWISEDOCUMENT->getList();
		$data['sector_list'] = $this->SECTOR->getList();
		$selectedItemList = $this->SECTORWISEDOCUMENT->getSelectedIdList();

		$selected_arr = array();
		foreach ($selectedItemList as $selectedItem) {
			array_push($selected_arr, $selectedItem['id']);
			
		}

		$data['checked_document_id'] = $selected_arr;

		$data['page'] = 'backend/sector_wise_documents/sector_wise_document';
		$this->load->view('backend/layout_main', $data);
	}
 

	function getSelectedDocumentsIsArray(){
		$sector_id = $this->input->post('sector_id');
		$data = $this->SECTORWISEDOCUMENT->getSelectedIdListDetails($sector_id);
		echo json_encode($data);
	}


	public function sectorwiseAddDocuments()
	{
		
		

		$err =array();

		if($this->input->post())
		{

		$document_arr = $this->input->post('document');
		$sector_id = $this->input->post('sector_id');

		$sector = $this->SECTOR->getRecord($sector_id);


		if ($this->SECTORWISEDOCUMENT->isSectorIdExist($sector_id)) {
			$this->SECTORWISEDOCUMENT->deleteAllRecBySectorId($sector_id);


			$dbOject = array(
							'sector_id' => $sector_id,
							'created_at' => date("Y-m-d H:i:s"),
							'updated_at' => date("Y-m-d H:i:s")
							);
		
			foreach($document_arr as $document_list){
		        $dbOject['document_id'] = $document_list;
		        $this->SECTORWISEDOCUMENT->insert($dbOject); 

		    }
	        echo json_encode(array('status'=> 1, 'msg'=> $sector['name'].' Document list updated successfully'));
	        return true;
		}else {
			$dbOject = array(
							'sector_id' => $sector_id,
							'created_at' => date("Y-m-d H:i:s"),
							'updated_at' => date("Y-m-d H:i:s")
							);
		
			foreach($document_arr as $document_list){
		        $dbOject['document_id'] = $document_list;
		        $this->SECTORWISEDOCUMENT->insert($dbOject); 
		    }
		    echo json_encode(array('status'=> 1, 'msg'=>$sector['name'].' Document list added successfully'));
		    return true;
		}
			// redirect(base_url('backend/sector_wise_documents/sector_wise_document', 'refresh'));
		}
	}

}
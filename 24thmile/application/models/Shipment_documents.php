<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment_documents extends CI_Model{

	private $TBL='tbl_shipment_documents';

	function __construct(){
		parent::__construct();
	}

	public function insert($data){
		if($this->db->insert($this->TBL,$data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	public function update($id,$data){
		$this->db->where('id', $id);
		if($this->db->update($this->TBL, $data)){
			return true;
		}else{
			return false;
		}
	}

	// public function getRecord($id){
	// 	$this->db->where('id', $id);
	// 	$query = $this->db->get($this->TBL);
	// 	$row=array();
	// 	if ($query->num_rows() > 0){
	// 		$row = $query->row_array();
	// 	}
	// 	return $row;
	// } 

	public function delete($id){
		return	$this->db->delete($this->TBL, array('id' => $id));
	}
	
	public function deleteDocument($condition){
		return	$this->db->delete($this->TBL, $condition);
	}

    //get document details based on request_id, document_type, company_id
	public function getRecord($master_form_id, $document_type, $company_id){
		$this->db->select('*');
		$this->db->where('master_form_id',$master_form_id);
		$this->db->where('company_id',$company_id);
		$this->db->where('document_type',$document_type);
		$query=$this->db->get($this->TBL);
		
		return $query->row();
	}
    //return total count of document based on document_type, company_id
	public function getCount($document_type, $company_id){
		$this->db->select('COUNT(*) AS CNT');
		$this->db->where('company_id',$company_id);
		$this->db->where('document_type',$document_type);
		$query=$this->db->get($this->TBL);
		return $query->row()->CNT;
	}

    //return list of documents based on request_id, document_type, company_id
  	public function getList($master_form_id, $company_id,$filter=[]){
		$this->db->Select("tbl_shipment_document_master.document,tbl_shipment_document_master.name,$this->TBL.id, $this->TBL.invoice_number,$this->TBL.invoice_date,$this->TBL.invoice_amount, $this->TBL.status, $this->TBL.created_at");
		// $this->db->where('request_id',$request_id);
		// $this->db->where('company_id',$company_id);

		//$this->db->where_in('transiction',$filter['transiction']);
		// $this->db->where_in('user_type',$filter['user_type']);
		$this->db->where('rank > 0');
		if(isset($filter['shipment_type'])){
			$this->db->where('shipment_type',$filter['shipment_type']);
		}
		//$this->db->join('tbl_shipment_document_master',"tbl_shipment_document_master.document = $this->TBL.document_type ","left");
		$this->db->join('tbl_shipment_document_master',"$this->TBL.document_type = tbl_shipment_document_master.document AND master_form_id = $master_form_id AND company_id = $company_id ","RIGHT");
		$this->db->order_by('rank');
		$query = $this->db->get($this->TBL);
		
		return $query->result();
	}

	public function getDocumentList($request_id, $company_id, $filter){
		$filter['shipment_type'] = 'Pre-Shipment';
		$pre_shipment_doc = $this->getList($request_id, $company_id, $filter);

		$filter['shipment_type'] = 'Post-Shipment';
		$post_shipment_doc = $this->getList($request_id, $company_id, $filter);

		$filter['shipment_type'] = 'Shipment-Instruction';
		$shipment_instruction_doc = $this->getList($request_id, $company_id, $filter);
		return  [
			'pre-shipment' => $pre_shipment_doc,
			'post-shipment'=> $post_shipment_doc,
			'shipment_instructions'=> $shipment_instruction_doc,
		];
	}
	
	

}
?>

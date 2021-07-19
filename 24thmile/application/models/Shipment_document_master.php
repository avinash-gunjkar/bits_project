<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment_document_master extends CI_Model{

	private $TBL='tbl_shipment_document_master';
	function __construct(){
		parent::__construct();
	}

	
	public function getList($filter){
		$this->db->where_in('transiction',$filter['transiction']);
		$this->db->where_in('user_type',$filter['user_type']);

		if(isset($filter['shipment_type'])){
			$this->db->where('shipment_type',$filter['shipment_type']);
		}
		$query = $this->db->get($this->TBL);
		return $query->result();
	}

	public function getDocumentList($filter){
		$filter['shipment_type'] = 'Pre-Shipment';
		$pre_shipment_doc = $this->getList($filter);

		$filter['shipment_type'] = 'Post-Shipment';
		$post_shipment_doc = $this->getList($filter);
		return  [
			'pre-shipment' => $pre_shipment_doc,
			'post-shipment'=> $post_shipment_doc
		];
	}

}
?>

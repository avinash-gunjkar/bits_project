<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_master_form extends CI_Model{

	private $TBL='tbl_document_master_form';

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

	public function getRecord($id='',$request_id='',$company_id){
		
		if(empty($id) && empty($request_id)){
			return null;
		}
		if($id!=''){
			$this->db->where("$this->TBL.id", $id);
		}
		if($request_id!=''){
			$this->db->where("$this->TBL.request_id", $request_id);
		}
		$this->db->where("$this->TBL.created_by_company_id", $company_id);
		
		$this->db->select("$this->TBL.*,tbl_shipment.type as shipment,tbl_mode.type as mode");

		$this->db->join('tbl_shipment', "tbl_shipment.id = $this->TBL.shipment_id", 'left');
		$this->db->join('tbl_mode', "tbl_mode.id = $this->TBL.mode_id", 'left');

		$query = $this->db->get($this->TBL);
		
		return $query->row();
	} 

	public function delete($id){
		return	$this->db->delete($this->TBL, array('id' => $id));
	}

    public function exist($id)
    {
		$this->db->select('COUNT(*) AS CNT');
		$this->db->where('id',$id);
		$query=$this->db->get($this->TBL);

		if ($query->num_rows() > 0){
			if($query->row()->CNT>0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

    // public function getList($isActive=false){
	// 	$this->db->order_by('created_at','DESC');
	// 	if ($isActive) {
	// 		$this->db->where('isActive',1);
	// 	}
	// 	$query = $this->db->get($this->TBL);
	// 	$rs=array();
	// 	foreach ($query->result_array() as $row){
	// 		array_push($rs, $row);
	// 	}
	// 	return $rs;
	// }

    public function getList($company_id)
    {
        
		$this->db->where('created_by_company_id', $company_id);
		$this->db->where('deleted_at IS NULL');
		
		$this->db->order_by('created_at','DESC');
		
		$query = $this->db->get($this->TBL);
                
		return $query->result();
	}
    public function checkFormExist($request_id)
    {
        
		$this->db->where('request_id', $request_id);
		$this->db->where('deleted_at IS NULL');
		
		$this->db->limit(1);
		$query = $this->db->get($this->TBL);
               
		return count($query->result());
	}

}
?>

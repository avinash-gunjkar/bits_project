<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sectorwisedocument_model extends CI_Model{

	private $TBL='tbl_sector_wise_documents';

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

	public function getRecord($id){
		$this->db->where('id', $id);
		$query = $this->db->get($this->TBL);
		$row=array();
		if ($query->num_rows() > 0){
			$row = $query->row_array();
		}
		return $row;
	} 

	public function delete($id){
		return	$this->db->delete($this->TBL, array('id' => $id));
	}

	public function deleteAllRecBySectorId($sector_id){
		return	$this->db->delete($this->TBL, array('sector_id' => $sector_id));
	}

	public function exist($id){
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

	public function isSectorIdExist($sector_id){
		$this->db->select('COUNT(*) AS CNT');
		$this->db->where('sector_id',$sector_id);
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

    public function getList($isActive=false){
		$this->db->order_by('created_at','DESC');
		if ($isActive) {
			$this->db->where('isActive',1);
		}
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $rs;
	}

	public function getSelectedIdList($isActive=false){
		$this->db->order_by('created_at','DESC');
		if ($isActive) {
			$this->db->where('isActive',1);
		}
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $rs;
	}


	public function getListBetween($unix_start_date,$unix_end_date){
		$this->db->where('created_at =',$unix_start_date);
		$this->db->where('created_at <',$unix_end_date);
		$this->db->order_by('created_at','DESC');
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $rs;
	}	

    public function getSelectedIdListDetails($sector_id){
    	$this->db->select('document_id as value,name');
    	$this->db->join('tbl_document','tbl_document.id = tbl_sector_wise_documents.document_id','left');
    	$this->db->where('sector_id',$sector_id);	
		$query = $this->db->get($this->TBL);
		 // echo $query;die;
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $rs;
	}


}
?>

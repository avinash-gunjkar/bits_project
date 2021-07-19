<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sector_model extends CI_Model{

	private $TBL='tbl_sector';

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

  	public function getList($isActive=false){
		$this->db->order_by('(name = "Other" )', 'DESC');
		$this->db->order_by('name','ASC');
		if ($isActive) {
			$this->db->where('isActive',1);
		}
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
//                print_r($this->db->last_query());die;
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
	
	public function getTitles($ids=array()){

		$rs=array();
		if(!empty($ids)){
			$this->db->where_in('id',$ids);
			$this->db->order_by('name','asc');
			$query = $this->db->get($this->TBL);
			foreach ($query->result_array() as $row){
				array_push($rs, $row['name']);
			}
		}
		return $rs;
	}
 


}
?>

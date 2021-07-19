<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Particular_model extends CI_Model{

	private $TBL='tbl_export_comparative_template';

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


  	public function getParticularsFromRFCCategory($rfc_cat){
  		$this->db->select('tmpl.id, tmpl.particular, tmpl.container_id, cont.type, tmpl.rfc_category_id');
		// $this->db->order_by('created_at','DESC');
		// $this->db->from('tbl_export_comparative_template as tmpl');
		$this->db->join('tbl_container as cont','cont.id = tmpl.container_id', 'LEFT');
		$this->db->where('rfc_category_id',$rfc_cat);
		$query = $this->db->get('tbl_export_comparative_template as tmpl');
		//echo $query;die;

		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $query->result_array();
	}
	
	public function getFreightList(){
		
		$this->db->select('particular, amount, no_of_container, comp_unit, ect.isActive as active, ect.id as ect_id, comp.name as company_name, cont.type as container_name, rfc_category_id');
		$this->db->from('tbl_export_comparative_template as ect');
		$this->db->join('tbl_company as comp','comp.id = ect.company_id', 'LEFT');
		$this->db->join('tbl_container as cont','cont.id = ect.container_id', 'LEFT');
		$query = $this->db->get();
			
		return  $query->result();
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
 


}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_bank extends CI_Model{

	private $TBL='tbl_company_banks';

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

	public function getRecord($id,$company_id){
		$this->db->where('id', $id);
		$this->db->where('company_id', $company_id);
		$query = $this->db->get($this->TBL);
		$row=array();
		if ($query->num_rows() > 0){
			$row = $query->row();
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

    public function getList($company_id){
        
		$this->db->where('company_id', $company_id);
		// $this->db->where('type', $type);
		$this->db->order_by('created_at','DESC');
		
		$query = $this->db->get($this->TBL);
                
		return $query->result();
	}

	public function getActiveBankDetails($company_id){
		$this->db->where('company_id', $company_id);
		$this->db->where('status', '1');
		$query = $this->db->get($this->TBL);
		return $query->row();
	}

}
?>

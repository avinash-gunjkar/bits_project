<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annual_contract_mapp_ff_model extends CI_Model{

	private $TBL='tbl_annual_contract_mapp_ff';

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
    
    

	public function update($annual_contract_id,$ff_company_id,$data){
		$this->db->where('annual_contract_id', $annual_contract_id);
		$this->db->where('ff_company_id', $ff_company_id);
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

	public function delete($id='',$annualContractId='',$keepRouteIds=[]){
		if(!empty($id)){
			return	$this->db->delete($this->TBL, array('id' => $id));
		}else{
			$this->db->where('annual_contract_id', $annualContractId);
			$this->db->where_not_in('id', $keepRouteIds);
			return	$this->db->delete($this->TBL);
		}
		
	}

	public function getList($annual_contract_id){
		$this->db->where('annual_contract_id', $annual_contract_id);
		$query = $this->db->get($this->TBL);
		return $query->result();
	}

	function getSelectedFfids($annual_contract_id)
	{
		$this->db->select("ff_company_id");
		$this->db->from($this->TBL);
		$this->db->where('annual_contract_id', $annual_contract_id);
		$query = $this->db->get();
		$ff_ids = array();

		$result = $query->result();
		$ff_ids = array_column($result, "ff_company_id");
		return $ff_ids;
	}

}
?>

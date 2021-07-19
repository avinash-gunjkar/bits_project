<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annual_contract_route_riders_model extends CI_Model{

	private $TBL='tbl_annual_contract_route_riders';

	function __construct(){
		parent::__construct();
                
	}

    public function insert($data){
		
		if($this->checkChargesExist($data)){
			//update
			$this->db->where('route_id', $data['route_id']);
			$this->db->where('other_charge_id', $data['other_charge_id']);
			$this->db->where('ff_company_id', $data['ff_company_id']);
			if($this->db->update($this->TBL, $data)){
				
				return true;
			}else{
				return false;
			}

		}else{
			//insert
			if($this->db->insert($this->TBL,$data)){
				return $this->db->insert_id();
			}else{
				return false;
			}
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

	public function delete($id='',$annualContractId='',$keepRouteIds=[]){
		if(!empty($id)){
			return	$this->db->delete($this->TBL, array('id' => $id));
		}else{
			$this->db->where('annual_contract_id', $annualContractId);
			$this->db->where_not_in('id', $keepRouteIds);
			return	$this->db->delete($this->TBL);
		}
		
	}

	public function getList($route_id,$ff_company_id){
		$this->db->select("*");
		$this->db->from($this->TBL);
	//	$this->db->join('tbl_annual_contract_route_rfc_charges', "tbl_annual_contract_route_rfc_charges.charges_label_id = tbl_rfc_pricing_labels.id AND tbl_annual_contract_route_rfc_charges.route_id=$route_id AND tbl_annual_contract_route_rfc_charges.ff_company_id='$ff_company_id'",'left');
		$this->db->where('route_id', $route_id);
		$this->db->where('ff_company_id', $ff_company_id);
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		return $query->result();
	}

	

	public function checkChargesExist($data){
		$this->db->where('route_id', $data['route_id']);
		$this->db->where('other_charge_id', $data['other_charge_id']);
		$this->db->where('ff_company_id', $data['ff_company_id']);
		$query = $this->db->get($this->TBL);
		return (bool)$query->num_rows();
	}

}
?>

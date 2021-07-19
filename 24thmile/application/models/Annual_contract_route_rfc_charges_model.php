<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annual_contract_route_rfc_charges_model extends CI_Model{

	private $TBL='tbl_annual_contract_route_rfc_charges';

	function __construct(){
		parent::__construct();
                
	}

    public function insert($data){
		
		if($this->checkChargesExist($data)){
			//update
			$this->db->where('route_id', $data['route_id']);
			$this->db->where('annual_contract_id', $data['annual_contract_id']);
			$this->db->where('ff_company_id', $data['ff_company_id']);
			$this->db->where('rfc_charges_id', $data['rfc_charges_id']);
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
		$this->db->select("tbl_annual_contract_route_rfc_charges.id,tbl_rfc_pricing_labels.category_id as charges_category_id,tbl_annual_contract_route_rfc_charges.charges,tbl_rfc_pricing_labels.id as charges_label_id");
		$this->db->from('tbl_rfc_pricing_labels');
		$this->db->join('tbl_annual_contract_route_rfc_charges', "tbl_annual_contract_route_rfc_charges.charges_label_id = tbl_rfc_pricing_labels.id AND tbl_annual_contract_route_rfc_charges.route_id=$route_id AND tbl_annual_contract_route_rfc_charges.ff_company_id='$ff_company_id'",'left');
		// $this->db->where('route_id', $route_id);
		// $this->db->where('ff_company_id', $ff_company_id);
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		return $query->result();
	}

	public function getTotalCharges($route_id,$category_id,$ff_company_id){
		$this->db->select("SUM(charges) as total");
		$this->db->from('tbl_annual_contract_route_rfc_charges');
		//$this->db->join('tbl_annual_contract_route_rfc_charges', "tbl_annual_contract_route_rfc_charges.charges_label_id = tbl_rfc_pricing_labels.id AND tbl_annual_contract_route_rfc_charges.route_id=$route_id AND tbl_annual_contract_route_rfc_charges.ff_company_id='$ff_company_id'",'left');
		$this->db->where('route_id', $route_id);
		$this->db->where('charges_category_id', $category_id);
		$this->db->where('ff_company_id', $ff_company_id);
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		$result = $query->row();
		return $result->total;
	}

	public function checkChargesExist($data){
		$this->db->where('route_id', $data['route_id']);
		$this->db->where('annual_contract_id', $data['annual_contract_id']);
		$this->db->where('ff_company_id', $data['ff_company_id']);
		$this->db->where('rfc_charges_id', $data['rfc_charges_id']);
		$query = $this->db->get($this->TBL);
		return (bool)$query->num_rows();
	}

	public function checkOtherChargesExist($rfc_category_id,$route_id,$ff_company_id){

		$this->db->where('route_id', $route_id);
		$this->db->where('rfc_category_id', $rfc_category_id);
		$this->db->where('ff_company_id', $ff_company_id);
		$query = $this->db->get('tbl_annual_contract_route_rfc_other_charges');
		return (bool)$query->num_rows();
	}

	public function updateRfcOtherCharges($rfc_category_id,$route_id, $ff_company_id, $charges)
	{

		if ($this->checkOtherChargesExist($rfc_category_id,$route_id, $ff_company_id)) {
			//update
			$this->db->where('route_id', $route_id);
			$this->db->where('rfc_category_id', $rfc_category_id);
			$this->db->where('ff_company_id', $ff_company_id);
			if ($this->db->update('tbl_annual_contract_route_rfc_other_charges', ['charges'=>$charges])) {
				return true;
			} else {
				return false;
			}

		} else {
			//insert
			if ($this->db->insert('tbl_annual_contract_route_rfc_other_charges',['rfc_category_id'=>$rfc_category_id,'route_id'=>$route_id,'ff_company_id'=>$ff_company_id,'charges'=>$charges])) {
				return $this->db->insert_id();
			} else {
				return false;
			}
		}
	}

	public function getRfcOtherCharges($rfc_category_id,$route_id, $ff_company_id)
	{
		$this->db->select("charges,counter_offer");
		$this->db->from('tbl_annual_contract_route_rfc_other_charges');
		$this->db->where('route_id', $route_id);
		$this->db->where('rfc_category_id', $rfc_category_id);
		$this->db->where('ff_company_id', $ff_company_id);
		$query = $this->db->get();
		$resultTemp = $query->row();
		return $resultTemp;
	}

	public function updateCounterOffer($charges){
		$this->db->where('route_id', $charges['route_id']);
		$this->db->where('rfc_charges_id', $charges['rfc_charges_id']);
		$this->db->where('ff_company_id', $charges['ff_company_id']);
		if ($this->db->update($this->TBL, ['counter_offer'=>$charges['counter_offer']])) {
			return true;
		} else {
			return false;
		}
	}

	public function updateOtherCounterOffer($category_id,$route_id, $ff_company_id, $counter_offer){
		$this->db->where('route_id', $route_id);
		$this->db->where('rfc_category_id', $category_id);
		$this->db->where('ff_company_id', $ff_company_id);
		if ($this->db->update('tbl_annual_contract_route_rfc_other_charges', ['counter_offer'=>$counter_offer])) {
			return true;
		} else {
			return false;
		}
	}


}
?>

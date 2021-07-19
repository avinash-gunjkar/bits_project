<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Annual_contract_route_model extends CI_Model
{

	private $TBL = 'tbl_annual_contract_routes';

	function __construct()
	{
		parent::__construct();
		$this->load->model('freight_model');
	}

	public function insert($data)
	{
		if ($this->db->insert($this->TBL, $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}



	public function update($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update($this->TBL, $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function getRecord($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->TBL);
		$row = array();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
		}
		return $row;
	}

	public function delete($id = '', $annualContractId = '', $keepRouteIds = [])
	{
		if (!empty($id)) {
			return	$this->db->delete($this->TBL, array('id' => $id));
		} else {
			$this->db->where('annual_contract_id', $annualContractId);
			$this->db->where_not_in('id', $keepRouteIds);
			return	$this->db->delete($this->TBL);
		}
	}

	public function getList($annual_contract_id, $ff_company_id = '', $mode_id = '',$filter=[])
	{
		$this->load->model('annual_contract_route_rfc_charges_model');
		$this->db->select("$this->TBL.*,tbl_shipment.type as shipment,tbl_mode.type as mode");
		$this->db->from($this->TBL);
		$this->db->join('tbl_shipment', "tbl_shipment.id = $this->TBL.shipment_id", 'left');
		$this->db->join('tbl_mode', "tbl_mode.id = $this->TBL.mode_id", 'left');
		$this->db->where('annual_contract_id', $annual_contract_id);
		
		if (!empty($mode_id)) {
			$this->db->where("$this->TBL.mode_id", $mode_id);
		}
		if (isset($filter['transaction'])) {
			$this->db->where("$this->TBL.transaction", $filter['transaction']);
		}
		if (isset($filter['shipment'])) {
			$this->db->where("$this->TBL.shipment_id", $filter['shipment']);
		}


		$query = $this->db->get();
		$resultTemp = $query->result();
		$result = [];
		foreach ($resultTemp as $row) {
			$row->charges = $this->freight_model->getAnnualCotntractRfcChargesCategory($row->id, $ff_company_id, $row->mode_id);
			$row->ridersLables = $this->freight_model->getAnnualContractRiders($row->id, $ff_company_id, $row->mode_id);
			$row->counter_rate = $this->getCounterRate($row->id, $ff_company_id);
			$result[] = $row;
		}
		return $result;
	}
	public function getComparativeList($annual_contract_id, $mode_id,$filter=[])
	{
		$this->load->model('annual_contract_route_rfc_charges_model');
		$this->db->select("$this->TBL.*,tbl_annual_contract_mapp_ff.ff_company_id,tbl_company.name as ff_company_name,tbl_shipment.type as shipment,tbl_mode.type as mode");
		$this->db->from('tbl_annual_contract_mapp_ff');
		$this->db->join('tbl_annual_contract_routes', ' tbl_annual_contract_routes.annual_contract_id = tbl_annual_contract_mapp_ff.annual_contract_id');
		$this->db->join('tbl_company', ' tbl_annual_contract_mapp_ff.ff_company_id = tbl_company.id');
		$this->db->join('tbl_shipment', "tbl_shipment.id = $this->TBL.shipment_id", 'left');
		$this->db->join('tbl_mode', "tbl_mode.id = $this->TBL.mode_id", 'left');
		$this->db->where("$this->TBL.annual_contract_id", $annual_contract_id);
		$this->db->where("$this->TBL.mode_id", $mode_id);

		if(isset($filter['shipment_id'])){
			$this->db->where("$this->TBL.shipment_id", $filter['shipment_id']);
		}
		if(isset($filter['transaction'])){
			$this->db->where("$this->TBL.transaction", $filter['transaction']);
		}
		if(isset($filter['sp'])){
			$this->db->where("tbl_annual_contract_mapp_ff.ff_company_id", $filter['sp']);
		}
		if(isset($filter['container_stuffing'])){
			$this->db->where("$this->TBL.container_stuffing", $filter['container_stuffing']);
		}
		if(isset($filter['cargo_status'])){
			$this->db->where("$this->TBL.cargo_status", $filter['cargo_status']);
		}

		$this->db->order_by('tbl_annual_contract_routes.id');
		$query = $this->db->get();
		$resultTemp = $query->result();
		$result = [];
		foreach ($resultTemp as $row) {
			$row->charges = $this->freight_model->getAnnualCotntractRfcChargesCategory($row->id, $row->ff_company_id, $row->mode_id);
			$row->ridersLables = $this->freight_model->getAnnualContractRiders($row->id, $row->ff_company_id, $row->mode_id);
			$row->counter_rate = $this->getCounterRate($row->id, $row->ff_company_id);
			$result[] = $row;
		}
		// vdebug($result);
		return $result;
	}


	public function updateCounterRate($route_id, $ff_company_id, $counter_rate)
	{

		if ($this->checkCounterRateExist($route_id, $ff_company_id)) {
			//update
			$this->db->where('route_id', $route_id);
			$this->db->where('ff_company_id', $ff_company_id);
			if ($this->db->update('tbl_annual_contract_route_mapp_counter_rates', ['counter_rate'=>$counter_rate,'updated_at'=>date('Y-m-d H:i:s')])) {
				return true;
			} else {
				return false;
			}

		} else {
			//insert
			if ($this->db->insert('tbl_annual_contract_route_mapp_counter_rates',['route_id'=>$route_id,'ff_company_id'=>$ff_company_id,'counter_rate'=>$counter_rate])) {
				return $this->db->insert_id();
			} else {
				return false;
			}
		}
	}

	public function getCounterRate($route_id, $ff_company_id)
	{
		$this->db->select("counter_rate");
		$this->db->from('tbl_annual_contract_route_mapp_counter_rates');
		$this->db->where('route_id', $route_id);
		$this->db->where('ff_company_id', $ff_company_id);

		$query = $this->db->get();
		$resultTemp = $query->row();
		return $resultTemp->counter_rate;
	}

	public function checkCounterRateExist($route_id, $ff_company_id)
	{
		$this->db->select("counter_rate");
		$this->db->from('tbl_annual_contract_route_mapp_counter_rates');
		$this->db->where('route_id', $route_id);
		$this->db->where('ff_company_id', $ff_company_id);

		$query = $this->db->get();
		return $query->row();
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_dashboard extends CI_Model
{


	function __construct()
	{
		parent::__construct();
	}

	public function getNumberOfRequests()
	{
		$this->db->select('COUNT(t1.id) as request_count, 
						COUNT(IF(t1.shipment_id="2",1, NULL)) as lcl_count,
						COUNT(IF(t1.shipment_id="2" AND t1.status IN(1,2,3,4,7,8),1, NULL)) as lcl_inquiry_count,
						COUNT(IF(t1.shipment_id="2" AND t1.status IN(5,6),1, NULL)) as lcl_booking_count,
						COUNT(IF(t1.shipment_id="1",1, NULL)) as fcl_count,
						COUNT(IF(t1.shipment_id="1" AND t1.status IN(1,2,3,4,7,8),1, NULL)) as fcl_inquiry_count,
						COUNT(IF(t1.shipment_id="1" AND t1.status IN(5,6),1, NULL)) as fcl_booking_count,
						COUNT(IF(t1.mode_id="3",1, NULL)) as sea_count,
						COUNT(IF(t1.mode_id="3" AND t1.status IN(1,2,3,4,7,8),1, NULL)) as sea_inquiry_count,
						COUNT(IF(t1.mode_id="3" AND t1.status IN(5,6),1, NULL)) as sea_booking_count,
						COUNT(IF(t1.mode_id="2",1, NULL)) as air_count,
						COUNT(IF(t1.mode_id="2" AND t1.status IN(1,2,3,4,7,8),1, NULL)) as air_inquiry_count,
						COUNT(IF(t1.mode_id="2" AND t1.status IN(5,6),1, NULL)) as air_booking_count,
						COUNT(IF(t1.mode_id="1" AND t1.status IN(1,2,3,4,7,8),1, NULL)) as road_inquiry_count,
						COUNT(IF(t1.mode_id="1" AND t1.status IN(5,6),1, NULL)) as road_booking_count,
						COUNT(IF(t1.mode_id="1",1, NULL)) as road_count');
		$this->db->from('tbl_seller_requirement as t1');
		// $this->db->where('t1.selected_ff_company_id', $company_id);
		$query = $this->db->get();
		
		return $query->row();
	}
	public function getUserCounts()
	{
		$this->db->select('COUNT(t1.id) as total_user_count, COUNT(IF(t1.role="2" AND t1.company_role="super_user",1, NULL)) as fs_count,COUNT(IF(t1.role="3" AND t1.company_role="super_user",1, NULL)) as ff_count');
		$this->db->from('tbl_users as t1');
		$this->db->where('company_id IS NOT NULL');
		$query = $this->db->get();
		return $query->row();
	}


	public function getNewInquireCount()
	{
		$this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
		$this->db->from('tbl_seller_requirement as t1');
		$this->db->join('tbl_seller_requirement_mapp_ff as t2', ' t1.id = t2.request_id');
		// $this->db->where('t2.ff_company_id', $company_id);
		$this->db->where('t1.status', '2');
		$query = $this->db->get();
		return $query->row();
	}
	public function getShipmentInProcessCount()
	{
		$this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
		$this->db->from('tbl_seller_requirement as t1');
		// $this->db->where('t1.selected_ff_company_id', $company_id);
		$this->db->where_in('t1.status', ['4', '5']);
		$query = $this->db->get();
		return $query->row();
	}
	public function getCompletedShipmentCount()
	{
		$this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
		$this->db->from('tbl_seller_requirement as t1');
		// $this->db->where('t1.selected_ff_company_id', $company_id);
		$this->db->where_in('t1.status', ['6']);
		$query = $this->db->get();
		return $query->row();
	}
	public function getCompletedShipmentPaymentPendingCount()
	{
		$this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
		$this->db->from('tbl_seller_requirement as t1');
		$this->db->where('t1.bill_amount_received', '1');
		$this->db->where_in('t1.status', ['6']);
		$query = $this->db->get();
		return $query->row();
	}
}

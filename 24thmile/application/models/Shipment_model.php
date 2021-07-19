<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment_model extends CI_Model{

	private $TBL='tbl_shipment';

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
	
	public function insertRaiseInvoice($data){
		if($this->db->insert('tbl_raised_invoice',$data)){
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
 
	public function getBookedShipmentList($book_id=""){
		
		if($book_id != ""){
			$this->db->select('tbl_booked_shipments.*,tbl_booked_shipments.id as booked_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*,tbl_users.*, tb.firstname as bfname, tb.lastname as blname, tb.email as bemail, tb.phone as bphone, ts.firstname as ffname, ts.lastname as flname, ts.email as femail, ts.phone as fphone');
			$this->db->from('tbl_booked_shipments');
			$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_booked_shipments.deliver_term_id','left');
			$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_booked_shipments.shipment_id','left');
			$this->db->join('tbl_mode', 'tbl_mode.id = tbl_booked_shipments.mode_id','left');
			$this->db->join('tbl_users as ts', 'ts.id = tbl_booked_shipments.ff_id','left');
			$this->db->join('tbl_users as tb', 'tb.id = tbl_booked_shipments.buyer_id','left');
			$this->db->join('tbl_users', 'tbl_users.id = tbl_booked_shipments.user_id','left');
			$this->db->where('tbl_booked_shipments.id', $book_id);
			$query = $this->db->get();
			return $query->row();
		}
		
		$this->db->select('tbl_booked_shipments.*,tbl_booked_shipments.id as booked_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*,tbl_users.*, tb.firstname as bfname, tb.lastname as blname, tb.email as bemail, tb.phone as bphone, ts.firstname as ffname, ts.lastname as flname, ts.email as femail, ts.phone as fphone');
		$this->db->from('tbl_booked_shipments');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_booked_shipments.deliver_term_id','left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_booked_shipments.shipment_id','left');
		$this->db->join('tbl_mode', 'tbl_mode.id = tbl_booked_shipments.mode_id','left');
		$this->db->join('tbl_users as ts', 'ts.id = tbl_booked_shipments.ff_id','left');
		$this->db->join('tbl_users as tb', 'tb.id = tbl_booked_shipments.buyer_id','left');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_booked_shipments.user_id','left');
		$query = $this->db->get();
		return $query->result();
	}

	public function getBookedShipmentInvoice($book_id="", $invoice_id=""){
		
		if($invoice_id != "" && $book_id != ""){
			$this->db->select('tbl_raised_invoice.*');
			$this->db->from('tbl_raised_invoice');
			$this->db->where('tbl_raised_invoice.book_id', $book_id);
			$this->db->where('tbl_raised_invoice.id', $invoice_id);
			$query = $this->db->get();
			return $query->row();
		}
	}
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model{

	private $TBL='tbl_booked_shipments';

	function __construct(){
		parent::__construct();
	}	
 
	public function getBookedReportsList($book_id=""){
		
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
	
//	public function getMyBookedReportsList($book_id="",$user_id){
//		
//		if($book_id != ""){
//			$this->db->select('tbl_booked_shipments.*,tbl_booked_shipments.id as booked_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*,tbl_users.*, tb.firstname as bfname, tb.lastname as blname, tb.email as bemail, tb.phone as bphone, ts.firstname as ffname, ts.lastname as flname, ts.email as femail, ts.phone as fphone');
//			$this->db->from('tbl_booked_shipments');
//			$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_booked_shipments.deliver_term_id','left');
//			$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_booked_shipments.shipment_id','left');
//			$this->db->join('tbl_mode', 'tbl_mode.id = tbl_booked_shipments.mode_id','left');
//			$this->db->join('tbl_users as ts', 'ts.id = tbl_booked_shipments.ff_id','left');
//			$this->db->join('tbl_users as tb', 'tb.id = tbl_booked_shipments.buyer_id','left');
//			$this->db->join('tbl_users', 'tbl_users.id = tbl_booked_shipments.user_id','left');
//			$this->db->where('tbl_booked_shipments.id', $book_id);
//			$this->db->where('tbl_booked_shipments.ff_id', $user_id);
//			$query = $this->db->get();
//			return $query->row();
//		}
//		
//		$this->db->select('tbl_booked_shipments.*,tbl_booked_shipments.id as booked_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*,tbl_users.*, tb.firstname as bfname, tb.lastname as blname, tb.email as bemail, tb.phone as bphone, ts.firstname as ffname, ts.lastname as flname, ts.email as femail, ts.phone as fphone');
//		$this->db->from('tbl_booked_shipments');
//		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_booked_shipments.deliver_term_id','left');
//		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_booked_shipments.shipment_id','left');
//		$this->db->join('tbl_mode', 'tbl_mode.id = tbl_booked_shipments.mode_id','left');
//		$this->db->join('tbl_users as ts', 'ts.id = tbl_booked_shipments.ff_id','left');
//		$this->db->join('tbl_users as tb', 'tb.id = tbl_booked_shipments.buyer_id','left');
//		$this->db->join('tbl_users', 'tbl_users.id = tbl_booked_shipments.user_id','left');
//		$this->db->where('tbl_booked_shipments.ff_id', $user_id);
//		$query = $this->db->get();
//		return $query->result();
//	}
	public function getMyBookedReportsList($request_id="",$user_id){
		
		if($book_id != ""){
			$this->db->select('t1.*,t1.id as request_id,t2.*type as mode,t3.type as shipment, t5.firstname as ffname, t5.lastname as flname, t5.email as femail, t5.phone as fphone,t6.firstname as sfname, t6.lastname as slname, t6.email as semail, t6.phone as sphone');
			$this->db->from('tbl_seller_requirement AS t1');
			$this->db->join('tbl_deliver_term as t2', 't2.id = t1.deliver_term_id','left');
			$this->db->join('tbl_shipment t3', 't3.id = t1.shipment_id','left');
			$this->db->join('tbl_mode t4', 't4.id = t1.mode_id','left');
			$this->db->join('tbl_users as t5', 'ts.id = t1.selected_ff_id','left');
//			$this->db->join('tbl_users as tb', 'tb.id = tbl_booked_shipments.buyer_id','left');
			$this->db->join('tbl_users t6', 'tbl_users.id = t1.user_id','left');
			$this->db->where('t1.id', $request_id);
			$this->db->where('t1.ff_id', $user_id);
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
		$this->db->where('tbl_booked_shipments.ff_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	public function getBookedReportsByFilter($fromdate,$todate,$ff_id){
		
		
			$this->db->select('tbl_booked_shipments.*,tbl_booked_shipments.id as booked_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*,tbl_users.*, tb.firstname as bfname, tb.lastname as blname, tb.email as bemail, tb.phone as bphone, ts.firstname as ffname, ts.lastname as flname, ts.email as femail, ts.phone as fphone');
			$this->db->from('tbl_booked_shipments');
			$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_booked_shipments.deliver_term_id','left');
			$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_booked_shipments.shipment_id','left');
			$this->db->join('tbl_mode', 'tbl_mode.id = tbl_booked_shipments.mode_id','left');
			$this->db->join('tbl_users as ts', 'ts.id = tbl_booked_shipments.ff_id','left');
			$this->db->join('tbl_users as tb', 'tb.id = tbl_booked_shipments.buyer_id','left');
			$this->db->join('tbl_users', 'tbl_users.id = tbl_booked_shipments.user_id','left');
			
			if($fromdate != ''){
				$this->db->where('DATE(tbl_booked_shipments.created_at) >= ', $fromdate);
			}
			
			if($ff_id != ''){
				$this->db->where('tbl_booked_shipments.ff_id', $ff_id);
			}
			
			if($todate != ''){
				$this->db->where('DATE(tbl_booked_shipments.created_at) <= ', $todate);
			}
			
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
	
	public function getFFList(){
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where('role',3);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getValuesBookedShipments($fromdate="",$todate="",$ff_id=""){
			
		$this->db->select('SUM(shipment_value) as tot_ship_value, SUM(Invoice_amount) as tot_inv_amount, SUM(MEIS_amount) as tot_meis_amount');
		$this->db->from('tbl_booked_shipments');
		if($fromdate != ''){
			$this->db->where('DATE(tbl_booked_shipments.created_at) >= ', $fromdate);
		}
		
		if($ff_id != ''){
			$this->db->where('tbl_booked_shipments.ff_id', $ff_id);
		}
		
		if($todate != ''){
			$this->db->where('DATE(tbl_booked_shipments.created_at) <= ', $todate);
		}
		
		$query = $this->db->get();
		return $query->row();
	}
}
?>

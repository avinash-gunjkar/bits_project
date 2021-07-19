<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seller_model extends CI_Model
{

	function __construct()
	{

		parent::__construct();

		$this->load->database();
		$this->load->library('email');
	}

	function getSellerInfo($user_id)
	{
		if ($user_id != '') {

			$this->db->select("*,tbl_users.id as userId");
			$this->db->from("tbl_users");
			$this->db->join('tbl_users_profile', 'tbl_users_profile.user_id = tbl_users.id', 'left');
			$this->db->join('tbl_department_head', 'tbl_department_head.user_id = tbl_users.id', 'left');
			$this->db->where('tbl_users.id', $user_id);
			$query = $this->db->get();
			return $query->row();
		}

		$this->db->select("*");
		$this->db->from("tbl_users");
		$this->db->join('tbl_users_profile', 'tbl_users_profile.user_id = tbl_users.id', 'left');
		$this->db->join('tbl_department_head', 'tbl_department_head.user_id = tbl_users.id', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	function getLogedinUserDetails($user_id)
	{
		if ($user_id != '') {

			$this->db->select("*,tbl_users.id as userId");
			$this->db->from("tbl_users");
			$this->db->join('tbl_users_profile', 'tbl_users_profile.user_id = tbl_users.id', 'left');
			$this->db->join('tbl_department_head', 'tbl_department_head.user_id = tbl_users.id', 'left');
			$this->db->where('tbl_users.id', $user_id);
			$query = $this->db->get();
			return $query->row();
		}
		return null;
	}

	function getSellerProfile($user_id)
	{
		$this->db->select("t2.*,t1.*");
		$this->db->from("tbl_users as t1");
		$this->db->join("tbl_users_profile as t2", 't1.id=t2.user_id', 'left');
		$this->db->where('t1.id', $user_id);
		$query = $this->db->get();
		$user_details = $query->row();
		$user_details->company_details = $this->getCompanyProfile($user_details->company_id);
		return $user_details;
	}
	function getSellerDetails($user_id)
	{
		$this->db->select("*");
		$this->db->from("tbl_users");
		$this->db->where('id', $user_id);
		$query = $this->db->get();
		$user_details = $query->row();

		$user_details->company_details = $this->getCompanyProfile($user_details->company_id);
		return $user_details;
	}

	function getCompanyProfile($company_id)
	{
		$this->db->select("*");
		$this->db->from("tbl_company");
		$this->db->where('id', $company_id);
		$query = $this->db->get();
		return $query->row();
	}

	function  getFS_DetailsByCompanyId($company_id)
	{
		$this->db->select("T1.name,T1.address_line_1,T1.address_line_2,T1.city_name,T1.transaction_currency,T1.head_salutation,T1.head_firstname,T1.head_lastname,T1.head_email,T2.id as user_id,T2.company_id,T2.salutation,T2.firstname,T2.lastname,T2.email,T2.country_code,T2.phone");
		$this->db->from("tbl_company AS T1");
		$this->db->join("tbl_users as T2", 'T1.id = T2.company_id', 'left');
		$this->db->where('T1.id', $company_id);
		$this->db->where('T2.role', '2');
		$query = $this->db->get();
		return $query->row();
	}
	function  getFF_DetailsByCompanyId($company_id)
	{
		$this->db->select("T1.name,T1.address_line_1,T1.address_line_2,T1.city_name,T1.transaction_currency,T1.head_salutation,T1.head_firstname,T1.head_lastname,T1.head_email,T2.id as user_id,T2.company_id,T2.salutation,T2.firstname,T2.lastname,T2.email,T2.country_code,T2.phone");
		$this->db->from("tbl_company AS T1");
		$this->db->join("tbl_users as T2", 'T1.id = T2.company_id', 'left');
		$this->db->where('T1.id', $company_id);
		$this->db->where('T2.role', '3');
		$query = $this->db->get();

		return $query->row();
	}

	function documentVerified($user_id)
	{
		$this->db->select("*");
		$this->db->from("tbl_users_kyc_document");
		$this->db->where('user_id', $user_id);
		$this->db->where('is_verified', 1);
		$query = $this->db->get();
		return $query->result();
	}

	function getHeadProfile($user_id)
	{
		$this->db->select("*");
		$this->db->from("tbl_department_head");
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->row();
	}

	function getUserKYC($company_id, $type = '')
	{

		$this->db->select("*");
		$this->db->from("tbl_company_mapp_documents");
		$this->db->where('company_id', $company_id);
		$this->db->where('type', $type);

		$query = $this->db->get();

		return array_pop($query->result());
	}


	function getDesignationData()
	{
		$this->db->select("*");
		$this->db->from("tbl_designation");
		$query = $this->db->get();
		return $query->result();
	}

	function getCompanyData()
	{
		$this->db->select("*");
		$this->db->from("tbl_company");
		$query = $this->db->get();
		return $query->result();
	}

	public function getCompanyIndustryTypes($company_id)
	{
		$this->db->where('company_id', $company_id);
		$query = $this->db->get('tbl_company_mapp_industry_type');
		$rs = array();
		foreach ($query->result_array() as $row) {
			array_push($rs, $row['industry_type_id']);
		}
		return $rs;
	}
	public function getCompanySectors($company_id)
	{
		$this->db->where('company_id', $company_id);
		$query = $this->db->get('tbl_company_mapp_industry_sector');
		$rs = array();
		foreach ($query->result_array() as $row) {
			array_push($rs, $row['sector_id']);
		}
		return $rs;
	}

	function insertUserInfo($data)
	{
		$this->db->insert('tbl_users_profile', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function insertUserHead($data)
	{
		$this->db->insert('tbl_department_head', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function insertBookShipment($data)
	{
		$this->db->insert('tbl_booked_shipments', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}


	function insertUserKYC($data)
	{
		//delete old record
		$this->db->delete('tbl_company_mapp_documents', array('type' => $data['type'], 'company_id' => $data['company_id']));

		$this->db->insert('tbl_company_mapp_documents', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function insertNoAttempt($data)
	{
		$this->db->insert('tbl_counter_offer_per_user', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}




	function insertQuatation($data)
	{
		$this->db->insert('tbl_freight_quotation', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function insertStepProcessData($data)
	{
		$this->db->insert('tbl_shipment_process', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function insertCounterQuatation($data)
	{
		$this->db->insert('tbl_freight_counter_offer', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function updateUser($data, $user_id)
	{
		$this->db->where('id', $user_id);

		$this->db->update('tbl_users', $data);

		return true;
	}

	function updateBookShipment($data, $request_id)
	{
		$this->db->where('id', $request_id);

		$this->db->update('tbl_seller_requirement', $data);

		return true;
	}


	function updateUserInfo($data, $user_id)
	{
		$this->db->where('user_id', $user_id);

		$this->db->update('tbl_users_profile', $data);

		return true;
	}

	function updateUserHead($data, $user_id)
	{
		$this->db->where('user_id', $user_id);

		$this->db->update('tbl_department_head', $data);

		return true;
	}

	function updateNoAttempt($sender_user_id, $freight_enquiry_id, $receiver_user_id, $data)
	{
		$this->db->where('sender_user_id', $sender_user_id);
		$this->db->where('freight_enquiry_id', $freight_enquiry_id);
		$this->db->where('receiver_user_id', $receiver_user_id);
		$this->db->update('tbl_counter_offer_per_user', $data);

		return true;
	}

	function updateStepProcessData($data, $request_id, $step_id)
	{
		$this->db->where('request_id', $request_id);

		$this->db->where('step_id', $step_id);

		$this->db->update('tbl_shipment_process', $data);

		return true;
	}

	function sendUserEmail($fname, $to_email)
	{
		$subject = 'Verify Your Email Address';
		$message = 'Dear ' . $fname . ',<br/><br/> Please click on the below activation link to verify your email address.<br/><br/> ' . base_url('login/verify/' . md5($to_email)) . ' <br/><br/><br/>  Thanks <br/> Infinite 1 Team';

		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'noreply@talentedgenext.com';
		$config['smtp_pass']    = 'Mohammed@1292';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html';

		$this->email->initialize($config);

		$this->email->from('noreply@talentedgenext.com', 'LMS');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
		return true;
	}


	function verifyEmailID($key)
	{
		$data = array('isActive' => 1);
		$this->db->where('sha1(email)', $key);
		return $this->db->update('tbl_users', $data);
	}

	function get_User($email)
	{

		$query = $this->db->query("select * from tbl_users where email = '" . $email . "'");

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

	function getStateByCountry($cName)
	{

		$query = $this->db->get_where('tbl_country_state', array('country_name' => $cName));

		return  $query->result();
	}

	function getCityByState($sName)
	{

		$query = $this->db->get_where('tbl_state_city', array('state' => $sName));

		return  $query->result();
	}


	function getSectorWiseDoc($sector_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_sector_wise_documents');
		$this->db->join('tbl_document', 'tbl_document.id = tbl_sector_wise_documents.document_id', 'left');
		$this->db->where('tbl_sector_wise_documents.sector_id', $sector_id);
		$query = $this->db->get();
		return $query->result();
	}


	function getCountries()
	{
		return array();
		//		$this->db->select('*');
		//		$this->db->group_by('country_name');
		//		$this->db->from("tbl_country_state");
		//		$query = $this->db->get();
		//		return $query->result();

	}

	function getFreightEnquiry($user_id)
	{
		$this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as fe_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*');
		$this->db->from('tbl_seller_requirement');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.deliver_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
		$this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'left');
		$this->db->where('tbl_seller_requirement.user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}



	function getFreightEnquiryByRFCId($rfc_id)
	{
		$this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as fe_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*');
		$this->db->from('tbl_seller_requirement');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.deliver_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
		$this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'left');
		$this->db->where('tbl_seller_requirement.id', $rfc_id);
		$query = $this->db->get();
		return $query->row();
	}

	function getFreightEnquiryByCity($pincode, $city)
	{
		$this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as fe_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*,tbl_users.*');
		$this->db->from('tbl_seller_requirement');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.deliver_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
		$this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'left');
		$this->db->join('tbl_users', ' tbl_users.id = tbl_seller_requirement.user_id', 'left');
		$this->db->where('tbl_seller_requirement.pickup_pin', $pincode);
		$this->db->or_like('tbl_seller_requirement.pickup_city', $city);
		$this->db->or_like('tbl_seller_requirement.delivery_city', $city);

		$query = $this->db->get();
		return $query->result();
	}

	function getCountOffers($userId, $feId)
	{
		$this->db->select('*');
		$this->db->from('tbl_freight_counter_offer');
		$this->db->join('tbl_seller_requirement', 'tbl_seller_requirement.id = tbl_freight_counter_offer.freight_enquiry_id', 'left');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_seller_requirement.user_id', 'left');
		$this->db->where('tbl_freight_counter_offer.sender_user_id', $userId);
		$this->db->where('tbl_freight_counter_offer.freight_enquiry_id', $feId);
		$query = $this->db->get();
		return $query->result();
	}

	function getTemplateData($sector_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_freight_template');
		$this->db->join('tbl_rfc_category', 'tbl_rfc_category.id = tbl_freight_template.rfc_category_id', 'left');
		$this->db->join('tbl_export_comparative_template', 'tbl_export_comparative_template.id = tbl_freight_template.particular_id', 'left');
		$this->db->join('tbl_container', 'tbl_container.id = tbl_freight_template.container_id', 'left');
		$this->db->where('tbl_freight_template.sector_id', $sector_id);
		$query = $this->db->get();

		// echo $this->db->last_query();
		return $query->result();
	}

	function getFreightEnquiryQuotationData($freight_enquiry_id)
	{
		$this->db->select('tbl_freight_quotation.*,tbl_rfc_category.*,tbl_export_comparative_template.*,tbl_container.*,tbl_seller_requirement.*, tbl_users.*,tbl_freight_quotation.no_of_container as num_cnt');
		$this->db->from('tbl_freight_quotation');
		$this->db->join('tbl_rfc_category', 'tbl_rfc_category.id = tbl_freight_quotation.rfc_category_id', 'left');
		$this->db->join('tbl_export_comparative_template', 'tbl_export_comparative_template.id = tbl_freight_quotation.particular_id', 'left');
		$this->db->join('tbl_container', 'tbl_container.id = tbl_freight_quotation.container_id', 'left');
		$this->db->join('tbl_seller_requirement', 'tbl_seller_requirement.id = tbl_freight_quotation.freight_enquiry_id', 'left');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_freight_quotation.quote_sender_id', 'left');
		$this->db->where('tbl_freight_quotation.freight_enquiry_id', $freight_enquiry_id);
		$query = $this->db->get();
		return $query->result();
	}

	function getMyCounterOffers($freight_enquiry_id, $receiver_user_id)
	{
		$this->db->select('tbl_freight_counter_offer.*,tbl_rfc_category.*,tbl_export_comparative_template.*,tbl_container.*,tbl_seller_requirement.*, tbl_users.*,tbl_freight_counter_offer.no_of_container as num_cnt');
		$this->db->from('tbl_freight_counter_offer');
		$this->db->join('tbl_rfc_category', 'tbl_rfc_category.id = tbl_freight_counter_offer.rfc_category_id', 'left');
		$this->db->join('tbl_export_comparative_template', 'tbl_export_comparative_template.id = tbl_freight_counter_offer.particular_id', 'left');
		$this->db->join('tbl_container', 'tbl_container.id = tbl_freight_counter_offer.container_id', 'left');
		$this->db->join('tbl_seller_requirement', 'tbl_seller_requirement.id = tbl_freight_counter_offer.freight_enquiry_id', 'left');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_freight_counter_offer.sender_user_id', 'left');
		$this->db->where('tbl_freight_counter_offer.freight_enquiry_id', $freight_enquiry_id);
		$this->db->where('tbl_freight_counter_offer.receiver_user_id', $receiver_user_id);
		$query = $this->db->get();
		return $query->result();
	}

	function getCompInfo($comp_name)
	{
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where('company_name', $comp_name);
		$query = $this->db->get();
		return $query->row();
	}

	function getNoOfCounter($sender_user_id, $freight_enquiry_id, $receiver_user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_counter_offer_per_user');
		$this->db->where('sender_user_id', $sender_user_id);
		$this->db->where('freight_enquiry_id', $freight_enquiry_id);
		$this->db->where('receiver_user_id', $receiver_user_id);
		$query = $this->db->get();
		return $query->row();
	}

	function getNoAttemptOfCount($sender_user_id, $freight_enquiry_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_counter_offer_per_user');
		$this->db->where('sender_user_id', $sender_user_id);
		$this->db->where('freight_enquiry_id', $freight_enquiry_id);
		$query = $this->db->get();
		return $query->result();
	}

	function getBookedShipmentList($user_id)
	{
		$this->db->select('tbl_booked_shipments.*,tbl_booked_shipments.id as booked_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*,tbl_users.*');
		$this->db->from('tbl_booked_shipments');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_booked_shipments.deliver_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_booked_shipments.shipment_id', 'left');
		$this->db->join('tbl_mode', 'tbl_mode.id = tbl_booked_shipments.mode_id', 'left');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_booked_shipments.ff_id', 'left');
		$this->db->where('tbl_booked_shipments.user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	function getBookedShipmentListofFF($user_id)
	{
		$this->db->select('tbl_booked_shipments.*,tbl_booked_shipments.id as booked_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*,tbl_users.*');
		$this->db->from('tbl_booked_shipments');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_booked_shipments.deliver_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_booked_shipments.shipment_id', 'left');
		$this->db->join('tbl_mode', 'tbl_mode.id = tbl_booked_shipments.mode_id', 'left');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_booked_shipments.user_id', 'left');
		$this->db->where('tbl_booked_shipments.ff_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}


	function getBookedShipmentById($user_id, $transctn, $bookid)
	{
		$this->db->select('tbl_booked_shipments.*,tbl_booked_shipments.id as booked_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*,tbl_users.*, tb.firstname as bfname, tb.lastname as blname, tb.email as bemail, tb.phone as bphone, ts.firstname as ffname, ts.lastname as flname, ts.email as femail, ts.phone as fphone');
		$this->db->from('tbl_booked_shipments');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_booked_shipments.deliver_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_booked_shipments.shipment_id', 'left');
		$this->db->join('tbl_mode', 'tbl_mode.id = tbl_booked_shipments.mode_id', 'left');
		$this->db->join('tbl_users as ts', 'ts.id = tbl_booked_shipments.ff_id', 'left');
		$this->db->join('tbl_users as tb', 'tb.id = tbl_booked_shipments.buyer_id', 'left');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_booked_shipments.user_id', 'left');
		$this->db->where('tbl_booked_shipments.id', $bookid);
		$this->db->where('tbl_booked_shipments.user_id', $user_id);

		if ($transctn == 1) {
			$this->db->where('tbl_booked_shipments.transaction', 'Export');
		} else {
			$this->db->where('tbl_booked_shipments.transaction', 'Import');
		}

		$query = $this->db->get();
		return $query->row();
	}

	function getBookedShipmentByFFId($ff_id, $transctn, $bookid)
	{
		$this->db->select('tbl_booked_shipments.*,tbl_booked_shipments.id as booked_id,tbl_shipment.*,tbl_shipment.type as shipment,tbl_deliver_term.*,tbl_mode.*,tbl_users.*, tb.firstname as bfname, tb.lastname as blname, tb.email as bemail, tb.phone as bphone, ts.firstname as ffname, ts.lastname as flname, ts.email as femail, ts.phone as fphone');
		$this->db->from('tbl_booked_shipments');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_booked_shipments.deliver_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_booked_shipments.shipment_id', 'left');
		$this->db->join('tbl_mode', 'tbl_mode.id = tbl_booked_shipments.mode_id', 'left');
		$this->db->join('tbl_users as ts', 'ts.id = tbl_booked_shipments.ff_id', 'left');
		$this->db->join('tbl_users as tb', 'tb.id = tbl_booked_shipments.buyer_id', 'left');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_booked_shipments.user_id', 'left');
		$this->db->where('tbl_booked_shipments.id', $bookid);
		$this->db->where('tbl_booked_shipments.ff_id', $ff_id);

		if ($transctn == 1) {
			$this->db->where('tbl_booked_shipments.transaction', 'Export');
		} else {
			$this->db->where('tbl_booked_shipments.transaction', 'Import');
		}

		$query = $this->db->get();
		return $query->row();
	}

	function getShipmentProcessData($transctn, $request_id, $arrStepId = array())
	{
		$this->db->select('tbl_shipment_process.*,tbl_tracking_steps.*,');
		$this->db->from('tbl_shipment_process');
		//$this->db->join('tbl_booked_shipments', 'tbl_booked_shipments.id = tbl_shipment_process.book_id','left');
		$this->db->join('tbl_tracking_steps', 'tbl_tracking_steps.id = tbl_shipment_process.step_id', 'left');
		$this->db->where('tbl_shipment_process.request_id', $request_id);
		if (!empty($arrStepId)) {
			$this->db->where_in('tbl_shipment_process.step_id', $arrStepId);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function getSPSteps($transctn, $mode_id, $shipment_id, $delivery_term_id)
	{
		$this->db->select('t1.id,t1.step_name');
		$this->db->from('tbl_tracking_steps as t1'); //
		$this->db->join('tbl_delivery_term_mapp_tracking_steps as t2', 't1.id = t2.step_id');
		$this->db->where('t2.transaction', $transctn);
		$this->db->where('t2.mode_id', $mode_id);
		$this->db->where('t2.shipment_id', $shipment_id);
		$this->db->where('t2.delivery_term_id', $delivery_term_id);
		$this->db->order_by('t1.id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}



	public function getCompletedStep($transctn, $request_id)
	{
		$this->db->select('tbl_shipment_process.step_id');
		$this->db->from('tbl_shipment_process');
		$this->db->where('tbl_tracking_steps.transaction', $transctn);

		$this->db->join('tbl_tracking_steps', 'tbl_tracking_steps.id = tbl_shipment_process.step_id', 'left');
		$this->db->where('tbl_shipment_process.request_id', $request_id);
		$this->db->order_by('tbl_tracking_steps.id', 'asc');
		$query = $this->db->get();
		//		 echo $this->db->last_query();exit();
		return $query->result();
	}

	public function getCurrentStep($transctn, $request_id)
	{
		$this->db->select('tbl_shipment_process.step_id,tbl_tracking_steps.tracking_status_title');
		$this->db->from('tbl_shipment_process');
		$this->db->where('tbl_tracking_steps.transaction', $transctn);

		$this->db->join('tbl_tracking_steps', 'tbl_tracking_steps.id = tbl_shipment_process.step_id', 'left');
		$this->db->where('tbl_shipment_process.request_id', $request_id);
		//$this->db->where('tbl_shipment_process.status !=', 1);
		//		$this->db->order_by('tbl_shipment_process.step_id', 'DESC'); 	
		// $this->db->order_by('tbl_tracking_steps.id', 'asc');
		$this->db->order_by('tbl_tracking_steps.id', 'desc');
        $this->db->limit(1);
		$query = $this->db->get();
		// echo $this->db->last_query();exit();
		return $query->row();
	}

	public function getCurrentTrackStep($transctn, $request_id)
	{
		$this->db->select('tbl_shipment_process.step_id,tbl_tracking_steps.tracking_status_title');
		$this->db->from('tbl_shipment_process');
		$this->db->where('tbl_tracking_steps.transaction', $transctn);

		$this->db->join('tbl_tracking_steps', 'tbl_tracking_steps.id = tbl_shipment_process.step_id', 'left');
		$this->db->where('tbl_shipment_process.request_id', $request_id);
		$this->db->where('tbl_shipment_process.status !=', 1);
		// $this->db->order_by('tbl_shipment_process.step_id', 'DESC'); 	
		$this->db->order_by('tbl_tracking_steps.id', 'asc');
		// $this->db->order_by('tbl_tracking_steps.id', 'desc');
        // $this->db->limit(1);
		$query = $this->db->get();
		// echo $this->db->last_query();exit();
		return $query->row();
	}



	public function getLastCompletedStep($transctn, $request_id)
	{
		$this->db->select('tbl_shipment_process.step_id');
		$this->db->from('tbl_shipment_process');
		$this->db->where('tbl_tracking_steps.transaction', $transctn);

		$this->db->join('tbl_tracking_steps', 'tbl_tracking_steps.id = tbl_shipment_process.step_id', 'left');
		$this->db->where('tbl_shipment_process.request_id', $request_id);
		$this->db->where('tbl_shipment_process.status', 1);
		$this->db->order_by('tbl_shipment_process.step_id', 'DESC');
		$query = $this->db->get();
		// echo $this->db->last_query();exit();
		return $query->row();
	}
	public function getNextStep($transctn, $mode_id, $shipment_id, $delivery_term_id, $complete_id = array())
	{
		$this->db->select('t1.id');
		$this->db->from('tbl_tracking_steps as t1');
		$this->db->join('tbl_delivery_term_mapp_tracking_steps as t2', 't1.id = t2.step_id');
		$this->db->where('t2.transaction', $transctn);
		$this->db->where('t2.mode_id', $mode_id);
		$this->db->where('t2.shipment_id', $shipment_id);
		$this->db->where('t2.delivery_term_id', $delivery_term_id);
		$this->db->order_by('t1.id', 'ASC');

		if (!empty($complete_id)) {
			$this->db->where_not_in('t1.id', $complete_id);
		}
		$query = $this->db->get();

		//		 echo $this->db->last_query();exit();
		return $query->row();
	}

	function getShipmentProcessDataByStepId($request_id, $step_id)
	{
		$this->db->select('tbl_shipment_process.*,tbl_tracking_steps.step_name,');
		$this->db->from('tbl_shipment_process');
		//$this->db->join('tbl_booked_shipments', 'tbl_booked_shipments.id = tbl_shipment_process.book_id','left');
		$this->db->join('tbl_tracking_steps', 'tbl_tracking_steps.id = tbl_shipment_process.step_id', 'left');
		$this->db->where('tbl_shipment_process.request_id', $request_id);
		$this->db->where('tbl_shipment_process.step_id', $step_id);

		$query = $this->db->get();
		// print_r($this->db->last_query());
		return $query->row();
	}

	function getBookedShipmentByRFCId($rfc_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_booked_shipments');
		$this->db->where('rfc_id', $rfc_id);
		$query = $this->db->get();
		return $query->row();
	}

	/*jb098*/
	function insertRequirement($data)
	{
		$this->db->insert('tbl_seller_requirement', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function updateRequirement($request_id, $data)
	{
		$this->db->where('id', $request_id);
		if ($this->db->update('tbl_seller_requirement', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function getRequirmentList($company_id, $filter = array())
	{
		$this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as request_id,tbl_shipment.type as shipment,tbl_deliver_term.name as delivery_term_name,tbl_mode.type as mode, tbl_field_shipment_status.title as status_title');

		$this->db->from('tbl_seller_requirement');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.delivery_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
		$this->db->join('tbl_field_shipment_status', 'tbl_field_shipment_status.id = tbl_seller_requirement.status', 'left');
		$this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'right');

		if ($company_id) {

			$this->db->where('tbl_seller_requirement.fs_company_id', $company_id);
		}

		if (isset($filter['fromDate']) && isset($filter['toDate'])) {
			$this->db->where("CAST(tbl_seller_requirement.created_at AS DATE) >= '" . $filter['fromDate'] . "' AND " . "CAST(tbl_seller_requirement.created_at AS DATE) <= '" . $filter['toDate'] . "'");
		}

		if (isset($filter['transaction'])) {
			$this->db->where('tbl_seller_requirement.transaction', $filter['transaction']);
		}
		if (isset($filter['mode'])) {
			$this->db->where('tbl_seller_requirement.mode_id', $filter['mode']);
		}
		if (isset($filter['shipment'])) {
			$this->db->where('tbl_seller_requirement.shipment_id', $filter['shipment']);
		}

		$this->db->where_in('tbl_seller_requirement.status', ['1', '2', '3', '4', '7', '8']);
		$this->db->where('tbl_seller_requirement.deleted_at IS NULL');
		$this->db->order_by('tbl_seller_requirement.created_at', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getReportList($company_id, $transaction, $fromDate, $toDate)
	{
		$this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as request_id,tbl_shipment.type as shipment,tbl_deliver_term.name as delivery_term_name,tbl_mode.type as mode,tbl_company.name as ff_company_name,tbl_seller_requirement_mapp_ff.total_quote_amount,tbl_field_shipment_status.title as status_title');

		$this->db->from('tbl_seller_requirement');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.delivery_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
		$this->db->join('tbl_company', 'tbl_seller_requirement.selected_ff_company_id = tbl_company.id', 'left');
		$this->db->join('tbl_seller_requirement_mapp_ff', 'tbl_seller_requirement.selected_ff_company_id = tbl_seller_requirement_mapp_ff.ff_company_id AND tbl_seller_requirement_mapp_ff.request_id = tbl_seller_requirement.id', 'left');
		$this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'right');
		$this->db->join('tbl_field_shipment_status', 'tbl_field_shipment_status.id = tbl_seller_requirement.status', 'left');
		if ($fromDate) {
			$this->db->where(' CAST(tbl_seller_requirement.created_at AS DATE) >=', $fromDate);
		}
		if ($toDate) {
			$this->db->where(' CAST(tbl_seller_requirement.created_at AS DATE) <=', $toDate);
		}


		$this->db->where('tbl_seller_requirement.fs_company_id', $company_id);
		$this->db->where('tbl_seller_requirement.transaction', $transaction);
		$this->db->where('tbl_seller_requirement.deleted_at IS NULL');
		$this->db->order_by('tbl_seller_requirement.created_at', 'DESC');
		//		$this->db->where_in('tbl_seller_requirement.status', ['new','edited','send_for_quote']);
		$query = $this->db->get();
		//                print_r($this->db->last_query());die;
		$result = $query->result();
		foreach($result as $key=>$item){
			$result[$key]->totalGW = $this->getTotalGrossWeight($item->id,$item->shipment_id == 1 ? 'container' : 'package');
			$result[$key]->deliverCompletedDate = $this->getDeliveryCompletedDate($item->request_id);
			$currentStep = $this->getCurrentStep($item->transaction, $item->request_id);
			$result[$key]->currentStep = $currentStep;
            $result[$key]->tracking_status_title = $currentStep->tracking_status_title?$currentStep->tracking_status_title:'At Origin';
			$result[$key]->so_number = implode(", ",array_filter($this->getSoNumberList($item->request_id)));
			$result[$key]->so_line_item = implode(", ",array_filter($this->getSoLineItemList($item->request_id)));
           
		}

		return $result;
	}

	function getBookingList($company_id, $filter = array())
	{
		$this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as request_id,tbl_shipment.type as shipment,tbl_deliver_term.name as delivery_term_name,tbl_mode.type as mode,tbl_field_shipment_status.title as status_title');

		$this->db->from('tbl_seller_requirement');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.delivery_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
		$this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'right');
		$this->db->join('tbl_field_shipment_status', 'tbl_field_shipment_status.id = tbl_seller_requirement.status', 'left');

		if ($company_id) {

			$this->db->where('tbl_seller_requirement.fs_company_id', $company_id);
		}
		if (isset($filter['fromDate']) && isset($filter['toDate'])) {
			$this->db->where("CAST(tbl_seller_requirement.created_at AS DATE) >= '" . $filter['fromDate'] . "' AND " . "CAST(tbl_seller_requirement.created_at AS DATE) <= '" . $filter['toDate'] . "'");
		}

		if (isset($filter['transaction'])) {
			$this->db->where('tbl_seller_requirement.transaction', $filter['transaction']);
		}
		if (isset($filter['mode'])) {
			$this->db->where('tbl_seller_requirement.mode_id', $filter['mode']);
		}
		if (isset($filter['shipment'])) {
			$this->db->where('tbl_seller_requirement.shipment_id', $filter['shipment']);
		}

		$this->db->where_in('tbl_seller_requirement.status', ['5', '6']);
		$this->db->where('tbl_seller_requirement.deleted_at IS NULL');
		$this->db->order_by('tbl_seller_requirement.selected_ff_dt', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	function getRequestQuoteCount($request_id)
	{
		$this->db->select('COUNT(request_id) as request_count, COUNT(IF(`quote_status`  IN ("1","3","4","5","6","7","8","9"),1, NULL)) as quote_count');
		$this->db->from('tbl_seller_requirement_mapp_ff');
		$this->db->where('request_id', $request_id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getNumberOfRequests($company_id)
	{
		// $this->db->select('COUNT(t1.id) as request_count,COUNT(IF(t1.transaction="Export",1, NULL)) as export_count,COUNT(IF(t1.transaction="Import",1, NULL)) as import_count');
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
		$this->db->where('t1.fs_company_id', $company_id);
		$this->db->where('t1.deleted_at IS NULL');
		$query = $this->db->get();
		return $query->row();
	}


	public function getNewInquireCount($company_id)
	{
		$this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
		$this->db->from('tbl_seller_requirement as t1');
		// $this->db->join('tbl_seller_requirement_mapp_ff as t2', ' t1.id = t2.request_id');
		$this->db->where('t1.fs_company_id', $company_id);
		$this->db->where('t1.status', '2');
		$this->db->where('t1.deleted_at IS NULL');
		$query = $this->db->get();
		return $query->row();
	}
	public function getShipmentInProcessCount($company_id)
	{
		$this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
		$this->db->from('tbl_seller_requirement as t1');
		$this->db->where('t1.fs_company_id', $company_id);
		$this->db->where_in('t1.status', ['4', '5']);
		$this->db->where('t1.deleted_at IS NULL');
		$query = $this->db->get();
		return $query->row();
	}
	public function getCompletedShipmentCount($company_id)
	{
		$this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
		$this->db->from('tbl_seller_requirement as t1');
		$this->db->where('t1.fs_company_id', $company_id);
		$this->db->where_in('t1.status', ['6']);
		$this->db->where('t1.deleted_at IS NULL');
		$query = $this->db->get();
		return $query->row();
	}
	public function getCompletedShipmentPaymentPendingCount($company_id)
	{
		$this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
		$this->db->from('tbl_seller_requirement as t1');
		$this->db->where('t1.bill_amount_received', '1');
		$this->db->where('t1.fs_company_id', $company_id);
		$this->db->where_in('t1.status', ['6']);
		$this->db->where('t1.deleted_at IS NULL');
		$query = $this->db->get();
		return $query->row();
	}

	function getRequirmentDetails($request_id, $company_id)
	{
		if (empty($request_id)) {
			return;
		}
		$this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as request_id,tbl_shipment.type as shipment,tbl_deliver_term.name as delivery_term_name,tbl_mode.type as mode,tbl_field_shipment_status.title as status_title');

		$this->db->from('tbl_seller_requirement');
		$this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.delivery_term_id', 'left');
		$this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
		$this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'right');
		$this->db->join('tbl_field_shipment_status', 'tbl_field_shipment_status.id = tbl_seller_requirement.status', 'left');
		$this->db->where('tbl_seller_requirement.fs_company_id', $company_id);
		$this->db->where('tbl_seller_requirement.id', $request_id);
		$this->db->where('tbl_seller_requirement.deleted_at IS NULL');
		$query = $this->db->get();
		$result = $query->row();
		if (empty($result)) {
			return;
		}
		$result->package = [];
		$result->container = [];
		$result->totalVolume = $this->getTotalVolume($request_id, 'package');
		$result->totalVolumetricWeight = $this->getTotalVolumetricWeight($request_id, 'package');
		$result->totalGrossWeight = $this->getTotalGrossWeight($request_id, 'package');
		$result->totalNetWeight = $this->getTotalNetWeight($request_id, 'package');
		if ($result->shipment_id == "1") {
			//FCL
			$result->container = $this->getRequirementItems($request_id, 'container');
			
			//$result->package = $this->getRequirementItems($request_id, 'package');
		} else if ($result->shipment_id == "2") {
			//LCL
			$result->package = $this->getRequirementItems($request_id, 'package');
			
		}

		$result->consignor_other = new stdClass();
		$result->consignee_other = new stdClass();
		if ($result->is_other_consignor == 'Yes') {
			$result->consignor_other = $this->checkOtherAddressExist($request_id, 'consignor');
		}

		if ($result->is_other_consignee == 'Yes') {
			$result->consignee_other = $this->checkOtherAddressExist($request_id, 'consignee');
		}
		$quoteDetails = $this->getFFQuoteDetails($request_id, $result->selected_ff_company_id);
		$result = (object)array_merge((array)$result, (array)$quoteDetails);

		return $result;
	}

	function getFFQuoteDetails($request_id, $ff_Company_id)
	{
		$this->db->select('quote_submit_dt,counter_rate_update_status,counter_rate_update_dt,total_quote_amount,counter_rate');
		$this->db->from('tbl_seller_requirement_mapp_ff');
		$this->db->where('ff_company_id', $ff_Company_id);
		$this->db->where('request_id', $request_id);
		$query = $this->db->get();
		return $query->row();
	}

	function insertRequirementItem($data)
	{
		$this->db->insert('tbl_seller_requirement_mapp_items', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function updateRequirementItem($item_id, $data)
	{
		$this->db->where('id', $item_id);
		if ($this->db->update('tbl_seller_requirement_mapp_items', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function getRequirementItems($request_id, $itemType,$parentId=0)
	{
		$this->db->select('t1.*,ROUND((t1.length*t1.width*t1.height)/1000000,3) as volume,ROUND((t1.length*t1.width*t1.height)/5000,1) as volumetric_weight,'
			. 't3.type as container_type_name, t3.description as containerDesc, t4.type as type_of_packing_name,t5.size as container_size_title');
		//            $this->db->select('t1.*');
		$this->db->from('tbl_seller_requirement_mapp_items as t1');
		// $this->db->join('tbl_seller_requirement_items_mapp_ff_rate as t2', 't1.id = t2.request_item_id AND t2.ff_id = '.$ff_id,'left');
		$this->db->join('tbl_container as t3', 't1.container_type = t3.id', 'left');
		$this->db->join('tbl_packing as t4', 't1.type_of_packing = t4.id', 'left');
		$this->db->join('tbl_container_size as t5', 't1.container_size = t5.id', 'left');
		$this->db->where('t1.request_id', $request_id);
		$this->db->where('t1.parent_id', $parentId);
		$this->db->where('t1.item_type', $itemType);
		//            $this->db->where('t2.ff_id', $ff_id);
		$query = $this->db->get();
		$result = [];
			foreach($query->result() as $rowItem){

				if($this->isExistContainerPackage($rowItem->id)){
					$rowItem->package = $this->getRequirementItems($request_id,'package',$rowItem->id);
				}
				$result[]=$rowItem;
			}

		return $result;
	}

	function getTotalPackageCount($request_id, $itemType){
		$this->db->select('SUM(number_of_container) as total_package');
		$this->db->where('t1.request_id', $request_id);
		
		$this->db->where('t1.item_type', $itemType);
		$this->db->from('tbl_seller_requirement_mapp_items as t1');
		$query = $this->db->get();
		$result = $query->row();
		return $result->total_package;
	}

	function isExistContainerPackage($parentId){
		$this->db->select('id');
		$this->db->from('tbl_seller_requirement_mapp_items');
		$this->db->where('parent_id', $parentId);
		$query = $this->db->get();
		$result =$query->row();
		return (bool)$result;
	}

	function getTotalGrossWeight($requets_id, $itemType)
	{
		$this->db->select('SUM(gross_weight*number_of_container) as totalGrossWeight');
		$this->db->from('tbl_seller_requirement_mapp_items');
		$this->db->where('request_id', $requets_id);
		$this->db->where('item_type', $itemType);
		$query = $this->db->get();
		$result =  $query->row();
		return $result->totalGrossWeight;
	}
	function getTotalNetWeight($requets_id, $itemType)
	{
		$this->db->select('SUM(net_weight*number_of_container) as totalNetWeight');
		$this->db->from('tbl_seller_requirement_mapp_items');
		$this->db->where('request_id', $requets_id);
		$this->db->where('item_type', $itemType);
		$query = $this->db->get();
		$result =  $query->row();
		return $result->totalNetWeight;
	}
	function getTotalVolume($requets_id, $itemType)
	{
		$this->db->select('SUM(ROUND((length*width*height)/1000000,1)*number_of_container) as totalVolume');
		$this->db->from('tbl_seller_requirement_mapp_items');
		$this->db->where('request_id', $requets_id);
		$this->db->where('item_type', $itemType);
		$query = $this->db->get();
		$result =  $query->row();
		return $result->totalVolume;
	}
	function getTotalVolumetricWeight($requets_id, $itemType)
	{
		$this->db->select('SUM(ROUND((length*width*height)/5000,1)*number_of_container) as totalVolumetricWeight');
		$this->db->from('tbl_seller_requirement_mapp_items');
		$this->db->where('request_id', $requets_id);
		$this->db->where('item_type', $itemType);
		$query = $this->db->get();
		$result =  $query->row();
		return $result->totalVolumetricWeight;
	}

	function deleteRequirementItem($requets_id, $arrItemIds)
	{
		
		$this->db->where('request_id', $requets_id);
		$this->db->where_not_in('id', $arrItemIds);
		return $this->db->delete('tbl_seller_requirement_mapp_items');
	}

	

	function getFfList($filterData = '')
	{
		$this->db->select("t1.*,t1.id as user_id, t3.name as company_name,t3.address_line_1,t3.address_line_2,t3.city_name,t3.transaction_currency,GROUP_CONCAT(DISTINCT(t5.name)) AS sectors, GROUP_CONCAT(DISTINCT(t7.title)) as industryTypes");
		$this->db->from("tbl_users as t1");
		$this->db->join('tbl_users_profile as t2', 't2.user_id = t1.id', 'left');
		$this->db->join('tbl_company as t3', 't3.id = t1.company_id');
		$this->db->join('tbl_company_mapp_industry_sector as t4', 't3.id = t4.company_id', 'left');
		$this->db->join('tbl_sector as t5', 't4.sector_id = t5.id', 'left');
		$this->db->join('tbl_company_mapp_industry_type as t6', 't3.id = t6.company_id', 'left');
		$this->db->join('tbl_field_industry_type as t7', 't6.industry_type_id = t7.id', 'left');
		$this->db->join('tbl_company_mapp_documents as t8', 't1.company_id = t8.company_id AND t8.status="1"');
		$this->db->where('t1.role', '3');
		$this->db->where('t1.company_role', 'super_user');
		$this->db->where('t1.isActive', '1');
		if (!empty($filterData)) {
			if (!empty($filterData['name'])) {
				$this->db->where('t3.name LIKE "%' . $filterData['name'] . '%"');
			}
			if (!empty($filterData['location'])) {
				$this->db->where('t3.city_name LIKE "%' . $filterData['location'] . '%"');
			}
			if (!empty($filterData['sectors'])) {
				$this->db->where_in('t4.sector_id', $filterData['sectors']);
			}
			if (!empty($filterData['isActive'])) {
				$this->db->where('t3.isActive', $filterData['isActive']);
			}
			if (isset($filterData['public_status'])) {

				if ($filterData['public_status'] != null) {
					$this->db->where('t3.public_status', $filterData['public_status']);
				}
			}
		}

		$this->db->group_by('t1.id');
		$query = $this->db->get();

		return $query->result();
	}
	function getResponseFfList($request_id)
	{
		$this->db->select("t1.*,t1.id as user_id, t3.name as company_name,t3.address_line_1,t3.address_line_2,t3.city_name,t3.transaction_currency,t4.ff_id,t4.request_id,t4.other_charges_total,t4.quote_status,t5.title as quote_status_title, t4.quote_submit_dt,t4.total_quote_amount");
		$this->db->from("tbl_users as t1");
		$this->db->join('tbl_users_profile as t2', 't2.user_id = t1.id', 'left');
		$this->db->join('tbl_company as t3', 't3.id = t1.company_id', 'left');
		$this->db->join('tbl_seller_requirement_mapp_ff as t4', "t1.company_id = t4.ff_company_id AND t4.request_id = $request_id");
		$this->db->join('tbl_field_ff_shipment_status as t5', 't5.id = t4.quote_status', 'left');
		$this->db->where('t1.role', '3');
		$this->db->where('t1.company_role', 'super_user');
		$this->db->order_by('(-t4.total_quote_amount)', 'DESC');
		$query = $this->db->get();
		//            print_r($this->db->last_query()); 
		return $query->result();
	}

	function getSelectedFfids($request_id)
	{
		$this->db->select("ff_company_id");
		$this->db->from("tbl_seller_requirement_mapp_ff");
		$this->db->where('request_id', $request_id);
		$query = $this->db->get();
		$ff_ids = array();

		$result = $query->result();
		$ff_ids = array_column($result, "ff_company_id");
		return $ff_ids;
	}
 function getQuoteStatus($request_id,$ff_company_id){
	$this->db->select("tbl_seller_requirement_mapp_ff.quote_status,t5.title as quote_status_title,");
	$this->db->from("tbl_seller_requirement_mapp_ff");
	$this->db->join('tbl_field_ff_shipment_status as t5', 't5.id = tbl_seller_requirement_mapp_ff.quote_status', 'left');
	$this->db->where('request_id', $request_id);
	$this->db->where('ff_company_id', $ff_company_id);
	$query = $this->db->get();
	$result = $query->row();
	return $result;
 }
	function deleteRequestFf($request_id,$ff_company_id)
	{
		$this->db->where('request_id', $request_id);
		$this->db->where('quote_status', '2');
		if(is_array($ff_company_id)){
			$this->db->where_in('ff_company_id', $ff_company_id);
		}else{
			$this->db->where('ff_company_id', $ff_company_id);
		}
		
		return $this->db->delete('tbl_seller_requirement_mapp_ff');
	}
	
	function insertRequestFf($insertData)
	{
		$this->db->insert('tbl_seller_requirement_mapp_ff', $insertData);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	function changeRequestStatus($request_id, $data)
	{
		$this->db->where('id', $request_id);
		if ($this->db->update('tbl_seller_requirement', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function updateCounterRate($request_id, $ff_company_id, $counter_rate)
	{
		$updateData =  [
			'quote_status' => '3',
			'counter_rate_update_status' => '1',
			'counter_rate' => $counter_rate,
			'counter_rate_update_dt' => date('Y-m-d H:i:s')
		];
		$this->db->where('request_id', $request_id);
		$this->db->where('ff_company_id', $ff_company_id);
		if ($this->db->update('tbl_seller_requirement_mapp_ff', $updateData)) {
			return true;
		} else {
			return false;
		}
	}
	function updateRfcChargeCounterRate($ffChargesId, $counter_rate)
	{
		
		$this->db->where('id', $ffChargesId);
		if ($this->db->update('tbl_seller_requirement_mapp_rfc_charges', ['counter_rate'=>$counter_rate])) {
			return true;
		} else {
			return false;
		}
	}
	function updateOtherRfcChargeCounterRate($other_charge_id, $counter_rate)
	{
		
		$this->db->where('id', $other_charge_id);
		if ($this->db->update('tbl_seller_requirement_mapp_rfc_other_charges', ['counter_rate'=>$counter_rate])) {
			return true;
		} else {
			return false;
		}
	}


	function getFFcompanyDetails($company_id)
	{
		$this->db->select('t3.*,GROUP_CONCAT(DISTINCT(t5.name)) AS sectors, GROUP_CONCAT(DISTINCT(t7.title)) as industryTypes');
		$this->db->from('tbl_company as t3');
		$this->db->join('tbl_company_mapp_industry_sector as t4', 't3.id = t4.company_id', 'left');
		$this->db->join('tbl_sector as t5', 't4.sector_id = t5.id', 'left');
		$this->db->join('tbl_company_mapp_industry_type as t6', 't3.id = t6.company_id', 'left');
		$this->db->join('tbl_field_industry_type as t7', 't6.industry_type_id = t7.id', 'left');
		$this->db->where('t3.id', $company_id);
		$this->db->group_by('t3.id');
		$query = $this->db->get();
		$result = $query->row();

		return $result;
	}

	function getLastRfcRequestDetails($company_id)
	{
		$this->db->select('id as request_id');
		$this->db->where('fs_company_id', $company_id);
		$this->db->where('deleted_at IS NULL');
		$this->db->limit(1);
		$this->db->order_by('id', 'DESC');
		$this->db->from('tbl_seller_requirement');
		$query = $this->db->get();
		$result = $query->row();
		if (!empty($result)) {
			return $this->getRequirmentDetails($result->request_id, $company_id);
		}
		return;
	}


	function updateOtherAddress($request_id, $type, $data)
	{

		if ($this->checkOtherAddressExist($request_id, $type)) {
			//update
			$this->db->where('request_id', $request_id);
			$this->db->where('type', $type);
			if ($this->db->update('tbl_seller_requiement_mapp_address', $data)) {
				return true;
			} else {
				return false;
			}
		} else {
			//insert
			$data['request_id'] = $request_id;
			$data['type'] = $type;
			$data['id'] = null;
			$this->db->insert('tbl_seller_requiement_mapp_address', $data);
			$insert_id = $this->db->insert_id();
			return  $insert_id;
		}
	}


	function checkOtherAddressExist($request_id, $type)
	{

		$this->db->select('*');
		$this->db->from('tbl_seller_requiement_mapp_address');
		$this->db->where('request_id', $request_id);
		$this->db->where('type', $type);
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	function cancel_ff_shipment($request_id)
	{
		$this->db->where('request_id', $request_id);
		if ($this->db->update('tbl_seller_requirement_mapp_ff', ['quote_status' => '8'])) {
			return true;
		} else {
			return false;
		}
	}

	function getBookingShipmentStatusCount($companyId='',$transaction,$finyear)
	{
		$finDate1 = $finyear.'-04-01';
		$finDate2 = ($finyear+1).'-03-31';

		$temp =[
			'At Origin'=>0,
			'At Origin Port'=>0,
			'In-transit'=>0,
			'At Destination Port'=>0,
			'Delivered'=>0,
			'Statutory Update'=>0,
			'Completed'=>0,
		];	
		$subQuery = "SELECT t3.tracking_status_title FROM  `tbl_tracking_steps` as t3 WHERE t3.id = (SELECT COALESCE(MAX(step_id), 1) as step_id FROM `tbl_shipment_process` AS t2 WHERE t1.id = t2.request_id) ";

		$this->db->select("t1.fs_company_id,t1.transaction,($subQuery) as tracking_status_title, count(id) as  count");
		$this->db->from('tbl_seller_requirement as t1');
		$this->db->where('t1.transaction', $transaction);
		$this->db->where('t1.status', '5');
		$this->db->where('t1.deleted_at IS NULL');
		$this->db->where("CAST(t1.created_at AS DATE) BETWEEN '$finDate1' AND '$finDate2' ");
		if($companyId){
			$this->db->where('t1.fs_company_id', $companyId);
		}
		$this->db->group_by('tracking_status_title');
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$temp[$row->tracking_status_title] = $row->count;
		}
		$temp['Completed'] = $this->getCompletdShipmentCount($companyId,$transaction,$finyear);
		return $temp;
	}

	public function getCompletdShipmentCount($companyId='',$transaction,$finyear){
		$finDate1 = $finyear.'-04-01';
		$finDate2 = ($finyear+1).'-03-31';

		$this->db->select("count(id) as  count");
		$this->db->from('tbl_seller_requirement as t1');
		$this->db->where('t1.transaction', $transaction);
		$this->db->where('t1.status', '6');//see table tbl_field_shipment_status (Exporter-Importer) for status id
		if($companyId){
			$this->db->where('t1.fs_company_id', $companyId);
		}
		$this->db->where('t1.deleted_at IS NULL');
		$this->db->where("CAST(t1.created_at AS DATE) BETWEEN '$finDate1' AND '$finDate2' ");
		$query = $this->db->get();
		$result = $query->row();
		return $result->count;
	}

	function deleteRFC($request_id)
	{
		$this->db->where('id', $request_id);
		if ($this->db->update('tbl_seller_requirement', ['deleted_at'=>date('Y-m-d H:i:s')])) {
			return true;
		} else {
			return false;
		}
	}

	public function getSoNumberList($request_id){
		$this->db->select("so_number");
		$this->db->from("tbl_seller_requirement_mapp_items");
		$this->db->where('request_id', $request_id);
		$this->db->where('so_number IS NOT NULL');
		$query = $this->db->get();
		

		$result = $query->result();
		
		return array_column($result, "so_number");
	}
	
	public function getSoLineItemList($request_id){
		$this->db->select("so_line_item");
		$this->db->from("tbl_seller_requirement_mapp_items");
		$this->db->where('request_id', $request_id);
		$this->db->where('so_line_item IS NOT NULL');
		$query = $this->db->get();
		

		$result = $query->result();
		
		return array_column($result, "so_line_item");
	}
	function getDeliveryCompletedDate($request_id){
		$this->db->select("action_date");
		$this->db->from("tbl_shipment_process");
		$this->db->where('request_id', $request_id);
		$this->db->where_in('step_id',[10,19]);
		$query = $this->db->get();
		

		$result = $query->row();
		
		return $result->action_date?$result->action_date:null;
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cn_company extends CI_Controller
{
	public $session_user;
	public function __construct()
	{
		parent::__construct();

		$app_id = '9';
		$this->session_user = checkAdminSession($app_id);

		$this->load->model('Company_model', 'COMPANY', TRUE);
		$this->load->model('company_user_modal', 'C_USER', TRUE);
		$this->load->model('branch_model', 'BRNACH', TRUE);
		$this->load->model('sector_model');
		$this->load->model('freight_model');
		$this->load->model('industry_model');
		$this->load->model('seller_model');
	}

	public function index($type)
	{

		if ($type == "freight-forwarder") {
			$role = '3'; //freight-forwarder
			$data['addCompanyUrl'] = base_url('admin/company/freight-forwarder/add');
			$data['addBtnTitle'] = "Add Freight Forwarder";
		} else {
			$role = '2'; //exporter-importer
			$data['addCompanyUrl'] = base_url('admin/company/exporter-importer/add');
			$data['addBtnTitle'] = "Add Exporter Importer";
		}

		$data['company_list'] = $this->COMPANY->getList($role);
		$data['page'] = 'backend/company/index';
		$this->load->view('backend/layout_main', $data);
	}


	public function createCompany($type){
		if ($type == "freight-forwarder") {
			$role = '3'; //freight-forwarder
			$data['page_title'] = 'Add Freight Forwarder';
			$data['backUrl'] = base_url('admin/company/freight-forwarder');
		}else{
			$role = '2'; //exporter-importer
			$data['page_title'] = 'Add Exporter-Importer';
			$data['backUrl'] = base_url('admin/company/exporter-importer');
		}

		if ($_POST) {
			$this->load->model('login_model');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('firstname', 'Full Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_users.email]');
			$this->form_validation->set_rules('phone', 'Mobile', 'trim|required|numeric');
			// $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			//$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
			//$this->form_validation->set_rules('captcha_challenge', 'Captcha', 'trim|required|callback_captch_check');
			// $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == true) {
				//create new company

				//create company
				$dbOject = array(
					'name' => $this->input->post('company_name'),
					'description' => '',
					'role' => $role,
					'created_at' => date("Y-m-d H:i:s"),
					'updated_at' => date("Y-m-d H:i:s")
				);

				$companyId = $this->COMPANY->insert($dbOject);
				$password = password_generate(8);
				$userdata = array(
					'company_id' => $companyId ? $companyId : null,
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'username' => $this->input->post('firstname'),
					'phone' => $this->input->post('phone'),
					'password' => sha1($password),
					'role' => $role,
					'company_role' => 'super_user',
					'email' => $this->input->post('email')
				);

				$userId = $this->login_model->insertUser($userdata);
				if($userId){
					sendEmail_Usercreate($this->input->post('firstname'),$this->input->post('email'),$password);
					$this->session->set_flashdata('success', 'Successfully Registered!');
							
				}else{
					$this->session->set_flashdata('error', 'Something went wrog.');
						
				}

				redirect($data['backUrl']);

			}
		}
		
		$data['page'] = 'backend/company/add';
		
		$this->load->view('backend/layout_main', $data);
	}

	public function rfcList($company_id = '')
	{

		$data['companyProfile'] = $this->COMPANY->getRecord($company_id);
		// if ($this->input->get()) {
		// 	$filter = array();
		// 	$filter['fromDate'] = getMysqlDateFormat($this->input->get('fromDate'));
		// 	$filter['toDate'] = getMysqlDateFormat($this->input->get('toDate'));
		// 	$filter['transaction'] = $this->input->get('transaction');
		// 	$filter['mode'] = $this->input->get('mode');
		// 	$filter['shipment'] = $this->input->get('shipment');
		// 	$filter = array_filter($filter);
		// 	//$data['shippig_requirment_list'] = $this->seller_model->getRequirmentList($company_id, $filter);
		// }else{
		// 	//$data['shippig_requirment_list'] = $this->seller_model->getRequirmentList($company_id);
		// }

		$data['page'] = 'backend/company/rfc-list';
		$data['company_id'] = $company_id;
		$this->load->view('backend/layout_main', $data);
	}

	public function ajaxRFCList($company_id = '')
	{

		$companyProfile = $this->COMPANY->getRecord($company_id);

		$searchKey = $_POST['search'];
		$columns = $_POST['columns'];
		$order = $_POST['order'];

		$orderBy = $columns[$order[0]['column']]['data'] . ' ' . $order[0]['dir'];

		$iSearch = [];

		if (!empty($searchKey['value'])) {
			foreach ($columns as $row) {
				if (!empty($row['data'])) {

					$iSearch[] = " " . $row['data'] . " LIKE '%" . $searchKey['value'] . "%' ";
				}
			}
		}
		$iSearch_str = implode(' OR ', $iSearch);
		// $company_id = 9;
		$filter = [];
		if (isset($_POST['filter'])) {
			$filter = $_POST['filter'];
		}

		if ($companyProfile->role == '3') {
			//ff
			$filter['quote_status'] = ['1', '2', '3', '4', '6', '7', '8'];
			$filter['role'] = '3';
		} else {
			//fs
			$filter['status'] = ['1', '2', '3', '4', '7', '8'];
			$filter['role'] = '2';
		}



		echo json_encode($this->freight_model->get_rfc_list($company_id, $_POST['start'], $_POST['length'], $filter, '', $orderBy));
		die;
	}


	public function bookingList($company_id = '')
	{


		// if ($this->input->get()) {
		// 	$filter = array();
		// 	$filter['fromDate'] = getMysqlDateFormat($this->input->get('fromDate'));
		// 	$filter['toDate'] = getMysqlDateFormat($this->input->get('toDate'));
		// 	$filter['transaction'] = $this->input->get('transaction');
		// 	$filter['mode'] = $this->input->get('mode');
		// 	$filter['shipment'] = $this->input->get('shipment');
		// 	$filter = array_filter($filter);
		// $data['booking_list'] = $this->seller_model->getBookingList($company_id, $filter);
		// } else {
		// 	$data['booking_list'] = $this->seller_model->getBookingList($company_id);
		// }

		$data['companyProfile'] = $this->COMPANY->getRecord($company_id);
		$data['company_id'] = $company_id;
		$data['page'] = 'backend/company/booking-list';
		$this->load->view('backend/layout_main', $data);
	}

	public function ajaxBookingList($company_id = ''){
		$companyProfile = $this->COMPANY->getRecord($company_id);

		$searchKey = $_POST['search'];
		$columns = $_POST['columns'];
		$order = $_POST['order'];

		$orderBy = $columns[$order[0]['column']]['data'] . ' ' . $order[0]['dir'];

		$iSearch = [];

		if (!empty($searchKey['value'])) {
			foreach ($columns as $row) {
				if (!empty($row['data'])) {

					$iSearch[] = " " . $row['data'] . " LIKE '%" . $searchKey['value'] . "%' ";
				}
			}
		}
		$iSearch_str = implode(' OR ', $iSearch);
		// $company_id = 9;
		$filter = [];
		if (isset($_POST['filter'])) {
			$filter = $_POST['filter'];
		}

		if ($companyProfile->role == '3') {
			//ff
			$filter['quote_status'] = ['5', '9'];
			$filter['role'] = '3';
		} else {
			//fs
			$filter['status'] = ['5', '6'];
			$filter['role'] = '2';
		}



		echo json_encode($this->freight_model->get_rfc_list($company_id, $_POST['start'], $_POST['length'], $filter, '', $orderBy));
		die;
	}

	public function viewShipRequirment($company_id, $request_id)
	{

		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $company_id);

		$data['company_id'] = $company_id;
		$data['requestDetails'] = $requestDetails;
		//$data['delivery_terms'] = $this->deliver_term_model->getList();
		//$data['doc_verified'] = $this->seller_model->documentVerified($seller_session_data['id']);
		$data['skipComparative'] = ($data['requestDetails']->delivery_term_id == 1 && $data['requestDetails']->transaction == 'Export') || (in_array($data['requestDetails']->delivery_term_id, ['5', '6', '7']) && $data['requestDetails']->transaction == 'Import');
		if ($data['skipComparative'] || empty($requestDetails->selected_ff_company_id)) {
			$data['rfc_charges'] = array();
			$data['rfc_other_charges'] = array();
			$data['other_charges'] = array();
			$data['other_charges_value_arr'] = array();
		} else {
			$data['rfc_charges'] = $this->freight_model->getRfcChargesCategory($requestDetails, $request_id, $requestDetails->selected_ff_company_id);
			$data['rfc_other_charges'] = $this->freight_model->getRfcOtherCharges($request_id, $requestDetails->selected_ff_company_id);
			$data['other_charges'] = $this->freight_model->getOtherCharges($requestDetails);
			$data['other_charges_value_arr'] = $this->freight_model->getOtherChargesValues($requestDetails, $requestDetails->selected_ff_company_id, $requestDetails->shipment_id);
		}
		$data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($requestDetails->selected_ff_company_id);


		$data['page'] = 'backend/company/view-shipping-requirment';
		$this->load->view('backend/layout_main', $data);
	}

	public function viewDetails($company_id)
	{
		$company_data = $this->COMPANY->getRecord($company_id);
				// vdebug($company_data );
		$data['companyProfile'] = $company_data;
		$data['companyProfile']->industryTypes = $this->seller_model->getCompanyIndustryTypes($company_id);
		$data['companyProfile']->sectors = $this->seller_model->getCompanySectors($company_id);
		$data['companyProfile']->selected_sectors = $this->sector_model->getTitles($data['companyProfile']->sectors);
		$data['companyProfile']->selected_industries = $this->industry_model->getTitles($data['companyProfile']->industryTypes);


		if ($this->input->post()) {



			$this->load->library('upload');
			$company_id = $company_id;
			$doc_names = $this->input->post('doc_name');
			$document_number = $this->input->post('document_number');
			$old_doc_name = $this->input->post('old_doc_name');

			$files = $_FILES;



			$errorInFiles = array();

			foreach ($files['kyc_documents']['name'] as $i => $file) {


				if (!empty($files['kyc_documents']['name'][$i])) {
					$_FILES['kyc_documents']['name'] = $files['kyc_documents']['name'][$i];
					$_FILES['kyc_documents']['type'] = $files['kyc_documents']['type'][$i];
					$_FILES['kyc_documents']['tmp_name'] = $files['kyc_documents']['tmp_name'][$i];
					$_FILES['kyc_documents']['error'] = $files['kyc_documents']['error'][$i];
					$_FILES['kyc_documents']['size'] = $files['kyc_documents']['size'][$i];

					$config = array();

					$pathinfoArr = pathinfo($_FILES['kyc_documents']['name']);
					$extention	= $pathinfoArr['extension'];
					$newImagename = uniqid() . '.' . $extention;
					//				$config['file_name'] = $_FILES['company_logo']['name'];
					$config['file_name'] = $newImagename;
					$config['overwrite'] = false;
					$config['upload_path'] = 'uploads/kyc_documents/';
					$config['allowed_types'] = 'gif|jpeg|jpg|png|pdf|doc|docx';


					$this->upload->initialize($config);

					//$this->upload->initialize($this->set_upload_options());

					if ($this->upload->do_upload('kyc_documents')) {
						$dataInfo[$i] = $this->upload->data();
						$dataInfo[$i]['doc_name'] = $doc_names[$i];
						$dataInfo[$i]['doc_number'] = $document_number[$i];
						$dataInfo[$i]['original_file_name'] = $_FILES['kyc_documents']['name'];
						//unlink old file
						if (is_file($config['upload_path'] . $old_doc_name[$i])) {

							unlink($config['upload_path'] . $old_doc_name[$i]);
						}
					} else {
						$errorInFiles[] = $_FILES['kyc_documents']['name'];
					}
				}
			}


			foreach ($dataInfo as $kycfile) {

				$userkycdata = array(
					'company_id' => $company_id,
					'file' => $kycfile['file_name'],
					'number' => $kycfile['doc_number'],
					'original_file_name' => $kycfile['original_file_name'],
					'type' => $kycfile['doc_name'],
					'status' => '1'
				);

				$this->seller_model->insertUserKYC($userkycdata);
			}


			if (empty($errorInFiles)) {
				$this->session->set_flashdata('success', 'KYC document uploaded successfully');
				redirect(base_url('admin/view-company-details/' . $company_id));
			} else {
				$this->session->set_flashdata('error', implode(', ', $errorInFiles) . ' uploading faild.');
				redirect(base_url('admin/view-company-details/' . $company_id));
			}
		}
		$kycDocuments = [];
		if($company_data->role=='2'){
			$kycDocuments[] = ["type" => "1", "documnetName" => "PAN", "is_mandatory" => true, "details" => array()];
			$kycDocuments[] = ["type" => "2", "documnetName" => "COI/Proprietorship/LLP", "is_mandatory" => false, "details" => array()];
			$kycDocuments[] = ["type" => "4", "documnetName" => "IEC-Import Export Code", "is_mandatory" => false, "details" => array()];
			$kycDocuments[] = ["type" => "5", "documnetName" => "GST-Goods and Service Tax", "is_mandatory" => true, "details" => array()];
			$kycDocuments[] = ["type" => "6", "documnetName" => "LUT-Leter of Undertaking", "is_mandatory" => false, "details" => array()];
			$kycDocuments[] = ["type" => "9", "documnetName" => "Old Shipping Bill", "is_mandatory" => false, "details" => array()];
			//$kycDocuments[] = ["type" => "10", "documnetName" => "IATA-International Air Transport Association", "is_mandatory" => false, "details" => array()];
			$kycDocuments[] = ["type" => "11", "documnetName" => "Old Bill of Entry", "is_mandatory" => false, "details" => array()];
			
		}else{
			$kycDocuments[] = ["type" => "1", "documnetName" => "PAN", "is_mandatory" => true, "details" => array()];
			$kycDocuments[] = ["type" => "2", "documnetName" => "COI/Proprietorship/LLP", "is_mandatory" => false, "details" => array()];
			$kycDocuments[] = ["type" => "4", "documnetName" => "IEC-Import Export Code", "is_mandatory" => false, "details" => array()];
			$kycDocuments[] = ["type" => "5", "documnetName" => "GST-Goods and Service Tax", "is_mandatory" => true, "details" => array()];
			//$kycDocuments[] = ["type" => "6", "documnetName" => "LUT-Leter of Undertaking", "is_mandatory" => false, "details" => array()];
			//$kycDocuments[] = ["type" => "9", "documnetName" => "Old Shipping Bill", "is_mandatory" => false, "details" => array()];
			$kycDocuments[] = ["type" => "10", "documnetName" => "IATA-International Air Transport Association", "is_mandatory" => false, "details" => array()];
			//$kycDocuments[] = ["type" => "11", "documnetName" => "Old Bill of Entry", "is_mandatory" => false, "details" => array()];
			
		}
		
		foreach ($kycDocuments as $key => $doc) {
			$kycDocuments[$key]['details'] = $this->seller_model->getUserKYC($company_id, $doc['type']);
		}
		$data['companyProfile']->kyc_documents = $kycDocuments;
		$data['user_list'] = $this->C_USER->getList($company_id, '');
		$data['branch_list'] = $this->BRNACH->getList($company_id);

		//    vdebug($data['companyProfile']);
		$data['page'] = 'backend/company/view';

		$this->load->view('backend/layout_main', $data);
	}

	public function viewComparative($company_id, $request_id)
	{
		$ff_list =  $this->seller_model->getResponseFfList($request_id);
		$data['company_id'] = $company_id;
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$data['ff_list'] = $ff_list;
		$requirment = $this->seller_model->getRequirmentDetails($request_id, $company_id);
		$skipComparative = ($requirment->delivery_term_id == 1 && $requirment->transaction == 'Export') || (in_array($requirment->delivery_term_id, ['5', '6', '7']) && $requirment->transaction == 'Import');

		if ($skipComparative) {
			$this->session->set_flashdata('error', 'Comparative not available.');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$data['requestDetails'] = $requirment;

		if (empty($data['requestDetails'])) {
			$this->session->set_flashdata('error', 'Something went wrong.');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$data['selectedFFids'] = $this->seller_model->getSelectedFfids($request_id);
		//vdebug($_SERVER['HTTP_REFERER']);//
		$data['page'] = 'backend/company/view-comparative';
		$this->load->view('backend/layout_main', $data);
	}

	public function viewTracking($company_id, $request_id)
	{
		$data['company_id'] = $company_id;
		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $company_id);
		$transctn = $requestDetails->transaction;
		$steps = $this->seller_model->getSPSteps($requestDetails->transaction, $requestDetails->mode_id, $requestDetails->shipment_id, $requestDetails->delivery_term_id);
		// For step show start
		$completedStep = $this->seller_model->getCompletedStep($transctn, $request_id);
		$currentStep = $this->seller_model->getCurrentStep($transctn, $request_id);
		$completedStepID = array();
		foreach ($completedStep as $CS) {
			array_push($completedStepID, $CS->step_id);
		}

		if ($currentStep == NULL) {
			$nextStep = $this->seller_model->getNextStep($requestDetails->transaction, $requestDetails->mode_id, $requestDetails->shipment_id, $requestDetails->delivery_term_id, $completedStepID);
			if ($nextStep) {
				$currentStep = new StdClass;
				$currentStep->step_id = $nextStep->id;
			} else {
				$lastCompletedSetp = $this->seller_model->getLastCompletedStep($transctn, $request_id);
				$currentStep = new StdClass;
				$currentStep->step_id = $lastCompletedSetp->step_id;
			}
		}

		// print_r($currentStep);die;
		// push current step in complete step to active ul>li
		array_push($completedStepID, $currentStep->step_id);
		$data['currentStep'] = $currentStep;
		$data['completedStep'] = $completedStepID;
		// For step show End


		$shipmentProcessData = $this->seller_model->getShipmentProcessData($transctn, $request_id);
		//echo '<pre>';print_r($shipmentProcessData);die;
		$data['bookedShipment'] = $requestDetails;
		$data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($requestDetails->selected_ff_company_id);
		$data['stepData'] = $steps;
		$data['shipmentProcessData'] = $shipmentProcessData;

		$data['stepData'] = $steps;
		// if ($transctn === "Export") {
		// 	$data['page'] = 'frontend/seller/track_shipment_export';
		// } else {
		// 	$data['page'] = 'frontend/seller/track_shipment_import';
		// }
		$data['skipComparative'] = ($data['bookedShipment']->delivery_term_id == 1 && $data['bookedShipment']->transaction == 'Export') || (in_array($data['bookedShipment']->delivery_term_id, ['5', '6', '7']) && $data['bookedShipment']->transaction == 'Import');


		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$buyer_seler_email = array();
		$buyer_seler_email[] = isset($requestDetails->consignor_other->email) ? $requestDetails->consignor_other->email : '';
		$buyer_seler_email[] = isset($requestDetails->consignee_other->email) ? $requestDetails->consignee_other->email : '';
		$data['buyer_seler_email'] = implode(',', array_filter($buyer_seler_email));
		//                vdebug($requestDetails);
		$data['page'] = 'backend/company/view-tracking';
		$this->load->view('backend/layout_main', $data);
	}

	public function changeStatus()
	{
		$id = $this->input->post('id');
		$isActive = $this->input->post('isActive');

		if (empty($id)) {
			echo json_encode(array('status' => 0, 'msg' => 'Company not found'));
			die;
		}

		$dbOject = array(
			'isActive' => $isActive,
			'updated_at' => date("Y-m-d H:i:s")
		);

		$mesg_sub = $isActive == 1 ? 'Activated' : 'Deactivated';
		$company_data = $this->COMPANY->getRecord($id);
		$msg = $company_data->name . ' ' . $mesg_sub;
		if ($this->COMPANY->update($id, $dbOject)) {
			echo json_encode(array('status' => 1, 'msg' => $msg));
			die;
		} else {
			$msg = "Error";
			echo json_encode(array('status' => 0, 'msg' => $msg));
			die;
		}
	}
	public function changePublicStatus()
	{
		$id = $this->input->post('id');
		$isActive = $this->input->post('isActive');

		if (empty($id)) {
			echo json_encode(array('status' => 0, 'msg' => 'Company not found'));
			die;
		}

		$dbOject = array(
			'public_status' => $isActive,
			'updated_at' => date("Y-m-d H:i:s")
		);

		$mesg_sub = $isActive == 1 ? 'Blocked' : 'Unblocked';
		$company_data = $this->COMPANY->getRecord($id);
		$msg = $company_data->name . ' ' . $mesg_sub;
		if ($this->COMPANY->update($id, $dbOject)) {
			echo json_encode(array('status' => 1, 'msg' => $msg));
			die;
		} else {
			$msg = "Error";
			echo json_encode(array('status' => 0, 'msg' => $msg));
			die;
		}
	}
}

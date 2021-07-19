<?php
defined('BASEPATH') or exit('No direct script access allowed');
//ini_set('display_errors', 1);

class Freightforwarder extends CI_Controller
{

	public $seller_session_data;
	public function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata("seller_logged_in"))) {
			$this->session->set_userdata('redirect_url', uri_string());
			redirect(base_url('signin'));
		} else {
			$this->seller_session_data = $this->session->userdata('seller_logged_in');
			if ($this->seller_session_data['role'] !== '3') {

				redirect(base_url());
			}
		}

		$this->load->model('company_model');
		$this->load->model('shipment_model');
		$this->load->model('contract_model');
		$this->load->model('container_model');
		$this->load->model('deliver_term_model');
		$this->load->model('mode_model');
		$this->load->model('sector_model');
		$this->load->model('port_model');
		$this->load->model('sector_model');
		$this->load->model('industry_model');
		$this->load->model('seller_model');
		$this->load->model('freight_model');
		$this->load->model('reports_model');
		$this->load->model('login_model');
		$this->load->model('communication_model');
		$this->load->model('annual_contract_model');
		$this->load->model('annual_contract_mapp_ff_model');
		$this->load->model('annual_contract_route_rfc_charges_model');
		$this->load->model('annual_contract_route_riders_model');
		$this->load->helper('cookie');
		$this->load->library(array('session', 'form_validation', 'email'));
	}

	public function dashboard()
	{
		$data['leftmenuActive'] = "dashboard";
		$data['numberOfAwardedRequests'] = $this->freight_model->getNumberOfRequests($this->seller_session_data['company_id']);
		$data['newInquireCount'] = $this->freight_model->getNewInquireCount($this->seller_session_data['company_id']);
		$data['shipmentInProcessCount'] = $this->freight_model->getShipmentInProcessCount($this->seller_session_data['company_id']);
		$data['completedShipmentPaymentPendingCount'] = $this->freight_model->getCompletedShipmentPaymentPendingCount($this->seller_session_data['company_id']);
		$data['completedShipmentCount'] = $this->freight_model->getCompletedShipmentCount($this->seller_session_data['company_id']);
		if (isset($_GET['finyear'])) {
			$finyear = $_GET['finyear'];
		} else {
			$finyear = getCurrentFinancialYear();
		}
		$bookedShipmentStatusCount = new stdClass;
		$bookedShipmentStatusCount->import = $this->freight_model->getBookingShipmentStatusCount($this->seller_session_data['company_id'], 'Import', $finyear);
		$bookedShipmentStatusCount->export = $this->freight_model->getBookingShipmentStatusCount($this->seller_session_data['company_id'], 'Export', $finyear);
		$data['bookedShipmentStatusCount'] = $bookedShipmentStatusCount;
		$data['finyear'] = $finyear;

		$data['page'] = 'frontend/freightforwarder/dashboard';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function profile()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['leftmenuActive'] = "my-profile";
		if ($_POST) {
			//                    echo "<pre>";
			//                print_r($_POST);
			//                print_r($_FILES);
			//		echo "</pre>";die;
			$this->session->set_userdata('profileActiveTab', 'profile');

			$user_id = $seller_session_data['id'];

			$profileData = $this->seller_model->getSellerProfile($user_id);

			///$headData = $this->seller_model->getHeadProfile($user_id);

			$userdata = array(
				'salutation' => $this->input->post('salutation'),
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'country_code' => $this->input->post('country_code'),
				'phone' => $this->input->post('phone')
			);


			if (!empty($_FILES['profile_pic']['name'])) {

				$config['upload_path'] = 'uploads/users/';
				$pathinfoArr = pathinfo($_FILES['profile_pic']['name']);
				$extention	= $pathinfoArr['extension'];
				$newImagename = uniqid() . '.' . $extention;
				$config['file_name'] = $newImagename;
				//				$config['file_name'] = $_FILES['profile_pic']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = 'jpg|jpeg|png|gif';

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('profile_pic')) {
					//unlink old file
					$uploadData = $this->upload->data();
					unlink($config['upload_path'] . $this->input->post('old_profile_pic'));
					$profile_pic = $uploadData['file_name'];
				} else {
					$profile_pic = '';
				}
				$userprofile['profile_pic'] = $profile_pic;
			}

			$userprofile['designation_id'] = $this->input->post('designation_id');
			//			 $userprofile['address'] = $this->input->post('address');
			//			 $userprofile['gender'] = $this->input->post('gender');
			$userprofile['user_type'] = 3;
			//			   print_r($userprofile);die;
			if ($this->seller_model->updateUser($userdata, $user_id)) {

				if (empty($profileData->id)) {

					$userprofile['user_id'] = $user_id;
					$this->seller_model->insertUserInfo($userprofile);
					$this->session->set_flashdata('success', 'Profile updated successfully');

					redirect(base_url('ff-my-profile'));
				} else {

					$this->seller_model->updateUserInfo($userprofile, $user_id);
					$this->session->set_flashdata('success', 'Profile updated successfully');

					redirect(base_url('ff-my-profile'));
				}
			}
		}

		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		//$data['myProfile']->kyc_documents = $this->seller_model->getUserKYC($seller_session_data['id']);
		//$country_name = $this->seller_model->getCountries();
		//$data['CName'] = $country_name;
		//		if(!empty($data['myProfile']->sector_id)){
		//			$data['sectorDocs'] = $this->seller_model->getSectorWiseDoc($data['myProfile']->sector_id);
		//		}else{
		//			$data['sectorDocs'] = "";
		//		}

		//$data['compData'] = $this->seller_model->getCompanyData();
		$data['designtnData'] = $this->seller_model->getDesignationData();
		//$data['sectors'] = $this->sector_model->getList();
		$data['page'] = 'frontend/freightforwarder/profile';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}
	public function company_profile()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');

		$data['leftmenuActive'] = "company-profile";
		$data['leftSubMenuActive'] = "company-profile";
		if ($_POST) {
			$this->session->set_userdata('companyActiveTab', 'profile');


			$user_id = $seller_session_data['id'];
			$company_id = $seller_session_data['company_id'];

			$profileData = $this->seller_model->getSellerProfile($user_id);
			$companyData = $this->seller_model->getCompanyProfile($company_id);

			$headData = $this->seller_model->getHeadProfile($user_id);

			$companyData = array(
				'name' => $this->input->post('company_name'),
				'address_line_1' => $this->input->post('address_line_1'),
				'address_line_2' => $this->input->post('address_line_2'),
				'city_id' => $this->input->post('city_id') ? $this->input->post('city_id') : null,
				'state_id' => $this->input->post('state_id') ? $this->input->post('state_id') : null,
				'country_id' => $this->input->post('country_id') ? $this->input->post('country_id') : null,
				'city_name' => $this->input->post('city_name') ? $this->input->post('city_name') : null,
				'pincode' => $this->input->post('pincode'),
				'website' => $this->input->post('website'),
				'transaction_currency' => $this->input->post('transaction_currency'),
				'description' => $this->input->post('description'),
				'head_firstname' => $this->input->post('head_firstname'),
				'head_country_code' => $this->input->post('head_country_code'),
				'head_phone' => $this->input->post('head_phone'),
				'head_email' => $this->input->post('head_email'),
				'head_landline' => $this->input->post('head_landline'),
				'head_fax' => $this->input->post('head_fax')
			);

			if (!empty($_FILES['company_logo']['name'])) {

				$config['upload_path'] = 'uploads/company/';
				$pathinfoArr = pathinfo($_FILES['company_logo']['name']);
				$extention	= $pathinfoArr['extension'];
				$newImagename = uniqid() . '.' . $extention;
				//				$config['file_name'] = $_FILES['company_logo']['name'];
				$config['file_name'] = $newImagename;
				$config['overwrite'] = false;
				$config["allowed_types"] = 'jpg|jpeg|png|gif';

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('company_logo')) {
					$uploadData = $this->upload->data();
					$company_logo = $newImagename;
				} else {
					$company_logo = '';
				}
				$companyData['company_logo'] = $company_logo;
				$companyData['company_logo_original_name'] = $_FILES['company_logo']['name'];
			}

			//			 $userprofile['designation_id'] = $this->input->post('designation');
			//			 $userprofile['address'] = $this->input->post('address');
			//			 $userprofile['country'] = $this->input->post('country');
			//			 $userprofile['state'] = $this->input->post('state');
			//			 $userprofile['city'] = $this->input->post('city');
			//			 $userprofile['pincode'] = $this->input->post('pincode');
			//			 $userprofile['gender'] = $this->input->post('gender');
			//			 $userprofile['user_type'] = 2;


			//delete old and insert new mapp industry types
			$this->company_model->insertIndustryTypes($company_id, $this->input->post('industry_types'));


			//delete old and insert insert mapp sectors
			$this->company_model->insertSectors($company_id, $this->input->post('sectors'));

			if ($this->company_model->update($company_id, $companyData)) {

				$this->session->set_flashdata('success', 'Company profile updated successfully.');
				redirect(base_url('ff-company-profile'));
			} else {
				$this->session->set_flashdata('error', 'Something went wrong.');
				redirect(base_url('ff-company-profile'));
			}
		}
		$kycDocuments[] = ["type" => "5", "documnetName" => "GST-Goods and Service Tax", "is_mandatory" => true, "details" => array()];
		$kycDocuments[] = ["type" => "1", "documnetName" => "PAN", "is_mandatory" => true, "details" => array()];
		$kycDocuments[] = ["type" => "2", "documnetName" => "COI/Proprietorship/LLP/Partnership", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "4", "documnetName" => "IEC-Import Export Code", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "10", "documnetName" => "IATA-International Air Transport Association", "is_mandatory" => false, "details" => array()];
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$data['companyProfile'] = $this->seller_model->getCompanyProfile($seller_session_data['company_id']);
		$data['companyProfile']->industryTypes = $this->seller_model->getCompanyIndustryTypes($seller_session_data['company_id']);
		$data['companyProfile']->sectors = $this->seller_model->getCompanySectors($seller_session_data['company_id']);
		foreach ($kycDocuments as $key => $doc) {
			$kycDocuments[$key]['details'] = $this->seller_model->getUserKYC($seller_session_data['company_id'], $doc['type']);
		}
		$data['companyProfile']->kyc_documents = $kycDocuments;

		$country_name = $this->seller_model->getCountries();
		$data['CName'] = $country_name;

		if (!empty($data['myProfile']->sector_id)) {
			$data['sectorDocs'] = $this->seller_model->getSectorWiseDoc($data['myProfile']->sector_id);
		} else {
			$data['sectorDocs'] = "";
		}

		//$data['compData'] = $this->seller_model->getCompanyData();
		$data['designtnData'] = $this->seller_model->getDesignationData();
		$data['sectors'] = $this->sector_model->getList($active = true);
		$data['industries'] = $this->industry_model->getList($active = true);
		$data['page'] = 'frontend/freightforwarder/company-profile';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';

		//                echo '<pre>';
		//                print_r($data);
		//                echo '</pre>';
		//                die;
		$this->load->view('frontend/layout_main', $data);
	}


	public function kyc_document()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		//print_r($seller_session_data);
		if ($_POST) {
			//$this->session->set_userdata('companyActiveTab','kyc');
			//			echo '<pre>';
			//                        print_r($_FILES);
			//			print_r($_POST);
			//die;

			$user_id = $seller_session_data['id'];
			$company_id = $seller_session_data['company_id'];

			$doc_names = $this->input->post('doc_name');
			$document_number = $this->input->post('document_number');
			$old_doc_name = $this->input->post('old_doc_name');

			$kycData = $this->seller_model->getUserKYC($user_id);

			$this->load->library('upload');

			$files = $_FILES;

			$cpt = count($_FILES['kyc_documents']['name']);
			$errorInFiles = array();
			for ($i = 0; $i < $cpt; $i++) {
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
					$config['allowed_types'] = 'gif|jpg|png|Pdf|doc|docx';


					$this->upload->initialize($config);

					//$this->upload->initialize($this->set_upload_options());

					if ($this->upload->do_upload('kyc_documents')) {

						$dataInfo[$i] = $this->upload->data();
						$dataInfo[$i]['doc_name'] = $doc_names[$i];
						$dataInfo[$i]['doc_number'] = $document_number[$i];
						$dataInfo[$i]['original_file_name'] = $_FILES['kyc_documents']['name'];
						//unlink old file
						unlink($config['upload_path'] . $old_doc_name[$i]);
					} else {
						$errorInFiles[] = $_FILES['kyc_documents']['name'];
					}
				}
			}
			//			print_r($dataInfo);die;
			foreach ($dataInfo as $kycfile) {

				$userkycdata = array(
					'company_id' => $company_id,
					'file' => $kycfile['file_name'],
					'number' => $kycfile['doc_number'],
					'original_file_name' => $kycfile['original_file_name'],
					'type' => $kycfile['doc_name'],
					'status' => '0'
				);

				$this->seller_model->insertUserKYC($userkycdata);
			}

			if (empty($errorInFiles)) {
				$this->session->set_flashdata('success', 'KYC document uploaded successfully.');
				redirect(base_url('ff-company-profile'));
			} else {
				$this->session->set_flashdata('error', implode(', ', $errorInFiles) . ' uploading faild.');
				redirect(base_url('ff-company-profile'));
			}
		}
	}

	public function change_password()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');

		if ($_POST) {
			//$this->session->set_userdata('profileActiveTab','setting');

			$user_id = $seller_session_data['id'];

			$profileData = $this->seller_model->getSellerProfile($user_id);

			$userdata = array(
				'password' => sha1($this->input->post('confirm_password'))
			);

			if ($this->seller_model->updateUser($userdata, $user_id)) {
				sendEmail_changePassword($profileData->firstname, $profileData->lastname, $profileData->email, $this->input->post('confirm_password'));
				$this->session->set_flashdata('success', 'Password updated successfully');
				redirect(base_url('ff-my-profile'));
			}
		}
	}



	public function request_list()
	{
		$data['leftmenuActive'] = "shipping";

		$data['leftSubMenuActive'] = "request-list";
		$data['shippig_requirment_list'] = []; // $this->freight_model->getRequirmentList($this->seller_session_data['company_id']);

		$data['page'] = 'frontend/freightforwarder/request_list';

		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function ajaxRequestList($company_id = '')
	{

		$company_id = $this->seller_session_data['company_id'];

		$searchKey = $_POST['search'];
		$columns = $_POST['columns'];
		$order = $_POST['order'];

		$orderBy = $columns[$order[0]['column']]['data'] . ' ' . $order[0]['dir'];

		$iSearch = [];

		if (!empty($searchKey['value'])) {
			foreach ($columns as $row) {
				if (!empty($row['data']) && $row['searchable'] == 'true') {

					if ($row['data'] == 'mode') {
						$row['data'] = 'tbl_mode.type';
					}
					if($row['data'] =='request_id'){
						$row['data'] ='tbl_seller_requirement.id';
					}
					if ($row['data'] == 'delivery_term_name') {
						$row['data'] = 'tbl_deliver_term.name';
					}
					if ($row['data'] == 'shipment') {
						$row['data'] = 'tbl_shipment.type';
					}
					if ($row['data'] == 'quote_status_title') {
						$row['data'] = 't5.title';
					}
					if ($row['data'] == 'quote_status_title') {
						$row['data'] = 't5.title';
					}
					if ($row['data'] == 'status_title') {
						$row['data'] = 'tbl_field_shipment_status.title';
					}
					$iSearch[] = " " . $row['data'] . " LIKE '%" . $searchKey['value'] . "%' ";
				}
			}
		}
		$iSearch_str = implode(' OR ', $iSearch);

		$filter = [];
		if (isset($_POST['filter'])) {
			$filter = $_POST['filter'];
		}

		//ff
		$filter['quote_status'] = ['1', '2', '3', '4', '6', '7', '8'];
		$filter['role'] = '3';



		echo json_encode($this->freight_model->get_rfc_list($company_id, $_POST['start'], $_POST['length'], $filter, $iSearch_str, $orderBy));
		die;
	}

	public function edit_request_details($request_id)
	{

		is_ff_kyc_approved(); //check user kyc is approved or not

		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$seller_session_data = $this->session->userdata('seller_logged_in');

		//get request details
		if ($this->input->post('request_id')) {
			$request_id = $this->input->post('request_id');
		}

		$requestDetails = $this->freight_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);


		if (!$requestDetails) {
			$this->session->set_flashdata('error', 'RFC details not found.');
			redirect(base_url('ff-request-list'));
		}

		if (!in_array($requestDetails->quote_status, ['1', '2', '3'])) {
			//$this->session->set_flashdata('error','Details not found.');
			redirect(base_url("view-request-details/$request_id"));
		}

		if ($this->input->post()) {
			//                     vdebug($_POST);
			$submit = $this->input->post('submit');

			$totalQuoteValue = 0;
			$other_charges_total = 0;
			$total = 0;
			foreach ($this->input->post('rfc_charges') as $rfc) {

				$rfcChargesDetails = $this->freight_model->checkRfcChargeExist($request_id, $this->seller_session_data['company_id'], $rfc['rfc_id'], $rfc['item_id']);
				$total = ($rfc['rfc_charge'] * $rfc['qty']);
				if (!empty($rfcChargesDetails)) {
					//update
					$insertData = [
						'charges' => $rfc['rfc_charge'],
						'qty' => $rfc['qty'],
						'total' => $total
					];
					$this->freight_model->updateRfcCharges($rfcChargesDetails->id, $insertData);
				} else {
					//insert
					$insertData = [
						'ff_company_id' => $this->seller_session_data['company_id'],
						'request_id' => $request_id,
						'item_id' => $rfc['item_id'],
						'rfc_charges_id' => $rfc['rfc_id'],
						'charges' => $rfc['rfc_charge'],
						'qty' => $rfc['qty'],
						'total' => $total
					];
					$this->freight_model->insertRfcCharges($insertData);
				}
				$totalQuoteValue += $total;
			}


			foreach ($this->input->post('rfc_charges_other') as $rfc) {

				//   $rfcChargesDetails = $this->freight_model->checkRfcChargeExist($request_id,$this->seller_session_data['company_id'],$rfc['rfc_id'],$rfc['item_id']);
				$total = ($rfc['rfc_charge'] * $rfc['qty']);
				$other_charges_total += $total;
				$totalQuoteValue += $total;
				if (!empty($rfc['id'])) {
					//update
					$insertData = [

						'charges' => $rfc['rfc_charge'],
						'title' => $rfc['title'],
						'unit' => $rfc['unit'],
						'qty' => $rfc['qty'],
						'total' => $total
					];
					$this->freight_model->updateRfcOtherCharges($rfc['id'], $insertData);
				} else {
					//insert
					$insertData = [
						'ff_company_id' => $this->seller_session_data['company_id'],
						'request_id' => $request_id,
						'category_id' => $rfc['category_id'],
						'charges' => $rfc['rfc_charge'],
						'title' => $rfc['title'],
						'unit' => $rfc['unit'],
						'qty' => $rfc['qty'],
						'total' => $total
					];
					$this->freight_model->insertRfcOtherCharges($insertData);
				}
			}

			$this->freight_model->updateRfcChargesTotal($request_id, $this->seller_session_data['company_id']);
			//insert particulars if shipment is FCL
			//delete old
			$this->freight_model->deleteOtherCharges($request_id, $this->seller_session_data['company_id']);
			foreach ($this->input->post('otherCharges') as $otherCharge) {
				$value_1 = $otherCharge['value_1'];
				$value_2 = $otherCharge['value_2'];
				$other_charge_id = $otherCharge['other_charge_id'];

				if (in_array($other_charge_id, ['15', '16'])) {
					$value_1 = $otherCharge['value_1'] . '|' . $otherCharge['currency_from'];
					$value_2 = $otherCharge['value_2'] . '|' . $otherCharge['currency_to'];
				}
				if (in_array($other_charge_id, ['2', '3', '4'])) {
					$value_1 = getMysqlDateFormat($otherCharge['value_1']);
				}

				$otherChargedata = [
					'other_charge_id' => $other_charge_id,
					'request_id' => $request_id,
					'ff_company_id' => $this->seller_session_data['company_id'],
					'value_1' => $value_1,
					'value_2' => $value_2,
				];
				$this->freight_model->insertOtherCharge($otherChargedata);
			}

			$this->freight_model->deleteParticulars($request_id, $this->seller_session_data['company_id']);
			if (!empty($this->input->post('billingItems'))) {
				foreach ($this->input->post('billingItems') as $particular) {
					$particularData = [
						'ff_company_id' => $this->seller_session_data['company_id'],
						'request_id' => $request_id,
						'vehicle' => $particular['vehicle'],
						'transport_charge' => $particular['transport_charge'],
						'varai_charge' => $particular['varai_charge'],
						'detention_charge' => $particular['detention_charge'],
						'qty' => $particular['qty'],
						'cost' => $particular['cost'],
					];
					$this->freight_model->insertParticular($particularData);
				}
			}
			//update ff payment terms
			$this->freight_model->updateQuoteStatus($request_id, $this->seller_session_data['company_id'], ['ff_payment_term' => $this->input->post('ff_payment_term'), 'comment' => $this->input->post('comment')]);


			//update total quote Amount
			$this->freight_model->updateTotalQuoteAmount($request_id, $this->seller_session_data['company_id'], ['total_quote_amount' => $totalQuoteValue, 'other_charges_total' => $other_charges_total]);

			if ($submit == 'Save and Send Quote') {
				//send quote
				$this->freight_model->updateQuoteStatus($request_id, $this->seller_session_data['company_id'], ['quote_status' => '1', 'quote_submit_dt' => date('Y-m-d H:i:s')]);
				$this->session->set_flashdata('success', 'Quote sent successfully.');

				//update request status Quotation Received
				if ($requestDetails->status == '2') {
					$updateReqData['status'] =  '3';
					$updated = $this->seller_model->updateRequirement($request_id, $updateReqData);
				}

				$fs_details = $this->seller_model->getFS_DetailsByCompanyId($requestDetails->fs_company_id);
				$fs_name = $fs_details->salutation . ' ' . $fs_details->firstname . ' ' . $fs_details->lastname;
				$url = base_url('view-quote/' . $request_id . '/' . $this->seller_session_data['company_id']);
				$url = "<a href='$url' target='_blank'>$url</a>";
				sendEmail_quoteSendToSeller($fs_details->email, $fs_name, $url, $request_id);

				//redirect(base_url('ff-request-list'));
			} else {
				$this->session->set_flashdata('success', 'Rate updated successfully.');
			}



			redirect(base_url('ff-request-list'));
		}

		$data['requestDetails'] = $requestDetails;

		$data['fs_details'] = $this->seller_model->getSellerDetails($requestDetails->user_id);
		$data['messages'] = $this->communication_model->getRecord([$requestDetails->user_id, $this->seller_session_data['id']], $request_id);
		//$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		//$data['compData'] = $this->seller_model->getCompanyData();
		$data['delivery_terms'] = $this->deliver_term_model->getList();
		$data['doc_verified'] = $this->seller_model->documentVerified($seller_session_data['id']);
		$data['modes'] = $this->mode_model->getList();
		//		$data['pol'] = $this->port_model->getPOLList();
		//		$data['pod'] = $this->port_model->getPODList();
		//$data['companys'] = $this->company_model->getList();
		$data['shipments'] = $this->shipment_model->getList(true);
		//$data['contracts'] = $this->contract_model->getList(true);


		$data['container_types'] = $this->container_model->getList();

		$data['skipComparative'] = ($requestDetails->delivery_term_id == 1 && $requestDetails->transaction == 'Export') || (in_array($requestDetails->delivery_term_id, ['5', '6', '7']) && $requestDetails->transaction == 'Import');
		if ($data['skipComparative']) {
			$data['rfc_charges'] = array();
			$data['rfc_other_charges'] = array();
			$data['other_charges'] = array();
			$data['other_charges_value_arr'] = array();
		} else {
			$data['rfc_charges'] = $this->freight_model->getRfcChargesCategory($requestDetails, $request_id, $this->seller_session_data['company_id']);
			$data['rfc_other_charges'] = $this->freight_model->getRfcOtherCharges($request_id, $this->seller_session_data['company_id']);
			$data['other_charges'] = $this->freight_model->getOtherCharges($requestDetails);
			$data['other_charges_value_arr'] = $this->freight_model->getOtherChargesValues($requestDetails, $this->seller_session_data['company_id'], $requestDetails->shipment_id);
		}
		$data['particulars'] = $this->freight_model->getParticularList($request_id, $this->seller_session_data['company_id']);
		//		$data['rfc_charges'] = $this->freight_model->getRfcCharges($requestDetails->delivery_term_id,$request_id,$this->seller_session_data['id']);
		//        vdebug($data['other_charges_value_arr']);sssss
		$data['page'] = 'frontend/freightforwarder/edit_request_details';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		
		$this->load->view('frontend/layout_main', $data);
	}

	public function sellerCompanyDetails($company_id)
	{


		$data['companyDetails'] = $this->seller_model->getFFcompanyDetails($company_id);

		$kycDocuments[] = ["type" => "5", "documnetName" => "GST-Goods and Service Tax", "is_mandatory" => true, "details" => array()];
		$kycDocuments[] = ["type" => "1", "documnetName" => "PAN", "is_mandatory" => true, "details" => array()];
		$kycDocuments[] = ["type" => "2", "documnetName" => "COI/Proprietorship/LLP", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "4", "documnetName" => "IEC-Import Export Code", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "6", "documnetName" => "LUT-Leter of Undertaking", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "9", "documnetName" => "Old Shipping Bill", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "11", "documnetName" => "Old Bill of Entry", "is_mandatory" => false, "details" => array()];
		foreach ($kycDocuments as $key => $doc) {
			$kycDocuments[$key]['details'] = $this->seller_model->getUserKYC($company_id, $doc['type']);
		}
		$data['companyDetails']->kyc_documents = $kycDocuments;


		$data['page'] = 'frontend/freightforwarder/fs_company_details';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function view_request_details($request_id)
	{

		$seller_session_data = $this->session->userdata('seller_logged_in');

		is_ff_kyc_approved(); //check user kyc is approved or not

		$requestDetails = $this->freight_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);

		if (!$requestDetails) {
			$this->session->set_flashdata('error', 'RFC details not found.');
			redirect(base_url('ff-request-list'));
		}
		if ($this->input->post()) {
			//                     vdebug($_POST);
			$submit = $this->input->post('actionType');





			//update ff comment
			$this->freight_model->updateQuoteStatus($request_id, $this->seller_session_data['company_id'], ['comment' => $this->input->post('comment')]);

			if ($submit == 'Accept') {
				$this->freight_model->updateQuoteStatus($request_id, $this->seller_session_data['company_id'], ['quote_status' => '5', 'accepted_dt' => date('Y-m-d H:i:s')]);
				$this->freight_model->updateShipmentStatus($request_id, ['status' => '5']);
				$this->session->set_flashdata('success', 'Shipment accepted successfully.');

				$fs_details = $this->seller_model->getFS_DetailsByCompanyId($requestDetails->fs_company_id);
				$fs_name = $fs_details->salutation . ' ' . $fs_details->firstname . ' ' . $fs_details->lastname;
				$url = base_url('view-quote/' . $request_id . '/' . $this->seller_session_data['company_id']);
				$url = "<a href='$url' target='_blank'>$url</a>";
				sendEmail_quoteSendToSeller($fs_details->email, $fs_name, $url, $request_id, $this->input->post('comment'));

				redirect(base_url('ff-booking-list'));
			} else if ($submit == 'Reject') {
				$this->freight_model->updateQuoteStatus($request_id, $this->seller_session_data['company_id'], ['quote_status' => '6', 'rejected_dt' => date('Y-m-d H:i:s')]);
				$this->freight_model->updateShipmentStatus($request_id, ['status' => '8']);

				$this->session->set_flashdata('success', 'Shipment rejected successfully.');

				$fs_details = $this->seller_model->getFS_DetailsByCompanyId($requestDetails->fs_company_id);
				$fs_name = $fs_details->salutation . ' ' . $fs_details->firstname . ' ' . $fs_details->lastname;
				$url = base_url('view-quote/' . $request_id . '/' . $this->seller_session_data['company_id']);
				$url = "<a href='$url' target='_blank'>$url</a>";
				sendEmail_quoteSendToSeller($fs_details->email, $fs_name, $url, $request_id, $this->input->post('comment'));
			} else {
				$this->session->set_flashdata('success', 'Something went wrong.');
			}

			//update total quote Amount
			//                    $this->freight_model->updateTotalQuoteAmount($request_id,$this->seller_session_data['company_id'],$this->input->post('total_quote_amount'));


			redirect(base_url('ff-request-list'));
		}

		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$data['requestDetails'] = $requestDetails;

		$data['fs_details'] = $this->seller_model->getSellerDetails($requestDetails->user_id);
		//                vdebug($requestDetails);
		$data['messages'] = $this->communication_model->getRecord([$requestDetails->user_id, $this->seller_session_data['company_id']], $request_id);
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$data['compData'] = $this->seller_model->getCompanyData();
		$data['delivery_terms'] = $this->deliver_term_model->getList();
		$data['doc_verified'] = $this->seller_model->documentVerified($seller_session_data['id']);
		$data['modes'] = $this->mode_model->getList();
		//		$data['pol'] = $this->port_model->getPOLList();
		//		$data['pod'] = $this->port_model->getPODList();
		$data['companys'] = $this->company_model->getList();
		$data['shipments'] = $this->shipment_model->getList(true);
		$data['contracts'] = $this->contract_model->getList(true);
		$data['skipComparative'] = ($requestDetails->delivery_term_id == 1 && $requestDetails->transaction == 'Export') || (in_array($requestDetails->delivery_term_id, ['5', '6', '7']) && $requestDetails->transaction == 'Import');
		if ($data['skipComparative']) {
			$data['rfc_charges'] = array();
			$data['rfc_other_charges'] = array();
			$data['other_charges'] = array();
			$data['other_charges_value_arr'] = array();
		} else {
			$data['rfc_charges'] = $this->freight_model->getRfcChargesCategory($requestDetails, $request_id, $this->seller_session_data['company_id']);
			$data['rfc_other_charges'] = $this->freight_model->getRfcOtherCharges($request_id, $this->seller_session_data['company_id']);
			$data['other_charges'] = $this->freight_model->getOtherCharges($requestDetails);
			$data['other_charges_value_arr'] = $this->freight_model->getOtherChargesValues($requestDetails, $this->seller_session_data['company_id'], $requestDetails->shipment_id);
		}
		$data['particulars'] = $this->freight_model->getParticularList($request_id, $this->seller_session_data['company_id']);
		$data['container_types'] = $this->container_model->getList();
		$data['page'] = 'frontend/freightforwarder/view_request_details';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		// vdebug($data['rfc_charges']);
		$this->load->view('frontend/layout_main', $data);
	}


	public function booking_list()
	{

		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "booking-list";
		$data['booking_list'] = []; //$this->freight_model->getBookingList($this->seller_session_data['company_id']);

		$data['page'] = 'frontend/freightforwarder/booking_list';

		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function ajaxBookingList()
	{

		$company_id = $this->seller_session_data['company_id'];
		$searchKey = $_POST['search'];
		$columns = $_POST['columns'];
		$order = $_POST['order'];

		$orderBy = $columns[$order[0]['column']]['data'] . ' ' . $order[0]['dir'];

		$iSearch = [];

		if (!empty($searchKey['value'])) {
			foreach ($columns as $row) {
				if (!empty($row['data']) && $row['searchable'] == 'true') {

					if ($row['data'] == 'mode') {
						$row['data'] = 'tbl_mode.type';
					}
					if($row['data'] =='request_id'){
						$row['data'] ='tbl_seller_requirement.id';
					}
					if ($row['data'] == 'delivery_term_name') {
						$row['data'] = 'tbl_deliver_term.name';
					}
					if ($row['data'] == 'shipment') {
						$row['data'] = 'tbl_shipment.type';
					}
					if ($row['data'] == 'quote_status_title') {
						$row['data'] = 't5.title';
					}
					if ($row['data'] == 'quote_status_title') {
						$row['data'] = 't5.title';
					}
					if ($row['data'] == 'status_title') {
						$row['data'] = 'tbl_field_shipment_status.title';
					}
					$iSearch[] = " " . $row['data'] . " LIKE '%" . $searchKey['value'] . "%' ";
				}
			}
		}
		$iSearch_str = implode(' OR ', $iSearch);

		$filter = [];
		if (isset($_POST['filter'])) {
			$filter = $_POST['filter'];
		}


		//ff
		$filter['quote_status'] = ['5', '9'];
		$filter['role'] = '3';


		echo json_encode($this->freight_model->get_rfc_list($company_id, $_POST['start'], $_POST['length'], $filter, $iSearch_str, $orderBy));
		die;
	}

	public function track_shipment($request_id)
	{

		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "booking-list";
		$requestDetails = $this->freight_model->getBookingDetails($request_id, $this->seller_session_data['company_id']);
		if (empty($requestDetails)) {
			$this->session->set_flashdata('error', 'Shipment details not found.');
			redirect(base_url('ff-booking-list'));
		}
		$transctn = $requestDetails->transaction;
		$steps = $this->seller_model->getSPSteps($requestDetails->transaction, $requestDetails->mode_id, $requestDetails->shipment_id, $requestDetails->delivery_term_id);

		$shipmentProcessData = $this->seller_model->getShipmentProcessData($transctn, $request_id);

		// For step show start
		$completedStep = $this->seller_model->getCompletedStep($transctn, $request_id);
		$currentStep = $this->seller_model->getCurrentTrackStep($transctn, $request_id);
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
		array_push($completedStepID, $currentStep->step_id);
		$data['currentStep'] = $currentStep;
		$data['completedStep'] = $completedStepID;
		// For step show End

		$data['bookedShipment'] = $requestDetails;
		$data['fs_details'] = $this->seller_model->getFS_DetailsByCompanyId($requestDetails->fs_company_id);
		$data['stepData'] = $steps;
		$data['shipmentProcessData'] = $shipmentProcessData;
		if ($transctn === "Export") {
			$data['page'] = 'frontend/freightforwarder/track_shipment_export';
		} else {
			$data['page'] = 'frontend/freightforwarder/track_shipment_import';
		}
		$data['skipComparative'] = ($data['bookedShipment']->delivery_term_id == 1 && $data['bookedShipment']->transaction == 'Export') || (in_array($data['bookedShipment']->delivery_term_id, ['5', '6', '7']) && $data['bookedShipment']->transaction == 'Import');
		//                vdebug($data);
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function upload_export_process_documents()
	{


		$request_id = $this->input->post('request_id');
		//$book_id = $this->input->post('book_id');
		$requestDetails = $this->freight_model->getBookingDetails($request_id, $this->seller_session_data['company_id']);
		$skipComparative = ($requestDetails->delivery_term_id == 1 && $requestDetails->transaction == 'Export') || (in_array($requestDetails->delivery_term_id, ['5', '6', '7']) && $requestDetails->transaction == 'Import');

		$ff_details = $this->seller_model->getFF_DetailsByCompanyId($requestDetails->selected_ff_company_id);
		$fs_details = $this->seller_model->getFS_DetailsByCompanyId($requestDetails->fs_company_id);
		$ff_name = $ff_details->salutation . ' ' . $ff_details->firstname . ' ' . $ff_details->lastname;
		$url = base_url('ff-track-shipment/' . $request_id);
		$url = "<a href='$url' target='_blank'>$url</a>";


		$ff_email = $ff_details->email;
		$buyer_email = $requestDetails->consignor_email;
		$seller_email = $fs_details->email;

		$step = array_search("Submit", $this->input->post());
		$documents = array();
		$allowed_file_types = 'bmp|jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';

		switch ($step) {

			case "step1_export":

				$step_id = $this->input->post('step_id');
				$step1_export_correction_ff = $this->input->post('step1_export_correction_ff');

				$step1_export_status = $this->input->post('step1_export_status');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step1_export_status;
				$dataStep1['corrections'] = $step1_export_correction_ff;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);


						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			case "step2_export":

				//echo '<pre>'; print_r($_FILES);
				//echo '<pre>'; print_r($this->input->post());die;
				$step_id = $this->input->post('step2_export_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);

				$step2_export_SB_number = $this->input->post('step2_export_SB_number');
				$step2_export_SB_date = $this->input->post('step2_export_SB_date');

				if (!empty($_FILES['sb_checklist_ff']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step2_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['sb_checklist_ff']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('sb_checklist_ff')) {
						$uploadData = $this->upload->data();
						$sb_checklist_ff = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['Shipping_bill_checklist'] = $sb_checklist_ff;
				}

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}

				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');


				if ($stepdata->status == 2) {

					$dataStep1['status'] = 3;
				} else if ($stepdata->status == 1) {

					$dataStep1['status'] = 1;
				} else {

					$dataStep1['status'] = 2;
				}

				//$this->seller_model->updateBookShipment($bkdata, $request_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			case "step3_export":

				$step_id = $this->input->post('step3_export_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);

				$step3_export_act_date = $this->input->post('step3_export_act_date');
				//$actndate = explode(' ',$step3_export_act_date);
				$step3_export_status = $this->input->post('step3_export_status');
				$step3_export_details = $this->input->post('step3_export_details');

				$step3_export_SB_number = $this->input->post('step3_export_SB_number');
				$step3_export_SB_date = $this->input->post('step3_export_SB_date');

				$step3_export_dbk_amount = $this->input->post('step3_export_dbk_amount');
				$step3_export_meis_rate = $this->input->post('step3_export_meis_rate');
				$step3_export_fob_value = $this->input->post('step3_export_fob_value');
				$step3_export_meis_amount = $this->input->post('step3_export_meis_amount');
				$step3_export_under_schment = $this->input->post('step3_export_under_schment');
				$import_u_s_l_no = $this->input->post('import_u_s_l_no');



				if (!empty($_FILES['final_sb_checklist_ff']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step3_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['final_sb_checklist_ff']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('final_sb_checklist_ff')) {
						$uploadData = $this->upload->data();
						$sb_checklist_ff = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['Final_shipping_bill'] = $sb_checklist_ff;
				}

				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step3_export_status;
				$dataStep1['action_date'] = $step3_export_act_date ? getMysqlDateFormat($step3_export_act_date) : date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');
				$dataStep1['corrections'] = $step3_export_details;

				if (!empty($step3_export_SB_number)) {
					$bkdata['shipping_bill_number'] = $step3_export_SB_number;
				}
				if (!empty($step3_export_SB_date)) {
					$bkdata['shipping_bill_date'] = getMysqlDateFormat($step3_export_SB_date);
				}

				$bkdata['DBK_amount'] = $step3_export_dbk_amount;
				$bkdata['fob_value'] = $step3_export_fob_value;
				$bkdata['MEIS_rate'] = $step3_export_meis_rate;
				$bkdata['MEIS_amount'] = $step3_export_meis_amount;
				$bkdata['import_under_schment'] = $step3_export_under_schment;
				$bkdata['import_u_s_l_no'] = $import_u_s_l_no;

				$this->seller_model->updateBookShipment($bkdata, $request_id);


				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email);
						//								$documents = array(); 
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);


					if ($insert_id) {

						$to = array($seller_email, $ff_email);
						//								$documents = array(); 
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			case "step4_export":

				$step_id = $this->input->post('step4_export_step_id');

				$step4_export_act_date = $this->input->post('step4_export_act_date');
				$step4_export_status = $this->input->post('step4_export_status');
				$step4_export_details = $this->input->post('step4_export_details');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step4_export_status;
				$dataStep1['action_date'] =  getMysqlDateFormat($step4_export_act_date);
				$dataStep1['time'] = date('H:i:s');
				$dataStep1['corrections'] = $step4_export_details;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			case "step5_export":

				$step_id = $this->input->post('step5_export_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);



				if (!empty($_FILES['Bill_of_lading']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step5_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['Bill_of_lading']['name'];
					$config['overwrite'] = TRUE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('Bill_of_lading')) {
						$uploadData = $this->upload->data();
						$Bill_of_lading = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['Bill_of_lading'] = $Bill_of_lading;
				}


				if (!empty($_FILES['vgm_document']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step5_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['vgm_document']['name'];
					$config['overwrite'] = TRUE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('vgm_document')) {
						$uploadData = $this->upload->data();
						$vgm_document = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['vgm_document'] = $vgm_document;
				}

				$dataStep1['status'] = 2;
				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}
				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');

				//                                                if(!empty($step5_export_bol_number)){
				//                                                    $bkdata['bill_of_lading_number'] = $step5_export_bol_number;
				//                                                }
				//						
				//                                                if(!empty($step5_export_bol_date)){
				//                                                    $bkdata['bill_of_lading_date'] = getMysqlDateFormat($step5_export_bol_date);
				//                                                }


				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				//						$this->seller_model->updateBookShipment($bkdata,$request_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}

				break;
			case "step6_export":

				$step_id = $this->input->post('step6_export_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);

				$step6_export_bol_number = $this->input->post('step6_export_bol_number');
				$step6_export_bol_date = $this->input->post('step6_export_bol_date');
				$step6_export_etd_date = $this->input->post('step6_export_etd_date');
				$step6_export_eta_date = $this->input->post('step6_export_eta_date');
				$step6_export_lov_date = $this->input->post('step6_export_lov_date');
				$actndate = explode(' ', $step6_export_lov_date);
				$step6_export_status = $this->input->post('step6_export_status');
				$step6_export_details = $this->input->post('step6_export_details');

				if (!empty($_FILES['Final_Bill_of_lading']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step6_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['Final_Bill_of_lading']['name'];
					$config['overwrite'] = TRUE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('Final_Bill_of_lading')) {
						$uploadData = $this->upload->data();
						$Final_Bill_of_lading = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['Final_Bill_of_lading'] = $Final_Bill_of_lading;
				}

				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}
				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step6_export_status;
				$dataStep1['action_date'] = getMysqlDateFormat($step6_export_lov_date);
				$dataStep1['time'] = date('H:i:s');
				$dataStep1['corrections'] = $step6_export_details;

				$bkdata['ETD'] = getMysqlDateFormat($step6_export_etd_date);
				$bkdata['ETA'] = getMysqlDateFormat($step6_export_eta_date);

				if (!empty($step6_export_bol_number)) {
					$bkdata['bill_of_lading_number'] = $step6_export_bol_number;
				}

				if (!empty($step6_export_bol_date)) {
					$bkdata['bill_of_lading_date'] = getMysqlDateFormat($step6_export_bol_date);
				}

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$this->seller_model->updateBookShipment($bkdata, $request_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email, $buyer_email);

						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email, $buyer_email);
						//								$documents = array(); 
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			case "step8_export":

				$step_id = $this->input->post('step8_export_step_id');

				$step8_export_rdp_date = $this->input->post('step8_export_rdp_date');
				$actndate = explode(' ', $step8_export_rdp_date);
				$step8_export_status = $this->input->post('step8_export_status');
				$step8_export_details = $this->input->post('step8_export_details');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step8_export_status;
				$dataStep1['action_date'] = getMysqlDateFormat($step8_export_rdp_date);
				$dataStep1['time'] = date('H:i:s', strtotime($actndate[1]));
				$dataStep1['corrections'] = $step8_export_details;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			case "step9_export":

				$step_id = $this->input->post('step9_export_step_id');

				$step9_export_ccd_date = $this->input->post('step9_export_ccd_date');
				$actndate = explode(' ', $step9_export_ccd_date);
				$step9_export_status = $this->input->post('step9_export_status');
				$step9_export_details = $this->input->post('step9_export_details');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step9_export_status;
				$dataStep1['action_date'] = getMysqlDateFormat($step9_export_ccd_date);
				$dataStep1['time'] = date('H:i:s');
				$dataStep1['corrections'] = $step9_export_details;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			case "step10_export":

				$step_id = $this->input->post('step10_export_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);


				$step10_export_delivery_date = $this->input->post('step10_export_delivery_date');

				$step10_export_status = $this->input->post('step10_export_status');

				$actndate = explode(' ', $step10_export_delivery_date);

				if (!empty($_FILES['invoice_confirm']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step12_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['invoice_confirm']['name'];
					$config['overwrite'] = TRUE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('invoice_confirm')) {
						$uploadData = $this->upload->data();
						$invoice_confirm = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$invoice_confirm = '';
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['invoice_confirm'] = $invoice_confirm;
				}

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['documents'] = json_encode($documents);
				$dataStep1['action_date'] = getMysqlDateFormat($step10_export_delivery_date);
				$dataStep1['time'] = date('H:i:s');

				$step10_export_invoice_amount = $this->input->post('step10_export_invoice_amount');
				$step10_export_invoice_number = $this->input->post('step10_export_invoice_number');
				$step10_export_invoice_date = $this->input->post('step10_export_invoice_date');
				$step10_export_payment_due_date = $this->input->post('step10_export_payment_due_date');

				$courier_doc_no = $this->input->post('courier_doc_no');
				$courier_date = $this->input->post('courier_date');
				$courier_company = $this->input->post('courier_company');

				if (!empty($step10_export_invoice_amount)) {
					$bkdata['Invoice_amount'] = $step10_export_invoice_amount;
				}
				if (!empty($step10_export_invoice_number)) {
					$bkdata['invoice_number'] = $step10_export_invoice_number;
				}

				if (!empty($step10_export_invoice_date)) {
					$bkdata['invoice_date'] = getMysqlDateFormat($step10_export_invoice_date);
				}
				if (!empty($step10_export_payment_due_date)) {
					$bkdata['payment_due_date'] = getMysqlDateFormat($step10_export_payment_due_date);
				}
				if (!empty($courier_date)) {
					$bkdata['courier_date'] = getMysqlDateFormat($courier_date);
				}
				if (!empty($courier_doc_no)) {
					$bkdata['courier_doc_no'] = $courier_doc_no;
				}
				if (!empty($courier_company)) {
					$bkdata['courier_company'] = $courier_company;
				}
				if (!empty($bkdata)) {
					$this->seller_model->updateBookShipment($bkdata, $request_id);
				}

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($step10_export_status) {

					$dataStep1['status'] = 1;
				} else {
					$dataStep1['status'] = 2;
				}

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						if ($skipComparative) {
							//shipment process completed
							$this->freight_model->updateQuoteStatus($request_id, $this->seller_session_data['company_id'], ['quote_status' => '9', 'updated_at' => date('Y-m-d H:i:s')]);
						}
						$to = array($seller_email, $ff_email, $buyer_email);
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}

				break;
			case "step11_export":

				$step_id = $this->input->post('step11_export_step_id');

				$step11_export_bill_amnt_received = $this->input->post('step11_export_bill_amnt_received');
				//						$actndate = explode(' ',$step11_export_erbc_date);



				$step11_export_bill_amount = $this->input->post('step11_export_bill_amount');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = 1;
				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s', strtotime($actndate[1]));
				$dataStep1['corrections'] = '';


				//						$bkdata['Invoice_amount'] = $step11_export_invoice_amount;
				//						
				if (!empty($step11_export_bill_amnt_received)) {
					$bkdata['bill_amount_received'] = $step11_export_bill_amnt_received ? 1 : 0;
				}


				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$this->seller_model->updateBookShipment($bkdata, $request_id);

				$this->freight_model->updateQuoteStatus($request_id, $this->seller_session_data['company_id'], ['quote_status' => '9', 'updated_at' => date('Y-m-d H:i:s')]);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			default:
				redirect(base_url('ff-track-shipment/' . $request_id));
		}
	}

	public function upload_import_process_documents()
	{


		$request_id = $this->input->post('request_id');

		$requestDetails = $this->freight_model->getBookingDetails($request_id, $this->seller_session_data['company_id']);

		$ff_details = $this->seller_model->getFF_DetailsByCompanyId($requestDetails->selected_ff_company_id);
		$fs_details = $this->seller_model->getFS_DetailsByCompanyId($requestDetails->fs_company_id);
		$ff_name = $ff_details->salutation . ' ' . $ff_details->firstname . ' ' . $ff_details->lastname;
		$url = base_url('ff-track-shipment/' . $request_id);
		$url = "<a href='$url' target='_blank'>$url</a>";


		$ff_email = $ff_details->email;
		$buyer_email = $requestDetails->consignor_email;
		$seller_email = $fs_details->email;

		$step = array_search("Submit", $this->input->post());

		$documents = array();
		$allowed_file_types = 'bmp|jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';
		//print_r($_FILES);
		//print_r($this->input->post());die;

		switch ($step) {

			case "step1_import":
				$step_id = $this->input->post('step_id');
				$step1_import_correction_ff = $this->input->post('step1_import_correction_ff');

				$step1_import_status = $this->input->post('step1_import_status');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step1_import_status;
				$dataStep1['corrections'] = $step1_import_correction_ff;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);


				$bkdata['vehicle_details'] = $this->input->post('vehicle_details');
				$bkdata['driver_contact_details'] = $this->input->post('driver_contact_details');
				$this->seller_model->updateBookShipment($bkdata, $request_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			case "step2_import":

				$step_id = $this->input->post('step2_import_step_id');
				// $documents = null;
				// if (!empty($_FILES['sb_checklist_ff']['name'])) {

				// 	$uploadfilepath = 'uploads/rfc-' . $request_id . '/step2_document/';

				// 	if (!file_exists($uploadfilepath)) {
				// 		mkdir($uploadfilepath, 0777, true);
				// 	}

				// 	$config['upload_path'] = $uploadfilepath;
				// 	$config['file_name'] = $_FILES['sb_checklist_ff']['name'];
				// 	$config['overwrite'] = TRUE;
				// 	$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';

				// 	$this->load->library('upload', $config);

				// 	$this->upload->initialize($config);
				// 	$sb_checklist_ff = '';
				// 	if ($this->upload->do_upload('sb_checklist_ff')) {
				// 		$uploadData = $this->upload->data();
				// 		$sb_checklist_ff = base_url($uploadfilepath . $uploadData['file_name']);
				// 	} else {

				// 		$this->session->set_flashdata('error', 'Error in document upload.');
				// 		redirect(base_url('ff-track-shipment/' . $request_id));
				// 	}

				// 	$documents['Shipping_bill_checklist'] = $sb_checklist_ff;
				// }

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}

				$dataStep1['action_date'] = getMysqlDateFormat($this->input->post('shipment_lifted_date'));
				$dataStep1['time'] = date('H:i:s');
				$dataStep1['corrections'] = $this->input->post('step2_import_details');
				$dataStep1['status'] = 1;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				//						if($stepdata->status == 2){
				//							
				//							$dataStep1['status'] = 3;
				//						
				//						}else if($stepdata->status == 1){
				//							
				//							$dataStep1['status'] = 1;
				//						
				//						}else{
				//							
				//							$dataStep1['status'] = 2;
				//						}

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			case "step3_import":

				$step_id = $this->input->post('step3_import_step_id');

				$step3_import_act_date = $this->input->post('step3_import_act_date');
				//$step3_import_act_date = str_replace('/', '-', $step3_import_act_date);
				//$actndate = explode(' ',$step3_import_act_date);
				$step3_import_status = $this->input->post('step3_import_status');
				$step3_import_details = $this->input->post('step3_import_details');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step3_import_status;
				$dataStep1['action_date'] = getMysqlDateFormat($step3_import_act_date);
				$dataStep1['time'] = date('H:i:s');
				$dataStep1['corrections'] = $step3_import_details;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;

			case "step4_import":

				$step_id = $this->input->post('step4_import_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);
				if (!empty($_FILES['Bill_of_lading']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step4_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['Bill_of_lading']['name'];
					$config['overwrite'] = TRUE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);
					$Bill_of_lading = '';
					if ($this->upload->do_upload('Bill_of_lading')) {
						$uploadData = $this->upload->data();
						$Bill_of_lading = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['Bill_of_lading'] = $Bill_of_lading;
				}

				$dataStep1['status'] = 2;
				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}

				$dataStep1['action_date'] = getMysqlDateFormat($this->input->post('custome_cleared_date'));
				$dataStep1['time'] = date('H:i:s');

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}

				break;
				//		case "step6_import":
				//			
				//						$step_id = $this->input->post('step_id_6');
				//						
				//						$step6_import_etd_date = $this->input->post('step6_import_etd_date');
				//                                                //$step6_import_etd_date  = str_replace('/', '-', $step6_import_etd_date);
				//						//$actndate = explode(' ',$step6_import_etd_date);
				//						$step6_import_status = $this->input->post('step6_import_status');
				//						$step6_import_details = $this->input->post('step6_import_details');
				//						
				//						$dataStep1['request_id'] = $request_id;
				//						$dataStep1['step_id'] = $step_id;
				//						$dataStep1['status'] = $step6_import_status;
				//						$dataStep1['action_date'] = getMysqlDateFormat($step6_import_etd_date);
				//						$dataStep1['time'] = date('H:i:s');
				//						$dataStep1['corrections'] = $step6_import_details;
				//						
				//						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id,$step_id);
				//						
				//						if($stepdata){
				//							
				//							if($this->seller_model->updateStepProcessData($dataStep1,$request_id,$step_id)){
				//                                                            $to = array($seller_email,$ff_email);
				//								$this->sendTrackingMail($to,$documents,'Import',$request_id,$step_id);
				//								$this->session->set_flashdata('success','Updated successfully');
				//								redirect(base_url('ff-track-shipment/'.$request_id));
				//							}else{
				//								$this->session->set_flashdata('error','Something went wrong');
				//								redirect(base_url('ff-track-shipment/'.$request_id));
				//							}
				//							
				//						}else{
				//							
				//							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
				//							
				//							if($insert_id){
				//                                                            $to = array($seller_email,$ff_email);
				//								$this->sendTrackingMail($to,$documents,'Import',$request_id,$step_id);
				//								$this->session->set_flashdata('success','Updated successfully');
				//								redirect(base_url('ff-track-shipment/'.$request_id));
				//							}else{
				//								$this->session->set_flashdata('error','Something went wrong');
				//								redirect(base_url('ff-track-shipment/'.$request_id));
				//							}
				//						}
				//				break;
			case "step5_import":

				$step_id = $this->input->post('step5_import_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);

				$step5_import_lov_date = $this->input->post('step5_import_lov_date');

				$step5_import_bol_number = $this->input->post('step5_import_bol_number');
				$step5_import_bol_date = $this->input->post('step5_import_bol_date');
				$step5_import_etd_date = $this->input->post('step5_import_etd_date');
				$step5_import_eta_date = $this->input->post('step5_import_eta_date');
				$loading_confirm_date = $this->input->post('loading_confirm_date');
				// $step5_import_lov_date = str_replace('/', '-', $step5_import_lov_date);
				//$actndate = explode(' ',$step5_import_lov_date);
				$step5_import_status = $this->input->post('step5_import_status');
				$step5_import_details = $this->input->post('step5_import_details');

				if (!empty($_FILES['Final_Bill_of_lading']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step5_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['Final_Bill_of_lading']['name'];
					$config['overwrite'] = TRUE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);
					$Final_Bill_of_lading = '';
					if ($this->upload->do_upload('Final_Bill_of_lading')) {
						$uploadData = $this->upload->data();
						$Final_Bill_of_lading = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['final_billl_of_lading'] = $Final_Bill_of_lading;
				}

				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step5_import_status;
				$dataStep1['action_date'] = getMysqlDateFormat($step5_import_lov_date);
				$dataStep1['time'] = date('H:i:s');
				$dataStep1['corrections'] = $step5_import_details;

				$bkdata['ETD'] = getMysqlDateFormat($step5_import_etd_date);
				$bkdata['ETA'] = getMysqlDateFormat($step5_import_eta_date);
				$bkdata['loading_confirm_date'] = getMysqlDateFormat($loading_confirm_date);

				if (!empty($step5_import_bol_number)) {
					$bkdata['bill_of_lading_number'] = $step5_import_bol_number;
				}

				if (!empty($step5_import_bol_date)) {
					$bkdata['bill_of_lading_date'] = getMysqlDateFormat($step5_import_bol_date);
				}

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$this->seller_model->updateBookShipment($bkdata, $request_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			case "step6_import":

				$step_id = $this->input->post('step6_import_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);

				if (!empty($_FILES['bill_of_entry']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step6_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['bill_of_entry']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);
					$sb_checklist_ff = '';
					if ($this->upload->do_upload('bill_of_entry')) {
						$uploadData = $this->upload->data();
						$sb_checklist_ff = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['bill_of_entry'] = $sb_checklist_ff;
				}



				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}

				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');

				// $bkdata['import_duty_paid'] = $this->input->post('import_duty_paid');
				//regular
				$bkdata['boe_type'] = $this->input->post('boe_type');
				$bkdata['import_duty_amount'] = $this->input->post('step6_import_duty_amount');
				$bkdata['custom_bank_details'] = $this->input->post('step6_custom_bank_details');
				$bkdata['bill_of_entry_no'] = $this->input->post('step6_bill_of_entry_no');
				$bkdata['import_under_schment'] = $this->input->post('step6_import_under_schment');
				$bkdata['bill_of_entry_date'] = getMysqlDateFormat($this->input->post('step6_bill_of_entry_date'));

				$this->seller_model->updateBookShipment($bkdata, $request_id);

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$dataStep1['status'] = 2;

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}

				break;

			case "step6_import_inbond":

				$step_id = $this->input->post('step6_import_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);



				if (!empty($_FILES['bill_of_entry_inbond']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step6_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['bill_of_entry_inbond']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);
					$sb_checklist_ff = '';
					if ($this->upload->do_upload('bill_of_entry_inbond')) {
						$uploadData = $this->upload->data();
						$sb_checklist_ff = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['bill_of_entry_inbond'] = $sb_checklist_ff;
				}



				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}

				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');


				//inbond
				$bkdata['boe_type'] = $this->input->post('boe_type');
				$bkdata['import_duty_amount_inbond'] = $this->input->post('step6_import_duty_amount_inbond');
				$bkdata['custom_bank_details_inbond'] = $this->input->post('step6_custom_bank_details_inbond');
				$bkdata['bill_of_entry_no_inbond'] = $this->input->post('step6_bill_of_entry_no_inbond');
				$bkdata['import_under_schment_inbond'] = $this->input->post('step6_import_under_schment_inbond');
				$bkdata['bill_of_entry_date_inbond'] = getMysqlDateFormat($this->input->post('step6_bill_of_entry_date_inbond'));


				$this->seller_model->updateBookShipment($bkdata, $request_id);

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$dataStep1['status'] = 2;

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}

				break;

			case "step6_import_exbond":

				$step_id = $this->input->post('step6_import_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);

				if (!empty($_FILES['bill_of_entry_exbond']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step6_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['bill_of_entry_exbond']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);
					$sb_checklist_ff = '';
					if ($this->upload->do_upload('bill_of_entry_exbond')) {
						$uploadData = $this->upload->data();
						$sb_checklist_ff = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['bill_of_entry_exbond'] = $sb_checklist_ff;
				}

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}

				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');


				//exbond
				$bkdata['boe_type'] = $this->input->post('boe_type');
				$bkdata['import_duty_amount_exbond'] = $this->input->post('step6_import_duty_amount_exbond');
				$bkdata['custom_bank_details_exbond'] = $this->input->post('step6_custom_bank_details_exbond');
				$bkdata['bill_of_entry_no_exbond'] = $this->input->post('step6_bill_of_entry_no_exbond');
				$bkdata['import_under_schment_exbond'] = $this->input->post('step6_import_under_schment_exbond');
				$bkdata['bill_of_entry_date_exbond'] = getMysqlDateFormat($this->input->post('step6_bill_of_entry_date_exbond'));


				$this->seller_model->updateBookShipment($bkdata, $request_id);

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$dataStep1['status'] = 2;

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}

				break;

			case "step7_import":

				$step_id = $this->input->post('step7_import_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);

				$step7_import_ccd_date = $this->input->post('step7_import_ccd_date');
				//                                                $step7_import_ccd_date = str_replace('/', '-', $step7_import_ccd_date);
				//						$actndate = explode(' ',$step7_import_ccd_date);
				$step7_import_details = $this->input->post('step7_import_details');
				$step7_import_status = $this->input->post('step7_import_status');

				$documents = array();
				if (!empty($_FILES['final_bill_of_entry']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step7_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['final_bill_of_entry']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);
					$sb_checklist_ff = '';
					if ($this->upload->do_upload('final_bill_of_entry')) {
						$uploadData = $this->upload->data();
						$sb_checklist_ff = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['final_bill_of_entry'] = $sb_checklist_ff;
				}

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}
				$dataStep1['status'] = 2;
				$dataStep1['action_date'] = getMysqlDateFormat($step7_import_ccd_date);
				$dataStep1['time'] = date('H:i:s');
				$dataStep1['corrections'] = $step7_import_details;

				$bkdata['boe_type'] = $this->input->post('step7_import_boe_type');
				$bkdata['import_u_s_l_no'] = $this->input->post('import_u_s_l_no');
				$bkdata['import_duty_amount'] = $this->input->post('import_duty_amount');
				$bkdata['bill_of_entry_no'] = $this->input->post('bill_of_entry_no');
				$bkdata['import_under_schment'] = $this->input->post('import_under_schment');
				$bkdata['bill_of_entry_date'] = getMysqlDateFormat($this->input->post('bill_of_entry_date'));
				$this->seller_model->updateBookShipment($bkdata, $request_id);


				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);


				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;


			case "step7_import_inbond":

				$step_id = $this->input->post('step7_import_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);



				if (!empty($_FILES['step7_import_bill_of_entry_inbond']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step7_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['step7_import_bill_of_entry_inbond']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);
					$sb_checklist_ff = '';
					if ($this->upload->do_upload('step7_import_bill_of_entry_inbond')) {
						$uploadData = $this->upload->data();
						$sb_checklist_ff = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['bill_of_entry_inbond'] = $sb_checklist_ff;
				}



				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}

				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');


				//inbond
				$bkdata['boe_type'] = $this->input->post('step7_import_boe_type');
				$bkdata['import_duty_amount_inbond'] = $this->input->post('step7_import_duty_amount_inbond');
				$bkdata['custom_bank_details_inbond'] = $this->input->post('step7_custom_bank_details_inbond');
				$bkdata['bill_of_entry_no_inbond'] = $this->input->post('step7_bill_of_entry_no_inbond');
				$bkdata['import_under_schment_inbond'] = $this->input->post('step7_import_under_schment_inbond');
				$bkdata['import_u_s_l_no_inbond'] = $this->input->post('import_u_s_l_no_inbond');
				$bkdata['bill_of_entry_date_inbond'] = getMysqlDateFormat($this->input->post('step7_bill_of_entry_date_inbond'));


				$this->seller_model->updateBookShipment($bkdata, $request_id);

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$dataStep1['status'] = 2;

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}

				break;

			case "step7_import_exbond":

				$step_id = $this->input->post('step7_import_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);

				if (!empty($_FILES['step7_import_bill_of_entry_exbond']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step6_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['step7_import_bill_of_entry_exbond']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);
					$sb_checklist_ff = '';
					if ($this->upload->do_upload('step7_import_bill_of_entry_exbond')) {
						$uploadData = $this->upload->data();
						$sb_checklist_ff = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['bill_of_entry_exbond'] = $sb_checklist_ff;
				}

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}

				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');


				//exbond
				$bkdata['boe_type'] = $this->input->post('step7_import_boe_type');
				$bkdata['import_duty_amount_exbond'] = $this->input->post('step7_import_duty_amount_exbond');
				$bkdata['custom_bank_details_exbond'] = $this->input->post('step7_custom_bank_details_exbond');
				$bkdata['bill_of_entry_no_exbond'] = $this->input->post('step7_bill_of_entry_no_exbond');
				$bkdata['import_under_schment_exbond'] = $this->input->post('step7_import_under_schment_exbond');
				$bkdata['bill_of_entry_date_exbond'] = getMysqlDateFormat($this->input->post('step7_bill_of_entry_date_exbond'));
				$bkdata['import_u_s_l_no_exbond'] = $this->input->post('import_u_s_l_no_exbond');

				$this->seller_model->updateBookShipment($bkdata, $request_id);

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$dataStep1['status'] = 2;

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}

				break;


			case "step8_import":

				$step_id = $this->input->post('step8_import_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array)json_decode($stepdata->documents);

				$step8_import_status = $this->input->post('step8_import_status');

				$step8_date = $this->input->post('step8_date');
				//						$step12_date = str_replace('/', '-', $step12_date);
				//						$actndate = explode(' ',$step12_date);
				if (!empty($_FILES['invoice_confirm']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step8_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['invoice_confirm']['name'];
					$config['overwrite'] = TRUE;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('invoice_confirm')) {
						$uploadData = $this->upload->data();
						$invoice_confirm = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$invoice_confirm = '';
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}

					$documents['invoice_confirm'] = $invoice_confirm;
				}

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}


				$step8_import_invoice_amount = $this->input->post('step8_import_invoice_amount');
				$step8_import_invoice_number = $this->input->post('step8_import_invoice_number');
				$step8_import_invoice_date = $this->input->post('step8_import_invoice_date');
				$step8_import_payment_due_date = $this->input->post('step8_import_payment_due_date');

				$courier_date = $this->input->post('courier_date');
				$courier_doc_no = $this->input->post('courier_doc_no');
				$courier_company = $this->input->post('courier_company');

				if (!empty($step8_import_invoice_amount)) {
					$bkdata['Invoice_amount'] = $step8_import_invoice_amount;
				}
				if (!empty($step8_import_invoice_number)) {
					$bkdata['invoice_number'] = $step8_import_invoice_number;
				}
				if (!empty($step8_import_invoice_date)) {
					$bkdata['invoice_date'] = getMysqlDateFormat($step8_import_invoice_date);
				}
				if (!empty($step8_import_payment_due_date)) {
					$bkdata['payment_due_date'] = getMysqlDateFormat($step8_import_payment_due_date);
				}
				if (!empty($courier_date)) {
					$bkdata['courier_date'] = getMysqlDateFormat($courier_date);
				}
				if (!empty($courier_doc_no)) {
					$bkdata['courier_doc_no'] = $courier_doc_no;
				}
				if (!empty($courier_company)) {
					$bkdata['courier_company'] = $courier_company;
				}

				if (!empty($bkdata)) {
					$this->seller_model->updateBookShipment($bkdata, $request_id);
				}


				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');


				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($step8_import_status) {

					$dataStep1['status'] = 1;
				} else {
					$dataStep1['status'] = 2;
				}

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong 1');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong 2');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}

				break;
			case 'step9_import':
				$step_id = $this->input->post('step9_import_step_id');

				$step9_export_bill_amnt_received = $this->input->post('step9_import_bill_amnt_received');
				//						$actndate = explode(' ',$step11_export_erbc_date);



				//$step11_export_bill_amount = $this->input->post('step9_export_bill_amount');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = 1;
				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');
				$dataStep1['corrections'] = '';


				//						$bkdata['Invoice_amount'] = $step11_export_invoice_amount;
				//						
				if (!empty($step9_export_bill_amnt_received)) {
					$bkdata['bill_amount_received'] = $step9_export_bill_amnt_received ? 1 : 0;
				}


				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$this->seller_model->updateBookShipment($bkdata, $request_id);

				//update status to completed
				$this->freight_model->updateQuoteStatus($request_id, $this->seller_session_data['company_id'], ['quote_status' => '9', 'updated_at' => date('Y-m-d H:i:s')]);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('ff-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('ff-track-shipment/' . $request_id));
					}
				}
				break;
			default:
				redirect(base_url('ff-track-shipment/' . $request_id));
		}
	}

	function sendTrackingMail($to, $docs, $trans, $book_id, $currentstep)
	{

		return false; //stop send mails for tracking steps

		$requestDetails = $this->freight_model->getBookingDetails($book_id, $this->seller_session_data['company_id']);
		//echo $currentstep;die;
		$stpData = $this->seller_model->getSPSteps($requestDetails->transaction, $requestDetails->mode_id, $requestDetails->shipment_id, $requestDetails->delivery_term_id);

		$loadedOn_arr[3] = 'Vessel';
		$loadedOn_arr[2] = 'Flight';
		$loadedOn_arr[1] = 'Truck';

		$subject = "Shipment Status RFC ID : #" . $book_id;
		$message = "<table style='border:1px solid;'>";
		$message .= "<tr><th style='border: 1px solid;padding: 6px;'>Date</th><th style='border: 1px solid;padding: 6px;'>Process</th><th style='border: 1px solid;padding: 6px;'>Correction/Detail</th><th style='border: 1px solid;padding: 6px;'>Status</th></tr>";
		foreach ($stpData as $stData) {
			$shData = $this->seller_model->getShipmentProcessDataByStepId($book_id, $stData->id);
			if (!empty($shData) && $shData->step_id == $stData->id) {
				$status = "Pending";
				if (!empty($shData)) {
					if (!empty($shData->status == 1)) {
						$status = "Approved";
					} else if (!empty($shData->status == 2)) {
						$status = "Uploaded";
					} else if (!empty($shData->status == 3)) {
						$status = "Reupload";
					} else {
						$status = "Upload Pending";
					}
				}
				if ($currentstep == $shData->step_id) {
					$rwgt = 'font-weight:700;color:#4784c5';
					$subject .= " - $shData->step_name " . ((in_array($shData->id, ['16', '6'])) ? $loadedOn_arr[$requestDetails->mode_id] : '');
				} else {
					$rwgt = 'color: green;';
				}
				$message .= "<tr style='" . $rwgt . "'>
							<td style='border: 1px solid;padding: 6px;text-align: center;'><i>" . date('d-M-Y', strtotime($shData->action_date)) . " at " . date('h:i:s a', strtotime($shData->time)) . "</i></td>
							<td style='border: 1px solid;padding: 6px;text-align: center;'>" . $shData->step_name . "</td>
							<td style='border: 1px solid;padding: 6px;text-align: center;'>" . $shData->corrections . "</td>
							<td style='border: 1px solid;padding: 6px;text-align: center;'>" . $status . "</td>
						</tr>";
			} else {
				$message .= "<tr>
							<td style='border: 1px solid;padding: 6px;text-align: center;color:#d23434;'></td>
							<td style='border: 1px solid;padding: 6px;text-align: center;color:#d23434;'>" . $stData->step_name . "</td>
							<td style='border: 1px solid;padding: 6px;text-align: center;color:#d23434;'></td>
							<td style='border: 1px solid;padding: 6px;text-align: center;color:#d23434;'>Pending</td>
						</tr>";
			}
		}

		$message .= "</table>";

		return sendEmail($to, $subject, $message, $docs);
	}

	function shippingDocuments()
	{
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "document-management";
		$data['shipmentProcessData'] = '';
		$data['requestDetails'] = '';
		$data['steps'] = '';
		if ($this->input->get('rfc_id')) {
			$request_id = $this->input->get('rfc_id');
			$requestDetails =  $this->freight_model->getBookingDetails($request_id, $this->seller_session_data['company_id']);

			if (!empty($requestDetails)) {
				$transctn = $requestDetails->transaction;
				$steps = $this->seller_model->getSPSteps($requestDetails->transaction, $requestDetails->mode_id, $requestDetails->shipment_id, $requestDetails->delivery_term_id);
				$shipmentProcessData = $this->seller_model->getShipmentProcessData($transctn, $request_id, ['2', '3', '5', '10', '13', '15', '16', '17', '19']);
				$data['shipmentProcessData'] = $shipmentProcessData;
				$data['requestDetails'] = $requestDetails;
				$data['steps'] = $steps;
			}
		}
		$data['page'] = 'frontend/freightforwarder/shipping_documents';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	function reports($transaction = 'Export')
	{

		$data['leftmenuActive'] = "reports";
		$data['leftSubMenuActive'] = strtolower($transaction) . "-report";
		$data['reportType'] = $transaction;

		$toDate = $_GET['to_dt'] ? getMysqlDateFormat($_GET['to_dt']) : date('Y-m-d');
		$fromDate = $_GET['from_dt'] ? getMysqlDateFormat($_GET['from_dt']) : date('Y-m-d', strtotime('-180 days ' . $toDate));

		$data['from_dt'] = printFormatedDate($fromDate);
		$data['to_dt'] = printFormatedDate($toDate);

		$data['shippig_requirment_list'] = $this->freight_model->getReportList($this->seller_session_data['company_id'], $transaction, $fromDate, $toDate);
		$data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($this->seller_session_data['company_id']);
		if ($this->input->get('download') == 'true' || $this->input->get('send') == 'true') {
			// vdebug($data['shippig_requirment_list']);
			//The donwload file name:

			$this->load->library('Excel');
			PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
			//              $this->load->library('Excel_io_factory');
			$objPHPExcel = new PHPExcel();
			$filename = $transaction . "_report_" . date('Ymd') . ".xls";


			$tmpfile = tempnam(sys_get_temp_dir(), 'html');
			if($transaction=='Export'){
				file_put_contents($tmpfile, $this->load->view('frontend/freightforwarder/reports_export_template', $data, true));
			}else{
				file_put_contents($tmpfile, $this->load->view('frontend/freightforwarder/reports_import_template', $data, true));
			}
			
			$excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
			$excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
			$objPHPExcel->getActiveSheet()->setTitle('Report'); // Change sheet's title if you want
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

			$lastCol = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
			$lastRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
			$objPHPExcel->getActiveSheet()->getStyle("A1:$lastCol" . '2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle("A1:$lastCol" . $lastRow)->applyFromArray($styleArray);
			unset($styleArray);

			foreach (range('A', 'P') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}


			unlink($tmpfile); // delete temporary file because it isn't needed anymore



			if ($this->input->get('send') == 'true') {
				$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$tmpfileExcelfile = tempnam(sys_get_temp_dir(), 'report');
				$writer->save($tmpfileExcelfile);
				$arrAttachments = [$tmpfileExcelfile];

				$ff_details = $this->seller_model->getFF_DetailsByCompanyId($this->seller_session_data['company_id']);
				$mailSend = sendEmail_report($ff_details->email, $ff_details->name, $transaction, $data['from_dt'], $data['to_dt'], $arrAttachments);
				unlink($tmpfileExcelfile);
				if ($mailSend) {
					$this->session->set_flashdata('success', 'Report send successfully.');
					redirect(base_url("ff-reports/$transaction"));
				} else {
					$this->session->set_flashdata('error', 'Report sending faild.');
					redirect(base_url("ff-reports/$transaction"));
				}
				exit;
			} else {
				// The function header by sending raw excel
				header("Content-Type: application/vnd.ms-excel");

				// Defines the name of the export file "codelution-export.xls"
				header("Content-Disposition: attachment; filename=\"$filename\"");

				//header('Cache-Control: max-age=0');

				// Creates a writer to output the $objPHPExcel's content
				$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$writer->save('php://output');
			}


			// create the writer
			//            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
			//            $objWriter->save('results.xlsx');
		} else {
			$data['page'] = 'frontend/freightforwarder/reports';
			$data['sidebar'] = 'frontend/components/sidebar_dashboard';
			$this->load->view('frontend/layout_main', $data);
		}
	}

	public function annualContractList()
	{

		$data['leftmenuActive'] = "projects";
		$data['leftSubMenuActive'] = "annual-contract";
		$data['booking_list'] = []; // $this->seller_model->getBookingList($this->seller_session_data['company_id']);

		$data['page'] = 'frontend/freightforwarder/projects/annual_contract_list';

		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function editAnnualContract($annualContractId)
	{

		$data['leftmenuActive'] = "projects";
		$data['leftSubMenuActive'] = "annual-contract";
		$data['annualContractDetails'] = new stdClass;
		$data['view'] = $this->input->get('view');
		$mode_id = $this->input->get('mode_id');
		$filter = [];
		if ($this->input->get('transaction')) {
			$filter['transaction'] = $this->input->get('transaction');
		}
		if ($this->input->get('shipment')) {
			$filter['shipment'] = $this->input->get('shipment');
		}

		$data['mode_id'] = $mode_id;
		$data['annualContractDetails'] = $this->annual_contract_model->getDetails($annualContractId, $this->seller_session_data['company_id'], $mode_id, $filter);

		$data['rfcCategory'] = $this->freight_model->getAnnualCotntractRfcChargesCategory();
		if (in_array($data['annualContractDetails']->quote_status, ['3', '4', '6']) && $data['view'] != 'true') {
			$this->session->set_flashdata('error', 'You Can\'t modify annual contract.');
			redirect(base_url("ff-view-annual-contract/$annualContractId?mode_id=$mode_id&view=true"));
		}

		if ($this->input->post()) {
			// vdebug($_POST);
			
			$update = '';
			$messageSuccess = '';
			$messageError = '';
			if (strcasecmp($this->input->post('submitBtn'), 'Save Correction') == 0) {
				$updateData = ['comment' => $this->input->post('correction')];
				$update = $this->annual_contract_mapp_ff_model->update($annualContractId, $this->seller_session_data['company_id'], $updateData);
				$messageSuccess = 'Correction saved successfully.';
			}

			if (strcasecmp($this->input->post('submitBtn'), 'Send Quote') == 0) {
				if ($this->input->post('accept_terms_and_conditions') == 'on') {

					$updateData = ['quote_status' => '3', 'accept_terms_and_conditions' => 1];
					$update = $this->annual_contract_mapp_ff_model->update($annualContractId, $this->seller_session_data['company_id'], $updateData);
					$messageSuccess = 'Quote sent successfully.';

					if ($update) {
						$this->session->set_flashdata('success', $messageSuccess);
						redirect(base_url("ff-view-annual-contract/$annualContractId?" . $_SERVER['QUERY_STRING']."&view=true"));
					}

				} else {
					$messageError = 'Please accept Terms and Conditions.';
				}
			}

			if (strcasecmp($this->input->post('submitBtn'), 'Update Charges') == 0) {
				//$annualContractId, $this->seller_session_data['company_id']
				// vdebug($_POST);
				$isUpdateCharges = [];
				$ff_company_id = $this->seller_session_data['company_id'];
				$charges = $this->input->post('rfc_charges');
				$riders = $this->input->post('riders');
				$route_id = $this->input->post('route_id');
				foreach ($charges as $chargKey => $chargecategory) {
					foreach ($chargecategory['subcategory'] as $subcategory) {
						$chargesInsert['route_id'] = $route_id;
						$chargesInsert['annual_contract_id'] = $annualContractId;
						$chargesInsert['ff_company_id'] = $ff_company_id;
						$chargesInsert['rfc_charges_id'] = $subcategory['rfc_charges_id'];
						$chargesInsert['charges'] = $subcategory['charges'];
						//insert charges

						$isUpdateCharges[] = $this->annual_contract_route_rfc_charges_model->insert($chargesInsert);
					}
					if (isset($chargecategory['other_charges'])) {
						$isUpdateCharges[] = $this->annual_contract_route_rfc_charges_model->updateRfcOtherCharges($chargecategory['id'], $route_id, $ff_company_id, $chargecategory['other_charges']);
					}
				}

				foreach ($riders as $chargKey => $rider) {

					$riderInsert['route_id'] = $route_id;
					// $chargesInsert['annual_contract_id']=$annual_contract_id;
					$riderInsert['ff_company_id'] = $ff_company_id;
					$riderInsert['other_charge_id'] = $rider['rider_charge_id'];
					if (in_array($rider['rider_charge_id'], ['2', '3', '4'])) {
						$riderInsert['value_1'] =  getMysqlDateFormat($rider['value_1']);
					} else {
						$riderInsert['value_1'] = $rider['value_1'];
					}

					//insert charges
					$isUpdateCharges[] =  $this->annual_contract_route_riders_model->insert($riderInsert);
				}

				if (!empty(array_filter($isUpdateCharges))) {
					$messageSuccess = "Charges updated.";
					$update = true;
				}
			}


			if ($update) {
				$this->session->set_flashdata('success', $messageSuccess);
			} else {
				$messageError = !empty($messageError) ? $messageError : 'Something went wrong.';
				$this->session->set_flashdata('error', $messageError);
			}
			redirect(base_url("ff-edit-annual-contract/$annualContractId?" . $_SERVER['QUERY_STRING']));
		}
		$data['page'] = 'frontend/freightforwarder/projects/edit_annual_contract';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function ajaxAnnualContract()
	{

		$company_id = $this->seller_session_data['company_id'];
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

		$filter = [];
		if (isset($_POST['filter'])) {
			$filter = $_POST['filter'];
		}


		//fs
		//$filter['status'] = ['5', '6'];
		$filter['role'] = '3';


		echo json_encode($this->annual_contract_model->get_annual_contract_list($company_id, $_POST['start'], $_POST['length'], $filter, '', $orderBy));
		die;
	}


	function downloadAnnualContractTemplate($annualContractId)
	{



		//$toDate = $_GET['to_dt'] ? getMysqlDateFormat($_GET['to_dt']) : date('Y-m-d');
		//	$fromDate = $_GET['from_dt'] ? getMysqlDateFormat($_GET['from_dt']) : date('Y-m-d', strtotime('-7 days ' . $toDate));

		//$data['from_dt'] = printFormatedDate($fromDate);
		//	$data['to_dt'] = printFormatedDate($toDate);

		$mode_id = $this->input->get('mode_id');
		$data['mode_id'] = $mode_id;
		$data['rfcCategory'] = $this->freight_model->getAnnualCotntractRfcChargesCategory('', '', $mode_id);
		$data['riderLables'] = $this->freight_model->getAnnualContractRiders('', '', $mode_id);
		$data['annualContractDetails'] =  $this->annual_contract_model->getDetails($annualContractId, $this->seller_session_data['company_id'], $mode_id);
		// vdebug($data);
		//	$data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($this->seller_session_data['company_id']);
		//        vdebug($data['fs_details']);
		//	if ($this->input->get('download') == 'true' || $this->input->get('send') == 'true') {
		//The donwload file name:

		$this->load->library('Excel');
		PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		//              $this->load->library('Excel_io_factory');
		$objPHPExcel = new PHPExcel();
		$filename = "annual_contract_" . $annualContractId . "_" . date('Ymd') . ".xls";

		// echo $this->load->view('frontend/freightforwarder/projects/download_annual_contract_template', $data,true);
		// die;
		$tmpfile = tempnam(sys_get_temp_dir(), 'html');
		file_put_contents($tmpfile, $this->load->view('frontend/freightforwarder/projects/download_annual_contract_template', $data, true));
		$excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
		$excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
		$objPHPExcel->getActiveSheet()->setTitle('Report'); // Change sheet's title if you want
		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);

		$lastCol = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
		$lastRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
		$objPHPExcel->getActiveSheet()->getStyle("A1:$lastCol" . '1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A1:$lastCol" . $lastRow)->applyFromArray($styleArray);
		unset($styleArray);

		foreach (range('A', 'Z') as $columnID) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}


		unlink($tmpfile); // delete temporary file because it isn't needed anymore




		// The function header by sending raw excel
		header("Content-Type: application/vnd.ms-excel");

		// Defines the name of the export file "codelution-export.xls"
		header("Content-Disposition: attachment; filename=\"$filename\"");

		//header('Cache-Control: max-age=0');

		// Creates a writer to output the $objPHPExcel's content
		$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$writer->save('php://output');



		// create the writer
		//            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
		//            $objWriter->save('results.xlsx');
		//	} else {
		//		$data['page'] = 'frontend/freightforwarder/reports';
		//		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		//		$this->load->view('frontend/layout_main', $data);
		//	}
	}

	public function onlineBiddingList()
	{

		$data['leftmenuActive'] = "projects";
		$data['leftSubMenuActive'] = "online-bidding";
		$data['booking_list'] = []; // $this->seller_model->getBookingList($this->seller_session_data['company_id']);

		$data['page'] = 'frontend/seller/projects/online_bidding_list';

		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function downloadQuote($request_id)
	{
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$ff_company_id = $this->seller_session_data['company_id'];
		$requestDetails = $this->freight_model->getRequirmentDetails($request_id, $ff_company_id);
		if (empty($requestDetails)) {
			$this->session->set_flashdata('error', 'Quote details not found.');
			redirect(base_url('ff-request-list'));
		}

		$data['requestDetails'] = $requestDetails;
		$data['messages'] = $this->communication_model->getRecord([$requestDetails->ff_id, $this->seller_session_data['id']], $request_id);
		$data['skipComparative'] = ($data['requestDetails']->delivery_term_id == 1 && $data['requestDetails']->transaction == 'Export') || (in_array($data['requestDetails']->delivery_term_id, ['5', '6', '7']) && $data['requestDetails']->transaction == 'Import');
		if ($data['skipComparative']) {
			$data['rfc_charges'] = array();
			$data['rfc_other_charges'] = array();
			$data['other_charges'] = array();
			$data['other_charges_value_arr'] = array();
		} else {
			$data['rfc_charges'] = $this->freight_model->getRfcChargesCategory($requestDetails, $request_id, $ff_company_id);
			$data['rfc_other_charges'] = $this->freight_model->getRfcOtherCharges($request_id, $ff_company_id);
			$data['other_charges'] = $this->freight_model->getOtherCharges($requestDetails);
			$data['other_charges_value_arr'] = $this->freight_model->getOtherChargesValues($requestDetails, $ff_company_id, $requestDetails->shipment_id);
		}
		$data['particulars'] = $this->freight_model->getParticularList($request_id, $ff_company_id);

		$data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($ff_company_id);

		$this->load->library('pdf');
		$data['htmlData'] = $this->load->view('frontend/pdf-download-templates/download_quote', $data, true);
		$this->pdf->generate($data['htmlData'], $request_id . "_quote_" . $ff_company_id);
	}
}

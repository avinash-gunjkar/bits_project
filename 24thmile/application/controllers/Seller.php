<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seller extends CI_Controller
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
			if ($this->seller_session_data['role'] !== '2') {
				redirect(base_url());
			}
		}

		$this->load->model('company_model');
		$this->load->model('shipment_model');
		$this->load->model('contract_model');
		$this->load->model('container_model');
		$this->load->model('deliver_term_model');
		$this->load->model('mode_model');
		$this->load->model('port_model');
		$this->load->model('sector_model');
		$this->load->model('industry_model');
		$this->load->model('packing_model');
		$this->load->model('container_size_model');
		$this->load->model('seller_model');
		$this->load->model('freight_model');
		$this->load->model('login_model');
		$this->load->model('communication_model');
		$this->load->model('branch_model');
		$this->load->model('annual_contract_model');
		$this->load->model('annual_contract_route_model');
		$this->load->model('annual_contract_mapp_ff_model');
		$this->load->helper('cookie');
		$this->load->library(array('session', 'form_validation', 'email'));
	}

	public function dashboard()
	{
		$data['leftmenuActive'] = "dashboard";
		$data['numberOfAwardedRequests'] = $this->seller_model->getNumberOfRequests($this->seller_session_data['company_id']);
		$data['newInquireCount'] = $this->seller_model->getNewInquireCount($this->seller_session_data['company_id']);
		$data['shipmentInProcessCount'] = $this->seller_model->getShipmentInProcessCount($this->seller_session_data['company_id']);
		$data['completedShipmentPaymentPendingCount'] = $this->seller_model->getCompletedShipmentPaymentPendingCount($this->seller_session_data['company_id']);
		$data['completedShipmentCount'] = $this->seller_model->getCompletedShipmentCount($this->seller_session_data['company_id']);

		$data['page'] = 'frontend/seller/dashboard';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		if (isset($_GET['finyear'])) {
			$finyear = $_GET['finyear'];
		} else {
			$finyear = getCurrentFinancialYear();
		}
		$bookedShipmentStatusCount = new stdClass;
		$bookedShipmentStatusCount->import = $this->seller_model->getBookingShipmentStatusCount($this->seller_session_data['company_id'], 'Import', $finyear);
		$bookedShipmentStatusCount->export = $this->seller_model->getBookingShipmentStatusCount($this->seller_session_data['company_id'], 'Export', $finyear);
		$data['bookedShipmentStatusCount'] = $bookedShipmentStatusCount;
		$data['finyear'] = $finyear;
		$this->load->view('frontend/layout_main', $data);
	}

	public function profile()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['leftmenuActive'] = "my-profile";
		if ($_POST) {
			$this->session->set_userdata('profileActiveTab', 'profile');
			$user_id = $seller_session_data['id'];

			$profileData = $this->seller_model->getSellerProfile($user_id);

			//$headData = $this->seller_model->getHeadProfile($user_id);

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
					if (file_exists($config['upload_path'] . $this->input->post('old_profile_pic')) && !empty($this->input->post('old_profile_pic'))) {
						unlink($config['upload_path'] . $this->input->post('old_profile_pic'));
					}

					$uploadData = $this->upload->data();
					$profile_pic = $uploadData['file_name'];
				} else {
					$profile_pic = '';
				}
				$userprofile['profile_pic'] = $profile_pic;
			}

			$userprofile['designation_id'] = $this->input->post('designation_id');
			//			 $userprofile['address'] = $this->input->post('address');
			//			 $userprofile['country'] = $this->input->post('country');
			//			 $userprofile['state'] = $this->input->post('state');
			//			 $userprofile['city'] = $this->input->post('city');
			//			 $userprofile['pincode'] = $this->input->post('pincode');
			//			 $userprofile['gender'] = $this->input->post('gender');
			$userprofile['user_type'] = 2;

			if ($this->seller_model->updateUser($userdata, $user_id)) {

				if (empty($profileData->id)) {

					$userprofile['user_id'] = $user_id;
					$this->seller_model->insertUserInfo($userprofile);
					$this->session->set_flashdata('success', 'Profile updated successfully.');
					redirect(base_url('fs-my-profile'));
				} else {

					$this->seller_model->updateUserInfo($userprofile, $user_id);
					$this->session->set_flashdata('success', 'Profile updated successfully');
					redirect(base_url('fs-my-profile'));
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

		//                echo '<pre>';
		//                print_r($data);
		//                echo '</pre>';die;
		//$data['compData'] = $this->seller_model->getCompanyData();
		$data['designtnData'] = $this->seller_model->getDesignationData();
		//$data['sectors'] = $this->sector_model->getList();
		$data['page'] = 'frontend/seller/profile';
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
				'average_annual_import' => $this->input->post('average_annual_import'),
				'average_annual_export' => $this->input->post('average_annual_export'),
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
				redirect(base_url('fs-company-profile'));
			} else {
				$this->session->set_flashdata('error', 'Something went wrong.');
				redirect(base_url('fs-company-profile'));
			}
		}
		$kycDocuments[] = ["type" => "5", "documnetName" => "GST-Goods and Service Tax", "is_mandatory" => true, "details" => array()];
		$kycDocuments[] = ["type" => "1", "documnetName" => "PAN", "is_mandatory" => true, "details" => array()];
		$kycDocuments[] = ["type" => "2", "documnetName" => "COI/Proprietorship/LLP", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "4", "documnetName" => "IEC-Import Export Code", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "6", "documnetName" => "LUT-Letter of Undertaking", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "9", "documnetName" => "Old Shipping Bill", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "11", "documnetName" => "Old Bill of Entry", "is_mandatory" => false, "details" => array()];
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
		$data['page'] = 'frontend/seller/company-profile';
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
			//			                        print_r($_FILES);
			//						print_r($_POST);
			//			                        die;

			$user_id = $seller_session_data['id'];
			$company_id = $seller_session_data['company_id'];

			$doc_names = $this->input->post('doc_name');
			$document_valid_date = $this->input->post('document_valid_date');
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
					$config['allowed_types'] = 'gif|jpeg|jpg|png|pdf|doc|docx';


					$this->upload->initialize($config);

					//$this->upload->initialize($this->set_upload_options());

					if ($this->upload->do_upload('kyc_documents')) {
						$dataInfo[$i] = $this->upload->data();
						$dataInfo[$i]['doc_name'] = $doc_names[$i];
						$dataInfo[$i]['doc_number'] = $document_number[$i];
						$dataInfo[$i]['doc_valid_date'] = $document_valid_date[$i];
						$dataInfo[$i]['original_file_name'] = $_FILES['kyc_documents']['name'];
						//unlink old file
						unlink($config['upload_path'] . $old_doc_name[$i]);
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
					'doc_valid_date' => getMysqlDateFormat($kycfile['doc_valid_date']),
					'original_file_name' => $kycfile['original_file_name'],
					'type' => $kycfile['doc_name'],
					'status' => '0'
				);

				$this->seller_model->insertUserKYC($userkycdata);
				
			}
			
			if (empty($errorInFiles)) {
				$this->session->set_flashdata('success', 'KYC document uploaded successfully');
				redirect(base_url('fs-company-profile'));
			} else {
				$this->session->set_flashdata('error', implode(', ', $errorInFiles) . ' uploading faild.');
				redirect(base_url('fs-company-profile'));
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
				redirect(base_url('fs-my-profile'));
			}
		}
	}

	private function set_upload_options()
	{
		//upload an image options
		$config = array();
		$config['upload_path'] = 'uploads/kyc_documents/';
		$config['allowed_types'] = 'gif|jpg|png|Pdf|doc|docx';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;

		return $config;
	}

	public function request_list()
	{

		//$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$data['myProfile'] = $this->seller_model->getSellerInfo($this->seller_session_data['id']);
		$data['shippig_requirment_list'] = []; //$this->seller_model->getRequirmentList($this->seller_session_data['company_id']);

		$data['page'] = 'frontend/seller/request_list';

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
				if (!empty($row['data']) && $row['searchable']=='true') {

					if($row['data'] =='mode'){
						$row['data'] ='tbl_mode.type';
					}
					if($row['data'] =='request_id'){
						$row['data'] ='tbl_seller_requirement.id';
					}
					if($row['data'] =='delivery_term_name'){
						$row['data'] ='tbl_deliver_term.name';
					}
					if($row['data'] =='shipment'){
						$row['data'] ='tbl_shipment.type';
					}
					if($row['data'] =='quote_status_title'){
						$row['data'] ='t5.title';
					}
					if($row['data'] =='quote_status_title'){
						$row['data'] ='t5.title';
					}
					if($row['data'] =='status_title'){
						$row['data'] ='tbl_field_shipment_status.title';
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

		//fs
		$filter['status'] = ['1', '2', '3', '4', '7', '8'];
		$filter['role'] = '2';



		echo json_encode($this->freight_model->get_rfc_list($company_id, $_POST['start'], $_POST['length'], $filter, $iSearch_str, $orderBy));
		die;
	}

	public function select_ff($request_id)
	{
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";

		$data['request_id'] = $request_id;
		$selectFFMax_limit = 7;
		$filterData = ['sectors' => array(), 'location' => '', 'name' => '', 'isActive' => '1', 'public_status' => '0'];
		if ($this->input->post() && $this->input->post('btn_submit') == 'Search') {
			$filterData['sectors'] = !empty($this->input->post('sr_sector')) ? $this->input->post('sr_sector') : array();
			$filterData['location'] = $this->input->post('location');
			$filterData['name'] = $this->input->post('name');
			$ff_list =  $this->seller_model->getFfList($filterData);
		} else {
			$ff_list =  $this->seller_model->getFfList(['isActive' => '1', 'public_status' => '0']);
		}
		$data['filterData'] = $filterData;
		//                vdebug($_POST);
		$data['selectedFFids'] = $this->seller_model->getSelectedFfids($request_id);

		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);

		if ($this->input->post() && $this->input->post('btn_submit') == 'Request for Quote') {
			//remove old 
			// $this->seller_model->deleteRequestFf($request_id);
			
			if($this->input->post('removeFFIds')){
				
				$deleted = $this->seller_model->deleteRequestFf($request_id,$this->input->post('removeFFIds'));
			}

			$data['selectedFFids'] = $this->seller_model->getSelectedFfids($request_id);

			$totalFFcount = count($this->input->post('ff_company_id')) + count($data['selectedFFids']);
			if ($totalFFcount > $selectFFMax_limit) {
				$this->session->set_flashdata('message', '<div  class="alert alert-warning alert-dismissible fade show" role="alert">
                             You can select maximum ' . $selectFFMax_limit . ' Freight Forwarders.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>');
				redirect(base_url('select-ff-shipping-requirement/' . $request_id));
			}

			if ($this->input->post('ff_company_id')) {
				foreach ($this->input->post('ff_company_id') as $ff_company_id) {
					$insertData = [
						'request_id' => $request_id,
						'ff_company_id' => $ff_company_id,
						'quote_status' => '2',
					];
					//send email
					$ff_company_details = $this->seller_model->getFF_DetailsByCompanyId($ff_company_id);
					$ff_name = $ff_company_details->salutation . ' ' . $ff_company_details->firstname . ' ' . $ff_company_details->lastname;
					$url = base_url('edit-request-details/' . $request_id);
					$url = "<a href='$url' target='_blank'>$url</a>";
					sendEmail_rfcSend($ff_company_details->email, $ff_name, $url, $request_id);
					$this->seller_model->insertRequestFf($insertData);
				}

				if(in_array($requestDetails->status,['1'])){
					$this->seller_model->changeRequestStatus($request_id, ['status' => '2']);
				}

				$this->session->set_flashdata('success', 'Request sent successfully. You will receive Request for Comparative within One or Two Working days.');
				$this->session->set_flashdata('message', '<div  class="alert alert-success alert-dismissible fade show" role="alert">
                             Request sent successfully. You will receive Request for Comparative within One or Two Working days.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>');
				redirect(base_url('fs-request-list'));
			} else {
				$this->session->set_flashdata('message', '<div  class="alert alert-warning alert-dismissible fade show" role="alert">
                             Please select Fraight Forwarder to send fraight request.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>');
				redirect(base_url('select-ff-shipping-requirement/' . $request_id));
			}
		} else if ($this->input->post() && $this->input->post('btn_submit') == 'Save & Continue') {

			redirect(base_url('confirm-shipment/' . $request_id . '/' . $this->input->post('ff_company_id')));
		}

		$data['ff_list'] = $ff_list;

		$data['requestDetails'] = $requestDetails;
		$data['skipComparative'] = ($data['requestDetails']->delivery_term_id == 1 && $data['requestDetails']->transaction == 'Export') || (in_array($data['requestDetails']->delivery_term_id, ['5', '6', '7']) && $data['requestDetails']->transaction == 'Import');

		$data['sectors'] = $this->sector_model->getList($active = true);
		$data['page'] = 'frontend/seller/select_ff';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		//            $this->load->helper('vayes_helper');
		//                vdebug( $data);

		$this->load->view('frontend/layout_main', $data);
	}

	public function selectFF_fromAnnualContract($request_id)
	{
		$data['leftmenuActive'] = "shipping";
		$data['request_id'] = $request_id;
		$data['leftSubMenuActive'] = "request-list";


		$requestDetails =  $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		$filter = [];

		$filter['mode_id'] = $requestDetails->mode_id;
		$filter['awarded_contract_dt'] = true;
		$filter['shipment_id'] = $requestDetails->shipment_id;
		$filter['container_stuffing'] = $requestDetails->container_stuffing;
		$filter['cargo_status'] = $requestDetails->cargo_status;
		$filter['transaction'] = $requestDetails->transaction;
		$filter['checkAnnualContractDate'] = true;

		$ff_list =  $this->annual_contract_model->getServiceProviderList('', $this->seller_session_data['company_id'], $filter);

		// vdebug($ff_list);
		//$data['selectedFFids'] = $this->seller_model->getSelectedFfids($request_id);
		$data['selectedFFids'] = [];

		if ($this->input->post()) {
			$updated = '';
			$selected_route_id_ff_company_id_list = $this->input->post('selected_route_id_ff_company_id');

			foreach ($selected_route_id_ff_company_id_list as $selected_route_id_ff_company_id) {


				$selected_route_id_ff_company_id = explode('|', $selected_route_id_ff_company_id);
				$selected_route_id = $selected_route_id_ff_company_id[0];
				$selected_ff_company_id = $selected_route_id_ff_company_id[1];

				$routeDetails =  $this->annual_contract_route_model->getRecord($selected_route_id);
				$transactionCurrency = $routeDetails['currency']?$routeDetails['currency']:'INR';
				//select ff
				$updated =	$this->seller_model->changeRequestStatus($request_id, [
					'status' => '3',
					'transaction_currency' => $transactionCurrency,
					//'selected_ff_company_id' => $selected_ff_company_id,
					// 'shipping_instruction' => $this->input->post('shipping_instruction'),
					// 'pick_up_datetime' => getMysqlDateTimeFormat($this->input->post('pick_up_datetime')),
					//'selected_ff_dt' => date('Y-m-d H:i:s')
				]);

				$selectedFFidList = $this->seller_model->getSelectedFfids($request_id);
				if (!in_array($selected_ff_company_id, $selectedFFidList)) {
					//insert request to ff
					$insertData = [
						'request_id' => $request_id,
						'ff_company_id' => $selected_ff_company_id,
						'quote_status' => '1',
						'quote_submit_dt' => date('Y-m-d H:i:s'),
						'annual_contract_id' => $routeDetails['annual_contract_id'],
						'annual_contract_route_id' => $routeDetails['id']
						// 'awarded_dt' => date('Y-m-d H:i:s')
					];
					$this->seller_model->insertRequestFf($insertData);
				} else {
				}


				$rfc_charges = $this->freight_model->getRfcChargesCategory($requestDetails, $request_id, $selected_ff_company_id);
				$rfc_other_charges = $this->freight_model->getRfcOtherCharges($request_id, $selected_ff_company_id);
				$other_charges = $this->freight_model->getOtherCharges($requestDetails);
				$other_charges_value_arr = $this->freight_model->getOtherChargesValues($requestDetails, $selected_ff_company_id, $requestDetails->shipment_id);
				$annualContractRfcCharges = $this->freight_model->getAnnualCotntractRfcChargesCategory($selected_route_id, $selected_ff_company_id, $requestDetails->mode_id);
				$annualContractRiders = $this->freight_model->getAnnualContractRiders($selected_route_id, $selected_ff_company_id, $requestDetails->mode_id);
				
				
				$sumVolume = 0;
				$sumNetWeight = 0;
				$sumGrossWeight = 0;
				$totalOfMaxWeight = 0;
				$sumVolumetricWeight = 0;
				foreach ($requestDetails->package as $key => $row) {
					$sumVolume += ($row->volume * $row->number_of_container);
					$sumVolumetricWeight += ($row->volumetric_weight * $row->number_of_container);
					$sumNetWeight += ($row->net_weight * $row->number_of_container);
					$sumGrossWeight += ($row->gross_weight * $row->number_of_container);
					$totalOfMaxWeight += max([$row->volumetric_weight, $row->gross_weight]) * $row->number_of_container;
				}
				$totalContainers = 0;
				foreach ($requestDetails->container as $key => $row) {
					$totalContainers += $row->number_of_container;
					//$sumGrossWeight += ($row->gross_weight * $row->number_of_container);
				}

				$rfc_other_charges = [];
				foreach ($rfc_charges as $key1 => $category) {

					foreach ($category->subCategory as $key2 => $subCategory) {

						foreach ($annualContractRfcCharges[$key1]->subCategory as $annualContractSubcategory) {
							if ($annualContractSubcategory->rfc_pricing_label_id == $subCategory->rfc_pricing_label_id) {
								$rfc_charges[$key1]->subCategory[$key2]->charges = $annualContractSubcategory->charges;
								$defaultQty = 1;
								if (strcasecmp($subCategory->unit, 'CBM') == 0) {
									$defaultQty = $sumVolume;
								} else if (strcasecmp($subCategory->unit, 'Kg') == 0) {
									$defaultQty = $totalOfMaxWeight;
								}
								if ($subCategory->unit == 'Container') {
									$rfc_charges[$key1]->subCategory[$key2]->qty = $totalContainers;
								} else {
									$rfc_charges[$key1]->subCategory[$key2]->qty = $defaultQty;
								}
								$rfc_charges[$key1]->subCategory[$key2]->total = $rfc_charges[$key1]->subCategory[$key2]->charges * $rfc_charges[$key1]->subCategory[$key2]->qty = $defaultQty;
							}
						}
					}

					if (isset($annualContractRfcCharges[$key1]->other_charges) && !empty($category->subCategory)) {
						$tempOtherCharges = new stdClass();
						$tempOtherCharges->ff_company_id = $selected_ff_company_id;
						$tempOtherCharges->request_id = $request_id;
						$tempOtherCharges->category_id = $category->id;
						$tempOtherCharges->charges = $annualContractRfcCharges[$key1]->other_charges;
						$tempOtherCharges->title = 'Other';
						$tempOtherCharges->qty = 1;
						$tempOtherCharges->total = $tempOtherCharges->qty * $annualContractRfcCharges[$key1]->other_charges;
						$tempOtherCharges->unit = '';
						$rfc_other_charges[] = $tempOtherCharges;
					}
				}


				$totalQuoteValue = 0;
				$other_charges_total = 0;
				$total = 0;

				//insert rfc charges
				foreach ($rfc_charges as $category) {
					foreach ($category->subCategory as $rfc) {

						$rfcChargesDetails = $this->freight_model->checkRfcChargeExist($request_id, $selected_ff_company_id, $rfc->id, $rfc->item_id);
						$total = ($rfc->charges * $rfc->qty);
						if (!empty($rfcChargesDetails)) {
							//update
							$insertData = [
								'charges' => $rfc->charges,
								'qty' => $rfc->qty,
								'total' => $total
							];
							$this->freight_model->updateRfcCharges($rfcChargesDetails->id, $insertData);
						} else {
							//insert
							$insertData = [
								'ff_company_id' => $selected_ff_company_id,
								'request_id' => $request_id,
								'item_id' => $rfc->item_id ? $rfc->item_id : 0,
								'rfc_charges_id' => $rfc->id,
								'charges' => $rfc->charges,
								'qty' => $rfc->qty,
								'total' => $total
							];
							$this->freight_model->insertRfcCharges($insertData);
						}

						$totalQuoteValue += $total;
					}
				}


				//insert rfc other charges
				
				$this->freight_model->deleteOtherRfcCharges($request_id, $selected_ff_company_id);
				foreach ($rfc_other_charges as $rfc) {

					//$rfcChargesDetails = $this->freight_model->checkRfcChargeExist($request_id,$this->seller_session_data['company_id'],$rfc['rfc_id'],$rfc['item_id']);
					$total = ($rfc->charges * $rfc->qty);
					$other_charges_total += $total;
					$totalQuoteValue += $total;
					if (!empty($rfc->id)) {
						//update
						$insertData = [

							'charges' => $rfc->charges,
							'title' => $rfc->title,
							'unit' => $rfc->unit,
							'qty' => $rfc->qty,
							'total' => $total
						];
						$this->freight_model->updateRfcOtherCharges($rfc->id, $insertData);
					} else {
						//insert

						$this->freight_model->insertRfcOtherCharges($rfc);
					}
				}

				$this->freight_model->updateRfcChargesTotal($request_id, $selected_ff_company_id);
				//insert riders
				//delete old

				$this->freight_model->deleteOtherCharges($request_id, $selected_ff_company_id);
				foreach ($other_charges as $otherCharge) {
					$value_1 = getIdFromValue($annualContractRiders, $otherCharge->other_charge_id, 'rider_charge_id', 'value_1');
					// $value_2 = $otherCharge['value_2'];

					$other_charge_id = $otherCharge->other_charge_id;

					if (in_array($other_charge_id, ['15', '16'])) {
						$currency = explode('||', $value_1);
						$value_1 = $currency[0];
						$value_2 = $currency[1];
					}
					if (in_array($other_charge_id, ['2', '3', '4'])) {
						$value_1 = getMysqlDateFormat($value_1);
					}

					$otherChargedata = [
						'other_charge_id' => $other_charge_id,
						'request_id' => $request_id,
						'ff_company_id' => $selected_ff_company_id,
						'value_1' => $value_1,
						'value_2' => $value_2,
					];
					$this->freight_model->insertOtherCharge($otherChargedata);

					//update total quote Amount
					$this->freight_model->updateTotalQuoteAmount($request_id, $selected_ff_company_id, ['total_quote_amount' => $totalQuoteValue, 'other_charges_total' => $other_charges_total]);
				}
				
				//update total quote Amount
				$this->freight_model->updateTotalQuoteAmount($request_id, $selected_ff_company_id, ['total_quote_amount' => $totalQuoteValue, 'other_charges_total' => $other_charges_total]);

				
			}
			// fs-request-list redirect
			if ($updated) {
				$this->session->set_flashdata('success', 'Quote Received.');
			} else {
				$this->session->set_flashdata('error', 'Something went wrong.');
			}
			
			redirect(base_url('fs-request-list'));
		} //end post


		$data['ff_list'] = $ff_list;

		$data['requestDetails'] = $requestDetails;


		$data['sectors'] = $this->sector_model->getList($active = true);
		$data['page'] = 'frontend/seller/select_ff_from_annualContract';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		//            $this->load->helper('vayes_helper');

		$this->load->view('frontend/layout_main', $data);
	}

	public function quoteList($request_id)
	{

		$ff_list =  $this->seller_model->getResponseFfList($request_id);
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$data['ff_list'] = $ff_list;
		$requirment = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		if (!$requirment) {
			$this->session->set_flashdata('error', 'RFC details not found.');
			redirect(base_url('fs-request-list'));
		}
		$skipComparative = ($requirment->delivery_term_id == 1 && $requirment->transaction == 'Export') || (in_array($requirment->delivery_term_id, ['5', '6', '7']) && $requirment->transaction == 'Import');

		if ($skipComparative) {
			$this->session->set_flashdata('error', 'Comparative not available.');
			redirect(base_url('fs-request-list'));
		}
		$data['requestDetails'] = $requirment;

		if (empty($data['requestDetails'])) {
			$this->session->set_flashdata('error', 'Something went wrong.');
			redirect(base_url('fs-request-list'));
		}
		$data['selectedFFids'] = $this->seller_model->getSelectedFfids($request_id);
		$data['page'] = 'frontend/seller/quote_list';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		//                vdebug($data['ff_list']);
		$this->load->view('frontend/layout_main', $data);
	}

	public function downloadQuoteComparative($request_id){

		$ff_list =  $this->seller_model->getResponseFfList($request_id);
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$data['ff_list'] = $ff_list;
		$requirment = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		if (!$requirment) {
			$this->session->set_flashdata('error', 'RFC details not found.');
			redirect(base_url('fs-request-list'));
		}
		$skipComparative = ($requirment->delivery_term_id == 1 && $requirment->transaction == 'Export') || (in_array($requirment->delivery_term_id, ['5', '6', '7']) && $requirment->transaction == 'Import');

		if ($skipComparative) {
			$this->session->set_flashdata('error', 'Comparative not available.');
			redirect(base_url('fs-request-list'));
		}
		$data['requestDetails'] = $requirment;

		if (empty($data['requestDetails'])) {
			$this->session->set_flashdata('error', 'Something went wrong.');
			redirect(base_url('fs-request-list'));
		}
		$data['selectedFFids'] = $this->seller_model->getSelectedFfids($request_id);
		
		//                vdebug($data['ff_list']);
		$data['page'] = 'frontend/seller/download_quote_comparative';
		
		$this->load->library('pdf');
		$data['htmlData'] = $this->load->view('frontend/seller/download_quote_comparative', $data,true);
		$this->pdf->generate($data['htmlData'], $request_id . "_quote_comparative",TRUE,'A4','landscape');

	}
	public function companyDetails($company_id)
	{
		$data['companyDetails'] = $this->seller_model->getFFcompanyDetails($company_id);

		//ff kyc details
		$kycDocuments[] = ["type" => "5", "documnetName" => "GST-Goods and Service Tax", "is_mandatory" => true, "details" => array()];
		$kycDocuments[] = ["type" => "1", "documnetName" => "PAN", "is_mandatory" => true, "details" => array()];
		$kycDocuments[] = ["type" => "2", "documnetName" => "COI/Proprietorship/LLP/Partnership", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "4", "documnetName" => "IEC-Import Export Code", "is_mandatory" => false, "details" => array()];
		$kycDocuments[] = ["type" => "10", "documnetName" => "IATA-International Air Transport Association", "is_mandatory" => false, "details" => array()];
		foreach ($kycDocuments as $key => $doc) {
			$kycDocuments[$key]['details'] = $this->seller_model->getUserKYC($company_id, $doc['type']);
		}
		$data['companyDetails']->kyc_documents = $kycDocuments;
		// vdebug($data);
		$data['page'] = 'frontend/seller/ff_company_details';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}


	public function viewQuote($request_id, $ff_company_id)
	{
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$requestDetails = $this->freight_model->getRequirmentDetails($request_id, $ff_company_id);
		if (empty($requestDetails)) {
			$this->session->set_flashdata('error', 'Quote details not found.');
			redirect(base_url('quote-list/' . $request_id));
		}
		if ($this->input->post()) {
			$submit = $this->input->post('submit');

			if ($submit == 'Submit Counter Rate') {
				//update counter rate
				// vdebug($_POST);
				foreach($this->input->post('rfc_charges') as $rfc_charge){
					//update counter rate
					$this->seller_model->updateRfcChargeCounterRate($rfc_charge['ffChargesId'],$rfc_charge['counter_rate']);
				}
				foreach($this->input->post('rfc_charges_other') as $rfc_charge_other){
					//update counter rate
					$this->seller_model->updateOtherRfcChargeCounterRate($rfc_charge_other['id'],$rfc_charge_other['counter_rate']);
				}
				$this->seller_model->updateCounterRate($request_id, $ff_company_id, $this->input->post('counter_rate'));
				$ff_details = $this->seller_model->getFF_DetailsByCompanyId($ff_company_id);
				$ff_name = $ff_details->salutation . ' ' . $ff_details->firstname . ' ' . $ff_details->lastname;
				$url = base_url('edit-request-details/' . $request_id);
				$url = "<a href='$url' target='_blank'>$url</a>";
				sendEmail_SendCounterOffer($ff_details->email, $ff_name, $url, $request_id);

				$this->session->set_flashdata('success', 'Counter rate updated successfully.');
				redirect(base_url('quote-list/' . $request_id));
			} else if ($submit == 'Award & Send Shipment Instruction') {
				//select ff
				$this->seller_model->changeRequestStatus($request_id, [
					'selected_ff_company_id' => $ff_company_id, 'selected_ff_dt' => date('Y-m-d H:i:s'), 'shipping_instruction' => $this->input->post('shipping_instruction'),
					'pick_up_datetime' => getMysqlDateTimeFormat($this->input->post('pick_up_datetime'))
				]);
				$this->freight_model->updateQuoteStatus($request_id, $ff_company_id, ['quote_status' => '4', 'awarded_dt' => date('Y-m-d H:i:s')]);
				$ff_details = $this->seller_model->getFF_DetailsByCompanyId($ff_company_id);
				$ff_name = $ff_details->salutation . ' ' . $ff_details->firstname . ' ' . $ff_details->lastname;
				$url = base_url('ff-track-shipment/' . $request_id);
				$url = "<a href='$url' target='_blank'>$url</a>";
				sendEmail_quoteAccept($ff_details->email, $ff_name, $url, $request_id);

				//get not selected ff email list
				$ffList =  $this->seller_model->getResponseFfList($request_id);
				foreach ($ffList as $ff) {
					if ($ff->company_id != $ff_company_id and !empty($ff->email)) {
						sendEmail_regretMail($ff->email);
					}
				}
				$this->session->set_flashdata('success', 'Shipment awarded successfully successfully.');
				redirect(base_url("quote-list/$request_id"));
			}
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
		$data['page'] = 'frontend/seller/view_quote';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($ff_company_id);



		$this->load->view('frontend/layout_main', $data);
	}

	public function downloadQuote($request_id, $ff_company_id)
	{
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$requestDetails = $this->freight_model->getRequirmentDetails($request_id, $ff_company_id);
		if (empty($requestDetails)) {
			$this->session->set_flashdata('error', 'Quote details not found.');
			redirect(base_url('quote-list/' . $request_id));
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
		$data['page'] = 'frontend/seller/view_quote';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($ff_company_id);

		$this->load->library('pdf');
		$data['htmlData'] = $this->load->view('frontend/pdf-download-templates/download_quote', $data, true);
		$this->pdf->generate($data['htmlData'], $request_id . "_quote_" . $ff_company_id);
	}

	public function confirmShipment($request_id, $ff_company_id)
	{
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$data['ff_company_id'] = $ff_company_id;
		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);

		if ($this->input->post()) {

			$submit = $this->input->post('submit');
			if ($submit == 'Award & Send Shipment Instruction') {
				//select ff
				$this->seller_model->changeRequestStatus($request_id, [
					'status' => '4',
					'selected_ff_company_id' => $ff_company_id,
					'shipping_instruction' => $this->input->post('shipping_instruction'),
					'pick_up_datetime' => getMysqlDateTimeFormat($this->input->post('pick_up_datetime')),
					'selected_ff_dt' => date('Y-m-d H:i:s')
				]);

				$insertData = [
					'request_id' => $request_id,
					'ff_company_id' => $ff_company_id,
					'quote_status' => '4',
					'awarded_dt' => date('Y-m-d H:i:s')
				];
				$this->seller_model->insertRequestFf($insertData);
				//send email
				$ff_company_details = $this->seller_model->getFF_DetailsByCompanyId($ff_company_id);
				$ff_name = $ff_company_details->salutation . ' ' . $ff_company_details->firstname . ' ' . $ff_company_details->lastname;
				$url = base_url('edit-request-details/' . $request_id);
				$url = "<a href='$url' target='_blank'>$url</a>";
				sendEmail_rfcSend($ff_company_details->email, $ff_name, $url, $request_id);
			}
			redirect(base_url("fs-request-list"));
		}
		$data['requestDetails'] = $requestDetails;
		$data['messages'] = $this->communication_model->getRecord([$requestDetails->ff_id, $this->seller_session_data['id']], $request_id);
		if ($requestDetails->delivery_term_id == 1 && $requestDetails->transaction == 'Export') {
			$data['rfc_charges'] = array();
		} else {
			$data['rfc_charges'] = $this->freight_model->getRfcChargesCategory($requestDetails, $request_id, $ff_company_id);
		}

		$data['particulars'] = $this->freight_model->getParticularList($request_id, $ff_company_id);
		$data['page'] = 'frontend/seller/confirm_shipment';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($ff_company_id);

		//            vdebug($data['rfc_charges']);


		$this->load->view('frontend/layout_main', $data);
	}

	public function track_shipment_edit($request_id, $ff_company_id)
	{


		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "booking-list";
		$requestDetails = $this->freight_model->getRequirmentDetails($request_id, $ff_company_id);
		$ff_details = $this->seller_model->getFF_DetailsByCompanyId($ff_company_id);
		$ff_name = $ff_details->salutation . ' ' . $ff_details->firstname . ' ' . $ff_details->lastname;
		$url = base_url('ff-track-shipment/' . $request_id);
		$url = "<a href='$url' target='_blank'>$url</a>";
		$ff_email = $ff_details->email;

		if ($this->input->post()) {
			$submit = $this->input->post('submit');

			$postdata = array(

				'consignor_name' => $this->input->post('consignor_name'),
				'consignor_company_name' => $this->input->post('consignor_company_name'),
				'consignor_email' => $this->input->post('consignor_email'),
				'consignor_country_code' => $this->input->post('consignor_country_code'),
				'consignor_phone' => $this->input->post('consignor_phone'),
				'consignor_address_line_1' => $this->input->post('consignor_address_line_1'),
				'consignor_address_line_2' => $this->input->post('consignor_address_line_2'),
				'consignor_city_name' => $this->input->post('consignor_city_name'),
				'consignor_city_id' => $this->input->post('consignor_city_id') ? $this->input->post('consignor_city_id') : null,
				'consignor_state_id' => $this->input->post('consignor_state_id') ? $this->input->post('consignor_state_id') : null,
				'consignor_country_id' => $this->input->post('consignor_country_id') ? $this->input->post('consignor_country_id') : null,
				'consignor_pincode' => $this->input->post('consignor_pincode'),
				'consignee_company_name' => $this->input->post('consignee_company_name'),
				'consignee_email' => $this->input->post('consignee_email'),
				'consignee_name' => $this->input->post('consignee_name'),
				'consignee_country_code' => $this->input->post('consignee_country_code'),
				'consignee_phone' => $this->input->post('consignee_phone'),
				'consignee_address_line_1' => $this->input->post('consignee_address_line_1'),
				'consignee_address_line_2' => $this->input->post('consignee_address_line_2'),
				'consignee_city_name' => $this->input->post('consignee_city_name'),
				'consignee_city_id' => $this->input->post('consignee_city_id') ? $this->input->post('consignee_city_id') : null,
				'consignee_state_id' => $this->input->post('consignee_state_id') ? $this->input->post('consignee_state_id') : null,
				'consignee_country_id' => $this->input->post('consignee_country_id') ? $this->input->post('consignee_country_id') : null,
				'consignee_pincode' => $this->input->post('consignee_pincode'),
				'shipping_instruction' => $this->input->post('shipping_instruction'),
				'pick_up_datetime' => getMysqlDateTimeFormat($this->input->post('pick_up_datetime'))
			);

			//update
			$postdata['updated_at'] =  date("Y-m-d H:i:s");
			$postdata['status'] = 'in_process';
			$updated = $this->seller_model->updateRequirement($request_id, $postdata);

			$requestDetails = $this->freight_model->getRequirmentDetails($request_id, $ff_company_id);
			$shipping_instruction = $this->load->view('frontend/seller/shipping_instruction_email_template', ['requestDetails' => $requestDetails], true);

			sendEmail_ShippingInstructions($ff_email, $ff_name, $shipping_instruction, $request_id);

			$this->session->set_flashdata('success', 'Shipping instructions updated.');
			redirect(base_url('fs-track-shipment/' . $request_id));
		}
		$data['requestDetails'] = $requestDetails;
		$data['messages'] = $this->communication_model->getRecord([$requestDetails->ff_id, $this->seller_session_data['id']], $request_id);
		if ($requestDetails->delivery_term_id == 1 && $requestDetails->transaction == 'Export') {
			$data['rfc_charges'] = array();
		} else {
			$data['rfc_charges'] = $this->freight_model->getRfcChargesCategory($requestDetails, $request_id, $ff_company_id);
		}
		$data['particulars'] = $this->freight_model->getParticularList($request_id, $ff_company_id);
		$data['page'] = 'frontend/seller/edit_pick_up_address_quote';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['ff_details'] = $ff_details;
		//            vdebug($data['ff_details']);
		//            $this->load->helper('vayes_helper');


		$this->load->view('frontend/layout_main', $data);
	}

	public function shipping_requirement($request_id = '')
	{
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$seller_session_data = $this->session->userdata('seller_logged_in');

		is_fs_kyc_approved(); //check user kyc is approved or not

		//get request details
		if ($this->input->post('request_id')) {
			$request_id = $this->input->post('request_id');
		}
		$sellerCompanyDetails = $this->seller_model->getFFcompanyDetails($this->seller_session_data['company_id']);
		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);

		if (!$requestDetails && $request_id) {
			$this->session->set_flashdata('error', 'RFC details not found.');
			redirect(base_url('fs-request-list'));
		}

		if (!in_array($requestDetails->status, ['1']) && !empty($requestDetails)) {
			redirect(base_url("partial-edit-shipping-requirement/$request_id"));
		}


		if ($_POST) {


			$user_id = $this->seller_session_data['id'];

			//$profileData = $this->seller_model->getSellerProfile($user_id);



			$postdata = array(

				'mode_id' => $this->input->post('mode') ? $this->input->post('mode') : null,
				'transaction' => $this->input->post('transaction') ? $this->input->post('transaction') : 'Export',
				'delivery_term_id' => $this->input->post('delivery_term') ? $this->input->post('delivery_term') : null,
				'shipment_id' => $this->input->post('shipment') ? $this->input->post('shipment') : null,
				'container_stuffing' => $this->input->post('container_stuffing'),
				'stuffing' => $this->input->post('stuffing') ? $this->input->post('stuffing') : null,
				'cargo_status' => $this->input->post('cargo_status'),
				'consignor_name' => $this->input->post('consignor_name'),
				'consignor_company_name' => $this->input->post('consignor_company_name'),
				'consignor_email' => $this->input->post('consignor_email'),
				'consignor_country_code' => $this->input->post('consignor_country_code'),
				'consignor_phone' => $this->input->post('consignor_phone'),
				'consignor_address_line_1' => $this->input->post('consignor_address_line_1'),
				'consignor_address_line_2' => $this->input->post('consignor_address_line_2'),
				'consignor_city_name' => $this->input->post('consignor_city_name'),
				'consignor_city_id' => $this->input->post('consignor_city_id') ? $this->input->post('consignor_city_id') : null,
				'consignor_state_id' => $this->input->post('consignor_state_id') ? $this->input->post('consignor_state_id') : null,
				'consignor_country_id' => $this->input->post('consignor_country_id') ? $this->input->post('consignor_country_id') : null,
				'consignor_pincode' => $this->input->post('consignor_pincode'),
				'consignee_company_name' => $this->input->post('consignee_company_name'),
				'consignee_email' => $this->input->post('consignee_email'),
				'consignee_name' => $this->input->post('consignee_name'),
				'consignee_country_code' => $this->input->post('consignee_country_code'),
				'consignee_phone' => $this->input->post('consignee_phone'),
				'consignee_address_line_1' => $this->input->post('consignee_address_line_1'),
				'consignee_address_line_2' => $this->input->post('consignee_address_line_2'),
				'consignee_city_name' => $this->input->post('consignee_city_name'),
				'consignee_city_id' => $this->input->post('consignee_city_id') ? $this->input->post('consignee_city_id') : null,
				'consignee_state_id' => $this->input->post('consignee_state_id') ? $this->input->post('consignee_state_id') : null,
				'consignee_country_id' => $this->input->post('consignee_country_id') ? $this->input->post('consignee_country_id') : null,
				'consignee_pincode' => $this->input->post('consignee_pincode'),
				'shipment_value' => $this->input->post('shipment_value') ? $this->input->post('shipment_value') : null,
				'shipment_value_currency' => $this->input->post('shipment_value_currency') ? $this->input->post('shipment_value_currency') : null,
				'port_loading_id' => $this->input->post('port_loading_id') ? $this->input->post('port_loading_id') : null,
				'port_loading_name' => $this->input->post('port_loading_name') ? $this->input->post('port_loading_name') : null,
				'port_discharge_id' => $this->input->post('port_discharge_id') ? $this->input->post('port_discharge_id') : null,
				'port_discharge_name' => $this->input->post('port_discharge_name') ? $this->input->post('port_discharge_name') : null,
				'tentativ_date_dispatch' => getMysqlDateFormat($this->input->post('tentativ_date_dispatch')),
				'tentativ_date_delivery' => getMysqlDateFormat($this->input->post('tentativ_date_delivery')),
				'special_consideration_lcl' => $this->input->post('special_consideration_lcl'),
				'payment_term' => $this->input->post('payment_term'),
				'transaction_currency' => $sellerCompanyDetails->transaction_currency ? $sellerCompanyDetails->transaction_currency : 'INR',
				'response_end_date' => getMysqlDateFormat($this->input->post('response_end_date')),
				'is_other_consignor' => $this->input->post('is_other_consignor') ? $this->input->post('is_other_consignor') : 'No',
				'is_other_consignee' => $this->input->post('is_other_consignee') ? $this->input->post('is_other_consignee') : 'No'
			);

			if (empty($requestDetails)) {
				//insert
				$postdata['user_id'] =  $user_id;
				$postdata['fs_company_id'] =  $this->seller_session_data['company_id'] ? $this->seller_session_data['company_id'] : null;
				$request_id = $this->seller_model->insertRequirement($postdata);

				$this->session->set_flashdata('success', 'Freight Enquiry Created successfully');
			} else {
				//update
				$postdata['updated_at'] =  date("Y-m-d H:i:s");
				//$postdata['status'] = 'edited';
				$updated = $this->seller_model->updateRequirement($request_id, $postdata);
				$this->session->set_flashdata('success', 'Freight Enquiry updated successfully');
			}

			$updateDocumentData = [];
			$allowed_file_types = 'bmp|jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';
			if (!empty($_FILES['attach_msds']['name'])) {

				$uploadfilepath = 'uploads/rfc-' . $request_id . '/';


				if (!file_exists($uploadfilepath)) {
					mkdir($uploadfilepath, 0777, true);
				}

				$config['upload_path'] = $uploadfilepath;
				$config['file_name'] = $_FILES['attach_msds']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = $allowed_file_types;
				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('attach_msds')) {
					$uploadData = $this->upload->data();
					$attach_msds = base_url($uploadfilepath . $uploadData['file_name']);
				} else {

					$this->session->set_flashdata('error', 'Error in document upload.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				$updateDocumentData['msds_doc'] = $attach_msds;
			}

			if (!empty($_FILES['attach_product_specification']['name'])) {

				$uploadfilepath = 'uploads/rfc-' . $request_id . '/';

				if (!file_exists($uploadfilepath)) {
					mkdir($uploadfilepath, 0777, true);
				}

				$config['upload_path'] = $uploadfilepath;
				$config['file_name'] = $_FILES['attach_product_specification']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = $allowed_file_types;

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('attach_product_specification')) {
					$uploadData = $this->upload->data();
					$attach_product_specification = base_url($uploadfilepath . $uploadData['file_name']);
				} else {

					$this->session->set_flashdata('error', 'Error in document upload.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				$updateDocumentData['product_specification_doc']  = $attach_product_specification;
			}

			if (!empty($_FILES['attach_other_documents_1']['name'])) {

				$uploadfilepath = 'uploads/rfc-' . $request_id . '/';

				if (!file_exists($uploadfilepath)) {
					mkdir($uploadfilepath, 0777, true);
				}

				$config['upload_path'] = $uploadfilepath;
				$config['file_name'] = $_FILES['attach_other_documents_1']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = $allowed_file_types;

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('attach_other_documents_1')) {
					$uploadData = $this->upload->data();
					$attach_other_documents_1 = base_url($uploadfilepath . $uploadData['file_name']);
				} else {

					$this->session->set_flashdata('error', 'Error in document upload.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				$updateDocumentData['other_doc_1']  = $attach_other_documents_1;
			}

			if (!empty($_FILES['attach_other_documents_2']['name'])) {

				$uploadfilepath = 'uploads/rfc-' . $request_id . '/';

				if (!file_exists($uploadfilepath)) {
					mkdir($uploadfilepath, 0777, true);
				}

				$config['upload_path'] = $uploadfilepath;
				$config['file_name'] = $_FILES['attach_other_documents_2']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = $allowed_file_types;

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('attach_other_documents_2')) {
					$uploadData = $this->upload->data();
					$attach_other_documents_2 = base_url($uploadfilepath . $uploadData['file_name']);
				} else {

					$this->session->set_flashdata('error', 'Error in document upload.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				$updateDocumentData['other_doc_2']  = $attach_other_documents_2;
			}

			//update documents
			if (!empty($updateDocumentData)) {
				$updated = $this->seller_model->updateRequirement($request_id, $updateDocumentData);
			}

			if (!$request_id) {
				$this->session->set_flashdata('error', 'Something went wrong.');
				redirect(base_url('fs-request-list'));
			}

			if ($this->input->post('is_other_consignor') == 'Yes') {
				$this->seller_model->updateOtherAddress($request_id, 'consignor', $this->input->post('consignor_other'));
			}
			if ($this->input->post('is_other_consignee') == 'Yes') {
				$this->seller_model->updateOtherAddress($request_id, 'consignee', $this->input->post('consignee_other'));
			}

			$arryItemIds = [];
			if ($this->input->post('shipment') == '1') {
				//FCL
				$arryItemIds = $this->insertRequestItems($request_id, $this->input->post('container'), 'container');
			} else if ($this->input->post('shipment') == '2') {
				//LCL
				$arryItemIds = $this->insertRequestItems($request_id, $this->input->post('package'), 'package');
			}


			$this->seller_model->deleteRequirementItem($request_id, array_unique($arryItemIds));

			if ($this->input->post('submit') == 'Save') {
				redirect(base_url('fs-request-list'));
			} else {
				redirect(base_url('select-ff-shipping-requirement/' . $request_id));
			}
		} else if (empty($request_id)) {
			$requestDetails = $this->seller_model->getLastRfcRequestDetails($this->seller_session_data['company_id']);
			if (!empty($requestDetails)) {
				foreach ($requestDetails->container as $key => $val) {
					$requestDetails->container[$key]->id = '';
				}
				foreach ($requestDetails->package as $key => $val) {
					$requestDetails->package[$key]->id = '';
				}
				$requestDetails->request_id = '';
				$requestDetails->msds_doc = null;
				$requestDetails->product_specification_doc = null;
				$requestDetails->other_doc_1 = null;
				$requestDetails->other_doc_2 = null;
			}
		}

		$country_name = $this->seller_model->getCountries();
		// vdebug($requestDetails);
		/* $new_country_name = array();  
		foreach($country_name as $cntry_name){
			$cntName = trim($cntry_name->country_name);
			array_push($new_country_name,$cntName);
		}
		$new_country_name = array_unique($new_country_name);
		$CName = implode('", "',$new_country_name); */
		//		$data['CName'] = $country_name;
		$data['requestDetails'] = $requestDetails;
		$data['sellerCompanyDetails'] = $sellerCompanyDetails;
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$data['compData'] = $this->seller_model->getCompanyData();
		$data['delivery_terms'] = $this->deliver_term_model->getList();
		$data['doc_verified'] = $this->seller_model->documentVerified($seller_session_data['id']);
		$data['modes'] = $this->mode_model->getList();
		//		$data['pols'] = $this->port_model->getPortList(1);
		//		$data['pods'] = $this->port_model->getPortList(1);
		//		$data['companys'] = $this->company_model->getList();
		$data['shipments'] = $this->shipment_model->getList(true);
		$data['contracts'] = $this->contract_model->getList(true);

		$data['compnayBranch'] = $this->branch_model->getList($this->seller_session_data['company_id'], 'branch');
		$data['consigneeAddressList'] = $this->branch_model->getList($this->seller_session_data['company_id'], 'consignee');

		$data['container_types'] = $this->container_model->getList();
		$data['packingList'] = $this->packing_model->getList();
		$data['containerSizeList'] = $this->container_size_model->getList();
		$data['page'] = 'frontend/seller/shipping_requirement';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function partial_edit_shipping_requirement($request_id = '')
	{
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$seller_session_data = $this->session->userdata('seller_logged_in');

		//get request details
		if ($this->input->post('request_id')) {
			$request_id = $this->input->post('request_id');
		}
		$sellerCompanyDetails = $this->seller_model->getFFcompanyDetails($this->seller_session_data['company_id']);
		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		//                 vdebug($requestDetails);
		//                $this->load->helper('vayes_helper');
		if ($_POST) {



			$user_id = $this->seller_session_data['id'];

			//$profileData = $this->seller_model->getSellerProfile($user_id);


			$postdata = array(

				// 'mode_id' => $this->input->post('mode')?$this->input->post('mode'):null,
				//  'transaction' => $this->input->post('transaction')?$this->input->post('transaction'):'Export',
				//  'delivery_term_id' => $this->input->post('delivery_term')?$this->input->post('delivery_term'):null,
				//  'shipment_id' => $this->input->post('shipment')?$this->input->post('shipment'):null,
				//  'container_stuffing' => $this->input->post('container_stuffing'),
				//  'stuffing' => $this->input->post('stuffing')?$this->input->post('stuffing'):null,
				//  'cargo_status' => $this->input->post('cargo_status'),
				'consignor_name' => $this->input->post('consignor_name'),
				'consignor_company_name' => $this->input->post('consignor_company_name'),
				'consignor_email' => $this->input->post('consignor_email'),
				'consignor_country_code' => $this->input->post('consignor_country_code'),
				'consignor_phone' => $this->input->post('consignor_phone'),
				'consignor_address_line_1' => $this->input->post('consignor_address_line_1'),
				'consignor_address_line_2' => $this->input->post('consignor_address_line_2'),
				'consignor_city_name' => $this->input->post('consignor_city_name'),
				'consignor_city_id' => $this->input->post('consignor_city_id') ? $this->input->post('consignor_city_id') : null,
				'consignor_state_id' => $this->input->post('consignor_state_id') ? $this->input->post('consignor_state_id') : null,
				'consignor_country_id' => $this->input->post('consignor_country_id') ? $this->input->post('consignor_country_id') : null,
				'consignor_pincode' => $this->input->post('consignor_pincode'),
				'consignee_company_name' => $this->input->post('consignee_company_name'),
				'consignee_email' => $this->input->post('consignee_email'),
				'consignee_name' => $this->input->post('consignee_name'),
				'consignee_country_code' => $this->input->post('consignee_country_code'),
				'consignee_phone' => $this->input->post('consignee_phone'),
				'consignee_address_line_1' => $this->input->post('consignee_address_line_1'),
				'consignee_address_line_2' => $this->input->post('consignee_address_line_2'),
				'consignee_city_name' => $this->input->post('consignee_city_name'),
				'consignee_city_id' => $this->input->post('consignee_city_id') ? $this->input->post('consignee_city_id') : null,
				'consignee_state_id' => $this->input->post('consignee_state_id') ? $this->input->post('consignee_state_id') : null,
				'consignee_country_id' => $this->input->post('consignee_country_id') ? $this->input->post('consignee_country_id') : null,
				'consignee_pincode' => $this->input->post('consignee_pincode'),
				'shipment_value' => $this->input->post('shipment_value') ? $this->input->post('shipment_value') : null,
				'shipment_value_currency' => $this->input->post('shipment_value_currency') ? $this->input->post('shipment_value_currency') : null,
				'port_loading_id' => $this->input->post('port_loading_id') ? $this->input->post('port_loading_id') : null,
				'port_loading_name' => $this->input->post('port_loading_name') ? $this->input->post('port_loading_name') : null,
				'port_discharge_id' => $this->input->post('port_discharge_id') ? $this->input->post('port_discharge_id') : null,
				'port_discharge_name' => $this->input->post('port_discharge_name') ? $this->input->post('port_discharge_name') : null,
				'tentativ_date_dispatch' => getMysqlDateFormat($this->input->post('tentativ_date_dispatch')),
				'tentativ_date_delivery' => getMysqlDateFormat($this->input->post('tentativ_date_delivery')),
				'special_consideration_lcl' => $this->input->post('special_consideration_lcl'),
				'payment_term' => $this->input->post('payment_term'),
				'transaction_currency' => $sellerCompanyDetails->transaction_currency ? $sellerCompanyDetails->transaction_currency : 'INR',
				'response_end_date' => getMysqlDateFormat($this->input->post('response_end_date')),
				'is_other_consignor' => $this->input->post('is_other_consignor') ? $this->input->post('is_other_consignor') : 'No',
				'is_other_consignee' => $this->input->post('is_other_consignee') ? $this->input->post('is_other_consignee') : 'No'
			);

			if (empty($requestDetails)) {
				//insert
				$postdata['user_id'] =  $user_id;
				$postdata['fs_company_id'] =  $this->seller_session_data['company_id'] ? $this->seller_session_data['company_id'] : null;
				$request_id = $this->seller_model->insertRequirement($postdata);
				$this->session->set_flashdata('success', 'Freight Enquiry Created successfully');
			} else {
				//update
				$postdata['updated_at'] =  date("Y-m-d H:i:s");
				//$postdata['status'] = 'edited';
				$updated = $this->seller_model->updateRequirement($request_id, $postdata);
				$this->session->set_flashdata('success', 'Freight Enquiry updated successfully');
			}


			if ($this->input->post('is_other_consignor') == 'Yes') {
				$this->seller_model->updateOtherAddress($request_id, 'consignor', $this->input->post('consignor_other'));
			}
			if ($this->input->post('is_other_consignee') == 'Yes') {
				$this->seller_model->updateOtherAddress($request_id, 'consignee', $this->input->post('consignee_other'));
			}

			$updateDocumentData = [];
			$allowed_file_types = 'bmp|jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';
			if (!empty($_FILES['attach_msds']['name'])) {

				$uploadfilepath = 'uploads/rfc-' . $request_id . '/';


				if (!file_exists($uploadfilepath)) {
					mkdir($uploadfilepath, 0777, true);
				}

				$config['upload_path'] = $uploadfilepath;
				$config['file_name'] = $_FILES['attach_msds']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = $allowed_file_types;
				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('attach_msds')) {
					$uploadData = $this->upload->data();
					$attach_msds = base_url($uploadfilepath . $uploadData['file_name']);
				} else {

					$this->session->set_flashdata('error', 'Error in document upload.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				$updateDocumentData['msds_doc'] = $attach_msds;
			}

			if (!empty($_FILES['attach_product_specification']['name'])) {

				$uploadfilepath = 'uploads/rfc-' . $request_id . '/';

				if (!file_exists($uploadfilepath)) {
					mkdir($uploadfilepath, 0777, true);
				}

				$config['upload_path'] = $uploadfilepath;
				$config['file_name'] = $_FILES['attach_product_specification']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = $allowed_file_types;

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('attach_product_specification')) {
					$uploadData = $this->upload->data();
					$attach_product_specification = base_url($uploadfilepath . $uploadData['file_name']);
				} else {

					$this->session->set_flashdata('error', 'Error in document upload.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				$updateDocumentData['product_specification_doc']  = $attach_product_specification;
			}

			if (!empty($_FILES['attach_other_documents_1']['name'])) {

				$uploadfilepath = 'uploads/rfc-' . $request_id . '/';

				if (!file_exists($uploadfilepath)) {
					mkdir($uploadfilepath, 0777, true);
				}

				$config['upload_path'] = $uploadfilepath;
				$config['file_name'] = $_FILES['attach_other_documents_1']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = $allowed_file_types;

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('attach_other_documents_1')) {
					$uploadData = $this->upload->data();
					$attach_other_documents_1 = base_url($uploadfilepath . $uploadData['file_name']);
				} else {

					$this->session->set_flashdata('error', 'Error in document upload.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				$updateDocumentData['other_doc_1']  = $attach_other_documents_1;
			}

			if (!empty($_FILES['attach_other_documents_2']['name'])) {

				$uploadfilepath = 'uploads/rfc-' . $request_id . '/';

				if (!file_exists($uploadfilepath)) {
					mkdir($uploadfilepath, 0777, true);
				}

				$config['upload_path'] = $uploadfilepath;
				$config['file_name'] = $_FILES['attach_other_documents_2']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = $allowed_file_types;

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('attach_other_documents_2')) {
					$uploadData = $this->upload->data();
					$attach_other_documents_2 = base_url($uploadfilepath . $uploadData['file_name']);
				} else {

					$this->session->set_flashdata('error', 'Error in document upload.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				$updateDocumentData['other_doc_2']  = $attach_other_documents_2;
			}

			//update documents
			if (!empty($updateDocumentData)) {
				$updated = $this->seller_model->updateRequirement($request_id, $updateDocumentData);
			}
			

			//                        if($this->input->post('shipment')=='1'){
			//                            //FCL
			//                            $this->insertRequestItems($request_id,$this->input->post('container'));
			//                        }else if($this->input->post('shipment')=='2'){
			//                            //LCL
			//                            $this->insertRequestItems($request_id,$this->input->post('package'));
			//                        }


			redirect(base_url('fs-request-list/'));
		}

		$country_name = $this->seller_model->getCountries();

		/* $new_country_name = array();  
		foreach($country_name as $cntry_name){
			$cntName = trim($cntry_name->country_name);
			array_push($new_country_name,$cntName);
		}
		$new_country_name = array_unique($new_country_name);
		$CName = implode('", "',$new_country_name); */
		//		$data['CName'] = $country_name;
		$data['requestDetails'] = $requestDetails;
		//$data['sellerCompanyDetails'] = $sellerCompanyDetails;
		//$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		//$data['compData'] = $this->seller_model->getCompanyData();
		$data['delivery_terms'] = $this->deliver_term_model->getList();
		$data['doc_verified'] = $this->seller_model->documentVerified($seller_session_data['id']);
		$data['modes'] = $this->mode_model->getList();
		//		$data['pols'] = $this->port_model->getPortList(1);
		//		$data['pods'] = $this->port_model->getPortList(1);
		//		$data['companys'] = $this->company_model->getList();
		$data['shipments'] = $this->shipment_model->getList(true);
		$data['contracts'] = $this->contract_model->getList(true);

		$data['compnayBranch'] = $this->branch_model->getList($this->seller_session_data['company_id']);
		$data['consigneeAddressList'] = $this->branch_model->getList($this->seller_session_data['company_id'], 'consignee');
		$data['container_types'] = $this->container_model->getList();
		$data['packingList'] = $this->packing_model->getList();
		$data['containerSizeList'] = $this->container_size_model->getList();
		$data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($requestDetails->selected_ff_company_id);
		$data['page'] = 'frontend/seller/partial_edit_shipping_requirement';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}
	public function view_shipping_requirement($request_id = '')
	{
		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "request-list";
		$seller_session_data = $this->session->userdata('seller_logged_in');

		//get request details
		if ($this->input->post('request_id')) {
			$request_id = $this->input->post('request_id');
		}
		$sellerCompanyDetails = $this->seller_model->getFFcompanyDetails($this->seller_session_data['company_id']);
		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);


		$data['requestDetails'] = $requestDetails;
		$data['delivery_terms'] = $this->deliver_term_model->getList();
		$data['doc_verified'] = $this->seller_model->documentVerified($seller_session_data['id']);
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
		$data['page'] = 'frontend/seller/view_shipping_requirement';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';

		$this->load->view('frontend/layout_main', $data);
	}

	public function insertRequestItems($requestId, $items, $item_type, $parentId = 0)
	{
		global	$arryItemIds;
		$items = (array) $items;
		foreach ($items as $item) {
			$item = (array) $item; //convert object to array
			
			$postData = [
				'request_id' => $requestId,
				'item_type' => $item['item_type'] ? $item['item_type'] : null,
				'parent_id' => $parentId ? $parentId : 0,
				'material_type' => $item['material_type'] ? $item['material_type'] : null,
				'unit_qty' => $item['unit_qty'] ? $item['unit_qty'] : 0.00,
				'material_description' => $item['material_description'] ? $item['material_description'] : null,
				'hs_code' => $item['hs_code'] ? $item['hs_code'] : null,
				'type_of_packing' => $item['type_of_packing'] ? $item['type_of_packing'] : null,
				'length' => $item['length'] ? $item['length'] : null,
				'length_uom' => $item['length_uom'] ? $item['length_uom'] : null,
				'height' => $item['height'] ? $item['height'] : null,
				'height_uom' => $item['height_uom'] ? $item['height_uom'] : null,
				'width' => $item['width'] ? $item['width'] : null,
				'width_uom' => $item['width_uom'] ? $item['width_uom'] : null,
				'net_weight' => $item['net_weight'] ? $item['net_weight'] : null,
				'net_weight_uom' => $item['net_weight_uom'] ? $item['net_weight_uom'] : null,
				'gross_weight' => $item['gross_weight'] ? $item['gross_weight'] : null,
				'gross_weight_uom' => $item['gross_weight_uom'] ? $item['gross_weight_uom'] : null,
				'container_size' => $item['container_size'] ? $item['container_size'] : null,
				'container_type' => $item['container_type'] ? $item['container_type'] : null,
				'number_of_container' => $item['number_of_container'] ? $item['number_of_container'] : null,
				'unit' => $item['unit'] ? $item['unit'] : null,
				'so_number' => $item['so_number'] ? $item['so_number'] : null,
				'so_line_item' => $item['so_line_item'] ? $item['so_line_item'] : null,
				'remarks' => $item['remarks'] ? $item['remarks'] : null,
			];

			if ($item['item_id']) {
				//update
				$this->seller_model->updateRequirementItem($item['item_id'], $postData);
				$arryItemIds[] = $item['item_id'];
				$this->insertRequestItems($requestId, $item['package'], 'package', $item['item_id']);
				//$arryItemIds = array_merge($arryItemIds,);
			} else {
				//insert new
				$insertId = $this->seller_model->insertRequirementItem($postData);
				$arryItemIds[] = $insertId;
				$this->insertRequestItems($requestId, $item['package'], 'package', $insertId);
				// $arryItemIds = array_merge($arryItemIds,);
				// $arryItemIds = ;
			}
		}

		return $arryItemIds;
	}



	public function getAjaxState()
	{
		$cntId = $this->input->post('countryN');
		$statedata = $this->seller_model->getStateByCountry(trim($cntId));
		echo json_encode($statedata);
	}

	public function getAjaxCity()
	{
		$state = $this->input->post('state');
		$Citydata = $this->seller_model->getCityByState(trim($state));
		echo json_encode($Citydata);
	}

	public function booking_list()
	{

		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "booking-list";
		$data['booking_list'] = []; // $this->seller_model->getBookingList($this->seller_session_data['company_id']);

		$data['page'] = 'frontend/seller/booking_list';

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
				if (!empty($row['data']) && $row['searchable']=='true') {

					if($row['data'] =='mode'){
						$row['data'] ='tbl_mode.type';
					}
					if($row['data'] =='request_id'){
						$row['data'] ='tbl_seller_requirement.id';
					}
					if($row['data'] =='delivery_term_name'){
						$row['data'] ='tbl_deliver_term.name';
					}
					if($row['data'] =='shipment'){
						$row['data'] ='tbl_shipment.type';
					}
					if($row['data'] =='quote_status_title'){
						$row['data'] ='t5.title';
					}
					if($row['data'] =='quote_status_title'){
						$row['data'] ='t5.title';
					}
					if($row['data'] =='status_title'){
						$row['data'] ='tbl_field_shipment_status.title';
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


		//fs
		$filter['status'] = ['5', '6'];
		$filter['role'] = '2';


		echo json_encode($this->freight_model->get_rfc_list($company_id, $_POST['start'], $_POST['length'], $filter, $iSearch_str, $orderBy));
		die;
	}

	public function track_shipment($request_id)
	{

		$data['leftmenuActive'] = "shipping";
		$data['leftSubMenuActive'] = "booking-list";
		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		$transctn = $requestDetails->transaction;
		$steps = $this->seller_model->getSPSteps($requestDetails->transaction, $requestDetails->mode_id, $requestDetails->shipment_id, $requestDetails->delivery_term_id);
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
		if ($transctn === "Export") {
			$data['page'] = 'frontend/seller/track_shipment_export';
		} else {
			$data['page'] = 'frontend/seller/track_shipment_import';
		}
		$data['skipComparative'] = ($data['bookedShipment']->delivery_term_id == 1 && $data['bookedShipment']->transaction == 'Export') || (in_array($data['bookedShipment']->delivery_term_id, ['5', '6', '7']) && $data['bookedShipment']->transaction == 'Import');


		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$buyer_seler_email = array();
		$buyer_seler_email[] = isset($requestDetails->consignor_other->email) ? $requestDetails->consignor_other->email : '';
		$buyer_seler_email[] = isset($requestDetails->consignee_other->email) ? $requestDetails->consignee_other->email : '';
		$data['buyer_seler_email'] = implode(',', array_filter($buyer_seler_email));
		//                vdebug($requestDetails);
		$this->load->view('frontend/layout_main', $data);
	}
	public function upload_export_process_documents()
	{

		$request_id = $this->input->post('request_id');
		//		$book_id = $this->input->post('book_id');

		$step = array_search("Submit", $this->input->post());

		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		$ff_details = $this->seller_model->getFF_DetailsByCompanyId($requestDetails->selected_ff_company_id);
		$fs_details = $this->seller_model->getFS_DetailsByCompanyId($requestDetails->fs_company_id);
		$ff_name = $ff_details->salutation . ' ' . $ff_details->firstname . ' ' . $ff_details->lastname;
		$url = base_url('ff-track-shipment/' . $request_id);
		$url = "<a href='$url' target='_blank'>$url</a>";
		$ff_email = $ff_details->email;
		$buyer_email = $requestDetails->consignor_email;
		$seller_email = $fs_details->email;
		$skipComparative = ($requestDetails->delivery_term_id == 1 && $requestDetails->transaction == 'Export') || (in_array($requestDetails->delivery_term_id, ['5', '6', '7']) && $requestDetails->transaction == 'Import');

		$documents = array();
		$allowed_file_types = 'bmp|jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';

		switch ($step) {

			case "step1_export":

				$step_id = $this->input->post('step1_export_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);


				$documents = (array) json_decode($stepdata->documents);



				$step1_export_custom_invoice_number = $this->input->post('step1_export_custom_invoice_number');
				$step1_export_custom_invoice_date = $this->input->post('step1_export_custom_invoice_date');
				$step1_export_coustom_invoice_currency = $this->input->post('step1_export_coustom_invoice_currency');
				$step1_export_coustom_invoice_value = $this->input->post('step1_export_coustom_invoice_value');
				$shipment_under_payment = $this->input->post('shipment_under_payment');
				$igst_payment_amount = $this->input->post('step1_export_igst_payment_amount');

				if (!empty($_FILES['step1_export_custom_invoice']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step1_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['step1_export_custom_invoice']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('step1_export_custom_invoice')) {
						$uploadData = $this->upload->data();
						$step1_export_custom_invoice = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['Custom_Invoice'] = $step1_export_custom_invoice;
				}

				if (!empty($_FILES['step1_export_packing_list']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step1_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['step1_export_packing_list']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('step1_export_packing_list')) {
						$uploadData = $this->upload->data();
						$step1_export_packing_list = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['packing_List'] = $step1_export_packing_list;
				}

				if (!empty($_FILES['step1_export_other_documents_1']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step1_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['step1_export_other_documents_1']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] =  $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('step1_export_other_documents_1')) {
						$uploadData = $this->upload->data();
						$step1_export_other_documents = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['other_documents_1'] = $step1_export_other_documents;
				}
				if (!empty($_FILES['step1_export_other_documents_2']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step1_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['step1_export_other_documents_2']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] =  $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('step1_export_other_documents_2')) {
						$uploadData = $this->upload->data();
						$step1_export_other_documents = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$step1_export_other_documents = '';
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['other_documents_2'] = $step1_export_other_documents;
				}
				if (!empty($_FILES['step1_export_other_documents_3']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step1_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['step1_export_other_documents_3']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] = $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('step1_export_other_documents_3')) {
						$uploadData = $this->upload->data();
						$step1_export_other_documents = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$step1_export_other_documents = '';
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['other_documents_3'] = $step1_export_other_documents;
				}


				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;


				$dataStep1['documents'] = json_encode($documents);

				if (!empty($step1_export_custom_invoice_number)) {
					$bkdata['custom_invoice_number'] = $step1_export_custom_invoice_number;
				}
				if (!empty($step1_export_custom_invoice_date)) {
					$bkdata['custom_invoice_date'] = getMysqlDateFormat($step1_export_custom_invoice_date);
				}
				if (!empty($step1_export_coustom_invoice_currency)) {
					$bkdata['custom_invoice_currency'] = $step1_export_coustom_invoice_currency;
				}
				if (!empty($step1_export_coustom_invoice_value)) {
					$bkdata['custom_invoice_value'] = $step1_export_coustom_invoice_value;
				}
				$bkdata['shipment_under_payment'] = $shipment_under_payment;
				$bkdata['igst_payment_amount'] = $igst_payment_amount ? $igst_payment_amount : 0.00;



				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$dataStep1['status'] = 2;

				$this->seller_model->updateBookShipment($bkdata, $request_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						// $to = 'amolc.infinite1@gmail.com';
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);
						// $smstext = "Preshipment document uploaded.";
						// $this->sendSMS($to,$smstext);
						//sendEmail_exportStep1_upload_doc($ff_details->email,$ff_name,$url,$request_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					if ($stepdata->status == 2) {

						$dataStep1['status'] = 2;
					}

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}

				break;
			case "step2_export":

				$step_id = $this->input->post('step_id_2');

				$step2_export_correction = $this->input->post('step2_export_correction');

				$step2_export_status = $this->input->post('step2_export_status');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step2_export_status;
				$dataStep1['corrections'] = $step2_export_correction;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}
				break;
			case "step5_export":

				$step_id = $this->input->post('step_id_5');

				$step5_export_correction = $this->input->post('step5_export_correction');

				$step5_export_status = $this->input->post('step5_export_status');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step5_export_status;
				$dataStep1['corrections'] = $step5_export_correction;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$dataStep1['status'] = $step5_export_status;

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}
				break;
			case "step7_export":

				$step_id = $this->input->post('step7_export_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);


				$documents = (array) json_decode($stepdata->documents);

				$step7_export_commercial_invoice_number = $this->input->post('step7_export_commercial_invoice_number');
				$step7_export_commercial_invoice_date = $this->input->post('step7_export_commercial_invoice_date');
				$step7_export_status = $this->input->post('step7_export_status');
				$step7_export_correction = $this->input->post('step7_export_correction');
				$step7_export_agree_document_sent = $this->input->post('step7_export_agree_document_sent');

				if ($this->input->post('post_shipment_doc1')) {
					$documents['post_shipment_doc1'] = $this->input->post('post_shipment_doc1');
				}


				if (!empty($_FILES['post_shipment_doc2']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step7_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['post_shipment_doc2']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] =  $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('post_shipment_doc2')) {
						$uploadData = $this->upload->data();
						$post_shipment_doc2 = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['post_shipment_doc2'] = $post_shipment_doc2;
				}

				if (!empty($_FILES['post_shipment_doc3']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step7_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['post_shipment_doc3']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] =   $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('post_shipment_doc3')) {
						$uploadData = $this->upload->data();
						$post_shipment_doc3 = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['post_shipment_doc3'] = $post_shipment_doc3;
				}

				if (!empty($_FILES['post_shipment_doc4']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step7_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['post_shipment_doc4']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] =   $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('post_shipment_doc4')) {
						$uploadData = $this->upload->data();
						$post_shipment_doc4 = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['post_shipment_doc4'] = $post_shipment_doc4;
				}

				if (!empty($_FILES['post_shipment_doc5']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step7_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['post_shipment_doc5']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] =  $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('post_shipment_doc5')) {
						$uploadData = $this->upload->data();
						$post_shipment_doc5 = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['post_shipment_doc5'] = $post_shipment_doc5;
				}

				if (!empty($_FILES['post_shipment_doc6']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $this->input->post('request_id') . '/step7_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['post_shipment_doc6']['name'];
					$config['overwrite'] = FALSE;
					$config["allowed_types"] =   $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('post_shipment_doc6')) {
						$uploadData = $this->upload->data();
						$post_shipment_doc6 = base_url($uploadfilepath . $uploadData['file_name']);
					} else {

						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['post_shipment_doc6'] = $post_shipment_doc6;
				}
				$buyer_email = $this->input->post('step7_export_buyer_email');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['documents'] = json_encode($documents);
				$dataStep1['note_for_doc'] = $step7_export_agree_document_sent;
				$dataStep1['status'] = 1;
				$dataStep1['corrections'] = $step7_export_correction;
				$dataStep1['buyer_email'] = $buyer_email;


				$bkdata['commercial_invoice_number'] = $step7_export_commercial_invoice_number;
				$bkdata['commercial_invoice_date'] = getMysqlDateFormat($step7_export_commercial_invoice_date);

				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$this->seller_model->updateBookShipment($bkdata, $request_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array_merge([$seller_email, $ff_email], explode(',', $buyer_email));
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array_merge([$seller_email, $ff_email], explode(',', $buyer_email));
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}

				break;
			case "step8_export":

				$step_id = $this->input->post('step_id_8');

				$step8_export_correction = $this->input->post('step8_export_correction');

				$step8_export_status = $this->input->post('step8_export_status');



				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step8_export_status;
				$dataStep1['corrections'] = $step8_export_correction;


				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}
				break;
			case "step10_export":

				$step_id = $this->input->post('step_id_10');

				$step10_export_correction = $this->input->post('step10_export_correction');

				$step10_export_status = $this->input->post('step10_export_status');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step10_export_status;
				$dataStep1['corrections'] = $step10_export_correction;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}
				break;
			case "step11_export":

				$step_id = $this->input->post('step11_export_step_id');

				$step11_export_igst_payment_status = $this->input->post('step11_export_igst_payment_status');
				$step11_export_erbc_received = $this->input->post('step11_export_erbc_received');
				$step11_export_dbk_received = $this->input->post('step11_export_dbk_received');
				$step11_dbk_received_date = $this->input->post('step11_dbk_received_date');
				$step11_meis_received_date = $this->input->post('step11_meis_received_date');
				$step11_ff_invoice_payment_date = $this->input->post('step11_ff_invoice_payment_date');
				$step11_export_meis_received = $this->input->post('step11_export_meis_received');
				$step11_export_bill_amnt_received = $this->input->post('step11_export_bill_amnt_received');
				$step11_export_erbc_number = $this->input->post('step11_export_erbc_number');
				$step11_export_erbc_date = $this->input->post('step11_export_erbc_date');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = 1;
				$dataStep1['corrections'] = '';

				$bkdata['igst_payment_status'] = $step11_export_igst_payment_status;
				$bkdata['erbc_status'] = $step11_export_erbc_received;
				$bkdata['ERBC_number'] = $step11_export_erbc_number;
				$bkdata['ERBC_date'] = getMysqlDateFormat($step11_export_erbc_date);
				$bkdata['MEIS_status'] = $step11_export_meis_received;
				$bkdata['meis_received_date'] = getMysqlDateFormat($step11_meis_received_date);
				$bkdata['ff_invoice_payment_date'] = getMysqlDateFormat($step11_ff_invoice_payment_date);
				$bkdata['Bill_status'] = $step11_export_bill_amnt_received;
				$bkdata['DBK_status'] = $step11_export_dbk_received;
				$bkdata['dbk_received_date'] = getMysqlDateFormat($step11_dbk_received_date);

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				$this->seller_model->updateBookShipment($bkdata, $request_id);

				if ($skipComparative) {
					if (!empty($step11_export_erbc_number) && !empty($step11_export_erbc_date) && !empty($step11_export_meis_received) && !empty($step11_export_dbk_received) && !empty($step11_export_dbk_received) && !empty($step11_meis_received_date)) {
						//update shipment status completed
						$this->freight_model->updateShipmentStatus($request_id, ['status' => '6', 'updated_at' => date('Y-m-d H:i:s')]);
					}
				} else {
					if (!empty($step11_export_erbc_number) && !empty($step11_export_erbc_date) && !empty($step11_export_meis_received) && !empty($step11_export_dbk_received) && !empty($step11_export_bill_amnt_received) && !empty($step11_export_dbk_received) && !empty($step11_meis_received_date) && !empty($step11_ff_invoice_payment_date)) {
						//update shipment status completed
						$this->freight_model->updateShipmentStatus($request_id, ['status' => '6', 'updated_at' => date('Y-m-d H:i:s')]);
					}
				}



				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {

						$to = array($seller_email, $ff_email, $buyer_email);
						$documents = array();
						$this->sendTrackingMail($to, $documents, 'Export', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}
				break;
			default:
				redirect(base_url('fs-track-shipment/' . $request_id));
		}
	}

	public function upload_import_process_documents()
	{

		$request_id = $this->input->post('request_id');
		//$book_id = $this->input->post('book_id');

		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		$ff_details = $this->seller_model->getFF_DetailsByCompanyId($requestDetails->selected_ff_company_id);
		$fs_details = $this->seller_model->getFS_DetailsByCompanyId($requestDetails->fs_company_id);
		$ff_name = $ff_details->salutation . ' ' . $ff_details->firstname . ' ' . $ff_details->lastname;
		$url = base_url('ff-track-shipment/' . $request_id);
		$url = "<a href='$url' target='_blank'>$url</a>";
		$ff_email = $ff_details->email;
		$buyer_email = $requestDetails->consignor_email;
		$seller_email = $fs_details->email;

		$step = array_search("Submit", $this->input->post());

		// vdebug($_POST);die;
		$documents = array();
		$allowed_file_types = 'bmp|jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';

		switch ($step) {

			case "step1_import":
				$step_id = $this->input->post('step1_import_step_id');
				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);
				$documents = (array) json_decode($stepdata->documents);

				$commercial_invoice_number = $this->input->post('commercial_invoice_number');
				$commercial_invoice_date = $this->input->post('commercial_invoice_date');
				$commercial_invoice_value = $this->input->post('commercial_invoice_value');

				if (!empty($_FILES['final_billl_of_lading']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step1_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['final_billl_of_lading']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] =  $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('final_billl_of_lading')) {
						$uploadData = $this->upload->data();
						$step1_import_custom_invoice = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$step1_import_custom_invoice = '';
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['final_billl_of_lading'] = $step1_import_custom_invoice;
				}

				if (!empty($_FILES['commercial_invoice']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step1_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['commercial_invoice']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] =  $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('commercial_invoice')) {
						$uploadData = $this->upload->data();
						$step1_import_custom_invoice = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$step1_import_custom_invoice = '';
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['commercial_invoice'] = $step1_import_custom_invoice;
				}

				if (!empty($_FILES['step1_import_packing_list']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step1_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['step1_import_packing_list']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] =  $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('step1_import_packing_list')) {
						$uploadData = $this->upload->data();
						$step1_import_packing_list = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$step1_import_packing_list = '';
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['packing_List'] = $step1_import_packing_list;
				}

				if (!empty($_FILES['certificate_of_origin']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step1_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['certificate_of_origin']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] =  $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('certificate_of_origin')) {
						$uploadData = $this->upload->data();
						$step1_import_transit_insurance = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$step1_import_transit_insurance = '';
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['certificate_of_origin'] = $step1_import_transit_insurance;
				}

				if (!empty($_FILES['step1_import_other_documents']['name'])) {

					$uploadfilepath = 'uploads/rfc-' . $request_id . '/step1_document/';

					if (!file_exists($uploadfilepath)) {
						mkdir($uploadfilepath, 0777, true);
					}

					$config['upload_path'] = $uploadfilepath;
					$config['file_name'] = $_FILES['step1_import_other_documents']['name'];
					$config['overwrite'] = false;
					$config["allowed_types"] =  $allowed_file_types;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ($this->upload->do_upload('step1_import_other_documents')) {
						$uploadData = $this->upload->data();
						$step1_import_other_documents = base_url($uploadfilepath . $uploadData['file_name']);
					} else {
						$step1_import_other_documents = '';
						$this->session->set_flashdata('error', 'Error in document upload.');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}

					$documents['other_documents'] = $step1_import_other_documents;
				}

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				if (!empty($documents)) {
					$dataStep1['documents'] = json_encode($documents);
				}


				$this->input->post('commercial_invoice_currency');
				$bkdata['commercial_invoice_number'] = $commercial_invoice_number;
				$bkdata['commercial_invoice_value'] = $commercial_invoice_value;
				$bkdata['commercial_invoice_currency'] = $this->input->post('commercial_invoice_currency') ? $this->input->post('commercial_invoice_currency') : 'INR';
				$bkdata['commercial_invoice_date'] = getMysqlDateFormat($commercial_invoice_date);
				$this->seller_model->updateBookShipment($bkdata, $request_id);

				$dataStep1['action_date'] = date('Y-m-d');
				$dataStep1['time'] = date('H:i:s');

				$dataStep1['status'] = 2;

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);

						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					if ($stepdata->status == 2) {

						$dataStep1['status'] = 2;
					}

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Uploaded successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}

				break;
				//		case "step2_import":
				//			
				//						$step_id = $this->input->post('step_id_2');
				//						
				//						$step2_import_correction = $this->input->post('step2_import_correction');
				//						
				//						$step2_import_status = $this->input->post('step2_import_status');
				//						
				//						$dataStep1['request_id'] = $request_id;
				//						$dataStep1['step_id'] = $step_id;
				//						$dataStep1['status'] = $step2_import_status;
				//						$dataStep1['corrections'] = $step2_import_correction;
				//						
				//						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id,$step_id);
				//						
				//						if($stepdata){
				//							
				//							if($this->seller_model->updateStepProcessData($dataStep1,$request_id,$step_id)){
				//                                                            $to = array($seller_email,$ff_email);
				//								$this->sendTrackingMail($to,$documents,'Import',$request_id,$step_id);
				//								$this->session->set_flashdata('success','Updated successfully');
				//								redirect(base_url('fs-track-shipment/'.$request_id));
				//							}else{
				//								$this->session->set_flashdata('error','Something went wrong');
				//								redirect(base_url('fs-track-shipment/'.$request_id));
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
				//								redirect(base_url('fs-track-shipment/'.$request_id));
				//							}else{
				//								$this->session->set_flashdata('error','Something went wrong');
				//								redirect(base_url('fs-track-shipment/'.$request_id));
				//							}
				//						}
				//					break;
			case "step4_import":

				$step_id = $this->input->post('step_id_4');

				$step4_import_correction = $this->input->post('step4_import_correction');

				$step4_import_status = $this->input->post('step4_import_status');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step4_import_status;
				$dataStep1['corrections'] = $step4_import_correction;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata->status == 2) {

					$dataStep1['status'] = $step4_import_status;
				} else {
					$dataStep1['status'] = 3;
				}

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}
				break;
			case "step6_import":

				$step_id = $this->input->post('step_id_6');

				$step6_import_correction = $this->input->post('step6_import_correction');

				$step6_import_status = $this->input->post('step6_import_status');

				
				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step6_import_status;
				$dataStep1['corrections'] = $step6_import_correction;

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}
				break;
			case "step7_import":

				$step_id = $this->input->post('step_id_7');

				$step7_import_correction = $this->input->post('step7_import_correction');

				$step7_import_status = $this->input->post('step7_import_status');

				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = '1';
				$dataStep1['corrections'] = $step7_import_correction;

				$bkdata['neft_payment_details'] = $this->input->post('neft_payment_details');
				$bkdata['neft_payment_details_inbond'] = $this->input->post('neft_payment_details_inbond');
				$bkdata['neft_payment_details_exbond'] = $this->input->post('neft_payment_details_exbond');
				$bkdata['neft_payment_date'] = getMysqlDateFormat($this->input->post('neft_payment_date'));
				$bkdata['neft_payment_date_inbond'] = getMysqlDateFormat($this->input->post('neft_payment_date_inbond'));
				$bkdata['neft_payment_date_exbond'] = getMysqlDateFormat($this->input->post('neft_payment_date_exbond'));
				$this->seller_model->updateBookShipment($bkdata, $request_id);


				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}
				break;
			case "step8_import":

				$step_id = $this->input->post('step_id_8');

				$step8_import_correction = $this->input->post('step8_import_correction');

				$step8_import_status = $this->input->post('step8_import_status');


				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = $step8_import_status;
				$dataStep1['corrections'] = $step8_import_correction;


				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}
				break;
			case "step9_import":

				$step_id = $this->input->post('step9_import_step_id');

				$step9_import_correction = $this->input->post('step9_import_correction');

				$step9_import_status = $this->input->post('step9_import_status');


				$dataStep1['request_id'] = $request_id;
				$dataStep1['step_id'] = $step_id;
				$dataStep1['status'] = 2;
				$dataStep1['corrections'] = $step9_import_correction;

				$bkdata['Bill_status'] = $this->input->post('step9_import_bill_amnt_received');
				$bkdata['document_submited_to_bank_date'] = getMysqlDateFormat($this->input->post('step9_document_submited_to_bank_date'));
				$bkdata['ff_invoice_payment_date'] = getMysqlDateFormat($this->input->post('step9_ff_invoice_payment_date'));
				$bkdata['foreign_trade_policy_compliance'] = $this->input->post('foreign_trade_policy_compliance');
				$this->seller_model->updateBookShipment($bkdata, $request_id);

				$stepdata = $this->seller_model->getShipmentProcessDataByStepId($request_id, $step_id);

				if (!empty($bkdata['Bill_status']) && !empty($bkdata['foreign_trade_policy_compliance'])  && !empty($bkdata['document_submited_to_bank_date']) && !empty($bkdata['ff_invoice_payment_date'])) {
					//update shipment status completed
					$this->freight_model->updateShipmentStatus($request_id, ['status' => '6', 'updated_at' => date('Y-m-d H:i:s')]);
				}
				if ($stepdata) {

					if ($this->seller_model->updateStepProcessData($dataStep1, $request_id, $step_id)) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				} else {

					$insert_id = $this->seller_model->insertStepProcessData($dataStep1);

					if ($insert_id) {
						$to = array($seller_email, $ff_email);
						$this->sendTrackingMail($to, $documents, 'Import', $request_id, $step_id);
						$this->session->set_flashdata('success', 'Updated successfully');
						redirect(base_url('fs-track-shipment/' . $request_id));
					} else {
						$this->session->set_flashdata('error', 'Something went wrong');
						redirect(base_url('fs-track-shipment/' . $request_id));
					}
				}
				break;
			default:
				redirect(base_url('fs-track-shipment/' . $request_id));
		}
	}

	public function cancelShipingRequest()
	{
		if (!empty($this->input->post('request_id'))) {
			$request_id = $this->input->post('request_id');

			$postdata['status'] =  '7';
			$postdata['updated_at'] =  date("Y-m-d H:i:s");
			//$postdata['status'] = 'edited';
			$updated = $this->seller_model->updateRequirement($request_id, $postdata);
			$this->seller_model->cancel_ff_shipment($request_id);
			if ($updated) {
				$this->session->set_flashdata('success', 'Request canceled successfully.');
				redirect(base_url('fs-request-list'));
			}
		}
		$this->session->set_flashdata('error', 'Somethig went wrong.');
		redirect(base_url('fs-request-list'));
	}

	function sendTrackingMail($to, $docs, $trans, $book_id, $currentstep)
	{
		return false; //stop send mails for tracking steps

		$loadedOn_arr[3] = 'Vessel';
		$loadedOn_arr[2] = 'Flight';
		$loadedOn_arr[1] = 'Truck';

		$requestDetails = $this->seller_model->getRequirmentDetails($book_id, $this->seller_session_data['company_id']);
		$stpData = $this->seller_model->getSPSteps($requestDetails->transaction, $requestDetails->mode_id, $requestDetails->shipment_id, $requestDetails->delivery_term_id);
		$subject = "Shipment Status RFC ID : #" . $book_id;
		$message = "<table style='border:1px solid;'>";
		$message .= "<tr><th style='border: 1px solid;padding: 6px;'>Date</th><th style='border: 1px solid;padding: 6px;'>Process</th><th style='border: 1px solid;padding: 6px;'>Correction/Detail</th><th style='border: 1px solid;padding: 6px;'>Status</th></tr>";
		foreach ($stpData as $stData) {
			$shData = $this->seller_model->getShipmentProcessDataByStepId($book_id, $stData->id);
			if (!empty($shData) && $shData->step_id == $stData->id) {
				$status = "Upload Pending";
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
							<td style='border: 1px solid;padding: 6px;text-align: center;'></td>
							<td style='border: 1px solid;padding: 6px;text-align: center;'>" . $stData->step_name . "</td>
							<td style='border: 1px solid;padding: 6px;text-align: center;'></td>
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
			$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);

			if (!empty($requestDetails)) {
				$transctn = $requestDetails->transaction;
				$steps = $this->seller_model->getSPSteps($requestDetails->transaction, $requestDetails->mode_id, $requestDetails->shipment_id, $requestDetails->delivery_term_id);
				$shipmentProcessData = $this->seller_model->getShipmentProcessData($transctn, $request_id);
				$data['shipmentProcessData'] = $shipmentProcessData;
				$data['requestDetails'] = $requestDetails;
				$data['steps'] = $steps;
			}
		}

		$data['page'] = 'frontend/seller/shipping_documents';
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

		$data['shippig_requirment_list'] = $this->seller_model->getReportList($this->seller_session_data['company_id'], $transaction, $fromDate, $toDate);
		$data['fs_details'] = $this->seller_model->getFS_DetailsByCompanyId($this->seller_session_data['company_id']);
		if ($this->input->get('download') == 'true' || $this->input->get('send') == 'true') {
			//The donwload file name:
			// vdebug($data['shippig_requirment_list']);

			$this->load->library('Excel');
			PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
			//              $this->load->library('Excel_io_factory');
			$objPHPExcel = new PHPExcel();
			$filename = $transaction . "_report_" . date('Ymd') . ".xls";


			$tmpfile = tempnam(sys_get_temp_dir(), 'html');

			if($transaction=='Export'){
				file_put_contents($tmpfile, $this->load->view('frontend/seller/reports_export_template', $data, true));
			}else{
				file_put_contents($tmpfile, $this->load->view('frontend/seller/reports_import_template', $data, true));
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

				$fs_details = $this->seller_model->getFS_DetailsByCompanyId($this->seller_session_data['company_id']);
				$mailSend = sendEmail_report($fs_details->email, $fs_details->name, $transaction, $data['from_dt'], $data['to_dt'], $arrAttachments);
				unlink($tmpfileExcelfile);
				if ($mailSend) {
					$this->session->set_flashdata('success', 'Report send successfully.');
					redirect(base_url("fs-reports/$transaction"));
				} else {
					$this->session->set_flashdata('error', 'Report sending faild.');
					redirect(base_url("fs-reports/$transaction"));
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
			$data['page'] = 'frontend/seller/reports';
			$data['sidebar'] = 'frontend/components/sidebar_dashboard';
			$this->load->view('frontend/layout_main', $data);
		}
	}

	function copy_to_new_request($request_id)
	{



		$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);

		if (!empty($requestDetails)) {
			$insertdata = array(

				'mode_id' => $requestDetails->mode_id,
				'transaction' => $requestDetails->transaction,
				'delivery_term_id' => $requestDetails->delivery_term_id,
				'shipment_id' => $requestDetails->shipment_id,
				'container_stuffing' => $requestDetails->container_stuffing,
				'stuffing' => $requestDetails->stuffing,
				'cargo_status' => $requestDetails->cargo_status,
				'consignor_name' => $requestDetails->consignor_name,
				'consignor_company_name' => $requestDetails->consignor_company_name,
				'consignor_email' => $requestDetails->consignor_email,
				'consignor_country_code' => $requestDetails->consignor_country_code,
				'consignor_phone' => $requestDetails->consignor_phone,
				'consignor_address_line_1' => $requestDetails->consignor_address_line_1,
				'consignor_address_line_2' => $requestDetails->consignor_address_line_2,
				'consignor_city_name' => $requestDetails->consignor_city_name,
				'consignor_city_id' => $requestDetails->consignor_city_id,
				'consignor_state_id' => $requestDetails->consignor_state_id,
				'consignor_country_id' => $requestDetails->consignor_country_id,
				'consignor_pincode' => $requestDetails->consignor_pincode,
				'consignee_company_name' => $requestDetails->consignee_company_name,
				'consignee_email' => $requestDetails->consignee_email,
				'consignee_name' => $requestDetails->consignee_name,
				'consignee_country_code' => $requestDetails->consignee_country_code,
				'consignee_phone' => $requestDetails->consignee_phone,
				'consignee_address_line_1' => $requestDetails->consignee_address_line_1,
				'consignee_address_line_2' => $requestDetails->consignee_address_line_2,
				'consignee_city_name' => $requestDetails->consignee_city_name,
				'consignee_city_id' => $requestDetails->consignee_city_id,
				'consignee_state_id' => $requestDetails->consignee_state_id,
				'consignee_country_id' => $requestDetails->consignee_country_id,
				'consignee_pincode' => $requestDetails->consignee_pincode,
				'shipment_value' => $requestDetails->shipment_value,
				'shipment_value_currency' => $requestDetails->shipment_value_currency,
				'port_loading_id' => $requestDetails->port_loading_id,
				'port_loading_name' => $requestDetails->port_loading_name,
				'port_discharge_id' => $requestDetails->port_discharge_id,
				'port_discharge_name' => $requestDetails->port_discharge_name,
				'tentativ_date_dispatch' => $requestDetails->tentativ_date_dispatch,
				'tentativ_date_delivery' => $requestDetails->tentativ_date_delivery,
				'special_consideration_lcl' => $requestDetails->special_consideration_lcl,
				'payment_term' => $requestDetails->payment_term,
				'transaction_currency' => $requestDetails->transaction_currency ? $requestDetails->transaction_currency : 'INR',
				'response_end_date' => $requestDetails->response_end_date,
				'is_other_consignor' => $requestDetails->is_other_consignor,
				'is_other_consignee' => $requestDetails->is_other_consignee,
				'referance_from_rfc' => $requestDetails->request_id,
				'user_id' => $this->seller_session_data['id'],
				'fs_company_id' => $this->seller_session_data['company_id'] ? $this->seller_session_data['company_id'] : null
			);

			$new_request_id = $this->seller_model->insertRequirement($insertdata);


			if ($requestDetails->is_other_consignor == 'Yes') {
				$this->seller_model->updateOtherAddress($new_request_id, 'consignor', (array) $requestDetails->consignor_other);
			}
			if ($requestDetails->is_other_consignee == 'Yes') {
				$this->seller_model->updateOtherAddress($new_request_id, 'consignee', (array) $requestDetails->consignee_other);
			}

			if ($requestDetails->shipment_id == '1') {
				//FCL
				$this->insertRequestItems($new_request_id, $requestDetails->container, 'container');
			} else if ($requestDetails->shipment_id == '2') {
				//LCL
				$this->insertRequestItems($new_request_id, $requestDetails->package, 'package');
			}
			$this->session->set_flashdata('success', 'Request details coppied successfully.');
			redirect(base_url("edit-shipping-requirement/$new_request_id"));
		}

		$this->session->set_flashdata('error', 'Something went wrong.');
		redirect(base_url($_SERVER['HTTP_REFERER']));
	}

	public function annualContractList()
	{

		$data['leftmenuActive'] = "projects";
		$data['leftSubMenuActive'] = "annual-contract";
		$data['booking_list'] = []; // $this->seller_model->getBookingList($this->seller_session_data['company_id']);

		$data['page'] = 'frontend/seller/projects/annual_contract_list';

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
		$filter['role'] = '2';


		echo json_encode($this->annual_contract_model->get_annual_contract_list($company_id, $_POST['start'], $_POST['length'], $filter, '', $orderBy));
		die;
	}

	public function createAnnualContract($annualContractId = '')
	{
		$data['leftmenuActive'] = "projects";
		$data['leftSubMenuActive'] = "annual-contract";
		$data['annualContractDetails'] = new stdClass;

		//is_fs_kyc_approved();//check user kyc is approved or not
		if ($annualContractId) {
			//get details of annual contract
			$data['annualContractDetails'] = $this->annual_contract_model->getDetails($annualContractId, $this->seller_session_data['company_id']);
			// vdebug($data['annualContractDetails']);

			if($data['annualContractDetails']->status !='1'){
				$this->session->set_flashdata('error', 'You Can\'t modify annual contract.');
				redirect(base_url('fs-annual-contract-list'));
			}

		}

		// $data['shipments'] = $this->shipment_model->getList(true);
		// $data['contracts'] = $this->contract_model->getList(true);
		$data['modes'] = $this->mode_model->getList();

		if ($this->input->post()) {
			$insertData['fs_company_id'] = $this->seller_session_data['company_id'];
			$insertData['user_id'] = $this->seller_session_data['id'];
			$insertData['annual_contract_title'] = $this->input->post('annual_contract_title');
			$insertData['terms_and_conditions'] = $this->input->post('terms_and_conditions');
			$insertData['start_date'] = getMysqlDateFormat($this->input->post('start_date'));
			$insertData['end_date'] = getMysqlDateFormat($this->input->post('end_date'));
			$routes = $this->input->post('route');


			if ($annualContractId) {
				//update
				$insertData['updated_at'] = date('Y-m-d H:i:s');
				$update = $this->annual_contract_model->update($annualContractId, $insertData);
				$keepRouteIds = [];
				foreach ($routes as $route) {
					if ($route['id']) {
						//update
						$keepRouteIds[] = $route['id'];
						$this->annual_contract_route_model->update($route['id'], $route);
					} else {
						//insert
						$route['annual_contract_id'] = $annualContractId;
						$keepRouteIds[] = $this->annual_contract_route_model->insert($route);
					}
				}

				//delete removed roues;
				$this->annual_contract_route_model->delete('', $annualContractId, $keepRouteIds);

				if ($update) {
					$this->session->set_flashdata('success', 'Annual contract has been updated.');
				}
			} else {
				//insert
				$annualContractId = $this->annual_contract_model->insert($insertData);
				foreach ($routes as $route) {
					$route['annual_contract_id'] = $annualContractId;
					$this->annual_contract_route_model->insert($route);
				}

				if ($annualContractId) {
					$this->session->set_flashdata('success', 'Annual contract has been created.');
				} else {
					$this->session->set_flashdata('error', 'Something went wrong.');
				}
			}

			if ($this->input->post('submit') == 'Save') {
				redirect(base_url('fs-annual-contract-list'));
			} else {
				redirect(base_url('annual-contract-select-ff/' . $annualContractId));
			}
		}

		$data['modeList'] = $this->mode_model->getList(true);
		$data['shipmentList'] = $this->shipment_model->getList(true);
		$data['cargoTypeList'] = ['Stackable', 'Non-Stackable'];
		$data['cargoNatureList'] = ['Hazardous', 'Non-Hazardous'];
		$data['transactionList'] = ['Import', 'Export'];

		$data['container_types'] = $this->container_model->getList();
		$data['packingList'] = $this->packing_model->getList();
		$data['containerSizeList'] = $this->container_size_model->getList();
		$data['page'] = 'frontend/seller/projects/create_annual_contract';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function comparativeAnnualContract($annualContractId = '')
	{
		$data['leftmenuActive'] = "projects";
		$data['leftSubMenuActive'] = "annual-contract";
		$data['annualContractDetails'] = new stdClass;
		$mode_id = $this->input->get('mode_id');
		$filter = [];
		if ($this->input->get('transaction')) {
			$filter['transaction'] = $this->input->get('transaction');
		}
		if ($this->input->get('shipment')) {
			$filter['shipment_id'] = $this->input->get('shipment');
		}
		if ($this->input->get('sp')) {
			$filter['sp'] = $this->input->get('sp');
		}
		$data['mode_id'] = $mode_id;
		$data['rfcCategory'] = $this->freight_model->getAnnualCotntractRfcChargesCategory('', '', $mode_id);
		$data['serviceProviderList'] = $this->annual_contract_model->getServiceProviderList($annualContractId, $this->seller_session_data['company_id']);

		//is_fs_kyc_approved();//check user kyc is approved or not
		if ($annualContractId) {
			//get details of annual contract
			$data['annualContractDetails'] = $this->annual_contract_model->getComparativeDetails($annualContractId, $this->seller_session_data['company_id'], $mode_id, $filter);
			// vdebug($data['annualContractDetails']);
		}

		if ($this->input->post()) {
			// vdebug($_POST);
			if (strcasecmp($this->input->post('submitBtn'), 'Send Counter Offer') == 0) {
				$route_id = $this->input->post('route_id');
				$ff_company_id = $this->input->post('ff_company_id');
				$charges = $this->input->post('rfc_charges');
				$isUpdateCharges=[];
				foreach ($charges as $chargKey => $chargecategory) {
					foreach ($chargecategory['subcategory'] as $subcategory) {
						$chargesInsert['route_id'] = $route_id;
						$chargesInsert['annual_contract_id'] = $annualContractId;
						$chargesInsert['ff_company_id'] = $ff_company_id;
						$chargesInsert['rfc_charges_id'] = $subcategory['rfc_charges_id'];
						$chargesInsert['counter_offer'] = $subcategory['counter_offer'];
						//update counter offer

						$isUpdateCharges[] = $this->annual_contract_route_rfc_charges_model->updateCounterOffer($chargesInsert);
					}
					if (isset($chargecategory['counter_offer'])) {
						//update counter offer
						$isUpdateCharges[] = $this->annual_contract_route_rfc_charges_model->updateOtherCounterOffer($chargecategory['id'], $route_id, $ff_company_id, $chargecategory['counter_offer']);
					}
				}

				$counter_rate = $this->input->post('counter_rate');
				$updated = $this->annual_contract_route_model->updateCounterRate($route_id, $ff_company_id, $counter_rate);
				//update quote status to 5 (counter offer)
				$updateData = ['quote_status' => '5'];
				$update = $this->annual_contract_mapp_ff_model->update($annualContractId, $ff_company_id, $updateData);

				if ($updated) {
					$this->session->set_flashdata('success', 'Counter rate updated.');
				} else {
					$this->session->set_flashdata('error', 'Counter rate not updated.');
				}
			}


			if (strcasecmp($this->input->post('submitBtn'), 'Award Contract') == 0) {

				$ff_company_id = $this->input->post('ff_company_id');
				$updated = $this->annual_contract_mapp_ff_model->update($annualContractId, $ff_company_id, ['awarded_contract_dt' => date('Y-m-d H:i:s')]);
				$update = $this->annual_contract_model->update($annualContractId,['status'=>'4']);
				if ($updated) {
					$this->session->set_flashdata('success', 'Annual contract awarded.');
				} else {
					$this->session->set_flashdata('error', 'Something went Wrong.');
				}
			}


			redirect(base_url("fs-annual-contract-comparative/$annualContractId?mode_id=$mode_id"));
		}
		// $data['shipments'] = $this->shipment_model->getList(true);
		// $data['contracts'] = $this->contract_model->getList(true);
		//$data['modes'] = $this->mode_model->getList();


		$data['modeList'] = $this->mode_model->getList(true);
		$data['shipmentList'] = $this->shipment_model->getList(true);
		$data['cargoTypeList'] = ['Stackable', 'Non-Stackable'];
		$data['cargoNatureList'] = ['Hazardous', 'Non-Hazardous'];
		$data['transactionList'] = ['Import', 'Export'];

		$data['container_types'] = $this->container_model->getList();
		$data['packingList'] = $this->packing_model->getList();
		$data['containerSizeList'] = $this->container_size_model->getList();
		$data['page'] = 'frontend/seller/projects/comparative_annual_contract';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}

	public function downloadAnnualContractComparative($annualContractId)
	{

		//$toDate = $_GET['to_dt'] ? getMysqlDateFormat($_GET['to_dt']) : date('Y-m-d');
		//	$fromDate = $_GET['from_dt'] ? getMysqlDateFormat($_GET['from_dt']) : date('Y-m-d', strtotime('-7 days ' . $toDate));

		//$data['from_dt'] = printFormatedDate($fromDate);
		//	$data['to_dt'] = printFormatedDate($toDate);

		$mode_id = $this->input->get('mode_id');
		$data['mode_id'] = $mode_id;
		$data['rfcCategory'] = $this->freight_model->getAnnualCotntractRfcChargesCategory('', '', $mode_id);
		$data['riderLables'] = $this->freight_model->getAnnualContractRiders('', '', $mode_id);
		// vdebug($data);
		$data['annualContractDetails'] =  $this->annual_contract_model->getComparativeDetails($annualContractId, $this->seller_session_data['company_id'], $mode_id);
		//	$data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($this->seller_session_data['company_id']);
		//        vdebug($data['fs_details']);
		//	if ($this->input->get('download') == 'true' || $this->input->get('send') == 'true') {
		//The donwload file name:

		$this->load->library('Excel');
		PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		//              $this->load->library('Excel_io_factory');
		$objPHPExcel = new PHPExcel();
		$filename = "annual_contract_comparative_" . $annualContractId . "_" . date('Ymd') . ".xls";

		// echo $this->load->view('frontend/freightforwarder/projects/download_annual_contract_template', $data,true);
		// die;
		$tmpfile = tempnam(sys_get_temp_dir(), 'html');
		file_put_contents($tmpfile, $this->load->view('frontend/seller/projects/download_annual_contract_comparative_template', $data, true));
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
	}


	public function annualContract_select_ff($annualContractId)
	{

		$data['leftmenuActive'] = "projects";
		$data['leftSubMenuActive'] = "annual-contract";
		$selectFFMax_limit = 7;
		$filterData = ['sectors' => array(), 'location' => '', 'name' => '', 'isActive' => '1', 'public_status' => '0'];
		if ($this->input->post() && $this->input->post('btn_submit') == 'Search') {
			$filterData['sectors'] = !empty($this->input->post('sr_sector')) ? $this->input->post('sr_sector') : array();
			$filterData['location'] = $this->input->post('location');
			$filterData['name'] = $this->input->post('name');
			$ff_list =  $this->seller_model->getFfList($filterData);
		} else {
			$ff_list =  $this->seller_model->getFfList(['isActive' => '1', 'public_status' => '0']);
		}
		$data['filterData'] = $filterData;
		//                vdebug($_POST);
		$data['selectedFFids'] = $this->annual_contract_mapp_ff_model->getSelectedFfids($annualContractId);



		if ($this->input->post() && $this->input->post('btn_submit') == 'Request for Quote') {
			//remove old 
			// $this->seller_model->deleteRequestFf($request_id);
			$totalFFcount = count($this->input->post('ff_company_id')) + count($data['selectedFFids']);
			if ($totalFFcount > $selectFFMax_limit) {
				$this->session->set_flashdata('message', '<div  class="alert alert-warning alert-dismissible fade show" role="alert">
                             You can select maximum ' . $selectFFMax_limit . ' Freight Forwarders.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>');
				redirect(base_url('annual-contract-select-ff/' . $annualContractId));
			}

			if ($this->input->post('ff_company_id')) {
				foreach ($this->input->post('ff_company_id') as $ff_company_id) {
					$insertData = [
						'annual_contract_id' => $annualContractId,
						'ff_company_id' => $ff_company_id,
						'quote_status' => '2',
					];
					//send email
					//$ff_company_details = $this->seller_model->getFF_DetailsByCompanyId($ff_company_id);
					//$ff_name = $ff_company_details->salutation . ' ' . $ff_company_details->firstname . ' ' . $ff_company_details->lastname;
					//$url = base_url('edit-request-details/' . $request_id);
					//$url = "<a href='$url' target='_blank'>$url</a>";
					//sendEmail_rfcSend($ff_company_details->email, $ff_name, $url, $request_id);
					$this->annual_contract_mapp_ff_model->insert($insertData);
				}

				
				//update annual contract status to request quote(2)
				$update = $this->annual_contract_model->update($annualContractId, ['status'=>'2']);
				$this->session->set_flashdata('success', 'Request sent successfully. You will receive Request for Comparative within One or Two Working days.');
				$this->session->set_flashdata('message', '<div  class="alert alert-success alert-dismissible fade show" role="alert">
                             Request sent successfully. You will receive Request for Comparative within One or Two Working days.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>');
				redirect(base_url('fs-annual-contract-list'));
			} else {
				$this->session->set_flashdata('message', '<div  class="alert alert-warning alert-dismissible fade show" role="alert">
                             Please select Fraight Forwarder to send fraight request.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>');
				redirect(base_url('annual-contract-select-ff/' . $annualContractId));
			}
		} else if ($this->input->post() && $this->input->post('btn_submit') == 'Save & Continue') {

			//redirect(base_url('confirm-shipment/' . $request_id . '/' . $this->input->post('ff_company_id')));
		}

		$data['ff_list'] = $ff_list;

		//	$data['requestDetails'] = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		//	$data['skipComparative'] = ($data['requestDetails']->delivery_term_id == 1 && $data['requestDetails']->transaction == 'Export') || (in_array($data['requestDetails']->delivery_term_id, ['5', '6', '7']) && $data['requestDetails']->transaction == 'Import');

		$data['sectors'] = $this->sector_model->getList($active = true);
		$data['page'] = 'frontend/seller/projects/annual_contract_select_ff';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		//            $this->load->helper('vayes_helper');
		//                vdebug( $data);

		$this->load->view('frontend/layout_main', $data);
	}

	public function deleteAnnualContract()
	{

		if ($this->input->post('annual_contract_id')) {

			$annual_contract_id = $this->input->post('annual_contract_id');
			$company_id = $this->seller_session_data['company_id'];
			if ($this->annual_contract_model->deleteAnnualContract($annual_contract_id,$company_id)) {
				$this->session->set_flashdata('success', 'Annual Contract has been deleted.');
				redirect(base_url('fs-annual-contract-list'));
				exit();
			}
		}

		$this->session->set_flashdata('error', 'Something went wrong.');
		redirect(base_url('fs-annual-contract-list'));
		exit();
	}

	public function cancelAnnualContract()
	{

		if ($this->input->post('annual_contract_id')) {

			$annual_contract_id = $this->input->post('annual_contract_id');
			// $company_id = $this->seller_session_data['company_id'];
			$dataUpdate = [
				'status'=>6,
				'updated_at'=>date('Y-m-d H:i:s')
			];
			if ($this->annual_contract_model->update($annual_contract_id,$dataUpdate)) {
				$this->session->set_flashdata('success', 'Annual Contract has been cancelled.');
				redirect(base_url('fs-annual-contract-list'));
				exit();
			}
		}

		$this->session->set_flashdata('error', 'Something went wrong.');
		redirect(base_url('fs-annual-contract-list'));
		exit();
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

	public function deleteRfc()
	{

		if ($this->input->post('request_id')) {

			$request_id = $this->input->post('request_id');
			if ($this->seller_model->deleteRFC($request_id)) {
				$this->session->set_flashdata('success', 'RFC Deleted.');
				redirect(base_url('fs-request-list'));
				exit();
			}
		}

		$this->session->set_flashdata('error', 'Something went wrong.');
		redirect(base_url('fs-request-list'));
		exit();
	}


	public function removeFF_fromComparative(){
		if($this->input->post()){
			$ff_company_id = $this->input->post('ff_company_id');
			$request_id = $this->input->post('request_id');
			echo "ff_company_id=$ff_company_id  request_id=$request_id";
			//get quote details
			$requestDetails = $this->freight_model->getRequirmentDetails($request_id, $ff_company_id);
			$deleted='';
			if($requestDetails->quote_status=='2'){
				//delete
				$deleted = $this->seller_model->deleteRequestFf($request_id,$ff_company_id);
			}
			if($deleted){
				$this->session->set_flashdata('success', 'FF removed.');
			}else{
				$this->session->set_flashdata('error', 'Something went wrong.');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}

		
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seller_dms extends CI_Controller
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
			if ($this->seller_session_data['role'] !== ROLE_IMPORTER_EXPORTER) {
				redirect(base_url());
			}
		}

		$this->load->model('seller_model');
		$this->load->model('city_model');
		$this->load->model('document_master_form');
		$this->load->model('shipment_document_master');
		$this->load->model('shipment_documents');
		$this->load->model('mode_model');
		$this->load->model('shipment_model');
		$this->load->model('deliver_term_model');
		$this->load->model('company_bank');
		$this->load->model('branch_model');
		$this->load->helper('cookie');
		$this->load->library(array('session', 'form_validation', 'email'));
	}

	public function index()
	{
		$master_form_id = $this->input->get('mf');
		$request_id = $this->input->get('rq');
		$masterFormDetails = '';
		if (!empty($master_form_id)) {
			//get master form details
			$masterFormDetails = $this->document_master_form->getRecord($master_form_id, '', $this->seller_session_data['company_id']);
		} else if (!empty($request_id)) {
			//get master form details
			$masterFormDetails = $this->document_master_form->getRecord('', $request_id, $this->seller_session_data['company_id']);
		}

		if (empty($masterFormDetails)) {
			$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Information form details not found.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';

			$this->session->set_flashdata('message', $message);
			redirect(base_url('fs-document-master-list'));
		}

		$data['leftmenuActive'] = "";
		$data['leftSubMenuActive'] = "";
		$requestDetails = $this->seller_model->getRequirmentDetails($masterFormDetails->request_id, $this->seller_session_data['company_id']);
		$documetTypeList = $this->shipment_documents->getDocumentList($masterFormDetails->id, $this->seller_session_data['company_id'], ['transiction' => ['All', $requestDetails->transaction]]);
		$data['page'] = 'frontend/seller/dms/index';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['requestDetails'] = $requestDetails;
		$data['masterFormDetails'] = $masterFormDetails;
		$data['documetTypeList'] = $documetTypeList;
		// vdebug($documetTypeList);
		$this->load->view('frontend/layout_main', $data);
	}

	public function create($master_form_id, $document_type)
	{
		$data['leftmenuActive'] = "";
		$data['leftSubMenuActive'] = "";

		$masterFormDetails = $this->document_master_form->getRecord($master_form_id, '', $this->seller_session_data['company_id']);
		//$requestDetails = $this->seller_model->getRequirmentDetails($master_form_id, $this->seller_session_data['company_id']);
		$documentPermission = checkDocumentPermission($document_type, $masterFormDetails->transaction, $masterFormDetails->mode, $masterFormDetails->shipment, 'EXIM');
		if (empty($documentPermission) || $documentPermission == '0' || $documentPermission == 'view') {
			$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Access denied
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';

			$this->session->set_flashdata('message', $message);
			redirect($_SERVER['HTTP_REFERER']);
		}

		$documetTypeList = $this->shipment_document_master->getList(['transiction' => ['All', $masterFormDetails->transaction], 'user_type' => ['All', 'IE']]);
		$data['page'] = "frontend/seller/dms/$document_type";
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['masterFormDetails'] = $masterFormDetails;
		$data['documetTypeList'] = $documetTypeList;
		$data['modes'] = $this->mode_model->getList();
		$data['delivery_terms'] = $this->deliver_term_model->getList();
		
		$data['shipments'] = $this->shipment_model->getList(true);
		$documentData = $this->shipment_documents->getRecord($masterFormDetails->id, $document_type, $this->seller_session_data['company_id']);

		if (empty($documentData)) {
			$documentData = $this->getFormatedData($document_type, $masterFormDetails);
			// $documentData->other_details = json_decode($masterFormDetails->other_details);
			// $documentData->invoice_number = $masterFormDetails->invoice_number;
			// $documentData->invoice_date = $masterFormDetails->invoice_date;
		} else {
			$documentData->items = json_decode($documentData->items);
			$documentData->other_details = json_decode($documentData->other_details);
		}

		if ($this->input->post()) {
			// vdebug($_POST);
			$totalQty = 0.00;
			$total_package_qty = 0.00;
			$total_net_wt = 0.00;
			$total_gross_wt = 0.00;
			$total_measurment = 0.00;
			$invoice_amount = 0.00;
			foreach ($this->input->post('items') as $item) {

				if (isset($item['products'])) {
					foreach ($item['products'] as $product) {
						$totalQty += $product['qty'];
					}
				} else {
					$totalQty += $item['qty'];
				}

				$total_package_qty += $item['package_qty'];

				if (isset($item['net_wt_per_pk'])) {
					$total_net_wt += $item['net_wt_per_pk'] * $item['package_qty'];
				} else {
					$total_net_wt += $item['net_wt'];
				}
				if (isset($item['gross_wt_per_pk'])) {
					$total_gross_wt += $item['gross_wt_per_pk'] * $item['package_qty'];
				} else {
					$total_gross_wt += $item['gross_wt'];
				}

				$total_measurment += $item['measurment'];

				$invoice_amount += ceil($item['qty'] * $item['price']);
			}

			if (isset($_FILES['signature']['tmp_name']) && !empty($_FILES['signature']['tmp_name'])) {
				//	$signFile = addslashes(file_get_contents($_FILES['signature']['tmp_name']));
				$imageFileType = strtolower(pathinfo($_FILES['signature']['tmp_name'], PATHINFO_EXTENSION));

				// Convert to base64 
				$image_base64 = base64_encode(file_get_contents($_FILES['signature']['tmp_name']));
				$signFile = 'data:image/' . $imageFileType . ';base64,' . $image_base64;
			} else {
				$signFile = $documentData->signature;
			}

			$submitBtn = $this->input->post('submitBtn');
			$status = '0';
			if (strcasecmp("Create Document", $submitBtn) == 0) {
				$status = '1';
			}

			$saveData = [
				'invoice_number' => $this->input->post('invoice_number'),
				'invoice_date' => getMysqlDateFormat($this->input->post('invoice_date')),
				'currency' => $this->input->post('currency'),
				'invoice_amount' => $invoice_amount,
				'total_qty' => $totalQty,
				'total_package_qty' => $total_package_qty,
				'total_net_wt' => $total_net_wt,
				'total_gross_wt' => $total_gross_wt,
				'total_measurment' => $total_measurment,
				'items' => json_encode($this->input->post('items')),
				'other_details' => json_encode($this->input->post('other_details')),
				'for_consignor_company' => $this->input->post('for_consignor_company'),
				'signature' => $signFile,
				'issue_place' => $this->input->post('issue_place'),
				'issue_date' => getMysqlDateFormat($this->input->post('issue_date')),
				'status' => $status,
			];
			if (isset($documentData->id)) {
				//update

				$update = $this->shipment_documents->update($documentData->id, $saveData);
			} else {
				//insert

				$saveData['master_form_id'] = $master_form_id;
				$saveData['request_id'] = $masterFormDetails->request_id ? $masterFormDetails->request_id : 0;
				$saveData['company_id'] = $this->seller_session_data['company_id'];
				$saveData['document_type'] = $document_type;
				$saveData['created_by'] = $this->seller_session_data['id'];
				$update =	$this->shipment_documents->insert($saveData);
			}
			$message = '';
			if ($update) {				$message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Document saved!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
			} else {
				$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Document not saved please try again.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
			}
			$this->session->set_flashdata('message', $message);
			if (strcasecmp("Create Document", $submitBtn) == 0) {
				redirect(base_url("fs-dms?mf=$master_form_id"));
			} else {
				redirect(base_url("fs-dms?mf=$master_form_id"));
			}
		}

		$data['documentData'] = (object)$documentData;
		$this->load->view('frontend/layout_main', $data);
	}

	private function getFormatedData($document_type, $masterFormDetails)
	{
		$formatedData = new stdClass();

		$conversion_rate = isset($_GET['conversion_rate'])?$_GET['conversion_rate']:'';
		//Start get kyc document details
		//GST
		$kycDetails = $this->seller_model->getUserKYC($this->seller_session_data['company_id'], '5');
		$gst_no = $kycDetails->number;

		//PAN
		$kycDetails = $this->seller_model->getUserKYC($this->seller_session_data['company_id'], '1');
		$pan_no = $kycDetails->number;

		//LUT No
		$kycDetails = $this->seller_model->getUserKYC($this->seller_session_data['company_id'], '6');
		$lut_no = $kycDetails->number;
		$lut_valid_date = printFormatedDate($kycDetails->doc_valid_date);

		//IEC No
		$kycDetails = $this->seller_model->getUserKYC($this->seller_session_data['company_id'], '4');
		$iec_no = $kycDetails->number;

		$formatedData->other_details = json_decode($masterFormDetails->other_details);
		$formatedData->items = json_decode($masterFormDetails->items);
		$other_details = $formatedData->other_details;
		
		$formatedData->other_details->iec_no = $iec_no;
		$formatedData->other_details->gst_no = $gst_no;
		$formatedData->other_details->pan_no = $pan_no;
		$formatedData->other_details->lut_no = $lut_no;
		$formatedData->other_details->export_under_lut_no_valid_date = $lut_valid_date;
		$formatedData->currency = 'INR';
		$formatedData->created_at = date('Y-m-d');
		$formatedData->signature = $masterFormDetails->signature;

		//get bank details
		$bankDetails = $this->company_bank->getActiveBankDetails($this->seller_session_data['company_id']);
		$formatedData->other_details->bank_name = $bankDetails->bank_name;
		$formatedData->other_details->account_number = $bankDetails->account_number;
		$formatedData->other_details->ifsc_code = $bankDetails->ifsc_code;
		$formatedData->other_details->swift_code = $bankDetails->swift_code;
		$formatedData->other_details->ad_code = $bankDetails->ad_code;

		$formatedData->other_details->exporter = ($other_details->exporter_company_name?"<b>$other_details->exporter_company_name</b>":"").($other_details->exporter_address_line_1?"<br>$other_details->exporter_address_line_1":'').($other_details->exporter_address_line_2?"<br>$other_details->exporter_address_line_2":"").($other_details->exporter_city?"<br>$other_details->exporter_city":""). ($other_details->exporter_pincode?" - $other_details->exporter_pincode":"");//<br>Contact Person Name: $other_details->exporter_person_name<br>Contact Number: $other_details->exporter_contact_number
		$formatedData->other_details->consignee = ($other_details->consignee_company_name?"<b>$other_details->consignee_company_name</b>":"").($other_details->consignee_address_line_1?"<br>$other_details->consignee_address_line_1":"").($other_details->consignee_address_line_2?"<br>$other_details->consignee_address_line_2":"").($other_details->consignee_city?"<br>$other_details->consignee_city":"").($other_details->consignee_pincode?" - $other_details->consignee_pincode":"");//<br>Contact Person Name: $other_details->consignee_person_name<br>Contact Number: $other_details->consignee_contact_number
		$formatedData->other_details->buyer = ($other_details->buyer_company_name?"<b>$other_details->buyer_company_name</b>":"").($other_details->buyer_address_line_1?"<br>$other_details->buyer_address_line_1":"").($other_details->buyer_address_line_2?"<br>$other_details->buyer_address_line_2":"").($other_details->buyer_city?"<br>$other_details->buyer_city":"").($other_details->buyer_pincode?" - $other_details->buyer_pincode":"");//<br>Contact Person Name: $other_details->buyer_person_name<br>Contact Number: $other_details->buyer_contact_number
		$formatedData->other_details->notify_party = ($other_details->notify_party_company_name?"<b>$other_details->notify_party_company_name</b>":"").($other_details->notify_party_address_line_1?"<br>$other_details->notify_party_address_line_1":"").($other_details->notify_party_address_line_2?"<br>$other_details->notify_party_address_line_2":"").($other_details->notify_party_city?"<br>$other_details->notify_party_city":"").($other_details->notify_party_pincode?" - $other_details->notify_party_pincode":"");//<br>Contact Person Name: $other_details->notify_party_person_name<br>Contact Number: $other_details->notify_party_contact_number

		$formatedData->other_details->exporter_address = "$other_details->exporter_address_line_1 $other_details->exporter_address_line_2 $other_details->exporter_city".($other_details->exporter_pincode?" - $other_details->exporter_pincode":"");
		$formatedData->other_details->consignee_address = "$other_details->consignee_address_line_1 $other_details->consignee_address_line_2 $other_details->consignee_city".($other_details->consignee_pincode?" - $other_details->consignee_pincode":"");
		$formatedData->other_details->buyer_address = "$other_details->buyer_address_line_1 $other_details->buyer_address_line_2 $other_details->buyer_city ".($other_details->buyer_pincode?" - $other_details->buyer_pincode":"");
		$formatedData->other_details->notify_party_address = "$other_details->notify_party_address_line_1 $other_details->notify_party_address_line_2 $other_details->notify_party_city".($other_details->notify_party_pincode?" - $other_details->notify_party_pincode":"");

		$formatedData->other_details->shipping_marks_from = $other_details->exporter_company_name;
		$formatedData->other_details->shipping_marks_to = $other_details->consignee_company_name;
		$formatedData->for_consignor_company = $other_details->exporter_company_name;

		$formatedData->other_details->bol_awb_no = '';
		$formatedData->other_details->bol_awb_dated = '';
		if ($masterFormDetails->mode_id == '3') {
			//mode sea
			$formatedData->other_details->bol_awb_no = $other_details->bill_of_lading;
			$formatedData->other_details->bol_awb_dated = $other_details->bill_of_lading_date;
		} else if ($masterFormDetails->mode_id == '2') {
			//mode air
			$formatedData->other_details->bol_awb_no = $other_details->airway_bill_number;
			$formatedData->other_details->bol_awb_dated = $other_details->airway_bill_date;
		}else if($masterFormDetails->mode_id == '1'){
			//mode road
			$formatedData->other_details->bol_awb_no = $other_details->lorry_number;
			$formatedData->other_details->bol_awb_dated = $other_details->lorry_date;
		}

		$customeInvoiceDocument = $this->shipment_documents->getRecord($masterFormDetails->id, 'custom-invoice', $this->seller_session_data['company_id']);

		if ($customeInvoiceDocument) {

			$customeInvoiceDocument->items = json_decode($customeInvoiceDocument->items);
			$customeInvoiceDocument->other_details = json_decode($customeInvoiceDocument->other_details);
		}
		switch ($document_type) {
			case 'custom-invoice':
				$declaration = [
					'commercial-shipment' => "\"We intend to claim rewards under 'Remission of Duties and Taxes on Exported Products (RoDTEP)' and Drawback S/bill All Industry Schedule Tariff.\"<br>I/We undertake to abide by provisions of Foreign Exchange Management Act, 1999, as amended from time to time, including realization/repatriation of foreign exchange to/from India.<br><br>Declaration :<br>We declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct.",
					'sample-shipment' => "\"This invoice does not contain any commericial transaction and doen not involve any Foreign Exchange, This goods are being exported for (Sample/Testing Purpose) only.\"<br><br>Value declared for customs purpose only.<br><br>Declaration :<br>We declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct",
					'advance-license-shipment' => "\" We are exporting this material Sr. no. ___to_____ against Advance License Number _____________ dated________\"<br><br>\"We intend to claim rewards under 'Remission of Duties and Taxes on Exported Products (RoDTEP)'.\"<br><br>\"I/We undertake to abide by provisions of Foreign Exchange Management Act, 1999, as amended from time to time, including realization/repatriation of foreign exchange to/from India.\"<br><br>Declaration :<br>We declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct.",
					'epcg-shipment' => "\"We are exporting this material Sr. no. ___to_____ against EPCG License Number _____________ dated________\"<br>\"We intend to claim rewards under 'Remission of Duties and Taxes on Exported Products (RoDTEP)'.\"<br>\"I/We undertake to abide by provisions of Foreign Exchange Management Act, 1999, as amended from time to time, including realization/repatriation of foreign exchange to/from India.\"<br><br>Declaration :<br>We declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct.",
					'return-to-origin-shipment' => "\"We intend to claim drawback under Section 74.\"<br><br>\"We are sending this material for (Testing Purpose) re-export under Section 74 (Imported vide Invoice No. _______ dated ______, BE No. ________ dated ______, Quantity ______, Value ________, Duty Paid _________, Total Drawback claimed: Rs. _____% of Rs. ________)<br><br>Declaration :<br>We declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct.",
				];

				$formatedData->other_details->declaration = $declaration[$_GET['type']];

				break;
			case 'commercial-invoice':
				//default items from custom-invoice
				$formatedData->other_details->invoice_number =$formatedData->other_details->commercial_invoice_number;
				$formatedData->other_details->invoice_date =$formatedData->other_details->commercial_invoice_date;
				$formatedData->items = $customeInvoiceDocument->items ? $customeInvoiceDocument->items : null;
				$formatedData->currency = $customeInvoiceDocument->currency ? $customeInvoiceDocument->currency : 'INR';
				$formatedData->invoice_amount = $customeInvoiceDocument->invoice_amount ? $customeInvoiceDocument->invoice_amount : '0.00';
				$formatedData->total_qty = $customeInvoiceDocument->total_qty ? $customeInvoiceDocument->total_qty : '0.00';
				$formatedData->total_package_qty = $customeInvoiceDocument->total_package_qty ? $customeInvoiceDocument->total_package_qty : '0.00';
				$formatedData->other_details->amount_in_words = $customeInvoiceDocument->other_details->amount_in_words ? $customeInvoiceDocument->other_details->amount_in_words : '0.00';

				$formatedData->other_details->declaration = "\"I/We undertake to abide by provisions of Foreign Exchange Management Act, 1999, as amended from time to time, including realization/repatriation of foreign exchange to/from India.\" <br>Declaration:<br>We declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct.";
				break;
			case 'packing-list-pre-shipment':
				$formatedData->other_details->declaration = "\"We intend to claim rewards under 'Remission of Duties and Taxes on Exported Products (RoDTEP)' and Drawback S/bill All Industry Schedule Tariff<br>\"I/We undertake to abide by provisions of Foreign Exchange Management Act, 1999, as amended from time to time, including realization/repatriation of foreign exchange to/from India.\"<br>Declaration :<br>We declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct";
				break;
			case 'packing-list-post-shipment':
				$formatedData->other_details->invoice_number =$formatedData->other_details->commercial_invoice_number;
				$formatedData->other_details->invoice_date =$formatedData->other_details->commercial_invoice_date;
				$formatedData->other_details->declaration = "\"I/We undertake to abide by provisions of Foreign Exchange Management Act, 1999, as amended from time to time, including realization/repatriation of foreign exchange to/from India.\"<br>Declaration :<br>We declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct";
				break;

			case 'sli-format':
				$packingListPreShipmentDetails = $this->shipment_documents->getRecord($masterFormDetails->request_id, 'packing-list-pre-shipment', $this->seller_session_data['company_id']);
				$packageItems = json_decode($packingListPreShipmentDetails->items, true);

				$type_of_shipping_bills = [
					(object)["name" => "FREE TRADE SAMPLE", "value" => "0"],
					(object)["name" => "DUTYFREE", "value" => "0"],
					(object)["name" => "DUTY DRAWBACK", "value" => "0"],
					(object)["name" => "ADVANCE LICENCE (DEEC)", "value" => "0"],
					(object)["name" => "EPCG", "value" => "0"],
					(object)["name" => "100% EOU", "value" => "0"],
					(object)["name" => "REPAIR & RETURN (RE EXPORT)", "value" => "0"],
					(object)["name" => "REPAIR & RETURN (RE EXPORT) SEC-74", "value" => "0"],
				];
				$documentList = [
					(object)["name" => "INVOICE (4 COPIES)", "value" => "0"],
					(object)["name" => "PACKING LIST (4 COPIES)", "value" => "0"],
					(object)["name" => "COPY OF PARTICIPATION LETTER", "value" => "0"],
					(object)["name" => "DECLARATION BY EXHIBITOR", "value" => "0"],
					(object)["name" => "COPY OF ICE", "value" => "0"],
					(object)["name" => "GR FORM/GR WAIVER", "value" => "0"],
					(object)["name" => "BANK LETTER", "value" => "0"],
					(object)["name" => "VISA/AEPC ENDORESMENT", "value" => "0"],
					(object)["name" => "EVD", "value" => "0"],
					(object)["name" => "SLI", "value" => "0"],
					(object)["name" => "SDF", "value" => "0"],
					(object)["name" => "NON-DG DECLARATION", "value" => "0"],
				];

				$formatedData->other_details->type_of_shipping_bills = (object) $type_of_shipping_bills;
				$formatedData->other_details->documentList  = (object) $documentList;
				break;

			case 'ecgc-instructions':
				$formatedData->other_details->subject = "Application for Overseas Remittance Insurance Cover";
				$formatedData->items = [
					(object)[
						"document_name" => 'ECGC Form',
						"document_number_date" =>'',
						"document_original_count" => '',
						"document_copies_count" => ''
					],
					(object)[
						"document_name" => 'Purchase Order',
						"document_number_date" =>$other_details->po_number.' Date:'.$other_details->po_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					],
				];
				break;

			case 'post-shipment-covering-letter-for-bank':
				$formatedData->other_details->subject = "Submission of Export documents for Collection and e-BRC.";
				$formatedData->items = [];
				if ($masterFormDetails->mode_id == '3') {
					//mode sea
					//$formatedData->other_details->bol_awb_no = $other_details->bill_of_lading;
					//$formatedData->other_details->bol_awb_dated = $other_details->bill_of_lading_date;
					array_push($formatedData->items,(object)[
						"document_name" => 'Bill of Lading',
						"document_number_date" =>$other_details->bill_of_lading.'; Date:'.$other_details->bill_of_lading_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					]
				);

				} else if ($masterFormDetails->mode_id == '2') {
					//mode air
					//$formatedData->other_details->bol_awb_no = $other_details->airway_bill_number;
					//$formatedData->other_details->bol_awb_dated = $other_details->airway_bill_date;
					array_push($formatedData->items,(object)[
						"document_name" => 'Airway Bill',
						"document_number_date" =>$other_details->airway_bill_number.'; Date:'.$other_details->airway_bill_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					]
				);
				}else if($masterFormDetails->mode_id == '1'){
					//mode road
					//$formatedData->other_details->bol_awb_no = $other_details->lorry_number;
					//$formatedData->other_details->bol_awb_dated = $other_details->lorry_date;
					array_push($formatedData->items,(object)[
						"document_name" => 'Lorry number',
						"document_number_date" =>$other_details->lorry_number.'; Date:'.$other_details->lorry_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					]
				);
				}
				array_push($formatedData->items,
				(object)[
					"document_name" => 'Foreign Inward Remittance Certificate(FIRC)',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Shipping Bill',
					"document_number_date" =>$other_details->shipping_bill_no.'; Date:'.$other_details->shipping_bill_date,
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Commercial Invoice',
					"document_number_date" =>$other_details->commercial_invoice_number.'; Date:'.$other_details->commercial_invoice_date,
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Packing List',
					"document_number_date" =>$other_details->commercial_invoice_number.'; Date:'.$other_details->commercial_invoice_date,
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Certificate of Origin',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Marine Insurance Policy',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Letter of Credit',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Bill of Exchange',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				]
			);
				
				break;
			case 'pre-shipment-covering-letter-for-cha-or-ff':
				$formatedData->other_details->subject = "Pre-Shipment Documents to process Custom Clearance and Shipping";
				$formatedData->items = [
					(object)[
						"document_name" => 'Custom Invoice and Packing List',
						"document_number_date" =>$other_details->invoice_number.'Date:'.$other_details->invoice_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					],
					(object)[
						"document_name" => 'Export Value Declaration(EVD)',
						"document_number_date" =>'',
						"document_original_count" => '',
						"document_copies_count" => ''
					],
					(object)[
						"document_name" => 'Letter of Undertaking (LUT)',
						"document_number_date" =>$other_details->lut_no.' Date:'.$other_details->export_under_lut_no_valid_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					],
					(object)[
						"document_name" => 'Import Export Code (IEC)',
						"document_number_date" =>$other_details->iec_no,
						"document_original_count" => '',
						"document_copies_count" => ''
					],
					(object)[
						"document_name" => 'Old Shipping Bill',
						"document_number_date" =>'',
						"document_original_count" => '',
						"document_copies_count" => ''
					],


				];
				break;
				
			case 'scomet-letter':
					$formatedData->other_details->subject = "NON-SCOMET DECLARATION";
			
				break;

			case 'tax-invoice-with-lut-bond':

				$formatedData->other_details->shipper_declaration = "<p>Supply meant for export is under <b>LUT Bond Number $lut_no Dated $lut_valid_date.</b></p><p>We declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct.</p>";
				$formatedData->other_details->igst_payment_status = "export-under-bond";
				$formatedData->show_conversion_form = $customeInvoiceDocument->currency!='INR' && empty($conversion_rate);

				if(!empty($conversion_rate)){
					foreach($customeInvoiceDocument->items as &$item){
						$item->price = $item->price * $conversion_rate;
						//$customeInvoiceDocument->$key->price = $customeInvoiceDocument->$key->price * $conversion_rate;
					}
					// vdebug($customeInvoiceDocument->items);
				}
				$formatedData->items = $customeInvoiceDocument->items;
				$formatedData->other_details->custom_invoice_currency = $customeInvoiceDocument->currency;
				if($customeInvoiceDocument->currency!='INR'){
					$formatedData->other_details->conversion_rate = "$customeInvoiceDocument->currency 1 = INR $conversion_rate";
				}else{
					$formatedData->other_details->conversion_rate = "$customeInvoiceDocument->currency 1 = INR 1";
				}
				
				break;

			case 'tax-invoice-without-lut-bond':
				$formatedData->other_details->shipper_declaration = "<p>Supply meant for export is under <b>IGST Payment against GSTIN ________________.</b></p><p>We declare that this Invoice shows the actual price of the goods described and that all particulars are true and correct.</p>";
				$formatedData->other_details->igst_payment_status = "export-under-bond";
				$formatedData->show_conversion_form = $customeInvoiceDocument->currency!='INR' && empty($conversion_rate);
				if(!empty($conversion_rate)){
					foreach($customeInvoiceDocument->items as &$item){
						$item->price = $item->price * $conversion_rate;
						//$customeInvoiceDocument->$key->price = $customeInvoiceDocument->$key->price * $conversion_rate;
					}
					// vdebug($customeInvoiceDocument->items);
				}
				$formatedData->items = $customeInvoiceDocument->items;
				$formatedData->other_details->custom_invoice_currency = $customeInvoiceDocument->currency;
				if($customeInvoiceDocument->currency!='INR'){
					$formatedData->other_details->conversion_rate = "$customeInvoiceDocument->currency 1 = INR $conversion_rate";
				}else{
					$formatedData->other_details->conversion_rate = "$customeInvoiceDocument->currency 1 = INR 1";
				}
				break;

			case 'draft-bill-of-lading-pre-shipment':
				$formatedData->other_details->shipper = $formatedData->other_details->exporter;
				$formatedData->other_details->no_of_original_bill_of_lading = 3;
				break;
			case 'final-bill-of-lading-post-shipment':
				$formatedData->other_details->shipper = $formatedData->other_details->exporter;
				$formatedData->other_details->no_of_original_bill_of_lading = 3;
				break;

			case 'draft-certificate-of-origin':

				$formatedData->other_details->declaration_by_chamber = "The undersigned certifies on the basis of information provided by the exporter that to the best of it’s knowledge and belief, the goods are of designated origin, production or manufacture.";
				$formatedData->other_details->declaration_by_exporter = "I, the undersigned, being duly authorized by the Consignor, and having made the necessary enquiries hereby certify that based on the rules of origin of the country of destination, all the goods listed originate in the country and place of designated. I further declare that I will furnish to the Customs authorities of the importing or their nominee, for inspection at any time, such as evidence as may be required  for the purpose of verifying this certificate. <br><br>The goods were produed/manufactured at " . $formatedData->other_details->country_of_origin;

				break;

			case 'declaration-of-origin':
				$formatedData->other_details->declaration_by_exporter = "The undersigned certifies on the basis of information provided by the exporter that to the best of it’s knowledge and belief, the goods are of designated origin, production or manufacture.";
				break;

			case 'evd-form':

				break;

			case 'non-dg-declaration':
				$formatedData->other_details->text1 = "Two completed and signed copies of this Declaration must be handed over to the freight forwarder.<br><br>Warning:<br>Failure to comply in all respectes with the applicable Dangerous Goods Regulations may be in breach of the applicable law, subject to legal penalties.";
				$formatedData->other_details->text3 = "ARTICLES AND DESCRIPTION. Number and type of packages. Net Quantity per package and Flashpoint Specify each articles seperately.";
				$formatedData->other_details->transport_details = "This shipment can be transported on both passengers and cargo aicraft";
				$formatedData->other_details->declaration = "Declaration:<br>We herby certify that the contents of the consignment are not dangerous and are not dangerous of carrying by air according to the current edition for IATA dangerous goods regulation and all the applicable carrier and government regulation. We acknowledge that we may be liable for dangerous resulting from any misstatement for omission and we further agree that any air carrier involved in the shipment of the consignment may rely upon this certificate. There is safe for air transport.";
				$formatedData->items = null;

				break;

			case 'marine-insurance-instructions':
				// var_dump($masterFormDetails);
				$formatedData->other_details->subject = "Application for All Risks Cover Marine Insurance Policy.";
				   $formatedData->items = [
					(object)[
						"document_name" => 'Purchase Order',					
						"document_number_date" => $other_details->po_number.' Date:'.$other_details->po_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					],
					(object)[
						"document_name" => 'Custom Invoice',
						"document_number_date" => $other_details->invoice_number.' Date:'.$other_details->invoice_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					],
				];



				break;
				
			case 'post-shipment-covering-letter-for-client':
				$formatedData->items = [];
				if ($masterFormDetails->mode_id == '3') {
					//mode sea
					//$formatedData->other_details->bol_awb_no = $other_details->bill_of_lading;
					//$formatedData->other_details->bol_awb_dated = $other_details->bill_of_lading_date;
					array_push($formatedData->items,(object)[
						"document_name" => 'Bill of Lading',
						"document_number_date" =>$other_details->bill_of_lading.' Date:'.$other_details->bill_of_lading_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					]
				);

				} else if ($masterFormDetails->mode_id == '2') {
					//mode air
					//$formatedData->other_details->bol_awb_no = $other_details->airway_bill_number;
					//$formatedData->other_details->bol_awb_dated = $other_details->airway_bill_date;
					array_push($formatedData->items,(object)[
						"document_name" => 'Airway Bill',
						"document_number_date" =>$other_details->airway_bill_number.' Date:'.$other_details->airway_bill_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					]
				);
				}else if($masterFormDetails->mode_id == '1'){
					//mode road
					//$formatedData->other_details->bol_awb_no = $other_details->lorry_number;
					//$formatedData->other_details->bol_awb_dated = $other_details->lorry_date;
					array_push($formatedData->items,(object)[
						"document_name" => 'Lorry number',
						"document_number_date" =>$other_details->lorry_number.' Date:'.$other_details->lorry_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					]
				);
				}
				array_push($formatedData->items,
				(object)[
					"document_name" => 'Commercial Invoice',
					"document_number_date" =>$other_details->commercial_invoice_number.' Date:'.$other_details->commercial_invoice_date,
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Packing List',
					"document_number_date" =>$other_details->commercial_invoice_number.' Date:'.$other_details->commercial_invoice_date,
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Certificate of Origin',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Marine Insurance Policy',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Letter of Credit',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				]
				);
				
				break;

			case 'covering-letter-for-import-clearance':
				$formatedData->other_details->subject = "Documents to process Custom Clearance and Shipping.";
				$formatedData->other_details->document_date = date('Y-m-d');
				$formatedData->items = [];
				if ($masterFormDetails->mode_id == '3') {
					//mode sea
					//$formatedData->other_details->bol_awb_no = $other_details->bill_of_lading;
					//$formatedData->other_details->bol_awb_dated = $other_details->bill_of_lading_date;
					array_push($formatedData->items,(object)[
						"document_name" => 'Bill of Lading',
						"document_number_date" =>$other_details->bill_of_lading.' Date:'.$other_details->bill_of_lading_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					]
				);

				} else if ($masterFormDetails->mode_id == '2') {
					//mode air
					//$formatedData->other_details->bol_awb_no = $other_details->airway_bill_number;
					//$formatedData->other_details->bol_awb_dated = $other_details->airway_bill_date;
					array_push($formatedData->items,(object)[
						"document_name" => 'Airway Bill',
						"document_number_date" =>$other_details->airway_bill_number.' Date:'.$other_details->airway_bill_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					]
				);
				}else if($masterFormDetails->mode_id == '1'){
					//mode road
					//$formatedData->other_details->bol_awb_no = $other_details->lorry_number;
					//$formatedData->other_details->bol_awb_dated = $other_details->lorry_date;
					array_push($formatedData->items,(object)[
						"document_name" => 'Lorry number',
						"document_number_date" =>$other_details->lorry_number.' Date:'.$other_details->lorry_date,
						"document_original_count" => '',
						"document_copies_count" => ''
					]
				);
				}
				array_push($formatedData->items,
				(object)[
					"document_name" => 'Commercial Invoice',
					"document_number_date" =>$other_details->commercial_invoice_number.' Date:'.$other_details->commercial_invoice_date,
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Packing List',
					"document_number_date" =>$other_details->commercial_invoice_number.' Date:'.$other_details->commercial_invoice_date,
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Marine Insurance Policy',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Certificate of Origin',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'MSDS',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Product Catalogue',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'Last Bill of Entry Copy',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				],
				(object)[
					"document_name" => 'FEMA & OGL',
					"document_number_date" =>'',
					"document_original_count" => '',
					"document_copies_count" => ''
				]
			);
				break;

			case 'covering-letter-for-advance-remittance':
				$formatedData->other_details->document_date = date('Y-m-d');
				break;

			case 'covering-letter-for-import-document-sbumission-to-bank':
				$formatedData->other_details->subject = "Submission of Bill of Entries against import remittances effected through Bank";
				$formatedData->other_details->document_date = date('Y-m-d');
				$formatedData->items = null;
				break;

			case 'authorisation-letter-to-custom-house-agent';
				$formatedData->other_details->document_date = date('Y-m-d');

				break;

			case 'vgm-declaration';
				$formatedData->other_details->document_date = date('Y-m-d');
				$formatedData->other_details->shipper = $formatedData->other_details->exporter;

				break;
		}
		// vdebug($formatedData);

		return $formatedData;
	}

	public function download($master_form_id, $document_type)
	{

		// $requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		$masterFormDetails = $this->document_master_form->getRecord($master_form_id, '', $this->seller_session_data['company_id']);
		
		if( $document_type=="shiping-marks-pre-shipment"){

			$documentPermission = checkDocumentPermission('packing-list-pre-shipment', $masterFormDetails->transaction, $masterFormDetails->mode, $masterFormDetails->shipment, 'EXIM');
		}else{

			$documentPermission = checkDocumentPermission($document_type, $masterFormDetails->transaction, $masterFormDetails->mode, $masterFormDetails->shipment, 'EXIM');
		}

		if (empty($documentPermission) || $documentPermission == '0') {
			$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Access denied
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';

			$this->session->set_flashdata('message', $message);
			redirect($_SERVER['HTTP_REFERER']);
		}

		$paper = 'A4'; 
		$orientation = "portrait";
		if( $document_type=="shiping-marks-pre-shipment"){
			$orientation = "landscape";
			$documentData = $this->shipment_documents->getRecord($master_form_id, 'packing-list-pre-shipment', $this->seller_session_data['company_id']);
		}else{
			$documentData = $this->shipment_documents->getRecord($master_form_id, $document_type, $this->seller_session_data['company_id']);
		}
		
		
		$documentData->items = json_decode($documentData->items);
		$documentData->other_details = json_decode($documentData->other_details);
		$data['documentData'] = $documentData;
		$data['masterFormDetails'] = $masterFormDetails;

		$this->load->library('pdf');

	

		 $data['htmlData'] = $this->load->view("frontend/seller/dms/download-pdf-templates/$document_type", $data, true);

		$this->pdf->generate($data['htmlData'], $master_form_id . " $document_type",true,$paper,$orientation);
	}

	public function deleteDocument()
	{

		$update = 0;
		if ($this->input->post()) {
			$documentType = $this->input->post('documentType');
			$master_form_id = $this->input->post('master_form_id');

			$condition['document_type'] = $documentType;
			$condition['master_form_id'] = $master_form_id;
			$update = $this->shipment_documents->deleteDocument($condition);
		}


		$message = '';
		if ($update) {
			$message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Document delete.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
		} else {
			$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Something went wrong.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
		}

		$this->session->set_flashdata('message', $message);

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function ajaxAddPackageItem_from_excel()
	{
		$htmlContent = '';
		if ($this->input->post()) {
			$item = new stdClass();

			$file = $_FILES['file']['tmp_name'];
			$uuid1 = $this->input->post('uuid1');
			//load the excel library
			$this->load->library('excel');
			PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);

			//get only the Cell Collection
			// $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
			foreach ($allDataInSheet as $key => $row) {
				if ($key == '1') {
					continue;
				}

				$uuid2 = uniqid();
				$data = [];
				$data['uuid1'] = $uuid1;
				$data['uuid2'] = $uuid2;
				$data['item'] = (object) [
					'product' => $row['A'],
					'description' => $row['B'],
					'qty' => $row['C'],
					'unit' => $row['D'],
				];
				$htmlContent .= $this->load->view('frontend/ajax/ajaxPackingList_product_line', $data, true);
			}
		}

		echo $htmlContent;
		die;
	}


	public function ajaxAddContainerPackageItem_from_excel()
	{
		$htmlContent = '';
		if ($this->input->post()) {
			$item = new stdClass();

			$file = $_FILES['file']['tmp_name'];
			$uuid1 = $this->input->post('uuid1');
			//load the excel library
			$this->load->library('excel');
			PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);

			//get only the Cell Collection
			// $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
			foreach ($allDataInSheet as $key => $row) {
				if ($key == '1') {
					continue;
				}

				$uuid2 = uniqid();
				$data = [];
				$data['uuid1'] = $uuid1;
				$data['uuid2'] = $uuid2;
				$data['item'] = (object) [
					'container_no' => $row['A'],
					'seal_no' => $row['B'],
					'description' => $row['C'],
					'qty' => $row['D'],
					'unit' => $row['E'],
				];
				$htmlContent .= $this->load->view('frontend/ajax/ajaxContainerPackingList_product_line', $data, true);
			}
		}

		echo $htmlContent;
		die;
	}



	public function document_master_list()
	{



		$data['leftmenuActive'] = "documents-master-list";
		$data['leftSubMenuActive'] = "documents-master-list";
		// $requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		// $documetTypeList = $this->shipment_documents->getDocumentList($request_id, $this->seller_session_data['company_id'], ['transiction' => ['All', $requestDetails->transaction]]);
		$data['page'] = 'frontend/seller/dms/document_master_list';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		// $data['requestDetails'] = $requestDetails;
		// $data['documetTypeList'] = $documetTypeList;
		// vdebug($documetTypeList);
		$data['masterForms'] = $this->document_master_form->getList($this->seller_session_data['company_id']);
		$this->load->view('frontend/layout_main', $data);
	}

	public function create_document_master_form()
	{
		//create-master-information-form
		$data['leftmenuActive'] = "documents-master-list";
		$data['leftSubMenuActive'] = "documents-master-list";
		$data['page'] = 'frontend/seller/dms/create-master-information-form';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['request_id'] = isset($_GET['request_id']) ? $_GET['request_id'] : '';
		$request_id = $data['request_id'];
		$requestDetails = '';

		if (!empty($data['request_id'])) {
			//get request details
			$requestDetails = $this->seller_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		}

		$data['requestDetails'] = $requestDetails;
		$data['compnayBranch'] = $this->branch_model->getList($this->seller_session_data['company_id'], 'branch');
		$data['consigneeAddressList'] = $this->branch_model->getList($this->seller_session_data['company_id'], 'consignee');

		$other_details = new stdClass();
		$other_details->exporter_company_name = $requestDetails->consignor_company_name;
		$other_details->exporter_address_line_1 = $requestDetails->consignor_address_line_1;
		$other_details->exporter_address_line_2 =  $requestDetails->consignor_address_line_2;
		$other_details->exporter_city = $requestDetails->consignor_city_name;
		$other_details->exporter_pincode = $requestDetails->consignor_pincode;
		$other_details->exporter_person_name = $requestDetails->consignor_name;
		$other_details->exporter_contact_number = $requestDetails->consignor_phone;

		$other_details->consignee_company_name = $requestDetails->consignee_company_name;
		$other_details->consignee_address_line_1 = $requestDetails->consignee_address_line_1;
		$other_details->consignee_address_line_2 = $requestDetails->consignee_address_line_2;
		$other_details->consignee_city = $requestDetails->consignee_city_name;
		$other_details->consignee_pincode = $requestDetails->consignee_pincode;
		$other_details->consignee_person_name = $requestDetails->consignee_name;
		$other_details->consignee_contact_number = $requestDetails->consignee_phone;

		$otherConsignee = $requestDetails->consignee_other;

		$other_details->buyer_company_name = $otherConsignee->company_name;
		$other_details->buyer_address_line_1 = $otherConsignee->address_line_1;
		$other_details->buyer_address_line_2 = $otherConsignee->address_line_2;
		$other_details->buyer_city = $otherConsignee->city_name;
		$other_details->buyer_pincode = $otherConsignee->pincode;
		$other_details->buyer_person_name = $otherConsignee->name;
		$other_details->buyer_contact_number = $otherConsignee->phone;

		// $other_details->notify_party_company_name = $requestDetails->consignor_company_name;
		// $other_details->notify_party_address_line_1 = $requestDetails->consignor_address_line_1;
		// $other_details->notify_party_address_line_2 = $requestDetails->consignor_address_line_2;
		// $other_details->notify_party_city = $requestDetails->consignor_city_name;
		// $other_details->notify_party_pincode = $requestDetails->consignor_pincode;
		// $other_details->notify_party_person_name = $requestDetails->consignor_name;
		// $other_details->notify_party_contact_number = $requestDetails->consignor_phone;

		$data['other_details'] = $other_details;

		if ($_POST) {

			//get master form details for rfc id
			if (!empty($request_id) && $this->document_master_form->checkFormExist($request_id)) {
				$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Master information form is already exist for RFC ID ' . $request_id . ' .
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
				$this->session->set_flashdata('message', $message);

				redirect(base_url('fs-document-master-list'));
			}

			$user_id = $this->seller_session_data['id'];
			$company_id = $this->seller_session_data['company_id'];
			if (!empty($requestDetails)) {
				$transaction = $requestDetails->transaction;
				$mode = $requestDetails->mode_id;
				$shipment = $requestDetails->shipment_id;
				$shipment_under_payment = $requestDetails->shipment_under_payment;
			} else {
				$transaction = $this->input->post('transaction');
				$mode = $this->input->post('mode');
				$shipment = $this->input->post('shipment');
				$shipment_under_payment = $this->input->post('shipment_under_payment');
			}

			$signFile = '';
			if (isset($_FILES['signature']['tmp_name']) && !empty($_FILES['signature']['tmp_name'])) {
				//	$signFile = addslashes(file_get_contents($_FILES['signature']['tmp_name']));
				$imageFileType = strtolower(pathinfo($_FILES['signature']['tmp_name'], PATHINFO_EXTENSION));

				// Convert to base64 
				$image_base64 = base64_encode(file_get_contents($_FILES['signature']['tmp_name']));
				$signFile = 'data:image/' . $imageFileType . ';base64,' . $image_base64;
			}
			$infoForm = array(
				'created_by_company_id' => $company_id,
				'created_by_user_id' => $user_id,
				'transaction' => $transaction,
				'mode_id' => $mode,
				'shipment_id' => $shipment,
				'shipment_under_payment' =>  $shipment_under_payment,
				'request_id' => $this->input->post('request_id'),
				'items' => json_encode($this->input->post('items')),
				'other_details' => json_encode($this->input->post('other_details')),
				'signature' => $signFile
			);

			$update = $this->document_master_form->insert($infoForm);
			$message = '';
			if ($update) {
				$message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Document saved!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
			} else {
				$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Document not saved please try again.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
			}
			$this->session->set_flashdata('message', $message);

			redirect(base_url('fs-document-master-list'));
			// echo $this->db->last_query();
			// die;
		}

		$ffCompanyDetails = $this->seller_model->getFFcompanyDetails($requestDetails->selected_ff_company_id);
		$forwarder = (object)[
			'company_name' => $ffCompanyDetails->name,
			'address_line_1' => $ffCompanyDetails->address_line_1,
			'address_line_2' => $ffCompanyDetails->address_line_2,
			'name' => $ffCompanyDetails->head_firstname . ' ' . $ffCompanyDetails->head_lastname,
			'email' => $ffCompanyDetails->head_email,
			'country_code' => $ffCompanyDetails->head_country_code,
			'phone' => $ffCompanyDetails->head_phone,
			'city_name' => $ffCompanyDetails->city_name,
			'pincode' => $ffCompanyDetails->pincode,
		];
		//Start get kyc document details
		//GST
		$kycDetails = $this->seller_model->getUserKYC($this->seller_session_data['company_id'], '5');
		$gst_no = $kycDetails->number;

		//PAN
		$kycDetails = $this->seller_model->getUserKYC($this->seller_session_data['company_id'], '1');
		$pan_no = $kycDetails->number;

		//LUT No
		$kycDetails = $this->seller_model->getUserKYC($this->seller_session_data['company_id'], '6');
		$lut_no = $kycDetails->number;

		//IEC No
		$kycDetails = $this->seller_model->getUserKYC($this->seller_session_data['company_id'], '4');
		$iec_no = $kycDetails->number;

		//get country of origin
		$country_origin = $this->city_model->getCountryFromId($requestDetails->consignor_country_id);
		$data['country_origin'] = $country_origin;
		//country of destination
		$country_detination = $this->city_model->getCountryFromId($requestDetails->consignee_country_id);
		$data['country_detination'] = $country_detination;

		$data['forwarder'] = $forwarder;
		$data['gst_no'] = $gst_no;
		$data['pan_no'] = $pan_no;
		$data['lut_no'] = $lut_no;
		$data['iec_no'] = $iec_no;

		$data['modes'] = $this->mode_model->getList();
		$data['shipments'] = $this->shipment_model->getList(true);
		$this->load->view('frontend/layout_main', $data);
	}

	public function edit_document_master_form()
	{
		$data['leftmenuActive'] = "documents-master-list";
		$data['leftSubMenuActive'] = "documents-master-list";
		$data['page'] = 'frontend/seller/dms/edit-master-information-form';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		//$data['request_id'] = isset($_GET['request_id'])?$_GET['request_id']:'';
		//$request_id = $data['request_id'];
		$requestDetails = '';

		$master_form_id = isset($_GET['mf']) ? $_GET['mf'] : '';

		if (empty($master_form_id)) {
			$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Shipment Documents Form details not found.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url('fs-document-master-list'));
		}


		//get information for details
		$masterFormDetails = $this->document_master_form->getRecord($master_form_id, '', $this->seller_session_data['company_id']);
		$masterFormDetails->items = json_decode($masterFormDetails->items);
		$masterFormDetails->other_details = json_decode($masterFormDetails->other_details);
		if (empty($masterFormDetails)) {
			$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Shipment Documents Form details not found.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url('fs-document-master-list'));
		}
		// echo "<pre>";
		// print_r($masterFormDetails);
		// echo "</pre>";
		if ($this->input->post()) {
			$infoForm = [];
			if (isset($_FILES['signature']['tmp_name']) && !empty($_FILES['signature']['tmp_name'])) {
				//	$signFile = addslashes(file_get_contents($_FILES['signature']['tmp_name']));
				$imageFileType = strtolower(pathinfo($_FILES['signature']['tmp_name'], PATHINFO_EXTENSION));

				// Convert to base64 
				$image_base64 = base64_encode(file_get_contents($_FILES['signature']['tmp_name']));
				$signFile = 'data:image/' . $imageFileType . ';base64,' . $image_base64;
				$infoForm['signature'] = $signFile;
			}

			$infoForm['items'] = json_encode($this->input->post('items'));
			$infoForm['other_details'] = json_encode($this->input->post('other_details'));
			$infoForm['updated_at'] = date('Y-m-d');


			$update = $this->document_master_form->update($master_form_id, $infoForm);
			if ($update) {
				$message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Shipment Documents Form details updated successfully.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>';
				$this->session->set_flashdata('message', $message);
				redirect(base_url('fs-document-master-list'));
			} else {
				$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Shipment Documents Form details not updated.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>';
				$this->session->set_flashdata('message', $message);
				redirect(base_url('fs-document-master-list'));
			}
		}


		$data['masterFormDetails'] = $masterFormDetails;
		$data['other_details'] = $masterFormDetails->other_details;
		$data['items'] = $masterFormDetails->items;
		$data['modes'] = $this->mode_model->getList();
		$data['shipments'] = $this->shipment_model->getList(true);
		$data['compnayBranch'] = $this->branch_model->getList($this->seller_session_data['company_id'], 'branch');
		$data['consigneeAddressList'] = $this->branch_model->getList($this->seller_session_data['company_id'], 'consignee');

		$this->load->view('frontend/layout_main', $data);
	}

	public function delete_document_master_form()
	{
		$update = 0;
		if ($this->input->post()) {

			$master_form_id = $this->input->post('master_form_id');


			$condition['master_form_id'] = $master_form_id;

			//delete master form
			$update = $this->document_master_form->delete($master_form_id);

			//delete documents
			$this->shipment_documents->deleteDocument($condition);
		}


		$message = '';
		if ($update) {
			$message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Document delete.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
		} else {
			$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Something went wrong.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
		}

		$this->session->set_flashdata('message', $message);

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function copy_document_master_form()
	{
		$update = 0;
		if ($this->input->post()) {

			$master_form_id = $this->input->post('master_form_id');

			//get master form details
			$masterFormDetails = $this->document_master_form->getRecord($master_form_id, '', $this->seller_session_data['company_id']);

			$infoForm = array(
				'created_by_company_id' => $this->seller_session_data['company_id'],
				'created_by_user_id' => $this->seller_session_data['id'],
				'transaction' => $masterFormDetails->transaction,
				'mode_id' => $masterFormDetails->mode_id,
				'shipment_id' => $masterFormDetails->shipment_id,
				'shipment_under_payment' =>  $masterFormDetails->shipment_under_payment,
				'request_id' => null,
				'items' => $masterFormDetails->items,
				'other_details' => $masterFormDetails->other_details,
				'signature' => $masterFormDetails->signature
			);

			$update = $this->document_master_form->insert($infoForm);
			
		}


		$message = '';
		if ($update) {
			$message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Document copied.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
		} else {
			$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Something went wrong.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';
		}

		$this->session->set_flashdata('message', $message);

		redirect($_SERVER['HTTP_REFERER']);
	}
}

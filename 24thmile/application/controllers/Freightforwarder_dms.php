<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Freightforwarder_dms extends CI_Controller
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
			if ($this->seller_session_data['role'] !== ROLE_FREIGHT_FORWARDER) {

				redirect(base_url());
			}
		}
        
		$this->load->model('seller_model');
		$this->load->model('freight_model');
		$this->load->model('shipment_document_master');
		$this->load->model('shipment_documents');
		$this->load->helper('cookie');
		$this->load->library(array('session', 'form_validation', 'email'));
    }
    
    public function index($request_id){

        $data['leftmenuActive'] = "";
		$data['leftSubMenuActive'] = "";
        $requestDetails = $this->freight_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
        $documetTypeList = $this->shipment_documents->getDocumentList($request_id, $requestDetails->fs_company_id,['transiction'=>['All',$requestDetails->transaction]]);
        $data['page'] = 'frontend/freightforwarder/dms/index';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['requestDetails'] = $requestDetails;
		$data['documetTypeList'] = $documetTypeList;
        // vdebug($documetTypeList);
		$this->load->view('frontend/layout_main', $data);
    }

   
	public function download($request_id,$document_type){

		$requestDetails = $this->freight_model->getRequirmentDetails($request_id, $this->seller_session_data['company_id']);
		$documentPermission = checkDocumentPermission($document_type,$requestDetails->transaction,$requestDetails->mode,$requestDetails->shipment,'EXIM');
	
		if(empty($documentPermission)||$documentPermission=='0'){
			$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Access denied
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>';

			  $this->session->set_flashdata('message', $message);
			  redirect($_SERVER['HTTP_REFERER']);
		}
		$documentData = $this->shipment_documents->getRecord($request_id, $document_type, $requestDetails->fs_company_id);
		$documentData->items = json_decode($documentData->items);
		$documentData->other_details = json_decode($documentData->other_details);
		$data['documentData'] =$documentData;
		$this->load->library('pdf');
		 $data['htmlData'] = $this->load->view("frontend/seller/dms/download-pdf-templates/$document_type", $data, true);
		$this->pdf->generate($data['htmlData'], $request_id . " $document_type");
	}

}
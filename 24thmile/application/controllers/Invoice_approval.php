<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_approval extends CI_Controller {

    public $session_user;
	public function __construct()
	{
		parent::__construct();

                $app_id ='20';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('invoice_model', 'INVOICE', TRUE); 
		
	}
	
	public function index()
	{	$data['invoice_list'] = $this->INVOICE->getList(['sent_for_approval']);
		$data['page'] = 'backend/invoice_approval/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function view($invoice_id='')
	{	
		
           
            if($this->input->post('invoice_id')){
                $invoice_id = $this->input->post('invoice_id');
            }
            
            $invoice_details = $this->INVOICE->getInvoiceDetails($invoice_id);
            
		if($this->input->post()){
                   
			
				$dbOject = array(
                                                'invToUserName' => $this->input->post('name_to'),
                                                'invToCompanyName' => $this->input->post('companyName_to'),
                                                'invToUserEmail' => $this->input->post('email_to'),
                                                'invToUserAddress' => $this->input->post('address_to'),
                                                'invToUserPhoneNo' => $this->input->post('phone_to'),
                                                'invToPlaceOfSupply' => $this->input->post('place_of_supply_to'),
                                                'invToUserGSTNo' => $this->input->post('gst_no_to'),
                                                'city_to' => $this->input->post('city_to'),
                                                'state_to' => $this->input->post('state_to'),
                                                'pin_to' => $this->input->post('pin_to'),
                                                'invFromUserName' => $this->input->post('name_from'),
                                                'invFromCompanyName' => $this->input->post('companyName_from'),
                                                'invFromUserEmail' => $this->input->post('email_from'),
                                                'invFromUserAddress' => $this->input->post('address_from'),
                                                'invfromUserPhoneNo' => $this->input->post('phone_from'),
                                                'invFromPlaceOfSupply' => $this->input->post('place_of_supply_from'),
                                                'invFromUserGSTNo' => $this->input->post('gst_no_from'),
                                                'tan_from' => $this->input->post('tan_from'),
                                                'pan_from' => $this->input->post('pan_from'),
                                                'sac_code_from' => $this->input->post('sac_code_from'),
                                                'lut_no_from' => $this->input->post('lut_no_from'),
                                                'msme_no_from' => $this->input->post('msme_no_from'),
                                                'bankAccountNumber' => $this->input->post('bank_account_no_from'),
                                                'bankName' => $this->input->post('bank_name_from'),
                                                'bankBranchCity' => $this->input->post('bank_branch_from'),
                                                'bankCodeIFSC' => $this->input->post('bank_ifsc_code_from'),
                                                'inv_amount' => $this->input->post('subtotal'),
                                                'inv_tax' => $this->input->post('igst'),
                                                'sgst_tax' => $this->input->post('sgst'),
                                                'cgst_tax' => $this->input->post('cgst'),
                                                'inv_total_amount' => $this->input->post('totalInvoice'),
                                                'term_delivery' => $this->input->post('term_delivery'),
                                                'term_payment' => $this->input->post('term_payment'),
                                                'term_reference' => $this->input->post('term_reference'),
                                                'last_update_datetime' => date('Y-m-d H:i:s'),
                                                );
				
                                if(empty($invoice_details)){
                                    //create
//                                    $dbOject['invCreatedByActor'] = $this->seller_session_data['id'];
//                                    $invoice_id = $this->INVOICE->insert($dbOject);
//                                    $this->updateBillingItems($invoice_id,$this->input->post('billingItems'));
//                                     $this->session->set_flashdata('success','Invoice created successfully.');
//                                    redirect(base_url('invoice'));
                                }else{
                                    //update
//                                   $updated= $this->INVOICE->update($invoice_id,$dbOject);
//                                    $this->updateBillingItems($invoice_id,$this->input->post('billingItems'));
//                                     $this->session->set_flashdata('success','Invoice updated successfully.');
//                                    redirect(base_url('invoice'));
                                }
			
		}
//                vdebug($invoice_details);
		$data['page'] = 'backend/invoice_approval/view';
		$data['invoice_details'] = $invoice_details;
		$data['placeOfSupplyList'] = $this->INVOICE->getPlaceOfSupplyList();
               
		$this->load->view('backend/layout_main', $data);		
	}

      
}
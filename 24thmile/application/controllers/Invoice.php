<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

    public $session_user;
    public $invoice_type;
	public function __construct()
	{
		parent::__construct();
                
                 $this->invoice_type = (preg_match('/\invoice\b/', uri_string()))?'invoice':'proforma';
                
                $app_id = $this->invoice_type == 'invoice' ?'19':'20';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model ('invoice_model', 'INVOICE', TRUE); 
		$this->load->model ('Company_model', 'COMPANY', TRUE); 
	}
	
	public function index()
	{	$data['invoice_list'] = $this->INVOICE->getList([],$this->invoice_type);
		$data['page'] = 'backend/invoice/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add($invoice_type='proforma',$invoice_id='')
	{	
		
           
            if($this->input->post('invoice_id')){
                $invoice_id = $this->input->post('invoice_id');
            }
            
            $invoice_details = $this->INVOICE->getInvoiceDetails($invoice_id,$this->invoice_type);
           
		if($this->input->post()){
//                    vdebug($_POST);
			
				$dbOject = array(
                                                
                                                'inv_type' => $this->input->post('invoice_type'),
                                                'company_id' => $this->input->post('to_company_id')?$this->input->post('to_company_id'):null,
                                                'customer_name' => $this->input->post('customer_name'),
                                                'company_name' => $this->input->post('company_name'),
                                                'address' => $this->input->post('address'),
                                                'contact_no' => $this->input->post('contact_number'),
                                                'gst_tax_no' => $this->input->post('gst_tax_no'),
                                                'invoice_date' => getMysqlDateFormat($this->input->post('invoice_date')) ,
                                                'total_amount' => $this->input->post('total'),
                                                'tax_type' => $this->input->post('tax_type'),
                                                'cgst_percent' => $this->input->post('cgst_percent'),
                                                'sgst_percent' => $this->input->post('sgst_percent'),
                                                'igst_percent' => $this->input->post('igst_percent'),
                                                'cgst_tax' => $this->input->post('cgst_tax'),
                                                'sgst_tax' => $this->input->post('sgst_tax'),
                                                'igst_tax' => $this->input->post('igst_tax'),
                                                'grand_total' => $this->input->post('grand_total'),
                                                'transaction_currency' => $this->input->post('transaction_currency'),
                                                'term' => $this->input->post('terms'),
                                                'city_id' => $this->input->post('city_id'),
                                                'state_id' => $this->input->post('state_id'),
                                                'country_id' => $this->input->post('country_id'),
                                                'city_name' => $this->input->post('city_name'),
                                                'pincode' => $this->input->post('pincode'),
                                                'email' => $this->input->post('email'),
                                                'last_update_datetime' => date('Y-m-d H:i:s'),
                                                );
				
                                if(empty($invoice_details)){
                                    //create
                                    $dbOject['created_by'] = $this->session_user['id'];
                                    $dbOject['inv_unique_id'] = $this->INVOICE->generateInvoiceNumber($this->input->post('invoice_type'));
                                    $invoice_id = $this->INVOICE->insert($dbOject);
                                    $this->updateBillingItems($invoice_id,$this->input->post('billingItems'));
                                    if(!empty($this->input->post('proformaToLink'))){
                                        //change status of selected proforma invoice to linked
                                        if($this->input->post('invoice_type')=="invoice"){
                                        $this->INVOICE->linkeProforma($this->input->post('proformaToLink'),$invoice_id);
                                        }else{
                                            $this->INVOICE->mappLinkedProforma($this->input->post('proformaToLink'),$invoice_id);
                                        }
                                    }
                                    
                                    $this->session->set_flashdata('success', ucwords($this->invoice_type).' created successfully.');
                                    redirect(base_url($this->invoice_type));
                                }else{
                                    //update
                                   $updated= $this->INVOICE->update($invoice_id,$dbOject);
                                    $this->updateBillingItems($invoice_id,$this->input->post('billingItems'));
                                    
                                        //change status of selected proforma invoice to linked
                                        if($this->input->post('invoice_type')=="invoice"){
                                        $this->INVOICE->linkeProforma($this->input->post('proformaToLink'),$invoice_id);
                                        }else{
                                            $this->INVOICE->mappLinkedProforma($this->input->post('proformaToLink'),$invoice_id);
                                        }
                                    
                                     $this->session->set_flashdata('success',ucwords($this->invoice_type).' updated successfully.');
                                    redirect(base_url($this->invoice_type));
                                }
			
        }
       
		$data['page'] = 'backend/invoice/add';
		$data['invoice_type'] = $invoice_type;
		$data['invoice_details'] = $invoice_details;
		$data['tmp_invoice_number'] = $this->INVOICE->generateInvoiceNumber($invoice_type);
        $data['company_list'] = $this->COMPANY->getList();
        
        
		$this->load->view('backend/layout_main', $data);		
	}

        public function updateBillingItems($invoice_id,$items){
            $arryItemIds = array();
            
            foreach ($items as $item){
                $postData = [
                    'inv_id'=>$invoice_id,
                    'particular'=>$item['name']?$item['name']:null,
                    'amount'=>$item['amount']?$item['amount']:null,
                ];
               
                if($item['item_id']){
                    //update
                    $this->INVOICE->updateBillingItem($item['item_id'],$postData);
                    $arryItemIds[] = $item['item_id'];
                }else{
                    //insert new
                   // echo 'insert';
                   $arryItemIds[]= $this->INVOICE->insertBillingItem($postData);
                }
              
            }
            $this->INVOICE->deleteBillingItem($invoice_id, $arryItemIds);
        }
        
        public function downloadInvoice($invoice_type,$invoice_id){
//            ini_set('display_errors', 1);
//            phpinfo();die;
            $data['invoice_details'] = $this->INVOICE->getInvoiceDetails($invoice_id,$this->invoice_type);
            
            $this->load->library('pdf');
           //$this->load->view('view_file');
            $data['htmlData'] = $this->load->view('backend/invoice/invoice-template', $data,true);
            $this->pdf->generate($data['htmlData'],'invoice.pdf');
        }
        
        public function sendToCustomer($invoice_type,$invoice_id){
            $data['invoice_details'] = $this->INVOICE->getInvoiceDetails($invoice_id,$this->invoice_type);
            $email_cc='';
            if($this->input->post('email_cc')){
                $email_cc = $this->input->post('email_cc');
            }
            $this->load->library('pdf');
            $data['htmlData'] = $this->load->view('backend/invoice/invoice-template', $data,true);
            $file = $this->pdf->generate($data['htmlData'],'invoice.pdf',false);
            $tmpfile = tempnam(sys_get_temp_dir(), 'invoice');
            file_put_contents($tmpfile, $file);
            $attachments =[$tmpfile];
            $emailSend = sendEmail_invoice($email_cc,$data['invoice_details'],$attachments);
            unlink($tmpfile);
            if($emailSend){
                //update status to yes
                 $dbOject['sent_to_customer'] = 'yes';
                 $dbOject['ondatetime_sentToCustomer'] = date('Y-m-d H:i:s');
                 $updated= $this->INVOICE->update($invoice_id,$dbOject);
                 
                 if($updated){
                     $this->session->set_flashdata('success',ucwords($this->invoice_type).' send successfully.');
                                    redirect(base_url($this->invoice_type));
                 }
            }
            
            
            
            $this->session->set_flashdata('error',ucwords($this->invoice_type).' send failed.');
                                    redirect(base_url($this->invoice_type));
            
        }
        public function sendForApproval(){
            
            if($this->input->post('invoice_id')){
                $invoice_id = $this->input->post('invoice_id');
                $invoice_details = $this->INVOICE->getInvoiceDetails($invoice_id);
                
                if(in_array($invoice_details->status, ['new','edited'])){
                    $dbOject =[
                        'status'=>'sent_for_approval'
                    ];
                    $updated= $this->INVOICE->update($invoice_id,$dbOject);
                    $this->session->set_flashdata('success','Invoice sent for approval.');
                    redirect(base_url('invoice'));
                    exit();
                }
                
            }
            
             $this->session->set_flashdata('error','Something went wrong.');
              redirect(base_url('invoice'));
            exit();
        }
      
}
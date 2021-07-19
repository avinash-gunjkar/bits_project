<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_banks extends CI_Controller {

        public $seller_session_data;
	public function __construct()
	{
		parent::__construct();
            if(empty($this->session->userdata("seller_logged_in")))
            {
                            redirect(base_url('signin'));
            }
            $this->seller_session_data = $this->session->userdata('seller_logged_in');
           
		$this->load->model ('Company_bank', 'BANK', TRUE); 
		$this->load->model ('seller_model'); 
		
	}
	
	public function index()
	{	

        
                $data['leftmenuActive']="company-profile";  
                // $data['type']=$type;
               
                // if($type=='consignee'){
                //     $data['leftSubMenuActive']= "consignee-address";
                     $data['pageheading']= "Company Banks";
                // }else{
                //     $data['leftSubMenuActive']= "company-branch";
                //     $data['pageheading']= "Company Branch Management";
                // }
                $data['bank_list'] = $this->BANK->getList($this->seller_session_data['company_id']);
		$data['page'] = 'frontend/company-banks/index';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		// echo '<pre>';print_r($data);die;
		$this->load->view('frontend/layout_main', $data);	
		//$this->load->view('backend/layout_main', $data);
	}
 

	public function add($id='')
	{	
          $data['leftmenuActive']="company-profile";
              $data['pageheading']= "Company Banks";
            
            if($this->input->post('id')){
                $id = $this->input->post('id');
            }
            
            $bank_details = $this->BANK->getRecord($id,$this->seller_session_data['company_id']);
            
            
            if($this->input->post()){
                $dbOject = array(
                                'company_id' => $this->seller_session_data['company_id'],
                                // 'type' => $type,
                                'bank_name' => $this->input->post('bank_name'),
                                // 'bank_address' => $this->input->post('bank_address'),
                                'account_number' => $this->input->post('account_number'),
                                'ifsc_code' => $this->input->post('ifsc_code'),
                                'swift_code' => $this->input->post('swift_code'),
                                'ad_code' => $this->input->post('ad_code'),
                                'status' => $this->input->post('status')
                            );
                              
                    if(empty($bank_details)){
                        //insert
                        
                        $dbOject['created_at'] = date("Y-m-d H:i:s");
                        $dbOject['updated_at'] = date("Y-m-d H:i:s");
                        if($this->BANK->insert($dbOject)){
                            $this->session->set_flashdata('success','Company bank added successfully.');
                                redirect(base_url('company-banks/'));
                            }else{
                                // echo $this->db->last_query ();
                                // die;
                                $this->session->set_flashdata('error','Something goes wrong.');
                                redirect(base_url('company-banks/'));
                            }
                            
                    }else{
                        //update
                      
                        $dbOject['updated_at'] = date("Y-m-d H:i:s");
                        if($this->BANK->update($id,$dbOject)){
                            $this->session->set_flashdata('success','Company bank updated successfully.');
                                redirect(base_url('company-banks/'));
                            }else{
                                $this->session->set_flashdata('error','Something goes wrong.');
                                redirect(base_url('company-banks/'));
                            }
                    }            
                            
            }
		
                $data['designtnData'] = $this->seller_model->getDesignationData();       
		$data['page'] = 'frontend/company-banks/add';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['bank_details'] = $bank_details;
		$this->load->view('frontend/layout_main', $data);		
	}

        public function delete_bank($id){
            $bank_details = $this->BANK->getRecord($id,$this->seller_session_data['company_id']);
            if(!empty($bank_details)){
                if($this->BANK->delete($id)){
                     $this->session->set_flashdata('success','Company bank deleted successfully.');
                      
                }else{
                    $this->session->set_flashdata('error','Something goes wrong.');
                              
                }
                
            }else{
                $this->session->set_flashdata('error','Company bank details not found.');
                
            }
            
            redirect(base_url('company-banks/'));
            
        }
}
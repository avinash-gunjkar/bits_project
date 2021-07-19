<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

        public $seller_session_data;
	public function __construct()
	{
		parent::__construct();
            if(empty($this->session->userdata("seller_logged_in")))
            {
                            redirect(base_url('signin'));
            }
            $this->seller_session_data = $this->session->userdata('seller_logged_in');
           
		$this->load->model ('branch_model', 'BRNACH', TRUE); 
		$this->load->model ('seller_model'); 
		
	}
	
	public function index($type)
	{	
                
                $data['leftmenuActive']="company-profile";
                $data['type']=$type;
               
                if($type=='consignee'){
                    $data['leftSubMenuActive']= "consignee-address";
                    $data['pageheading']= "Consignee Address Management";
                }else{
                    $data['leftSubMenuActive']= "company-branch";
                    $data['pageheading']= "Company Branch Management";
                }
                $data['branch_list'] = $this->BRNACH->getList($this->seller_session_data['company_id'],$type);
		$data['page'] = 'frontend/branch/index';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
//		echo '<pre>';print_r($data);die;
		$this->load->view('frontend/layout_main', $data);	
		//$this->load->view('backend/layout_main', $data);
	}
 

	public function add($type,$branch_id='')
	{	
          $data['leftmenuActive']="company-profile";
          $data['type']=$type;
               
          if($type=='consignee'){
              $data['leftSubMenuActive']= "consignee-address";
              $data['pageheading']= "Consignee Address Details";
          }else{
              $data['leftSubMenuActive']= "company-branch";
              $data['pageheading']= "Company Branch Details";
          }
            //get branch details
            if($this->input->post('branch_id')){
                $branch_id = $this->input->post('branch_id');
            }
            
            $branch_details = $this->BRNACH->getRecord($branch_id,$this->seller_session_data['company_id']);
            
            
            if($this->input->post()){
                $dbOject = array(
                                'company_id' => $this->seller_session_data['company_id'],
                                'type' => $type,
                                'branch_name' => $this->input->post('branch_name'),
                                'address_line_1' => $this->input->post('address_line_1'),
                                'address_line_2' => $this->input->post('address_line_2'),
                                'city_id' => $this->input->post('city_id')?$this->input->post('city_id'):null,
                                'state_id' => $this->input->post('state_id')?$this->input->post('state_id'):null,
                                'country_id' => $this->input->post('country_id')?$this->input->post('country_id'):null,
                                'city_name' => $this->input->post('city_name')?$this->input->post('city_name'):null,
                                'transaction_currency' => $this->input->post('transaction_currency')?$this->input->post('transaction_currency'):null,
                                'pincode' => $this->input->post('pincode'),
                                'email' => $this->input->post('email'),
                                'phone' => $this->input->post('phone'),
                                'fax' => $this->input->post('fax'),
                                'contact_person' => $this->input->post('contact_person'),
                                'contact_person_designation' => $this->input->post('contact_person_designation'),
                                'contact_country_code' => $this->input->post('contact_country_code'),
                                'contact_person_phone' => $this->input->post('contact_person_phone'),
                                'contact_person_email' => $this->input->post('contact_person_email')
                            );
                               // 'created_at' => date("Y-m-d H:i:s"),
                              //  'updated_at' => date("Y-m-d H:i:s")
                    if(empty($branch_details)){
                        //insert
                        
                        $dbOject['created_at'] = date("Y-m-d H:i:s");
                        $dbOject['updated_at'] = date("Y-m-d H:i:s");
                        if($this->BRNACH->insert($dbOject)){
                            $this->session->set_flashdata('success','Company branch added successfully.');
                                redirect(base_url('company-branch/'.$type));
                            }else{
                                $this->session->set_flashdata('error','Something goes wrong.');
                                redirect(base_url('company-branch/'.$type));
                            }
                            
                    }else{
                        //update
                      
                        $dbOject['updated_at'] = date("Y-m-d H:i:s");
                        if($this->BRNACH->update($branch_id,$dbOject)){
                            $this->session->set_flashdata('success','Company branch updated successfully.');
                                redirect(base_url('company-branch/'.$type));
                            }else{
                                $this->session->set_flashdata('error','Something goes wrong.');
                                redirect(base_url('company-branch/'.$type));
                            }
                    }            
                            
            }
		
                $data['designtnData'] = $this->seller_model->getDesignationData();       
		$data['page'] = 'frontend/branch/add';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['branch_details'] = $branch_details;
		$this->load->view('frontend/layout_main', $data);		
	}

        public function delete_branch($type,$branch_id){
            $branch_details = $this->BRNACH->getRecord($branch_id,$this->seller_session_data['company_id']);
            if(!empty($branch_details)){
                if($this->BRNACH->delete($branch_id)){
                     $this->session->set_flashdata('success','Company branch deleted successfully.');
                      
                }else{
                    $this->session->set_flashdata('error','Something goes wrong.');
                              
                }
                
            }else{
                $this->session->set_flashdata('error','Company brabch details not found.');
                
            }
            
            redirect(base_url('company-branch/'.$type));
            
        }
}
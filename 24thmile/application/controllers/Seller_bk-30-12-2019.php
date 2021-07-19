<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends CI_Controller {

    public $seller_session_data;
	public function __construct()
	{
		parent::__construct();
		
		if(empty($this->session->userdata("seller_logged_in")))
        {
			redirect(base_url('signin'));
        }else{
            $this->seller_session_data = $this->session->userdata('seller_logged_in');
            if($this->seller_session_data['role']!=='2'){
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
		$this->load->helper('cookie');
       	$this->load->library(array('session', 'form_validation', 'email'));
		
	}
	
	public function profile()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['leftmenuActive']="my-profile";
		if($_POST){
			$this->session->set_userdata('profileActiveTab','profile');
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
			 
                         
			 if(!empty($_FILES['profile_pic']['name'])) {
				 
				$config['upload_path'] = 'uploads/users/'; 
                                $pathinfoArr = pathinfo($_FILES['profile_pic']['name']);
                                $extention	= $pathinfoArr['extension'];
                                $newImagename = uniqid().'.'.$extention;
				$config['file_name'] = $newImagename;
//				$config['file_name'] = $_FILES['profile_pic']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = 'jpg|jpeg|png|gif';
				
				$this->load->library('upload',$config);
				
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('profile_pic')){	
                                    //unlink old file
                                    unlink($config['upload_path'].$this->input->post('old_profile_pic'));
					$uploadData = $this->upload->data();
					$profile_pic = $uploadData['file_name'];					
				}else{					
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
			   
			 if($this->seller_model->updateUser($userdata,$user_id)){
				
				 if(empty($profileData)){
					 
					 $userprofile['user_id'] = $user_id;
					 $this->seller_model->insertUserInfo($userprofile);
					 $this->session->set_flashdata('success','Profile updated successfully');
					 redirect(base_url('fs-my-profile'));
					 
				 }else{
					
					$this->seller_model->updateUserInfo($userprofile,$user_id);
					$this->session->set_flashdata('success','Profile updated successfully');
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
		
              $data['leftmenuActive']="company-profile";
                
		if($_POST){
                               $this->session->set_userdata('companyActiveTab','profile');    
                    
			
			$user_id = $seller_session_data['id'];
			$company_id = $seller_session_data['company_id'];
			
			$profileData = $this->seller_model->getSellerProfile($user_id);
			$companyData = $this->seller_model->getCompanyProfile($company_id);
			
			$headData = $this->seller_model->getHeadProfile($user_id);
				
			$companyData = array(
			  'name' => $this->input->post('company_name'),
			  'address_line_1' => $this->input->post('address_line_1'),
			  'address_line_2' => $this->input->post('address_line_2'),
			  'city_id' => $this->input->post('city_id')?$this->input->post('city_id'):null,
			  'state_id' => $this->input->post('state_id')?$this->input->post('state_id'):null,
			  'country_id' => $this->input->post('country_id')?$this->input->post('country_id'):null,
			  'city_name' => $this->input->post('city_name')?$this->input->post('city_name'):null,
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
			 
			 if(!empty($_FILES['company_logo']['name'])) {
				 
				$config['upload_path'] = 'uploads/company/'; 
                                $pathinfoArr = pathinfo($_FILES['company_logo']['name']);
                                $extention	= $pathinfoArr['extension'];
                                $newImagename = uniqid().'.'.$extention;
//				$config['file_name'] = $_FILES['company_logo']['name'];
				$config['file_name'] = $newImagename;
				$config['overwrite'] = false;
				$config["allowed_types"] = 'jpg|jpeg|png|gif';
				
				$this->load->library('upload',$config);
				
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('company_logo')){					
					$uploadData = $this->upload->data();
					$company_logo = $newImagename;					
				}else{					
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
                        $this->company_model->insertIndustryTypes($company_id,$this->input->post('industry_types'));
                        
                        
                        //delete old and insert insert mapp sectors
                        $this->company_model->insertSectors($company_id,$this->input->post('sectors'));
                        
			 if($this->company_model->update($company_id,$companyData)){
				
				 $this->session->set_flashdata('success','Company profile updated successfully.');
                                 redirect(base_url('fs-company-profile'));
                         } else{
                             $this->session->set_flashdata('error','Something went wrong.');
                                 redirect(base_url('fs-company-profile'));
                         }  
		}
		$kycDocuments[] = ["type"=>"5","documnetName"=>"GST/Tax No","is_mandatory"=>true,"details"=>array()];
		$kycDocuments[] = ["type"=>"1","documnetName"=>"PAN / Income Tax","is_mandatory"=>true,"details"=>array()];
		$kycDocuments[] = ["type"=>"2","documnetName"=>"COI/Proprietorship/LLP","is_mandatory"=>false,"details"=>array()];
		$kycDocuments[] = ["type"=>"4","documnetName"=>"Import Export Code","is_mandatory"=>false,"details"=>array()];
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$data['companyProfile'] = $this->seller_model->getCompanyProfile($seller_session_data['company_id']);
		$data['companyProfile']->industryTypes = $this->seller_model->getCompanyIndustryTypes($seller_session_data['company_id']);
		$data['companyProfile']->sectors = $this->seller_model->getCompanySectors($seller_session_data['company_id']);
                foreach ($kycDocuments as $key=>$doc){
                    $kycDocuments[$key]['details'] = $this->seller_model->getUserKYC($seller_session_data['company_id'],$doc['type']);
                }
		$data['companyProfile']->kyc_documents = $kycDocuments;
		
		$country_name = $this->seller_model->getCountries();
		$data['CName'] = $country_name;
		
		if(!empty($data['myProfile']->sector_id)){
			$data['sectorDocs'] = $this->seller_model->getSectorWiseDoc($data['myProfile']->sector_id);
		}else{
			$data['sectorDocs'] = "";
		}
                
		//$data['compData'] = $this->seller_model->getCompanyData();
		$data['designtnData'] = $this->seller_model->getDesignationData();
		$data['sectors'] = $this->sector_model->getList($active=true);
		$data['industries'] = $this->industry_model->getList($active=true);
		$data['page'] = 'frontend/seller/company-profile';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';

//                echo '<pre>';
//                print_r($data);
//                echo '</pre>';
//                die;
		$this->load->view('frontend/layout_main', $data);
	}
        
	public function business_head()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
		if($_POST){
			$this->session->set_userdata('activeTab','bhead');
			$user_id = $this->input->post('user_id');
			
			$headData = $this->seller_model->getHeadProfile($user_id);
			
			$headprofile['head_salutation'] = $this->input->post('head_salutation');
			$headprofile['head_designation_id'] = $this->input->post('head_designation');
			$headprofile['head_firstname'] = $this->input->post('head_firstname');
			$headprofile['head_lastname'] = $this->input->post('head_lastname');
			$headprofile['head_email'] = $this->input->post('head_email');
			$headprofile['head_country_code'] = $this->input->post('head_country_code');
			$headprofile['industry'] = $this->input->post('head_industry');
			$headprofile['head_phone'] = $this->input->post('head_phone');
			$headprofile['sector_id'] = $this->input->post('head_sector');
			
			
			if(empty($headData)){
				
				$headprofile['user_id'] = $user_id;
				$this->seller_model->insertUserHead($headprofile);
				$this->session->set_flashdata('success','Head info updated successfully');
				redirect(base_url('my-profile'));
				
			}else{
				
				$this->seller_model->updateUserHead($headprofile,$user_id);
				$this->session->set_flashdata('success','Head info updated successfully');
				redirect(base_url('my-profile'));
			}
			 
		}
	}
	
	public function kyc_document()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		//print_r($seller_session_data);
		if($_POST){
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
			
			for($i=0; $i<$cpt; $i++)
			{           
                                if(!empty($files['kyc_documents']['name'][$i])){
                                $_FILES['kyc_documents']['name']= $files['kyc_documents']['name'][$i];
				$_FILES['kyc_documents']['type']= $files['kyc_documents']['type'][$i];
				$_FILES['kyc_documents']['tmp_name']= $files['kyc_documents']['tmp_name'][$i];
				$_FILES['kyc_documents']['error']= $files['kyc_documents']['error'][$i];
				$_FILES['kyc_documents']['size']= $files['kyc_documents']['size'][$i];    

				$config = array();
                                
                                $pathinfoArr = pathinfo($_FILES['kyc_documents']['name']);
                                $extention	= $pathinfoArr['extension'];
                                $newImagename = uniqid().'.'.$extention;
//				$config['file_name'] = $_FILES['company_logo']['name'];
				$config['file_name'] = $newImagename;
				$config['overwrite'] = false;
                                $config['upload_path'] = 'uploads/kyc_documents/';
                                $config['allowed_types'] = 'gif|jpg|png|Pdf|doc|docx';
				
				
				$this->upload->initialize($config);
                                
				//$this->upload->initialize($this->set_upload_options());
				
				$this->upload->do_upload('kyc_documents');
				
				$dataInfo[] = $this->upload->data();
				$dataInfo[$i]['doc_name'] = $doc_names[$i];
				$dataInfo[$i]['doc_number'] = $document_number[$i];
				$dataInfo[$i]['original_file_name'] = $_FILES['kyc_documents']['name'];
                                //unlink old file
                                       unlink($config['upload_path'].$old_doc_name[$i]);
                                   
                                }
				
				
			}
//			print_r($dataInfo);die;
			foreach($dataInfo as $kycfile){
				
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
			
			//print_r($dataInfo);die;
			$this->session->set_flashdata('success','KYC document uploaded successfully');
			redirect(base_url('fs-company-profile'));

			  
		}
	}
	
	public function change_password()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
		if($_POST){
			//$this->session->set_userdata('profileActiveTab','setting');
			
			$user_id = $seller_session_data['id'];
			
			//$profileData = $this->seller_model->getSellerProfile($user_id);
				
			$userdata = array(
			  'password' => sha1($this->input->post('confirm_password'))
		     );
			 
			 if($this->seller_model->updateUser($userdata,$user_id)){
				
				$this->session->set_flashdata('success','Password updated successfully');
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
            
		$data['myProfile'] = $this->seller_model->getSellerInfo($this->seller_session_data['id']);
		$data['shippig_requirment_list'] = $this->seller_model->getRequirmentList($this->seller_session_data['id']);
		
		$data['page'] = 'frontend/seller/request_list';
                
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}
	
        public function select_ff($request_id){
            
            $ff_list =  $this->seller_model->getFfList();
                            
            if($this->input->post() && $this->input->post('btn_submit')=='Request for Quote'){
                //remove old 
               // $this->seller_model->deleteRequestFf($request_id);
                if($this->input->post('ff_id')){
                      foreach ($this->input->post('ff_id') as $ff_id){
                    $insertData = [
                        'request_id' => $request_id,
                        'ff_id' => $ff_id,
                    ];
                    $this->seller_model->insertRequestFf($insertData);
                }
                $this->seller_model->changeRequestStatus($request_id,['status'=>'send_for_quote']);
                }
              
                
                
            }
            
            $data['ff_list'] = $ff_list;
            $data['selectedFFids'] = $this->seller_model->getSelectedFfids($request_id);
            $data['page'] = 'frontend/seller/select_ff';
            $data['sidebar'] = 'frontend/components/sidebar_dashboard';
//            $this->load->helper('vayes_helper');
//                vdebug($data);
            $this->load->view('frontend/layout_main', $data);
        }
        
        public function quoteList($request_id){
            
            $ff_list =  $this->seller_model->getResponseFfList($request_id);
                            
            $data['ff_list'] = $ff_list;
            $data['requestDetails'] = $this->seller_model->getRequirmentDetails($request_id,$this->seller_session_data['id']);
            $data['selectedFFids'] = $this->seller_model->getSelectedFfids($request_id);
            $data['page'] = 'frontend/seller/quote_list';
            $data['sidebar'] = 'frontend/components/sidebar_dashboard';
//            $this->load->helper('vayes_helper');
//                vdebug($data['requestDetails']);
            $this->load->view('frontend/layout_main', $data);
        }
        public function companyDetails($company_id){
            
           
            $data['companyDetails'] = $this->seller_model->getFFcompanyDetails($company_id);
            $data['page'] = 'frontend/seller/ff_company_details';
            $data['sidebar'] = 'frontend/components/sidebar_dashboard';
            $this->load->view('frontend/layout_main', $data);
        }
        
        
        public function viewQuote($request_id,$ff_id){
            
            $requestDetails = $this->freight_model->getRequirmentDetails($request_id,$ff_id);
            if($this->input->post()){
                $submit = $this->input->post('submit');
                
                if($submit=='Submit Counter Rate'){
                    //update counter rate
                    foreach ($this->input->post('items') as $item){
                        $updateData = ['counter_rate'=>$item['counter_rate']?$item['counter_rate']:null];
                        $this->seller_model->updateCounterRate($request_id,$item['item_id'],$ff_id,$updateData);
                    }
                    $this->session->set_flashdata('success','Counter rate updated successfully.');
				redirect(base_url('quote-list/'.$request_id));
                    
                }else if($submit=='Accept Quote'){
                    //select ff
                    $this->seller_model->changeRequestStatus($request_id,['status'=>'confirm_shipment','selected_ff_id'=>$ff_id,'selected_ff_dt'=>date('Y-m-d H:i:s')]);
                }
                
            }
            $data['requestDetails'] = $requestDetails;
            $data['rfc_charges'] = $this->freight_model->getRfcCharges($requestDetails->delivery_term_id,$request_id,$ff_id);
            $data['page'] = 'frontend/seller/view_quote';
            $data['sidebar'] = 'frontend/components/sidebar_dashboard';
//            $this->load->helper('vayes_helper');
//                vdebug($requestDetails);
            $this->load->view('frontend/layout_main', $data);
        }
        
	public function freight_compare()
	{
		
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$feId = $this->uri->segment(2);
		$topThreeQuote = $this->seller_model->getFreightEnquiryQuotationData($feId);
		$compareData = array();
		$checkdata = array();
		$cocount = array();
		//echo '<pre>';print_r($topThreeQuote);
		
		foreach($topThreeQuote as $thquote){
			$compareData[$thquote->company_name][$thquote->rfc_category_name][$thquote->particular][]= $thquote;
			$checkdata[$thquote->company_name][$thquote->rfc_category_name][$thquote->particular][$thquote->container_id]= $thquote;
		}
		

		// print_r($checkdata);die;
		$data['FEQuotation'] = $compareData;
		$data['checkdata'] = $checkdata;
		
		$tempData = $this->seller_model->getTemplateData($data['myProfile']->sector_id);
		
		$countOffers = $this->seller_model->getCountOffers($seller_session_data['id'],$feId);
		
		$cocount = $this->seller_model->getNoAttemptOfCount($seller_session_data['id'],$feId);
		//echo '<pre>';print_r($cocount);die;
		$newTemData = array();
		foreach($tempData as $temData){
			
			$newTemData[$temData->template_id][$temData->rfc_category_name.'-'.$temData->rfc_category_id][$temData->particular.'-'.$temData->particular_id][$temData->container_id] = $temData;
		}
		$data['cocount'] = $cocount;
		$data['tempData'] = $newTemData;

		// print_r($newTemData);die;

		$data['countOffers'] = $countOffers;
		//$data['FEQuotation'] = $compareData;
		$data['page'] = 'frontend/seller/freight_compare';
		$this->load->view('frontend/layout_main', $data);
	}
	
	public function send_counter_offer()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
		if($_POST){
			
			$user_id = $seller_session_data['id'];
			
			$profileData = $this->seller_model->getSellerProfile($user_id);
			
			$num_cont = $this->input->post('num_cont');
			$amount = $this->input->post('amount');
			$freight_enquiry_id = $this->input->post('freight_enquiry_id');
			$ff_id = $this->input->post('ff_id');
			$totalqts = 0;
			
			$noOfAttempt = $this->seller_model->getNoOfCounter($user_id,$freight_enquiry_id,$ff_id);
			
			if(!empty($noOfAttempt)){
				
				if($noOfAttempt < 2){
					
					$attmpt['sender_user_id'] = $user_id;
					$attmpt['freight_enquiry_id'] = $freight_enquiry_id;
					$attmpt['no_of_attempt'] = 2;
					$attmpt['receiver_user_id'] = $ff_id;
					
					$this->seller_model->updateNoAttempt($user_id,$freight_enquiry_id,$ff_id,$attmpt);
				}
				
			}else{
				
				$attmpt['sender_user_id'] = $user_id;
				$attmpt['freight_enquiry_id'] = $freight_enquiry_id;
				$attmpt['no_of_attempt'] = 1;
				$attmpt['receiver_user_id'] = $ff_id;
				
				$this->seller_model->insertNoAttempt($attmpt);	
				
			}
			
			foreach($num_cont as $ref_cat_id=>$r_num_count){
				
				foreach($r_num_count as $partcl_id=>$rm_num_count){
					
					foreach($rm_num_count as $cont_id=>$rmv_val){
						
						$totalqts = $totalqts + (($amount[$ref_cat_id][$partcl_id][$cont_id])*($rmv_val));
						
						$postdata = array(
						  'sender_user_id' => $user_id,
						  'receiver_user_id' => $ff_id,
						  'freight_enquiry_id' => $freight_enquiry_id,
						  'rfc_category_id' => $ref_cat_id,
						  'particular_id' => $partcl_id,
						  'container_id' => $cont_id,
						  'no_of_container' => $rmv_val,
						  'amount' => $amount[$ref_cat_id][$partcl_id][$cont_id],
						  'total_amount' => (($amount[$ref_cat_id][$partcl_id][$cont_id])*($rmv_val)),
						  'total_quotes' => $totalqts,
						  'reply_date' => date('Y-m-d')
						 );
						 
						 $this->seller_model->insertCounterQuatation($postdata);
					}
				}
			}
			
			
			
			 
			 $this->session->set_flashdata('success','Profile updated successfully');
			 redirect(base_url('request-list'));
					 
				
			 
		}
	}
	
	public function view_respond()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$feId = $this->uri->segment(2);
		$topThreeQuote = $this->seller_model->getMyCounterOffers($feId,$seller_session_data['id']);
		//echo '<pre>';print_r($topThreeQuote);die;
		$compareData = array();
		$checkdata = array();
		$cocount = array();
		foreach($topThreeQuote as $thquote){
			$compareData[$thquote->company_name][$thquote->rfc_category_name][$thquote->particular][]= $thquote;
			$checkdata[$thquote->company_name][$thquote->rfc_category_name][$thquote->particular][$thquote->container_id]= $thquote;
		}
		
		$data['FEQuotation'] = $compareData;
		$data['checkdata'] = $checkdata;
		
		$tempData = $this->seller_model->getTemplateData($data['myProfile']->sector_id);
		
		$countOffers = $this->seller_model->getCountOffers($seller_session_data['id'],$feId);
		
		$cocount = $this->seller_model->getNoAttemptOfCount($seller_session_data['id'],$feId);
		
		$newTemData = array();
		foreach($tempData as $temData){
			
			$newTemData[$temData->template_id][$temData->rfc_category_name.'-'.$temData->rfc_category_id][$temData->particular.'-'.$temData->particular_id][$temData->container_id] = $temData;
		}
		$data['cocount'] = $cocount;
		$data['tempData'] = $newTemData;
		$data['countOffers'] = $countOffers;
		//$data['FEQuotation'] = $compareData;
		$data['page'] = 'frontend/seller/view_respond';
		$this->load->view('frontend/layout_main', $data);
	}
	
	/*public function freight_compare()
	{
		
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$feId = $this->uri->segment(2);
		$topThreeQuote = $this->seller_model->getFreightEnquiryQuotationData($feId);
		$compareData = array();
		$i=0;
		$partcls = array();
		foreach($topThreeQuote as $thquote){
			
			$companame[] = $thquote->company_name;
			
			if(!in_array($thquote->particular,$partcls)){
				
				array_push($partcls,$thquote->particular);
				
				$particulars[$thquote->rfc_category_name][] = $thquote->particular;
			}
			
			$compareData[$thquote->particular][$thquote->company_name][] = $thquote;
			
		}
		
		$data['companame'] = array_unique($companame);
		$data['particulars'] = $particulars;
		$data['compareData'] = $compareData;
		
		//$data['FEQuotation'] = $compareData;
		$data['page'] = 'frontend/seller/freight_compare';
		$this->load->view('frontend/layout_main', $data);
	}*/
	
	public function shipping_requirement($request_id='')
	{
         
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
                 //get request details
                if($this->input->post('request_id')){
                    $request_id = $this->input->post('request_id');
                }

                $requestDetails = $this->seller_model->getRequirmentDetails($request_id,$this->seller_session_data['id']);
//                $this->load->helper('vayes_helper');
//                vdebug($requestDetails);
		if($_POST){
			
			
			
			$user_id = $this->seller_session_data['id'];
			
			//$profileData = $this->seller_model->getSellerProfile($user_id);
			
				
			$postdata = array(
			  
			  'mode_id' => $this->input->post('mode')?$this->input->post('mode'):null,
			  'delivery_term_id' => $this->input->post('delivery_term')?$this->input->post('delivery_term'):null,
			  'shipment_id' => $this->input->post('shipment')?$this->input->post('shipment'):null,
			  'container_stuffing' => $this->input->post('container_stuffing'),
			  'cargo_status' => $this->input->post('cargo_status'),
			  'consignor_name' => $this->input->post('consignor_name'),
			  'consignor_country_code' => $this->input->post('consignor_country_code'),
			  'consignor_phone' => $this->input->post('consignor_phone'),
			  'consignor_address_line_1' => $this->input->post('consignor_address_line_1'),
			  'consignor_address_line_2' => $this->input->post('consignor_address_line_2'),
			  'consignor_city_name' => $this->input->post('consignor_city_name'),
			  'consignor_city_id' => $this->input->post('consignor_city_id')?$this->input->post('consignor_city_id'):null,
			  'consignor_state_id' => $this->input->post('consignor_state_id')?$this->input->post('consignor_state_id'):null,
			  'consignor_country_id' => $this->input->post('consignor_country_id')?$this->input->post('consignor_country_id'):null,
			  'consignor_pincode' => $this->input->post('consignor_pincode'),
			  'consignee_name' => $this->input->post('consignee_name'),
			  'consignee_country_code' => $this->input->post('consignee_country_code'),
			  'consignee_phone' => $this->input->post('consignee_phone'),
			  'consignee_address_line_1' => $this->input->post('consignee_address_line_1'),
			  'consignee_address_line_2' => $this->input->post('consignee_address_line_2'),
			  'consignee_city_name' => $this->input->post('consignee_city_name'),
			  'consignee_city_id' => $this->input->post('consignee_city_id')?$this->input->post('consignee_city_id'):null,
			  'consignee_state_id' => $this->input->post('consignee_state_id')?$this->input->post('consignee_state_id'):null,
			  'consignee_country_id' => $this->input->post('consignee_country_id')?$this->input->post('consignee_country_id'):null,
			  'consignee_pincode' => $this->input->post('consignee_pincode'),
			  'shipment_value' => $this->input->post('shipment_value')?$this->input->post('shipment_value'):null,
			  'shipment_value_currency' => $this->input->post('shipment_value_currency')?$this->input->post('shipment_value_currency'):null,
			  'port_loading_id' => $this->input->post('port_loading_id')?$this->input->post('port_loading_id'):null,
			  'port_discharge_id' => $this->input->post('port_discharge_id')?$this->input->post('port_discharge_id'):null,
			  'tentativ_date_dispatch' => $this->input->post('tentativ_date_dispatch')?$this->input->post('tentativ_date_dispatch'):null,
			  'tentativ_date_delivery' => $this->input->post('tentativ_date_delivery')?$this->input->post('tentativ_date_delivery'):null,
			  'special_consideration_lcl' => $this->input->post('special_consideration_lcl'),
			  'response_end_date' => $this->input->post('response_end_date')?$this->input->post('response_end_date'):null
		     );
			 
                      if(empty($requestDetails)){
                          //insert
                          $postdata['user_id'] =  $user_id?$user_id:null;
                          $request_id = $this->seller_model->insertRequirement($postdata);
                          $this->session->set_flashdata('success','Freight Enquiry Created successfully');
                      }else{
                          //update
                          $postdata['updated_at'] =  date("Y-m-d H:i:s");
                          $postdata['status'] = 'edited';
                          $updated = $this->seller_model->updateRequirement($request_id,$postdata);
                          $this->session->set_flashdata('success','Freight Enquiry updated successfully');
                      }  
			
			
                        if($this->input->post('shipment')=='1'){
                            //FCL
                            $this->insertRequestItems($request_id,$this->input->post('container'));
                        }else if($this->input->post('shipment')=='2'){
                            //LCL
                            $this->insertRequestItems($request_id,$this->input->post('package'));
                        }
                         
			
			redirect(base_url('fs-request-list'));
		}
		
		$country_name = $this->seller_model->getCountries();
	
		/* $new_country_name = array();  
		foreach($country_name as $cntry_name){
			$cntName = trim($cntry_name->country_name);
			array_push($new_country_name,$cntName);
		}
		$new_country_name = array_unique($new_country_name);
		$CName = implode('", "',$new_country_name); */
		$data['CName'] = $country_name;
		$data['requestDetails'] = $requestDetails;
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$data['compData'] = $this->seller_model->getCompanyData();
		$data['delivery_terms'] = $this->deliver_term_model->getList();
		$data['doc_verified'] = $this->seller_model->documentVerified($seller_session_data['id']);
		$data['modes'] = $this->mode_model->getList();
		$data['pol'] = $this->port_model->getPOLList();
		$data['pod'] = $this->port_model->getPODList();
		$data['companys'] = $this->company_model->getList();
		$data['shipments'] = $this->shipment_model->getList(true);
		$data['contracts'] = $this->contract_model->getList(true);

               
		
		$data['container_types'] = $this->container_model->getList();
		$data['packingList'] = $this->packing_model->getList();
		$data['containerSizeList'] = $this->container_size_model->getList();
		$data['page'] = 'frontend/seller/shipping_requirement';
                $data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}
	
        public function insertRequestItems($requestId,$items){
            $arryItemIds = array();
           
            foreach ($items as $item){
                $postData = [
                    'request_id'=>$requestId,
                    'item_type'=>$item['item_type']?$item['item_type']:null,
                    'material_type'=>$item['material_type']?$item['material_type']:null,
                    'material_description'=>$item['material_description']?$item['material_description']:null,
                    'hs_code'=>$item['hs_code']?$item['hs_code']:null,
                    'type_of_packing'=>$item['type_of_packing']?$item['type_of_packing']:null,
                    'length'=>$item['length']?$item['length']:null,
                    'length_uom'=>$item['length_uom']?$item['length_uom']:null,
                    'height'=>$item['height']?$item['height']:null,
                    'height_uom'=>$item['height_uom']?$item['height_uom']:null,
                    'width'=>$item['width']?$item['width']:null,
                    'width_uom'=>$item['width_uom']?$item['width_uom']:null,
                    'net_weight'=>$item['net_weight']?$item['net_weight']:null,
                    'net_weight_uom'=>$item['net_weight_uom']?$item['net_weight_uom']:null,
                    'gross_weight'=>$item['gross_weight']?$item['gross_weight']:null,
                    'gross_weight_uom'=>$item['gross_weight_uom']?$item['gross_weight_uom']:null,
                    'container_size'=>$item['container_size']?$item['container_size']:null,
                    'container_type'=>$item['container_type']?$item['container_type']:null,
                    'number_of_container'=>$item['number_of_container']?$item['number_of_container']:null,
                    'remarks'=>$item['remarks']?$item['remarks']:null,
                ];
               
                if($item['item_id']){
                    //update
                    $this->seller_model->updateRequirementItem($item['item_id'],$postData);
                    $arryItemIds[] = $item['item_id'];
                }else{
                    //insert new
                   $arryItemIds[]= $this->seller_model->insertRequirementItem($postData);
                }
                
            }
            $this->seller_model->deleteRequirementItem($requestId, $arryItemIds);
            
        }
      
	public function book_shipment()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
			$user_id = $seller_session_data['id'];
			
			$rfc_id = $this->uri->segment(2);
			$comname = urldecode($this->uri->segment(3));
			//echo $rfc_id;
			//echo $comname;die;
			$rfcData = $this->seller_model->getFreightEnquiryByRFCId($rfc_id);
			$comUser = $this->seller_model->getCompInfo($comname);
			$bookdataAvail = $this->seller_model->getBookedShipmentByRFCId($rfc_id);
			
			if(empty($bookdataAvail)){
				
				//echo '<pre>'; print_r($rfcData);
				//echo '<pre>'; print_r($comUser);die;
				
				$postdata = array(
				  'rfc_id' => $rfc_id,
				  'user_id' => $rfcData->user_id,
				  'ff_id' => $comUser->id,
				  'buyer_id' => $rfcData->buyer_id,
				  'transaction' => $rfcData->transaction,
				  'mode_id' => $rfcData->mode_id,
				  'pickup_address_1' => $rfcData->pickup_address_1,
				  'pickup_pin' => $rfcData->pickup_pin,
				  'pickup_country' => $rfcData->pickup_country,
				  'pickup_state' => $rfcData->pickup_state,
				  'pickup_city' => $rfcData->pickup_city,
				  'delivery_address_1' => $rfcData->delivery_address_1,
				  'delivery_pin' => $rfcData->delivery_pin,
				  'delivery_country' => $rfcData->delivery_country,
				  'delivery_state' => $rfcData->delivery_state,
				  'delivery_city' => $rfcData->delivery_city,
				  'deliver_term_id' => $rfcData->deliver_term_id,
				  'shipment_value' => $rfcData->shipment_value,
				  'shipment_id' => $rfcData->shipment_id,
				  'shipment_value_currency' => $rfcData->shipment_value_currency,
				  'contract_id' => $rfcData->contract_id,
				  'quote_country' => $rfcData->quote_country,
				  'quote_region' => $rfcData->quote_region,
				  'port_loading_id' =>$rfcData->port_loading_id,
				  'port_discharge_id' => $rfcData->port_discharge_id
				 );
				 
				 $this->seller_model->insertBookShipment($postdata);
				 $this->session->set_flashdata('success','Shipment booked successfully');
				 redirect(base_url('freight-compare/'.$rfc_id));
				 
			}else{
				
				$this->session->set_flashdata('error','You already booked this shipment');
				 redirect(base_url('freight-compare/'.$rfc_id));
				 
			}
	}
	
	public function shipment_list()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);

		$bookedShipment = $this->seller_model->getBookedShipmentList($seller_session_data['id']);
		
		$data['bookedShipment'] = $bookedShipment;
		$data['page'] = 'frontend/seller/shipment_list';
		$this->load->view('frontend/layout_main', $data);
	}
	
	public function view_shipment_tracking()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		
		$data['page'] = 'frontend/seller/view_shipment_tracking';
		$this->load->view('frontend/layout_main', $data);
	}

	
	
	public function shipment_tracking()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$transctn = $this->uri->segment(2);
		$bookid = $this->uri->segment(3);
		$confirmShipment = $this->seller_model->getBookedShipmentById($seller_session_data['id'],$transctn,$bookid);
		
		$steps = $this->seller_model->getSPSteps($transctn);

		// For step show start
		$completedStep = $this->seller_model->getCompletedStep($transctn,$bookid);
		$currentStep = $this->seller_model->getCurrentStep($transctn,$bookid);
		$completedStepID = array();
		foreach ($completedStep as $CS) {			
			array_push($completedStepID,$CS->step_id);
		}		
		if($currentStep==NULL){
			$nextStep = $this->seller_model->getNextStep($transctn,$completedStepID);
			if($nextStep){
				$currentStep = new StdClass;
				$currentStep->step_id = $nextStep->id;
			}else{
				$lastCompletedSetp = $this->seller_model->getLastCompletedStep($transctn,$bookid);
				$currentStep = new StdClass;
				$currentStep->step_id = $lastCompletedSetp->step_id;
			}
		}


		// print_r($currentStep);die;
		// push current step in complete step to active ul>li
		array_push($completedStepID,$currentStep->step_id);		
 		$data['currentStep'] = $currentStep;
 		$data['completedStep'] = $completedStepID;
 		// For step show End



	// print_r($currentStep->step_id);
	// echo '<br>';
	// print_r($shipmentProcessData[0]->step_id);die;

		$shipmentProcessData = $this->seller_model->getShipmentProcessData($transctn,$bookid);
		//echo '<pre>';print_r($shipmentProcessData);die;
		$data['bookedShipment'] = $confirmShipment;
		$data['stepData'] = $steps;
		$data['shipmentProcessData'] = $shipmentProcessData;
		
		if($transctn == 1){
			$data['page'] = 'frontend/seller/shipment_tracking';
		}else{
			$data['page'] = 'frontend/seller/shipment_tracking_import';
		}
		
		$this->load->view('frontend/layout_main', $data);
	}
	
	
	public function getAjaxState(){
		$cntId = $this->input->post('countryN');
		$statedata = $this->seller_model->getStateByCountry(trim($cntId));
		echo json_encode($statedata);
	}
	
	public function getAjaxCity(){
		$state = $this->input->post('state');
		$Citydata = $this->seller_model->getCityByState(trim($state));
		echo json_encode($Citydata);
	}
	
	public function upload_process_documents(){
		
		$rfc_id = $this->input->post('rfc_id');
		$book_id = $this->input->post('book_id');
		
		$step = array_search("Save",$this->input->post());
		
		
		
		switch ($step) {
			
			case "step1_export":
						
						$step_id = $this->input->post('step_id');
						
						$step1_export_custom_invoice_number = $this->input->post('step1_export_custom_invoice_number');
						$step1_export_custom_invoice_date = $this->input->post('step1_export_custom_invoice_date');
						
						if(!empty($_FILES['step1_export_custom_invoice']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['step1_export_custom_invoice']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('step1_export_custom_invoice')){					
								$uploadData = $this->upload->data();
								$step1_export_custom_invoice = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$step1_export_custom_invoice = '';
							}
							
							$documents['Custom_Invoice'] = $step1_export_custom_invoice;
						}
						
						if(!empty($_FILES['step1_export_packing_list']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['step1_export_packing_list']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('step1_export_packing_list')){					
								$uploadData = $this->upload->data();
								$step1_export_packing_list = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$step1_export_packing_list = '';
							}
							
							$documents['packing_List'] = $step1_export_packing_list;
						}
						
						if(!empty($_FILES['step1_export_other_documents']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['step1_export_other_documents']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('step1_export_other_documents')){					
								$uploadData = $this->upload->data();
								$step1_export_other_documents = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$step1_export_other_documents = '';
							}
							
							$documents['other_documents'] = $step1_export_other_documents;
						}
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['documents'] = json_encode($documents);
						
						$bkdata['custom_invoice_number'] = $step1_export_custom_invoice_number;
						$bkdata['custom_invoice_date'] = date('Y-m-d',strtotime($step1_export_custom_invoice_date));
						
						$dataStep1['action_date'] = date('Y-m-d');
						$dataStep1['time'] = date('h:i:s');
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
							
						$dataStep1['status'] = 2;
						
						$this->seller_model->updateBookShipment($bkdata,$book_id);
		
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								// $to = 'amolc.infinite1@gmail.com';
								// $this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								// $smstext = "Preshipment document uploaded.";
								// $this->sendSMS($to,$smstext);
								
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
							
						}else{
							
							if($stepdata->status == 2){
							
								$dataStep1['status'] = 2;
							
							}
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = 'amolc.infinite1@gmail.com';
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
								
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
						}
						
				break;
		case "step2_export":
			
						$step_id = $this->input->post('step_id_2');
						
						$step2_export_correction = $this->input->post('step2_export_correction');
						
						$step2_export_status = $this->input->post('step2_export_status');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step2_export_status;
						$dataStep1['corrections'] = $step2_export_correction;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
						}
					break;
		case "step5_export":
			
						$step_id = $this->input->post('step_id_5');
						
						$step5_export_correction = $this->input->post('step5_export_correction');
						
						$step5_export_status = $this->input->post('step5_export_status');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step5_export_status;
						$dataStep1['corrections'] = $step5_export_correction;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						$dataStep1['status'] = $step5_export_status;
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
						}
				break;
		case "step7_export":
						
						$step_id = $this->input->post('step_id_7');
						
						$step7_export_commercial_invoice_number = $this->input->post('step7_export_commercial_invoice_number');
						$step7_export_commercial_invoice_date = $this->input->post('step7_export_commercial_invoice_date');
						$step7_export_status = $this->input->post('step7_export_status');
						$step7_export_correction = $this->input->post('step7_export_correction');
						$step7_export_agree_document_sent = $this->input->post('step7_export_agree_document_sent');
						
						if(!empty($_FILES['post_shipment_doc1']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['post_shipment_doc1']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('post_shipment_doc1')){					
								$uploadData = $this->upload->data();
								$post_shipment_doc1 = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$post_shipment_doc1 = '';
							}
							
							$documents['post_shipment_doc1'] = $post_shipment_doc1;
						}
						
						if(!empty($_FILES['post_shipment_doc2']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['post_shipment_doc2']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('post_shipment_doc2')){					
								$uploadData = $this->upload->data();
								$post_shipment_doc2 = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$post_shipment_doc2 = '';
							}
							
							$documents['post_shipment_doc2'] = $post_shipment_doc2;
						}
						
						if(!empty($_FILES['post_shipment_doc3']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['post_shipment_doc3']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('post_shipment_doc3')){					
								$uploadData = $this->upload->data();
								$post_shipment_doc3 = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$post_shipment_doc3 = '';
							}
							
							$documents['post_shipment_doc3'] = $post_shipment_doc3;
						}
						
						if(!empty($_FILES['post_shipment_doc4']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['post_shipment_doc4']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('post_shipment_doc4')){					
								$uploadData = $this->upload->data();
								$post_shipment_doc4 = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$post_shipment_doc4 = '';
							}
							
							$documents['post_shipment_doc4'] = $post_shipment_doc4;
						}
						
						if(!empty($_FILES['post_shipment_doc5']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['post_shipment_doc5']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('post_shipment_doc5')){					
								$uploadData = $this->upload->data();
								$post_shipment_doc5 = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$post_shipment_doc5 = '';
							}
							
							$documents['post_shipment_doc5'] = $post_shipment_doc5;
						}
						
						if(!empty($_FILES['post_shipment_doc6']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['post_shipment_doc6']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('post_shipment_doc6')){					
								$uploadData = $this->upload->data();
								$post_shipment_doc6 = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$post_shipment_doc6 = '';
							}
							
							$documents['post_shipment_doc6'] = $post_shipment_doc6;
						}
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['documents'] = json_encode($documents);
						$dataStep1['note_for_doc'] = $step7_export_agree_document_sent;
						$dataStep1['status'] = 1;
						$dataStep1['corrections'] = $step7_export_correction;
						
						$bkdata['commercial_invoice_number'] = $step7_export_commercial_invoice_number;
						$bkdata['commercial_invoice_date'] = date('Y-m-d',strtotime($step7_export_commercial_invoice_date));
						
						$dataStep1['action_date'] = date('Y-m-d');
						$dataStep1['time'] = date('h:i:s');
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						$this->seller_model->updateBookShipment($bkdata,$book_id);
		
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = 'amolc.infinite1@gmail.com';
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = 'amolc.infinite1@gmail.com';
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
								
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
						}
						
				break;
		case "step8_export":
			
						$step_id = $this->input->post('step_id_8');
						
						$step8_export_correction = $this->input->post('step8_export_correction');
						
						$step8_export_status = $this->input->post('step8_export_status');
						
						
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step8_export_status;
						$dataStep1['corrections'] = $step8_export_correction;
						
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
						}
					break;
		case "step10_export":
			
						$step_id = $this->input->post('step_id_10');
						
						$step10_export_correction = $this->input->post('step10_export_correction');
						
						$step10_export_status = $this->input->post('step10_export_status');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step10_export_status;
						$dataStep1['corrections'] = $step10_export_correction;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
						}
					break;
		case "step11_export":
			
						$step_id = $this->input->post('step_id_11');
						
						$step11_export_dbk_received = $this->input->post('step11_export_dbk_received');
						$step11_export_meis_received = $this->input->post('step11_export_meis_received');
						$step11_export_bill_amnt_received = $this->input->post('step11_export_bill_amnt_received');
						$step11_export_erbc_number = $this->input->post('step11_export_erbc_number');
						$step11_export_erbc_date = $this->input->post('step11_export_erbc_date');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = 1;
						$dataStep1['corrections'] = '';
						
						$bkdata['ERBC_number'] = $step11_export_erbc_number;
						$bkdata['ERBC_date'] = date('Y-m-d',strtotime($step11_export_erbc_date));
						$bkdata['MEIS_status'] = $step11_export_meis_received;
						$bkdata['Bill_status'] = $step11_export_bill_amnt_received;
						$bkdata['DBK_status'] = $step11_export_dbk_received;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						$this->seller_model->updateBookShipment($bkdata,$book_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/1/'.$book_id));
							}
						}
				break;
			default:
				echo "Your favorite color is neither red, blue, nor green!";
		}
	}
	
	public function upload_import_process_documents(){
		
		$rfc_id = $this->input->post('rfc_id');
		$book_id = $this->input->post('book_id');
		
		$step = array_search("Save",$this->input->post());
		
		//print_r($_FILES);
		//print_r($this->input->post());die;
		
		switch ($step) {
			
			case "step1_import":
						$step_id = $this->input->post('step_id');
						if(!empty($_FILES['step1_import_custom_invoice']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['step1_import_custom_invoice']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('step1_import_custom_invoice')){					
								$uploadData = $this->upload->data();
								$step1_import_custom_invoice = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$step1_import_custom_invoice = '';
							}
							
							$documents['Custom_Invoice'] = $step1_import_custom_invoice;
						}
						
						if(!empty($_FILES['step1_import_packing_list']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['step1_import_packing_list']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('step1_import_packing_list')){					
								$uploadData = $this->upload->data();
								$step1_import_packing_list = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$step1_import_packing_list = '';
							}
							
							$documents['packing_List'] = $step1_import_packing_list;
						}
						
						if(!empty($_FILES['step1_import_transit_insurance']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['step1_import_transit_insurance']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('step1_import_transit_insurance')){					
								$uploadData = $this->upload->data();
								$step1_import_transit_insurance = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$step1_import_transit_insurance = '';
							}
							
							$documents['Transit_Insurance'] = $step1_import_transit_insurance;
						}
						
						if(!empty($_FILES['step1_import_other_documents']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step1_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['step1_import_other_documents']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('step1_import_other_documents')){					
								$uploadData = $this->upload->data();
								$step1_import_other_documents = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$step1_import_other_documents = '';
							}
							
							$documents['other_documents'] = $step1_import_other_documents;
						}
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['documents'] = json_encode($documents);
						
						$dataStep1['action_date'] = date('Y-m-d');
						$dataStep1['time'] = date('h:i:s');
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
							
						$dataStep1['status'] = 2;
		
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}
							
						}else{
							
							if($stepdata->status == 2){
							
								$dataStep1['status'] = 2;
							
							}
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}
						}
						
				break;
		case "step2_import":
			
						$step_id = $this->input->post('step_id_2');
						
						$step2_import_correction = $this->input->post('step2_import_correction');
						
						$step2_import_status = $this->input->post('step2_import_status');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step2_import_status;
						$dataStep1['corrections'] = $step2_import_correction;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}
						}
					break;
		case "step5_import":
			
						$step_id = $this->input->post('step_id_5');
						
						$step5_import_correction = $this->input->post('step5_import_correction');
						
						$step5_import_status = $this->input->post('step5_import_status');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step5_import_status;
						$dataStep1['corrections'] = $step5_import_correction;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata->status == 2){
							
							$dataStep1['status'] = 3;
						
						}else{
							
							$dataStep1['status'] = $step5_import_status;
						
						}
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}
						}
				break;
		case "step8_import":
			
						$step_id = $this->input->post('step_id_8');
						
						$step8_import_correction = $this->input->post('step8_import_correction');
						
						$step8_import_status = $this->input->post('step8_import_status');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step8_import_status;
						$dataStep1['corrections'] = $step8_import_correction;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}
						}
					break;
		case "step12_import":
			
						$step_id = $this->input->post('step_id_12');
						
						$step12_import_correction = $this->input->post('step12_import_correction');
						
						$step12_import_status = $this->input->post('step12_import_status');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step12_import_status;
						$dataStep1['corrections'] = $step12_import_correction;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking/2/'.$book_id));
							}
						}
					break;
			default:
				echo "Your favorite color is neither red, blue, nor green!";
		}
	}
	
	
	function sendTrackingMail($to,$docs,$trans,$book_id,$currenytstep)
    {
		$stpData = $this->seller_model->getSPSteps($trans);
		$subject = "Tracking Status of Your Consignment Id : #".$book_id;
		$message = "<table style='border:1px solid;'>";
		$message .= "<tr><th style='border: 1px solid;padding: 6px;'>Date</th><th style='border: 1px solid;padding: 6px;'>Process</th><th style='border: 1px solid;padding: 6px;'>Correction/Detail</th><th style='border: 1px solid;padding: 6px;'>Status</th></tr>";
		foreach($stpData as $stData){
			$shData = $this->seller_model->getShipmentProcessDataByStepId($book_id,$stData->id);
			if(!empty($shData) && $shData->step_id == $stData->id){
				$status = "Upload Pending";
				if(!empty($shData)){
					if(!empty($shData->status ==1)){ 
						$status = "Approved";
					 }else if(!empty($shData->status ==2)){ 
						$status = "Uploaded";
					 }else if(!empty($shData->status ==3)){ 
						$status = "Reupload";
					 }else{
						 $status = "Upload Pending";
					 } 
				 }
				 if($currenytstep == $shData->step_id){
					 $rwgt = 'font-weight:700;color:#4784c5';
				 }else{
					 $rwgt = 'color: green;';
				 }
				$message .= "<tr style='".$rwgt."'>
							<td style='border: 1px solid;padding: 6px;text-align: center;'><i>".date('d-M-Y',strtotime($shData->action_date))." at ".date('h:i:s a',strtotime($shData->time))."</i></td>
							<td style='border: 1px solid;padding: 6px;text-align: center;'>".$shData->step_name."</td>
							<td style='border: 1px solid;padding: 6px;text-align: center;'>".$shData->corrections."</td>
							<td style='border: 1px solid;padding: 6px;text-align: center;'>".$status."</td>
						</tr>";
			}else{
				$message .= "<tr>
							<td style='border: 1px solid;padding: 6px;text-align: center;'></td>
							<td style='border: 1px solid;padding: 6px;text-align: center;'>".$stData->step_name."</td>
							<td style='border: 1px solid;padding: 6px;text-align: center;'></td>
						</tr>";
			}
		}
		
		$message.="</table>";
					
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'info.24thmile@gmail.com';
		$config['smtp_pass']    = 'info@24th';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html';

		$this->email->initialize($config);
		
        $this->email->from('info.24thmile@gmail.com', '24thMile');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
		if(!empty($docs)){
			foreach($docs as $attachpath){
				$this->email->attach($attachpath);
			}
		}
        $this->email->send();
		return true;
    }
	
	function sendSMS($to,$message)
    {
        $smsGatewayUrl = "http://www.eazy2sms.in/SMS.aspx?Mobile=".$to."&Message=".urlencode($message)."&Type=1&Userid=Temgire&Password=Temgire2019";
		
		$url = $smsGatewayUrl;
	   
		$output = file_get_contents($url);
       
    }
}
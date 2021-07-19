<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Freightforwarder extends CI_Controller {

    public $seller_session_data;
	public function __construct()
	{
		parent::__construct();
		
		if(empty($this->session->userdata("seller_logged_in")))
        {
			redirect(base_url('signin'));
        }else{
            $this->seller_session_data = $this->session->userdata('seller_logged_in');
            if($this->seller_session_data['role']!=='3'){
               
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
		$this->load->helper('cookie');
                $this->load->library(array('session', 'form_validation', 'email'));
		
	}
	
	public function dashboard()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
		if($_POST){
			$this->session->set_userdata('activeTab','profile');
			$user_id = $this->input->post('user_id');
			
			$profileData = $this->seller_model->getSellerProfile($user_id);
			
			$headData = $this->seller_model->getHeadProfile($user_id);
				
			$userdata = array(
			  'salutation' => $this->input->post('salutation'),
			  'firstname' => $this->input->post('firstname'),
			  'lastname' => $this->input->post('lastname'),
			  'email' => $this->input->post('email'),
			  'country_code' => $this->input->post('country_code'),
			  'phone' => $this->input->post('phone'),
			  'company_name' => $this->input->post('company_name')
		     );
			 
			 if(!empty($_FILES['profile_pic']['name'])) {
				 
				$config['upload_path'] = 'uploads/users/'; 
				$config['file_name'] = $_FILES['profile_pic']['name'];
				$config['overwrite'] = TRUE;
				$config["allowed_types"] = 'jpg|jpeg|png|gif';
				
				$this->load->library('upload',$config);
				
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('profile_pic')){					
					$uploadData = $this->upload->data();
					$profile_pic = base_url('uploads/users/'.$uploadData['file_name']);					
				}else{					
					$profile_pic = '';
				}				
				$userprofile['profile_pic'] = $profile_pic;
			}
			 
			 $userprofile['designation_id'] = $this->input->post('designation');
			 $userprofile['address'] = $this->input->post('address');
			 $userprofile['country'] = $this->input->post('country');
			 $userprofile['state'] = $this->input->post('state');
			 $userprofile['city'] = $this->input->post('city');
			 $userprofile['pincode'] = $this->input->post('pincode');
			 $userprofile['gender'] = $this->input->post('gender');
			 $userprofile['user_type'] = 2;
			   
			 if($this->seller_model->updateUser($userdata,$user_id)){
				
				 if(empty($profileData)){
					 
					 $userprofile['user_id'] = $user_id;
					 $this->seller_model->insertUserInfo($userprofile);
					 $this->session->set_flashdata('success','Profile updated successfully');
					 redirect(base_url('freight-forwarder-profile'));
					 
				 }else{
					
					$this->seller_model->updateUserInfo($userprofile,$user_id);
					$this->session->set_flashdata('success','Profile updated successfully');
					redirect(base_url('freight-forwarder-profile'));
				 }
			 }   
		}
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$data['report_data'] = $this->reports_model->getMyBookedReportsList($book_id='',$seller_session_data['id']);
		$data['report_val'] = $this->reports_model->getValuesBookedShipments($fromdate="",$todate="",$seller_session_data['id']);
		$data['page'] = 'frontend/freightforwarder/dashboard';
		$this->load->view('frontend/layout_main', $data);
	}
	
	public function profile()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['leftmenuActive']="my-profile";
		if($_POST){
//                    echo "<pre>";
//                print_r($_POST);
//                print_r($_FILES);
//		echo "</pre>";die;
			$this->session->set_userdata('profileActiveTab','profile');
			
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
					$uploadData = $this->upload->data();
                                        unlink($config['upload_path'].$this->input->post('old_profile_pic'));
					$profile_pic = $uploadData['file_name'];					
				}else{					
					$profile_pic = '';
				}				
				$userprofile['profile_pic'] = $profile_pic;
			}
			 
			 $userprofile['designation_id'] = $this->input->post('designation_id');
//			 $userprofile['address'] = $this->input->post('address');
//			 $userprofile['gender'] = $this->input->post('gender');
			 $userprofile['user_type'] = 3;
//			   print_r($userprofile);die;
			 if($this->seller_model->updateUser($userdata,$user_id)){
				
				 if(empty($profileData)){
					 
					 $userprofile['user_id'] = $user_id;
					 $this->seller_model->insertUserInfo($userprofile);
					 $this->session->set_flashdata('success','Profile updated successfully');
                                         
					 redirect(base_url('ff-my-profile'));
					 
				 }else{
					
					$this->seller_model->updateUserInfo($userprofile,$user_id);
					$this->session->set_flashdata('success','Profile updated successfully');
                                        
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
                                 redirect(base_url('ff-company-profile'));
                         } else{
                             $this->session->set_flashdata('error','Something went wrong.');
                                 redirect(base_url('ff-company-profile'));
                         }  
		}
		$kycDocuments[] = ["type"=>"5","documnetName"=>"GST/Tax No","is_mandatory"=>true,"details"=>array()];
		$kycDocuments[] = ["type"=>"1","documnetName"=>"PAN / Income Tax","is_mandatory"=>true,"details"=>array()];
		$kycDocuments[] = ["type"=>"2","documnetName"=>"COI/Proprietorship/LLP","is_mandatory"=>false,"details"=>array()];
		$kycDocuments[] = ["type"=>"4","documnetName"=>"Import Export Code","is_mandatory"=>false,"details"=>array()];
		$kycDocuments[] = ["type"=>"10","documnetName"=>"IATA","is_mandatory"=>false,"details"=>array()];
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
		$data['page'] = 'frontend/freightforwarder/company-profile';
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
				redirect(base_url('freight-forwarder-profile'));
				
			}else{
				
				$this->seller_model->updateUserHead($headprofile,$user_id);
				$this->session->set_flashdata('success','Head info updated successfully');
				redirect(base_url('freight-forwarder-profile'));
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
			redirect(base_url('ff-company-profile'));

			  
		}
	}
	
	public function change_password()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
		if($_POST){
			//$this->session->set_userdata('profileActiveTab','setting');
			
			$user_id = $seller_session_data['id'];
			
			$profileData = $this->seller_model->getSellerProfile($user_id);
				
			$userdata = array(
			  'password' => sha1($this->input->post('confirm_password'))
		     );
			 
			 if($this->seller_model->updateUser($userdata,$user_id)){
				
				$this->session->set_flashdata('success','Password updated successfully');
				redirect(base_url('ff-my-profile'));
				 
			 }   
		}
		
	}
	
	public function my_quotes()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
		if($_POST){
			
			$user_id = $this->input->post('user_id');
			
			$profileData = $this->seller_model->getSellerProfile($user_id);
				
			$userdata = array(
			  'firstname' => $this->input->post('firstname'),
			  'lastname' => $this->input->post('lastname'),
			  'email' => $this->input->post('email'),
			  'phone' => $this->input->post('phone'),
			  'company_name' => $this->input->post('company_name')
		     );
			 
			 if(!empty($_FILES['profile_pic']['name'])) {
				 
				$config['upload_path'] = 'uploads/users/'; 
				$config['file_name'] = $_FILES['profile_pic']['name'];
				$config['overwrite'] = TRUE;
				$config["allowed_types"] = 'jpg|jpeg|png|gif';
				
				$this->load->library('upload',$config);
				
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('profile_pic')){					
					$uploadData = $this->upload->data();
					$profile_pic = base_url('uploads/users/'.$uploadData['file_name']);					
				}else{					
					$profile_pic = '';
				}				
				$userprofile['profile_pic'] = $profile_pic;
			}
			 
			 $userprofile['address'] = $this->input->post('address');
			 $userprofile['gender'] = $this->input->post('gender');
			 $userprofile['user_type'] = 2;
			   
			 if($this->seller_model->updateUser($userdata,$user_id)){
				 
				 if(empty($profileData)){
					 
					 $userprofile['user_id'] = $user_id;
					 $this->seller_model->insertUserInfo($userprofile);
					 $this->session->set_flashdata('success','Profile updated successfully');
					 redirect(base_url('freight-forwarder-profile'));
					 
				 }else{
					
					$this->seller_model->updateUserInfo($userprofile);
					$this->session->set_flashdata('success','Profile updated successfully');
					redirect(base_url('freight-forwarder-profile'));
				 }
			 }   
		}
		
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		//echo '<pre>'; print_r($data['myProfile']);
		$data['FreightEnquiry'] = $this->seller_model->getFreightEnquiryByCity($data['myProfile']->pincode,$data['myProfile']->city);
		//echo '<pre>'; print_r($data['FreightEnquiry']);die;
		$data['page'] = 'frontend/freightforwarder/my_quotes';
		$this->load->view('frontend/layout_main', $data);
	}
	
	public function send_quotes()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
		if($_POST){
			
			$user_id = $seller_session_data['id'];
			
			$profileData = $this->seller_model->getSellerProfile($user_id);
			
			$num_cont = $this->input->post('num_cont');
			$amount = $this->input->post('amount');
			$freight_enquiry_id = $this->input->post('freight_enquiry_id');
			$totalqts = 0;
			
			foreach($num_cont as $ref_cat_id=>$r_num_count){
				
				foreach($r_num_count as $partcl_id=>$rm_num_count){
					
					foreach($rm_num_count as $cont_id=>$rmv_val){
						
						$totalqts = $totalqts + ($rmv_val * $amount[$ref_cat_id][$partcl_id][$cont_id]);
						
						$postdata = array(
						  'quote_sender_id' => $user_id,
						  'freight_enquiry_id' => $freight_enquiry_id,
						  'rfc_category_id' => $ref_cat_id,
						  'particular_id' => $partcl_id,
						  'container_id' => $cont_id,
						  'no_of_container' => $rmv_val,
						  'amount' => $amount[$ref_cat_id][$partcl_id][$cont_id],
						  'total_amount' => ($rmv_val * $amount[$ref_cat_id][$partcl_id][$cont_id]),
						  'total_quotes' => $totalqts,
						  'reply_date' => date('Y-m-d')
						 );
						 
						 $this->seller_model->insertQuatation($postdata);
					}
				}
			}
			
			 
			 $this->session->set_flashdata('success','Profile updated successfully');
			 redirect(base_url('freightforwarder/my_quotes'));
					 
				
			 
		}
		
		$country_name = $this->seller_model->getCountries();
	
		$new_country_name = array();  
		foreach($country_name as $cntry_name){
			$cntName = trim($cntry_name->country_name);
			array_push($new_country_name,$cntName);
		}
		$new_country_name = array_unique($new_country_name);
		$CName = implode('", "',$new_country_name);
		$data['CName'] = $CName;
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		$tempData = $this->seller_model->getTemplateData($data['myProfile']->sector_id);
		$newTemData = array();
		foreach($tempData as $temData){
			//echo '<pre>'; print_r($temData);die;
			$newTemData[$temData->template_id][$temData->rfc_category_name.'-'.$temData->rfc_category_id][$temData->particular.'-'.$temData->particular_id][$temData->container_id] = $temData;
		}
		$data['tempData'] = $newTemData;
		
		$data['page'] = 'frontend/freightforwarder/send_quotes';
		$this->load->view('frontend/layout_main', $data);
	}
	
	public function view_counter_offers()
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
		$data['page'] = 'frontend/freightforwarder/view_counter_offers';
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
						
						$totalqts = $totalqts + ($rmv_val*$amount[$ref_cat_id][$partcl_id][$cont_id]);
						
						$postdata = array(
						  'sender_user_id' => $user_id,
						  'receiver_user_id' => $ff_id,
						  'freight_enquiry_id' => $freight_enquiry_id,
						  'rfc_category_id' => $ref_cat_id,
						  'particular_id' => $partcl_id,
						  'container_id' => $cont_id,
						  'no_of_container' => $rmv_val,
						  'amount' => $amount[$ref_cat_id][$partcl_id][$cont_id],
						  'total_amount' => ($rmv_val*$amount[$ref_cat_id][$partcl_id][$cont_id]),
						  'total_quotes' => $totalqts,
						  'reply_date' => date('Y-m-d')
						 );
						 
						 $this->seller_model->insertCounterQuatation($postdata);
					}
				}
			}
			 
			 $this->session->set_flashdata('success','Profile updated successfully');
			 redirect(base_url('freightforwarder/my_quotes'));
					 
				
			 
		}
	}
	
        public function request_list(){
            
            $data['shippig_requirment_list'] = $this->freight_model->getRequirmentList($this->seller_session_data['id']);
           
            $data['page'] = 'frontend/freightforwarder/request_list';

            $data['sidebar'] = 'frontend/components/sidebar_dashboard';
            $this->load->view('frontend/layout_main', $data);
        }
        
        public function edit_request_details($request_id)
	{
         
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
                 //get request details
                if($this->input->post('request_id')){
                    $request_id = $this->input->post('request_id');
                }

                $requestDetails = $this->freight_model->getRequirmentDetails($request_id,$this->seller_session_data['id']);
//                $this->load->helper('vayes_helper');
               
                if(in_array($requestDetails->quote_submit_status, ['1'])){
                    $this->session->set_flashdata('error','Details not found.');
                    redirect(base_url('ff-request-list'));
                }
                
                if($this->input->post()){
//                     vdebug($_POST);
                    $submit = $this->input->post('submit');
                    foreach ($this->input->post('items') as $item){
                        $itemRateDetails = $this->freight_model->checkItemRateExist($request_id,$item['item_id'],$this->seller_session_data['id']);
                        if(!empty($itemRateDetails)){
                        //update
                            $insertData=[
                                    'rate'=>$item['rate'],
                                    'updated_at'=>date('Y-m-d H:i:s')
                                 ];
                            $this->freight_model->updateItemRate($itemRateDetails->id,$insertData);
                        }else{
                            //insert
                            $insertData=[
                                    'ff_id'=>$this->seller_session_data['id'],
                                    'request_id'=>$request_id,
                                    'request_item_id'=>$item['item_id'],
                                    'rate'=>$item['rate']
                                 ];
                            $this->freight_model->insertItemRate($insertData);
                        }
                    }
                    
                    foreach ($this->input->post('rfc_charges') as $rfc){
                        
                        $rfcChargesDetails = $this->freight_model->checkRfcChargeExist($request_id,$this->seller_session_data['id'],$rfc['rfc_id']);
                        if(!empty($rfcChargesDetails)){
                            //update
                            $insertData=[
                                    'charges'=>$rfc['rfc_charge']
                                 ];
                            $this->freight_model->updateRfcCharges($rfcChargesDetails->id,$insertData);
                        }else{
                            //insert
                            $insertData=[
                                    'ff_id'=>$this->seller_session_data['id'],
                                    'request_id'=>$request_id,
                                    'rfc_charges_id'=>$rfc['rfc_id'],
                                    'charges'=>$rfc['rfc_charge']
                                 ];
                            $this->freight_model->insertRfcCharges($insertData);
                        }
                    }
                    
                    if($submit=='Save and send'){
                        //send quote
                        $this->freight_model->updateQuoteStatus($request_id,$this->seller_session_data['id'],['quote_submit_status'=>'1','quote_submit_dt'=>date('Y-m-d H:i:s')]);
                        $this->session->set_flashdata('success','Quote sent successfully.');
                        //redirect(base_url('ff-request-list'));
                    }else{
                        $this->session->set_flashdata('success','Rate updated successfully.');
                    }
                    
                    //update total quote Amount
                    $this->freight_model->updateTotalQuoteAmount($request_id,$this->seller_session_data['id']);
                    
                    redirect(base_url('ff-request-list'));
                    
                }
                
		$data['requestDetails'] = $requestDetails;
		//$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		//$data['compData'] = $this->seller_model->getCompanyData();
		$data['delivery_terms'] = $this->deliver_term_model->getList();
		$data['doc_verified'] = $this->seller_model->documentVerified($seller_session_data['id']);
		$data['modes'] = $this->mode_model->getList();
		$data['pol'] = $this->port_model->getPOLList();
		$data['pod'] = $this->port_model->getPODList();
		//$data['companys'] = $this->company_model->getList();
		$data['shipments'] = $this->shipment_model->getList(true);
		//$data['contracts'] = $this->contract_model->getList(true);

               
		$data['container_types'] = $this->container_model->getList();
		$data['rfc_charges'] = $this->freight_model->getRfcCharges($requestDetails->delivery_term_id,$request_id,$this->seller_session_data['id']);
		
		$data['page'] = 'frontend/freightforwarder/edit_request_details';
                $data['sidebar'] = 'frontend/components/sidebar_dashboard';
                 
		$this->load->view('frontend/layout_main', $data);
	}
	
          public function view_request_details($request_id)
	{
         
		$seller_session_data = $this->session->userdata('seller_logged_in');
		
                

                $requestDetails = $this->freight_model->getRequirmentDetails($request_id,$this->seller_session_data['id']);
                
                
                
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

               
		$data['rfc_charges'] = $this->freight_model->getRfcCharges($requestDetails->delivery_term_id,$request_id,$this->seller_session_data['id']);
		$data['container_types'] = $this->container_model->getList();
		$data['page'] = 'frontend/freightforwarder/view_request_details';
                $data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$this->load->view('frontend/layout_main', $data);
	}
        
	public function shipment_list()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);

		$bookedShipment = $this->seller_model->getBookedShipmentListofFF($seller_session_data['id']);
		
		$data['bookedShipment'] = $bookedShipment;
		$data['page'] = 'frontend/freightforwarder/shipment_list';
		$this->load->view('frontend/layout_main', $data);
	}
	
	public function shipment_tracking()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		
		$transctn = $this->uri->segment(2);
		$bookid = $this->uri->segment(3);
		$confirmShipment = $this->seller_model->getBookedShipmentByFFId($seller_session_data['id'],$transctn,$bookid);
		
		$steps = $this->seller_model->getSPSteps($transctn);
		
		$shipmentProcessData = $this->seller_model->getShipmentProcessData($transctn,$bookid);


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
 		$data['currentStep'] = $currentStep;
 		$data['completedStep'] = $completedStepID;
 		// For step show End
		
		// push current step in complete step to active ul>li
		array_push($completedStepID,$currentStep->step_id);	
		$data['bookedShipment'] = $confirmShipment;
		$data['stepData'] = $steps;
		$data['shipmentProcessData'] = $shipmentProcessData;
		if($transctn == 1){
			$data['page'] = 'frontend/freightforwarder/shipment_tracking';
		}else{
			$data['page'] = 'frontend/freightforwarder/shipment_tracking_import';
		}
		
		$this->load->view('frontend/layout_main', $data);
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
				  'ff_id' => $user_id,
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
	
	public function upload_process_documents(){
		
		
		$rfc_id = $this->input->post('rfc_id');
		$book_id = $this->input->post('book_id');
		$ff_email = $this->input->post('ff_email');
		$buyer_email = $this->input->post('buyer_email');
		$seller_email = $this->input->post('seller_email');
		
		$step = array_search("Save",$this->input->post());
		
		
		
		switch ($step) {
			
			case "step1_export":
			
						$step_id = $this->input->post('step_id');
						$step1_export_correction_ff = $this->input->post('step1_export_correction_ff');
						
						$step1_export_status = $this->input->post('step1_export_status');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step1_export_status;
						$dataStep1['corrections'] = $step1_export_correction_ff;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
						}
						break;
			case "step2_export":
			
						//echo '<pre>'; print_r($_FILES);
						//echo '<pre>'; print_r($this->input->post());die;
						$step_id = $this->input->post('step_id_2');
						$step2_export_SB_number = $this->input->post('step2_export_SB_number');
						$step2_export_SB_date = $this->input->post('step2_export_SB_date');
						
						if(!empty($_FILES['sb_checklist_ff']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step2_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['sb_checklist_ff']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('sb_checklist_ff')){					
								$uploadData = $this->upload->data();
								$sb_checklist_ff = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$sb_checklist_ff = '';
							}
							
							$documents['Shipping_bill_checklist'] = $sb_checklist_ff;
						}
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['documents'] = json_encode($documents);
						$dataStep1['action_date'] = date('Y-m-d');
						$dataStep1['time'] = date('h:i:s');
						
						$bkdata['shipping_bill_number'] = $step2_export_SB_number;
						$bkdata['shipping_bill_date'] = date('Y-m-d',strtotime($step2_export_SB_date));
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata->status == 2){
							
							$dataStep1['status'] = 3;
						
						}else if($stepdata->status == 1){
							
							$dataStep1['status'] = 1;
						
						}else{
							
							$dataStep1['status'] = 2;
						}
						
						$this->seller_model->updateBookShipment($bkdata,$book_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email);
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
								
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email);
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
						}
				break;
		case "step3_export":
			
						$step_id = $this->input->post('step_id_3');
						
						$step3_export_act_date = $this->input->post('step3_export_act_date');
						$actndate = explode(' ',$step3_export_act_date);
						$step3_export_status = $this->input->post('step3_export_status');
						$step3_export_details = $this->input->post('step3_export_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step3_export_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step3_export_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
						}
				break;
			case "step4_export":
			
						$step_id = $this->input->post('step_id_4');
						
						$step4_export_act_date = $this->input->post('step4_export_act_date');
						$actndate = explode(' ',$step4_export_act_date);
						$step4_export_status = $this->input->post('step4_export_status');
						$step4_export_details = $this->input->post('step4_export_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step4_export_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step4_export_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
						}
				break;
		case "step5_export":
			
						$step_id = $this->input->post('step_id_5');
						
						$step5_export_bol_number = $this->input->post('step5_export_bol_number');
						$step5_export_bol_date = $this->input->post('step5_export_bol_date');
						
						if(!empty($_FILES['Bill_of_lading']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step5_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['Bill_of_lading']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('Bill_of_lading')){					
								$uploadData = $this->upload->data();
								$Bill_of_lading = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$Bill_of_lading = '';
							}
							
							$documents['Bill_of_lading'] = $Bill_of_lading;
						}
						
						if(!empty($_FILES['Final_Bill_of_lading']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step5_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['Final_Bill_of_lading']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('Final_Bill_of_lading')){					
								$uploadData = $this->upload->data();
								$Final_Bill_of_lading = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$Final_Bill_of_lading = '';
							}
							
							$documents['Final_Bill_of_lading'] = $Final_Bill_of_lading;
						}
						
						$dataStep1['status'] = 2;
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['documents'] = json_encode($documents);
						$dataStep1['action_date'] = date('Y-m-d');
						$dataStep1['time'] = date('h:i:s');
						
						$bkdata['bill_of_lading_number'] = $step5_export_bol_number;
						$bkdata['bill_of_lading_date'] = date('Y-m-d',strtotime($step5_export_bol_date));
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						$this->seller_model->updateBookShipment($bkdata,$book_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email);
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email);
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
						}
						
				break;
		case "step6_export":
			
						$step_id = $this->input->post('step_id_6');
						
						$step6_export_etd_date = $this->input->post('step6_export_etd_date');
						$step6_export_eta_date = $this->input->post('step6_export_eta_date');
						$step6_export_lov_date = $this->input->post('step6_export_lov_date');
						$actndate = explode(' ',$step6_export_lov_date);
						$step6_export_status = $this->input->post('step6_export_status');
						$step6_export_details = $this->input->post('step6_export_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step6_export_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step6_export_details;
						
						$bkdata['ETD'] = date('Y-m-d h:i:s',strtotime($step6_export_etd_date));
						$bkdata['ETA'] = date('Y-m-d h:i:s',strtotime($step6_export_eta_date));
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						$this->seller_model->updateBookShipment($bkdata,$book_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
						}
				break;
		case "step8_export":
			
						$step_id = $this->input->post('step_id_8');
						
						$step8_export_rdp_date = $this->input->post('step8_export_rdp_date');
						$actndate = explode(' ',$step8_export_rdp_date);
						$step8_export_status = $this->input->post('step8_export_status');
						$step8_export_details = $this->input->post('step8_export_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step8_export_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step8_export_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
						}
				break;
		case "step9_export":
			
						$step_id = $this->input->post('step_id_9');
						
						$step9_export_ccd_date = $this->input->post('step9_export_ccd_date');
						$actndate = explode(' ',$step9_export_ccd_date);
						$step9_export_status = $this->input->post('step9_export_status');
						$step9_export_details = $this->input->post('step9_export_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step9_export_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step9_export_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
						}
				break;
		case "step10_export":
			
						$step_id = $this->input->post('step_id_10');
						
						$step10_export_delivery_date = $this->input->post('step10_export_delivery_date');
						
						$actndate = explode(' ',$step10_export_delivery_date);
						
						if(!empty($_FILES['invoice_confirm']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step12_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['invoice_confirm']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('invoice_confirm')){					
								$uploadData = $this->upload->data();
								$invoice_confirm = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$invoice_confirm = '';
							}
							
							$documents['invoice_confirm'] = $invoice_confirm;
						}
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['documents'] = json_encode($documents);
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						$dataStep1['status'] = 2;
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
						}
						
				break;
		case "step11_export":
			
						$step_id = $this->input->post('step_id_11');
						
						$step11_export_erbc_date = $this->input->post('step11_export_erbc_date');
						$actndate = explode(' ',$step11_export_erbc_date);
						$step11_export_invoice_amount = $this->input->post('step11_export_invoice_amount');
						
						$step11_export_dbk_amount = $this->input->post('step11_export_dbk_amount');
						$step11_export_meis_rate = $this->input->post('step11_export_meis_rate');
						$step11_export_meis_amount = $this->input->post('step11_export_meis_amount');
						$step11_export_bill_amount = $this->input->post('step11_export_bill_amount');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = 2;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = '';
						
						
						$bkdata['Invoice_amount'] = $step11_export_invoice_amount;
						$bkdata['DBK_amount'] = $step11_export_dbk_amount;
						$bkdata['MEIS_rate'] = $step11_export_meis_rate;
						$bkdata['MEIS_amount'] = $step11_export_meis_amount;
						$bkdata['Bill_amount'] = $step11_export_bill_amount;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						$this->seller_model->updateBookShipment($bkdata,$book_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								
								//$to = array($seller_email,$ff_email,$buyer_email);
								//$documents = array(); 
								//$this->sendTrackingMail($to,$documents,1,$book_id,$step_id);
								
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/1/'.$book_id));
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
						$step1_import_correction_ff = $this->input->post('step1_import_correction_ff');
						
						$step1_import_status = $this->input->post('step1_import_status');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step1_import_status;
						$dataStep1['corrections'] = $step1_import_correction_ff;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
						break;
			case "step2_import":
			
						$step_id = $this->input->post('step_id_2');
						
						if(!empty($_FILES['sb_checklist_ff']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step2_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['sb_checklist_ff']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('sb_checklist_ff')){					
								$uploadData = $this->upload->data();
								$sb_checklist_ff = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$sb_checklist_ff = '';
							}
							
							$documents['Shipping_bill_checklist'] = $sb_checklist_ff;
						}
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['documents'] = json_encode($documents);
						$dataStep1['action_date'] = date('Y-m-d');
						$dataStep1['time'] = date('h:i:s');
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata->status == 2){
							
							$dataStep1['status'] = 3;
						
						}else if($stepdata->status == 1){
							
							$dataStep1['status'] = 1;
						
						}else{
							
							$dataStep1['status'] = 2;
						}
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
				break;
		case "step3_import":
			
						$step_id = $this->input->post('step_id_3');
						
						$step3_import_act_date = $this->input->post('step3_import_act_date');
						$actndate = explode(' ',$step3_import_act_date);
						$step3_import_status = $this->input->post('step3_import_status');
						$step3_import_details = $this->input->post('step3_import_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step3_import_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step3_import_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
				break;
			case "step4_import":
			
						$step_id = $this->input->post('step_id_4');
						
						$step4_import_act_date = $this->input->post('step4_import_act_date');
						$actndate = explode(' ',$step4_import_act_date);
						$step4_import_status = $this->input->post('step4_import_status');
						$step4_import_details = $this->input->post('step4_import_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step4_import_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step4_import_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
				break;
		case "step5_import":
			
						$step_id = $this->input->post('step_id_5');
						
						if(!empty($_FILES['Bill_of_lading']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step5_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['Bill_of_lading']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('Bill_of_lading')){					
								$uploadData = $this->upload->data();
								$Bill_of_lading = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$Bill_of_lading = '';
							}
							
							$documents['Bill_of_lading'] = $Bill_of_lading;
						}
						$dataStep1['status'] = 2;
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['documents'] = json_encode($documents);
						$dataStep1['action_date'] = date('Y-m-d');
						$dataStep1['time'] = date('h:i:s');
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
						
				break;
		case "step6_import":
			
						$step_id = $this->input->post('step_id_6');
						
						$step6_import_etd_date = $this->input->post('step6_import_etd_date');
						$actndate = explode(' ',$step6_import_etd_date);
						$step6_import_status = $this->input->post('step6_import_status');
						$step6_import_details = $this->input->post('step6_import_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step6_import_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step6_import_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
				break;
			case "step7_import":
			
						$step_id = $this->input->post('step_id_7');
						
						$step7_import_lov_date = $this->input->post('step7_import_lov_date');
						$actndate = explode(' ',$step7_import_lov_date);
						$step7_import_status = $this->input->post('step7_import_status');
						$step7_import_details = $this->input->post('step7_import_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step7_import_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step7_import_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
				break;
		case "step8_import":
			
						$step_id = $this->input->post('step_id_8');
						
						if(!empty($_FILES['load_confirm']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step8_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['load_confirm']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('load_confirm')){					
								$uploadData = $this->upload->data();
								$load_confirm = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$load_confirm = '';
							}
							
							$documents['Load_confirm'] = $load_confirm;
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
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
						
				break;
		case "step9_import":
			
						$step_id = $this->input->post('step_id_9');
						
						$step9_import_eta_date = $this->input->post('step9_import_eta_date');
						$actndate = explode(' ',$step9_import_eta_date);
						$step9_import_status = $this->input->post('step9_import_status');
						$step9_import_details = $this->input->post('step9_import_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step9_import_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step9_import_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
				break;
		case "step10_import":
			
						$step_id = $this->input->post('step_id_10');
						
						$step10_import_rdp_date = $this->input->post('step10_import_rdp_date');
						$actndate = explode(' ',$step10_import_rdp_date);
						$step10_import_status = $this->input->post('step10_import_status');
						$step10_import_details = $this->input->post('step10_import_details');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step10_import_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step10_import_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
				break;
		case "step11_import":
			
						$step_id = $this->input->post('step_id_11');
						
						$step11_import_ccd_date = $this->input->post('step11_import_ccd_date');
						$actndate = explode(' ',$step11_import_ccd_date);
						$step11_import_details = $this->input->post('step11_import_details');
						$step11_import_status = $this->input->post('step11_import_status');
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['status'] = $step11_import_status;
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						$dataStep1['corrections'] = $step11_import_details;
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Updated successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
				break;
		case "step12_import":
			
						$step_id = $this->input->post('step_id_12');
						
						$step12_date = $this->input->post('step12_date');
						
						$actndate = explode(' ',$step12_date);
						
						if(!empty($_FILES['invoice_confirm']['name'])){
			
							$uploadfilepath = 'uploads/rfc-'.$this->input->post('rfc_id').'/step12_document/';
							
							if (!file_exists($uploadfilepath)) {
								mkdir($uploadfilepath, 0777, true);
							}
							
							$config['upload_path'] = $uploadfilepath; 
							$config['file_name'] = $_FILES['invoice_confirm']['name'];
							$config['overwrite'] = TRUE;
							$config["allowed_types"] = 'jpg|jpeg|png|gif|pdf|doc';
							
							$this->load->library('upload',$config);
							
							$this->upload->initialize($config);
							
							if($this->upload->do_upload('invoice_confirm')){					
								$uploadData = $this->upload->data();
								$invoice_confirm = base_url($uploadfilepath.$uploadData['file_name']);					
							}else{					
								$invoice_confirm = '';
							}
							
							$documents['invoice_confirm'] = $invoice_confirm;
						}
						
						$dataStep1['book_id'] = $book_id;
						$dataStep1['step_id'] = $step_id;
						$dataStep1['documents'] = json_encode($documents);
						$dataStep1['action_date'] = date('Y-m-d',strtotime($actndate[0]));
						$dataStep1['time'] = date('h:i:s',strtotime($actndate[1]));
						
						
						$stepdata = $this->seller_model->getShipmentProcessDataByStepId($book_id,$step_id);
						
						$dataStep1['status'] = 2;
						
						if($stepdata){
							
							if($this->seller_model->updateStepProcessData($dataStep1,$book_id,$step_id)){
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
							
						}else{
							
							$insert_id = $this->seller_model->insertStepProcessData($dataStep1);
							
							if($insert_id){
								$this->session->set_flashdata('success','Uploaded successfully');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}else{
								$this->session->set_flashdata('error','Something went wrong');
								redirect(base_url('shipment-tracking-ff/2/'.$book_id));
							}
						}
						
				break;
			default:
				echo "Your favorite color is neither red, blue, nor green!";
		}
	}
	
	function sendTrackingMail($to,$docs,$trans,$book_id,$currenytstep)
    {
		//echo $currenytstep;die;
		$stpData = $this->seller_model->getSPSteps($trans);
		$subject = "Tracking Status of Your Consignment Id : #".$book_id;
		$message = "<table style='border:1px solid;'>";
		$message .= "<tr><th style='border: 1px solid;padding: 6px;'>Date</th><th style='border: 1px solid;padding: 6px;'>Process</th><th style='border: 1px solid;padding: 6px;'>Correction/Detail</th><th style='border: 1px solid;padding: 6px;'>Status</th></tr>";
		foreach($stpData as $stData){
			$shData = $this->seller_model->getShipmentProcessDataByStepId($book_id,$stData->id);
			if(!empty($shData) && $shData->step_id == $stData->id){
				$status = "Pending";
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
							<td style='border: 1px solid;padding: 6px;text-align: center;color:#d23434;'></td>
							<td style='border: 1px solid;padding: 6px;text-align: center;color:#d23434;'>".$stData->step_name."</td>
							<td style='border: 1px solid;padding: 6px;text-align: center;color:#d23434;'></td>
							<td style='border: 1px solid;padding: 6px;text-align: center;color:#d23434;'>Pending</td>
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
	
	/*public function getAjaxState(){
		$cntId = $this->input->post('countryN');
		$statedata = $this->seller_model->getStateByCountry(trim($cntId));
		echo json_encode($statedata);
	}
	
	public function getAjaxCity(){
		$state = $this->input->post('state');
		$Citydata = $this->seller_model->getCityByState(trim($state));
		echo json_encode($Citydata);
	}*/


		public function view_shipment_tracking()
	{
		$seller_session_data = $this->session->userdata('seller_logged_in');
		$data['myProfile'] = $this->seller_model->getSellerInfo($seller_session_data['id']);
		
		$data['page'] = 'frontend/freightforwarder/view_shipment_tracking';
		$this->load->view('frontend/layout_main', $data);
	}

}



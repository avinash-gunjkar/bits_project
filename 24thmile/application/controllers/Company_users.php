<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_users extends CI_Controller {

        public $seller_session_data;
	public function __construct()
	{
		parent::__construct();
            if(empty($this->session->userdata("seller_logged_in")))
            {
                            redirect(base_url('signin'));
            }
            $this->seller_session_data = $this->session->userdata('seller_logged_in');

            $this->load->model ('company_user_modal', 'C_USER', TRUE); 
            $this->load->model ('seller_model');  
            $this->load->model ('branch_model');  
            $this->load->model ('role_model');  
            $this->load->model ('login_model');  
		
	}
	
	public function index()
	{	$data['leftmenuActive']="company-profile";
        
                $data['leftSubMenuActive']= "company-users";
                $data['user_list'] = $this->C_USER->getList($this->seller_session_data['company_id'],$this->seller_session_data['id']);
		$data['page'] = 'frontend/company-users/index';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
//		echo '<pre>';print_r($data);die;
		$this->load->view('frontend/layout_main', $data);	
		//$this->load->view('backend/layout_main', $data);
	}
 

	public function add($user_id='')
	{	
          $data['leftmenuActive']="company-profile";
        
                $data['leftSubMenuActive']= "company-users";
            //get branch details
            if($this->input->post('user_id')){
                $user_id = $this->input->post('user_id');
            }
            
            $user_details = $this->C_USER->getRecord($user_id,$this->seller_session_data['company_id']);
            $profileData = $this->C_USER->getUserProfile($user_id);
            
            if($_POST){
                    
			
			$useremail = $this->input->post('email');
			
                        if(empty($user_id)){
                            $userExist = $this->C_USER->checkEmailAlreadyExist($useremail);
                        }else{
                            $userExist = $this->C_USER->checkEmailAlreadyExist($useremail,$user_id);
                        }
			
			
			if(empty($userExist)){
	
                            //check otp
//                            if(!$this->check_otp($this->input->post('otp'), $this->input->post('phone'))){
//                                $this->session->set_flashdata('error','Invalid otp !!!');
//						redirect(base_url('signup'));
//                            }
                            
                            //create new user                    
                            $userdata = array(
                                   'company_id' => $this->seller_session_data['company_id']?$this->seller_session_data['company_id']:null,
                                   'firstname' => $this->input->post('firstname'),
                                   'lastname' => $this->input->post('lastname'),
                                   'username' => $this->input->post('firstname'),
                                   'country_code' => $this->input->post('country_code'),
                                   'phone' => $this->input->post('phone'),
                                   'role' => $this->seller_session_data['role'],
                                   'supervisor_id' => $this->input->post('supervisor_id'),
                                   'branch_id' => $this->input->post('branch_id'),
                                   'salutation' => $this->input->post('salutation'),
                                   'email' => $this->input->post('email')
                             );
                           if(empty($user_details)){
                               //create
                                $user_id = $this->login_model->insertUser($userdata);
                           }else{
                               //update
                              $updated = $this->seller_model->updateUser($userdata,$user_id);
                           }
			  
			   
			   if($user_id){
			   
                               //create user profile
                               if(!empty($_FILES['profile_pic']['name'])) {
                                    $userprofile['profile_pic'] = $this->uploadProfilePic();
                               }
                               $userprofile['designation_id'] = $this->input->post('designation_id');
                               $userprofile['user_type'] =   $this->seller_session_data['role'];
                              
                                if(empty($profileData)){
					 $userprofile['user_id'] = $user_id;
					 $this->seller_model->insertUserInfo($userprofile);
				 }else{
					$this->seller_model->updateUserInfo($userprofile,$user_id);
				 }
                               
                                 if($updated){
                                     $this->session->set_flashdata('success','User details updated successfully.');
						redirect(base_url('company-users'));
                                 }
                               //delete otp cookie
				//$this->session->unset_userdata('otp_data');	
                                $this->session->set_flashdata('success','User created successfully.');
						redirect(base_url('company-users'));
                                       
                                }else{
                                    $this->session->set_flashdata('error','Something went wrong.');
                                    redirect(base_url('add-company-user'));
                                }
			}
			else
			{
				$this->session->set_flashdata('error','User Already Exist ..!!!');
				redirect(base_url('add-company-user'));
			}
			
		}
            
		
                $data['designtnData'] = $this->seller_model->getDesignationData();       
                $data['roles'] = $this->role_model->getRoles('1, 2, 3');       
                $data['branch_list'] = $this->branch_model->getList($this->seller_session_data['company_id']);       
                $data['supervisor_list'] = $this->C_USER->getSupervisorList($this->seller_session_data['company_id']);       
		$data['page'] = 'frontend/company-users/add';
		$data['sidebar'] = 'frontend/components/sidebar_dashboard';
		$data['user_details'] = $user_details;
		$this->load->view('frontend/layout_main', $data);		
	}

        public function uploadProfilePic(){
            $profile_pic = '';
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
                   
            }
            return $profile_pic;
        }
       
        public function delete_user($user_id){
            $user_details = $this->C_USER->getRecord($user_id,$this->seller_session_data['company_id']);
            if(!empty($user_details)){
                if($this->C_USER->delete($user_id)){
                     $this->session->set_flashdata('success','User deleted successfully.');
                      
                }else{
                    $this->session->set_flashdata('error','Something goes wrong.');
                              
                }
                
            }else{
                $this->session->set_flashdata('error','User details not found.');
                
            }
            
            redirect(base_url('company-users'));
            
        }
}
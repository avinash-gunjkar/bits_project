<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_user extends CI_Controller {

    public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='4';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model ('User_model', 'USER', TRUE);
		$this->load->model ('app_previlages');
		
	}
	
	public function index()
	{	$data['user_list'] = $this->USER->getList(['5']);
		$data['page'] = 'backend/user/index';
		$this->load->view('backend/layout_main', $data);
	}
	
	public function kyc_document()
	{
		$userid = $this->uri->segment(3);
		$data['kyc_document_list'] = $this->USER->getKYCList($userid);
		$data['page'] = 'backend/user/kyc_document';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add($user_id='')
	{	
            
             if($this->input->post('user_id')){
                $user_id = $this->input->post('user_id');
            }
            $user_details = $this->USER->getRecord($role=5,$user_id);
            
		if($this->input->post()){
		
                    if(empty($user_id)){
                            $userExist = $this->USER->checkEmailAlreadyExist($this->input->post('email'));
                        }else{
                            $userExist = $this->USER->checkEmailAlreadyExist($this->input->post('email'),$user_id);
                        }
                    
                       if(!empty($userExist)){
                           $this->session->set_flashdata('error','User Already Exist ..!!!');
                            redirect(base_url('admin/users'));
                       }
                    
                   // vdebug($_POST);
                            
                            $dbOject = [
                                'username'=>$this->input->post('firstname'),
                                'firstname'=>$this->input->post('firstname'),
                                'lastname'=>$this->input->post('lastname'),
                                'email'=>$this->input->post('email'),
                                'phone'=>$this->input->post('phone'),
                                'role'=>$this->input->post('role')
                            ];
                    
                            if(empty($user_details)){
                               //create
                                $password = sha1($this->input->post('password'));
                                $dbOject['isActive'] = '1';
                                $dbOject['password'] = $password;
                                $user_id = $this->USER->insert($dbOject);
                                $this->updateAppPrevilage($this->input->post('app_privilages'),$user_id);
                                $this->session->set_flashdata('success','User created.');
                                redirect(base_url('admin/users'));
                           }else{
                               //update
                              $updated = $this->USER->update($user_id,$dbOject);
                              $this->updateAppPrevilage($this->input->post('app_privilages'),$user_id);
                                $this->session->set_flashdata('success','User details updated.');
                                redirect(base_url('admin/users'));
                           }
                   
		}
		$data['app_previlage_list'] = $this->app_previlages->getAppGrpList($status='1');
		$data['user_details'] = $user_details;
                $data['page_title'] = $user_details?"Edit User":"Add User";
		$data['user_app_previlage_id_list'] = $this->app_previlages->getAppUserAppPrivilageIdList($user_id);
		$data['page'] = 'backend/user/add';
		$this->load->view('backend/layout_main', $data);		
	}

        public function updateAppPrevilage($appList,$user_id){
            foreach ($appList as $app_id){
                if($this->app_previlages->getAppIdExist($app_id,$user_id)){
                    //update
                     $this->app_previlages->updateAppPrivilage($app_id,$user_id);
                }else{
                    //insert
                    $data = [
                        'app_id'=>$app_id,
                        'by_user_id'=>$this->session_user['id'],
                        'to_user_id'=>$user_id,
                        'status'=>'1',
                        'on_date'=>date('Y-m-d H:i:s'),
                    ];
                    $this->app_previlages->insertAppPrivilage($data);
                }
            }
            $this->app_previlages->removeAppPrevilage($appList,$user_id);
        }
        
        
	public function edit($id)
	{ 
		if($this->input->post() && $this->input->is_ajax_request()){
			$user_id = $this->input->post('user_id');
			$user_name = $this->input->post('user_name');
			$user_description = $this->input->post('user_description');
			// $isActive = $this->input->post('isActive');
			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'name' => $user_name,
								'description' => $user_description, 
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->USER->update($user_id,$dbOject)){
				$msg = 'User '.$user_name .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$user_name)); 
				return true;
			}else{
				$msg = 'User '.$user_name .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$user_name)); 
				return true;
			}
		}

		$user_data = $this->USER->getRecord($id);
		$user_profile = $this->USER->getUserProfile($id);
		//print_r($user_profile);die;
		if($user_data){
			$data['modules'] = $this->USER->getModules();
			$data['roles'] = $this->USER->getRoles();
			$data['user_data'] = $user_data;
			$data['user_profile'] = $user_profile;
			$data['page'] = 'backend/user/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['modules'] = $this->USER->getModules();
			$data['roles'] = $this->USER->getRoles();
			$data['user_profile'] = $user_profile;
			$data['page'] = 'backend/user/edit';
			$this->load->view('backend/layout_main', $data);
		}
	}


	public function changeStatus()
	{
		$id = $this->input->post('id');
                
                if(empty($id)){
                     echo json_encode(array('status'=>0,'msg'=>"User details not found."));	
                     die;
                }
		$isActive = $this->input->post('isActive');
		$role = 5;
		$dbOject = array(
						'isActive' => $isActive, 
						'updated_at' => date("Y-m-d H:i:s") 
						);
	
		$mesg_sub = $isActive == 1 ? 'Activated' : 'Deactivated';
		$user_data = $this->USER->getRecord($role,$id);	
		$msg = $user_data->firstname.' '.$user_data->lastname.' '.$mesg_sub ;	
		if($this->USER->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
                         die;
		}else{
                    $msg = "Error";
			 echo json_encode(array('status'=>0,'msg'=>$msg));	
                          die;
		}

	}
	
	public function changeDocStatus()
	{
		$id = $this->input->post('id');
		$isActive = $this->input->post('isActive');

		$dbOject = array(
						'is_verified' => $isActive, 
						'update_at' => date("Y-m-d H:i:s") 
						);
	
		$mesg_sub = $isActive == 1 ? 'Verified' : 'Not Verified';
		
		$msg = $mesg_sub;	
		if($this->USER->updateKYC($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
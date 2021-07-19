<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_spend_lov extends CI_Controller {

	public $session_user;
	public $viewFilePath ="backend/spend_lov/";
	public $redirectPath = "admin/spend-lov";
	public function __construct()
	{
		parent::__construct();
                $app_id ='24';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model('spend_lov_model','MODEL',true);
		
		
	}
	
	public function index()
	{	$data['list'] = $this->MODEL->getList();
		$data['page'] = $this->viewFilePath.'index';
		$this->load->view('backend/layout_main', $data);
	}
	

	public function add($id='')
	{	
            
             if($this->input->post('id')){
                $id = $this->input->post('id');
            }
            $details = $this->MODEL->getRecord($id);
            
		if($this->input->post()){
		
			if(empty($this->input->post('name'))){
				$this->session->set_flashdata('error','Spend LOV name.');
				 redirect(base_url($this->redirectPath.'/add'));
			}

                    if(empty($id)){
                            $recordExist = $this->MODEL->checkNameAlreadyExist($this->input->post('name'));
                        }else{
                            $recordExist = $this->MODEL->checkNameAlreadyExist($this->input->post('name'),$id);
                        }
                    
                       if(!empty($recordExist)){
                           $this->session->set_flashdata('error','Spend LOV name Already Exist.');
                            redirect(base_url($this->redirectPath));
                       }
                      
                    
                            if(empty($details)){
                               //create
							   $dbOject = [
                                'name'=>$this->input->post('name'),
                                'isActive'=>'1',
                           		 ];
                               
                                $id = $this->MODEL->insert($dbOject);
                               
                                $this->session->set_flashdata('success','Spend LOV created.');
                                redirect(base_url($this->redirectPath));
                           }else{
							   //update
							   $dbOject = [
                                'name'=>$this->input->post('name')
                           		 ];
                              $updated = $this->MODEL->update($id,$dbOject);
                              
                                $this->session->set_flashdata('success','Spend LOV details updated.');
                                redirect(base_url($this->redirectPath));
                           }
                   
		}
		
		$data['recordDetails'] = $details;
        $data['page_title'] = $details?"Edit Spend LOV":"Add Spend LOV";
		
		$data['page'] =  $this->viewFilePath.'add';
		$this->load->view('backend/layout_main', $data);		
	}


	public function changeStatus()
	{
		$id = $this->input->post('id');
                
                if(empty($id)){
                     echo json_encode(array('status'=>0,'msg'=>"Details not found."));	
                     die;
                }
		$isActive = $this->input->post('isActive');
		
		$dbOject = array(
						'isActive' => $isActive, 
						);
	
		$msg = $isActive == 1 ? 'Activated' : 'Deactivated';
		$resultData = $this->MODEL->getRecord($id);	

		if($this->MODEL->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
                         die;
		}else{
            $msg = "Error";
			echo json_encode(array('status'=>0,'msg'=>$msg));	
            die;
		}

	}
	
}
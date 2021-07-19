<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_kyc_approval extends CI_Controller{

        public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='3';
                $this->session_user = checkAdminSession($app_id);
                $this->load->model('company_model');
	}
        
    public function index(){
        $filter=array();
        if($this->input->get()){
                $filter['company_name']=$this->input->get('filter_company_name');
                $filter['status']=$this->input->get('filter_status');
        }

        $data['kyc_list'] = $this->company_model->getKycDocumentList($filter);
        $data['page'] = 'backend/kyc_approval/index';
//        vdebug($data);
        $this->load->view('backend/layout_main', $data);
    }    
      
    public function changeStatus(){
        $id = $this->input->post('id');
		$isActive = $this->input->post('isActive');
            if(empty($id)){
                     echo json_encode(array('status'=>0,'msg'=>'Document not found.'));
                     die;
                }
		$dbOject = array(
                                'status' => $isActive, 
                                'updated_on' => date("Y-m-d H:i:s") 
                                );
	
		$mesg_sub = $isActive == '1' ? 'Approved' : 'Approval Pending';
//		$company_data = $this->COMPANY->getRecord($id);	
//		$msg = $company_data['name'].' '.$mesg_sub ;	
			
		if($this->company_model->updateKycStatus($id,$dbOject)){
                        $msg ="Status Updated";
			echo json_encode(array('status'=>1,'msg'=>$msg));
                        die;
		}else{
                     $msg = "Error";
			 echo json_encode(array('status'=>0,'msg'=>$msg));
                         die;
		}
               
    }
        
}


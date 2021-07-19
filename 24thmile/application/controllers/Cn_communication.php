<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_communication extends CI_Controller {

        
	public function __construct()
	{
            parent::__construct();
           
           $this->load->model('communication_model');  
		
	}
	
	public function index()
	{	
            
            $from_user_id= $this->input->post('from_user_id');
            $to_user_id = $this->input->post('to_user_id');
            $from_company_id = $this->input->post('from_company_id');
            $to_company_id = $this->input->post('to_company_id');
           // $to_user_id = $this->input->post('to_user_id');
            $request_id = $this->input->post('request_id');
            $last_message_id = $this->input->post('last_message_id')?$this->input->post('last_message_id'):'';
            
//            $from_user_id=46;
//            $to_user_id = 57;
//            $request_id = 8;
            $last_message_id = $this->input->post('last_message_id')?$this->input->post('last_message_id'):'';
             
             if(!empty($from_user_id) && !empty($to_company_id) && !empty($from_company_id) && !empty($request_id)){
                
                $communication_user_ids  = [$from_company_id,$to_company_id];
               
                $messages = $this->communication_model->getRecord($communication_user_ids,$request_id,$last_message_id);
                //vdebug($messages);
                        foreach($messages as $message){
                         $this->load->view('frontend/communication/message',['message'=>$message,'from_user_id'=>$from_user_id]);      
                        }
                
            }
            
           // die;
	}
        
        public function sendMessage(){
           
            $msg = $this->input->post('msg');
            $from_user_id= $this->input->post('from_user_id');
            $from_company_id = $this->input->post('from_company_id');
            $to_company_id = $this->input->post('to_company_id');
            $request_id = $this->input->post('request_id');
            if(!empty($from_user_id) && !empty($from_company_id) && !empty($to_company_id) && !empty($msg) && !empty($request_id)){
                
                $data = [
                            'request_id' => $request_id,
                            'from_user_id' => $from_user_id,
                            'from_company_id' => $from_company_id,
                            'to_company_id' => $to_company_id,
                            'message' => $msg,
                        ];
                
                if($this->communication_model->insert($data)){
                    echo 'success';
                    die;
                }
            }
            
            echo 'error';
            die;
        }
 

}
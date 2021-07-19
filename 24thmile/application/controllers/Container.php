<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Container extends CI_Controller {
        public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='10';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Container_model', 'CONTAINER', TRUE); 
		
	}
	
	public function index()
	{	$data['container_list'] = $this->CONTAINER->getList();
		$data['page'] = 'backend/container/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$container_type = $this->input->post('container_type');

			if(!$container_type){
				$err = "Container Type is Not provided";
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'type' => $container_type,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->CONTAINER->insert($dbOject)){
					$msg = "Container <b>".$container_type	 ."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$container_type)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/container/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$container_id = $this->input->post('container_id');
			$container_type = $this->input->post('container_type');

			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'type' => $container_type,
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->CONTAINER->update($container_id,$dbOject)){
				$msg = 'Container '.$container_type .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$container_type)); 
				return true;
			}else{
				$msg = 'Container '.$container_type .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$container_type)); 
				return true;
			}
		}

		$container_data = $this->CONTAINER->getRecord($id);
		if($container_data){
			$data['container_data'] = $container_data;
			$data['page'] = 'backend/container/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/container/edit';
			$this->load->view('backend/layout_main', $data);
		}
	}


	public function changeStatus()
	{
		$id = $this->input->post('id');
		$isActive = $this->input->post('isActive');

		$dbOject = array(
						'isActive' => $isActive, 
						'updated_at' => date("Y-m-d H:i:s") 
						);
	
		$mesg_sub = $isActive == 1 ? 'Activated' : 'Deactivated';
		$container_data = $this->CONTAINER->getRecord($id);	
		$msg = $container_data['type'].' '.$mesg_sub ;	
		if($this->CONTAINER->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
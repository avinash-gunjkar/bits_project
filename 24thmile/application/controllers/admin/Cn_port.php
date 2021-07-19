<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_port extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='16';
                $this->session_user = checkAdminSession($app_id);
		$this->load->model ('Port_model', 'PORT', TRUE); 
		
	}
	
	public function index()
	{	//$data['port_list'] = $this->PORT->getList();
		$data['page'] = 'backend/port/index';
		$this->load->view('backend/layout_main', $data);
	}
	public function ajaxPorts()
	{	
		$searchKey = $_POST['search'];
		$columns = $_POST['columns'];
		$order = $_POST['order'];

		$orderBy =$columns[$order[0]['column']]['data'].' '.$order[0]['dir'];

		$iSearch = [];
		
		if (!empty($searchKey['value'])) {
			foreach ($columns as $row) {
				if (!empty($row['data'])) {
					
					$iSearch[] = " " . $row['data'] . " LIKE '%" . $searchKey['value'] . "%' ";
				}
			}
		}
		$iSearch_str = implode(' OR ', $iSearch);
		// if(isset($_POST['filter'])){
		// 	$filter = $_POST['filter'];
			

			

		// 	if(isset($filter['status'])){
		// 		if(strlen(trim($filter['status']))>0){

		// 			$builder->where("status",$filter['status']);
		// 		}
		// 	}
		// 	if(isset($filter['title'])){
		// 		if(strlen(trim($filter['title']))>0){

		// 			$builder->like("title",$filter['title']);
		// 		}
		// 	}


		// }


		$data['data'] = $this->PORT->getList($iSearch_str,$_POST['length'],$_POST['start'],$orderBy);
		$data['recordsTotal'] = $this->PORT->getRecordsTotalCoutnt();
		$data['recordsFiltered'] = $this->PORT->getRecordsFilteredCount($iSearch_str);
		echo json_encode($data);
		die;
	}
 

	public function add()
	{	
		$err='';
        $msg='';
        // print_r($this->input->post());die;
		if($this->input->post() && $this->input->is_ajax_request()){
			$port_name = $this->input->post('port_name');
			$port_description = $this->input->post('port_description');
			$loading = $this->input->post('loading');
			$discharge = $this->input->post('discharge');


			if(!$port_name){
				$err = "Port Name is Not provided";
			}
			if(!$port_description){
				$err = "Port Description is Not provided";
			}
			
			if (!empty($loading) && !empty($discharge)) {
				$isFor = 3;
			}
			elseif ($loading) {
				$isFor = 1;
			}
			elseif ($discharge) {
				$isFor = 2;
			}
			else{
				$isFor = '';
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'name' => $port_name,
								'isFor' => $isFor,
								'description' => $port_description,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				//print_r($dbOject);die;
				
				if($this->PORT->insert($dbOject)){
					$msg = "Port <b>".$port_name ."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$port_name)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/port/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$port_id = $this->input->post('port_id');
			$port_name = $this->input->post('port_name');
			$port_description = $this->input->post('port_description');
			
			$loading = $this->input->post('loading');
			$discharge = $this->input->post('discharge');
			
			if (!empty($loading) && !empty($discharge)) {
				$isFor = 3;
			}
			elseif ($loading) {
				$isFor = 1;
			}
			elseif ($discharge) {
				$isFor = 2;
			}
			
			$dbOject = array(
								'name' => $port_name,
								'description' => $port_description, 
								'isFor' => $isFor, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->PORT->update($port_id,$dbOject)){
				$msg = 'Port '.$port_name .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$port_name)); 
				return true;
			}else{
				$msg = 'Port '.$port_name .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$port_name)); 
				return true;
			}
		}

		$port_data = $this->PORT->getRecord($id);
		//print_r($port_data);die;
		if($port_data){
			$data['port_data'] = $port_data;
			$data['page'] = 'backend/port/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			 

			$data['page'] = 'backend/port/edit';
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
		$port_data = $this->PORT->getRecord($id);	
		$msg = $port_data['name'].' '.$mesg_sub ;	
		if($this->PORT->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}
	}
        
        
        
       
}
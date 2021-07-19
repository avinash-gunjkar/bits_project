<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {
    public $session_user;
	 public function __construct() {
		parent::__construct (); 
                $app_id ='';
                $this->session_user = checkAdminSession($app_id);
		//Models
       	$this->load->model ('Department_model', 'DEPARTMENT', TRUE); 
       	// $this->load->model ('Employee_model', 'EMPLOYEE', TRUE); 
    }
	
	public function index()
	{ 

	  // $departments = $this->DEPARTMENT->getList();	
	  // $data['departments'] = $departments;
	  // $dept_names = $this->DEPARTMENT->getDepartmentList();	
	//  print_r($dept_names);die;
	  // $data['dept_names'] = $dept_names;
	  $data['page_title']= "Department:Master";
	  $data['page']= "backend/department/index";
      $this->load->view('backend/components/container', $data);
	}

	public function add()
	{	
		$err =array();
		if($this->input->post('doSubmit')){

			$department_name = $this->input->post('department_name');

			if(empty($err)){
				$dbOject = array(

								'department_name' => $department_name,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s"),
								'created_by' => 1,
								'updated_by' => 1

								);

				if($this->DEPARTMENT->insert($dbOject)){
					redirect(base_url('department'));
				}else{
					echo 'failed';
				}
			}

		}
	}


	public function getDepartment()
	{
		$department_id = $this->input->post('id');

		if(!$department_id){
			$err[] = "Department id not provided";
		}

		if(empty($err)){ 
			$department = $this->DEPARTMENT->getRecord($department_id);
			if($department){
				 echo json_encode(array('status'=>1,'data'=>$department));
			}else{
				echo 'failed';
				 
			}

		}
	}

	public function getDepartmentChecWithExisting()
	{
		$department_id = $this->input->post('id');
		// print_r($department_id);die('okk');

		$dept = $this->EMPLOYEE->getExistingDeptID($department_id);

		if($dept){
			 echo json_encode(array('status'=>0,'data'=>null,'msg'=>'Department Used'));
		}else{
			$department = $this->DEPARTMENT->getRecord($department_id);	
		 	echo json_encode(array('status'=>1,'data'=>$department,'msg'=>'Department not used'));	 
		}
	}

	public function edit()
	{
		$err =array();
		if($this->input->post('doEdit')){

			$department = $this->input->post('edit_department_name');
			$department_id = $this->input->post('edit_id');

			if(!$department_id){
				$err[] = "Department id not provied";
			}
			if(!$department){
				$err[] = "Department Not provided";
			}


			if(empty($err)){
				$dbOject = array(

								'department_name' => $department, 
								'updated_at' => date("Y-m-d H:i:s"), 
								'updated_by' => 1

								);
				
				if($this->DEPARTMENT->update($department_id,$dbOject)){
					redirect(base_url('department'));
				}else{
					echo 'failed';
				}
			}
		}
	}


	public function delete()
	{
		$err =array();
		
		if($this->input->post('doDelete')){
 
			$department_id = $this->input->post('delete_id');

			if(!$department_id){
				$err[] = "Department id not provied";
			} 

			if(empty($err)){
				$dbOject = array(

								'isActive' => 0, 
								'updated_at' => date("Y-m-d H:i:s"), 
								'updated_by' => 1

								);
				
				if($this->DEPARTMENT->update($department_id, $dbOject)){
					redirect(base_url('department'));
				}else{
					echo 'failed';
				}
			}
		}
	}

}

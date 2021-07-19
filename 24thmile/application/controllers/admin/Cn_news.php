<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_news extends CI_Controller {

	public $session_user;
	public $viewFilePath ="backend/news/";
	public $redirectPath = "admin/news-and-events";
	public $type = 'News';
	public function __construct()
	{
		parent::__construct();
                $app_id ='28';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model('newsEvents_model','MODEL',true);
		
		
	}
	
	public function index()
	{	//$data['list'] = $this->MODEL->getList();
		$data['page'] = $this->viewFilePath.'index';
		$this->load->view('backend/layout_main', $data);
	}
	public function ajaxNewsAndEvents()
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
		//$type='News',$limit='',$start=0,$search='',$filter=array(),$orderBy='id desc'
		$data['data'] = $this->MODEL->getNewsEvents($this->type,$_POST['length'],$_POST['start'],$iSearch_str,[],$orderBy);
		$data['recordsTotal'] = $this->MODEL->getRecordsTotalCoutnt($this->type);
		$data['recordsFiltered'] = $this->MODEL->getRecordsFilteredCount($this->type,$iSearch_str,[]);
		echo json_encode($data);
		die;
	}
	

	public function add($id='')
	{	
            
             if($this->input->post('id')){
                $id = $this->input->post('id');
            }
            $details = $this->MODEL->getRecord($this->type,$id);
            
		if($this->input->post()){
			$oldImageName = $this->input->post('old_image');
			if($this->input->post('flagDeleteImage')){
				if(is_file('uploads/news/' . $oldImageName)){
					unlink('uploads/news/' . $oldImageName);
					$oldImageName='';
				}
			}

			//upload image
			if (!empty($_FILES['image']['name'])) {

				$config['upload_path'] = 'uploads/news/';
				$pathinfoArr = pathinfo($_FILES['image']['name']);
				$extention	= $pathinfoArr['extension'];
				$newImagename = uniqid() . '.' . $extention;
				$config['file_name'] = $newImagename;
				//				$config['file_name'] = $_FILES['profile_pic']['name'];
				$config['overwrite'] = false;
				$config["allowed_types"] = 'jpg|jpeg|png|gif';

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				if ($this->upload->do_upload('image')) {
					
					//unlink old file
					$uploadData = $this->upload->data();
					if(is_file($config['upload_path'] . $this->input->post('old_image'))){
						unlink($config['upload_path'] . $this->input->post('old_image'));
					}
					$imageFileName = $uploadData['file_name'];
				} else {
					
					$imageFileName = '';
				}
				
			}else{
				
				$imageFileName = $oldImageName;
			}

			
			
                            if(empty($details)){
                               //create
							   $dbOject = [
                                'title'=>$this->input->post('title'),
                                'date'=>getMysqlDateFormat($this->input->post('date')),
                                'description'=>$this->input->post('description'),
                                'type'=>$this->type,
                                'image'=>$imageFileName,
                                'status'=>'1',
                           		 ];
                               
                                $id = $this->MODEL->insert($dbOject);
                               
                                $this->session->set_flashdata('success','Created.');
                                redirect(base_url($this->redirectPath));
                           }else{
							   //update
							   $dbOject = [
                                'title'=>$this->input->post('title'),
                                'date'=>getMysqlDateFormat($this->input->post('date')),
                                'description'=>$this->input->post('description'),
                                'updated_at'=>date('Y-m-d H:i:s'),
                                'image'=>$imageFileName,
                                'status'=>'1',
                           		 ];
                               $updated = $this->MODEL->update($id,$dbOject);
                              
                                $this->session->set_flashdata('success','Updated.');
                                redirect(base_url($this->redirectPath));
                           }
                   
		}
		
		$data['recordDetails'] = $details;
        $data['page_title'] = $details?"Edit News":"Add News";
		
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
						'status' => $isActive, 
						);
	
		$msg = $isActive == 1 ? 'Activated' : 'Deactivated';
		//$resultData = $this->MODEL->getRecord($id);	

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
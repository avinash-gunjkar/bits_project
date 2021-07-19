<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Freight extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model ('Sector_model', 'SECTOR', TRUE);
		$this->load->model ('Freight_model', 'FREIGHT', TRUE);
		$this->load->model ('Rfc_category_model', 'RFCCATEGORY', TRUE);
		$this->load->model ('Particular_model', 'PARTICULAR', TRUE);		
	}

	public function index()
	{	
		
	$freightTemplate_list = $this->FREIGHT->getTemplateListByParticulars(true);
// print_r($freightTemplate_list);die;
		$data['freightTemplate_list'] = $freightTemplate_list;
		$data['page'] = 'backend/freight/freight_template_list';
		$this->load->view('backend/layout_main', $data);


	}

	public function addTemplateForSector()
	{	
			$rfccategory_list = $this->RFCCATEGORY->getList(true);

		for ($i=0; $i < count($rfccategory_list); $i++) 
		{ 
			$particular_list = $this->PARTICULAR->getParticularsFromRFCCategory($rfccategory_list[$i]['id']);
			$rfccategory_list[$i]['particular_list'] = $particular_list;
		}

		$data['rfccategory_list'] = $rfccategory_list;
		$data['sector_data'] = $this->SECTOR->getList();
		$data['page'] = 'backend/freight/index';
		$this->load->view('backend/layout_main', $data);
	}

 


	public function addTemplate()
	{	
		$err='';
        $msg=''; 
		if($this->input->post())
		{
			$formData = $this->input->post('formData');
			for ($i=0; $i < count($formData) ; $i++) { 
					$rfccategory_id = $formData[$i]['rfccategory_id'];
					$transaction = $formData[$i]['transaction'];
					$sector_id = $formData[$i]['sector'];
					
					$template_id = md5(time());
					// echo $template_id;die;
					if (!empty($formData[$i]['tempalte'])) {
						for ($j=0; $j < count($formData[$i]['tempalte']); $j++) { 
						$formData[$i]['tempalte'][$j]['template_id'] = $template_id;
						$formData[$i]['tempalte'][$j]['transaction'] = $transaction;
						$formData[$i]['tempalte'][$j]['sector_id'] = $sector_id;
						$formData[$i]['tempalte'][$j]['rfc_category_id'] = $rfccategory_id;
						$formData[$i]['tempalte'][$j]['created_at'] = date("Y-m-d H:i:s");
						$formData[$i]['tempalte'][$j]['updated_at'] = date("Y-m-d H:i:s");
						if(empty($err)){
							$dbOject = $formData[$i]['tempalte'][$j];
						    $this->FREIGHT->insert($dbOject);					
							}
						}
					}

			}
		}

		$data['page'] = 'backend/freight/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		// if($this->input->post() && $this->input->is_ajax_request())
		// {
		// 	$sector_id = $this->input->post('sector_id');
		// 	$sector_name = $this->input->post('sector_name');
		// 	$sector_description = $this->input->post('sector_description');
		// 	// $isActive = $this->input->post('isActive');
		// 	if ($this->input->post('isActive') == 'on') {
		// 		$isActive = 1;
		// 	}
		// 	else{
		// 		$isActive = 0;
		// 	}

		// 	$dbOject = array(
		// 						'name' => $sector_name,
		// 						'description' => $sector_description, 
		// 						'isActive' => $isActive, 
		// 						'updated_at' => date("Y-m-d H:i:s")
		// 					);

		// 	if($this->SECTOR->update($sector_id,$dbOject)){
		// 		$msg = 'Sector '.$sector_name .' updated successfully.';
		// 		echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$sector_name)); 
		// 		return true;
		// 	}else{
		// 		$msg = 'Sector '.$sector_name .' failed to updated.';				
		// 		echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$sector_name)); 
		// 		return true;
		// 	}
		// }

		// $sector_data = $this->SECTOR->getRecord($id);
		// if($sector_data){
		// 	$data['sector_data'] = $sector_data;
		// 	$data['page'] = 'backend/freight/edit';
		// 	$this->load->view('backend/layout_main', $data);
		// }else{
			 

		// 	$data['page'] = 'backend/freight/edit';
		// 	$this->load->view('backend/layout_main', $data);
		// }
	}


	public function changeStatus()
	{
		// $id = $this->input->post('id');
		// $isActive = $this->input->post('isActive');

		// $dbOject = array(
		// 				'isActive' => $isActive, 
		// 				'updated_at' => date("Y-m-d H:i:s") 
		// 				);
	
		// $mesg_sub = $isActive == 1 ? 'Activated' : 'Deactivated';
		// $sector_data = $this->SECTOR->getRecord($id);	
		// $msg = $sector_data['name'].' '.$mesg_sub ;	
		// if($this->SECTOR->update($id,$dbOject)){			
		// 	echo json_encode(array('status'=>1,'msg'=>$msg));
		// }else{
		// 	 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		// }

	}


		public function viewTemplate($template_id)
	{
		// print_r($template_id);die;
		$getFreightTemplate_list = $this->FREIGHT->getFreightTemplateList($template_id);
		// print_r($getFreightTemplate_list);die; 

		$freightTemp = array(); 
			 foreach ($getFreightTemplate_list as $oneRec) {
			 	if(!array_key_exists($oneRec['rfc_category_name'], $freightTemp) ){
			 		$freightTemp[$oneRec['rfc_category_name']]=array();
					array_push($freightTemp[$oneRec['rfc_category_name']], $oneRec);
		 	 	}else{
					array_push($freightTemp[$oneRec['rfc_category_name']], $oneRec);
		 	 	} 
			 }	 
			// print_r($freightTemp);
			// die('dd');
 


		$data['getFreightTemplate_list'] = $freightTemp;
		// print_r($rfccategory_list);die;
		$data['page'] = 'backend/freight/view';
		$this->load->view('backend/layout_main', $data);
		
	}

	public function addRow()
	{
		$rfc_cat = $this->input->post('rfc_cat');
		$particular_list = $this->PARTICULAR->getParticularsFromRFCCategory($rfc_cat);

		$html = ' <tr class="fieldRow">
                    <td class="col-sm-4 input-field">
                      <select class="mdb-select md-form particular_id" name="particular"  >
                        <option value="#" disabled selected>particluars</option>';
                       
                       foreach ($particular_list as $particular) {
                      	$html .= '<option value="'. $particular['id'] .'"> '. $particular['particular'].'</option>';
                       }
                     $html .='
                      </select>
                    </td>
                    <td class="col-sm-4 input-field">
                    <select class="mdb-select md-form container_id" name="container_id"  >
                        <option value="#" disabled selected>particluars</option>';
                       foreach ($particular_list as $particular) 
                       {
                      	$html .= '<option value="'. $particular['container_id'] .'"> '. $particular['type'].'</option>';
                       }
                     $html .='
                      </select>
                    </td>
                    <td class="col-sm-4 input-field">
                    <input name="unit" type="text" class="validate unit">
                    <label for="unit" data-error="">Unit</label>
                    </td>
                    <td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>
                </tr>';

                echo $html;
	}
}
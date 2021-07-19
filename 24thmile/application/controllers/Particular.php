<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Particular extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();

                $app_id ='';
                $this->session_user = checkAdminSession($app_id);
                
		$this->load->model ('Particular_model', 'PARTICULAR', TRUE); 
		$this->load->model ('Deliver_term_model', 'DELIVERTERM', TRUE); 
		$this->load->model ('Shipment_model', 'SHIPMENT', TRUE); 
		$this->load->model ('Container_model', 'CONTAINER', TRUE); 
		$this->load->model ('Contract_model', 'CONTRACT', TRUE);
		$this->load->model ('Port_model', 'PORT', TRUE);
		$this->load->model ('Mode_model', 'MODE', TRUE);
		$this->load->model ('Company_model', 'COMPANY', TRUE);
		$this->load->model ('Rfc_category_model', 'RFCCATEGORY', TRUE);
	}
	
	public function index()
	{	
		$data['freight_list'] = $this->PARTICULAR->getFreightList();
		$data['page'] = 'backend/particulars/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		
		if($this->input->post())
		{
			$particular = $this->input->post('particular');
			// $shipment = $this->input->post('shipment');
			$rfc_category_id = $this->input->post('rfc_category_id');
			$container = $this->input->post('container');
			// $no_of_container = $this->input->post('no_of_container');
			// $company_unit = $this->input->post('company_unit');
			// $mode = $this->input->post('mode');
			// $delivery_term = $this->input->post('delivery_term');
			// $amount = $this->input->post('amount');
			// $company = $this->input->post('company');
			// $contract_id = $this->input->post('contract_id');
			
			if(empty($err) && $err==''){
				$dbOject = array(
								'particular' => $particular,
								// 'shipment_id' => $shipment,
								'rfc_category_id' => $rfc_category_id,
								'container_id' => $container,
								// 'no_of_container' => $no_of_container,
								// 'comp_unit' => $company_unit,
								// 'mode_id' => $mode,
								// 'deliver_term_id' => $delivery_term,
								// 'amount' => $amount,
								// 'company_id' => $company,
								// 'contract_id' => $contract_id,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->PARTICULAR->insert($dbOject)){
					$msg = "Particular added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>'Particular')); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		
		$data['company_list'] = $this->COMPANY->getList(true);
		$data['deliveryterm_list'] = $this->DELIVERTERM->getList(true);
		$data['shipment_list'] = $this->SHIPMENT->getList(true);
		$data['container_list'] = $this->CONTAINER->getList(true);
		$data['mode_list'] = $this->MODE->getList(true);
		$data['contract_list'] = $this->CONTRACT->getList(true);
		$data['rfccategory_list'] = $this->RFCCATEGORY->getList(true);

		$data['page'] = 'backend/particulars/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{
		if ($id) {
			if($this->input->post() && $this->input->is_ajax_request())
			{
				$sellerreq_id = $this->input->post('sellerreq_id');
				$particular = $this->input->post('particular');
				$rfc_category_id = $this->input->post('rfc_category_id');
				$container = $this->input->post('container');

				if ($this->input->post('isActive') == 'on') {
					$isActive = 1;
				}
				else{
					$isActive = 0;
				}
				
				$dbOject = array(
								'particular' => $particular,
								// 'shipment_id' => $shipment,
								'rfc_category_id' => $rfc_category_id,
								'container_id' => $container,
								// 'no_of_container' => $no_of_container,
								// 'comp_unit' => $company_unit,
								// 'mode_id' => $mode,
								// 'deliver_term_id' => $delivery_term,
								// 'amount' => $amount,
								// 'company_id' => $company,
								// 'contract_id' => $contract_id,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);

				if($this->PARTICULAR->update($sellerreq_id,$dbOject)){
					$msg = 'Particular updated successfully.';
						echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>'Seller Requirements')); 
					return true;
				}else{
					$msg = 'Particular failed to updated.';				
						echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>'Seller Requirements')); 
					return true;
				}
			}
			
			$data['company_list'] = $this->COMPANY->getList(true);
			$data['deliveryterm_list'] = $this->DELIVERTERM->getList(true);
			$data['shipment_list'] = $this->SHIPMENT->getList(true);
			$data['container_list'] = $this->CONTAINER->getList(true);
			$data['mode_list'] = $this->MODE->getList(true);
			$data['contract_list'] = $this->CONTRACT->getList(true);
			$freight_temp = $this->PARTICULAR->getRecord($id);
			$data['rfccategory_list'] = $this->RFCCATEGORY->getList(true);
			$data['freight_temp'] = $freight_temp;

			$data['page'] = 'backend/particulars/edit';
			$this->load->view('backend/layout_main', $data);
		}
		else{
			 redirect(base_url('Particular')); 
		}		
	}


	public function detail($id)
	{
		if ($id) 
		{
			$data['deliveryterm_list'] = $this->DELIVERTERM->getList(true);
			$data['packing_list'] = $this->PACKING->getList(true);
			$data['container_list'] = $this->CONTAINER->getList(true);
			$data['contract_list'] = $this->CONTRACT->getList(true);
			$sellerreq_data = $this->SELLERREQ->getRecord($id);
			$data['sellerreq_data'] = $sellerreq_data;
			$data['pol_list'] = $this->PORT->getPortListFor('loading');
			$data['pod_list'] = $this->PORT->getPortListFor('discharge');
			
			$data['page'] = 'backend/sellerreq/detail';
			$this->load->view('backend/layout_main', $data);
		}
		else{
			 redirect(base_url('sellerreq')); 
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
		$sellerreq_data = $this->PARTICULAR->getRecord($id);	
		$msg = 'Freight Template'.' '.$mesg_sub;	
		if($this->PARTICULAR->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sellerreq extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model ('Sellerreq_model', 'SELLERREQ', TRUE); 
		$this->load->model ('Deliver_term_model', 'DELIVERTERM', TRUE); 
		$this->load->model ('Packing_model', 'PACKING', TRUE); 
		$this->load->model ('Container_model', 'CONTAINER', TRUE); 
		$this->load->model ('Contract_model', 'CONTRACT', TRUE);
		$this->load->model ('Port_model', 'PORT', TRUE);
		$this->load->model ('Dimension_model', 'DIMENSION', TRUE);
	}
	
	public function index()
	{	
		$data['sellerreq_list'] = $this->SELLERREQ->getList();
		$data['page'] = 'backend/sellerreq/index';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$user_id = $this->input->post('user_name');
			$pickup_address = $this->input->post('pickup_address');
			$pickup_pin = $this->input->post('pickup_pin');
			$delivery_address = $this->input->post('delivery_address');
			$delivery_pin = $this->input->post('delivery_pin');
			$deliver_term_id = $this->input->post('deliver_term_id');
			$material_description = $this->input->post('material_description');
			$material_quantity = $this->input->post('material_quantity');
			$material_unit = $this->input->post('material_unit');
			$invoice_value = $this->input->post('invoice_value');
			$hs_code = $this->input->post('hs_code');
			$packing_id = $this->input->post('packing_id');
			$container_id = $this->input->post('container_id');
			$container_required = $this->input->post('container_required');
			$contract_id = $this->input->post('contract_id');
			$validity = $this->input->post('validity');
			$frequency = $this->input->post('frequency');
			$port_loading_id = $this->input->post('pol');
			$port_discharge_id = $this->input->post('pod');
			$factory_or_port_stuffings = $this->input->post('factory_or_port_stuffings');

			if(empty($err) && $err==''){
				$dbOject = array(
								'user_id' => $user_id,
								'pickup_address' => $pickup_address,
								'pickup_pin' => $pickup_pin,
								'delivery_address' => $delivery_address,
								'delivery_pin' => $delivery_pin,
								'deliver_term_id' => $deliver_term_id,
								'material_description' => $material_description,
								'material_quantity' => $material_quantity,
								'material_unit' => $material_unit,
								'invoice_value' => $invoice_value,
								'hs_code' => $hs_code,
								'packing_id' => $packing_id,
								'container_id' => $container_id,
								'container_required' => $container_required,
								'contract_id' => $contract_id,
								'validity' => $validity,
								'frequency' => $frequency,
								'port_loading_id' => $port_loading_id,
								'port_discharge_id' => $port_discharge_id,
								'factory_or_port_stuffings' => $factory_or_port_stuffings,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->SELLERREQ->insert($dbOject)){
					$msg = "Seller Requirement added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>'Seller Requirement')); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['deliveryterm_list'] = $this->DELIVERTERM->getList(true);
		$data['packing_list'] = $this->PACKING->getList(true);
		$data['container_list'] = $this->CONTAINER->getList(true);
		$data['dimension_list'] = $this->DIMENSION->getList(true);
		$data['contract_list'] = $this->CONTRACT->getList(true);
		$data['pol_list'] = $this->PORT->getPortListFor('loading');
		$data['pod_list'] = $this->PORT->getPortListFor('discharge');

		$data['page'] = 'backend/sellerreq/add';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{
		if ($id) {
			
			
			if($this->input->post() && $this->input->is_ajax_request())
			{
				// print_r($this->input->post());die;
				$sellerreq_id = $this->input->post('sellerreq_id');
				$user_id = $this->input->post('user_name');
				$pickup_address = $this->input->post('pickup_address');
				$pickup_pin = $this->input->post('pickup_pin');
				$delivery_address = $this->input->post('delivery_address');
				$delivery_pin = $this->input->post('delivery_pin');
				$deliver_term_id = $this->input->post('deliver_term_id');
				$material_description = $this->input->post('material_description');
				$material_quantity = $this->input->post('material_quantity');
				$material_description = $this->input->post('material_description');
				$material_quantity = $this->input->post('material_quantity');
				$material_unit = $this->input->post('material_unit');
				$invoice_value = $this->input->post('invoice_value');
				$hs_code = $this->input->post('hs_code');
				$packing_id = $this->input->post('packing_id');
				$container_id = $this->input->post('container_id');
				$container_required = $this->input->post('container_required');
				$contract_id = $this->input->post('contract_id');
				$validity = $this->input->post('validity');
				$frequency = $this->input->post('frequency');
				$port_loading_id = $this->input->post('pol');
				$port_discharge_id = $this->input->post('pod');
				$factory_or_port_stuffings = $this->input->post('factory_or_port_stuffings');

				if ($this->input->post('isActive') == 'on') {
					$isActive = 1;
				}
				else{
					$isActive = 0;
				}
				

				$dbOject = array(
									'user_id' => $user_id,
									'pickup_address' => $pickup_address,
									'pickup_pin' => $pickup_pin,
									'delivery_address' => $delivery_address,
									'delivery_pin' => $delivery_pin,
									'deliver_term_id' => $deliver_term_id,
									'material_description' => $material_description,
									'material_quantity' => $material_quantity,
									'material_unit' => $material_unit,
									'invoice_value' => $invoice_value,
									'hs_code' => $hs_code,
									'packing_id' => $packing_id,
									'container_id' => $container_id,
									'container_required' => $container_required,
									'contract_id' => $contract_id,
									'validity' => $validity,
									'frequency' => $frequency,
									'port_loading_id' => $port_loading_id,
									'port_discharge_id' => $port_discharge_id,
									'factory_or_port_stuffings' => $factory_or_port_stuffings,
									'created_at' => date("Y-m-d H:i:s"),
									'updated_at' => date("Y-m-d H:i:s")
								);

				if($this->SELLERREQ->update($sellerreq_id,$dbOject)){
					$msg = 'Seller Requirements updated successfully.';
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>'Seller Requirements')); 
					return true;
				}else{
					$msg = 'Seller Requirements failed to updated.';				
					echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>'Seller Requirements')); 
					return true;
				}
			}
			
			$data['deliveryterm_list'] = $this->DELIVERTERM->getList(true);
			$data['packing_list'] = $this->PACKING->getList(true);
			$data['container_list'] = $this->CONTAINER->getList(true);
			$data['contract_list'] = $this->CONTRACT->getList(true);
			$sellerreq_data = $this->SELLERREQ->getRecord($id);
			$data['sellerreq_data'] = $sellerreq_data;
			$data['pol_list'] = $this->PORT->getPortListFor('loading');
			$data['pod_list'] = $this->PORT->getPortListFor('discharge');

			$data['page'] = 'backend/sellerreq/edit';
			$this->load->view('backend/layout_main', $data);
		}
		else{
			 redirect(base_url('sellerreq')); 
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
		$sellerreq_data = $this->SELLERREQ->getRecord($id);	
		$msg = 'Seller Requirements'.' '.$mesg_sub ;	
		if($this->SELLERREQ->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
public $session_user;
	public function __construct()
	{
		parent::__construct();
                $app_id ='';
                $this->session_user = checkAdminSession($app_id);
		$this->load->library("Pdf");
		$this->load->model('Reports_model', 'REPORTS', TRUE); 
		
	}
	
	public function index()
	{	
		if($_POST){
			//echo '<pre>';print_r($_POST);die;
			
			if(!empty($this->input->post('ff_id'))){
				$ff_id = $this->input->post('ff_id');
			}else{
				$ff_id = '';
			}
			
			if(!empty($this->input->post('from_date'))){
				$from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
			}else{
				$from_date = '';
			}
			
			if(!empty($this->input->post('to_date'))){
				$to_date = date('Y-m-d',strtotime($this->input->post('to_date')));
			}else{
				$to_date = date('Y-m-d');
			}
			
			$data['from_date'] = $from_date;
			$data['to_date'] = $to_date;
			$data['ff_id'] = $ff_id;
			
			$data['ff_list'] = $this->REPORTS->getFFList(true);
			$data['report_data'] = $this->REPORTS->getBookedReportsByFilter($from_date,$to_date,$ff_id);
			$data['report_val'] = $this->REPORTS->getValuesBookedShipments($from_date,$to_date,$ff_id);
			$data['page'] = 'backend/reports/index';
			$this->load->view('backend/layout_main', $data);
			
		}else{
			
			$data['from_date'] = '';
			$data['to_date'] = '';
			$data['ff_id'] = '';
			$data['ff_list'] = $this->REPORTS->getFFList(true);
			$data['report_data'] = $this->REPORTS->getBookedReportsList();
			$data['report_val'] = $this->REPORTS->getValuesBookedShipments();
			$data['page'] = 'backend/reports/index';
			$this->load->view('backend/layout_main', $data);
		}
	}
}
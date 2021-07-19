<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_dashboard extends CI_Controller {

    public $session_user;
	public function __construct()
	{
            parent::__construct();
              $app_id ='';
              $this->session_user =  checkAdminSession($app_id);
               
                
		$this->load->model('app_previlages');
		$this->load->model('admin_dashboard');
		$this->load->model('seller_model');
	}
	
	public function index()
	{
		$data['page'] = 'backend/home';
		$data['numberOfAwardedRequests'] = $this->admin_dashboard->getNumberOfRequests();
		$data['userCounts'] = $this->admin_dashboard->getUserCounts();
		$data['newInquireCount'] = $this->admin_dashboard->getNewInquireCount();
		$data['shipmentInProcessCount'] = $this->admin_dashboard->getShipmentInProcessCount();
		$data['completedShipmentPaymentPendingCount'] = $this->admin_dashboard->getCompletedShipmentPaymentPendingCount();
		$data['completedShipmentCount'] = $this->admin_dashboard->getCompletedShipmentCount();
		if(isset($_GET['finyear'])){
			$finyear = $_GET['finyear'];
		}else{
			$finyear = getCurrentFinancialYear();
		}
		$bookedShipmentStatusCount = new stdClass;
		$bookedShipmentStatusCount->import = $this->seller_model->getBookingShipmentStatusCount('','Import',$finyear);
		$bookedShipmentStatusCount->export = $this->seller_model->getBookingShipmentStatusCount('','Export',$finyear);
		$data['bookedShipmentStatusCount'] = $bookedShipmentStatusCount;
		$this->load->view('backend/layout_main', $data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('inquiry_model');
		$this->load->model('feedback_model');
		$this->load->model('NewsEvents_model');
	}
	
	public function index()
	{
		$data['page'] = 'frontend/home/index';
		$data['activeMenu']='home';
		if($this->input->post()){


			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('fullname', 'Full Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric');
			$this->form_validation->set_rules('origin', 'Origin City', 'required');
			$this->form_validation->set_rules('destination', 'Destination City', 'required');
			$this->form_validation->set_rules('shippingDate', 'Shipping Date', 'required');
			$this->form_validation->set_rules('shippingType', 'Shipping Type', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() == true)
			{
				$requestData['fullname'] = $this->input->post('fullname');
				$requestData['email'] = $this->input->post('email');
				$requestData['mobile'] = $this->input->post('mobile');
				$requestData['source'] = $this->input->post('origin');
				$requestData['destination'] = $this->input->post('destination');
				$requestData['shipping_type'] = $this->input->post('shippingType');
				$requestData['date_of_shipping'] = $this->input->post('shippingDate')?getMysqlDateFormat($this->input->post('shippingDate')):'';
				$requestData['message'] = $this->input->post('message');
				$requestData['status'] = '1';
				$this->inquiry_model->insert($requestData);
				sendEmail_inquiry($requestData);
				$this->session->set_flashdata('success','Your message sends successfully. 24thmile team contact you soon.');
				redirect(base_url());
				exit();
			}
			// echo validation_errors();die;
			
		}

		$this->load->view('frontend/layout_main', $data);
	}
	
	public function about_us()
	{
		$data['page'] = 'frontend/home/about_us';
		$data['activeMenu']='about-us';
		$this->load->view('frontend/layout_main', $data);
	}

	public function construction()
	{
		$data['page'] = 'frontend/home/construction';
		$data['activeMenu']='services';
		$this->load->view('frontend/layout_main', $data);
	}

	
	public function services()
	{
		$data['page'] = 'frontend/home/services';
		$data['activeMenu']='services';
		$this->load->view('frontend/layout_main', $data);
	}	

	public function booking_report()
	{
		$data['page'] = 'frontend/home/booking_tracking_status_report';
		$data['activeMenu']='services';
		$this->load->view('frontend/layout_main', $data);
	}	

	public function export_import_process_outsourcing_consultancy()
	{
		$data['page'] = 'frontend/home/export_import_process_outsourcing_consultancy';
		$data['activeMenu']='services';
		$this->load->view('frontend/layout_main', $data);
	}	

	public function other_outsourcing_consultancy()
	{
		$data['page'] = 'frontend/home/other_outsourcing_consultancy';
		$data['activeMenu']='services';
		$this->load->view('frontend/layout_main', $data);
	}

	public function news_event()
	{
		
		$data['page'] = 'frontend/home/news_event';
		$data['activeMenu']='news-event';
		$data['newsList'] = $this->NewsEvents_model->getNewsEvents('News','','','',$filter=['status'=>'1']);
		$data['testimonialList'] = $this->NewsEvents_model->getNewsEvents('Testimonial','','','',$filter=['status'=>'1']);
		
		$this->load->view('frontend/layout_main', $data);
	}
		public function our_clients()
	{
		$data['page'] = 'frontend/home/our_clients';
		$data['activeMenu']='our-clients';
		$this->load->view('frontend/layout_main', $data);
	}
	
	public function contact_us()
	{
		$data['page'] = 'frontend/home/contact_us';
		$data['activeMenu']='contact-us';
		if($this->input->post()){

			$this->load->library('form_validation');
			$this->form_validation->set_rules('fullname', 'Full Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric');
			$this->form_validation->set_rules('companyName', 'Company Name', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() == true)
			{
				$requestData['fullname'] = $this->input->post('fullname');
				$requestData['company_name'] = $this->input->post('companyName');
				$requestData['email'] = $this->input->post('email');
				$requestData['country_dial_code'] = $this->input->post('country_dial_code');
				$requestData['mobile'] = $this->input->post('mobile');
				$requestData['message'] = $this->input->post('message');
				$requestData['status'] = '1';
				$this->feedback_model->insert($requestData);
			
				@sendEmail_feedback($requestData);
				$this->session->set_flashdata('success','Thank you for your valuable feedback. 24thmile team contact you soon.');
				
				redirect(base_url('contact-us'));
				exit();
			}
			
		}
		$this->load->view('frontend/layout_main', $data);
	}
	public function terms_conditions()
	{
		$data['page'] = 'frontend/home/terms_conditions';
		$data['activeMenu']='terms-conditions';
		$this->load->view('frontend/layout_main', $data);
	}
	
	public function process()
	{
		$data['page'] = 'frontend/home/process';
		$data['activeMenu']='process';
		$this->load->view('frontend/layout_main', $data);
	}

	public function migrationProcess(){
		echo "<center><h1>This site is in migration process. Resume will after 24 hr.</h1></center>";
		die;
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Models
		$this->load->model('login_model');
		$this->load->model('seller_model');

		$this->load->model('Company_model', 'COMPANY', TRUE);
		$this->load->helper('cookie');
		$this->load->library(array('session', 'form_validation', 'email'));
	}


	public function index()
	{
		//admin login
		if ($this->input->post()) {

			if (!empty($this->session->userdata('logged_in'))) {
				redirect(base_url('admin/dashboard'));
			} else {

				$email = trim($this->input->post('email'));
				$password = $this->input->post('password');
				$remember_me = $this->input->post('remember_me');

				$result = $this->login_model->userlogin($email, $password);

				if ($result) {

					if (in_array($result->role, ['2', '3', '4'])) {
						$this->session->set_flashdata('error', 'Access denied.');
						redirect(base_url('admin/login'));
					}

					if ($result->isActive == 1) {

						$sess_array = array(
							'id' => $result->id,
							'firstname' => $result->firstname,
							'lastname' => $result->lastname,
							'email' => $result->email,
							'role' => $result->role,
							'isActive' => $result->isActive
						);

						$this->session->set_userdata('logged_in', $sess_array);

						if ($this->input->post("remember_me")) {
							$this->input->set_cookie('email', $email, 86500); /* Create cookie for store emailid */
							$this->input->set_cookie('password', $password, 86500); /* Create cookie for password */
						} else {
							delete_cookie('email'); /* Delete email cookie */
							delete_cookie('password'); /* Delete password cookie */
						}

						$this->session->set_flashdata('success', 'Welcome ' . $sess_array['firstname'] . ' ' . $sess_array['lastname'] . '..!');

						redirect(base_url('admin/dashboard'));
					} else {

						$this->session->set_flashdata('error', 'You are registered but please confirm the mail sent to your email id');
						redirect(base_url('admin/login'));
					}
				} else {

					$this->session->set_flashdata('error', 'Invalid username or password');
					redirect(base_url('admin/login'));
				}
			}
		} else {

			if (!empty($this->session->userdata('logged_in'))) {
				redirect(base_url('admin/dashboard'));
			} else {
				$data['page'] = 'backend/login/index';
				$this->load->view("backend/layout_login", $data);
			}
		}
	}

	public function register()
	{
		if ($_POST) {

			$useremail = $this->input->post('email');

			$userExist = $this->login_model->get_User($useremail);

			if (empty($userExist)) {

				$userdata = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'username' => $this->input->post('username'),
					'password' => sha1($this->input->post('password')),
					'email' => $this->input->post('email')
				);

				$userId = $this->login_model->insertUser($userdata);

				if ($userId) {

					$this->session->set_flashdata('success', 'You are Successfully Registered!');

					redirect(base_url('login'));
					/*if($this->login_model->sendUserEmail($this->input->post('firstname'),$this->input->post('email')))
					{
						
						$this->session->set_flashdata('success','You are Successfully Registered! Please confirm the mail sent to your Email-ID!!!');
						redirect(base_url('login'));
						
					}
					 else
					{
					   
						$this->session->set_flashdata('error','Email Not Send..!!!');
						redirect(base_url('login'));
					}*/
				}
			} else {
				$this->session->set_flashdata('error', 'User Already Exist ..!!!');
				redirect(base_url('login'));
			}
		} else {

			$data['page'] = 'backend/login/register';
			$this->load->view('backend/layout_login', $data);
		}
	}

	public function logout()
	{
		//admin logout
		$this->session->unset_userdata('logged_in');
		redirect(base_url('admin/login'));
	}

	public function seller_login()
	{

		if ($this->input->post()) {

			$email = trim($this->input->post('email'));
			$password = $this->input->post('password');
			$remember_me = $this->input->post('remember_me');

			$result = $this->login_model->userlogin($email, $password);

			if ($result) {

				if ($result->isActive == 1) {
					$profileData = $this->seller_model->getSellerProfile($result->id);

					if (!$profileData->company_details->isActive) {
						$this->session->set_flashdata('error', 'Your company is Inactive, please contact to admin.');
						redirect(base_url('signin'));
					}
					if ($profileData->company_details->public_status) {
						$this->session->set_flashdata('error', 'Your company was Blocked, please contact to admin.');
						redirect(base_url('signin'));
					}


					$sess_array = array(
						'id' => $result->id,
						'company_id' => $result->company_id,
						'phone' => $result->phone,
						'company_name' => $profileData->company_details->name,
						'firstname' => $result->firstname,
						'lastname' => $result->lastname,
						'email' => $result->email,
						'role' => $result->role,
						'profile_pic' => $profileData->profile_pic,
						'isActive' => $result->isActive
					);

					$this->session->set_userdata('seller_logged_in', $sess_array);

					if ($this->input->post("remember_me")) {
						$this->input->set_cookie('seller-email', $email, 86500); /* Create cookie for store emailid */
						$this->input->set_cookie('seller-password', $password, 86500); /* Create cookie for password */
					} else {
						delete_cookie('email'); /* Delete email cookie */
						delete_cookie('password'); /* Delete password cookie */
					}

					$this->session->set_flashdata('success', 'Welcome ' . $sess_array['firstname'] . ' ' . $sess_array['lastname'] . '..!');

					if ($sess_array['role'] == 3) {

						if ($this->session->userdata('redirect_url') !== null) {
							$redirect_url = $this->session->userdata('redirect_url');
							$this->session->unset_userdata('redirect_url');
						} else {
							$redirect_url = 'ff-dashboard';
						}
						redirect(base_url($redirect_url));
					} else {

						if ($this->session->userdata('redirect_url') !== null) {
							$redirect_url = $this->session->userdata('redirect_url');
							$this->session->unset_userdata('redirect_url');
						} else {
							$redirect_url = 'fs-dashboard';
						}
						redirect(base_url($redirect_url));
					}
				} else {

					$this->session->set_flashdata('error', 'You are registered but please confirm the mail sent to your email id');
					redirect(base_url('signin'));
				}
			} else {

				$this->session->set_flashdata('error', 'Invalid username or password');
				redirect(base_url('signin'));
			}
		} else {
			$data['page'] = 'frontend/login/index';
			$this->load->view("frontend/layout_main", $data);
		}
	}

	public function seller_registeration()
	{


		if ($_POST) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('firstname', 'Full Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_users.email]');
			$this->form_validation->set_rules('phone', 'Mobile', 'trim|required|numeric');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
			$this->form_validation->set_rules('captcha_challenge', 'Captcha', 'trim|required|callback_captch_check');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() == true) {


				$useremail = $this->input->post('email');

				$userExist = $this->login_model->get_User($useremail);

				if ($this->input->post('user_type') == 'Freight Forwarder') {
					$role = 3;
				} else {
					$role = 2;
				}

				if (empty($userExist)) {

					//check otp
					//     if(!$this->check_otp($this->input->post('otp'), $this->input->post('phone'))){
					//         $this->session->set_flashdata('error','Invalid otp !!!');
					// redirect(base_url('signup'));
					//     }


					//create company
					$dbOject = array(
						'name' => '',
						'description' => '',
						'role' => $role,
						'created_at' => date("Y-m-d H:i:s"),
						'updated_at' => date("Y-m-d H:i:s")
					);

					$companyId = $this->COMPANY->insert($dbOject);

					$userdata = array(
						'company_id' => $companyId ? $companyId : null,
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'username' => $this->input->post('firstname'),
						'phone' => $this->input->post('phone'),
						'password' => sha1($this->input->post('confirm_password')),
						'role' => $role,
						'company_role' => 'super_user',
						'email' => $this->input->post('email')
					);

					$userId = $this->login_model->insertUser($userdata);

					if ($userId) {

						/* $this->session->set_flashdata('success','You are Successfully Registered!');
					
					redirect(base_url('signin')); */

						//delete otp cookie
						$this->session->unset_userdata('otp_data');

						if (sendEmail_Signup($this->input->post('firstname'), $this->input->post('email'))) {

							$this->session->set_flashdata('success', 'You are Successfully Registered! Please confirm the mail sent to your Email-ID!!!');
							redirect(base_url('signin'));
						} else {

							$this->session->set_flashdata('error', 'Email Not Send..!!!');
							redirect(base_url('signin'));
						}
					}
				} else {
					$this->session->set_flashdata('error', 'User Already Exist ..!!!');
					redirect(base_url('signin'));
				}
			}
		}

		$data['page'] = 'frontend/login/register';
		$this->load->view('frontend/layout_main', $data);
	}

	public function forgot()
	{
		if ($_POST) {

			$email = $this->input->post('email');
			$check = $this->login_model->get_User($email);
			//echo '<pre>';print_r($check);die;
			if ($check) {
				//				$subject = 'Forgot Password';
				//				
				//				$message = 'Dear '.$check->firstname.' '.$check->lastname.',<br/><br/> Please click on the below activation link to reset your password.<br/><br/> '.base_url('login/change_password?reset_code='.base64_encode($check->email)).' <br/> <br/><br/> Thanks <br/> 24thmile Team';
				//				
				//				$config['protocol']    = 'smtp';
				//				$config['smtp_host']    = 'ssl://smtp.googlemail.com';
				//				$config['smtp_port']    = '465';
				//				$config['smtp_timeout'] = '7';
				//				$config['smtp_user']    = 'info.24thmile@gmail.com';
				//				$config['smtp_pass']    = 'info@24th';
				//				$config['charset']    = 'iso-8859-1';
				//				$config['newline']    = "\r\n";
				//				$config['mailtype'] = 'html';
				//				
				//				$this->load->library('email');
				//				$this->email->initialize($config);
				//				
				//				$this->email->from('info.24thmile@gmail.com', '24thMile');
				//				$this->email->to($email);
				//				$this->email->subject($subject);
				//				$this->email->message($message);
				//				$this->email->send();

				sendEmail_forgotPassword($check->firstname, $check->lastname, $check->email);
				$this->session->set_flashdata('success', 'Kindly click on the link share on your email id to reset your password !!!');
				redirect(base_url('signin'));
			} else {

				$this->session->set_flashdata('error', 'Your email id not exist !!!');
				redirect(base_url('signin'));
			}
		} else {
			$data['page'] = 'frontend/login/forgot';
			$this->load->view('frontend/layout_main', $data);
		}
	}

	function verify($hash = NULL)
	{
		if ($this->login_model->verifyEmailID($hash)) {
			$this->session->set_flashdata('success', 'Your Email Address is successfully verified! Please login to access your account!');
			redirect(base_url('signin'));
		} else {
			$this->session->set_flashdata('error', 'Sorry! There is error verifying your Email Address!');
			redirect(base_url('signup'));
		}
	}

	public function seller_logout()
	{
		$this->session->unset_userdata('seller_logged_in');
		redirect(base_url('signin'));
	}

	public function change_password()
	{
		if ($_POST) {



			$email = base64_decode($this->input->post('email'));

			$user_Data = $this->login_model->get_User($email);
			$check = $this->login_model->get_User($email);
			$userdata = array(
				'password' => sha1($this->input->post('confirm_password')),
				'isActive' => 1
			);

			if ($this->login_model->updatePassword($email, $userdata)) {

				//                             $subject = 'Change Password';
				//				
				//				$message = 'Dear '.$check->firstname.' '.$check->lastname.',<br/><br/>  Your new password is <b> '.$this->input->post('confirm_password').'</b> <br/> <br/><br/> Thanks <br/> 24thmile Team';
				//				
				//				$config['protocol']    = 'smtp';
				//				$config['smtp_host']    = 'ssl://smtp.googlemail.com';
				//				$config['smtp_port']    = '465';
				//				$config['smtp_timeout'] = '7';
				//				$config['smtp_user']    = 'info.24thmile@gmail.com';
				//				$config['smtp_pass']    = 'info@24th';
				//				$config['charset']    = 'iso-8859-1';
				//				$config['newline']    = "\r\n";
				//				$config['mailtype'] = 'html';
				//				
				//				$this->load->library('email');
				//				$this->email->initialize($config);
				//				
				//				$this->email->from('info.24thmile@gmail.com', '24thMile');
				//				$this->email->to($email);
				//				$this->email->subject($subject);
				//				$this->email->message($message);
				//				$this->email->send();

				sendEmail_changePassword($check->firstname, $check->lastname, $email, $this->input->post('confirm_password'));
				$this->session->set_flashdata('success', 'Password reset successfully');
				redirect(base_url('signin'));
			}
		} else {
			$data['page'] = 'frontend/login/change_password';
			$this->load->view('frontend/layout_main', $data);
		}
	}

	public function send_otp()
	{
		$mobile = $this->input->post('phone');
		$email = $this->input->post('email');

		if (!empty($mobile)) {
			$otp_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

			if (!empty($email)) {
				sendEmail_verificationCode($email, $otp_code);
			}

			$message = "Use $otp_code is your 24thmile verification code. Please do not share with anyone. We will not ask for your code in any way.";
			//getting values from included file

			$message = urlencode($message);

			$ch = curl_init("http://www.eazy2sms.in/SMS.aspx?Userid=Temgire&Password=Temgire2019&Type=1&Mobile=" . $mobile . "&Message=" . $message);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			$output = curl_exec($ch);
			curl_close($ch);

			//    print_r($output);
			//End::Send otp sms

			//                $output = "Successfully";

			$this->session->set_userdata('otp_data', [$mobile => $otp_code]);
			if (stripos(strip_tags($output), "Successfully") !== false) {
				/*return:*/
				$result['result'] = array('msg' => '1', 'msg_string' => 'Verification code send successfully.');
				$return = json_encode($result);
				echo $return;
				die;
			}
			/*return:*/
			$result['result'] = array('msg' => '0', 'msg_string' => 'Faild to send otp.');
			$return = json_encode($result);
			echo $return;
			die;
		}
		$result['result'] = array('msg' => '0', 'msg_string' => 'Something went wrong.');
		$return = json_encode($result);
		echo $return;
		die;

		//           print_r($this->input->cookie());
	}

	public function check_otp($str, $mobile)
	{

		$otp_data = $this->session->userdata('otp_data');
		if ($otp_data[$mobile] == $str) {
			return true;
		} else {

			$this->form_validation->set_message('check_otp', "OTP is not match with $mobile.");
			return FALSE;
		}
	}

	public function captch_check($str)
	{
		if (strcmp($str, $this->session->userdata('captcha_text')) == 0) {
			return TRUE;
		} else {

			$this->form_validation->set_message('captch_check', 'Invalid {field}.');
			return FALSE;
		}
	}
}

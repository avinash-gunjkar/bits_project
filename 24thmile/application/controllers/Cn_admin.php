<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_admin extends CI_Controller {

        public $admin_session;
	public function __construct()
	{
		parent::__construct();
               
        if(empty($this->session->userdata('logged_in')))
        {
                    
                    $this->session->set_userdata('redirect_url', uri_string());
			redirect(base_url('login'));
        }else{
            $this->admin_session = $this->session->userdata('logged_in');
            if($this->admin_session['role']!=='1'){
                $this->session->set_flashdata('error','Access denied.');
                redirect(base_url());
            }
            
        }
		
	}
        
       
        
        
}


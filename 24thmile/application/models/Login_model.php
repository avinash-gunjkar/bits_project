<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	 
	function __construct() {
		
        parent::__construct();
		
		$this->load->database();
		$this->load->library('email');
    }
	
	function userlogin($email, $password)
	{
	   $this->db->select('*');
	   $this->db->from('tbl_users');
	   $this->db->where('email', $email);
	   $this->db->where('password', sha1($password));
	   $this->db->limit(1);
	 
	   $query = $this->db->get();
	   
	   if($query->num_rows() == 1)
	   {
		 return $query->row();
	   }
	   else
	   {
		 return false;
	   }
	}
	
	function insertUser($data)
    {
        $this->db->insert('tbl_users', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
    }
    
	function updatePassword($email,$data)
    {
        $this->db->where('email',$email);
        return $this->db->update('tbl_users', $data);
    }
   
    function sendUserEmail($fname,$to_email)
    {
        $subject = 'Verify Your Email Address';
        $message = 'Dear '.$fname.',<br/><br/> Please click on the below activation link to verify your email address.<br/><br/> '.base_url('login/verify/' . sha1($to_email)).' <br/><br/><br/>  Thanks <br/> Infinite 1 Team';
		
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.googlemail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'info.24thmile@gmail.com';
		$config['smtp_pass']    = 'info@24th';
		$config['charset']    = 'iso-8859-1';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html';
		
		$this->load->library('email');
		$this->email->initialize($config);
		
        $this->email->from('info.24thmile@gmail.com', '24thMile');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
		return true;
    }
    
    
    function verifyEmailID($key)
    {
        $data = array('isActive' => 1);
        $this->db->where('sha1(email)', $key);
        return $this->db->update('tbl_users', $data);
    }
	
	function get_User($email)
	{
		
	   $query = $this->db->query("select * from tbl_users where email = '" . $email . "'");
	   
	   if($query->num_rows() == 1)
	   {
		 return $query->row();
	   }
	   else
	   {
		 return false;
	   }
	}
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry_model extends CI_Model{

	private $TBL='tbl_inquiry';

	function __construct(){
		parent::__construct();
	}

	public function insert($data){
		if($this->db->insert($this->TBL,$data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}


}
?>

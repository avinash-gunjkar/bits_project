<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Communication_model extends CI_Model{

	private $TBL='tbl_seller_requirement_mapp_communication';

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

	public function update($id,$data){
		$this->db->where('id', $id);
		if($this->db->update($this->TBL, $data)){
			return true;
		}else{
			return false;
		}
	}

	public function getRecord($communication_user_ids,$request_id,$last_message_id=''){

            $this->db->select("t1.*,CONCAT(t2.firstname,' ',t2.lastname) as from_name");
            $this->db->from("tbl_seller_requirement_mapp_communication as t1");
            $this->db->join("tbl_users as t2","t1.from_user_id=t2.id",'left');
            $this->db->where_in('t1.from_company_id',$communication_user_ids);
            $this->db->where_in('t1.to_company_id',$communication_user_ids);
            $this->db->where('t1.request_id',$request_id);

            if($last_message_id){
                $this->db->where('t1.id >',$last_message_id);
            }
            $query = $this->db->get();
            return $query->result();
	} 
        
        
   


}
?>

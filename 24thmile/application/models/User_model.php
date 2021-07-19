<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	private $TBL='tbl_users';

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
	
	public function updateKYC($id,$data){
		$this->db->where('id', $id);
		if($this->db->update('tbl_users_kyc_document', $data)){
			return true;
		}else{
			return false;
		}
	}
	

	public function getRecord($role='',$id){
		$this->db->where('id', $id);
                if($role){
                    $this->db->where('role', $role);
                }
		$query = $this->db->get($this->TBL);
		$row=array();
		if ($query->num_rows() > 0){
			$row = $query->row();
		}
		return $row;
	} 

	public function delete($id){
		return	$this->db->delete($this->TBL, array('id' => $id));
	}

	public function exist($id){
		$this->db->select('COUNT(*) AS CNT');
		$this->db->where('id',$id);
		$query=$this->db->get($this->TBL);

		if ($query->num_rows() > 0){
			if($query->row()->CNT>0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

         function checkEmailAlreadyExist($email,$user_id='')
    {
            $this->db->select("*");
            $this->db->from("tbl_users");
            $this->db->where('email',$email);
            if($user_id){
             $this->db->where('id !=',$user_id);
            }
            $query = $this->db->get();
            return $query->row();

    }
    
  	public function getList($roles_array=array(),$isActive=false){
		$this->db->order_by('created_at','DESC');
		if ($isActive) {
			$this->db->where('isActive',1);
		}
		if ($roles_array) {
			$this->db->where_in('role',$roles_array);
		}
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $rs;
	}


	
	public function getUserProfile($id){
		$this->db->select('*');
		$this->db->where('user_id', $id);
		$query = $this->db->get('tbl_users_profile');
		return $query->row();
	}
	
	public function getKYCList($id){
		$this->db->select('*');
		$this->db->where('user_id', $id);
		$query = $this->db->get('tbl_users_kyc_document');
		return $query->result();
	}

	public function getListBetween($unix_start_date,$unix_end_date){
		$this->db->where('created_at =',$unix_start_date);
		$this->db->where('created_at <',$unix_end_date);
		$this->db->order_by('created_at','DESC');
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $rs;
	}	
 
	public function getModules(){
		$this->db->select('*');
		$query = $this->db->get('tbl_modules');
		return $query->result();
	}
	
	public function getRoles(){
		$this->db->select('*');
		$query = $this->db->get('tbl_user_role');
		return $query->result();
	}

}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_user_modal extends CI_Model{

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

	public function getRecord($user_id,$company_id){
//		$this->db->where('id', $id);
//		$this->db->where('company_id', $company_id);
//		$query = $this->db->get($this->TBL);
//		$row=array();
//		if ($query->num_rows() > 0){
//			$row = $query->row();
//		}
//		return $row;
                        $this->db->select("*,tbl_users.id as user_id");
			$this->db->from("tbl_users");
			$this->db->join('tbl_users_profile', 'tbl_users_profile.user_id = tbl_users.id','left');
			$this->db->where('tbl_users.id',$user_id);
			$this->db->where('tbl_users.company_id',$company_id);
			$query = $this->db->get();
			return $query->row();
	} 
        
        

	public function delete($id){
            //delete profile
             $this->db->delete('tbl_users_profile', array('user_id' => $id));
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

    public function getList($company_id,$sessionUserId){
        
		$query = $this->db->select('t1.*, CONCAT(t2.salutation," ", t2.firstname," ", t2.lastname) as supervisor_name, t3.branch_name ')
                        ->from('tbl_users as t1')
                        ->where('t1.company_id',$company_id)
                        ->where('t1.id !=',$sessionUserId)
                        ->join('tbl_users as t2', 't1.supervisor_id = t2.id', 'LEFT')
                        ->join('tbl_company_mapp_branch_offices as t3', 't1.branch_id = t3.id', 'LEFT')
                        ->get();
                   return $query->result();
	}
        
        public function getSupervisorList($company_id){
            $query = $this->db->select('t2.id, CONCAT(t2.salutation," ", t2.firstname," ", t2.lastname) as supervisor_name ')
                        ->from('tbl_users as t2')
                        ->where('t2.company_id',$company_id)
                        ->get();
                   return $query->result();
        }
    function getUserProfile($user_id)
            {
                    $this->db->select("*");
                    $this->db->from("tbl_users_profile");
                    $this->db->where('user_id',$user_id);
                    $query = $this->db->get();
                    return $query->row();

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


}
?>

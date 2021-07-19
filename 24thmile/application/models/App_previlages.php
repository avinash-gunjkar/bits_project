<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_previlages extends CI_Model{

	
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

	public function getRecord($id,$company_id){
		$this->db->where('id', $id);
		$this->db->where('company_id', $company_id);
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

         public function getAppGrpList($status='',$arr_user_app_privilege_id=array()){
        
            //  if($status){
			// }
			$this->db->where('status', '1');
		$this->db->order_by('rank');
		$query = $this->db->get('tbl_mst_app_grp_name_list');
                $result = $query->result();
                
                foreach ($result as $key=>$row){
                   $result[$key]->app_list = $this->getAppList($row->app_grp_id,$status,$arr_user_app_privilege_id) ;
                }
                
		return $result;
	}
        
    public function getAppList($app_grp_id,$status='',$arr_user_app_privilege_id=array()){
        
		if($status){
                 $this->db->where('status', $status);
                }
		if($arr_user_app_privilege_id){
                 $this->db->where_in('app_id', $arr_user_app_privilege_id);
                }
                $this->db->where('app_grp_id', $app_grp_id);
                 
		$this->db->order_by('app_name');
		
		$query = $this->db->get('tbl_mst_app_name_list');
                
                
		return $query->result();
	}
        
        public function getAppIdExist($app_id,$user_id){
                $this->db->where('app_id', $app_id);
                $this->db->where('to_user_id ', $user_id);
		$query = $this->db->get('tbl_mst_app_user_privileges');
		return $query->row();
        }
        
        public function insertAppPrivilage($data){
            if($this->db->insert('tbl_mst_app_user_privileges',$data)){
                return $this->db->insert_id();
            }else{
                return;
            }
            
        }
        
        public function updateAppPrivilage($app_id,$user_id){
                $this->db->where('app_id', $app_id);
                $this->db->where('to_user_id', $user_id);
		if($this->db->update('tbl_mst_app_user_privileges', ['status'=>'1'])){
			return true;
		}else{
			return false;
		}
            
        }
        
        public  function removeAppPrevilage($app_id_arr,$user_id){
                $this->db->where_not_in('app_id', $app_id_arr);
                $this->db->where('to_user_id', $user_id);
		if($this->db->update('tbl_mst_app_user_privileges', ['status'=>'0'])){
			return true;
		}else{
			return false;
		}
        }
        public  function getAppUserAppPrivilageIdList($user_id){
                $this->db->select('app_id');
                $this->db->where('status', '1');
                $this->db->where('to_user_id', $user_id);
		$query = $this->db->get('tbl_mst_app_user_privileges');
                $result = $query->result();
                
                $appIdList = array();
                foreach ($result as $row){
                    array_push($appIdList, $row->app_id);
                }
                return $appIdList;
        }



}
?>

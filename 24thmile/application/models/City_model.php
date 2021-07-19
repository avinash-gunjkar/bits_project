<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends CI_Model{

	

	function __construct(){
		parent::__construct();
                
	}

	



  	public function getList($city_name){
            
       $query = $this->db->select('t1.id as city_id, t1.city, t2.state_id , t2.state_title, t3.idCountry as country_id, t3.countryName, t3.currency')
             ->from('tbl_master_city as t1')
             ->where('t1.city LIKE "%'.$city_name.'%"')
             ->join('tbl_state as t2', 't1.state_id = t2.state_id', 'LEFT')
             ->join('tbl_countries as t3', 't2.country_id = t3.idCountry', 'LEFT')
             ->limit(10)
             ->get();
        return $query->result();
           
		
	}
        
        public function countryExist($name){
            $this->db->select('idCountry,currency');
            $this->db->where('countryName',$name);
            $query=$this->db->get('tbl_countries');
             $result =  $query->row();
             return $result;
             
        }

        public function getCountryFromId($id){
            $this->db->select('idCountry,countryCode,countryName,currency');
            $this->db->where('idCountry',$id);
            $query=$this->db->get('tbl_countries');
             $result =  $query->row();
             return $result;
             
        }

        public function stateExist($name,$country_id){
            $this->db->select('state_id');
            $this->db->where('state_title',$name);
            $this->db->where('country_id',$country_id);
            $query=$this->db->get('tbl_state');
             $result =  $query->row();
             return $result->state_id;
             
        }
        public function cityExist($name,$state_id){
            $this->db->select('id');
            $this->db->where('city',$name);
            $this->db->where('state_id',$state_id);
            $query=$this->db->get('tbl_master_city');
             $result =  $query->row();
             return $result->id;
             
        }
        
        public function addCountry($data){
            if($this->db->insert('tbl_countries',$data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
        }
        public function addState($data){
            if($this->db->insert('tbl_state',$data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
        }
        public function addCity($data){
            if($this->db->insert('tbl_master_city',$data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
        }
        

	
 


}
?>

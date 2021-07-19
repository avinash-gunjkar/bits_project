<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Port_model extends CI_Model{

	private $TBL='tbl_port';

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

	public function getRecord($id){
		$this->db->where('id', $id);
		$query = $this->db->get($this->TBL);
		$row=array();
		if ($query->num_rows() > 0){
			$row = $query->row_array();
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

    public function getList($iSearch='',$length,$start,$orderBy){
		
		$this->db->limit($length,$start);
		$this->db->order_by($orderBy);
		if(!empty($iSearch)){
			$this->db->where("($iSearch)");
		}
		$query = $this->db->get($this->TBL);
		
		return $query->result();
	}

    public function getRecordsTotalCoutnt(){
		
		return $this->db->count_all_results($this->TBL);
		
	}
    public function getRecordsFilteredCount($iSearch=''){
		if(!empty($iSearch)){
			$this->db->where("($iSearch)");
		}
		return $this->db->count_all_results($this->TBL);
		
	}



    public function getPODList($isActive=false){
		$this->db->order_by('name','asc');
		if ($isActive) {
			$this->db->where('isActive',1);
			
		}
		
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $rs;
	}

    public function getListAutoComplete($searchKeword='',$type='',$isActive=false){
		
                    $this->db->select('*');
                    $this->db->from('tbl_port');
                    $this->db->where('name LIKE "%'.$searchKeword.'%"');
                    
                    if($type){
                        $this->db->where('type',$type);
                    }
                    
                    if($isActive){
                        $this->db->where('isActive',$isActive);
                    }
                    
                    $this->db->limit(10);
                    $query = $this->db->get();
                    return $query->result();
	}
	
	public function getPOLList($isActive=false){
		$this->db->order_by('created_at','DESC');
		if ($isActive) {
			$this->db->where('isActive',1);
			
		}
		$this->db->where('isFor',1);
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $rs;
	}

	public function getPortListFor($isFor){
		$this->db->order_by('created_at','DESC');
		if ($isFor == 'loading') {
			$this->db->where('isFor',1);
			$this->db->or_where('isFor',3);
		}
		elseif ($isFor == 'discharge') {
			$this->db->where('isFor',2);
			$this->db->or_where('isFor',3);
		}

		$this->db->where('isActive',1);
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $rs;
	}
	public function getPortList($isActive){
		$this->db->order_by('name');
		if ($isActive) {
			$this->db->where('isActive',1);
			
		}
		
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
			array_push($rs, $row);
		}
		return $rs;
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
        
         public function portExist($name,$iso_country,$type){
            $this->db->select('id, name, municipality, iso_country');
            $this->db->where('name',$name);
            $this->db->where('type',$type);
            $this->db->where('iso_country',$iso_country);
            $query=$this->db->get($this->TBL);
             $result =  $query->row();
             return $result;
             
        }
        
        
 


}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsEvents_model extends CI_Model{

	private $TBL='tbl_news_events';

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

	public function getRecord($type='News',$id){

		$this->db->where('id',$id);
		$this->db->where('type',$type);
		$query = $this->db->get($this->TBL);
		return $query->row();
	}


	public function getNewsEvents($type='News',$limit='',$start=0,$iSearch='',$filter=array(),$orderBy='id desc'){
		$this->db->select("*, DATE_FORMAT(date,'".MYSQL_SELECT_DATE_FORMAT."') as date,DATE_FORMAT(created_at,'".MYSQL_SELECT_DATE_FORMAT."') as created_at");
		$this->db->order_by($orderBy);
		$this->db->where('deleted_at',null);
		$this->db->where('type',$type);
		if($limit){
			$this->db->limit($limit,$start);
		}
		if(isset($filter['status'])){
			if(strlen($filter['status'])){
				$this->db->where('status',$filter['status']);
			}
		}

		if(!empty($iSearch)){
			$this->db->where("($iSearch)");
		}
		
		$query = $this->db->get($this->TBL);
		return $query->result();
	}

	public function getRecordsTotalCoutnt($type='News'){
		
		$this->db->where('deleted_at',null);
		$this->db->where('type',$type);
		return $this->db->count_all_results($this->TBL);
		
	}

	public function getRecordsFilteredCount($type='News',$iSearch='',$filter=array()){
		$this->db->where('deleted_at',null);
		$this->db->where('type',$type);
		if(!empty($iSearch)){
			$this->db->where("($iSearch)");
		}
		return $this->db->count_all_results($this->TBL);
		
	}

}
?>

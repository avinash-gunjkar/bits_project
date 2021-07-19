<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model{

	private $TBL='tbl_company';

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
		return $query->row();
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

    public function getList($role='',$isActive=false){
		$this->db->order_by('name','ASC');
		if ($isActive) {
			$this->db->where('isActive',1);
		}
		if ($role) {
			$this->db->where('role',$role);
		}
		$query = $this->db->get($this->TBL);
		$rs=array();
		foreach ($query->result_array() as $row){
                    $row['gst_tax_doc_details'] = $this->getCompanyKYC($row['id'],$type=5);
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
        
        public function insertIndustryTypes($company_id,$arr_industry_types){
            //delete old
            $this->db->delete('tbl_company_mapp_industry_type', array('company_id' => $company_id));
            //insert new
            foreach ($arr_industry_types as $item){
                $data = array();
                $data['company_id'] = $company_id;
                $data['industry_type_id'] = $item;
                $lastinsertRecord = $this->db->insert('tbl_company_mapp_industry_type',$data);
            }
            return $lastinsertRecord?true:false;
        }
        public function insertSectors($company_id,$arr_sectors){
            //delete old
            $this->db->delete('tbl_company_mapp_industry_sector', array('company_id' => $company_id));
            //insert new
            foreach ($arr_sectors as $item){
                $data = array();
                $data['company_id'] = $company_id;
                $data['sector_id'] = $item;
                $lastinsertRecord = $this->db->insert('tbl_company_mapp_industry_sector',$data);
            }
            return $lastinsertRecord?true:false;
        }
        
        public function getKycDocumentList($filter=array()){

        $this->db->select("t1.*,t2.id as document_id,t2.number as document_number,t2.file as document_file,t2.original_file_name, t2.status as document_status,t3.name as document_name");
		$this->db->from("tbl_company as t1");
		$this->db->join('tbl_company_mapp_documents as t2', 't1.id = t2.company_id');
		$this->db->join('tbl_document as t3', 't2.type = t3.id','left');
		if($filter['company_name']){
			$this->db->where("t1.name like '%".$filter['company_name']."%'");
		}
		if(isset($filter['status']) && $filter['status']!=''){
			$this->db->where("t2.status",$filter['status']);
		}
		$query = $this->db->get();
	
		
		return $query->result();
        }
        
        function getCompanyKYC($company_id,$type)
	{
		$this->db->select("*");
		$this->db->from("tbl_company_mapp_documents");
		$this->db->where('company_id',$company_id);
		$this->db->where('type',$type);
		$query = $this->db->get();
		return array_pop($query->result());
		
	}
        
        public function updateKycStatus($id,$data){
            $this->db->where('id', $id);
		if($this->db->update('tbl_company_mapp_documents', $data)){
			return true;
		}else{
			return false;
		}
        }
 


}

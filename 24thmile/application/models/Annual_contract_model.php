<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annual_contract_model extends CI_Model{

	private $TBL='tbl_annual_contract';

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

	public function getDetails($id,$company_id,$mode='',$filter=[]){
		$this->db->select("$this->TBL.*,tbl_annual_contract_mapp_ff.ff_company_id,tbl_annual_contract_status.title as fs_contract_status_title,ff_contract_status.title as ff_contract_status_title,tbl_annual_contract_mapp_ff.comment as correction,tbl_annual_contract_mapp_ff.accept_terms_and_conditions,tbl_annual_contract_mapp_ff.quote_status");
		$this->db->join('tbl_annual_contract_mapp_ff', ' tbl_annual_contract.id = tbl_annual_contract_mapp_ff.annual_contract_id','left');
		$this->db->join('tbl_annual_contract_status', ' tbl_annual_contract.status = tbl_annual_contract_status.id','left');
		$this->db->join('tbl_annual_contract_status as ff_contract_status', ' tbl_annual_contract_mapp_ff.quote_status = ff_contract_status.id','left');
		$this->db->where("$this->TBL.id", $id);
		$this->db->where("(tbl_annual_contract_mapp_ff.ff_company_id = $company_id OR tbl_annual_contract.fs_company_id = $company_id )");
		$query = $this->db->get($this->TBL);
		// echo $this->db->last_query();die;
		$result = $query->row();

		if($result){
			$this->load->model('annual_contract_route_model');
			$result->routes = $this->annual_contract_route_model->getList($id,$result->ff_company_id,$mode,$filter);
		}
		return $result;
	}
	public function getComparativeDetails($id,$company_id,$mode_id,$filter=[]){
		$this->load->model('annual_contract_route_model');

		$this->db->select("$this->TBL.*,tbl_annual_contract_mapp_ff.ff_company_id,tbl_annual_contract_status.title as fs_contract_status_title,ff_contract_status.title as ff_contract_status_title,tbl_annual_contract_mapp_ff.comment as correction,tbl_annual_contract_mapp_ff.accept_terms_and_conditions,tbl_annual_contract_mapp_ff.quote_status");
		$this->db->join('tbl_annual_contract_mapp_ff', ' tbl_annual_contract.id = tbl_annual_contract_mapp_ff.annual_contract_id');
		$this->db->join('tbl_annual_contract_status', ' tbl_annual_contract.status = tbl_annual_contract_status.id','left');
		$this->db->join('tbl_annual_contract_status as ff_contract_status', ' tbl_annual_contract_mapp_ff.quote_status = ff_contract_status.id','left');
		$this->db->where("$this->TBL.id", $id);
		$this->db->where("tbl_annual_contract.fs_company_id = $company_id");
		$query = $this->db->get($this->TBL);
		// echo $this->db->last_query();die;
		$result = $query->row();

		
		if($result){
			
			$result->routes = $this->annual_contract_route_model->getComparativeList($id,$mode_id,$filter);
		}
		// vdebug($result);
		return $result;
	}


	public function getServiceProviderList($annualContractId='',$company_id,$filter=[]){
		$currentDate = date('Y-m-d');
		$this->db->select("tbl_annual_contract_routes.*,tbl_annual_contract_mapp_ff.ff_company_id,tbl_company.name as ff_company_name,tbl_annual_contract_status.title as fs_contract_status_title,ff_contract_status.title as ff_contract_status_title,tbl_annual_contract_mapp_ff.comment as correction,tbl_annual_contract_mapp_ff.accept_terms_and_conditions,tbl_annual_contract_mapp_ff.quote_status,tbl_annual_contract_mapp_ff.awarded_contract_dt,tbl_shipment.type as shipment,tbl_mode.type as mode");
		$this->db->join('tbl_annual_contract_mapp_ff', ' tbl_annual_contract.id = tbl_annual_contract_mapp_ff.annual_contract_id');
		$this->db->join('tbl_annual_contract_routes', ' tbl_annual_contract_routes.annual_contract_id = tbl_annual_contract_mapp_ff.annual_contract_id');
		$this->db->join('tbl_annual_contract_status', ' tbl_annual_contract.status = tbl_annual_contract_status.id','left');
		$this->db->join('tbl_annual_contract_status as ff_contract_status', ' tbl_annual_contract_mapp_ff.quote_status = ff_contract_status.id','left');
		$this->db->join('tbl_company', 'tbl_annual_contract_mapp_ff.ff_company_id = tbl_company.id');
		$this->db->join('tbl_shipment', "tbl_shipment.id = tbl_annual_contract_routes.shipment_id", 'left');
		$this->db->join('tbl_mode', "tbl_mode.id = tbl_annual_contract_routes.mode_id", 'left');
		if($annualContractId){
			$this->db->where("$this->TBL.id", $annualContractId);
			$this->db->group_by('tbl_annual_contract_mapp_ff.ff_company_id');
		}

		if(isset($filter['mode_id'])){
			$this->db->where("tbl_annual_contract_routes.mode_id", $filter['mode_id']);
		}
		if(isset($filter['transaction'])){
			$this->db->where("tbl_annual_contract_routes.transaction", $filter['transaction']);
		}
		if(isset($filter['awarded_contract_dt'])){
			$this->db->where("tbl_annual_contract_mapp_ff.awarded_contract_dt IS NOT NULL");
		}
		if(isset($filter['shipment_id'])){
			$this->db->where("tbl_annual_contract_routes.shipment_id", $filter['shipment_id']);
		}
		if(isset($filter['container_stuffing'])){
			$this->db->where("tbl_annual_contract_routes.container_stuffing", $filter['container_stuffing']);
		}
		if(isset($filter['cargo_status'])){
			$this->db->where("tbl_annual_contract_routes.cargo_status", $filter['cargo_status']);
		}
		if(isset($filter['checkAnnualContractDate'])){
			//check annual contract is not expired.
			$this->db->where("tbl_annual_contract.start_date <= '$currentDate' AND  tbl_annual_contract.end_date >= '$currentDate'");
	
		}

		$this->db->where("tbl_annual_contract.fs_company_id = $company_id");

		//check annual contract is deleted
		$this->db->where('tbl_annual_contract.deleted_at IS NULL');

			
		$query = $this->db->get($this->TBL);
		
		$result = $query->result();
		return $result;
	}

	

	public function delete($id){
		return	$this->db->delete($this->TBL, array('id' => $id));
	}
	public function deleteAnnualContract($id,$company_id){
		$this->db->where('id', $id);
		$this->db->where('fs_company_id', $company_id);
		if($this->db->update($this->TBL, ['deleted_at'=>date('Y-m-d H:i:s')])){
			return true;
		}else{
			return false;
		}
	}

	public function get_annual_contract_list($company_id='',$start=0,$length=-1,$filter=array(),$searchKey='',$order_by='tbl_annual_contract.created_at DESC'){
		{
        
			$this->db->select('tbl_annual_contract.annual_contract_title,DATE_FORMAT(tbl_annual_contract.created_at,"%d-%b-%Y") AS create_date,tbl_annual_contract.id as annual_contract_id,DATE_FORMAT(tbl_annual_contract.start_date,"%d-%b-%Y") AS start_date,DATE_FORMAT(tbl_annual_contract.end_date,"%d-%b-%Y") AS end_date,tbl_annual_contract.status,tbl_annual_contract_status.title as fs_contract_status_title,ff_contract_status.title as ff_contract_status_title,tbl_annual_contract_mapp_ff.quote_status');
			$this->db->from('tbl_annual_contract');
			$this->db->join('tbl_annual_contract_mapp_ff', ' tbl_annual_contract.id = tbl_annual_contract_mapp_ff.annual_contract_id','left');
			$this->db->join('tbl_annual_contract_status', ' tbl_annual_contract.status = tbl_annual_contract_status.id','left');
			$this->db->join('tbl_annual_contract_status as ff_contract_status', ' tbl_annual_contract_mapp_ff.quote_status = ff_contract_status.id','left');
			$this->db->order_by($order_by);
			
			$this->db->group_by('tbl_annual_contract.id');
	
			if(!empty($company_id)){
				$this->db->where("(tbl_annual_contract_mapp_ff.ff_company_id = $company_id OR tbl_annual_contract.fs_company_id = $company_id )");
			}
			
	
			$filter = array_filter($filter);
		//    if(isset($filter['quote_status'])){
		// 	//    $this->db->where_in('tbl_seller_requirement_mapp_ff.quote_status', ['1', '2', '3', '4', '6', '7', '8']);
		// 	   $this->db->where_in('tbl_seller_requirement_mapp_ff.quote_status', $filter['quote_status']);
		//    }
	
		//    if(isset($filter['status'])){
		// 		// $this->db->where_in('tbl_seller_requirement.status', ['1', '2', '3', '4', '7', '8']);
		// 		$this->db->where_in('tbl_seller_requirement.status', $filter['status']);
		// 	}
	
			$this->db->where('tbl_annual_contract.deleted_at IS NULL');
	
			$totalCount_obj = clone $this->db;
			$recordsTotal = $totalCount_obj->count_all_results();
	
	
			// if(isset($filter['mode_id'])){
			// 	$this->db->where('tbl_seller_requirement.mode_id',$filter['mode_id']);
			// }
	
			// if(isset($filter['transaction'])){
			// 	$this->db->where('tbl_seller_requirement.transaction',$filter['transaction']);
			// }
	
			// if(isset($filter['delivery_term_id'])){
			// 	$this->db->where('tbl_seller_requirement.delivery_term_id',$filter['delivery_term_id']);
			// }
			// if(isset($filter['shipment_id'])){
			// 	$this->db->where('tbl_seller_requirement.shipment_id',$filter['shipment_id']);
			// }
	
			
	
			if(isset($filter['fromDate']) && isset($filter['toDate'])){
				if(!empty($filter['fromDate']) && !empty($filter['toDate'])){
					$fromDate = getMysqlDateFormat($filter['fromDate']);
					$toDate = getMysqlDateFormat($filter['toDate']);
					$this->db->where("CAST(tbl_seller_requirement.created_at AS DATE) BETWEEN '$fromDate' AND '$toDate' ");
				}
			}
	
			if(!empty($searchKey)){
				$this->db->where("($searchKey)");
			}
	
			$totalFilteredCount_obj = clone $this->db;
			$recordsFiltered = $totalFilteredCount_obj->count_all_results();
			
			if($length>0){
				$this->db->limit($length,$start);
			}
			$query = $this->db->get();
			
			$result = $query->result();
			
			// echo $this->db->last_query();die;
			return ['recordsTotal'=>$recordsTotal,'recordsFiltered'=>$recordsFiltered,'data'=>$result];
		}
	}

}

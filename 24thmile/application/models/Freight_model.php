<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Freight_model extends CI_Model
{

    private $TBL = 'tbl_freight_template';

    function __construct()
    {
        parent::__construct();
        $this->load->model('annual_contract_route_rfc_charges_model');
    }

    public function insert($data)
    {
        if ($this->db->insert($this->TBL, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update($this->TBL, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getRecord($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->TBL);
        $row = array();
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
        }
        return $row;
    }

    public function delete($id)
    {
        return    $this->db->delete($this->TBL, array('id' => $id));
    }

    public function exist($id)
    {
        $this->db->select('COUNT(*) AS CNT');
        $this->db->where('id', $id);
        $query = $this->db->get($this->TBL);

        if ($query->num_rows() > 0) {
            if ($query->row()->CNT > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getList($isActive = false)
    {
        $this->db->order_by('created_at', 'asc');
        if ($isActive) {
            $this->db->where('isActive', 1);
        }
        $query = $this->db->get($this->TBL);
        $rs = array();
        foreach ($query->result_array() as $row) {
            array_push($rs, $row);
        }
        return $rs;
    }


    public function getFreightTemplateList($template_id)
    {
        $this->db->select('*');
        // $this->db->order_by('created_at','asc');
        $this->db->from('tbl_freight_template');
        $this->db->join('tbl_export_comparative_template', 'tbl_export_comparative_template.id = tbl_freight_template.particular_id', 'left');
        $this->db->join('tbl_container', 'tbl_container.id = tbl_freight_template.container_id', 'left');
        $this->db->join('tbl_rfc_category', 'tbl_rfc_category.id = tbl_freight_template.rfc_category_id', 'left');
        $this->db->where('template_id', $template_id);
        $query = $this->db->get();

        // echo $this->db->last_query();die;
        $rs = array();
        foreach ($query->result_array() as $row) {
            array_push($rs, $row);
        }
        return $rs;
    }


    public function getTemplateListByParticulars()
    {
        $this->db->select('*');
        $this->db->group_by('template_id');
        $this->db->from('tbl_freight_template AS tbl_freight_template');
        $this->db->join('tbl_container', 'tbl_container.id = tbl_freight_template.container_id', 'left');
        $this->db->join('tbl_export_comparative_template', 'tbl_export_comparative_template.id = tbl_freight_template.particular_id', 'left');
        $this->db->join('tbl_sector', 'tbl_sector.id = tbl_freight_template.sector_id', 'left');
        $query = $this->db->get();
        // echo $this->db->last_query();
        $rs = array();
        foreach ($query->result_array() as $row) {
            array_push($rs, $row);
        }
        return $rs;
    }



    public function getListBetween($unix_start_date, $unix_end_date)
    {
        $this->db->where('created_at =', $unix_start_date);
        $this->db->where('created_at <', $unix_end_date);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get($this->TBL);
        $rs = array();
        foreach ($query->result_array() as $row) {
            array_push($rs, $row);
        }
        return $rs;
    }

    public function getRequirmentList($company_id)
    {
        $this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as request_id,tbl_shipment.type as shipment,tbl_deliver_term.name as delivery_term_name,tbl_mode.type as mode,tbl_seller_requirement_mapp_ff.quote_status,t5.title as quote_status_title, tbl_seller_requirement_mapp_ff.quote_submit_dt, tbl_field_shipment_status.title as status_title');
        $this->db->from('tbl_seller_requirement');
        $this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.delivery_term_id', 'left');
        $this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
        $this->db->join('tbl_field_shipment_status', 'tbl_field_shipment_status.id = tbl_seller_requirement.status', 'left');
        $this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'right');
        $this->db->join('tbl_seller_requirement_mapp_ff', ' tbl_seller_requirement.id = tbl_seller_requirement_mapp_ff.request_id');
        $this->db->join('tbl_field_ff_shipment_status as t5', 't5.id = tbl_seller_requirement_mapp_ff.quote_status', 'left');
        $this->db->where('tbl_seller_requirement_mapp_ff.ff_company_id', $company_id);
        $this->db->where_in('tbl_seller_requirement_mapp_ff.quote_status', ['1', '2', '3', '4', '6', '7', '8']);
        $this->db->order_by('tbl_seller_requirement.created_at', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }

    public function get_rfc_list($company_id='',$start=0,$length=-1,$filter=array(),$searchKey='',$order_by='tbl_seller_requirement.created_at DESC')
    {
        
        $this->db->select('tbl_seller_requirement.*,DATE_FORMAT(tbl_seller_requirement.created_at,"%d-%b-%Y") AS rfc_date,tbl_seller_requirement.id as request_id,tbl_shipment.type as shipment,tbl_deliver_term.name as delivery_term_name,tbl_mode.type as mode,tbl_seller_requirement_mapp_ff.quote_status,t5.title as quote_status_title, tbl_seller_requirement_mapp_ff.quote_submit_dt, tbl_field_shipment_status.title as status_title,tbl_seller_requirement_mapp_ff.annual_contract_id,tbl_seller_requirement_mapp_ff.annual_contract_route_id');
        $this->db->from('tbl_seller_requirement');
        $this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.delivery_term_id', 'left');
        $this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
        $this->db->join('tbl_field_shipment_status', 'tbl_field_shipment_status.id = tbl_seller_requirement.status', 'left');
        $this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'right');
        $this->db->join('tbl_seller_requirement_mapp_ff', ' tbl_seller_requirement.id = tbl_seller_requirement_mapp_ff.request_id','left');
        $this->db->join('tbl_field_ff_shipment_status as t5', 't5.id = tbl_seller_requirement_mapp_ff.quote_status', 'left');
        $this->db->order_by($order_by);
        $this->db->group_by('tbl_seller_requirement.id');

        if(!empty($company_id)){
            $this->db->where("(tbl_seller_requirement_mapp_ff.ff_company_id = $company_id OR tbl_seller_requirement.fs_company_id = $company_id )");
        }

        $filter = array_filter($filter);
       if(isset($filter['quote_status'])){
        //    $this->db->where_in('tbl_seller_requirement_mapp_ff.quote_status', ['1', '2', '3', '4', '6', '7', '8']);
           $this->db->where_in('tbl_seller_requirement_mapp_ff.quote_status', $filter['quote_status']);
       }

       if(isset($filter['status'])){
            // $this->db->where_in('tbl_seller_requirement.status', ['1', '2', '3', '4', '7', '8']);
            $this->db->where_in('tbl_seller_requirement.status', $filter['status']);
        }

        $this->db->where('tbl_seller_requirement.deleted_at IS NULL');

        $totalCount_obj = clone $this->db;
        $recordsTotal = $totalCount_obj->count_all_results();


        if(isset($filter['mode_id'])){
            $this->db->where('tbl_seller_requirement.mode_id',$filter['mode_id']);
        }

        if(isset($filter['transaction'])){
            $this->db->where('tbl_seller_requirement.transaction',$filter['transaction']);
        }

        if(isset($filter['delivery_term_id'])){
            $this->db->where('tbl_seller_requirement.delivery_term_id',$filter['delivery_term_id']);
        }
        if(isset($filter['shipment_id'])){
            $this->db->where('tbl_seller_requirement.shipment_id',$filter['shipment_id']);
        }

        

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
// echo $searchKey;die;
        $totalFilteredCount_obj = clone $this->db;
        $recordsFiltered = $totalFilteredCount_obj->count_all_results();
        
        if($length>0){
            $this->db->limit($length,$start);
        }
        $query = $this->db->get();
        
        $result = $query->result();
        foreach($result as $key=>$item){
            $result[$key]->totalGW = $this->getTotalGrossWeight($item->id,$item->shipment_id == 1 ? 'container' : 'package');
            $requestCount =  $this->getRequestQuoteCount($item->id);
            $result[$key]->requestCount = $requestCount->quote_count . '/' . $requestCount->request_count;
            $result[$key]->trackingSteps = count($this->getCompletedStep($item->transaction, $item->request_id)) . '/' . count($this->getSPSteps($item->transaction, $item->mode_id, $item->shipment_id, $item->delivery_term_id));
            $currentStep = $this->getCurrentStep($item->transaction, $item->request_id);
            $result[$key]->currentStep = $currentStep;
            $result[$key]->tracking_status_title = $currentStep->tracking_status_title?$currentStep->tracking_status_title:'At Origin';
            $result[$key]->skipComparative = true;
            $result[$key]->role = $filter['role'];
            if (in_array($item->status, ['2','3', '4', '5', '6', '7', '8']) && $filter['role']=='2') {
                $result[$key]->skipComparative = ($item->delivery_term_id == 1 && $item->transaction == 'Export') || (in_array($item->delivery_term_id, ['5', '6', '7']) && $item->transaction == 'Import');
            }

        }
        // echo $this->db->last_query();die;
        return ['recordsTotal'=>$recordsTotal,'recordsFiltered'=>$recordsFiltered,'data'=>$result];
    }
    function getTotalGrossWeight($requets_id, $itemType)
	{
		$this->db->select('SUM(gross_weight * number_of_container) as totalGrossWeight');
		$this->db->from('tbl_seller_requirement_mapp_items');
		$this->db->where('request_id', $requets_id);
		$this->db->where('item_type', $itemType);
		$query = $this->db->get();
		$result =  $query->row();
		return $result->totalGrossWeight;
    }
    function getRequestQuoteCount($request_id)
	{
		$this->db->select('COUNT(request_id) as request_count, COUNT(IF(`quote_status`  IN ("1","3","4","5","6","7","8","9"),1, NULL)) as quote_count');
		$this->db->from('tbl_seller_requirement_mapp_ff');
		$this->db->where('request_id', $request_id);
		$query = $this->db->get();
		return $query->row();
	}

    // public function get_rfc_list_totalCount($company_id='',$filter=array()){
    //     $this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as request_id,tbl_shipment.type as shipment,tbl_deliver_term.name as delivery_term_name,tbl_mode.type as mode,tbl_seller_requirement_mapp_ff.quote_status,t5.title as quote_status_title, tbl_seller_requirement_mapp_ff.quote_submit_dt, tbl_field_shipment_status.title as status_title');

    //     $this->db->from('tbl_seller_requirement');
    //     $this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.delivery_term_id', 'left');
    //     $this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
    //     $this->db->join('tbl_field_shipment_status', 'tbl_field_shipment_status.id = tbl_seller_requirement.status', 'left');
    //     $this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'right');
    //     $this->db->join('tbl_seller_requirement_mapp_ff', ' tbl_seller_requirement.id = tbl_seller_requirement_mapp_ff.request_id');
    //     $this->db->join('tbl_field_ff_shipment_status as t5', 't5.id = tbl_seller_requirement_mapp_ff.quote_status', 'left');
    //     $this->db->order_by('tbl_seller_requirement.created_at', 'DESC');
    //     $this->db->group_by('tbl_seller_requirement.id');

    //     if(!empty($company_id)){
    //         $this->db->where("(tbl_seller_requirement_mapp_ff.ff_company_id = $company_id OR tbl_seller_requirement.fs_company_id = $company_id )");
    //     }

    //    if(isset($filter['quote_status'])){
    //     //    $this->db->where_in('tbl_seller_requirement_mapp_ff.quote_status', ['1', '2', '3', '4', '6', '7', '8']);
    //        $this->db->where_in('tbl_seller_requirement_mapp_ff.quote_status', $filter['quote_status']);
    //    }

    //    if(isset($filter['status'])){
    //         // $this->db->where_in('tbl_seller_requirement.status', ['1', '2', '3', '4', '7', '8']);
    //         $this->db->where_in('tbl_seller_requirement.status', $filter['status']);
    //     }
    // }
    
    // public function get_rfc_list_filteredCount($company_id='',$filter=array(),$searchKey=''){
    //     $this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as request_id,tbl_shipment.type as shipment,tbl_deliver_term.name as delivery_term_name,tbl_mode.type as mode,tbl_seller_requirement_mapp_ff.quote_status,t5.title as quote_status_title, tbl_seller_requirement_mapp_ff.quote_submit_dt, tbl_field_shipment_status.title as status_title');

    //     $this->db->from('tbl_seller_requirement');
    //     $this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.delivery_term_id', 'left');
    //     $this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
    //     $this->db->join('tbl_field_shipment_status', 'tbl_field_shipment_status.id = tbl_seller_requirement.status', 'left');
    //     $this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'right');
    //     $this->db->join('tbl_seller_requirement_mapp_ff', ' tbl_seller_requirement.id = tbl_seller_requirement_mapp_ff.request_id');
    //     $this->db->join('tbl_field_ff_shipment_status as t5', 't5.id = tbl_seller_requirement_mapp_ff.quote_status', 'left');
    //     $this->db->order_by('tbl_seller_requirement.created_at', 'DESC');
    //     $this->db->group_by('tbl_seller_requirement.id');

    //     if(!empty($company_id)){
    //         $this->db->where("(tbl_seller_requirement_mapp_ff.ff_company_id = $company_id OR tbl_seller_requirement.fs_company_id = $company_id )");
    //     }

    //    if(isset($filter['quote_status'])){
    //     //    $this->db->where_in('tbl_seller_requirement_mapp_ff.quote_status', ['1', '2', '3', '4', '6', '7', '8']);
    //        $this->db->where_in('tbl_seller_requirement_mapp_ff.quote_status', $filter['quote_status']);
    //    }

    //    if(isset($filter['status'])){
    //         // $this->db->where_in('tbl_seller_requirement.status', ['1', '2', '3', '4', '7', '8']);
    //         $this->db->where_in('tbl_seller_requirement.status', $filter['status']);
    //     }
    // }


    public function getNumberOfRequests($company_id)
    {
        $this->db->select('COUNT(t1.id) as request_count, 
						COUNT(IF(t1.shipment_id="2",1, NULL)) as lcl_count,
						COUNT(IF(t1.shipment_id="2" AND t2.quote_status IN(1,2,3,4,6,7,8),1, NULL)) as lcl_inquiry_count,
						COUNT(IF(t1.shipment_id="2" AND t2.quote_status IN(5,9),1, NULL)) as lcl_booking_count,
						COUNT(IF(t1.shipment_id="1",1, NULL)) as fcl_count,
						COUNT(IF(t1.shipment_id="1" AND t2.quote_status IN(1,2,3,4,6,7,8),1, NULL)) as fcl_inquiry_count,
						COUNT(IF(t1.shipment_id="1" AND t2.quote_status IN(5,9),1, NULL)) as fcl_booking_count,
						COUNT(IF(t1.mode_id="3",1, NULL)) as sea_count,
						COUNT(IF(t1.mode_id="3" AND t2.quote_status IN(1,2,3,4,6,7,8),1, NULL)) as sea_inquiry_count,
						COUNT(IF(t1.mode_id="3" AND t2.quote_status IN(5,9),1, NULL)) as sea_booking_count,
						COUNT(IF(t1.mode_id="2",1, NULL)) as air_count,
						COUNT(IF(t1.mode_id="2" AND t2.quote_status IN(1,2,3,4,6,7,8),1, NULL)) as air_inquiry_count,
						COUNT(IF(t1.mode_id="2" AND t2.quote_status IN(5,9),1, NULL)) as air_booking_count,
						COUNT(IF(t1.mode_id="1" AND t2.quote_status IN(1,2,3,4,6,7,8),1, NULL)) as road_inquiry_count,
						COUNT(IF(t1.mode_id="1" AND t2.quote_status IN(5,9),1, NULL)) as road_booking_count,
						COUNT(IF(t1.mode_id="1",1, NULL)) as road_count');
        $this->db->from('tbl_seller_requirement as t1');
        $this->db->join('tbl_seller_requirement_mapp_ff as t2', ' t1.id = t2.request_id');
        $this->db->where('t2.ff_company_id', $company_id);
        $this->db->where('t1.deleted_at IS NULL');
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->row();
    }
    public function getNumberOfAwardedRequests($company_id)
    {
        $this->db->select('COUNT(t1.id) as request_count, COUNT(IF(t1.shipment_id="2",1, NULL)) as lcl_count,COUNT(IF(t1.shipment_id="1",1, NULL)) as fcl_count, COUNT(IF(t1.mode_id="3",1, NULL)) as sea_count, COUNT(IF(t1.mode_id="2",1, NULL)) as air_count, COUNT(IF(t1.mode_id="1",1, NULL)) as road_count');
        $this->db->from('tbl_seller_requirement as t1');
        $this->db->join('tbl_seller_requirement_mapp_ff as t2', ' t1.id = t2.request_id');
        $this->db->where('t2.ff_company_id', $company_id);
        $this->db->where('t1.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->row();
    }

    public function getNewInquireCount($company_id)
    {
        $this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
        $this->db->from('tbl_seller_requirement as t1');
        $this->db->join('tbl_seller_requirement_mapp_ff as t2', ' t1.id = t2.request_id');
        $this->db->where('t2.ff_company_id', $company_id);
        $this->db->where_in('t2.quote_status', ['2', '3']);
        $this->db->where('t1.deleted_at IS NULL');
        $query = $this->db->get();

        return $query->row();
    }
    public function getShipmentInProcessCount($company_id)
    {
        $this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
        $this->db->from('tbl_seller_requirement as t1');
        $this->db->join('tbl_seller_requirement_mapp_ff as t2', ' t1.id = t2.request_id');
        $this->db->where('t1.selected_ff_company_id', $company_id);
        $this->db->where_in('t2.quote_status', ['5', '9']);
        $this->db->where('t1.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->row();
    }
    public function getCompletedShipmentCount($company_id)
    {
        $this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
        $this->db->from('tbl_seller_requirement as t1');
        $this->db->join('tbl_seller_requirement_mapp_ff as t2', ' t1.id = t2.request_id');
        $this->db->where('t1.selected_ff_company_id', $company_id);
        $this->db->where_in('t2.quote_status', ['9']);
        $this->db->where('t1.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->row();
    }
    public function getCompletedShipmentPaymentPendingCount($company_id)
    {
        $this->db->select('COUNT(IF(t1.transaction="Export",1, NULL)) as export,COUNT(IF(t1.transaction="Import",1, NULL)) as import');
        $this->db->from('tbl_seller_requirement as t1');
        $this->db->join('tbl_seller_requirement_mapp_ff as t2', ' t1.id = t2.request_id');
        $this->db->where('t1.selected_ff_company_id', $company_id);
        $this->db->where('t1.bill_amount_received', '1');
        $this->db->where('t1.deleted_at IS NULL');
        $this->db->where_in('t2.quote_status', ['9']);
        $query = $this->db->get();
        return $query->row();
    }

    function getReportList($company_id, $transaction, $fromDate, $toDate)
    {
        $this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as request_id,tbl_shipment.type as shipment,tbl_deliver_term.name as delivery_term_name,tbl_mode.type as mode,tbl_company.name as ff_company_name,tbl_seller_requirement_mapp_ff.total_quote_amount,tbl_seller_requirement_mapp_ff.quote_status,t5.title as quote_status_title');

        $this->db->from('tbl_seller_requirement');
        $this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.delivery_term_id', 'left');
        $this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
        $this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'right');
        $this->db->join('tbl_seller_requirement_mapp_ff', ' tbl_seller_requirement.id = tbl_seller_requirement_mapp_ff.request_id');
        $this->db->join('tbl_company', 'tbl_seller_requirement_mapp_ff.ff_company_id = tbl_company.id', 'left');
        $this->db->join('tbl_field_ff_shipment_status as t5', 't5.id = tbl_seller_requirement_mapp_ff.quote_status', 'left');
        if ($fromDate) {
            $this->db->where(' CAST(tbl_seller_requirement.created_at AS DATE) >=', $fromDate);
        }
        if ($toDate) {
            $this->db->where(' CAST(tbl_seller_requirement.created_at AS DATE) <=', $toDate);
        }
        $this->db->where('tbl_seller_requirement_mapp_ff.ff_company_id', $company_id);
        $this->db->where('tbl_seller_requirement.transaction', $transaction);
        $this->db->where('tbl_seller_requirement.deleted_at IS NULL');
        $this->db->order_by('tbl_seller_requirement.created_at', 'DESC');
        //		$this->db->where_in('tbl_seller_requirement.status', ['new','edited','send_for_quote']);
        $query = $this->db->get();
        //                print_r($this->db->last_query());die;
        $result = $query->result();
		foreach($result as $key=>$item){
			$result[$key]->totalGW = $this->getTotalGrossWeight($item->id,$item->shipment_id == 1 ? 'container' : 'package');
			$result[$key]->deliverCompletedDate = $this->getDeliveryCompletedDate($item->request_id);
			$currentStep = $this->getCurrentStep($item->transaction, $item->request_id);
			$result[$key]->currentStep = $currentStep;
            $result[$key]->tracking_status_title = $currentStep->tracking_status_title?$currentStep->tracking_status_title:'At Origin';
			$result[$key]->so_number = implode(", ",array_filter($this->getSoNumberList($item->request_id)));
			$result[$key]->so_line_item = implode(", ",array_filter($this->getSoLineItemList($item->request_id)));
           
        }
        return $result;
    }


    public function getRequirmentDetails($request_id, $company_id)
    {
        $this->db->select('t1.*,t1.id as request_id,t3.type as shipment,t2.name as delivery_term_name,t4.type as mode,t5.ff_company_id,t5.quote_status,t5.quote_submit_dt,t5.counter_rate_update_status,t5.counter_rate_update_dt,t5.ff_id,t5.total_quote_amount,t5.counter_rate,t1.port_loading_name as loading_port, t1.port_discharge_name as discharge_port,t5.ff_payment_term,t6.title as status_title,t5.annual_contract_id,t5.annual_contract_route_id');

        $this->db->from('tbl_seller_requirement as t1');
        $this->db->join('tbl_deliver_term as t2', 't2.id = t1.delivery_term_id', 'left');
        $this->db->join('tbl_shipment as t3', 't3.id = t1.shipment_id', 'left');
        $this->db->join('tbl_mode as t4', ' t4.id = t1.mode_id', 'right');
        $this->db->join('tbl_seller_requirement_mapp_ff as t5', ' t1.id = t5.request_id');
        $this->db->join('tbl_field_ff_shipment_status as t6', 't6.id = t5.quote_status', 'left');
        $this->db->where('t5.ff_company_id', $company_id);
        $this->db->where('t5.request_id', $request_id);
        $this->db->where('t1.deleted_at IS NULL');
        $query = $this->db->get();

        $result = $query->row();
        
        if(empty($result)){
            return null;
        }

        $result->package  = [];
        $result->container  = [];
        if ($result->shipment_id == "1") {
            //FCL
            $result->container = $this->getRequirementItems($request_id, 'container');
           // $result->package = $this->getRequirementItems($request_id, 'package');
           
        } else if ($result->shipment_id == "2") {
            //LCL
            $result->package = $this->getRequirementItems($request_id, 'package');
           
        }

        $result->consignor_other = new stdClass();
        $result->consignee_other = new stdClass();
        if ($result->is_other_consignor == 'Yes') {
            $result->consignor_other = $this->checkOtherAddressExist($request_id, 'consignor');
        }

        if ($result->is_other_consignee == 'Yes') {
            $result->consignee_other = $this->checkOtherAddressExist($request_id, 'consignee');
        }


        return $result;
    }



    function checkOtherAddressExist($request_id, $type)
    {
        $this->db->select('*');
        $this->db->from('tbl_seller_requiement_mapp_address');
        $this->db->where('request_id', $request_id);
        $this->db->where('type', $type);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result;
    }

    function getRequirementItems($request_id, $itemType, $parentId=0)
    {
        $this->db->select('t1.*,ROUND((t1.length*t1.width*t1.height)/1000000,3) as volume,ROUND((t1.length*t1.width*t1.height)/5000,1) as volumetric_weight,
        t3.type as container_type_name,t3.description as containerDesc,t4.type as type_of_packing_name,t5.size as container_size_title');
        //            $this->db->select('t1.*');
        $this->db->from('tbl_seller_requirement_mapp_items as t1');
        // $this->db->join('tbl_seller_requirement_items_mapp_ff_rate as t2', 't1.id = t2.request_item_id AND t2.ff_id = '.$ff_id,'left');
        $this->db->join('tbl_container as t3', 't1.container_type = t3.id', 'left');
        $this->db->join('tbl_packing as t4', 't1.type_of_packing = t4.id', 'left');
        $this->db->join('tbl_container_size as t5', 't1.container_size = t5.id', 'left');
        $this->db->where('t1.request_id', $request_id);
		$this->db->where('t1.parent_id', $parentId);
        $this->db->where('t1.item_type', $itemType);
        //            $this->db->where('t2.ff_id', $ff_id);
       $query = $this->db->get();
		$result = [];
			foreach($query->result() as $rowItem){

				if($this->isExistContainerPackage($rowItem->id)){
					$rowItem->package = $this->getRequirementItems($request_id,'package',$rowItem->id);
				}
				$result[]=$rowItem;
            }
            return $result; 
    }

    function isExistContainerPackage($parentId){
		$this->db->select('id');
		$this->db->from('tbl_seller_requirement_mapp_items');
		$this->db->where('parent_id', $parentId);
		$query = $this->db->get();
		$result =$query->row();
		return (bool)$result;
    }
    
    function checkItemRateExist($request_id, $item_id, $ff_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_seller_requirement_items_mapp_ff_rate');
        $this->db->where('request_id', $request_id);
        $this->db->where('request_item_id', $item_id);
        $this->db->where('ff_id', $ff_id);
        $query = $this->db->get();
        return $query->row();
    }

    function insertItemRate($data)
    {
        if ($this->db->insert('tbl_seller_requirement_items_mapp_ff_rate', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    function updateItemRate($id, $data)
    {

        $this->db->where('id', $id);
        if ($this->db->update('tbl_seller_requirement_items_mapp_ff_rate', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function updateQuoteStatus($request_id, $ff_company_id, $data)
    {
        $this->db->where('request_id', $request_id);
        $this->db->where('ff_company_id', $ff_company_id);
        if ($this->db->update('tbl_seller_requirement_mapp_ff', $data)) {
            return true;
        } else {
            return false;
        }
    }
    function updateShipmentStatus($request_id, $data)
    {
        $this->db->where('id', $request_id);

        if ($this->db->update('tbl_seller_requirement', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function updateTotalQuoteAmount($request_id, $ff_company_id, $data)
    {

        //            $totalRfcCharges = $this->getTotalRfcCharges($request_id,$ff_id);
        //            $totalItemRate = $this->getTotalItemRate($request_id,$ff_id);
        //            $total = $totalItemRate + $totalRfcCharges;
        $this->db->where('request_id', $request_id);
        $this->db->where('ff_company_id', $ff_company_id);
        if ($this->db->update('tbl_seller_requirement_mapp_ff', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function getTotalItemRate($request_id, $ff_company_id)
    {
        $this->db->select('SUM(rate) sum');
        $this->db->from('tbl_seller_requirement_items_mapp_ff_rate');
        $this->db->where('request_id', $request_id);
        $this->db->where('ff_company_id', $ff_company_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->sum;
    }
    function getTotalRfcCharges($request_id, $ff_company_id)
    {
        $this->db->select('SUM(charges) sum');
        $this->db->from('tbl_seller_requirement_mapp_rfc_charges');
        $this->db->where('request_id', $request_id);
        $this->db->where('ff_company_id', $ff_company_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->sum;
    }

    function getRfcChargesCategory($requestDetails, $request_id, $ff_company_id, $isComparative = false)
    {

        $this->db->select('*');
        $this->db->from('tbl_rfc_category');
       // $this->db->order_by('FIELD(rfc_category_name, "Pre-carriage","Main-carriage","On-carriage")');
        $query = $this->db->get();
        $rfcCharges = $query->result();

        foreach ($rfcCharges as $key => $category) {
            $rfcCharges[$key]->subCategory = $this->getRfcCharges($requestDetails, $request_id, $ff_company_id, $category->id, $isComparative);
            $rfcCharges[$key]->categoryTotal = $this->getRfcChargesCategoryTotal($requestDetails,$ff_company_id,$category->id,$isComparative);
            $rfcCharges[$key]->otherCharges = $this->getRfcOtherCharges($request_id, $ff_company_id,$category->id);
        }
        
        return $rfcCharges;
    }

    function getRfcCharges($requestDetails, $request_id, $ff_company_id, $rfc_category_id, $isComparative = false)
    {

        if (!$isComparative) {
            $this->db->select('t2.id,t2.rfc_pricing_label_id,t2.rfcChargesTitle,t2.unit,t3.id as ffChargesId,t3.charges,t3.qty,t3.total,t3.item_id,t3.counter_rate');
        } else {
            $this->db->select('t2.id,t2.rfcChargesTitle,t2.unit,t3.id as ffChargesId,t3.total');
        }
        $this->db->from('tbl_rfc_charges as t2');
        //$this->db->join('tbl_rfc_charges as t2', "t1.rfc_charges_id = t2.id",'left');
        if (!$isComparative) {
            $this->db->join('tbl_seller_requirement_mapp_rfc_charges as t3', "t2.id = t3.rfc_charges_id AND t3.request_id=$requestDetails->request_id AND t3.ff_company_id=$ff_company_id", 'left');
        } else {
            $this->db->join('tbl_seller_requirement_mapp_rfc_charges_total as t3', "t2.id = t3.rfc_charges_id AND t3.request_id=$requestDetails->request_id AND t3.ff_company_id=$ff_company_id", 'left');
        }

        $this->db->where('t2.delivery_term_id', $requestDetails->delivery_term_id);
        $this->db->where('t2.transaction', $requestDetails->transaction);
        $this->db->where('t2.mode_id', $requestDetails->mode_id);
        $this->db->where('t2.shipment_id', $requestDetails->shipment_id);
        $this->db->where('t2.rfc_category_id ', $rfc_category_id);
        $query = $this->db->get();
        // print_r($this->db->last_query());die;
        return $query->result();
    }

    function getRfcChargesCategoryTotal($requestDetails,$ff_company_id,$rfc_category_id,$isComparative = false){
        if (!$isComparative) {
            $this->db->select('SUM(t3.total) as total');
        } else {
            $this->db->select('SUM(t3.total) as total');
        }
        $this->db->from('tbl_rfc_charges as t2');
        //$this->db->join('tbl_rfc_charges as t2', "t1.rfc_charges_id = t2.id",'left');
        if (!$isComparative) {
            $this->db->join('tbl_seller_requirement_mapp_rfc_charges as t3', "t2.id = t3.rfc_charges_id AND t3.request_id=$requestDetails->request_id AND t3.ff_company_id=$ff_company_id", 'left');
        } else {
            $this->db->join('tbl_seller_requirement_mapp_rfc_charges_total as t3', "t2.id = t3.rfc_charges_id AND t3.request_id=$requestDetails->request_id AND t3.ff_company_id=$ff_company_id", 'left');
        }

        $this->db->where('t2.delivery_term_id', $requestDetails->delivery_term_id);
        $this->db->where('t2.transaction', $requestDetails->transaction);
        $this->db->where('t2.mode_id', $requestDetails->mode_id);
        $this->db->where('t2.shipment_id', $requestDetails->shipment_id);
        $this->db->where('t2.rfc_category_id ', $rfc_category_id);
        $query = $this->db->get();
        // print_r($this->db->last_query());die;
        $result = $query->row();

        //get other charges total for catagory
        $otherTotal = $this->getRfcCategoryOtherTotal($requestDetails->request_id,$ff_company_id,$rfc_category_id);
        return $result->total + $otherTotal;
    }

    function getAnnualCotntractRfcChargesCategory($route_id='',$ff_company_id='',$mode_id='')
    {

        $this->db->select('*');
        $this->db->from('tbl_rfc_category');
       // $this->db->order_by('FIELD(rfc_category_name, "Pre-carriage","Main-carriage","On-carriage")');
        $query = $this->db->get();
        $rfcCharges = $query->result();

        
        foreach ($rfcCharges as $key => $category) {
            $rfcCharges[$key]->subCategory = $this->getAnnualContractRfcCharges($category->id,$route_id,$ff_company_id,$mode_id);
           $rfcCharges[$key]->categoryTotal = $this->getContractCatgeoryTotalCharges($category->id,$route_id,$ff_company_id,$mode_id);
           $rfcCharges[$key]->categoryTotalCounterOffer = $this->getContractCatgeoryTotalCounterOffer($category->id,$route_id,$ff_company_id,$mode_id);
           // $rfcCharges[$key]->otherCharges = $this->getRfcOtherCharges($request_id, $ff_company_id,$category->id);
           if(in_array($category->id,['1','2','4','5'])){
               $otherCharges = $this->annual_contract_route_rfc_charges_model->getRfcOtherCharges($category->id,$route_id,$ff_company_id);
               $rfcCharges[$key]->other_charges = $otherCharges?$otherCharges->charges:0.00;
               $rfcCharges[$key]->counter_offer = $otherCharges?$otherCharges->counter_offer:0.00;
               $rfcCharges[$key]->categoryTotal = $rfcCharges[$key]->categoryTotal + $rfcCharges[$key]->other_charges;
               $rfcCharges[$key]->categoryTotalCounterOffer = $rfcCharges[$key]->categoryTotalCounterOffer + $rfcCharges[$key]->counter_offer;
             }
        }
        
        
        return $rfcCharges;
    }

    function getAnnualContractRfcCharges($rfc_category_id,$route_id,$ff_company_id,$mode_id)
    {

        // if (!$isComparative) {
        //     $this->db->select('t2.id,t2.rfcChargesTitle,t2.unit,t3.id as ffChargesId,t3.charges,t3.qty,t3.total,t3.item_id');
        // } else {
        //     $this->db->select('t2.id,t2.rfcChargesTitle,t2.unit,t3.id as ffChargesId,t3.total');
        // }
        // $this->db->select("tbl_annual_contract_route_rfc_charges.id,tbl_rfc_pricing_labels.mode,tbl_rfc_pricing_labels.pricing_label,tbl_rfc_pricing_labels.type,tbl_rfc_pricing_labels.category_id as charges_category_id,tbl_annual_contract_route_rfc_charges.charges,tbl_rfc_pricing_labels.id as charges_label_id");
        // $this->db->from('tbl_rfc_pricing_labels');
        // $this->db->join('tbl_annual_contract_route_rfc_charges', "tbl_annual_contract_route_rfc_charges.charges_label_id = tbl_rfc_pricing_labels.id AND tbl_annual_contract_route_rfc_charges.route_id='$route_id' AND tbl_annual_contract_route_rfc_charges.ff_company_id='$ff_company_id'",'left');
        //$this->db->join('tbl_rfc_charges as t2', "t1.rfc_charges_id = t2.id",'left');
        // if (!$isComparative) {
        //     $this->db->join('tbl_seller_requirement_mapp_rfc_charges as t3', "t2.id = t3.rfc_charges_id AND t3.request_id=$requestDetails->request_id AND t3.ff_company_id=$ff_company_id", 'left');
        // } else {
        //     $this->db->join('tbl_seller_requirement_mapp_rfc_charges_total as t3', "t2.id = t3.rfc_charges_id AND t3.request_id=$requestDetails->request_id AND t3.ff_company_id=$ff_company_id", 'left');
        // }

        // $this->db->where('t2.delivery_term_id', $requestDetails->delivery_term_id);
        // $this->db->where('t2.transaction', $requestDetails->transaction);
        // $this->db->where('t2.mode_id', $requestDetails->mode_id);
        // $this->db->where('t2.shipment_id', $requestDetails->shipment_id);
       // $this->db->where('tbl_rfc_pricing_labels.category_id ', $rfc_category_id);
        // if(strlen($mode_id)>0){
        //     $this->db->where_in('tbl_rfc_pricing_labels.mode', ['0',$mode_id]);
        // }

        $this->db->select('t2.id as rfc_charges_id,t2.rfc_pricing_label_id,t2.rfcChargesTitle,t2.unit,t3.id as ffChargesId,t3.ff_company_id,t3.charges,t3.counter_offer');
        $this->db->from('tbl_rfc_charges as t2');
        $this->db->join('tbl_annual_contract_route_rfc_charges as t3', "t2.id = t3.rfc_charges_id AND t3.route_id='$route_id' AND t3.ff_company_id='$ff_company_id'", 'left');
        $this->db->where('t2.delivery_term_id', '1');
        $this->db->where('t2.transaction', 'Import');
        $this->db->where('t2.shipment_id', '2');
        $this->db->where('t2.mode_id', $mode_id);
        $this->db->where('t2.rfc_category_id ', $rfc_category_id);

        $query = $this->db->get();
        // print_r($this->db->last_query());//die;
        return $query->result();
    }

    public function getContractCatgeoryTotalCharges($category_id,$route_id,$ff_company_id,$mode_id=''){
		$this->db->select("SUM(charges) as total");
       //$this->db->select('t2.id as rfc_charges_id,t2.rfcChargesTitle,t2.unit,t3.id as ffChargesId,t3.ff_company_id,t3.charges');
        $this->db->from('tbl_rfc_charges as t2');
        $this->db->join('tbl_annual_contract_route_rfc_charges as t3', "t2.id = t3.rfc_charges_id AND t3.route_id='$route_id' AND t3.ff_company_id='$ff_company_id'", 'left');
        $this->db->where('t2.delivery_term_id', '1');
        $this->db->where('t2.transaction', 'Import');
        $this->db->where('t2.shipment_id', '2');
        $this->db->where('t2.mode_id', $mode_id);
        $this->db->where('t2.rfc_category_id ', $category_id);
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		$result = $query->row();
		return $result->total;
	}
    public function getContractCatgeoryTotalCounterOffer($category_id,$route_id,$ff_company_id,$mode_id=''){
		$this->db->select("SUM(counter_offer) as total");
       //$this->db->select('t2.id as rfc_charges_id,t2.rfcChargesTitle,t2.unit,t3.id as ffChargesId,t3.ff_company_id,t3.charges');
        $this->db->from('tbl_rfc_charges as t2');
        $this->db->join('tbl_annual_contract_route_rfc_charges as t3', "t2.id = t3.rfc_charges_id AND t3.route_id='$route_id' AND t3.ff_company_id='$ff_company_id'", 'left');
        $this->db->where('t2.delivery_term_id', '1');
        $this->db->where('t2.transaction', 'Import');
        $this->db->where('t2.shipment_id', '2');
        $this->db->where('t2.mode_id', $mode_id);
        $this->db->where('t2.rfc_category_id ', $category_id);
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		$result = $query->row();
		return $result->total;
	}

    function getRfcCategoryOtherTotal($request_id,$company_id,$rfc_category_id){
        $this->db->select('SUM(total) as total');
        $this->db->from('tbl_seller_requirement_mapp_rfc_other_charges');
        $this->db->where('request_id', $request_id);
        $this->db->where('category_id', $rfc_category_id);
        $this->db->where('ff_company_id', $company_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->total;
    }

    function checkRfcChargeExist($request_id, $ff_company_id, $rfc_id, $item_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_seller_requirement_mapp_rfc_charges');
        $this->db->where('request_id', $request_id);
        if (!empty($item_id)) {
            $this->db->where('item_id', $item_id);
        }
        $this->db->where('rfc_charges_id', $rfc_id);
        $this->db->where('ff_company_id', $ff_company_id);
        $query = $this->db->get();
        return $query->row();
    }

    function insertRfcCharges($data)
    {
        if ($this->db->insert('tbl_seller_requirement_mapp_rfc_charges', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    function updateRfcCharges($id, $data)
    {

        $this->db->where('id', $id);
        if ($this->db->update('tbl_seller_requirement_mapp_rfc_charges', $data)) {
            return true;
        } else {
            return false;
        }
    }
    function getRfcOtherCharges($request_id, $company_id,$categoryId='')
    {
        $this->db->select('*');
        $this->db->from('tbl_seller_requirement_mapp_rfc_other_charges');
        $this->db->where('request_id', $request_id);
        $this->db->where('ff_company_id', $company_id);
        if($categoryId){
            $this->db->where('category_id', $categoryId);
        }
        $query = $this->db->get();
        return $query->result();
    }



    function insertRfcOtherCharges($data)
    {
        if ($this->db->insert('tbl_seller_requirement_mapp_rfc_other_charges', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    function updateRfcOtherCharges($id, $data)
    {

        $this->db->where('id', $id);
        if ($this->db->update('tbl_seller_requirement_mapp_rfc_other_charges', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function updateRfcChargesTotal($request_id, $company_id)
    {
        $this->db->select('`request_id`, `ff_company_id`, `rfc_charges_id`, SUM(`total`) AS total');
        $this->db->from('tbl_seller_requirement_mapp_rfc_charges');
        $this->db->where('request_id', $request_id);
        $this->db->where('ff_company_id', $company_id);
        $this->db->group_by('rfc_charges_id');
        $query = $this->db->get();
        $result = $query->result();
        //            vdebug($result);

        foreach ($result as $row) {
            $this->updateRfcChargesTotal_update($row);
        }
    }

    function updateRfcChargesTotal_check($row)
    {
        $this->db->select('`request_id`, `ff_company_id`, `rfc_charges_id`, SUM(`total`) AS total');
        $this->db->from('tbl_seller_requirement_mapp_rfc_charges_total');
        $this->db->where('request_id', $row->request_id);
        $this->db->where('ff_company_id', $row->ff_company_id);
        $this->db->where('rfc_charges_id', $row->rfc_charges_id);
        $query = $this->db->get();

        return $query->row()->request_id ? $query->row()->request_id : null;
    }
    function updateRfcChargesTotal_update($row)
    {
        if ($this->updateRfcChargesTotal_check($row)) {
            $this->db->where('request_id', $row->request_id);
            $this->db->where('ff_company_id', $row->ff_company_id);
            $this->db->where('rfc_charges_id', $row->rfc_charges_id);
            $this->db->update('tbl_seller_requirement_mapp_rfc_charges_total', $row);
        } else {
            $this->db->insert('tbl_seller_requirement_mapp_rfc_charges_total', $row);
        }
    }

    public function getBookingList($company_id)
    {
        $this->db->select('tbl_seller_requirement.*,tbl_seller_requirement.id as request_id,tbl_shipment.type as shipment,tbl_deliver_term.name as delivery_term_name,tbl_mode.type as mode,tbl_seller_requirement_mapp_ff.quote_status,t5.title as quote_status_title, tbl_seller_requirement_mapp_ff.quote_submit_dt');

        $this->db->from('tbl_seller_requirement');
        $this->db->join('tbl_deliver_term', 'tbl_deliver_term.id = tbl_seller_requirement.delivery_term_id', 'left');
        $this->db->join('tbl_shipment', 'tbl_shipment.id = tbl_seller_requirement.shipment_id', 'left');
        $this->db->join('tbl_mode', ' tbl_mode.id = tbl_seller_requirement.mode_id', 'right');
        $this->db->join('tbl_seller_requirement_mapp_ff', ' tbl_seller_requirement.id = tbl_seller_requirement_mapp_ff.request_id');
        $this->db->join('tbl_field_ff_shipment_status as t5', 't5.id = tbl_seller_requirement_mapp_ff.quote_status', 'left');
        $this->db->where('tbl_seller_requirement_mapp_ff.ff_company_id', $company_id);
        $this->db->where('tbl_seller_requirement.selected_ff_company_id', $company_id);
        $this->db->where_in('tbl_seller_requirement_mapp_ff.quote_status', ['5', '9']);
        $this->db->order_by('tbl_seller_requirement.selected_ff_dt', 'DESC');
        $this->db->where('tbl_seller_requirement.deleted_at IS NULL');
        $query = $this->db->get();
        //                print_r($this->db->last_query());die;
        return $query->result();
    }
    public function getBookingDetails($request_id, $company_id)
    {
        $this->db->select('t1.*,t1.id as request_id,t3.type as shipment,t2.name as delivery_term_name,t4.type as mode,t5.quote_status,t5.quote_submit_dt,t5.counter_rate_update_status,t5.counter_rate_update_dt,t5.ff_id');

        $this->db->from('tbl_seller_requirement as t1');
        $this->db->join('tbl_deliver_term as t2', 't2.id = t1.delivery_term_id', 'left');
        $this->db->join('tbl_shipment as t3', 't3.id = t1.shipment_id', 'left');
        $this->db->join('tbl_mode as t4', ' t4.id = t1.mode_id', 'right');
        $this->db->join('tbl_seller_requirement_mapp_ff as t5', ' t1.id = t5.request_id');

        $this->db->where_in('t5.quote_status', ['5', '9']);
        $this->db->where('t1.selected_ff_company_id', $company_id);
        $this->db->where('t5.request_id', $request_id);
        $this->db->where('t1.deleted_at IS NULL');
        $query = $this->db->get();
        $result = $query->row();
        if ($result->shipment_id == "1") {
            //FCL
            $result->container = $this->getRequirementItems($request_id, 'container', $company_id);
            $result->package;
        } else if ($result->shipment_id == "2") {
            //LCL
            $result->package = $this->getRequirementItems($request_id, 'package', $company_id);
            $result->container;
        } else {
            $result->package;
            $result->container;
        }

        return $result;
    }

    public function insertParticular($data)
    {
        if ($this->db->insert('tbl_seller_requirement_mapp_rfc_charges_particulars', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }


    public function deleteParticulars($request_id, $ff_company_id)
    {
        return    $this->db->delete('tbl_seller_requirement_mapp_rfc_charges_particulars', array('request_id' => $request_id, 'ff_company_id' => $ff_company_id));
    }

    public function getParticularList($request_id, $ff_company_id)
    {

        $this->db->where('request_id', $request_id);
        $this->db->where('ff_company_id', $ff_company_id);
        $query = $this->db->get('tbl_seller_requirement_mapp_rfc_charges_particulars');
        return $query->result();
    }

    public function getParticularTotalCharges($request_id, $ff_company_id)
    {
        $this->db->select('SUM(transport_charge * qty) as totalTransportCharges, SUM(varai_charge * qty) as totalVarai_chargeCharges');
        $this->db->where('request_id', $request_id);
        $this->db->where('ff_company_id', $ff_company_id);
        $query = $this->db->get('tbl_seller_requirement_mapp_rfc_charges_particulars');

        return $query->row();
    }

    function getOtherCharges($requestDetails)
    {
        $this->db->select('t2.other_charge_id, t1.title as other_charge_title');
        $this->db->from('tbl_field_other_charges as t1');
        $this->db->join('tbl_delivery_term_mapp_other_charges as t2', "t1.id = t2.other_charge_id");
        $this->db->where('t2.delivery_term_id', $requestDetails->delivery_term_id);
        $this->db->where('t2.transaction', $requestDetails->transaction);
        $this->db->where('t2.mode_id', $requestDetails->mode_id);
        $this->db->where('t2.shipment_id', $requestDetails->shipment_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getAnnualContractRiders($route_id='',$ff_company_id='',$mode_id)
    {
        $this->db->select('t2.other_charge_id as rider_charge_id, t1.title as rider_title,t3.value_1');
        $this->db->from('tbl_field_other_charges as t1');
        $this->db->join('tbl_delivery_term_mapp_other_charges as t2', "t1.id = t2.other_charge_id");
        $this->db->join('tbl_annual_contract_route_riders as t3', "t2.other_charge_id = t3.other_charge_id AND t3.route_id='$route_id' AND t3.ff_company_id='$ff_company_id'", 'left');
        $this->db->where('t2.delivery_term_id', '1');
        $this->db->where('t2.transaction', 'Import');
        $this->db->where('t2.mode_id', $mode_id);
        $this->db->where('t2.shipment_id', '2');
        $query = $this->db->get();
        return $query->result();
    }



    function getOtherChargesValues($requestDetails, $ff_company_id, $shipmentTypeId)
    {
        //              echo $shipmentTypeId;die;
        $this->db->select('id,other_charge_id,request_id,value_1,value_2');
        $this->db->from('tbl_seller_requirement_mapp_ff_other_charges');
        $this->db->where('ff_company_id', $ff_company_id);
        $this->db->where('request_id', $requestDetails->request_id);
        $query = $this->db->get();
        $result = $query->result();
        $finalArray = array();
        foreach ($result as $row) {
            if (in_array($row->other_charge_id, ['13', '14']) && $shipmentTypeId == '1') {
                $temp = array();
                $temp['value_1'] = $row->value_1;
                $temp['value_2'] = $row->value_2;
                $finalArray[$row->other_charge_id][] = $temp;
            } else {
                $finalArray[$row->other_charge_id]['value_1'] = $row->value_1;
                $finalArray[$row->other_charge_id]['value_2'] = $row->value_2;
            }
        }

        return $finalArray;
    }



    function insertOtherCharge($data)
    {
        if ($this->db->insert('tbl_seller_requirement_mapp_ff_other_charges', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function deleteOtherCharges($request_id, $ff_company_id)
    {
        return    $this->db->delete('tbl_seller_requirement_mapp_ff_other_charges', array('request_id' => $request_id, 'ff_company_id' => $ff_company_id));
    }
    function deleteOtherRfcCharges($request_id, $ff_company_id)
    {
        return    $this->db->delete('tbl_seller_requirement_mapp_rfc_other_charges', array('request_id' => $request_id, 'ff_company_id' => $ff_company_id));
    }

    
	public function getCompletedStep($transctn, $request_id)
	{
		$this->db->select('tbl_shipment_process.step_id');
		$this->db->from('tbl_shipment_process');
		$this->db->where('tbl_tracking_steps.transaction', $transctn);

		$this->db->join('tbl_tracking_steps', 'tbl_tracking_steps.id = tbl_shipment_process.step_id', 'left');
		$this->db->where('tbl_shipment_process.request_id', $request_id);
		$this->db->order_by('tbl_tracking_steps.id', 'asc');
		$query = $this->db->get();
		//		 echo $this->db->last_query();exit();
		return $query->result();
    }
    
    function getSPSteps($transctn, $mode_id, $shipment_id, $delivery_term_id)
	{
		$this->db->select('t1.id,t1.step_name');
		$this->db->from('tbl_tracking_steps as t1'); //
		$this->db->join('tbl_delivery_term_mapp_tracking_steps as t2', 't1.id = t2.step_id');
		$this->db->where('t2.transaction', $transctn);
		$this->db->where('t2.mode_id', $mode_id);
		$this->db->where('t2.shipment_id', $shipment_id);
		$this->db->where('t2.delivery_term_id', $delivery_term_id);
		$this->db->order_by('t1.id', 'ASC');
		$query = $this->db->get();
		return $query->result();
    }

    public function getCurrentStep($transctn, $request_id)
	{
		$this->db->select('tbl_shipment_process.step_id,tbl_tracking_steps.tracking_status_title');
		$this->db->from('tbl_shipment_process');
		$this->db->where('tbl_tracking_steps.transaction', $transctn);

		$this->db->join('tbl_tracking_steps', 'tbl_tracking_steps.id = tbl_shipment_process.step_id', 'left');
		$this->db->where('tbl_shipment_process.request_id', $request_id);
		//$this->db->where('tbl_shipment_process.status !=', 1);
		//		$this->db->order_by('tbl_shipment_process.step_id', 'DESC'); 	
        $this->db->order_by('tbl_tracking_steps.id', 'desc');
        $this->db->limit(1);
		$query = $this->db->get();
		// echo $this->db->last_query();exit();
		return $query->row();
    }
    public function getCurrentTrackStep($transctn, $request_id)
	{
		$this->db->select('tbl_shipment_process.step_id,tbl_tracking_steps.tracking_status_title');
		$this->db->from('tbl_shipment_process');
		$this->db->where('tbl_tracking_steps.transaction', $transctn);

		$this->db->join('tbl_tracking_steps', 'tbl_tracking_steps.id = tbl_shipment_process.step_id', 'left');
		$this->db->where('tbl_shipment_process.request_id', $request_id);
		$this->db->where('tbl_shipment_process.status !=', 1);
		$this->db->order_by('tbl_shipment_process.step_id', 'asc'); 	
        // $this->db->order_by('tbl_tracking_steps.id', 'desc');
        // $this->db->limit(1);
		$query = $this->db->get();
		// echo $this->db->last_query();exit();
		return $query->row();
    }
    
    function getBookingShipmentStatusCount($companyId='',$transaction,$finyear)
	{
		$finDate1 = $finyear.'-04-01';
		$finDate2 = ($finyear+1).'-03-31';

		$temp =[
			'At Origin'=>0,
			'At Origin Port'=>0,
			'In-transit'=>0,
			'At Destination Port'=>0,
			'Delivered'=>0,
			'Statutory Update'=>0,
			'Completed'=>0,
		];	
		$subQuery = "SELECT t3.tracking_status_title FROM  `tbl_tracking_steps` as t3 WHERE t3.id = (SELECT COALESCE(MAX(step_id), 1) as step_id FROM `tbl_shipment_process` AS t2 WHERE t1.id = t2.request_id) ";

		$this->db->select("t1.fs_company_id,t1.transaction,($subQuery) as tracking_status_title, count(id) as  count");
		$this->db->from('tbl_seller_requirement as t1');
		$this->db->where('t1.transaction', $transaction);
        $this->db->where('t1.status', '5');
        $this->db->where('t1.deleted_at IS NULL');
		$this->db->where("CAST(t1.created_at AS DATE) BETWEEN '$finDate1' AND '$finDate2' ");
		if($companyId){
			$this->db->where('t1.selected_ff_company_id', $companyId);
		}
		$this->db->group_by('tracking_status_title');
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$temp[$row->tracking_status_title] = $row->count;
		}
		$temp['Completed'] = $this->getCompletdShipmentCount($companyId,$transaction,$finyear);
		return $temp;
	}

	public function getCompletdShipmentCount($companyId='',$transaction,$finyear){
		$finDate1 = $finyear.'-04-01';
		$finDate2 = ($finyear+1).'-03-31';

		$this->db->select("count(id) as  count");
		$this->db->from('tbl_seller_requirement as t1');
		$this->db->where('t1.transaction', $transaction);
		$this->db->where('t1.status', '6');//see table tbl_field_shipment_status (Exporter-Importer) for status id
		if($companyId){
			$this->db->where('t1.selected_ff_company_id', $companyId);
        }
        $this->db->where('t1.deleted_at IS NULL');
		$this->db->where("CAST(t1.created_at AS DATE) BETWEEN '$finDate1' AND '$finDate2' ");
		$query = $this->db->get();
		$result = $query->row();
		return $result->count;
    }
    
    function getSoNumberList($request_id){
		$this->db->select("so_number");
		$this->db->from("tbl_seller_requirement_mapp_items");
		$this->db->where('request_id', $request_id);
		$this->db->where('so_number IS NOT NULL');
		$query = $this->db->get();
		

		$result = $query->result();
		
		return array_column($result, "so_number");
	}
	function getSoLineItemList($request_id){
		$this->db->select("so_line_item");
		$this->db->from("tbl_seller_requirement_mapp_items");
		$this->db->where('request_id', $request_id);
		$this->db->where('so_line_item IS NOT NULL');
		$query = $this->db->get();
		

		$result = $query->result();
		
		return array_column($result, "so_line_item");
	}
	function getDeliveryCompletedDate($request_id){
		$this->db->select("action_date");
		$this->db->from("tbl_shipment_process");
		$this->db->where('request_id', $request_id);
		$this->db->where_in('step_id',[10,19]);
		$query = $this->db->get();
		

		$result = $query->row();
		
		return $result->action_date?$result->action_date:null;
	}
    
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model{

	private $TBL='tbl_revenue_inv_list';

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
		$this->db->where('inv_id', $id);
		if($this->db->update($this->TBL, $data)){
			return true;
		}else{
			return false;
		}
	}

	public function getRecord($id){
		$this->db->where('inv_id', $id);
		$query = $this->db->get($this->TBL);
		$row=array();
		if ($query->num_rows() > 0){
			$row = $query->row_array();
		}
		return $row;
	} 

        public function delete($id){
                return	$this->db->delete($this->TBL, array('inv_id' => $id));
        }

        public function exist($id){
                    $this->db->select('COUNT(*) AS CNT');
                    $this->db->where('inv_id',$id);
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

        public function getList($arr_status=array(),$invoiceType='',$isActive=false){
		
                if(!empty($arr_status)){
                    $this->db->where_in('status',$arr_status);
                }
                if(!empty($invoiceType)){
                    $this->db->where('inv_type',$invoiceType);
                }
                $this->db->order_by('inv_id','DESC');
		$query = $this->db->get($this->TBL);
		
		return $query->result();
	}

        public function getPlaceOfSupplyList(){
            $query = $this->db->order_by('name')->get('tbl_field_invoice_place_of_supply');
		
		return $query->result();
        }
        
        public function getInvoiceDetails($invoice_id,$invoice_type){
               
                if(empty($invoice_id))
                    return null;
                $this->db->select('*');
		
		$this->db->from($this->TBL);
		$this->db->where('inv_id', $invoice_id);
		$this->db->where('inv_type', $invoice_type);
		$query = $this->db->get();
                $result = $query->row();
                if(!empty($result)){
                    $result->billingItems = $this->getBillingItems($invoice_id);
                    $result->proformaLinkedList = $this->getLinkedInoviceId($result->company_id,$result->inv_id);
                    $result->proformaNotLinkedList = $this->getProfomaInvoiceNotLinked($result->company_id,$result->inv_id,$result->proformaLinkedList);
                }
                
                return $result;
        }
        
        
        function getBillingItems($invoice_id){
            $this->db->select('*');
            $this->db->from('tbl_revenue_inv_mapp_billed_item');
            $this->db->where('inv_id', $invoice_id);
            $query = $this->db->get();
            return $query->result();
        }
        
           function insertBillingItem($data)
        {
            $this->db->insert('tbl_revenue_inv_mapp_billed_item', $data);
                    $insert_id = $this->db->insert_id();
                    return  $insert_id;
        }
        
        function updateBillingItem($item_id,$data)
        {
             $this->db->where('id', $item_id);
                    if($this->db->update('tbl_revenue_inv_mapp_billed_item', $data)){
                            return true;
                    }else{
                            return false;
                    }
        }
        function deleteBillingItem($invoice_id,$arrItemIds){
            
            $this->db->where('inv_id', $invoice_id);
            $this->db->where_not_in('id', $arrItemIds);
            return $this->db->delete('tbl_revenue_inv_mapp_billed_item');
        }
        
        function generateInvoiceNumber($invoiceType){
            $this->db->select('COUNT(inv_id) as invoice_count');
            $this->db->from($this->TBL);
            $this->db->where('inv_type', $invoiceType);
            $query = $this->db->get();
            $result = $query->row();
            $invoiceNumber = str_pad(($result->invoice_count + 1), 5, '0', STR_PAD_LEFT);
            return $invoiceType=="proforma"?"PRF".$invoiceNumber:'INV'.$invoiceNumber;
        }
        
        function getProfomaInvoiceNotLinked($company_id,$invoice_id,$arrLinkedInvId=array()){
            //get list of not linked proforma invoices
             
            if(empty($company_id)){
                return null;
            }
                $this->db->where_in('status',['new','edited']);
                $this->db->where('inv_type','proforma');
                $this->db->where('company_id',$company_id);
               
               
                if(!empty($invoice_id)){
                    $this->db->where('inv_id !=',$invoice_id);
                }
                 if(!empty($arrLinkedInvId)){
                     $this->db->or_where_in('inv_id',$arrLinkedInvId);
                }
               
		$query = $this->db->get($this->TBL);
             
		return $query->result();
        }
        
        function getLinkedInoviceId($company_id,$invoice_id){
            if(empty($company_id)){
                return array();
            }
                
                
                if(!empty($invoice_id)){
                    $this->db->where('invoice_id',$invoice_id);
                }
                
                
		$query = $this->db->get('tbl_revenue_inv_list_mapp_linked_proforma');
		$result = $query->result();
                $resultArr = array();
                foreach ($result as $row){
                    $resultArr [] = $row->linked_inv_id;
                }
		return $resultArr;
        }
        
        function linkeProforma($proformaInvId_arr,$invoice_id){
            $this->mappLinkedProforma($proformaInvId_arr,$invoice_id);
            if(!empty($proformaInvId_arr)){
                $this->db->where_in('inv_id',$proformaInvId_arr);
                $this->db->update($this->TBL, ['status'=>'linked']);
            }
           
           
        }
        
        function mappLinkedProforma($proformaInvId_arr,$invoice_id){
            //remove old records
            $this->db->delete('tbl_revenue_inv_list_mapp_linked_proforma', array('invoice_id' => $invoice_id));
            
           if(!empty($proformaInvId_arr)){
               foreach ($proformaInvId_arr as $proforma_id){
                   $data = [
                       'invoice_id'=>$invoice_id,
                       'linked_inv_id'=>$proforma_id
                   ];
                   $this->db->insert('tbl_revenue_inv_list_mapp_linked_proforma',$data);
               }
           }
        }
}
?>

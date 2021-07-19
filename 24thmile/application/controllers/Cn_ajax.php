<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_ajax extends CI_Controller{
    
   public function __construct() {
        parent::__construct();
        $this->load->model('container_model');
        $this->load->model('container_size_model');
        $this->load->model('packing_model');
        $this->load->model('invoice_model');
        $this->load->model ('Port_model', 'PORT', TRUE); 
        $this->load->model('city_model','CITY',true); 
		$this->load->model('mode_model');
		$this->load->model('shipment_model');
		$this->load->model('freight_model');
		$this->load->model('annual_contract_route_rfc_charges_model');
		$this->load->model('annual_contract_route_riders_model');
        
    }
    
    public function ajaxAddContainer(){
          $containerCounter = uniqid();
          $data['containerCounter']=$containerCounter;
          $data['container_types'] = $this->container_model->getList();
         $data['packingList'] = $this->packing_model->getList();
         $data['containerSizeList'] = $this->container_size_model->getList();
          $this->load->view('frontend/ajax/ajaxAddContainer',$data);
          
      }
       public function ajaxAddPackage(){
          $packageCounter = uniqid();
          $data['packingList'] = $this->packing_model->getList();
          $data['packageCounter']=$packageCounter;
          $data['containerCounter'] = $this->input->post('containerCounter');
          $data['transaction'] = $this->input->post('transaction');
          if(!empty($data['containerCounter'])){
            $this->load->view('frontend/ajax/ajaxAddContainerPackage',$data);
          }else{
            $this->load->view('frontend/ajax/ajaxAddPackage',$data);
          }
         
          
      }
       public function ajaxAddOtherCharges(){
          
        //          $data['packingList'] = $this->packing_model->getList();
        //          $data['packageCounter']=$packageCounter;
           $data['arr_unit'] = $this->input->post('arr_unit');
           $other = new stdClass;
           $other->category_id = $this->input->post('category_id');
           $data['other'] = $other;
          $this->load->view('frontend/ajax/ajaxAddOtherCharges',$data);
          
      }
       public function ajaxAddParticular(){
          $particularCount = uniqid();
          
          $data['particularCounter']=$particularCount;
          $this->load->view('frontend/ajax/ajaxAddParticular',$data);
          
      }
       public function ajaxAddInvoiceItemRow(){
         
          $invoice_id = $this->input->post('invoice_id'); 
          if(!empty($invoice_id)){
              
              foreach ($this->invoice_model->getBillingItems($invoice_id) as $item){
                  $item->id = '';
                $this->load->view('backend/ajax/invoiceItemRow',['item'=>$item,'invoice_id'=>$invoice_id]);  
              }
              
             
          }else{
             $this->load->view('backend/ajax/invoiceItemRow');  
          }
         
          
      }
       public function ajaxGetProformaInvoiceList(){
          
          $company_id = $this->input->post('company_id');
          $inv_id = $this->input->post('inv_id');
          $data['proformaNotLinkedList'] = $this->invoice_model->getProfomaInvoiceNotLinked($company_id,$inv_id);
          
          $this->load->view('backend/ajax/linkProformaInvoice',$data);
          
      }
      
      public function ajaxPortList(){
            $keyword = $this->input->post('keyword');
            $type = $this->input->post('type');
            $type = ($type=='2')?'air_port':'sea_port';
         
            if(!empty($keyword)){
               $cityList = $this->PORT->getListAutoComplete($keyword,$type,$isActive=1); 
              
            }else{
                $cityList = array();
            }
            
            $cityListHtml = '<ul id="country-list">';
            foreach ($cityList as $city){
                
             $cityListHtml .= '<li data-portId="'.$city->id.'"  >'.(implode(', ', array_filter([$city->name,$city->municipality,$city->iso_country]))).'</li>'; 
            }
           
            $cityListHtml .= '<li data-portId="0"  >Other</li>';  
           
           echo $cityListHtml.='</ul>';
            die;
        }
        
         public  function ajaxAddPort(){
            
            $port_name = trim($this->input->post('port_name'));
            $port_city = trim($this->input->post('port_city'));
            $iso_country = trim($this->input->post('iso_country'));
            $port_type = trim($this->input->post('port_type'));
            $port_type = ($port_type=='2')?'air_port':'sea_port';
            
            $session_user_id = trim($this->input->post('session_user_id'));
            
            if(!empty($port_name) && !empty($iso_country) && !empty($port_type)){
                
                $port_details = $this->PORT->portExist($port_name,$iso_country,$port_type);
               
                if(empty($port_details)){
                    //insert port
                    $insertData = [
                        'name'=>$port_name,
                        'type'=>$port_type,
                        'iso_country'=>$iso_country,
                        'municipality'=>$port_city?$port_city:null,
                        'isActive'=>1,
                        'created_by_user_id'=>$session_user_id?$session_user_id:'',
                    ];
                   $port_id =  $this->PORT->insert($insertData);
                   $port_details = $this->PORT->portExist($port_name,$iso_country,$port_type);
                }
                 
                $result = ['port_id'=>$port_details->id,'port_name'=>(implode(', ', array_filter([$port_details->name,$port_details->municipality,$port_details->iso_country])))];
                echo json_encode($result);
                die;
            }else{
               
                 $result = ['port_id'=>'','port_name'=>''];
                echo json_encode($result);
                die;
            }
            
        }
         public function ajaxCityList(){
            $keyword = $this->input->post('keyword');
            
            if(!empty($keyword)){
               $cityList = $this->CITY->getList($keyword); 
            }else{
                $cityList = array();
            }
            
            $cityListHtml = '<ul id="country-list">';
            foreach ($cityList as $city){
             $cityListHtml .= '<li data-cityId="'.$city->city_id.'" data-stateId="'.$city->state_id.'" data-countryId="'.$city->country_id.'" data-currency="'.$city->currency.'"  >'.$city->city.', '.$city->state_title.', '.$city->countryName.'</li>'; 
            }
           
            $cityListHtml .= '<li data-cityId="0" data-stateId="0" data-countryId="0" data-currency=""  >Other</li>';  
           
           echo $cityListHtml.='</ul>';
            die;
        }
        
        public function ajaxAddCity(){
            
            $country = trim($this->input->post('country'));
            $state = trim($this->input->post('state'));
            $city = trim($this->input->post('city'));
            $session_user_id = trim($this->input->post('session_user_id'));
            
            if(!empty($country)&& !empty($state) && !empty($city)){
               
                $country_details = $this->CITY->countryExist($country);
                if(empty($country_details)){
                    //insert new country
                    $insertData = [
                        'countryName'=>$country,
                        'created_by_user_id'=>$session_user_id?$session_user_id:null,
                        'status'=>'1'
                    ];
                    $country_id = $this->CITY->addCountry($insertData);
                    $country_details = $this->CITY->countryExist($country);
                }
                
                $state_id = $this->CITY->stateExist($state,$country_details->idCountry);
                if(empty($state_id)){
                    //insert new country
                    $insertData = [
                        'state_title'=>$country,
                        'country_id'=>$country_id,
                        'created_by_user_id'=>$session_user_id?$session_user_id:null,
                        'status'=>'1'
                    ];
                    $state_id = $this->CITY->addState($insertData);
                }
                
                $city_id = $this->CITY->cityExist($city,$state_id);
                if(empty($city_id)){
                    //insert new country
                    $insertData = [
                        'city'=>$city,
                        'state_id'=>$state_id,
                        'created_by_user_id'=>$session_user_id?$session_user_id:null,
                        'status'=>'1'
                    ];
                    $city_id = $this->CITY->addCity($insertData);
                }
                
                 $result = ['city_id'=>$city_id,'state_id'=>$state_id,'country_id'=>$country_details->idCountry,'city_name'=>"$city, $state, $country",'currency'=>$country_details->currency];
                echo json_encode($result);
                die;
            }else{
                 $result = ['city_id'=>'','state_id'=>'','country_id'=>'','city_name'=>"",'currency'=>''];
                echo json_encode($result);
                die;
            }
            
            
            
           
        }
      
      public function ajaxAddPackageFrom_Excel(){
 
          $packingList = $this->packing_model->getList();
        
          $item = new stdClass();
          
         $file = $_FILES['file']['tmp_name'];
         $containerCounter = $this->input->post('containerCounter');
         $transaction = $this->input->post('transaction');
            //load the excel library
            $this->load->library('excel');
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            //read file from path
            $objPHPExcel = PHPExcel_IOFactory::load($file);

            //get only the Cell Collection
           // $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            
            //extract to a PHP readable array format
            foreach ($allDataInSheet as $key=>$row) {
                if($key=='1'){
                    continue;
                }
               
                $packageCounter = uniqid();
                $item->type_of_packing = $this->getIdFromValue($packingList,$row['A'],'type','id');
                $item->hs_code = $row['B'];
                $item->length = $row['C'];
                $item->width = $row['D'];
                $item->height = $row['E'];
                $item->volume = number_format(($item->length * $item->width * $item->height)/1000000,1,'.','') ;
                $item->volume_cm = ($item->length * $item->width * $item->height) ;
                $item->volumetric_weight = number_format($item->volume_cm/5000,0,'.','');
                $item->net_weight = $row['F'];
                $item->gross_weight = $row['G'];
                $item->material_description = $row['H'];
                $item->number_of_container = $row['I']?$row['I']:'1';
                $item->unit = $row['J']?$row['J']:'NUM';
                $item->so_number = $row['K']?$row['K']:'1';
                $item->so_line_item = $row['L']?$row['L']:'1';
                if(!empty($containerCounter)){
                    $this->load->view('frontend/ajax/ajaxAddContainerPackage',['packageCounter'=>$packageCounter,'containerCounter'=>$containerCounter,'item_details'=>$item,'packingList'=>$packingList,'transaction'=>$transaction]);
                }else{
                    $this->load->view('frontend/ajax/ajaxAddPackage',['packageCounter'=>$packageCounter,'containerCounter'=>$containerCounter,'item_details'=>$item,'packingList'=>$packingList,'transaction'=>$transaction]);
                }


            }

            
      }
      
      public function ajaxAddContainerFrom_Excel(){
 
         //ini_set('display_errors', 1);
        $packingList = $this->packing_model->getList();
        $container_types = $this->container_model->getList();
        $containerSizeList = $this->container_size_model->getList();
      
          $item = new stdClass();
          
         $file = $_FILES['file']['tmp_name'];

            //load the excel library
            $this->load->library('excel');
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            //read file from path
            $objPHPExcel = PHPExcel_IOFactory::load($file);

            //get only the Cell Collection
           // $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            
            //extract to a PHP readable array format
            foreach ($allDataInSheet as $key=>$row) {
                if($key=='1'){
                    continue;
                }
              
                $packageCounter = uniqid();
                $item->container_size = $this->getIdFromValue($containerSizeList,$row['A'],'size','id');
                $containerTypeArr = explode(' ', $row['B']);
                $item->container_type = $this->getIdFromValue($container_types,$containerTypeArr[0],'type','id');
                $item->number_of_container = $row['C'];
                $item->type_of_packing = $this->getIdFromValue($packingList,$row['D'],'type','id');
                $item->hs_code = $row['E'];
                $item->material_description = $row['F'];
                $item->gross_weight = $row['G'];
                $item->remarks = $row['H'];
                $item->unit = $row['I']?$row['I']:'NUM';
                $this->load->view('frontend/ajax/ajaxAddContainer',['containerCounter'=>$packageCounter,'item_details'=>$item,'packingList'=>$packingList,'containerSizeList'=>$containerSizeList,'container_types'=>$container_types]);
            }

            
      }
      public function ajaxUploadAnnualContract(){
 
         //ini_set('display_errors', 1);
        $packingList = $this->packing_model->getList();
        $container_types = $this->container_model->getList();
        $containerSizeList = $this->container_size_model->getList();
        $modeList = $this->mode_model->getList(true);
        $shipmentList = $this->shipment_model->getList(true);
        $cargoTypeList = ['Stackable','Non-Stackable'];
        $cargoNatureList = ['Hazardous','Non-Hazardous'];
        $transactionList = ['Import','Export'];
          $item = new stdClass();
        //   vdebug([$modeList,$shipmentList]);
         $file = $_FILES['file']['tmp_name'];

            //load the excel library
            $this->load->library('excel');
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            //read file from path
            $objPHPExcel = PHPExcel_IOFactory::load($file);

            //get only the Cell Collection
           // $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            
            //extract to a PHP readable array format
            foreach ($allDataInSheet as $key=>$row) {
                if($key=='1'){
                    continue;
                }
              
                $packageCounter = uniqid();
                $item->loading_place = $row['A'];
                $item->loading_country = $row['B'];
                $item->port_loading_name = $row['C'];
                $item->discharge_place = $row['D'];
                $item->discharge_country = $row['E'];
                $item->port_discharge_name = $row['F'];
                $item->mode_id = $this->getIdFromValue($modeList,$row['G'],'type','id');//getid
                $item->transaction = $row['H'];
                $item->container_stuffing = $row['I'];//cargo Type
                $item->cargo_status = $row['J'];//cargo nature
                $item->shipment_id =  $this->getIdFromValue($shipmentList,$row['K'],'type','id');//getid
                $item->currency = $row['L'];
                $item->commodity = $row['M'];
                $item->container_type = $row['N'];//getid
                $item->volume_per_annum = $row['O'];
                $item->tentative_gross_wt = $row['P'];
               
                $this->load->view('frontend/ajax/ajaxAddContractRow',['containerCounter'=>$packageCounter,
                'item_details'=>$item,
                'cargoTypeList'=>$cargoTypeList,
                'cargoNatureList'=>$cargoNatureList,
                'transactionList'=>$transactionList,
                'modeList'=>$modeList,
                'shipmentList'=>$shipmentList]);
            }

            
      }
      
      public function ajax_ff_UploadAnnualContract(){
 
        //ini_set('display_errors', 1);
       $packingList = $this->packing_model->getList();
       $container_types = $this->container_model->getList();
       $containerSizeList = $this->container_size_model->getList();
       $modeList = $this->mode_model->getList(true);
       $shipmentList = $this->shipment_model->getList(true);
       $cargoTypeList = ['Stackable','Non-Stackable'];
       $cargoNatureList = ['Hazardous','Non-Hazardous'];
       $transactionList = ['Import','Export'];
         $item = new stdClass();
         $ff_company_id = $this->input->post('ff_company_id');
         $annual_contract_id = $this->input->post('annual_contract_id');
         $mode_id = $this->input->post('mode_id');
       //   vdebug([$modeList,$shipmentList]);
        $file = $_FILES['file']['tmp_name'];

           //load the excel library
           $this->load->library('excel');
           PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
           //read file from path
           $objPHPExcel = PHPExcel_IOFactory::load($file);

           //get only the Cell Collection
          // $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
           $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        //    vdebug([$_POST,$allDataInSheet]);
           //extract to a PHP readable array format
           $route = [];
           foreach ($allDataInSheet as $key=>$row) {
               if(in_array($key,['1','2'])){
                   //skip first two rows from excel file
                   continue;
               }
             
               $packageCounter = uniqid();
               $route[$key]['id'] = $row['A'];
               $chargesStartCol ='R';
               $charges = $this->freight_model->getAnnualCotntractRfcChargesCategory($row['A'],$ff_company_id,$mode_id);
               $riders = $this->freight_model->getAnnualContractRiders($row['A'],$ff_company_id,$mode_id);
             
               foreach($charges as $chargKey=>$chargecategory){
                   foreach($chargecategory->subCategory as $subcategory){
                    $chargesInsert['route_id']=$row['A'];
                    $chargesInsert['annual_contract_id']=$annual_contract_id;
                    $chargesInsert['ff_company_id']=$ff_company_id;
                    $chargesInsert['rfc_charges_id']=$subcategory->rfc_charges_id;
                    $chargesInsert['charges']=$row[$chargesStartCol];
                    //insert charges
                    $route[$key]['charges'][]=$chargesInsert;
                   $this->annual_contract_route_rfc_charges_model->insert($chargesInsert);
                  
                    $chargesStartCol++;
                   }
                   if(isset($chargecategory->other_charges)){
                    $this->annual_contract_route_rfc_charges_model->updateRfcOtherCharges($chargecategory->id,$row['A'], $ff_company_id, $row[$chargesStartCol]);
                    $chargesStartCol++;
                   }
               }

               //update riders
               foreach($riders as $chargKey=>$rider){
               
                 $riderInsert['route_id']=$row['A'];
                // $chargesInsert['annual_contract_id']=$annual_contract_id;
                 $riderInsert['ff_company_id']=$ff_company_id;
                 $riderInsert['other_charge_id']=$rider->rider_charge_id;
                 if (in_array($rider->rider_charge_id, ['2', '3', '4'])) {
                    
                    $excelDate = $objPHPExcel->getActiveSheet()->getCell($chargesStartCol.$key)->getValue(); // gives you a number like 44444, which is days since 1900
                    $stringDate = \PHPExcel_Style_NumberFormat::toFormattedString($excelDate, 'YYYY-MM-DD');
                    
                    $riderInsert['value_1'] = $stringDate;// getMysqlDateFormat($row[$chargesStartCol]);
				}else{
                    $riderInsert['value_1']=$row[$chargesStartCol];
                }
                
                 //insert charges
                 $route[$key]['riders'][]=$riderInsert;
                $this->annual_contract_route_riders_model->insert($riderInsert);
               
                 $chargesStartCol++;
              

            }
               //$route[$key]['charges'] = $charges;
             //  $item->loading_place = $row['B'];
            //    $item->loading_country = $row['C'];
            //    $item->port_loading_name = $row['D'];
            //    $item->discharge_place = $row['E'];
            //    $item->discharge_country = $row['F'];
            //    $item->port_discharge_name = $row['G'];
            //    $item->mode_id = $this->getIdFromValue($modeList,$row['H'],'type','id');//getid
            //    $item->transaction = $row['I'];
            //    $item->container_stuffing = $row['J'];//cargo Type
            //    $item->cargo_status = $row['K'];//cargo nature
            //    $item->shipment_id =  $this->getIdFromValue($shipmentList,$row['L'],'type','id');//getid
            //    $item->currency = $row['M'];
            //    $item->volume_per_annum = $row['N'];
            //    $item->container_type = $row['O'];//getid
              
            //    $this->load->view('frontend/ajax/ajaxAddContractRow',['containerCounter'=>$packageCounter,
            //    'item_details'=>$item,
            //    'cargoTypeList'=>$cargoTypeList,
            //    'cargoNatureList'=>$cargoNatureList,
            //    'transactionList'=>$transactionList,
            //    'modeList'=>$modeList,
            //    'shipmentList'=>$shipmentList]);
           }

            $this->session->set_flashdata('success', 'Charges updated.');
            echo "success";
           
     }
      public function ajaxAddNewRowAnnualContract(){
        $modeList = $this->mode_model->getList(true);
        $shipmentList = $this->shipment_model->getList(true);
        $cargoTypeList = ['Stackable','Non-Stackable'];
        $cargoNatureList = ['Hazardous','Non-Hazardous'];
        $transactionList = ['Import','Export'];
        $packageCounter = uniqid();
        $item = new stdClass;
        $this->load->view('frontend/ajax/ajaxAddContractRow',['containerCounter'=>$packageCounter,
                                    'cargoTypeList'=>$cargoTypeList,
                                    'cargoNatureList'=>$cargoNatureList,
                                    'transactionList'=>$transactionList,
                                    'modeList'=>$modeList,
                                    'shipmentList'=>$shipmentList,
                                    'item_details'=>$item]);
      }

       private function getIdFromValue($array,$searchValue,$searchKey,$retrunKey){
           foreach ($array as $key=>$row){
               if(strcasecmp($row[$searchKey],$searchValue)==0){
                   return $row[$retrunKey];
               }
           }
           return;
       }
      
     
}

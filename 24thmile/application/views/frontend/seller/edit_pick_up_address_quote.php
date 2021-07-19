<style>
.comment-group {
    border-bottom:none;
	padding: none;
}
.comment-img {
    position: initial !important;
}
.comment-img img {
    max-width: 80%;
    border-radius: 0%;
}
.section-title {
    text-align: left;
    padding-bottom: 0px;
    padding-top: 45px;
}
.wshipping-content-block {
    padding: 0px 0px;
}

.from-user {
	background-color: #d5ffd5;
	padding: 5px;
	margin-bottom: 5px;
	margin-left: 50px;
	margin-top: 5px;
}
.to-user {
	background-color: #f9f6f6;
	padding: 5px;
	margin-bottom: 5px;
	margin-top: 5px;
	margin-right: 50px;
}
.communication-box {
	background-color: #f0f0f0;
	max-height: 200px;
	overflow-y: scroll;
}
@media (min-width: 840px){
	.mdl-grid {
		padding: 8px;
		width: 100% !important;
	}
}
</style>
   <!-- Tracking start -->
   <div class="wshipping-content-block">
      
	   <div class="container">
       <div class="row">
          <div class="col-12 col-lg-12">
              <div class="tracking-block">
                  <div class="tab-content">
                     
		  <h3 class="heading3-border">Shipment Instructions</h3>
                
		  
                  <div class="wshipping-content-block shipping-block">
            <div class="container">
              <div class="row">
                    <div class="shipping-form-block">
                        <?php $transactionCurrencyHtml =  "&nbsp;(".($requestDetails->transaction_currency?$requestDetails->transaction_currency:'INR').")";?>
                      
                        <form id="frmRequirement" name="frmRequirement" method="post" action="<?= base_url('fs-track-shipment-edit/'.$requestDetails->request_id.'/'.$requestDetails->selected_ff_company_id);?>"  >

                            <input type="hidden" name="request_id" value="<?=$requestDetails->request_id?>"/>
                    <div class="shipping-form">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-lg-2">
                                                   <label>RFC ID : </label>
                                                  <?=$requestDetails->request_id?>
                                           </div>
                                    <div class="col-12 col-lg-4">
                                                   <label>Freight Forwarder : </label>
                                                   <a href="<?= base_url('company-details/'.$ff_details->company_details->id)?>" target="_blank"><?=$ff_details->name?></a>
                                           </div>
                                </div>
                                   <div class="row">

                                          
                                           <div class="col-12 col-lg-2">
                                                   <label>Mode : </label>
                                                  <?=$requestDetails->mode?>
                                           </div>
                                           <div class="col-12 col-lg-2">
                                                   <label>Transaction : </label>
                                                  <?=$requestDetails->transaction?>
                                           </div>
                                       <div class="col-12 col-lg-2">
                                                   <label>Delivery Term :</label>
                                                  <?=$requestDetails->delivery_term_name?>
                                           </div>
                                       <div class="col-12 col-lg-2">
                                            <label>Shipment Type :</label><?=$requestDetails->shipment?>
                                                
                                           </div>
                                       <div class="col-12 col-lg-2">
                                            <label>Container Stuffing :</label>
                                             <?= $requestDetails->container_stuffing?>    
                                           </div>
                                       
                                       <div class="col-12 col-lg-2">
                                            <label>Cargo Status :</label>
                                             <?= $requestDetails->cargo_status?>    
                                           </div>
                                       <?php if(!empty($requestDetails->stuffing)){?>
                                       <div class="col-12 col-lg-2">
                                            <label>Stuffing :</label>
                                             <?= $requestDetails->stuffing?>    
                                           </div>
                                       <?php }?>
                                   </div>
                        
                        <div class="row">
                             <div class="col-lg-6 mt-0">
                                 <h3><b>Pick-up Address (If there is a change)</b></h3>
                               <div class="form-row mb-3 ">
                               <div class="col-6">
                                    <label>Company Name <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignor_company_name" id="consignor_company_name"  placeholder="Company Name" maxlength="50" value="<?= $requestDetails->consignor_company_name?$requestDetails->consignor_company_name:$sellerCompanyDetails->name; ?>" >
                                </div>
                                   <div class="col-6">
                                       <label>Email <sup>*</sup></label>
                                     
                                       <input type="text" class="form-control" name="consignor_email"  aria-describedby="consignor_email-error" placeholder="Email" maxlength="50" value="<?= $requestDetails->consignor_email?$requestDetails->consignor_email:$this->seller_session_data['email']; ?>" >
                                     
                                       <span id="consignor_email-error" class="error"></span>
                                     </div>
                                </div>
                                  
                                <div class="form-row mb-3">
                                <div class="col-6">
                                    <label>Address line 1 <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignor_address_line_1" id="consignor_address_line_1"  placeholder="Address line 1" maxlength="50" value="<?= $requestDetails->consignor_address_line_1; ?>" >
                                    </div>
                           <div class="col-6">
                                    <label>Address line 2</label>
                                    <input type="text" class="form-control" name="consignor_address_line_2" id="consignor_address_line_2"  placeholder="Address line 2" maxlength="50" value="<?= $requestDetails->consignor_address_line_2; ?>" >
                                    </div>
                                </div>
                                 <div class="form-row mb-3 from-profileCitySearch">
                                  <div class="col-6">
                                       <label>City <sup>*</sup></label>
                                       <input type="text" class="form-control search-box" name="consignor_city_name" id="consignor_city_name" placeholder="Type City Name" autocomplete="off" value="<?= $requestDetails->consignor_city_name; ?>">
                                       <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                       <input type="hidden" class="cityId" id="consignor_city_id" name="consignor_city_id" value="<?= $requestDetails->consignor_city_id; ?>" >
                                       <input type="hidden" class="stateId" id="consignor_state_id" name="consignor_state_id"  value="<?= $requestDetails->consignor_state_id; ?>" >
                                       <input type="hidden" class="countryId" id="consignor_country_id" name="consignor_country_id" value="<?= $requestDetails->consignor_country_id; ?>">
                                       </div>
                                   <div class="col-6">
                                  
                                  
                                    <label>Pin code <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignor_pincode" id="consignor_pincode"  placeholder="Pin code" maxlength="10" value="<?= $requestDetails->consignor_pincode; ?>"  >
                                </div>
                                </div>
                                 
                                 
                                 
                                 <div class="form-row mb-3 ">
                               <div class="col-6">
                                    <label>Contact Person Name <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignor_name" id="consignor_name"  placeholder="Contact Person Name" maxlength="50" value="<?= $requestDetails->consignor_name; ?>" >
                                </div>
                                   <div class="col-6">
                                       <label>Contact Number <sup>*</sup></label>
                                        <div class="input-group">
                                       <div class="input-group-prepend">
                                           <select class="input-group-text custom-select" name="consignor_country_code" id="consignor_country_code">
                                            <?php foreach (getCountryDialCodes() as $countryDial){ ?>
                                               <option value="<?=$countryDial->dial_code?>" <?=$requestDetails->consignor_country_code==$countryDial->dial_code||(empty($requestDetails->consignor_country_code) && $countryDial->dial_code=='+91' )?' selected ':''?>><?=$countryDial->dial_code?></option>
                                            <?php }?>
                                         </select>
                                       </div>
                                       <input type="text" class="form-control" name="consignor_phone"  aria-describedby="consignor_phone-error" placeholder="Contact Number" maxlength="15" value="<?= $requestDetails->consignor_phone; ?>" >
                                     </div>
                                       <span id="consignor_phone-error" class="error"></span>
                                     </div>
                                </div>
                        </div>
            <div class="col-lg-6 mt-0">
                                 <h3><b>Delivery Address</b></h3>
                               <div class="form-row mb-3">
                                   <div class="col-6">
                                    <label>Company Name <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignee_company_name" id="consignee_company_name"  placeholder="Company Name" maxlength="50" value="<?= $requestDetails->consignee_company_name; ?>"  >
                                </div>
                                   <div class="col-6">
                                       <label>Email <sup>*</sup></label>
                                       
                                       <input type="text" class="form-control" name="consignee_email" aria-describedby="consignee_email-error" placeholder="Email" maxlength="50" value="<?= $requestDetails->consignee_email; ?>" >
                                    
                                     <span id="consignee_email-error" class="error"></span>
                               </div>
                                </div>
                                 
                                <div class="form-row mb-3">
                                 <div class="col-6">
                                    <label>Address line 1 <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignee_address_line_1" id="consignee_address_line_1"  placeholder="Address line 1" maxlength="50"  value="<?= $requestDetails->consignee_address_line_1; ?>" ></div>
                                     <div class="col-6">
                               
                                    <label>Address line 2</label>
                                    <input type="text" class="form-control" name="consignee_address_line_2" id="consignee_address_line_2"  placeholder="Address line 2" maxlength="50" value="<?= $requestDetails->consignee_address_line_2; ?>" >
                                    </div>
                                </div>
                                 <div class="form-row mb-3 to-profileCitySearch">
                                  <div class="col-6">
                                       <label>City <sup>*</sup></label>
                                       <input type="text" class="form-control search-box" name="consignee_city_name" id="consignee_city_name" placeholder="Type City Name" autocomplete="off" value="<?= $requestDetails->consignee_city_name; ?>" >
                                       <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                       <input type="hidden" class="cityId" id="consignee_city_id" name="consignee_city_id" value="<?= $requestDetails->consignee_city_id; ?>" >
                                       <input type="hidden" class="stateId" id="consignee_state_id" name="consignee_state_id" value="<?= $requestDetails->consignee_state_id; ?>">
                                       <input type="hidden" class="countryId" id="consignee_country_id" name="consignee_country_id" value="<?= $requestDetails->consignee_country_id; ?>" >
                                   </div>
                                <div class="col-6">
                                    <label>Pin code <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignee_pincode" id="consignee_pincode"  placeholder="Pin code" maxlength="10"  value="<?= $requestDetails->consignee_pincode; ?>"   >
                                </div>
                                

                        </div>
                                 
                                 
                                 <div class="form-row mb-3">
                                   <div class="col-6">
                                    <label>Contact Person Name <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignee_name" id="consignee_name"  placeholder="Contact Person Name" maxlength="50" value="<?= $requestDetails->consignee_name; ?>"  >
                                </div>
                                   <div class="col-6">
                                       <label>Contact Number <sup>*</sup></label>
                                        <div class="input-group">
                                       <div class="input-group-prepend">
                                           <select class="input-group-text custom-select" name="consignee_country_code" id="contact_country_code">
                                             <?php foreach (getCountryDialCodes() as $countryDial){ ?>
                                    <option value="<?=$countryDial->dial_code?>" <?=$requestDetails->consignee_country_code==$countryDial->dial_code||(empty($requestDetails->consignee_country_code) && $countryDial->dial_code=='+91' )?' selected ':''?>><?=$countryDial->dial_code?></option>
                                    <?php }?>
                                         </select>
                                       </div>
                                       <input type="text" class="form-control" name="consignee_phone" aria-describedby="consignee_phone-error" placeholder="Contact Number" maxlength="15" value="<?= $requestDetails->consignee_phone; ?>" >
                                     </div>
                                     <span id="consignee_phone-error" class="error"></span>
                               </div>
                                </div>
                        </div>

                        </div>

                                <div class="row">
                                    
                                    
                                    <div class="col-12 col-lg-10 mb-2">
                                    <label>Any other specific instructions</label>
                                    <textarea name="shipping_instruction" class="form-control" maxlength="500"><?= printFormatedDateTime($requestDetails->shipping_instruction); ?></textarea>
                                    
                                </div>
                                    <div class="col-12 col-lg-2 mb-2">
                                        <label>Pick-up Date and Time<sup>*</sup></label>
                                    <input type="text" name="pick_up_datetime" class="form-control pickup_datetimepicker" value="<?= printFormatedDateTime($requestDetails->pick_up_datetime); ?>" required="">
                                </div>
                                    <div class="col-lg-12 text-right">
                                    <a href="<?= base_url('fs-booking-list');?>" class="btn btn-secondary btn-sm">Go Back</a>
                                    <input type="submit" name="submit" class="btn btn-submit btn-sm" value="Save And Process Shipment" />
                                </div>
                                </div>
                        </div>


                            <div class="form-group" style="margin-top: 20px;">
                             <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="edibx1">
                                           <label>Shipment Value: </label> <?= $requestDetails->shipment_value_currency.' '.$requestDetails->shipment_value; ?>
                                           
                                    </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="edibx1">
                                     <label>Port Of Loading :</label> <?=$requestDetails->loading_port?>
                                              
                                    </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="edibx1">
                                           <label>Port Of Discharge :</label> <?= $requestDetails->discharge_port?>
                                             
                                    </div>
                                    </div>
                                    
                             </div>
                           </div>
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="edibx1">
                                <label>Tentative Date of Dispatch :</label> <?= printFormatedDate($requestDetails->tentativ_date_dispatch); ?>   
                            </div>
                            </div>
<!--                            <div class="col-12 col-lg-4">
                                <div class="edibx1">
                                <label>Tentative Date of Delivery :</label> <?= printFormatedDate($requestDetails->tentativ_date_delivery); ?>  
                            </div>
                            </div>-->
                            <div class="col-lg-4">
                                <div class="edibx1">
                                            <label>Offer response on or before :</label> <?=printFormatedDate($requestDetails->response_end_date)?>
                                    </div>
                                    </div>
                                <div class="col-12 col-lg-4">
                                        <div class="edibx1">
                                           <label>Expected Payment Term :</label> <?= $requestDetails->payment_term?>
                                             
                                    </div>
                                    </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12">
                            <div class="edibx1">
                                <label>Any Special Consideration for LCL</label>
                                 <div class="input-comment">
                                    <?= $requestDetails->special_consideration_lcl; ?>
                                 </div>    
                            </div>
                            </div>
                        </div>
<!--                        <div class="form-group">
                               <div class="row">
                                   <div class="col-lg-4">
                                            <label>Response by date :</label><?=$requestDetails->response_end_date?>
                                    </div>
                               </div>
                            </div>-->
                            <h3><b>Material Detail</b></h3>
                            
                            <div class="multi-container hideLCL" style="<?= $requestDetails->shipment_id=='2'?'display:none;':''; ?>">
                                <?php if(!empty($requestDetails->container)){ ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Container</th>
                                            <th>Size</th>
                                            <th>Container Type</th>
                                            <th>Qty</th>
                                            <th>G.W.(Kg)</th>
                                            <th>Packing</th>
                                            <th>HSN Code</th>
                                            <th>Material Type</th>
                                            <th>Description</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php $totalContainers = 0;
                                    foreach ($requestDetails->container as $key=>$row){
                                        $totalContainers +=$row->number_of_container;
                                    $sumGrossWeight += $row->gross_weight;?>
                                
                                        <tr>
                                            <td>Container <?=$key+1?>
                                            <input type="hidden" name="items[<?=$key?>][item_id]" value="<?=$row->id;?>">
                                            <input type="hidden" name="items[<?=$key?>][item_type]" value="container">
                                            </td>
                                            <td><?=$row->container_size_title?$row->container_size_title:'- -'?></td>
                                            <td><?=$row->container_type_name?$row->container_type_name:'- -'?></td>
                                            <td><?=$row->number_of_container?$row->number_of_container:'- -'?></td>
                                            <td><?=$row->gross_weight?$row->gross_weight:'- -'?></td>
                                            <td><?=$row->type_of_packing_name?$row->type_of_packing_name:'- -'?></td>
                                            <td><?=$row->hs_code?$row->hs_code:'- -'?></td>
                                            <td><?=$row->material_type?$row->material_type:'- -'?></td>
                                            <td><?=$row->material_description?$row->material_description:'- -'?></td>
                                            <td><?=$row->remarks?$row->remarks:'- -'?></td>
                                        </tr>
                                   
                                <?php }?>
                                         <?php if(!empty($requestDetails->container)){?>
                                        <tr><td colspan="3" class="text-left">Summary</td>
                                            <td><?=$totalContainers?></td>
                                            <td><?=$sumGrossWeight?></td>
                                            <td colspan="5"></td>
                                        </tr>
                                        <?php }?>
                                         </tbody>
                                </table>
                                <?php }?>
                                
                           </div>
                            

                            <div class="multi-packaging hideFCL" style="<?= $requestDetails->shipment_id=='1'||empty($requestDetails->shipment_id)?'display:none;':''; ?>">
                               <?php  if(!empty($requestDetails->package)){ ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>Material Type</th>
                                            <th>Description</th>
                                            <th>HSN Code</th>
                                            <th>Packing</th>
                                            <th>Remark</th>
                                            <th>L x W x H (Cm)</th>
                                            <th>Volume(CBM)</th>
                                            <th>Volumetric Weight(Kg)</th>
                                            <th>N.W.(Kg)</th>
                                            <th>G.W.(Kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php  $sumVolume = 0;$sumNetWeight =0;$sumGrossWeight =0;
                                foreach ($requestDetails->package as $key=>$row){
                                    $sumVolume += $row->volume;
                                    $sumVolumetricWeight += $row->volumetric_weight;
                                    $sumNetWeight += $row->net_weight;
                                    $sumGrossWeight += $row->gross_weight;
                                    ?>
                                <tr>
                                            <td>Package <?=$key+1?>
                                            <input type="hidden" name="items[<?=$key?>][item_id]" value="<?=$row->id;?>">
                                            <input type="hidden" name="items[<?=$key?>][item_type]" value="container">
                                            </td>
                                            <td><?= $row->material_type?$row->material_type:'- -' ?></td>
                                            <td><?= $row->material_description?$row->material_description:'- -' ?></td>
                                            <td><?= $row->hs_code?$row->hs_code:'- -' ?></td>
                                            <td><?= $row->type_of_packing_name?$row->type_of_packing_name:'- -' ?></td>
                                            <td><?= $row->remarks?$row->remarks:'- -' ?></td>
                                            <td><?= $row->length.' x '.$row->width.' x '.$row->height; ?></td>
                                            <td><?= $row->volume; ?></td>
                                            <td><?= $row->volumetric_weight; ?></td>
                                            <td><?= $row->net_weight; ?></td>
                                            <td><?= $row->gross_weight; ?></td>
                                </tr>
                                <?php }?>
                                    
                                <?php if(!empty($requestDetails->package)) {?>
                                <tr class="font-weight-bold">
                                    <td class="text-left" colspan="7">Summary:</td>
                                    <td><?=$sumVolume?></td>
                                    <td><?=$sumVolumetricWeight?></td>
                                    <td><?=$sumNetWeight?></td>
                                    <td><?=$sumGrossWeight?></td>
                                </tr>
                                 <?php }?>
                                </tbody>
                                </table>
                                <?php }?>
                              
                           </div>
                          <?php if(!empty($rfc_charges)){
                                $rfc_charge_counter=0;
                                ?>
                                
                                
                                <?php foreach ($rfc_charges as $key=>$rfc_charge){?>
                             <?php if(!empty($rfc_charge->subCategory)){?>
                                
                            <?php if($rfc_charge->id == '2'){?>
                            <h3><b><?=$rfc_charge->rfc_category_name?></b><?=$transactionCurrencyHtml?></h3>
                           <?php }else if(in_array($rfc_charge->id, ['3','6'])){?>
                           
                                    <?php if($rfc_charge->id == 3 && $requestDetails->mode_id == 3) {//sea?>
                                    <h3><b><?=$rfc_charge->rfc_category_name?> </b><?=$transactionCurrencyHtml?></h3>
                                    <?php }?>
                                    
                                    <?php if($rfc_charge->id == 6  && $requestDetails->mode_id == 2) {//air?>
                                    <h3><b><?=$rfc_charge->rfc_category_name?></b><?=$transactionCurrencyHtml?></h3>
                                    <?php }?>
                                    
                           <?php }else{?>
                            <h3><b><?=$rfc_charge->rfc_category_name?></b><?=$transactionCurrencyHtml?></h3>
                           <?php }?>
                            
                                <?php  if($rfc_charge->id == '2' && in_array($requestDetails->shipment_id, ['1']) ){ ?>
                                <div class="row">
                                <div class="col-lg-12">
                                    
                                    <table class="table" id="particulars">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Vehicle</th>
                                            <th>Transport Charge</th>
                                            <th>Labor Charge</th>
                                            <th>Detention Charge</th>
                                            <th>Qty</th>
                                            <th>Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php if(!empty($particulars)) {?>
                                                    <?php $totalParticularCost=0; foreach ($particulars as $key=>$particular){
                                                        $totalParticularCost+=$particular->cost;?>
                                            <tr>
                                                <td><?=$key+1?></td>
                                                <td><?=$particular->vehicle?></td>
                                                <td><?=number_format($particular->transport_charge,2)?></td>
                                                <td><?=number_format($particular->varai_charge,2)?></td>
                                                <td><?=number_format($particular->detention_charge,2)?></td>
                                                <td><?=$particular->qty?></td>
                                                <td><?= number_format($particular->cost,2)?></td>
                                            </tr>
                                                    <?php }?>
                                            <tr class="font-weight-bold">
                                                <td colspan="6" class="text-right">Total</td>
                                                <td><?=number_format($totalParticularCost,2)?></td>
                                            </tr>
                                            <?php } else{?>
                                             
                                            <?php }?>
                                        </tbody>
                                    </table>
                            </div>
                            </div>
                            <?php } else{?>
                                
                               
                                
                                <?php }?>
                             <div class="row" id="rfcChargesDiv">
                                    
                                    <?php if(in_array($rfc_charge->id, ['3','6'])){?>
                           
                                    <?php if($rfc_charge->id == 3 && $requestDetails->mode_id == 3) {//sea?>
                                    <?php foreach ($rfc_charge->subCategory as $key2=>$sub_rfc_charge){
                                    $rfc_charge_counter++;
                                    ?>
                                <div class="col-lg-3 mb-2">
                                   <label class="pull-left" ><?=$sub_rfc_charge->sub_account?>:</label> <?=$sub_rfc_charge->unit?"<small>(".$sub_rfc_charge->unit.")</small>":''?>
                                    <span class="pull-right"><?=number_format($sub_rfc_charge->charges,2)?></span>
                                </div>
                                <?php }?>
                                    <?php }?>
                                    
                                    <?php if($rfc_charge->id == 6  && $requestDetails->mode_id == 2) {//air?>
                                    <?php foreach ($rfc_charge->subCategory as $key2=>$sub_rfc_charge){
                                    $rfc_charge_counter++;
                                    ?>
                                <div class="col-lg-3 mb-2">
                                   <label class="pull-left" ><?=$sub_rfc_charge->sub_account?>:</label> <?=$sub_rfc_charge->unit?"<small>(".$sub_rfc_charge->unit.")</small>":''?>
                                    <span class="pull-right"><?=number_format($sub_rfc_charge->charges,2)?></span>
                                </div>
                                <?php }?>
                                    <?php }?>
                                    
                           <?php }else{?>
                            <?php foreach ($rfc_charge->subCategory as $key2=>$sub_rfc_charge){
                                    $rfc_charge_counter++;
                                    ?>
                                  <?php if(in_array($sub_rfc_charge->id ,['1','2']) &&  in_array($requestDetails->shipment_id, ['1'])){?>
                                  <?php }else{?>
                                <div class="col-lg-3 mb-2">
                                   <label class="pull-left" ><?=$sub_rfc_charge->sub_account?>:</label> <?=$sub_rfc_charge->unit?"<small>(".$sub_rfc_charge->unit.")</small>":''?>
                                    <span class="pull-right"><?=number_format($sub_rfc_charge->charges,2)?></span>
                                </div>
                                <?php }?>
                                <?php }?>
                           <?php }?>
                            
                                
                            </div>
                                <?php }?>
                                <?php }?>
                            <?php }?>
                           
                           
                           

                            <div class="row mt-5">
                             <div class="col-lg-2 mb-2">
                                 <h3 >Total Quote Value<?=$transactionCurrencyHtml?></h3>
                              </div>
                               <div class="col-lg-2 mb-2">
                                  <h3 > <?=$requestDetails->total_quote_amount?></h3 >
                                   
                             </div>
                             <div class="col-lg-2 mb-2">
                                 <h3 >Counter Rate<?=$transactionCurrencyHtml?></h3>
                              </div>
                               <div class="col-lg-2 mb-2">
                                  
                                  <?=$requestDetails->counter_rate?>
                             </div>
                             </div>
                                
                    </div>
                    </form>
              </div>
            </div>
        </div>
          </div>
                  
                  
                  </div>
                  
          </div>
                  
                  
          </div>
       </div>
           
     </div>
   </div>
   <!-- Blog content end --> 
   </section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->
<!--Start:: add City Modal -->
<div class="modal fade" id="addNewCityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add City</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="addCityFrm" name="addCityFrm"  method="post" action="">
          <div class="form-group">
              <input type="hidden" name="city_prefix" value="" id="city_prefix">
          <div class="row">
              <div class="col-lg-4">
        <label for="country">Country</label>
        <input type="text" class="form-control alpha-num-space" placeholder="Country" id="country" name="country" maxlength="50" required="">
      </div>
          <div class="col-lg-4">
        <label for="state">State</label>
        <input type="text" class="form-control alpha-num-space" placeholder="State" id="state" name="state" maxlength="50" required>
      </div>
          <div class="col-lg-4">
        <label for="city">City</label>
        <input type="text" class="form-control alpha-num-space" placeholder="City" id="city" name="city" maxlength="50" required>
      </div>
          </div>
          </div>
              </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--End:: add City Modal -->

<script type="text/javascript">
var session_user_id = '<?=$this->session->userdata("seller_logged_in")['id'];?>';
$('#addNewCityModal button[type="submit"]').click(function(e){
    var city_prefix = $('#city_prefix').val();
    var city = $('#addNewCityModal #city').val();
    var state = $('#addNewCityModal #state').val();
    var country = $('#addNewCityModal #country').val();
    e.preventDefault();
    $('#addCityFrm').validate({
        rules:{
            country:{required:true},
            state:{required:true},
            city:{required:true},
        }
    });
    if(!$('#addCityFrm').valid()){
        return false;
    }
    $.ajax({
           type:'post',
           url:'<?php echo base_url('ajax-add-city'); ?>',
           //dataType:'json',
           data:{country:country,state:state,city:city,session_user_id:session_user_id},
           success:function(response){
              var json_response = JSON.parse(response);
              console.log(city_prefix,json_response);
              $('#'+city_prefix+'_city_id').val(json_response.city_id);
              $('#'+city_prefix+'_state_id').val(json_response.state_id);
              $('#'+city_prefix+'_country_id').val(json_response.country_id);
              $('#'+city_prefix+'_city_name').val(json_response.city_name);
              $('#addNewCityModal').modal('hide');
           }
        });
} );


</script>
<!--[strat::city]-->
<style type="text/css">
#country-list{float:left;list-style:none;margin:0;padding:0;width:740px; z-index:1010; position:absolute;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
</style>
<script type="text/javascript">
$('.from-profileCitySearch input.search-box').on('keyup',function(e){
        var keyword = $(this).val();
        
        console.log(keyword);
        if(keyword!==""){
		$.ajax({
		type: "POST",
		url: $('#base_url').val()+"ajax-city-list",
		data:'keyword='+keyword,
		beforeSend: function(){
			$("#search-box").css("background","#FFF url("+$('#base_url').val()+"media/images/ajax-loader.gif) no-repeat 165px");
		},
		success: function(data){
			$(".from-profileCitySearch .cityId").val('');
			$(".from-profileCitySearch .stateId").val('');
			$(".from-profileCitySearch .countryId").val('');
			$(".from-profileCitySearch .suggesstion-box").show();
			$(".from-profileCitySearch .suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
                }else{
                $(".from-profileCitySearch .cityId").val('');
                $(".from-profileCitySearch .stateId").val('');
                $(".from-profileCitySearch .countryId").val('');
                $(".from-profileCitySearch .suggesstion-box").hide();
            }
    });
    
    $('.from-profileCitySearch input.search-box').on('blur',function(e){
        ($(".from-profileCitySearch .cityId").val())?'':$(".from-profileCitySearch input.search-box").val('');
        
    });
    
     $(document).on('click','.from-profileCitySearch .suggesstion-box ul li',function(e){
         
         if($(this).attr('data-cityId')!='0'){
           
         $(".from-profileCitySearch .cityId").val($(this).attr('data-cityId'));
         $(".from-profileCitySearch .stateId").val($(this).attr('data-stateId'));
         $(".from-profileCitySearch .countryId").val($(this).attr('data-countryId'));
         $("#transaction_currency").val($(this).attr('data-currency'));
         
         $('.from-profileCitySearch input.search-box').val($(this).text());
          
         }else{
             $('#addNewCityModal #city_prefix').val('consignor');
             $('#addNewCityModal').modal('show');
         }
         $(".from-profileCitySearch .suggesstion-box").hide();
         
     });


    $('.to-profileCitySearch input.search-box').on('keyup',function(e){
        var keyword = $(this).val();
        console.log(keyword);
        if(keyword!==""){
		$.ajax({
		type: "POST",
		url: $('#base_url').val()+"ajax-city-list",
		data:'keyword='+keyword,
		beforeSend: function(){
			$("#search-box").css("background","#FFF url("+$('#base_url').val()+"media/images/ajax-loader.gif) no-repeat 165px");
		},
		success: function(data){
			$(".to-profileCitySearch .cityId").val('');
			$(".to-profileCitySearch .stateId").val('');
			$(".to-profileCitySearch .countryId").val('');
			$(".to-profileCitySearch .suggesstion-box").show();
			$(".to-profileCitySearch .suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
                }else{
                $(".to-profileCitySearch .cityId").val('');
                $(".to-profileCitySearch .stateId").val('');
                $(".to-profileCitySearch .countryId").val('');
                $(".to-profileCitySearch .suggesstion-box").hide();
            }
    });
    
    $('.to-profileCitySearch input.search-box').on('blur',function(e){
        ($(".to-profileCitySearch .cityId").val())?'':$(".to-profileCitySearch input.search-box").val('');
        
    });
    
    $(document).on('click','.to-profileCitySearch .suggesstion-box ul li',function(e){
       if($(this).attr('data-cityId')!='0'){
            
         $(".to-profileCitySearch .cityId").val($(this).attr('data-cityId'));
         $(".to-profileCitySearch .stateId").val($(this).attr('data-stateId'));
         $(".to-profileCitySearch .countryId").val($(this).attr('data-countryId'));
         $("#transaction_currency").val($(this).attr('data-currency'));
         
         $('.to-profileCitySearch input.search-box').val($(this).text());
         
         }else{
             $('#addNewCityModal #city_prefix').val('consignee');
             $('#addNewCityModal').modal('show');
         }
         $(".to-profileCitySearch .suggesstion-box").hide();
     });
     
    $('.loading-port-search input.search-box').on('keyup',function(e){
        var keyword = $(this).val();
        console.log(keyword);
        if(keyword!==""){
		$.ajax({
		type: "POST",
		url: $('#base_url').val()+"ajax-port-list",
		data:'keyword='+keyword+'&type='+$('.mode:checked').val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url("+$('#base_url').val()+"media/images/ajax-loader.gif) no-repeat 165px");
		},
		success: function(data){
                     $(".loading-port-search .port_loading_id").val('');
			$(".loading-port-search .port_loading_name").val('');
			$(".loading-port-search .suggesstion-box").show();
			$(".loading-port-search .suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
                    
			
		}
		});
                }else{
                $(".loading-port-search .port_loading_id").val('');
                $(".loading-port-search .port_loading_name").val('');
                $(".loading-port-search .suggesstion-box").hide();
            }
    });
    
    $('.loading-port-search input.search-box').on('blur',function(e){
        ($(".loading-port-search .port_loading_id").val())?'':$(".loading-port-search input.search-box").val('');
        
    });
    
    $(document).on('click','.loading-port-search .suggesstion-box ul li',function(e){
       if($(this).attr('data-portId')!='0'){
            
         $(".loading-port-search .port_loading_id").val($(this).attr('data-portId'));
         
         $('.loading-port-search input.search-box').val($(this).text());
         
         }else{
              $('#addNewPortModal #port_type').val($('.mode:checked').val());
            $('#addNewPortModal #port_prefix').val('port_loading');
            $('#addNewPortModal').modal('show');
         }
         
         $(".loading-port-search .suggesstion-box").hide();
     });
     
    $('.discharge-port-search input.search-box').on('keyup',function(e){
        var keyword = $(this).val();
        console.log(keyword);
        if(keyword!==""){
		$.ajax({
		type: "POST",
		url: $('#base_url').val()+"ajax-port-list",
		data:'keyword='+keyword+'&type='+$('.mode:checked').val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url("+$('#base_url').val()+"media/images/ajax-loader.gif) no-repeat 165px");
		},
		success: function(data){
			$(".discharge-port-search .port_discharge_id").val('');
			$(".discharge-port-search .port_discharge_name").val('');
			$(".discharge-port-search .suggesstion-box").show();
			$(".discharge-port-search .suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
                }else{
                $(".discharge-port-search .port_discharge_id").val('');
                $(".discharge-port-search .port_discharge_name").val('');
                $(".discharge-port-search .suggesstion-box").hide();
            }
    });
    
    $('.discharge-port-search input.search-box').on('blur',function(e){
        ($(".discharge-port-search .port_discharge_id").val())?'':$(".discharge-port-search input.search-box").val('');
        
    });
    
    $(document).on('click','.discharge-port-search .suggesstion-box ul li',function(e){
       if($(this).attr('data-portId')!='0'){
            
         $(".discharge-port-search .port_discharge_id").val($(this).attr('data-portId'));
         
         $('.discharge-port-search input.search-box').val($(this).text());
         
         }else{
            $('#addNewPortModal #port_type').val($('.mode:checked').val());
            $('#addNewPortModal #port_prefix').val('port_discharge');
            $('#addNewPortModal').modal('show');
         }
         $(".discharge-port-search .suggesstion-box").hide();
     });
     
</script>
<!--[end::city]-->
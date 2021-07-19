
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

@media (min-width: 840px){
	.mdl-grid {
		padding: 8px;
		width: 100% !important;
	}
}
ul#ui-id-1 {
    z-index: 9999 !important;
    padding: 3px !important;
    border: 1px solid #e2e9e6 !important;
	background: #fff !important;
    width: 16.5% !important;
	height:200px !important;
	overflow: auto !important;
}
ul#ui-id-2 {
    z-index: 9999 !important;
    padding: 3px !important;
    border: 1px solid #e2e9e6 !important;
	background: #fff !important;
    width: 16.5% !important;
	height:200px !important;
	overflow: auto !important;
}
.chosen-container-single .chosen-single{
    height: 33px !important;
    background-color: #fff;
    background: -webkit-linear-gradient(top, #ffffff 20%, #ffffff 50%, #ffffff 52%, #ffffff 100%) !important;
    background-clip: unset !important;
    box-shadow: none !important;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
   <!-- Tracking start -->
   <div class="wshipping-content-block">
       
	   <div class="container">
       <div class="row">
          <div class="col-12 col-lg-12">
              <div class="tracking-block">
                  <div class="tab-content">
			<?php if(empty($doc_verified)){ ?>
				<div class="text-box text-box-style3">Your KYC Not Approved / Pending</b></div><br/>
			<?php } ?>
		  <h3 class="heading3-border text-uppercase">Request for Freight Comparative</h3>
		 <!-- Customer Registration Start -->
        <div class="wshipping-content-block shipping-block">
            <div class="container">
              <div class="row">
                    <div class="shipping-form-block">
                       
                        <form id="frmRequirement" name="frmRequirement" class="" action="<?php echo base_url('shipping-requirement'); ?>" accept-charset="UTF-8" enctype="multipart/form-data" method="post" >

                            <input type="hidden" name="request_id" value="<?=$requestDetails->request_id?>"/>
                    <div class="shipping-form">
                            <div class="form-group">
                                   <div class="row">

                                           <div class="col-12 col-lg-4">
                                                   <label>Mode <sup>* </sup></label>
                                                   <select name="mode" id="modeId" class="form-control">
                                                           <option value="">Select Mode</option>
                                                           <?php foreach($modes as $mode){ ?>
                                                           <option value="<?php echo $mode['id']; ?>" <?= $requestDetails->mode_id==$mode['id']?'selected':''; ?>><?php echo $mode['type']; ?></option>
                                                           <?php } ?>
                                                   </select>
                                           </div>
                                       <div class="col-12 col-lg-4">
                                                   <label>Delivery Term <sup>* </sup></label>
                                                   <select name="delivery_term" class="form-control">
                                                           <option value="">Select Delivery Term</option>
                                                           <?php foreach($delivery_terms as $delivery_term){ ?>
                                                                   <option value="<?php echo $delivery_term['id']; ?>" <?= $requestDetails->delivery_term_id==$delivery_term['id']?'selected':''; ?>><?php echo $delivery_term['name']; ?></option>
                                                           <?php } ?>
                                                   </select>
                                           </div>
                                       <div class="col-12 col-lg-4">
                                            <label>Shipment Type <sup>* </sup></label>
                                             <div class="input-comment">
                                              <select name="shipment" id="shipment" class="form-control">
                                              <option value="">Select Shipment Type</option>
                                                   <?php foreach($shipments as $shipment){ ?>
                                                           <option value="<?php echo $shipment['id']; ?>" <?= $requestDetails->shipment_id==$shipment['id']?'selected':''; ?>><?php echo $shipment['type']; ?></option>
                                                   <?php } ?>
                                              </select>
                                            </div>    
                                           </div>
                                   </div>
                        <div class="form-group">
                                   <div class="row">
                                       <div class="col-12 col-lg-4">
                                            <label>Container Stuffing <sup>* </sup></label>
                                             <div class="input-comment">
                                              <select name="container_stuffing" id="container_stuffing" class="form-control">
                                              <option value="">Select Container Stuffing</option>
                                              <option value="Stackable" <?= $requestDetails->container_stuffing=="Stackable"?'selected':''; ?> >Stackable</option>
                                              <option value="Non-Stackable" <?= $requestDetails->container_stuffing=="Non-Stackable"?'selected':''; ?>>Non-Stackable</option>

                                              </select>

                                            </div>    
                                           </div>
                                       <div class="col-12 col-lg-4">
                                            <label>Cargo Status <sup>* </sup></label>
                                             <div class="input-comment">
                                              <select name="cargo_status" id="cargo_status" class="form-control">
                                              <option value="">Select Cargo Status</option>
                                              <option value="Hazardous" <?= $requestDetails->cargo_status=="Hazardous"?'selected':''; ?>>Hazardous</option>
                                              <option value="Non-Hazardous" <?= $requestDetails->cargo_status=="Non-Hazardous"?'selected':''; ?>>Non-Hazardous</option>

                                              </select>

                                            </div>    
                                           </div>
                                   </div>
                           </div>
                        <div class="row">
                             <div class="col-lg-6">
                                 <h3><b>Consignor/Pick up</b></h3>
                               <div class="form-row mb-3">
                                    <label>Contact Person Name <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignor_name" id="consignor_name"  placeholder="Contact Person Name" maxlength="50" value="<?= $requestDetails->consignor_name; ?>" >
                                </div>
                                  <div class="form-row mb-3">
                                       <label>Contact Number <sup>*</sup></label>
                                        <div class="input-group">
                                       <div class="input-group-prepend">
                                           <select class="input-group-text" name="consignor_country_code" id="consignor_country_code">
                                             <option value="+91" >+91</option>
                                             <option value="+92">+92</option>
                                             <option value="+93">+93</option>
                                         </select>
                                       </div>
                                       <input type="text" class="form-control" name="consignor_phone"  placeholder="Contact Number" maxlength="15" value="<?= $requestDetails->consignor_phone; ?>" >
                                     </div>
                               </div>
                                <div class="form-row mb-3">
                                    <label>Address line 1 <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignor_address_line_1" id="consignor_address_line_1"  placeholder="Address line 1" maxlength="50" value="<?= $requestDetails->consignor_address_line_1; ?>" >
                                </div>
                                 <div class="form-row mb-3">
                                    <label>Address line 2 <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignor_address_line_2" id="consignor_address_line_2"  placeholder="Address line 2" maxlength="50" value="<?= $requestDetails->consignor_address_line_2; ?>" >
                                </div>
                                 <div class="form-row mb-3 from-profileCitySearch">
                                       <label>City <sup>*</sup></label>
                                       <input type="text" class="form-control search-box" name="consignor_city_name" id="consignor_city_name" placeholder="Type City Name" autocomplete="off" value="<?= $requestDetails->consignor_city_name; ?>">
                                       <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                       <input type="hidden" class="cityId" id="consignor_city_id" name="consignor_city_id" value="<?= $requestDetails->consignor_city_id; ?>" >
                                       <input type="hidden" class="stateId" id="consignor_state_id" name="consignor_state_id"  value="<?= $requestDetails->consignor_state_id; ?>" >
                                       <input type="hidden" class="countryId" id="consignor_country_id" name="consignor_country_id" value="<?= $requestDetails->consignor_country_id; ?>">
                                   </div>
                                 <div class="form-row mb-3">
                                    <label>Pin code <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignor_pincode" id="consignor_pincode"  placeholder="Pin code" maxlength="10" value="<?= $requestDetails->consignor_pincode; ?>"  >
                                </div>

                        </div>
            <div class="col-lg-6">
                                 <h3><b>Consignee/Deliver To</b></h3>
                               <div class="form-row mb-3">
                                    <label>Contact Person Name <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignee_name" id="consignee_name"  placeholder="Contact Person Name" maxlength="50" value="<?= $requestDetails->consignee_name; ?>"  >
                                </div>
                                  <div class="form-row mb-3">
                                       <label>Contact Number <sup>*</sup></label>
                                        <div class="input-group">
                                       <div class="input-group-prepend">
                                           <select class="input-group-text" name="consignee_country_code" id="contact_country_code">
                                             <option value="+91">+91</option>
                                             <option value="+92">+92</option>
                                             <option value="+93">+93</option>
                                         </select>
                                       </div>
                                       <input type="text" class="form-control" name="consignee_phone"  placeholder="Contact Number" maxlength="15" value="<?= $requestDetails->consignee_phone; ?>" >
                                     </div>
                               </div>
                                <div class="form-row mb-3">
                                    <label>Address line 1 <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignee_address_line_1" id="consignee_address_line_1"  placeholder="Address line 1" maxlength="50"  value="<?= $requestDetails->consignee_address_line_1; ?>" >
                                </div>
                                 <div class="form-row mb-3">
                                    <label>Address line 2 <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignee_address_line_2" id="consignee_address_line_2"  placeholder="Address line 2" maxlength="50" value="<?= $requestDetails->consignee_address_line_2; ?>" >
                                </div>
                                 <div class="form-row mb-3 to-profileCitySearch">
                                       <label>City <sup>*</sup></label>
                                       <input type="text" class="form-control search-box" name="consignee_city_name" id="consignee_city_name" placeholder="Type City Name" autocomplete="off" value="<?= $requestDetails->consignee_city_name; ?>" >
                                       <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                       <input type="hidden" class="cityId" id="consignee_city_id" name="consignee_city_id" value="<?= $requestDetails->consignee_city_id; ?>" >
                                       <input type="hidden" class="stateId" id="consignee_state_id" name="consignee_state_id" value="<?= $requestDetails->consignee_state_id; ?>">
                                       <input type="hidden" class="countryId" id="consignee_country_id" name="consignee_country_id" value="<?= $requestDetails->consignee_country_id; ?>" >
                                   </div>
                                 <div class="form-row mb-3">
                                    <label>Pin code <sup>*</sup></label>
                                    <input type="text" class="form-control" name="consignee_pincode" id="consignee_pincode"  placeholder="Pin code" maxlength="10"  value="<?= $requestDetails->consignee_pincode; ?>"   >
                                </div>

                        </div>
                        </div>

                        </div>


                            <div class="form-group" style="margin-top: 20px;">
                             <div class="row">
                                    <div class="col-12 col-lg-4">
                                           <label>Shipment Value: </label>
                                           <div style="display: flex;">
                                                   <input type="number" class="form-control" name="shipment_value" id="shipment_value"  value="<?= $requestDetails->shipment_value; ?>" />
                                                   <select class="form-control" name="shipment_value_currency" style="width: 80px;">
                                                           <option selected disabled>Currency</option>
                                                           <option value="INR" <?= $requestDetails->shipment_value_currency=="INR"?'selected':''; ?>>INR</option>
                                                           <option value="USD" <?= $requestDetails->shipment_value_currency=="USD"?'selected':''; ?>>USD</option>
                                                           <option value="EUR" <?= $requestDetails->shipment_value_currency=="EUR"?'selected':''; ?>>EUR</option>
                                                           <option value="JPY" <?= $requestDetails->shipment_value_currency=="JPY"?'selected':''; ?>>JPY</option>
                                                   </select>
                                           </div>
                                    </div>
                                 <div class="col-12 col-lg-4 mode-sea" style="display:none;">
                                     <label>Port Of Loading<sup>* </sup></label>
                                             <div class="input-comment">
                                              <select name="port_loading_id" class="form-control">
                                              <option value="">Select Port</option>
                                                   <?php foreach($pol as $pol){ ?>
                                                           <option value="<?php echo $pol['id']; ?>" <?= $requestDetails->port_loading_id==$pol['id']?'selected':''; ?> ><?php echo $pol['name']; ?></option>
                                                   <?php } ?>
                                              </select>
                                            </div>  
                                    </div>
                                    <div class="col-12 col-lg-4 mode-sea" style="display:none;">
                                           <label>Port Of Discharge<sup>* </sup></label>
                                             <div class="input-comment">
                                              <select name="port_discharge_id" class="form-control">
                                              <option value="">Select Port</option>
                                                   <?php foreach($pod as $pod){ ?>
                                                           <option value="<?php echo $pod['id']; ?>" <?= $requestDetails->port_discharge_id==$pod['id']?'selected':''; ?>><?php echo $pod['name']; ?></option>
                                                   <?php } ?>
                                              </select>
                                            </div>
                                    </div>
                             </div>
                           </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label>Tentative Date of Dispatch</label>
                                 <div class="input-comment">
                                     <input type="date" name="tentativ_date_dispatch" id="tentativ_date_dispatch" class="form-control" placeholder="DD-MM-YYYY" value="<?= $requestDetails->tentativ_date_dispatch; ?>"/>
                                 </div>    
                            </div>
                            <div class="col-12 col-lg-6">
                                <label>Tentative Date of Delivery</label>
                                 <div class="input-comment">
                                     <input type="date" class="form-control" name="tentativ_date_delivery" id="tentativ_date_delivery" placeholder="DD-MM-YYYY" value="<?= $requestDetails->tentativ_date_delivery; ?>"/>
                                 </div>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <label>Any Special Consideration for LCL</label>
                                 <div class="input-comment">
                                     <textarea class="form-control" name="special_consideration_lcl" id="special_consideration_lcl" placeholder="Refrigerated container,  specific temperature, multiple type of goods,  special packing requirement."><?= $requestDetails->special_consideration_lcl; ?></textarea>
                                 </div>    
                            </div>
                        </div>
                         <div class="form-group">
                               <div class="row">
                                   <div class="col-lg-4">
                                            <label>Response end date <sup>* </sup></label>
                                            <input type="date" class="form-control" name="response_end_date" value="<?=$requestDetails->response_end_date?>"/>
                                    </div>
                               </div>
                            </div>
                        
                            <h3><b>Material Detail</b></h3>
                            <span class="btn btn-small btn-warning hideLCL" id="add_more_container" style="<?= $requestDetails->shipment_id=='2'?'display:none;':''; ?>">Add Container</span>
                            <div class="multi-container hideLCL" style="<?= $requestDetails->shipment_id=='2'?'display:none;':''; ?>">
                                <?php if(!empty($requestDetails->container)){ ?>
                                <?php foreach ($requestDetails->container as $key=>$row){?>
                                <?php $this->load->view('frontend/ajax/ajaxAddContainer',['containerCounter'=>$key+1,'container_types'=>$container_types,'containerSizeList'=>$containerSizeList,'packingList'=>$packingList,'item_details'=>$row]); ?>
                                <?php }?>
                                <?php }else{?>
                                 <?php $this->load->view('frontend/ajax/ajaxAddContainer',['containerCounter'=>1,'container_types'=>$container_types,'containerSizeList'=>$containerSizeList,'packingList'=>$packingList]); ?>
                                <?php }?>
                           </div>
                            
                            <span class="btn btn-small btn-warning hideFCL" id="add_more_package" style="<?= $requestDetails->shipment_id=='1'||empty($requestDetails->shipment_id)?'display:none;':''; ?>">Add Package</span>

                            <div class="multi-packaging hideFCL" style="<?= $requestDetails->shipment_id=='1'||empty($requestDetails->shipment_id)?'display:none;':''; ?>">
                               <?php if(!empty($requestDetails->package)){ ?>
                                <?php foreach ($requestDetails->package as $key=>$row){?>
                                <?php $this->load->view('frontend/ajax/ajaxAddPackage',['packageCounter'=>$key+1,'item_details'=>$row,'packingList'=>$packingList]); ?>
                                <?php }?>
                                <?php }else{?>
                                <?php $this->load->view('frontend/ajax/ajaxAddPackage',['packageCounter'=>1,'packingList'=>$packingList]); ?>
                                <?php }?>
                           </div>
                           
                           
                          
                           
                    </div>
                    <!--<input type="submit" name="submit" class="submit action-button" value="Save & Continue" />-->
                    <input type="submit" name="submit" class="btn btn-success" value="Submit" />
                    <a href="<?= base_url('fs-request-list');?>" class="btn btn-secondary">Cancel</a>
                    </form>
                    </div>
              </div>
            </div>
        </div>
        <!-- Customer Registration end -->
          </div>
          </div>
          </div>
       </div>
     </div>
   </div>
   <!-- Blog content end --> 
  </section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->

<!-- Modal -->
<div class="modal fade" id="convertarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Converter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
          <div class="col-lg-12">
          <table class="table"> 
              <thead>
                  <tr>
                      <td></td>
                      <td>Length</td>
                      <td>Width</td>
                      <td>Height</td>
                      <td>Volume</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>
<!--                          <label>From:</label>-->
                <select class="form-control" id="convertFrom">
                      <option value="Cm">Cm</option>
                      <option value="Inch">Inch</option>
                      <option value="Foot">Foot</option>
                      <option value="Meter">Meter</option>
                  </select></td>
                      <td><input type="number" class="form-control lenght1"></td>
                      <td><input type="number" class=" form-control width1"></td>
                      <td><input type="number" class=" form-control height1"></td>
                      <td><input type="number" class=" form-control volume1" readonly></td>
                  </tr>
                  <tr>
                      <td>
<!--                          <label>To:</label>-->
                  <select class="form-control" id="convertTo">
                      <option value="Cm">Cm</option>
                  </select></td>
                      <td><input type="number" class=" form-control lenght2" readonly></td>
                      <td><input type="number" class=" form-control width2" readonly></td>
                      <td><input type="number" class=" form-control height2" readonly></td>
                      <td><input type="number" class=" form-control volume2" readonly></td>
                  </tr>
              </tbody>
          </table>
          </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnConvert" class="btn btn-primary">Convert</button>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" ></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 

<script type="text/javascript">


$("#quote_country").change(function(){
		var quote_country = $(this).val();
		$('#quote_region').empty();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('seller/getAjaxState'); ?>",
			data:{countryN:quote_country},
			success: function(response){
				var res = JSON.parse(response);
				$('#quote_region').append('<option value="" disabled selected>Select Region</option>');
				$.each(res, function(key, value) {   
					 $('#quote_region')
						 .append($("<option></option>")
									.attr("value",value.state_name)
									.text(value.state_name)); 
				});
			}
		});
});

var pckcount = 2;
$('#add_more_package').click(function(){
	
        $.ajax({
           type:'post',
           url:'<?php echo base_url('ajax-add-package'); ?>',
           //dataType:'json',
           data:{packageCounter:pckcount},
           success:function(response){
              
               $('.multi-packaging').append(response);
           }
        });
	//$('.multi-packaging').append('<div class="form-group" style="padding: 10px; border: 1px solid #ccc;"><span><b>Package '+pckcount+'</b></span><div class="row"><div class="col-12 col-lg-4"><label>Material Description <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="material" required="required" /><span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle"></i></span></div></div><div class="col-12 col-lg-4"><label>HS Code <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="hs_code" required="required" /><span class="error1" style="display: none;"><i class="error-log fa fa-exclamation-triangle"></i></span> </div></div><div class="col-12 col-lg-4"><label>Type Of Packing <sup>* </sup></label><div class="input-comment"><select name="material_unit" class="form-control"><option value="">Select Packing</option><option>Wooden</option><option>Pallet</option><option>Box</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Net Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="net_weight" id="net_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Gross Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="gross_weight" id="gross_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Length: </label><div style="display: flex;"><input type="text" class="form-control" name="length" id="length" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Height: </label><div style="display: flex;"><input type="text" class="form-control" name="height" id="height" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div><div class="col-12 col-lg-4"><label>Width: </label><div style="display: flex;"><input type="text" class="form-control" name="width" id="width" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div></div>');
	pckcount++;
});
var contcount = 2;
$('#add_more_container').click(function(){
	
        $.ajax({
           type:'post',
           url:'<?php echo base_url('ajax-add-container'); ?>',
           //dataType:'json',
           data:{containerCounter:contcount},
           success:function(response){
              
               $('.multi-container').append(response);
           }
        });
	contcount++;
});


$('#shipment').change(function(){
	
	var shpval = $(this).val();
	
	if(shpval == 2){
		$('.hideLCL').hide();
		$('.hideFCL').show();
	}else{
		$('.hideFCL').hide();
		$('.hideLCL').show();
	}
});
$('#modeId').change(function(){
	
	var shpval = $(this).val();
	
	if(shpval == 3){
		$('.mode-sea').show();
		
	}else{
		$('.mode-sea').hide();
	}
});

$(document).on('click','.converter-target-div input',function(e){
    var targetDiv = $(this).closest('.converter-target-div');
    console.log(targetDiv);
});

$('#convertarModal input.lenght1').change(function(){
    var length = this.value||0;
    var convertType = getConvertType();
//    lengthConvert(convertType,length);
    $('#convertarModal input.lenght2').val(lengthConvert(convertType,length));
});
$('#convertarModal input.width1').change(function(){
    var length = this.value||0;
    var convertType = getConvertType();
//    lengthConvert(convertType,length);
    $('#convertarModal input.width2').val(lengthConvert(convertType,length));
});
$('#convertarModal input.height1').change(function(){
    var length = this.value||0;
    var convertType = getConvertType();
//    lengthConvert(convertType,length);
    $('#convertarModal input.height2').val(lengthConvert(convertType,length));
});

function getConvertType(){
  return  $('#convertarModal #convertFrom').val()+'_'+$('#convertarModal #convertTo').val();
}

var lengthConvert =function (convertType,value){
    let result ;
    switch(convertType){
       case 'Cm_Cm': result = value;
                break;
       case 'Inch_Cm': result = value/0.39370;
                break;
       case 'Foot_Cm': result = value/0.032808;
                break;
       case 'Meter_Cm': result = value/0.01;
                break;
        default:  result = value;      
    }
    
    return result.toFixed(0);
}


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
         $(".from-profileCitySearch .cityId").val($(this).attr('data-cityId'));
         $(".from-profileCitySearch .stateId").val($(this).attr('data-stateId'));
         $(".from-profileCitySearch .countryId").val($(this).attr('data-countryId'));
         $("#transaction_currency").val($(this).attr('data-currency'));
         $(".from-profileCitySearch .suggesstion-box").hide();
         $('.from-profileCitySearch input.search-box').val($(this).text());
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
         $(".to-profileCitySearch .cityId").val($(this).attr('data-cityId'));
         $(".to-profileCitySearch .stateId").val($(this).attr('data-stateId'));
         $(".to-profileCitySearch .countryId").val($(this).attr('data-countryId'));
         $("#transaction_currency").val($(this).attr('data-currency'));
         $(".to-profileCitySearch .suggesstion-box").hide();
         $('.to-profileCitySearch input.search-box').val($(this).text());
     });
     
</script>
<!--[end::city]-->
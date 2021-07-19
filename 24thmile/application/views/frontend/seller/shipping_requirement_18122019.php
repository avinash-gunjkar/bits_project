
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
       <div class="row promo-box" style="background-image: url('<?php echo base_url('assets/frontend/images/bg-header.jpg'); ?>');background-repeat: no-repeat;background-position: center;">
		   <div class="container">
			   <div class="row">
				  <div class="col-12 col-lg-4">
					<br/>
					<span style="font-size:22px;color: #f25859;"><?php echo $myProfile->company_name; ?></span>
					<span class="text-white">( <i><?php echo ($myProfile->role == 2) ? 'Seller':'Freight Forwarder'; ?></i> ) </span>
<!-- 					 <div class="section-title wow fadeInUp">
						<div class="comment-img">
						<?php if($myProfile->profile_pic){ ?>
						<img src="<?php //echo $myProfile->profile_pic; ?>" alt="" />
						<?php }else{ ?>
						<img src="<?php //echo base_url('assets/frontend/images/comment-pic1.jpg'); ?>" alt="" />
						<?php } ?>
						</div>
						 <h4 class="text-white" style="margin-top:0px !important;margin-bottom:40px !important;"><?php //echo $myProfile->company_name; ?></h4>
					 </div> -->
				  </div>
				  <div class="col-12 col-lg-8">
					 <div class="wow fadeInUp pt10 pull-right">
						<a href="<?php echo base_url('my-profile'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">My Profile</span></a>
						<a href="<?php echo base_url('request-list'); ?>"><span class="custom-btn-reg cbtn-yellow text-uppercase cbtn-shadow" style="margin-top: 20px;">RFC</span></a>
						<a href="<?php echo base_url('shipment-list'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">Shipments</span></a>
					 </div>
				  </div>
			   </div>
		   </div>
       </div>
	   <br/>
	   <div class="container">
       <div class="row">
          <div class="col-12 col-lg-12">
			<?php if(empty($doc_verified)){ ?>
				<div class="text-box text-box-style3">Your KYC Not Approved / Pending</b></div><br/>
			<?php } ?>
		  <h3 class="heading3-border text-uppercase">Request for Freight Comparative</h3>
		 <!-- Customer Registration Start -->
		   <div class="wshipping-content-block shipping-block">
			 <div class="container">
			   <div class="row">
				 <div class="shipping-form-block">
				 <form class="steps" action="<?php echo base_url('shipping-requirement'); ?>" accept-charset="UTF-8" enctype="multipart/form-data" method="post" >
				   <fieldset>
					 <div class="shipping-form">
						 <div class="form-group">
							<div class="row">
								<div class="col-12 col-lg-4">
									<label>Transaction <sup>* </sup></label>
									<select name="transaction" class="form-control" required>
										<option value="">Select Transaction</option>
										<option value="Import">Import</option>
										<option value="Export">Export</option>
									</select>
									<span class="error1" style="display: none;">
									Select Transaction
									</span>
								</div>
								<div class="col-12 col-lg-4">
									<label>Contracts <sup>* </sup></label>
									<select name="contracts" class="form-control" required>
										<option value="">Select Contract</option>
										<?php foreach($contracts as $contract){ ?>
											<option value="<?php echo $contract['id']; ?>"><?php echo $contract['type']; ?></option>
										<?php } ?>
									</select>
									<span class="error1" style="display: none;">
										Select Contracts
									</span>
								</div>
								<div class="col-12 col-lg-4">
									<label>Mode <sup>* </sup></label>
									<select name="mode" class="form-control" required>
										<option value="">Select Mode</option>
										<?php foreach($modes as $mode){ ?>
											<option value="<?php echo $mode['id']; ?>"><?php echo $mode['type']; ?></option>
										<?php } ?>
									</select>
									<span class="error1" style="display: none;">
										Select Mode
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
						   <div class="row">
								<div class="col-12 col-lg-4">
									<label>Delivery Term <sup>* </sup></label>
									<select name="delivery_term" class="form-control" required>
										<option value="">Select Delivery Term</option>
										<?php foreach($delivery_terms as $delivery_term){ ?>
											<option value="<?php echo $delivery_term['id']; ?>"><?php echo $delivery_term['name']; ?></option>
										<?php } ?>
									</select>
									<span class="error1" style="display: none;">
									Select Delivery Term
									</span>
								</div>
								<div class="col-12 col-lg-4">
								 <label>Shipment Type <sup>* </sup></label>
								  <div class="input-comment">
								   <select name="shipment" id="shipment" class="form-control" required>
								   <option value="">Select Shipment Type</option>
									<?php foreach($shipments as $shipment){ ?>
										<option value="<?php echo $shipment['id']; ?>"><?php echo $shipment['type']; ?></option>
									<?php } ?>
								   </select>
								   <span class="error1" style="display: none;">
									Select Shipment Type
									</span>
								 </div>    
								</div>
							</div>    
						 </div>
						 <h3><b>Consignor/Pick up</b></h3>
						 <div class="form-group">
						   <div class="row">
								<div class="col-12 col-lg-4">
									<label>Address <sup>* </sup></label>
									<textarea type="text" class="form-control" name="pickup_address1" placeholder="Street Address/P.O.box" required="required"/></textarea>
									<span class="error1" style="display: none;">
									Enter Street Address/P.O.box 
									</span>
								</div>
								<div class="col-lg-4">
									 <label>Country <sup>* </sup></label>
									<select class="chosen-select form-control" name="from_country" id="from_country" tabindex="1">
										<option selected disabled value="">Select Country</option>
									  <?php foreach($CName as $country){ ?>
										<option value="<?php echo $country->country_name; ?>"><?php echo $country->country_name; ?></option>
									  <?php }?>
									</select>
								</div>
								<div class="col-12 col-lg-4">
									 <label>State <sup>* </sup></label>
									 <select name="from_state" class="form-control" id="from_state" required="required">
									 </select>
									 <span class="error1" style="display: none;">
									   Select State 
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
						   <div class="row">
							<div class="col-12 col-lg-4">
								 <label>City <sup>* </sup></label>
								 <select name="from_city" class="form-control" id="from_city">
								 </select>
								 <span class="error1" style="display: none;">
								   Select City 
								</span>
							</div>
							<div class="col-12 col-lg-4">
								<label>Pickup Pin/Postal Code <sup>* </sup></label>
								<input type="text" class="form-control" name="pickup_pin" required="required"/>
								<span class="error1" style="display: none;">
								Enter Pickup Pin/Postal Code 
								</span>
							</div>
							<!--<div class="col-12 col-lg-4">
								<label>Pickup Pin/Postal Code <sup>* </sup></label>
								<div id="divOuter">
									<div id="divInner">
										<input type="text" class="form-control" id="partitioned" name="pickup_pin" required="required"/>
									</div>
								</div>
								<span class="error1" style="display: none;">
								Enter Pickup Pin/Postal Code 
								</span>
							</div>-->
						   </div>    
						 </div>
						 <h3><b>Consignee/Deliver To</b></h3>
						 <div class="form-group">
							<div class="row">
							<div class="col-12 col-md-6 col-lg-4">
							<label>Salutation:  </label>
							<select class="form-control" name="salutation">
							 <option value="">Select Salutation</option>
							 <option value="Mr." >Mr.</option>
							 <option value="Mrs." >Mrs.</option>
							 <option value="Ms." >Ms.</option>
							 <option value="Miss" >Miss</option>
							</select>
						   </div>
						   <div class="col-12 col-md-6 col-lg-4">
							<label>First Name: <sup>* </sup></label>
							<input type="text" class="form-control" name="buyer_firstname" required="required" />
						   </div>
						   <div class="col-12 col-md-6 col-lg-4">
							<label>Last Name: <sup>* </sup></label>
							<input type="text" class="form-control" name="buyer_lastname" required="required" />
						   </div>
						 </div> 
							<div class="row">
							<div class="col-12 col-lg-4">
							 <label>Company or Name</label>
							  <input type="text" class="form-control" name="buyer_company"/>
							</div>
							<div class="col-12 col-lg-4">
							 <label>Contact <sup>* </sup></label>
							 <input type="number" class="form-control" name="buyer_contact" required="required"/>
							 <span class="error1" style="display: none;">
							   Enter Contact Number 
							</span>
							</div>
							<div class="col-12 col-lg-4">
							 <label>E-mail  <sup>* </sup></label>
							<input type="email" class="form-control" name="buyer_email" required="required"/>
							<span class="error1" style="display: none;">
							   Enter Valid Email Id 
							</span>
							</div>
						   </div>
						   <div class="row">
							<div class="col-12 col-lg-4">
							 <label>Address <sup>* </sup></label>
							 <textarea type="text" class="form-control" name="deliver_address1" placeholder="Street Address/P.O.box" required="required"/></textarea>
							 <span class="error1" style="display: none;">
							   Enter Street Address/P.O.box 
							</span>
							</div>
							<div class="col-lg-4">
								<label>Country <sup>* </sup></label>
								<select class="chosen-select form-control" name="to_country" id="to_country" tabindex="1">
									<option selected disabled value="">Select Country</option>
								  <?php foreach($CName as $country){ ?>
									<option value="<?php echo $country->country_name; ?>"><?php echo $country->country_name; ?></option>
								  <?php }?>
								</select>
							</div>
							<div class="col-12 col-lg-4">
							 <label>State <sup>* </sup></label>
							 <select name="to_state" class="form-control" id="to_state" required="required">
							 </select>
							 <span class="error1" style="display: none;">
							   Select State 
							</span>
							</div>
						   </div>    
						 </div>
						 <div class="form-group">
						   <div class="row">
							<div class="col-12 col-lg-4">
							 <label>City <sup>* </sup></label>
							 <select name="to_city" class="form-control" id="to_city" required="required">
							 </select>
							 <span class="error1" style="display: none;">
							   Select City 
							</span>
							</div>
							<div class="col-12 col-lg-4">
							 <label>Pickup Pin/Postal Code <sup>* </sup></label>
							 <input type="text" class="form-control" name="deliver_pin" required="required"/>
							 <span class="error1" style="display: none;">
							   Enter Pickup Pin/Postal Code 
							</span>
							</div>
						   </div>    
						 </div>
						 <h3><b>Material Detail</b></h3>
						 <span class="btn btn-small btn-warning hideLCL" id="add_more_container">Add Container</span>
						 <div class="form-group hideLCL" style="padding: 10px; border: 1px solid #ccc;">
							<span><b>Container 1</b></span>
							<div class="row">
								<div class="col-12 col-lg-4">
									<label>Container Type <sup>* </sup></label>
									  <div class="input-comment">
									   <select name="container_type[]" class="form-control">
									   <option value="">Select Shipment Type</option>
										<?php foreach($container_types as $container_type){ ?>
											<option value="<?php echo $container_type['id']; ?>"><?php echo $container_type['type']; ?></option>
										<?php } ?>
									   </select>
									 </div>
								</div>
								<div class="col-12 col-lg-4">
									<label>HS Code <sup>* </sup></label>
									  <div class="input-comment">
										<input type="text" class="form-control" name="hs_code[]" required="required" />
										<span class="error1" style="display: none;">
										   <i class="error-log fa fa-exclamation-triangle"></i>
										</span>
									  </div>
								</div>
								<div class="col-12 col-lg-4">
									 <label>Number of Container <sup>* </sup></label>
									  <div class="input-comment">
										<input type="number" class="form-control" name="num_container[]" required="required" />
										<span class="error1" style="display: none;">
										   <i class="error-log fa fa-exclamation-triangle"></i>
										</span>
									  </div>
								</div>
							</div>
						</div>
						 <span class="btn btn-small btn-warning hideFCL" id="add_more_package" style="display:none">Add Package</span>
						 <div class="form-group hideFCL" style="padding: 10px; border: 1px solid #ccc;display:none">
							<span><b>Package 1</b></span>
							<div class="row">
								<div class="col-12 col-lg-4">
									<label>Material Description <sup>* </sup></label>
									  <div class="input-comment">
										<input type="text" class="form-control" name="material[]" required="required" />
										<span class="error1" style="display: none;">
										   <i class="error-log fa fa-exclamation-triangle"></i>
										</span>
									 </div>
								</div>
								<div class="col-12 col-lg-4">
									<label>HS Code <sup>* </sup></label>
									  <div class="input-comment">
										<input type="text" class="form-control" name="hs_code[]" required="required" />
										<span class="error1" style="display: none;">
										   <i class="error-log fa fa-exclamation-triangle"></i>
										</span>
									  </div>
								</div>
								<div class="col-12 col-lg-4">
									 <label>Type Of Packing <sup>* </sup></label>
									  <div class="input-comment">
									   <select name="type_of_packing[]" class="form-control">
									   <option value="">Select Packing</option>
										<option>Wooden</option>
										<option>Pallet</option>
										<option>Box</option>
									   </select>
									 </div> 
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-lg-4">
									<label>Net Weight: </label>
									<div style="display: flex;">
										<input type="text" class="form-control" name="net_weight[]" id="net_weight" required="required"/>
										<select class="form-control" name="net_weight_uom[]" style="width: 80px;">
											<option selected disabled>UOM</option>
											<option>1 set</option>
											<option>1 lot</option>
											<option>KG</option>
											<option>Liter</option>
											<option>Cub meter</option>
										</select>
									</div>
								 </div>
								 <div class="col-12 col-lg-4">
									<label>Gross Weight: </label>
									<div style="display: flex;">
										<input type="text" class="form-control" name="gross_weight[]" id="gross_weight" required="required"/>
										<select class="form-control" name="gross_weight_uom[]" style="width: 80px;">
											<option selected disabled>UOM</option>
											<option>1 set</option>
											<option>1 lot</option>
											<option>KG</option>
											<option>Liter</option>
											<option>Cub meter</option>
										</select>
									</div>
								 </div>
								 <div class="col-12 col-lg-4">
									<label>Length: </label>
									<div style="display: flex;">
										<input type="text" class="form-control" name="length[]" id="length" required="required"/>
										<select class="form-control" name="length_uom[]" style="width: 80px;">
											<option selected disabled>UOM</option>
											<option>Cm</option>
											<option>Inch</option>
											<option>meter</option>
											<option>foot</option>
										</select>
									</div>
								 </div>
							</div>
							<div class="row">
								<div class="col-12 col-lg-4">
									<label>Height: </label>
									<div style="display: flex;">
										<input type="text" class="form-control" name="height[]" id="height" required="required"/>
										<select class="form-control" name="height_uom[]" style="width: 80px;">
											<option selected disabled>UOM</option>
											<option>Cm</option>
											<option>Inch</option>
											<option>meter</option>
											<option>foot</option>
										</select>
									</div>
								 </div>
								 <div class="col-12 col-lg-4">
									<label>Width: </label>
									<div style="display: flex;">
										<input type="text" class="form-control" name="width[]" id="width" required="required"/>
										<select class="form-control" name="width_uom[]" style="width: 80px;">
											<option selected disabled>UOM</option>
											<option>Cm</option>
											<option>Inch</option>
											<option>meter</option>
											<option>foot</option>
										</select>
									</div>
								 </div>
							</div>
						</div>
						<div class="multi-packaging hideFCL">
							
						</div>
						<div class="multi-container hideLCL">
							
						</div>
						
						<div class="form-group" style="margin-top: 20px;">
						  <div class="row">
							 <div class="col-12 col-lg-4">
								<label>Shipment Value: </label>
								<div style="display: flex;">
									<input type="number" class="form-control" name="shipment_value" id="shipment_value" required="required"/>
									<select class="form-control" name="shipment_value_currency" style="width: 80px;">
										<option selected disabled>Currency</option>
										<option>INR</option>
										<option>USD</option>
										<option>EUR</option>
										<option>JPY</option>
									</select>
								</div>
							 </div>
							 <div class="col-12 col-lg-4">
							  <label>Port Of Loading<sup>* </sup></label>
								  <div class="input-comment">
								   <select name="port_L" class="form-control">
								   <option value="">Select Port</option>
									<?php foreach($pol as $pol){ ?>
										<option value="<?php echo $pol['id']; ?>"><?php echo $pol['name']; ?></option>
									<?php } ?>
								   </select>
								 </div>  
							 </div>
							 <div class="col-12 col-lg-4">
								<label>Port Of Discharge<sup>* </sup></label>
								  <div class="input-comment">
								   <select name="port_D" class="form-control">
								   <option value="">Select Port</option>
									<?php foreach($pod as $pod){ ?>
										<option value="<?php echo $pod['id']; ?>"><?php echo $pod['name']; ?></option>
									<?php } ?>
								   </select>
								 </div>
							 </div>
						  </div>
						</div>
						<h3><b>Quote From</b></h3>
						<div class="form-group">
						   <div class="row">
							<div class="col-lg-4">
								 <label>Country <sup>* </sup></label>
								<select class="form-control" name="quote_country" id="quote_country" required="required">
									<option selected disabled value="">Select Country</option>
									  <?php foreach($CName as $country){ ?>
										<option value="<?php echo $country->country_name; ?>"><?php echo $country->country_name; ?></option>
									  <?php }?>
								</select>
								<span class="error1" style="display: none;">
								   Select Quote Country 
								</span>
							</div>
							<div class="col-12 col-lg-4">
								 <label>Region <sup>* </sup></label>
								 <select name="quote_region" class="form-control" id="quote_region" >
								 </select>
							</div>
						   </div>    
						 </div>
					 </div>
					 <input type="submit" name="submit" class="submit action-button" value="Submit" />
				   </fieldset>
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
   <!-- Blog content end --> 
   <br/>
   <br/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" ></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 

<script type="text/javascript">

	 $("#from_country").chosen().on("change", function(event, params) {
		  if (params.selected) {
			//  $("#status").text('The option: ' + params.selected + ' was selected.');
			//console.log(params.selected);
			$('#from_state').empty();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('seller/getAjaxState'); ?>",
				data:{countryN:params.selected},
				success: function(response){
					var res = JSON.parse(response);
					$('#from_state').append('<option value="" disabled selected>Select State</option>');
					$.each(res, function(key, value) {   
						 $('#from_state')
							 .append($("<option></option>")
										.attr("value",value.state_name)
										.text(value.state_name)); 
					});
				}
			});
		  }
		});
		
$('#from_state').change(function(){
	var state = $(this).val();
	$('#from_city').empty();
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('seller/getAjaxCity'); ?>",
		data:{state:state},
		success: function(response){
			var res = JSON.parse(response);
			$('#from_city').append('<option value="" disabled selected>Select City</option>');
			$.each(res, function(key, value) {   
				 $('#from_city')
					 .append($("<option></option>")
								.attr("value",value.city_name)
								.text(value.city_name)); 
			});
		}
	});
});

$("#to_country").chosen().on("change", function(event, params) {
	if (params.selected) {
		//  $("#status").text('The option: ' + params.selected + ' was selected.');
		//console.log(params.selected);
		$('#to_state').empty();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('seller/getAjaxState'); ?>",
			data:{countryN:params.selected},
			success: function(response){
				var res = JSON.parse(response);
				$('#to_state').append('<option value="" disabled selected>Select State</option>');
				$.each(res, function(key, value) {   
					 $('#to_state')
						 .append($("<option></option>")
									.attr("value",value.state_name)
									.text(value.state_name)); 
				});
			}
		});
	}
});
	
$('#to_state').change(function(){
	var state = $(this).val();
	$('#to_city').empty();
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('seller/getAjaxCity'); ?>",
		data:{state:state},
		success: function(response){
			var res = JSON.parse(response);
			$('#to_city').append('<option value="" disabled selected>Select City</option>');
			$.each(res, function(key, value) {   
				 $('#to_city')
					 .append($("<option></option>")
								.attr("value",value.city_name)
								.text(value.city_name)); 
			});
		}
	});
});

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
	
	$('.multi-packaging').append('<div class="form-group" style="padding: 10px; border: 1px solid #ccc;"><span><b>Package '+pckcount+'</b></span><div class="row"><div class="col-12 col-lg-4"><label>Material Description <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="material" required="required" /><span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle"></i></span></div></div><div class="col-12 col-lg-4"><label>HS Code <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="hs_code" required="required" /><span class="error1" style="display: none;"><i class="error-log fa fa-exclamation-triangle"></i></span> </div></div><div class="col-12 col-lg-4"><label>Type Of Packing <sup>* </sup></label><div class="input-comment"><select name="material_unit" class="form-control"><option value="">Select Packing</option><option>Wooden</option><option>Pallet</option><option>Box</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Net Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="net_weight" id="net_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Gross Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="gross_weight" id="gross_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Length: </label><div style="display: flex;"><input type="text" class="form-control" name="length" id="length" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Height: </label><div style="display: flex;"><input type="text" class="form-control" name="height" id="height" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div><div class="col-12 col-lg-4"><label>Width: </label><div style="display: flex;"><input type="text" class="form-control" name="width" id="width" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div></div>');
	pckcount++;
});
var contcount = 2;
$('#add_more_container').click(function(){
	
	$('.multi-container').append('<div class="form-group hideLCL" style="padding: 10px; border: 1px solid #ccc;"><span><b>Container '+contcount+'</b></span><div class="row"><div class="col-12 col-lg-4"><label>Container Type <sup>* </sup></label><div class="input-comment"><select name="container_type" class="form-control"> <option value="">Select Shipment Type</option><?php foreach($container_types as $container_type){ ?><option value="<?php echo $container_type['id']; ?>"><?php echo $container_type['type']; ?></option><?php } ?></select> </div></div><div class="col-12 col-lg-4"><label>HS Code <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="hs_code[]" required="required" /><span class="error1" style="display: none;"><i class="error-log fa fa-exclamation-triangle"></i></span></div></div><div class="col-12 col-lg-4"> <label>Number of Container <sup>* </sup></label> <div class="input-comment"><input type="number" class="form-control" name="num_container[]" required="required" /><span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle"></i></span></div></div></div></div>');
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
</script>
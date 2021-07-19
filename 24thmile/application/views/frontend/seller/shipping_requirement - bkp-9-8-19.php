
<style>
.comment-group {
    border-bottom:none;
	padding: none;
}
.comment-img {
    position: initial !important;
}
.comment-img img {
    max-width: 150px;
    border-radius: 100%;
}
.section-title {
    text-align: center;
    padding-bottom: 30px;
    padding-top: 30px;
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
</style>
   <!-- Tracking start -->
   <div class="wshipping-content-block">
     <div class="container">
       <div class="row" style="background-image: url('<?php echo base_url('assets/frontend/images/get-quote-bg2.jpg'); ?>');">
          <div class="col-12 col-lg-6 offset-lg-3">
             <div class="section-title wow fadeInUp">
                <div class="comment-img">
				<?php if($myProfile->profile_pic){ ?>
				<img src="<?php echo $myProfile->profile_pic; ?>" alt="" />
				<?php }else{ ?>
				<img src="<?php echo base_url('assets/frontend/images/comment-pic1.jpg'); ?>" alt="" />
				<?php } ?>
				</div>
				 <h1 class="text-white"><?php echo $myProfile->firstname.' '.$myProfile->lastname; ?></h1>
             </div>
          </div>
       </div>
	   <br/>
       <div class="row">
          <div class="col-12 col-lg-9">
		  <h3 class="heading3-border text-uppercase">Post Requirement </h3>
		  <!-- Customer Registration Start -->
		   <div class="wshipping-content-block shipping-block">
			 <div class="container">
			   <div class="row">
				 <div class="shipping-form-block">
				 <form class="steps" action="<?php echo base_url('shipping-requirement'); ?>" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
				   <fieldset>
					 <div class="shipping-form">
						  <h3>Pickup From</h3>
						 <div class="form-group">
							<div class="row">
								<div class="col-12 col-lg-4">
									<label>Company Name <sup>* </sup></label>
									<select name="pickup_cname" class="form-control">
										<option value="">Select Company</option>
										<?php foreach($companys as $company){ ?>
										<option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
										<?php } ?>
									</select>
									<span class="error1" style="display: none;">
									Enter Company Name
									</span>
								</div>
								<div class="col-12 col-lg-4">
									<label>Address <sup>* </sup></label>
									<input type="text" class="form-control" name="pickup_address1" placeholder="Street Address/P.O.box" required="required"/>
									<span class="error1" style="display: none;">
									Enter Street Address/P.O.box 
									</span>
								</div>
								<div class="col-12 col-lg-4">
									<label>Pickup Pin/Postal Code <sup>* </sup></label>
									<input type="text" class="form-control" name="pickup_pin" required="required"/>
									<span class="error1" style="display: none;">
									Enter Pickup Pin/Postal Code 
									</span>
								</div>
							</div>    
						 </div>
						 <div class="form-group">
						   <div class="row">
						   <div class="col-12 col-lg-4">
							 <label>Country <sup>* </sup></label>
							 <input type="text" class="form-control" name="from_country" id="from_country" required="required"/>
							 <span class="error1" style="display: none;">
							   Select Country 
							</span>
							</div>
							<div class="col-12 col-lg-4">
							 <label>State <sup>* </sup></label>
							 <select name="from_state" class="form-control" id="from_state" required="required">
							 </select>
							 <span class="error1" style="display: none;">
							   Select State 
							</span>
							</div>
							<div class="col-12 col-lg-4">
							 <label>City <sup>* </sup></label>
							 <select name="from_city" class="form-control" id="from_city" required="required">
							 </select>
							 <span class="error1" style="display: none;">
							   Select City 
							</span>
							</div>
						   </div>    
						 </div>
						 <h3>Drop To</h3>
						 <div class="form-group">
						   <div class="row">
							<div class="col-12 col-lg-4">
							 <label>Company or Name <sup>* </sup></label>
							  <select name="deliver_cname" class="form-control">
							   <option value="">Select Company</option>
								<?php foreach($companys as $company){ ?>
									<option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
								<?php } ?>
							   </select>
							 <span class="error1" style="display: none;">
							   Enter Company Name
							</span>
							</div>
							<div class="col-12 col-lg-4">
							 <label>Address <sup>* </sup></label>
							 <input type="text" class="form-control" name="deliver_address1" placeholder="Street Address/P.O.box" required="required"/>
							 <span class="error1" style="display: none;">
							   Enter Street Address/P.O.box 
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
						 <div class="form-group">
						   <div class="row">
						   <div class="col-12 col-lg-4">
							 <label>Country <sup>* </sup></label>
							 <input type="text" class="form-control" name="to_country" id="to_country" required="required"/>
							 <span class="error1" style="display: none;">
							   Select Country 
							</span>
							</div>
							<div class="col-12 col-lg-4">
							 <label>State <sup>* </sup></label>
							 <select name="to_state" class="form-control" id="to_state">
							 </select>
							 <span class="error1" style="display: none;">
							   Select State 
							</span>
							</div>
							<div class="col-12 col-lg-4">
							 <label>City <sup>* </sup></label>
							 <select name="to_city" class="form-control" id="to_city" required="required">
							 </select>
							 <span class="error1" style="display: none;">
							   Select City 
							</span>
							</div>
						   </div>    
						 </div>
						 <h3>Material Detail</h3>
						 <div class="form-group">
						  <div class="row">
							<div class="col-12 col-lg-4">
							 <label>Material Description <sup>* </sup></label>
							  <div class="input-comment">
								<textarea class="form-control" name="material_description" required="required" /></textarea>
								<span class="error1" style="display: none;">
								   <i class="error-log fa fa-exclamation-triangle"></i>
								</span>
							 </div>    
							</div>
							<div class="col-12 col-lg-4">
							  <label>Material Quantity <sup>* </sup></label>
							  <div class="input-comment">
								<input type="text" class="form-control" name="material_quantity" required="required" />
								<span class="error1" style="display: none;">
								   <i class="error-log fa fa-exclamation-triangle"></i>
								</span>
							  </div>
							 </div>
							 <div class="col-12 col-lg-4">
							 <label>Material Unit <sup>* </sup></label>
							  <div class="input-comment">
							   <select name="material_unit" class="form-control">
							   <option value="">Select Unit</option>
								<?php foreach($shipments as $shipment){ ?>
									<option value="<?php echo $shipment['id']; ?>"><?php echo $shipment['type']; ?></option>
								<?php } ?>
							   </select>
							 </div>    
							</div>
						  </div>
						</div>
						<div class="form-group">
						  <div class="row">
							 <div class="col-12 col-lg-4">
							  <label>Net Weight <sup>* </sup></label>
							  <div class="input-comment">
								<input type="text" class="form-control" name="weight" required="required" />
								<span class="error1" style="display: none;">
								   <i class="error-log fa fa-exclamation-triangle"></i>
								</span>
								<span class="field-comment">Kg </span>
							  </div>
							 </div>
							 <div class="col-12 col-lg-4">
							  <label>Gross Weight <sup>* </sup></label>
							  <div class="input-comment">
								<input type="text" class="form-control" name="weight" required="required" />
								<span class="error1" style="display: none;">
								   <i class="error-log fa fa-exclamation-triangle"></i>
								</span>
								<span class="field-comment">Kg. </span>
							  </div>
							 </div>
							 <div class="col-12 col-lg-4">
							  <label>Invoice Value <sup>* </sup></label>
							  <div class="input-comment">
								<input type="text" class="form-control" name="weight" required="required" />
								<span class="error1" style="display: none;">
								   <i class="error-log fa fa-exclamation-triangle"></i>
								</span>
							  </div>
							 </div>
						  </div>
						</div>
						<hr>
						<div class="form-group">
						  <div class="row">
							<div class="col-12 col-lg-4">
							 <label>Shipment Type <sup>* </sup></label>
							  <div class="input-comment">
							   <select name="shipment" id="shipment" class="form-control">
							   <option value="">Select Shipment Type</option>
								<?php foreach($shipments as $shipment){ ?>
									<option value="<?php echo $shipment['id']; ?>"><?php echo $shipment['type']; ?></option>
								<?php } ?>
							   </select>
							 </div>    
							</div>
							<div class="col-12 col-lg-4">
							 <label>Contract Type <sup>* </sup></label>
							  <div class="input-comment">
							   <select name="contract" class="form-control">
							   <option value="">Select Contract Type</option>
								<?php foreach($contracts as $contract){ ?>
									<option value="<?php echo $contract['id']; ?>"><?php echo $contract['type']; ?></option>
								<?php } ?>
							   </select>
							 </div>    
							</div>
							<div class="col-12 col-lg-4">
							  <label>Validity </label>
							  <div class="input-comment"><input type="text" class="form-control" name="validity" /><span class="field-comment">Days</span></div>
							</div>
						  </div>
						</div>
						<div class="form-group onlyFCL" style="display:none;border: 1px solid #ccc;padding: 13px;margin-bottom: 10px;">
						  <div class="row">
							<div class="col-12 col-lg-4">
							 <label>Container Type <sup>* </sup></label>
							  <div class="input-comment">
							   <select name="container_type" class="form-control">
							   <option value="">Select Shipment Type</option>
								<?php foreach($container_types as $container_type){ ?>
									<option value="<?php echo $container_type['id']; ?>"><?php echo $container_type['type']; ?></option>
								<?php } ?>
							   </select>
							 </div>    
							</div>
							<div class="col-12 col-lg-4">
							  <label>No of Container </label>
							  <div class="input-comment"><input type="text" class="form-control" name="no_of_container" /></div>
							</div>
						  </div>
						</div>
						<div class="form-group onlyLCL" style="display:none;border: 1px solid #ccc;padding: 13px;margin-bottom: 10px;">
						  <div class="row">
							<div class="col-12 col-lg-4">
							  <label>Length </label>
							  <div class="input-comment"><input type="text" class="form-control" name="length" /><span class="field-comment">in </span></div>
							 </div>
							<div class="col-12 col-lg-4">
							  <label>Width </label>
							  <div class="input-comment"><input type="text" class="form-control" name="width" /><span class="field-comment">in </span></div>
							 </div>
							 <div class="col-12 col-lg-4">
							  <label>Height </label>
							  <div class="input-comment"><input type="text" class="form-control" name="length" /><span class="field-comment">in </span></div>
							 </div>
						  </div>
						</div>
						<div class="form-group">
						  <div class="row">
							 <div class="col-12 col-lg-4">
							  <label>Frequency </label>
							  <div class="input-comment"><input type="text" class="form-control" name="frequency" /><span class="field-comment"></span></div>
							 </div>
							 <div class="col-12 col-lg-4">
							  <label>Factory/Port Stuffings</label>
							  <div class="input-comment"><input type="text" class="form-control" name="factory_or_port_stuffings" /><span class="field-comment"></span></div>
							 </div>
							 <div class="col-12 col-lg-4">
							   <label>Pickup date: </label>
							   <div class="input-group date" data-provide="datepicker">
								  <input type="text" class="form-control" name="pickup_date" />
								  <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
							   </div>
							</div>
						  </div>
						 </div>
						 <div class="form-group">
						   <div class="row">
							<div class="col-12 col-lg-4">
							 <label>Date and short details: </label>
							 <textarea class="form-control" name="shipDetails" ></textarea>
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
          <!-- Right sidebar start --> 
          <div class="col-12 col-lg-3">
             <div class="right-block left-menu menu-with-title mt40">
                <h4 class="title-with-bg">My Account</h4>
                <ul>
                   <li><a href="<?php echo base_url('my-profile'); ?>">My Profile </a></li>
                   <li class="active"><a href="<?php echo base_url('request-list'); ?>">Post Requirement</a></li>
                   <li><a href="tracking.html">Shipment Tracking </a></li>
                </ul>
             </div>
          </div>
          <!-- Right sidebar end --> 
       </div>
     </div>
   </div>
   <!-- Blog content end --> 
   <br/>
   <br/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script type="text/javascript">
	
    var countryTags = ["<?php echo $CName; ?>"];
	
    $( "#from_country" ).autocomplete({
      source: countryTags,
	  select: function(event, ui) {
		  //alert(ui.item.value);
		  var countryN = ui.item.value;
			$('#from_state').empty();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('seller/getAjaxState'); ?>",
				data:{countryN:countryN},
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

$( "#to_country" ).autocomplete({
      source: countryTags,
	  select: function(event, ui) {
		  //alert(ui.item.value);
		  var countryN = ui.item.value;
			$('#to_state').empty();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('seller/getAjaxState'); ?>",
				data:{countryN:countryN},
				success: function(response){
					var res = JSON.parse(response);
					$('#to_state').append('<option value="" disabled selected>Select State</option>');
					$.each(res, function(key, value) {   
						 $('#to_state')
							 .append($("<option></option>")
										.attr("value",value.id)
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
								.attr("value",value.city_id)
								.text(value.city_name)); 
			});
		}
	});
});

$('#shipment').change(function(){
	
	var shpval = $(this).val();
	
	if(shpval == 1){
		$('.onlyFCL').show();
		$('.onlyLCL').hide();
	}else{
		$('.onlyLCL').show();
		$('.onlyFCL').hide();
	}
});
</script>
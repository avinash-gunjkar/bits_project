
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
				   <!-- progressbar -->
				   <ul id="progressbar">
					 <li class="active">Pickup From </li>
					 <li>Delivered To</li>
					 <li>Material </li>
					 <li>How </li>
					 <!--<li>Payment </li>
					 <li>Review </li>-->
					 <li>Complete </li>
				   </ul>
				   <!-- fieldsets Shipping From Start-->
				   <fieldset>
					 <h3 class="fs-subtitle">* Indicates required field  </h3>
					 <div class="shipping-form">
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
						 <label>Contact <sup>* </sup></label>
						 <input type="number" class="form-control" name="pickup_contact" required="required"/>
						 <span class="error1" style="display: none;">
						   Enter Contact Number 
						</span>
						</div>
						<div class="col-12 col-lg-4">
						 <label>E-mail  <sup>* </sup></label>
						<input type="email" class="form-control" name="pickup_email" required="required"/>
						<span class="error1" style="display: none;">
						   Enter Valid Email Id 
						</span>
						</div>
					   </div>    
					 </div>
					 <div class="form-group">
					   <div class="row">
						<div class="col-12 col-lg-4">
						 <label>Address <sup>* </sup></label>
						 <input type="text" class="form-control" name="pickup_address1" placeholder="Street Address/P.O.box" required="required"/>
						 <span class="error1" style="display: none;">
						   Enter Street Address/P.O.box 
						</span>
						</div>
						<div class="col-12 col-lg-4">
						 <label class="empty">&nbsp; </label>
						 <input type="text" class="form-control" name="pickup_address2" placeholder="Apartment/Suite/ Unit/Building/Floor/etc." />
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
					 </div>
					 <input type="button" name="next" class="next action-button" value="Continue" />
					 <input type="reset" name="cancel" class="action-button btn-red" value="Cancel Shipment" />
				   </fieldset>
				   <!-- fieldsets Shipping From end-->
				  
				   <!-- fieldsets Shipping going Start-->
				   <fieldset>
					 <h3 class="fs-subtitle">* Indicates required field  </h3>
					 <div class="shipping-form">
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
						 <label>Contact <sup>* </sup></label>
						 <input type="number" class="form-control" name="deliver_contact" required="required"/>
						 <span class="error1" style="display: none;">
						   Enter Contact Number 
						</span>
						</div>
						<div class="col-12 col-lg-4">
						 <label>E-mail  <sup>* </sup></label>
						<input type="email" class="form-control" name="deliver_email" required="required"/>
						<span class="error1" style="display: none;">
						   Enter Valid Email Id 
						</span>
						</div>
					   </div>    
					 </div>
					 <div class="form-group">
					   <div class="row">
						<div class="col-12 col-lg-4">
						 <label>Address <sup>* </sup></label>
						 <input type="text" class="form-control" name="deliver_address1" placeholder="Street Address/P.O.box" required="required"/>
						 <span class="error1" style="display: none;">
						   Enter Street Address/P.O.box 
						</span>
						</div>
						<div class="col-12 col-lg-4">
						 <label class="empty">&nbsp; </label>
						 <input type="text" class="form-control" name="deliver_address2" placeholder="Apartment/Suite/ Unit/Building/Floor/etc." />
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
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <input type="button" name="next" class="next action-button" value="Continue" />
					 <input type="reset" name="cancel" class="action-button btn-red" value="Cancel Shipment" />
				   </fieldset>
				   <!-- fieldsets Shipping going end-->
				  
				   <!-- fieldsets package Start-->
				   <fieldset>
					 <h2 class="fs-title">What kind of packaging you using?  </h2>
					 <h3 class="fs-subtitle">* Indicates required field  </h3>
					 <div class="shipping-form">
					   <div class="row">
						  <div class="col-12 col-lg-8">
							<div class="form-group">
							  <div class="row">
								<div class="col-12 col-lg-6">
								 <label>Shipment Type <sup>* </sup></label>
								  <div class="input-comment">
								   <select name="shipment" class="form-control">
								   <option value="">Select Shipment Type</option>
									<?php foreach($shipments as $shipment){ ?>
										<option value="<?php echo $shipment['id']; ?>"><?php echo $shipment['type']; ?></option>
									<?php } ?>
								   </select>
								 </div>    
								</div>
								<div class="col-12 col-lg-6">
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
							  </div>
							</div>
							<div class="form-group">
							  <div class="row">
								<div class="col-12 col-lg-6">
								 <label>Material Description <sup>* </sup></label>
								  <div class="input-comment">
									<textarea class="form-control" name="material_description" required="required" /></textarea>
									<span class="error1" style="display: none;">
									   <i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								 </div>    
								</div>
								<div class="col-12 col-lg-6">
								  <label>Material Quantity <sup>* </sup></label>
								  <div class="input-comment">
									<input type="text" class="form-control" name="material_quantity" required="required" />
									<span class="error1" style="display: none;">
									   <i class="error-log fa fa-exclamation-triangle"></i>
									</span>
								  </div>
								 </div>
							  </div>
							</div>
							<div class="form-group">
							  <div class="row">
								<div class="col-12 col-lg-6">
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
								<div class="col-12 col-lg-6">
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
							<div class="form-group">
							  <div class="row">
								<div class="col-12 col-lg-6">
								  <label>Net Weight <sup>* </sup></label>
								  <div class="input-comment">
									<input type="text" class="form-control" name="weight" required="required" />
									<span class="error1" style="display: none;">
									   <i class="error-log fa fa-exclamation-triangle"></i>
									</span>
									<span class="field-comment">Kg </span>
								  </div>
								 </div>
								 <div class="col-12 col-lg-6">
								  <label>Gross Weight <sup>* </sup></label>
								  <div class="input-comment">
									<input type="text" class="form-control" name="weight" required="required" />
									<span class="error1" style="display: none;">
									   <i class="error-log fa fa-exclamation-triangle"></i>
									</span>
									<span class="field-comment">Kg. </span>
								  </div>
								 </div>
							  </div>
							</div>
							<div class="form-group onlyFCL">
							  <div class="row">
								<div class="col-12 col-lg-6">
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
								<div class="col-12 col-lg-6">
								  <label>No of Container </label>
								  <div class="input-comment"><input type="text" class="form-control" name="no_of_container" /></div>
								 </div>
							  </div>
							</div>
							<div class="form-group onlyLCL">
							  <div class="row">
								<div class="col-12 col-lg-6">
								  <label>Length </label>
								  <div class="input-comment"><input type="text" class="form-control" name="length" /><span class="field-comment">in </span></div>
								 </div>
								<div class="col-12 col-lg-6">
								  <label>Width </label>
								  <div class="input-comment"><input type="text" class="form-control" name="width" /><span class="field-comment">in </span></div>
								 </div>
							  </div>
							</div>
							<div class="form-group onlyLCL">
							  <div class="row">
								<div class="col-12 col-lg-6">
								  <label>Height </label>
								  <div class="input-comment"><input type="text" class="form-control" name="length" /><span class="field-comment">in </span></div>
								 </div>
							  </div>
							</div>
						  </div>
						  <div class="col-12 col-lg-4">
							 <div class="what-package"><img src="assets/frontend/images/package.jpg" alt="" /></div>
						  </div>     
					   </div>   
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <input type="button" name="next" class="next action-button" value="Continue" />
					 <input type="reset" name="cancel" class="action-button btn-red" value="Cancel Shipment" />
				   </fieldset>
				   <!-- fieldsets package end-->
				  
				   <!-- fieldsets pick up Start-->
				   <fieldset>
					 <h2 class="fs-title">When would you ship your shipment? </h2>
					 <h3 class="fs-subtitle">* Indicates required field  </h3>
					 <div class="shipping-form dropoff-block">
					   <div class="tab-content">
						 <div role="tabpanel" class="tab-pane active" id="no-drop">
						 <div class="form-group">
							  <div class="row">
								<div class="col-12 col-lg-6">
								  <label>Validity </label>
								  <div class="input-comment"><input type="text" class="form-control" name="validity" /><span class="field-comment">Days</span></div>
								 </div>
								<div class="col-12 col-lg-6">
								  <label>Frequency </label>
								  <div class="input-comment"><input type="text" class="form-control" name="frequency" /><span class="field-comment"></span></div>
								 </div>
							  </div>
						  </div>
						  <div class="form-group">
						   <div class="row">
							<div class="col-12 col-lg-6">
								  <label>Factory/Port Stuffings</label>
								  <div class="input-comment"><input type="text" class="form-control" name="factory_or_port_stuffings" /><span class="field-comment"></span></div>
							</div>
							<div class="col-12 col-lg-6">
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
					  </div> 
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <input type="button" name="next" class="next action-button" value="Continue" />
					 <input type="reset" name="cancel" class="action-button btn-red" value="Cancel Shipment" />
				   </fieldset>
				   <!-- fieldsets package end-->
				  
				   <!-- fieldsets payment Start
				   <fieldset>
					 <h2 class="fs-title">How would like to ___?  <a href="create-shipping.html" title="" class="login-btn-form">Login </a></h2>
					 <h3 class="fs-subtitle">* Indicates required field  </h3>
					 <div class="shipping-form">
					 <div class="form-group">
					   <div class="row">
						<div class="col-12 col-lg-4">
						 <label>Card Type <sup>* </sup></label>
						 <select name="cardType" class="form-control">
							<option />Select One 
							<option />Paypal 
							<option />Visa 
							<option />Master 
							<option />American express 
						 </select>
						</div>
						<div class="col-12 col-lg-4">
						  <div class="we-accept">
						   <img src="assets/images/card-paypal.png" alt="" />
						   <img src="assets/images/card-visa.png" alt="" />
						   <img src="assets/images/card-master.png" alt="" />
						   <img src="assets/images/card-discover.png" alt="" />
						   <img src="assets/images/card-amex.png" alt="" />
						  </div> 
						</div>
					   </div>    
					 </div>
					 <div class="form-group">
					   <div class="row">
						<div class="col-12 col-lg-4">
						 <label>Card Number <sup>* </sup></label>
						 <input type="text" class="form-control" name="address1" placeholder="Street Address" required="required" />
						 <span class="error1" style="display: none;">
						   <i class="error-log fa fa-exclamation-triangle"></i>
						</span>
						</div>
					   </div>    
					 </div>
					 <div class="form-group">
					   <div class="row">
						<div class="col-12 col-lg-4">
						 <label>Exparation <sup>* </sup></label>
						 <select name="exparation" class="form-control">
							<option />Select Month 
							<option />January 
							<option />February 
							<option />March 
						 </select>
						</div>
						<div class="col-12 col-lg-4">
						 <label class="empty">&nbsp; </label>
						 <select name="exparation2" class="form-control">
							<option />Select Year 
							<option />January 
							<option />February 
							<option />March 
						 </select>
						</div>
						<div class="col-12 col-lg-4">
						 <label>CVV <sup>* </sup></label>
						 <input type="text" class="form-control" name="other-address" />
						</div>
					   </div>    
					 </div>
					 <div class="form-group">
					   <div class="row">
						<div class="col-12 col-lg-4">
						 <label class="slide-label">Billing Address </label>
						  <div class="checkbox">
						   <input type="checkbox" name="remember" id="same-bill" class="css-checkbox" />
						   <label for="same-bill" class="css-label">Send updates on this ________ </label>
						  </div> 
						</div>
					   </div>    
					 </div>
					 <div class="form-group">
					   <h3>Duties and Taxes </h3>
					   <p>Lorem Ipsum is simply _____ text of the printing ___ typesetting industry. Lorem Ipsum ___ been the industry's standard _____ text ever since the 1500_, when an unknown printer ____ a galley of type ___ scrambled it to make _ type specimen book. It ___ survived not only five _________. </p>
					   <div class="row">
						<div class="col-12 col-lg-4">
						 <label class="slide-label">Use a promo code? </label>
						  <div class="slide-redio">  
						   <input type="checkbox" value="None" id="slide-radio4" name="check" checked="" />
						   <label for="slide-radio4"></label>
						 </div>
						</div>
					   </div>    
					 </div>
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <input type="button" name="next" class="next action-button" value="Continue" />
					 <input type="reset" name="cancel" class="action-button btn-red" value="Cancel Shipment" />
				   </fieldset>
				   <!-- fieldsets payment Start-->
				  
				   <!-- fieldsets Review Start
				   <fieldset>
					 <h2 class="fs-title">Let's make sure everyting __ in order </h2>
					 <div class="shipping-form">
					  <div class="review">
					   <h3>Where  <a href="create-shipping.html" title="Edit" class="btn-edit">Edit </a></h3>
					   <div class="row">
					   <div class="col-12 col-lg-4">
						 <div class="ship-address">
						  <h4>Ship from </h4>
						  <p>Lorem Ipsum is simply _____ text <br /> of the printing ___ typesetting industry </p>
						 </div> 
					   </div>
					   <div class="col-12 col-lg-4">
						 <div class="ship-address">
						  <h4>Ship to </h4>
						  <p>Lorem Ipsum is simplydummy ____ of the <br />  printing and ___________ industry </p>
						 </div> 
					   </div>
					   <div class="col-12 col-lg-4">
						 <div class="ship-address">
						  <h4>Return to </h4>
						  <p>Lorem Ipsum is simplydummy ____ of the <br />  printing and ___________ industry </p>
						 </div> 
						</div>
					   </div>
					  </div>
					  <div class="review">
					   <h3>What  <a href="create-shipping.html" title="Edit" class="btn-edit">Edit </a></h3>
					   <h5>Shipment information </h5>
					   <ul>
						 <li><b>Actual Weight: </b> 60 lbs </li>
						 <li><b>Total Bilable Weight: </b> 60 lbs </li>
					   </ul>
					   <h5>Package information </h5>
					   <ul>
						 <li><b>Weight: </b> 60 lbs </li>
						 <li><b>Dimensions: </b> 17x13x11 in </li>
						 <li><b>Declared value: </b> $100 </li>
					   </ul>
					  </div>
					  <div class="review">
					   <h3>How  <a href="create-shipping.html" title="Edit" class="btn-edit">Edit </a></h3>
					   <h5>Service Selection </h5>
					   <p>It has survived not ____ five centuries, </p>
					   <h5>Arrival </h5>
					   <p>Mon, Nov6, 2017, End __ the day </p>
					  </div>
					  <div class="review">
					   <h3>Aditional Option  <a href="create-shipping.html" title="Edit" class="btn-edit">Edit </a></h3>
					   <p>N/A </p>
					  </div>
					  <div class="review">
					   <h3>Payment  <a href="create-shipping.html" title="Edit" class="btn-edit">Edit </a></h3>
					   <h5>Bill Shipping Charge to: </h5>
					   <p>Paypal </p>
					   <h5>Bill Duties and Taxes __: </h5>
					   <p>Receive Company name </p>
					   <h5>Enter Promo Code: </h5>
					   <div class="promoCode-input">
						 <input type="text" class="form-control" name="sDetails" />
					   </div>
					  </div>
					  <div class="review">
						<div class="checkbox">
						   <input type="checkbox" name="remember" id="trems" class="css-checkbox" />
						   <label for="trems" class="css-label">Lorem Ipsum is simply _____ text of the printing ___ typesetting industry. Lorem Ipsum ___ been the industry's standard _____ text ever since the 1500_, when an unknown printer ____ a galley of type ___ scrambled it to make _ type specimen book. It ___ survived not only five _________, but also the leap ____ electronic typesetting, remaining essentially _________. </label>
						  </div>
					  </div>
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <input type="button" name="next" class="next action-button" value="Continue" />
				   </fieldset>
				   <!-- fieldsets payment Start-->
				   <fieldset>
					 <div class="shipping-form">
					   <h1 class="tanks-message">Thank You For Create ________ </h1>
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
</script>
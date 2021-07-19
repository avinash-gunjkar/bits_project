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
.hideStepSection{
	opacity: 0; 
	display: none;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
						<a href="<?php echo base_url('freight-forwarder-dashboard'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">Dashboard</span></a>
						<a href="<?php echo base_url('freight-forwarder-profile'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">My Profile</span></a>
						<a href="<?php echo base_url('my-quotes'); ?>"><span class="custom-btn-reg cbtn-yellow text-uppercase cbtn-shadow" style="margin-top: 20px;">My Quotes</span></a>
						<a href="<?php echo base_url('shipment-list-ff'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">Shipments</span></a>
					 </div>
				  </div>
			   </div>
		   </div>
       </div>
	   <br/>
	   <div class="container">
		<div class="row">
          <div class="col-12 col-lg-12">
		  <h3 class="heading3-border text-uppercase">Track Your Shipment</h3>
		   <!-- Customer Registration Start -->
		   <div class="wshipping-content-block shipping-block">
			 <div class="container">
			   <div class="row">
				 <div class="shipping-form-block">
				 <form class="steps" action="<?php echo base_url('freightforwarder/upload_process_documents'); ?>" enctype="multipart/form-data" method="post">
				   <!-- progressbar -->
				   <ul id="progressbar">
					<?php foreach($stepData as $steps){ ?>
					 <li class="<?php echo (in_array($steps->id,$completedStep)) ? 'active' : '' ?>"><?php echo $steps->step_name; ?></li>
				   <?php } ?>
				   </ul>
				   
				   <!-- fieldsets Shipping From Start-->
				   <fieldset class="hideStepSection" <?php echo ($currentStep->step_id == $stepData[0]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					 <h3>Shipping Instructions</h3>
						<div class="row">
							<div class="col-12 col-lg-6">
							 <div class="ship-address">
							  <h4>Source Details</h4>
							  <p><?php echo $bookedShipment->firstname.' '.$bookedShipment->lastname; ?> <br/> <?php echo $bookedShipment->email; ?><br/><?php echo $bookedShipment->phone; ?></p>
							 </div> 
							 <div class="ship-address">
							  <h4>Pick Up Address</h4>
							  <p><?php echo $bookedShipment->pickup_address_1; ?> <br/> <?php echo $bookedShipment->pickup_city; ?><br/><?php echo $bookedShipment->pickup_state; ?>, <?php echo $bookedShipment->pickup_country; ?> - <?php echo $bookedShipment->pickup_pin; ?></p>
							 </div> 
						   </div>
						   <div class="col-12 col-lg-6">
							 <div class="ship-address">
							  <h4>Destination Details</h4>
							  <p><?php echo $bookedShipment->bfname.' '.$bookedShipment->blname; ?> <br/> <?php echo $bookedShipment->bemail; ?><br/><?php echo $bookedShipment->bphone; ?></p>
							 </div> 
							 <div class="ship-address">
							  <h4>Delivery Address</h4>
							  <p><?php echo $bookedShipment->delivery_address_1; ?> <br/> <?php echo $bookedShipment->delivery_city; ?><br/><?php echo $bookedShipment->delivery_state; ?>, <?php echo $bookedShipment->delivery_country; ?> - <?php echo $bookedShipment->delivery_pin; ?></p>
							 </div> 
						   </div>
						 </div>
						<h3>Preshipment Document</h3>
						<?php $preshipdocs = isset($shipmentProcessData[0]->documents) ? json_decode($shipmentProcessData[0]->documents):''; 
						$status = "<i style='color: #ed2325;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
						if(!empty($shipmentProcessData[0])){
							if(!empty($shipmentProcessData[0]->status ==1)){ 
								$status = "<i style='color: #27ae60;font-size: 17px;margin-left: 10px;' class='fa fa-check-circle-o mt-10'></i>&nbsp;Approved";
							 }else if(!empty($shipmentProcessData[0]->status ==2)){ 
								$status = "<i style='color: #ffb723;font-size: 17px;margin-left: 10px;' class='fa fa-upload mt-10'></i>&nbsp;Uploaded";
							 }else if(!empty($shipmentProcessData[0]->status ==3)){ 
								$status = "<i style='color: #e133ff;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Reupload";
							 }else{
								 $status = "<i style='color: #ed2325;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
							 } 
						 } ?>
						 <div class="row">
							 <div class="col-12 col-lg-3">
								 <div class="form-group">
									<label>Custom Invoice Document</label>
									&nbsp;<a target="_blank" href="<?php echo isset($preshipdocs->Custom_Invoice) ? $preshipdocs->Custom_Invoice : '#'; ?>" class="btn btn-warning">Download </a>
									<?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-3">
								 <div class="form-group">
									<label>Packaging List Document</label>
									&nbsp;<a target="_blank" href="<?php echo isset($preshipdocs->packing_List) ? $preshipdocs->packing_List : '#'; ?>" class="btn btn-warning">Download </a>
									<?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-3">
								 <div class="form-group">
									<label>Other Document</label><br/>
									&nbsp;<a target="_blank" href="<?php echo isset($preshipdocs->other_documents) ? $preshipdocs->other_documents : '#' ; ?>" class="btn btn-warning">Download </a>
									<?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-3">
								 <div class="form-group">
									<div class="radio mt-20">
									 <input type="radio" name="step1_export_status" class="css-radio" checked value="1">
									 <label for="approve" class="css-label">Approved</label>
									 <input type="radio" name="step1_export_status" class="css-radio" value="3">
									 <label for="reupload" class="css-label">Reupload</label>
									</div>
								 </div>
							 </div>
							 <br/>
						 </div>
						 <div class="row">
							<br/>
							<div class="col-12 col-lg-5">
								<div class="form-group">
									<label>Custom Invoice Number :</label>
									<b><?php echo isset($bookedShipment->custom_invoice_number) ? $bookedShipment->custom_invoice_number : ''; ?></b>
								</div>
							</div>
							<div class="col-12 col-lg-5">
								 <div class="form-group">
									<label>Custom Invoice Date:</label>
									<b><?php echo isset($bookedShipment->custom_invoice_date) ? date('d-M-Y',strtotime($bookedShipment->custom_invoice_date)) : ''; ?></b>
								 </div>
							</div>
							<br/>
						</div>
						<h3>Corrections/Suggestions</h3>
						<div class="form-group">
						 <textarea class="form-control" name="step1_export_correction_ff" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
						</div>
						 <br/>
						 <h3>Corrections/Suggestions History</h3>
						<div class="row">
							<div class="col-12 col-lg-12">
								 <div class="comment-content" style="padding: 19px;background: #d2e1f1;border-radius: 25px;">
									<p><?php echo isset($shipmentProcessData[0]->corrections)? $shipmentProcessData[0]->corrections : 'No correction Found'; ?></p>
								 </div>
								 <br/>
							 </div>
						</div>
						<input type="hidden" name="rfc_id" value="<?php echo $bookedShipment->rfc_id; ?>">
						<input type="hidden" name="book_id" value="<?php echo $this->uri->segment(3); ?>">
						<input type="hidden" name="ff_email" value="<?php echo $bookedShipment->femail; ?>">
						<input type="hidden" name="buyer_email" value="<?php echo $bookedShipment->bemail; ?>">
						<input type="hidden" name="seller_email" value="<?php echo $bookedShipment->email; ?>">
						<?php if(!empty($shipmentProcessData[0]->step_id)){ 
						if(isset($shipmentProcessData[0]->step_id) && $stepData[0]->id == $shipmentProcessData[0]->step_id && $shipmentProcessData[0]->status != 1){ ?>
						<input type="hidden" name="step_id" value="<?php echo $stepData[0]->id; ?>">
						<input type="submit" name="step1_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id" value="<?php echo $stepData[0]->id; ?>">
						<input type="submit" name="step1_export" class="action-button" value="Save" />
						<?php } ?>
						<?php if(isset($shipmentProcessData[0]->step_id) && $stepData[0]->id == $shipmentProcessData[0]->step_id && $shipmentProcessData[0]->status == 1){ ?>
						<input type="button" name="next" class="next action-button" value="Next" />
						<?php } ?>
				   </fieldset>
				   <!-- fieldsets Shipping From end-->
				  
				   <!-- fieldsets Shipping going Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[1]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
				   <?php $preshipdocs = isset($shipmentProcessData[1]->documents) ? json_decode($shipmentProcessData[1]->documents):''; 
						$status = "<i style='color: #ed2325;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
						if(!empty($shipmentProcessData[1])){
							if(!empty($shipmentProcessData[1]->status ==1)){ 
								$status = "<i style='color: #27ae60;font-size: 17px;margin-left: 10px;' class='fa fa-check-circle-o mt-10'></i>&nbsp;Approved";
							 }else if(!empty($shipmentProcessData[1]->status ==2)){ 
								$status = "<i style='color: #ffb723;font-size: 17px;margin-left: 10px;' class='fa fa-upload mt-10'></i>&nbsp;Uploaded";
							 }else if(!empty($shipmentProcessData[1]->status ==3)){ 
								$status = "<i style='color: #e133ff;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Reupload";
							 }else{
								 $status = "<i style='color: #ed2325;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
							 } 
						 } ?>
					 <div class="shipping-form">
						<h3>Shipping Bill Checklist Document</h3>
						 <div class="row">
							 <div class="col-12 col-lg-6">
								 <div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Shipping Bill Checklist Document</span>
										<input type="file" id="sb_checklist_ff" name="sb_checklist_ff" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?> />
									</div>
									<span id="sb_checklist_ff_file"></span>
									<?php echo $status; ?>
								 </div>
							 </div>
						</div>
						<div class="row">
							<br/>
							<div class="col-12 col-lg-5">
								<div class="form-group">
									<label>Shipping Bill Number :</label>
									<input type="number" id="step2_export_SB_number" name="step2_export_SB_number" value="<?php echo isset($bookedShipment->shipping_bill_number) ? $bookedShipment->shipping_bill_number : ''; ?>" />
								 </div>
							</div>
							<div class="col-12 col-lg-5">
								 <div class="form-group">
									<label>Shipping Bill Date</label>
									<input type="text" id="step2_export_SB_date" name="step2_export_SB_date" value="<?php echo isset($bookedShipment->shipping_bill_date) ? date('d-M-Y',strtotime($bookedShipment->shipping_bill_date)) : ''; ?>" />
								 </div>
							</div>
							<br/>
						</div>
						<h3>Correction/Suggestion</h3>
						<div class="row">
							<div class="col-12 col-lg-12">
							 <div class="comment-content" style="padding: 19px;background: #d2e1f1;border-radius: 25px;">
								<p><?php echo isset($shipmentProcessData[1]->corrections)? $shipmentProcessData[1]->corrections : 'No correction Found'; ?></p>
							 </div>
							 <br/>
							</div>
						</div>
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php if(!empty($shipmentProcessData[1]->step_id)){ 
						if(isset($shipmentProcessData[1]->step_id) && $stepData[1]->id == $shipmentProcessData[1]->step_id && $shipmentProcessData[1]->status != 1){ ?>
						<input type="hidden" name="step_id_2" value="<?php echo $stepData[1]->id; ?>">
						<input type="submit" name="step2_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id_2" value="<?php echo $stepData[1]->id; ?>">
						<input type="submit" name="step2_export" class="action-button" value="Save" />
						<?php } ?>
						<?php if(isset($shipmentProcessData[1]->step_id) && $stepData[1]->id == $shipmentProcessData[1]->step_id && $shipmentProcessData[1]->status == 1){ ?>
						<input type="button" name="next" class="next action-button" value="Next" />
						<?php } ?>
				   </fieldset>
				   <!-- fieldsets Shipping going end-->
				  
				   <!-- fieldsets package Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[2]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					 <div class="shipping-form">
					   <div class="row">
						  <div class="col-12 col-lg-8">
							<p>Reached at Loading Port on Date of &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[2]->action_date) ? date('d-M-Y',strtotime($shipmentProcessData[2]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[2]->time) ? date('h:i A',strtotime($shipmentProcessData[2]->time)) : ''; ?> </span></strong> </p>
							<div class="form-group">
							  <label>Reached at Loading Port Date </label>
							  <input type="text" class="form-control" name="step3_export_act_date" id="step3_export_act_date" placeholder="Date" />
							</div>
							<div class="form-group">
							   <input type="text" class="form-control" name="step3_export_details" placeholder="Detail" />
							</div>
						  </div>
						  <div class="col-12 col-lg-4">
							 <div class="form-group">
								<div class="radio mt-20">
								 <input type="radio" name="step3_export_status" class="css-radio" value="1">
								 <label for="approve" class="css-label">Approved</label>
								</div>
							 </div>
						 </div>
					   </div>   
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php if(!empty($shipmentProcessData[2]->step_id)){ 
						if(isset($shipmentProcessData[2]->step_id) && $stepData[2]->id == $shipmentProcessData[2]->step_id && $shipmentProcessData[2]->status != 1){ ?>
						<input type="hidden" name="step_id_3" value="<?php echo $stepData[2]->id; ?>">
						<input type="submit" name="step3_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id_3" value="<?php echo $stepData[2]->id; ?>">
						<input type="submit" name="step3_export" class="action-button" value="Save" />
						<?php } ?>
						<?php if(isset($shipmentProcessData[2]->step_id) && $stepData[2]->id == $shipmentProcessData[2]->step_id && $shipmentProcessData[2]->status == 1){ ?>
						<input type="button" name="next" class="next action-button" value="Next" />
						<?php } ?>
				   </fieldset>
				   <!-- fieldsets package end-->
				  
				   <!-- fieldsets pick up Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[3]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					 <div class="shipping-form">
					   <div class="row">
						  <div class="col-12 col-lg-8">
							 <p>Reached in Custom Clearance on Date of &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[3]->action_date) ? date('d-M-Y',strtotime($shipmentProcessData[3]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[3]->time) ? date('h:i A',strtotime($shipmentProcessData[3]->time)) : ''; ?> </span></strong></p>
							<div class="form-group">
							  <label>Reached in Custom Clearance Date</label>
							  <input type="text" class="form-control" id="step4_export_act_date" name="step4_export_act_date" />
							</div>
							<div class="form-group">
							   <input type="text" class="form-control" name="step4_export_details" placeholder="Details"/>
							</div>
						  </div>
						  <div class="col-12 col-lg-4">
							 <div class="form-group">
								<div class="radio mt-20">
								 <input type="radio" name="step4_export_status" class="css-radio" value="1">
								 <label for="approve" class="css-label">Approved</label>
								</div>
							 </div>
						 </div>
					   </div>   
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php if(!empty($shipmentProcessData[3]->step_id)){ 
						if(isset($shipmentProcessData[3]->step_id) && $stepData[3]->id == $shipmentProcessData[3]->step_id && $shipmentProcessData[3]->status != 1){ ?>
						<input type="hidden" name="step_id_4" value="<?php echo $stepData[3]->id; ?>">
						<input type="submit" name="step4_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id_4" value="<?php echo $stepData[3]->id; ?>">
						<input type="submit" name="step4_export" class="action-button" value="Save" />
						<?php } ?>
						<?php if(isset($shipmentProcessData[3]->step_id) && $stepData[3]->id == $shipmentProcessData[3]->step_id && $shipmentProcessData[3]->status == 1){ ?>
						<input type="button" name="next" class="next action-button" value="Next" />
						<?php } ?>
				   </fieldset>
				   <!-- fieldsets package end-->
				  
				   <!-- fieldsets payment Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[4]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					<?php $preshipdocs = isset($shipmentProcessData[4]->documents) ? json_decode($shipmentProcessData[4]->documents):''; 
						$status = "<i style='color: #ed2325;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
						if(!empty($shipmentProcessData[4])){
							if(!empty($shipmentProcessData[4]->status ==1)){ 
								$status = "<i style='color: #27ae60;font-size: 17px;margin-left: 10px;' class='fa fa-check-circle-o mt-10'></i>&nbsp;Approved";
							 }else if(!empty($shipmentProcessData[4]->status ==2)){ 
								$status = "<i style='color: #ffb723;font-size: 17px;margin-left: 10px;' class='fa fa-upload mt-10'></i>&nbsp;Uploaded";
							 }else if(!empty($shipmentProcessData[4]->status ==3)){ 
								$status = "<i style='color: #e133ff;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Reupload";
							 }else{
								 $status = "<i style='color: #ed2325;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
							 } 
						 } ?>
					 <div class="shipping-form">
						<h3>Bill of Lading Document</h3>
						 <div class="row">
							 <div class="col-12 col-lg-8">
								 <div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Bill of Lading Document</span>
										<input type="file" id="Bill_of_lading" name="Bill_of_lading" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?>/>
									</div>
									<span id="Bill_of_lading_file"></span>
									<?php echo $status; ?>
								 </div>
								 <div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Final Bill of Lading Document</span>
										<input type="file" id="Final_Bill_of_lading" name="Final_Bill_of_lading" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?>/>
									</div>
									<span id="Final_Bill_of_lading_file"></span>
									<?php echo $status; ?>
								 </div>
							 </div>
						</div>
						<div class="row">
							<br/>
							<div class="col-12 col-lg-5">
								<div class="form-group">
									<label>Bill of Lading Number :</label>
									<input type="number" id="step5_export_bol_number" name="step5_export_bol_number" value="<?php echo isset($bookedShipment->bill_of_lading_number) ? $bookedShipment->bill_of_lading_number : ''; ?>" />
								</div>
							</div>
							<div class="col-12 col-lg-5">
								 <div class="form-group">
									<label>Bill of Lading Date</label>
									<input type="text" id="step5_export_bol_date" name="step5_export_bol_date" value="<?php echo isset($bookedShipment->bill_of_lading_date) ? date('d-M-Y',strtotime($bookedShipment->bill_of_lading_date)) : ''; ?>" />
								 </div>
							</div>
							<br/>
						</div>
						<h3>Correction/Suggestion</h3>
						<div class="row">
							<div class="col-12 col-lg-12">
							 <div class="comment-content" style="padding: 19px;background: #d2e1f1;border-radius: 25px;">
								<p><?php echo isset($shipmentProcessData[4]->corrections)? $shipmentProcessData[4]->corrections : 'No correction Found'; ?></p>
							 </div>
							 <br/>
							</div>
						</div>
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php if(!empty($shipmentProcessData[4]->step_id)){ 
						if(isset($shipmentProcessData[4]->step_id) && $stepData[4]->id == $shipmentProcessData[4]->step_id && $shipmentProcessData[4]->status != 1){ ?>
						<input type="hidden" name="step_id_5" value="<?php echo $stepData[4]->id; ?>">
						<input type="submit" name="step5_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id_5" value="<?php echo $stepData[4]->id; ?>">
						<input type="submit" name="step5_export" class="action-button" value="Save" />
						<?php } ?>
						<?php if(isset($shipmentProcessData[4]->step_id) && $stepData[4]->id == $shipmentProcessData[4]->step_id && $shipmentProcessData[4]->status == 1){ ?>
						<input type="button" name="next" class="next action-button" value="Next" />
						<?php } ?>
				   </fieldset>
				   <!-- fieldsets payment Start-->
				   
				   <!-- fieldsets payment Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[5]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					 <div class="shipping-form">
					   <div class="row">
						  <div class="col-12 col-lg-12">
							<p>Loaded on Vessel/Flight Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[5]->action_date) ? date('d-M-Y',strtotime($shipmentProcessData[5]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[5]->time) ? date('h:i A',strtotime($shipmentProcessData[5]->time)) : ''; ?></strong></p>
							<p>ETD ( Estimated Time of Departure ) Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($bookedShipment->ETD) ? date('d-M-Y h:i a',strtotime($bookedShipment->ETD)) : ''; ?></strong></p>
							<p>ETA ( Estimated Time of Arrival ) Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($bookedShipment->ETA) ? date('d-M-Y h:i a',strtotime($bookedShipment->ETA)) : ''; ?></strong></p>
						  </div>
						</div>
						<div class="row">
							<div class="col-12 col-lg-4">
								<div class="form-group">
								  <label>Loaded on Vessel/Flight Date</label>
								  <input type="text" class="form-control" id="step6_export_lov_date" name="step6_export_lov_date" />
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="form-group">
								  <label>ETD ( Estimated Time of Departure ) Date</label>
								  <input type="text" class="form-control" id="step6_export_etd_date" name="step6_export_etd_date" />
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="form-group">
								  <label>ETA ( Estimated Time of Arrival ) Date</label>
								  <input type="text" class="form-control" id="step6_export_eta_date" name="step6_export_eta_date" />
								</div>
							</div>
						  <div class="col-12 col-lg-12">
							<div class="form-group">
							   <input type="text" class="form-control" name="step6_export_details" placeholder="Details">
							</div>
							<div class="form-group">
								<div class="radio mt-20">
								 <input type="radio" name="step6_export_status" class="css-radio" value="1">
								 <label for="approve" class="css-label">Approved</label>
								</div>
							</div>
						 </div>
					   </div>   
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php if(!empty($shipmentProcessData[5]->step_id)){ 
						if(isset($shipmentProcessData[5]->step_id) && $stepData[5]->id == $shipmentProcessData[5]->step_id && $shipmentProcessData[5]->status != 1){ ?>
						<input type="hidden" name="step_id_6" value="<?php echo $stepData[5]->id; ?>">
						<input type="submit" name="step6_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id_6" value="<?php echo $stepData[5]->id; ?>">
						<input type="submit" name="step6_export" class="action-button" value="Save" />
						<?php } ?>
						<?php if(isset($shipmentProcessData[5]->step_id) && $stepData[5]->id == $shipmentProcessData[5]->step_id && $shipmentProcessData[5]->status == 1){ ?>
						<input type="button" name="next" class="next action-button" value="Next" />
						<?php } ?>
				   </fieldset>
				   <!-- fieldsets payment Start-->
				   
				   <!-- fieldsets payment Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[6]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					<?php $preshipdocs = isset($shipmentProcessData[6]->documents) ? json_decode($shipmentProcessData[6]->documents):''; 
						$status = "<i style='color: #ed2325;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
						if(!empty($shipmentProcessData[6])){
							if(!empty($shipmentProcessData[6]->status ==1)){ 
								$status = "<i style='color: #27ae60;font-size: 17px;margin-left: 10px;' class='fa fa-check-circle-o mt-10'></i>&nbsp;Approved";
							 }else if(!empty($shipmentProcessData[6]->status ==2)){ 
								$status = "<i style='color: #ffb723;font-size: 17px;margin-left: 10px;' class='fa fa-upload mt-10'></i>&nbsp;Uploaded";
							 }else if(!empty($shipmentProcessData[6]->status ==3)){ 
								$status = "<i style='color: #e133ff;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Reupload";
							 }else{
								 $status = "<i style='color: #ed2325;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
							 } 
						 } ?>
					 <div class="shipping-form">
						<h3>Postshipment Document</h3>
						 <div class="row">
							 <div class="col-12 col-lg-8">
								 <div class="form-group">
									<div class="checkbox">
									 <input type="checkbox" name="step7_export_agree_document_sent" id="step7_export_agree_document_sent" class="css-checkbox" value="1" <?php echo (isset($shipmentProcessData[6]->note_for_doc) && ($shipmentProcessData[6]->note_for_doc == 1))? 'checked' : ''; ?>>
									 <label for="agree_document_sent" class="css-label">Seller agree that he has sent document to buyer/importer</label>
								    </div>
								 </div>
							 </div>
						</div>
						<h3>Correction/Suggestion</h3>
						<div class="row">
							<div class="col-12 col-lg-12">
							 <div class="comment-content" style="padding: 19px;background: #d2e1f1;border-radius: 25px;">
								<p><?php echo isset($shipmentProcessData[6]->corrections)? $shipmentProcessData[6]->corrections : 'No correction Found'; ?></p>
							 </div>
							 <br/>
							</div>
						</div>
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php if(!empty($shipmentProcessData[6]->step_id)){ 
						if(isset($shipmentProcessData[6]->step_id) && $stepData[6]->id == $shipmentProcessData[6]->step_id && $shipmentProcessData[6]->status != 1){ ?>
						<input type="hidden" name="step_id_7" value="<?php echo $stepData[6]->id; ?>">
						<input type="submit" name="step7_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id_7" value="<?php echo $stepData[6]->id; ?>">
						<input type="submit" name="step7_export" class="action-button" value="Save" />
						<?php } ?>
						<?php if(isset($shipmentProcessData[6]->step_id) && $stepData[6]->id == $shipmentProcessData[6]->step_id && $shipmentProcessData[6]->status == 1){ ?>
						<input type="button" name="next" class="next action-button" value="Next" />
						<?php } ?>
				   </fieldset>
				   <!-- fieldsets payment Start-->
				   
				   <!-- fieldsets payment Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[7]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					 <div class="shipping-form">
					   <div class="row">
						  <div class="col-12 col-lg-8">
							<p>Reached at destination port Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[7]->action_date) ? date('d-M-Y',strtotime($shipmentProcessData[7]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[7]->time) ? date('h:i A',strtotime($shipmentProcessData[7]->time)) : ''; ?> </span></strong></p>
							<div class="form-group">
							  <label> Reached at destination port Date</label>
							  <input type="text" class="form-control" id="step8_export_rdp_date" name="step8_export_rdp_date" />
							</div>
							<div class="form-group">
							   <input type="text" class="form-control" name="step8_export_details" placeholder="Details">
							</div>
						  </div>
						  <div class="col-12 col-lg-4">
							 <div class="form-group">
								<div class="radio mt-20">
								 <input type="radio" name="step8_export_status" class="css-radio" value="1">
								 <label for="approve" class="css-label">Approved</label>
								</div>
							 </div>
						 </div>
					   </div>   
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php if(!empty($shipmentProcessData[7]->step_id)){ 
						if(isset($shipmentProcessData[7]->step_id) && $stepData[7]->id == $shipmentProcessData[7]->step_id && $shipmentProcessData[7]->status != 1){ ?>
						<input type="hidden" name="step_id_8" value="<?php echo $stepData[7]->id; ?>">
						<input type="submit" name="step8_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id_8" value="<?php echo $stepData[7]->id; ?>">
						<input type="submit" name="step8_export" class="action-button" value="Save" />
						<?php } ?>
						<?php if(isset($shipmentProcessData[7]->step_id) && $stepData[7]->id == $shipmentProcessData[7]->step_id && $shipmentProcessData[7]->status == 1){ ?>
						<input type="button" name="next" class="next action-button" value="Next" />
						<?php } ?>
				   </fieldset>
				   <!-- fieldsets payment Start-->
				   
				    <!-- fieldsets payment Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[8]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					 <div class="shipping-form">
					   <div class="row">
						  <div class="col-12 col-lg-8">
							<p>Custom Cleared at Destination port Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[8]->action_date) ? date('d-M-Y',strtotime($shipmentProcessData[8]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[8]->time) ? date('h:i A',strtotime($shipmentProcessData[8]->time)) : ''; ?> </span></strong></p>
							<div class="form-group">
							  <label> Custom Cleared at Destination port Date</label>
							  <input type="text" class="form-control" id="step9_export_ccd_date" name="step9_export_ccd_date" />
							</div>
							<div class="form-group">
							   <input type="text" class="form-control" name="step9_export_details" placeholder="Details">
							</div>
						  </div>
						  <div class="col-12 col-lg-4">
							 <div class="form-group">
								<div class="radio mt-20">
								 <input type="radio" name="step9_export_status" class="css-radio" value="1">
								 <label for="approve" class="css-label">Approved</label>
								</div>
							 </div>
						 </div>
					   </div>   
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php if(!empty($shipmentProcessData[8]->step_id)){ 
						if(isset($shipmentProcessData[8]->step_id) && $stepData[8]->id == $shipmentProcessData[8]->step_id && $shipmentProcessData[8]->status != 1){ ?>
						<input type="hidden" name="step_id_9" value="<?php echo $stepData[8]->id; ?>">
						<input type="submit" name="step9_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id_9" value="<?php echo $stepData[8]->id; ?>">
						<input type="submit" name="step9_export" class="action-button" value="Save" />
						<?php } ?>
						<?php if(isset($shipmentProcessData[8]->step_id) && $stepData[8]->id == $shipmentProcessData[8]->step_id && $shipmentProcessData[8]->status == 1){ ?>
						<input type="button" name="next" class="next action-button" value="Next" />
						<?php } ?>
				   </fieldset>
				   <!-- fieldsets payment Start-->
				   
				   <!-- fieldsets payment Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[9]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					 <?php $preshipdocs = isset($shipmentProcessData[9]->documents) ? json_decode($shipmentProcessData[9]->documents):''; 
						$status = "<i style='color: #ed2325;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
						if(!empty($shipmentProcessData[9])){
							if(!empty($shipmentProcessData[9]->status ==1)){ 
								$status = "<i style='color: #27ae60;font-size: 17px;margin-left: 10px;' class='fa fa-check-circle-o mt-10'></i>&nbsp;Approved";
							 }else if(!empty($shipmentProcessData[9]->status ==2)){ 
								$status = "<i style='color: #ffb723;font-size: 17px;margin-left: 10px;' class='fa fa-upload mt-10'></i>&nbsp;Uploaded";
							 }else if(!empty($shipmentProcessData[9]->status ==3)){ 
								$status = "<i style='color: #e133ff;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Reupload";
							 }else{
								 $status = "<i style='color: #ed2325;font-size: 17px;margin-left: 10px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
							 } 
						 } ?>
					 <div class="shipping-form">
						<h3>Invoice Document</h3>
						 <div class="row">
							 <div class="col-12 col-lg-4">
								 <div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Invoice Document</span>
										<input type="file" id="invoice_confirm" name="invoice_confirm" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?> />
									</div>
									<span id="invoice_confirm_file"></span>
									<?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-4">
								 <div class="form-group">
								  <label> Delivery Date</label>
								  <input type="text" class="form-control" id="step10_export_delivery_date" name="step10_export_delivery_date" />
								</div>
							 </div>
						</div>
						<hr>
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php if(!empty($shipmentProcessData[9]->step_id)){ 
						if(isset($shipmentProcessData[9]->step_id) && $stepData[9]->id == $shipmentProcessData[8]->step_id && $shipmentProcessData[9]->status != 1){ ?>
						<input type="hidden" name="step_id_10" value="<?php echo $stepData[9]->id; ?>">
						<input type="submit" name="step10_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id_10" value="<?php echo $stepData[9]->id; ?>">
						<input type="submit" name="step10_export" class="action-button" value="Save" />
						<?php } ?>
						<?php if(isset($shipmentProcessData[9]->step_id) && $stepData[9]->id == $shipmentProcessData[9]->step_id && $shipmentProcessData[9]->status == 1){ ?>
						<input type="button" name="next" class="next action-button" value="Next" />
						<?php } ?>
				   </fieldset>
				   <!-- fieldsets payment Start-->
				  
				   <!-- fieldsets payment Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[10]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					<div class="shipping-form">
						<div class="row">
							<div class="col-12 col-lg-4">
								<div class="form-group">
								  <label>Invoice Amount</label>
								  <input type="text" class="form-control" id="step11_export_invoice_amount" name="step11_export_invoice_amount" value="<?php echo isset($bookedShipment->Invoice_amount) ? $bookedShipment->Invoice_amount : ''; ?>"/>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="form-group">
								  <label>DBK Amount</label>
								  <input type="text" class="form-control" id="step11_export_dbk_amount" name="step11_export_dbk_amount" value="<?php echo isset($bookedShipment->DBK_amount) ? $bookedShipment->DBK_amount : ''; ?>"/>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="form-group">
								  <label>MEIS Rate</label>
								  <input type="text" class="form-control" id="step11_export_meis_rate" name="step11_export_meis_rate" value="<?php echo isset($bookedShipment->MEIS_rate) ? $bookedShipment->MEIS_rate : ''; ?>"/>
								</div>
							</div>
					   </div>
					   <div class="row">
							<div class="col-12 col-lg-4">
								<div class="form-group">
								  <label>MEIS Amount</label>
								  <input type="text" class="form-control" id="step11_export_meis_amount" name="step11_export_meis_amount" value="<?php echo isset($bookedShipment->MEIS_amount) ? $bookedShipment->MEIS_amount : ''; ?>"/>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="form-group">
								<label>Bill Amount</label>
								<input type="text" class="form-control" id="step11_export_bill_amount" name="step11_export_bill_amount" value="<?php echo isset($bookedShipment->Bill_amount) ? $bookedShipment->Bill_amount : ''; ?>"/>
								</div>
							</div>
					   </div>					   
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php if(!empty($shipmentProcessData[10]->step_id)){ 
						if(isset($shipmentProcessData[10]->step_id) && $stepData[10]->id == $shipmentProcessData[10]->step_id && $shipmentProcessData[10]->status != 1){ ?>
						<input type="hidden" name="step_id_11" value="<?php echo $stepData[10]->id; ?>">
						<input type="submit" name="step11_export" class="action-button" value="Save" />
						<?php } 
						}else{ ?>
						<input type="hidden" name="step_id_11" value="<?php echo $stepData[10]->id; ?>">
						<input type="submit" name="step11_export" class="action-button" value="Save" />
						<?php } ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script src="<?php echo base_url('assets/frontend/js/custom.js');?>"></script>
<script type="text/javascript">
	
</script>
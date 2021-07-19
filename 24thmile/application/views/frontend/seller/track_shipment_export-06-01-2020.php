
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
       <div class="container">
       <div class="row">
          <div class="col-12 col-lg-12">
              <div class="tracking-block">
                  <div class="tab-content">
		  <h3 class="heading3-border text-uppercase">Track your Shipment </h3>
                  <div class="wshipping-content-block shipping-block">
	     <div class="container">
	    <div class="row">
          <div class="col-12 col-lg-12">
		  
		   <!-- Customer Registration Start -->
		   <div class="wshipping-content-block shipping-block">
			 <div class="container">
			   <div class="row">
				 <div class="shipping-form-block">
				 <form class="steps" action="<?php echo base_url('seller/upload_export_process_documents'); ?>" enctype="multipart/form-data" method="post">
				   <!-- progressbar -->
				   <ul id="progressbar">
				   <?php foreach($stepData as $steps){ ?>
					 <li class="<?php echo (in_array($steps->id,$completedStep)) ? 'active' : '' ?>" ><?php echo $steps->step_name; ?></li>
				   <?php } ?>
				   </ul>
				   <!-- fieldsets Shipping From Start-->
				   <fieldset class="hideStepSection" <?php echo ($currentStep->step_id == $stepData[0]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					 <div class="shipping-form">
						<h3>Shipping Instructions</h3>
						<div class="row">
							<div class="col-12 col-lg-6">
							 <div class="ship-address">
							  <h4>Source Details</h4>
							  <p><?php echo $bookedShipment->consignor_name ?> <br/> <?php echo $bookedShipment->consignor_country_code; ?> <?php echo $bookedShipment->consignor_phone; ?></p>
                                                          <p><?php echo $bookedShipment->consignor_address_line_1; ?> <br/> <?php echo $bookedShipment->consignor_address_line_2; ?><br/><?php echo $bookedShipment->consignor_city_name; ?> - <?php echo $bookedShipment->consignor_pincode; ?></p>
							
							 </div> 
<!--							 <div class="ship-address">
							  <h4>Pick Up Address</h4>
							   </div> -->
						   </div>
						   <div class="col-12 col-lg-6">
							 <div class="ship-address">
							  <h4>Destination Details</h4>
							  <p><?php echo $bookedShipment->consignee_name; ?> <br/> <?php echo $bookedShipment->consignee_country_code; ?> <?php echo $bookedShipment->consignee_phone; ?></p>
							 <p><?php echo $bookedShipment->consignee_address_line_1; ?> <br/> <?php echo $bookedShipment->consignee_address_line_2; ?><br/><?php echo $bookedShipment->consignee_city_name; ?> - <?php echo $bookedShipment->consignee_pincode; ?></p>
							
                                                         </div> 
<!--							 <div class="ship-address">
							  <h4>Delivery Address</h4>
							   </div> -->
						   </div>
						 </div>
						 <h3>Preshipment Document</h3>
						 <div class="row">
						 <?php $preshipdocs = isset($shipmentProcessData[0]->documents) ? json_decode($shipmentProcessData[0]->documents) : '';  
						 $status = "<i style='color: #ed2325;font-size: 17px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
						 if(!empty($shipmentProcessData[0])){
							 if(!empty($shipmentProcessData[0]->status ==1)){ 
								$status = "<i style='color: #27ae60;font-size: 17px;' class='fa fa-check-circle-o mt-10'></i>&nbsp;Approved";
							 }else if(!empty($shipmentProcessData[0]->status ==2)){ 
								$status = "<i style='color: #ffb723;font-size: 17px;' class='fa fa-upload mt-10'></i>&nbsp;Uploaded";
							 }else if(!empty($shipmentProcessData[0]->status ==3)){ 
								$status = "<i style='color: #e133ff;font-size: 17px;' class='fa fa-exclamation mt-10'></i>&nbsp;Reupload";
							 }else{
								 $status = "<i style='color: #ed2325;font-size: 17px;' class='fa fa-exclamation mt-10'></i>&nbsp;Upload Pending";
							 }
						 }
						 ?>
							 <div class="col-12 col-lg-4">
								 <div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Custom Invoice</span>
										<input type="file" id="step1_export_custom_invoice" name="step1_export_custom_invoice" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?>/>
									</div>
									<span id="step1_export_custom_invoice_file"></span>
									<br/><?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-4">
								 <div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Packaging List</span>
										<input type="file" id="step1_export_packing_list" name="step1_export_packing_list" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?> />
									</div>
									<span id="step1_export_packing_list_file"></span>
									<br/><?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-4">
								 <div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Other Document</span>
										<input type="file" id="step1_export_other_documents" name="step1_export_other_documents" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?>/>
									</div>
									<span id="step1_export_other_documents_file"></span>
									<br/><?php echo $status; ?>
								 </div>
							 </div>
						</div>
						<div class="row">
							<br/>
							<div class="col-12 col-lg-5">
								<div class="form-group">
									<label>Custom Invoice Number :</label>
									<input type="number" id="step1_export_custom_invoice_number" name="step1_export_custom_invoice_number" value="<?php echo isset($bookedShipment->custom_invoice_number) ? $bookedShipment->custom_invoice_number : ''; ?>" />
								 </div>
							</div>
							<div class="col-12 col-lg-5">
								 <div class="form-group">
									<label>Custom Invoice Date</label>
									<input type="text" id="step1_export_custom_invoice_date" name="step1_export_custom_invoice_date" value="<?php echo isset($bookedShipment->custom_invoice_date) ? date('d-M-Y',strtotime($bookedShipment->custom_invoice_date)) : ''; ?>" />
								 </div>
							</div>
							<br/>
						</div>
						<h3>Correction/Suggestion</h3>
						<div class="row">
							<div class="col-12 col-lg-12">
							 <div class="comment-content" style="padding: 10px;background: #d2e1f1;border-radius: 25px;">
								<p><?php echo isset($shipmentProcessData[0]->corrections) ? $shipmentProcessData[0]->corrections : 'No correction Found'; ?></p>
							 </div> <br/>
							 </div>
						</div>
					 </div>
					 <input type="hidden" name="request_id" value="<?php echo $bookedShipment->request_id; ?>">
					 <?php                                                  // vdebug([$shipmentProcessData,$stepData]);?>
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
							 <div class="col-12 col-lg-7">
								 <div class="form-group">
									<label>Shipping Bill</label>
									&nbsp;<a target="_blank" href="<?php echo isset($preshipdocs->Shipping_bill_checklist) ? $preshipdocs->Shipping_bill_checklist : '#'; ?>" class="btn btn-warning">Download </a><?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-5">
								 <div class="form-group">
									<div class="radio">
									 <input type="radio" name="step2_export_status" class="css-radio" value="1">
									 <label for="approve" class="css-label">Approved</label>
									 <input type="radio" name="step2_export_status" class="css-radio" value="3">
									 <label for="reupload" class="css-label">Reupload</label>
									</div>
								 </div>
							 </div>
						</div>
						<div class="row">
							<br/>
							<div class="col-12 col-lg-5">
								<div class="form-group">
									<label>Shipping Bill Number :</label>
									<b><?php echo isset($bookedShipment->shipping_bill_number) ? $bookedShipment->shipping_bill_number : ''; ?></b>
								</div>
							</div>
							<div class="col-12 col-lg-5">
								 <div class="form-group">
									<label>Shipping Bill Date:</label>
									<b><?php echo isset($bookedShipment->shipping_bill_date) ? date('d-M-Y',strtotime($bookedShipment->shipping_bill_date)) : ''; ?></b>
								 </div>
							</div>
							<br/>
						</div>
						<h3>Corrections/Suggestions</h3>
						  <div class="form-group">
							 <textarea class="form-control" name="step2_export_correction" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
						  </div>
						 <br/>
						 <hr>
						  <p>Corrections/Suggestions History</p>
						<div class="row">
							<div class="col-12 col-lg-12">
							 <div class="comment-content" style="padding: 19px;background: #d2e1f1;border-radius: 25px;">
								<p><?php echo isset($shipmentProcessData[1]->corrections) ? $shipmentProcessData[1]->corrections : 'No correction Found'; ?></p>
							 </div>
							 <br/>
							</div>
						</div>
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php 
					 if(!empty($shipmentProcessData[1]->step_id)){
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
					 <p>Reached at Loading Port on Date of &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[2]->action_date) ? date('d-M-Y',strtotime($shipmentProcessData[2]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[2]->time) ? date('h:i A',strtotime($shipmentProcessData[2]->time)) : ''; ?> </span></strong> </p>	
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php 
					 if(!empty($shipmentProcessData[2]->step_id)){
					if(isset($shipmentProcessData[2]->step_id) && $stepData[2]->id == $shipmentProcessData[2]->step_id && $shipmentProcessData[2]->status != 1){ ?>
						 <input type="hidden" name="step_id_3" value="<?php echo $stepData[2]->id; ?>">
						 <input type="submit" id="step3_export" class="action-button" value="Save" />
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
					 <p>Reached in Custom Clearance on Date of &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[3]->action_date) ? date('d-M-Y',strtotime($shipmentProcessData[3]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[3]->time) ? date('h:i A',strtotime($shipmentProcessData[3]->time)) : ''; ?> </span></strong></p>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php 
					 if(!empty($shipmentProcessData[3]->step_id)){
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
							 <div class="col-12 col-lg-7">
								 <div class="form-group">
									<label>Draft Bill of Lading</label>
									&nbsp;<a target="_blank" href="<?php echo isset($preshipdocs->Bill_of_lading) ? $preshipdocs->Bill_of_lading : '#'; ?>" class="btn btn-warning">Download </a><?php echo $status; ?>
								 </div>
								 <div class="form-group">
									<label>Final Bill of Lading</label>
									&nbsp;<a target="_blank" href="<?php echo isset($preshipdocs->Final_Bill_of_lading) ? $preshipdocs->Final_Bill_of_lading : '#'; ?>" class="btn btn-warning">Download </a><?php echo $status; ?>
								 </div>
							 </div>
							  <div class="col-12 col-lg-5">
								 <div class="form-group">
									<div class="radio">
									<?php if(!empty($preshipdocs->Final_Bill_of_lading)){ ?>
									 <input type="radio" name="step5_export_status" class="css-radio" value="1">
									 <label for="approve" class="css-label">Approved</label>
									<?php } ?>
									 <input type="radio" name="step5_export_status" class="css-radio" value="3">
									 <label for="reupload" class="css-label">Reupload</label>
									</div>
								 </div>
							 </div>
						</div>
						<div class="row">
							<br/>
							<div class="col-12 col-lg-5">
								<div class="form-group">
									<label>Bill of Lading Number :</label>
									<b><?php echo isset($bookedShipment->bill_of_lading_number) ? $bookedShipment->bill_of_lading_number : ''; ?></b>
								</div>
							</div>
							<div class="col-12 col-lg-5">
								 <div class="form-group">
									<label>Bill of Lading Date:</label>
									<b><?php echo isset($bookedShipment->bill_of_lading_date) ? date('d-M-Y',strtotime($bookedShipment->bill_of_lading_date)) : ''; ?></b>
								 </div>
							</div>
							<br/>
						</div>
						<h3>Corrections/Suggestions</h3>
						<div class="form-group">
							 <textarea class="form-control" name="step5_export_correction" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
						  </div>
						 <br/>
						 <hr>
						  <p>Corrections/Suggestions History</p>
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
					
						<?php 
					 if(!empty($shipmentProcessData[4]->step_id)){
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
				  
				   <!-- fieldsets pick up Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[5]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					<p>Loaded on Vessel/Flight Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[5]->action_date) ? date('d-M-Y',strtotime($shipmentProcessData[5]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[5]->time) ? date('h:i A',strtotime($shipmentProcessData[5]->time)) : ''; ?></strong></p>
					<p>ETD ( Estimated Time of Departure ) Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($bookedShipment->ETD) ? date('d-M-Y h:i a',strtotime($bookedShipment->ETD)) : ''; ?></strong></p>
					<p>ETA ( Estimated Time of Arrival ) Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($bookedShipment->ETA) ? date('d-M-Y h:i a',strtotime($bookedShipment->ETA)) : ''; ?></strong></p>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					  <?php 
					 if(!empty($shipmentProcessData[5]->step_id)){
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
				   <!-- fieldsets package end-->
				   
				   <!-- fieldsets pick up Start-->
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
						<h3>Post Shipment Document</h3>
						 <div class="row">
							 <div class="col-12 col-lg-4">
								<div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Final Bill of Lading</span>
										<input type="file" id="post_shipment_doc1" name="post_shipment_doc1" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?>/>
									</div>
									<span id="post_shipment_doc1_file"></span>
									<?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-4">
								<div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Commercial Invoice</span>
										<input type="file" id="post_shipment_doc2" name="post_shipment_doc2" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?>/>
									</div>
									<span id="post_shipment_doc2_file"></span>
									<?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-4">
								<div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Packaging List</span>
										<input type="file" id="post_shipment_doc3" name="post_shipment_doc3" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?>/>
									</div>
									<span id="post_shipment_doc3_file"></span>
									<?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-4">
								<div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Certificate of Origin</span>
										<input type="file" id="post_shipment_doc4" name="post_shipment_doc4" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?>/>
									</div>
									<span id="post_shipment_doc4_file"></span>
									<?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-4">
								<div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Marin Insurance</span>
										<input type="file" id="post_shipment_doc5" name="post_shipment_doc5" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?>/>
									</div>
									<span id="post_shipment_doc5_file"></span>
									<?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-4">
								<div class="form-group">
									<div class="fileUpload btn btn-primary">
										<span>Other Document</span>
										<input type="file" id="post_shipment_doc6" name="post_shipment_doc6" class="upload" <?php echo (strpos($status, 'Approved') !== false) ? 'disabled' : ''; ?>/>
									</div>
									<span id="post_shipment_doc6_file"></span>
									<?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-5">
								 <div class="form-group">
									<div class="radio">
									 <input type="radio" name="step7_export_status" class="css-radio" value="1">
									 <label for="approve" class="css-label">Approved</label>
									 <input type="radio" name="step7_export_status" class="css-radio" value="3">
									 <label for="reupload" class="css-label">Reupload</label>
									</div>
								 </div>
								 <div class="form-group">
									<div class="checkbox">
									 <input type="checkbox" name="step7_export_agree_document_sent" id="step7_export_agree_document_sent" class="css-checkbox" value="1" <?php echo (isset($shipmentProcessData[6]->note_for_doc) && ($shipmentProcessData[6]->note_for_doc == 1))? 'checked' : ''; ?>>
									 <label for="step7_export_agree_document_sent" class="css-label">I agree that I sent document to buyer/importer</label>
								    </div>
								 </div>
							 </div>
						</div>
						<div class="row">
							<br/>
							<div class="col-12 col-lg-5">
								<div class="form-group">
									<label>Commercial Invoice Number :</label>
									<input type="number" id="step7_export_commercial_invoice_number" name="step7_export_commercial_invoice_number" value="<?php echo isset($bookedShipment->commercial_invoice_number) ? $bookedShipment->commercial_invoice_number : ''; ?>" />
								 </div>
							</div>
							<div class="col-12 col-lg-5">
								 <div class="form-group">
									<label>Commercial Invoice Date</label>
									<input type="text" id="step7_export_commercial_invoice_date" name="step7_export_commercial_invoice_date" value="<?php echo isset($bookedShipment->commercial_invoice_date) ? date('d-M-Y',strtotime($bookedShipment->commercial_invoice_date)) : ''; ?>" />
								 </div>
							</div>
							<br/>
						</div>
						<h3>Corrections/Suggestions</h3>
						 <div class="form-group">
							 <textarea class="form-control" name="step7_export_correction" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
						  </div>
						 <br/>
						 <hr>
						  <p>Corrections/Suggestions History</p>
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
					 <?php 
					 if(!empty($shipmentProcessData[6]->step_id)){
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
				   <!-- fieldsets package end-->
				   
				   <!-- fieldsets pick up Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[7]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					 <p>Reached at destination port Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[7]->action_date) ? date('d-M-Y',strtotime($shipmentProcessData[7]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[7]->time) ? date('h:i A',strtotime($shipmentProcessData[7]->time)) : ''; ?> </span></strong></p>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php 
					 if(!empty($shipmentProcessData[7]->step_id)){
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
				   <!-- fieldsets package end-->
				   
				   <!-- fieldsets pick up Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[8]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					 <p>Custom Cleared at Destination Port Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[8]->action_date) ? date('d-M-Y',strtotime($shipmentProcessData[8]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[8]->time) ? date('h:i A',strtotime($shipmentProcessData[8]->time)) : ''; ?> </span></strong></p>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php 
					 if(!empty($shipmentProcessData[8]->step_id)){
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
				   <!-- fieldsets package end-->
				   
				   <!-- fieldsets pick up Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[9]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					<?php $preshipdocs = isset($shipmentProcessData[9]->documents) ? json_decode($shipmentProcessData[9]->documents):''; 
						$status = "Upload Pending";
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
					  <h3>Invoice</h3>
						 <div class="row">
							 <div class="col-12 col-lg-7">
								 <div class="form-group">
									<label>Invoice Document</label>
									&nbsp;<a target="_blank" href="<?php echo isset($preshipdocs->invoice_confirm) ? $preshipdocs->invoice_confirm : '#'; ?>" class="btn btn-warning">Download </a><?php echo $status; ?>
								 </div>
							 </div>
							 <div class="col-12 col-lg-5">
								 <div class="form-group">
									<div class="radio">
									 <input type="radio" name="step10_export_status" class="css-radio" value="1">
									 <label for="approve" class="css-label">Approved</label>
									 <input type="radio" name="step10_export_status" class="css-radio" value="3">
									 <label for="reupload" class="css-label">Reupload</label>
									</div>
								 </div>
							 </div>
						</div>
						<h3>Corrections/Suggestions</h3>
						<div class="form-group">
							 <textarea class="form-control" name="step10_export_correction" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
						  </div>
						 <br/>
						 <hr>
						  <p>Corrections/Suggestions History</p>
							<div class="row">
								<div class="col-12 col-lg-12">
								 <div class="comment-content" style="padding: 19px;background: #d2e1f1;border-radius: 25px;">
									<p><?php echo isset($shipmentProcessData[9]->corrections)? $shipmentProcessData[9]->corrections : 'No correction Found'; ?></p>
								 </div>
								 <br/>
								</div>
							</div>
					 </div>
					 <input type="button" name="previous" class="previous action-button" value="Previous" />
					 <?php 
					 if(!empty($shipmentProcessData[9]->step_id)){
					if(isset($shipmentProcessData[9]->step_id) && $stepData[9]->id == $shipmentProcessData[9]->step_id && $shipmentProcessData[9]->status != 1){ ?>
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
				   <!-- fieldsets package end-->
				   
				   <!-- fieldsets Review Start-->
				   <fieldset <?php echo ($currentStep->step_id == $stepData[10]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
					<div class="shipping-form">
						<div class="row">
							<div class="col-12 col-lg-4">
								<div class="form-group">
								  <label>ERBC Number</label>
								  <input type="text" class="form-control" id="step11_export_erbc_number" name="step11_export_erbc_number" value="<?php echo isset($bookedShipment->ERBC_number) ? $bookedShipment->ERBC_number : ''; ?>"/>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="form-group">
								  <label>ERBC Date</label>
								  <input type="text" class="form-control" id="step11_export_erbc_date" name="step11_export_erbc_date" value="<?php echo isset($bookedShipment->ERBC_date) ? $bookedShipment->ERBC_date : ''; ?>"/>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="form-group">
									<div class="radio mt-20">
									<input type="radio" name="step11_export_dbk_received" class="css-radio" value="1" <?php echo ($bookedShipment->DBK_status == 1) ? 'checked' : ''; ?>>
									<label for="received" class="css-label">DBK Received</label>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="form-group">
									<div class="radio mt-20">
									<input type="radio" name="step11_export_meis_received" class="css-radio" value="1" <?php echo ($bookedShipment->MEIS_status == 1) ? 'checked' : ''; ?>>
									<label for="received" class="css-label">MEIS Received</label>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="form-group">
									<div class="radio mt-20">
									<input type="radio" name="step11_export_bill_amnt_received" class="css-radio" value="1" <?php echo ($bookedShipment->Bill_status == 1) ? 'checked' : ''; ?>>
									<label for="bill_amnt_received" class="css-label">Bill Amount Received</label>
									</div>
								</div>
							</div>
					   </div>
					</div>
					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<?php 
					 if(!empty($shipmentProcessData[10]->step_id)){
					if(isset($shipmentProcessData[10]->step_id) && $stepData[10]->id == $shipmentProcessData[10]->step_id && $shipmentProcessData[10]->status != 1){ ?>
						 <input type="hidden" name="step_id_11" value="<?php echo $stepData[10]->id; ?>">
						 <input type="submit" name="step11_export" class="action-button" value="Save" />
					 <?php } 
					 }else{ ?>
						 <input type="hidden" name="step_id_11" value="<?php echo $stepData[10]->id; ?>">
						 <input type="submit" name="step11_export" class="action-button" value="Save" />
					 <?php } ?>
					<!--<input type="submit" name="submit" class="submit action-button" value="Submit" />-->
				   </fieldset>
				   <!-- fieldsets payment Start-->
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
          </div>
       </div>
     </div>
   </div>
   <!-- Blog content end --> 
   </section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->
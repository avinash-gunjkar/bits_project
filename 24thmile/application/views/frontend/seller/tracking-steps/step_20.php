 <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
 	<div class="shipping-form">

 		<div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
			 
		 <div class="row">
		 	<div class="col-12 col-lg-4">
 					<div class="form-group">
 						
 							<label for="step9_document_submited_to_bank_date">Document Submited to Bank Date</label>
 							<input type="text" class="form-control date-picker" required aria-describedby="step9_document_submited_to_bank_date-error" required id="step9_document_submited_to_bank_date" name="step9_document_submited_to_bank_date" value="<?=printFormatedDate($bookedShipment->document_submited_to_bank_date)?>" >
						 
						 <span id="step9_document_submited_to_bank_date-error" class="error"></span>

 					</div>
				 </div>
		 		<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<div class="checkbox mt-20">
 							<input type="checkbox" aria-describedby="step9_import_bill_amnt_received-error" required id="step9_import_bill_amnt_received" name="step9_import_bill_amnt_received" class="css-radio" value="1" <?php echo ($bookedShipment->Bill_status == 1) ? 'checked' : ''; ?>>
 							<label for="step9_import_bill_amnt_received">FF Invoice Payment completed</label>
						 </div>
						 <span id="step9_import_bill_amnt_received-error" class="error"></span>

 					</div>
				 </div>
				 <div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>FF Invoice Payment Date: </label>
 						<input type="text" required="" class="form-control date-picker" autocomplete="off" placeholder="DD-MM-YYYY" id="step9_ff_invoice_payment_date" name="step9_ff_invoice_payment_date" value="<?= printFormatedDate($bookedShipment->ff_invoice_payment_date); ?>" />
 					</div>
				 </div>
				 <div class="col-12 col-lg-12">
 					<div class="form-group">
					 <input type="submit" name="step9_import" id="step9_submit_btn_1" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 					</div>
				 </div>
		 </div>
		 <hr>
		 <div class="row">
		 
 				<div class="col-12 col-lg-6">
 					<div class="form-group">
 						<div class="checkbox mt-20">
 							<input type="checkbox" aria-describedby="foreign_trade_policy_compliance-error" required name="foreign_trade_policy_compliance" id="foreign_trade_policy_compliance" class="css-radio" value="1" <?php echo ($bookedShipment->foreign_trade_policy_compliance == 1) ? 'checked' : ''; ?>>
 							<label for="foreign_trade_policy_compliance">Closed Advance License/EPCG or other license if any</label>
						 </div>
						 <span id="foreign_trade_policy_compliance-error" class="error"></span>
 					</div>
				 </div>
 				<div class="col-12 col-lg-6">
 					<div class="form-group">
					 <input type="submit" name="step9_import" id="step9_submit_btn_2" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 					</div>
				 </div>
				 
 			</div>
 		</div>

 		<div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
			 
		 <div class="row">
		 <div class="col-12 col-lg-4">
 					<div class="form-group">
						 <label for="step9_document_submited_to_bank_date">Document Submited to Bank Date:</label>
						 <p><?=printFormatedDate($bookedShipment->document_submited_to_bank_date)?></p>
 					</div>
				 </div>
		 <div class="col-12 col-lg-4">
 					<div class="form-group">

 						<label for="bill_amnt_received">FF Invoice Payment completed:</label> <span><?= $bookedShipment->Bill_status ? 'Yes' : 'Pending' ?></span>
 					</div>
 				</div>
				 <div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>FF Invoice Payment Date: </label> <span><?= printFormatedDate($bookedShipment->ff_invoice_payment_date); ?></span>
 					</div>
				 </div>
		 </div>
		 <hr>
		 <div class="row">
 				
 				<div class="col-12 col-lg-6">
 					<div class="form-group">

 						<label>Closed Advance License/EPCG or other license if any:</label> <span><?= $bookedShipment->foreign_trade_policy_compliance ? 'Done' : 'Pending' ?></span>
 					</div>
 				</div>
 				<div class="col-12 col-lg-12">
 					<span class="text-info">Payment has been sent to Freight Forwarder.</span>
 				</div>
 			</div>
 		</div>
	</div>
	<hr>
 	<input type="hidden" name="step9_import_step_id" value="<?php echo $stepData[$key]->id; ?>">
 	<?php if (in_array($bookedShipment->status,['5'])) { ?>
 		<a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
 		<!-- <input type="submit" name="step9_import" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" /> -->
 		<button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
 	<?php } ?>


	 <script>
 				$('#step9_submit_btn_1').click(function() {
 					$('#step9_import_bill_amnt_received, #step9_document_submited_to_bank_date,#step9_ff_invoice_payment_date').attr('required', true);

 					$('#foreign_trade_policy_compliance').attr('required', false);
 				});
 				$('#step9_submit_btn_2').click(function() {
 					$('#step9_import_bill_amnt_received, #step9_document_submited_to_bank_date,#step9_ff_invoice_payment_date').attr('required', false);

 					$('#foreign_trade_policy_compliance').attr('required', true);
 				});
 				
			 </script>
			 
 </fieldset>
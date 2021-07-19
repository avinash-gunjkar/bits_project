 <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
 	<div class="shipping-form">

 		<div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
			 
		 <div class="row">
		 	<div class="col l6">
 					<div class="form-group">
 						<div class="checkbox mt-20">
 							<input type="checkbox" aria-describedby="step9_import_bill_amnt_received-error" required id="step9_import_bill_amnt_received" name="step9_import_bill_amnt_received" class="css-radio" value="1" <?php echo ($bookedShipment->Bill_status == 1) ? 'checked' : ''; ?>>
 							<label for="step9_import_bill_amnt_received">FF Invoice Payment completed</label>
						 </div>
						 <span id="step9_import_bill_amnt_received-error" class="error"></span>

 					</div>
				 </div>
				 <div class="col l6">
 					<div class="form-group">
					 <input type="submit" name="step9_import" id="step9_submit_btn_1" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 					</div>
				 </div>
		 </div>
		 <hr>
		 <div class="row">
 				
 				<div class="col l6">
 					<div class="form-group">
 						<div class="checkbox mt-20">
 							<input type="checkbox" aria-describedby="foreign_trade_policy_compliance-error" required name="foreign_trade_policy_compliance" id="foreign_trade_policy_compliance" class="css-radio" value="1" <?php echo ($bookedShipment->foreign_trade_policy_compliance == 1) ? 'checked' : ''; ?>>
 							<label for="foreign_trade_policy_compliance">Closed Advance License/EPCG or other license if any</label>
						 </div>
						 <span id="foreign_trade_policy_compliance-error" class="error"></span>
 					</div>
				 </div>
 				<div class="col l6">
 					<div class="form-group">
					 <input type="submit" name="step9_import" id="step9_submit_btn_2" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 					</div>
				 </div>
				 
 			</div>
 		</div>

 		<div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
			 
		 <div class="row">
		 <div class="col l6">
 					<div class="form-group">

 						<label for="bill_amnt_received">FF Invoice Payment completed:</label> <span><?= $bookedShipment->Bill_status ? 'Yes' : 'Pending' ?></span>
 					</div>
 				</div>
		 </div>
		 <hr>
		 <div class="row">
 				
 				<div class="col l6">
 					<div class="form-group">

 						<label>Closed Advance License/EPCG or other license if any:</label> <span><?= $bookedShipment->foreign_trade_policy_compliance ? 'Done' : 'Pending' ?></span>
 					</div>
 				</div>
 				<div class="col l12">
 					<span class="text-info">Payment has been sent to Freight Forwarder.</span>
 				</div>
 			</div>
 		</div>
	</div>
	<hr>
 	<input type="hidden" name="step9_import_step_id" value="<?php echo $stepData[$key]->id; ?>">
 	<?php if ($bookedShipment->status == 5) { ?>
 		<!-- <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a> -->
 		<!-- <input type="submit" name="step9_import" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" /> -->
 		<!-- <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button> -->
 	<?php } ?>


	
			 
 </fieldset>
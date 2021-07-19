 <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>

 	<div class="shipping-form">
 		<!--<h3><?= $bookedShipment->mode_id == '2' ? 'Draft Bill of Airway Bill for Approval' : 'Draft Bill of Lading for Approval' ?> <?php echo $status; ?></h3>-->
 		<div class="row">
 			<div class="col l4">
 				<div class="form-group">
 					<label>Custom Cleared Date:</label>
 					<span><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?></span>
 				</div>
 			</div>
 		</div>
 	</div>
 	<!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->

 	<?php
		if (!empty($shipmentProcessData[$key]->step_id)) {
			if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
 			<!--						 <input type="hidden" name="step_id_4" value="<?php echo $stepData[$key]->id; ?>">
						 <input type="submit" name="step4_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
 		<?php }
		} else { ?>
 		<!--						<input type="hidden" name="step_id_4" value="<?php echo $stepData[$key]->id; ?>">
						<input type="submit" name="step4_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
 	<?php } ?>
 	<?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
 		<!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
 	<?php } ?>
 </fieldset>
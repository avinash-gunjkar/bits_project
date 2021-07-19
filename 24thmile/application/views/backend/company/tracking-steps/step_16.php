 <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
	 <?php
	 $step1_docs = isset($shipmentProcessData[0]->documents) ? json_decode($shipmentProcessData[0]->documents) : '';
	  $preshipdocs = isset($shipmentProcessData[$key]->documents) ? json_decode($shipmentProcessData[$key]->documents) : '';
		$showDownloadbtn = $shipmentProcessData[$key]->status == 2 || $shipmentProcessData[$key]->status == 1;
		$status = "<span class='badge badge-danger'>Upload Pending</span>";
		if (!empty($shipmentProcessData[$key])) {
			if (!empty($shipmentProcessData[$key]->status == 1)) {
				$status = "<span class='badge badge-success'>Approved</span>";
			} else if (!empty($shipmentProcessData[$key]->status == 2)) {
				$status = "<span class='badge badge-info'>Uploaded</span>";
			} else if (!empty($shipmentProcessData[$key]->status == 3)) {
				$status = "<span class='badge badge-warning'>Reupload</span>";
			} else {
				$status = "<span class='badge badge-danger'>Upload Pending</span>";
			}
		} ?>
 	<!--<h3><?= $bookedShipment->mode_id == '2' ? 'Final Bill of Airway Bill' : 'Final Bill of Lading' ?> <?php echo $status; ?></h3>-->
 	<h5>Final Bill of Lading / Airway Bill <?php echo $status; ?></h5>
 	<div class="row">

	 <?php if (in_array($bookedShipment->delivery_term_id, ['3', '4', '5', '6', '7'])) { ?>
					<div class="col l4">
							<div class="form-group">
									<label>Final BL / AWB:</label>
									<p><?= printDocumentLink($step1_docs->final_billl_of_lading) ?></p>
							</div>
					</div>
			<?php } else { ?>
			 <div class="col l4">
 				<div class="form-group">
					 <label>Final BL / AWB:</label>
					 <p><?= printDocumentLink($preshipdocs->final_billl_of_lading) ?></p>
					 
 				</div>
			 </div>
			 <?php } ?>

 		<div class="col l4">
 			<div class="form-group">
 				<label>BL / AWB Number :</label>
					 <p><?php echo isset($bookedShipment->bill_of_lading_number) ? $bookedShipment->bill_of_lading_number : '- -'; ?></p>
 			</div>
 		</div>
 		<div class="col l4">
 			<div class="form-group">
				 <label>BL / AWB Date:</label> 
				 <p><?=  $bookedShipment->bill_of_lading_date?printFormatedDate($bookedShipment->bill_of_lading_date):'- -'; ?></p>
 			</div>
 		</div>
 		<div class="col l4">
 			<div class="form-group">
 				<label>Loaded on <?= $loadedOn_str ?> Date:</label>
 				<p><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?></p>
 			</div>
 		</div>
 		<div class="col l4">
 			<div class="form-group">
 				<label>ETD ( Estimated Time of Departure ) Date:</label>
 				<p><?= $bookedShipment->ETD ? printFormatedDate($bookedShipment->ETD) : '- -'; ?></p>
 			</div>
 		</div>
 		<div class="col l4">
 			<div class="form-group">
 				<label>ETA ( Estimated Time of Arrival ):</label>
 				<p><?= $bookedShipment->ETA ? printFormatedDate($bookedShipment->ETA) : '- -'; ?></p>
 			</div>
 		</div>
 		<div class="col l6">
 			<div class="form-group">
 				<label>Loading Confirmation Date: </label>
 				<span><?= $bookedShipment->loading_confirm_date ? printFormatedDate($bookedShipment->loading_confirm_date) : '- -'; ?></span>
 			</div>
 		</div>
 		<div class="col l12">
 			<div class="form-group">
 				<label>Remark:</label>
 				<span><?= $shipmentProcessData[$key]->corrections ? $shipmentProcessData[$key]->corrections : '- -'; ?></span>
 			</div>
 		</div>
 		<?php if ($shipmentProcessData[$key]->status == 1 || $shipmentProcessData[$key]->status == 2) { ?>
 			<div class="col l12">
 				<span class="text-info">Email has been sent to Buyer.</span>
 			</div>
 		<?php } ?>

 	</div>

 	<!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->
 	<?php
		if (!empty($shipmentProcessData[$key]->step_id)) {
			if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
 			<!--						 <input type="hidden" name="step_id_5" value="<?php echo $stepData[$key]->id; ?>">
						 <input type="submit" name="step5_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
 		<?php }
		} else { ?>
 		<!--						<input type="hidden" name="step_id_5" value="<?php echo $stepData[$key]->id; ?>">
						<input type="submit" name="step5_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
 	<?php } ?>
 	<?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
 		<!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
 	<?php } ?>
 </fieldset>
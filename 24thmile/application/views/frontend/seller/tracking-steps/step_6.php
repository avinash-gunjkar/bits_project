<fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
	<?php $preshipdocs = isset($shipmentProcessData[$key]->documents) ? json_decode($shipmentProcessData[$key]->documents) : '';
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
	<h3>Final Bill of Lading / Airway Bill</h3>
	<div class="row">

		<div class="col-12 col-lg-4">
			<div class="form-group">
				<label>Final BL / AWB:</label>
				<p><?= printDocumentLink($preshipdocs->Final_Bill_of_lading) ?></p>
				
			</div>
		</div>

		<div class="col-12 col-lg-4">
			<div class="form-group">
				<label>BL / AWB Number :</label> 
				<p><?php echo isset($bookedShipment->bill_of_lading_number) ? $bookedShipment->bill_of_lading_number : '- -'; ?></p>
			</div>
		</div>

		<div class="col-12 col-lg-4">
			<div class="form-group">
				<label>BL / AWB Date:</label>
				<p><?= $bookedShipment->bill_of_lading_date?printFormatedDate($bookedShipment->bill_of_lading_date):'- -'; ?></p>
			</div>
		</div>


		<div class="col-12 col-lg-4">
			<div class="form-group">
				<label>Loaded on Vessel/Flight Date:</label> <p><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?></p>
			</div>
		</div>
		<div class="col-12 col-lg-4">
			<div class="form-group">
				<label>ETD ( Estimated Time of Departure ) Date:</label> <p><?= $bookedShipment->ETD ? printFormatedDate($bookedShipment->ETD) : '- -'; ?></p>
			</div>
		</div>
		<div class="col-12 col-lg-4">
			<div class="form-group">
				<label>ETA ( Estimated Time of Arrival ) Date:</label> <p><?= $bookedShipment->ETA ? printFormatedDate($bookedShipment->ETA) : '- -'; ?></p>
			</div>
		</div>
		<div class="col-12 col-lg-12">
			<div class="form-group">
				<label>Remark:</label> <span><?= $shipmentProcessData[$key]->corrections ? $shipmentProcessData[$key]->corrections : '- -'; ?></span>
			</div>
		</div>

		<?php if ($shipmentProcessData[$key]->status == 1 || $shipmentProcessData[$key]->status == 2) { ?>
			<!-- <div class="col-12 col-lg-12">
				<span class="text-info">Email has been sent to Buyer.</span>
			</div> -->
		<?php } ?>

	</div>
	
	<?php
	if (!empty($shipmentProcessData[$key]->step_id)) {
		if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
			<!--						 <input type="hidden" name="step_id_6" value="<?php echo $stepData[$key]->id; ?>">
						 <input type="submit" name="step6_export" class="btn btn-default-cust action-button pull-right" value="Submit" />-->
		<?php }
	} else { ?>
		<!--						<input type="hidden" name="step_id_6" value="<?php echo $stepData[$key]->id; ?>">
						<input type="submit" name="step6_export" class="btn btn-default-cust action-button pull-right" value="Submit" />-->
	<?php } ?>
	<?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
		<!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
	<?php } ?>

</fieldset>
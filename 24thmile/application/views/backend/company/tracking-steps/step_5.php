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
	<div class="shipping-form">
		<h5>Draft Bill of Lading / Airway Bill <?php echo $status; ?></h5>
		<div class="row">
			<div class="col l3">
				<div class="form-group">
					<label>Draft BL / AWB:</label>
					<p><?= printDocumentLink($preshipdocs->Bill_of_lading) ?></p>
				
				</div>
			</div>

			<?php if ($bookedShipment->mode_id == '3') { ?>
				<div class="col l3">
					<div class="form-group">
						<label>VGM:</label>
						<p><?= printDocumentLink($preshipdocs->vgm_document) ?>?</p>
					
					</div>
				</div>
			<?php } ?>


			<?php if ($shipmentProcessData[$key]->status == 1 || $shipmentProcessData[$key]->status == 2) { ?>
				<!-- <div class="col l12">
					<span class="text-info">Email has been sent to Freight Forwarder.</span>
				</div> -->
			<?php } ?>
		</div>
		<?php if ($shipmentProcessData[$key]->status != 1) { ?>
			<!-- <h3>Corrections/Suggestions</h3>
			<div class="form-group">
				<textarea class="form-control" name="step5_export_correction" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
			</div>
			<br /> -->
		<?php } ?>
		<hr>
		<p>Corrections/Suggestions History</p>
		<div class="row">
			<div class="col l12">
				<div class="comment-content-box">
					<p><?php echo isset($shipmentProcessData[$key]->corrections) ? $shipmentProcessData[$key]->corrections : 'No correction Found'; ?></p>
				</div>
				<br />
			</div>
		</div>
	</div>
	<!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->
	<?php if ($shipmentProcessData[$key]->status != 1) { ?>
		<!-- <div class="row">
			<div class="col l12">
				<div class="py-2">
					<i class="text-mutted">Note: Kindly approved or Suggest changes through System Communication.</i>
				</div>
				<div class="form-group">
					<div class="form-check form-check-inline">

						<input type="radio" name="step5_export_status" required="" class="form-check-input" value="1">
						<label for="approve" class="form-check-label">Approve</label>

					</div>
					<div class="form-check form-check-inline">
						<input type="radio" name="step5_export_status" required="" class="form-check-input" value="3" checked="">
						<label for="reupload" class="form-check-label">Correction required</label>
					</div>
				</div>
			</div>
		</div> -->
	<?php } ?>
	<?php
	if (!empty($shipmentProcessData[$key]->step_id)) {
		if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
			<!-- <input type="hidden" name="step_id_5" value="<?php echo $stepData[$key]->id; ?>"> -->
			<!-- <input type="submit" name="step5_export" class="btn btn-default-cust action-button pull-right" value="Submit" /> -->
		<?php }
	} else { ?>
		<!--						<input type="hidden" name="step_id_5" value="<?php echo $stepData[$key]->id; ?>">
						<input type="submit" name="step5_export" class="btn btn-default-cust action-button pull-right" value="Submit" />-->
	<?php } ?>
	<?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
		<!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
	<?php } ?>

</fieldset>
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
		<h3><?= $bookedShipment->mode_id == '2' ? 'Draft Bill of Airway Bill for Approval' : 'Draft Bill of Lading for Approval' ?> <?php echo $status; ?></h3>
		<div class="row">
			<div class="col-12 col-lg-12">
				<div class="form-group">
					<?php if ($shipmentProcessData[$key]->status == 1 || $shipmentProcessData[$key]->status == 2) { ?>
						<label>Draft Bill</label>
						&nbsp;<a target="_blank" href="<?php echo isset($preshipdocs->Bill_of_lading) ? $preshipdocs->Bill_of_lading : '#'; ?>" class="fa fa-download fa-lg text-primary" title="Download"></a>
					<?php } else { ?>
						<div class="fileUpload btn btn-secondary">
							<span>Select Draft Bill</span>
							<input type="file" aria-describedby="Bill_of_lading-error" id="Bill_of_lading" name="Bill_of_lading" class="upload"  />
						</div>
						<div class="selected-file-name"></div>
						<span id="Bill_of_lading-error" class="error"></span>
					<?php } ?>

				</div>
			</div>
		</div>
		<h3>Correction/Suggestion</h3>
		<div class="row">
			<div class="col-12 col-lg-12">
				<div class="comment-content-box">
					<p><?php echo isset($shipmentProcessData[$key]->corrections) ? $shipmentProcessData[$key]->corrections : 'No correction Found'; ?></p>
				</div>
				<br />
			</div>
		</div>
	</div>
	<!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->
	<?php if (!empty($shipmentProcessData[$key]->step_id)) {
		if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
			<input type="hidden" name="step_id_5" value="<?php echo $stepData[$key]->id; ?>">
			<input type="submit" name="step5_import" class="btn btn-default-cust action-button pull-right" value="Submit" />
		<?php }
	} else { ?>
		<input type="hidden" name="step_id_5" value="<?php echo $stepData[$key]->id; ?>">
		<input type="submit" name="step5_import" class="btn btn-default-cust action-button pull-right" value="Submit" />
	<?php } ?>
	<?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
		<!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
	<?php } ?>
</fieldset>
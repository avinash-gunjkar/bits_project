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
		<!--<h3>Checklist for Shipping Bill</h3>-->
		<h3>Approve Checklist of Custom documents (Shipping Bill) <?php echo $status; ?></h3>
		<div class="row">
			<div class="col-12 col-lg-6">
				<div class="form-group">
					<label>Checklist for Shipping Bill:</label>
					<?= printDocumentLink($preshipdocs->Shipping_bill_checklist) ?>
				

					<?php if ($shipmentProcessData[$key]->status == 1 || $shipmentProcessData[$key]->status == 2) { ?>
						<br><span class="text-info">Email has been sent.</span>
					<?php } ?>
				</div>
			</div>

			

		</div>
		<?php if ($shipmentProcessData[$key]->status != 1) { ?>
			<h3>Corrections/Suggestions</h3>
			<div class="form-group">
				<textarea class="form-control" name="step2_export_correction" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
			</div>
			<br />
		<?php } ?>
		<hr>
		<p>Corrections/Suggestions History</p>
		<div class="row">
			<div class="col-12 col-lg-12">
				<div class="comment-content-box">
					<p><?php echo isset($shipmentProcessData[$key]->corrections) ? $shipmentProcessData[$key]->corrections : 'No correction Found'; ?></p>
				</div>
				<br />
			</div>
		</div>
	</div>

	<?php if ($shipmentProcessData[$key]->status != 1) { ?>
		<div class="row">
				<div class="col-12 col-lg-12">
				<div class="py-2">
					<i class="text-mutted">Note: Kindly approved  or Suggest changes through System Communication.</i>
				</div>
					<div class="form-group">
						<div class="form-check form-check-inline">
							<input type="radio" name="step2_export_status" class="form-check-input" value="1">
							<label for="approve" class="form-check-label">Approve</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="step2_export_status" class="form-check-input" value="3">
							<label for="reupload" class="form-check-label">Correction required</label>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
	<!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->
	<?php
	if (!empty($shipmentProcessData[$key]->step_id)) {
		if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
			<input type="hidden" name="step_id_2" value="<?php echo $stepData[$key]->id; ?>">
			<input type="submit" name="step2_export" class="btn btn-default-cust btn btn-submit pull-right" value="Submit" />
		<?php }
	} else { ?>
		<!--						<input type="hidden" name="step_id_2" value="<?php echo $stepData[$key]->id; ?>">
						<input type="submit" name="step2_export" class="btn btn-default-cust btn btn-submit pull-right" value="Submit" />-->
	<?php } ?>
	<?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
		<!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
	<?php } ?>

</fieldset>
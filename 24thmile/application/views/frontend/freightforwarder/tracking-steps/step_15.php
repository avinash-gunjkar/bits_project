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
		<h3>Draft Bill of Lading / Airway Bill <?php echo $status; ?></h3>

		<div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
			<div class="row">
				<div class="col-12 col-lg-12">

					<div class="form-group">
						<div class="fileUpload btn btn-secondary">
							<label>Draft Bill</label>
							<input type="file" aria-describedby="Bill_of_lading-error" id="Bill_of_lading" name="Bill_of_lading" class="upload" />
						</div>
						<div class="selected-file-name">
							<p><?= printDocumentLink($preshipdocs->Bill_of_lading) ?></p>
						</div>
						<span id="Bill_of_lading-error" class="error"></span>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="form-group">
						<label>Custom Cleared Date:</label>
						<input type="text" required class="form-control date-picker" required="" placeholder="DD-MM-YYYY" autocomplete="off" name="custome_cleared_date" value="<?= printFormatedDate($shipmentProcessData[$key]->action_date) ?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
			<div class="row">
				<div class="col-12 col-lg-12">
					<div class="form-group">
						<label>Draft Bill</label>
						<p><?= printDocumentLink($preshipdocs->Bill_of_lading) ?></p>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="form-group">
						<label>Custom Cleared Date:</label>
						<span><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?></span>
					</div>
				</div>
			</div>
			
		</div>

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



	<input type="hidden" name="step4_import_step_id" value="<?php echo $stepData[$key]->id; ?>">
	<?php if ($bookedShipment->quote_status == 5) { ?>
		<a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
		<input type="submit" name="step4_import" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
		<button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
	<?php } ?>

</fieldset>
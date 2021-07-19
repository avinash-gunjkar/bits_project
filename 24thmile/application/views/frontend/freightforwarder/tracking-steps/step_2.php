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
 		<h3>Send draft of Checklist of Custom documents (Shipping Bill) for Approval. <?php echo $status; ?></h3>
		 
		 <div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
		 <div class="row">
 			<div class="col-12 col-lg-6">
 				<div class="form-group">
				 <div class="fileUpload btn btn-secondary">
 							<span>Select Checklist for Shipping Bill</span>
 							<input type="file" aria-describedby="sb_checklist_ff-error" id="sb_checklist_ff" name="sb_checklist_ff" class="upload"  />
 						</div>

 						<div class="selected-file-name">
						 <?php if (!empty($preshipdocs->Shipping_bill_checklist)) {  ?>
								<?= array_pop(explode('/', $preshipdocs->Shipping_bill_checklist)); ?>&nbsp;<a target="_blank" href="<?php echo isset($preshipdocs->Shipping_bill_checklist) ? $preshipdocs->Shipping_bill_checklist : '#'; ?>" title="Download" class="fa fa-download fa-lg text-primary"></a>
						<?php } ?>
						 </div>
 						<span id="sb_checklist_ff-error" class="error"></span>

						 <?php if ($shipmentProcessData[$key]->status == 3) { ?>
 						<span class="text-info">Email has been sent to Freight Seller. Awaiting for approval.</span>
 					<?php } ?>
 				</div>
 			</div>
 			

 		</div>
		</div>
		<div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
		<div class="row">
 			<div class="col-12 col-lg-6">
 				<div class="form-group">
					 <label>Checklist for Shipping Bill:</label>
					 <?= printDocumentLink($preshipdocs->Shipping_bill_checklist) ?>
					

 					<?php if ($shipmentProcessData[$key]->status == 3) { ?>
 						<span class="text-info">Email has been sent.</span>
 					<?php } ?>
 				</div>
 			</div>

 		</div>
		</div>
		

 		<p>Correction/Suggestion</p>
 		<div class="row">
 			<div class="col-12 col-lg-12">
 				<div class="comment-content-box">
 					<p><?php echo isset($shipmentProcessData[$key]->corrections) ? $shipmentProcessData[$key]->corrections : 'No correction Found'; ?></p>
 				</div>
 				<br />
 			</div>
 		</div>
	 </div>
	 
	 <input type="hidden" name="step2_export_step_id" value="<?php echo $stepData[$key]->id; ?>">
	 <?php if ($bookedShipment->quote_status == 5) { ?>
                 <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                 <input type="submit" name="step2_export" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                 <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
		 <?php } ?>
		

 </fieldset>
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
 	<div class="shipping-form">
 		<!--<h3><?= $bookedShipment->mode_id == '2' ? 'Final Bill of Airway Bill' : 'Final Bill of Lading' ?> <?php echo $status; ?></h3>-->
 		<h3>Final Bill of Lading / Airway Bill <?php echo $status; ?></h3>


 		<div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
 			<div class="row">
			 <?php if (in_array($bookedShipment->delivery_term_id, ['3', '4', '5', '6', '7'])) { ?>
					<div class="col-12 col-lg-3">
							<div class="form-group">
									<label>Final BL / AWB:</label>
									<p><?= printDocumentLink($step1_docs->final_billl_of_lading) ?></p>
							</div>
					</div>
			<?php } else { ?>
			 <div class="col-12 col-lg-4">
 				<div class="form-group">
				 <div class="fileUpload btn btn-secondary">
 							<span>Select Final BL / AWB</span>
 							<input type="file" aria-describedby="Final_Bill_of_lading-error" id="Final_Bill_of_lading" name="Final_Bill_of_lading" class="upload"  />
 						</div>
 						<div class="selected-file-name">
						 <p><?= printDocumentLink($step1_docs->final_billl_of_lading) ?></p>
						 </div>
						 <span id="Final_Bill_of_lading-error" class="error"></span>

 				</div>
			 </div>
			 <?php } ?>
			 
			 <div class="col-12 col-lg-4">

 					<div class="form-group">

 						<label> BL / AWB Number <sup>*</sup></label>
 						<input type="text" required="" class="form-control width-150" autocomplete="off" id="step5_import_bol_number" name="step5_import_bol_number" value="<?php echo isset($bookedShipment->bill_of_lading_number) ? $bookedShipment->bill_of_lading_number : ''; ?>" />
 					</div>
 				</div>
 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>BL / AWB Date <sup>*</sup></label>
 						<input type="text" required="" class="date-picker form-control " placeholder="DD-MM-YYYY" autocomplete="off" name="step5_import_bol_date" value="<?= printFormatedDate($bookedShipment->bill_of_lading_date); ?>" />
 					</div>
 				</div>

 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>Loaded on <?= $loadedOn_str ?> Date <sup>*</sup> </label>
 						<input type="text" required class="form-control date-picker" placeholder="DD-MM-YYYY" required="" autocomplete="off" name="step5_import_lov_date" value="<?=printFormatedDate($shipmentProcessData[$key]->action_date)?>"/>
 					</div>
 				</div>
 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>ETD ( Estimated Time of Departure ) Date <sup>*</sup> </label>
 						<input type="text" required class="form-control date-picker" required="" placeholder="DD-MM-YYYY" autocomplete="off" name="step5_import_etd_date" value="<?=printFormatedDate($bookedShipment->ETD)?>" />
 					</div>
 				</div>
 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>ETA ( Estimated Time of Arrival ) Date <sup>*</sup> </label>

 						<input type="text" required class="form-control date-picker" required="" placeholder="DD-MM-YYYY" autocomplete="off" name="step5_import_eta_date" value="<?=printFormatedDate($bookedShipment->ETA)?>" />

 					</div>
 				</div>
 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>Loading Confirmation Date <sup>*</sup></label>

 						<input type="text" required class="form-control date-picker" required="" placeholder="DD-MM-YYYY" autocomplete="off" name="loading_confirm_date" value="<?=printFormatedDate($bookedShipment->loading_confirm_date)?>" />

 					</div>
 				</div>
 				<div class="col-12 col-lg-12">
 					<div class="form-group">
 						<label>Remark</label>

 						<input type="text" class="form-control" name="step5_import_details" placeholder="Remark" value="<?= $shipmentProcessData[$key]->corrections?>">

 					</div>

				 </div>

				 <div class="form-group" style="display: none;">
 				<div class="form-check form-check-inline mt-20">
 					<input type="radio" name="step5_import_status" class="form-check-input" checked="" value="1">
 					<label for="approve" class="form-check-label">Approved</label>
 				</div>
 			</div>
				 
 			</div>
 		</div>
 		<div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
 			<div class="row">
			 <?php if (in_array($bookedShipment->delivery_term_id, ['3', '4', '5', '6', '7'])) { ?>
					<div class="col-12 col-lg-4">
							<div class="form-group">
									<label>Final BL / AWB:</label>
									<p><?= printDocumentLink($step1_docs->final_billl_of_lading) ?></p>
							</div>
					</div>
			<?php } else { ?>
			 <div class="col-12 col-lg-4">
 				<div class="form-group">
					 <label>Final BL / AWB:</label>
					 <p><?= printDocumentLink($preshipdocs->final_billl_of_lading) ?></p>
					 
 				</div>
			 </div>
			 <?php } ?>
			 
			 <div class="col-12 col-lg-4">

 					<div class="form-group">

 						<label> BL / AWB Number :</label>
 						<p><?php echo isset($bookedShipment->bill_of_lading_number) ? $bookedShipment->bill_of_lading_number : '- -'; ?></p>
 					</div>
 				</div>

 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>BL / AWB Date:</label>
 						<p><?=$bookedShipment->bill_of_lading_date?printFormatedDate($bookedShipment->bill_of_lading_date):'- -'; ?></p>
 					</div>
 				</div>



 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>Loaded on <?= $loadedOn_str ?> Date: </label>
 						<p><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -' ?></p>
 					</div>
 				</div>
 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>ETD ( Estimated Time of Departure ) Date: </label>
 						<p><?= $bookedShipment->ETD ? printFormatedDate($bookedShipment->ETD) : '- -'; ?></p>
 					</div>
 				</div>
 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>ETA ( Estimated Time of Arrival ) Date: </label>
 						<p><?= $bookedShipment->ETA ? printFormatedDate($bookedShipment->ETA) : '- -'; ?></p>
 					</div>
 				</div>
 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>Loading Confirmation Date: </label>
 						<span><?= $bookedShipment->loading_confirm_date ? printFormatedDate($bookedShipment->loading_confirm_date) : '- -'; ?></span>
 					</div>
 				</div>

 				<div class="col-12 col-lg-12">
 					<div class="form-group">
 						<label>Remark:</label>
 						<?= $shipmentProcessData[$key]->corrections ? $shipmentProcessData[$key]->corrections : '- -' ?>
 					</div>
 				</div>
 			</div>
 		</div>
 		
	 </div>
	 
	 
	<input type="hidden" name="step5_import_step_id" value="<?php echo $stepData[$key]->id; ?>">
	<?php if ($bookedShipment->quote_status == 5) { ?>
		<a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
		<input type="submit" name="step5_import" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
		<button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
	<?php } ?>
	
 </fieldset>
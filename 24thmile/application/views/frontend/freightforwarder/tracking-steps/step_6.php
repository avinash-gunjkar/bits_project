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
		<h3>Final Bill of Lading / Airway Bill <?php echo $status; ?></h3>

		<div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
			<div class="row">
				<div class="col-12 col-lg-4">
					<div class="form-group">
						<div class="fileUpload btn btn-secondary">
							<span>Select Final BL / AWB</span>
							<input type="file" aria-describedby="Final_Bill_of_lading-error" id="Final_Bill_of_lading" name="Final_Bill_of_lading" class="upload"  />
						</div>
						<div class="selected-file-name">
						<p><?= printDocumentLink($preshipdocs->Final_Bill_of_lading) ?></p>
						</div>
						<span id="Final_Bill_of_lading-error" class="error"></span>
					</div>
				</div>

				<div class="col-12 col-lg-4">

					<div class="form-group">

						<label> BL / AWB Number :</label>
						<input type="text" class="form-control width-150 " autocomplete="off" id="step6_export_bol_number" name="step6_export_bol_number" value="<?php echo isset($bookedShipment->bill_of_lading_number) ? $bookedShipment->bill_of_lading_number : ''; ?>" required />

					</div>
				</div>

				<div class="col-12 col-lg-4">
					<div class="form-group">
						<label>BL / AWB Date:</label>
						<input type="text" class="date-picker form-control" autocomplete="off" placeholder="DD-MM-YYYY" name="step6_export_bol_date" value="<?= printFormatedDate($bookedShipment->bill_of_lading_date); ?>" required />


					</div>
				</div>

				<div class="col-12 col-lg-4">
					<div class="form-group">
						<label>Loaded on Vessel/Flight Date: </label>


						<input type="text" class="form-control date-picker" placeholder="DD-MM-YYYY" autocomplete="off" name="step6_export_lov_date" value="<?=$shipmentProcessData[$key]->action_date?>" required />



					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="form-group">
						<label>ETD ( Estimated Time of Departure ) Date: </label>

						<input type="text" class="form-control date-picker" placeholder="DD-MM-YYYY" autocomplete="off" name="step6_export_etd_date" value="<?=printFormatedDate($bookedShipment->ETD)?>" required />

					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="form-group">
						<label>ETA ( Estimated Time of Arrival ) Date: </label>

						<input type="text" class="form-control date-picker" placeholder="DD-MM-YYYY" autocomplete="off" name="step6_export_eta_date" value="<?=printFormatedDate($bookedShipment->ETA)?>" required/>

					</div>
				</div>
				<div class="col-12 col-lg-12">
				<div class="form-group">
					<label>Remark:</label>
					<input type="text" class="form-control" name="step6_export_details" placeholder="Remark" value="<?=$shipmentProcessData[$key]->corrections?>">
				</div>
				</div>

			</div>
		</div>

		<div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
			<div class="row">
				<div class="col-12 col-lg-4">
					<div class="form-group">
						<label>Final BL / AWB:</label>
						<p><?= printDocumentLink($preshipdocs->Final_Bill_of_lading) ?></p>
						
					</div>
				</div>

				<div class="col-12 col-lg-4">

					<div class="form-group">

						<label> BL / AWB Number :</label>
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
						<label>Loaded on Vessel/Flight Date: </label>

						<p><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -' ?></p>

					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="form-group">
						<label>ETD ( Estimated Time of Departure ) Date: </label>

						<p><?= $bookedShipment->ETD ? printFormatedDate($bookedShipment->ETD) : '- -' ?></p>

					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="form-group">
						<label>ETA ( Estimated Time of Arrival ) Date: </label>

						<p><?= $bookedShipment->ETA ? printFormatedDate($bookedShipment->ETA) : '- -' ?></p>

					</div>
				</div>
				<div class="col-12 col-lg-12">
				<div class="form-group">
					<label>Remark:</label>
					<span><?= $shipmentProcessData[$key]->corrections?$shipmentProcessData[$key]->corrections:'- -' ?></span>
					

				</div>
				</div>
				<div class="col-12 col-lg-12">
					<span class="text-info">Email has been sent.</span>
				</div>

			</div>
		</div>

		<div class="row">




			<div class="col-12 col-lg-12">
				
				<div class="form-group" style="display: none;">
					<div class="form-check form-check-inline mt-20">
						<input type="radio" name="step6_export_status" class="form-check-input" checked="" value="1">
						<label for="approve" class="form-check-label">Approved</label>
					</div>
				</div>
			</div>
			
		</div>
	</div>

	<input type="hidden" name="step6_export_step_id" value="<?php echo $stepData[$key]->id; ?>">
	<?php if ($bookedShipment->quote_status == 5) { ?>
                 <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                 <input type="submit" name="step6_export" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                 <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
         <?php } ?>
	

</fieldset>
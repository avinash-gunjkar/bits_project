<fieldset class="hideStepSection" <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
	<h3>Shipping Instructions</h3>
	<div class="row">
		<div class="col-12 col-lg-6">
			<div class="ship-address">
				<h4>Pick-up Address</h4>
				<p><?php echo $bookedShipment->consignor_name ?> <br /> <?php echo $bookedShipment->consignor_country_code; ?> <?php echo $bookedShipment->consignor_phone; ?></p>
				<p><?php echo $bookedShipment->consignor_address_line_1; ?> <br /> <?php echo $bookedShipment->consignor_address_line_2; ?><br /><?php echo $bookedShipment->consignor_city_name; ?> - <?php echo $bookedShipment->consignor_pincode; ?></p>
			</div>

		</div>
		<div class="col-12 col-lg-6">
			<div class="ship-address">
				<h4>Delivery Address</h4>
				<p><?php echo $bookedShipment->consignee_name; ?> <br /> <?php echo $bookedShipment->consignee_country_code; ?> <?php echo $bookedShipment->consignee_phone; ?></p>
				<p><?php echo $bookedShipment->consignee_address_line_1; ?> <br /> <?php echo $bookedShipment->consignee_address_line_2; ?><br /><?php echo $bookedShipment->consignee_city_name; ?> - <?php echo $bookedShipment->consignee_pincode; ?></p>
			</div>

		</div>
	</div>
	<div class="row">
		<div class="col-12 col-lg-4">
			<div class="form-group">
				<label>Pick-up Date:</label> <?= $bookedShipment->pick_up_datetime ? printFormatedDateTime($bookedShipment->pick_up_datetime) : '- -' ?>
			</div>
		</div>
		<div class="col-12 col-lg-8">
			<div class="form-group">
				<label>Any other specific instructions:</label> <?= $bookedShipment->shipping_instruction ? $bookedShipment->shipping_instruction : 'NA'; ?>
			</div>
		</div>
	</div>

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
	<h3>Pre-Shipment Documents <?php echo $status; ?></h3>
	<div class="row preship">
		<div class="col-12 col-lg-3">
			<div class="form-group">
				<label style="display: inline-block">Custom Invoice:</label>
				<p><?= printDocumentLink($preshipdocs->Custom_Invoice) ?></p>
			</div>
		</div>

		<div class="col-12 col-lg-3">
			<div class="form-group">
				<label style="display: inline;">Custom Invoice Number :</label>
				<p><?php echo isset($bookedShipment->custom_invoice_number) ? $bookedShipment->custom_invoice_number : '- -'; ?></p>
			</div>
		</div>
		<div class="col-12 col-lg-3">
			<div class="form-group">
				<label style="display: inline;">Custom Invoice Date:</label>
				<p><?= $bookedShipment->custom_invoice_date ? printFormatedDate($bookedShipment->custom_invoice_date) : '- -'; ?></p>
			</div>
		</div>
		<div class="col-12 col-lg-3">
			<div class="form-group">
				<label>Custom Invoice Value (<?= $bookedShipment->custom_invoice_currency ? $bookedShipment->custom_invoice_currency : 'INR' ?>):</label>
				<p><?php echo isset($bookedShipment->custom_invoice_value) ? $bookedShipment->custom_invoice_value : '- -'; ?></p>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
		<div class="col-12 col-lg-3">
			<div class="form-group">
				<label style="display: inline-block">Packing List:</label>
				<p><?= printDocumentLink($preshipdocs->packing_List) ?></p>
			</div>
		</div>
		<div class="col-12 col-lg-3">
			<div class="form-group">
				<label style="display: inline-block">Other Document 1:</label>
				<p><?= printDocumentLink($preshipdocs->other_documents_1) ?></p>
			</div>
		</div>
		<div class="col-12 col-lg-3">
			<div class="form-group">
				<label style="display: inline-block">Other Document 2:</label>
				<p><?= printDocumentLink($preshipdocs->other_documents_2) ?></p>
			</div>
		</div>
		<div class="col-12 col-lg-3">
			<div class="form-group">
				<label style="display: inline-block">Other Document 3:</label>
				<p><?= printDocumentLink($preshipdocs->other_documents_3) ?></p>
			</div>
		</div>

		<div class="col-12 col-lg-3">
			<div class="form-group">
				<label>Payment Under:</label>
				<div class="radio">
					<label class="mr-3 ml-3" style="display:inline-block"><input type="radio" disabled name="shipment_under_payment_ro" value="LUT BOND" <?= $bookedShipment->shipment_under_payment == "LUT BOND" ? 'checked' : ''; ?>> LUT BOND</label>&nbsp;
					<label class="mr-3 ml-3" style="display:inline-block"><input type="radio" disabled name="shipment_under_payment_ro" value="IGST" <?= $bookedShipment->shipment_under_payment == "IGST" ? 'checked' : ''; ?>> IGST</label>&nbsp;

				</div>
			</div>
		</div>

		<div class="col-12 col-lg-3" style="<?= $bookedShipment->shipment_under_payment == 'IGST' ? '' : 'display:none;' ?>">
			<div class="form-group">
				<label>IGST Amount:</label>
				<p><?php echo isset($bookedShipment->igst_payment_amount) ? $bookedShipment->igst_payment_amount : ''; ?></p>
			</div>
		</div>
	</div>
	<div class="row">
		<?php if ($shipmentProcessData[$key]->status == 1 || $shipmentProcessData[$key]->status == 2) { ?>
			<div class="col-12 col-lg-12">
				<span class="text-info">Email has been sent.</span>
			</div>
		<?php } ?>
		<br />
	</div>
	<?php if ($shipmentProcessData[$key]->status != 1) { ?>
		<h3>Corrections/Suggestions</h3>
		<div class="form-group">
			<textarea class="form-control" name="step1_export_correction_ff" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
		</div>
		<br />

	<?php } ?>
	<p>Corrections/Suggestions History</p>
	<div class="row">
		<div class="col-12 col-lg-12">
			<div class="comment-content-box">
				<p><?php echo isset($shipmentProcessData[$key]->corrections) ? $shipmentProcessData[$key]->corrections : 'No correction Found'; ?></p>
			</div>
			<br />
		</div>
	</div>


	<?php if ($shipmentProcessData[$key]->status != 1) { ?>
		<div class="row">

			<div class="col-12 col-lg-12">
				<div class="py-2">
					<i class="text-mutted">Note: Kindly approved or Suggest changes through System Communication.</i>
				</div>
				<div class="form-group">
					<div class="form-check form-check-inline mt-20">
						<input type="radio" name="step1_export_status" class="form-check-input" checked value="1">
						<label for="approve" class="form-check-label">Approve</label>
					</div>
					<div class="form-check form-check-inline mt-20">
						<input type="radio" name="step1_export_status" class="form-check-input" value="3">
						<label for="reupload" class="form-check-label">Correction required</label>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<input type="hidden" name="request_id" value="<?php echo $bookedShipment->request_id; ?>">
	<!--<input type="hidden" name="book_id" value="<?php echo $this->uri->segment(3); ?>">-->
	<!--						<input type="hidden" name="ff_email" value="<?php echo $bookedShipment->femail; ?>">
						<input type="hidden" name="buyer_email" value="<?php echo $bookedShipment->bemail; ?>">
						<input type="hidden" name="seller_email" value="<?php echo $bookedShipment->email; ?>">-->
	<?php if (!empty($shipmentProcessData[$key]->step_id)) {
		if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
			<input type="hidden" name="step_id" value="<?php echo $stepData[$key]->id; ?>">
			<input type="submit" name="step1_export" class="btn btn-default-cust btn-submit pull-right" value="Submit" />
		<?php }
	} else { ?>
		<!--						<input type="hidden" name="step_id" value="<?php echo $stepData[$key]->id; ?>">
						<input type="submit" name="step1_export" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
	<?php } ?>
	<?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
		<!--<input type="button" name="next" class="next btn btn-default-cust action-button  pull-right" value="Next" />-->
	<?php } ?>

</fieldset>
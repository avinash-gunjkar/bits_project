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
		<h3>Uploaded Post-Shipment Documents <?php echo $status; ?></h3>
		<div class="row">
			<div class="col-12 col-lg-4">
				<div class="form-group">

					<label>Commercial Invoice:</label>
					<p> <?= printDocumentLink($preshipdocs->post_shipment_doc2) ?></p>

				</div>
			</div>


			<div class="col-12 col-lg-4">
				<div class="form-group">
					<label>Commercial Invoice Number :</label>
					<p><?php echo isset($bookedShipment->commercial_invoice_number) ? $bookedShipment->commercial_invoice_number : '- -'; ?></p>

				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="form-group">
					<label>Commercial Invoice Date :</label>
					<p><?= $bookedShipment->commercial_invoice_date ? printFormatedDate($bookedShipment->commercial_invoice_date) : '- -' ?></p>

				</div>
			</div>


			<div class="col-12 col-lg-4">
				<div class="form-group">

					<label>Final BL / AWB:</label>
					<p> <?= printDocumentLink($preshipdocs->post_shipment_doc1) ?></p>
				</div>
			</div>



			<div class="col-12 col-lg-4">
				<div class="form-group">
					<label>Packing List:</label>
					<p><?= printDocumentLink($preshipdocs->post_shipment_doc3) ?></p>
				</div>
			</div>

			<div class="col-12 col-lg-4">
				<div class="form-group">
					<label>Certificate of Origin:</label>
					<p><?= printDocumentLink($preshipdocs->post_shipment_doc4) ?></p>
				</div>
			</div>

			<div class="col-12 col-lg-4">
				<div class="form-group">
					<label>Marin Insurance:</label>
					<p><?= printDocumentLink($preshipdocs->post_shipment_doc5) ?></p>
				</div>
			</div>

			<div class="col-12 col-lg-4">
				<div class="form-group">
					<label>Other Document:</label>
					<p><?= printDocumentLink($preshipdocs->post_shipment_doc6) ?></p>
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-12 col-lg-8">
				<div class="form-group">
					<div class="checkbox">
						<input type="checkbox" name="step7_export_agree_document_sent" id="step7_export_agree_document_sent" class="css-checkbox" value="1" <?php echo (isset($shipmentProcessData[$key]->note_for_doc) && ($shipmentProcessData[$key]->note_for_doc == 1)) ? 'checked' : ''; ?>>
						<label for="agree_document_sent" class="css-label">Seller agree to send documents to buyer/importer.</label>
					</div>
				</div>
			</div>
			<?php if ($shipmentProcessData[$key]->status == 1 || $shipmentProcessData[$key]->status == 2) { ?>
				<div class="col-12 col-lg-12">
					<span class="text-info">Email has been sent.</span>
				</div>
			<?php } ?>
		</div>

	</div>

</fieldset>
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
 	<?php $step6documents = isset($shipmentProcessData[5]->documents) ? json_decode($shipmentProcessData[5]->documents) : '';  ?>
 	<div class="shipping-form">
 		<h3>Upload Post-Shipment Documents <?php echo $status; ?></h3>

 		<div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
 			<div class="row">
 				

 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<div class="fileUpload btn btn-secondary">
 							<span>Select Commercial Invoice</span>
 							<input type="file" aria-describedby="post_shipment_doc2-error" id="post_shipment_doc2" name="post_shipment_doc2" class="upload"  />
 						</div>
 						<div class="selected-file-name">
						 <p><?= printDocumentLink($step6documents->post_shipment_doc2) ?></p>
 							
 						</div>
 						<span id="post_shipment_doc2-error" class="error" style=""></span>
 					</div>
				 </div>
				 
				 <div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>Commercial Invoice Number :</label>

 						<input type="text" required="" maxlength="20" class="form-control width-150" id="step7_export_commercial_invoice_number" name="step7_export_commercial_invoice_number" value="<?php echo isset($bookedShipment->commercial_invoice_number) ? $bookedShipment->commercial_invoice_number : ''; ?>" />

 					</div>
 				</div>
 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>Commercial Invoice Date :</label>
 						<input type="text" required="" class="form-control date-picker" placeholder="DD-MM-YYYY" name="step7_export_commercial_invoice_date" value="<?= printFormatedDate($bookedShipment->commercial_invoice_date) ?>" />

 					</div>
 				</div>

				 <div class="col-12 col-lg-4">
 					<div class="form-group">
						 <label>Final BL / AWB</label>
						 <p><?= printDocumentLink($step6documents->Final_Bill_of_lading) ?></p>
 						<input type="hidden" name="post_shipment_doc1" value="<?= $step6documents->Final_Bill_of_lading ?>" />
 					</div>
 				</div>


 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<div class="fileUpload btn btn-secondary">
 							<span>Select Packing List</span>
 							<input type="file" aria-describedby="post_shipment_doc3-error" id="post_shipment_doc3" name="post_shipment_doc3" class="upload"  />
 						</div>
 						<div class="selected-file-name">
						 <p><?= printDocumentLink($step6documents->post_shipment_doc3) ?></p>
 						</div>
 						<span id="post_shipment_doc3-error" class="error" style=""></span>



 					</div>
 				</div>

 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<div class="fileUpload btn btn-secondary">
 							<span>Select Certificate of Origin</span>
 							<input type="file" aria-describedby="post_shipment_doc4-error" id="post_shipment_doc4" name="post_shipment_doc4" class="upload"  />
 						</div>
 						<div class="selected-file-name">
						 <p><?= printDocumentLink($step6documents->post_shipment_doc4) ?></p>
 						</div>
 						<span id="post_shipment_doc4-error" class="error" style=""></span>
 					</div>
 				</div>
 				<div class="col-12 col-lg-4">
 					<div class="form-group">

 						<div class="fileUpload btn btn-secondary">
 							<span>Select Marin Insurance</span>
 							<input type="file" aria-describedby="post_shipment_doc5-error" id="post_shipment_doc5" name="post_shipment_doc5" class="upload"  />
 						</div>
 						<div class="selected-file-name">
						 <p><?= printDocumentLink($step6documents->post_shipment_doc5) ?></p>
 						</div>
 						<span id="post_shipment_doc5-error" class="error" style=""></span>


 					</div>
 				</div>

 				<div class="col-12 col-lg-4">
 					<div class="form-group">

 						<div class="fileUpload btn btn-secondary">
 							<span>Select Other Document</span>
 							<input type="file" aria-describedby="post_shipment_doc6-error" id="post_shipment_doc6" name="post_shipment_doc6" class="upload"  />
 						</div>
 						<div class="selected-file-name">
						 <p><?= printDocumentLink($step6documents->post_shipment_doc6) ?></p>
 						</div>
 						<span id="post_shipment_doc6-error" class="error" style=""></span>


 					</div>
 				</div>

 				<div class="col-12 col-lg-12">
 					<div class="form-group" style="display: none;">
 						<div class="form-check form-check-inline">
 							<input type="radio" name="step7_export_status" class="form-check-input" checked="" value="1">
 							<label for="approve" class="form-check-label">Approved</label>
 						</div>

 					</div>
 					<div class="form-group">
 						<div class="checkbox">
 							<input type="checkbox" name="step7_export_agree_document_sent" id="step7_export_agree_document_sent" class="css-checkbox" value="1" <?php echo (isset($shipmentProcessData[$key]->note_for_doc) && ($shipmentProcessData[$key]->note_for_doc == 1)) ? 'checked' : ''; ?>>
 							<label for="step7_export_agree_document_sent" class="css-label">I agree to send documents to buyer/importer.</label>
 						</div>
 					</div>

 					<div class="form-group">
 						<label class="css-label">Buyer/Importer Email:</label>

 						<input type="text" data-role="tagsinput" class="form-control" id="step7_export_buyer_email" name="step7_export_buyer_email" value="<?php echo isset($shipmentProcessData[$key]->email) ? $shipmentProcessData[$key]->email : $buyer_seler_email; ?>" />

 					</div>
 				</div>


 			</div>

 			

 		</div>

 		<div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
 			<div class="row">
 				

 				<div class="col-12 col-lg-4">
 					<div class="form-group">

						 <label>Commercial Invoice:</label>
						 <p><?= printDocumentLink($preshipdocs->post_shipment_doc2) ?></p>
 						
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
 						<p><?= $bookedShipment->commercial_invoice_date?printFormatedDate($bookedShipment->commercial_invoice_date):'- -' ?></p>
 					</div>
 				</div>
				 
				 <div class="col-12 col-lg-4">
 					<div class="form-group">

						 <label>Final BL / AWB:</label>
						<p> <?= printDocumentLink($preshipdocs->post_shipment_doc1) ?><p>
 					
 					</div>
 				</div>

 				<div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>Packing List:</label>
						<p> <?= printDocumentLink($preshipdocs->post_shipment_doc3) ?></p>
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

 				<div class="col-12 col-lg-12">

 					<div class="form-group">
 						<div class="checkbox">
 							<input type="checkbox" disabled name="step7_export_agree_document_sent" id="step7_export_agree_document_sent" class="css-checkbox" value="1" <?php echo (isset($shipmentProcessData[$key]->note_for_doc) && ($shipmentProcessData[$key]->note_for_doc == 1)) ? 'checked' : ''; ?>>
 							<label for="step7_export_agree_document_sent" class="css-label">I agree to send documents to buyer/importer.</label>
 						</div>
 					</div>

 					<div class="form-group">
 						<label class="css-label">Buyer/Importer Email:</label>
 						<?php echo isset($shipmentProcessData[$key]->buyer_email) ? $shipmentProcessData[$key]->buyer_email : '- -'; ?>
 					</div>
 				</div>

 			</div>

 			<div class="row">
 				<br />
 				

 				<div class="col-12 col-lg-12">
 					<span class="text-info">Email has been sent.</span>
 				</div>

 			</div>

 		</div>





 	</div>

	
 	<input type="hidden" name="step7_export_step_id" value="<?php echo $stepData[$key]->id; ?>">
	 <?php if ($bookedShipment->status == 5) { ?>
                 <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                 <input type="submit" name="step7_export" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                 <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
         <?php } ?>
	

 </fieldset>
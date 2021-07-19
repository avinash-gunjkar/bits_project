 <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
 	<div class="shipping-form">

 		<div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
 			<div class="row">
 				<div class="col-12 col-lg-3">
 					<div class="form-group">
 						<label>e-BRC Number: </label>
 						<input type="text" required="" class="form-control" aria-describedby="step11_export_erbc_number-error" id="step11_export_erbc_number" name="step11_export_erbc_number" value="<?php echo isset($bookedShipment->ERBC_number) ? $bookedShipment->ERBC_number : ''; ?>" />
 						<span id="step11_export_erbc_number-error" class="error"></span>
 					</div>
 				</div>
 				<div class="col-12 col-lg-3">
 					<div class="form-group">
 						<label>e-BRC Date: </label>

 						<input type="text" required="" class="form-control date-picker" autocomplete="off" placeholder="DD-MM-YYYY" id="erbc_date" name="step11_export_erbc_date" value="<?= printFormatedDate($bookedShipment->ERBC_date); ?>" />
 					</div>
				 </div>
				 <div class="col-12 col-lg-3">
 					<div class="form-group">
 						<div class="checkbox">
 							<input type="checkbox" required="" aria-describedby="step11_export_erbc_received-error" id="step11_export_erbc_received" name="step11_export_erbc_received" class="css-radio" value="1" <?php echo ($bookedShipment->erbc_status == 1) ? 'checked' : ''; ?>>
 							<label for="step11_export_erbc_received">e-BRC Received</label>
 						</div>

 						<span id="step11_export_erbc_received-error" class="error"></span>
 					</div>
				 </div>
				 <?php if(strcasecmp($bookedShipment->shipment_under_payment,'IGST')==0){?>
				 <div class="col-12 col-lg-3">
 					<div class="form-group">
 						<div class="checkbox">
 							<input type="checkbox" required="" aria-describedby="step11_export_igst_payment_status-error" id="step11_export_igst_payment_status" name="step11_export_igst_payment_status" class="css-radio" value="1" <?php echo ($bookedShipment->igst_payment_status == 1) ? 'checked' : ''; ?>>
 							<label for="step11_export_igst_payment_status">IGST Received</label>
 						</div>

 						<span id="step11_export_igst_payment_status-error" class="error"></span>
 					</div>
				 </div>
				 <?php }?>

 				<div class="col-12 col-lg-12">
 					<p></p>

 					<?php if ($bookedShipment->status == 5) { ?>
 						<input type="submit" name="step11_export" id="step11_submit_btn_1" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 					<?php } ?>
 				</div>
 			</div>
 			<hr>
 			<div class="row">
 				<div class="col-12 col-lg-3">
 					<div class="form-group">
 						<div class="checkbox mt-20">
 							<input type="checkbox" required="" aria-describedby="step11_export_dbk_received-error" id="step11_export_dbk_received" name="step11_export_dbk_received" class="css-radio" value="1" <?php echo ($bookedShipment->DBK_status == 1) ? 'checked' : ''; ?>>
 							<label for="step11_export_dbk_received">DBK Received</label>
 						</div>

 						<span id="step11_export_dbk_received-error" class="error"></span>
 					</div>
 				</div>
				 <div class="col-12 col-lg-3">
 					<div class="form-group">
 						<label>DBK Received Date: </label>
 						<input type="text" required="" class="form-control date-picker" autocomplete="off" placeholder="DD-MM-YYYY" id="dbk_received_date" name="step11_dbk_received_date" value="<?= printFormatedDate($bookedShipment->dbk_received_date); ?>" />
 					</div>
				 </div>
 				<div class="col-12 col-lg-12">
 					<p></p>

 					<?php if ($bookedShipment->status == 5) { ?>
 						<input type="submit" name="step11_export" id="step11_submit_btn_2" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 					<?php } ?>
 				</div>
 			</div>
 			<hr>
 			<div class="row">
 				<div class="col-12 col-lg-3">
 					<div class="form-group">
 						<div class="checkbox mt-20">
 							<input type="checkbox" required="" aria-describedby="step11_export_meis_received-error" id="step11_export_meis_received" name="step11_export_meis_received" class="css-radio" value="1" <?php echo ($bookedShipment->MEIS_status == 1) ? 'checked' : ''; ?>>
 							<label for="step11_export_meis_received">MEIS/RoDTEP Received</label>
 						</div>
 						<span id="step11_export_meis_received-error" class="error"></span>
 					</div>
 				</div>

				 <div class="col-12 col-lg-3">
 					<div class="form-group">
 						<label>MEIS/RoDTEP Received Date: </label>
 						<input type="text" required="" class="form-control date-picker" autocomplete="off" placeholder="DD-MM-YYYY" id="meis_received_date" name="step11_meis_received_date" value="<?= printFormatedDate($bookedShipment->meis_received_date); ?>" />
 					</div>
				 </div>

 				<div class="col-12 col-lg-12">
 					<p></p>

 					<?php if ($bookedShipment->status == 5) { ?>
 						<input type="submit" name="step11_export" id="step11_submit_btn_3" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 					<?php } ?>
 				</div>

 			</div>
 			<?php if (!$skipComparative) { ?>
 				<hr>
 				<div class="row">
 					<div class="col-12 col-lg-3">
 						<div class="form-group">
 							<div class="checkbox mt-20">
 								<input type="checkbox" required="" aria-describedby="step11_export_bill_amnt_received-error" id="step11_export_bill_amnt_received" name="step11_export_bill_amnt_received" class="css-radio" value="1" <?php echo ($bookedShipment->Bill_status == 1) ? 'checked' : ''; ?>>
 								<label for="step11_export_bill_amnt_received">FF Invoice Payment completed</label>
 							</div>

 							<span id="step11_export_bill_amnt_received-error" class="error"></span>
 						</div>
 					</div>

					 <div class="col-12 col-lg-3">
 					<div class="form-group">
 						<label>FF Invoice Payment Date: </label>
 						<input type="text" required="" class="form-control date-picker" autocomplete="off" placeholder="DD-MM-YYYY" id="ff_invoice_payment_date" name="step11_ff_invoice_payment_date" value="<?= printFormatedDate($bookedShipment->ff_invoice_payment_date); ?>" />
 					</div>
				 </div>

 					<div class="col-12 col-lg-12">
 						<p></p>

 						<?php if ($bookedShipment->status == 5) { ?>
 							<input type="submit" name="step11_export" id="step11_submit_btn_4" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 						<?php } ?>
 					</div>

 				</div>
 			<?php } ?>


 		</div>
 		<div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
 			<div class="row">
 				<div class="col-12 col-lg-3">
 					<div class="form-group">
 						<label>e-BRC Number: </label>
 						<span><?php echo isset($bookedShipment->ERBC_number) ? $bookedShipment->ERBC_number : '- -'; ?></span>
 					</div>
 				</div>
 				<div class="col-12 col-lg-3">
 					<div class="form-group">
 						<label>e-BRC Date: </label>
 						<?= $bookedShipment->ERBC_date ? printFormatedDate($bookedShipment->ERBC_date) : '- -'; ?>
 					</div>
				 </div>
				 <div class="col-12 col-lg-3">
 					<div class="form-group">
						 <label for="step11_export_erbc_received">e-BRC Received:</label> <span><?php echo ($bookedShipment->erbc_status == 1) ? 'Yes' : 'No'; ?></span>
 						
 					</div>
				 </div>
				 <?php if(strcasecmp($bookedShipment->shipment_under_payment,'IGST')==0){?>
					<div class="col-12 col-lg-3">
						<div class="form-group">
							<label for="step11_export_erbc_received">IGST Received:</label> <span><?php echo ($bookedShipment->igst_payment_status == 1) ? 'Yes' : 'No'; ?></span>
						</div>
					</div>
					<?php }?>
 			</div>
 			<hr>
 			<div class="row">
 				<div class="col-12 col-lg-3">
 					<div class="form-group">

 						<label>DBK Received:</label> <span><?php echo ($bookedShipment->DBK_status == 1) ? 'Yes' : 'No'; ?></span>
 					</div>
 				</div>
				 <div class="col-12 col-lg-3">
 					<div class="form-group">
 						<label>DBK Received Date: </label> <span><?= printFormatedDate($bookedShipment->dbk_received_date); ?></span>
 					</div>
				 </div>
 			</div>
 			<hr>
 			<div class="row">
 				<div class="col-12 col-lg-3">
 					<div class="form-group">

 						<label>MEIS/RoDTEP Received:</label> <span><?php echo ($bookedShipment->MEIS_status == 1) ? 'Yes' : 'No'; ?></span>
 					</div>
 				</div>
				 <div class="col-12 col-lg-4">
 					<div class="form-group">
 						<label>MEIS/RoDTEP Received Date: </label> <span><?= printFormatedDate($bookedShipment->meis_received_date); ?></span>
 					</div>
				 </div>
 			</div>
 			<?php if (!$skipComparative) { ?>
 				<hr>
 				<div class="row">
 					<div class="col-12 col-lg-3">
 						<div class="form-group">

 							<label>FF Invoice Payment completed: </label> <span><?php echo ($bookedShipment->Bill_status == 1) ? 'Yes' : 'No'; ?></span>
 						</div>
 					</div>
					 <div class="col-12 col-lg-3">
 					<div class="form-group">
 						<label>FF Invoice Payment Date: </label> <span><?= printFormatedDate($bookedShipment->ff_invoice_payment_date); ?></span>
 					</div>
				 </div>
 					<div class="col-12 col-lg-12">
 						<span class="text-info">Payment has been sent.</span>
 					</div>
 				</div>
 			<?php } ?>

 		</div>
		 <input type="hidden" name="step11_export_step_id" value="<?php echo $stepData[$key]->id; ?>">

<hr>


 	</div>


 	<?php if ($bookedShipment->status == 5) { ?>
		<a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
		<!-- <input type="submit" name="step11_export" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" /> -->
		<button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
	<?php } ?>

 			<script>
 				$('#step11_submit_btn_1').click(function() {
 					$('#step11_export_erbc_number,#erbc_date,#step11_export_erbc_received').attr('required', true);

 					$('#step11_export_dbk_received,#dbk_received_date').attr('required', false);

 					$('#step11_export_meis_received,#meis_received_date').attr('required', false);

 					$('#step11_export_bill_amnt_received,#ff_invoice_payment_date').attr('required', false);
 				});
 				$('#step11_submit_btn_2').click(function() {
					$('#step11_export_erbc_number,#erbc_date,#step11_export_erbc_received').attr('required', false);

					$('#step11_export_dbk_received,#dbk_received_date').attr('required', true);

					$('#step11_export_meis_received,#meis_received_date').attr('required', false);

					$('#step11_export_bill_amnt_received,#ff_invoice_payment_date').attr('required', false);
 				});
 				$('#step11_submit_btn_3').click(function() {
					$('#step11_export_erbc_number,#erbc_date,#step11_export_erbc_received').attr('required', false);

						$('#step11_export_dbk_received,#dbk_received_date').attr('required', false);

						$('#step11_export_meis_received,#meis_received_date').attr('required', true);

						$('#step11_export_bill_amnt_received,#ff_invoice_payment_date').attr('required', false);
 				});
 				$('#step11_submit_btn_4').click(function() {
					$('#step11_export_erbc_number,#erbc_date,#step11_export_erbc_received').attr('required', false);

					$('#step11_export_dbk_received,#dbk_received_date').attr('required', false);

					$('#step11_export_meis_received,#meis_received_date').attr('required', false);

					$('#step11_export_bill_amnt_received,#ff_invoice_payment_date').attr('required', true);
 				});
 			</script>

 </fieldset>
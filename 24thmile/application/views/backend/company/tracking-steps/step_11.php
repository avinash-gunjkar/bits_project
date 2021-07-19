 <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
 	<div class="shipping-form">

 		<!-- <div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
 			<div class="row">
 				<div class="col l4">
 					<div class="form-group">
 						<label>e-BRC Number: </label>
 						<input type="text" required="" class="form-control" aria-describedby="step11_export_erbc_number-error" id="step11_export_erbc_number" name="step11_export_erbc_number" value="<?php echo isset($bookedShipment->ERBC_number) ? $bookedShipment->ERBC_number : ''; ?>" />
 						<span id="step11_export_erbc_number-error" class="error"></span>
 					</div>
 				</div>
 				<div class="col l4">
 					<div class="form-group">
 						<label>e-BRC Date: </label>

 						<input type="text" required="" class="form-control date-picker" autocomplete="off" placeholder="DD-MM-YYYY" id="erbc_date" name="step11_export_erbc_date" value="<?= printFormatedDate($bookedShipment->ERBC_date); ?>" />
 					</div>
 				</div>
 				<div class="col l4">
 					<p></p>

 					<?php if ($bookedShipment->status == 5) { ?>
 						<input type="submit" name="step11_export" id="step11_submit_btn_1" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 					<?php } ?>
 				</div>
 			</div>
 			<hr>
 			<div class="row">
 				<div class="col l2">
 					<div class="form-group">
 						<div class="checkbox mt-20">
 							<input type="checkbox" required="" aria-describedby="step11_export_dbk_received-error" id="step11_export_dbk_received" name="step11_export_dbk_received" class="css-radio" value="1" <?php echo ($bookedShipment->DBK_status == 1) ? 'checked' : ''; ?>>
 							<label for="step11_export_dbk_received">DBK Received</label>
 						</div>

 						<span id="step11_export_dbk_received-error" class="error"></span>
 					</div>
 				</div>
 				<div class="col l10">
 					<p></p>

 					<?php if ($bookedShipment->status == 5) { ?>
 						<input type="submit" name="step11_export" id="step11_submit_btn_2" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 					<?php } ?>
 				</div>
 			</div>
 			<hr>
 			<div class="row">
 				<div class="col l2">
 					<div class="form-group">
 						<div class="checkbox mt-20">
 							<input type="checkbox" required="" aria-describedby="step11_export_meis_received-error" id="step11_export_meis_received" name="step11_export_meis_received" class="css-radio" value="1" <?php echo ($bookedShipment->MEIS_status == 1) ? 'checked' : ''; ?>>
 							<label for="step11_export_meis_received">MEIS Received</label>
 						</div>
 						<span id="step11_export_meis_received-error" class="error"></span>
 					</div>
 				</div>

 				<div class="col l10">
 					<p></p>

 					<?php if ($bookedShipment->status == 5) { ?>
 						<input type="submit" name="step11_export" id="step11_submit_btn_3" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 					<?php } ?>
 				</div>

 			</div>
 			<?php if (!$skipComparative) { ?>
 				<hr>
 				<div class="row">
 					<div class="col l3">
 						<div class="form-group">
 							<div class="checkbox mt-20">
 								<input type="checkbox" required="" aria-describedby="step11_export_bill_amnt_received-error" id="step11_export_bill_amnt_received" name="step11_export_bill_amnt_received" class="css-radio" value="1" <?php echo ($bookedShipment->Bill_status == 1) ? 'checked' : ''; ?>>
 								<label for="step11_export_bill_amnt_received">FF Invoice Payment completed</label>
 							</div>

 							<span id="step11_export_bill_amnt_received-error" class="error"></span>
 						</div>
 					</div>

 					<div class="col l9">
 						<p></p>

 						<?php if ($bookedShipment->status == 5) { ?>
 							<input type="submit" name="step11_export" id="step11_submit_btn_4" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
 						<?php } ?>
 					</div>

 				</div>
 			<?php } ?>


 		</div> -->
 		<div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:block' ?>">
 			<div class="row">
 				<div class="col l4">
 					<div class="form-group">
 						<label>e-BRC Number: </label>
 						<span><?php echo isset($bookedShipment->ERBC_number) ? $bookedShipment->ERBC_number : '- -'; ?></span>
 					</div>
 				</div>
 				<div class="col l4">
 					<div class="form-group">
 						<label>e-BRC Date: </label>
 						<?= $bookedShipment->ERBC_date ? printFormatedDate($bookedShipment->ERBC_date) : '- -'; ?>
 					</div>
 				</div>
 			</div>
 			<hr>
 			<div class="row">
 				<div class="col l4">
 					<div class="form-group">

 						<label>DBK Received:</label> <span><?php echo ($bookedShipment->DBK_status == 1) ? 'Yes' : 'No'; ?></span>
 					</div>
 				</div>
 			</div>
 			<hr>
 			<div class="row">
 				<div class="col l4">
 					<div class="form-group">

 						<label>MEIS Received:</label> <span><?php echo ($bookedShipment->MEIS_status == 1) ? 'Yes' : 'No'; ?></span>
 					</div>
 				</div>
 			</div>
 			<?php if (!$skipComparative) { ?>
 				<hr>
 				<div class="row">
 					<div class="col l4">
 						<div class="form-group">

 							<label>FF Invoice Payment completed: </label> <span><?php echo ($bookedShipment->Bill_status == 1) ? 'Yes' : 'No'; ?></span>
 						</div>
 					</div>
 					<div class="col l12">
 						<span class="text-info">Payment has been sent to Freight Forwarder.</span>
 					</div>
 				</div>
 			<?php } ?>

 		</div>
		 <input type="hidden" name="step11_export_step_id" value="<?php echo $stepData[$key]->id; ?>">

<hr>


 	</div>


 	<?php if ($bookedShipment->status == 5) { ?>
		<!-- <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a> -->
		<!-- <input type="submit" name="step11_export" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" /> -->
		<!-- <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button> -->
	<?php } ?>

 			

 </fieldset>
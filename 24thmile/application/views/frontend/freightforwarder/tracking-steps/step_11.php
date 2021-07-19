<?php if (!$skipComparative) { ?>
	<fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
		<div class="shipping-form">
		<div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, [ '0', '3']) ? 'display:block' : 'display:none' ?>">
				<div class="row">
				<div class="col-12 col-lg-3">
							<div class="form-group">
								<div class="checkbox mt-20">
									<input type="checkbox" required="" aria-describedby="step11_export_bill_amnt_received-error" name="step11_export_bill_amnt_received" class="css-radio" value="1" <?php echo ($bookedShipment->bill_amount_received == 1) ? 'checked' : ''; ?>>
									<label for="step11_export_bill_amnt_received" >Invoice Payment Received</label>
								</div>
								<span id="step11_export_bill_amnt_received-error" class="error"></span>
							</div>
						</div>
				</div>
			</div>

			 <div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
				<div class="row">
				<div class="col-12 col-lg-3">
							<div class="form-group">
								<label for="step11_export_bill_amnt_received" class="css-label">Invoice Payment Received:</label> <span><?=$bookedShipment->bill_amount_received?'Yes':'No'?></span>
							</div>
						</div>
				</div>
			</div>

		</div>

		<input type="hidden" name="step11_export_step_id" value="<?php echo $stepData[$key]->id; ?>">
		<?php if ($bookedShipment->quote_status == 5) { ?>
                 <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                 <input type="submit" name="step11_export" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, [ '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                 <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
         <?php } ?>
	

	</fieldset>
<?php } else { ?>

<?php } ?>
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
	 <h5>Final Custom Documents / Final Bill of Entry <?php echo $status; ?></h5>
 		<div class="row">
		 <div class="col l4">
                  <div class="form-group">
                      <label>Final Bill of Entry:</label>
                      <p><?= printDocumentLink($preshipdocs->final_bill_of_entry) ?></p>
                  </div>
              </div>

              <div class="col l4">
                     <div class="form-group">
                         <label> Bill of Entry Number: </label>
                         <p><?php echo isset($bookedShipment->bill_of_entry_no) ? $bookedShipment->bill_of_entry_no : '- -'; ?></p>

                     </div>
                 </div>
                 <div class="col l4">
                     <div class="form-group">
                         <label> Bill of Entry Date: </label>
                         <p><?php echo isset($bookedShipment->import_under_schment) ? printFormatedDate($bookedShipment->bill_of_entry_date) : '- -'; ?></p>

                     </div>
                 </div>
                 
		 <div class="col l4">
                     <div class="form-group">
                         <label>Import Duty Amount (INR): </label>
                         <p><?= isset($bookedShipment->import_duty_amount) ? number_format($bookedShipment->import_duty_amount, 2) : '- -'; ?></p>
                     </div>
                 </div>
                
                 
                 <div class="col l4">
                     <div class="form-group">
                         <label>Import Under Scheme: </label>
                         <p><?php echo isset($bookedShipment->import_under_schment) ? $bookedShipment->import_under_schment : '- -'; ?></p>

                     </div>
				 </div>
				 

 			<div class="col l4">
 				<label> Custom Cleared at Destination Port Date</label>
 				<p><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?></p>
 			</div>
 			<div class="col l12">
 				<label>Remark:</label>
 				<span><?= $shipmentProcessData[$key]->corrections ? $shipmentProcessData[$key]->corrections : '- -'; ?></span>
 			</div>
 		</div>
 	</div>
 	<!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->
 	<?php
		if (!empty($shipmentProcessData[$key]->step_id)) {
			if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
 			<!--						 <input type="hidden" name="step_id_7" value="<?php echo $stepData[$key]->id; ?>">
						 <input type="submit" name="step7_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
 		<?php }
		} else { ?>
 		<!--						<input type="hidden" name="step_id_7" value="<?php echo $stepData[$key]->id; ?>">
						<input type="submit" name="step7_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
 	<?php } ?>
 	<?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
 		<!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
 	<?php } ?>
 </fieldset>
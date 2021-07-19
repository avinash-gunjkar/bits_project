 <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
 	<div class="shipping-form">
	 <div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
	 <div class="row">
 			
			 <div class="col-12 col-lg-5">
 					<div class="form-group">
 						<label> Custom Cleared at Destination Port Date:</label>

 						<input type="text" required="" class="form-control date-picker" placeholder="DD-MM-YYYY" autocomplete="off" name="step9_export_ccd_date" value="<?=printFormatedDate($shipmentProcessData[$key]->action_date)?>" />

 					</div>
 				</div>

 				<div class="col-12 col-lg-12">
 					<div class="form-group">
 						<label>Remark:</label>

 						<input type="text" class="form-control" name="step9_export_details" placeholder="Remark" value="<?= $shipmentProcessData[$key]->corrections ?>">

 					</div>
 				</div>


 			<div class="col-12 col-lg-4" style="display: none;">
 				<div class="form-group">
 					<div class="form-check form-check-inline mt-20">
 						<input type="radio" name="step9_export_status" class="form-check-input" checked="" value="1">
 						<label for="approve" class="form-check-label">Approved</label>
 					</div>
 				</div>
 			</div>
 		</div>
	</div>

	<div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
	<div class="row">
 			<div class="col-12 col-lg-12">
 					<!--<p>Custom Cleared at Destination port Date &nbsp;<strong><i class="fa fa-clock-o"></i> <?php echo isset($shipmentProcessData[$key]->action_date) ? date('d-M-Y', strtotime($shipmentProcessData[$key]->action_date)) : ''; ?> __ <?php echo isset($shipmentProcessData[$key]->time) ? date('h:i A', strtotime($shipmentProcessData[$key]->time)) : ''; ?> </span></strong></p>-->
 					<div class="form-group">
 						<label> Custom Cleared at Destination Port Date:</label>
 						<span><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?></span>

 					</div>
 				</div>
 				<div class="col-12 col-lg-12">
 					<div class="form-group">
 						<label>Remark:</label>
 						<?= $shipmentProcessData[$key]->corrections ? $shipmentProcessData[$key]->corrections : '- -' ?>
 					</div>
 				</div>


			 <div class="col-12 col-lg-12">
				 <span class="text-info">Email has been sent.</span>
			 </div>
 		</div>
	</div>
 		
	 </div>
	  
	 <input type="hidden" name="step9_export_step_id" value="<?php echo $stepData[$key]->id; ?>">
	 <?php if ($bookedShipment->quote_status == 5) { ?>
                 <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                 <input type="submit" name="step9_export" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                 <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
         <?php } ?>


 </fieldset>
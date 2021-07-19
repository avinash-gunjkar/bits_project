 <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
         <div class="shipping-form">

                 <div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
                         <div class="row">
                                 <?php if ($bookedShipment->Bill_status == 1) { ?>
                                         <div class="col-12 col-lg-6">
                                                 <div class="form-group">
                                                         <div class="checkbox mt-20">
                                                                 <input type="checkbox" aria-describedby="step9_import_bill_amnt_received" required name="step9_import_bill_amnt_received" class="css-radio" value="1" <?php echo ($bookedShipment->bill_amount_received == 1) ? 'checked' : ''; ?>>
                                                                 <label for="step9_import_bill_amnt_received" >Invoice Payment Received</label>
                                                         </div>
                                                         <span id="step9_import_bill_amnt_received-error" class="error"></span>
                                                 </div>
                                         </div>
                                 <?php } ?>
                         </div>
                 </div>
                 <div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
                         <div class="row">
                         <div class="col-12 col-lg-6">
 					<div class="form-group">
						 <label for="step9_document_submited_to_bank_date">Document Submited to Bank Date:</label>
						 <p><?=printFormatedDate($bookedShipment->document_submited_to_bank_date)?></p>
 					</div>
				 </div>
                         <div class="col-12 col-lg-6">
                                <div class="form-group">
                                        <label for="step9_import_bill_amnt_received" >Invoice Payment Received:</label> <span><?=$bookedShipment->bill_amount_received?'Yes':'No'?></span>
                                </div>
                        </div>
                         </div>
                 </div>

               

         </div>
         <input type="hidden" name="step9_import_step_id" value="<?php echo $stepData[$key]->id; ?>">
         <?php if ($bookedShipment->quote_status == 5) { ?>
                 <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                 <input type="submit" name="step9_import" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, [ '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                 <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
         <?php } ?>


 </fieldset>
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
         <h3>Final Custom Documents / Final Bill of Entry <?php echo $status; ?></h3>
         <div class="row">
             <div class="radio">
                 <label class="mr-3 ml-3"><input type="radio" disabled value="Regular" <?= $bookedShipment->boe_type == "Regular" ? 'checked' : ''; ?>> Regular BOE</label>&nbsp;
                 <label class="mr-3 ml-3"><input type="radio" disabled value="Bonded" <?= $bookedShipment->boe_type == "Bonded" ? 'checked' : ''; ?>> Bonded BOE</label>&nbsp;
                 <span id="boe_type-error" class="error"></span>
             </div>
         </div>
         <div class="row" style="<?= $bookedShipment->boe_type == 'Regular' ? '' : 'display:none;' ?>">
             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Final Bill of Entry:</label>
                     <p><?= printDocumentLink($preshipdocs->final_bill_of_entry) ?></p>
                 </div>
             </div>

             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label> Bill of Entry Number: </label>
                     <p><?php echo isset($bookedShipment->bill_of_entry_no) ? $bookedShipment->bill_of_entry_no : '- -'; ?></p>

                 </div>
             </div>
             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label> Bill of Entry Date: </label>
                     <p><?php echo isset($bookedShipment->import_under_schment) ? printFormatedDate($bookedShipment->bill_of_entry_date) : '- -'; ?></p>

                 </div>
             </div>

             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Import Duty Amount (INR): </label>
                     <p><?= isset($bookedShipment->import_duty_amount) ? number_format($bookedShipment->import_duty_amount, 2) : '- -'; ?></p>
                 </div>
             </div>


             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Import Under Scheme: </label>
                     <p><?php echo isset($bookedShipment->import_under_schment) ? $bookedShipment->import_under_schment : '- -'; ?></p>

                 </div>
             </div>
             <?php 
                 $importUnderSchemeLicenseLable= '';
                 if(strcasecmp($bookedShipment->import_under_schment,'Advance Authorization')==0){
                    $importUnderSchemeLicenseLable="Advance Authorization license No.:";
                 }else if(strcasecmp($bookedShipment->import_under_schment,'Export Promotion Capital Goods')==0){
                    $importUnderSchemeLicenseLable="Export Promotion Capital Goods license No.:";
                 } ?>
                 <div  style="<?=!empty($importUnderSchemeLicenseLable)?'display:block':'display:none'?>" class="col-12 col-lg-4">
                 <div class="form-group">
                     <label><?=$importUnderSchemeLicenseLable?></label>
                     <p><?=$bookedShipment->import_u_s_l_no?></p>
                     </div>
                 </div>
             <?php if ($shipmentProcessData[$key]->status == 1) { ?>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Payment link for ICEGATE: </label>
                         <p><?php $globalData = getGlobalValues(); ?>
                             <a target="_blank" href="<?= $globalData['icegate_url']; ?>"><?= $globalData['icegate_url']; ?></a>
                         </p>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Details: </label>
                         <p><?php echo isset($bookedShipment->neft_payment_details) ? $bookedShipment->neft_payment_details : '- -'; ?></p>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Date: </label>
                         <p><?php echo isset($bookedShipment->neft_payment_date) ? printFormatedDate($bookedShipment->neft_payment_date) : '- -'; ?></p>
                     </div>
                 </div>

             <?php } else { ?>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Payment link for ICEGATE: </label>
                         <p><?php $globalData = getGlobalValues(); ?>
                             <a target="_blank" href="<?= $globalData['icegate_url']; ?>"><?= $globalData['icegate_url']; ?></a>
                         </p>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Details: </label>
                         <div class="input-group">
                             <input type="text" autocomplete="off"  class="form-control" name="neft_payment_details" value="<?= $bookedShipment->neft_payment_details ?>" />
                         </div>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> NEFT Payment Date</label>
                         <input type="text" autocomplete="off" placeholder="DD-MM-YYYY" class="form-control date-picker width-150" name="neft_payment_date" value="<?= printFormatedDate($bookedShipment->neft_payment_date) ?>" />
                     </div>
                 </div>
             <?php } ?>


         </div>
         <div class="row" style="<?= $bookedShipment->boe_type == 'Bonded' ? '' : 'display:none;' ?>">

             <div class="col-12">
                 <h3>Inbond BOE:</h3>
             </div>
             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Bill of Entry:</label>
                     <p><?= printDocumentLink($preshipdocs->bill_of_entry_inbond) ?></p>
                 </div>
             </div>

             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label> Bill of Entry Number: </label>
                     <p><?php echo isset($bookedShipment->bill_of_entry_no_inbond) ? $bookedShipment->bill_of_entry_no_inbond : '- -'; ?></p>
                 </div>
             </div>
             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label> Bill of Entry Date: </label>
                     <p><?php echo isset($bookedShipment->bill_of_entry_date_inbond) ? printFormatedDate($bookedShipment->bill_of_entry_date_inbond) : '- -'; ?></p>
                 </div>
             </div>

             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Import Duty Amount (INR): </label>
                     <p><?= isset($bookedShipment->import_duty_amount_inbond) ? number_format($bookedShipment->import_duty_amount_inbond, 2) : '- -'; ?></p>
                 </div>
             </div>
             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Custom Bank Details: </label>
                     <p><?php echo isset($bookedShipment->custom_bank_details_inbond) ? $bookedShipment->custom_bank_details_inbond : '- -'; ?></p>
                 </div>
             </div>

             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Import Under Scheme: </label>
                     <p><?php echo isset($bookedShipment->import_under_schment_inbond) ? $bookedShipment->import_under_schment_inbond : '- -'; ?></p>
                 </div>
             </div>

             <?php 
                 $importUnderSchemeLicenseLableInbond= '';
                 if(strcasecmp($bookedShipment->import_under_schment_inbond,'Advance Authorization')==0){
                    $importUnderSchemeLicenseLableInbond="Advance Authorization license No.:";
                 }else if(strcasecmp($bookedShipment->import_under_schment_inbond,'Export Promotion Capital Goods')==0){
                    $importUnderSchemeLicenseLableInbond="Export Promotion Capital Goods license No.:";
                 } ?>
                 <div  style="<?=!empty($importUnderSchemeLicenseLableInbond)?'display:block':'display:none'?>" class="col-12 col-lg-4">
                 <div class="form-group">
                     <label><?=$importUnderSchemeLicenseLableInbond?></label>
                     <p><?=$bookedShipment->import_u_s_l_no_inbond?></p>
                     </div>
                 </div>

             <?php if ($shipmentProcessData[$key]->status == 1) { ?>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Payment link for ICEGATE: </label>
                         <p><?php $globalData = getGlobalValues(); ?>
                             <a target="_blank" href="<?= $globalData['icegate_url']; ?>"><?= $globalData['icegate_url']; ?></a>
                         </p>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Details: </label>
                         <p><?php echo isset($bookedShipment->neft_payment_details_inbond) ? $bookedShipment->neft_payment_details_inbond : '- -'; ?></p>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Date: </label>
                         <p><?php echo isset($bookedShipment->neft_payment_date_inbond) ? printFormatedDate($bookedShipment->neft_payment_date_inbond) : '- -'; ?></p>
                     </div>
                 </div>
             <?php } else { ?>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Payment link for ICEGATE: </label>
                         <p><?php $globalData = getGlobalValues(); ?>
                             <a target="_blank" href="<?= $globalData['icegate_url']; ?>"><?= $globalData['icegate_url']; ?></a>
                         </p>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Details: </label>
                         <div class="input-group">
                             <input type="text" autocomplete="off"  class="form-control" name="neft_payment_details_inbond" value="<?= $bookedShipment->neft_payment_details_inbond ?>" />
                         </div>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> NEFT Payment Date</label>
                         <input type="text" autocomplete="off" placeholder="DD-MM-YYYY" class="form-control date-picker width-150" name="neft_payment_date_inbond" value="<?= printFormatedDate($bookedShipment->neft_payment_date_inbond) ?>" />

                     </div>
                 </div>
             <?php } ?>

             <div class="col-12">
                 <hr>
                 <h3>Exbond BOE:</h3>
             </div>
             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Bill of Entry:</label>
                     <p><?= printDocumentLink($preshipdocs->bill_of_entry_exbond) ?></p>
                 </div>
             </div>

             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label> Bill of Entry Number: </label>
                     <p><?php echo isset($bookedShipment->bill_of_entry_no_exbond) ? $bookedShipment->bill_of_entry_no_exbond : '- -'; ?></p>
                 </div>
             </div>
             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label> Bill of Entry Date: </label>
                     <p><?php echo isset($bookedShipment->bill_of_entry_date_exbond) ? printFormatedDate($bookedShipment->bill_of_entry_date_exbond) : '- -'; ?></p>
                 </div>
             </div>

             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Import Duty Amount (INR): </label>
                     <p><?= isset($bookedShipment->import_duty_amount_exbond) ? number_format($bookedShipment->import_duty_amount_exbond, 2) : '- -'; ?></p>
                 </div>
             </div>
             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Custom Bank Details: </label>
                     <p><?php echo isset($bookedShipment->custom_bank_details_exbond) ? $bookedShipment->custom_bank_details_exbond : '- -'; ?></p>
                 </div>
             </div>

             <div class="col-12 col-lg-4">
                 <div class="form-group">
                     <label>Import Under Scheme: </label>
                     <p><?php echo isset($bookedShipment->import_under_schment_exbond) ? $bookedShipment->import_under_schment_exbond : '- -'; ?></p>
                 </div>
             </div>

                <?php 
                 $importUnderSchemeLicenseLableExbond= '';
                 if(strcasecmp($bookedShipment->import_under_schment_exbond,'Advance Authorization')==0){
                    $importUnderSchemeLicenseLableExbond="Advance Authorization license No.:";
                 }else if(strcasecmp($bookedShipment->import_under_schment_exbond,'Export Promotion Capital Goods')==0){
                    $importUnderSchemeLicenseLableExbond="Export Promotion Capital Goods license No.:";
                 } ?>
                 <div  style="<?=!empty($importUnderSchemeLicenseLableExbond)?'display:block':'display:none'?>" class="col-12 col-lg-4">
                 <div class="form-group">
                     <label><?=$importUnderSchemeLicenseLableExbond?></label>
                     <p><?=$bookedShipment->import_u_s_l_no_exbond?></p>
                     </div>
                 </div>

             <?php if ($shipmentProcessData[$key]->status == 1) { ?>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Payment link for ICEGATE: </label>
                         <p><?php $globalData = getGlobalValues(); ?>
                             <a target="_blank" href="<?= $globalData['icegate_url']; ?>"><?= $globalData['icegate_url']; ?></a>
                         </p>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Details: </label>
                         <p><?php echo isset($bookedShipment->neft_payment_details_exbond) ? $bookedShipment->neft_payment_details_exbond : '- -'; ?></p>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Date: </label>
                         <p><?php echo isset($bookedShipment->neft_payment_date_exbond) ? printFormatedDate($bookedShipment->neft_payment_date_exbond) : '- -'; ?></p>
                     </div>
                 </div>
             <?php } else { ?>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Payment link for ICEGATE: </label>
                         <p><?php $globalData = getGlobalValues(); ?>
                             <a target="_blank" href="<?= $globalData['icegate_url']; ?>"><?= $globalData['icegate_url']; ?></a>
                         </p>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Details: </label>
                         <div class="input-group">
                             <input type="text" autocomplete="off"  class="form-control" name="neft_payment_details_exbond" value="<?= $bookedShipment->neft_payment_details_exbond ?>" />
                         </div>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> NEFT Payment Date</label>
                         <input type="text" autocomplete="off" placeholder="DD-MM-YYYY" class="form-control date-picker width-150" name="neft_payment_date_exbond" value="<?= printFormatedDate($bookedShipment->neft_payment_date_exbond) ?>" />

                     </div>
                 </div>
             <?php } ?>
         </div>

         <div class="row">
             <div class="col-12 col-lg-4">
                 <label> Custom Cleared at Destination Port Date</label>
                 <p><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?></p>
             </div>
             <!-- <div class="col-12 col-lg-12">
                 <label>Remark:</label>
                 <span><?= $shipmentProcessData[$key]->corrections ? $shipmentProcessData[$key]->corrections : '- -'; ?></span>
             </div> -->
         </div>

     </div>
     <!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->
     <?php
        if (!empty($shipmentProcessData[$key]->step_id)) {
            if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
             			<input type="hidden" name="step_id_7" value="<?php echo $stepData[$key]->id; ?>">
						 <input type="submit" name="step7_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />
         <?php }
        } else { ?>
         <!--						<input type="hidden" name="step_id_7" value="<?php echo $stepData[$key]->id; ?>">
						<input type="submit" name="step7_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
     <?php } ?>
     <?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
         <!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
     <?php } ?>
 </fieldset>
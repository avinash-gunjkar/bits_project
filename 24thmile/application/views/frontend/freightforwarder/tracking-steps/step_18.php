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
         <h3>Upload Final Custom Documents / Final Bill of Entry <?php echo $status; ?></h3>


         <div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
             <input type="hidden" name="step7_import_step_id" value="<?php echo $stepData[$key]->id; ?>">
             <div class="row">
                 <div class="radio">
                     <label class="mr-3 ml-3"><input type="radio" aria-describedby="step7_import_boe_type-error" name="step7_import_boe_type" id="step7_import_boe_type_regular" value="Regular" <?= $bookedShipment->boe_type == "Regular" ? 'checked' : ''; ?>> Regular BOE</label>&nbsp;
                     <label class="mr-3 ml-3"><input type="radio" aria-describedby="step7_import_boe_type-error" name="step7_import_boe_type" id="step7_import_boe_type_bonded" value="Bonded" <?= $bookedShipment->boe_type == "Bonded" ? 'checked' : ''; ?>> Bonded BOE</label>&nbsp;
                     <span id="step7_import_boe_type-error" class="error"></span>
                 </div>
             </div>
             <div class="row" id="step7_import_RegularBOE" style="<?= $bookedShipment->boe_type == 'Regular' ? '' : 'display:none;' ?>">
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <div class="fileUpload btn btn-secondary">
                             <span>Select Final Bill of Entry</span>
                             <input type="file" aria-describedby="final_bill_of_entry-error" id="final_bill_of_entry" name="final_bill_of_entry" class="upload" />
                         </div>
                         <div class="selected-file-name">
                             <p><?= printDocumentLink($preshipdocs->final_bill_of_entry) ?></p>
                         </div>
                         <span id="final_bill_of_entry-error" class="error"></span>

                     </div>
                 </div>

                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> Bill of Entry Number</label>
                         <input type="text" required class="form-control width-150" name="bill_of_entry_no" value="<?= $bookedShipment->bill_of_entry_no ?>" />

                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> Bill of Entry Date</label>
                         <input type="text" required autocomplete="off" placeholder="DD-MM-YYYY" class="form-control date-picker width-100" name="bill_of_entry_date" value="<?= printFormatedDate($bookedShipment->bill_of_entry_date) ?>" />

                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Import Duty Amount (INR): </label>
                         <input type="text" required maxlength="20" class="form-control decimal-numbers width-150" id="import_duty_amount" name="import_duty_amount" value="<?php echo isset($bookedShipment->import_duty_amount) ? $bookedShipment->import_duty_amount : ''; ?>" />
                     </div>
                 </div>


                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Import Under Scheme: </label>
                         <select id="import_under_schment" name="import_under_schment" data-target="#importUnderSchemeLicenseNoContainer" class="import-under-schment form-control">
                             <option value="">-Select-</option>
                             <option value="Advance Authorization" <?= $bookedShipment->import_under_schment == 'Advance Authorization' ? ' selected ' : '' ?>>Advance Authorization</option>
                             <option value="Export Promotion Capital Goods" <?= $bookedShipment->import_under_schment == 'Export Promotion Capital Goods' ? ' selected ' : '' ?>>Export Promotion Capital Goods</option>
                             <option value="Inbound Bill of entry" <?= $bookedShipment->import_under_schment == 'Inbound Bill of entry' ? ' selected ' : '' ?>>Inbound Bill of entry</option>
                             <option value="Outbound Bill of entry" <?= $bookedShipment->import_under_schment == 'Outbound Bill of entry' ? ' selected ' : '' ?>>Outbound Bill of entry</option>
                             <option value="Bill of Entry for Home Consumption" <?= $bookedShipment->import_under_schment == 'Bill of Entry for Home Consumption' ? ' selected ' : '' ?>>Bill of Entry for Home Consumption</option>
                             <option value="Other" <?= $bookedShipment->import_under_schment == 'Other' ? ' selected ' : '' ?>>Other</option>
                         </select>
                     </div>
                 </div>
                 <?php 
                 $importUnderSchemeLicenseLable= '';
                 if(strcasecmp($bookedShipment->import_under_schment,'Advance Authorization')==0){
                    $importUnderSchemeLicenseLable="Advance Authorization license No.:";
                 }else if(strcasecmp($bookedShipment->import_under_schment,'Export Promotion Capital Goods')==0){
                    $importUnderSchemeLicenseLable="Export Promotion Capital Goods license No.:";
                 } ?>
                 <div  id="importUnderSchemeLicenseNoContainer" style="<?=!empty($importUnderSchemeLicenseLable)?'display:block':'display:none'?>" class="col-12 col-lg-4">
                 <div class="form-group">
                     <label><?=$importUnderSchemeLicenseLable?></label>
                        <input type="text" name="import_u_s_l_no" maxlength="50" value="<?=$bookedShipment->import_u_s_l_no?>" class='width-150 form-control'>
                     </div>
                 </div>
                

                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> Custom Cleared at Destination Port Date</label>
                         <input type="text" required autocomplete="off" placeholder="DD-MM-YYYY" class="form-control date-picker" name="step7_import_ccd_date" value="<?= printFormatedDate($shipmentProcessData[$key]->action_date) ?>" />

                     </div>
                 </div>

                 <?php if ($bookedShipment->quote_status == 5) { ?>
                     <div class="col-12">
                         <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                         <input type="submit" name="step7_import" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                         <!-- <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button> -->
                     </div>
                 <?php } ?>

             </div>

             <div class="row" id="step7_import_BondedBOE" style="<?= $bookedShipment->boe_type == 'Bonded' ? '' : 'display:none;' ?>">
                 <div class="col-12">
                     <h3>Inbond BOE:</h3>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <div class="fileUpload btn btn-secondary">
                             <span>Select Bill of Entry</span>
                             <input type="file" aria-describedby="step7_import_bill_of_entry_inbond-error" id="step7_import_bill_of_entry_inbond" name="step7_import_bill_of_entry_inbond" class="upload" />
                         </div>
                         <div class="selected-file-name">
                             <p><?= printDocumentLink($preshipdocs->bill_of_entry_inbond) ?></p>
                         </div>
                         <span id="step7_import_bill_of_entry_inbond-error" class="error"></span>
                     </div>
                 </div>

                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> Bill of Entry Number</label>
                         <input type="text" required class="form-control width-150" name="step7_bill_of_entry_no_inbond" value="<?= $bookedShipment->bill_of_entry_no_inbond ?>" />

                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> Bill of Entry Date</label>
                         <input type="text" required autocomplete="off" placeholder="DD-MM-YYYY" class="form-control date-picker width-150" name="step7_bill_of_entry_date_inbond" value="<?= printFormatedDate($bookedShipment->bill_of_entry_date_inbond) ?>" />

                     </div>
                 </div>

                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Import Duty Amount (INR): </label>
                         <input type="text" required maxlength="20" class="form-control decimal-numbers width-150" id="step7_import_duty_amount_inbond" name="step7_import_duty_amount_inbond" value="<?php echo isset($bookedShipment->import_duty_amount_inbond) ? $bookedShipment->import_duty_amount_inbond : ''; ?>" />
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Custom Bank Details: </label>
                         <input type="text" required maxlength="100" class="form-control" id="step7_custom_bank_details_inbond" name="step7_custom_bank_details_inbond" value="<?php echo isset($bookedShipment->custom_bank_details_inbond) ? $bookedShipment->custom_bank_details_inbond : ''; ?>" />
                     </div>
                 </div>

                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Import Under Scheme: </label>
                         <select id="step7_import_under_schment_inbond" name="step7_import_under_schment_inbond" data-target="#importUnderSchemeLicenseNoContainerInbond" class="import-under-schment form-control">
                             <option value="">-Select-</option>
                             <option value="Advance Authorization" <?= $bookedShipment->import_under_schment_inbond == 'Advance Authorization' ? ' selected ' : '' ?>>Advance Authorization</option>
                             <option value="Export Promotion Capital Goods" <?= $bookedShipment->import_under_schment_inbond == 'Export Promotion Capital Goods' ? ' selected ' : '' ?>>Export Promotion Capital Goods</option>
                             <option value="Inbound Bill of entry" <?= $bookedShipment->import_under_schment_inbond == 'Inbound Bill of entry' ? ' selected ' : '' ?>>Inbound Bill of entry</option>
                             <option value="Outbound Bill of entry" <?= $bookedShipment->import_under_schment_inbond == 'Outbound Bill of entry' ? ' selected ' : '' ?>>Outbound Bill of entry</option>
                             <option value="Bill of Entry for Home Consumption" <?= $bookedShipment->import_under_schment_inbond == 'Bill of Entry for Home Consumption' ? ' selected ' : '' ?>>Bill of Entry for Home Consumption</option>
                             <option value="Other" <?= $bookedShipment->import_under_schment_inbond == 'Other' ? ' selected ' : '' ?>>Other</option>
                         </select>
                     </div>
                 </div>
                 <?php 
                 $importUnderSchemeLicenseLableInbond= '';
                 if(strcasecmp($bookedShipment->import_under_schment_inbond,'Advance Authorization')==0){
                    $importUnderSchemeLicenseLableInbond="Advance Authorization license No.:";
                 }else if(strcasecmp($bookedShipment->import_under_schment_inbond,'Export Promotion Capital Goods')==0){
                    $importUnderSchemeLicenseLableInbond="Export Promotion Capital Goods license No.:";
                 } ?>
                 <div  id="importUnderSchemeLicenseNoContainerInbond" style="<?=!empty($importUnderSchemeLicenseLableInbond)?'display:block':'display:none'?>" class="col-12 col-lg-4">
                 <div class="form-group">
                     <label><?=$importUnderSchemeLicenseLableInbond?></label>
                        <input type="text" name="import_u_s_l_no_inbond" maxlength="50" value="<?=$bookedShipment->import_u_s_l_no_inbond?>"  class='width-150 form-control'>
                     </div>
                 </div>
                 <?php if ($bookedShipment->quote_status == 5) { ?>
                     <div class="col-12">
                         <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                         <input type="submit" name="step7_import_inbond" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                         <!-- <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button> -->
                     </div>
                 <?php } ?>

                 <div class="col-12">
                     <hr>
                     <h3>Exbond BOE:</h3>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <div class="fileUpload btn btn-secondary">
                             <span>Select Bill of Entry</span>
                             <input type="file" aria-describedby="step7_import_bill_of_entry_exbond-error" id="step7_import_bill_of_entry_exbond" name="step7_import_bill_of_entry_exbond" class="upload" />
                         </div>
                         <div class="selected-file-name">
                             <p><?= printDocumentLink($preshipdocs->bill_of_entry_exbond) ?></p>
                         </div>
                         <span id="step7_import_bill_of_entry_exbond-error" class="error"></span>
                     </div>
                 </div>

                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> Bill of Entry Number</label>
                         <input type="text" class="form-control width-150" name="step7_bill_of_entry_no_exbond" value="<?= $bookedShipment->bill_of_entry_no_exbond ?>" />

                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> Bill of Entry Date</label>
                         <input type="text" autocomplete="off" placeholder="DD-MM-YYYY" class="form-control date-picker width-150" name="step7_bill_of_entry_date_exbond" value="<?= printFormatedDate($bookedShipment->bill_of_entry_date_exbond) ?>" />

                     </div>
                 </div>

                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Import Duty Amount (INR): </label>
                         <input type="text" maxlength="20" class="form-control decimal-numbers width-150" id="step7_import_duty_amount_exbond" name="step7_import_duty_amount_exbond" value="<?php echo isset($bookedShipment->import_duty_amount_exbond) ? $bookedShipment->import_duty_amount_exbond : ''; ?>" />
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Custom Bank Details: </label>
                         <input type="text" maxlength="100" class="form-control" id="step7_custom_bank_details_exbond" name="step7_custom_bank_details_exbond" value="<?php echo isset($bookedShipment->custom_bank_details_exbond) ? $bookedShipment->custom_bank_details_exbond : ''; ?>" />
                     </div>
                 </div>

                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>Import Under Scheme: </label>
                         <select id="step7_import_under_schment_exbond" name="step7_import_under_schment_exbond" data-target="#importUnderSchemeLicenseNoContainerExbond" class="import-under-schment form-control">
                             <option value="">-Select-</option>
                             <option value="Advance Authorization" <?= $bookedShipment->import_under_schment_exbond == 'Advance Authorization' ? ' selected ' : '' ?>>Advance Authorization</option>
                             <option value="Export Promotion Capital Goods" <?= $bookedShipment->import_under_schment_exbond == 'Export Promotion Capital Goods' ? ' selected ' : '' ?>>Export Promotion Capital Goods</option>
                             <option value="Inbound Bill of entry" <?= $bookedShipment->import_under_schment_exbond == 'Inbound Bill of entry' ? ' selected ' : '' ?>>Inbound Bill of entry</option>
                             <option value="Outbound Bill of entry" <?= $bookedShipment->import_under_schment_exbond == 'Outbound Bill of entry' ? ' selected ' : '' ?>>Outbound Bill of entry</option>
                             <option value="Bill of Entry for Home Consumption" <?= $bookedShipment->import_under_schment_exbond == 'Bill of Entry for Home Consumption' ? ' selected ' : '' ?>>Bill of Entry for Home Consumption</option>
                             <option value="Other" <?= $bookedShipment->import_under_schment_exbond == 'Other' ? ' selected ' : '' ?>>Other</option>
                         </select>
                     </div>
                 </div>

                 <?php 
                 $importUnderSchemeLicenseLableExbond= '';
                 if(strcasecmp($bookedShipment->import_under_schment_exbond,'Advance Authorization')==0){
                    $importUnderSchemeLicenseLableExbond="Advance Authorization license No.:";
                 }else if(strcasecmp($bookedShipment->import_under_schment_exbond,'Export Promotion Capital Goods')==0){
                    $importUnderSchemeLicenseLableExbond="Export Promotion Capital Goods license No.:";
                 } ?>
                 <div  id="importUnderSchemeLicenseNoContainerExbond" style="<?=!empty($importUnderSchemeLicenseLableExbond)?'display:block':'display:none'?>" class="col-12 col-lg-4">
                 <div class="form-group">
                     <label><?=$importUnderSchemeLicenseLableExbond?></label>
                        <input type="text" name="import_u_s_l_no_exbond" maxlength="50" value="<?=$bookedShipment->import_u_s_l_no_exbond?>"  class='form-control width-150'>
                     </div>
                 </div>

                 <?php if ($bookedShipment->quote_status == 5) { ?>
                     <div class="col-12">
                         <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                         <input type="submit" name="step7_import_exbond" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                         <!-- <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button> -->
                     </div>
                 <?php } ?>

             </div>


             <div class="row">
                 <!-- <div class="col-12 col-lg-12">
                     <div class="form-group">
                         <label>Remark</label>
                         <input type="text" class="form-control" name="step7_import_details" placeholder="Remark" value="<?= $shipmentProcessData[$key]->corrections ?>">
                     </div>
                 </div> -->

                 <div class="col-12 col-lg-4" style="display: none;">
                     <div class="form-group">
                         <div class="form-check form-check-inline mt-20">
                             <input type="radio" name="step7_import_status" class="form-check-input" checked="" value="1">
                             <label for="approve" class="form-check-label">Approved</label>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
         <div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
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
                         <label>Import Duty Amount (INR): </label>
                         <p><?= isset($bookedShipment->import_duty_amount) ? number_format($bookedShipment->import_duty_amount, 2) : '- -'; ?></p>
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

                 <div class="col-12 col-lg-4">
                     <label> Custom Cleared at Destination Port Date</label>
                     <p><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?></p>
                 </div>
                 <div class="col-12 col-lg-12">
                     <label>Remark:</label>
                     <span><?= $shipmentProcessData[$key]->corrections ? $shipmentProcessData[$key]->corrections : '- -'; ?></span>
                 </div>

                 <?php if ($bookedShipment->quote_status == 5) { ?>
                     <div class="col-12">
                         <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                         <!-- <input type="submit" name="step6_import" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" /> -->
                         <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
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
                         <?php echo isset($bookedShipment->bill_of_entry_no_inbond) ? $bookedShipment->bill_of_entry_no_inbond : '- -'; ?>
    
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> Bill of Entry Date: </label>
                         <?php echo isset($bookedShipment->bill_of_entry_date_inbond) ? printFormatedDate($bookedShipment->bill_of_entry_date_inbond) : '- -'; ?>
    
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
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Details: </label>
                         <p><?php echo isset($bookedShipment->neft_payment_details_inbond) ? $bookedShipment->neft_payment_details_inbond : '- -'; ?></p>
                     </div>
                 </div>

                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> NEFT Payment Date: </label>
                         <?php echo isset($bookedShipment->neft_payment_date_inbond) ? printFormatedDate($bookedShipment->neft_payment_date_inbond) : '- -'; ?>

                     </div>
                 </div>
    
    
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
                         <?php echo isset($bookedShipment->bill_of_entry_no_exbond) ? $bookedShipment->bill_of_entry_no_exbond : '- -'; ?>
    
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> Bill of Entry Date: </label>
                         <?php echo isset($bookedShipment->bill_of_entry_date_exbond) ? printFormatedDate($bookedShipment->bill_of_entry_date_exbond) : '- -'; ?>
    
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

                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label>NEFT Payment Details: </label>
                         <p><?php echo isset($bookedShipment->neft_payment_details_exbond) ? $bookedShipment->neft_payment_details_exbond : '- -'; ?></p>
                     </div>
                 </div>
                 <div class="col-12 col-lg-4">
                     <div class="form-group">
                         <label> NEFT Payment Date: </label>
                         <?php echo isset($bookedShipment->neft_payment_date_exbond) ? printFormatedDate($bookedShipment->neft_payment_date_exbond) : '- -'; ?>

                     </div>
                 </div>
    
    
                 <?php if ($bookedShipment->quote_status == 5) { ?>
                     <div class="col-12">
                         <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                         <!-- <input type="submit" name="step6_import_exbond" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" /> -->
                         <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
                     </div>
                 <?php } ?>
             </div>
         </div>

     </div>







 </fieldset>
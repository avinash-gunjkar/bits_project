 <fieldset class="hideStepSection" <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
        <h3>Shipping Instructions</h3>
        <div class="row">
               <div class="col-12 col-lg-6">
                      <div class="ship-address">
                             <h4>Pick-up Address</h4>
                             <p><?php echo $bookedShipment->consignor_name ?> <br /> <?php echo $bookedShipment->consignor_country_code; ?> <?php echo $bookedShipment->consignor_phone; ?></p>
                             <p><?php echo $bookedShipment->consignor_address_line_1; ?> <br /> <?php echo $bookedShipment->consignor_address_line_2; ?><br /><?php echo $bookedShipment->consignor_city_name; ?> - <?php echo $bookedShipment->consignor_pincode; ?></p>
                      </div>

               </div>
               <div class="col-12 col-lg-6">
                      <div class="ship-address">
                             <h4>Delivery Address</h4>
                             <p><?php echo $bookedShipment->consignee_name; ?> <br /> <?php echo $bookedShipment->consignee_country_code; ?> <?php echo $bookedShipment->consignee_phone; ?></p>
                             <p><?php echo $bookedShipment->consignee_address_line_1; ?> <br /> <?php echo $bookedShipment->consignee_address_line_2; ?><br /><?php echo $bookedShipment->consignee_city_name; ?> - <?php echo $bookedShipment->consignee_pincode; ?></p>
                      </div>

               </div>
        </div>
        <div class="row">
               <div class="col-12 col-lg-4">
                      <div class="form-group">
                             <label>Pick-up Date:</label> <?= $bookedShipment->pick_up_datetime ? printFormatedDateTime($bookedShipment->pick_up_datetime) : '- -' ?>
                      </div>
               </div>
               <div class="col-12 col-lg-8">
                      <div class="form-group">
                             <label>Shipping Instructions:</label> <?= $bookedShipment->shipping_instruction ? $bookedShipment->shipping_instruction : '- -'; ?>
                      </div>
               </div>
        </div>

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
        <h3><?= (in_array($bookedShipment->delivery_term_id, ['3', '4', '5', '6', '7'])) ? 'Post-' : 'Pre-' ?>Shipment Documents <?php echo $status; ?></h3>


        <div class="row">
               <div class="col-12 col-lg-3">
                      <div class="form-group">
                             <label style="display: inline-block">Commercial Invoice:</label>
                             <p><?= printDocumentLink($preshipdocs->commercial_invoice) ?></p>
                      </div>
               </div>

               <div class="col-12 col-lg-3">
                      <div class="form-group">
                             <label style="display: inline">Commercial Invoice Number :</label>
                             <p><?php echo isset($bookedShipment->commercial_invoice_number) ? $bookedShipment->commercial_invoice_number : '- -'; ?></p>

                      </div>
               </div>

               <div class="col-12 col-lg-3">
                      <div class="form-group">
                             <label style="display: inline">Commercial Invoice Date :</label>
                             <p><?= $bookedShipment->commercial_invoice_date ? printFormatedDate($bookedShipment->commercial_invoice_date) : '- -' ?></p>

                      </div>
               </div>

               <div class="col-12 col-lg-3">
                      <div class="form-group">
                             <label style="display: inline">Commercial Invoice Value:</label>
                             <p><?= $bookedShipment->commercial_invoice_value ? $bookedShipment->commercial_invoice_currency.' '.$bookedShipment->commercial_invoice_value : '- -' ?></p>

                      </div>
               </div>
        </div>


        <div class="row">

               <?php if (in_array($bookedShipment->delivery_term_id, ['3', '4', '5', '6', '7'])) { ?>
                      <div class="col-12 col-lg-3">
                             <div class="form-group">
                                    <label style="display: inline-block">Final BL/AWB:</label>
                                   <p> <?= printDocumentLink($preshipdocs->final_billl_of_lading) ?></p>


                             </div>
                      </div>
               <?php } ?>



               <div class="col-12 col-lg-3">
                      <div class="form-group">
                             <label style="display: inline-block">Packing List:</label>
                             <p><?= printDocumentLink($preshipdocs->packing_List) ?></p>


                      </div>
               </div>

               <div class="col-12 col-lg-3">
                      <div class="form-group">
                             <label style="display: inline-block">Certificate of Origin:</label>
                             <p><?= printDocumentLink($preshipdocs->certificate_of_origin) ?></p>


                      </div>
               </div>

               <div class="col-12 col-lg-3">
                      <div class="form-group">
                             <label style="display: inline-block">Other Document:</label>
                             <p><?= printDocumentLink($preshipdocs->other_documents) ?></p>


                      </div>
               </div>

               

               <?php if (in_array($bookedShipment->delivery_term_id, ['1']) ) { ?>
                      <div class="col-12 col-lg-4">
                             <div class="form-group">
                                    <label style="display: inline">Vehicle Details :</label>
                                    <input type="text" required="" maxlength="20" class="form-control" id="vehicle_details" name="vehicle_details" value="<?php echo isset($bookedShipment->vehicle_details) ? $bookedShipment->vehicle_details : ''; ?>" />
                             </div>
                      </div>
                      <div class="col-12 col-lg-4">
                             <div class="form-group">
                                    <label style="display: inline">Transporter Contact Details :</label>
                                    <input type="text" required="" maxlength="20" class="form-control" id="driver_contact_details" name="driver_contact_details" value="<?php echo isset($bookedShipment->driver_contact_details) ? $bookedShipment->driver_contact_details : ''; ?>" />
                             </div>
                      </div>
               <?php } ?>


        </div>
        <?php if ($shipmentProcessData[$key]->status != 1) { ?>
               <hr>
               <h3>Corrections/Suggestions</h3>
               <div class="form-group">
                      <textarea class="form-control" name="step1_import_correction_ff" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
               </div>
               <br />
        <?php } ?>
        <hr>
        <p>Corrections/Suggestions History</p>
        <div class="row">
               <div class="col-12 col-lg-12">


                      <div class="comment-content-box">
                             <p><?php echo isset($shipmentProcessData[$key]->corrections) ? $shipmentProcessData[$key]->corrections : 'No correction Found'; ?></p>
                      </div>
                      <br />
               </div>
        </div>

        <?php if ($shipmentProcessData[$key]->status != 1) { ?>

               <div class="row">
                      <div class="col-12 col-lg-12">
                             <div class="py-2">
                                    <i class="text-mutted">Note: Kindly approved or Suggest changes through System Communication.</i>
                             </div>
                             <div class="form-group">
                                    <div class="form-check form-check-inline">
                                           <input type="radio" aria-describedby="step1_import_status-error" name="step1_import_status" required="" class="form-check-input" value="1">
                                           <label for="approve" class="form-check-label">Approved</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                           <input type="radio" aria-describedby="step1_import_status-error" name="step1_import_status" required="" class="form-check-input" value="3">
                                           <label for="reupload" class="form-check-label">Correct required</label>
                                    </div>
                                    <span id="step1_import_status-error" class="error"></span>

                             </div>

                      </div>
               </div>
        <?php } ?>
        <input type="hidden" name="request_id" value="<?php echo $bookedShipment->request_id; ?>">

        <?php if (!empty($shipmentProcessData[$key]->step_id)) {
                     if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
                      <input type="hidden" name="step_id" value="<?php echo $stepData[$key]->id; ?>">
                      <input type="submit" name="step1_import" class="btn btn-default-cust action-button pull-right" value="Submit" />
               <?php }
              } else { ?>
               <!--						<input type="hidden" name="step_id" value="<?php echo $stepData[$key]->id; ?>">
           <input type="submit" name="step1_import" class="btn btn-default-cust action-button pull-right" value="Submit" />-->
        <?php } ?>
        <?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
               <!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
        <?php } ?>
 </fieldset>
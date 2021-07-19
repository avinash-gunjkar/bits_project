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
          <h5>Custom Documents / Bill of Entry <?php echo $status; ?></h5>
          <div class="row">
              <div class="col l4">
                  <div class="form-group">
                      <label>Bill of Entry:</label>
                      <p><?= printDocumentLink($preshipdocs->bill_of_entry) ?></p>
                     

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
                      <p><?php echo isset($bookedShipment->bill_of_entry_date) ? printFormatedDate($bookedShipment->bill_of_entry_date) : '- -'; ?></p>
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
                      <label>Custom Bank Details: </label>
                      <p><?php echo isset($bookedShipment->custom_bank_details) ? $bookedShipment->custom_bank_details : '- -'; ?></p>
                  </div>
              </div>
              
              <div class="col l4">
                  <div class="form-group">
                      <label>Import Under Scheme: </label>
                      <p><?php echo isset($bookedShipment->import_under_schment) ? $bookedShipment->import_under_schment : '- -'; ?></p>
                  </div>
              </div>

              <?php if ($shipmentProcessData[$key]->status == 1) { ?>
                  <div class="col l4">
                      <div class="form-group">
                          <label>NEFT Payment Details: </label>
                          <p><?php echo isset($bookedShipment->neft_payment_details) ? $bookedShipment->neft_payment_details : '- -'; ?></p>
                      </div>
                  </div>
              <?php } else { ?>
                  <div class="col l4">
                      <div class="form-group">
                          <label>NEFT Payment Details: </label>
                          <div class="input-group">
                              <input type="text" autocomplete="off" required="" class="form-control" name="neft_payment_details" value="<?= $bookedShipment->neft_payment_details ?>" />
                          </div>
                      </div>
                  </div>
              <?php } ?>
              
          </div>
          <?php if ($shipmentProcessData[$key]->status != 1) { ?>
              <h3>Corrections/Suggestions</h3>
              <div class="form-group">
                  <textarea class="form-control" name="step6_import_correction" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
              </div>
              <br />
          <?php } ?>
          <hr>
          <p>Corrections/Suggestions History</p>
          <div class="row">
              <div class="col l12">
                  <div class="comment-content-box">
                      <p><?php echo isset($shipmentProcessData[$key]->corrections) ? $shipmentProcessData[$key]->corrections : 'No correction Found'; ?></p>
                  </div>
                  <br />
              </div>
          </div>
      </div>

      <?php if ($shipmentProcessData[$key]->status != 1) { ?>
                  <div class="row">
                      <div class="col l12">
                      <div class="py-2">
                          <i class="text-mutted">Note: Kindly approved or Suggest changes through System Communication.</i>
                      </div>

                          <div class="form-group">
                              <div class="form-check form-check-inline">
                                  <input type="radio" name="step6_import_status" class="form-check-input" value="1">
                                  <label for="approve" class="form-check-label">Approve</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input type="radio" name="step6_import_status" class="form-check-input" value="3">
                                  <label for="reupload" class="form-check-label">Correction required</label>
                              </div>
                          </div>
                      </div>
                  </div>
              <?php } ?>


      <!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->
      <?php
        if (!empty($shipmentProcessData[$key]->step_id)) {
            if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
              <!-- <input type="hidden" name="step_id_6" value="<?php echo $stepData[$key]->id; ?>"> -->
              <!-- <input type="submit" name="step6_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" /> -->
          <?php }
        } else { ?>
          <!--						<input type="hidden" name="step_id_6" value="<?php echo $stepData[$key]->id; ?>">
						<input type="submit" name="step6_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
      <?php } ?>
      <?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
          <!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
      <?php } ?>
  </fieldset>
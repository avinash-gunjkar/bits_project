<?php if (!$skipComparative) { ?>
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
                     <h3>Service Invoice from Freight Forwarder <?php echo $status; ?></h3>
                     <div class="row">

                            <div class="col-12 col-lg-3">
                                   <div class="form-group">
                                          <label>FF Invoice:</label>
                                          <p><?= printDocumentLink($preshipdocs->invoice_confirm) ?></p>
                                          
                                   </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                   <div class="form-group">
                                          <label>FF Invoice Number:</label>
                                          <p><?php echo isset($bookedShipment->invoice_number) ? $bookedShipment->invoice_number : '- -'; ?></p>

                                   </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                   <div class="form-group">
                                          <label>FF Invoice Date: </label>
                                          <p><?= $bookedShipment->invoice_date?printFormatedDate($bookedShipment->invoice_date):'- -'; ?></p>
                                   </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                   <div class="form-group">
                                          <label>FF Invoice Amount (INR):</label>
                                          <p><?php echo isset($bookedShipment->Invoice_amount) ? number_format($bookedShipment->Invoice_amount, 2) : '- -'; ?></p>

                                   </div>
                            </div>

                            

                            <div class="col-12 col-lg-3">
                                   <div class="form-group">
                                          <label>Payment Due Date: </label>
                                          <p><?= $bookedShipment->payment_due_date?printFormatedDate($bookedShipment->payment_due_date):'- -'; ?></p>


                                   </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                   <div class="form-group">
                                          <label>Shipment Delivery Completed date: </label>
                                          <p><?= $shipmentProcessData[$key]->action_date?printFormatedDate($shipmentProcessData[$key]->action_date):'- -'; ?></p>

                                   </div>
                            </div>

                            
                     </div>
                     <div class="row">
                                         <div class="col-12 col-lg-12">
                                                 <h3>Original Shipping and Customs documents sent to Exporter-Importer by </h3>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Document No.: </label>
                                                         <input type="text" required="" class="form-control width-150" autocomplete="off" value="<?= $bookedShipment->courier_doc_no; ?>" name="courier_doc_no" />
                                                 </div>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Date: </label>
                                                         <input type="text" required="" placeholder="DD-MM-YYYY" class="form-control date-picker" autocomplete="off" value="<?= printFormatedDate($bookedShipment->courier_date); ?>" name="courier_date" />
                                                 </div>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Courier: </label>
                                                         <input type="text" required="" class="form-control width-150" autocomplete="off" value="<?= $bookedShipment->courier_company; ?>" name="courier_company" />
                                                 </div>
                                         </div>

                                 </div>
                     <?php if ($shipmentProcessData[$key]->status != 1) { ?>
                            <h3>Corrections/Suggestions</h3>
                            <div class="form-group">
                                   <textarea class="form-control" name="step8_import_correction" placeholder="If any Correction/Suggestion in uploaded document please enter here.."></textarea>
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
                                                               <input type="radio" name="step8_import_status" class="form-check-input" value="1">
                                                               <label for="approve" class="form-check-label">Approve</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                               <input type="radio" name="step8_import_status" class="form-check-input" value="3">
                                                               <label for="reupload" class="form-check-label">Correction required</label>
                                                        </div>
                                                 </div>
                                          </div>
                                   </div>
                            <?php } ?>
              </div>
              <!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->
              <?php
              if (!empty($shipmentProcessData[$key]->step_id)) {
                     if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
                            <input type="hidden" name="step_id_8" value="<?php echo $stepData[$key]->id; ?>">
                            <input type="submit" name="step8_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />
                     <?php }
              } else { ?>
                     <input type="hidden" name="step_id_8" value="<?php echo $stepData[$key]->id; ?>">
                     <input type="submit" name="step8_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />
              <?php } ?>
              <?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
                     <!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
              <?php } ?>
              <!--<input type="submit" name="submit" class="submit action-button" value="Submit" />-->
       </fieldset>
<?php } else { ?>
       <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
              <div class="shipping-form">
                     <div class="row">
                            <div class="col-12 col-lg-5">
                                   <div class="form-group">
                                          <label>Shipment Delivery Completed date: </label>
                                          <?php if (empty($shipmentProcessData[$key]->action_date)) {
                                                 echo '- -';
                                          }
                                          echo printFormatedDate($shipmentProcessData[$key]->action_date); ?>
                                   </div>
                            </div>
                     </div>
              </div>
       </fieldset>
<?php } ?>
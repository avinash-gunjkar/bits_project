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
                         <h3>Service Invoice to Freight Seller <?php echo $status; ?></h3>

                         <div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
                                 <div class="row">
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">

                                                         <div class="fileUpload btn btn-secondary">
                                                                 <span>Upload Invoice</span>
                                                                 <input type="file" aria-describedby="invoice_confirm-error" id="invoice_confirm" name="invoice_confirm" class="upload" />
                                                         </div>
                                                         <div class="selected-file-name">
                                                                 <p> <?= printDocumentLink($preshipdocs->invoice_confirm) ?></p>
                                                         </div>
                                                         <span id="invoice_confirm-error" class="error"></span>

                                                 </div>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>FF Invoice Number:</label>
                                                         <input type="text" required="" class="form-control width-150" maxlength="20" id="step10_export_invoice_number" name="step10_export_invoice_number" value="<?php echo isset($bookedShipment->invoice_number) ? $bookedShipment->invoice_number : ''; ?>" />

                                                 </div>
                                         </div>


                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>FF Invoice Date: </label>
                                                         <input type="text" required="" placeholder="DD-MM-YYYY" class="form-control date-picker" value="<?= printFormatedDate($bookedShipment->invoice_date); ?>" autocomplete="off" name="step10_export_invoice_date" />

                                                 </div>
                                         </div>

                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Amount (INR):</label>
                                                         <input type="text" required="" class="form-control width-150 decimal-numbers" maxlength="20" id="step10_export_invoice_amount" name="step10_export_invoice_amount" value="<?php echo isset($bookedShipment->Invoice_amount) ? $bookedShipment->Invoice_amount : ''; ?>" />
                                                 </div>
                                         </div>

                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Payment Due Date: </label>
                                                         <input type="text" required="" placeholder="DD-MM-YYYY" class="form-control date-picker" autocomplete="off" value="<?= printFormatedDate($bookedShipment->payment_due_date) ?>" name="step10_export_payment_due_date" />

                                                 </div>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Shipment Delivery Completed Date: </label>
                                                         <input type="text" required="" placeholder="DD-MM-YYYY" class="form-control date-picker" autocomplete="off" value="<?= printFormatedDate($shipmentProcessData[$key]->action_date); ?>" name="step10_export_delivery_date" />

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
                                                         <input type="text" required="" class="form-control width-150" maxlength="20" autocomplete="off" value="<?= $bookedShipment->courier_doc_no; ?>" name="courier_doc_no" />
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

                         </div>

                         <div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
                                 <div class="row">
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Invoice:</label>
                                                         <p> <?= printDocumentLink($preshipdocs->invoice_confirm) ?></p>
                                                 </div>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>FF Invoice Number:</label>
                                                         <p><?php echo isset($bookedShipment->invoice_number) ? $bookedShipment->invoice_number : '- -'; ?></p>

                                                 </div>
                                         </div>

                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>FF Invoice Date: </label>
                                                         <p><?= $bookedShipment->invoice_date ? printFormatedDate($bookedShipment->invoice_date) : '- -'; ?></p>

                                                 </div>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Amount (INR):</label>
                                                         <p><?php echo isset($bookedShipment->Invoice_amount) ? number_format($bookedShipment->Invoice_amount, 2) : '- -'; ?></p>
                                                 </div>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Payment Due Date: </label>
                                                         <p><?= $bookedShipment->payment_due_date ? printFormatedDate($bookedShipment->payment_due_date) : '- -'; ?></p>

                                                 </div>
                                         </div>

                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Shipment Delivery Completed Date: </label>
                                                         <p> <?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?></p>

                                                 </div>
                                         </div>

                                         <div class="col-12 col-lg-12">
                                                 <span class="text-info">Email has been sent.</span>
                                         </div>
                                 </div>
                                 <div class="row">
                                         <div class="col-12 col-lg-12">
                                                 <h3>Original Shipping and Customs documents sent to Exporter-Importer by </h3>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Document No.: </label>
                                                         <p><?= $bookedShipment->courier_doc_no?$bookedShipment->courier_doc_no:'- -'; ?></p>
                                                         
                                                 </div>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Date: </label>
                                                         <p><?= $bookedShipment->courier_date ? printFormatedDate($bookedShipment->courier_date) : '- -'; ?></p>
                                                 </div>
                                         </div>
                                         <div class="col-12 col-lg-4">
                                                 <div class="form-group">
                                                         <label>Courier: </label>
                                                         <p><?= $bookedShipment->courier_company?$bookedShipment->courier_company:'- -'; ?></p>
                                                 </div>
                                         </div>

                                 </div>
                         </div>



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

                 </div>

                 <input type="hidden" name="step10_export_step_id" value="<?php echo $stepData[$key]->id; ?>">
                 <?php if ($bookedShipment->quote_status == 5) { ?>
                         <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                         <input type="submit" name="step10_export" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                         <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
                 <?php } ?>



         </fieldset>
 <?php } else { ?>
         <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
                 <div class="shipping-form">

                         <div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
                                 <div class="row">
                                         <div class="col-12 col-lg-6">
                                                 <div class="form-group">
                                                         <label>Shipment Delivery Completed Date:</label>
                                                         <input type="text" required="" placeholder="DD-MM-YYYY" class="form-control date-picker" autocomplete="off" value="<?= printFormatedDate($shipmentProcessData[$key]->action_date); ?>" name="step10_export_delivery_date" />

                                                 </div>
                                         </div>
                                 </div>
                         </div>
                         <div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
                                 <div class="row">
                                         <div class="col-12 col-lg-+">
                                                 <div class="form-group">
                                                         <label>Shipment Delivery Completed Date:</label>
                                                         <?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?>

                                                 </div>
                                         </div>
                                 </div>
                         </div>

                 </div>
                 <input type="hidden" name="step10_export_status" value="1">
                 <input type="hidden" name="step10_export_step_id" value="<?php echo $stepData[$key]->id; ?>">
                 <?php if ($bookedShipment->quote_status == 5) { ?>
                         <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a>
                         <input type="submit" name="step10_export" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" />
                         <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button>
                 <?php } ?>

         </fieldset>
 <?php } ?>
<fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
        <div class="shipping-form">
                <h5>Shipping Instructions</h5>
                <div class="row">
                        <div class="col l6">
                                <div class="ship-address">
                                        <h6><strong>Pick-up Address</strong></h6>
                                        <p><?php echo $bookedShipment->consignor_name ?> <br /> <?php echo $bookedShipment->consignor_country_code; ?> <?php echo $bookedShipment->consignor_phone; ?></p>
                                        <p><?php echo $bookedShipment->consignor_address_line_1; ?> <br /> <?php echo $bookedShipment->consignor_address_line_2; ?><br /><?php echo $bookedShipment->consignor_city_name; ?> - <?php echo $bookedShipment->consignor_pincode; ?></p>
                                </div>

                        </div>
                        <div class="col l6">
                                <div class="ship-address">
                                        <h6><strong>Delivery Address</strong></h6>
                                        <p><?php echo $bookedShipment->consignee_name; ?> <br /> <?php echo $bookedShipment->consignee_country_code; ?> <?php echo $bookedShipment->consignee_phone; ?></p>
                                        <p><?php echo $bookedShipment->consignee_address_line_1; ?> <br /> <?php echo $bookedShipment->consignee_address_line_2; ?><br /><?php echo $bookedShipment->consignee_city_name; ?> - <?php echo $bookedShipment->consignee_pincode; ?></p>
                                </div>

                        </div>
                </div>
                <div class="row">
                        <div class="col l4">
                                <div class="form-group">
                                        <label>Pick-up Date:</label> <?= $bookedShipment->pick_up_datetime ? printFormatedDateTime($bookedShipment->pick_up_datetime) : '- -' ?>
                                </div>
                        </div>
                        <div class="col l8">
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
                <h5><?= (in_array($bookedShipment->delivery_term_id, ['3', '4', '5', '6', '7'])) ? 'Post-' : 'Pre-' ?>Shipment Documents <?php echo $status; ?></h5>

                <div class="editableDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:block' : 'display:none' ?>">
                        <div class="row">

                                <div class="col l3">
                                        <div class="form-group">
                                                <div class="fileUpload btn btn-secondary">
                                                        <span>Select Commercial Invoice</span>
                                                        <input type="file" aria-describedby="commercial_invoice-error" id="commercial_invoice" name="commercial_invoice" class="upload"  />
                                                </div>
                                                <div class="selected-file-name">
                                                        <p><?= printDocumentLink($preshipdocs->commercial_invoice) ?></p>

                                                </div>
                                                <span id="commercial_invoice-error" class="error" style=""></span>



                                        </div>
                                </div>

                                <div class="col l3">
                                        <div class="form-group">
                                                <label>Commercial Invoice Number :</label>
                                                <input type="text" maxlength="20" required="" class="form-control" id="commercial_invoice_number" name="commercial_invoice_number" value="<?php echo isset($bookedShipment->commercial_invoice_number) ? $bookedShipment->commercial_invoice_number : ''; ?>" />
                                        </div>
                                </div>
                                <div class="col l3">
                                        <div class="form-group">
                                                <label>Commercial Invoice Date :</label>
                                                <input type="text" required="" class="form-control date-picker" autocomplete="off" placeholder="DD-MM-YYYY" name="commercial_invoice_date" value="<?= printFormatedDate($bookedShipment->commercial_invoice_date) ?>" />
                                        </div>
                                </div>
                                <div class="col l3">
                                        <div class="form-group">
                                                <label>Commercial Invoice Value:</label>
                                                <div class="input-group">
                                                        <div class="input-group-prepend">
                                                                <select aria-describedby="commercial_invoice_currency-error" class="input-group custom-select" id="commercial_invoice_currency" name="commercial_invoice_currency" style="width: 80px;">
                                                                        <option selected disabled>Currency</option>
                                                                        <?php foreach (getCountryCurrency() as $countryCurrency) { ?>
                                                                                <option value="<?= $countryCurrency->currency; ?>" <?= $bookedShipment->commercial_invoice_currency == $countryCurrency->currency ? 'selected' : ''; ?>><?= $countryCurrency->currency ?></option>
                                                                        <?php } ?>

                                                                </select>
                                                        </div>
                                                        <input type="text" required="" aria-describedby="commercial_invoice_value-error" maxlength="20" class="form-control width-100" id="commercial_invoice_value" name="commercial_invoice_value" value="<?php echo isset($bookedShipment->commercial_invoice_value) ? $bookedShipment->commercial_invoice_value : ''; ?>" />
                                                </div>
                                                <span id="commercial_invoice_currency-error" class="error"></span> &nbsp;
                                                <span id="commercial_invoice_value-error" class="error"></span>
                                        </div>
                                </div>

                        </div>
                        <div class="row">
                                <?php if (in_array($bookedShipment->delivery_term_id, ['3', '4', '5', '6', '7'])) { ?>
                                        <div class="col l3">
                                                <div class="form-group">
                                                        <div class="fileUpload btn btn-secondary">
                                                                <span>Select Final BL/AWB</span>
                                                                <input type="file" aria-describedby="final_billl_of_lading-error" name="final_billl_of_lading" class="upload"  />
                                                        </div>
                                                        <div class="selected-file-name">
                                                                <p><?= printDocumentLink($preshipdocs->final_billl_of_lading) ?></p>
                                                        </div>
                                                        <span id="final_billl_of_lading-error" class="error" style=""></span>
                                                </div>
                                        </div>
                                <?php } ?>

                                <div class="col l3">
                                        <div class="form-group">
                                                <div class="fileUpload btn btn-secondary">
                                                        <span>Select Packing List</span>
                                                        <input type="file" aria-describedby="step1_import_packing_list-error" id="step1_import_packing_list" name="step1_import_packing_list" class="upload"  />
                                                </div>
                                                <div class="selected-file-name">
                                                        <p><?= printDocumentLink($preshipdocs->packing_List) ?></p>
                                                </div>
                                                <span id="step1_import_packing_list-error" class="error" style=""></span>




                                        </div>
                                </div>

                                <div class="col l3">
                                        <div class="form-group">
                                                <div class="fileUpload btn btn-secondary">
                                                        <span>Select Certificate of Origin</span>
                                                        <input type="file" aria-describedby="certificate_of_origin-error" id="certificate_of_origin" name="certificate_of_origin" class="upload"  />
                                                </div>
                                                <div class="selected-file-name">
                                                        <p><?= printDocumentLink($preshipdocs->certificate_of_origin) ?></p>
                                                </div>
                                                <span id="certificate_of_origin-error" class="error" style=""></span>
                                        </div>
                                </div>

                                <div class="col l3">
                                        <div class="form-group">
                                                <div class="fileUpload btn btn-secondary">
                                                        <span>Select Other Document</span>
                                                        <input type="file" aria-describedby="step1_import_other_documents-error" id="step1_import_other_documents" name="step1_import_other_documents" class="upload"  />
                                                </div>
                                                <div class="selected-file-name">
                                                        <p><?= printDocumentLink($preshipdocs->other_documents) ?></p>
                                                </div>
                                                <span id="step1_import_other_documents-error" class="error" style=""></span>


                                        </div>
                                </div>




                        </div>
                </div>
                <div class="readonlyDataDiv" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:block' : 'display:none' ?>">
                        <div class="row">
                                

                                <div class="col l3">
                                        <div class="form-group">
                                                <label>Commercial Invoice:</label>
                                                <p><?= printDocumentLink($preshipdocs->commercial_invoice) ?></p>
                                        </div>
                                </div>

                                <div class="col l3">
                                        <div class="form-group">
                                                <label style="display: inline">Commercial Invoice Number :</label>
                                                <p><?php echo isset($bookedShipment->commercial_invoice_number) ? $bookedShipment->commercial_invoice_number : '- -'; ?></p>
                                        </div>
                                </div>
                                <div class="col l3">
                                        <div class="form-group">
                                                <label style="display: inline">Commercial Invoice Date :</label>
                                                <p><?= $bookedShipment->commercial_invoice_date ? printFormatedDate($bookedShipment->commercial_invoice_date) : '- -' ?></p>
                                        </div>
                                </div>
                                <div class="col l3">
                                        <div class="form-group">
                                                <label>Commercial Invoice Value (<?= $bookedShipment->commercial_invoice_currency ?>):</label>
                                                <p><?php echo isset($bookedShipment->commercial_invoice_value) ? $bookedShipment->commercial_invoice_value : '- -'; ?></p>
                                        </div>
                                </div>
                        </div>
                        <div class="row">
                        <?php if (in_array($bookedShipment->delivery_term_id, ['3', '4', '5', '6', '7'])) { ?>
                                        <div class="col l3">
                                                <div class="form-group">
                                                        <label>Final BL / AWB:</label>
                                                        <p><?= printDocumentLink($preshipdocs->final_billl_of_lading) ?></p>
                                                </div>
                                        </div>
                                <?php } ?>

                                <div class="col l3">
                                        <div class="form-group">
                                                <label>Packing List:</label>
                                                <p><?= printDocumentLink($preshipdocs->packing_List) ?></p>
                                        </div>
                                </div>

                                <div class="col l3">
                                        <div class="form-group">
                                                <label>Certificate of Origin:</label>
                                                <p><?= printDocumentLink($preshipdocs->certificate_of_origin) ?></p>
                                        </div>
                                </div>

                                <div class="col l3">
                                        <div class="form-group">
                                                <label>Other Document:</label>
                                                <p><?= printDocumentLink($preshipdocs->other_documents) ?></p>
                                        </div>
                                </div>

                                

                        </div>
                </div>

                <p>Correction/Suggestions History</p>
                <div class="row">
                        <div class="col l12">
                                <div class="comment-content-box">
                                        <p><?php echo isset($shipmentProcessData[$key]->corrections) ? $shipmentProcessData[$key]->corrections : 'No correction Found'; ?></p>
                                </div>
                                <br />
                        </div>
                </div>

        </div>

        <input type="hidden" name="step1_import_step_id" value="<?php echo $stepData[$key]->id; ?>">
        <?php if ($bookedShipment->status == 5) { ?>
                <!-- <a href="javascript:void(0)" class="btn btn-secondary pull-right mx-2 cancelBtn">Cancel</a> -->
                <!-- <input type="submit" name="step1_import" class="btn btn-success pull-right" value="Submit" style="<?= in_array($shipmentProcessData[$key]->status, ['', '0', '3']) ? 'display:inline-block' : 'display:none' ?>" /> -->
                <!-- <button type="button" class="btn btn-primary pull-right editbtn" style="<?= in_array($shipmentProcessData[$key]->status, ['1', '2']) ? 'display:inline-block' : 'display:none' ?>">Edit</button> -->
        <?php } ?>

</fieldset>
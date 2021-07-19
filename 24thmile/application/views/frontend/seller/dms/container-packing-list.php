<style>
    .comment-group {
        border-bottom: none;
        padding: none;
    }

    .comment-img {
        position: initial !important;
    }

    .comment-img img {
        max-width: 80%;
        border-radius: 0%;
    }

    .section-title {
        text-align: left;
        padding-bottom: 0px;
        padding-top: 45px;
    }

    .wshipping-content-block {
        padding: 0px 0px;
    }

    table.table tbody tr td {
        text-align: left;
    }

    @media (min-width: 840px) {
        .mdl-grid {
            padding: 8px;
            width: 100% !important;
        }
    }

    .breakup-details p {
        margin: 0;
    }

    label {
        font-weight: bold;
        margin: 0 10px 0 0;
    }

    div.editable {
        display: inline-block;
        padding: 2px 0;
    }

    div.editable input {
        /*border: none;*/
    }

    div.editable-textarea {
        display: block;
    }

    div.editable-block {
        width: 100%;

    }

    div.editable-block input {
        width: 100%;
    }

    div.editable-textarea textarea {
       /* border: none;*/
        resize: none;
        width: 100%;
        height: auto;
    }

    table.table.items-table tr td {
        padding: 0;
    }

    table.table.items-table tr td input,
    table.table.items-table tr td select {
        border: none;
        width: 100%;
        padding: 0 5px;
    }

    input.decimal-numbers,
    span.total-qty,
    span.final-total {
        text-align: right;
    }

    span.total-qty,
    span.final-total {
        padding: 0 5px;
    }

    table.table.items-table tr {
        position: relative;
    }

    table.table.items-table tr a.delete-row-btn {
        display: none;
    }

    table.table.items-table tr:hover a.delete-row-btn {
        position: absolute;
        display: block;
        right: -25px;
        top: 0;
    }

    table.table.no-border td,
    table.table.no-border {
        border: none;
    }
</style>
<!-- Tracking start -->
<div class="wshipping-content-block">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                    <?php
                        $other_details = $documentData->other_details;
                        $items = $documentData->items;
                    ?>
                        <h3 class="heading3-border">Container Packing List</h3>
                        <?= $this->session->flashdata('message') ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td rowspan="3" colspan="2">
                                            <label for="">Exporter</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[exporter]" class="form-control requiredClass" rows="10">
                                            <?= $other_details->exporter ?></textarea>
                                            </div>
                                        </td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div><label for="" style="min-width: 100px;">Export Invoice No.</label>
                                                <div class="editable">
                                                    <input type="text" class="form-control requiredClass" name="invoice_number" value="INV-0001">
                                                </div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">Export Date</label>
                                                <div class="editable">
                                                    <input type="text" name="invoice_date" id="invoice_date" class="date-picker form-control requiredClass" value="<?= printFormatedDate(date('Y-m-d')) ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <label for="">Exporter's Ref</label>
                                            <div><label for="" style="min-width: 100px;">IEC No.</label>
                                                <div class="editable"><input type="text" name="other_details[iec_no]" class="form-control requiredClass" value="<?= $other_details->iec_no ?>"></div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">PSN No.</label>
                                                <div class="editable"><input type="text" name="other_details[pan_no]" class="form-control requiredClass" value="<?= $other_details->pan_no ?>"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Reference</label>
                                            <div><label for="" style="min-width: 100px;">SO# Number</label>
                                                <div class="editable"><input type="text" name="other_details[so_no]" class="form-control requiredClass" value="<?= $other_details->so_no ?>"></div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">SO# Date</label>
                                                <div class="editable"><input type="text" name="other_details[so_date]" class="date-picker form-control" value="<?= $other_details->so_date ?>"></div>
                                            </div>

                                        </td>
                                        <td>
                                            <label for="">Buyer Reference</label>
                                            <div><label for="" style="min-width: 100px;">PO# Number</label>
                                                <div class="editable"><input type="text" name="other_details[po_number]" class="form-control requiredClass" value="<?= $other_details->po_no ?>"></div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">PO# Date</label>
                                                <div class="editable"><input type="text" name="other_details[po_date]" class="date-picker form-control" value="<?= $other_details->po_date ?>"></div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for="">Consignee</label>

                                            <div class="editable-textarea">
                                                <textarea name="other_details[consignee]" class="form-control requiredClass" rows="5"><?= $other_details->consignee ?></textarea>
                                            </div>

                                        </td>
                                        <td colspan="2">
                                            <label for="">Buyer (If not Consignee)</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[consignee_other]" class="form-control requiredClass" rows="5"><?= $other_details->consignee_other ?></textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label for="">Pre-Carriage by</label>
                                            <input type="text" name="other_details[pre_carriage]" class="form-control requiredClass" value="<?= $other_details->pre_carriage ?>">

                                        </td>
                                        <td>
                                            <label for="">Place of Receipt</label>
                                            <input type="text" name="other_details[place_of_receipt]" class="form-control requiredClass" value="<?= $other_details->place_of_receipt ?>">

                                        </td>
                                        <td>
                                            <label for="">Country of Origin</label>
                                            <input type="text" name="other_details[country_o]" class="form-control requiredClass" value="<?= $other_details->country_o ?>">

                                        </td>
                                        <td>
                                            <label for="">Country of Final Destination</label>
                                            <input type="text" name="other_details[country_d]" class="form-control requiredClass" value="<?= $other_details->country_d ?>">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Vessel / Aircraft/ Voyage No</label>
                                            <input type="text" name="other_details[vessel_aircraft_voyage_no]" class="form-control" value="<?= $other_details->vessel_aircraft_voyage_no ?>">

                                        </td>
                                        <td>
                                            <label for="">Port of Loading</label>
                                            <input type="text" name="other_details[port_of_l]" class="form-control requiredClass" value="<?= $other_details->port_of_l ?>">

                                        </td>

                                        <td rowspan="2" colspan="2"><label for="">Packing Information:</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[packing_info]" class="form-control requiredClass" rows="5"><?= $other_details->packing_info ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Port of Discharge</label>
                                            <input type="text" name="other_details[port_of_d]" class="form-control requiredClass" value="<?= $other_details->port_of_d ?>">

                                        </td>
                                        <td>
                                            <label for="">Final Destination</label>
                                            <input type="text" name="other_details[final_destination]" class="form-control requiredClass" value="<?= $other_details->final_destination ?>">

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Description of Goods</th>
                                                        <th>Unit Quantity</th>
                                                        <th>Unit Type</th>
                                                        <th>Package Quantity</th>
                                                        <th>Net Wt per Package (Kg)</th>
                                                        <th>Gross Wt per Package (Kg)</th>
                                                        <th>Dimensions Per Package (LxWxH) cm</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) { ?>
                                                        <?php foreach ($items as $key => $item) {
                                                            $item = (object)$item; ?>

                                                            <tr>
                                                                <td>
                                                                    <input type="text" maxlength="30" class="form-control requiredClass" name="items[<?= $key ?>][product]" value="<?= $item->product ?>">
                                                                </td>
                                                                <td><input type="text" maxlength="50" class="form-control requiredClass" name="items[<?= $key ?>][description]" value="<?= $item->description ?>"></td>

                                                                <td><input type="text" class="decimal-numbers qty form-control requiredClass" maxlength="12" name="items[<?= $key ?>][qty]" placeholder="0.00" value="<?= $item->qty ?>"></td>
                                                                <td>
                                                                    <select name="items[<?= $key ?>][unit]" id="">
                                                                        <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                                                                            <option value="<?= $unitCode ?>" <?= $unitCode == $item->unit ? ' selected ' : '' ?>><?= $unitValue ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" class="decimal-numbers package_qty form-control requiredClass" maxlength="12" name="items[<?= $key ?>][package_qty]" placeholder="0.00" value="<?= $item->package_qty ?>"></td>
                                                                <td><input type="text" class="decimal-numbers net_wt_per_pk form-control requiredClass" maxlength="12" name="items[<?= $key ?>][net_wt_per_pk]" placeholder="0.00" value="<?= $item->net_wt_per_pk ?>"></td>
                                                                <td><input type="text" class="decimal-numbers gross_wt_per_pk form-control requiredClass" maxlength="12" name="items[<?= $key ?>][gross_wt_per_pk]" placeholder="0.00" value="<?= $item->gross_wt_per_pk ?>"></td>
                                                                <td>
                                                                    <input type="text" class="dimention_per_pk form-control requiredClass" maxlength="14" name="items[<?= $key ?>][dimention_per_pk]" placeholder="0.00" value="<?= $item->dimention_per_pk ?>">
                                                                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>

                                                <tfoot>
                                                    <!-- <tr>
                                                    <td>Kind of Packages</td>
                                                    <td></td>
                                                    <td>Total This Page</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr> -->
                                                    <!-- <tr>
                                                    
                                                    <td colspan='2'>Total This Page</td>
                                                    
                                                    <td class="text-right"><span class="total-qty"><?= $documentData->total_qty ?></span></td>
                                                    <td class="text-right"><span class="total-qty"><?= $documentData->total_qty ?></span></td>
                                                    <td class="text-right"><span class="total-qty"><?= $documentData->total_qty ?></span></td>
                                                    <td class="text-right"><span class="total-qty"><?= $documentData->total_qty ?></span></td>
                                                    <td class="text-right"><span class="total-qty"><?= $documentData->total_qty ?></span></td>
                                                    <td class="text-right"><span class="total-qty"><?= $documentData->total_qty ?></span></td>
                                                </tr> -->
                                                    <tr>

                                                        <td colspan='2'>Consignment Total</td>

                                                        <td class="text-right"><span class="total-qty"><?= $documentData->total_qty ?></span></td>
                                                        <td class="text-right"> </td>
                                                        <td class="text-right"><span class="total-package_qty"><?= $documentData->total_package_qty ?></span></td>
                                                        <td class="text-right"><span class="total-net_wt_per_pk"><?= $documentData->total_net_wt ?></span></td>
                                                        <td class="text-right"><span class="total-gross_wt_per_pk"><?= $documentData->total_gross_wt ?></span></td>
                                                        <td class="text-right"> </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8" class="text-left">
                                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>

                                                </tfoot>

                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" colspan='4'><label for=""> Any Special Consideration for Shipment: </label>
                                            <div class="editable-textarea">
                                                <textarea cols="200" rows="4" class="form-control requiredClass" name="other_details[special_consideration]"><?= $other_details->special_consideration ?></textarea>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <p>Shipping Bill Number: <span><?= $other_details->shipping_bill_no ?> dated <?= $other_details->shipping_bill_date ?></span>
                                                <input type="hidden" value="<?= $other_details->shipping_bill_no ?>" class="form-control" style="width:200px;display:inline" name="other_details[shipping_bill_no]" maxlength="40">
                                                <input type="hidden" value="<?= $other_details->shipping_bill_date ?>" class="form-control" style="width:200px;display:inline" name="other_details[shipping_bill_date]" maxlength="40">
                                                <br>
                                                Bill of Lading / Airway Bill Number: <span><?= $other_details->bol_awb_no ?> dated <?= $other_details->bol_awb_dated ?></span>
                                                <input type="hidden" value="<?= $other_details->bol_awb_no ?>" class="form-control" style="width:200px;display:inline" name="other_details[bol_awb_no]" maxlength="15">
                                                <input type="hidden" value="<?= $other_details->bol_awb_dated ?>" class="form-control" style="width:200px;display:inline" name="other_details[bol_awb_dated]" maxlength="15">
                                            </p>
                                            <br>
                                            <p><label for="">Shipping Marks</label></p><br>
                                            <p><label for="" style="min-width: 100px;">To:</label> <?= $other_details->shipping_marks_to ?></p><br>
                                            <input type="hidden" name="other_details[shipping_marks_to]" value="<?= $other_details->shipping_marks_to ?>">
                                            <p><label for="" style="min-width: 100px;">From:</label> <?= $other_details->shipping_marks_from ?></p><br>
                                            <input type="hidden" name="other_details[shipping_marks_from]" value="<?= $other_details->shipping_marks_from ?>">
                                            <p><label for="" style="min-width: 100px;">Package No.</label> <input type="text" value="<?= $other_details->shipping_marks_package_no ?>" class="form-control requiredClass" style="width:200px;display:inline" name="other_details[shipping_marks_package_no]" maxlength="60"></p><br>
                                            <p><label for="" style="min-width: 100px;">Weight:</label> <input type="text" value="<?= $other_details->shipping_marks_weight ?>" class="form-control requiredClass" style="width:200px;display:inline" name="other_details[shipping_marks_weight]" maxlength="60"></p>
                                        </td>
                                        <td colspan="2">
                                            <table class="table no-border">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            For <?= $documentData->for_consignor_company ?>
                                                            <br><br>
                                                            <input type="hidden" name="for_consignor_company" value="<?= $documentData->for_consignor_company ?>">
                                                            <div>
                                                                <div class="fileUpload btn btn-secondary">
                                                                    <span>Select Signature</span>
                                                                    <input type="file" class="upload preview" name="signature" data-previewTarget="#userPhotoPreview" id="profile_pic">
                                                                    <!-- <label class="custom-file-label" for="profile_pic">Slect Sign</label> -->
                                                                </div>
                                                                <input id="clearSelectionBtn" type="button" class="btn btn-secondary btn-sm" value="Clear the Selection" style="display:none;">
                                                                <img id="userPhotoPreview" src="<?= $documentData->signature ?>" style="height:50px;width: 150px; object-fit: contain;" />

                                                                <br><label for="">Signature</label>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td><label for="">Place:</label></td>
                                                        <td><input type="text" name="issue_place" maxlength="50" style="width:200px" class="form-control requiredClass" value="<?= $documentData->issue_place ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="">Date:</label></td>
                                                        <td><input type="text" class="date-picker form-control requiredClass" name="issue_date" value="<?= printFormatedDate($documentData->issue_date) ?>" maxlength="15"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <center>
                                <input type="submit" value="Save as Draft" class="btn btn-warning">
                                <input type="submit" value="Create Document" name="submitBtn" id="createDocumentBtn" class="btn btn-success">
                            </center>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog content end -->
</section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->

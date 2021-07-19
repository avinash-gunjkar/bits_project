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
        height: 25px;
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

    table.table.items-table tr td {
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
        z-index: 9;
    }

    table.product-table tr a.delete-product-row-btn {
        display: none;
    }

    table.product-table tr:hover a.delete-product-row-btn {
        position: absolute;
        display: block;
        right: -25px;
        top: 0;
        z-index: 9;
    }

    table.table.no-border td,
    table.table.no-border {
        border: none;
    }

    .fix-width-60 {
        width: 60px;
        min-width: 60px;
        max-width: 60px;
    }

    .fix-width-80 {
        width: 80px;
        min-width: 80px;
        max-width: 80px;
    }

    .fix-width-600 {
        width: 500px;
        min-width: 500px;
        max-width: 500px;
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

                        <center>
                            <h3 class="heading3-border">Packing List</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
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
                                                <textarea name="other_details[exporter]" class="form-control requiredClass" rows="10"><?= $other_details->exporter ?></textarea>
                                            </div>
                                        </td>

                                        <td>
                                            <div><label for="" style="min-width: 100px;">Export Invoice No.</label>
                                                <div class="editable">
                                                    <input type="text" class="form-control requiredClass" name="other_details[invoice_number]" value="<?= $other_details->invoice_number ?>">
                                                </div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">Export Date</label>
                                                <div class="editable">
                                                    <input type="text" name="other_details[invoice_date]" id="invoice_date" class="date-picker form-control requiredClass" value="<?= printFormatedDate($other_details->invoice_date) ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <label for="">Exporter's Ref</label>
                                            <div><label for="" style="min-width: 100px;">IEC No.</label>
                                                <div class="editable"><input type="text" name="other_details[iec_no]" class="form-control requiredClass" value="<?= $other_details->iec_no ?>"></div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">Ad Code</label>
                                                <div class="editable"><input type="text" name="other_details[ad_code]" class="form-control requiredClass" value="<?= $other_details->ad_code ?>"></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td colspan="2">
                                            <label for="">Buyer Reference</label>
                                            <div><label for="" style="min-width: 100px;">PO# Number</label>
                                                <div class="editable"><input type="text" name="other_details[po_no]" class="form-control requiredClass" value="<?= $other_details->po_no ?>"></div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">PO# Date</label>
                                                <div class="editable"><input type="text" name="other_details[po_date]" class="requiredClass form-control" value="<?= $other_details->po_date ?>"></div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label>Other Reference/Notify Party</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[notify_party]" class="form-control" rows="6"><?= $other_details->notify_party ?></textarea>
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
                                            <label for="">Buyer (If other than Consignee)</label>
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

                                        <td rowspan="2" colspan="2"><label for="">Terms / Method of Payment</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[terms_method_payment]" class="form-control requiredClass" rows="5"><?= $other_details->terms_method_payment ?></textarea>
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
                                            <a href="<?= base_url('assets/frontend/excel-file-templates/packing-list-products-template.xlsx') ?>" class=" btn btn-sm btn-success">Download Add Lines Template</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th class="fix-width-60">Sr.No.</th>
                                                        <th class="fix-width-600">Description of Goods</th>
                                                        <th class="fix-width-60">Quantity</th>
                                                        <th class="fix-width-80">Unit of Measure</th>
                                                        <th>Package Quantity</th>
                                                        <th>Net Weight (Kg)</th>
                                                        <th>Gross Weight (Kg)</th>
                                                        <th colspan="3">Dimensions (LxWxH) Centimeter</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) { ?>
                                                        <?php foreach ($items as $key => $item) {
                                                            $item = (object)$item; ?>

                                                            <tr>

                                                                <td colspan="4">
                                                                    <table id="product_<?= $key ?>" class="product-table table" data-rowid="<?= $key ?>">
                                                                        <tbody>
                                                                            <?php if (!empty($item->products)) { ?>
                                                                                <?php foreach ($item->products as $key2 => $product) {
                                                                                    $product = (object)$product; ?>
                                                                                    <tr>
                                                                                        <td class="fix-width-60"><input type="text" maxlength="30" class="form-control requiredClass" name="items[<?= $key ?>][products][<?= $key2 ?>][product]" value="<?= $product->product ?>"></td>
                                                                                        <td class="fix-width-600"><input type="text" maxlength="50" class="form-control requiredClass" name="items[<?= $key ?>][products][<?= $key2 ?>][description]" value="<?= $product->description ?>"></td>
                                                                                        <td class="fix-width-60"><input type="text" class="decimal-numbers qty form-control requiredClass" maxlength="12" name="items[<?= $key ?>][products][<?= $key2 ?>][qty]" placeholder="0.00" value="<?= $product->qty ?>"></td>
                                                                                        <td class="fix-width-80">
                                                                                            <select name="items[<?= $key ?>][products][<?= $key2 ?>][unit]" id="">
                                                                                                <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                                                                                                    <option value="<?= $unitCode ?>" <?= $unitCode == $product->unit ? ' selected ' : '' ?>><?= $unitValue ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                            <a class="btn delete-product-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                                                                                        </td>
                                                                                    </tr>

                                                                                <?php } ?>
                                                                            <?php } else {
                                                                                $key2 = 0; ?>
                                                                                <tr>
                                                                                    <td class="fix-width-60"><input type="text" maxlength="30" class="form-control requiredClass" name="items[<?= $key ?>][products][<?= $key2 ?>][product]" value="<?= $item->product ?>"></td>
                                                                                    <td class="fix-width-600"><input type="text" maxlength="50" class="form-control requiredClass" name="items[<?= $key ?>][products][<?= $key2 ?>][description]" value="<?= $item->description ?>"></td>
                                                                                    <td class="fix-width-60"><input type="text" class="decimal-numbers qty form-control requiredClass" maxlength="12" name="items[<?= $key ?>][products][<?= $key2 ?>][qty]" placeholder="0.00" value="<?= $item->qty ?>"></td>
                                                                                    <td class="fix-width-80">
                                                                                        <select name="items[<?= $key ?>][products][<?= $key2 ?>][unit]" id="">
                                                                                            <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                                                                                                <option value="<?= $unitCode ?>" <?= $unitCode == $item->unit ? ' selected ' : '' ?>><?= $unitValue ?></option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                        <a class="btn delete-product-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <td colspan="4" class="text-left">
                                                                                    <a class="btn btn-sm text-primary add-new-product"><i class="fa fa-plus"></i> Add new line</a>
                                                                                    <label>
                                                                                        <input type="file" class="import-lines" style="display: none;">
                                                                                        <a class="text-primary"><i class="fa fa-plus"></i> Import lines</a>
                                                                                    </label>
                                                                                </td>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </td>


                                                                <td><input type="text" class="decimal-numbers package_qty form-control requiredClass" maxlength="12" name="items[<?= $key ?>][package_qty]" placeholder="0.00" value="<?= $item->package_qty ?>"></td>
                                                                <td><input type="text" class="decimal-numbers net_wt_per_pk form-control requiredClass" maxlength="12" name="items[<?= $key ?>][net_wt_per_pk]" placeholder="0.00" value="<?= $item->net_wt_per_pk ?>"></td>
                                                                <td><input type="text" class="decimal-numbers gross_wt_per_pk form-control requiredClass" maxlength="12" name="items[<?= $key ?>][gross_wt_per_pk]" placeholder="0.00" value="<?= $item->gross_wt_per_pk ?>"></td>
                                                                <td><input type="text" class="decimal-numbers dimention_per_pk form-control requiredClass" maxlength="5" name="items[<?= $key ?>][length]" placeholder="L" value="<?= $item->length ?>"></td>
                                                                <td><input type="text" class="decimal-numbers dimention_per_pk form-control requiredClass" maxlength="5" name="items[<?= $key ?>][width]" placeholder="W" value="<?= $item->width ?>"></td>
                                                                <td>
                                                                    <input type="text" class="decimal-numbers dimention_per_pk form-control requiredClass" maxlength="5" name="items[<?= $key ?>][height]" placeholder="H" value="<?= $item->height ?>">
                                                                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>

                                                <tfoot>

                                                    <tr>

                                                        <td colspan='2'>Consignment Total</td>

                                                        <td class="text-right"><span class="total-qty"><?= $documentData->total_qty ?></span></td>
                                                        <td class="text-right"></td>
                                                        <td class="text-right"><span class="total-package_qty"><?= $documentData->total_package_qty ?></span></td>
                                                        <td class="text-right"><span class="total-net_wt_per_pk"><?= $documentData->total_net_wt ?></span></td>
                                                        <td class="text-right"><span class="total-gross_wt_per_pk"><?= $documentData->total_gross_wt ?></span></td>
                                                        <td class="text-right" colspan="3"> </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="10" class="text-left">
                                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add New Package</a>
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
                                    <td colspan="4">
                                            <p>Export Shipment under LUT No: <span><?= $other_details->lut_no ?></span> &nbsp;&nbsp;&nbsp; LUT Valid till <input type="text" value="<?= $other_details->export_under_lut_no_valid_date ?>" class="date-picker form-control" style="width:200px;display:inline" name="other_details[export_under_lut_no_valid_date]" maxlength="15">&nbsp;&nbsp;&nbsp; GST No.: <span><?=$other_details->gst_no?></span> </p>
                                            <input type="hidden" class="form-control" style="width:200px;display:inline" value="<?= $other_details->lut_no ?>" name="other_details[lut_no]" maxlength="40">
                                            <input type="hidden" value="<?= $other_details->gst_no ?>" class="form-control" style="width:200px;display:inline" name="other_details[gst_no]" maxlength="40">
                                            <br>
                                            <p><label >Shipping Marks</label></p><br>
                                            <p><label  style="min-width: 100px;">To:</label> <span><?= $other_details->shipping_marks_to ?></span> <input type="hidden" class="form-control" style="display: inline; width:400px;" name="other_details[shipping_marks_to]" value="<?= $other_details->shipping_marks_to ?>"></p><br>
                                            
                                            <p><label  style="min-width: 100px;">From:</label> <span><?= $other_details->shipping_marks_from ?></span> <input type="hidden" class="form-control" style="display: inline; width:400px;" name="other_details[shipping_marks_from]" value="<?= $other_details->shipping_marks_from ?>"></p><br>
                                            
                                            <p><label  style="min-width: 100px;">Package No.</label> <input type="text"  id="shipping_marks_package_no" value="<?= $other_details->shipping_marks_package_no ?>" class="form-control requiredClass" style="width:400px;display:inline" name="other_details[shipping_marks_package_no]" maxlength="100">
                                                    
                                            </p><br>
                                            <p><label  style="min-width: 100px;">Weight:</label> <input type="text" value="<?= $other_details->shipping_marks_weight ?>" class="form-control requiredClass" style="width:400px;display:inline" name="other_details[shipping_marks_weight]" maxlength="60"></p>

                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="editable-textarea">
                                                <textarea cols="30" class="form-control" rows="10" name="other_details[declaration]"><?=$other_details->declaration?></textarea>
                                            </div>

                                        </td>
                                        <td colspan="2">
                                            <table class="table no-border">
                                                <tbody>
                                                   
                                                    <tr>
                                                        <td colspan="1">
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

                                                                <br><label >Authorized Signatory</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="other_details[designation]" id="" value="<?=$other_details->designation?>" class="form-control">
                                                            <label for="">Designation</label>
                                                        </td>

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
<div id="item-table-row-template" style="display: none;">
    <table>
        <tbody>
            <tr>
                <td colspan="4">
                    <table id="product_{uid}" class="product-table table" data-rowid="{uid}">
                        <tbody>
                            <tr>
                                <td class="fix-width-60"><input type="text" maxlength="30" class="form-control requiredClass" name="items[{uid}][products][{uid2}][product]" value="<?= $tem->product ?>"></td>
                                <td class="fix-width-600"><input type="text" maxlength="50" class="form-control requiredClass" name="items[{uid}][products][{uid2}][description]" value="<?= $tem->description ?>"></td>
                                <td class="fix-width-60"><input type="text" class="decimal-numbers qty form-control requiredClass" maxlength="12" name="items[{uid}][products][{uid2}][qty]" placeholder="0.00" value="<?= $tem->qty ?>"></td>
                                <td class="fix-width-80">
                                    <select name="items[{uid}][products][{uid2}][unit]" id="">
                                        <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                                            <option value="<?= $unitCode ?>" <?= $unitCode == $item->unit ? ' selected ' : '' ?>><?= $unitValue ?></option>
                                        <?php } ?>
                                    </select>
                                    <a class="btn delete-product-row-btn" title="Delete"><i class="fa fa-trash "></i></a>

                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-left">
                                    <a class="btn btn-sm text-primary add-new-product"><i class="fa fa-plus"></i> Add new line</a>
                                    <label>
                                        <input type="file" class="import-lines" style="display: none;">
                                        <a class="text-primary"><i class="fa fa-plus"></i> Import lines</a>
                                    </label>

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </td>


                <td><input type="text" class="decimal-numbers package_qty form-control requiredClass" maxlength="12" name="items[{uid}][package_qty]" placeholder="0.00"></td>
                <td><input type="text" class="decimal-numbers net_wt_per_pk form-control requiredClass" maxlength="12" name="items[{uid}][net_wt_per_pk]" placeholder="0.00"></td>
                <td><input type="text" class="decimal-numbers gross_wt_per_pk form-control requiredClass" maxlength="12" name="items[{uid}][gross_wt_per_pk]" placeholder="0.00"></td>
                <td>
                    <input type="text" class="decimal-numbers dimention_per_pk form-control requiredClass" maxlength="5" name="items[{uid}][length]" placeholder="L">
                </td>
                <td>
                    <input type="text" class="decimal-numbers dimention_per_pk form-control requiredClass" maxlength="5" name="items[{uid}][width]" placeholder="W">
                </td>
                <td>
                    <input type="text" class="decimal-numbers dimention_per_pk form-control requiredClass" maxlength="5" name="items[{uid}][height]" placeholder="H">
                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                </td>

            </tr>
        </tbody>
    </table>

</div>


<div id="product-table-row-template" style="display: none;">
    <table>
        <tbody>


            <tr>
                <td class="fix-width-60"><input type="text" maxlength="30" class="form-control requiredClass" name="items[{uid}][products][{uid2}][product]" value="<?= $tem->product ?>"></td>
                <td class="fix-width-600"><input type="text" maxlength="50" class="form-control requiredClass" name="items[{uid}][products][{uid2}][description]" value="<?= $tem->description ?>"></td>
                <td class="fix-width-60"><input type="text" class="decimal-numbers qty form-control requiredClass" maxlength="12" name="items[{uid}][products][{uid2}][qty]" placeholder="0.00" value="<?= $tem->qty ?>"></td>
                <td class="fix-width-80">
                    <select name="items[{uid}][products][{uid2}][unit]" id="">
                        <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                            <option value="<?= $unitCode ?>" <?= $unitCode == $item->unit ? ' selected ' : '' ?>><?= $unitValue ?></option>
                        <?php } ?>
                    </select>
                    <a class="btn delete-product-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                </td>
            </tr>


        </tbody>
    </table>
</div>


<script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
    jQuery.validator.addClassRules("requiredClass", {
        required: true,
    });
    $("#documentForm").validate({

        onfocusout: function(e) {
            $(e).valid()
        },
        rules: {
            invoice_number: {
                required: true,
            },
            invoice_date: {
                required: true,
            },
            "other_details[iec_no]": {
                required: true,
            },
            "other_details[pan_no]": {
                required: true,
            },

        },
        messages: {}
    });
</script>

<!--start city autocomplete style-->
<style type="text/css">
    #country-list {
        float: left;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 740px;
        z-index: 1010;
        position: absolute;
    }

    #country-list li {
        padding: 10px;
        background: #FAFAFA;
        border-bottom: #F0F0F0 1px solid;
    }

    #country-list li:hover {
        background: #F0F0F0;
    }
</style>

<!--end city autocomplete style-->

<script>
    //start::city auto complete
    $('.from-profileCitySearch input.search-box').on('keyup', function(e) {
        var keyword = $(this).val();

        console.log(keyword);
        if (keyword !== "") {
            $.ajax({
                type: "POST",
                url: $('#base_url').val() + "ajax-city-list",
                data: 'keyword=' + keyword,
                beforeSend: function() {
                    $("#search-box").css("background", "#FFF url(" + $('#base_url').val() + "media/images/ajax-loader.gif) no-repeat 165px");
                },
                success: function(data) {
                    $(".from-profileCitySearch .cityId").val('');
                    $(".from-profileCitySearch .stateId").val('');
                    $(".from-profileCitySearch .countryId").val('');
                    $(".from-profileCitySearch .suggesstion-box").show();
                    $(".from-profileCitySearch .suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");
                }
            });
        } else {
            $(".from-profileCitySearch .cityId").val('');
            $(".from-profileCitySearch .stateId").val('');
            $(".from-profileCitySearch .countryId").val('');
            $(".from-profileCitySearch .suggesstion-box").hide();
        }
    });



    $(document).on('click', '.from-profileCitySearch .suggesstion-box ul li', function(e) {

        if ($(this).attr('data-cityId') != '0') {

            // $(".from-profileCitySearch .cityId").val($(this).attr('data-cityId'));
            // $(".from-profileCitySearch .stateId").val($(this).attr('data-stateId'));
            // $(".from-profileCitySearch .countryId").val($(this).attr('data-countryId'));
            // $("#transaction_currency").val($(this).attr('data-currency'));

            $('.from-profileCitySearch input.search-box').val($(this).text());

        } else {
            // $('#addNewCityModal #city_prefix').val('consignor');
            // $('#addNewCityModal').modal('show');
        }
        $(".from-profileCitySearch .suggesstion-box").hide();

    });

    //end::city auto complete
    const uid = function() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }
    $(document).ready(function() {

        // Start: Calculate total qty
        $(document).on('blur', 'input.qty', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#itemstable'; //'#' + $(this).closest('table').attr('id');
            var totalQty = 0;
            $(tableId + ' tbody tr input.qty').each(function() {

                let qty = parseFloat($(this).val()) || 0.0
                totalQty += qty
            });

            $(tableId + ' > tfoot tr span.total-qty').text(totalQty.toFixed(2));
        });
        // END: Calculate total qty

        // Start: Calculate total package qty
        $(document).on('blur', 'input.package_qty', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#itemstable'; //'#' + $(this).closest('table').attr('id');
            var totalPackage_qty = 0;
            $(tableId + ' tbody tr input.package_qty').each(function() {

                let qty = parseFloat($(this).val()) || 0.0
                totalPackage_qty += qty
            });

            $(tableId + ' > tfoot tr span.total-package_qty').text(totalPackage_qty.toFixed(2));
        });
        // End: Calculate total package qty

        // Start: Calculate total net_wt 
        $(document).on('blur', 'input.net_wt_per_pk,input.package_qty', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            var totalNet_wt = 0;
            $(tableId + ' tbody tr ').each(function() {
                var tr = $(this);
                var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
                var net_wt_per_pk = parseFloat(tr.find('input.net_wt_per_pk').val()) || 0.0;
                totalNet_wt += package_qty * net_wt_per_pk;
            });

            $(tableId + ' tfoot tr span.total-net_wt_per_pk').text(totalNet_wt.toFixed(2));
        });
        // End: Calculate total net_wt 

        // Start: Calculate total gross_wt 
        $(document).on('blur', 'input.gross_wt_per_pk,input.package_qty', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            var totalGross_wt = 0;
            $(tableId + ' tbody tr ').each(function() {
                var tr = $(this);
                var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
                var gross_wt_per_pk = parseFloat(tr.find('input.gross_wt_per_pk').val()) || 0.0;
                totalGross_wt += package_qty * gross_wt_per_pk;


            });

            $(tableId + ' tfoot tr span.total-gross_wt_per_pk').text(totalGross_wt.toFixed(2));
        });
        // End: Calculate total gross_wt 

        // Delete row
        $(document).on('click', 'table.items-table a.delete-row-btn', function() {

            if (confirm("Are you sure you want to delete this line?")) {
                var tableId = '#itemstable'; //'#' + $(this).closest('table').attr('id');
                $(this).closest('tr').remove();
                caculateFinaltotal(tableId);
            }
        });
        // Delete product row
        $(document).on('click', 'table.product-table a.delete-product-row-btn', function() {

            if (confirm("Are you sure you want to delete this line?")) {
                var tableId = '#itemstable'; //'#' + $(this).closest('table').attr('id');
                $(this).closest('tr').remove();
                caculateFinaltotal(tableId);
            }
        });

        $(document).on('click', 'table.items-table tfoot tr a.add-new-line-btn', function() {
            // var tableId = '#' + $(this).closest('table').attr('id');
            var packageRow = $('#item-table-row-template table tbody').html().replace(/{uid}/g, uid());
            $('#itemstable > tbody').append(packageRow.replace(/{uid2}/g, uid()));
        });

        $(document).on('click', 'table.product-table tfoot tr a.add-new-product', function() {
            var tableId = '#' + $(this).closest('table').attr('id');
            var rowid = $(this).closest('table').attr('data-rowid');
            var productRow = $('#product-table-row-template table tbody').html().replace(/{uid}/g, rowid)
            $(tableId + ' > tbody').append(productRow.replace(/{uid2}/g, uid()));
        });
    });

    function caculateFinaltotal(tableId) {
        var finalTotal = 0;
        var totalQty = 0;

        $(tableId + ' tbody tr input.qty').each(function() {

            let qty = parseFloat($(this).val()) || 0.0
            totalQty += qty
        });

        $(tableId + ' > tfoot tr span.total-qty').text(totalQty.toFixed(2));


        var totalPackage_qty = 0;
        $(tableId + ' tbody tr input.package_qty').each(function() {

            let qty = parseFloat($(this).val()) || 0.0

            totalPackage_qty += qty
        });

        $(tableId + ' > tfoot tr span.total-package_qty').text(totalPackage_qty.toFixed(2));


        var totalNet_wt = 0;
        $(tableId + ' tbody tr ').each(function() {
            var tr = $(this);
            var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
            var net_wt_per_pk = parseFloat(tr.find('input.net_wt_per_pk').val()) || 0.0;
            totalNet_wt += package_qty * net_wt_per_pk;


        });

        $(tableId + ' tfoot tr span.total-net_wt_per_pk').text(totalNet_wt.toFixed(2));

        var totalGross_wt = 0;
        $(tableId + ' tbody tr ').each(function() {
            var tr = $(this);
            var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
            var gross_wt_per_pk = parseFloat(tr.find('input.gross_wt_per_pk').val()) || 0.0;
            totalGross_wt += package_qty * gross_wt_per_pk;


        });

        $(tableId + ' tfoot tr span.total-gross_wt_per_pk').text(totalGross_wt.toFixed(2));

    }


    /*start::import lines form excel file*/
    $(document).on("change", "input.import-lines", function(e) {

        var file_data = $(this).prop("files")[0]; // Getting the properties of file from file field
        var form_data = new FormData(); // Creating object of FormData class
        // var element = this;
        var tableId = '#' + $(this).closest('table.product-table').attr('id');
        let uuid1 = $(this).closest('table.product-table').attr('data-rowid');
        // var containerCounter = $(this).data('containercounter') || '';

        if (confirm("Are your sure" + ' Import from ' + file_data.name + "?")) {
            form_data.append("file", file_data);
            form_data.append("uuid1", uuid1);
            form_data.append("tableId", tableId);


            //                    console.log(file_data);
            insertProductItemsFile(form_data, tableId);
            return true;
        }
    });

    function insertProductItemsFile(form_data, tableId) {

        $.ajax({
            url: '<?php echo base_url('Seller_dms/ajaxAddPackageItem_from_excel'); ?>', //Server script to process data
            type: 'POST',
            // cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            //Ajax events
            success: function(html) {
                $(tableId + ' tbody ').append(html);
                caculateFinaltotal('#itemstable');
            }
        });
    }
    /*end::import lines form excel file*/

    $('#profile_pic').change(function() {
        $('#clearSelectionBtn').show();
        $('.fileUpload').hide();
    });

    $('#clearSelectionBtn').click(function() {
        $(this).hide();
        $('.fileUpload').show();
        $('span#profile_pic-error').hide();
        $('#profile_pic').val('');
        $('#userPhotoPreview').attr('src', '');
    });
</script>
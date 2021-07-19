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

    table.table tbody tr th {
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
        margin-right: 10px;
    }

    table tr td,
    table tr th {
        vertical-align: top;
    }





    div.editable {
        display: inline-block;
        padding: 2px 0;
    }



    div.editable-textarea {
        display: block;
    }

    div.editable-textarea textarea {
        /* border: none; */
        resize: none;
        width: 100%;
    }

    ul {
        font-size: inherit;
        list-style: none;
    }

    table.table.no-border td,
    table.table.no-border {
        border: none;
    }

    input.decimal-numbers,
    span.total-qty-no,
    span.total_value {
        text-align: right;
    }

    span.total-qty-no,
    span.total_value {
        padding: 0 5px;
    }

    /* table.table.items-table tr td {
        position: relative;
    }
    table.table.items-table tr a.delete-row-btn {
        display: none;
    }

    table.table.items-table tr:hover a.delete-row-btn {
        position: absolute;
        display: block;
        right: -25px;
        top:0;
    } */

    table {
        counter-reset: srno;
    }

    table tr td.sr-no::before {
        counter-increment: srno;
        content: counter(srno);
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

                        $consignor = (object) $other_details->consignor;
                        $items = $documentData->items;
                        // echo $other_details->custom_invoice_currency;
                        // vdebug($other_details);
                        // echo print_r($requestDetails);

                        
                        ?>

                        <center>
                            <h3 class="heading3-border">TAX-INVOICE</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>

                        <?php  if($documentData->show_conversion_form){ ?>
                            <form method="GET">
                                <div class="row">
                                    <div class="col-lg-4 offset-lg-4">

                                    
                                <h3>Currency Conversion Rate</h3>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>From <?=$other_details->custom_invoice_currency?></td>
                                            <td></td>
                                            <td>To INR</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control decimal-numbers" readonly value="1" name="from" >
                                            </td>
                                            <td>
                                                =
                                            </td>
                                            <td>
                                                <input type="text" class="form-control decimal-numbers" name="conversion_rate" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="Submit" value="Submit" class="btn btn-sm btn-success">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                </div>
                            </form>
                        <?php }else{ ?>
                        
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col width="25%">
                                        <col width="25%">
                                        <col width="25%">
                                        <col width="25%">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td class="text-left"><label>Supplier:</label></td>
                                            <td class="text-left">
                                                <input placeholder="Consignee Company Name" type="text" class="form-control requiredClass" name="other_details[exporter_company_name]" id="#exporter_company_name" value="<?= $other_details->exporter_company_name ?>">
                                            </td>
                                            <td class="text-left"><label>Consignee:</label></td>
                                            <td class="text-left">
                                                <input placeholder="Consignee Company Name" type="text" class="form-control requiredClass" name="other_details[consignee_company_name]" id="#consignee_company_name" value="<?= $other_details->consignee_company_name ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><label>Supplier Address</label></td>
                                            <td class="text-left">
                                                <div class="editable-textarea"><textarea name="other_details[exporter_address]" class="form-control wysihtml5-editor-no-controlls requiredClass" rows="2"><?= $other_details->exporter_address ?></textarea></div>
                                            </td>
                                            <td class="text-left"><label>Consignee Address</label></td>
                                            <td class="text-left">
                                                <div class="editable-textarea"><textarea name="other_details[consignee_address]" class="form-control wysihtml5-editor-no-controlls requiredClass" rows="2"><?= $other_details->consignee_address ?></textarea></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><label>Contact Details:</label></td>
                                            <td class="text-left">
                                                <div class="editable-textarea"><textarea name="other_details[exporter_contact_number]" class="form-control wysihtml5-editor-no-controlls requiredClass" rows="2"><?= $other_details->exporter_contact_number ?></textarea></div>
                                            </td>
                                            <td class="text-left"><label>Contact Details:</label></td>
                                            <td class="text-left">
                                                <div class="editable-textarea"><textarea name="other_details[consignee_contact_number]" class="form-control wysihtml5-editor-no-controlls requiredClass" rows="2"><?= $other_details->consignee_contact_number ?></textarea></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <div>
                                                <td colspan="2">
                                                    <label>IEC/PAN/ Aadhar/ Passport No:</label>
                                                    <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[iec_no]" id="#iec_no" value="<?= $other_details->iec_no ?>"></div>
                                                </td>
                                                <td colspan="2"><label>GSTIN/UIN:</label>
                                                    <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[gst_no]" id="#gst_no" value="<?= $other_details->gst_no ?>"></div>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><label>IGST Payment Status: (Tick applicable option):</label></td>
                                            <td class="text-left"><label>A)Not Applicable <input type="radio" name="other_details[igst_payment_status]" <?= $other_details->igst_payment_status == "not-applicable" ? ' checked ' : '' ?> value="not-applicable"></label></td>
                                            <td class="text-left"><label>B) LUT or Export under Bond <input type="radio" name="other_details[igst_payment_status]" <?= $other_details->igst_payment_status == "export-under-bond" ? ' checked ' : '' ?> value="export-under-bond"></label></td>
                                            <td class="text-left"><label>C) Export Against Payment of IGST <input type="radio" name="other_details[igst_payment_status]" <?= $other_details->igst_payment_status == "export-against-payment" ? ' checked ' : '' ?> value="export-against-payment"></label></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <label>GST Invoice No:</label>
                                            </td>
                                            <td class="text-left">
                                                <input type="text" class="form-control requiredClass" name="other_details[gst_invoice_no]" id="#gst_invoice_no" value="<?= $other_details->gst_invoice_no ?>">
                                            </td>
                                            <td class="text-left">
                                                <label for="">Conversion Rate</label>
                                            </td>
                                            <td colspan="" class="text-left">
                                            <?=$other_details->conversion_rate?>
                                            <input type="hidden" readonly name="other_details[conversion_rate]" value="<?=$other_details->conversion_rate?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <label>Place of Supply:</label>
                                            </td>
                                            <td class="text-left">
                                                <input type="text" class="form-control requiredClass" name="other_details[place_of_supply]" id="#place_of_supply" value="<?= $other_details->place_of_supply ?>">
                                            </td>
                                            <td class="text-left">
                                                <label>Vehicle number:</label>
                                            </td>
                                            <td class="text-left">
                                                <input type="text" class="form-control requiredClass" name="other_details[vehicle_no]" id="#vehicle_no" value="<?= $other_details->vehicle_no ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <label>State Code:</label>
                                            </td>
                                            <td class="text-left">
                                                <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[state_code]" id="#state_code" value="<?= $other_details->state_code ?>"></div>
                                            </td>
                                            <td class="text-left"><label>Date of Supply:</label></td>
                                            <td class="text-left">
                                                <div class="editable input"><input type="text" class="date-picker form-control requiredClass" name="other_details[date_of_supply]" value="<?= printFormatedDate($other_details->date_of_supply) ?>" maxlength="15"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-center"><label>Notifying Party, if Other than Consignee</label></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><label>Supplier:</label></td>
                                            <td class="text-left">
                                                <input placeholder="Consignee Company Name" type="text" class="form-control " name="other_details[notify_party_company_name]" id="#notify_party_company_name" value="<?= $other_details->notify_party_company_name ?>">
                                            </td>
                                            <td class="text-left"><label>Consignee:</label></td>
                                            <td class="text-left">
                                                <input placeholder="Consignee Company Name" type="text" class="form-control " name="other_details[buyer_company_name]" id="#buyer_company_name" value="<?= $other_details->buyer_company_name ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><label>Supplier Address</label></td>
                                            <td class="text-left">
                                                <div class="editable-textarea"><textarea name="other_details[notify_party_address]" class="form-control wysihtml5-editor-no-controlls " rows="2"><?= $other_details->notify_party_address ?></textarea></div>
                                            </td>
                                            <td class="text-left"><label>Consignee Address</label></td>
                                            <td class="text-left">
                                                <div class="editable-textarea"><textarea name="other_details[buyer_address]" class="form-control wysihtml5-editor-no-controlls " rows="2"><?= $other_details->buyer_address ?></textarea></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><label>Contact Details:</label></td>
                                            <td class="text-left">
                                                <div class="editable-textarea"><textarea name="other_details[notify_party_contact_number]" class="form-control wysihtml5-editor-no-controlls " rows="2"><?= $other_details->notify_party_contact_number ?></textarea></div>
                                            </td>
                                            <td class="text-left"><label>Contact Details:</label></td>
                                            <td class="text-left">
                                                <div class="editable-textarea"><textarea name="other_details[buyer_contact_number]" class="form-control wysihtml5-editor-no-controlls " rows="2"><?= $other_details->buyer_contact_number ?></textarea></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="table-responsive">
                                                    <table id="itemstable" class="table items-table">
                                                        <thead>
                                                            <tr>
                                                                <td rowspan="2">
                                                                    <label>Sr. No.</label>
                                                                </td>
                                                                <td rowspan="2" style="width: 40%;">
                                                                    <label>Product Description</label>
                                                                </td>
                                                                <td rowspan="2">
                                                                    <label>HSN Code</label>
                                                                </td>
                                                                <td rowspan="2">
                                                                    <label>Quantity</label>
                                                                </td>
                                                                <td rowspan="2">
                                                                    <label>Rate per Unit (In INR)</label>
                                                                </td>
                                                                <td rowspan="2">
                                                                    <label>Total Value (In INR)</label>
                                                                </td>
                                                                <td colspan="3">
                                                                    <label>IGST</label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>% Rate</td>
                                                                <td>Value in INR</td>
                                                                <td></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($items)) { ?>
                                                                <?php foreach ($items as $key => $item) { ?>
                                                                    <tr>
                                                                        <td class="sr-no">
                                                                        </td>
                                                                        <td>
                                                                            <!-- <?= $item->description ?> -->
                                                                            <input type="text" maxlength="50" class="form-control requiredClass" name="items[<?= $key ?>][description]" value="<?= htmlspecialchars($item->description) ?>">
                                                                        </td>

                                                                        <td>
                                                                            <input type="text" maxlength="10" class="form-control only-numbers requiredClass text-center" name="items[<?= $key ?>][hs_code]" value="<?= $item->hs_code ?>">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control decimal-numbers qty_no requiredClass" maxlength="12" name="items[<?= $key ?>][qty]" placeholder="0.00" value="<?= $item->qty ?>">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control decimal-numbers rate_per_unit requiredClass" maxlength="12" name="items[<?= $key ?>][price]" placeholder="0.00" value="<?= $item->price ?>">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control decimal-numbers total_value requiredClass" name="items[<?= $key ?>][total_amount]" readonly maxlength="12" placeholder="0.00" value="<?= $item->total_amount ?>">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" maxlength="5" class=" form-control decimal-numbers per_rate requiredClass" placeholder="0.00" name="items[<?= $key ?>][per_rate]" value="<?= isset($item->per_rate) ? $item->per_rate : '18.00' ?>">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" readonly class=" form-control decimal-numbers value_in_inr requiredClass" placeholder="0.00" name="items[<?= $key ?>][value_in_inr]" value="<?= $item->value_in_inr ?>">
                                                                        </td>
                                                                        <td>
                                                                            <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>

                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            <?php } ?>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="9">
                                                                    <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add new line</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"><label>Total</label></td>
                                                                <td>
                                                                    <!-- <span class="total-qty-no"><?= $other_details->total_qty_no ?></span> -->
                                                                    <input class="form-control total-qty-no" type="text" readonly name="other_details[total_qty_no]" id="#total_qty_no" value="<?= $other_details->total_qty_no ?>">
                                                                </td>
                                                                <td></td>
                                                                <td>
                                                                    <!-- <span class="total-value"><?= $other_details->total_value ?></span> -->
                                                                    <input class="form-control total-value" type="text" readonly placeholder="0.00" name="other_details[total_value]" id="#total_value" value="<?= $other_details->total_value ?>">
                                                                </td>
                                                                <td></td>
                                                                <td>
                                                                    <!-- <span class="total-value-inr"><?= $other_details->total_value_inr ?></span> -->
                                                                    <input type="text" class="form-control total-value-inr" readonly placeholder="0.00" name="other_details[total_value_inr]" id="#total_value_inr" value="<?= $other_details->total_value_inr ?>">
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="3"><label>Invoice Amount before Tax in Words</label></td>
                                                                <td colspan="2"><label>Total Amount before Tax</label></td>
                                                                <td>
                                                                    <!-- <span class="total-amt-before-tax"><?= $other_details->total_amt_before_tax ?></span> -->
                                                                    <input class="form-control total-amt-before-tax" readonly placeholder="0.00" name="other_details[total_amt_before_tax]" id="#total_amt_before_tax" value="<?= $other_details->total_amt_before_tax ?>">
                                                                </td>
                                                                <td colspan="3"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" rowspan="3">
                                                                    <!-- <span class="totalAmountInWords"><?= $other_details->total_Amount_InWords ?></span> -->
                                                                    <!-- <input class="totalAmountInWords" readonly name="other_details[total_Amount_InWords]" id="#total_Amount_InWords" value="<?= $other_details->total_Amount_InWords ?>"> -->
                                                                    <textarea name="other_details[total_Amount_InWords]" readonly class="form-control totalAmountInWords" rows="3" cols="65"><?= $other_details->total_Amount_InWords ?></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"><label>IGST in INR</label></td>
                                                                <td>
                                                                    <!-- <span class="igst-in-inr"><?= $other_details->igst_in_inr ?></span> -->
                                                                    <input class="form-control igst-in-inr" readonly placeholder="0.00" name="other_details[igst_in_inr]" id="#igst_in_inr" value="<?= $other_details->igst_in_inr ?>">
                                                                </td>
                                                                <td colspan="3"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td>
                                                                    <!-- <span class="total-value-currency"><?= $other_details->total_value_currency ?></span> -->
                                                                    <input type="text" class="form-control total-value-currency" readonly placeholder="0.00" name="other_details[total_value_currency]" id="#total_value_currency" value="<?= $other_details->total_value_currency ?>">
                                                                </td>
                                                                <td colspan="3"></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2"><label>Ceritified that the particulars given above are true and correct</label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-left"><label>Shipper Declaration :</label>
                                                <textarea name="other_details[shipper_declaration]" rows="4" class="form-control wysihtml5-editor-no-controlls"><?= $other_details->shipper_declaration ?></textarea>
                                            </td>

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

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label>Authorized Signatory:</label>
                                                    </div>
                                                    <div class="col-lg-8">

                                                        <input type="text" class="form-control " name="other_details[name_of_authorized_signatory]" value="<?= $other_details->name_of_authorized_signatory ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">

                                                        <label for="">Designation:</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="other_details[designation]" class="form-control col-lg-6" value="<?= $other_details->designation ?>">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                            <center>
                                <input type="submit" value="Save" name="submitBtn" class="btn btn-success">
                                <!-- <input type="submit" value="Create Document" name="submitBtn" id="createDocumentBtn" class="btn btn-success"> -->
                            </center>

                        </form>
                        <?php } ?>

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

                <td class="sr-no"></td>
                <td>
                    <!-- <?= $item->description ?> -->
                    <input type="text" class="form-control requiredClass" maxlength="60" name="items[{uid}][description]">
                </td>
                <td><input type="text" class="form-control requiredClass" maxlength="10" name="items[{uid}][hs_code]"></td>
                <td><input type="text" class="form-control decimal-numbers qty_no requiredClass" maxlength="5" name="items[{uid}][qty]"></td>
                <td><input type="text" class="form-control decimal-numbers rate_per_unit requiredClass" placeholder="0.00" maxlength="8" name="items[{uid}][price]"></td>
                <td><input type="text" class="form-control decimal-numbers total_value requiredClass" placeholder="0.00" readonly name="items[{uid}][total_amount]"></td>
                <td><input type="text" class="form-control decimal-numbers per_rate requiredClass" placeholder="0.00" value="18" maxlength="5" name="items[{uid}][per_rate]"></td>
                <td><input type="text" class="form-control decimal-numbers value_in_inr requiredClass" placeholder="0.00" readonly name="items[{uid}][value_in_inr]">
                </td>
                <td>
                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>

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

        },
        messages: {}

    });
</script>

<script>
    const uid = function() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }
    $(document).ready(function() {

        $(document).on('blur', 'input.qty_no, input.rate_per_unit,input.per_rate', function(e) {

            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            // var categoryTotal = 0;
            var charges = parseFloat(tr.find('input.rate_per_unit').val()) || 0.0;
            var qty = parseFloat(tr.find('input.qty_no').val()) || 0.0;
            var per_rate = parseFloat(tr.find('input.per_rate').val()) || 0.0;
            var total = (charges * qty).toFixed(2);
            var valueinInr = (total * (per_rate / 100)).toFixed(2);
            tr.find('input.total_value').val(total);
            tr.find('input.value_in_inr').val(valueinInr);
            caculateFinaltotal(tableId);

        });

        $(document).on('click', 'table.items-table a.delete-row-btn', function() {

            if (confirm("Are you sure you want to delete this line?")) {
                var tableId = '#' + $(this).closest('table').attr('id');
                $(this).closest('tr').remove();
                caculateFinaltotal(tableId);
            }
        });
        $(document).on('click', 'table.items-table tfoot tr a.add-new-line-btn', function() {
            var tableId = '#' + $(this).closest('table').attr('id');
            $(tableId + ' tbody').append($('#item-table-row-template table tbody').html().replace(/{uid}/g, uid()));
        });
    });

    function caculateFinaltotal(tableId) {
        var finalTotal = 0;
        var totalQty = 0;
        var totalValueInr = 0;
        var grandTotal = 0;

        $(tableId + ' tbody tr').each(function() {
            let item_row = $(this);
            let qty = parseFloat($(item_row).find('input.qty_no').val()) || 0.0
            let charges = parseFloat($(item_row).find('input.rate_per_unit').val()) || 0.0
            let per_rate = parseFloat($(item_row).find('input.per_rate').val()) || 0.0;
            // let valueInr = parseFloat($(item_row).find('input.valueinInr').val()) || 0.0

            console.log('qty:' + qty + ' charges:' + charges);
            totalQty += qty
            finalTotal += (charges * qty)
            totalValueInr += ((charges * qty) * (per_rate / 100))
            grandTotal = (totalValueInr + finalTotal)
            // totalValueInr += valueInr

        });
        $(tableId + ' tfoot tr input.total-qty-no').val(totalQty.toFixed(2));
        $(tableId + ' tfoot tr input.total-value').val(finalTotal.toFixed(2));
        // $(tableId + ' tfoot tr input.decimal-numbers total-value requiredClass').text(finalTotal.toFixed(2));
        $(tableId + ' tfoot tr input.total-value-inr').val(totalValueInr.toFixed(2));
        $(tableId + ' tfoot tr input.total-amt-before-tax').val(finalTotal.toFixed(2));
        $(tableId + ' tfoot tr input.igst-in-inr').val(totalValueInr.toFixed(2));
        $(tableId + ' tfoot tr input.total-value-currency').val(grandTotal.toFixed(2));

        $(tableId + ' tfoot tr textarea.totalAmountInWords').val(amountInWords(grandTotal, 'INR'));
        console.log(finalTotal);
    }

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

    $('#createDocumentBtn').click(function() {
        if (!confirm('Do you want to create final document? After creating final document you can not edit document.')) {
            return false;
        }

    });

    $(document).ready(function() {
        $('.qty_no').blur();
    });
</script>
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

    

    table.table.no-border td,
    table.table.no-border {
        border: none;
    }

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
                          
                        ?>

                        <center>
                            <h3 class="heading3-border">Custom Invoice</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="other_details[custom_invoice_type]" value="<?= $other_details->custom_invoice_type ?>">
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
                                            <label>Exporter</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[exporter]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="10"><?= $other_details->exporter ?></textarea>
                                            </div>
                                        </td>
                                        <td>
                                            <div><label style="min-width: 142px;">Invoice Number</label>
                                                <div class="editable">
                                                    <input type="text" name="other_details[invoice_number]" class="form-control requiredClass" id="invoice_number" value="<?= $other_details->invoice_number ?>">
                                                </div>
                                            </div>
                                            <div><label style="min-width: 142px;">Date</label>
                                                <div class="editable">
                                                    <input type="text" name="other_details[invoice_date]" id="invoice_date" class="date-picker form-control " value="<?= printFormatedDate($other_details->invoice_date) ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <label>Exporter's Referance</label>
                                            <div><label style="min-width: 135px;">Import Export Code</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[iec_no]" id="#ice_no" value="<?= $other_details->iec_no ?>"></div>
                                            </div>
                                            <div><label style="min-width: 135px;">Authorized Dealer Code</label>
                                                <div class="editable"><input type="text" onkeyup="addHyphen(this)" class="form-control requiredClass" name="other_details[ad_code]" id="#ad_code" value="<?= formated_ad_code($other_details->ad_code) ?>"></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <!-- <td>
                                            <label >Reference</label>
                                            <div><label  style="min-width: 100px;">SO# Number</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[so_no]" id="#so_number" value="<?= $other_details->so_no ?>"></div>
                                            </div>
                                            <div><label  style="min-width: 100px;">SO# Date</label>
                                                <div class="editable"><input type="text" class="form-control" name="other_details[so_date]" id="#so_date" class="date-picker" value="<?= $other_details->so_date ?>"></div>
                                            </div>

                                        </td> -->
                                        <td colspan="2">
                                            <label>Buyer Reference</label>
                                            <div><label style="min-width: 100px;">Purchase Order Number and Date (if any)</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[po_number]" id="#po_number" value="<?= $other_details->po_number ?>"></div>
                                                <div class="editable"><input type="text" class="form-control date-picker" name="other_details[po_date]" id="#po_date" class="date-picker" value="<?= printFormatedDate($other_details->po_date) ?>"></div>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label>Other Reference/Notify Party (if any)</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[notify_party]" class="form-control wysihtml5-editor-no-controlls" rows="6"><?= $other_details->notify_party ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label>Consignee</label>

                                            <div class="editable-textarea">
                                                <textarea name="other_details[consignee]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="5"><?= $other_details->consignee ?></textarea>
                                            </div>

                                        </td>
                                        <td colspan="2">
                                            <label>Buyer (if other than Consignee)</label>

                                            <div class="editable-textarea">

                                                <textarea name="other_details[buyer]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="5"><?= $other_details->buyer ?></textarea>

                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>Pre-Carriage by</label>
                                            <select class="form-control " name="other_details[pre_carriage_by]">

                                                <?php foreach (getPrecarriageByList() as $carriage) { ?>
                                                    <option value="<?= $carriage ?>" <?= $other_details->pre_carriage_by == $carriage ? 'selected' : '' ?>><?= $carriage ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <label>Place of Receipt</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[place_of_receipt]" value="<?= $other_details->place_of_receipt ?>">

                                        </td>
                                        <td>
                                            <label>Country of Origin</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[country_of_origin]" value="<?= $other_details->country_of_origin ?>">

                                        </td>
                                        <td>
                                            <label>Country of Final Destination</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[country_of_final_destination]" value="<?= $other_details->country_of_final_destination ?>">

                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Vessel / Aircraft/ Voyage No</label>
                                            <input type="text" class="form-control" name="other_details[vessel_aircraft_voyage_no]" value="<?= $other_details->vessel_aircraft_voyage_no ?>">

                                        </td>
                                        <td>
                                            <label>Port of Loading</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[port_of_l]" value="<?= $other_details->port_of_l ?>">

                                        </td>

                                        <td rowspan="2" colspan="2"><label>Delivery Term & Method of Payment</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[terms_method_of_payment]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="6"><?= $other_details->terms_method_of_payment ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Port of Discharge</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[port_of_d]" id="" value="<?= $other_details->port_of_d ?>">

                                        </td>
                                        <td>
                                            <label>Final Destination</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[final_destination]" id="" value="<?= $other_details->final_destination ?>">

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No.</th>
                                                        <th style="width: 60%;">Description of Goods</th>
                                                        <th>HS Code</th>
                                                        <th>Unit Quantity</th>
                                                        <th>Unit Type</th>
                                                        <th>Price/Unit</th>
                                                        <th>Amount</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) { ?>
                                                        <?php foreach ($items as $key => $tem) { ?>

                                                            <tr>
                                                                <td class="sr-no text-right">

                                                                    <!-- <input type="text" maxlength="30" class="requiredClass" name="items[<?= $key ?>][product]" value="<?= $tem->product ?>"> -->
                                                                </td>
                                                                <td class=""><input type="text" maxlength="50" class="requiredClass" name="items[<?= $key ?>][description]" value="<?= htmlspecialchars($tem->description) ?>"></td>
                                                                <td><input type="text" maxlength="10" class="only-numbers requiredClass text-center" name="items[<?= $key ?>][hs_code]" value="<?= $tem->hs_code ?>"></td>
                                                                <td><input type="text" class="decimal-numbers qty requiredClass" maxlength="12" name="items[<?= $key ?>][qty]" placeholder="0.00" value="<?= $tem->qty ?>"></td>
                                                                <td>
                                                                    <select name="items[<?= $key ?>][unit]" id="">
                                                                        <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                                                                            <option value="<?= $unitCode ?>" <?= $unitCode == $item->unit ? ' selected ' : '' ?>><?= $unitValue ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" class="decimal-numbers price requiredClass" maxlength="12" name="items[<?= $key ?>][price]" placeholder="0.00" value="<?= $tem->price ?>"></td>
                                                                <td>
                                                                    <input type="text" class="decimal-numbers total-amount requiredClass" name="items[<?= $key ?>][total_amount]" readonly maxlength="12" placeholder="0.00" value="<?= ceil($tem->total_amount) ?>">
                                                                </td>
                                                                <td>
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
                                                    <tr>
                                                        <td colspan="2">Total Number of Packages: <input type="text" id="total_package_count" class="form-control only-numbers" maxlength="5" style="width: 100px;display: inline;" name="other_details[total_package_count]" value="<?= $other_details->total_package_count ?>"></td>
                                                        <td>Total Invoice</td>
                                                        <td class="text-right">&nbsp;</td>
                                                        <td></td>
                                                        <td>
                                                            <div class="editable">
                                                                <select class="requiredClass form-control custom-select" id="selectCurrency" name="currency" style="width: 80px;" aria-describedby="shipment_value_currency-error">
                                                                    <option selected disabled>Currency</option>
                                                                    <?php foreach (getCountryCurrency() as $countryCurrency) { ?>
                                                                        <option value="<?= $countryCurrency->currency ?>" <?= $documentData->currency == $countryCurrency->currency ? 'selected' : ''; ?>><?= $countryCurrency->currency ?></option>
                                                                    <?php } ?>

                                                                </select>
                                                                <!-- <input type="text" name="currency" class="requiredClass" Placeholder="currency" value="<?= $documentData->currency ?>"> -->
                                                            </div>
                                                        </td>
                                                        <td class="text-right"><span class="final-total"><?= ceil($documentData->invoice_amount) ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7">
                                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>

                                                </tfoot>

                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4"><label>Total Invoice Amount (In words)</label>
                                            <textarea name="other_details[amount_in_words]" readonly id="amountInWords" class="form-control" rows="2" style="resize: none;"><?= $other_details->amount_in_words ?></textarea>
                                            <!-- <input type="text" class="form-control" name="other_details[amount_in_words]" id="amountInWords" value="<?= $other_details->amount_in_words ?>"> -->
                                            <!-- <span id="totalAmountInWords"><?= getAmountInWords($documentData->invoice_amount) ?></span> -->
                                        </td>
                                        <!-- <td colspan="2">
                                            <label >Payment Term:</label>
                                            <div class="editable-block">
                                                <input type="text" class="form-control requiredClass" name="other_details[payment_term]" value="<?= $other_details->payment_term ?>">
                                            </div>
                                        </td> -->
                                    </tr>

                                    <tr>
                                        <td colspan="3">
                                            <p>Export Shipment under LUT No: <span><?= $other_details->lut_no ?></span> &nbsp;&nbsp;&nbsp; LUT Valid till <input type="text" value="<?= $other_details->export_under_lut_no_valid_date ?>" class="date-picker form-control" style="width:200px;display:inline" name="other_details[export_under_lut_no_valid_date]" maxlength="15">&nbsp;&nbsp;&nbsp; GST No.: <span><?= $other_details->gst_no ?></span> </p>
                                            <input type="hidden" class="form-control" style="width:200px;display:inline" value="<?= $other_details->lut_no ?>" name="other_details[lut_no]" maxlength="40">
                                            <input type="hidden" value="<?= $other_details->gst_no ?>" class="form-control" style="width:200px;display:inline" name="other_details[gst_no]" maxlength="40">
                                            <br>
                                            <p><label>Shipping Marks</label></p><br>
                                            
                                            <p><label style="min-width: 100px;">From:</label> <input type="text" class="form-control" style="display: inline; width:400px;" name="other_details[shipping_marks_from]" value="<?= $other_details->shipping_marks_from ?>"></p><br>
                                            <p><label style="min-width: 100px;">To:</label>  <input type="text" class="form-control" style="display: inline; width:400px;" name="other_details[shipping_marks_to]" value="<?= $other_details->shipping_marks_to ?>"></p><br>

                                            <p><label style="min-width: 100px;">Package No.</label> <input type="text" id="shipping_marks_package_no" value="<?= $other_details->shipping_marks_package_no ?>" class="form-control requiredClass" style="width:400px;display:inline" name="other_details[shipping_marks_package_no]" maxlength="100">

                                            </p><br>
                                            <p><label style="min-width: 100px;">Weight:</label> <input type="text" value="<?= $other_details->shipping_marks_weight ?>" class="form-control requiredClass" style="width:400px;display:inline" name="other_details[shipping_marks_weight]" maxlength="60"></p>

                                        </td>
                                        <td colspan="1">
                                            <label>Bank Details:</label>
                                            <p style="margin-bottom:10px;"><label style="font-size: 12px;">Bank Name:</label><input type="text" name="other_details[bank_name]" class="form-control requiredClass" style="display: inline;" maxlength="30" value="<?= $other_details->bank_name ?>"></p>
                                            <p style="margin-bottom:10px;"><label style="font-size: 12px;">Account Number:</label><input type="text" name="other_details[account_number]" class="form-control requiredClass" style="display: inline;" maxlength="30" value="<?= $other_details->account_number ?>"></p>
                                            <p style="margin-bottom:10px;"><label style="font-size: 12px;">IFSC Code:</label><input type="text" name="other_details[ifsc_code]" class="form-control requiredClass" style="display: inline;" maxlength="30" value="<?= $other_details->ifsc_code ?>"></p>
                                            <p style="margin-bottom:10px;"><label style="font-size: 12px;">SWIFT Code/IBAN:</label><input type="text" name="other_details[swift_code]" class="form-control requiredClass" style="display: inline;" maxlength="30" value="<?= $other_details->swift_code ?>"></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <div class="editable-textarea">
                                                <textarea cols="30" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="10" name="other_details[declaration]"><?= $other_details->declaration ?></textarea>
                                            </div>

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
                            <center>
                                <input type="submit" value="Save" name="submitBtn" class="btn btn-success">
                                <!-- <input type="submit" value="Create Document" name="submitBtn" id="createDocumentBtn" class="btn btn-success"> -->
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
                <td class="sr-no text-right">

                    <!-- <input type="text" class="requiredClass" maxlength="30" name="items[{uid}][product]"> -->
                </td>
                <td><input type="text" class="requiredClass" maxlength="50" name="items[{uid}][description]"></td>
                <td><input type="text" maxlength="10" class="only-numbers requiredClass text-center" name="items[{uid}][hs_code]"></td>
                <td><input type="text" class="decimal-numbers qty requiredClass" maxlength="12" name="items[{uid}][qty]" placeholder="0.00"></td>
                <td>
                    <select name="items[{uid}][unit]" id="">
                        <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                            <option value="<?= $unitCode ?>"><?= $unitValue ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input type="text" class="decimal-numbers price requiredClass" maxlength="12" name="items[{uid}][price]" placeholder="0.00"></td>
                <td>
                    <input type="text" class="decimal-numbers total-amount requiredClass" name="items[{uid}][total_amount]" readonly maxlength="12" placeholder="0.00">
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

<script>
    const uid = function() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }
    $(document).ready(function() {

        $(document).on('blur', 'input.qty,input.price', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            var categoryTotal = 0;
            var charges = parseFloat(tr.find('input.price').val()) || 0.0;
            var qty = parseFloat(tr.find('input.qty').val()) || 0.0;
            var total = Math.ceil(charges * qty);
            tr.find('input.total-amount').val(total);
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

        $(tableId + ' tbody tr').each(function() {
            let item_row = $(this);
            let qty = parseFloat($(item_row).find('input.qty').val()) || 0.0
            let charges = parseFloat($(item_row).find('input.price').val()) || 0.0
            console.log('qty:' + qty + ' charges:' + charges);
            finalTotal += Math.ceil(charges * qty)
            totalQty += qty
        });

        $(tableId + ' tfoot tr span.total-qty').text(totalQty.toFixed(2));
        $(tableId + ' tfoot tr span.final-total').text(Math.ceil(finalTotal));

        $('#amountInWords').val(amountInWords(finalTotal, $('#selectCurrency').val()));

    }

    $('#selectCurrency').change(function() {
        var tableid = '#' + $(this).closest('table').attr('id');
        let finalTotal = parseFloat($(tableid + ' tfoot tr span.final-total').text()) || 0.0;

        $('#amountInWords').val(amountInWords(finalTotal, $('#selectCurrency').val()));
    });

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

    // $('#invoice_number').change(function(){
    //     var inoiceNumber = $(this).val();
    //     var shipping_marks_package_no ='';
    //     var total_package_count = $('#total_package_count').val();
    //     shipping_marks_package_no = inoiceNumber+" 1/"+total_package_count+" to "+inoiceNumber+" "+total_package_count+"/"+total_package_count;
    //     $('#shipping_marks_package_no').val(shipping_marks_package_no);
    // });
</script>
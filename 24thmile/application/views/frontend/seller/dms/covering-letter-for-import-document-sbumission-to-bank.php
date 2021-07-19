<style>
    

    table.table tbody tr th {
        text-align: center;
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
        margin-right: 10px;
    }

    div.editable {
        display: inline-block;
        padding: 2px 0;
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

    div.editable-textarea {
        display: block;
    }

    div.editable-textarea textarea {

        resize: none;
        width: 100%;
    }

    table.table.no-border td,
    table.table.no-border {
        border: none;
    }

    table.table.items-table tr td {
        padding: 0;
    }

    /* table.table.items-table tr {
        position: relative;
    } */

    /* table.table.items-table tr a.delete-row-btn {
        display: none;
    }

    table.table.items-table tr:hover a.delete-row-btn {
        position: absolute;
        display: block;
        right: -25px;
        top: 0;
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
                        $container_list = $other_details->container_list;
                        // print_r($documentData);
                        // die;
                        ?>
                        
                        <center>
                            <h3 class="heading3-border">Document Submission to Bank</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">

                            <div>Date: <div class="editable">
                                <input type="text" class="date-picker form-control requiredClass" name="other_details[document_date]" value="<?= printFormatedDate($other_details->document_date) ?>" maxlength="15"></div>
                            </div><br>

                            <div>The Branch Manager,</div>
                            <div class="col-lg-4"><input type="text"  maxlength="50" placeholder="Name of Bank" class="form-control requiredClass" name="other_details[name_of_bank]" value="<?= $other_details->name_of_bank ?>"></div>
                            <div class="col-lg-4"><input type="text" maxlength="50" placeholder="Name of Branch" class="form-control requiredClass" name="other_details[branch_name]" value="<?= $other_details->branch_name ?>"></div>
                            <div class="col-lg-4"><input type="text" maxlength="50" placeholder="Place" class="form-control requiredClass" name="other_details[branch_place]" value="<?= $other_details->branch_place ?>"></div>

                            <br>
                            <div class="row">
                                    <div class="col-lg-2 text-right">
                                        <label for="">Subject:</label>
                                    </div>
                                    <div class="col-lg-10">
                                    <input type="text" maxlength="200" class="col-lg-10" name="other_details[subject]" value="<?=$other_details->subject?>">
                                    </div>
                                </div>
                            <div>Dear Madam/Sir,</div><br>
                            <div>We hereby submit the below listed Bills of Entry (as applicable * ) in respect of our below detailed import remittances for necessary action at your end.</div><br>

                            <div>Please acknowledge receipt on the duplicate hereof.</div><br>
                            <div>A) Details of Self attested Bill of Entries enclosed</div>
                            <table id="itemstable" class="table table-bordered items-table" style="margin-top: 15px;">
                                <thead>
                                    <th>Sr.No.</th>
                                    <th>Bank Bill reference number</th>
                                    <th>BoE Number</th>
                                    <th>BoE Dated</th>
                                    <th>Currency</th>
                                    <th>Total Amount to be endorsed</th>
                                    <th>Balance amount available</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <?php if (!empty($items)) { ?>
                                        <?php foreach ($items as $key => $item) { ?>
                                            <tr>
                                                <td class="sr-no  text-center"></td>
                                                <td><input type="text" maxlength="30" class="form-control requiredClass" name="items[<?= $key ?>][reference_no]" value="<?= $item->reference_no ?>"></td>
                                                <td><input type="text" maxlength="20" class="form-control requiredClass" name="items[<?= $key ?>][boe_no]" value="<?= $item->boe_no ?>"></td>
                                                <td><input type="text" maxlength="15" class="date-picker form-control requiredClass" name="items[<?= $key ?>][boe_date]" value="<?= printFormatedDate($item->boe_date) ?>"></td>
                                                <td><input type="text" maxlength="15" class="form-control" name="items[<?= $key ?>][currency]" value="<?= $item->currency ?>"></td>
                                                <td><input type="text" maxlength="30" class="decimal-numbers form-control" name="items[<?= $key ?>][total_amt]" value="<?= $item->total_amt ?>"></td>
                                                <td>
                                                    <input type="text" maxlength="30" class="decimal-numbers form-control" name="items[<?= $key ?>][balance_amt]" value="<?= $item->balance_amt ?>">
                                                    
                                                </td>
                                                <td><a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-left" colspan="8">
                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i>Add New Line</a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>



                            <br>
                            <div>B) Details of Bill of Entry issued on or after 01st December 2016</div>
                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">
                                </colgroup>
                                <tbody>

                                    <tr>
                                        <td><label>Customer Name</label></td>
                                        <td><input type="text" maxlength="10" class="form-control requiredClass" name="other_details[customer_name]" value="<?= $other_details->customer_name ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Import Export Code</label></td>
                                        <td><input type="text" maxlength="10" class="form-control requiredClass" name="other_details[customer_name]" value="<?= $other_details->customer_name ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Authorised Dealer Code</label></td>
                                        <td><input type="text" maxlength="10" class="form-control requiredClass" name="other_details[customer_name]" value="<?= $other_details->customer_name ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Bill Of Entry No.</label></td>
                                        <td><input type="text" maxlength="10" class="form-control requiredClass" name="other_details[customer_name]" value="<?= $other_details->customer_name ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Bill Of Entry Date</label></td>
                                        <td><input type="text" class="date-picker form-control requiredClass" name="other_details[boe_date]" value="<?= printFormatedDate($other_details->boe_date) ?>" maxlength="15"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Bill Of Entry Amount</label></td>
                                        <td><input type="text" maxlength="10" class="form-control requiredClass" name="other_details[boe_amount]" value="<?= $other_details->boe_amount ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Currency</label></td>
                                        <td><input type="text" maxlength="10" class="form-control requiredClass" name="other_details[currency]" value="<?= $other_details->currency ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Free On Board value</label></td>
                                        <td><input type="text" maxlength="10" class="form-control requiredClass" name="other_details[fob_value]" value="<?= $other_details->fob_value ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Port Code</label></td>
                                        <td><input type="text" maxlength="10" class="form-control requiredClass" name="other_details[port_code]" value="<?= $other_details->port_code ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Harmonized System (H.S.) Code</label></td>
                                        <td><input type="text" maxlength="10" class="form-control requiredClass" name="other_details[hsn_no]" value="<?= $other_details->hsn_no ?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <div><u><strong>Reasons for difference in amounts/any other mismatch</strong></u></div>
                            <div>
                                <hr style="margin: 1.5rem 1rem 0 0;">
                            </div>
                            <div>
                                <hr style="margin: 1.5rem 1rem 0 0;">
                            </div>
                            <div>
                                <hr style="margin: 1.5rem 1rem 0 0;">
                            </div>
                            <div>
                                <hr style="margin: 1.5rem 1rem 0 0;">
                            </div>
                            <br>
                            <div class="editable-textarea"><textarea name="other_details[ec_copy]" placeholder="For EDI ports - original (EC Copy)where Bill of Entry is dated prior to 01st December" class="form-control requiredClass" rows="2"><?= $other_details->ec_copy ?></textarea></div>
                            <div class="editable-textarea"><textarea name="other_details[boe_details]" placeholder="For EDI ports - BOE details in case of Bill of Entry issued  on or after 01st December" class="form-control requiredClass" rows="2"><?= $other_details->boe_details ?></textarea></div>
                            <div class="editable-textarea"><textarea name="other_details[courier_bills]" placeholder="For manual ports or courier bill of Entries – Physical original EC copy to be submitted." class="form-control requiredClass" rows="2"><?= $other_details->courier_bills ?></textarea></div>

                            <!-- <div><textarea cols="30" rows="10"></textarea><u><strong>For EDI ports - original (EC Copy)where Bill of Entry is dated prior to 01st December 2016</strong></u></div> -->
                            <!-- <div><u><strong>For EDI ports - BOE details in case of Bill of Entry issued on or after 01st December 2016</u></strong></div> -->
                            <!-- <div><u><strong>For manual ports or courier bill of Entries – Physical original EC copy to be submitted.</u></strong></div> -->
                            <br>
                            <div>Strike out the portion (A or B) which is not applicable.</div>
                            <br><br>
                            <div>For <input type="text" name="other_details[exporter_company_name]" class="requiredClass" style="width: 40%" placeholder='Name of exporter/importers’s company' value="<?= $other_details->exporter_company_name ?>"></div>
                            <br><br>
                            <td>
                                <br />
                                <label style="min-width: 40px;">Authorized Person -</label>
                                <span>
                                    <input type="text" name="other_details[name_of_authorized_signatory]" class="requiredClass" style="width: 35%" placeholder='Name of authorized person' value="<?= $other_details->name_of_authorized_signatory ?>">
                                </span>
                            </td>
                            <td>
                                <br />
                                <label style="min-width: 115px;">Designation -</label>
                                <span>
                                    <input type="text" name="other_details[designation]" class="requiredClass" style="width: 35%" placeholder='designatio of person' value="<?= $other_details->designation ?>">
                                </span>
                            </td>

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
                <td class="sr-no text-center"></td>
                <td><input type="text" maxlength="30" class="form-control requiredClass" name="items[{uid}][reference_no]"></td>
                <td><input type="text" maxlength="20" class="form-control requiredClass" name="items[{uid}][boe_no]"></td>
                <td><input type="text" maxlength="15" id="date_picker_{uid}" class="date-picker form-control requiredClass" name="items[{uid}][boe_date]"></td>
                <td><input type="text" maxlength="30" class=" form-control" name="items[{uid}][currency]"></td>
                <td><input type="text" maxlength="30" class="decimal-numbers form-control" name="items[{uid}][total_amt]"></td>
                <td>
                    <input type="text" maxlength="30" class="decimal-numbers form-control" name="items[{uid}][balance_amt]">                 
                </td>
                <td><a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a></td>
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


    $('#selectCurrency').change(function() {
        // var tableid = '#' + $(this).closest('table').attr('id');
        let rem_currency = $('#remitted').val();
        $('#amountInWords').val(amountInWords(rem_currency, $('#selectCurrency').val()));
    });

    $('#remitted').blur(function() {
        // var tableid = '#' + $(this).closest('table').attr('id');
        let rem_currency = $('#remitted').val();
        $('#amountInWords').val(amountInWords(rem_currency, $('#selectCurrency').val()));
    });


    const uid = function() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }
    $(document).ready(function() {
        $(document).on('click', 'table.items-table a.delete-row-btn', function() {

            if (confirm("Are you sure you want to delete this line?")) {
                var tableId = '#' + $(this).closest('table').attr('id');
                $(this).closest('tr').remove();
                caculateFinaltotal(tableId);
            }
        });
        $(document).on('click', 'table.items-table tfoot tr a.add-new-line-btn', function() {
            var tableId = '#' + $(this).closest('table').attr('id');
            let var_uid = uid();
            $(tableId + ' tbody').append($('#item-table-row-template table tbody').html().replace(/{uid}/g, var_uid));
            $('#date_picker_'+var_uid).datetimepicker({
                format: 'd-M-Y',
                scrollInput: false,
                timepicker: false
            });
        });
    });
</script>
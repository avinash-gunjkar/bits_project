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

    table.table.items-table tr {
        position: relative;
    }

    table.table.items-table tr a.delete-row-btn {
        padding: 10px 0px 0px 0px;
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
                            $items = $documentData->items;
                        ?>
                        <center>
                            <!-- <h3 class="heading3-border">Marine Insurance Instructions</h3> -->
                            <h3 class="heading3-border">Post Shipment Covering Letter for Bank</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="30%">
                                    <col width="70%">

                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div><label for="" style="min-width: 100px;"> Date</label>
                                                <div class="editable">
                                                    <input type="text" name="other_details[date]" id="#date" class="date-picker form-control requiredClass" value="<?= $other_details->date ? $other_details->date : printFormatedDate(date('Y-m-d')) ?>">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div>
                                                <p>To,</p>
                                                <label for=""> The Manager,</label>
                                            </div>

                                            <div>
                                                <!-- <label style="min-width: 100px;">Name of bank</label> -->
                                                <div><input placeholder="Name of bank" type="text" style="min-width: 50%" name="other_details[name_of_bank]" value="<?= $other_details->name_of_bank ?>"></div>
                                            </div>
                                            <br/>
                                            <div>
                                                <!-- <label style="min-width: 100px;">Branch</label> -->
                                                <div><input type="text" placeholder="Branch" style="min-width: 50%" name="other_details[branch]" value="<?= $other_details->branch ?>"></div>
                                            </div>
                                            <br/>
                                            <div>
                                                <!-- <label style="min-width: 100px;">City</label> -->
                                                <div><input type="text" style="min-width: 50%;" placeholder="City" style="min-width: 50%" name="other_details[city]" value="<?= $other_details->city ?>"></div>
                                            </div>


                                            <!-- <div>
                                                <label for=""> Name of bank* </label>
                                            </div>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[name_of_bank]" class="form-control requiredClass" rows="2"><?= $other_details->name_of_bank ?></textarea>
                                            </div> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label for="">  Subject :</label>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name="other_details[subject]" class="form-control requiredClass" value=" <?= $other_details->subject ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>  Dear </span>
                                        </td>
                                        <td>
                                            <div>
                                                <select name="other_details[dear]" id="#dear" class="form-control requiredClass">
                                                    <option value="Madam/Sir ," <?= "Madam/Sir" == $other_details->dear ? ' selected ' : '' ?>> Madam/Sir ,</option>
                                                    <option value="Sir ," <?= "Sir" == $other_details->dear ? ' selected ' : '' ?>>Sir ,</option>
                                                    <option value="Madam ," <?= "Madam" == $other_details->dear ? ' selected ' : '' ?>>Madam ,</option>

                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <span>  We are enclosing herewith following documents to process Custom Clearance and Shipping documents: </span>
                                <table id="itemstable" class="table items-table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th style="width:50%">Document Name</th>
                                        <th>Original</th>
                                        <th>Copies</th>
                                        <th></th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php if (!empty($items)) { ?>
                                        <?php foreach ($items as $key => $item) { ?>
                                            <tr>
                                                <td class="sr-no text-center "></td>
                                                <td><input type="text" maxlength="50" style="text-align :left" class="form-control requiredClass" name="items[<?= $key ?>][document_name]" placeholder="Description..." value="<?= $item->document_name ?>"></td>
                                                <td><input type="number" maxlength="5" max="99999" min="0" style="text-align :center" class="form-control requiredClass" name="items[<?= $key ?>][document_original_count]" placeholder="Number" value="<?= $item->document_original_count ?>"></td>
                                                <td>
                                                    <input type="number" maxlength="5" max="99999" min="0" style="text-align :center" class="form-control requiredClass" name="items[<?= $key ?>][document_copies_count]" placeholder="Number" value="<?= $item->document_copies_count ?>">
                                                </td>
                                                <td class="text-center">
                                                    <a class=" delete-row-btn" title="Delete"><i class="fa fa-trash fa-lg "></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-left">
                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add new line</a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label> Bank details </label>
                                        </td>
                                        <td>
                                            <div><label style="min-width: 135px;">Name</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[bank_name]" id="#name" value="<?= $other_details->bank_name ?>"></div>
                                            </div>

                                            <div><label style="min-width: 135px;">Account Number:</label>
                                                <div class="editable"><input type="text" class="decimal-numbers form-control requiredClass" name="other_details[account_number]" id="#account_number" value="<?= $other_details->account_number ?>"></div>
                                            </div>
                                            <div><label style="min-width: 135px;">SWIFT:</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[swift_code]" id="#SWIFT" value="<?= $other_details->swift_code ?>"></div>
                                            </div>

                                            <div><label style="min-width: 135px;">IFSC code</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[ifsc_code]" id="#ifsc_code" value="<?= $other_details->ifsc_code ?>"></div>
                                            </div>
                                            <div><label style="min-width: 135px;">Contact and fax number</label>
                                                <div class="editable"><input type="text" class="decimal-numbers form-control requiredClass" name="other_details[contact_fax_no]" id="#contact_fax_no" value="<?= $other_details->contact_fax_no ?>"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div> Please acknowledge receipt and you are requested to Process e-BRC on First in First Out basis of Remittance. </div>
                                            <div><span>Thanking you. </span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div><span>Yours truly, </span></div>
                                            For <span><input type="text" style="min-width: 50%;" name="other_details[exporter_company_name]" value="<?= $other_details->exporter_company_name ?>"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">

                                            <br>
                                            <span><label style="min-width: 100px;">Authorized Person</label><input type="text" style="min-width: 42%;" name="other_details[name_of_authorized_signatory]" value="<?= $other_details->name_of_authorized_signatory ?>"></span>
                                            <br>
                                            <span><label style="min-width: 100px;">Designation </label> <input type="text" style="min-width: 42%; " name="other_details[designation]" value="<?= $other_details->designation ?>"></span>

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

                <td class="sr-no text-center"></td>
                <td><input type="text" style="text-align :left" class="form-control requiredClass" name="items[{uid}][document_name]" placeholder="Description..."></td>
                <td><input type="number" style="text-align :center" maxlength="5" max="99999" min="0" class="form-control requiredClass" name="items[{uid}][document_original_count]" placeholder="Number"></td>

                <td>
                    <input type="number" style="text-align :center" maxlength="5" max="99999" min="0" class="form-control requiredClass" name="items[{uid}][document_copies_count]" placeholder="Number">
                </td>
                <td class="text-center">
                    <a class=" delete-row-btn" title="Delete"><i class="fa fa-trash fa-lg "></i></a>
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
            $(tableId + ' tbody').append($('#item-table-row-template table tbody').html().replace(/{uid}/g, uid()));
        });

    });
</script>
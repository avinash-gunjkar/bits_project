<style>
    table.table tbody tr th {
        text-align: center;
        width: auto;
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
        width: 50%;
    }

    table.table.no-border td,
    table.table.no-border {
        border: none;
    }

    table.table.items-table tr td {
        padding: 0;
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
                            <h3 class="heading3-border">Marine Insurance Instructions</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="request_id" value="<?= $requestDetails->request_id ?>">
                            <td>
                                <label style="min-width: 50px;">Date</label>
                                <div class="editable">
                                    <input type="text" name="other_details[marins_date]" class="date-picker form-control " value="<?= $other_details->marins_date ? $other_details->marins_date : printFormatedDate(date('Y-m-d')) ?>">
                                </div>
                            </td>
                            <dev>
                                <br /><br /><label style="min-width: 50px;">To,</label><br>
                                <label style="min-width: 50px;">Branch Manager,</label>
                            </dev>
                            <p>
                            <div>
                                <input type="text" name="other_details[insurance_company]" class="requiredClass" style="width: 40%" maxlength="100" placeholder='Insurance Company Name' value="<?= $other_details->insurance_company ?>">
                            </div>
                            <div style="padding: 20px 0px">
                                <input type="text" maxlength="50" name="other_details[city]" class="requiredClass" style="width: 40%" placeholder='City Name' value="<?= $other_details->city ?>">
                            </div>
                            <div style="padding: 2px 0px">
                                <input type="text" maxlength="50" name="other_details[state]" class="requiredClass" style="width: 40%" placeholder='State' value="<?= $other_details->state ?>">
                            </div>
                            <div style="padding: 20px 0px">
                                <input type="text" maxlength="50" name="other_details[pin]" class="requiredClass" style="width: 40%" placeholder='Pin Code' value="<?= $other_details->pin ?>">
                            </div>
                            </P>
                            <td><label>Subject -</label>
                                <span>
                                    <input type="text" name="other_details[subject]" class="requiredClass" style="width: 94%" value="<?= $other_details->subject ? $other_details->subject : 'Application for All Risks Cover Marine Insurance Policy' ?>">

                                </span>
                            </td>
                            
                            <div style="padding: 20px 0px">
                                <label>Dear</label> 
                                <span>
                                <select name="other_details[mam_sir]" class="requiredClass">
                                                <option value="Madam/Sir ," <?= "Madam/Sir" == $other_details->mam_sir ? ' selected ' : '' ?>> Madam/Sir , </option>
                                                <option value="Sir ," <?= "Sir" == $other_details->mam_sir ? ' selected ' : '' ?>>Sir ,</option>
                                                <option value="Madam ," <?= "Madam" == $other_details->mam_sir ? ' selected ' : '' ?>>Madam ,</option>
		                                        </select>
                                </span>
                            </div>
                            <P>
                            <br />
                            We are enclosing herewith following documents to apply for All Risks Cover Marine Insurance Policy.<br />
                            <br />
                            <table id="itemstable" class="table items-table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th style="width:50%">Document Name</th>
                                        <th>Document Number and Date</th>
                                        <th>Original</th>
                                        <th>Copies</th>
                                        <th></th>
                                    </tr>

                                    <!-- <tr>
                                    <td>1.</td>
                                    <td style="text-align: left">Purchase Order Number and Date</td>
                                    <td><input name="other_details[orignal]" maxlength="5" class="only-numbers requiredClass" placeholder='Number' style="text-align :center" value="<?= $other_details->orignal ?>"></td>
                                    <td><input name="other_details[copies]" maxlength="5" class="only-numbers requiredClass" placeholder='number' style="text-align :center" value="<?= $other_details->copies ?>"></td>
                                    <td></td>
                                </tr>    
                                <tr>
                                    <td>2.</td>
                                    <td style="text-align: left">Invoice Number and Date</td>
                                    <td><input name="other_details[orignal1]" maxlength="5" name="orignal1" class="only-numbers requiredClass" placeholder='Number' style="text-align :center" value="<?= $other_details->orignal1 ?>"></td>
                                    <td><input name="other_details[copies1]" maxlength="5" class="only-numbers requiredClass" placeholder='number' style="text-align :center" value="<?= $other_details->copies1 ?>"></td>
                                    <td></td>
                                </tr> -->
                                </thead>
                                <tbody>
                                    <?php if (!empty($items)) { ?>
                                        <?php foreach ($items as $key => $item) { ?>
                                            <tr>
                                                <td class="sr-no text-center "></td>
                                                <td><input type="text" maxlength="50" style="text-align :left" class="form-control requiredClass" name="items[<?= $key ?>][document_name]" placeholder="Description..." value="<?= $item->document_name ?>"></td>
                                                <td><input type="text" maxlength="50" style="text-align :left" class="form-control requiredClass" name="items[<?= $key ?>][document_number_date]" placeholder="Number and Date of Document.." value="<?= $item->document_number_date ?>"></td>
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
                            We hope that all documents are in line. You are requested to proceed further.
                            <br />Thanking you.<br /><br />

                            Yours faithfully,
                            <br /><br /> For
                            <input type="text" name="other_details[exporter_company_name]" class="requiredClass" style="width: 40%" placeholder='Name of exporter/importers’s company' value="<?= $other_details->exporter_company_name ?>">
                            </p>
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
                            <br />
                            <br />

                            <center>
                                <input type="submit" value="Save" name="submitBtn" class="btn btn-success">
                                <!--input type="submit" value="Create Document" name="submitBtn" id="createDocumentBtn" class="btn btn-success">-->
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
                <td><input type="text" style="text-align :left" class="form-control" name="items[{uid}][document_number_date]" placeholder="Number and Date of Document..."></td>
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
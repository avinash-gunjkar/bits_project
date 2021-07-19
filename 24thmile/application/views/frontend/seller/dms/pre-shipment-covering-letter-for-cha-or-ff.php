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
                            <h3 class="heading3-border">Pre Shipment Covering Letter for CHA/FF</h3>
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
                                                    <!-- <?= printFormatedDate(date('Y-m-d')) ?>  -->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Kind attention: </label>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name="other_details[person]" class="form-control requiredClass" placeholder="Custom House Agent/ Freight Forwarder" value="<?= $other_details->person ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Name of the Company:</label>
                                        </td>
                                        <td>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[company]" placeholder="Custom House Agent/ Freight Forwarding Company Name" class="form-control requiredClass" rows="2"><?= $other_details->company ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Address :</label>
                                        </td>
                                        <td>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[address1]" class="form-control requiredClass" placeholder="Address Line1..." rows="2"><?= $other_details->address1 ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for=""></label>
                                        </td>
                                        <td>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[address2]" placeholder="Address Line2..." class="form-control requiredClass" rows="2"><?= $other_details->address2 ?></textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label for="">Subject :</label>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name="other_details[subject]" class="form-control requiredClass" value="<?= $other_details->subject ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <spam>Dear </spam>
                                        </td>
                                        <td>
                                            <div>
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
                                            <spam>  We are enclosing herewith following documents to process Custom Clearance and Shipping documents: </spam>
                                            <table id="itemstable" class="table items-table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Document Name</th>
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
                                                <td><input type="text" maxlength="50" style="text-align :left" class="form-control" name="items[<?= $key ?>][document_number_date]" placeholder="Number and Date of Document.." value="<?= $item->document_number_date ?>"></td>
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
                                        <td colspan="2">
                                            <div><span>We hope that all documents are in line. You are requested to proceed further. </span></div>
                                            <div><span>Thanking you. </span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div><span>Yours faithfully, </span></div>
                                            For <input type="text" name="other_details[exporter_company_name]" class="requiredClass" style="width: 40%" placeholder='Name of exporter/importers’s company' value="<?= $other_details->exporter_company_name ?>">
                                            <br><br>

                                            <!-- <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[authorized_person]" id="#name" value="<?= $other_details->authorized_person ?>"></div>
                                            <div><label style="min-width: 100px;">Authorized Person</label></div> -->

                                            <!-- <div class="editable">
                                                <label style="min-width: 100px;">Designation :  <input type="text" class="form-control requiredClass" name="other_details[designation]" id="#other_details[designation]" value="<?= $other_details->designation ?>">
                                            </label>
                                            </div> -->

                                            <p><label style="min-width: 127px;">Authorized Person:</label> <input type="text" value="<?= $other_details->name_of_authorized_signatory ?>"  style="min-width: 40%" name="other_details[name_of_authorized_signatory]" maxlength="60"></p>
                                            <br>
                                            <p><label style="min-width: 127px;">Designation:</label> <input type="text" value="<?= $other_details->designation ?>" style="min-width: 40%" name="other_details[designation]" maxlength="60"></p>

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
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
                        ?>
                        <center>
                            <h3 class="heading3-border">Import Clearance</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <div>Date: <div class="editable"><input type="text" class="date-picker form-control requiredClass" name="other_details[document_date]" value="<?= printFormatedDate($other_details->document_date) ?>" maxlength="15"></div>
                            </div>
                            <div style="padding: 2px 0px">Kind Attention: <input type="text" class="col-lg-3" maxlength="50" placeholder="Person Name" class="form-control requiredClass" name="other_details[person_name]" value="<?= $other_details->person_name ?>"></div>
                            <div style="padding: 2px 0px"><input type="text" class="col-lg-3" placeholder="Name of Company" maxlength="50" class="form-control requiredClass" name="other_details[company_name]" value="<?= $other_details->company_name ?>"></div>
                            <div style="padding: 2px 0px"><input type="text" class="col-lg-3" placeholder="Address Line 1" maxlength="50" class="form-control requiredClass" name="other_details[address_line1]" value="<?= $other_details->address_line1 ?>"></div>
                            <div style="padding: 2px 0px"><input type="text" class="col-lg-3" placeholder="Address Line 2" maxlength="50" class="form-control requiredClass" name="other_details[address_line2]" value="<?= $other_details->address_line2 ?>"></div><br><br>
                            
                            
                                <div class="row">
                                    <div class="col-lg-2 text-right">
                                        <label for="">Subject:</label>
                                    </div>
                                    <div class="col-lg-10">
                                    <input type="text" maxlength="200" class="col-lg-10" name="other_details[subject]" value="<?=$other_details->subject?>">
                                    </div>
                                </div>
                                
                            

                            <div>Dear Madam/Sir,</div><br>
                            <div>We are enclosing herewith following documents to process Custom Clearance and Shipping documents:</div><br>
                            <table id="itemstable" class="table items-table table-bordered">
                               <thead>
                               <tr>
                                        <th>Sr. No.</th>
                                        <th>Document Name</th>
                                        <th>Document Number and Date</th>
                                        <th ><label>Original</label></th>
                                        <th ><label>Copies</label></th>
                                        <th></th>
                                    </tr>
                               </thead>
                                <tbody>
                                   
                                    <?php if (!empty($items)) { ?>
                                        <?php foreach ($items as $key => $item) { ?>
                                            <tr>
                                                <td class="sr-no text-center; width:5% "></td>
                                                <td style="width:45%"><input type="text" maxlength="50" style="text-align :left" class="form-control requiredClass" name="items[<?= $key ?>][document_name]" placeholder="Description..." value="<?= $item->document_name ?>"></td>
                                                <td style="width:30%"><input type="text" maxlength="50" style="text-align :left" class="form-control" name="items[<?= $key ?>][document_number_date]" placeholder="Number and Date of Document.." value="<?= $item->document_number_date ?>"></td>
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
                            <div>We hope that all documents are in line. You are requested to proceed further.</div>
                            <div>Thanking you.</div><br><br>
                            <div>Yours faithfully,</div>
                            <div>For, <input type="text" class="col-lg-3" placeholder="Name of exporter’s company" class="form-control requiredClass" name="other_details[exporter_company_name]" value="<?= $other_details->exporter_company_name ?>"></div>
                            <br><br>
                            <div style="padding: 2px 0px"><input type="text" class="col-lg-3" placeholder="Authorized Person" class="form-control requiredClass" name="other_details[name_of_authorized_signatory]" value="<?= $other_details->name_of_authorized_signatory ?>"></div>
                            <div style="padding: 2px 0px"><input type="text" class="col-lg-3" placeholder="Designation" class="form-control requiredClass" name="other_details[designation]" value="<?= $other_details->designation ?>"></div>
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
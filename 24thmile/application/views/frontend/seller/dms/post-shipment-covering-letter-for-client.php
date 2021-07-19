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
        margin: 0 10px 0 0;
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

   
       form {
        font-size: 14px;
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
                            <h2 style="font-weight: bold;" class="heading3-border">Post Shipment Covering Letter For Client</h2>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                         <label  style="margin: 50px 20px 0 0;">Date</label>
                                <div class="editable">
                                    <input type="text" name="other_details[client_date]" class="date-picker form-control "  value="<?= $other_details->client_date? $other_details->client_date : printFormatedDate(date('Y-m-d')) ?>">
                                </div>
                                <div>
                                <label style="margin: 70px 5px 0 0">Kind Attention :- </label>
                           <input type="text" name="other_details[person_name]" class="requiredClass" style="width: 31%" maxlength="100" placeholder='Name Of Person....' value="<?= $other_details->person_name ?>">
                           <div/>
                           <div>
                           <input type="text" maxlength="50" name="other_details[designation1]" class="requiredClass" style="width: 40%; margin: 10px 0 0 0;" placeholder='Designaion....' value="<?= $other_details->designation1 ?>">
                         </div>
                         <div>
                           <input type="text" maxlength="50" name="other_details[consignee_company_name]" class="requiredClass" style="width: 40%; margin: 10px 0 0 0;" placeholder='Company Name....' value="<?= $other_details->consignee_company_name ?>">
                         </div> 
                         <div>
                           <input type="text" maxlength="50" name="other_details[consignee_address_line_1]" class="requiredClass" style="width: 40%; margin: 10px 0 0 0;" placeholder='Address Line1....' value="<?= $other_details->consignee_address_line_1 ?>">
                         </div> 
                         <div>
                           <input type="text" maxlength="50" name="other_details[consignee_address_line_2]" class="requiredClass" style="width: 40%; margin: 10px 0 0 0;" placeholder='Address Line2....' value="<?= $other_details->consignee_address_line_2 ?>">
                         </div>
                         <label >Subject -</label>
                                <span>
                                    <input type="text" name="other_details[subject]" class="requiredClass" style="width: 94%; margin: 10px 0 0 0;" value="<?=$other_details->subject? $other_details->subject: 'Post Shipments Documents for Import Clearance and Remittance Purpose.' ?>">
                                </span>
                                <P style="margin: 30px 0 0 0;">
                                <div>
                        Dear
                        <span>
                        <select name="other_details[mam_sir]"  style="width: 10%;" class="custom-selec">
                               <option value="Madam/Sir ," <?= "Madam/Sir" == $other_details->mam_sir ? ' selected ' : '' ?>> Madam/Sir , </option>
                                <option value="Sir ," <?= "Sir" == $other_details->mam_sir ? ' selected ' : '' ?>>Sir ,</option>
                                <option value="Madam ," <?= "Madam" == $other_details->mam_sir ? ' selected ' : '' ?>>Madam ,</option>
		                 </select>
                        </span>
                    </div>

                        <div style="margin: 20px 0 0 25px;">We are enclosing here with following documents for collection. </div>
                        <p/>

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
                        <p>
                        We hope that all documents are in line. You are requested to proceed further.
                        <br/>Thanking you.<br/><br/>
                        Yours faithfully,
                        <br/> For
                           <input type="text" name="other_details[exporter_company_name]" class="requiredClass" style="width: 40%" placeholder='Name of exporter/importers’s company' value="<?= $other_details->exporter_company_name ?>">
                        </p>
                        <label  style="min-width: 40px; margin: 20px 0 0 0;">Authorized Person -</label>
                                <span>
                                    <input type="text" name="other_details[name_of_authorized_signatory]" class="requiredClass" style="width: 35%; margin: " placeholder='Name of authorized person' value="<?= $other_details->name_of_authorized_signatory ?>" >
                                <br/></span>
                                <label  style="min-width: 131px; margin: 5px 0 0 0;">Designatio -</label>
                                <span>
                                    <input type="text" name="other_details[designation]" class="requiredClass" style="width: 35%" placeholder='designatio of person' value="<?= $other_details->designation ?>">
                                    </span>
                            <center style="margin: 20px 0 0 0;">
                                <input type="submit" value="Save" name="submitBtn" class="btn btn-success">
                                <!--input type="submit" value="Create Document" name="submitBtn" id="createDocumentBtn" class="btn btn-success"-->
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
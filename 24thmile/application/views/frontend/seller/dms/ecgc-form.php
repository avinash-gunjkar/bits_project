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
                            <!-- <h3 class="heading3-border">Marine Insurance Instructions</h3> -->
                            <h3 class="heading3-border">FORMAT - BASIC INFORMATION FROM MAJOR COMPANY</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">

                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">

                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label >1. Name of the Company:</label>
                                        </td>
                                        <td>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[company_name]" placeholder="Company Name..." class="form-control requiredClass" rows="2"><?= $other_details->company_name ?></textarea>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <label >2. City:</label>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name="other_details[city]" placeholder="City..." class="form-control requiredClass" value="<?= $other_details->city ?>">
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <label>3. Contact Person:</label>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name="other_details[contact_person]" placeholder="Contact Person Name..." class="form-control requiredClass" value="<?= $other_details->contact_person ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>4. Mobile Number:</label>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name="other_details[mobile_mumber]" placeholder="Mobile Number..." class="form-control requiredClass" value="<?= $other_details->mobile_mumber ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>5. E-mail address:</label>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="email" name="other_details[email]" class="form-control requiredClass" placeholder="Email ID.." value="<?= $other_details->email ?>">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <label >6. Details of Export turnover :</label>
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th class="fix-width-60">Name of the country</th>
                                                        <th class="fix-width-600">Total Value of export in last F Y (INR)</th>
                                                        <th class="fix-width-60">Value in Advance Payment (INR)</th>
                                                        <th class="fix-width-80">Value in LC term (INR)</th>
                                                        <th>Value in CAD/DP/TT terms (INR)</th>
                                                        <th>Value in DA or Open Account Term (INR)</th>
                                                        <th>Maximum outstanding expected at any one point of time (INR)</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items->export_turnover)) { ?>
                                                        <?php foreach ($items->export_turnover as $key => $tem) { ?>

                                                            <tr>
                                                                <td><input type="text" class="name_of_the_country requiredClass" name="items[export_turnover][<?= $key ?>][name_of_the_country]" value="<?= $tem->name_of_the_country ?>"></td>
                                                                <td><input type="text" class="decimal-numbers total_value requiredClass" name="items[export_turnover][<?= $key ?>][total_value]" value="<?= $tem->total_value ?>"></td>
                                                                <td><input type="text" class="decimal-numbers value_in_advance requiredClass" name="items[export_turnover][<?= $key ?>][value_in_advance]" value="<?= $tem->value_in_advance ?>"></td>
                                                                <td><input type="text" class="decimal-numbers value_in_lc requiredClass" name="items[export_turnover][<?= $key ?>][value_in_lc]" value="<?= $tem->value_in_lc ?>"></td>
                                                                <td><input type="text" class="decimal-numbers value_in_da requiredClass" name="items[export_turnover][<?= $key ?>][value_in_cad]" value="<?= $tem->value_in_cad ?>"></td>
                                                                <td><input type="text" class="decimal-numbers value_in_cad requiredClass" name="items[export_turnover][<?= $key ?>][value_in_da]" value="<?= $tem->value_in_da ?>"></td>
                                                                <td>
                                                                    <input type="text" class="decimal-numbers maximum_outstanding requiredClass" name="items[export_turnover][<?= $key ?>][maximum_outstanding]" readonly maxlength="12" value="<?= $tem->maximum_outstanding ?>">
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
                                                        <td colspan="10" class="text-left">
                                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>

                                                </tfoot>

                                            </table>
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <label >7. Details of Major 5 buyers: </label>

                                            <table id="itemstable2" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th class="fix-width-60">Name of the buyer and country</th>
                                                        <th class="fix-width-600">Total Value of export in last F Y (INR)</th>
                                                        <th class="fix-width-60">Value in Advance Payment (INR)</th>
                                                        <th class="fix-width-80">Value in LC term (INR)</th>
                                                        <th>Value in CAD/DP/TT terms (INR)</th>
                                                        <th>Value in DA or Open Account Term (INR)</th>
                                                        <th>Maximum outstanding expected at any one point of time (INR)</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items->buyers)) { ?>
                                                        <?php foreach ($items->buyers as $key => $tem) { ?>

                                                            <tr>
                                                                <td><input type="text" class="name_of_the_country requiredClass" name="items[buyers][<?= $key ?>][name_of_the_country]" value="<?= $tem->name_of_the_country ?>"></td>
                                                                <td><input type="text" class="decimal-numbers total_value requiredClass" name="items[buyers][<?= $key ?>][total_value]" value="<?= $tem->total_value ?>"></td>
                                                                <td><input type="text" class="decimal-numbers value_in_advance requiredClass" name="items[buyers][<?= $key ?>][value_in_advance]" value="<?= $tem->value_in_advance ?>"></td>
                                                                <td><input type="text" class="decimal-numbers value_in_lc requiredClass" name="items[buyers][<?= $key ?>][value_in_lc]" value="<?= $tem->value_in_lc ?>"></td>
                                                                <td><input type="text" class="decimal-numbers value_in_da requiredClass" name="items[buyers][<?= $key ?>][value_in_cad]" value="<?= $tem->value_in_cad ?>"></td>
                                                                <td><input type="text" class="decimal-numbers value_in_cad requiredClass" name="items[buyers][<?= $key ?>][value_in_da]" value="<?= $tem->value_in_da ?>"></td>
                                                                <td>
                                                                    <input type="text" class="decimal-numbers maximum_outstanding2 requiredClass" name="items[buyers][<?= $key ?>][maximum_outstanding]" readonly maxlength="12" value="<?= $tem->maximum_outstanding ?>">
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
                                                        <td colspan="10" class="text-left">
                                                            <a class="btn btn-sm text-primary add-new-line-btn2"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>

                                                </tfoot>

                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <label >8. Is there any overdue payment more than 30 days from the due date? If yes, please give details. (INR in Crore) </label>

                                            <table id="itemstable3" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th class="fix-width-60">Name of the buyer </th>
                                                        <th class="fix-width-600">Country</th>
                                                        <th class="fix-width-60">Value of overdue amount (INR)</th>
                                                        <th class="fix-width-80">Reason for non-payment by the buyer</th>
                                                        <th>Whether you desired to do further exports to the buyer</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items->overdue)) { ?>
                                                        <?php foreach ($items->overdue as $key => $tem) { ?>

                                                            <tr>
                                                                <td><input type="text" class="name_of_the_buyer requiredClass" name="items[overdue][<?= $key ?>][name_of_the_buyer]" value="<?= $tem->name_of_the_buyer ?>"></td>
                                                                <td><input type="text" class="country requiredClass" name="items[overdue][<?= $key ?>][country]" value="<?= $tem->country ?>"></td>
                                                                <td><input type="text" class="decimal-numbers value_of_overdue requiredClass" name="items[overdue][<?= $key ?>][value_of_overdue]" value="<?= $tem->value_of_overdue ?>"></td>
                                                                <td><input type="text" class="reason requiredClass" name="items[overdue][<?= $key ?>][reason]" value="<?= $tem->reason ?>"></td>
                                                                <td>
                                                                    <input type="text" class="further_exports requiredClass" name="items[overdue][<?= $key ?>][further_exports]" maxlength="12" value="<?= $tem->further_exports ?>">
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
                                                        <td colspan="10" class="text-left">
                                                            <a class="btn btn-sm text-primary add-new-line-btn3"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>

                                                </tfoot>

                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>9. Whether you have opted cover from any other credit insurance company? If yes, give name of the credit insurer: </label>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name="other_details[pre_carriage]" class="form-control requiredClass" value="<?= $other_details->pre_carriage ?>">
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <center>
                                <input type="submit" value="Save" name="submitBtn" class="btn btn-success">
                                <!--<input type="submit" value="Create Document" name="submitBtn" id="createDocumentBtn" class="btn btn-success">-->
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

<!-- name_of_the_country total_value value_in_advance value_in_lc value_in_cad value_in_da maximum_outstanding -->
<div id="item-table-row-template" style="display: none;">
    <table>
        <tbody>
            <tr>

                <td><input type="text" class="name_of_the_country requiredClass" name="items[export_turnover][{uid}][name_of_the_country]"></td>
                <td><input type="text" class="country requiredClass" name="items[export_turnover][{uid}][total_value]"></td>
                <td><input type="text" class="decimal-numbers value_in_advance requiredClass" name="items[export_turnover][{uid}][value_in_advance]"></td>
                <td><input type="text" class="decimal-numbers value_in_lc requiredClass" name="items[export_turnover][{uid}][value_in_lc]"></td>
                <td><input type="text" class="decimal-numbers value_in_cad requiredClass" name="items[export_turnover][{uid}][value_in_cad]"></td>
                <td><input type="text" class="decimal-numbers value_in_da requiredClass" name="items[export_turnover][{uid}][value_in_da]"></td>
                <td>
                    <input type="text" class="decimal-numbers decimal-numbers maximum_outstanding requiredClass" name="items[export_turnover][{uid}][maximum_outstanding]">
                </td>
                <td>
                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                </td>
            </tr>
        </tbody>
    </table>

</div>

<div id="item-table-row-template2" style="display: none;">
    <table>
        <tbody>
            <tr>

                <td><input type="text" class="name_of_the_country requiredClass" name="items[buyers][{uid}][name_of_the_country]"></td>
                <td><input type="text" class="decimal-numbers total_value requiredClass" name="items[buyers][{uid}][total_value]"></td>
                <td><input type="text" class="decimal-numbers value_in_advance requiredClass" name="items[buyers][{uid}][value_in_advance]"></td>
                <td><input type="text" class="decimal-numbers value_in_lc requiredClass" name="items[buyers][{uid}][value_in_lc]"></td>
                <td><input type="text" class="decimal-numbers value_in_cad requiredClass" name="items[buyers][{uid}][value_in_cad]"></td>
                <td><input type="text" class="decimal-numbers value_in_da requiredClass" name="items[buyers][{uid}][value_in_da]"></td>
                <td>
                    <input type="text" class="decimal-numbers maximum_outstanding requiredClass" name="items[buyers][{uid}][maximum_outstanding]">
                </td>
                <td>
                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                </td>
            </tr>
        </tbody>
    </table>

</div>

<div id="item-table-row-template3" style="display: none;">
    <table>
        <tbody>
            <tr>

                <td><input type="text" class="name_of_the_buyer requiredClass" name="items[overdue][{uid}][name_of_the_buyer]"></td>
                <td><input type="text" class="country requiredClass" name="items[overdue][{uid}][country]"></td>
                <td><input type="text" class="decimal-numbers value_of_overdue requiredClass" name="items[overdue][{uid}][value_of_overdue]"></td>
                <td><input type="text" class="reason requiredClass" name="items[overdue][{uid}][reason]"></td>
                <td>
                    <input type="text" class="further_exports requiredClass" name="items[overdue][{uid}][further_exports]">
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

        $(document).on('click', 'table.items-table tfoot tr a.add-new-line-btn2', function() {
            var tableId = '#' + $(this).closest('table').attr('id');
            $(tableId + ' tbody').append($('#item-table-row-template2 table tbody').html().replace(/{uid}/g, uid()));
        });

        $(document).on('click', 'table.items-table tfoot tr a.add-new-line-btn3', function() {
            var tableId = '#' + $(this).closest('table').attr('id');
            $(tableId + ' tbody').append($('#item-table-row-template3 table tbody').html().replace(/{uid}/g, uid()));
        });

    });
</script>
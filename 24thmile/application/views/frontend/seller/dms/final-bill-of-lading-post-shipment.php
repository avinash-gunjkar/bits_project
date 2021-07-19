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
        display: none;
    }

    table.table.items-table tr:hover a.delete-row-btn {
        position: absolute;
        display: block;
        right: -25px;
        top: 0;
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
                            <h3 class="heading3-border">Final Bill of Lading </h3>
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
                                        <td colspan="2" rowspan="2" class="text-left">
                                            <label >Shipper: </label>

                                            <div class="editable-textarea">
                                                <textarea name="other_details[shipper]" class="form-control wysihtml5-editor-no-controlls requiredClass" cols="40" rows="5" placeholder="Consignor Company Name, Address line 1, Address line 2, City, State, Country, Pin Code, Contact Person Name, Contact Number, Email"><?= $other_details->shipper ?></textarea>
                                            </div>
                                        </td>
                                        <td>
                                            <label  style="min-width: 100px;">Shipper's Reference:</label>
                                            <input type="text" name="other_details[shipper_reference]" value="<?= $other_details->shipper_reference ?>" class="form-control requiredClass">

                                        </td>
                                        <td rowspan="1">
                                            <label  style="min-width: 100px;">Bill of Lading Number: </label>

                                            <input type="text" name="other_details[bill_of_lading_number]" value="<?= $other_details->bill_of_lading_number ?>" class="form-control requiredClass">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label  style="min-width: 100px;">Carrier's Reference</label>
                                            <input type="text" name="other_details[carrier_reference]" value="<?= $other_details->carrier_reference ?>" class="form-control requiredClass">

                                        </td>
                                        <td >
                                            <label style="min-width: 100px;">Unique Consignment Reference</label>

                                            <div class="editable">
                                                <input type="text" name="other_details[unique_consignment_reference]" value="<?= $other_details->unique_consignment_reference ?>" class="form-control requiredClass">
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label >Consignee: </label>

                                            <div class="editable-textarea"><textarea name="other_details[consignee]" class="form-control wysihtml5-editor-no-controlls requiredClass" cols="40" rows="5" placeholder="Consignor Company Name, Address line 1, Address line 2, City, State, Country, Pin Code, Contact Person Name, Contact Number, Email"><?= $other_details->consignee ?></textarea></div>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <label >Carrier Name: </label>

                                            <div class="editable-textarea"><textarea name="other_details[carrier]" class="form-control wysihtml5-editor-no-controlls requiredClass" cols="40" rows="5" placeholder="Forwarder Company Name, Address line 1, Address line 2 City, State, Country, Pin Code, Contact Person Name, Contact Number, Email"><?= $other_details->carrier ?></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label >Notify Party (if other than Consignee): </label>
                                            <div class="editable-textarea"><textarea name="other_details[notify_party]" class="form-control wysihtml5-editor-no-controlls requiredClass " cols="40" rows="5" placeholder="Consignor Company Name, Address line 1, Address line 2, City, State, Country, Pin Code, Contact Person Name, Contact Number, Email"><?= $other_details->notify_party ?></textarea></div>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <label >Additional Party Notify: </label>

                                            <div class="editable-textarea"><textarea name="other_details[additional_notify_party]" class="form-control wysihtml5-editor-no-controlls requiredClass" cols="40" rows="5" placeholder="Consignee, Consignor Company Name, Address line 1, Address line 2, City, State, Country, Pin Code, Contact Person Name, Contact Number, Email"><?= $other_details->additional_notify_party ?></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="text-left">
                                            <label  style="min-width: 100px;">Pre-Carriage By</label>
                                            <!-- <input type="text" name="other_details[pre_carriage_by]" value="<?= $other_details->pre_carriage_by ?>" class="form-control requiredClass"> -->
                                            <select class="form-control " name="other_details[pre_carriage_by]">

                                                <?php foreach (getPrecarriageByList() as $carriage) { ?>
                                                    <option value="<?= $carriage ?>"><?= $carriage ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td  class="text-left">
                                            <label  style="min-width: 100px;">Place of Receipt</label>
                                            <input type="text" name="other_details[place_of_receipt]" value="<?= $other_details->place_of_receipt ?>" class="form-control requiredClass">

                                        </td>
                                        <td rowspan="2" colspan="2" class="text-left">
                                            <label  style="min-width: 100px;">Additional Information:</label><br>

                                            <div class="editable"><label >Shipping Bill Number: </label><input type="text" name="other_details[shipping_bill_no]" value="<?= $other_details->shipping_bill_no ?>" class="form-control requiredClass"></div>
                                            <div class="editable"><label >Invoice Number: </label><input type="text" name="other_details[invoice_number]" value="<?= $other_details->invoice_number ?>" class="form-control requiredClass"></div>
                                            <div class="editable"><label >Invoice Date: </label><input type="text" name="other_details[invoice_date]" value="<?= $other_details->invoice_date ?>" class="form-control date-picker requiredClass"></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="text-left">

                                            <label  style="min-width: 100px;">Vessel / Aircraft</label>
                                            <input type="text" name="other_details[vessel_aircraft]" value="<?= $other_details->vessel_aircraft ?>" class="form-control">

                                        </td>
                                        <td  class="text-left">
                                            <label  style="min-width: 100px;">Port of Loading</label>
                                            <input type="text" name="other_details[port_of_l]" value="<?= $other_details->port_of_l ?>" class="form-control requiredClass">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="text-left">
                                            <label >Port of Discharge</label>
                                            <input type="text" name="other_details[port_of_d]" value="<?= $other_details->port_of_d ?>" class="form-control requiredClass">

                                        </td>
                                        <td  class="text-left">
                                            <label  style="min-width: 100px;">Place of Delivery</label>
                                            <input type="text" name="other_details[place_of_delivery]" value="<?= $other_details->place_of_delivery ?>" class="form-control requiredClass">

                                        </td>
                                        <td  class="text-left">
                                            <label >Final Destination</label>
                                            <input type="text" name="other_details[final_destination]" value="<?= $other_details->final_destination ?>" class="form-control requiredClass">

                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th>Marks and Numbers</th>
                                                        <th>Kind & Number Packages</th>
                                                        <th style="width: 50%;">Description of Goods</th>
                                                        <th>Net Weight (kg)</th>
                                                        <th>Groos Weight (kg)</th>
                                                        <th>Measurements (m<sup>3</sup>)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) {
                                                        foreach ($items as $key => $item) { ?>
                                                            <tr>
                                                                <td>

                                                                    <input type="text" maxlength="30" class="requiredClass" name="items[<?= $key ?>][marks_and_numbers]" value="<?= $item->marks_and_numbers ?>">
                                                                </td>
                                                                <td><input type="text" class="decimal-numbers package_qty requiredClass" maxlength="15" name="items[<?= $key ?>][package_qty]" value="<?= $item->package_qty ?>"></td>
                                                                <td><input type="text" maxlength="50" class="requiredClass" name="items[<?= $key ?>][description]" value="<?= $item->description ?>"></td>
                                                                <td><input type="text" class="decimal-numbers net_wt requiredClass" maxlength="12" name="items[<?= $key ?>][net_wt]" placeholder="0.00" value="<?= $item->net_wt ?>"></td>
                                                                <td><input type="text" class="decimal-numbers gross_wt requiredClass" maxlength="12" name="items[<?= $key ?>][gross_wt]" placeholder="0.00" value="<?= $item->gross_wt ?>"></td>
                                                                <td>
                                                                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                                                                    <input type="text" class="decimal-numbers measurment requiredClass" name="items[<?= $key ?>][measurment]" maxlength="12" placeholder="0.00" value="<?= $item->measurment ?>">
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-left"><label >Consignment Total</label></td>
                                                        <td class="text-right">
                                                            <span class="total-net_wt"><?= $documentData->total_net_wt ?></span>
                                                        </td>
                                                        <td class="text-right">
                                                            <span class="total-gross_wt"><?= $documentData->total_gross_wt ?></span>
                                                        </td>
                                                        <td class="text-right">
                                                            <span class="total-measurment"><?= $documentData->total_measurment ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table id="itemstable2" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th>Container Number(s)</th>
                                                        <th>Seal Number(s)</th>
                                                        <th>Size / Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($container_list)) {
                                                        foreach ($container_list as $key2 => $container) { ?>
                                                            <tr>
                                                                <td>

                                                                    <input type="text" maxlength="50" class="requiredClass" name="other_details[container_list][<?= $key2 ?>][container_no]" value="<?= $container->container_no ?>">
                                                                </td>
                                                                <td><input type="text" class="requiredClass" maxlength="50" name="other_details[container_list][<?= $key2 ?>][number_of_packages]" value="<?= $container->number_of_packages ?>"></td>
                                                                <td>
                                                                    <input type="text" maxlength="50" class="requiredClass" name="other_details[container_list][<?= $key2 ?>][description]" value="<?= $container->description ?>">
                                                                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                                <tfoot>


                                                    <tr>
                                                        <td colspan="3">
                                                            <a class="btn btn-sm text-primary add-new-line-btn2"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>
                                                </tfoot>

                                            </table>

                                            <label >Total Number of Containers or other packages or units (in words)</label>
                                            <div class=""><input type="text" name="other_details[total_no_of_containers_words]" value="<?= $other_details->total_no_of_containers_words ?>" class="form-control requiredClass"></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <label >Number of original Bills of Lading</label>
                                                        <input type="number" name="other_details[no_of_original_bill_of_lading]" value="<?= $other_details->no_of_original_bill_of_lading ?>" min="1" max="10" maxlength="2" class="form-control only-numbers requiredClass">
                                                    </td>
                                                    <td>
                                                        <label >IncoTerms</label>
                                                        <input type="text" name="other_details[incoterms]" value="<?= $other_details->incoterms ?>" maxlength="30" class="form-control requiredClass">
                                                    </td>
                                                    <td>
                                                        <label >Payable at</label>
                                                        <input type="text" name="other_details[payable_at]" value="<?= $other_details->payable_at ?>" maxlength="100" class="form-control requiredClass">
                                                    </td>
                                                    <td>
                                                        <label >Frieght Charges</label>
                                                        <input type="text" name="other_details[freight_charges]" value="<?= $other_details->freight_charges ?>" maxlength="30" class="form-control requiredClass">
                                                    </td>
                                                    <td>
                                                        <label >Shipped on Board Date</label>
                                                        <input type="text" name="other_details[shipped_on_board_date]" value="<?= $other_details->shipped_on_board_date ?>" maxlength="15" class="form-control date-picker requiredClass">
                                                    </td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label >Terms & Conditions</label>
                                            <div class="editable-textarea"><textarea name="other_details[terms_and_conditions]" class="form-control" cols="40" rows="12" placeholder=""><?= $other_details->terms_and_conditions ?></textarea></div>
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
                <td>

                    <input type="text" maxlength="30" class="requiredClass" name="items[{uid}][marks_and_numbers]">
                </td>
                <td><input type="text" class="decimal-numbers package_qty requiredClass" maxlength="15" name="items[{uid}][package_qty]"></td>
                <td><input type="text" class="requiredClass" maxlength="50" name="items[{uid}][description]"></td>
                <td><input type="text" class="decimal-numbers net_wt requiredClass" maxlength="12" name="items[{uid}][net_wt]" placeholder="0.00"></td>
                <td><input type="text" class="decimal-numbers gross_wt requiredClass" maxlength="12" name="items[{uid}][gross_wt]" placeholder="0.00"></td>
                <td>
                    <input type="text" class="decimal-numbers measurment requiredClass" name="items[{uid}][measurment]" maxlength="12" placeholder="0.00">
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
                <td>

                    <input type="text" maxlength="50" class="requiredClass" name="other_details[container_list][{uid}][container_no]">
                </td>
                <td><input type="text" class="requiredClass" maxlength="50" name="other_details[container_list][{uid}][number_of_packages]"></td>
                <td>
                    <input type="text" maxlength="50" class="requiredClass" name="other_details[container_list][{uid}][description]">
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

        // Start: Calculate total package qty
        $(document).on('blur', 'input.package_qty', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            var totalPackage_qty = 0;
            $(tableId + ' tbody tr input.package_qty').each(function() {

                let qty = parseFloat($(this).val()) || 0.0

                totalPackage_qty += qty
            });

            $(tableId + ' tfoot tr span.total-package_qty').text(totalPackage_qty.toFixed(2));
        });
        // End: Calculate total package qty

        // Start: Calculate total net_wt 
        $(document).on('blur', 'input.net_wt', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            var totalNet_wt = 0;
            $(tableId + ' tbody tr ').each(function() {
                var tr = $(this);
                // var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
                var net_wt_per_pk = parseFloat(tr.find('input.net_wt').val()) || 0.0;
                totalNet_wt += net_wt_per_pk;


            });

            $(tableId + ' tfoot tr span.total-net_wt').text(totalNet_wt.toFixed(2));
        });
        // End: Calculate total net_wt 

        // Start: Calculate total gross_wt 
        $(document).on('blur', 'input.gross_wt', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            var totalGross_wt = 0;
            $(tableId + ' tbody tr ').each(function() {
                var tr = $(this);
                //  var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
                var gross_wt_per_pk = parseFloat(tr.find('input.gross_wt').val()) || 0.0;
                totalGross_wt += gross_wt_per_pk;


            });

            $(tableId + ' tfoot tr span.total-gross_wt').text(totalGross_wt.toFixed(2));
        });
        // End: Calculate total gross_wt 

        // Start: Calculate total measurment 
        $(document).on('blur', 'input.measurment', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            var totalMeasurment = 0;
            $(tableId + ' tbody tr ').each(function() {
                var tr = $(this);
                //  var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
                var measurment = parseFloat(tr.find('input.measurment').val()) || 0.0;
                totalMeasurment += measurment;


            });

            $(tableId + ' tfoot tr span.total-measurment').text(totalMeasurment.toFixed(2));
        });
        // End: Calculate total measurment 

        $(document).on('click', 'table.items-table a.delete-row-btn', function() {

            if (confirm("Are you sure you want to delete this line?")) {
                var tableId = '#' + $(this).closest('table').attr('id');
                $(this).closest('tr').remove();
                // caculateFinaltotal(tableId);
                if ($(tableId + ' input.net_wt').length) {

                    $(tableId + ' input.net_wt, ' + tableId + ' input.gross_wt, ' + tableId + ' input.measurment').trigger('blur');
                } else {
                    $(tableId + ' tfoot tr span.total-net_wt').text('0.00');
                    $(tableId + ' tfoot tr span.total-gross_wt').text('0.00');
                    $(tableId + ' tfoot tr span.total-measurment').text('0.00');
                }

            }
        });
        $(document).on('click', 'table.items-table tfoot tr a.add-new-line-btn', function() {
            var tableId = '#' + $(this).closest('table').attr('id');
            $(tableId + ' tbody').append($('#item-table-row-template table tbody').html().replace(/{uid}/g, uid()));
        });

        //start::container list table
        $(document).on('click', 'table.items-table tfoot tr a.add-new-line-btn2', function() {
            var tableId = '#' + $(this).closest('table').attr('id');
            $(tableId + ' tbody').append($('#item-table-row-template2 table tbody').html().replace(/{uid}/g, uid()));
        });
        //end::container list table
    });

    function caculateFinaltotal(tableId) {
        var finalTotal = 0;
        var totalQty = 0;

        $(tableId + ' tbody tr').each(function() {
            let item_row = $(this);
            let qty = parseFloat($(item_row).find('input.qty').val()) || 0.0
            let charges = parseFloat($(item_row).find('input.price').val()) || 0.0
            console.log('qty:' + qty + ' charges:' + charges);
            finalTotal += (charges * qty)
            totalQty += qty
        });
        $(tableId + ' tfoot tr span.total-qty').text(totalQty.toFixed(2));
        $(tableId + ' tfoot tr span.final-total').text(finalTotal.toFixed(2));
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
</script>
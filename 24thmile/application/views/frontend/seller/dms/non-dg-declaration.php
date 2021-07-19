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

    table tr td,
    table tr th {
        vertical-align: top;
        padding: 5px;
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

    table.table.no-border td,
    table.table.no-border {
        border: none;
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
                            <h3 class="heading3-border">Non-DG Declaration</h3>
                        </center>

                        <?= $this->session->flashdata('message') ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">

                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td><label for="" style="min-width: 100px;">Exporter</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[exporter]" class="form-control wysihtml5-editor-no-controlls" rows="5"><?= $other_details->exporter ?></textarea>
                                            </div>
                                        </td>
                                        <td>
                                            <div><label for="" style="min-width: 100px;">Bill of Lading/ Air waybill No.</label>
                                                <div class="editable"><input class="form-control" type="text" name="other_details[bol_awb_no]" id="#bol_awb_no" value="<?= $other_details->bol_awb_no ?>"></div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">Invoice No.</label>
                                                <div class="editable">
                                                    <input type="text" class="form-control" name="other_details[invoice_number]" id="#shippers_reff_no" value="<?= $other_details->invoice_number ?>">
                                                </div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">Export Date</label>
                                                <div class="editable">
                                                    <input type="text" name="other_details[invoice_date]" id="invoice_date" class="date-picker form-control" value="<?= printFormatedDate($other_details->invoice_date) ?>">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><label for="" style="min-width: 100px;">Consignee</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[consignee]" class="form-control wysihtml5-editor-no-controlls" rows="5"><?= $other_details->consignee ?></textarea>
                                            </div>
                                        </td>
                                        <td rowspan="2">
                                            <div class="editable-textarea">
                                                <textarea name="other_details[text1]" class="form-control wysihtml5-editor-no-controlls" rows="8"><?= $other_details->text1 ?></textarea>
                                            </div>
                                            <!-- <label for="" style="min-width: 100px;">Warning:</label> <br>
                                        <div class="editable-textarea">
                                            <textarea name="other_details[text2]" class="form-control" rows="2"><?= $other_details->text2 ?></textarea>
                                        </div> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="" style="min-width: 100px;">Transport Details</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[transport_details]" class="form-control wysihtml5-editor-no-controlls" rows="2"><?= $other_details->transport_details ?></textarea>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="" style="min-width: 150px;max-width:200px;">Airport of Destination:</label>
                                            <div class="editable">
                                                <input class="form-control" type="text" name="other_details[airport_of_destination]" id="" value="<?= $other_details->airport_of_destination ?>">
                                            </div><br>

                                            <label for="" style="min-width: 150px;max-width:200px;">Port of Discharge</label>
                                            <div class="editable">
                                                <input class="form-control" type="text" name="other_details[port_of_d]" id="" value="<?= $other_details->port_of_d ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <label for="" style="min-width: 150px;max-width:200px;">Airport of Depatrue:</label>
                                            <div class="editable">
                                                <input class="form-control" type="text" name="other_details[airport_of_departure]" id="" value="<?= $other_details->airport_of_departure ?>">
                                            </div><br>
                                            <label for="" style="min-width: 150px;max-width:200px;">Port of Loading</label>
                                            <div class="editable">
                                                <input class="form-control" type="text" name="other_details[port_of_l]" id="" value="<?= $other_details->port_of_l ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="editable-textarea">
                                                <textarea name="other_details[text3]" class="form-control wysihtml5-editor-no-controlls" rows="4"><?= $other_details->text3 ?></textarea>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="2">
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th>Kind & No of Packages</th>
                                                        <th style="width: 50%;">Product name</th>
                                                        <th>HS Code</th>
                                                        <th>Gross Weight (Kg)</th>
                                                        <th>Net Wteight. (kg)</th>
                                                        <th>Invoice Number</th>
                                                        <th>Date of Invoice</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php if (!empty($items)) { ?>
                                                        <?php foreach ($items as $key => $tem) { ?>
                                                            <tr>
                                                                <td>

                                                                    <input type="text" class="form-control" maxlength="30" name="items[<?= $key ?>][kind_of_packages]" value="<?= $tem->kind_of_packages ?>">
                                                                </td>
                                                                <td><input type="text" class="form-control" maxlength="50" name="items[<?= $key ?>][product_name]" value="<?= $tem->product_name ?>"></td>
                                                                <td><input type="text" maxlength="8" class="only-numbers" name="items[<?= $key ?>][hs_code]" value="<?= $tem->hs_code ?>"></td>
                                                                <td><input type="text" class="form-control decimal-numbers gross_wt_per_pk" maxlength="12" name="items[<?= $key ?>][gross_wt]" placeholder="0.00" value="<?= $tem->gross_wt ?>"></td>
                                                                <td><input type="text" class="form-control decimal-numbers net_wt_per_pk" maxlength="12" name="items[<?= $key ?>][net_wt]" placeholder="0.00" value="<?= $tem->net_wt ?>"></td>
                                                                <td><input type="text" maxlength="8" class="only-numbers" name="items[<?= $key ?>][invoice_no]" value="<?= $tem->invoice_no ?>"></td>
                                                                <td><input type="text" class="date-picker form-control invoice_date" name="items[<?= $key ?>][invoice_date]" value="<?= $tem->invoice_date ?>">
                                                                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td class="text-right"><span class="total-package_qty"></span></td>
                                                        <td>Declaration Total</td>
                                                        <td class="text-right"></td>
                                                        <td class="text-right"><span class="total-gross_wt_per_pk"><?= $documentData->total_gross_wt ?></span></td>
                                                        <td class="text-right"><span class="total-net_wt_per_pk"><?= $documentData->total_net_wt ?></span></td>
                                                        <td class="text-right"></td>
                                                        <td class="text-right"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="9">
                                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td colspan="2"><label for="" style="min-width: 100px;">Additional Handling Information:</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[handeling_info]" class="form-control wysihtml5-editor-no-controlls" rows="2"><?= $other_details->handeling_info ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <center><b>24 hr. Emergency Contact No. +91 77090 65277</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><label for="" style="min-width: 100px;">Declaration:</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[declaration]" class="form-control wysihtml5-editor-no-controlls" rows="10"><?= $other_details->declaration ?></textarea>
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
                                    <!-- <tr>
                                        <td colspan="2">
                                            <p class="text-center"><?= $consignor->company_name ?> <?= $consignor->address_line_1 ?> <?= $consignor->address_line_2 ?> <?= $consignor->city_name ?> Pincode: <?= $consignor->pincode ?> <br> Contact Person: <?= $consignor->contact_name ?> Email: <?= $consignor->contact_email ?> Phone: <?= $consignor->contact_phone ?> </p>
                                            <input type="hidden" name="other_details[consignor][company_name]" value="<?= $consignor->company_name ?>">
                                            <input type="hidden" name="other_details[consignor][address_line_1]" value="<?= $consignor->address_line_1 ?>">
                                            <input type="hidden" name="other_details[consignor][address_line_2]" value="<?= $consignor->address_line_2 ?>">
                                            <input type="hidden" name="other_details[consignor][city_name]" value="<?= $consignor->city_name ?>">
                                            <input type="hidden" name="other_details[consignor][pincode]" value="<?= $consignor->pincode ?>">
                                            <input type="hidden" name="other_details[consignor][contact_name]" value="<?= $consignor->contact_name ?>">
                                            <input type="hidden" name="other_details[consignor][contact_email]" value="<?= $consignor->contact_email ?>">
                                            <input type="hidden" name="other_details[consignor][contact_phone]" value="<?= $consignor->contact_phone ?>">
                                        </td>
                                    </tr> -->

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

                    <input type="text" class="form-control kind_of_packages" maxlength="30" name="items[{uid}][kind_of_packages]" value="">
                </td>
                <td><input class="form-control" type="text" maxlength="50" name="items[{uid}][product_name]" value=""></td>

                <td><input type="text" class="form-control only-numbers hs_code" maxlength="8" name="items[{uid}][hs_code]"></td>
                <td><input type="text" class="form-control decimal-numbers gross_wt_per_pk" maxlength="12" name="items[{uid}][gross_wt]" placeholder="0.00"></td>
                <td><input type="text" class="form-control decimal-numbers net_wt_per_pk" maxlength="12" name="items[{uid}][net_wt]" placeholder="0.00"></td>
                <td><input type="text" class="form-control invoice_no" maxlength="14" name="items[{uid}][invoice_no]"></td>
                <td><input type="text" class="form-control invoice_date" maxlength="14" name="items[{uid}][invoice_date]">
                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                </td>

            </tr>
        </tbody>
    </table>

</div>

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


        // Start: Calculate total net_wt 
        $(document).on('blur', 'input.net_wt_per_pk ', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            var totalNet_wt = 0;
            $(tableId + ' tbody tr ').each(function() {
                var tr = $(this);
                //var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
                var net_wt_per_pk = parseFloat(tr.find('input.net_wt_per_pk').val()) || 0.0;
                totalNet_wt += net_wt_per_pk;


            });

            $(tableId + ' tfoot tr span.total-net_wt_per_pk').text(totalNet_wt.toFixed(2));
        });
        // End: Calculate total net_wt 

        // Start: Calculate total gross_wt 
        $(document).on('blur', 'input.gross_wt_per_pk ', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            var totalGross_wt = 0;
            $(tableId + ' tbody tr ').each(function() {
                var tr = $(this);
                //var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
                var gross_wt_per_pk = parseFloat(tr.find('input.gross_wt_per_pk').val()) || 0.0;
                totalGross_wt += gross_wt_per_pk;


            });

            $(tableId + ' tfoot tr span.total-gross_wt_per_pk').text(totalGross_wt.toFixed(2));
        });
        // End: Calculate total gross_wt 

        // Delete row
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
</script>
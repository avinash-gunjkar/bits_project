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
        margin-right: 10px;
    }

    div.editable {
        display: inline-block;
        padding: 2px 0;
    }

    div.editable input {
        /* border: none; */
    }

    div.editable-textarea {
        display: block;
    }

    div.editable-textarea textarea {
        /* border: none; */
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

    table.table.items-table tr td input,
    table.table.items-table tr td select {
        border: none;
        width: 100%;
        padding: 0 5px;
        height: 25px;
    }

    table.table.items-table tr td {
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
                        <h3 class="heading3-border">VGM Declaration</h3>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td rowspan="4" colspan="1" class="text-left">
                                            <label for="">Shipper: </label>
                                            <div class="editable-textarea "><textarea name="other_details[shipper]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="10"><?= $other_details->shipper ?></textarea></div>
                                        </td>
                                        <td class="text-left">
                                            <label for="">Invoice Number: </label>
                                            <div class="editable">
                                                <input type="text" name="other_details[invoice_number]" class="form-control requiredClass" value="<?= $other_details->invoice_number ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label for="">Invoice Date: </label>
                                            <div class="editable input"><input type="text" class="date-picker form-control requiredClass" name="other_details[invoice_date]" value="<?= printFormatedDate($other_details->invoice_date) ?>" maxlength="15"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label for="">Pre-Carriage By: </label>
                                            <select class="form-control col-lg-3" style="display: inline;" name="other_details[pre_carriage_by]">

                                                <?php foreach (getPrecarriageByList() as $carriage) { ?>
                                                    <option value="<?= $carriage ?>" <?= $other_details->pre_carriage_by == $carriage ? 'selected' : '' ?>><?= $carriage ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label for="">Certificate Number: </label>
                                            <div class="editable" style="min-width: 100px;"><input type="text" class="form-control requiredClass" name="other_details[certificate_no]" id="#certificate_no" value="<?= $other_details->certificate_no ?>"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">METHOD 1</label><br>
                                            <div class="editable">
                                                <P>Weighing the packed container using calibrated and certified weighing equipment (e.g. weighbridges, load cell sensing technologies etc).</P>
                                            </div>
                                            <div class="pull-right"><input type="checkbox" name="other_details[method1]" <?= $other_details->method1 ? ' checked ' : '' ?> value="1"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">METHOD 2</label><br>
                                            <div class="editable">
                                                <P>Weighing all packages and cargo items, including the mass of pallets, dunnage and other securing material to be packed in the container and adding the tare mass of the container to the sum of the single masses, using a certified method approved by the Country competent Authority (Marine and Coastguard Agency (MCA) or its authorized body).</P>
                                            </div>
                                            <div class="pull-right"><input type="checkbox" name="other_details[method2]" <?= $other_details->method2 ? ' checked ' : '' ?> value="1"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <td>Container Number</td>
                                                        <td>Container Tare (kg)</td>
                                                        <td>Cargo Weight (kg)</td>
                                                        <td>Gross Weight (kg)</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) { ?>
                                                        <?php foreach ($items as $key => $tem) { ?>
                                                            <tr>
                                                                <td><input type="text" maxlength="8" class="form-control requiredClass" name="items[<?= $key ?>][container_no]" value="<?= $tem->container_no ?>"></td>
                                                                <td><input type="text" class="decimal-numbers form-control requiredClass" maxlength="12" name="items[<?= $key ?>][container_tare]" placeholder="0.00" value="<?= $tem->container_tare ?>"></td>
                                                                <td><input type="text" class="decimal-numbers form-control requiredClass" maxlength="12" name="items[<?= $key ?>][cargo_wt]" placeholder="0.00" value="<?= $tem->cargo_wt ?>"></td>
                                                                <td>
                                                                    <input type="text" class="decimal-numbers form-control requiredClass" maxlength="12" name="items[<?= $key ?>][gross_wt]" placeholder="0.00" value="<?= $tem->gross_wt ?>">
                                                                    <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4">
                                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-left">
                                            <label for="">VGM Declaration</label>
                                            <div class="editable">
                                                <p>In accordance with the International Maritime Organization(IMO) Safety of Life at Sea(SOLAS) convention under regulation 2 of chapter VI which mandates the declaration of the Verified Gross Mass(VGM), the shipper hereby certifies all information on this Verified Gross Mass declaration is true and correct.</p>
                                            </div>
                                        </td>
                                        <td colspan="1">
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
                                        <td colspan="5">
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
                <td><input type="text" maxlength="20" class="form-control requiredClass" name="items[{uid}][container_no]" value="<?= $tem->container_no ?>"></td>
                <td><input type="text" class="decimal-numbers form-control requiredClass" maxlength="20" name="items[{uid}][container_tare]" placeholder="0.00" value="<?= $tem->container_tare ?>"></td>
                <td><input type="text" class="decimal-numbers form-control requiredClass" maxlength="20" name="items[{uid}][cargo_wt]" placeholder="0.00" value="<?= $tem->cargo_wt ?>"></td>
                <td>
                    <input type="text" class="decimal-numbers form-control requiredClass" maxlength="20" name="items[{uid}][gross_wt]" placeholder="0.00" value="<?= $tem->gross_wt ?>">
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

        $(document).on('blur', 'input.qty,input.price', function(e) {
            var tr = $(this).closest('tr');
            var tableId = '#' + $(this).closest('table').attr('id');
            var categoryTotal = 0;
            var charges = parseFloat(tr.find('input.price').val()) || 0.0;
            var qty = parseFloat(tr.find('input.qty').val()) || 0.0;
            var total = (charges * qty).toFixed(2);
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
            finalTotal += (charges * qty)
            totalQty += qty
        });
        $(tableId + ' tfoot tr span.total-qty').text(totalQty.toFixed(2));
        $(tableId + ' tfoot tr span.final-total').text(finalTotal.toFixed(2));
        $('#totalAmountInWords').text(inWords(finalTotal));

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
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
        text-align: left;
    }

    table.table tbody tr td {
        text-align: left;
        border: none;
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

    div.c {
        float: right;
    }

    div.d {
        vertical-align: bottom;
        text-align: center;
    }

    div.e {
        text-align: center;
    }

    table.table,
    th,
    td {
        border: none;
        border-collapse: collapse;
    }

    div.editable {
        display: inline-block;
        padding: 2px 0;
    }



    div.editable-textarea {
        display: block;
    }

    div.editable-textarea textarea {

        resize: none;
        width: 100%;
    }

    table.table.table-bordered tbody tr td,
    table.table.table-bordered thead tr th {
        border: 1px solid #ccc;
    }

    .width-200 {
        width: 200px;
        display: inline-block;
    }

    .width-250 {
        width: 250px;
        display: inline-block;
    }

    .width-300 {
        width: 300px;
        display: inline-block;
    }

    .width-400 {
        width: 400px;
        display: inline-block;
    }

    .width-500 {
        width: 500px;
        display: inline-block;
    }

    #itemstable td {
        padding: 0;
    }

    #itemstable td input {

        width: 100%;
        border: none;
    }

    table.table.items-table tr td{
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

    ol,
    p {

        font-size: 12px;
    }
    ol li {
        margin-bottom: 15px;
    }
</style>
<!-- Tracking start -->
<div class="wshipping-content-block">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                        <center>
                        <h3 class="heading3-border">DETAILS OF SELF SEALED CONTAINER DECLARATION</h3>
                        </center>
                        <?php

                        $other_details = $documentData->other_details;
                        $consignor = (object) $other_details->consignor;
                        $items = $documentData->items;
                        ?>
                        <?=$this->session->flashdata('message')?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <table class="table">
                                <colgroup>
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="20%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div class="editable">
                                                <div class="pull-left">
                                                    <label for="">Invoice No.</label>
                                                    <input type="text" class="form-control width-250" name="other_details[invoice_number]" value="<?= $other_details->invoice_number ?>">
                                                </div>

                                            </div>
                                        </td>
                                        <td colspan="3">
                                            <div class="editable">
                                                <div class="c">
                                                    <label for="date">Date:</label>
                                                    <input type="text" class="date-picker width-200 form-control" name="other_details[invoice_date]" value="<?= printFormatedDate($other_details->invoice_date) ?>">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <p>Declaration under Foreign Exchange Management Act1999:</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <ol type="1">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                        Name of Exporter:
                                                        </div>
                                                        <div class="col-lg-9" style="padding-left:45px;">
                                                            <input class="form-control" type="text" name="other_details[exporter_company_name]" value="<?= $other_details->exporter_company_name ?>">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <ol type="a">
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                IEC Number:
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <input class="form-control" type="text" name="other_details[iec_no]" value="<?= $other_details->iec_no ?>">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                Branch Code:
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <input class="form-control" type="text" name="other_details[branch_code]" value="<?= $other_details->branch_code ?>">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                GSTIN:
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <input class="form-control" type="text" name="other_details[gst_no]" value="<?= $other_details->gst_no ?>">
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                        Name & Address of Manufacturer:
                                                        </div>
                                                        <div class="col-lg-9" style="padding-left:45px;">
                                                            <input type="text" name="other_details[name_address_manufacturer]" class="form-control" value="<?= $other_details->name_address_manufacturer ?>">
                                                        </div>
                                                    </div>


                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                        The 40 feet container is received & Loaded at M/s:
                                                        </div>
                                                        <div class="col-lg-9" style="padding-left: 45px;">
                                                            <input type="text" name="other_details[container_received_loaded_at]" class="form-control" value="<?= $other_details->container_received_loaded_at ?>">
                                                        </div>
                                                    </div>

                                                </li>
                                                <li>
                                                    <div>
                                                        Certified that the Description, Quantity, Value, Net Weight and technical characteristics of the Export Product of the Goods are covered by this invoice and Particulars which are amplified in packing list have been checked by us and the goods are stuffed in the Container.
                                                    </div>

                                                    <table id="itemstable" class="table table-bordered items-table" style="margin-top: 15px;">
                                                        <thead>
                                                            <th>Container Number</th>
                                                            <th>SIZE</th>
                                                            <th>Vehicle No.</th>
                                                            <th>Shipping Line Seal No.</th>
                                                            <th>RFID Seal No.</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($items)) { ?>
                                                            <?php foreach ($items as $key => $item) { ?>
                                                                <tr>
                                                                    <td>
                                                                        
                                                                        <input type="text" maxlength="30" name="items[<?=$key?>][container_number]" value="<?=$item->container_number?>">
                                                                    </td>
                                                                    <td><input type="text" maxlength="20" name="items[<?=$key?>][container_size]" value="<?=$item->container_size?>"></td>
                                                                    <td><input type="text" maxlength="15" class="" name="items[<?=$key?>][vehicle_no]" value="<?=$item->vehicle_no?>"></td>
                                                                    <td><input type="text" class="" maxlength="30" name="items[<?=$key?>][shipping_line_seal_no]" value="<?=$item->shipping_line_seal_no?>"></td>
                                                                    <td>
                                                                        <input type="text" class="" name="items[<?=$key?>][rfid_seal_no]" maxlength="30" value="<?=$item->rfid_seal_no?>">
                                                                        <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            <?php } ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add Container</a>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </li>
                                                <li>
                                                    This Container is stuffed as per File No. VIII/Cus/Tech./SSP/48-105/18-19 issued one time by the Commissioner of Customs GST Bhavan, 41/A, Sassoon Road, Pune-411001.
                                                </li>
                                            </ol>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td colspan="3"></td>
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
                                <!-- <input type="submit" value="Create Document"  name="submitBtn" id="createDocumentBtn" class="btn btn-success"> -->
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
                   
                    <input type="text" maxlength="30" name="items[{uid}][container_number]">
                </td>
                <td><input type="text" maxlength="20" name="items[{uid}][container_size]"></td>
                <td><input type="text" maxlength="15" class="" name="items[{uid}][vehicle_no]"></td>
                <td><input type="text" class="" maxlength="30" name="items[{uid}][shipping_line_seal_no]"></td>
                <td>
                    <input type="text" class="" name="items[{uid}][rfid_seal_no]" maxlength="30">
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
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
        /*border: none;*/
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
        height:25px;
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
                        $items = $documentData->items;
                    ?>
                   
                    <center>
                        <h3 class="heading3-border">CERTIFICATE OF ORIGIN</h3>
                    </center>
                    
                    <?=$this->session->flashdata('message')?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="table table-bordered">
                            <colgroup>
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                            </colgroup>
                            <tbody>
                            <tr>
                                    <td  colspan="2">
                                        <label for="" style="min-width: 100px;">Exporter</label>
                                        <div class="editable-textarea">
                                            <textarea name="other_details[exporter]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="5"><?=$other_details->exporter?></textarea>
                                        </div>
                                    </td>
                                   
                                    <td>
                                        <div><label for="" style="min-width: 100px;">Export Invoice No.</label>
                                            <div class="editable">
                                                <input type="text" class="form-control requiredClass" name="other_details[invoice_number]" id="#invoice_number" value="<?=$other_details->invoice_number?>">
                                            </div>
                                        </div>
                                        <div><label for="" style="min-width: 100px;">Export Date</label>
                                            <div class="editable">
                                                <input type="text" name="other_details[invoice_date]"  id="invoice_date" class="date-picker form-control requiredClass" value="<?= printFormatedDate($other_details->invoice_date) ?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div><label for="" style="min-width: 100px;" >Letter of Credit No.</label>
                                            <div class="editable"><input class="form-control requiredClass" type="text" name="other_details[letter_of_credit_no]" id="#letter_of_credit_no" value="<?=$other_details->letter_of_credit_no?>"></div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <label for="" style="min-width: 100px;" >Consignee</label>

                                        <div class="editable-textarea">
                                            <textarea name="other_details[consignee]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="5"><?=$other_details->consignee?></textarea>
                                        </div>

                                    </td>
                                    <td colspan="2">
                                        <label for="" style="min-width: 100px;" >Buyer (if other than Consignee)</label>
                                        <div class="editable-textarea">
                                            <textarea name="other_details[consignee_other]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="5"><?=$other_details->consignee_other?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="" style="min-width: 100px;" >Method of Dispatch</label>
                                        <input class="form-control requiredClass" type="text" name="other_details[method_of_dispatch]" value="<?=$other_details->method_of_dispatch?>">
                                        
                                    </td>
                                    <td>
                                        <label for="" style="min-width: 100px;">Type of Shipment</label>
                                        <input class="form-control requiredClass" type="text" name="other_details[type_of_shipment]" value="<?=$other_details->type_of_shipment?>">
                                        
                                    </td>

                                    <td>
                                        <label for="" style="min-width: 100px;" >Vessel / Aircraft </label>
                                        <input class="form-control" type="text" name="other_details[vessel_aircraft]" value="<?=$other_details->vessel_aircraft?>">
                                        
                                    </td>
                                    <td>
                                        <label for="" style="min-width: 100px;" >Voyage Number</label>
                                        <input class="form-control" type="text" name="other_details[voyage_no]" value="<?=$other_details->voyage_no?>">
                                       
                                    </td>

                                    <!-- <td rowspan="4" colspan="2">
                                    </td> -->
                                </tr>
                               
                                <tr>
                                    <td>
                                        <label for="" style="min-width: 100px;">Port of Loading</label>
                                        <input class="form-control" type="text" name="other_details[port_of_l]"   value="<?=$other_details->port_of_l?>">
                                        
                                    </td>
                                    <td><label for="" style="min-width: 100px;">Date of Departure</label> 
                                    <input class="date-picker form-control" type="text" name="other_details[date_of_departure]" id="port_of_d" value="<?= printFormatedDate($other_details->date_of_departure) ?>">
                                       
                                    </td> 
                                    <td>
                                        <label for="" style="min-width: 100px;">Port of Discharge</label>
                                        <input class="form-control" type="text" name="other_details[port_of_d]" id="" value="<?=$other_details->port_of_d?>">
                                        
                                    </td>
                                    <td>
                                        <label for="" style="min-width: 100px;">Final Destination</label>
                                        <input class="form-control" type="text" name="other_details[final_destination]" id="" value="<?=$other_details->final_destination?>">
                                        
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="4">
                                    <table id="itemstable" class="table items-table">
                                            <thead>
                                                <tr>
                                                    <th>Marks & Numbers</th>
                                                    <th>Kind & No of Packages</th>
                                                    <th style="width: 50%;">Description of Goods</th>                                         
                                                    <th>Tarif Code</th>
                                                    <th>Gross Weight (Kg)</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(!empty($items)){?>
                                                <?php foreach ($items as $key=>$tem) { ?>

                                                    <tr>
                                                        <td>
                                                           
                                                            <input type="text" class="form-control" maxlength="12" name="items[<?=$key?>][marks_and_no]" value="<?=$tem->marks_and_no?>">
                                                        </td>
                                                        <td><input type="text" class="form-control" maxlength="12" name="items[<?=$key?>][kind_of_packages]" placeholder="0.00" value="<?=$tem->kind_of_packages?>"></td>
                                                        <td><input type="text" maxlength="100" name="items[<?=$key?>][description]" value="<?=$tem->description?>"></td>
                                                        <td><input type="text" class="form-control" maxlength="12" name="items[<?=$key?>][tarif_code]" value="<?=$tem->tarif_code?>"></td>
                                                        <td>
                                                            <input type="text" class="form-control decimal-numbers gross_wt_per_pk" maxlength="12" name="items[<?=$key?>][gross_wt]" placeholder="0.00" value="<?=$tem->gross_wt?>">
                                                            <a class="btn delete-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                
                                                    <tr>
                                                        <td colspan="7">
                                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                </tr>

                                <tr>                
                                <td colspan="2"><label for="" style="min-width: 100px;" >Declaration By The Chamber:</label>
                                        <div class="editable-textarea">
                                            <textarea name="other_details[declaration_by_chamber]" class="form-control wysihtml5-editor-no-controlls" rows="8"><?=$other_details->declaration_by_chamber?></textarea>
                                        </div>
                                    </td>
                                    
                                    <td colspan="2"><label for="" style="min-width: 100px;" >Declaration By The Exporter:</label>
                                        <div class="editable-textarea">
                                            <textarea name="other_details[declaration_by_exporter]" class="form-control wysihtml5-editor-no-controlls" rows="8"><?=$other_details->declaration_by_exporter?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td colspan="2">
                                <div><label for="">Place and Date of Issue:</label><br><br></div>
                                <div><label for="">Signatory Chamber:</label><br><br></div>
                                <div><label for="">Name of Authorized Signatory:</label><br><br></div>
                                <div><label for="">Signature:</label></div>
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
                   
                    <input type="text" maxlength="30" name="items[{uid}][marks_and_no]">
                </td>
                <td><input type="text" maxlength="8" class="only-numbers" name="items[{uid}][kind_of_packages]"></td>
                <td><input type="text" maxlength="100" name="items[{uid}][description]"></td>
                <td><input type="text" class="decimal-numbers tarif_code" maxlength="12" name="items[{uid}][tarif_code]" placeholder="0.00"></td>
                
                <td>
                    <input type="text" class="decimal-numbers gross_wt" maxlength="12" name="items[{uid}][gross_wt]" placeholder="0.00">
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

    $('#createDocumentBtn').click(function(){
        if(!confirm('Do you want to create final document? After creating final document you can not edit document.')){
            return false;
        }
        
    });
</script>
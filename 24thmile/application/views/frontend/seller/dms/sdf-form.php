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
                            <h2>APPENDIX I</h2>
                            <h3 class="heading3-border">SDF Form</h3>
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
                                        <td colspan="2">
                                            <div class="row">
                                                <div class="col-lg-6"><label for="" style="min-width: 100px;">Shipping Bill no. : </label>  ______________________________________</div>
                                                <!-- <div class="editable">
                                                   
                                                    <input type="text" class="form-control requiredClass" name="shipping_bill_no" id="#shipping_bill_no" value="<?= $other_details->shipping_bill_no ?>">
                                                </div> -->
                                                <div class="col-lg-6"><label for="" style="min-width: 100px;">Date : </label> ____________________________________</div>
                                                <!-- <div class="editable">
                                                    
                                                    <input type="text" name="invoice_date" id="invoice_date" class="date-picker form-control requiredClass" value="<?= printFormatedDate(date('Y-m-d')) ?>">
                                                </div> -->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        <label for="" style="min-width: 100px;"> Declaration under Foreign Exchange Management Act1999: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        <label for="" style="min-width: 100px;"> 1. I/We hereby declare that I/We am/are the *SELLER/CONSIGNOR of the goods in respect of which this declaration is made and that the particulars given in the Shipping Bill No: ___________ dated :__________ are true and that,
                                        </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        <label for="" style="min-width: 100px;">A)* The value as contracted with the buyer is same as the full export value in the above shipping bills.
                                        </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p> </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        <label for="" style="min-width: 100px;">B)* The full export value of the goods are not ascertainable at the time of export and that the value declared is that which I/We, having regard to the prevailing market conditions, accept to receive on the sale of goods in the overseas market.
                                        </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p> </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        <label for="" style="min-width: 100px;"> 2. I/We undertake that I/We will deliver to the bank named herein THE HONGKONG AND SHANGHAI BANKING BANKING CORPORATION, INSTITUTIONAL PLOT NO. 68, SECTOR -44, GURGAON 122002 the foreign exchange representing the full export value of the goods on or before @ ___________________ in the manner prescribed in Rule 9 of the Foreign Exchange Management Act.1999
                                        </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p> </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        <label for="" style="min-width: 100px;">3. I/We further declares that I/We am/are resident in India and I/We have place of Business in India.
                                        </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p> </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        <label for="" style="min-width: 100px;"> 4. I./We am/are Or am/are not in Caution list of the Reserve Bank of India.
                                        </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td> </td>
                                        <td>
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
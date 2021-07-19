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
    ol li {
        margin-bottom: 10px;
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
                            <h3 class="heading3-border">ANNEXURE – A</h3>
                            <h3 class="heading3-border">: EXPORT VALUE DECLARATION :</h3>
                            <small>(See Rule 7 of Customs Valuation (Determination of Value of Export Goods) Rules, 2007.)</small>
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
                                            <ol>
                                                <li>
                                                    <div>
                                                        <label style="min-width: 100px;">Shipping Bill Number and Date :</label>
                                                        <div class="editable">
                                                            <input type="text" class="form-control requiredClass" name="other_details[shipping_bill_no]" placeholder="shipping bill no." value="<?= $other_details->shipping_bill_no ?>">
                                                        </div>
                                                        <div class="editable">
                                                            <input type="text" class="form-control requiredClass date-picker" name="other_details[shipping_bill_date]" placeholder="DD-MM-YYYY" value="<?= $other_details->shipping_bill_date ?>">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label style="min-width: 100px;"> Invoice Number and Date:</label>
                                                            <div class="editable">
                                                                <input type="text" name="other_details[invoice_number]" class="form-control requiredClass" id="invoice_number" value="<?= $other_details->invoice_number ?>">
                                                            </div>
                                                            <div class="editable">
                                                                <input type="text" name="other_details[invoice_date]" id="invoice_date" class="date-picker form-control " value="<?= printFormatedDate($other_details->invoice_date) ?>">
                                                            </div>

                                                        </div>

                                                    </div>


                                                </li>
                                                <li>
                                                    <div><label style="min-width: 100px;">Nature of Transaction:</label> <br>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <label style=" font-weight:normal;"> <input type="radio" name="other_details[nature_of_transaction]" <?= $other_details->nature_of_transaction == 'sale' ? ' checked ' : '' ?> value="sale"> Sale</label>
                                                                <label style="  font-weight:normal;"> <input type="radio" name="other_details[nature_of_transaction]" <?= $other_details->nature_of_transaction == 'sale_on_consignment_basis' ? ' checked ' : '' ?> value="sale_on_consignment_basis"> Sale on consignment Basis</label>
                                                                <label style=" font-weight:normal;"><input type="radio" name="other_details[nature_of_transaction]" <?= $other_details->nature_of_transaction == 'gift' ? ' checked ' : '' ?> value="gift"> Gift</label>
                                                                <label style=" font-weight:normal;"> <input type="radio" name="other_details[nature_of_transaction]" <?= $other_details->nature_of_transaction == 'sample' ? ' checked ' : '' ?> value="sample"> Sample</label>
                                                                <label style=" font-weight:normal;"> <input type="radio" name="other_details[nature_of_transaction]" <?= $other_details->nature_of_transaction == 'other' ? ' checked ' : '' ?> value="other"> Other</label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <br>
                                                <li>
                                                    <div><label style="min-width: 100px;">Method of Valuation:</label></div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label style="min-width: 100px; font-weight:normal;"> <input type="radio" name="other_details[method_of_valuation]" <?= $other_details->method_of_valuation == 'Rule_3' ? ' checked ' : '' ?> value="Rule_3"> Rule 3</label>
                                                            <label style="min-width: 100px; font-weight:normal;"> <input type="radio" name="other_details[method_of_valuation]" <?= $other_details->method_of_valuation == 'Rule_4' ? ' checked ' : '' ?> value="Rule_4"> Rule 4</label>
                                                            <label style="min-width: 100px; font-weight:normal;"> <input type="radio" name="other_details[method_of_valuation]" <?= $other_details->method_of_valuation == 'Rule_5' ? ' checked ' : '' ?> value="Rule_5"> Rule 5</label>
                                                            <label style="min-width: 100px; font-weight:normal;"> <input type="radio" name="other_details[method_of_valuation]" <?= $other_details->method_of_valuation == 'Rule_6' ? ' checked ' : '' ?> value="Rule_6"> Rule 6</label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <br>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label style="min-width: 100px;">Whether seller and buyer are Related:</label>
                                                            <label style="min-width: 100px; font-weight:normal;"> <input type="radio" name="other_details[whether_seller_and_buyer_related]" <?= $other_details->whether_seller_and_buyer_related == 'yes' ? ' checked ' : '' ?> value="yes"> Yes</label>
                                                            <label style="min-width: 100px; font-weight:normal;"> <input type="radio" name="other_details[whether_seller_and_buyer_related]" <?= $other_details->whether_seller_and_buyer_related == 'no' ? ' checked ' : '' ?> value="no"> No</label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <br>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label style="min-width: 100px;">If yes, whether relationship has influenced the price:</label>
                                                            <label style="min-width: 100px; font-weight:normal;"> <input type="radio" name="other_details[whether_relationship_influenced_price]" <?= $other_details->whether_relationship_influenced_price == 'yes' ? ' checked ' : '' ?> value="yes"> Yes</label>
                                                            <label style="min-width: 100px; font-weight:normal;"> <input type="radio" name="other_details[whether_relationship_influenced_price]" <?= $other_details->whether_relationship_influenced_price == 'no' ? ' checked ' : '' ?> value="no"> No</label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div><label style="min-width: 100px;">Terms of Payment: </label>
                                                    <textarea class="form-control wysihtml5-editor-no-controlls" name="other_details[terms_of_payment]"><?= $other_details->terms_of_payment ? $other_details->terms_of_payment : $other_details->terms_method_of_payment ?></textarea>
                                                       
                                                    </div>
                                                </li>
                                                <li>
                                                    <div><label style="min-width: 100px;">Terms of Delivery: </label>
                                                        
                                                            <textarea class="form-control wysihtml5-editor-no-controlls" name="other_details[terms_of_delivery]"><?= $other_details->terms_of_delivery ? $other_details->terms_of_delivery : $other_details->terms_method_of_payment ?></textarea>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div><label style="min-width: 100px;">Previous exports of identical / similar goods, If any </label>
                                                        <div><label style="min-width: 100px;">Shipping Bill Number : </label>
                                                            <div class="editable">
                                                                <input type="text" class="form-control requiredClass" name="other_details[previous_export_similar_goods_shipping_bill_no]" value="<?= $other_details->previous_export_similar_goods_shipping_bill_no ?>">
                                                            </div>
                                                        </div>
                                                        <div><label style="min-width: 100px;">Shipping Bill Date</label>
                                                            <div class="editable">
                                                                <input type="text" name="other_details[previous_export_similar_goods_shipping_bill_date]" class="date-picker form-control requiredClass" value="<?= printFormatedDate($other_details->previous_export_similar_goods_shipping_bill_date) ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <label style="min-width: 100px;">Any other relevant information (Attach separate sheet, If necessary)</label>
                                                    </div>
                                                </li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>DECLARATION</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p>1. I / We hereby declare that the information furnished above is true, complete and correct in every respect.
                                            </p>
                                            <p>2. I / We also undertake to bring to the notice of proper officer any particulars, which subsequently come to my/our knowledge, which will have bearing on a valuation.
                                            </p><br>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td >
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
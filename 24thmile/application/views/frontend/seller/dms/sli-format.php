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
        margin: 0 10px 0 0;
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
        left: -25px;
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
                   <center>
                   <h3 class="heading3-border">SHIPPER' S LETTER OF INSTRUCTIONS</h3>
                   </center>
                   
                        <?php
                        $other_details = $documentData->other_details;
                        $consignor = (object) $other_details->consignor;
                        $items = $documentData->items;
                        $type_of_shipping_bills = $other_details->type_of_shipping_bills;
                        $documentList = $other_details->documentList;
                        ?>
                       
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
                                        <td colspan="4">

                                            <div class="row">
                                                <div class="col-lg-2"><label for="">Exporter Name:</label></div>
                                                <div class="col-lg-6"><input type="text" class="form-control required-class" name="other_details[exporter_company_name]" value="<?= $other_details->exporter_company_name ?>" ></div>
                                                <div class="col-lg-4"><label for="">Date:</label><?= printFormatedDate($documentData->created_at) ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2"><label for="">Invoice Number and Date:</label></div>
                                                <div class="col-lg-6">
                                                    <?= $other_details->invoice_number ?> <?= printFormatedDate($other_details->invoice_date) ?>
                                                    <input type="hidden" name="other_details[invoice_number]" value="<?= $other_details->invoice_number ?>">
                                                    <input type="hidden" name="other_details[invoice_date]" value="<?= printFormatedDate($other_details->invoice_date) ?>">
                                                </div>
                                                <div class="col-lg-4"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">Import Export Code Number (10 DIGIT) : </label>
                                                <div class="col-lg-4">
                                                    <input type="text" maxlength="10" class="form-control only-numbers requiredClass" name="other_details[iec_no]" value="<?=$other_details->iec_no?>">

                                                </div>
                                            </div>
                                           
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">GSTIN Number:</label>
                                                <div class="col-lg-4">
                                                    <input type="text" maxlength="10" class="form-control requiredClass" name="other_details[gst_no]" value="<?=$other_details->gst_no?>">

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">Bank Authorized Dealer Code (PART I & II):</label>
                                                <div class="col-lg-4">
                                                    <input type="text" maxlength="15" class="form-control requiredClass" name="other_details[bank_ad_code]" value="<?=formated_ad_code($other_details->bank_ad_code)?>">

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">CURRENCY OF INVOICE:</label>
                                                <div class="col-lg-4">
                                                    <input type="text" maxlength="10" class="form-control requiredClass" name="other_details[currency]" value="<?=$other_details->currency?>">

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">INCOTERMS :</label>
                                                <div class="col-lg-4">
                                                    <!-- <input type="text" maxlength="10" class="form-control requiredClass" name="other_details[incoterms]" value="<?=$other_details->incoterms?>"> -->
                                                    <select name="other_details[incoterms]" class="form-control requiredClass">
                                                    <option value="">Select</option>
                                                    <?php foreach($delivery_terms as $delivery_term){ 
                                                        $delivery_term = (object) $delivery_term;
                                                            $selected = $delivery_term->name == $other_details->incoterms?' selected ':'';
                                                            echo "<option value='$delivery_term->name'>$delivery_term->name</option>";
                                                     }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">NATURE OF PAYMENT :</label>
                                                <div class="col-lg-4">
                                                    <input type="text" maxlength="10" class="form-control requiredClass" name="other_details[nature_of_payment]" value="<?=$other_details->nature_of_payment?>">

                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="">DETAILS TO BE DECLARED FOR PREPARATION OF SHIPPING BILL:</label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">FOB VALUE: </label>
                                                <div class="col-lg-4">
                                                    <input type="text" maxlength="20" class="form-control only-numbers requiredClass" name="other_details[fob_value]" value="<?=$other_details->fob_value?>">

                                                </div>
                                            </div>
                                           
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">FREIGHT (IF ANY):</label>
                                                <div class="col-lg-4">
                                                    <input type="text" maxlength="20" class="form-control requiredClass" name="other_details[freight]" value="<?=$other_details->freight?>">

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">INSURANCE (IF ANY):</label>
                                                <div class="col-lg-4">
                                                    <input type="text" maxlength="20" class="form-control requiredClass" name="other_details[insurance]" value="<?=$other_details->insurance?>">

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">COMMISSION (IF ANY):</label>
                                                <div class="col-lg-4">
                                                    <input type="text" maxlength="20" class="form-control requiredClass" name="other_details[commission]" value="<?=$other_details->commission?>">

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-lg-2">DISCOUNT (IF ANY):</label>
                                                <div class="col-lg-4">
                                                    <input type="text" maxlength="20" class="form-control requiredClass" name="other_details[discount]" value="<?=$other_details->discount?>">

                                                </div>
                                            </div>
                                            
                                        </td>

                                    </tr>

                                    <tr>
                                        <td colspan="3">
                                            <div><label for="">DESCRIPTION OF GOODS TO BE DECLARED ON SHIPPING BILL</label></div>
                                        </td>
                                        <td rowspan="3">
                                            <ul style="list-style: none;padding:0;">
                                                <li>NUMBER OF PKGS. : 1</li>
                                                <li>NET WT. (kg): <span><?=$other_details->total_net_wt?><input type="hidden" name="other_details[total_net_wt]" value="<?=$other_details->total_net_wt?>"></span></li>
                                                <li>GROSS WT. (kg): <span><?=$other_details->total_gross_wt?><input type="hidden" name="other_details[total_gross_wt]" value="<?=$other_details->total_gross_wt?>"></span></li>
                                                <li>VOLUME WT. : <span><?=$other_details->total_volumetric_wt?><input type="hidden" name="other_details[total_volumetric_wt]" value="<?=$other_details->total_volumetric_wt?>"></span></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><div>as per invoice Attached</div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div><label for="">DESCRIPTION OF GOODS TO BE DECLARED ON AWB</label></div>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div>as per invoice Attached</div>
                                        </td>
                                        <td>
                                            <div><label for="">DIMENSION (IN CMS)</label></div>
                                            <div>L  X  B  X H</div>
                                            <ul style="list-style: none;padding:0;">
                                            <?php if(!empty($items)){?>
                                            <?php $counter=1; foreach($items as $key=>$item){ $item = (object)$item;?>
                                                    <li>
                                                        Package <?=$counter++?>: <?=$item->dimention_per_pk?>
                                                        <input type="hidden" name="items[][dimention_per_pk]" value="<?=$item->dimention_per_pk?>">
                                                    </li>
                                                <?php }?>
                                                <?php }?>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                            <label for="">SPECIAL INSTRUCTION IF ANY,</label>
                                            <div class="editable-textarea">
                                                <textarea  cols="30" rows="4" class="form-control" placeholder="type here..." name="other_details[special_instructions]" ><?=$other_details->special_instructions?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for="">TYPE OF SHIPPING BILL</label>
                                            <?php foreach ($type_of_shipping_bills as $key => $type_of_shipping_bill) { ?>
                                                <div>
                                                    <label class="checkbox-inline checkbox"><input type="checkbox" name="other_details[type_of_shipping_bills][<?= $key ?>][value]" value="1" <?= $type_of_shipping_bill->value == '1' ? 'checked' : '' ?>> <?= $type_of_shipping_bill->name ?></label>
                                                    <input type="hidden" name="other_details[type_of_shipping_bills][<?= $key ?>][name]" value="<?= $type_of_shipping_bill->name ?>" id="">
                                                </div>
                                            <?php } ?>
                                        </td>
                                        <td colspan="2">
                                            <label for="">BELOW DETAILS REQUIRED TO BE DECLARED ON INVOICE</label>
                                            <ul style="list-style-type: none;">
                                                <li>EXPORT INVOICE, IF VALUE IS MORE THEN RS.25000/- THEN GR WAIVER</li>
                                                <li>EXPORT INVOICE, PACKING LIST, SDF</li>
                                                <li>REQD.DRAWBACK SR NO, ANX-1, ANX-111</li>
                                                <li>REQD.DEEC REGN. NO. SBILL COPY, RAW MATERIAL DETAILS, LICENCE COPY</li>
                                                <li>REQD. EPCG REGN. NO. SBILL COPY, RAW MATERIAL DETAILS, LICENCE COPY</li>
                                                <li>ANX-C1</li>
                                                <li>COPY OF BOE</li>
                                                <li>ALL IMPORT & EXPORT DOCUMENTS IN ORIGINAL</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <label for="">PLEASE TICK & LIST THE DOCUMENTS (BEING) HANDED OVER TO FORWARDER :</label>
                                            <div class="row">

                                                <?php foreach ($documentList as $key => $document) {

                                                ?>

                                                    <div class="col-lg-4">
                                                        <label><input type="checkbox" name="other_details[documentList][<?= $key ?>][value]" value="1" <?= $document->value == '1' ? 'checked' : '' ?>> <?= $document->name ?></label>
                                                        <input type="hidden" name="other_details[documentList][<?= $key ?>][name]" value="<?= $document->name ?>" id="">

                                                    </div>


                                                <?php } ?>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <label for="">Declaration:</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[declaration]" class="form-control" cols="30" rows="10"><?= $other_details->declaration ?></textarea>
                                            </div>
                                        </td>
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
                                        <td colspan="4">
                                            <p class="text-center"><?= $consignor->company_name ?> <?= $consignor->address_line_1 ?> <?= $consignor->address_line_2 ?> <?= $consignor->city_name ?> Pincode: <?= $consignor->pincode ?> <br> Contact Person: <?= $consignor->name ?> Email: <?= $consignor->email ?> Phone: <?= $consignor->phone ?> </p>
                                            <input type="hidden" name="other_details[consignor][company_name]" value="<?= $consignor->company_name ?>">
                                            <input type="hidden" name="other_details[consignor][address_line_1]" value="<?= $consignor->address_line_1 ?>">
                                            <input type="hidden" name="other_details[consignor][address_line_2]" value="<?= $consignor->address_line_2 ?>">
                                            <input type="hidden" name="other_details[consignor][city_name]" value="<?= $consignor->city_name ?>">
                                            <input type="hidden" name="other_details[consignor][pincode]" value="<?= $consignor->pincode ?>">
                                            <input type="hidden" name="other_details[consignor][name]" value="<?= $consignor->name ?>">
                                            <input type="hidden" name="other_details[consignor][email]" value="<?= $consignor->email ?>">
                                            <input type="hidden" name="other_details[consignor][phone]" value="<?= $consignor->phone ?>">
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
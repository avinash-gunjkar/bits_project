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
        border: none;
    }

    div.editable-textarea {
        display: block;
    }

    div.editable-textarea textarea {
        border: none;
        resize: none;
        width: 100%;
    }

    div.editable {
        display: inline-block;
        padding: 2px 0;
    }

    div.editable input {
        border: none;
    }

    div.editable-textarea {
        display: block;
    }

    div.editable-textarea textarea {
        border: none;
        resize: none;
        width: 100%;
    }

    ul {
        font-size: inherit;
        list-style: none;
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
                        <h3 class="heading3-border">New SLI</h3>
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
                                        <td colspan="4" class="text-left">
                                            <label for="date">Date:</label>
                                            <div class="editable"><input type="text" class="date-picker form-control requiredClass" name="invoice_date" value="<?= printFormatedDate($documentData->invoice_date) ?>" maxlength="15"></div>
                                            <br>
                                            <label for="">Bluedart Account</label>
                                            <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[bluedart_account]" id="#bluedart_account" value="<?= $other_details->bluedart_account ?>"></div>

                                            <label for="">Invoice No.</label>
                                            <div class="editable"><input type="text" name="invoice_number" class="form-control requiredClass" id="#invoice_number" value="<?= $documentData->invoice_number ?>"></div>

                                            <label for="">Dart EWB No.</label>
                                            <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[dart_ewb_no]" id="#dart_ewb_no" value="<?= $other_details->dart_ewb_no ?>"></div>

                                            <label for="">EIN No.</label>
                                            <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[ein_no]" id="#ein_no" value="<?= $other_details->ein_no ?>"></div>

                                            <label for="">PAN No.</label>
                                            <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[pan_no]" id="#pan_no" value="<?= $other_details->pan_no ?>"></div><br>

                                            <label for="">AD Code No.</label>
                                            <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[ad_code_no]" id="#ad_code_no" value="<?= $other_details->ad_code_no ?>"></div>

                                            <label for="">IEC No.</label>
                                            <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[iec_no]" id="#iec_no" value="<?= $other_details->iec_no ?>"></div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Exporter:</label>
                                            <div class="editable-textarea"><textarea name="other_details[exporter]" class="form-control requiredClass" rows="10"><?= $other_details->exporter ?></textarea></div>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <label for="">Contract Type(Select one):</label><br>

                                            <ul style="display:inline-table">
                                                <li><label>Ex-Works <input type="radio" name="other_details[contract_type]" <?= $other_details->contract_type ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>C & F (breakup) <input type="radio" name="other_details[contract_type]" <?= $other_details->contract_type ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>CIF (breakup) <input type="radio" name="other_details[contract_type]" <?= $other_details->contract_type ? ' checked ' : '' ?> value="1"></label></li>
                                            </ul>
                                            <ul style="display:inline-grid">
                                                <li><label>FOB <input type="radio" name="other_details[contract_type]" <?= $other_details->contract_type ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Cost <input type="radio" name="other_details[contract_type]" <?= $other_details->contract_type ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Cost <input type="radio" name="other_details[contract_type]" <?= $other_details->contract_type ? ' checked ' : '' ?> value="1"></label></li>
                                            </ul>
                                            <ul style="display:inline-grid">
                                                <li><label>DDP <input type="radio" name="other_details[contract_type]" <?= $other_details->contract_type ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Freight <input type="radio" name="other_details[contract_type]" <?= $other_details->contract_type ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Insurance <input type="radio" name="other_details[contract_type]" <?= $other_details->contract_type ? ' checked ' : '' ?> value="1"></label></li>
                                            </ul>
                                            <ul style="display:inline-grid">
                                                <li><label>Other <input type="radio" name="other_details[contract_type]" <?= $other_details->contract_type ? ' checked ' : '' ?> value="true">
                                                    </label>
                                                </li>
                                            </ul><br>

                                            <label>Other Please Specify:</label>
                                            <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[other_specified]" id="#other_specified" value="<?= $other_details->other_specified ?>"></div><br>

                                            <label for="">Currency:</label>
                                            <label for="">USD</label>
                                            <input type="text" class="decimal-numbers qty requiredClass" maxlength="12" name="other_details[currency]" placeholder="0.00" value="<?= $other_details->currency ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" rowspan="3" class="text-left">
                                            <label for="">Consignee:</label>
                                            <div class="editable-textarea"><textarea name="other_details[consignee]" class="form-control requiredClass" rows="10"><?= $other_details->consignee ?></textarea></div>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <label for="">Type of Shipping Bill (tick one)</label><br>
                                            <ul style="display:inline-table">
                                                <li><label>Drawback <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Commercial exports <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Sample-FOC <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Free Shipping Bill <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                            </ul>
                                            <ul style="display:inline-grid">
                                                <li><label>NFEI <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>EOU <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Advance Authorisation <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Re-Export <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                            </ul>
                                            <ul style="display:inline-grid">
                                                <li><label>MEIS <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>EPCG <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Jobbing <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                                <li><label>Repair and Return <input type="radio" name="other_details[type_of_shipping_bill]" <?= $other_details->type_of_shipping_bill ? ' checked ' : '' ?> value="1"></label></li>
                                            </ul>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Duty Drawback Details:</label>
                                            <div class="editable-textarea"><textarea name="other_details[duty_drawback_details]" class="form-control requiredClass" rows="10"><?= $other_details->duty_drawback_details ?></textarea></div>
                                            <label for="">Bank Details:</label>
                                            <div class="edi`table`-textarea"><textarea name="other_details[bank_detalis]" class="form-control requiredClass" rows="10"><?= $other_details->bank_detalis ?></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Current A/c No.:</label>
                                            <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[current_ac_no]" id="#current_ac_no" value="<?= $other_details->current_ac_no ?>"></div>
                                            <label for="">Description Of Goods:</label>
                                            <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[description_of_goods]" id="#description_of_goods" value="<?= $other_details->description_of_goods ?>"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="1"><label for="">Destination</label></td>
                                        <td colspan="1"><label for="">No. Of Packages</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[destination]" id="#destination" value="<?= $other_details->destination ?>"></div>
                                        </td>
                                        <td><input type="text" maxlength="8" class="only-numbers requiredClass" name="other_details[no_of_packages]" value="<?= $other_details->no_of_packages ?>"></td>
                                        <td><label for="">GSTIN Details</label></td>
                                        <td><input type="text" class="form-control requiredClass" name="other_details[gstin_details]" id="#gstin_details" value="<?= $other_details->gstin_details ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Net Weight (Kgs)</label></td>
                                        <td><label for="">Gross Weight (Kgs)</label></td>
                                        <td><label for="">GSTIN No. of the pick-up state</label><br>
                                            <input type="text" class="form-control requiredClass" name="other_details[gstin_no_of_pickup_state]" id="#gstin_no_of_pickup_state" value="<?= $other_details->gstin_no_of_pickup_state ?>">
                                        </td>
                                        <td><label for="">GSTIN Type</label><br>
                                            <input type="text" class="form-control requiredClass" name="other_details[gstin_type]" id="#gstin_type" value="<?= $other_details->gstin_type ?>">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" class="decimal-numbers qty requiredClass" maxlength="12" name="other_details[net_wt]" placeholder="0.00" value="<?= $other_details->net_wt ?>"></td>
                                        <td><input type="text" class="decimal-numbers qty requiredClass" maxlength="12" name="other_details[gross_wt]" placeholder="0.00" value="<?= $other_details->gross_wt ?>"></td>
                                        <td><label for="">State Code</label></td>
                                        <td><input type="text" maxlength="8" class="only-numbers requiredClass" name="other_details[state_code]" value="<?= $other_details->state_code ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label for="">Marks and Numbers: </label>
                                            <input type="text" class="form-control requiredClass" name="other_details[marks_and_numbers]" id="#marks_and_numbers" value="<?= $other_details->marks_and_numbers ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" rowspan="4" class="text-left">
                                            <label for="">Documents Enclosed (tick where applicable):</label>
                                            <ul>
                                                <li><label for="">AWB (duly complete)</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[awb]" <?= $other_details->awb ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                                <li><label for="">Invoice (5 copies)</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[invoice]" <?= $other_details->invoice ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                                <li><label for="">Packing List (5 copies)</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[packing_list]" <?= $other_details->packing_list ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                                <li><label for="">Buyer Order</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[buyer_order]" <?= $other_details->buyer_order ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                                <li><label for="">GSP Form</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[gsp_form]" <?= $other_details->gsp_form ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                                <li><label for="">Original, Duplicate Visa (with 2 copies)</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[visa]" <?= $other_details->visa ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                                <li><label for="">Export Certificates (with 2 copies)</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[export_certificate]" <?= $other_details->export_certificate ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                                <li><label for="">Photo copy of IEC with PAN No.</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[iec_with_pan]" <?= $other_details->iec_with_pan ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                                <li><label for="">Bank Certificate</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[bank_certificate]" <?= $other_details->bank_certificate ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                                <li><label for="">ARE-1 Form</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[are1_form]" <?= $other_details->are1_form ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                                <li><label for="">Any Export Promotion Council Regn. Copy</label>
                                                    <div class="pull-right"><input type="checkbox" name="other_details[export_promotion_council]" <?= $other_details->export_promotion_council ? ' checked ' : '' ?> value="1"></div>
                                                </li>
                                            </ul>
                                        </td>
                                        <td colspan="2" class="text-left"><label for="">Mandatory if PSD / EP copy delivery address other than IEC Add.</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left"><label for="">Post shipment document / EP delivery instructions</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <label for="">Contact person</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control requiredClass" name="other_details[contact_person]" id="#contact_person" value="<?= $other_details->contact_person ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">Telephone / Mobile</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" maxlength="13" class="only-numbers requiredClass" name="other_details[mobile_no]" value="<?= $other_details->mobile_no ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">Street Address 1</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control requiredClass" name="other_details[street_addr1]" id="#street_addr1" value="<?= $other_details->street_addr1 ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">Street Address 2</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control requiredClass" name="other_details[street_addr2]" id="#street_addr2" value="<?= $other_details->street_addr2 ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">City</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control requiredClass" name="other_details[city]" id="#city" value="<?= $other_details->city ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">PIN number</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" maxlength="7" class="only-numbers requiredClass" name="other_details[pin_no]" value="<?= $other_details->pin_no ?>">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label for="">Any other instructions on Post shipment docs / EP delivery</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">Details of Duty Benefit Claimed</label><br>
                                            <label for="">Drawback</label><br>
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <td><label for="">Inv Item No.</label></td>
                                                        <td>
                                                            <label for="">Bank Name</label>
                                                        </td>
                                                        <td>
                                                            <label for="">A/c No.</label>
                                                        </td>
                                                        <td>
                                                            <label for="">DBK Sr. No.</label>
                                                        </td>
                                                        <td>
                                                            <label for="">DBK Rate</label>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) { ?>
                                                        <?php foreach ($items as $key => $item) { ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="text" maxlength="7" class="only-numbers requiredClass" name="items[<?= $key ?>][inv_item_no]" value="<?= $item->inv_item_no ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control requiredClass" name="items[<?= $key ?>][bank_name]" value="<?= $item->bank_name ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" maxlength="7" class="only-numbers requiredClass" name="items[<?= $key ?>][ac_no]" value="<?= $item->ac_no ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" maxlength="7" class="only-numbers requiredClass" name="items[<?= $key ?>][dbk_sr_no]" value="<?= $item->dbk_sr_no ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" maxlength="7" class="only-numbers requiredClass" name="items[<?= $key ?>][dbk_rate]" value="<?= $item->dbk_rate ?>">
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="5">
                                                            <a class="btn btn-sm text-primary add-new-line-btn"><i class="fa fa-plus"></i> Add new line</a>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">Drawback Item Declaration</label><br>

                                            <div class="text-center">
                                                <label for="">DBK 001 </label>
                                                <input type="text" name="" id="">
                                                <label for="">DBK 002 </label>
                                                <input type="text" name="" id="">
                                                <label for="">DBK 003 </label>
                                                <input type="text" name="" id="">
                                            </div><br>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">DEEC / EPCG Details</label><br>

                                            <label for="">Inv Item No </label>
                                            <label for="">REG No(If LIC prior to 2009):
                                                <input type="text" class="form-control requiredCass" name="other_details[reg_no]" value="<?= $other_details->reg_no ?>">
                                            </label>
                                            <label for="">Date: </label>
                                            <div class="editable input"><input type="text" class="date-picker form-control requiredClass" name="other_details[deec_date]" value="<?= printFormatedDate($other_details->deec_date) ?>" maxlength="15"></div>
                                            <label for="">EPCG / DEEC LIC No. / Date: </label>
                                            <div class="editable input"><input type="text" class="date-picker form-control requiredClass" name="other_details[epcg_date]" value="<?= printFormatedDate($other_details->epcg_date) ?>" maxlength="15"></div>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">Any Other Documents:</label><br>
                                            <div class="text-center"><label for="">If MEIS box is ticked in type of shippping bill please mention on the Shipping Bill as under:</label><br>
                                                <label for="">"We intend to claim rewards under Merchandise Export From India Scheme (MEIS)"</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">Other Handling Information</label><br>
                                            <div>
                                                <label for="">GSP REQUIRED? If YES - (It will be prepared by Jeena & Co.)</label><br>
                                                <label for="">If NO - Please provide the GSP (if applicable).</label>
                                                <label for="">GSP Type:</label>
                                                <label>Normal <input type="radio" name="other_details[gsp_type]" <?= $other_details->gsp_type ? ' checked ' : '' ?> value="1"></label>
                                                <label>Tatkal <input type="radio" name="other_details[gsp_type]" <?= $other_details->gsp_type ? ' checked ' : '' ?> value="1"></label>
                                                <label for="">(Same Day) (Please tick any one)</label><br>
                                                <label for="">GSP Registration No.: </label>
                                                <input type="text" class="form-control requiredClass" name="other_details[gsp_reg_no]" id="#gsp_reg_no" value="<?= $other_details->gsp_reg_no ?>">
                                                <label for="">Password: </label>
                                                <input type="text" class="form-control requiredClass" name="other_details[password]" id="#password" value="<?= $other_details->password ?>">
                                            </div><br>
                                            <label for="">Refer www.eicindia.gov.in. for further inquiry.</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left">
                                            <p>We hereby appoint ""FORWARDER NAME"" as our authorized CHA for filling of our export / import documents in our name & getting our cargo cleared as per the documents and information provided to them by us. We hereby also declare that the information in the subject invoice is as per our knowledge, true and correct and if during custom examination anything found contradictory / objectionable in the shipment neither CHA nor the carrier would be held responsible.</p><br>
                                            <label for="">I/ We declare that the particulars given herein are true, correct and complete</label>

                                            <label for="">I/We undertake to abide by provisions of Foreign Exchange Management Act, 1999, as amended from time to time, including realization / repatriation of foreign exchange to / from India.</label>

                                            <br><br><br>
                                            <label for="">Shipper Signature and Stamp</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Shipper Name & Designation:</label>
                                        </td>
                                        <td>
                                            <input type="text" placeholder="Name" class="form-control requiredClass" name="other_details[shippers_name]" id="#shippers_name" value="<?= $other_details->shippers_name ?>">

                                            <input type="text" placeholder="Designation" class="form-control requiredClass" name="other_details[shippers_desig]" id="#shippers_desig" value="<?= $other_details->shippers_desig ?>">
                                        </td>
                                        <td><label for="">Contact Details:</label></td>
                                        <td><input type="text" class="form-control requiredClass" name="other_details[contact_details]" id="#contact_details" value="<?= $other_details->contact_details ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">MANDATORY REQUIREMENTS FOR BELOW SHIPPING TYPES Note: EVD IS MUST FOR EVERY TYPES OF S/B )</label></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label for="">DRAWBACK</label><br>
                                            <label for="">Cenvat Form</label>
                                            <label for="">(with comm, division and range)</label><br>
                                            <label for="">Anex 7 (for Leather Items)</label><br>
                                            <label for="">Net Wt of Items</label>
                                        </td>
                                        <td class="text-left">
                                            <label for="">DEEC / DFIA</label><br>
                                            <label for="">Original Consumption Sheet</label><br>
                                            <label for="">Copy of Registration Sheet</label><br>
                                            <label for="">IEC Copy</label><br>
                                            <label for="">EPCG</label>
                                        </td>
                                        <td class="text-left">
                                            <label for="">EPCG Licence</label><br>
                                            <label for="">Copy of Reg. Sheet</label><br>
                                            <label for="">RE-EXPORT</label><br>
                                            <label for="">Original Bill of Entry</label><br>
                                            <label for="">Original Import Invoice</label>
                                        </td>
                                        <td class="text-left">
                                            <label for="">GR Waiver (Bank NOC)</label><br>
                                            <label for="">Chartered Engg.Certificate</label><br>
                                            <label for="">100% EOU</label><br>
                                            <label for="">ANEX. C1</label><br>
                                            <label for="">ARE 1</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
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
                                    </tr>

                                </tbody>
                            </table>
                            <center>
                                <input type="submit" value="Save as Draft" name="submitBtn" class="btn btn-warning">
                                <input type="submit" value="Create Document" name="submitBtn" id="createDocumentBtn" class="btn btn-success">
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

                <td><input type="text" maxlength="7" class="only-numbers requiredClass" name="items[{uid}][inv_item_no]"></td>
                <td><input type="text" class="form-control requiredClass" maxlength="12" name="items[{uid}][bank_name]"></td>
                <td><input type="text" class="only-numbers requiredClass" maxlength="12" name="items[{uid}][ac_no]"></td>
                <td><input type="text" class="only-numbers requiredClass" maxlength="12" name="items[{uid}][dbk_sr_no]"></td>
                <td><input type="text" class="only-numbers requiredClass" maxlength="12" name="items[{uid}][dbk_rate]">

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

            "other_details[contract_type]": {
                required: true,
            },
            "other_details[other_specified]": {
                required: function(element) {
                    return $('input[name="other_details[contract_type]"]:checked').val() == 'true';
                }
            }

        },
        messages: {}

    });
</script>

<script>
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
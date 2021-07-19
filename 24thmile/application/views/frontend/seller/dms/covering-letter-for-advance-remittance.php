<style>
   
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
                            <h3 class="heading3-border">Advance Remittance</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <div>To,</div>
                            <!-- <div class=" text-right">Date: <input type="text" class="date-picker form-control requiredClass" name="invoice_date" value="<?= printFormatedDate($documentData->invoice_date) ?>" maxlength="15"></div> -->
                            <div class="float-right">Date:<input type="text" class="date-picker form-control requiredClass" name="other_details[document_date]" value="<?= printFormatedDate($other_details->document_date) ?>" maxlength="15"></div>

                            <div>The Branch Manager</div>
                            <div><input type="text" class="col-lg-3" maxlength="50" placeholder="Name of Bank" class="form-control requiredClass" name="other_details[name_of_bank]" value="<?= $other_details->name_of_bank ?>"></div>
                            <div><input type="text" class="col-lg-3" maxlength="50" placeholder="Name of Branch" class="form-control requiredClass" name="other_details[name_of_branch]" value="<?= $other_details->name_of_branch ?>"></div>
                           <br><br>
                            <p>We wish to make an advance payment towards import of Name of Material (Goods / Services) as part of our Raw Material /Capital Goods requirement:
                                <input type="text" class="col-lg-3" maxlength="50" placeholder="Name of Material" class="form-control requiredClass" name="other_details[name_of_material]" value="<?= $other_details->name_of_material ?>">
                            </p>
                            <p>Request you to process the Import remittances / Demand Draft request as per following request: </p>
                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">
                                </colgroup>
                                <tbody>

                                    <tr>
                                        <td colspan="1">
                                            <label for="">Name & Address of the Customer:</label>
                                        </td>
                                        <td colspan="1">
                                            <input type="text" class="form-control requiredClass" placeholder="Company Name" maxlength="50" name="other_details[customer_name]" value="<?= $other_details->customer_name ?>">
                                            <input type="text" class="form-control requiredClass" placeholder="Address" maxlength="50" name="other_details[customer_address]" value="<?= $other_details->customer_address ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Account to be debited</label>
                                        </td>
                                        <td colspan="1"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[account_number_debit]" value="<?= $other_details->account_number_debit ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Account to be debited for charges</label>
                                        </td>
                                        <td colspan="1">
                                            <div>
                                                <label>Account Number</label>
                                                <div class="editable"><input type="text" maxlength="50" class="form-control requiredClass" name="other_details[account_number_debit_charges]" value="<?= $other_details->account_number_debit_charges ?>">
                                                </div>
                                                <label>( ) Net off i.e. On beneficiary.</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Amount and currency to be remitted (figures & words)</label>
                                        </td>
                                        <td colspan="1">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">

                                                    <select class="requiredClass form-control custom-select input-group-text" id="selectCurrency" name="currency" style="width: 80px;" aria-describedby="shipment_value_currency-error">
                                                        <option selected disabled>Currency</option>
                                                        <?php foreach (getCountryCurrency() as $countryCurrency) { ?>
                                                            <option value="<?= $countryCurrency->currency ?>" <?= $documentData->currency == $countryCurrency->currency ? 'selected' : ''; ?>><?= $countryCurrency->currency ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <input type="text" maxlength="50" class="decimal-numbers form-control" id="remitted" name="other_details[currency_remitted]" value="<?= $other_details->currency_remitted ?>">

                                            </div>

                                            <textarea name="other_details[amount_in_words]" readonly id="amountInWords" class="form-control" cols="40" rows="1" style="resize: none;"><?= $other_details->amount_in_words ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Beneficiary name and address</label>
                                        </td>
                                        <td colspan="1">
                                            <input type="text" class="form-control requiredClass" placeholder="Company Name" maxlength="50" name="other_details[benificiary_company_name]" value="<?= $other_details->benificiary_company_name ?>">
                                            <input type="text" class="form-control requiredClass" placeholder="Address1" maxlength="50" name="other_details[benificiary_company_address1]" value="<?= $other_details->benificiary_company_address1 ?>">
                                            <input type="text" class="form-control requiredClass" placeholder="Address2" maxlength="50" name="other_details[benificiary_company_address2]" value="<?= $other_details->benificiary_company_address2 ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Beneficiary Bank name and address</label>
                                        </td>
                                        <td colspan="1">
                                            <input type="text" class="form-control requiredClass" placeholder="Bank Name" maxlength="50" name="other_details[benificiary_bank_name]" value="<?= $other_details->benificiary_bank_name ?>">
                                            <input type="text" class="form-control requiredClass" placeholder="Address" maxlength="50" name="other_details[benificiary_bank_address]" value="<?= $other_details->benificiary_bank_address ?>">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Beneficiary Bank Account No.</label>
                                        </td>
                                        <td colspan="1"><input type="text" class="form-control requiredClass" placeholder="Account Number" maxlength="50" name="other_details[benificiary_account_number]" value="<?= $other_details->benificiary_account_number ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Swift code / ABA / Routing no / Sort code of Beneficiary bank</label>
                                        </td>
                                        <td colspan="1"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[benificiary_bank_code]" value="<?= $other_details->benificiary_bank_code ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Correspondent / intermediary bank name and address</label>
                                        </td>
                                        <td colspan="1">
                                            <input type="text" class="form-control requiredClass" placeholder="Bank Name" maxlength="50" name="other_details[correspondent_bank_name]" value="<?= $other_details->correspondent_bank_name ?>">
                                            <input type="text" class="form-control requiredClass" placeholder="Address" maxlength="50" name="other_details[correspondent_bank_address]" value="<?= $other_details->correspondent_bank_address ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Correspondent Bank Account No.</label>
                                        </td>
                                        <td colspan="1"><input type="text" class="form-control requiredClass" placeholder="Account Number" maxlength="50" name="other_details[correspondent_account_number]" value="<?= $other_details->correspondent_account_number ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Swift code / ABA / Routing no / Sort code of Correspondent bank</label>
                                        </td>
                                        <td colspan="1"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[correspondent_bank_code]" value="<?= $other_details->correspondent_bank_code ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Foreign bank charges</label>
                                        </td>
                                        <td colspan="1">
                                            <div> <label>() On US</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[foreign_bank_charges_onus]" value="<?= $other_details->foreign_bank_charges_onus ?>"></div>
                                            </div>
                                            <div>
                                                <label>() On Beneficiary</label>
                                                <div class="editable">
                                                    <input type="text" class="form-control requiredClass" maxlength="50" name="other_details[foreign_bank_charges_onbenif]" value="<?= $other_details->foreign_bank_charges_onbenif ?>">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Mandatory for Advance Import Payment Shipment details</label>
                                        </td>
                                        <td colspan="1">
                                            <div><label>Expected Date of Dispatch / Download (software)</label>
                                                <div class="editable"><input type="text" class="date-picker form-control requiredClass" name="other_details[date_of_dispatch]" value="<?= printFormatedDate($other_details->date_of_dispatch) ?>" maxlength="15"></div>
                                            </div>
                                            <div><label>Name of the shipping company / airlines</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[foreign_bank_charges_onbenif]" value="<?= $other_details->foreign_bank_charges_onbenif ?>"></div>
                                            </div>
                                            <div><label>Port of Dispatch</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[port_of_dispatch]" value="<?= $other_details->port_of_dispatch ?>"></div>
                                            </div>
                                            <div><label>Destination Port</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[destination_port]" value="<?= $other_details->destination_port ?>"></div>
                                            </div>
                                            <div><label>Country of Origin of goods</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[country]" value="<?= $other_details->country ?>"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td colspan="1">
                                            <label for="">Goods description and HS classification code</label>
                                        </td>
                                        <td colspan="1">
                                            <div class="editable"><input type="text" class="form-control requiredClass" placeholder="Description" maxlength="50" name="other_details[goods_description]" value="<?= $other_details->goods_description ?>">
                                            </div>
                                            <div class="editable"><input type="text" class="form-control requiredClass" placeholder="Code" maxlength="50" name="other_details[hs_code]" value="<?= $other_details->hs_code ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Import License Details (if applicable)</label>
                                        </td>
                                        <td colspan="1">
                                            <div class="editable"><input type="text" class="form-control requiredClass" placeholder="Import-Export Code" maxlength="50" name="other_details[import_export_code]" value="<?= $other_details->import_export_code ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Special REF No. to be mentioned in Swift</label>
                                        </td>
                                        <td colspan="1">
                                            <div class="editable"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[special_ref_no]" value="<?= $other_details->special_ref_no ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Rate / contract booked with treasury – if any</label>
                                        </td>
                                        <td colspan="1">
                                            <div class="editable"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[rate_with_treasury]" value="<?= $other_details->rate_with_treasury ?>">
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <br><br>
                            <div class="text-right"><label>Customers Signature and Stamp</label></div><br>
                            <div> We undertake that we shall make physical import within 6 months from the date of remittance (Maximum Period - 3 years in case
                                of Capital goods) and documentary evidence of import (Bill of entry – Exchange control copy or Courier Bill of Entry or CA certificate
                                in case of Non Physical import) will be furnished within 15 days from the date of import. In case of non-import within the above
                                specified period, we shall arrange to repatriate the funds and submit original FIRC to the bank.</div>
                            <br>
                            <div><label><u>CBDT Requirement-</u></label> We hereby confirm to adhere the changes in taxation policy, as per the CBDT notification S.O.2659(E) dated 2nd Sept 2013, enforceable from 1st Oct 2013.</div>
                            <br>
                            <div><label><u>OFAC Declaration-</u></label> I / We hereby declare that the above transaction does not involve, and is not designed for the purpose of any contravention or evasion of the provisions of the OFAC.</div>
                            <br>
                            <div><label><u>FATF Declaration (tick if applicable)-</u></label> We are aware that the above remittance is being made to a FATF listed country and as per prevailing AML guidelines, all due diligence of the beneficiary has been carried out at our end. We indemnify the bank and request that the remittances should be
                                carried out at our risk and responsibility. We shall not hold HDFC Bank responsible if proceeds for the said transaction are held by
                                any foreign regulators or reach beneficiary with delay. If any additional information is sought by foreign regulators or
                                correspondent bank or by any other external or internal authorities, the same will be provided by us to ensure completion of the
                                transaction. Any loss / charges arising out of the said transaction will be borne by us.    <div class="pull-right"><input type="checkbox" name="other_details[fatf]" <?= $other_details->fatf ? ' checked ' : '' ?> value="1"></div></div>
                            <br>
                            <div><label><u>FEMA Declaration- CUM - Undertaking</u></label></div>
                            <div>
                                <strong>The goods imported by us are (Pls select any one):</strong>

                                <div>
                                    <input type="radio" name="other_details[goods_imported]" <?= $other_details->goods_imported=="not_covered" ? ' checked ' : '' ?> value="not_covered">
                                    Not covered under prohibited or restricted list and are freely importable as per relevant para and Chapters of the extant Foreign Trade Policy and amendments there to.
                                </div>
                                <div>

                                    <input type="radio" name="other_details[goods_imported]" <?= $other_details->goods_imported == "restricted" ? ' checked ' : '' ?> value="restricted">
                                    Restricted for import as per relevant para and Chapters of the extant Foreign Trade Policy and amendments there to and original exchange control copy of the license issued by D.G.F.T. is enclosed.
                                </div>
                            </div><br>
                            <div>
                                We are eligible to import the above mentioned goods under the extant Foreign Trade policy. Our Importer Exporter Code is:
                                <div class="editable"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[iec_no]" value="<?= $other_details->iec_no?>">
                            </div><br>
                            <div>

                                I / We hereby declare that the above transaction does not involve, and is not designed for the purpose of any contravention or
                                evasion of the provisions of the FEMA 1999 or of any rule, regulation, notification, direction or order made thereunder. I/ We also
                                hereby agree and undertake to give such information/ documents as will reasonably satisfy you about this transaction in terms of
                                the above declaration. I/ We also undertake that if I/ We refuse to comply with any such requirements or make only unsatisfactory
                                compliance therewith, the bank shall refuse in writing to undertake the transaction and shall if it has reason to believe that any
                                contravention /evasion is contemplated by me /us report the matter to Reserve Bank Of India. *I / We further declare that the
                                undersigned has/have the authority to give this declaration and undertaking on behalf of the firm/company.

                            </div>
                            <br>
                            <div>
                                <input type="checkbox" name="other_details[part_payment]" <?= $other_details->part_payment ? ' checked ' : '' ?> value="1"> Part Payment – We are hereby paying only part amount of Invoice due to 
                                <div class="editable"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[part_payment_amt]" value="<?= $other_details->part_payment_amt?>"></div>
                            </div>
                            <br>
                            <div class="col-lg-12">
                                <hr style="margin: 1.5rem 1rem 0 0;">
                            </div>
                            <br>
                            <div>We further confirm that the above remittance has not been affected through any other Authorized Dealer</div>
                            <div>
                                <u>Documents Attached:</u>
                            </div>
                            <div>
                                <input type="checkbox" name="other_details[performa_invoice]" <?= $other_details->performa_invoice ? ' checked ' : '' ?> value="1"> Proforma Invoice (Duly accepted by the importer)
                            </div>
                            <div>
                                <input type="checkbox" name="other_details[purchase_order]" <?= $other_details->purchase_order ? ' checked ' : '' ?> value="1"> Purchase order
                            </div>
                            <div>
                                <input type="checkbox" name="other_details[original_license]" <?= $other_details->original_license ? ' checked ' : '' ?> value="1"> Original License (Exchange control copy), If applicable
                            </div>
                            <div>
                                <input type="checkbox" name="other_details[bank_guarantee]" <?= $other_details->bank_guarantee ? ' checked ' : '' ?> value="1"> Original Bank Guarantee (If amount of advance remittance exceeds USD 200000 or Equivalent)
                            </div>
                            <div>
                                <input type="checkbox" name="other_details[other_doc]" <?= $other_details->other_doc ? ' checked ' : '' ?> value="1"> Other documents. Please specify:
                                <div class="editable"><input type="text" class="form-control requiredClass" maxlength="50" name="other_details[other_doc_name]" value="<?= $other_details->other_doc_name ?>"></div>
                            </div>
                            <div>
                                <p>Yours Faithfully</p>
                            </div>
                            <!-- <div> -->
                            <div>For,
                                <div class="editable">
                                    <input type="text" class="form-control requiredClass" placeholder="Company Name" maxlength="50" name="other_details[company_name]" value="<?= $other_details->company_name ?>">
                                </div>
                                <!-- <?= $other_details->customer_name ?> -->
                            </div>
                            <!-- </div> -->
                            <br><br>
                            <div>
                                <p>Authorised Signatory</p>
                            </div>
                            <div>
                                (Rubber stamp and authorized signatory name and signature)
                            </div>
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


    $('#selectCurrency').change(function() {
        // var tableid = '#' + $(this).closest('table').attr('id');
        let rem_currency = $('#remitted').val();
        $('#amountInWords').val(amountInWords(rem_currency, $('#selectCurrency').val()));
    });

    $('#remitted').blur(function() {
        // var tableid = '#' + $(this).closest('table').attr('id');
        let rem_currency = $('#remitted').val();
        $('#amountInWords').val(amountInWords(rem_currency, $('#selectCurrency').val()));
    });
</script>


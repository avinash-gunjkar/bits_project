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
        font-weight: none;
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
        width: 70%;
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

    table tr td.sr-no::before {
        counter-increment: srno;
        content: counter(srno);
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
                            <h2 class="heading3-border">Second Bill Of Exchange</h2>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                       <br/>
                       <label  style="min-width: 30px;">Date</label>
                                <div class="editable">
                                    <input type="text" name="other_details[second_bill_date]" class="date-picker form-control " value="<?= $other_details->second_bill_date? $other_details->second_bill_date : printFormatedDate(date('Y-m-d')) ?>">
                                </div>
                                <br/>
                               <br/> 
                               <p>Drawn under Letter of Credite Number : <span><input type="text" maxlength="15" name="other_details[second_credite_number]" class="requiredClass" placeholder="Credite Number.." value=<?= $other_details->second_credite_number ?>></span> .Dated
                               <span><input type="text" name="other_details[second_credit_date]" class="date-picker" value="<?= $other_details->second_credit_date ?>"></span>
                               </p>
                               <label>ISSUING BANK :-</label>
                               <span><input type="text" maxlength="15" name="other_details[second_bill_exc_bank_name]" class="requiredClass" style="width: 25%;" placeholder="Bank Name.." value=<?= $other_details->second_bill_exc_bank_name ?>></span>
                               <div>
                               <input type="text" maxlength="50" name="other_details[second_bill_exc_address1]" class="requiredClass" style="width: 34%;" placeholder="Address_Line1..." value=<?= $other_details->second_bill_exc_address1 ?>>
                               </div>
                               <div style="padding: 5px 0px;">
                               <input type="text" maxlength="50" name="other_details[second_bill_exc_address2]" class="requiredClass" style="width: 34%;" placeholder="Address_Line2..." value=<?= $other_details->second_bill_exc_address2 ?>>
                               </div>
                               <p>
                               AT SIGHT PAY THIS SECOND OF EXCHANGE (FIRST OF THE SAME TENOR AND DATE BEING UNPAID) TO THE ORDER OF EXPORTER BANK, BRANCH, INDIA) CITY- COUNTRY. A SUM OF
                               <select class="requiredClass form-control custom-select" onChange="caculateFinaltotal" id="selectCurrency" name="currency" style="width: 80px;" aria-describedby="shipment_value_currency-error">
                                    <option selected disabled>Currency</option>
                                    <?php foreach (getCountryCurrency() as $countryCurrency) { ?>
                                    <option value="<?= $countryCurrency->currency ?>" <?= $documentData->currency == $countryCurrency->currency ? 'selected' : ''; ?>><?= $countryCurrency->currency ?></option>
                                    <?php } ?>
                                </select>
                                <span>
                                   <input type="number" maxlength="10" name="other_details[second_bill_amount]" id="bill_amount" class="requiredClass" style="width: 20%" placeholder="Amount..." value=<?= $other_details->second_bill_amount ?>>
                                </span>  
                               </p>
                               <textarea name="other_details[amount_in_words]" readonly id="amountInWords" class="form-control" rows="2" style="resize: none;"><?= $other_details->amount_in_words ?></textarea>
                               <br><p>
                               FOR 100% VALUE RECEIVED OUR INVOICE NUMBER:- <span><input type="text" maxlength="20" name="other_details[second_bill_exc_cumm_invoice]" class="requiredClass" style="width: 15%;" placeholder="Invoice Number..." value=<?= $other_details->second_bill_exc_cumm_invoice ?>></span>
                               Date:- <span><input type="text" name="other_details[second_bill_exc_cumm_invoice_date]" class="date-picker" value="<?= $other_details->first_bill_exc_cumm_invoice? $other_details->second_bill_exc_cumm_invoice_date : printFormatedDate(date('Y-m-d')) ?>"></span>
                               <div style="padding: 30px 0px;">
                               For <input type="text" name="other_details[exporter_company_name]" class="requiredClass" style="width: 40%" placeholder='Name of exporter company' value="<?= $other_details->exporter_company_name ?>">
                               </div>
                               <div>
                               <label style="min-width: 40px;">Authorized Person -</label>
                                <span>
                                    <input type="text" name="other_details[name_of_authorized_signatory]" class="requiredClass" style="width: 35%" placeholder='Name of authorized person' value="<?= $other_details->name_of_authorized_signatory ?>">
                                </span>
                                <br><label style="min-width: 105px;">Designation -</label>
                                <span>
                                    <input type="text" name="other_details[designation]" class="requiredClass" style="width: 35%" placeholder='designatio of person' value="<?= $other_details->designation ?>">
                                </span>
                                </div>
                               <div style="padding: 20px 0px;">
                               <b>To,</b>
                               <div style="padding: 5px 0px;">
                               <input type="text" maxlength="20" name="other_details[second_importer_bank_code]" class="requiredClass" style="width: 30%;" placeholder="Importer Bank code..." value=<?= $other_details->second_importer_bank_code ?>>
                               </div>
                               <div style="padding: 5px 0px;">
                               <input type="text" maxlength="100" name="other_details[second_importer_bank_name]" class="requiredClass" style="width: 30%;" placeholder="Importer Bank Name..." value=<?= $other_details->second_importer_bank_name ?>>
                               </div>
                               <div style="padding: 5px 0px;">
                               <input type="text" maxlength="70" name="other_details[second_importer_bank_city_country]" class="requiredClass" style="width: 30%;" placeholder="City, Country..." value=<?= $other_details->second_importer_bank_city_country ?>>
                               </div>

                               </div>
                               </p>
                            <center>
                                <input type="submit" value="Save" name="submitBtn" class="btn btn-success">
                                <!--<input type="submit" value="Create Document" name="submitBtn" id="createDocumentBtn" class="btn btn-success">-->
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
</script>
<script>

  $('#selectCurrency,#bill_amount').change(function(){
      let amount = parseFloat(document.getElementById("bill_amount").value)||0.00;
      let currency = $('#selectCurrency').val();
      $('#amountInWords').val(amountInWords(amount, currency));
        });

</script>
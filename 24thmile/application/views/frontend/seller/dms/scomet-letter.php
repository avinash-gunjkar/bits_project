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
                            <h2 class="heading3-border">Non-Scomet Declaration</h2>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                       <br/>
                       
                        <label  style="min-width: 30px;">Date</label>
                                <div class="editable">
                                    <input type="text" name="other_details[scomet_date]" class="date-picker form-control " value="<?= $other_details->scomet_date? $other_details->scomet_date : printFormatedDate(date('Y-m-d')) ?>">
                                </div>
                                <br/>
                               <br/> 
                               <label>To,</label>
                               <div style="padding: 5px 0px;">
                               <input type="text" maxlength="40" name="other_details[scomet_letter_add1]" class="requiredClass" style="width: 34%;" placeholder="Address_Line1..." value="<?= $other_details->scomet_letter_add1? $other_details->scomet_letter_add1 : 'The Dy/Asst. Commissioner of Custom,' ?>">
                               </div>
                               <div style="padding: 5px 0px;">
                               <input type="text" maxlength="50" name="other_details[scomet_letter_add2]" class="requiredClass" style="width: 34%;" placeholder="Address_Line2..." value="<?= $other_details->scomet_letter_add2? $other_details->scomet_letter_add2 : 'Export Department,' ?>">
                               </div>
                               <div style="padding: 5px 0px;">
                               <input type="text" maxlength="50" name="other_details[scomet_letter_add3]" class="requiredClass" style="width: 34%;" placeholder="Address_Line3..." value="<?= $other_details->scomet_letter_add3? $other_details->scomet_letter_add3 : 'Mumbai,' ?>">
                               </div>
                               <br>
                               <div style="padding: 10px 0px;">
                               <label style="min-width: 30px;">Reference :- </label>
                               <span><input type="text" maxlength="70" name="other_details[reference]" class="requiredClass" style="width: 50%;" placeholder="Please Add Reference..." value="<?= $other_details->reference?>"></span>
                               </div>
                               <div style="padding: 05px 0px;">
                               <label style="min-width: 70px;">Subject :- </label>
                               <span><input type="text" maxlength="70" name="other_details[subject]" class="requiredClass" style="width: 50%;" placeholder="Please Add Subject..." value="<?= $other_details->subject?>"></span>
                               </div>
                               <div style="padding: 20px 0px">
                                <label>Dear</label> 
                                <span>
                                <select name="other_details[mam_sir]" class="requiredClass">
                                                <option value="Madam/Sir ," <?= "Madam/Sir" == $other_details->mam_sir ? ' selected ' : '' ?>> Madam/Sir , </option>
                                                <option value="Sir ," <?= "Sir" == $other_details->mam_sir ? ' selected ' : '' ?>>Sir ,</option>
                                                <option value="Madam ," <?= "Madam" == $other_details->mam_sir ? ' selected ' : '' ?>>Madam ,</option>
		                                        </select>
                                </span>
                            </div>
                               <p>
                               <div style="padding: 15px 0px;">
                               With reference to the above shipment we declare that the export item
                               </div>
                               <textarea name="other_details[product_details]" placeholder="Product Details.." class="form-control requiredClass" rows="2" style="resize: none; width: 70%;"><?= $other_details->product_details ?></textarea>
                               <div style="padding: 15px 0px;">
                               being exported to
                               <span><input type="text" maxlength="50" name="other_details[importer_address]" class="requiredClass" style="width: 30%;" placeholder="Import Address (city,State,Country)..." value=<?= $other_details->importer_address? $other_details->importer_address : $other_details->consignee_city ?>></span> 
                               item does not comes under SCOMET list of item as per the customs act 1962 and we take whole responsibility of the export consignment to note rule under SCOMET list of item and further they allow to exported from India without any restriction and prohibition as per the customs act 1962 rules and act amended from time to time as per the customs act 1962.
                               </div>
                               We hereby request you to kindly release the above shipment.
                               <br>
                               Thanking you,<br><br>
                               Your faithfully,
                               </p>
                               <div style="padding: 10px 0px;">
                               For <input type="text" name="other_details[exporter_company_name]" class="requiredClass" style="width: 40%" placeholder='Name of exporter company' value="<?= $other_details->exporter_company_name ?>">
                               </div>
                               <div>
                               <label style="min-width: 30px;">Authorized Person -</label>
                                <span>
                                    <input type="text" name="other_details[name_of_authorized_signatory]" class="requiredClass" style="width: 35%" placeholder='Name of authorized person' value="<?= $other_details->name_of_authorized_signatory ?>">
                                </span>
                                <br><label style="min-width: 113px;">Designation -</label>
                                <span>
                                    <input type="text" name="other_details[designation]" class="requiredClass" style="width: 35%" placeholder='designatio of person' value="<?= $other_details->designation ?>">
                                </span>
                                </div>
                               <br><br>    
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

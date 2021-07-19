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
                            <h3 class="heading3-border">Authorisation Letter to Custom House Agent</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <div>Date: <div class="editable"><input type="text" class="date-picker form-control requiredClass" name="other_details[document_date]" value="<?= printFormatedDate($other_details->document_date) ?>" maxlength="15"></div>
                            </div>
                            <br>
                            <div class="text-center">
                                <h3><u><strong>To whomsoever it may Concern</strong></u></h3>
                            </div>
                            <br> 
                            <div>
                                <p>We, <input type="text" class="col-lg-2" placeholder="Company Name" class="form-control requiredClass" name="other_details[exporter_company_name]" value="<?= $other_details->exporter_company_name ?>">
                                    , importer and exporter bearing an Import Export Code <input type="text" class="col-lg-2" placeholder="Code" minlength='6' class="form-control requiredClass" name="other_details[iec_no]" value="<?= $other_details->iec_no ?>">
                                    issued by the Director General of Foreign Trade having office at <input type="text" class="col-lg-2" placeholder="Address 1" class="form-control requiredClass" name="other_details[exporter_address_line_1]" value="<?= $other_details->exporter_address_line_1 ?>">,
                                    <input type="text" class="col-lg-2" placeholder="Address 2" class="form-control requiredClass" name="other_details[exporter_address_line_2]" value="<?= $other_details->exporter_address_line_2 ?>">
                                    and holding a valid PAN <input type="text" class="col-lg-2" placeholder="PAN Number" class="form-control requiredClass" name="other_details[pan_no]" value="<?= $other_details->pan_no ?>">
                                    is hereby appoints M/s. <input type="text" class="col-lg-2" placeholder=" CHA Name" class="form-control requiredClass" name="other_details[cha_name]" value="<?= $other_details->cha_name ?>">
                                    having a PAN based License Number <input type="text" class="col-lg-2" placeholder="License No." class="form-control requiredClass" name="other_details[license_no]" value="<?= $other_details->license_no ?>"> and having CHA
                                    Registration Number (<input type="text" class="col-lg-2" placeholder="CHA Registration No." class="form-control requiredClass" name="other_details[cha_reg_no]" value="<?= $other_details->cha_reg_no ?>">) to perform customs clearance and forwarding on behalf
                                    of us.
                                </p>
                            </div>
                            <br>
                            <div>
                                <p>We hereby hold the responsibility of the act of <?= $other_details->cha_name ?> as of our own against our Import and / or Export consignments while handling.</p>
                            </div>
                            <br>
                            <div>
                                <p>The Know Your Customer (KYC) as required and mandated by the Indian Customs vide
                                    CBEC circular 09/2010 and 33/2010 for identification / verification of importers /
                                    exporters for customs clearance performed by the Customs Broker is enclosed along
                                    with for records.
                                </p>
                            </div>
                            <br>
                            <div>
                                <p>Thanking you.</p>
                            </div>
                            <div>
                                <p>For, <input type="text" maxlength="50" name="for_consignor_company" value="<?= $documentData->for_consignor_company ?>"></p>
                            </div>
                            <br><br>
                            <div><input type="text" class="col-lg-2" placeholder="Authorized Person Name" class="form-control requiredClass" name="other_details[name_of_authorized_signatory]" value="<?= $other_details->name_of_authorized_signatory ?>"></div>
                            <div><input type="text" class="col-lg-2" placeholder="Designation" class="form-control requiredClass" name="other_details[designation]" value="<?= $other_details->designation ?>"></div>
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
</script>
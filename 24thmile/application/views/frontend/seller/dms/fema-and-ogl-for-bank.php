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

    span.dash-space {
        width: 300px;
        display: inline-block;
        border-bottom: 1px dashed #000;
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
                            <h3 class="heading3-border">FEMA & OGL for Bank</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <!-- <div> -->
                            <div class="col-lg-1">To,</div>
                            <div class="col-lg-4"><input type="text" maxlength="50" title="Name of Branch Manager" placeholder="Name of Branch Manager" class="form-control requiredClass" name="other_details[branch_manager_name]" value="<?= $other_details->branch_manager_name ?>"></div>
                            <div class="col-lg-4"><input type="text" maxlength="50" title="Place" placeholder="Place" class="form-control requiredClass" name="other_details[branch_place]" value="<?= $other_details->branch_place ?>"></div>
                            <div class="col-lg-4"><input type="text" maxlength="50" title="Name of Bank" placeholder="Name of Bank" class="form-control requiredClass" name="other_details[name_of_bank]" value="<?= $other_details->name_of_bank ?>"></div>
                            <br><br>
                            <!-- </div> -->
                            <p><u>Ref : Declaration Cum Undertaking Under Section 10(5) , Chapter III of the Foreign Exchange Management Act, 1999.</u></p><br>
                            <p>I/We hereby declare that the transaction the details of which are specifically mentioned in the Schedule
                                hereunder does not involve, and is not designed for the purpose of any contravention or evasion of the
                                provisions of the aforesaid Act or of any rule, regulation, notification, direction or order made thereunder.</p><br>

                            <p>I/We also hereby agree and undertake to give such information/documents as will reasonably satisfy you about this transaction in terms of the above declaration.</p><br>
                            <p>I/We also understand that if I/ We refuse to comply with any such requirement or make only satisfactory
                                compliance therewith, the Bank shall refuse in writing to undertake the transaction and shall if it has reason
                                to believe that any contravention/evasion is contemplated by me/us report the matter to the Reserve Bank of India.</p><br>
                            <p>I/We further declare that the undersigned has/have the authority to give this declaration and undertaking
                                on behalf of the firm /company.</p><br>
                            <p>The good imported under this transaction are under OGL and not under the negative list of imports.</p><br><br>
                            <p>Signature of the Applicant for Foreign Exchange</p>
                            <label>Place: </label>
                            <input type="text" class="col-lg-2" class="form-control requiredClass" name="other_details[place]" value="<?= $other_details->place ?>">



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
            "other_details[name_of_bank]": {
                required: true

            },
            "other_details[place]": {
                required: true
            },
        },
        messages: {
            bank_name: {
                required: "Please enter bank name.",

            },
            place: {
                required: "Please enter place",

            },

        }
    });
</script>

<script>
    $("#bank_details").validate({
        onfocusout: function(e) {
            $(e).valid()
        },
        rules: {
            bank_name: {
                required: true

            },
            place: {
                required: true
            },
        },
        messages: {
            bank_name: {
                required: "Please enter bank name.",

            },
            place: {
                required: "Please enter place",

            },

        }
    });
</script>
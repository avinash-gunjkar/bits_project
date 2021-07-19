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
        border-radius: 0% !important;
    }

    .section-title {
        text-align: left;
        padding-bottom: 0px;
        padding-top: 45px;
    }

    .wshipping-content-block {
        padding: 0px 0px;
    }

    .error {
        color: red;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
<!-- Tracking start -->
<div class="wshipping-content-block">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                        <h2><?= $pageheading ?></h2>

                        <!--<a class="btn btn-info btn-sm" href="<?= base_url('add-bank') ?>">Add new</a>-->

                        <div class="put-reference-number">
                            <!-- <form name="profileForm" id="profileForm" action="" method="post" enctype="multipart/form-data"> -->
                            <!--             <h3>User Details</h3>-->
                            <!-- <div class="row">
                                    <input type="hidden" name="bank_id" value="<?php echo $bank_details->id ?>">

                                    <div class="col-12">
                                        <div class="form-row mb-3">
                                            <div class="col">
                                                <label>Bank Name <sup>*</sup></label>
                                                <input type="text" class="form-control" name="bank_name" id="bank_name" maxlength="50" value="<?php echo $bank_details->bank_name ?>">
                                            </div>
                                            <div class="col">
                                                <label>Bank Address <sup>*</sup></label>
                                                <input type="text" class="form-control" name="bank_address" id="bank_address" maxlength="200" value="<?php echo $bank_details->bank_address ?>">
                                            </div>
                                            <div class="col">
                                                <label>Account Number <sup>*</sup></label>
                                                <input type="text" class="form-control" name="account_number" id="account_number" maxlength="50" value="<?php echo $bank_details->account_number ?>">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="col">
                                            <label>IFSC Code <sup>*</sup></label>
                                            <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" maxlength="50" value="<?php echo $bank_details->ifsc_code ?>">
                                        </div>
                                        <div class="col">
                                            <label>Swift Code <sup>*</sup></label>
                                            <input type="text" class="form-control" name="swift_code" id="swift_code" maxlength="10" value="<?php echo $bank_details->swift_code ?>">
                                        </div>
                                        <div class="col">
                                            <label>FAX Number <sup>*</sup></label>
                                            <input type="text" class="form-control" name="fax_number" id="fax_number" maxlength="50" value="<?php echo $bank_details->fax_number ?>">
                                        </div>
                                        <div class="col">
                                            <label>Status: </label>
                                            <label>Active <input type="radio" class="form-control" name="status" <?= $bank_details->status == "1" ? ' checked ' : '' ?> value="1"></label>
                                            <label>Inactive <input type="radio" class="form-control" name="status" <?= $bank_details->status == "0" ? ' checked ' : '' ?> value="0"></label>
                                        </div>

                                    </div>
                                </div> -->

                            <form id="bank_details" method="post" action="">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Bank Name <sup>*</sup></label>
                                    <!-- <label>Bank Name <sup>*</sup></label> -->
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bank_name" id="bank_name" maxlength="50" value="<?php echo $bank_details->bank_name ?>">
                                    </div>
                                </div>
                                <!-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Bank Address <sup>*</sup></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bank_address" id="bank_address" maxlength="200" value="<?php echo $bank_details->bank_address ?>">
                                    </div>
                                </div> -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Account Number <sup>*</sup></label>
                                    <!-- <label>Account Number <sup>*</sup></label> -->
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="account_number" id="account_number" maxlength="50" value="<?php echo $bank_details->account_number ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">IFSC Code <sup>*</sup></label>
                                    <!-- <label>IFSC Code <sup>*</sup></label> -->
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" maxlength="50" value="<?php echo $bank_details->ifsc_code ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Swift Code <sup>*</sup></label>
                                    <!-- <label>Swift Code <sup>*</sup></label> -->
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="swift_code" id="swift_code" maxlength="11" value="<?php echo $bank_details->swift_code ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Authorized Dealer Code <sup>*</sup></label>
                                    <!-- <label>FAX Number <sup>*</sup></label> -->
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " name="ad_code" onkeyup="addHyphen(this)" id="ad_code" minlength="7" maxlength="15" value="<?php echo $bank_details->ad_code ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <label class="form-check-label"><input type="radio" class="form-check-input" name="status" <?= $bank_details->status == "1" ||  $bank_details->status == "" ? ' checked ' : ''  ?> value="1"> Active</label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label"><input type="radio" class="form-check-input" name="status" <?= $bank_details->status == "0" ? ' checked ' : '' ?> value="0"> Inactive</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-submit">Save</button>
                                <a href="<?= base_url('company-banks/'); ?>" class="btn btn-secondary ">Cancel</a>
                                <!-- <button type="submit" class="btn btn-primary">Sign in</button> -->
                            </form>
                            <!-- <div class="col-12">
                                    <button type="submit" class="btn btn-submit">Save</button>
                                    <a href="<?= base_url('company-banks/'); ?>" class="btn btn-secondary ">Cancel</a>
                                </div> -->
                        </div>
                        <!-- </form> -->

                    </div>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>

<script>
    $("#bank_details").validate({
        onfocusout: function(e) {
            $(e).valid()
        },
        rules: {
            bank_name: {
                required: true

            },
            // bank_address: {
            //     required: true            
            // },
            account_number: {
                required: true

            },
            ifsc_code: {
                required: true
            },

            swift_code: {
                required: true,
            },
            ad_code: {
                required: true,
                minlength: 7,
                maxlength:15
            },
        },
        messages: {
            bank_name: {
                required: "Please enter bank name.",

            },
            bank_address: {
                required: "Please enter bank address",

            },
            account_number: {
                required: "Please enter account number",

            },
            ifsc_code: {
                required: "Please enter IFSC Code",
            },
            swift_code: {
                required: "Please enter swift code.",
            },
            ad_code: {
                required: "Please enter ad number",
                //minlength: "Enter minimum 7 characeters",
            },

        }
    });

   
</script>
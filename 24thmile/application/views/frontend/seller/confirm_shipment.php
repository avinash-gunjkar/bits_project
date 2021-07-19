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

    .from-user {
        background-color: #d5ffd5;
        padding: 5px;
        margin-bottom: 5px;
        margin-left: 50px;
        margin-top: 5px;
    }

    .to-user {
        background-color: #f9f6f6;
        padding: 5px;
        margin-bottom: 5px;
        margin-top: 5px;
        margin-right: 50px;
    }

    .communication-box {
        background-color: #f0f0f0;
        max-height: 200px;
        overflow-y: scroll;
    }

    @media (min-width: 840px) {
        .mdl-grid {
            padding: 8px;
            width: 100% !important;
        }
    }
</style>
<!-- Tracking start -->
<div class="wshipping-content-block">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">

                        <h3 class="heading3-border">Confirm Shipment</h3>


                        <!-- <div class="wshipping-content-block shipping-block">
                            <div class="container">
                                <div class="row"> -->
                        <div class="shipping-form-block">
                            <?php $transactionCurrencyHtml =  "&nbsp;(" . ($requestDetails->transaction_currency ? $requestDetails->transaction_currency : 'INR') . ")"; ?>

                            <form id="frmRequirement" name="frmRequirement" method="post" action="<?= base_url('confirm-shipment/' . $requestDetails->request_id . '/' . $ff_company_id); ?>">

                                <input type="hidden" name="request_id" value="<?= $requestDetails->request_id ?>" />
                                <div class="shipping-form">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="text-left">
                                                    <address class="mb-1"><label>RFC ID:</label> <?= $requestDetails->request_id ?></address>
                                                    <address class="mb-1"><label>RFC Date : </label>
                                                        <?= printFormatedDate($requestDetails->created_at) ?></address>
                                                    <address class="mb-1"><label>Freight Forwarder : </label>
                                                        <a href="<?= base_url('company-details/' . $ff_details->company_id) ?>" target="_blank"><?= $ff_details->name ?></a>
                                                    </address>
                                                    <address>
                                                        <label>Shipment Status:</label>
                                                        <span class='status badge <?= str_replace(' ', '-', strtolower($requestDetails->status_title)) ?>'><?= $requestDetails->status_title ? $requestDetails->status_title : '- -' ?></span>
                                                        <span class="text-warning"> <?= $requestDetails->status == 4 ? ' - Decision (Accept / Reject) Pending By Freight Forwarder' : '' ?></span>
                                                    </address>
                                                </td>
                                                <td class="text-left">
                                                    <address class="mb-1">
                                                        <label>Transaction : </label>
                                                        <?= $requestDetails->transaction ?>
                                                    </address>
                                                    <address class="mb-1">
                                                        <label>Mode : </label>
                                                        <?= $requestDetails->mode ?>
                                                    </address>
                                                    <address class="mb-1">
                                                        <label>Delivery Term :</label>
                                                        <?= $requestDetails->delivery_term_name ?>
                                                    </address>
                                                    <address class="mb-1">
                                                        <label>Shipment Type :</label><?= $requestDetails->shipment ?>
                                                    </address>
                                                </td>
                                                <td class="text-left">
                                                    <address class="mb-1">
                                                        <label>Cargo :</label> <?= $requestDetails->container_stuffing ?>
                                                    </address>
                                                    <address class="mb-1">
                                                        <label>Cargo Nature :</label>
                                                        <?= $requestDetails->cargo_status ?>

                                                    </address>
                                                    <?php if (!empty($requestDetails->stuffing)) { ?>
                                                        <address class="mb-1">
                                                            <label><?=($requestDetails->transaction == "Import")?"De-stuffing":"Stuffing"?> :</label>
                                                            <?= $requestDetails->stuffing ?>
                                                        </address>

                                                    <?php } ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div class="form-group">

                                        <div class="row">
                                            <div class="col-lg-6 rright">
                                                <div class="edibx">
                                                    <h3><b>Consignor/Pick up</b></h3>
                                                    <div class="form-row mb-1">
                                                        <label>Contact Person Name:</label>
                                                        <?= $requestDetails->consignor_name; ?>
                                                    </div>
                                                    <div class="form-row mb-1">
                                                        <label>Contact Number:</label>
                                                        <?= $requestDetails->consignor_country_code . ' ' . $requestDetails->consignor_phone; ?>

                                                    </div>
                                                    <div class="form-row mb-1">
                                                        <label>Address:</label> <?= $requestDetails->consignor_address_line_1 . ' ' . $requestDetails->consignor_address_line_2; ?>
                                                    </div>
                                                    <div class="form-row mb-1">
                                                        <label>City, State, Country:</label><?= $requestDetails->consignor_city_name; ?>
                                                    </div>
                                                    <div class="form-row mb-1">
                                                        <label>Pin Code:</label> <?= $requestDetails->consignor_pincode ? $requestDetails->consignor_pincode : ''; ?>
                                                    </div>
                                                    <?php if ($requestDetails->is_other_consignor == "Yes") { ?>
                                                        <h3><b>Seller if other than Consignor</b></h3>
                                                        <div class="form-row mb-1">
                                                            <label>Contact Person Name:</label>
                                                            <?= $requestDetails->consignor_other->name; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Contact Number:</label>
                                                            <?= $requestDetails->consignor_other->country_code . ' ' . $requestDetails->consignor_other->phone; ?>

                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Address:</label> <?= $requestDetails->consignor_other->address_line_1 . ' ' . $requestDetails->consignor_other->address_line_2; ?> <br>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>City, State, Country:</label> <?= $requestDetails->consignor_other->city_name; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Pin Code:</label> <?= $requestDetails->consignor_other->pincode ? $requestDetails->consignor_other->pincode : ''; ?>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 rright">
                                                <div class="edibx">
                                                    <h3><b>Consignee/Deliver To</b></h3>
                                                    <div class="form-row mb-1">
                                                        <label>Contact Person Name :</label> <?= $requestDetails->consignee_name; ?>
                                                    </div>
                                                    <div class="form-row mb-1">
                                                        <label>Contact Number :</label> <?= $requestDetails->consignee_country_code . ' ' . $requestDetails->consignee_phone; ?>

                                                    </div>
                                                    <div class="form-row mb-1">
                                                        <label>Address :</label> <?= $requestDetails->consignee_address_line_1 . ' ' . $requestDetails->consignee_address_line_2; ?>
                                                    </div>
                                                    <div class="form-row mb-1">
                                                        <label>City, State, Country :</label> <?= $requestDetails->consignee_city_name; ?>
                                                    </div>
                                                    <div class="form-row mb-1">
                                                        <label>Pin Code :</label> <?= $requestDetails->consignee_pincode ? $requestDetails->consignee_pincode : ''; ?>
                                                    </div>
                                                    <?php
                                                    if ($requestDetails->is_other_consignee == "Yes") { ?>
                                                        <h3><b>Buyer if other than Consignee</b></h3>
                                                        <div class="form-row mb-1">
                                                            <label>Contact Person Name:</label>
                                                            <?= $requestDetails->consignee_other->name; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Contact Number:</label>
                                                            <?= $requestDetails->consignee_other->country_code . ' ' . $requestDetails->consignee_other->phone; ?>

                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Address:</label> <?= $requestDetails->consignee_other->address_line_1 . ' ' . $requestDetails->consignee_other->address_line_2; ?> <br>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>City, State, Country:</label> <?= $requestDetails->consignee_other->city_name; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Pin Code:</label> <?= $requestDetails->consignee_other->pincode ? $requestDetails->consignee_other->pincode : ''; ?>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-group" style="margin-top: 20px;">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <div class="edibx1">
                                                    <label>Shipment Value: </label> <?= $requestDetails->shipment_value_currency . ' ' . $requestDetails->shipment_value; ?>

                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="edibx1">
                                                    <label>Port of Loading :</label> <?= $requestDetails->loading_port ?>

                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="edibx1">
                                                    <label>Port of Discharge :</label> <?= $requestDetails->discharge_port ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="edibx1">
                                                <label>Tentative Date of Dispatch :</label> <?= printFormatedDate($requestDetails->tentativ_date_dispatch); ?>
                                            </div>
                                        </div>
                                        <!--                            <div class="col-12 col-lg-4">
                                                            <div class="edibx1">
                                                            <label>Tentative Date of Delivery :</label> <?= printFormatedDate($requestDetails->tentativ_date_delivery); ?>  
                                                        </div>
                                                        </div>-->
                                        <div class="col-lg-4">
                                            <div class="edibx1">
                                                <label>Offer response on or before :</label> <?= printFormatedDate($requestDetails->response_end_date) ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="edibx1">
                                                <label>Expected Payment Term :</label> <?= $requestDetails->payment_term ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-12">
                                            <div class="edibx1">
                                                <label>Any Special Consideration for LCL</label>
                                                <div class="input-comment">
                                                    <?= $requestDetails->special_consideration_lcl; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                        <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                        <label>Response by date :</label><?= $requestDetails->response_end_date ?>
                                                                </div>
                                                        </div>
                                                        </div>-->
                                    <h3><b>Material Detail</b></h3>

                                    <div class="multi-container hideLCL" style="<?= $requestDetails->shipment_id == '2' ? 'display:none;' : ''; ?>">
                                        <?php if (!empty($requestDetails->container)) { ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Container</th>
                                                        <th>Size</th>
                                                        <th>Container Type</th>
                                                        <th>Qty</th>
                                                        <th>G.W.(Kg)</th>
                                                        <th>Packing</th>
                                                        <th>HSN Code</th>
                                                        <th>Material Type</th>
                                                        <th>Description</th>
                                                        <th>Remark</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $totalContainers = 0;
                                                    foreach ($requestDetails->container as $key => $row) {
                                                        $totalContainers += $row->number_of_container;
                                                        $sumGrossWeight += $row->gross_weight; ?>

                                                        <tr>
                                                            <td>Container <?= $key + 1 ?>
                                                                <input type="hidden" name="items[<?= $key ?>][item_id]" value="<?= $row->id; ?>">
                                                                <input type="hidden" name="items[<?= $key ?>][item_type]" value="container">
                                                            </td>
                                                            <td><?= $row->container_size_title ? $row->container_size_title : '- -' ?></td>
                                                            <td><?= $row->container_type_name ? $row->container_type_name : '- -' ?></td>
                                                            <td><?= $row->number_of_container ? $row->number_of_container : '- -' ?></td>
                                                            <td><?= $row->gross_weight ? $row->gross_weight : '- -' ?></td>
                                                            <td><?= $row->type_of_packing_name ? $row->type_of_packing_name : '- -' ?></td>
                                                            <td><?= $row->hs_code ? $row->hs_code : '- -' ?></td>
                                                            <td><?= $row->material_type ? $row->material_type : '- -' ?></td>
                                                            <td><?= $row->material_description ? $row->material_description : '- -' ?></td>
                                                            <td><?= $row->remarks ? $row->remarks : '- -' ?></td>
                                                        </tr>

                                                    <?php } ?>
                                                    <?php if (!empty($requestDetails->container)) { ?>
                                                        <tr>
                                                            <td colspan="3" class="text-left">Summary</td>
                                                            <td><?= $totalContainers ?></td>
                                                            <td><?= $sumGrossWeight ?></td>
                                                            <td colspan="5"></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } ?>

                                    </div>


                                    <div class="multi-packaging hideFCL" style="<?= $requestDetails->shipment_id == '1' || empty($requestDetails->shipment_id) ? 'display:none;' : ''; ?>">
                                        <?php if (!empty($requestDetails->package)) { ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Package</th>
                                                        <th>Material Type</th>
                                                        <th>Description</th>
                                                        <th>HSN Code</th>
                                                        <th>Packing</th>
                                                        <th>Remark</th>
                                                        <th>L x W x H (Cm)</th>
                                                        <th>Volume(CBM)</th>
                                                        <th>Volumetric Weight(Kg)</th>
                                                        <th>N.W.(Kg)</th>
                                                        <th>G.W.(Kg)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $sumVolume = 0;
                                                    $sumNetWeight = 0;
                                                    $sumGrossWeight = 0;
                                                    foreach ($requestDetails->package as $key => $row) {
                                                        $sumVolume += $row->volume;
                                                        $sumVolumetricWeight += $row->volumetric_weight;
                                                        $sumNetWeight += $row->net_weight;
                                                        $sumGrossWeight += $row->gross_weight;
                                                    ?>
                                                        <tr>
                                                            <td>Package <?= $key + 1 ?>
                                                                <input type="hidden" name="items[<?= $key ?>][item_id]" value="<?= $row->id; ?>">
                                                                <input type="hidden" name="items[<?= $key ?>][item_type]" value="container">
                                                            </td>
                                                            <td><?= $row->material_type ? $row->material_type : '- -' ?></td>
                                                            <td><?= $row->material_description ? $row->material_description : '- -' ?></td>
                                                            <td><?= $row->hs_code ? $row->hs_code : '- -' ?></td>
                                                            <td><?= $row->type_of_packing_name ? $row->type_of_packing_name : '- -' ?></td>
                                                            <td><?= $row->remarks ? $row->remarks : '- -' ?></td>
                                                            <td><?= $row->length . ' x ' . $row->width . ' x ' . $row->height; ?></td>
                                                            <td><?= $row->volume; ?></td>
                                                            <td><?= $row->volumetric_weight; ?></td>
                                                            <td><?= $row->net_weight; ?></td>
                                                            <td><?= $row->gross_weight; ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                    <?php if (!empty($requestDetails->package)) { ?>
                                                        <tr class="font-weight-bold">
                                                            <td class="text-left" colspan="7">Summary:</td>
                                                            <td><?= $sumVolume ?></td>
                                                            <td><?= $sumVolumetricWeight ?></td>
                                                            <td><?= $sumNetWeight ?></td>
                                                            <td><?= $sumGrossWeight ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } ?>

                                    </div>

                                    <h3><b>Shipment Instructions</b></h3>
                                    <div class="row">
                                        <div class="col-12 col-lg-2 mb-2">
                                            <label>Pick-up Date and Time<sup>*</sup></label>
                                            <input type="text" name="pick_up_datetime" autocomplete="off" class="form-control pickup_datetimepicker" value="<?= printFormatedDateTime($requestDetails->pick_up_datetime); ?>" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-10 mb-2">
                                            <label>Any other specific instructions</label>
                                            <textarea name="shipping_instruction" class="form-control" maxlength="500"><?= $requestDetails->shipping_instruction; ?></textarea>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-12 col-lg-12">
                                            <div class="pannelGroup">
                                                <div class="heading">
                                                    <h3>Terms and Conditions <i class="icon pull-right"></i></h3>

                                                </div>
                                                <div class="pannelBody">
                                                    <?= getTermsNConditions() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 text-center mt-5">
                                        <a href="<?= base_url('select-ff-shipping-requirement/' . $requestDetails->request_id); ?>" class="btn btn-secondary btn-md">Go Back</a>
                                        <input type="submit" name="submit" class="btn btn-submit btn-md" value="Award & Send Shipment Instruction" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- </div>
                            </div>
                        </div> -->



                        <!--                        <div class=" mescms clearfix">
        	<h3 class="">Communication</h3>
        </div>
        <div class="communicate_box clearfix">
        		
                 <div class="col-lg-12 communication-box">
                        <?php foreach ($messages as $message) {
                            $this->load->view('frontend/communication/message', ['message' => $message, 'from_user_id' => $this->seller_session_data['id']]);
                        } ?>
                         </div>
                          
              
           
                        <div class="col-lg-12  text-right">

                            <textarea id="message" class="form-control mb-3" maxlength="200" placeholder="Message..."></textarea>
                            
                            <input type="button" class="btn btn-submit btn-sm" id="btn_sendMessage" value="Send Message">
                        </div>
                 </div>-->
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
<script type="text/javascript">
    var session_user_id = '<?= $this->session->userdata("seller_logged_in")['id']; ?>';
    var to_user_id = '<?= $requestDetails->ff_id; ?>';
    var request_id = '<?= $requestDetails->request_id; ?>';
    $('#btn_sendMessage').click(function() {
        var msg = $('#message').val().trim();
        //     console.log(msg);
        //     if()
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('send-message'); ?>',
            //dataType:'json',
            data: {
                msg: msg,
                from_user_id: session_user_id,
                to_user_id: to_user_id,
                request_id: request_id
            },
            success: function(response) {

                console.log(response);
                if (response == 'success') {
                    $('#message').val('');
                    getMessages();
                }

            }
        });
    });

    function getMessages() {
        var last_message_id = $('.communication-box div.messageinner:last-child').attr('data-messageid');
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('get-message-list'); ?>',
            //dataType:'json',
            data: {
                from_user_id: session_user_id,
                to_user_id: to_user_id,
                request_id: request_id,
                last_message_id: last_message_id
            },
            success: function(response) {

                $('.communication-box').append(response);
                // $(".communication-box").animate({ scrollTop: $('.communication-box').prop("scrollHeight")}, 1000);

            }
        });
    }
    setInterval(function() {
        getMessages();
    }, 2000);
</script>
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

    #particulars {
        counter-reset: particular;
    }

    .particular-counter::before {
        counter-increment: particular;
        content: counter(particular);
    }

    .table {
        counter-reset: otherCharges;
    }

    .otherCharges-counter::before {
        counter-increment: otherCharges;
        content: counter(otherCharges);
    }



    /*#particulars tbody tr:only-of-type > .remove-item {
    display: none;
}*/



    @media (min-width: 840px) {
        .mdl-grid {
            padding: 8px;
            width: 100% !important;
        }
    }

    ul#ui-id-1 {
        z-index: 9999 !important;
        padding: 3px !important;
        border: 1px solid #e2e9e6 !important;
        background: #fff !important;
        width: 16.5% !important;
        height: 200px !important;
        overflow: auto !important;
    }

    ul#ui-id-2 {
        z-index: 9999 !important;
        padding: 3px !important;
        border: 1px solid #e2e9e6 !important;
        background: #fff !important;
        width: 16.5% !important;
        height: 200px !important;
        overflow: auto !important;
    }

    .chosen-container-single .chosen-single {
        height: 33px !important;
        background-color: #fff;
        background: -webkit-linear-gradient(top, #ffffff 20%, #ffffff 50%, #ffffff 52%, #ffffff 100%) !important;
        background-clip: unset !important;
        box-shadow: none !important;
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


                        <!--<h3 class="heading3-border">Request for Freight Comparative</h3>-->
                        <h3 class="heading3-border">Shipment Details</h3>

                        <!-- Customer Registration Start -->
                        <!-- <div class="wshipping-content-block shipping-block"> -->
                        <!-- <div class="container">
                                <div class="row"> -->
                        <div class="shipping-form-block editinfo">
                            <?php $transactionCurrencyHtml =  "&nbsp;(" . ($requestDetails->transaction_currency ? $requestDetails->transaction_currency : 'INR') . ")"; ?>
                            <form id="frmRequirement" name="frmRequirement" class="" action="<?php echo base_url('edit-request-details/' . $requestDetails->request_id); ?>" accept-charset="UTF-8" enctype="multipart/form-data" method="post">

                                <input type="hidden" name="request_id" value="<?= $requestDetails->request_id ?>" />
                                <div class="shipping-form">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="text-left">
                                                    <address class="mb-1"><label>RFC ID:</label> <?= $requestDetails->annual_contract_id?'AFC'.$requestDetails->request_id:$requestDetails->request_id ?></address>
                                                    <address class="mb-1"><label>RFC Date : </label>
                                                        <?= printFormatedDate($requestDetails->created_at) ?></address>
                                                    <address class="mb-1"><label>Exporter-Importer:</label>
                                                        <a href="<?= base_url('seller-company-details/' . $fs_details->company_details->id) ?>" target="_blank"><?= $fs_details->company_details->name ?></a>
                                                    </address>

                                                    <address>
                                                        <label>Shipment Status:</label>
                                                        <span class='status badge <?= str_replace(' ', '-', strtolower($requestDetails->status_title)) ?>'><?= $requestDetails->status_title ? $requestDetails->status_title : '- -' ?></span>
                                                        <span class="text-warning"> <?= $requestDetails->quote_status == 4 ? ' - Decision (Accept / Reject) Pending By Freight Forwarder' : '' ?></span>
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
                                                            <label><?= ($requestDetails->transaction == "Import") ? "De-stuffing" : "Stuffing" ?> :</label>
                                                            <?= $requestDetails->stuffing ?>
                                                        </address>

                                                    <?php } ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <div class="clearfix"></div>
                                    <div class="container">
                                        <div class="row">

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">MSDS Document</label>
                                                    <span><?= printDocumentLink($requestDetails->msds_doc) ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">

                                                    <label for="">Product Specification Document:</label>
                                                    <span><?= printDocumentLink($requestDetails->product_specification_doc) ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Other Documents 1</label>
                                                    <span><?= printDocumentLink($requestDetails->other_doc_1) ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Other Documents 2</label>
                                                    <span><?= printDocumentLink($requestDetails->other_doc_2) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 rright">
                                                <div class="edibx">
                                                    <h3><b>Consignor/Pick up</b></h3>
                                                    <!-- <div class="form-row mb-1">
                                                        <label>Contact Person Name:</label>
                                                        <?= $requestDetails->consignor_name; ?>
                                                    </div>
                                                    <div class="form-row mb-1">
                                                        <label>Contact Number:</label>
                                                        <?= $requestDetails->consignor_country_code . ' ' . $requestDetails->consignor_phone; ?>

                                                    </div> -->
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
                                                        <!-- <div class="form-row mb-1">
                                                            <label>Contact Person Name:</label>
                                                            <?= $requestDetails->consignor_other->name; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Contact Number:</label>
                                                            <?= $requestDetails->consignor_other->country_code . ' ' . $requestDetails->consignor_other->phone; ?>

                                                        </div> -->
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
                                                    <!-- <div class="form-row mb-1">
                                                        <label>Contact Person Name :</label> <?= $requestDetails->consignee_name; ?>
                                                    </div>
                                                    <div class="form-row mb-1">
                                                        <label>Contact Number :</label> <?= $requestDetails->consignee_country_code . ' ' . $requestDetails->consignee_phone; ?>

                                                    </div> -->
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
                                                        <!-- <div class="form-row mb-1">
                                                            <label>Contact Person Name:</label>
                                                            <?= $requestDetails->consignee_other->name; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Contact Number:</label>
                                                            <?= $requestDetails->consignee_other->country_code . ' ' . $requestDetails->consignee_other->phone; ?>

                                                        </div> -->
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
                                            <div class="col-lg-12">
                                                <p class="text-muted"><small>For any further information or query please feel free to Contact: 24thmile, Contact Number: 7709065277, Mail ID: <a href="mailto:sales@24thmile.com">sales@24thmile.com</a></small> </p>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <div class="edibx1">
                                                    <label>Shipment Value: </label> <?= $requestDetails->shipment_value_currency . ' ' . $requestDetails->shipment_value; ?>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="edibx1">
                                                    <label>Port of Loading:</label> <?= $requestDetails->port_loading_name ?>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="edibx1">
                                                    <label>Port of Discharge :</label> <?= $requestDetails->port_discharge_name ?>
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

                                    <?php include 'shipping_container_list.php'; ?>
                                    <?php include 'shipping_packaging_list.php'; ?>

                                    <?php if (!empty($rfc_charges)) {
                                        $rfc_charge_counter = 0;
                                        $arr_unit = ['CBM', 'Container', 'Document', 'KG'];
                                                                    //    vdebug([$arrContainerType,$rfc_charges]);
                                    ?>
                                        <div>
                                            <?php foreach ($rfc_charges as $key => $rfc_charge) { ?>
                                                <?php $sr_no = 1; $categoryTotal=0;$categoryCounterRateTotal=0; ?>
                                                <?php if (!empty($rfc_charge->subCategory)) { ?>
                                                    <h3><b><?= $rfc_charge->rfc_category_name ?></b><?= $transactionCurrencyHtml ?></h3>
                                                    <table id="<?= "charges_category_$rfc_charge->id" ?>" class="table">
                                                        <colgroup>
                                                            <col style="width:50px">
                                                            <col style="width:200px">
                                                            <col style="width:200px">
                                                            <col style="width:100px">
                                                            <col style="width:100px;">
                                                            <col style="width:100px;">
                                                            <col style="width:100px;">
                                                            <col style="width:20px">
                                                        </colgroup>
                                                        <thead>
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>Charges Title</th>
                                                                <th>Price Per Unit</th>
                                                                <th>Unit</th>
                                                                <th>Qty</th>
                                                                <th class="text-right">Total Price</th>
                                                                <th class="text-right">Counter Rate</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($rfc_charge->subCategory as $key2 => $sub_rfc_charge) { ?>
                                                                <?php
                                                                $defaultQty = 1;
                                                                if ($sub_rfc_charge->unit == 'CBM') {
                                                                    $defaultQty = $sumVolume;
                                                                } else if ($sub_rfc_charge->unit == 'Kg') {
                                                                    $defaultQty = $totalOfMaxWeight;
                                                                }
                                                                $categoryTotal += $sub_rfc_charge->total;
                                                                $categoryCounterRateTotal += $sub_rfc_charge->counter_rate;
                                                                ?>
                                                                <?php if ($sub_rfc_charge->unit == 'Container' && empty($sub_rfc_charge->ffChargesId)) { ?>
                                                                    <?php foreach ($requestDetails->container as $row) { ?>
                                                                        <?php $uniqueRowKey = uniqid(); ?>
                                                                        <tr>
                                                                            <td><?= $sr_no++; ?></td>

                                                                            <td class="text-left"><?= $sub_rfc_charge->rfcChargesTitle . ' ' . $row->container_size_title . ' ' . $row->container_type_name ?> </td>
                                                                            <td>
                                                                                <input type="hidden" name="rfc_charges[<?= $uniqueRowKey ?>][rfc_id]" value="<?= $sub_rfc_charge->id ?>" />
                                                                                <input type="hidden" name="rfc_charges[<?= $uniqueRowKey ?>][item_id]" value="<?= $row->id ?>" />
                                                                                <input type="text" name="rfc_charges[<?= $uniqueRowKey ?>][rfc_charge]" value="<?= $sub_rfc_charge->charges ?>" class=" text-right   rfc-charges-value  decimal-numbers " maxlength="12" />
                                                                            </td>
                                                                            <td><?= $sub_rfc_charge->unit ?></td>
                                                                            <td>
                                                                                <input type="text" min="1" readonly="" name="rfc_charges[<?= $uniqueRowKey ?>][qty]" value="<?= $row->number_of_container ?>" class=" qty only-numbers " maxlength="12" /> <small><?= $sub_rfc_charge->unit ?></small>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <input type="text" name="rfc_charges[<?= $uniqueRowKey ?>][total]" value="<?= $sub_rfc_charge->total ? $sub_rfc_charge->total : 0.00 ?>" class="text-right  total  decimal-numbers " maxlength="12" readonly="" />
                                                                            </td >
                                                                            <td  class="text-right"><?= number_format($sub_rfc_charge->counter_rate,2) ?></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <?php $uniqueRowKey = uniqid(); ?>
                                                                    <tr>
                                                                        <td><?= $sr_no++; ?></td>

                                                                        <td class="text-left"><?= $sub_rfc_charge->rfcChargesTitle ?> <?= $arrContainerType[$sub_rfc_charge->item_id] ? $arrContainerType[$sub_rfc_charge->item_id] : '' ?></td>
                                                                        <td>
                                                                            <input type="hidden" name="rfc_charges[<?= $uniqueRowKey ?>][rfc_id]" value="<?= $sub_rfc_charge->id ?>" />
                                                                            <input type="hidden" name="rfc_charges[<?= $uniqueRowKey ?>][item_id]" value="<?= $sub_rfc_charge->item_id ? $sub_rfc_charge->item_id : '' ?>" />
                                                                            <input type="text" name="rfc_charges[<?= $uniqueRowKey ?>][rfc_charge]" value="<?= $sub_rfc_charge->charges ?>" class="text-right   rfc-charges-value  decimal-numbers " maxlength="12" />
                                                                        </td>
                                                                        <td><?= $sub_rfc_charge->unit ?></td>
                                                                        <td>
                                                                            <input type="text" min="1" name="rfc_charges[<?= $uniqueRowKey ?>][qty]" value="<?= printFloatQuantity($sub_rfc_charge->qty ? $sub_rfc_charge->qty : $defaultQty) ?>" class=" qty  only-numbers " maxlength="12" readonly="" /> <small><?= $sub_rfc_charge->unit ?></small>
                                                                        </td>
                                                                        <td class="text-right">
                                                                            <input type="text" name="rfc_charges[<?= $uniqueRowKey ?>][total]" value="<?= $sub_rfc_charge->total ? $sub_rfc_charge->total : 0.00 ?>" class="text-right  total  decimal-numbers " maxlength="12" readonly="" />
                                                                        </td>
                                                                        <td class="text-right <?= $sub_rfc_charge->counter_rate!=$sub_rfc_charge->total?'text-danger':''?>"><?= number_format($sub_rfc_charge->counter_rate,2) ?></td>
                                                                        <td></td>
                                                                    </tr>
                                                                <?php } ?>

                                                            <?php } //end for

                                                            //other charges

                                                            ?>
                                                            <?php if (in_array($rfc_charge->id, ['1', '2', '4', '5'])) { ?>

                                                                <tr class="other-charges">
                                                                    <th colspan="7" class="text-left">Other Charges</th>
                                                                    <th><button type="button" data-categoryid="<?= $rfc_charge->id ?>" class="btn btn-sm btn-secondary addOtherCharges"><i class="fa fa-plus"></i> Add</button></th>
                                                                </tr>
                                                                <?php foreach ($rfc_other_charges as $key => $other) {
                                                                    if ($other->category_id == $rfc_charge->id) {
                                                                        $categoryTotal += $other->total;
                                                                        $categoryCounterRateTotal += $other->counter_rate;
                                                                        $this->load->view('frontend/ajax/ajaxAddOtherCharges', ['other' => $other, 'arr_unit' => $arr_unit]);
                                                                    }
                                                                } ?>
                                                            <?php } ?>
                                                            
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th colspan="5" class="text-right">Total</th>
                                                            <th class="text-right category-total" ><?=number_format($categoryTotal,2);?></th>
                                                            <th class="text-right"><?=number_format($categoryCounterRateTotal,2)?></th>
                                                            <th></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                <?php } ?>

                                            <?php } ?>



                                            <!--start::other charges-->
                                            <div class="row">
                                                <div class="col-12 col-lg-12">
                                                    <h3><b>Riders</b></h3>
                                                    <table class="table table-bordered table-sm">
                                                        <tbody>
                                                            <?php foreach ($other_charges as $charge) { ?>
                                                                <?php if ($charge->other_charge_id == '1') { ?>
                                                                    <?php $uniqueRowKey = uniqid(); ?>

                                                                    <tr>
                                                                        <td class="text-right"><input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group col-md-4">


                                                                                <div class="input-comment dropdown">
                                                                                    <input required type="text" id="payment_term" data-toggle="dropdown" autocomplete="off" class="form-control dropdown-toggle" placeholder="Payment Term..." name="otherCharges[<?= $uniqueRowKey ?>][value_1]" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ?>" maxlength="50" />
                                                                                    <ul class="dropdown-menu" role="menu">
                                                                                        <li class="mx-2" onclick="$('#payment_term').val($(this).text())">100% Advance</li>
                                                                                        <li class="mx-2" onclick="$('#payment_term').val($(this).text())">50% Advance 50% Against Delivery</li>
                                                                                        <li class="mx-2" onclick="$('#payment_term').val($(this).text())">15 days from Service Invoice date</li>
                                                                                        <li class="mx-2" onclick="$('#payment_term').val($(this).text())">30 days from Service Invoice date</li>
                                                                                        <li class="mx-2" onclick="$('#payment_term').val($(this).text())">45 days from Service Invoice date</li>
                                                                                        <li class="mx-2" onclick="$('#payment_term').val($(this).text())">60 days from Service Invoice date</li>
                                                                                        <li class="mx-2" onclick="$('#payment_term').val($(this).text())">90 days from Service Invoice date</li>
                                                                                        <li class="mx-2">Other</li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                <?php } ?>

                                                                <?php if ($charge->other_charge_id == '2') { ?>
                                                                    <tr>
                                                                        <td class="text-right">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group col-md-2">

                                                                                <input required type="text" class="date-picker " name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="DD-MM-YYYY" value="<?= printFormatedDate($other_charges_value_arr[$charge->other_charge_id]['value_1']) ?>">
                                                                            </div>
                                                                        </td>
                                                                    </tr>


                                                                <?php } ?>

                                                                <?php if ($charge->other_charge_id == '3' || $charge->other_charge_id == '4') { ?>
                                                                    <tr>
                                                                        <td class="text-right">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group col-md-2">

                                                                                <input required type="text" class=" date-picker " name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="DD-MM-YYYY" value="<?= printFormatedDate($other_charges_value_arr[$charge->other_charge_id]['value_1']) ?>">
                                                                            </div>
                                                                        </td>
                                                                    </tr>


                                                                <?php } ?>

                                                                <?php if ($charge->other_charge_id == '5' || $charge->other_charge_id == '6') { ?>
                                                                    <tr>
                                                                        <td class="text-right">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group col-md-4">
                                                                                <input required type="text" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="Name..." style="width: 100%" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ?>">
                                                                            </div>

                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <?php if ($charge->other_charge_id == '7' || $charge->other_charge_id == '8') { ?>
                                                                    <tr>
                                                                        <td class="text-right">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group col-md-4">
                                                                                <div class="input-group">
                                                                                    <input required type="number" class="form-control" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="0" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ?>">
                                                                                    <select id="inputState" class="form-control" name="otherCharges[<?= $uniqueRowKey ?>][value_2]">
                                                                                        <option <?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] == "Per Week" ? "selected" : "" ?>>Per Week</option>
                                                                                        <option <?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] == "Per Month" ? "selected" : "" ?>>Per Month</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                        </td>
                                                                    </tr>

                                                                <?php } ?>

                                                                <?php if ($charge->other_charge_id == '9') { ?>
                                                                    <tr>
                                                                        <td class="text-right">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group col-md-3">
                                                                                <div class="input-group">
                                                                                    <input required type="number" class="form-control" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="0" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ?>">
                                                                                    <span style="padding:5px 2px;  background-color:#CCCCCC;">Days</span>
                                                                                </div>
                                                                            </div>

                                                                        </td>
                                                                    </tr>

                                                                <?php } ?>
                                                                <?php if ($charge->other_charge_id == '10') { ?>
                                                                    <tr>
                                                                        <td class="text-right">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group col-md-3">
                                                                                <div class="input-group">
                                                                                    <input type="number" class="form-control" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="0" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ?>">
                                                                                    <span style="padding:5px 2px;  background-color:#CCCCCC;">Days</span>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <?php if ($charge->other_charge_id == '11') { ?>
                                                                    <tr>
                                                                        <td class="text-right">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group col-md-3">
                                                                                <div class="input-group">
                                                                                    <input type="number" class="form-control" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="0" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ?>">
                                                                                    <span style="padding:5px 2px;  background-color:#CCCCCC;">Days</span>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                <?php } ?>
                                                                <?php if ($charge->other_charge_id == '12') { ?>
                                                                    <tr>
                                                                        <td class="text-right">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo  $charge->other_charge_title; ?> <?= $transactionCurrencyHtml ?>:</label>

                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group col-md-3">
                                                                                <div class="input-group">
                                                                                    <input type="number" class="form-control" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="0" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ?>">
                                                                                    <!--<span style="padding:5px 2px;  background-color:#CCCCCC;">Days</span>-->
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>



                                                                <!--[start::looping for the container]-->
                                                                <?php if ($charge->other_charge_id == '13') { ?>
                                                                    <?php if ($requestDetails->shipment_id == '1') { ?>
                                                                        <?php foreach ($requestDetails->container as $key => $row) { ?>
                                                                            <tr>
                                                                                <td class="text-right">
                                                                                    <?php $uniqueRowKey = uniqid(); ?>
                                                                                    <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                                    <label><?php echo  $charge->other_charge_title; ?> <?= $transactionCurrencyHtml ?>:</label>

                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group col-md-4">
                                                                                        <div class="input-group">
                                                                                            <!--<span style="padding:5px 2px; background-color:#CCCCCC;"> </span>-->
                                                                                            <input style="padding:5px 2px; background-color:#CCCCCC;" readonly name="otherCharges[<?= $uniqueRowKey ?>][value_2]" value="<?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] ? $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] : $row->container_size_title . ' ' . $row->container_type_name . ' Container' ?>">
                                                                                            <input type="number" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" class="form-control" placeholder="0" value="<?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_1'] ?>">
                                                                                        </div>
                                                                                    </div>

                                                                                </td>
                                                                            </tr>

                                                                        <?php } ?>
                                                                    <?php } else { ?>
                                                                        <tr>
                                                                            <td class="text-right">
                                                                                <?php $uniqueRowKey = uniqid(); ?>
                                                                                <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                                <label><?php echo  $charge->other_charge_title; ?> <?= $transactionCurrencyHtml ?>:</label>

                                                                            </td>
                                                                            <td>

                                                                                <div class="form-group col-md-3">
                                                                                    <div class="input-group">
                                                                                        <?php if ($requestDetails->mode_id == '1' || $requestDetails->mode_id == '3') { ?>
                                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][value_2]" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] ? $other_charges_value_arr[$charge->other_charge_id]['value_2'] : $sumVolume . ' CBM' ?>">
                                                                                            <span style="padding:5px 2px; background-color:#CCCCCC;"><?= $sumVolume ?> CBM</span>
                                                                                        <?php } ?>
                                                                                        <?php if ($requestDetails->mode_id == '2') { ?>
                                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][value_2]" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] ? $other_charges_value_arr[$charge->other_charge_id]['value_2'] : $totalOfMaxWeight . ' Kg' ?>">
                                                                                            <span style="padding:5px 2px; background-color:#CCCCCC;"><?= $totalOfMaxWeight ?> Kg</span>
                                                                                        <?php } ?>
                                                                                        <input type="" class="form-control" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="0" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>


                                                                <?php } ?>

                                                                <?php if ($charge->other_charge_id == '14') { ?>
                                                                    <?php if ($requestDetails->shipment_id == '1') { ?>
                                                                        <?php foreach ($requestDetails->container as $key => $row) { ?>
                                                                            <tr>
                                                                                <td class="text-right">
                                                                                    <?php $uniqueRowKey = uniqid(); ?>
                                                                                    <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                                    <label><?php echo  $charge->other_charge_title; ?> <?= $transactionCurrencyHtml ?>:</label>

                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group col-md-4">
                                                                                        <div class="input-group">
                                                                                            <!--<span style="padding:5px 2px; background-color:#CCCCCC;"><?= $row->container_size_title . ' ' . $row->container_type_name ?>  Container</span>-->
                                                                                            <input style="padding:5px 2px; background-color:#CCCCCC;" readonly name="otherCharges[<?= $uniqueRowKey ?>][value_2]" value="<?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] ? $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] : $row->container_size_title . ' ' . $row->container_type_name . ' Container' ?> ">
                                                                                            <input type="" class="form-control" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="0" value="<?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_1'] ?>">
                                                                                        </div>
                                                                                    </div>

                                                                                </td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    <?php } else { ?>
                                                                        <tr>
                                                                            <td class="text-right">
                                                                                <?php $uniqueRowKey = uniqid(); ?>
                                                                                <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                                <label><?php echo  $charge->other_charge_title; ?> <?= $transactionCurrencyHtml ?>:</label>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group col-md-3">
                                                                                    <div class="input-group">
                                                                                        <?php if ($requestDetails->mode_id == '1' || $requestDetails->mode_id == '3') { ?>
                                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][value_2]" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] ? $other_charges_value_arr[$charge->other_charge_id]['value_2'] : $sumVolume . ' CBM' ?>">
                                                                                            <span style="padding:5px 2px; background-color:#CCCCCC;"><?= $sumVolume ?> CBM</span>
                                                                                        <?php } ?>
                                                                                        <?php if ($requestDetails->mode_id == '2') { ?>
                                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][value_2]" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] ? $other_charges_value_arr[$charge->other_charge_id]['value_2'] : $totalOfMaxWeight . ' Kg' ?>">
                                                                                            <span style="padding:5px 2px; background-color:#CCCCCC;"><?= $totalOfMaxWeight ?> Kg</span>
                                                                                        <?php } ?>
                                                                                        <input type="text" class="form-control" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" placeholder="0" value="<?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ?>">

                                                                                    </div>
                                                                                </div>

                                                                            </td>
                                                                        </tr>


                                                                    <?php } ?>


                                                                <?php } ?>

                                                                <!--[end::looping for the container]-->


                                                                <?php if ($charge->other_charge_id == '15') { ?>
                                                                    <tr>
                                                                        <td class="text-right">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo str_replace("{mode}", $requestDetails->mode, $charge->other_charge_title); ?>:</label>

                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group col-md-5">
                                                                                <?php
                                                                                $arr_value_1 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_1']);
                                                                                $arr_value_2 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_2']);
                                                                                ?>
                                                                                <div class="input-group">
                                                                                    <span style="padding:5px 2px; background-color:#CCCCCC;">FROM</span>
                                                                                    <input type="text" class="form-control" placeholder="0" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" value="<?= $arr_value_1[0] ?>">
                                                                                    <input type="text" class="form-control" placeholder="Ex: INR" name="otherCharges[<?= $uniqueRowKey ?>][currency_from]" value="<?= $arr_value_1[1] ? $arr_value_1[1] : 'USD' ?>">
                                                                                    <span style="padding:5px 2px;  background-color:#CCCCCC;">TO</span>
                                                                                    <input type="text" class="form-control" placeholder="0" name="otherCharges[<?= $uniqueRowKey ?>][value_2]" value="<?= $arr_value_2[0] ?>">
                                                                                    <input type="text" class="form-control" placeholder="Ex: USD" name="otherCharges[<?= $uniqueRowKey ?>][currency_to]" value="<?= $arr_value_2[1] ? $arr_value_2[1] : 'INR' ?>">
                                                                                </div>
                                                                            </div>

                                                                        </td>
                                                                    </tr>


                                                                <?php } ?>

                                                                <?php if ($charge->other_charge_id == '16') { ?>
                                                                    <tr>
                                                                        <td class="text-right">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <input type="hidden" name="otherCharges[<?= $uniqueRowKey ?>][other_charge_id]" value="<?= $charge->other_charge_id ?>">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group col-md-5">
                                                                                <?php
                                                                                $arr_value_1 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_1']);
                                                                                $arr_value_2 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_2']);
                                                                                ?>
                                                                                <div class="input-group">
                                                                                    <span style="padding:5px 2px; background-color:#CCCCCC;">FROM</span>
                                                                                    <input type="text" class="form-control" placeholder="0" name="otherCharges[<?= $uniqueRowKey ?>][value_1]" value="<?= $arr_value_1[0] ?>">
                                                                                    <input type="text" class="form-control" placeholder="Ex: EUR" name="otherCharges[<?= $uniqueRowKey ?>][currency_from]" value="<?= $arr_value_1[1] ? $arr_value_1[1] : 'USD' ?>">
                                                                                    <span style="padding:5px 2px;  background-color:#CCCCCC;">TO</span>
                                                                                    <input type="text" class="form-control" placeholder="0" name="otherCharges[<?= $uniqueRowKey ?>][value_2]" value="<?= $arr_value_2[0] ?>">
                                                                                    <input type="text" class="form-control" placeholder="Ex: INR" name="otherCharges[<?= $uniqueRowKey ?>][currency_to]" value="<?= $arr_value_2[1] ? $arr_value_2[1] : 'INR' ?>">
                                                                                </div>
                                                                            </div>

                                                                        </td>
                                                                    </tr>

                                                                <?php } ?>
                                                            <?php } ?>


                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            <!--end::other charges-->

                                            <table class="table">
                                                <colgroup>
                                                    <col style="width:90%">
                                                    <col style="width:10%">
                                                </colgroup>
                                                <tbody>
                                                    <tr>

                                                        <td class="text-right">
                                                            <h3>Total Quote Value<?= $transactionCurrencyHtml ?>:</h3>
                                                        </td>
                                                        <td>
                                                            <h3 class="text-right"> <input type="text" readonly="" placeholder="0.00" name="total_quote_amount" id="total_quote_amount" value="<?= $requestDetails->total_quote_amount ?>" /></h3>
                                                        </td>
                                                    </tr>
                                                    <?php if (!empty($requestDetails->counter_rate)) { ?>
                                                        <tr>
                                                            <td class="text-right">
                                                                <h3>Counter Rate<?= $transactionCurrencyHtml ?>:</h3>
                                                            </td>
                                                            <td>
                                                                <h3 class="text-right"><?= number_format($requestDetails->counter_rate, 2) ?></h3>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>

                                            </table>
                                        </div>

                                    <?php } ?>

                                    <div class="row my-5">

                                        <?php if (in_array($requestDetails->status, ['4', '5', '6', '7', '8'])) { ?>
                                            <div class="col-12 col-lg-12 mb-2">
                                                <h3><b>Shipment Instructions</b></h3>
                                            </div>
                                            <div class="col-12 col-lg-12 mb-2">
                                                <label>Pick-up Date and Time: </label>
                                                <?= printFormatedDateTime($requestDetails->pick_up_datetime); ?>
                                            </div>

                                            <div class="col-12 col-lg-10 mb-2">
                                                <label>Any other specific instructions: </label>
                                                <?= $requestDetails->shipping_instruction ? $requestDetails->shipping_instruction : '- -' ?>

                                            </div>


                                        <?php } ?>

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



                                    <div class="col-lg-12 text-right">
                                        <!--<input type="submit" name="submit" class="submit action-button" value="Save & Continue" />-->


                                        <input type="submit" name="submit" class="btn  btn-submit btn-md" value="Save" />
                                        <input type="submit" name="submit" class="btn  btn-success btn-md" value="Save and Send Quote" />
                                        <a href="<?= base_url('ff-request-list'); ?>" class="btn btn-secondary btn-md">Cancel</a>
                                    </div>

                                </div>
                                <!--end .shipping-form-->
                            </form>
                        </div>
                        <!-- </div>
                            </div> -->
                        <div class=" mescms clearfix">
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

                                <input type="button" class="btn btn-submit btn-md" id="btn_sendMessage" value="Send Message">
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog content end -->
    </section><!-- sidebar_dashboard-->
</div>
<!-- sidebar_dashboard-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<!-- <link href="<?php echo base_url('assets/frontend/js/bs4-pop/bs4.pop.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/frontend/js/bs4-pop/bs4.pop.js?v=1.2'); ?>" type="text/javascript"></script> -->

<script type="text/javascript">
    // $(document).on('blur', '#rfcChargesDiv .rfc-charges-value', function() {
    //     calculateTotalCost()
    // });

    // $(document).on('blur', '#particulars input.transport-charge,#particulars input.varai-charge,#particulars input.detention-charge,#particulars input.qty', function() {
    //     var parentTr = $(this).closest('tr');

    //     var transport = parseFloat($(parentTr).find('.transport-charge').val()) || 0;
    //     var varai = parseFloat($(parentTr).find('.varai-charge').val()) || 0;
    //     //var detention = parseFloat($(parentTr).find('.detention-charge').val()) || 0;
    //     var qty = parseInt($(parentTr).find('.qty').val()) || 1;

    //     $(parentTr).find('.cost').val(((transport + varai) * qty).toFixed(2));
    //     calculateTotalCost()

    // });

    //$(document).ready(function(){
    //    //Math.floor(Math.random() * 10) + 1;
    //     $('input.rfc-charges-value').each(function(){
    //       this.value = Math.floor(Math.random() * 500) + 1;
    //      
    //    });
    //    $('input.rfc-charges-value').blur();
    //})

    $(document).on('blur', 'input[name^="rfc_charges"]', function(e) {
        var tr = $(this).closest('tr');
        var tableId = '#'+$(this).closest('table').attr('id');
        var categoryTotal = 0;
        var charges = parseFloat(tr.find('input.rfc-charges-value').val()) || 0.0;
        var qty = parseFloat(tr.find('input.qty').val()) || 0.0;
        var total = (charges * qty).toFixed(2);
        tr.find('input.total').val(total);
        $(tableId+' tr input.total').each(function(){
            categoryTotal += parseFloat($(this).val()) || 0.00;
            console.log(categoryTotal);
        });
        $(tableId+' .category-total').text(categoryTotal.toFixed(2));
        
        calculateFinalTotal();
    });





    function calculateFinalTotal() {
        var finalTotal = 0;
        $('input.total').each(function() {
            finalTotal += parseFloat(this.value) || 0.0
        });
        $('#total_quote_amount').val(finalTotal.toFixed(2));
    }


    function calculateTotalCost() {
        var totalAmount = 0;
        var totalContainers = parseInt($('#totalContainers').val()) || 1;
        $('#rfcChargesDiv .rfc-charges-value').each(function() {
            var tempVar = parseFloat($(this).val()) || 0;
            tempVar = $(this).hasClass('per-container') ? tempVar * totalContainers : tempVar;
            console.log(tempVar, totalContainers, $(this).hasClass('per-container'));
            totalAmount += tempVar;
        });
        $('#particulars .cost').each(function() {
            totalAmount += parseFloat($(this).val()) || 0;
        });
        $('#total_quote_amount').val(totalAmount.toFixed(2));
    }

    var particularCount = $('#particulars tbody tr').length;
    $('#addParticular').click(function() {
        particularCount++;
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('ajax-add-particular'); ?>',
            //dataType:'json',
            data: {
                particularCount: particularCount
            },
            success: function(response) {

                $('#particulars tbody').append(response);
            }
        });
        //$('.multi-packaging').append('<div class="form-group" style="padding: 10px; border: 1px solid #ccc;"><span><b>Package '+pckcount+'</b></span><div class="row"><div class="col-12 col-lg-4"><label>Material Description <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="material" required="required" /><span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle"></i></span></div></div><div class="col-12 col-lg-4"><label>HS Code <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="hs_code" required="required" /><span class="error1" style="display: none;"><i class="error-log fa fa-exclamation-triangle"></i></span> </div></div><div class="col-12 col-lg-4"><label>Type Of Packing <sup>* </sup></label><div class="input-comment"><select name="material_unit" class="form-control"><option value="">Select Packing</option><option>Wooden</option><option>Pallet</option><option>Box</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Net Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="net_weight" id="net_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Gross Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="gross_weight" id="gross_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Length: </label><div style="display: flex;"><input type="text" class="form-control" name="length" id="length" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Height: </label><div style="display: flex;"><input type="text" class="form-control" name="height" id="height" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div><div class="col-12 col-lg-4"><label>Width: </label><div style="display: flex;"><input type="text" class="form-control" name="width" id="width" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div></div>');

    });

    //    var addOtherCharges = function(category_id){
    //         var arr_unit = <?= json_encode($arr_unit) ?>;
    //         $.ajax({
    //             type: 'post',
    //             url: '<?php echo base_url('ajax-add-other-charges'); ?>',
    //             //dataType:'json',
    //             data: {
    //                 arr_unit: arr_unit,
    //                 category_id:category_id
    //             },
    //             success: function(response) {

    //                 $('#charges_category_'+category_id+' tbody').append(response);
    //             }
    //         });
    //     }

    $('.addOtherCharges').click(function() {
        var arr_unit = <?= json_encode($arr_unit) ?>;
        var category_id = $(this).data('categoryid');
        console.log(this);
        console.log(category_id);
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('ajax-add-other-charges'); ?>',
            //dataType:'json',
            data: {
                arr_unit: arr_unit,
                category_id: category_id
            },
            success: function(response) {

                $('#charges_category_' + category_id + ' tbody').append(response);
            }
        });
        //$('.multi-packaging').append('<div class="form-group" style="padding: 10px; border: 1px solid #ccc;"><span><b>Package '+pckcount+'</b></span><div class="row"><div class="col-12 col-lg-4"><label>Material Description <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="material" required="required" /><span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle"></i></span></div></div><div class="col-12 col-lg-4"><label>HS Code <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="hs_code" required="required" /><span class="error1" style="display: none;"><i class="error-log fa fa-exclamation-triangle"></i></span> </div></div><div class="col-12 col-lg-4"><label>Type Of Packing <sup>* </sup></label><div class="input-comment"><select name="material_unit" class="form-control"><option value="">Select Packing</option><option>Wooden</option><option>Pallet</option><option>Box</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Net Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="net_weight" id="net_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Gross Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="gross_weight" id="gross_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Length: </label><div style="display: flex;"><input type="text" class="form-control" name="length" id="length" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Height: </label><div style="display: flex;"><input type="text" class="form-control" name="height" id="height" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div><div class="col-12 col-lg-4"><label>Width: </label><div style="display: flex;"><input type="text" class="form-control" name="width" id="width" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div></div>');

    });

    $(document).on('click', '.remove-item', function(e) {
        var currentElement = this;
        if (confirm("Are you sure you want to delete?")) {
            $(currentElement).closest('tr').remove();
            //  calculateTotalCost();
            calculateFinalTotal();
            return true;
        }
        return false
    });
    // $(document).on('click', '.remove-item', function(e) {
    //     var currentElement = this;

    //     e.preventDefault();
    //     bs4pop.confirm('Are your sure?', function(sure) {}, {
    //         title: 'Delete particular details.',
    //         hideRemove: true,
    //         btns: [{
    //                 label: 'ok',
    //                 onClick(cb) {
    //                     $(currentElement).closest('tr').remove();
    //                     //  calculateTotalCost();
    //                     calculateFinalTotal();
    //                     return true;
    //                 }
    //             },
    //             {
    //                 label: 'Cancel',
    //                 className: 'btn-secondary',
    //                 onClick(cb) {
    //                     return e.preventDefault();
    //                 }
    //             }

    //         ]

    //     });


    // });
</script>


<script type="text/javascript">
    var session_user_id = '<?= $this->session->userdata("seller_logged_in")['id']; ?>';
    var from_company_id = '<?= $this->session->userdata("seller_logged_in")['company_id']; ?>';
    var to_company_id = '<?= $requestDetails->fs_company_id; ?>';
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
                from_company_id: from_company_id,
                to_company_id: to_company_id,
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
                from_company_id: from_company_id,
                to_company_id: to_company_id,
                request_id: request_id,
                last_message_id: last_message_id
            },
            success: function(response) {

                $('.communication-box').append(response);
                //  $(".communication-box").animate({ scrollTop: $('.communication-box').prop("scrollHeight")}, 1000);

            }
        });
    }
    setInterval(function() {
        getMessages();
    }, 2000);
</script>

<script>
    $(document).click(function() {
        $(".dropdown-menu.show").removeClass('show');
    });
</script>
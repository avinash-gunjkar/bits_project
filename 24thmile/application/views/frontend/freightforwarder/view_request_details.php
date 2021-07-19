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

    .wshipping-content-block.shipping-block .shipping-form-block {
        padding-bottom: 0px;
    }


    .table {
        counter-reset: otherCharges;
    }

    .otherCharges-counter::before {
        counter-increment: otherCharges;
        content: counter(otherCharges);
    }

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

    input[name^="rfc_charges"]:read-only {
        border: none;
        background: transparent;
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

                        <h3 class="heading3-border">
                            Shipment Details
                        </h3>

                        <div class="shipping-form-block">
                            <?php $transactionCurrencyHtml =  "&nbsp;(" . ($requestDetails->transaction_currency ? $requestDetails->transaction_currency : 'INR') . ")"; ?>
                            <form id="frmRequirement" name="frmRequirement" action='<?= base_url("view-request-details/$requestDetails->request_id") ?>' method="post">

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
                                                    <label>Port of Loading :</label> <?= $requestDetails->port_loading_name ?>
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
                                                <label>Tentative Date of Dispatch :</label> <?= printFormatedDate($requestDetails->tentativ_date_dispatch); ?> </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
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
                                    ?>
                                        <div>
                                            <?php foreach ($rfc_charges as $key => $rfc_charge) { ?>
                                                <?php $sr_no = 1; ?>
                                                <?php if (!empty($rfc_charge->subCategory)) {
                                                    $categoryTotal = 0;
                                                    $categoryCounterRateTotal = 0;
                                                    $otherChargesHeader = 1;
                                                ?>
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
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($rfc_charge->subCategory as $key2 => $sub_rfc_charge) {
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
                                                                                <?= $sub_rfc_charge->charges ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $sub_rfc_charge->unit ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $sub_rfc_charge->qty ? $sub_rfc_charge->qty : 1 ?> <small><?= $sub_rfc_charge->unit ?></small>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <?= $sub_rfc_charge->total ? $sub_rfc_charge->total : 0.00 ?>
                                                                            </td>
                                                                            <td class="text-right"><?=$sub_rfc_charge->counter_rate?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <?php $uniqueRowKey = uniqid(); ?>
                                                                    <tr>
                                                                        <td><?= $sr_no++; ?></td>

                                                                        <td class="text-left"><?= $sub_rfc_charge->rfcChargesTitle ?> <?= $arrContainerType[$sub_rfc_charge->item_id] ? $arrContainerType[$sub_rfc_charge->item_id] : '' ?></td>
                                                                        <td>
                                                                            <?= $sub_rfc_charge->charges ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= $sub_rfc_charge->unit ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= printFloatQuantity($sub_rfc_charge->qty ? $sub_rfc_charge->qty : 1) ?> <small><?= $sub_rfc_charge->unit ?></small>
                                                                        </td>
                                                                        <td class="text-right">
                                                                            <?= $sub_rfc_charge->total ? $sub_rfc_charge->total : 0.00 ?>
                                                                        </td>
                                                                        <td class="text-right <?= $sub_rfc_charge->counter_rate!=$sub_rfc_charge->total?' text-danger ':''?>"><?=$sub_rfc_charge->counter_rate?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                            <?php } //end for
                                                            ?>

                                                            <?php foreach ($rfc_other_charges as $key => $other) {
                                                                if ($other->category_id == $rfc_charge->id) {
                                                                    $categoryTotal += $other->total;
                                                                    $categoryCounterRateTotal += $other->counter_rate;
                                                            ?>

                                                                    <?php if ($otherChargesHeader) {
                                                                        $otherChargesHeader = 0; ?>
                                                                        <tr class="other-charges">
                                                                            <th colspan="7" class="text-left">Other Charges</th>
                                                                        </tr>
                                                                    <?php } ?>

                                                                    <tr>
                                                                        <td class='otherCharges-counter'></td>
                                                                        <td class="text-left"><?= $other->title ?></td>
                                                                        <td><?= $other->charges ?></td>
                                                                        <td><?= $other->unit ?></td>
                                                                        <td><?= $other->qty ?> <small><?= $other->unit ?></small></td>
                                                                        <td class="text-right"><?= $other->total ?></td>
                                                                        <td class="text-right <?= $other->counter_rate!=$other->total?' text-danger ':''?>"><?=$other->counter_rate?></td>
                                                                    </tr>
                                                            <?php }
                                                            } ?>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="5" class="text-right">Total</th>
                                                                <th class="text-right"><?= number_format($categoryTotal, 2, '.', ',') ?></th>
                                                                <th class="text-right"><?= number_format($categoryCounterRateTotal, 2, '.', ',') ?></th>
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
                                                        <colgroup>
                                                            <col style="width:40%">
                                                            <col style="text-align:left;">
                                                        </colgroup>
                                                        <tbody>
                                                            <?php foreach ($other_charges as $charge) { ?>

                                                                <?php if ($charge->other_charge_id == '1') { ?>
                                                                    <tr>
                                                                        <td class="text-left">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>

                                                                        </td>
                                                                        <td class="text-left">

                                                                            <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] : '- -' ?>

                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <?php if ($charge->other_charge_id == '2') { ?>
                                                                    <tr>
                                                                        <td class="text-left">

                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td class="text-left">
                                                                            <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? printFormatedDate($other_charges_value_arr[$charge->other_charge_id]['value_1']) : '- -'; ?>


                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if ($charge->other_charge_id == '3' || $charge->other_charge_id == '4') { ?>
                                                                    <tr>
                                                                        <td class="text-left">

                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td class="text-left">
                                                                            <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? printFormatedDate($other_charges_value_arr[$charge->other_charge_id]['value_1']) : '- -' ?>

                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <?php if ($charge->other_charge_id == '5' || $charge->other_charge_id == '6') { ?>
                                                                    <tr>
                                                                        <td class="text-left">

                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td class="text-left">
                                                                            <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] : '- -' ?>


                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <?php if ($charge->other_charge_id == '7' || $charge->other_charge_id == '8') { ?>
                                                                    <tr>
                                                                        <td class="text-left">

                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td class="text-left">
                                                                            <div class="input-group">
                                                                                <span><?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] : '- -' ?></span> &nbsp;
                                                                                <span><?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] ?> </span>

                                                                            </div>


                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if ($charge->other_charge_id == '9') { ?>
                                                                    <tr>
                                                                        <td class="text-left">

                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td class="text-left">
                                                                            <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] . ' Days' : '- -' ?>


                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <?php if ($charge->other_charge_id == '10') { ?>
                                                                    <tr>
                                                                        <td class="text-left">

                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td class="text-left">
                                                                            <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] . ' Days' : '- -' ?>


                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <?php if ($charge->other_charge_id == '11') { ?>

                                                                    <tr>
                                                                        <td class="text-left">

                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                                        </td>
                                                                        <td class="text-left">
                                                                            <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] . ' Days' : '- -' ?>


                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <?php if ($charge->other_charge_id == '12') { ?>
                                                                    <tr>
                                                                        <td class="text-left">
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <label><?php echo  $charge->other_charge_title; ?> <?= $transactionCurrencyHtml ?>:</label>

                                                                        </td>
                                                                        <td class="text-left">

                                                                            <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] : '- -' ?>

                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>



                                                                <!--[start::looping for the container]-->
                                                                <?php if ($charge->other_charge_id == '13') { ?>
                                                                    <?php if ($requestDetails->shipment_id == '1') { ?>
                                                                        <?php foreach ($requestDetails->container as $key => $row) { ?>
                                                                            <tr>
                                                                                <td class="text-left">
                                                                                    <label><?php echo  $charge->other_charge_title; ?> <span>( <?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] ?>)</span> <?= $transactionCurrencyHtml ?>:</label>

                                                                                </td>
                                                                                <td class="text-left">
                                                                                    <div class="input-group">
                                                                                        <!--<span style="padding:5px 2px; background-color:#CCCCCC;"> </span>-->
                                                                                        <!--<span> <?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] ?></span>-->
                                                                                        <span><?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_1'] ? number_format($other_charges_value_arr[$charge->other_charge_id][$key]['value_1'], 2) : '- -'; ?></span>
                                                                                    </div>


                                                                                </td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    <?php } else { ?>
                                                                        <tr>
                                                                            <td class="text-left">

                                                                                <label><?php echo  $charge->other_charge_title; ?> <span>( <?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] ?>)</span> <?= $transactionCurrencyHtml ?>:</label>
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <div class="input-group">

                                                                                    <span><?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? number_format($other_charges_value_arr[$charge->other_charge_id]['value_1'], 2) : '- -'; ?></span>
                                                                                </div>


                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>


                                                                <?php } ?>

                                                                <?php if ($charge->other_charge_id == '14') { ?>
                                                                    <?php if ($requestDetails->shipment_id == '1') { ?>
                                                                        <?php foreach ($requestDetails->container as $key => $row) { ?>
                                                                            <tr>
                                                                                <td class="text-left">

                                                                                    <label><?php echo  $charge->other_charge_title; ?> <span>( <?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] ?>)</span> <?= $transactionCurrencyHtml ?>:</label>
                                                                                </td>
                                                                                <td class="text-left">

                                                                                    <div class="input-group">
                                                                                        <!--<span style="padding:5px 2px; background-color:#CCCCCC;"><?= $row->container_size_title . ' ' . $row->container_type_name ?>  Container</span>-->
                                                                                        <!--<span><?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] ?></span>-->
                                                                                        <span><?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_1'] ? number_format($other_charges_value_arr[$charge->other_charge_id][$key]['value_1'], 2) : '- -'; ?></span>
                                                                                    </div>

                                                                                </td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    <?php } else { ?>
                                                                        <tr>
                                                                            <td class="text-left">

                                                                                <label><?php echo  $charge->other_charge_title; ?> <span>( <?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] ?>)</span> <?= $transactionCurrencyHtml ?>:</label>
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <div class="input-group">

                                                                                    <span><?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? number_format($other_charges_value_arr[$charge->other_charge_id]['value_1'], 2) : '- -'; ?></span>
                                                                                </div>


                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>


                                                                <?php } ?>

                                                                <!--[end::looping for the container]-->


                                                                <?php if ($charge->other_charge_id == '15') { ?>
                                                                    <tr>
                                                                        <td class="text-left">

                                                                            <label><?php echo str_replace("{mode}", $requestDetails->mode, $charge->other_charge_title); ?>:</label>
                                                                        </td>
                                                                        <td class="text-left">

                                                                            <?php
                                                                            $arr_value_1 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_1']);
                                                                            $arr_value_2 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_2']);
                                                                            ?>
                                                                            <div class="input-group">
                                                                                <?php if (!empty($other_charges_value_arr[$charge->other_charge_id]['value_1']) && !empty($other_charges_value_arr[$charge->other_charge_id]['value_2'])) { ?>
                                                                                    <span><?= $arr_value_1[0] ?></span> &nbsp;
                                                                                    <span><?= $arr_value_1[1] ?></span>
                                                                                    <span class="equal-sign"></span>
                                                                                    <span><?= $arr_value_2[0] ?></span> &nbsp;
                                                                                    <span><?= $arr_value_2[1] ?></span>
                                                                                <?php } else { ?>

                                                                                    <span>- -</span>
                                                                                <?php } ?>
                                                                            </div>

                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if ($charge->other_charge_id == '16') { ?>
                                                                    <tr>
                                                                        <td class="text-left">
                                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>

                                                                        </td>
                                                                        <td class="text-left">

                                                                            <?php
                                                                            $arr_value_1 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_1']);
                                                                            $arr_value_2 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_2']);
                                                                            ?>
                                                                            <div class="input-group">
                                                                                <?php if (!empty($other_charges_value_arr[$charge->other_charge_id]['value_1']) && !empty($other_charges_value_arr[$charge->other_charge_id]['value_2'])) { ?>
                                                                                    <span><?= $arr_value_1[0] ?></span>&nbsp;
                                                                                    <span><?= $arr_value_1[1] ?></span>
                                                                                    <span class="equal-sign"></span>
                                                                                    <span><?= $arr_value_2[0] ?></span>&nbsp;
                                                                                    <span><?= $arr_value_2[1] ?></span>
                                                                                <?php } else { ?>

                                                                                    <span>- -</span>
                                                                                <?php } ?>
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
                                                    <col style="width:80%">
                                                    <col style="width:20%">
                                                </colgroup>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-right">
                                                            <h3>Total Quote Value<?= $transactionCurrencyHtml ?>:</h3>
                                                        </td>
                                                        <td class="text-right">
                                                            <h3> <?= number_format($requestDetails->total_quote_amount, 2) ?></h3>
                                                        </td>
                                                    </tr>
                                                    <?php if (!empty($requestDetails->counter_rate)) { ?>
                                                        <tr>
                                                            <td class="text-right">
                                                                <h3>Counter Rate<?= $transactionCurrencyHtml ?>:</h3>
                                                            </td>
                                                            <td class="text-right">
                                                                <h3><?= number_format($requestDetails->counter_rate, 2) ?></h3>
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


                                    <?php if (in_array($requestDetails->quote_status, ['4'])) { ?>
                                        <div class="row mt-5">
                                            <div class="col-lg-12 mb-2">
                                                <h3><b>Comment</b></h3>
                                                <!--<label>Comment <sup>*</sup></label><br>-->
                                                <textarea name="comment" class="form-control" required=""></textarea>
                                            </div>
                                        </div>
                                    <?php } ?>


                                </div>
                                <!--.shipping-form-block-->

                                <!--<input type="submit" name="submit" class="submit action-button" value="Save & Continue" />-->
                                <!--                    <input type="submit" name="submit" class="btn btn-success" value="Submit" />-->
                                <div class="col-lg-12 text-right">
                                    <?php if (in_array($requestDetails->quote_status, ['4'])) { ?>
                                        <a href="<?= base_url('ff-request-list'); ?>" class="btn btn-secondary btn-md">Go Back</a>
                                        <input type="hidden" id="actionType" name="actionType" value="Accept">
                                        <input type="submit" name="submit_btn" class="btn  btn-success btn-md" value="Accept" onclick="$('#actionType').val('Accept');" />
                                        <input type="submit" name="submit_btn" class="btn reject-shipment-btn btn-danger btn-md" value="Reject" onclick="$('#actionType').val('Reject');" />
                                    <?php } ?>
                                </div>


                            </form>
                        </div>
                        <!--shipping-form-block-->


                        <?php if (!in_array($requestDetails->quote_status, ['6'])) { ?>
                            <div class=" mescms clearfix">
                                <h3 class="">Communication</h3>
                            </div>
                            <div class="communicate_box clearfix">

                                <div class="col-lg-12 communication-box">
                                    <?php foreach ($messages as $message) {
                                        $this->load->view('frontend/communication/message', ['message' => $message, 'from_user_id' => $this->seller_session_data['id']]);
                                    } ?>
                                </div>



                                <div class="col-lg-12  text-right ">

                                    <textarea id="message" class="form-control mb-3" maxlength="200" placeholder="Message..."></textarea>

                                    <a href="<?= base_url('ff-request-list'); ?>" class="btn btn-secondary btn-md">Go Back</a>
                                    &nbsp;
                                    <input type="button" class="btn btn-submit btn-md" id="btn_sendMessage" value="Send Message">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!--.tab-containt-->
                </div>
                <!--.tracking-block-->
            </div>
            <!--.col-->
        </div>
        <!--.row-->
    </div>
    <!--container-->
</div>
<!--.wshipping-content-block-->

<!-- Blog content end -->
</section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script> -->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->

<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<script type="text/javascript">
    $(document).on('click', '.reject-shipment-btn', function(e) {
        var currentElement = this;
        if (!$('#frmRequirement').valid()) {
            return;
        }
        if (confirm('Are you sure, Reject Shipment?')) {
            $(currentElement).closest('form').submit();
        }

        // e.preventDefault();
        // bs4pop.confirm('Are your sure?', function(sure) {}, {
        //     title: 'Reject Shipment',
        //     hideRemove: true,
        //     btns: [{
        //             label: 'ok',
        //             onClick(cb) {

        //             }
        //         },
        //         {
        //             label: 'Cancel',
        //             className: 'btn-secondary',
        //             onClick(cb) {
        //                 return e.preventDefault();
        //             }
        //         }

        //     ]

        // });


    });
</script>



<script type="text/javascript">
    var session_user_id = '<?= $this->session->userdata("seller_logged_in")['id']; ?>';
    var from_company_id = '<?= $this->session->userdata("seller_logged_in")['company_id']; ?>';
    var to_company_id = '<?= $requestDetails->fs_company_id; ?>';
    var request_id = '<?= $requestDetails->request_id; ?>';
    $('#btn_sendMessage').click(function() {
        var msg = $('#message').val().trim();

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

<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
<!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
<!------ Include the above in your HEAD tag ---------->
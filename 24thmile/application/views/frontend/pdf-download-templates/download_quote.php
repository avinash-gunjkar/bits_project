<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/frontend/images/Logo-Temgire.png'); ?>" />
    
    <title>RFC ID: <?=$requestDetails->request_id?> Shipment Quotation Details by <?= ucwords($ff_details->name) ?></title>
    <style>
        /** 
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
     **/
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 1cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2.5cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 1cm;
            left: 2cm;
            right: 0cm;
            height: 2cm;

            /* Extra personal styles */
            /*background-color: #03a9f4;*/
            color: white;
            text-align: left;
            line-height: 1.5cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 0.5cm;

            /* Extra personal styles */
            /* background-color: #03a9f4; */
            /* color: white; */
            text-align: center;
            line-height: 0.15cm;

        }



        /**{ margin:0px; padding:0px; box-sizing:border-box;}*/
        body {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
        }

        /*.main { width:90%; margin:50px;}*/
        .table {
            width: 100%;
            font-size: 12px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .table table {
            border-collapse: collapse;
            width: 100%
        }

        .table table th,
        .table table td {
            padding: 6px 5px;
        }

        .table table tr.border {
            border-bottom: solid 1px #cccccc;
        }

        .table table td h1 {
            margin: 10px 0px;
            font-weight: 300;
        }

        .cmtname {
            text-transform: uppercase;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        p {
            margin-bottom: 2px;
        }

        /*.invoice-from p{ margin-bottom:2px;}*/
        .bg {
            background: #dfdfdf;
        }

        /* #particularTbl tbody tr:nth-child(even) {
            background-color: rgba(0,0,0,0.2);
        }
        #particularTbl tbody tr:nth-child(odd) {
            background-color: rgba(0,0,0,0.1);
        } */

        .particularTbl table,
        .particularTbl th,
        .particularTbl td {
            border: 1px solid #000;
        }

        .particularTbl tbody tr td {
            padding: 10px 5;
            line-height: 10px;
        }

        #bankDetails tbody tr td {
            padding: 10px 2;
            line-height: 5px;
        }

        #customerDetails td {
            line-height: 5px;
        }

        #customerDetails {
            margin: 20px 0;
        }

        #customerDetails p b {
            padding-right: 5px;
            display: inline-block;
            width: 80px;
        }

        #bankDetails p b {
            margin-right: 5px;
        }

        h1 {
            font-weight: bold;
        }
        label{
            font-weight: bold;
        }
        .multi-packaging table,.table-bordered {
            border-collapse: collapse;
        }
        .multi-packaging table tr td, .multi-packaging table tr th, .table-bordered tr td, .table-bordered tr th{
            border: 1px solid #c8c8c8;
            font-size: 12px;
        }
         
    </style>
</head>

<body>
    <footer>
        <div class="text-center" style="background-color: #fff; color:#000;padding-bottom: 5px;">
        <small>This is a system-generated document and does not require a signature.</small>
        </div>
    </footer>
    <!-- Tracking start -->
    <div class="wshipping-content-block">

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="tracking-block">
                    <img src="<?= APPPATH . '../assets/frontend/images/logo-for-invoice.jpg' ?>" style="height:40px; ">
                        <div class="tab-content">

                            <h3 class="heading3-border">Shipment Quotation Details by <?= ucwords($ff_details->name) ?></h3>


                            <!-- <div class="wshipping-content-block shipping-block">
                            <div class="container">
                                <div class="row"> -->
                            <div class="shipping-form-block">
                                <?php $transactionCurrencyHtml =  "&nbsp;(" . ($requestDetails->transaction_currency ? $requestDetails->transaction_currency : 'INR') . ")"; ?>

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
                                                                <label><?= ($requestDetails->transaction == "Import") ? "De-stuffing" : "Stuffing" ?> :</label>
                                                                <?= $requestDetails->stuffing ?>
                                                            </address>

                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                        <table class='table'>
                                            <tbody>
                                                <tr><td><h3><b>Consignor/Pick up</b></h3></td><td><h3><b>Consignee/Deliver To</b></h3></td></tr>
                                                <tr>
                                                    <td>
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
                                                    </td>
                                                    <td>
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
                                                    </td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>

                                    
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td> 
                                                        <label>Shipment Value: </label><br> <?= $requestDetails->shipment_value_currency . ' ' . $requestDetails->shipment_value; ?>
                                                    </td>
                                                    <td>
                                                    <label>Port of Loading :</label> <br><?= $requestDetails->port_loading_name ?>
                                                    </td>
                                                    <td>
                                                    <label>Port of Discharge :</label><br> <?= $requestDetails->port_discharge_name ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                    <label>Tentative Date of Dispatch :</label><br> <?= printFormatedDate($requestDetails->tentativ_date_dispatch); ?>
                                                    </td>
                                                    <td>
                                                    <label>Offer response on or before :</label><br> <?= printFormatedDate($requestDetails->response_end_date) ?>
                                                    </td>
                                                    <td>
                                                    <label>Expected Payment Term :</label><br> <?= $requestDetails->payment_term ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                    <label>Any Special Consideration for LCL</label>
                                                    <div class="input-comment">
                                                        <?= $requestDetails->special_consideration_lcl; ?>
                                                    </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>


                                        
                                        
                                    

                                        <?php $this->load->view('frontend/pdf-download-templates/shipping_container_list', ['requestDetails' => $requestDetails]); ?>
                                        <?php $this->load->view('frontend/pdf-download-templates/shipping_packaging_list', ['requestDetails' => $requestDetails]); ?>


                                        <?php if (!empty($rfc_charges)) {
                                            $rfc_charge_counter = 0;
                                        ?>
                                            <div>
                                                <?php foreach ($rfc_charges as $key => $rfc_charge) { ?>
                                                    <?php $sr_no = 1; ?>
                                                    <?php if (!empty($rfc_charge->subCategory)) {
                                                        $categoryTotal = 0;
                                                        $otherChargesHeader = 1;
                                                    ?>
                                                        <h3><b><?= $rfc_charge->rfc_category_name ?></b><?= $transactionCurrencyHtml ?></h3>
                                                        <table id="<?= "charges_category_$rfc_charge->id" ?>" class="table table-bordered">
                                                            <colgroup>
                                                                <col style="width:50px">
                                                                <col style="width:200px">
                                                                <col style="width:200px">
                                                                <col style="width:100px">
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
                                                                    <th>Total Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($rfc_charge->subCategory as $key2 => $sub_rfc_charge) {
                                                                    $categoryTotal += $sub_rfc_charge->total;  ?>
                                                                    <?php if ($sub_rfc_charge->unit == 'Container' && empty($sub_rfc_charge->ffChargesId)) { ?>
                                                                        <?php foreach ($requestDetails->container as $row) { ?>
                                                                            <?php $uniqueRowKey = uniqid(); ?>
                                                                            <tr>
                                                                                <td><?= $sr_no++; ?></td>

                                                                                <td class="text-left"><?= $sub_rfc_charge->rfcChargesTitle . ' ' . $row->container_size_title . ' ' . $row->container_type_name ?> </td>
                                                                                <td class='text-right'>
                                                                                    <?= $sub_rfc_charge->charges ?>
                                                                                </td>
                                                                                <td class='text-center'>
                                                                                    <?= $sub_rfc_charge->unit ?>
                                                                                </td>
                                                                                <td >
                                                                                    <?= $sub_rfc_charge->qty ? $sub_rfc_charge->qty : 1 ?> <small><?= $sub_rfc_charge->unit ?></small>
                                                                                </td>
                                                                                <td class='text-right'>
                                                                                    <?= $sub_rfc_charge->total ? $sub_rfc_charge->total : 0.00 ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    <?php } else { ?>
                                                                        <?php $uniqueRowKey = uniqid(); ?>
                                                                        <tr>
                                                                            <td><?= $sr_no++; ?></td>

                                                                            <td class="text-left"><?= $sub_rfc_charge->rfcChargesTitle ?> <?= $arrContainerType[$sub_rfc_charge->item_id] ? $arrContainerType[$sub_rfc_charge->item_id] : '' ?></td>
                                                                            <td class='text-right'>
                                                                                <?= $sub_rfc_charge->charges ?>
                                                                            </td>
                                                                            <td class='text-center'>
                                                                                <?= $sub_rfc_charge->unit ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= printFloatQuantity($sub_rfc_charge->qty ? $sub_rfc_charge->qty : 1) ?> <small><?= $sub_rfc_charge->unit ?></small>
                                                                            </td>
                                                                            <td class='text-right'>
                                                                                <?= $sub_rfc_charge->total ? $sub_rfc_charge->total : 0.00 ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>

                                                                <?php } //end for
                                                                ?>

                                                                <?php foreach ($rfc_other_charges as $key => $other) {
                                                                    if ($other->category_id == $rfc_charge->id) {
                                                                        $categoryTotal += $other->total;
                                                                ?>

                                                                        <?php if ($otherChargesHeader) {
                                                                            $otherChargesHeader = 0; ?>
                                                                            <tr class="other-charges">
                                                                                <th colspan="6" class="text-left">Other Charges</th>
                                                                            </tr>
                                                                        <?php } ?>

                                                                        <tr>
                                                                            <td class='otherCharges-counter'></td>
                                                                            <td class="text-left"><?= $other->title ?></td>
                                                                            <td class='text-right'><?= $other->charges ?></td>
                                                                            <td class='text-center'><?= $other->unit ?></td>
                                                                            <td ><?= $other->qty ?> <small><?= $other->unit ?></small></td>
                                                                            <td class='text-right'><?= $other->total ?></td>
                                                                        </tr>
                                                                <?php }
                                                                } ?>

                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th colspan="5" class="text-right">Total</th>
                                                                    <th class='text-right'><?= number_format($categoryTotal, 2, '.', ',') ?></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    <?php } ?>

                                                <?php } ?>
                                            </div>

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

                                                        <td colspan="4" class="text-right">
                                                            <h3>Total Quote Value<?= $transactionCurrencyHtml ?></h3>
                                                        </td>
                                                        <td>
                                                            <h3> <?= number_format($requestDetails->total_quote_amount, 2) ?></h3>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td colspan="4" class="text-right">
                                                            <h3>Counter Rate<?= $transactionCurrencyHtml ?></h3>
                                                        </td>
                                                        <td>
                                                            <h3><?= $requestDetails->counter_rate?$requestDetails->counter_rate:'- -' ?></h3>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        <?php } ?>

                                        <div class="col-12 my-5">
                                            <div class="row">
                                                <div class="col-12 col-lg-12">
                                                    <div class="pannelGroup show">
                                                        <div class="heading">
                                                            <h3>Terms and Conditions <i class="icon pull-right"></i></h3>
                                                        </div>
                                                        <div class="pannelBody">
                                                            <?= getTermsNConditions() ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                    </div>

                               
                            </div>
                            <!-- </div>
                            </div>
                        </div> -->
                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
    <!-- Blog content end -->
    </section><!-- sidebar_dashboard-->
    </div> <!-- sidebar_dashboard-->
</body>

</html>
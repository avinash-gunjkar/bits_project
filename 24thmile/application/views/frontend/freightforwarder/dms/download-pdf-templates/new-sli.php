<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/frontend/images/Logo-Temgire.png'); ?>" />
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/bootstrap.min.css'); ?>" /> -->
    <title>Document</title>
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
            height: 1.5cm;

            /* Extra personal styles */
            /* background-color: #03a9f4; */
            /* color: white; */
            text-align: center;
            line-height: 0.5cm;

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
            margin-top: 10px;
            margin-bottom: 10px;
            border-collapse: collapse;

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

        .table-bordered tr td {
            border: solid 1px #cccccc;
        }

        .table table td h1 {
            margin: 10px 0px;
            font-weight: 300;
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



        .particularTbl table,
        .particularTbl th,
        .particularTbl td {
            border: 1px solid #000;
        }

        .particularTbl tbody tr td {
            padding: 10px 5;
            line-height: 10px;
        }


        h1 {
            font-weight: bold;
        }

        label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    $other_details = $documentData->other_details;
    $consignor = (object) $other_details->consignor;
    $items = $documentData->items;
    ?>

    <footer>
        <div class="text-center" style="background-color: #fff; color:#000;padding-bottom: 5px;">
            <small><?= $consignor->company_name ?> <?= $consignor->address_line_1 ?> <?= $consignor->address_line_2 ?> <?= $consignor->city_name ?> Pincode: <?= $consignor->pincode ?> <br> Contact Person: <?= $consignor->contact_name ?> Email: <?= $consignor->contact_email ?> Phone: <?= $consignor->contact_phone ?> </small>
        </div>
    </footer>

    <!-- Tracking start -->
    <div class="wshipping-content-block">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="tracking-block">
                        <div class="tab-content">

                            <center>
                                <h3 class="heading3-border">New SLI</h3>
                            </center>




                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                </colgroup>
                                <tbody>
                                <tr>
                                        <td colspan="4" class="text-left">
                                            <label for="">Date:</label>
                                            <span><?= printFormatedDate(date('Y-m-d')) ?></span>
                                            <br>
                                            <label for="">Bluedart Account</label>
                                            <div style="white-space: pre;"><?= $other_details->bluedart_account ?></div>

                                            <label for="">Invoice No.</label>
                                            <div style="white-space: pre;"><?= $documentData->invoice_number ?></div>

                                            <label for="">Dart EWB No.</label>
                                            <div style="white-space: pre;"><?= $other_details->dart_ewb_no ?></div>

                                            <label for="">EIN No.</label>
                                            <div style="white-space: pre;"><?= $other_details->ein_no ?></div>

                                            <label for="">PAN No.</label>
                                            <div style="white-space: pre;"><?= $other_details->pan_no ?></div><br>

                                            <label for="">AD Code No.</label>
                                            <div style="white-space: pre;"><?= $other_details->ad_code_no ?></div>

                                            <label for="">IEC No.</label>
                                            <div style="white-space: pre;"><?= $other_details->iec_no ?></div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Exporter:</label>
                                            <div style="white-space: pre-wrap;"><?= $other_details->exporter ?></div>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <label for="">Contract Type(Select one):</label><br>

                                            <ul style="display:inline-table">
                                                <li><label>Ex-Works                                                 
                                        <?php $radioImage = $other_details->contract_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">                                             
                                                </label></li>
                                                <li><label>C & F (breakup) 
                                                <?php $radioImage = $other_details->contract_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">   
                                                </label></li>
                                                <li><label>CIF (breakup) 
                                                <?php $radioImage = $other_details->contract_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                            </ul>
                                            <ul style="display:inline-grid">
                                                <li><label>FOB 
                                                    <?php $radioImage = $other_details->contract_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Cost 
                                                    <?php $radioImage = $other_details->contract_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Cost 
                                                    <?php $radioImage = $other_details->contract_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                            </ul>
                                            <ul style="display:inline-grid">
                                                <li><label>DDP 
                                                    <?php $radioImage = $other_details->contract_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Freight 
                                                    <?php $radioImage = $other_details->contract_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Insurance 
                                                    <?php $radioImage = $other_details->contract_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                            </ul>
                                            <ul style="display:inline-grid">
                                                <li><label>Other 
                                                <?php $radioImage = $other_details->contract_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                    </label>
                                                </li>
                                            </ul><br>

                                            <label>Other Please Specify:</label>
                                            <div style="white-space: pre;"><?= $other_details->other_specified ?></div><br>

                                            <label for="">Currency:</label>
                                            <label for="">USD</label>
                                            <div style="white-space: pre;"><?= $other_details->currency ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" rowspan="3" class="text-left">
                                            <label for="">Consignee:</label>
                                            <div style="white-space: pre-wrap;"><?= $other_details->consignee ?></div>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <label for="">Type of Shipping Bill (tick one)</label><br>
                                            <ul style="display:inline-table">
                                                <li><label>Drawback 
                                                <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Commercial exports 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Sample-FOC 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Free Shipping Bill 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                            </ul>
                                            <ul style="display:inline-grid">
                                                <li><label>NFEI 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>EOU 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Advance Authorisation 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Re-Export 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                            </ul>
                                            <ul style="display:inline-grid">
                                                <li><label>MEIS 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>EPCG 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Jobbing 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                                <li><label>Repair and Return 
                                                    <?php $radioImage = $other_details->type_of_shipping_bill == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></li>
                                            </ul>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Duty Drawback Details:</label>
                                            <div style="white-space: pre-wrap;"><?= $other_details->duty_drawback_details ?></div>
                                            <label for="">Bank Details:</label>
                                            <div style="white-space: pre-wrap;"><?= $other_details->bank_detalis ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Current A/c No.:</label>
                                            <div style="white-space: pre;"><?= $other_details->current_ac_no ?></div>
                                            <label for="">Description Of Goods:</label>
                                            <div style="white-space: pre;"><?= $other_details->description_of_goods ?></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="1"><label for="">Destination</label></td>
                                        <td colspan="1"><label for="">No. Of Packages</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="white-space: pre;"><?= $other_details->destination ?></div>
                                        </td>
                                        <td><div style="white-space: pre;"><?= $other_details->no_of_packages ?></div></td>
                                        <td><label for="">GSTIN Details</label></td>
                                        <td><div style="white-space: pre;"><?= $other_details->gstin_details ?></div></td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Net Weight (Kgs)</label></td>
                                        <td><label for="">Gross Weight (Kgs)</label></td>
                                        <td><label for="">GSTIN No. of the pick-up state</label><br>
                                            <div style="white-space: pre;"><?= $other_details->gstin_no_of_pickup_state ?></div>
                                        </td>
                                        <td><label for="">GSTIN Type</label><br>
                                            <div style="white-space: pre;"><?= $other_details->gstin_type ?></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><div style="white-space: pre;"><?= $other_details->net_wt ?></div></td>
                                        <td><div style="white-space: pre;"><?= $other_details->gross_wt ?></div></td>
                                        <td><label for="">State Code</label></td>
                                        <td><div style="white-space: pre;"><?= $other_details->state_code ?></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label for="">Marks and Numbers: </label>
                                            <div style="white-space: pre;"><?= $other_details->marks_and_numbers ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" rowspan="4" class="text-left">
                                            <label for="">Documents Enclosed (tick where applicable):</label>
                                            <ul>
                                                <li><label for="">AWB (duly complete)</label>
                                                <?php $checkBoxImage = $other_details->awb == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">                                                    
                                                </li>
                                                <li><label for="">Invoice (5 copies)</label>
                                                <?php $checkBoxImage = $other_details->invoice == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                                    
                                                </li>
                                                <li><label for="">Packing List (5 copies)</label>
                                                <?php $checkBoxImage = $other_details->packing_list == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                                    
                                                </li>
                                                <li><label for="">Buyer Order</label>
                                                <?php $checkBoxImage = $other_details->buyer_order == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                                    
                                                </li>
                                                <li><label for="">GSP Form</label>
                                                <?php $checkBoxImage = $other_details->gsp_form == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                                    
                                                </li>
                                                <li><label for="">Original, Duplicate Visa (with 2 copies)</label>
                                                <?php $checkBoxImage = $other_details->visa == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                                    
                                                </li>
                                                <li><label for="">Export Certificates (with 2 copies)</label>
                                                <?php $checkBoxImage = $other_details->export_certificate == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                                    
                                                </li>
                                                <li><label for="">Photo copy of IEC with PAN No.</label>
                                                <?php $checkBoxImage = $other_details->iec_with_pan == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                                    
                                                </li>
                                                <li><label for="">Bank Certificate</label>
                                                <?php $checkBoxImage = $other_details->bank_certificate == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                                    
                                                </li>
                                                <li><label for="">ARE-1 Form</label>
                                                <?php $checkBoxImage = $other_details->are1_form == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                                    
                                                </li>
                                                <li><label for="">Any Export Promotion Council Regn. Copy</label>
                                                <?php $checkBoxImage = $other_details->export_promotion_council == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                                    
                                                </li>
                                            </ul>
                                        </td>
                                        <td colspan="2" class="text-left"><label for="">Mandatory if PSD / EP copy delivery address other than IEC Add.</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left"><label for="">Post shipment document / EP delivery instructions</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <label for="">Contact person</label>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: pre;"><?= $other_details->contact_person ?></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">Telephone / Mobile</label>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: pre;"><?= $other_details->mobile_no ?></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">Street Address 1</label>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: pre;"><?= $other_details->street_addr1 ?></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">Street Address 2</label>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: pre;"><?= $other_details->street_addr2 ?></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">City</label>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: pre;"><?= $other_details->city ?></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="">PIN number</label>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: pre;"><?= $other_details->pin_no ?></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label for="">Any other instructions on Post shipment docs / EP delivery</label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">Details of Duty Benefit Claimed</label><br>
                                            <label for="">Drawback</label><br>
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <td><label for="">Inv Item No.</label></td>
                                                        <td>
                                                            <label for="">Bank Name</label>
                                                        </td>
                                                        <td>
                                                            <label for="">A/c No.</label>
                                                        </td>
                                                        <td>
                                                            <label for="">DBK Sr. No.</label>
                                                        </td>
                                                        <td>
                                                            <label for="">DBK Rate</label>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) { ?>
                                                        <?php foreach ($items as $key => $item) { ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $item->inv_item_no ?>
                                                                </td>
                                                                <td>
                                                                    <?= $item->bank_name ?>
                                                                </td>
                                                                <td>
                                                                    <?= $item->ac_no ?>
                                                                </td>
                                                                <td>
                                                                    <?= $item->dbk_sr_no ?>
                                                                </td>
                                                                <td>
                                                                    <?= $item->dbk_rate ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">Drawback Item Declaration</label><br>

                                            <div class="text-center">
                                                <label for="">DBK 001 </label>
                                                <input type="text" name="" id="">
                                                <label for="">DBK 002 </label>
                                                <input type="text" name="" id="">
                                                <label for="">DBK 003 </label>
                                                <input type="text" name="" id="">
                                            </div><br>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">DEEC / EPCG Details</label><br>

                                            <label for="">Inv Item No </label>
                                            <label for="">REG No(If LIC prior to 2009):
                                                <div style="white-space: pre;"><?= $other_details->reg_no ?></div>
                                            </label>
                                            <label for="">Date: </label>
                                            <span><?= printFormatedDate(date('Y-m-d')) ?></span>
                                            <label for="">EPCG / DEEC LIC No. / Date: </label>
                                            <span><?= printFormatedDate(date('Y-m-d')) ?></span>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">Any Other Documents:</label><br>
                                            <div class="text-center"><label for="">If MEIS box is ticked in type of shippping bill please mention on the Shipping Bill as under:</label><br>
                                                <label for="">"We intend to claim rewards under Merchandise Export From India Scheme (MEIS)"</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">Other Handling Information</label><br>
                                            <div>
                                                <label for="">GSP REQUIRED? If YES - (It will be prepared by Jeena & Co.)</label><br>
                                                <label for="">If NO - Please provide the GSP (if applicable).</label>
                                                <label for="">GSP Type:</label>
                                                <label>Normal 
                                                <?php $radioImage = $other_details->gsp_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">   
                                                </label>
                                                <label>Tatkal 
                                                    <?php $radioImage = $other_details->gsp_type == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">   
                                                </label>
                                                <label for="">(Same Day) (Please tick any one)</label><br>
                                                <label for="">GSP Registration No.: </label>
                                                <div style="white-space: pre;"><?= $other_details->gsp_reg_no ?></div>
                                                <label for="">Password: </label>
                                                <div style="white-space: pre;"><?= $other_details->password ?></div>
                                            </div><br>
                                            <label for="">Refer www.eicindia.gov.in. for further inquiry.</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left">
                                            <p>We hereby appoint ""FORWARDER NAME"" as our authorized CHA for filling of our export / import documents in our name & getting our cargo cleared as per the documents and information provided to them by us. We hereby also declare that the information in the subject invoice is as per our knowledge, true and correct and if during custom examination anything found contradictory / objectionable in the shipment neither CHA nor the carrier would be held responsible.</p><br>
                                            <label for="">I/ We declare that the particulars given herein are true, correct and complete</label>

                                            <label for="">I/We undertake to abide by provisions of Foreign Exchange Management Act, 1999, as amended from time to time, including realization / repatriation of foreign exchange to / from India.</label>

                                            <br><br><br>
                                            <label for="">Shipper Signature and Stamp</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Shipper Name & Designation:</label>
                                        </td>
                                        <td>
                                            <div style="white-space: pre;"><?= $other_details->shippers_name ?></div>

                                            <div style="white-space: pre;"><?= $other_details->shippers_desig ?></div>
                                        </td>
                                        <td><label for="">Contact Details:</label></td>
                                        <td><div style="white-space: pre;"><?= $other_details->contact_details ?></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-left"><label for="">MANDATORY REQUIREMENTS FOR BELOW SHIPPING TYPES Note: EVD IS MUST FOR EVERY TYPES OF S/B )</label></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label for="">DRAWBACK</label><br>
                                            <label for="">Cenvat Form</label>
                                            <label for="">(with comm, division and range)</label><br>
                                            <label for="">Anex 7 (for Leather Items)</label><br>
                                            <label for="">Net Wt of Items</label>
                                        </td>
                                        <td class="text-left">
                                            <label for="">DEEC / DFIA</label><br>
                                            <label for="">Original Consumption Sheet</label><br>
                                            <label for="">Copy of Registration Sheet</label><br>
                                            <label for="">IEC Copy</label><br>
                                            <label for="">EPCG</label>
                                        </td>
                                        <td class="text-left">
                                            <label for="">EPCG Licence</label><br>
                                            <label for="">Copy of Reg. Sheet</label><br>
                                            <label for="">RE-EXPORT</label><br>
                                            <label for="">Original Bill of Entry</label><br>
                                            <label for="">Original Import Invoice</label>
                                        </td>
                                        <td class="text-left">
                                            <label for="">GR Waiver (Bank NOC)</label><br>
                                            <label for="">Chartered Engg.Certificate</label><br>
                                            <label for="">100% EOU</label><br>
                                            <label for="">ANEX. C1</label><br>
                                            <label for="">ARE 1</label>
                                        </td>
                                    </tr>
                                    

                                </tbody>
                            </table>
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
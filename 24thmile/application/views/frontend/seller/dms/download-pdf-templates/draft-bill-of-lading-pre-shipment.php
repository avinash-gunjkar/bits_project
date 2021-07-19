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
            height: 0.5cm;

            /* Extra personal styles */
            /* background-color: #03a9f4; */
            /* color: white; */
            text-align: center;
            line-height: 0.15cm;

        }



        /**{ margin:0px; padding:0px; box-sizing:border-box;}*/
        body {
            font-size: 8px;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
        }

        /*.main { width:90%; margin:50px;}*/
        .table {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table table {
            border-collapse: collapse;
            width: 100%
        }

        .table tr th,
        .table tr td {
            padding: 5px;
            vertical-align: top;
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





        h1 {
            font-weight: bold;
        }

        label {
            font-weight: bold;
        }
    </style>
</head>

<body>
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
                                <h3 class="heading3-border">Draft Bill of Lading</h3>
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
                                        <td colspan="2" rowspan="3" class="text-left">
                                            <label for="">Shipper: </label>
                                            <div style="white-space: pre;"><?=$other_details->shipper?></div>
                                            
                                            
                                        </td>
                                        <td>
                                            <label for="" style="min-width: 100px;">Shipper's Reference:</label>
                                            <span><?= $other_details->shipper_reference ?></span>
                                        </td>
                                        <td rowspan="2">
                                            <label for="" style="min-width: 100px;">Bill of Lading Number: </label>

                                            <span><?= $other_details->bill_of_lading_number ?></span>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="" style="min-width: 100px;">Carrier's Reference:</label>
                                            <span><?= $other_details->carrier_reference ?></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label style="min-width: 100px;">Unique Consignment Reference:</label>

                                            <div><?= $other_details->unique_consignment_reference ?></div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Consignee: </label>
                                            <div style="white-space: pre;"><?=$other_details->consignee?></div>
                                            </td>
                                        <td colspan="2" class="text-left">
                                            <label for="">Carrier Name: </label>
                                            <div style="white-space: pre;"><?=$other_details->carrier?></div>
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Notify Party (if other than Consignee): </label>
                                            <div style="white-space: pre;"><?=$other_details->notify_party?></div>
                                            

                                        </td>
                                        <td colspan="2" class="text-left">
                                            <label for="">Additional Party Notify: </label>
                                            <div style="white-space: pre;"><?=$other_details->additional_notify_party?></div>
                                            

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-left">
                                            <label for="" style="min-width: 100px;">Pre-Carriage By:</label>
                                            <span><?= $other_details->pre_carriage_by ?></span>
                                        </td>
                                        <td colspan="1" class="text-left">
                                            <label for="" style="min-width: 100px;">Place of Receipt:</label>
                                            <span><?= $other_details->place_of_receipt ?></span>
                                        </td>
                                        <td rowspan="2" colspan="2" class="text-left">
                                            <label for="" style="min-width: 100px;">Additional Information:</label><br>

                                            <div class="editable"><label for="">Shipping Bill Number: </label><span><?= $other_details->shipping_bill_no ?></span></div>
                                            <div class="editable"><label for="">Invoice Number: </label><span><?= $other_details->invoice_number ?></span></div>
                                            <div class="editable"><label for="">Invoice Date: </label><span><?= $other_details->invoice_date ?></span></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-left">

                                            <label for="" style="min-width: 100px;">Vessel / Aircraft:</label>
                                            <div><?= $other_details->vessel_aircraft ?></div>
                                        </td>
                                        <td colspan="1" class="text-left">
                                            <label for="" style="min-width: 100px;">Port of Loading:</label>
                                            <div><?= $other_details->port_of_l ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-left">
                                            <label for="">Port of Discharge:</label>
                                            <div><?= $other_details->port_of_d ?></div>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <label for="" style="min-width: 100px;">Place of Delivery:</label>
                                            <div><?= $other_details->place_of_delivery ?></div>
                                        </td>
                                        <td colspan="1" class="text-left">
                                            <label for="">Final Destination:</label>
                                            <div><?= $other_details->final_destination ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th>Marks and Numbers</th>
                                                        <th>Kind & Number Packages</th>
                                                        <th style="width: 50%;">Description of Goods</th>
                                                        <th>Net Weight (kg)</th>
                                                        <th>Groos Weight (kg)</th>
                                                        <th>Measurements (m<sup>3</sup>)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) {
                                                        foreach ($items as $key => $item) { ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $item->marks_and_numbers ?>
                                                                </td>
                                                                <td class="text-right"><?= $item->package_qty ?></td>
                                                                <td><?= $item->description ?></td>
                                                                <td class="text-right"><?= number_format($item->net_wt,2) ?></td>
                                                                <td class="text-right"><?= number_format($item->gross_wt,2) ?></td>
                                                                <td class="text-right"><?= number_format($item->measurment,2) ?></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-left"><label for="">Consignment Total</label></td>
                                                        <td class="text-right">
                                                            <span class="total-net_wt"><?= $documentData->total_net_wt ?></span>
                                                        </td>
                                                        <td class="text-right">
                                                            <span class="total-gross_wt"><?= $documentData->total_gross_wt ?></span>
                                                        </td>
                                                        <td class="text-right">
                                                            <span class="total-measurment"><?= $documentData->total_measurment ?></span>
                                                        </td>
                                                    </tr>

                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table id="itemstable2" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th>Container Number(s)</th>
                                                        <th>Seal Number(s)</th>
                                                        <th>Size / Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($container_list)) {
                                                        foreach ($container_list as $key2 => $container) { ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $container->container_no ?>
                                                                </td>
                                                                <td><?= $container->number_of_packages ?></td>
                                                                <td><?= $container->description ?></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>


                                            </table>

                                            <label for="">Total Number of Containers or other packages or units (in words)</label>
                                            <div class=""><?= $other_details->total_no_of_containers_words ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <label for="">Number of original Bills of Lading:</label>
                                                        <div><?= $other_details->no_of_original_bill_of_lading ?></div>
                                                    </td>
                                                    <td>
                                                        <label for="">IncoTerms:</label>
                                                        <div><?= $other_details->incoterms ?></div>
                                                    </td>
                                                    <td>
                                                        <label for="">Payable at:</label>
                                                        <div><?= $other_details->payable_at ?></div>
                                                    </td>
                                                    <td>
                                                        <label for="">Frieght Charges:</label>
                                                        <div><?= $other_details->freight_charges ?></div>
                                                    </td>
                                                    <td>
                                                        <label for="">Shipped on Board Date:</label>
                                                        <div><?= $other_details->shipped_on_board_date ?></div>
                                                    </td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Terms & Conditions:</label>
                                            <div class="editable-textarea" style="white-space: pre;"><?= $other_details->terms_and_conditions ?></div>
                                        </td>
                                        <td colspan="2" style="text-align: left;">
                                        For <?= $documentData->for_consignor_company ?>
                                        <br><br>
                                        <div>

                                            <img id="userPhotoPreview" src="<?= $documentData->signature ?>" style="height:50px;width: 150px; object-fit: contain;" />

                                            <br><label>Authorized Signatory & Designation.</label>
                                            <br> <?= $other_details->name_of_authorized_signatory ?>
                                            <br> <?= $other_details->designation ?>
                                        </div>
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
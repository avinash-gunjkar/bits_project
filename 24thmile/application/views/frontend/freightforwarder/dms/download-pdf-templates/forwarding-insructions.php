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
                                <h3 class="heading3-border">Forwarding Instruction</h3>
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
                                        <td colspan="2" class="text-left">
                                            <label for="">Shipper: </label>

                                            <div style="white-space: pre;"><?= $other_details->shipper ?></div>
                                        </td>
                                        <td>
                                            <label for="" style="min-width: 100px;">Buyer Reference:</label>
                                            <div class="row">
                                                <div class="col-lg-5"><label style="min-width: 100px;">Invoice Number:</label> <span><?= $other_details->invoice_number ?></span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5"><label style="min-width: 100px;">Invoice Date:</label> <span><?= printFormatedDate($other_details->invoice_date) ?></span></div>
                            
                                            </div>

                                        </td>
                                        <td rowspan="1">
                                            <label for="" style="min-width: 100px;">Export Declaration Number: </label>

                                            <div><?= $other_details->export_declration_no ?></div>

                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Consignee: </label>
                                            <div style="white-space: pre;"><?= $other_details->consignee ?></div>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <label for="">Carrier Name: </label>
                                            <div style="white-space: pre;"><?= $other_details->carrier ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <label for="">Notify Party (If other than Consignee): </label>
                                            <div style="white-space: pre;"><?= $other_details->notify_party ?></div>
                                        </td>
                                        <td>
                                            <label for="">Country of Origin</label>
                                            <div><?= $other_details->country_o ?></div>

                                        </td>
                                        <td>
                                            <label for="">Country of Final Destination</label>
                                            <div><?= $other_details->country_d ?></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-left">

                                            <label for="" style="min-width: 100px;">Method of Dispatch</label>
                                            <div><?= $other_details->method_of_dispatch ?></div>

                                        </td>
                                        <td colspan="1" class="text-left">

                                            <label for="" style="min-width: 100px;">Type of Shipment</label>
                                            <div><?= $other_details->type_of_shipment ?></div>

                                        </td>
                                        <td colspan="1" class="text-left">

                                            <label for="" style="min-width: 100px;">Vessel / Aircraft</label>
                                            <div><?= $other_details->vessel_aircraft ?></div>

                                        </td>
                                        <td colspan="1" class="text-left">
                                            <label for="" style="min-width: 100px;">Place of Receipt</label>
                                            <div><?= $other_details->place_of_receipt ?></div>

                                        </td>

                                    </tr>
                                    <tr>

                                        <td colspan="1" class="text-left">
                                            <label for="" style="min-width: 100px;">Port of Loading</label>
                                            <div><?= $other_details->port_of_l ?></div>

                                        </td>
                                        <td colspan="1" class="text-left">
                                            <label for="" style="min-width: 100px;">Date of Departure</label>
                                            <div><?= $other_details->date_of_departure ?></div>

                                        </td>
                                        <td colspan="1" class="text-left">
                                            <label for="">Port of Discharge</label>
                                            <div><?= $other_details->port_of_d ?></div>

                                        </td>
                                        <td colspan="1" class="text-left">
                                            <label for="">Final Destination</label>
                                            <div><?= $other_details->final_destination ?></div>

                                        </td>


                                    </tr>

                                    <tr>

                                        <td colspan="1" class="text-left">
                                            <label for="" style="min-width: 100px;">Freight Charges</label>
                                            <div><?= $other_details->freight_charges ?></div>

                                        </td>
                                        <td colspan="1" class="text-left">
                                            <label for="" style="min-width: 100px;">Document Instructions</label>
                                            <div><?= $other_details->document_instructions ?></div>

                                        </td>
                                        <td colspan="1" class="text-left">
                                            <label for="">Incoterms® 2020:</label>
                                            <div><?= $other_details->incoterms ?></div>

                                        </td>
                                        <td colspan="1" class="text-left">
                                            <label for="">Declared Value</label>
                                            <div><?= $other_details->declared_value ?></div>

                                        </td>


                                    </tr>


                                    <tr>
                                        <td colspan="4">
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th>Marks and Numbers</th>
                                                        <th>Kind & No. Packages</th>
                                                        <th style="width: 60%;">Description of Goods</th>
                                                        <th>Gross Weight (kg) per Package</th>
                                                        <th>Measurements (m<sup>3</sup>) per Package</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) {
                                                        foreach ($items as $key => $item) { ?>
                                                            <tr>
                                                                <td>

                                                                    <?= $item->marks_and_numbers ?>
                                                                </td>
                                                                <td><?= $item->package_qty ?></td>
                                                                <td><?= $item->description ?></td>
                                                                <td class="text-right"><?= number_format($item->gross_wt,2) ?></td>
                                                                <td class="text-right">
                                                                    <?= number_format($item->measurment,2) ?>

                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-left"><label for="">Consignment Total</label></td>

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
                                        <td colspan="2">
                                            Does this shipment contain HAZARDOUS /DANGEROUS goods? If you answered YES, please also enclose your dangerous goods paperwork.
                                            <label><?= $other_details->is_hazardours_goods ?></label>

                                        </td>

                                        <td colspan="2">
                                            Is this shipment on Letter of Credit? If you answered YES, please also enclose your Letter of Credit paperwork.
                                            <label><?= $other_details->is_shipment_on_letter_of_credit ?></label>


                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table id="itemstable2" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <th>Container No(s)</th>
                                                        <th>Seal No(s)</th>
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
                                                                <td>
                                                                    <?= $container->description ?>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>


                                            </table>

                                            <label for="">Total No of Containers or other packages or units (in words)</label>
                                            <div><?= $other_details->total_no_of_containers_words ?></div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="text-left">
                                        </td>
                                        <td colspan="2" class="text-left" style="padding-left:80px;">
                                            <div> For <?= $documentData->for_consignor_company ?></div>

                                            <div>
                                                <img id="userPhotoPreview" src="<?= $documentData->signature ?>" style="height:50px;width: 150px; object-fit: contain;" />

                                            </div>
                                            <div>
                                                <label for="">Place: </label> <span><?= $documentData->issue_place ?></span>
                                            </div>
                                            <div>
                                                <label for="">Date: </label> <span><?= printFormatedDate($documentData->issue_date) ?></span>
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
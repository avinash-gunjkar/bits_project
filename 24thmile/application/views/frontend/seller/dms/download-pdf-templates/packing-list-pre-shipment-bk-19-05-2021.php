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
            margin: 0;
            /* margin-left: 2cm;
            margin-right: 2cm;*/
            margin-top:50px;
            margin-bottom: 130px;
            /* page-break-after: always; */

        }




        * {
            border-collapse: collapse;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            /* margin-top: 7cm; */
            /* margin-left: 2cm;
            margin-right: 2cm; */
            /* margin-bottom: 8cm;  */
            padding-top: 380px;
            margin-bottom: 0px;
            /* padding-bottom: 10px; */
            padding-left: 70px;
            padding-right: 70px;
            /* border:1px solid red; */
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0cm;
            height: 200px;

            padding-left: 70px;
            padding-right: 70px;
           
            /* Extra personal styles */
            /*background-color: #03a9f4;*/
            /* color: white;
            text-align: left;
            line-height: 1.5cm; */
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            /* height: 70px; */
            padding-left: 70px;
            padding-right: 70px;
            /* page-break-before: always; */
            /* Extra personal styles */
            /* background-color: #03a9f4; */
            /* color: white; */
            /* text-align: center;
            line-height: 0.15cm; */

        }


        /* table tr {
            page-break-inside: auto;
        } */

        /* table tr td {
            page-break-inside: auto;
        } */

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

        .table tr td {
            vertical-align: top;
            padding: 5px;
        }

        .table table {
            border-collapse: collapse;
            width: 100%
        }

        .table table th,
        .table table td {
            padding: 6px 5px;
        }

        .table table th{
            text-align: center;
            background-color: white;
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
            margin: 0px;
        }


        h1 {
            font-weight: bold;
        }

        label {
            font-weight: bold;
        }

        table.table.no-border td,
        table.table.no-border {
            border: none;
        }

        .fix-width-60 {
            width: 5%;
        }

        .fix-width-80 {
            width: 7%;
        }

        .fix-width-600 {
            width: 45%;
        }

        ol {
            padding-left: 10px;
            margin: 0;
        }

        .hide-extra-content {
            max-height: 50px;
            min-height: 50px;
            overflow: hidden;
        }
        
        .package-tr:first-child{
            display: none;
        }
        .package-tr{
            line-height: 1px;
        }
       
    </style>
</head>

<body>
    <?php
    $other_details = $documentData->other_details;
    $items = $documentData->items;
    ?>
    <header>
        <center>
            <h3 class="heading3-border">Packing List</h3>
        </center>
        <table class="table table-bordered" >
            <tbody >
                <tr>
                    <td rowspan="3" colspan="2">
                        <label>Exporter</label>
                        <div class="hide-extra-content"><?= $other_details->exporter?$other_details->exporter:'<br>' ?></div>
                    </td>
                    <td>
                        <div><label>Invoice Number:</label> <span><?= $other_details->invoice_number ?></span>
                        </div>
                        <div>
                            <label>Date</label> <span><?= printFormatedDate($other_details->invoice_date) ?></span>
                        </div>
                    </td>
                    <td>
                        <!-- <label>Exporter's Ref</label> -->
                        <div>
                            <label>Import Export Code:</label> <span><?= $other_details->iec_no ?></span>

                        </div>
                        <div><label>Authorized Dealer Code:</label> <div><?= formated_ad_code($other_details->ad_code) ?></div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <!-- <td>
                                                <label>Reference</label>
                                                <div><label>SO# Number</label> <span><?= $other_details->so_no ?></span>
                                                </div>
                                                <div><label>SO# Date</label> <span><?= $other_details->so_date ?></span>
                                                </div>

                                            </td> -->
                    <td colspan="2">
                        <label>Buyer Reference</label>
                        <div>
                            <label>Purchase Order Number and Date (if any):</label>
                            <span><?= $other_details->po_number ?></span> <span><?= $other_details->po_date ?></span>
                        </div>
                        <br>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>Other Reference/Notify Party (if any)</label>
                        <div class="hide-extra-content"><?= $other_details->notify_party ? $other_details->notify_party : '<br>' ?></div>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>Consignee</label>

                        <div class="hide-extra-content"><?= $other_details->consignee?$other_details->consignee:'<br>' ?></div>

                    </td>
                    <td colspan="2">
                        <label>Buyer (if other than Consignee)</label>

                        <div class="hide-extra-content"><?= $other_details->buyer?$other_details->buyer:'<br>' ?></div>

                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Pre-Carriage by</label>
                        <div><?= $other_details->pre_carriage_by ?></div>
                    </td>
                    <td>
                        <label>Place of Receipt</label>
                        <div><?= $other_details->place_of_receipt ?>
                        </div>
                    </td>
                    <td>
                        <label>Country of Origin</label>
                        <div>
                            <?= $other_details->country_of_origin ?>
                        </div>
                    </td>
                    <td>
                        <label>Country of Final Destination</label>
                        <div>
                            <?= $other_details->country_of_final_destination ?>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>
                        <label>Vessel / Aircraft/ Voyage Number</label>
                        <div>
                            <?= $other_details->vessel_aircraft_voyage_no ?>
                        </div>
                    </td>
                    <td>
                        <label>Port of Loading</label>
                        <div>
                            <?= $other_details->port_of_l ?>
                        </div>
                    </td>

                    <td rowspan="2" colspan="2" ><label>Delivery Term & Method of Payment</label>
                        <div class="hide-extra-content">
                            <?= $other_details->terms_method_of_payment ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td >
                        <label>Port of Discharge</label>
                        <div>
                            <?= $other_details->port_of_d ?>
                        </div>
                    </td>
                    <td >
                        <label>Final Destination</label>
                        <div>
                            <?= $other_details->final_destination ?>
                        </div>
                    </td>
                </tr>
                



            </tbody>
        </table>
    </header>
    <footer>
        <table class="table table-bordered" style="margin: 0;">
            <tbody>

                <!-- <tr >
                    <td colspan="4">
                        <p>Export Shipment under LUT No: <?= $other_details->lut_no ?>; LUT Valid till <?= $other_details->export_under_lut_no_valid_date ?> GST No.: <?= $other_details->gst_no ?></p>

                        <p>Shipping Marks</p>
                        <p>From: <?= $other_details->shipping_marks_from ?></p>
                        <p>To: <?= $other_details->shipping_marks_to ?></p>
                        <p>Package No. <?= $other_details->shipping_marks_package_no ?></p>
                        <p>Weight: <?= $other_details->shipping_marks_weight ?></p>
                    </td>

                </tr> -->


                <tr>
                    <td colspan="3" style="vertical-align: bottom;">
                        <div><?= $other_details->declaration ?></div>

                    </td>
                    <td colspan="1" style="text-align: left;">
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
    </footer>

    <div style="position: absolute;bottom:0;border: 1px solid #cccccc;padding:5px;">
        <p>Export Shipment under LUT No: <?= $other_details->lut_no ?>; LUT Valid till <?= $other_details->export_under_lut_no_valid_date ?> GST No.: <?= $other_details->gst_no ?></p>
        <p>Shipping Marks</p>
        <p>From: <?= $other_details->shipping_marks_from ?></p>
        <p>To: <?= $other_details->shipping_marks_to ?></p>
        <p>Package No. <?= $other_details->shipping_marks_package_no ?></p>
        <p>Weight: <?= $other_details->shipping_marks_weight ?></p>
    </div>

    <?php $totalContainer = count((array)$items);
    if (!empty($items)) { ?>
        <?php $containerCounter = 0;
        $consignment_total = new stdClass();
        $consignment_total->net_wt = 0;
        $consignment_total->gross_wt = 0;
        $consignment_total->qty = 0;
        foreach ($items as $container_uid => $container) {
            $totalNetWt = 0;
            $totalGrossWt = 0;
            $totalqty = 0;
            $containerCounter = $containerCounter + 1; ?>
            <div style="border: 1px solid #cccccc;height:97.5%;max-height:97.5%;">
                <table id="itemstable" class="table items-table table-bordered" style="table-layout: fixed;margin:0;">
                    <thead>
                        <tr>
                            <th class="fix-width-60">Sr.No.</th>
                            <th class="fix-width-600">Description of Goods</th>
                            <th class="fix-width-60">Quantity</th>
                            <th class="fix-width-80">Unit of Measure</th>
                            <!-- <th>Package Quantity</th> -->
                            <th>Net Weight (Kg)</th>
                            <th>Gross Weight (Kg)</th>
                            <th>Dimension (LxWxH) Centimeter</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7">
                                Container : <?= $container->container_number ?>
                            </td>
                        </tr>
                        <?php if (!empty($container->packages)) { ?>

                            <?php $packageCounter = 0;
                            foreach ($container->packages as $package_uid => $package) {
                                $totalNetWt += $package->net_wt;
                                $totalGrossWt += $package->gross_wt;
                            ?>

                            <tr class="package-tr">
                                <td colspan="7" style="padding: 1px;"></td>
                            </tr>

                                <tr >
                                    <td><?= $packageCounter = $packageCounter + 1; ?></td>
                                    <td><span>Package:</span> <span style="margin-right:25px"> <?= $package->package_number ?> </span> <span>Packing Type:</span>
                                    <?= $package->packing_type ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <!-- <td></td> -->
                                    <td class="text-right"><?= number_format($package->net_wt, 2) ?></td>
                                    <td class="text-right"><?= number_format($package->gross_wt, 2) ?></td>
                                    <td><?= $package->dimension ?></td>
                                </tr>
                                <tr>

                                    <td colspan="4" style="padding: 0; border-collapse: collapse;">
                                        <table id="product_<?= $key ?>" class="product-table table" style="margin:0;table-layout: fixed;" data-rowid="<?= $key ?>">
                                            <tbody>
                                                <?php if (!empty($package->products)) { ?>
                                                    <?php $productCounter=0; foreach ($package->products as $product_uid => $product) {
                                                        $totalqty += $product->qty; ?>
                                                        <tr>
                                                            <td class="fix-width-60" style="padding-left: 12px;"></td>
                                                            <td class="fix-width-600"><?= $product->description ?></td>
                                                            <td class="fix-width-60 text-right"><?= number_format($product->qty, 2) ?></td>
                                                            <td class="fix-width-80">
                                                                <?php foreach (getPackingUnitList() as $unitCode => $unitValue) {
                                                                    echo  $unitCode == $product->unit ? $unitValue : '';
                                                                } ?>
                                                            </td>
                                                        </tr>

                                                    <?php } ?>

                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </td>

                                    <!-- <td class="text-right"></td> -->
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td></td>

                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>

                    <tfoot>
                        <?php
                        $consignment_total->net_wt = $consignment_total->net_wt + $totalNetWt;
                        $consignment_total->gross_wt = $consignment_total->gross_wt + $totalGrossWt;
                        $consignment_total->qty = $consignment_total->qty + $totalqty;

                        ?>
                        <tr>

                            <td class="fix-width-60">&nbsp;</td>
                            <td class="fix-width-600">Container Total</td>

                            <td class="text-right fix-width-60"><span class="total-qty"></span></td>
                            <td class="text-right fix-width-80"></td>
                            <!-- <td class="text-right"><span class="total-package_qty"><?= $documentData->total_package_qty ?></span></td> -->
                            <td class="text-right"><span class="total-net_wt_per_pk"><?= number_format($totalNetWt, 2) ?></span></td>
                            <td class="text-right"><span class="total-gross_wt_per_pk"><?= number_format($totalGrossWt, 2) ?></span></td>
                            <td class="text-right"> </td>
                        </tr>
                        <?php if ($containerCounter == $totalContainer) { ?>
                        <tr>
                            <td class="fix-width-60">&nbsp;</td>
                            <td class="fix-width-600">Consignment Total</td>
                            <td class="text-right fix-width-60"></td>
                            <td class="text-right fix-width-80"></td>
                            <td class="text-right"><?= number_format($consignment_total->net_wt, 2) ?></td>
                            <td class="text-right"><?= number_format($consignment_total->gross_wt, 2) ?></td>
                            <td class="text-right"></td>
                        </tr>
                        <?php } ?>

                    </tfoot>

                </table>

            </div>
            <?php if ($containerCounter < $totalContainer) { ?>
                <div style="page-break-before: always;"></div>
            <?php } ?>
        <?php } ?>

    <?php } ?>

</body>

</html>
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

            margin-left: 50px;
            margin-right: 50px;
            margin-top: 50px;
            margin-bottom: 50px;

            /* page-break-after: always; */

        }

        @page :first{
            /* margin-bottom: 4cm; */
            padding-bottom: 104px;
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
            /* padding-top: 380px; */
            /* margin-bottom: 0px; */
            /* padding-bottom: 10px; */
            /* padding-left: 70px;
            padding-right: 70px; */
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
            bottom: 0px;
            left: 0;
            right: 0;
            height: 104px;
            max-height: 104px;
            padding:1px;
            /* padding-left: 70px;
            padding-right: 70px; */
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
            font-size: 10px;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            padding-bottom: 104px;
        }

        /* body:first-child{
            padding-bottom: 200px;
        } */

        /*.main { width:90%; margin:50px;}*/
        .table {
            width: 100%;
            /* margin-top: 10px;
            margin-bottom: 10px; */
            /* border-collapse: collapse; */
            border-collapse: separate;
            border-spacing: -1.1px;
            table-layout: fixed;

        }

        .table tr td {
            vertical-align: top;
            /* padding: 5px; */
        }

        .table table {
            border-collapse: collapse;
            width: 100%
        }

        .table table th,
        .table table td {
            padding: 1px;
        }

        .table table th {
            text-align: center;
            background-color: white;
        }

        .table table tr.border {
            border-bottom: solid 1px   #abb2b9  ;
        }

        .table-bordered tr td {
            border: solid 1px   #abb2b9  ;
        }

        .table table td h1 {
            margin: 10px 0px;
            font-weight: 300;
        }



        .text-center {
            text-align: center!important;
        }

        .text-right {
            text-align: right!important;
        }

        .text-left {
            text-align: left!important;
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

        .package-tr td{
            padding-top: 15px;
        }

        table thead.table-header tr td {
            font-weight: normal;
            text-align: left;
            border: 1px solid   #abb2b9  ;
        }

        table thead.table-header tr td.heading {
            border-top: 3px solid #fff;
            border-left: 3px solid #fff;
            border-right: 3px solid #fff;
        }

        label {
            font-size: 10px;
            font-weight: normal;
        }

        .capitalize {
            text-transform: uppercase;
            font-weight: normal;
        }
        b {
            font-weight: normal;
        }

    </style>
</head>

<body style="border:1px solid   #abb2b9  ;border-bottom:solid 2px white;">
    <?php
    $other_details = $documentData->other_details;
    $items = $documentData->items;
    ?>




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
                    <td colspan="8" style="vertical-align: bottom;">
                        <div><?= $other_details->declaration ?></div>

                    </td>
                    <td colspan="4" style="text-align: left;">
                        For <b><?= $documentData->for_consignor_company ?></b>
                        <br><br>
                        <div>

                            <img id="userPhotoPreview" src="<?= $documentData->signature ?>" style="height:50px;width: 150px; object-fit: contain;" />

                            <!-- <br><label>Authorized Signatory & Designation.</label> -->
                            <br> <b><?= $other_details->name_of_authorized_signatory ?></b>
                            <br> <b><?= $other_details->designation ?></b>
                        </div>
                    </td>
                </tr>


            </tbody>
        </table>
    </footer>

    <div style="position: absolute;  bottom:0;border-top:0;padding:5px;">
        <p>Shipping Bill Number: <span><b><?= $other_details->shipping_bill_no ?></b>; Date: <b><?= $other_details->shipping_bill_date ?></b></span></p>
        <p>Bill of Lading / Airway Bill Number: <span><b><?= $other_details->bol_awb_no ?></b>; Date: <b><?= $other_details->bol_awb_dated ?></b></span></p>
        <p>Shipping Marks</p>
        <p>From: <b><?= $other_details->shipping_marks_from ?></b></p>
        <p>To: <b><?= $other_details->shipping_marks_to ?></b></p>
        <p>Package No. <b><?= $other_details->shipping_marks_package_no ?></b></p>
        <p>Weight: <b><?= $other_details->shipping_marks_weight ?></b></p>
    </div>


    <table class="table table-bordered " style="table-layout: fixed;">
        <thead class="table-header">
            <tr>
                <td colspan="12" class="heading">
                    <h3 class="heading3-border text-center ">PACKING LIST</h3>
                </td>
            </tr>
            <tr>
                <td rowspan="3" colspan="6">
                    <label>Exporter</label>
                    <div><?= $other_details->exporter ? $other_details->exporter : '<br><br>' ?> </div>
                </td>

                <td colspan="3">
                    <div><label>Invoice Number & Date</label></div>
                    <div><b><span><?= $other_details->invoice_number ?></span>; <span><?= printFormatedDate($other_details->invoice_date) ?></span> </b></div>
                </td>
                <td colspan="3">
                    <div>
                        <label>Import Export Code:</label> <span><b><?= $other_details->iec_no ?></b></span>

                    </div>
                    <div>
                        <label>Authorized Dealer Code:</label>
                        <div><b><?= formated_ad_code($other_details->ad_code) ?></b></div>
                    </div>
                </td>
            </tr>
            <tr>

                <td colspan="6">
                    <label>Buyer Reference</label>
                    <div>
                        <label>Purchase Order Number and Date (if any):</label>
                        <span><b><?= $other_details->po_number ?>; <?= $other_details->po_date ?></b></span>
                    </div>
                    <br>

                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label>Other Reference/Notify Party (if any)</label>
                    <p><?= $other_details->notify_party ? $other_details->notify_party : '<br><br>' ?></p>

                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label>Consignee</label>

                    <div class="hide-extra-content"><?= $other_details->consignee ? $other_details->consignee : '<br><br>' ?></div>

                </td>
                <td colspan="6">
                    <label>Buyer (if other than Consignee)</label>

                    <div class="hide-extra-content"><?= $other_details->buyer ? $other_details->buyer : '<br><br>' ?></div>

                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label>Pre-Carriage by</label>
                    <div class="capitalize"><?= $other_details->pre_carriage_by ?></div>
                </td>
                <td colspan="3">
                    <label>Place of Receipt</label>
                    <div class="capitalize"><?= $other_details->place_of_receipt ?>
                    </div>
                </td>

                <td colspan="3">
                    <label>Country of Origin</label>
                    <div class="capitalize" style="text-align:center;">
                        <?= $other_details->country_of_origin ?>
                    </div>
                </td>
                <td colspan="3">
                    <label>Country of Final Destination</label>
                    <div class="capitalize" style="text-align:center;">
                        <?= $other_details->country_of_final_destination ?>
                    </div>
                </td>

            </tr>
            <tr>
                <td colspan="3">
                    <label>Vessel / Aircraft/ Voyage Number</label>
                    <div class="capitalize">
                        <?= $other_details->vessel_aircraft_voyage_no ?>
                    </div>
                </td>
                <td colspan="3">
                    <label>Port of Loading</label>
                    <div class="capitalize">
                        <?= $other_details->port_of_l ?>
                    </div>
                </td>

                <td rowspan="2" colspan="6">
                    <div>
                        <?= $other_details->terms_method_of_payment ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label>Port of Discharge</label>
                    <div class="capitalize">
                        <?= $other_details->port_of_d ?>
                    </div>
                </td>
                <td colspan="3">
                    <label>Final Destination</label>
                    <div class="capitalize">
                        <?= $other_details->final_destination ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center" style="vertical-align: middle;width:5%">Sr.No.</td>
                <td colspan="6" style="vertical-align: middle;" class="text-center">Description of Goods</td>
                <td class="text-center" style="vertical-align: middle;width:6%">Quantity</td>
                <td class="text-center" style="vertical-align: middle;">Unit Type</td>

                <td class="text-center" style="vertical-align: middle;">Net <br>Weight (Kg)</td>
                <td class="text-center" style="vertical-align: middle;">Gross <br>Weight (Kg)</td>
                <td class="text-center" style="vertical-align: middle;width:13%">Dimension (LxWxH) Centimeter</td>
            </tr>

        </thead>

        <tbody>

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

                    <tr>
                        <td colspan="12" style="padding-top:10px;">
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
                                <td style="text-align: right;"></td>
                                <td colspan="8"><span>Package:</span> <span style="margin-right:25px;font-weight:normal;"> <?= $package->package_number ?> </span> <span>Packing Type:</span>
                                    <b><?= $package->packing_type ?></b>
                                </td>
                                <!-- <td></td>
                                <td></td> -->
                                <!-- <td></td> -->
                                <td class="text-right"><?= number_format($package->net_wt, 0) ?></td>
                                <td class="text-right"><?= number_format($package->gross_wt, 0) ?></td>
                                <td style="text-align: center;"><?= str_replace(" ","",$package->dimension) ?></td>
                            </tr>

                            <?php if (!empty($package->products)) { ?>
                                <?php $productCounter = 0;
                                foreach ($package->products as $product_uid => $product) {
                                    $totalqty += $product->qty; ?>
                                    <tr>
                                        <td style="padding-left: 12px;text-align:right;"><?=$productCounter=$productCounter+1;?></td>
                                        <td colspan="6"><?= $product->description ?></td>
                                        <td class="text-right"><?= number_format($product->qty, 2) ?></td>
                                        <td>
                                            <?php foreach (getPackingUnitList() as $unitCode => $unitValue) {
                                                echo  $unitCode == $product->unit ? $unitValue : '';
                                            } ?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                <?php } ?>

                            <?php } ?>
                        <?php } ?>
                    <?php } ?>


        <tfoot>
            <?php
                    $consignment_total->net_wt = $consignment_total->net_wt + $totalNetWt;
                    $consignment_total->gross_wt = $consignment_total->gross_wt + $totalGrossWt;
                    $consignment_total->qty = $consignment_total->qty + $totalqty;

            ?>
            <tr>

                <td>&nbsp;</td>
                <td colspan="6">Container Total</td>

                <td><span class="total-qty"></span></td>
                <td></td>
                <!-- <td class="text-right"><span class="total-package_qty"><?= $documentData->total_package_qty ?></span></td> -->
                <td class="text-right"><span class="total-net_wt_per_pk"><b><?= number_format($totalNetWt, 0) ?></b></span></td>
                <td class="text-right"><span class="total-gross_wt_per_pk"><b><?= number_format($totalGrossWt, 0) ?></b></span></td>
                <td> </td>
            </tr>
            <?php if ($containerCounter == $totalContainer) { ?>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="6">Consignment Total</td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><b><?= number_format($consignment_total->net_wt, 0) ?></b></td>
                    <td class="text-right"><b><?= number_format($consignment_total->gross_wt, 0) ?></b></td>
                    <td class="text-right"></td>
                </tr>
            <?php } ?>

        </tfoot>
    <?php } ?>

<?php } ?>

</tbody>

    </table>



</body>

</html>
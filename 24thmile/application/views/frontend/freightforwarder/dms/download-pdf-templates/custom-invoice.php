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
            padding-bottom: 100px;
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

        /* body:first-of-type{
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
            border-bottom: solid 1px  #abb2b9 ;
        }

        .table-bordered tr td {
            border: solid 1px  #abb2b9 ;
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
            font-weight: normal;
        }

        table.table.no-border td,
        table.table.no-border {
            border: none;
        }

        


        .package-tr:first-child {
            display: none;
        }

        .package-tr {
            line-height: 1px;
        }

        table thead.table-header tr td {
            font-weight: normal;
            text-align: left;
            border: 1px solid  #abb2b9 ;
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

<body style="border:1px solid  #abb2b9 ;border-bottom:solid 2px white;">
    <!-- Tracking start -->


    <?php
    $other_details = $documentData->other_details;
    $items = $documentData->items;
    ?>

    <footer>
        <table class="table table-bordered">
            <tbody>
                
                <tr>
                    <td colspan="8" style="vertical-align: bottom;">
                        <div><?= $other_details->declaration ?></div>
                    </td>
                    <td colspan="4" style="text-align: left;">
                                        For <b><?= $documentData->for_consignor_company ?></b>
                                        <br><br>
                                        <div>

                                            <img id="userPhotoPreview" src="<?= $documentData->signature ?>" style="height:50px;width: 150px; object-fit: contain;" />

                                            <br> <b><?= $other_details->name_of_authorized_signatory ?></b>
                            <br> <b><?= $other_details->designation ?></b>
                                        </div>
                                    </td>
                </tr>


            </tbody>
        </table>
    </footer>
    <div style="position: absolute;  bottom:0;border-top:0;padding:5px;">
        <table class="table">
        <tbody>
        <tr>
                    <td colspan="3">
                    <p>Export Shipment under LUT Number: <b><?= $other_details->lut_no ?></b>; Valid till <b><?= $other_details->export_under_lut_no_valid_date ?> GST: <?= $other_details->gst_no ?></b></p>
                     <p>Shipping Marks</p>
                        <p>From: <b><?= $other_details->shipping_marks_from ?></b></p>
                        <p>To: <b><?= $other_details->shipping_marks_to ?></b></p>
                        <p>Package No. <b><?= $other_details->shipping_marks_package_no ?></b></p>
                        <p>Weight: <b><?= $other_details->shipping_marks_weight ?></b></p>
                    </td>
                    <td>
                        <label>Bank Details:</label>
                        <p><label>Bank Name:</label> <span><?= $other_details->bank_name ?></span></p>
                        <p><label>Account Number:</label> <span><?= $other_details->account_number ?></span></p>
                        <p><label>IFSC Code:</label> <span><?= $other_details->ifsc_code ?></span></p>
                        <p><label>SWIFT Code/IBAN:</label> <span><?= $other_details->swift_code ?></span></p>
                    </td>
                </tr>
        </tbody>
        </table>
    </div>
    
    <table class="table table-bordered " style="table-layout: fixed;">
    
            <thead class="table-header">
                <tr>
                    <td colspan="12" class="heading">
                        <h3 class="heading3-border text-center">CUSTOM INVOICE</h3>
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
                        <div><?= $other_details->notify_party ? $other_details->notify_party : '<br><br>' ?></div>

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
                        <td class="text-center" style="vertical-align: middle;width:55%" colspan="6">Description of Goods</td>
                        <td class="text-center" style="vertical-align: middle;width:10%">HS Code</td>
                        <td class="text-center" style="vertical-align: middle;">Quantity</td>
                        <td class="text-center" style="vertical-align: middle;">Unit Type</td>
                        <td class="text-center" style="vertical-align: middle;">Price/Unit</td>
                        <td class="text-center" style="vertical-align: middle;">Amount</td>
                    </tr>

            </thead>
            
            <tbody>

                <?php if (!empty($items)) { ?>
                        <?php $counter=0; foreach ($items as $key => $item) { ?>

                            <tr>
                                <td class="text-right"><?= $counter = $counter+1; ?></td>
                                <td colspan="6"><?= htmlspecialchars($item->description) ?></td>
                                <td style="text-align: center;"><?= $item->hs_code ?></td>
                                <td class="text-right"><?= number_format($item->qty, 0) ?></td>
                                <td>

                                    <?php foreach (getPackingUnitList() as $unitCode => $unitValue) {
                                        echo  $unitCode == $item->unit ? $unitValue : '';
                                    } ?>

                                </td>
                                <td class="text-right"><?= number_format($item->price, 2) ?></td>
                                <td class="text-right"><?= number_format(ceil($item->total_amount),0) ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>

            </tbody>

            <tfoot>

                    <tr>
                        <td colspan="3">Total Number of Packages: <span><b><?= $other_details->total_package_count ?></b></span></td>
                        <td colspan="6" class="text-right">Total Invoice</td>
                        <td colspan="2"  class="text-right">
                            <b><?= $documentData->currency ?></b>
                        </td>
                        <td class="text-right"><span class="final-total"><b><?= number_format(ceil($documentData->invoice_amount), 0) ?></b></span></td>
                    </tr>
                    <tr>
                        <td colspan="12"><label >Total Invoice Amount (In words):</label><span><b><?= $other_details->amount_in_words ?></b></span></td>
                    </tr>

                </tfoot>
    </table>


</body>

</html>
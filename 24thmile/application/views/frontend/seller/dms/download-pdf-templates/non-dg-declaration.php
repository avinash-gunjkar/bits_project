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
            margin-right: 2cm;
            margin-top:300px;*/
            margin-bottom: 250px;
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
            /* padding-bottom: 70px; */
            padding-left: 70px;
            padding-right: 70px;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0cm;
            /* height: 200px; */

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


        table tr {
            page-break-inside: auto;
        }

        table tr td {
            page-break-inside: auto;
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

        .table table tr.border {
            border-bottom: solid 1px #cccccc;
        }

        .table-bordered tr td,.table-bordered tr th {
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
        .hide-extra-content{
           max-height: 50px;
           min-height: 50px;
           overflow:hidden;
        }
        .hide-extra-content-2{
           max-height: 75px;
           min-height: 75px;
           overflow:hidden;
        }
    </style>
</head>

<body>

    <?php
    $other_details = $documentData->other_details;
    $consignor = (object) $other_details->consignor;
    $items = $documentData->items;
    ?>

    <header>
        <center>
            <h3 class="heading3-border">Non-DG Declaration</h3>
        </center>
        <table class="table table-bordered" style="table-layout: fixed;">
            <colgroup>
                <col width="50%">
                <col width="50%">

            </colgroup>
            <tbody>
                <tr>
                    <td><label >Exporter</label>
                        <div class="hide-extra-content">
                            <?= $other_details->exporter ?>
                        </div>
                    </td>
                    <td>
                        <div><label >Bill of Lading/ Air waybill No.</label>
                            <?= $other_details->bol_awb_no ?>
                        </div>
                        <div><label >Invoice No.</label>
                            <span><?= $other_details->invoice_number ?></span>
                        </div>
                        <div><label >Export Date</label>
                            <span>
                                <?= printFormatedDate($other_details->invoice_date) ?>
                            </span>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td><label >Consignee</label>
                        <div class="hide-extra-content">
                            <?= $other_details->consignee ?>
                        </div>
                    </td>
                    <td rowspan="2">
                        <div class="hide-extra-content-2">
                            <?= $other_details->text1 ?>

                        </div>

                    </td>
                </tr>

                <tr>
                    <td><label >Transport Details</label>
                        <div class="hide-extra-content-2">
                            <?= $other_details->transport_details ?>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>

                        <div>
                            <label >Airport of Destination:</label> <?= $other_details->airport_of_destination ?>
                        </div><br>


                        <div>
                            <label >Port of Discharge</label> <?= $other_details->port_of_d ?>
                        </div>
                    </td>
                    <td>

                        <div>
                            <label >Airport of Depatrue:</label> <?= $other_details->airport_of_departure ?>
                        </div><br>

                        <div>
                            <label >Port of Loading</label> <?= $other_details->port_of_l ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="hide-extra-content">
                            <?= $other_details->text3 ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </header>

    <footer>
        <table class="table table-bordered" style="table-layout: fixed;">
            <colgroup>
                <col width="50%">
                <col width="50%">

            </colgroup>
            <tbody>
                <tr>
                    <td colspan="2">
                        <center><b>24 hr. Emergency Contact No. +91 77090 65277</b></center>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;"><label >Declaration:</label>
                        <div>
                            <?= $other_details->declaration ?>
                        </div>
                    </td>
                    <td colspan="1" style="text-align: left;">

                        <div style="padding-left:100px;margin-top:25px;">
                            For <?= $documentData->for_consignor_company ?>
                            <br><br>
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
  



    <div style="border: 1px solid #cccccc;height:97.5%;max-height:97.5%; ">
    <table id="itemstable" class="table items-table table-bordered" style="table-layout: fixed;margin:0;page-break-inside: auto;">
            <thead>
                <tr>
                    <th>Kind & No of Packages</th>
                    <th style="width: 50%;">Product name</th>
                    <th>HS Code</th>
                    <th>Gross Weight (Kg)</th>
                    <th>Net Weight (kg)</th>
                    <th>Invoice Number</th>
                    <th>Date of Invoice</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($items)) { ?>
                    <?php foreach ($items as $key => $tem) { ?>
                        <tr>
                            <td>
                                <?= $tem->kind_of_packages ?>
                            </td>
                            <td> <?= $tem->product_name ?> </td>
                            <td> <?= $tem->hs_code ?> </td>
                            <td style="text-align: right;"> <?= number_format($tem->gross_wt, 2) ?> </td>
                            <td style="text-align: right;"> <?= number_format($tem->net_wt, 2) ?> </td>
                            <td> <?= $tem->invoice_no ?> </td>
                            <td> <?= $tem->invoice_date ?> </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>

            <tfoot>
                <tr>
                    <td class="text-right"></td>
                    <td>Declaration Total</td>
                    <td class="text-right"></td>
                    <td class="text-right"> <?= $documentData->total_gross_wt ?> </td>
                    <td class="text-right"> <?= $documentData->total_net_wt ?> </td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                </tr>
            </tfoot>
        </table>
        <br>
        <label >Additional Handling Information:</label>
        <br>
        <?= $other_details->handeling_info ?>
    </div>
</body>
</html>
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
            margin-bottom: 2cm;
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
            font-size: 10px;
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

        .table tr th,
        .table tr td {
            padding: 5px;
            vertical-align: top;
        }

        .table table tr.border {
            border-bottom: solid 1px #cccccc;
        }

        .table-bordered tr td,
        .table-bordered tr th {
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

     

        ol li {
            margin-bottom: 15px;
        }
        table.table.no-border td,table.table.no-border{
        border: none;
    }
    </style>
</head>

<body>
    <?php
    $other_details = $documentData->other_details;
    $consignor = (object) $other_details->consignor;
    $items = $documentData->items;
    ?>
    <!-- <footer>
        <div class="text-center" style="background-color: #fff; color:#000;padding-bottom: 5px;">
            <small><?= $consignor->company_name ?> <?= $consignor->address_line_1 ?> <?= $consignor->address_line_2 ?> <?= $consignor->city_name ?> Pincode: <?= $consignor->pincode ?> <br> Contact Person: <?= $consignor->contact_name ?> Email: <?= $consignor->contact_email ?> Phone: <?= $consignor->contact_phone ?> </small>
        </div>
    </footer> -->
   

                            <center>
                                <h3 class="heading3-border">DETAILS OF SELF SEALED CONTAINER DECLARATION</h3>
                            </center>




                            <table class="table">
                                <colgroup>
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="20%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <div class="editable">
                                                <div class="pull-left">
                                                    <label for="">Invoice No.</label>
                                                    <span><?= $other_details->invoice_number ?></span>

                                                </div>

                                            </div>
                                        </td>
                                        
                                        <td colspan="2">
                                        <div style="text-align: right;">
                                                    <label for="date">Date:</label>
                                                    <span><?= printFormatedDate($other_details->invoice_date) ?></span>

                                                </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <p>Declaration under Foreign Exchange Management Act1999:</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <ol type="1">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            Name of Exporter:
                                                            <span> <?= $other_details->exporter_company_name ?></span>
                                                        </div>

                                                    </div>
                                                </li>
                                                <li>
                                                    <ol type="a">
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    IEC Number:
                                                                    <span><?= $other_details->iec_no ?></span>
                                                                </div>

                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    Branch Code:
                                                                    <span><?= $other_details->branch_code ?></span>

                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    GSTIN:
                                                                    <span><?= $other_details->gst_no ?></span>

                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            Name & Address of Manufacturer:
                                                            <span><?= $other_details->name_address_manufacturer ?></span>

                                                        </div>
                                                    </div>


                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            The 40 feet container is received & Loaded at M/s:
                                                            <span><?= $other_details->container_received_loaded_at ?></span>

                                                        </div>
                                                    </div>

                                                </li>
                                                <li>
                                                    <div>
                                                        Certified that the Description, Quantity, Value, Net Weight and technical characteristics of the Export Product of the Goods are covered by this invoice and Particulars which are amplified in packing list have been checked by us and the goods are stuffed in the Container.
                                                    </div>

                                                    <table id="itemstable" class="table table-bordered items-table" style="margin-top: 15px;">
                                                        <thead>
                                                            <th>Container Number</th>
                                                            <th>SIZE</th>
                                                            <th>Vehicle No.</th>
                                                            <th>Shipping Line Seal No.</th>
                                                            <th>RFID Seal No.</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($items as $key => $item) { ?>
                                                                <tr>
                                                                    <td><?= $item->container_number ?></td>
                                                                    <td><?= $item->container_size ?></td>
                                                                    <td><?= $item->vehicle_no ?></td>
                                                                    <td><?= $item->shipping_line_seal_no ?></td>
                                                                    <td><?= $item->rfid_seal_no ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </li>
                                                <li>
                                                    This Container is stuffed as per File No. VIII/Cus/Tech./SSP/48-105/18-19 issued one time by the Commissioner of Customs GST Bhavan, 41/A, Sassoon Road, Pune-411001.
                                                </li>
                                            </ol>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td colspan="4"></td>
                                        <td >
                                            <div style="padding-left:150px;text-align: left;">
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



</body>

</html>

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

        table.table.no-border td,
        table.table.no-border {
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
                                <h2>APPENDIX I</h2>
                                <h3 class="heading3-border">SDF Form</h3>
                            </center>
                            <?= $this->session->flashdata('message') ?>

                            <table class="table no-border">
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">
                                </colgroup>
                                <tbody>

                                    <tr>
                                        <td><label for="">Shipping Bill no. : </label>____________________________</td>
                                        <td><label for="">Date : </label>____________________________</td>

                                        <!-- <td colspan="2">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <span> <?= $other_details->shipping_bill_no ?> </span>
                                                </div>
                                                <div><label for="">Date : </label>
                                                    <span><?= printFormatedDate(date('Y-m-d')) ?></span>
                                                </div>
                                            </div>
                                        </td> -->
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for=""> Declaration under Foreign Exchange Management Act1999: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for=""> 1. I/We hereby declare that I/We am/are the *SELLER/CONSIGNOR of the goods in respect of which this declaration is made and that the particulars given in the Shipping Bill No: ___________ dated ____________ are true and that,
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for="">A)* The value as contracted with the buyer is same as the full export value in the above shipping bills.
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p> </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for="">B)* The full export value of the goods are not ascertainable at the time of export and that the value declared is that which I/We, having regard to the prevailing market conditions, accept to receive on the sale of goods in the overseas market.
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p> </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for=""> 2. I/We undertake that I/We will deliver to the bank named herein THE HONGKONG AND SHANGHAI BANKING BANKING CORPORATION, INSTITUTIONAL PLOT NO. 68, SECTOR -44, GURGAON 122002 the foreign exchange representing the full export value of the goods on or before @ ___________________ in the manner prescribed in Rule 9 of the Foreign Exchange Management Act.1999
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p> </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for="">3. I/We further declares that I/We am/are resident in India and I/We have place of Business in India.
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p> </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for=""> 4. I./We am/are Or am/are not in Caution list of the Reserve Bank of India.
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td> </td>
                                        <td colspan="1" style="text-align: left;">
                                            
                                            <div style="padding-left:200px;margin-top:25px;">
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
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
            margin-top: 4cm;
            margin-left: 3cm;
            margin-right: 2cm;
            margin-bottom: 4cm;
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
        span.uppercase{

            text-transform: uppercase;
        }


        /**{ margin:0px; padding:0px; box-sizing:border-box;}*/
        body {
            font-size: 14px;
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
                        Date :- <span><b><?= $other_details->second_bill_date?></b></span>
                            <p style="padding: 20px 0px;">
                            Drawn under Letter of Credite Number :- <span><?= $other_details->second_credite_number ?></span>
                            .Dated <span><?= $other_details->second_credit_date ?></span>
                            </p>

                            <label>ISSUING BANK</label>
                            <div style="padding: 5px 0px;">
                            <?= $other_details->second_bill_exc_bank_name ?>
                            <div><?= $other_details->second_bill_exc_address1 ?></div>
                            <div><?= $other_details->second_bill_exc_address2 ?></div>
                            </div>
                            <p>
                            AT SIGHT PAY THIS SECOND OF EXCHANGE (FIRST OF THE SAME TENOR AND DATE BEING UNPAID) TO THE ORDER OF EXPORTER BANK, BRANCH, INDIA) CITY- COUNTRY. A SUM OF
                            <span><?= $documentData->currency ?></span> <span><?= $other_details->second_bill_amount ?></span>
                            <span class="uppercase">(<?= $other_details->amount_in_words ?>)</span>
                            FOR 100% VALUE RECEIVED OUR INVOICE NUMBER: <span><?= $other_details->second_bill_exc_cumm_invoice ?></span>
                            DATE: <span><?= $other_details->second_bill_exc_cumm_invoice_date ?></span>
                            </p>
                            <div style="padding: 30px 0px;">
                            For <span><?= $other_details->exporter_company_name ?></span>
                            </div>
                            <div style="padding: 10px 0px;">
                            <span><?= $other_details->name_of_authorized_signatory ?></span><br>
                            <span><?= $other_details->designation ?></span>
                            </div>
                            <div style="padding: 15px 0px;">
                            To, 
                            <div>
                            <span><?= $other_details->second_importer_bank_code ?></span>
                            <div>
                            <?= $other_details->second_importer_bank_name ?>
                            </div>
                            <span><?= $other_details->second_importer_bank_city_country ?></span>
                            </div>

                            
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
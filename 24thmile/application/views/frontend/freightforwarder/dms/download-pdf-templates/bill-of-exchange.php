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
            margin-top: 5cm;
            margin-left: 3cm;
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


                            <!--<center>
                                <h2 class="heading3-border">Bill Of Exchange</h2>
                            </center>-->
                            <br/><br/><br/>
                            <label  style="min-width: 100px;">Draft Number :-</label>
                                    <span><?= $other_details->bill_draft_number ?></span>
                        <label  style="min-width: 20px; padding: 10px;">Date :-</label>
                                    <span><?= $other_details->bill_date ?></span>
                            <br/><br/><label style="min-width: 50px; font-weight: none;"> For Amount of </label>
                            <span><?= $documentData->currency ?></span>
                            <span><?= $other_details->bill_amount ?></span>
                            <p>
                                    On Demand / At 90 days sight (Specific date as per LC term) of this first  						
                                    <br/>Bill of Exchange (Seconded date and tenor remain same being unpaid).						
                                    </p>
                                    <br/><br/>
                                    <p>
                                pay to the order of
                               <span>
                                   <?= $other_details->bank_name ?>
                               </span>
                                and
                               <span>
                                   <?= $other_details->importer_name ?>
                                </span>
                                (As per LC status)
                                <br/>
                                <div>
                                the sum of
                                <span><?= $documentData->currency ?></span>
                            <span><?= $other_details->bill_amount ?></span>
                                </div>
                                </br></br>
                                <label style="width: 190px; font-weight: none;"> Drown under Invoice number :</label>
                                <span><?= $other_details->inv_number ?></span>
                                <br/><label style="width: 190px; font-weight: none;">Letter Of Credit Number :</label>
                                <span><?= $other_details->credit_number ?></span>
                                <br/>Letter Of Credit Issued By
                                <br/><br/><br/>
                                To,
                                <br/>
                                <span>
                                <div style="white-space: pre;"><?= $other_details->consignee ?></div>
                                </span>
                                </p>
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
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
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 3cm;
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

        table.table-bordered tr td, table.table-bordered tr th  {
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
    <!-- <footer>
        <div class="text-center" style="background-color: #fff; color:#000;padding-bottom: 5px;">
            <small><?= $consignor->company_name ?> <?= $consignor->address_line_1 ?> <?= $consignor->address_line_2 ?> <?= $consignor->city_name ?> Pincode: <?= $consignor->pincode ?> <br> Contact Person: <?= $consignor->contact_name ?> Email: <?= $consignor->contact_email ?> Phone: <?= $consignor->contact_phone ?> </small>
        </div>
    </footer> -->
    <!-- Tracking start -->
    <div class="wshipping-content-block">

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="tracking-block">
                        <div class="tab-content">


                            <!--<center>
                                <h3 class="heading3-border">FORMAT - BASIC INFORMATION FROM MAJOR COMPANY</h3>
                            </center>-->
                            <br>
                            <br>
                            <div>
                                <label >1. Name of the Company:</label>
                                <span> <?= $other_details->company_name ?> </span>
                            </div>
                            <br>
                            <div>
                                <label >2. City:</label>
                                <span> <?= $other_details->city ?> </span>
                            </div>
                            <br>

                            <div>
                                <label >3. Contact Person:</label>
                                <span> <?= $other_details->contact_person ?> </span>
                            </div>
                            <br>
                            <div>
                                <label >4. Mobile Number:</label>
                                <span> <?= $other_details->mobile_mumber ?> </span>
                            </div>
                            <br>
                            <div>
                                <label >5. E-mail address:</label>
                                <span> <?= $other_details->email ?> </span>
                            </div>
                            <br>
                            <br>
                            <label >6. Details of Export turnover :</label>
                            <table id="itemstable" class="table items-table table-bordered ">
                                <thead>
                                    <tr>
                                        <th class="fix-width-60">Name of the country</th>
                                        <th class="fix-width-60">Total Value of export in last F Y (INR)</th>
                                        <th class="fix-width-60">Value in Advance Payment (INR)</th>
                                        <th class="fix-width-80">Value in LC term (INR)</th>
                                        <th>Value in CAD/DP/TT terms (INR)</th>
                                        <th>Value in DA or Open Account Term (INR)</th>
                                        <th>Maximum outstanding expected at any one point of time (INR)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($items->export_turnover)) { ?>
                                        <?php foreach ($items->export_turnover as $key => $tem) { ?>

                                            <tr>
                                                <td> <?= $tem->name_of_the_country ?> </td>
                                                <td> <?= $tem->total_value ?> </td>
                                                <td> <?= $tem->value_in_advance ?> </td>
                                                <td> <?= $tem->value_in_lc ?> </td>
                                                <td> <?= $tem->value_in_cad ?> </td>
                                                <td> <?= $tem->value_in_da ?> </td>
                                                <td> <?= $tem->maximum_outstanding ?> </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                   

                            <label >7. Details of Major 5 buyers: </label>

                            <table id="itemstable2" class="table items-table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="fix-width-60">Name of the buyer and country</th>
                                        <th class="fix-width-60">Total Value of export in last F Y (INR)</th>
                                        <th class="fix-width-60">Value in Advance Payment (INR)</th>
                                        <th class="fix-width-80">Value in LC term (INR)</th>
                                        <th>Value in CAD/DP/TT terms (INR)</th>
                                        <th>Value in DA or Open Account Term (INR)</th>
                                        <th>Maximum outstanding expected at any one point of time (INR)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($items->buyers)) { ?>
                                        <?php foreach ($items->buyers as $key => $tem) { ?>

                                            <tr>
                                                <td> <?= $tem->name_of_the_country ?> </td>
                                                <td> <?= $tem->total_value ?> </td>
                                                <td> <?= $tem->value_in_advance ?> </td>
                                                <td> <?= $tem->value_in_lc ?> </td>
                                                <td> <?= $tem->value_in_cad ?> </td>
                                                <td> <?= $tem->value_in_da ?> </td>
                                                <td> <?= $tem->maximum_outstanding ?> </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>

                               

                            </table>


                            <label >8. Is there any overdue payment more than 30 days from the due date? If yes, please give details. (INR in Crore) </label>

                            <table id="item-table-row-template3" class="table items-table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="fix-width-60">Name of the buyer </th>
                                        <th class="fix-width-60">Country</th>
                                        <th class="fix-width-60">Value of overdue amount (INR)</th>
                                        <th class="fix-width-80">Reason for non-payment by the buyer</th>
                                        <th>Whether you desired to do further exports to the buyer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($items->overdue)) { ?>
                                        <?php foreach ($items->overdue as $key => $tem) { ?>

                                            <tr>
                                                <td> <?= $tem->name_of_the_buyer ?> </td>
                                                <td> <?= $tem->country ?> </td>
                                                <td> <?= $tem->value_of_overdue ?> </td>
                                                <td> <?= $tem->reason ?> </td>
                                                <td> <?= $tem->further_exports ?> </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div>
                                <label >9. Whether you have opted cover from any other credit insurance company? If yes, give name of the credit insurer: </label>
                                <span> <?= $other_details->pre_carriage ?> </span>
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
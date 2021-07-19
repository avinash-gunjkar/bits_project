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

                         

                            <center>
                                <h3 class="heading3-border">VGM Declaration</h3>
                            </center>




                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="60%">
                                    <col width="40%">
                                    

                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td rowspan="4" class="text-left">
                                            <label for="">Shipper: </label>
                                            <div ><?= $other_details->shipper ?></div>
                                        </td>
                                        <td class="text-left">
                                            <label for="">Invoice Number: </label>
                                            <span><?= $other_details->invoice_number ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label for="">Invoice Date: </label>
                                            <span><?= printFormatedDate($other_details->invoice_date) ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label for="">Pre-Carriage By: </label> <span><?= $other_details->pre_carriage_by ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label for="">Certificate Number: </label> <span><?= $other_details->certificate_no ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"  class="text-left">
                                            <label for="">METHOD 1</label><br>
                                            <div style="white-space: break-spaces;display: inline-block;width:95%">Weighing the packed container using calibrated and certified weighing equipment (e.g. weighbridges, 
                                            load cell sensing technologies etc).
                                            </div>
                                            <?php $checkBoxImage = $other_details->method1 == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; "> 
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  colspan="2" class="text-left">
                                            <label for="">METHOD 2</label><br>
                                            <div style="white-space: break-spaces;display: inline-block;width:95%">Weighing all packages and cargo items, including the mass of pallets, dunnage and other securing material to be packed in the container and adding the tare mass of the container to the sum of the single masses, using a certified method approved by the Country competent Authority (Marine and Coastguard Agency (MCA) or its authorized body).
                                            </div>
                                        <?php $checkBoxImage = $other_details->method2 == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                            <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; "> 
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <table id="itemstable" class="table items-table">
                                                <thead>
                                                    <tr>
                                                        <td>Container Number</td>
                                                        <td>Container Tare (kg)</td>
                                                        <td>Cargo Weight (kg)</td>
                                                        <td>Gross Weight (kg)</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) { ?>
                                                        <?php foreach ($items as $key => $tem) { ?>
                                                            <tr>
                                                                <td><?= $tem->container_no ?></td>
                                                                <td><?= $tem->container_tare ?></td>
                                                                <td><?= $tem->cargo_wt ?></td>
                                                                <td><?= $tem->gross_wt ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>

                                                </tbody>

                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-left">
                                            <label for="">VGM Declaration</label>
                                            <div class="editable">
                                                <p>In accordance with the International Maritime Organization(IMO) Safety of Life at Sea(SOLAS) convention under regulation 2 of chapter VI which mandates the declaration of the Verified Gross Mass(VGM), the shipper hereby certifies all information on this Verified Gross Mass declaration is true and correct.</p>
                                            </div>
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
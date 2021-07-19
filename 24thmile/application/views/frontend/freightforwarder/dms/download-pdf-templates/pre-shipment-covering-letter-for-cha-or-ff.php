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
        .table th {
            text-align: center;

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
    <!--<footer>
        <div class="text-center" style="background-color: #fff; color:#000;padding-bottom: 5px;">
            <small><?= $consignor->company_name ?> <?= $consignor->address_line_1 ?> <?= $consignor->address_line_2 ?> <?= $consignor->city_name ?> Pincode: <?= $consignor->pincode ?> <br> Contact Person: <?= $consignor->contact_name ?> Email: <?= $consignor->contact_email ?> Phone: <?= $consignor->contact_phone ?> </small>
        </div>
    </footer>-->
    <!-- Tracking start -->
    <div class="wshipping-content-block">

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="tracking-block">
                        <div class="tab-content">


                            <!--<center>
                                <h3 class="heading3-border">Pre Shipment Covering Letter for CHA/FF</h3>
                            </center>-->


                            <br><br>
                            <div>
                                <label style="font-weight: normal;">Date:</label> <span><b><?= printFormatedDate($other_details->date) ?></b></span>
                            </div>
                            <br>
                            <div>
                                <label style="font-weight: normal;">Kind attention:</label><span><b><?= $other_details->person ?></b></span>
                            </div>

                            <div>
                                <!-- <label for="">Name of the Company:</label> -->
                                <span><b><?= $other_details->company ?></b></span>
                            </div>

                            <div>
                                <!-- <label for="">Address1 :</label> -->
                                <span><b><?= $other_details->address1 ?></b></span>
                            </div>


                            <div>
                                <!-- <label for="">Address2 :</label> -->
                                <span><b><?= $other_details->address2 ?></b></span>
                            </div>
                            <br>
                            <div style="margin: 30px 5px 0 0">
                                <label style="font-weight: normal;">Subject :</label>
                                    <span><b><?= $other_details->subject ?></b></span>
                                
                            </div>
                            <br>
                            <div style="margin: 30px 5px 0px 0">
                                <span>Dear </span>
                                <span><b><?= $other_details->dear ?></b></span>
                            </div>

                            <br>
                            <span> We are enclosing herewith following documents to process Custom Clearance and Shipping documents: </span>

                            <table  class="table table-bordered">
                            <thead>
                                <tr>
                                   <th>Sr.No.</th>
                                   <th>Document Name</th>
                                   <th>Original</th>
                                   <th>Copies</th>
                                </tr>
                               
                                      
                            </thead>
                            <tbody>
                                    <?php if (!empty($items)) { ?>
                                        <?php $counter=0; foreach ($items as $key => $item) { ?>

                                            <tr>
                                                <td style="text-align:center"> <?= $counter = $counter + 1; ?> </td>
                                                <td> <?= $item->document_name ?> </td>
                                                <td style="text-align:center"> <?= $item->document_original_count ?> </td>
                                                <td style="text-align:center"> <?= $item->document_copies_count ?> </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                        </table>
                            

                            <div>We hope that all documents are in line. You are requested to proceed further. </div>
                            <br>
                            <div><span>Thanking you. </span></div>
                            <br>
                            <div><span>Yours faithfully, </span></div>
                            For <span><?=$other_details->exporter_company_name?></span>
                            <br><br>
                            <span> <?= $other_details->name_of_authorized_signatory ?> </span>
                            <br>
                            <span> <?= $other_details->designation ?> </span>

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
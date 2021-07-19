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

        span.uppercase{

            text-transform: uppercase;
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
    <!-- Tracking start -->
    <div class="wshipping-content-block">

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="tracking-block">
                        <div class="tab-content">
                            Date :- <span><?= $other_details->scomet_date?></span>
                            <div style="padding: 25px 0px;">
                            To,
                            <br>
                            <?= $other_details->scomet_letter_add1?><br>
                            <?= $other_details->scomet_letter_add2?><br>
                            <?= $other_details->scomet_letter_add3?>
                            </div>
                            <div>
                            Reference :- <span><b><?= $other_details->reference?></b></span>
                            </div>
                            <div style="padding: 10px 0px;">
                            Subject :- <span><b><?= $other_details->subject?></b></span>
                            </div>
                            <div style="padding: 10px 0px;">
                            Dear <span><?=$other_details->mam_sir?></span>
                            </div>
                            <p>
                            With reference to the above shipment we declare that the export item
                            "<span><?= $other_details->product_details ?></span>" being exported to 
                            <span><?= $other_details->importer_address?></span> does not comes under SCOMET list of item as per the customs act 1962 and we take whole 
                            responsibility of the export consignment to note rule under SCOMET list of item and further they allow to exported from India without any 
                            restriction and prohibition as per the customs act 1962 rules and act amended from time to time as per the customs act 1962. 
                            <div style="padding: 5px 0px;">We hereby request you to kindly release the above shipment.
                            <br><br>Thanking you,
                            </div>
                            
                            </p>
                            <div style="padding: 5px 0px;">
                            Your faithfully,
                            </div>
                            <div>
                            For <span><?= $other_details->exporter_company_name ?></span>
                            </div>
                            <div style="padding: 35px 0px;">
                            <span><?= $other_details->name_of_authorized_signatory ?></span><br>
                            <span><?= $other_details->designation ?></span>
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
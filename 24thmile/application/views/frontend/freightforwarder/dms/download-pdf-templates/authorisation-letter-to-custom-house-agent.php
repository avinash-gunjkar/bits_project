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
                            <!--<center>
                                <h3 class="heading3-border">Authorisation Letter to Custom House Agent</h3>
                            </center>-->
                            <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <div>Date: <b><?= printFormatedDate($other_details->document_date) ?></b></div>
                            
                            <br>
                            <div class="text-center">
                                <h3><u><strong>To whomsoever it may Concern</strong></u></h3>
                            </div>
                            <br>
                            <div>
                                <p>We, <?= $other_details->exporter_company_name ?>, importer and exporter bearing an Import and Export Code <?= $other_details->iec_no ?> issued by the Director General of Foreign Trade having office at <?= $other_details->exporter_address_line_1 ?>,
                                    <?= $other_details->exporter_address_line_2 ?> and holding a valid PAN <?= $other_details->pan_no ?> is hereby appoints M/s. <?= $other_details->cha_name ?> having a PAN based License Number <?= $other_details->license_no ?> and having CHA
                                    Registration Number (<?= $other_details->cha_reg_no ?>) to perform customs clearance and forwarding on behalf
                                    of us.
                                </p>
                            </div>
                            <br>
                            <div>
                                <p>We hereby hold the responsibility of the act of <?= $other_details->cha_name ?> as of our own against our Import and / or Export consignments while handling.</p>
                            </div>
                            <br>
                            <div>
                                <p>The Know Your Customer (KYC) as required and mandated by the Indian Customs vide
                                    CBEC circular 09/2010 and 33/2010 for identification / verification of importers /
                                    exporters for customs clearance performed by the Customs Broker is enclosed along
                                    with for records.
                                </p>
                            </div>
                            <br>
                            <div>
                                <p>Thanking you.</p>
                            </div>
                            <div>
                                <p>For <?= $documentData->for_consignor_company ?></p>
                            </div>
                            <br><br>
                            <div><?= $other_details->name_of_authorized_signatory ?></div>
                            <div><?= $other_details->designation ?></div>
                        </form>
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
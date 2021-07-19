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

        .table-bordered tr td,  .table-bordered tr th  {
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

        table {
        counter-reset: srno;
    }

    table tr td.sr-no::before {
        counter-increment: srno;
        content: counter(srno);
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
                                <h3 class="heading3-border">Document Submission to Bank</h3>
                            </center>-->
                            <form id="documentForm" action="" method="POST" enctype="multipart/form-data">

                                <div>Date: <?= printFormatedDate($other_details->document_date) ?></div><br>

                                <div>The Branch Manager,</div>
                                <div ><?= $other_details->name_of_bank ?></div>
                                <div><?= $other_details->branch_name ?></div>
                                <div><?= $other_details->branch_place ?></div>


                                </br></br><label for="">Subject:</label> <?= $other_details->subject ?></br></br><br>
                                <div>Dear Madam/Sir,</div><br>
                                <div>We hereby submit the below listed Bills of Entry (as applicable * ) in respect of our below detailed import remittances for necessary action at your end.</div><br>
                                <div>Please acknowledge receipt on the duplicate hereof.</div><br>
                                <div>A) Details of Self attested Bill of Entries enclosed</div>

                                <table id="itemstable" class="table table-bordered items-table" style="margin-top: 15px;">
                                    <thead>

                                        <th>Sr.No.</th>
                                        <th>Bank Bill reference number</th>
                                        <th>BoE Number</th>
                                        <th>BoE Dated</th>
                                        <th>Currency</th>
                                        <th>Total Amount to be endorsed</th>
                                        <th>Balance amount available</th>

                                    </thead>
                                    <tbody>
                                    
                                            <?php $counter=0; foreach ($items as $key => $item) { ?>
                                                <tr>
                                                    <td class="sr-no" style="text-align: center;">
                                                       <?=$counter = $counter + 1;?>
                                                    </td>
                                                    <td><?= $item->reference_no ?></td>
                                                    <td><?= $item->boe_no ?></td>
                                                    <td><?= printFormatedDate($item->boe_date) ?></td>
                                                    <td style="text-align: right;"><?= $item->currency ?></td>
                                                    <td style="text-align: right;"><?= $item->total_amt ?></td>
                                                    <td style="text-align: right;"><?= $item->balance_amt ?></td>
                                                </tr>
                                            <?php } ?>                                        
                                    </tbody>                                    
                                </table>
                                <div>B) Details of Bill of Entry issued on or after 01st December 2016</div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td><label>Customer Name</label></td>
                                            <td><?= $other_details->customer_name ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Import Export Code</label></td>
                                            <td><?= $other_details->customer_name ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Authorised Dealer Code</label></td>
                                            <td><?= $other_details->customer_name ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Bill Of Entry No.</label></td>
                                            <td><?= $other_details->customer_name ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Bill Of Entry Date</label></td>
                                            <td><?= printFormatedDate($other_details->boe_date) ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Bill Of Entry Amount</label></td>
                                            <td><?= $other_details->boe_amount ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Currency</label></td>
                                            <td><?= $other_details->currency ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Free On Board value</label></td>
                                            <td><?= $other_details->fob_value ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Port Code</label></td>
                                            <td><?= $other_details->port_code ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Harmonized System (H.S.) Code</label></td>
                                            <td><?= $other_details->hsn_no ?></td>
                                        </tr>

                                    </tbody>
                                </table><br>
                                <div><u><strong>Reasons for difference in amounts/any other mismatch</strong></u></div>
                                <div>
                                    <hr style="margin: 1.5rem 1rem 0 0;">
                                </div>
                                <div>
                                    <hr style="margin: 1.5rem 1rem 0 0;">
                                </div>
                                <div>
                                    <hr style="margin: 1.5rem 1rem 0 0;">
                                </div>
                                <div>
                                    <hr style="margin: 1.5rem 1rem 0 0;">
                                </div>
                                <br>
                                <div><u><strong><?= $other_details->ec_copy ?></strong></u></div>
                            <div><u><strong><?= $other_details->boe_details ?></strong></u></div>
                            <div><u><strong><?= $other_details->courier_bills ?></strong></u></div>
                                <!-- <div><u><strong>For EDI ports - original (EC Copy)where Bill of Entry is dated prior to 01st December 2016</strong></u></div>
                                <div><u><strong>For EDI ports - BOE details in case of Bill of Entry issued on or after 01st December 2016</u></strong></div>
                                <div><u><strong>For manual ports or courier bill of Entries – Physical original EC copy to be submitted.</u></strong></div> -->
                                <br>
                                <div>Strike out the portion (A or B) which is not applicable.</div>
                                <br><br>
                                <div>For, <?= $other_details->exporter_company_name ?></div>
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
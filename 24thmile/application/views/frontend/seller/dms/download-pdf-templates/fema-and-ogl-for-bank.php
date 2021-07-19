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
            margin-left: 2cm;
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
                        <center>
                            <h3 class="heading3-border">FEMA & OGL for Bank</h3>
                        </center>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <!-- <div> -->
                            <b><div class="col-lg-1">To,</div></b>
                            <div><?= $other_details->branch_manager_name ?></div>
                            <div><?= $other_details->branch_place ?></div>                         
                            <div style="white-space: pre;"><?= $other_details->name_of_bank ?></div>
                            <br><br>
                            <!-- </div> -->
                            <p><u>Ref : Declaration Cum Undertaking Under Section 10(5) , Chapter III of the Foreign Exchange Management Act, 1999.</u></p><br>
                            <p>I/We hereby declare that the transaction the details of which are specifically mentioned in the Schedule
                                hereunder does not involve, and is not designed for the purpose of any contravention or evasion of the
                                provisions of the aforesaid Act or of any rule, regulation, notification, direction or order made thereunder.</p><br>

                            <p>I/We also hereby agree and undertake to give such information/documents as will reasonably satisfy you about this transaction in terms of the above declaration.</p><br>
                            <p>I/We also understand that if I/ We refuse to comply with any such requirement or make only satisfactory
                                compliance therewith, the Bank shall refuse in writing to undertake the transaction and shall if it has reason
                                to believe that any contravention/evasion is contemplated by me/us report the matter to the Reserve Bank of India.</p><br>
                            <p>I/We further declare that the undersigned has/have the authority to give this declaration and undertaking
                                on behalf of the firm /company.</p><br>
                            <p>The good imported under this transaction are under OGL and not under the negative list of imports.</p><br><br>
                            <p>Signature of the Applicant for Foreign Exchange</p>
                            <label>Place: </label>
                            <?= $other_details->place ?>
                            <br><br><br><div>
                            <label>Schedule</label>        
                            </div>
                            <div>
                            <span>Nature/Purpose of the Foreign Exchange Transaction :-</span> 
                            <span></s><?= $other_details->foreign_exc_purp ?></span><br>
                            </div>
                            <div>
                            <span>Amount of Foreign Exchange :-</span>
                            <span><?= $other_details->foreign_exc_amt ?></span>
                            <p>( Please fill only in case of specific remittances )</p>
                            </div>
                            
                        
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
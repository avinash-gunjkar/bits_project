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

        .table  tr.border {
            border-bottom: solid 1px #cccccc;
        }

        .table-bordered tr td,.table-bordered tr th {
            border: solid 1px #cccccc;
        }

        .table td h1 {
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
            font-weight: none;
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
                                <h2 class="heading3-border">Marine Insurance Instruction</h2>
                            </center>-->
                            </br></br>
                            <div>
                               <label style="font-weight: normal;">Date</label>
                                  <span><?=$other_details->marins_date ?></span>
                            </div>
                            <td>
                            <dev>
                                <br/><br/><label  style="min-width: 50px;">To,</label><br>
                                <label  style="min-width: 50px;">Branch Manager,</label>
                            </dev>
                            </br><span><?=$other_details->insurance_company ?></span>
                            </br><span><?=$other_details->city ?></span>
                            <span style="padding: 20px 0px">
                            <?=$other_details->state ?>
                            </span>
                            <span style="padding: 20px 0px">
                            <?=$other_details->pin ?>
                            </span>
                        </div>
                        </td>
                        <div style="padding: 30px 0px 0 0"><label style="font-weight: normal";>Subject :-</label>
                        <span><b><?=$other_details->subject ?></b></span>
                        </div>
                        
                        <div>
                        <br/>
                        <p> <label style="font-weight: normal;">Dear</label>
                        <span><?=$other_details->mam_sir ?></span>
                        
                        <br/><br/><div>We are enclosing herewith following documents to apply for All Risks Cover Marine Insurance Policy.</div>
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                   <th>Sr.No.</th>
                                   <th>Document Name</th>
                                   <th>Document Number and Date</th>
                                   <th>Original</th>
                                   <th>Copies</th>
                                </tr>
                               
                                      
                            </thead>
                            <tbody>
                                    <?php if (!empty($items)) { ?>
                                        <?php $counter=0; foreach ($items as $key => $item) { ?>

                                            <tr>
                                                <td style="text-align:center; width:5%"> <?= $counter = $counter + 1; ?> </td>
                                                <td style="width:45%"> <?= $item->document_name ?> </td>
                                                <td style="width:30%"><?= $item->document_number_date ?></td>
                                                <td style="text-align:center"> <?= $item->document_original_count ?> </td>
                                                <td style="text-align:center"> <?= $item->document_copies_count ?> </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                        </table> 
                        We hope that all documents are in line. You are requested to proceed further.
                        <br/>Thanking you.<br/><br/>

                        Yours truly,
                        <br/> For <span><?=$other_details->exporter_company_name?></span>
                        </p>
                        <br/>
                        <br/>
                                 <span>
                                    <?= $other_details->name_of_authorized_signatory ?>
                                </span>
                        </td> 
                        <td>
                    <br/>
                                <span>
                                <?= $other_details->designation ?>
                                </span>
                        </td>    
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
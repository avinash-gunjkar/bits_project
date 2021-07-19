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
            margin-bottom: 2cm;
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

        .table table th,
        .table table td {
            padding: 6px 5px;
            vertical-align: top;
        }

        .table table tr.border {
            border-bottom: solid 1px #cccccc;
        }

        .table-bordered tr td,
        .table-bordered tr th {
            border: solid 1px #cccccc;
            padding:5px;
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

        ol,
        p {

            font-size: 12px;
        }

        ol li {
            margin-bottom: 15px;
        }
        table.table.no-border td,table.table.no-border{
        border: none;
    }
    ul.package-info li{
        margin: 0;
    }
    </style>
</head>

<body>
    <?php
    
    $other_details = $documentData->other_details;
    $consignor = (object) $other_details->consignor;
    $items = $documentData->items;
    $type_of_shipping_bills = $other_details->type_of_shipping_bills;
    $documentList = $other_details->documentList;
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
                                <h3 class="heading3-border">SHIPPER' S LETTER OF INSTRUCTIONS</h3>
                               
                            </center>




                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        
                                        <td colspan="3">
                                        <div><label for="">Exporter Name:</label> <span><?= $other_details->exporter_company_name ?></span></div>
                                        <div class="col-lg-2"><label for="">Invoice No and Date:</label> <span><?= $other_details->invoice_number ?> <?= printFormatedDate($other_details->invoice_date) ?></span></div>

                                        </td>
                                        <td colspan="1">
                                        <span ><label for="">Date:</label><?= printFormatedDate($documentData->created_at) ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">

                                        <table class="table no-border">
                                            <colgroup>
                                            <col width="30%">
                                            <col width="70%">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <td>Import Export Code Number (10 DIGIT) :</td>
                                                <td><?= $other_details->iec_no ?></td>
                                            </tr>
                                            <tr>
                                                <td>GSTIN Number:</td>
                                                <td><?= $other_details->gst_no ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bank Authorized Dealer Code # (PART I & II):</td>
                                                <td><?= formated_ad_code($other_details->bank_ad_code) ?></td>
                                            </tr>
                                            <tr>
                                                <td>CURRENCY OF INVOICE:</td>
                                                <td><?= $other_details->currency ?></td>
                                            </tr>
                                            <tr>
                                                <td>INCOTERMS:</td>
                                                <td><?= $other_details->incoterms ?></td>
                                            </tr>
                                            <tr>
                                                <td>NATURE OF PAYMENT:</td>
                                                <td><?= $other_details->nature_of_payment ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                            
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="">DETAILS TO BE DECLARED FOR PREPARATION OF SHIPPING BILL:</label>
                                                </div>
                                            </div>
                                            <table class="table no-border">
                                            <colgroup>
                                            <col width="30%">
                                            <col width="70%">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <td>FOB VALUE :</td>
                                                <td><?= $other_details->fob_value ?></td>
                                            </tr>
                                            <tr>
                                                <td>FREIGHT (IF ANY):</td>
                                                <td><?= $other_details->freight ?></td>
                                            </tr>
                                            <tr>
                                                <td>INSURANCE (IF ANY):</td>
                                                <td><?= $other_details->insurance ?></td>
                                            </tr>
                                            <tr>
                                                <td>COMMISSION (IF ANY):</td>
                                                <td><?= $other_details->commission ?></td>
                                            </tr>
                                            <tr>
                                                <td>DISCOUNT (IF ANY):</td>
                                                <td><?= $other_details->discount ?></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                            
                                            

                                        </td>

                                    </tr>

                                    <tr>
                                        <td colspan="3">
                                            <div><label for="">DESCRIPTION OF GOODS TO BE DECLARED ON SHIPPING BILL</label></div>
                                        </td>
                                        <td rowspan="3">
                                            <ul class="package-info" style="list-style: none;padding:0;">
                                                <li>NUMBER OF PKGS. : 1</li>
                                                <li>NET WT. (kg): <span  style="display: inline-block;"><?= $other_details->total_net_wt ?></span></li>
                                                <li>GROSS WT. (kg): <span  style="display: inline-block;"><?= $other_details->total_gross_wt ?></span></li>
                                                <li>VOLUME WT. : <span  style="display: inline-block;"><?= $other_details->total_volumetric_wt ?></span></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="vertical-align: top;">
                                            <div>as per invoice Attached</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div><label for="">DESCRIPTION OF GOODS TO BE DECLARED ON AWB</label></div>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="vertical-align: top;">
                                            as per invoice Attached
                                        </td>
                                        <td>
                                            <div><label for="">DIMENSION (IN CMS)</label></div>
                                            <div>L X B X H</div>
                                            <ul class="package-info" style="list-style: none;padding:0;">
                                            <?php if(!empty($items)){?>
                                            
                                                <?php foreach($items as $key=>$item){ $item = (object)$item;?>
                                                    <li>Package <?=$key+1?>: <span style="display: inline-block;"><?=$item->dimention_per_pk?></span></li>
                                                <?php }?>
                                                <?php }?>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                            <label for="">SPECIAL INSTRUCTION IF ANY,</label>
                                            <div class="editable-textarea" ><?= $other_details->special_instructions ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for="">TYPE OF SHIPPING BILL</label>
                                            <?php foreach ($type_of_shipping_bills as $key => $type_of_shipping_bill) { ?>
                                                <div>
                                                     <?php $checkBoxImage = $type_of_shipping_bill->value == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                                     <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; "> <?= $type_of_shipping_bill->name ?>
                                                    
                                                </div>
                                            <?php } ?>
                                        </td>
                                        <td colspan="2">
                                            <label for="">BELOW DETAILS REQUIRED TO BE DECLARED ON INVOICE</label>
                                            <ul style="list-style-type: none;">
                                                <li>EXPORT INVOICE, IF VALUE IS MORE THEN RS.25000/- THEN GR WAIVER</li>
                                                <li>EXPORT INVOICE, PACKING LIST, SDF</li>
                                                <li>REQD.DRAWBACK SR NO, ANX-1, ANX-111</li>
                                                <li>REQD.DEEC REGN. NO. SBILL COPY, RAW MATERIAL DETAILS, LICENCE COPY</li>
                                                <li>REQD. EPCG REGN. NO. SBILL COPY, RAW MATERIAL DETAILS, LICENCE COPY</li>
                                                <li>ANX-C1</li>
                                                <li>COPY OF BOE</li>
                                                <li>ALL IMPORT & EXPORT DOCUMENTS IN ORIGINAL</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <label for="">PLEASE TICK & LIST THE DOCUMENTS (BEING) HANDED OVER TO FORWARDER :</label>
                                    
                                                <table class="table no-border">
                                                    <tbody>
                                                        <tr>

                                                        
                                                <?php foreach ($documentList as $key => $document) {

                                                ?>

                                                    
                                                    
                                                   <td><?php $checkBoxImage = $document->value == '1' ? APPPATH.'../assets/frontend/images/checkbox-check-black.png' : APPPATH.'../assets/frontend/images/checkbox-uncheck-black.png' ?> 
                                                    <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">  <?= $document->name ?>
                                                    </td>
                                                   <?= $key % 3 == 2 && $key?'</tr><tr>':''; ?>

                                                <?php } ?>
                                                </tr>
                                                    </tbody>

                                                </table>
                                                </div>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <label for="">Declaration:</label>
                                            <div class="editable-textarea" ><?= $other_details->declaration ?></div>
                                        </td>
                                        <td style="text-align: left;">
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
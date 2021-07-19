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
            font-weight: normal;
        }

        table.table.no-border td,
        table.table.no-border {
            border: none;
        }

        ol li {
            margin-bottom: 20px;
        }
        
        img.checkbox-img{
            margin-right: 25px;
            margin-right: 5px;
            width: 12px;
            height: 12px;
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
                                <h3 class="heading3-border">ANNEXURE – A</h3>
                                <h3 class="heading3-border">EXPORT VALUE DECLARATION</h3>
                                <small>(See Rule 7 of Customs Valuation (Determination of Value of Export Goods) Rules, 2007.)</small>
                            </center>

                            <table class="table no-border">
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">
                                </colgroup>
                                <tbody>

                                    <tr>
                                        <td colspan="2">
                                            <ol>
                                                <li>
                                                    <div><label for="">Shipping Bill Number : </label>

                                                        <span><?= $other_details->shipping_bill_no ?></span>
                                                        &nbsp <label>Date : </label>
                                                        <span><?= printFormatedDate($other_details->shipping_bill_date) ?></span>
                                                    </div>
                                                </li>
                                                <li>

                                                    <div>
                                                        <div>
                                                            <label for=""> Invoice Number:</label>
                                                            <span><?= $other_details->invoice_number ?></span>
                                                                &nbsp <label>Date : </label>
                                                            <span><?= printFormatedDate($other_details->invoice_date) ?></span>
                                                        </div>

                                                       

                                                    </div>


                                                </li>
                                                <li>
                                                    <div><label for="">Nature of Transaction:</label></div>
                                                        <div><label for="" style="width: 50px;">Sale </label>
                                                            <?php $checkBoxImage = $other_details->nature_of_transaction == 'sale' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                            <img class="checkbox-img" src="<?= $checkBoxImage ?>" >

                                                            <label for="" style="width: 50px;">Sale on consignment Basis </label>
                                                            <?php $checkBoxImage = $other_details->nature_of_transaction == 'sale_on_consignment_basis' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                            <img class="checkbox-img" src="<?= $checkBoxImage ?>" >

                                                            <label for="" style="width: 50px;">Gift </label>
                                                            <?php $checkBoxImage = $other_details->nature_of_transaction == 'gift' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                            <img class="checkbox-img" src="<?= $checkBoxImage ?>" >

                                                            <label for="" style="width: 50px;">Sample </label>
                                                                <?php $checkBoxImage = $other_details->nature_of_transaction == 'sample' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                                <img class="checkbox-img" src="<?= $checkBoxImage ?>" >

                                                                <label for="" style="width: 50px;">Other </label>
                                                                    <?php $checkBoxImage = $other_details->nature_of_transaction == 'other' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                                    <img class="checkbox-img" src="<?= $checkBoxImage ?>" >
                                                        </div>
                                                    
                                                </li>

                                                <li>
                                                    <div><label for="">Method of Valuation:</label></div>
                                                    <div>
                                                        <label for="">Rule 3 </label><span><?= $other_details->Rule_3 ?></span>
                                                        <?php $checkBoxImage = $other_details->method_of_valuation == 'Rule_3' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                        <img class="checkbox-img" src="<?= $checkBoxImage ?>" >

                                                        <label for="">Rule 4 </label><span><?= $other_details->Rule_4 ?></span>
                                                        <?php $checkBoxImage = $other_details->method_of_valuation == 'Rule_4' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                        <img class="checkbox-img" src="<?= $checkBoxImage ?>" >

                                                        <label for="">Rule 5 </label><span><?= $other_details->Rule_5 ?></span>
                                                        <?php $checkBoxImage = $other_details->method_of_valuation == 'Rule_5' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                        <img class="checkbox-img" src="<?= $checkBoxImage ?>" >

                                                        <label for="">Rule 6 </label><span><?= $other_details->Rule_6 ?></span>
                                                        <?php $checkBoxImage = $other_details->method_of_valuation == 'Rule_6' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                        <img class="checkbox-img" src="<?= $checkBoxImage ?>" >
                                                    </div>
                                                </li>

                                                <li>
                                                    <div>
                                                        <label for="">Whether seller and buyer are Related:</label>
                                                        <label for="">Yes </label><span><?= $other_details->invowhether_seller_and_buyer_relatedice_number ?></span>
                                                        <?php $checkBoxImage = $other_details->whether_seller_and_buyer_related == 'yes' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                        <img class="checkbox-img" src="<?= $checkBoxImage ?>" >

                                                        <label for="">NO </label>
                                                        <!-- <span><?= $other_details->whether_seller_and_buyer_related ?></span> -->
                                                        <?php $checkBoxImage = $other_details->whether_seller_and_buyer_related == 'no' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                        <img class="checkbox-img" src="<?= $checkBoxImage ?>" >
                                                    </div>
                                                </li>

                                                <li>
                                                    <div>
                                                        <label for="">If yes, whether relationship has influenced the price:</label>
                                                        <label for="">Yes </label>
                                                            
                                                            <?php $checkBoxImage = $other_details->whether_relationship_influenced_price == 'yes' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                            <img class="checkbox-img" src="<?= $checkBoxImage ?>" >

                                                            <label for="">NO </label>
                                                            <!-- <span><?= $other_details->whether_relationship_influenced_price ?></span> -->
                                                            <?php $checkBoxImage = $other_details->whether_relationship_influenced_price == 'no' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                            <img class="checkbox-img" src="<?= $checkBoxImage ?>" >
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <label for="">Terms of Payment: </label><span><?= $other_details->terms_of_payment ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <label for="">Terms of Delivery: </label><span><?= $other_details->terms_of_delivery ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div><label for="">Previous exports of identical / similar goods, If any </label>
                                                        <div><label for="">Shipping Bill Number :</label>
                                                            <span><?= $other_details->previous_export_similar_goods_shipping_bill_no ?></span>
                                                        </div>
                                                        <div><label for="">Shipping Bill Date:</label>
                                                            <span><?= printFormatedDate($other_details->previous_export_similar_goods_shipping_bill_date) ?></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <label for="">Any other relevant information (Attach separate sheet, If necessary)</label>
                                                    </div>
                                                </li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label for="">DECLARATION</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p>1. I / We hereby declare that the information furnished above is true, complete and correct in every respect.
                                            </p>
                                            <p>2. I / We also undertake to bring to the notice of proper officer any particulars, which subsequently come to my/our knowledge, which will have bearing on a valuation.
                                            </p>

                                        </td>
                                    </tr>

                                    <tr>
                                        
                                        <td colspan="1" style="text-align: left;">
                                            
                                            <div style="margin-top:25px;">
                                            For <?= $documentData->for_consignor_company ?>
                                            <br><br>
                                            <img id="userPhotoPreview" src="<?= $documentData->signature ?>" style="height:50px;width: 150px; object-fit: contain;" />

                                            
                                            <br> <?= $other_details->name_of_authorized_signatory ?>
                                            <br> <?= $other_details->designation ?>
                                        </div>
                                    </td>
                                    <td></td>
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
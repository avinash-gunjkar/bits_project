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

        ul {
            list-style: none;
            display: inline-block;
            padding-left: 10px;
            vertical-align: top;
        }

        ul li {
            margin-bottom: 5px;
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
                            <!-- <img id="logoPreview" src="<?php echo getPhysicalPathFromUrl(base_url() . 'uploads/company/' . $companyProfile->company_logo); ?>" onerror='this.src="<?php echo base_url() . 'uploads/default.png'; ?>"' style="height:50px;width: 100px; object-fit: contain;" /> -->

                            <center>
                                <h3 class="heading3-border">TAX-INVOICE</h3>
                            </center>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="table-layout: fixed;">
                                    <colgroup>
                                        <col width="25%">
                                        <col width="25%">
                                        <col width="25%">
                                        <col width="25%">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="text-left"><label for="">Supplier:</label> <?= $other_details->exporter_company_name ?>
                                            </td>
                                            <td colspan="2" class="text-left"><label for="">Consignee:</label><?= $other_details->consignee_company_name ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-left"><label for="">Supplier Address:</label> <?= $other_details->exporter_address ?>
                                            </td>
                                            <td colspan="2" class="text-left"><label for="">Consignee Address:</label> <?= $other_details->consignee_address ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-left"><label for="">Contact Details:</label>  <?= $other_details->exporter_contact_number ?>
                                            </td>
                                            <td colspan="2" class="text-left"><label for="">Contact Details:</label>  <?= $other_details->consignee_contact_number ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <div>
                                                <td colspan="2">
                                                    <label for="">IEC/PAN/ Aadhar/ Passport No:</label> <span><?= $other_details->iec_no ?></span>
                                                </td>
                                                <td colspan="2"><label for="">GSTIN/UIN:</label> <span><?= $other_details->gst_no ?></span>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td><label>IGST Payment Status: (Tick applicable option):</label></td>
                                            <td><label>A)Not Applicable
                                                    <?php $radioImage = $other_details->igst_payment_status == 'not-applicable' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                    <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></td>
                                            <td><label>B) LUT or Export under Bond <?php $radioImage = $other_details->igst_payment_status == 'export-under-bond' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                    <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></td>
                                            <td><label>C) Export Against Payment of IGST <?php $radioImage = $other_details->igst_payment_status == 'export-against-payment' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                                    <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                                </label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="text-left">
                                                <label for="">GST Invoice No:</label>
                                            </td>
                                            <td colspan="1" class="text-left">
                                                <div><?= $other_details->gst_invoice_no ?></div>
                                            </td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <label for="">Place of Supply:</label>
                                            </td>
                                            <td class="text-left">
                                                <div><?= $other_details->place_of_supply ?></div>

                                            </td>
                                            <td class="text-left">
                                                <label for="">Vehicle number:</label>
                                            </td>
                                            <td class="text-left">
                                                <div><?= $other_details->vehicle_no ?></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">
                                                <label for="">State Code:</label>
                                            </td>
                                            <td class="text-left">
                                                <div><?= $other_details->state_code ?></div>
                                            </td>
                                            <td class="text-left"><label for="">Date of Supply:</label></td>
                                            <td class="text-left">
                                                <span><?= printFormatedDate($other_details->date_of_supply) ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-center"><label>Notifying Party, if Other than Consignee</label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-left"><label for="">Supplier:</label> <?= $other_details->notify_party_company_name ?>

                                            </td>
                                            <td colspan="2" class="text-left"><label for="">Consignee:</label> <?= $other_details->buyer_company_name ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-left"><label for="">Supplier Address:</label>  <?= $other_details->notify_party_address ?>

                                            </td>
                                            <td colspan="2" class="text-left"><label for="">Consignee Address:</label>  <?= $other_details->buyer_address ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-left"><label for="">Contact Details:</label> <?= $other_details->notify_party_contact_number?>

                                            </td>
                                            <td colspan="2" class="text-left"><label for="">Contact Details:</label>  <?= $other_details->buyer_contact_number ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <table id="itemstable" class="table items-table " style="table-layout: fixed;">
                                                    <thead>
                                                        <tr>
                                                            <td rowspan="2">
                                                                <label for="">Sr. No.</label>
                                                            </td>
                                                            <td rowspan="2" style="width:40%">
                                                                <label for="">Product Description</label>
                                                            </td>
                                                            <td rowspan="2">
                                                                <label for="">HSN Code</label>
                                                            </td>
                                                            <td rowspan="2">
                                                                <label for="">Quantity (In Number)</label>
                                                            </td>
                                                            <td rowspan="2">
                                                                <label for="">Rate per Unit (In INR)</label>
                                                            </td>
                                                            <td rowspan="2">
                                                                <label for="">Total Value (In INR)</label>
                                                            </td>
                                                            <td colspan="2">
                                                                <label for="">IGST</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>% Rate</td>
                                                            <td>Value in INR</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($items)) { ?>
                                                            <?php $counter=0; foreach ($items as $key => $item) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <?= $counter = $counter + 1; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item->description ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item->hs_code ?>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                        <?= number_format($item->qty ,2)?>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                        <?= number_format($item->price,2) ?>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                        <?=number_format( $item->total_amount,2) ?>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                        <?= number_format($item->per_rate,2) ?>
                                                                    </td>
                                                                    <td style="text-align: right;">
                                                                        <?= number_format($item->value_in_inr,2) ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } ?>

                                                    </tbody>
                                                    <tfoot>

                                                        <tr>
                                                            <td colspan="3"><label for="">Total</label></td>
                                                            <td colspan="1" style="text-align: right;">
                                                               <?= $other_details->total_qty_no ?>
                                                            </td>
                                                            <td colspan="1"></td>
                                                            <td colspan="1" style="text-align: right;">
                                                                <?= $other_details->total_value ?>
                                                            </td>
                                                            <td colspan="1"></td>
                                                            <td colspan="1" style="text-align: right;">
                                                                <?= $other_details->total_value_inr ?>
                                                            </td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"><label for="">Invoice Amount before Tax in Words</label></td>
                                                            <td colspan="2"><label for="">Total Amount before Tax</label></td>
                                                            <td colspan="1" style="text-align: right;">
                                                                <div><?= $other_details->total_amt_before_tax ?></div>
                                                            </td>
                                                            <td colspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" rowspan="2">
                                                                <?= $other_details->total_Amount_InWords ?>
                                                            </td>
                                                            <td colspan="2"><label for="">IGST in INR</label></td>
                                                            <td colspan="1" style="text-align: right;">
                                                                <?= $other_details->igst_in_inr ?>
                                                            </td>
                                                            <td colspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"></td>
                                                            <td colspan="1" style="text-align: right;">
                                                                <?= $other_details->total_value_currency ?>
                                                            </td>
                                                            <td colspan="2"></td>
                                                        </tr>
                                                    </tfoot> 
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2"><label for="">Ceritified that the particulars given above are true and correct</label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-left"><label for="">Shipper Declaration :</label>
                                        <div>
                                            <?=$other_details->shipper_declaration?>
                                        </div>
                                        </td>

                                            <td colspan="2" style="text-align: left;">
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
    </div>
    <!-- Blog content end -->
    </section><!-- sidebar_dashboard-->
    </div> <!-- sidebar_dashboard-->

</body>

</html>
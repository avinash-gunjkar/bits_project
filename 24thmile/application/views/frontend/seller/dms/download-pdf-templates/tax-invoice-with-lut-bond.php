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
            margin: 50px;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            /* margin-top: 1cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2.5cm; */
        }

        /** Define the header rules **/
        header {
            /* position: fixed;
            top: 1cm;
            left: 2cm;
            right: 0cm;
            height: 2cm; */

            /* Extra personal styles */
            /*background-color: #03a9f4;*/
            /* color: white;
            text-align: left;
            line-height: 1.5cm; */
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0px;
            left: 0;
            right: 0;
            height: 104px;
            max-height: 104px;

            padding:1px;
            /* Extra personal styles */
            /* background-color: #03a9f4; */
            /* color: white; */
            /* text-align: center;
            line-height: 0.5cm; */

        }

        /**{ margin:0px; padding:0px; box-sizing:border-box;}*/
        body {
            font-size: 10px;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            border: 1px solid #000;
            border-bottom: 2px solid white;
            padding-bottom: 110px;
        }

        /*.main { width:90%; margin:50px;}*/
        .table {
            width: 100%;
            /* margin-top: 10px;
            margin-bottom: 10px; */
            /* border-collapse: collapse; */
            border-collapse: separate;
            border-spacing: -1.1px;
            table-layout: fixed;

        }

        .table table {
            border-collapse: collapse;
            width: 100%
        }

        .table tr th,
        .table tr td {
            /* padding: 5px; */
            vertical-align: top;
        }

        .table table tr.border {
            border-bottom: solid 1px #000;
        }

        .table-bordered tr td {
            border: solid 1px #000;
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

        table thead.table-header tr td.heading {
            border-top: 3px solid #fff;
            border-left: 3px solid #fff;
            border-right: 3px solid #fff;
        }

        /* label {
            font-size: 10px;
            font-weight: normal;
        } */

        .capitalize {
            text-transform: uppercase;
            font-weight: bold;
        }

        .prticulars-heading td {
            text-align: center;
            vertical-align: middle !important;
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
        <table class="table table-bordered " style="table-layout: fixed;">
            <tbody>
                <tr>
                    <td colspan="6"></td>
                    <td colspan="6"><label for="">Ceritified that the particulars given above are true and correct</label></td>
                </tr>
                <tr>
                    <td colspan="8" class="text-left"><label for="">Shipper Declaration :</label>
                        <div>
                            <?= $other_details->shipper_declaration ?>
                        </div>
                    </td>

                    <td colspan="4" style="text-align: left;">
                        For <b><?= $documentData->for_consignor_company ?></b>
                        <br><br>
                        <div>

                            <img id="userPhotoPreview" src="<?= $documentData->signature ?>" style="height:50px;width: 150px; object-fit: contain;" />


                            <br> <b><?= $other_details->name_of_authorized_signatory ?></b>
                            <br> <b><?= $other_details->designation ?></b>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </footer>

    <table class="table table-bordered " style="table-layout: fixed;">
        <thead class="table-header">
            <tr>
                <td colspan="12" class="heading">
                    <h3 class="heading3-border text-center">TAX INVOICE</h3>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="text-left"><label>Supplier:</label> <?= $other_details->exporter_company_name ?>

                </td>
                <td colspan="6" class="text-left"><label>Consignee:</label> <?= $other_details->consignee_company_name ?>

                </td>
            </tr>
            <tr>
                <td colspan="6" class="text-left"><label>Supplier Address:</label> <?= $other_details->exporter_address ?>

                </td>
                <td colspan="6" class="text-left"><label>Consignee Address:</label> <?= $other_details->consignee_address ?>

                </td>
            </tr>
            <tr>
                <td colspan="6" class="text-left"><label>Contact Details:</label> <?= $other_details->exporter_contact_number ?>

                </td>
                <td colspan="6" class="text-left"><label>Contact Details:</label> <?= $other_details->consignee_contact_number ?>

                </td>
            </tr>
            <tr>

                <td colspan="6">
                    <label>IEC/PAN/ Aadhar/ Passport No:</label>
                    <span><?= $other_details->iec_no ?></span>
                </td>
                <td colspan="6"><label>GSTIN/UIN:</label>
                    <span><?= $other_details->gst_no ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="3"><label>IGST Payment Status: (Tick applicable option):</label></td>
                <td colspan="2"><label>A)Not Applicable
                        <?php $radioImage = $other_details->igst_payment_status == 'not-applicable' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                        <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                    </label></td>
                <td colspan="3"><label>B) LUT or Export under Bond <?php $radioImage = $other_details->igst_payment_status == 'export-under-bond' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                        <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                    </label></td>
                <td colspan="4"><label>C) Export Against Payment of IGST <?php $radioImage = $other_details->igst_payment_status == 'export-against-payment' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                        <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                    </label></td>
            </tr>
            <tr>
                <td colspan="2" class="text-left">
                    <label>GST Invoice No:</label>
                </td>
                <td colspan="4" class="text-left">
                    <div><?= $other_details->gst_invoice_no ?></div>
                </td>
                <td colspan="3" class="text-left">
                    <label for="">Conversion Rate</label>
                </td>
                <td colspan="3" class="text-left">
                    <?= $other_details->conversion_rate ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-left">
                    <label>Place of Supply:</label>
                </td>
                <td colspan="4" class="text-left">
                    <div><?= $other_details->place_of_supply ?></div>

                </td>
                <td colspan="2" class="text-left">
                    <label>Vehicle number:</label>
                </td>
                <td colspan="4" class="text-left">
                    <div><?= $other_details->vehicle_no ?></div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-left">
                    <label>State Code:</label>
                </td>
                <td colspan="4" class="text-left">
                    <div><?= $other_details->state_code ?></div>
                </td>
                <td colspan="2" class="text-left"><label>Date of Supply:</label></td>
                <td colspan="4" class="text-left">
                    <span><?= printFormatedDate($other_details->date_of_supply) ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="text-center"><label>Notifying Party, if Other than Consignee</label></td>
            </tr>
            <tr>

                <td colspan="2" class="text-left">

                    <label>Supplier:</label>
                </td>
                <td colspan="4" class="text-left">
                    <?= $other_details->notify_party_company_name ?>

                </td>
                <td colspan="2" class="text-left">

                    <label>Consignee:</label>
                </td>
                <td colspan="4" class="text-left">
                    <?= $other_details->buyer_company_name ?>

                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-left">

                    <label>Supplier Address:</label>
                </td>
                <td colspan="4" class="text-left">
                    <?= $other_details->notify_party_address ?>

                </td>
                <td colspan="2" class="text-left">

                    <label>Consignee Address:</label>
                </td>
                <td colspan="4" class="text-left">
                    <?= $other_details->buyer_address ?>

                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-left">
                    <label>Contact Details:</label>

                </td>
                <td colspan="4" class="text-left">
                    <?= $other_details->notify_party_contact_number ?>

                </td>
                <td colspan="2" class="text-left">

                    <label>Contact Details:</label>
                </td>
                <td colspan="4" class="text-left">
                    <?= $other_details->buyer_contact_number ?>
                </td>
            </tr>

            <tr class="prticulars-heading">
                <td rowspan="2" style="width: 5%;">Sr. No.</td>
                <td rowspan="2" colspan="5">Product Description</td>
                <td rowspan="2" style="width:9%">HSN Code</td>
                <td rowspan="2" style="width:6%">Quantity</td>
                <td rowspan="2" style="width: 9%;">Rate per Unit<br>(In INR)</td>
                <td rowspan="2">Total Value (In INR)</td>
                <td colspan="2">IGST</td>
            </tr>
            <tr class="prticulars-heading">
                <td style="width: 6%;">% Rate</td>
                <td>Value in INR</td>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)) { ?>
                <?php $counter = 0;
                foreach ($items as $key => $item) { ?>
                    <tr>
                        <td class="text-right">
                            <?= $counter = $counter + 1; ?>
                        </td>
                        <td colspan="5">
                            <?= $item->description ?>
                        </td>
                        <td style="text-align: center;">
                            <?= $item->hs_code ?>
                        </td>
                        <td style="text-align: right;">
                            <?= number_format($item->qty, 2) ?>
                        </td>
                        <td style="text-align: right;">
                            <?= number_format($item->price, 2) ?>
                        </td>
                        <td style="text-align: right;">
                            <?= number_format($item->total_amount, 0) ?>
                        </td>
                        <td style="text-align: right;">
                            <?= number_format($item->per_rate, 0) ?>
                        </td>
                        <td style="text-align: right;">
                            <?= number_format($item->value_in_inr, 0) ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
        <tfoot>

            <tr>
                <td colspan="7"><label for="">Total</label></td>
                <td style="text-align: right;">
                    <?= $other_details->total_qty_no ?>
                </td>
                <td></td>
                <td style="text-align: right;">
                    <?= number_format($other_details->total_value, 0) ?>
                </td>
                <td></td>
                <td style="text-align: right;">
                    <?= number_format($other_details->total_value_inr, 0) ?>
                </td>

            </tr>
            <tr>
                <td colspan="7"><label for="">Invoice Amount before Tax in Words</label></td>
                <td colspan="2"><label for="">Total Amount before Tax</label></td>
                <td style="text-align: right;">
                    <?= number_format($other_details->total_amt_before_tax, 0) ?>
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="7" rowspan="2">
                    <?= $other_details->total_Amount_InWords ?>
                </td>
                <td colspan="2"><label for="">IGST in INR</label></td>
                <td style="text-align: right;">
                    <?= number_format($other_details->igst_in_inr, 0) ?>
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td style="text-align: right;">
                    <?= number_format($other_details->total_value_currency, 0) ?>
                </td>
                <td colspan="2"></td>
            </tr>
        </tfoot>

    </table>
</body>

</html>
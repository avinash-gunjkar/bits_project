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

        getElementById.footer {
            page-break-before: always;
        }

        /* document.getElementById("footer").style.pageBreakBefore = "always"; */
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
                                <h3 class="heading3-border">Advance Remittance</h3>
                            </center>-->

                            <div class="text-left">Date: <b><?= printFormatedDate($other_details->document_date) ?></b></div><br/>
                            <b><div>To,</div></b>
                            <div>The Branch Manager</div>
                            <div><?= $other_details->name_of_bank ?><br></div>
                            <div><?= $other_details->name_of_branch ?></div>
                            <p>We wish to make an advance payment towards import of Name of Material (Goods / Services) as part of our Raw Material /Capital Goods requirement:
                                <?= $other_details->name_of_material ?>
                            </p>
                            <p>Request you to process the Import remittances / Demand Draft request as per following request: </p>
                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="50%">
                                    <col width="50%">
                                </colgroup>
                                <tbody>

                                    <tr>
                                        <td colspan="1">
                                            <label for="">Name & Address of the Customer:</label>
                                        </td>
                                        <td colspan="1">
                                            <div><?= $other_details->customer_name ?></div>
                                            <div><?= $other_details->customer_address ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Account to be debited</label>
                                        </td>
                                        <td colspan="1"><?= $other_details->account_number_debit ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Account to be debited for charges</label>
                                        </td>
                                        <td colspan="1">
                                            <div>
                                                <label>Account Number: </label>
                                                <?= $other_details->account_number_debit_charges ?>

                                                <label>( ) Net off i.e. On beneficiary.</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Amount and currency to be remitted (figures & words)</label>
                                        </td>
                                        <td colspan="1">
                                            <!-- <div class="input-group mb-3"> -->
                                            <!-- <div class="input-group-prepend"> -->
                                            <?= $documentData->currency ?>
                                            <!-- </div> -->
                                            <?= $other_details->currency_remitted ?>
                                            <!-- </div> -->
                                            <div>
                                                <?= $other_details->amount_in_words ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Beneficiary name and address</label>
                                        </td>
                                        <td colspan="1">
                                            <?= $other_details->company_name ?>
                                            <?= $other_details->company_address1 ?>
                                            <?= $other_details->company_address2 ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Beneficiary Bank name and address</label>
                                        </td>
                                        <td colspan="1">
                                            <?= $other_details->benificiary_bank_name ?>
                                            <?= $other_details->benificiary_bank_address ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Beneficiary Bank Account No.</label>
                                        </td>
                                        <td colspan="1"><?= $other_details->benificiary_account_number ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Swift code / ABA / Routing no / Sort code of Beneficiary bank</label>
                                        </td>
                                        <td colspan="1"><?= $other_details->benificiary_bank_code ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Correspondent / intermediary bank name and address</label>
                                        </td>
                                        <td colspan="1">
                                            <?= $other_details->correspondent_bank_name ?>
                                            <?= $other_details->correspondent_bank_address ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Correspondent Bank Account No.</label>
                                        </td>
                                        <td colspan="1"><?= $other_details->correspondent_account_number ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Swift code / ABA / Routing no / Sort code of Correspondent bank</label>
                                        </td>
                                        <td colspan="1"><?= $other_details->correspondent_bank_code ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Foreign bank charges</label>
                                        </td>
                                        <td colspan="1">
                                            <div> <label>() On US: </label>
                                                <?= $other_details->foreign_bank_charges_onus ?>
                                            </div>
                                            <div>
                                                <label>() On Beneficiary: </label>

                                                <?= $other_details->foreign_bank_charges_onbenif ?>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Mandatory for Advance Import Payment Shipment details</label>
                                        </td>
                                        <td colspan="1">
                                            <div><label>Expected Date of Dispatch / Download (software): </label>
                                                <?= printFormatedDate($other_details->date_of_dispatch) ?>
                                            </div>
                                            <div><label>Name of the shipping company / airlines: </label>
                                                <?= $other_details->foreign_bank_charges_onbenif ?>
                                            </div>
                                            <div><label>Port of Dispatch: </label>
                                                <?= $other_details->port_of_dispatch ?>
                                            </div>
                                            <div><label>Destination Port: </label>
                                                <?= $other_details->destination_port ?>
                                            </div>
                                            <div><label>Country of Origin of goods: </label>
                                                <?= $other_details->country ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td colspan="1">
                                            <label for="">Goods description and HS classification code</label>
                                        </td>
                                        <td colspan="1">
                                            <div class="editable"><label>Description: </label><?= $other_details->goods_description ?>
                                            </div>
                                            <div class="editable"><label>HS Code: </label><?= $other_details->hs_code ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Import License Details (if applicable)</label>
                                        </td>
                                        <td colspan="1">
                                            <div class="editable"><?= $other_details->import_export_code ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Special REF No. to be mentioned in Swift</label>
                                        </td>
                                        <td colspan="1">
                                            <div class="editable"><?= $other_details->special_ref_no ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <label for="">Rate / contract booked with treasury – if any</label>
                                        </td>
                                        <td colspan="1">
                                            <div class="editable"><?= $other_details->rate_with_treasury ?>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <br><br><br>
                            <div class="text-right" id="footer"><label>Customers Signature and Stamp</label></div><br>

                            <div style="page-break-before: always;">We undertake that we shall make physical import within 6 months from the date of remittance (Maximum Period - 3 years in case
                                of Capital goods) and documentary evidence of import (Bill of entry – Exchange control copy or Courier Bill of Entry or CA certificate
                                in case of Non Physical import) will be furnished within 15 days from the date of import. In case of non-import within the above
                                specified period, we shall arrange to repatriate the funds and submit original FIRC to the bank.</div>
                            <br>
                            <div><label><u>CBDT Requirement-</u></label> We hereby confirm to adhere the changes in taxation policy, as per the CBDT notification S.O.2659(E) dated 2nd Sept 2013, enforceable from 1st Oct 2013.</div>
                            <br>
                            <div><label><u>OFAC Declaration-</u></label> I / We hereby declare that the above transaction does not involve, and is not designed for the purpose of any contravention or evasion of the provisions of the OFAC.</div>
                            <br>
                            <div><label><u>FATF Declaration (tick if applicable)-</u></label> We are aware that the above remittance is being made to a FATF listed country and as per prevailing AML guidelines, all due diligence of the beneficiary has been carried out at our end. We indemnify the bank and request that the remittances should be
                                carried out at our risk and responsibility. We shall not hold HDFC Bank responsible if proceeds for the said transaction are held by
                                any foreign regulators or reach beneficiary with delay. If any additional information is sought by foreign regulators or
                                correspondent bank or by any other external or internal authorities, the same will be provided by us to ensure completion of the
                                transaction. Any loss / charges arising out of the said transaction will be borne by us. <div class="pull-right"><?php $checkBoxImage = $other_details->fatf == '1' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                    <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px; ">
                                </div>
                            </div>
                            <br>
                            <div><label><u>FEMA Declaration- CUM - Undertaking</u></label></div>
                            <div>
                                The goods imported by us are (Pls select any one):
                            </div><br>
                            <div>
                                <div>
                                    <?php $radioImage = $other_details->goods_imported == 'not_covered' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                    <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                    Not covered under prohibited or restricted list and are freely importable as per relevant para and Chapters of the extant Foreign Trade Policy and amendments there to.
                                </div>
                                <div>
                                    <?php $radioImage = $other_details->goods_imported == 'restricted' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                    <img src="<?= $radioImage ?>" style="height:10px;width:10px; ">
                                    Restricted for import as per relevant para and Chapters of the extant Foreign Trade Policy and amendments there to and original exchange control copy of the license issued by D.G.F.T. is enclosed.
                                </div><br>
                            </div>
                            <div>
                                We are eligible to import the above mentioned goods under the extant Foreign Trade policy. Our Importer Exporter Code is:
                                <?= $other_details->iec_no ?>
                            </div><br>
                            <div>

                                I / We hereby declare that the above transaction does not involve, and is not designed for the purpose of any contravention or
                                evasion of the provisions of the FEMA 1999 or of any rule, regulation, notification, direction or order made thereunder. I/ We also
                                hereby agree and undertake to give such information/ documents as will reasonably satisfy you about this transaction in terms of
                                the above declaration. I/ We also undertake that if I/ We refuse to comply with any such requirements or make only unsatisfactory
                                compliance therewith, the bank shall refuse in writing to undertake the transaction and shall if it has reason to believe that any
                                contravention /evasion is contemplated by me /us report the matter to Reserve Bank Of India. *I / We further declare that the
                                undersigned has/have the authority to give this declaration and undertaking on behalf of the firm/company.

                            </div><br>
                            <div>
                                <?php $checkBoxImage = $other_details->part_payment == '1' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px;"> Part Payment – We are hereby paying only part amount of Invoice due to <?= $other_details->part_payment_amt ?>
                            </div>
                            
                            <div class="col-lg-12">
                                <hr style="margin: 1.5rem 1rem 0 0;">
                            </div>
                            <br>
                            <div>We further confirm that the above remittance has not been affected through any other Authorized Dealer</div>
                            <div>
                                <u>Documents Attached:</u>
                            </div><br>
                            <div>
                                <?php $checkBoxImage = $other_details->performa_invoice == '1' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px;"> Proforma Invoice (Duly accepted by the importer)
                            </div>
                            <div>
                                <?php $checkBoxImage = $other_details->purchase_order == '1' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px;"> Purchase order
                            </div>
                            <div>
                                <?php $checkBoxImage = $other_details->original_license == '1' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px;"> Original License (Exchange control copy), If applicable
                            </div>
                            <div>
                                <?php $checkBoxImage = $other_details->bank_guarantee == '1' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px;"> Original Bank Guarantee (If amount of advance remittance exceeds USD 200000 or Equivalent)
                            </div>
                            <div>
                                <?php $checkBoxImage = $other_details->other_doc == '1' ? APPPATH . '../assets/frontend/images/checkbox-check-black.png' : APPPATH . '../assets/frontend/images/checkbox-uncheck-black.png' ?>
                                <img src="<?= $checkBoxImage ?>" style="height:10px;width:10px;"> Other documents. Please specify <?= $other_details->other_doc_name ?>
                            </div><br>
                            <div>
                                Yours Faithfully
                            </div>
                            <div>
                                For, <?= $other_details->company_name ?>
                            </div>
                            <br><br>
                            <div>
                                Authorised Signatory
                            </div>
                            <div>
                                (Rubber stamp and authorized signatory name and signature)
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
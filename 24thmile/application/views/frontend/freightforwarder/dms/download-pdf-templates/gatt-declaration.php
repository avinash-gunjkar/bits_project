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
            margin-bottom: 1cm;
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
            height: 0.5cm;

            /* Extra personal styles */
            /* background-color: #03a9f4; */
            /* color: white; */
            text-align: center;
            line-height: 0.15cm;

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



        .particularTbl table,
        .particularTbl th,
        .particularTbl td {
            border: 1px solid #000;
        }

        .particularTbl tbody tr td {
            padding: 10px 5;
            line-height: 10px;
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
        ol li {
            margin-bottom: 5px;
        }
        span.dash-space {
            width: 200px;
            display: inline-block;
            border-bottom: 1px dashed #000;
            padding: 5px;
        }
    </style>
</head>

<body>
    <!-- Tracking start -->
    <div class="wshipping-content-block">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="tracking-block">
                        <div class="tab-content">

                            <!-- <?php
                                    $other_details = $documentData->other_details;
                                    $items = $documentData->items;
                                    ?> -->


                            <center>
                                <h3 class="heading3-border">DECLARATION FORM</h3>
                                <h5 class="heading5-border">(See Rule 10 of Customs Valuation Rules,1988)</h5>
                                <small>
                                    Note : This declaration shall not be required for goods imported as passengers baggage,goods imported for personal use
                                    upto value of Rs.1000/-,Sample of no commercial value,or where the goods are subject to specific rate of duty.
                                </small>
                            </center>
                            <ol>
                                <li>
                                    <div class="row">
                                        <div>Importer's name and Address: <span><?= $other_details->importer_name_address ?></span></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div>Supplier's name and Address: <?= $other_details->supplier_name_address ?></div>

                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div>Name and Address of the Agent,if any: <?= $other_details->supplier_name_address ?></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Description of Goods:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Country of Origin:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Port of Shipment:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">AWB/BL Number and Date:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">IGM Number and date:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Contract Number and Date:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Nature of Payments:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Invoice Number and Date:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Invoice Value:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Terms of Payments:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Currency of Payment:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Exchange rate:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Term of Delivery:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Relationship between buyer and seller [Rule 2, (2)]:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">If related, what is the basis of declared value:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Conditions or Restriction attached with the sale[Rule 4, (2)]:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Valuation Method Applicable [See Rule 4 to 8]:</div>
                                    </div>

                                </li>

                                <li>
                                    <div class="row">
                                        <div class="col-lg-12">Cost and Services not included in the invoice value [Rule 9]:</div>

                                    </div>
                                    <ol type="a">
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Brokerage and Commissions:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Cost of Container:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Packing Cost:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Cost of Goods and services supplied by the buyer:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Royalties and Licence Fees:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Value of proceeds which accrue to seller:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Freight:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Insurance:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Loading, Unloading, Handling Charges:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Landing Charges:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Other payments if any:</div>
                                            </div>
                                        </li>
                                    </ol>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Assessable value in Rs.:</div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-12">Previous import of identical/similar goods,if any:</div>

                                    </div>
                                    <ol type="a">
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Bill of Entry Number and Date:</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">IGM Number and Date:</div>
                                            </div>
                                        </li>
                                    </ol>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            Any other relevant information (Attached separated sheet, if necessary):
                                        </div>
                                    </div>
                                </li>

                            </ol>
                            <div style="page-break-after: always;"></div>
                            <center>
                                <h4 class="heading3-border">DECLARATION</h4>
                            </center>
                            <ol>
                                <li>I / We hereby declare that the information furnished above are true,complete and correct in every suspect.</li>
                                <li>I / WE also undertake to bring to the notice of proper office any particulars which subsequently come to my / our knowledge which will have a bearing on valuation.</li>
                            </ol>

                            <div class="col-lg-12">
                                <div>
                                    <label for="">Place:</label>
                                </div>
                                <div>
                                    <label for="">Date:</label>
                                    <label  style="display:block;text-align: right;">Signature of Importer</label>
                                </div>
                            </div>

                            <center>
                                <h3 class="heading3-border"><u>FOR CUSTOM HOUSE USE</u></h3>
                            </center>

                            <ol>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Bill of Entry Number and Date :</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Valuation Method Applied (See Rule 4 to 8) :</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">If declared value not accepted, brief reasons:</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Reference number and Date of any previous decisions/ruling:</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Value Assessed:</div>
                                    </div>
                                </li>
                            </ol>
                            <div class="col-lg-12">
                                
                                <br>
                                <label style="display:block;text-align: right;">A/O Assistant Commissioner</label>

                            </div>

                            <br>
                            <br>
                            <br>
                            <center>
                                <h3 class="heading3-border">DECLARATION</h3>
                                <h5 class="heading5-border">DECLARATION TO BE SIGNED BY AN IMPORTER CLEARING GOODS WITH THE HELP OF A CUSTOMS HOUSE AGENT</h5>

                            </center>

                            <ol>
                                <li>
                                    I/We declare to the best of my/our knowledge and belief that the contents of invoice (s)
                                    <p>No.(s) <span class="dash-space">&nbsp;</span> dated <span class="dash-space">&nbsp;</span></p>
                                    <p>M/s<span class="dash-space">&nbsp;</span><span class="dash-space">&nbsp;</span></p>
                                    <p>and of other documents relating to the goods covered by the said invoice(s) and presented herewith are true and correct in every respect. </p>
                                </li>
                                <li>
                                    I/We declare that I/We have not received & do not know of any other document or information showing price, value quantity or description of said goods and that if at any time hereafter I/We will immediately make the same know to the controller of customs.
                                </li>
                                <li>I/We declare that goods covered by the bill of entry have been imported on an out-right purchase/consignment account.</li>
                                <li>
                                    I/We am/are not connected with the suppliers/manufacturers as
                                    <ol type="a">
                                        <li>Agent/Distributors/Indenter/Branch Subsidiary Concessionaire and</li>
                                        <li>Collaborator entitled to the use of trade mark, patent or design:</li>
                                        <li>Otherwise than as ordinary importers or buyers:</li>
                                    </ol>
                                </li>
                                <li>I/We declare the method of invoicing has not charged since the date on which my/our books of accounts and/or agreement with the suppliers examined previously by Customs House.</li>
                            </ol>
                            <div class="col-lg-12">
                                N. B. - Strike out whichever is inapplicable.
                            </div>

                            <div>
                                <br>
                                <br>
                                <label style="display:block;text-align: right;">Signature of Importer</label>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>






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
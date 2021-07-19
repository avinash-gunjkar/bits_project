<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>invoice</title>
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
            height: 2.5cm;

            /* Extra personal styles */
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 0.15cm;
            
        }



        /**{ margin:0px; padding:0px; box-sizing:border-box;}*/
        body {
            font-size: 10px;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
        }

        /*.main { width:90%; margin:50px;}*/
        .table {
            width: 100%;
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

        .table table td h1 {
            margin: 10px 0px;
            font-weight: 300;
        }

        .cmtname {
            text-transform: uppercase;
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

        /*.invoice-from p{ margin-bottom:2px;}*/
        .bg {
            background: #dfdfdf;
        }
        /* #particularTbl tbody tr:nth-child(even) {
            background-color: rgba(0,0,0,0.2);
        }
        #particularTbl tbody tr:nth-child(odd) {
            background-color: rgba(0,0,0,0.1);
        } */

        .particularTbl table, .particularTbl th, .particularTbl td {
            border: 1px solid #000;
        }

    .particularTbl tbody tr td {
            padding:10px 5;
            line-height: 10px;
        }
    #bankDetails tbody tr td {
            padding:10px 2;
            line-height: 5px;
        }
        #customerDetails td {
            line-height: 5px;
        }
        #customerDetails  {
            margin: 20px 0;
        }
        #customerDetails p b {
            padding-right:5px;
            display:inline-block;
            width:80px;
        }

        #bankDetails p b {
            margin-right:5px;
        }

        h1{
            font-weight: bold;
        }
    </style>
</head>

<body>

    <footer>
        <div class="text-center" style="background-color: #fff; color:#000;padding-bottom: 5px;">
        <small>This is a system generated invoice, and does not require a signature.</small>
        </div>
        
        <p><strong>• Registered Office •</strong></p>
        <p>TEMGIRE Consultancy Services (P) Limited</p>
        <p>103, Chandrarang Silver, Javalkarnagar, Pimple Gurav, Pune-411061. INDIA</p>
        <p> Phone: +91 77090 65277; Mobile: +91 84592 73468; E-mail: sales@24thmile.com</p>
        
        <p> CIN U74999PN2015PTC156121 </p>

    </footer>

    <div class="table">
        <?php //vdebug($invoice_details)
        ?>
        <table>

            <tr class="border">
                <td colspan="2"><img src="<?= APPPATH . '../assets/frontend/images/logo-for-invoice.jpg' ?>" style="height:40px; "> </td>
                <td colspan="2" class="text-right">
                    <h1><?= strtoupper($invoice_details->inv_type) ?></h1>
                </td>
            </tr>
        </table>
        <table id="customerDetails">
            <tbody>
                <tr style="vertical-align: top;">
                    <td style="width:70%;">
                        <p><b >Customer:</b><span><?= $invoice_details->customer_name ?></span></p>
                        <p><b >Company Name:</b><span><?= $invoice_details->company_name ?></span></p>
                        <p><b >Address:</b><span><?= $invoice_details->address ?></span></p>
                        <p><b >City:</b><span><?= $invoice_details->city_name ?></span></p>
                        <p><b >Pincode:</b><span><?= $invoice_details->pincode ?></span></p>
                        <p><b >Payment Term:</b><span><?=$invoice_details->term?></span></p>
                        <?php if(!empty($invoice_details->proformaLinkedList)){ ?>
                                <p><b >Referance:</b> 
                            <?php foreach($invoice_details->proformaNotLinkedList as $ref){ echo in_array($ref->inv_id , $invoice_details->proformaLinkedList)?"<span style='padding-right:10px;'>$ref->inv_unique_id</span>":'';  }?>
                            </p>
                                <?php }?>
                        <p><b >GSTIN:</b><span><?= $invoice_details->gst_tax_no ?></span></p>
                    </td>
                    <td style="width:30%" >
                        <p><b class="text-left" style="width:60px;display:inline-block;" >Invoice No:</b><span class="text-left"><?= $invoice_details->inv_unique_id ?></span></p>
                        <p><b class="text-left" style="width:60px;display:inline-block;">Date:</b><span class="text-left"> <?= printFormatedDate($invoice_details->invoice_date) ?></span></p>
                        <!-- <p><b style="padding-right:10px;display:inline-block;width:90px;">Term:</b><span><?= $invoice_details->term ?></span></p> -->
                    </td>
                </tr>
            </tbody>
        </table>
        
        
        <table  class="particularTbl">
            <thead>
                <tr class="bg">
                    <th class="text-center" style="width:10%">Sr No.</th>
                    <th class="text-center" style="width:75%">Particular</th>
                    <th class="text-center" style="width:15%">Amount (<?= $invoice_details->transaction_currency ?>)</th>
                </tr>
            </thead>
            <tbody style="line-height:10px;">
                <?php foreach ($invoice_details->billingItems as $key => $item) { ?>
                    <tr class="">
                        <td class="text-center"><?= $key + 1 ?></td>
                        <td class=""><?= $item->particular ?></td>
                        <td class="text-right"><?= number_format($item->amount, 2) ?></td>
                    </tr>

                <?php } ?>
                    
                
            </tbody>
            <tfoot>
            <tr class="border bg">
                    <td class="text-right" colspan="2"><strong>Total </strong></td>
                    <td class="text-right"><strong><?= number_format($invoice_details->total_amount, 2) ?></strong></td>
                </tr>
                <?php if ($invoice_details->tax_type == 'IGST') { ?>
                    <tr class="border bg">
                        <td class="text-right" colspan="2"><strong>IGST: <?= $invoice_details->igst_percent ?>%</strong></td>
                        <td class="text-right"><strong><?= number_format($invoice_details->igst_tax, 2) ?></strong></td>
                    </tr>
                <?php } else { ?>
                    <tr class="border bg">
                        <td class="text-right" colspan="2"><strong>CGST: <?= $invoice_details->cgst_percent ?>%</strong></td>
                        <td class="text-right"><strong><?= number_format($invoice_details->cgst_tax, 2) ?></strong></td>
                    </tr>
                    <tr class="border bg">
                        <td class="text-right" colspan="2"><strong>SGST: <?= $invoice_details->sgst_percent ?>%</strong></td>
                        <td class="text-right"><strong><?= number_format($invoice_details->sgst_tax, 2) ?></strong></td>
                    </tr>
                <?php } ?>
                <tr class="border bg">
                    <td class="text-right" colspan="2">
                        <strong>Grand Total </strong>
                        <p>Amount in words:<?= ucwords(getIndianCurrencyInWords($invoice_details->grand_total)) ?></p>
                    </td>
                    <td class="text-right"><strong><?= number_format($invoice_details->grand_total, 2) ?></strong></td>
                </tr>
            </tfoot>
            
        </table>
        
        <table id="bankDetails">


            <tr >
                <td style="">
                    <p><b>TEMGIRE Consultancy Services (P) Limited</b><p>
                            <p><b>HDFC Bank Ltd</b></p>
                            <p><b>IFSC:</b> HDFC0000900</p>
                            <p><b>IBAN:</b> HDFCINBB</p>
                            <p><b>Account No:</b> 50200033008212</p>
                            <p><b>TAN:</b> PNET10300D</p>
                </td>
                <td style="width:25%">
                    
                <p><b>PAN:</b> AAFCT4541F</p>
                            <p><b>GSTIN:</b> 27AAFCT4541F1ZE</p>
                            <!-- <p><b>SAC Code:</b> 9971</p> -->
                            <p><b>LUT No:</b> AD271019002979R</p>
                            <p><b>MSME No:</b> 547532579593</p>
                </td>
               
            </tr>

           





        </table>
        
        <h4 class="text-center">THANK YOU FOR YOUR BUSINESS!</h4>
        
    </div>


</body>

</html>
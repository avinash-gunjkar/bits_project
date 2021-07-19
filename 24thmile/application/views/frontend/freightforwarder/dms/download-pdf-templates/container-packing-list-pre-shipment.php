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

*{
    box-sizing: border-box;
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
            height: 0.5cm;

            /* Extra personal styles */
            /* background-color: #03a9f4; */
            /* color: white; */
            text-align: center;
            line-height: 0.15cm;

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

       


        h1 {
            font-weight: bold;
        }
        label{
            font-weight: bold;
        }
        table.table.no-border td,table.table.no-border{
        border: none;
    }

    .fix-width-60{
        width: 6%;
        min-width: 6%;
        max-width: 6%;
    }
    .fix-width-80{
        width: 6%;
        min-width: 6%;
        max-width: 6%;
    }
    .fix-width-600{
        width: 45%;
        min-width: 45%;
        max-width: 45%;
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
                       
                    <?php
                        $other_details = $documentData->other_details;
                        $items = $documentData->items;
                    ?>
                    
                        <center>
                            <h3 class="heading3-border">Container Packing List</h3>
                        </center>

                        <table class="table table-bordered" style="table-layout:fixed;">
                            <colgroup>
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td rowspan="2" colspan="2">
                                        <label for="">Exporter</label>
                                        <div style="white-space: pre;"><?=$other_details->exporter?></div>
                                    </td>
                                    
                                <td>
                                        <div><label for="">Export Invoice No.</label>
                                            <span><?=$other_details->invoice_number?></span>
                                        </div>
                                        <div>
                                            <label for="">Export Date</label>
                                            <span><?= printFormatedDate($other_details->invoice_date) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <label for="">Exporter's Ref</label>
                                        <div><label for="">IEC No.</label> <span><?=$other_details->iec_no?></span>
                                        </div>
                                        <div><label for="">PAN No.</label> <span><?=$other_details->pan_no?></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td>
                                        <label for="">Reference</label>
                                        <div><label for="">SO# Number</label> <span><?=$other_details->so_no?></span>
                                        </div>
                                        <div><label for="">SO# Date</label> <span><?=$other_details->so_date?></span>
                                        </div>

                                    </td>
                                    <td>
                                        <label for="">Buyer Reference</label>
                                        <div><label for="">PO# Number</label> <span><?=$other_details->po_no?></span>
                                        </div>
                                        <div><label for="">PO# Date</label> <span><?=$other_details->po_date?></span>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                <td colspan="2">
                                        <label for="">Consignee</label>

                                        <div style="white-space: pre;"><?=$other_details->consignee?></div>

                                    </td>
                                    <td colspan="2">
                                        <label for="">Buyer (If other than Consignee)</label>
                                        <div style="white-space: pre;"><?=$other_details->consignee_other?></div>
                                    </td>
                                </tr>

                                <tr>
                                <td>
                                        <label for="">Pre-Carriage by</label>
                                        <div class="editable"><?=$other_details->pre_carriage?></div>
                                    </td>
                                    <td>
                                        <label for="">Place of Receipt</label>
                                        <div class="editable"><?=$other_details->place_of_receipt?></div>
                                    </td>
                                    <td>
                                        <label for="">Country of Origin</label>
                                        <div class="editable"><?=$other_details->country_o?></div>
                                    </td>
                                    <td>
                                        <label for="">Country of Final Destination</label>
                                        <div class="editable"><?=$other_details->country_d?></div>
                                    </td>
                                </tr>
                                <tr>
                                <td>
                                        <label for="">Vessel / Aircraft/ Voyage No</label>
                                        <div class="editable"><?=$other_details->vessel_aircraft_voyage_no?></div>
                                    </td>
                                    <td>
                                        <label for="">Port of Loading</label>
                                        <div class="editable">
                                            <?=$other_details->port_of_l?>
                                        </div>
                                    </td>

                                    <td rowspan="2" colspan="2"><label for="">Packing Information:</label>
                                        <div class="editable-textarea">
                                            <?=$other_details->packing_info?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Port of Discharge</label>
                                        <div class="editable">
                                            <?=$other_details->port_of_d?>
                                        </div>
                                    </td>
                                    <td>
                                        <label for="">Final Destination</label>
                                        <div class="editable">
                                            <?=$other_details->final_destination?>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4">
                                    <table id="itemstable" class="table items-table" style="table-layout:fixed;">
                                                <thead>
                                                    <tr>
                                                        <th class="fix-width-60">Container Number</th>
                                                        <th class="fix-width-60">Seal Number</th>
                                                        <th class="fix-width-600">Description of Goods</th>
                                                        <th class="fix-width-60">Quantity</th>
                                                        <th class="fix-width-60">Unit of Measure</th>
                                                        <th>No. of Package</th>
                                                        <th>Net Weight (Kg)</th>
                                                        <th>Gross Weight (Kg)</th>
                                                        <th>Measurements (m³)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($items)) { ?>
                                                        <?php foreach ($items as $key => $item) {
                                                            $item = (object)$item; ?>

                                                            <tr>
                                                            <td colspan="5" style="padding: 0; border-collapse: collapse;">
                                                                    <table id="product_<?=$key?>" class="product-table table" style="margin:0;table-layout: fixed;" data-rowid="<?=$key?>">
                                                                        <tbody>
                                                                        <?php if(!empty($item->products)){?>
                                                                        <?php foreach ($item->products as $key2 => $product) {
                                                                             $product = (object)$product; ?>
                                                                            <tr>
                                                                                <td class="fix-width-60"><?= $product->container_no ?></td>
                                                                                <td class="fix-width-60"><?= $product->seal_no ?></td>
                                                                                <td class="fix-width-600"><?= $product->description ?></td>
                                                                                <td class="fix-width-60 text-right"><?= number_format($product->qty,2) ?></td>
                                                                                <td class="fix-width-60">
                                                                                    
                                                                                        <?php foreach (getPackingUnitList() as $unitCode => $unitValue) {
                                                                                          echo  $unitCode == $product->unit ? $unitValue : '';
                                                                                 } ?>
                                                                                   
                                                                                </td>
                                                                            </tr>

                                                                            <?php }?>
                                                                        <?php }?>
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td class="text-right"><?= number_format($item->package_qty,2) ?></td>
                                                                <td class="text-right"><?= number_format($item->net_wt,2) ?></td>
                                                                <td class="text-right"><?= number_format($item->gross_wt,2) ?></td>
                                                                <td class="text-right"><?= number_format($item->measurment,2) ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>

                                                <tfoot>

                                                    <tr>
                                                        <td colspan="2">Total No. of Containers: <span><?= $other_details->totalContainer ?></span></td>
                                                        <td>Consignment Total</td>
                                                        <td class="text-right"><span class="total-qty"><?= $documentData->total_qty ?></span></td>
                                                        <td class="text-right"> </td>
                                                        <td class="text-right"><span class="total_package_qty"><?= $documentData->total_package_qty ?></span></td>
                                                        <td class="text-right"><span class="total_net_wt"><?= $documentData->total_net_wt ?></span></td>
                                                        <td class="text-right"><span class="total_gross_wt"><?= $documentData->total_gross_wt ?></span></td>
                                                        <td class="text-right"><span class="total_measurment"><?= $documentData->total_measurment ?></span></td>

                                                    </tr>

                                                </tfoot>

                                            </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                    <p>Additional Information</p>
                                        <p>Shipping Marks</p>
                                        <p>To: <?=$other_details->shipping_marks_to?></p>
                                        <p>From: <?=$other_details->shipping_marks_from?></p>
                                        <p>Package No. <?=$other_details->shipping_marks_package_no?></p>
                                        <p>Weight: <?=$other_details->shipping_marks_weight?></p>
                                    </td>
                                    <td colspan="2">
                                    <table class="table no-border">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            For <?= $documentData->for_consignor_company ?>
                                                            <br><br>
                                                            <div>
                                                                
                                                                <img id="userPhotoPreview" src="<?= $documentData->signature ?>" style="height:50px;width: 150px; object-fit: contain;" />

                                                                <br><label for="">Signature</label>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td><label for="">Place:</label> <?= $documentData->issue_place ?></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td><label for="">Date:</label> <?= printFormatedDate($documentData->issue_date) ?></td>
                                                        
                                                    </tr>
                                                </tbody>
                                            </table>
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
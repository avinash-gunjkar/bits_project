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
            height: 0.5cm;

            /* Extra personal styles */
            /* background-color: #03a9f4; */
            /* color: white; */
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
        label{
            font-weight: bold;
        }
      
        table.table.no-border td,table.table.no-border{
        border: none;
    } 
    </style>
<!-- Tracking start -->
</head>
<body>
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
                        <h3 class="heading3-border">Declaration of Origin</h3>
                    </center> 

                        <table class="table table-bordered" style="table-layout: fixed;">
                            <colgroup>
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                            </colgroup>
                            <tbody>
                            <tr>
                                    <td rowspan="2" colspan="2">
                                        <label>Exporter</label>
                                        <div  ><?=$other_details->exporter?></div>
                                    </td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td>
                                    <div><label >Export Invoice Number</label>
                                            <div >
                                                <span><?=$other_details->invoice_number?></span>
                                            </div>
                                        </div>
                                        <div><label>Export Date</label>
                                            <div >
                                                <span><?= printFormatedDate($other_details->invoice_date) ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div><label>Letter of Credit Number</label>
                                            <div > <?=$other_details->letter_of_credit_no?> </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <label>Consignee</label>

                                        <div  ><?=$other_details->consignee?></div>

                                    </td>
                                    <td colspan="2">
                                        <label>Buyer (if not Consignee)</label>
                                        <div  ><?=$other_details->buyer?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Method of Dispatch</label>
                                            <div><?=$other_details->method_of_dispatch?> </div>
                                        
                                    </td>
                                    <td>
                                        <label>Type of Shipment</label>
                                         <div><?=$other_details->type_of_shipment?> </div>
                                        
                                    </td>

                                    <td>
                                        <label>Vessel / Aircraft </label>
                                          <div><?=$other_details->vessel_aircraft?> </div>
                                    </td>
                                    <td>
                                        <label>Voyage Number</label>
                                        <div> <?=$other_details->voyage_no?> </div>
                                       
                                    </td>

                                    <!-- <td rowspan="4" colspan="2">
                                    </td> -->
                                </tr>
                               
                                <tr>
                                    <td>
                                        <label>Port of Loading</label>
                                         <div><?=$other_details->port_of_l?> </div>
                                        
                                    </td>
                                    <td><label>Date of Departure</label> 
                                     <?= printFormatedDate($other_details->date_of_departure) ?>
                                    </td> 
                                    <td>
                                        <label>Port of Discharge</label>
                                         <div><?=$other_details->port_of_d?> </div>
                                        
                                    </td>
                                    <td>
                                        <label>Final Destination</label>
                                         <div><?=$other_details->final_destination?></div> 
                                        
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="4">
                                    <table id="itemstable" class="table items-table">
                                            <thead>
                                                <tr>
                                                    <th>Marks & Numbers</th>
                                                    <th>Kind & No of Packages</th>
                                                    <th style="width: 60%;">Description of Goods</th>                                         
                                                    <th>Tarif Code</th>
                                                    <th>Gross Weight (Kg)</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(!empty($items)){?>
                                                <?php foreach ($items as $key=>$tem) { ?>

                                                    <tr>
                                                        <td>
                                                              <?=$tem->marks_and_no?> 
                                                        </td>
                                                        <td> <?=$tem->kind_of_packages?> </td>
                                                        <td> <?=$tem->description?> </td>
                                                        <td> <?=$tem->tarif_code?> </td>
                                                        <td> <?=$tem->gross_wt?> </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            </tbody>
                                            
                                        </table>
                                    </td>
                                </tr>

                                <tr>                
                                    <td rowspan="2"colspan="2"> 
                                  
                                    </td>
                                    
                                    <td colspan="2"><label  style="min-width: 100px;" >Declaration By The Exporter:</label>
                                        <div class="editable-textarea" style="white-space: inline-pre;"><?=$other_details->declaration_by_exporter?></div>
                                    </td>
                                </tr>
                                <tr>
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
 
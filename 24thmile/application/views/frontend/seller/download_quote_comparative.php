
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
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
            /* background-color: #03a9f4;
            color: white; */
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
            font-size: 12px;
            margin-top: 10px;
            margin-bottom: 10px;
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

        .particularTbl table,
        .particularTbl th,
        .particularTbl td {
            border: 1px solid #000;
        }

        .particularTbl tbody tr td {
            padding: 10px 5;
            line-height: 10px;
        }

        #bankDetails tbody tr td {
            padding: 10px 2;
            line-height: 5px;
        }

        #customerDetails td {
            line-height: 5px;
        }

        #customerDetails {
            margin: 20px 0;
        }

        #customerDetails p b {
            padding-right: 5px;
            display: inline-block;
            width: 80px;
        }

        #bankDetails p b {
            margin-right: 5px;
        }

        h1 {
            font-weight: bold;
        }
        label{
            font-weight: bold;
        }
        .multi-packaging table,.table-bordered {
            border-collapse: collapse;
        }
        .multi-packaging table tr td, .multi-packaging table tr th, .table-bordered tr td, .table-bordered tr th{
            border: 1px solid #c8c8c8;
            font-size: 12px;
        }
         
    </style>
    </head>

<body>
<footer>
        <div class="text-center" style="background-color: #fff; color:#000;padding-bottom: 5px;">
        <small>This is a system-generated document and does not require a signature.</small>
        </div>
        

    </footer>
<!-- Tracking start -->
<div class="wshipping-content-block">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                <img src="<?= APPPATH . '../assets/frontend/images/logo-for-invoice.jpg' ?>" style="height:40px; ">
                    <div class="tab-content">
                        <h3 class="heading3-border">Freight Comparative </h3>
                        <div class="row">
                            <div class="shipping-form-block">
                                <?php $transactionCurrencyHtml =  "&nbsp;(" . ($requestDetails->transaction_currency ? $requestDetails->transaction_currency : 'INR') . ")"; ?>
                                

                                    <input type="hidden" name="request_id" value="<?= $requestDetails->request_id ?>" />
                                    <div class="shipping-form">

                                    <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="text-left">
                                                        <address class="mb-1"><label>RFC ID:</label> <?= $requestDetails->request_id ?></address>
                                                        <address class="mb-1"><label>RFC Date : </label>
                                                            <?= printFormatedDate($requestDetails->created_at) ?></address>
                                                        <address class="mb-1"><label>Freight Forwarder : </label>
                                                            <a href="<?= base_url('company-details/' . $ff_details->company_id) ?>" target="_blank"><?= $ff_details->name ?></a>
                                                        </address>
                                                        <address>
                                                            <label>Shipment Status:</label>
                                                            <span class='status badge <?= str_replace(' ', '-', strtolower($requestDetails->status_title)) ?>'><?= $requestDetails->status_title ? $requestDetails->status_title : '- -' ?></span>
                                                            <span class="text-warning"> <?= $requestDetails->status == 4 ? ' - Decision (Accept / Reject) Pending By Freight Forwarder' : '' ?></span>
                                                        </address>
                                                    </td>
                                                    <td class="text-left">
                                                        <address class="mb-1">
                                                            <label>Transaction : </label>
                                                            <?= $requestDetails->transaction ?>
                                                        </address>
                                                        <address class="mb-1">
                                                            <label>Mode : </label>
                                                            <?= $requestDetails->mode ?>
                                                        </address>
                                                        <address class="mb-1">
                                                            <label>Delivery Term :</label>
                                                            <?= $requestDetails->delivery_term_name ?>
                                                        </address>
                                                        <address class="mb-1">
                                                            <label>Shipment Type :</label><?= $requestDetails->shipment ?>
                                                        </address>
                                                    </td>
                                                    <td class="text-left">
                                                        <address class="mb-1">
                                                            <label>Cargo :</label> <?= $requestDetails->container_stuffing ?>
                                                        </address>
                                                        <address class="mb-1">
                                                            <label>Cargo Nature :</label>
                                                            <?= $requestDetails->cargo_status ?>

                                                        </address>
                                                        <?php if (!empty($requestDetails->stuffing)) { ?>
                                                            <address class="mb-1">
                                                                <label><?= ($requestDetails->transaction == "Import") ? "De-stuffing" : "Stuffing" ?> :</label>
                                                                <?= $requestDetails->stuffing ?>
                                                            </address>

                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                        <table class='table'>
                                            <tbody>
                                                <tr><td><h3><b>Consignor/Pick up</b></h3></td><td><h3><b>Consignee/Deliver To</b></h3></td></tr>
                                                <tr>
                                                    <td>
                                                    <div class="form-row mb-1">
                                                            <label>Contact Person Name:</label>
                                                            <?= $requestDetails->consignor_name; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Contact Number:</label>
                                                            <?= $requestDetails->consignor_country_code . ' ' . $requestDetails->consignor_phone; ?>

                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Address:</label> <?= $requestDetails->consignor_address_line_1 . ' ' . $requestDetails->consignor_address_line_2; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>City, State, Country:</label><?= $requestDetails->consignor_city_name; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Pin Code:</label> <?= $requestDetails->consignor_pincode ? $requestDetails->consignor_pincode : ''; ?>
                                                        </div>
                                                        <?php if ($requestDetails->is_other_consignor == "Yes") { ?>
                                                            <h3><b>Seller if other than Consignor</b></h3>
                                                            <div class="form-row mb-1">
                                                                <label>Contact Person Name:</label>
                                                                <?= $requestDetails->consignor_other->name; ?>
                                                            </div>
                                                            <div class="form-row mb-1">
                                                                <label>Contact Number:</label>
                                                                <?= $requestDetails->consignor_other->country_code . ' ' . $requestDetails->consignor_other->phone; ?>

                                                            </div>
                                                            <div class="form-row mb-1">
                                                                <label>Address:</label> <?= $requestDetails->consignor_other->address_line_1 . ' ' . $requestDetails->consignor_other->address_line_2; ?> <br>
                                                            </div>
                                                            <div class="form-row mb-1">
                                                                <label>City, State, Country:</label> <?= $requestDetails->consignor_other->city_name; ?>
                                                            </div>
                                                            <div class="form-row mb-1">
                                                                <label>Pin Code:</label> <?= $requestDetails->consignor_other->pincode ? $requestDetails->consignor_other->pincode : ''; ?>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                    <div class="form-row mb-1">
                                                            <label>Contact Person Name :</label> <?= $requestDetails->consignee_name; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Contact Number :</label> <?= $requestDetails->consignee_country_code . ' ' . $requestDetails->consignee_phone; ?>

                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Address :</label> <?= $requestDetails->consignee_address_line_1 . ' ' . $requestDetails->consignee_address_line_2; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>City, State, Country :</label> <?= $requestDetails->consignee_city_name; ?>
                                                        </div>
                                                        <div class="form-row mb-1">
                                                            <label>Pin Code :</label> <?= $requestDetails->consignee_pincode ? $requestDetails->consignee_pincode : ''; ?>
                                                        </div>
                                                        <?php
                                                        if ($requestDetails->is_other_consignee == "Yes") { ?>
                                                            <h3><b>Buyer if other than Consignee</b></h3>
                                                            <div class="form-row mb-1">
                                                                <label>Contact Person Name:</label>
                                                                <?= $requestDetails->consignee_other->name; ?>
                                                            </div>
                                                            <div class="form-row mb-1">
                                                                <label>Contact Number:</label>
                                                                <?= $requestDetails->consignee_other->country_code . ' ' . $requestDetails->consignee_other->phone; ?>

                                                            </div>
                                                            <div class="form-row mb-1">
                                                                <label>Address:</label> <?= $requestDetails->consignee_other->address_line_1 . ' ' . $requestDetails->consignee_other->address_line_2; ?> <br>
                                                            </div>
                                                            <div class="form-row mb-1">
                                                                <label>City, State, Country:</label> <?= $requestDetails->consignee_other->city_name; ?>
                                                            </div>
                                                            <div class="form-row mb-1">
                                                                <label>Pin Code:</label> <?= $requestDetails->consignee_other->pincode ? $requestDetails->consignee_other->pincode : ''; ?>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>

                                    
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td> 
                                                        <label>Shipment Value: </label><br> <?= $requestDetails->shipment_value_currency . ' ' . $requestDetails->shipment_value; ?>
                                                    </td>
                                                    <td>
                                                    <label>Port of Loading :</label> <br><?= $requestDetails->port_loading_name ?>
                                                    </td>
                                                    <td>
                                                    <label>Port of Discharge :</label><br> <?= $requestDetails->port_discharge_name ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                    <label>Tentative Date of Dispatch :</label><br> <?= printFormatedDate($requestDetails->tentativ_date_dispatch); ?>
                                                    </td>
                                                    <td>
                                                    <label>Offer response on or before :</label><br> <?= printFormatedDate($requestDetails->response_end_date) ?>
                                                    </td>
                                                    <td>
                                                    <label>Expected Payment Term :</label><br> <?= $requestDetails->payment_term ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                    <label>Any Special Consideration for LCL</label>
                                                    <div class="input-comment">
                                                        <?= $requestDetails->special_consideration_lcl; ?>
                                                    </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                            </div>
                        </div>
                        <?php $rfcCategory = $this->freight_model->getRfcChargesCategory($requestDetails, $requestDetails->request_id, 0);
                        $miscellaneousCharges = $this->freight_model->getOtherCharges($requestDetails);; ?>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:250px">RFC Charges (<?= $requestDetails->transaction_currency ? $requestDetails->transaction_currency : 'INR' ?>)</th>
                                        <?php foreach ($ff_list as $key => $ff) {
                                            echo "<th>" . ucwords($ff->company_name) . "</th>";
                                            $footerTotal .= "<td class='text-right'>" . (number_format($ff->total_quote_amount, 2)) . "</td>";
                                            if (!empty($ff->quote_submit_dt)) {
                                                $actionBtn = '<a href="' . base_url('view-quote/' . $ff->request_id . '/' . $ff->company_id) . '" class="text-primary">View Quote</a>';
                                                $actionBtn .= '&nbsp|&nbsp<a href="' . base_url('download-quote/' . $ff->request_id . '/' . $ff->company_id) . '" class="text-primary">Download</a>';
                                                
                                                if(in_array($ff->quote_status,['1','3'])){
                                                    $actionBtn .= "&nbsp|&nbsp<a href='javascript:void(0);' class='text-primary award-shipment-btn'>Award Shipment</a>";
                                                    $actionBtn .= "<form method='post' class='text-left' action='" . base_url('view-quote/' . $ff->request_id . '/' . $ff->company_id) . "' style='display:none;' >
                                                            <div class='col-12 mb-2'>
                                                            <label>Pick-up Date and Time<sup>*</sup></label>
                                                            
                                                            <input type='text' name='pick_up_datetime' autocomplete='off' class='form-control pickup_datetimepicker'  required>
                                                            </div>
                                                            <div class='col-12 mb-2'>
                                                            <label>Any other specific instructions</label>
                                                            <textarea name='shipping_instruction' class='form-control' maxlength='500'></textarea>
                                                            </div>
                                                            <div class='col-12 mb-2'>
                                                            <input type='submit' name='submit' class='btn btn-success btn-md' value='Award & Send Shipment Instruction' />
                                                            </div>
                                                        </form>
                                                    ";
                                                 }
                                            } else {
                                                $actionBtn = '<a href="javascript:void(0);" >Quote Pending</a>';
                                            }
                                            $footerAction .= "<td>$actionBtn</td>";
                                            $footerStatus .= "<td><span class='status badge " . (str_replace(' ', '-', strtolower($ff->quote_status_title))) . "'>$ff->quote_status_title</span></td>";
                                            $quoteList[] = $this->freight_model->getRfcChargesCategory($requestDetails, $requestDetails->request_id, $ff->company_id, true);
                                            $ff_miscellaneousCharges_list[] = $this->freight_model->getOtherChargesValues($requestDetails, $ff->company_id, $requestDetails->shipment_id);
                                            $otherCharges .= "<td>" . ($ff->other_charges_total ? $ff->other_charges_total : '- -') . "</td>";
                                        }
                                        ?>
                                    </tr>

                                </thead>
                                <tbody>


                                    <?php foreach ($rfcCategory as $key_1 => $category) {   ?>
                                        <?php if (!empty($category->subCategory)) {

                                        ?>





                                            <?php

                                            echo "<tr><th class='text-left' style='background-color:#4285f426;color:#000;'>$category->rfc_category_name";


                                            echo "<div class='breakup-details' >";
                                            foreach ($category->subCategory as $subcat) {
                                                echo "<p><small>$subcat->rfcChargesTitle ($subcat->unit)</small></p>";
                                            }
                                            if(in_array($category->id,['1','2','4','5'])){
                                                echo "<p><small>Other</small></p>";
                                            }

                                            echo "</div>";
                                            echo "</th>"; ?>
                                            <?php

                                            foreach ($quoteList as $key_3 => $charges) {
                                                echo "<th class='text-right'> <span class=''>" . number_format($charges[$key_1]->categoryTotal, 2) . "</span>";
                                                echo "<div class='breakup-details' >";
                                                foreach ($charges[$key_1]->subCategory as $key_4 => $subCategory2) {
                                                    echo "<p class='text-right'><small>" . number_format($subCategory2->total, 2) . "</small></p>";
                                                }
                                                $otherChargesCategoryTotal = 0;
                                                foreach ($charges[$key_1]->otherCharges as $key_4 => $otherCharges) {
                                                    $otherChargesCategoryTotal += $otherCharges->total;
                                                    // echo "<tr class='table-light'><td class='text-left'>$otherCharges->title:</td><td class='text-right'> $otherCharges->total</td><tr>";
                                                }
                                                if(in_array($category->id,['1','2','4','5'])){
                                                echo "<p class='text-right'><small>" . number_format($otherChargesCategoryTotal, 2) . "</small></p>";
                                                }
                                                echo "</div>";
                                                echo "</th>";
                                            }
                                            echo "</tr>";

                                            ?>

                                        <?php } ?>
                                    <?php } ?>
                                    <!-- <tr>
                                        <th style='background-color:#4285f426;color:#000;'>Other Charges</th>
                                    </tr>
                                    <tr>
                                        <th>Any Other Charges</th><?= $otherCharges ?>
                                    </tr> -->
                                    <tr>
                                        <th>Total</th><?= $footerTotal ?>
                                    </tr>
                                    <tr>
                                        <th style='background-color:#4285f426;color:#000;'>Riders</th>
                                    </tr>

                                    <?php foreach ($miscellaneousCharges as $key_1 => $otherCharge) {
                                        echo "<tr class='riders-details' ><th class='text-left'>" . str_replace("{mode}", $requestDetails->mode, $otherCharge->other_charge_title) . "</th>";
                                        foreach ($ff_miscellaneousCharges_list as $key_2 => $charges) {
                                            // echo "<td>".$charges[$key_1][$otherCharge->other_charge_id]->value_1."</td>";

                                            if (empty($charges[$otherCharge->other_charge_id]['value_1']) && !in_array($otherCharge->other_charge_id, ['13', '14'])) {
                                                echo "<td>- -</td>";
                                                continue;
                                            }

                                            switch ($otherCharge->other_charge_id) {

                                                case "1":
                                                    echo "<td>", $charges[$otherCharge->other_charge_id]['value_1'], "</td>";
                                                    break;
                                                case "2":
                                                    echo "<td>", printFormatedDate($charges[$otherCharge->other_charge_id]['value_1']), "</td>";
                                                    break;
                                                case "3":
                                                    echo "<td>", printFormatedDate($charges[$otherCharge->other_charge_id]['value_1']), "</td>";
                                                    break;
                                                case "4":
                                                    echo "<td>", printFormatedDate($charges[$otherCharge->other_charge_id]['value_1']), "</td>";
                                                    break;
                                                case "7":
                                                    echo "<td>", $charges[$otherCharge->other_charge_id]['value_1'], ' ', $charges[$otherCharge->other_charge_id]['value_2'], "</td>";
                                                    break;
                                                case "8":
                                                    echo "<td>", $charges[$otherCharge->other_charge_id]['value_1'], ' ', $charges[$otherCharge->other_charge_id]['value_2'], "</td>";
                                                    break;
                                                case "9":
                                                    echo "<td>", $charges[$otherCharge->other_charge_id]['value_1'], ' Days', "</td>";
                                                    break;
                                                case "10":
                                                    echo "<td>", $charges[$otherCharge->other_charge_id]['value_1'], ' Days', "</td>";
                                                    break;
                                                case "11":
                                                    echo "<td>", $charges[$otherCharge->other_charge_id]['value_1'], ' Days', "</td>";
                                                    break;
                                                case "12":
                                                    echo "<td>", number_format($charges[$otherCharge->other_charge_id]['value_1'], 2), "</td>";
                                                    break;
                                                case "13":
                                                    if ($requestDetails->shipment_id == '1') {
                                                        echo "<td>";
                                                        foreach ($charges[$otherCharge->other_charge_id] as $charges_2) {

                                                            echo $charges_2['value_2'], ': ', number_format($charges_2['value_1'], 2), "<br>";
                                                        }
                                                        echo "</td>";
                                                    } else if (!empty($charges[$otherCharge->other_charge_id]['value_1'])) {
                                                        echo "<td>", $charges[$otherCharge->other_charge_id]['value_2'], ': ', number_format($charges[$otherCharge->other_charge_id]['value_1'], 2), "</td>";
                                                    } else {
                                                        echo "<td>- -</td>";
                                                    }

                                                    break;
                                                case "14":
                                                    if ($requestDetails->shipment_id == '1') {
                                                        echo "<td>";
                                                        foreach ($charges[$otherCharge->other_charge_id] as $charges_2) {
                                                            echo $charges_2['value_2'], ': ', number_format($charges_2['value_1'], 2), "<br>";
                                                        }
                                                        echo "</td>";
                                                    } else if (!empty($charges[$otherCharge->other_charge_id]['value_1'])) {
                                                        echo "<td>", $charges[$otherCharge->other_charge_id]['value_2'], ': ', number_format($charges[$otherCharge->other_charge_id]['value_1'], 2), "</td>";
                                                    } else {
                                                        echo "<td>- -</td>";
                                                    }

                                                    break;

                                                case "15":
                                                    $arr_value_1 = explode('|', $charges[$otherCharge->other_charge_id]['value_1']);
                                                    $arr_value_2 = explode('|', $charges[$otherCharge->other_charge_id]['value_2']);
                                                    echo "<td> ", $arr_value_1[0], ' ', $arr_value_1[1], ' = ', $arr_value_2[0], ' ', $arr_value_2[1], "</td>";
                                                    break;
                                                case "16":
                                                    $arr_value_1 = explode('|', $charges[$otherCharge->other_charge_id]['value_1']);
                                                    $arr_value_2 = explode('|', $charges[$otherCharge->other_charge_id]['value_2']);
                                                    echo "<td> ", $arr_value_1[0], ' ', $arr_value_1[1], ' = ', $arr_value_2[0], ' ', $arr_value_2[1], "</td>";
                                                    break;
                                                default:
                                                    echo "<td>", $charges[$otherCharge->other_charge_id]['value_1'], $charges[$otherCharge->other_charge_id]['value_2'], "</td>";
                                            }
                                        }
                                        echo "</tr>";
                                    } ?>
                                   
                                    
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
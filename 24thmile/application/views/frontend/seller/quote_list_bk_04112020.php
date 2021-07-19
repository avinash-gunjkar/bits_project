<style>
    .comment-group {
        border-bottom: none;
        padding: none;
    }

    .comment-img {
        position: initial !important;
    }

    .comment-img img {
        max-width: 80%;
        border-radius: 0%;
    }

    .section-title {
        text-align: left;
        padding-bottom: 0px;
        padding-top: 45px;
    }

    .wshipping-content-block {
        padding: 0px 0px;
    }

    table.table tbody tr th {
        text-align: left;
    }

    @media (min-width: 840px) {
        .mdl-grid {
            padding: 8px;
            width: 100% !important;
        }
    }
</style>
<!-- Tracking start -->
<div class="wshipping-content-block">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                        <h3 class="heading3-border">Freight Comparative </h3>
                        <div class="row">
                            <div class="shipping-form-block">
                                <?php $transactionCurrencyHtml =  "&nbsp;(" . ($requestDetails->transaction_currency ? $requestDetails->transaction_currency : 'INR') . ")"; ?>
                                <form id="frmRequirement" name="frmRequirement" class=""  >

                                <input type="hidden" name="request_id" value="<?= $requestDetails->request_id ?>" />
                                <div class="shipping-form">

                                <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="text-left">
                                                    <address class="mb-1"><label>RFC ID:</label> <?= $requestDetails->request_id ?></address>
                                                    <address class="mb-1"><label>RFC Date : </label>
                                                        <?= printFormatedDate($requestDetails->created_at) ?></address>
                                                    <!-- <address class="mb-1"><label>Freight Forwarder : </label>
                                                        <a href="<?= base_url('company-details/' . $ff_details->company_id) ?>" target="_blank"><?= $ff_details->name ?></a>
                                                    </address> -->
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
                                                            <label><?=($requestDetails->transaction == "Import")?"De-stuffing":"Stuffing"?> :</label>
                                                            <?= $requestDetails->stuffing ?>
                                                        </address>

                                                    <?php } ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        

                                        <div class="row">
                                                    <div class="col-lg-6 rright">
                                                    <div class="edibx">
                                                        <h3><b>Consignor/Pick up</b></h3>
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
                                                            <label>City, State, Country</label><?= $requestDetails->consignor_city_name; ?>
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
                                                                <label>City, State, Country</label> <?= $requestDetails->consignor_other->city_name; ?>
                                                            </div>
                                                            <div class="form-row mb-1">
                                                                <label>Pin Code:</label> <?= $requestDetails->consignor_other->pincode ? $requestDetails->consignor_other->pincode : ''; ?>
                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                    </div>
                                                    <div class="col-lg-6 rright">
                                                    <div class="edibx">
                                                        <h3><b>Consignee/Deliver To</b></h3>
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
                                                            <label>City, State, Country</label> <?= $requestDetails->consignee_city_name; ?>
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
                                                                <label>City, State, Country</label> <?= $requestDetails->consignee_other->city_name; ?>
                                                            </div>
                                                            <div class="form-row mb-1">
                                                                <label>Pin Code:</label> <?= $requestDetails->consignee_other->pincode ? $requestDetails->consignee_other->pincode : ''; ?>
                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                    </div>
                                                </div>

                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <div class="edibx1">
                                                    <label>Shipment Value: </label> <?= $requestDetails->shipment_value_currency . ' ' . $requestDetails->shipment_value; ?>
                                                </div>

                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="edibx1">
                                                    <label>Port of Loading :</label> <?= $requestDetails->loading_port ?>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="edibx1">
                                                    <label>Port of Discharge :</label> <?= $requestDetails->discharge_port ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="edibx1">
                                                <label>Tentative Date of Dispatch :</label> <?= printFormatedDate($requestDetails->tentativ_date_dispatch); ?> </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="edibx1">
                                                <label>Offer response on or before :</label> <?= printFormatedDate($requestDetails->response_end_date) ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="edibx1">
                                                <label>Expected Payment Term :</label> <?= $requestDetails->payment_term ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-12">
                                            <div class="edibx1">
                                                <label>Any Special Consideration for LCL</label>
                                                <div class="input-comment">
                                                    <?= $requestDetails->special_consideration_lcl; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php $rfcCategory = $this->freight_model->getRfcChargesCategory($requestDetails, $requestDetails->request_id, 0);
                        $miscellaneousCharges = $this->freight_model->getOtherCharges($requestDetails);; ?>
                        <!--<form method="post" action="">-->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:250px">RFC Charges (<?= $requestDetails->transaction_currency ? $requestDetails->transaction_currency : 'INR' ?>)</th>
                                        <?php foreach ($ff_list as $key => $ff) {
                                            echo "<th>" . ucwords($ff->company_name) . "</th>";
                                            $footerTotal .= "<td>" . (number_format($ff->total_quote_amount, 2)) . "</td>";
                                            if (!empty($ff->quote_submit_dt)) {
                                                $actionBtn = '<a href="' . base_url('view-quote/' . $ff->request_id . '/' . $ff->company_id) . '" class="text-primary">View Quote</a>';
                                            } else {
                                                $actionBtn = '<a href="javascript:void(0);" >Quote Pending</a>';
                                            }
                                            $footerAction .= "<td>$actionBtn</td>";
                                            $footerStatus .= "<td><span class='status badge " . (str_replace(' ', '-', strtolower($ff->quote_status_title))) . "'>$ff->quote_status_title</span></td>";
                                            $quoteList[] = $this->freight_model->getRfcChargesCategory($requestDetails, $requestDetails->request_id, $ff->company_id, true);
                                            $ff_miscellaneousCharges_list[] = $this->freight_model->getOtherChargesValues($requestDetails, $ff->company_id, $requestDetails->shipment_id);
                                            $otherCharges .= "<td>" . ($ff->other_charges_total ? $ff->other_charges_total : '- -') . "</td>";
                                        } ?>
                                    </tr>

                                </thead>
                                <tbody>


                                    <?php foreach ($rfcCategory as $key_1 => $category) {   ?>
                                        <?php if (!empty($category->subCategory)) {

                                        ?>


                                            <?php echo "<tr><th style='background-color:#4285f426;color:#000;'>$category->rfc_category_name</th></tr>"; ?>
                                            <?php foreach ($category->subCategory as $key_2 => $subCategory) {
                                                echo "<tr><th>$subCategory->rfcChargesTitle (<small>$subCategory->unit</small>)</th> ";
                                                foreach ($quoteList as $key_3 => $charges) {
                                                    echo "<td>" . number_format($charges[$key_1]->subCategory[$key_2]->total, 2) . "</td>";
                                                }
                                                echo "</tr>";
                                            } ?>

                                        <?php } ?>
                                    <?php } ?>
                                    <tr>
                                        <th style='background-color:#4285f426;color:#000;'>Other Charges</th>
                                    </tr>
                                    <tr>
                                        <th>Any Other Charges</th><?= $otherCharges ?>
                                    </tr>
                                    <tr>
                                        <th>Total</th><?= $footerTotal ?>
                                    </tr>
                                    <tr>
                                        <th style='background-color:#4285f426;color:#000;'>Riders</th>
                                    </tr>
                                    <?php foreach ($miscellaneousCharges as $key_1 => $otherCharge) {
                                        echo "<tr><th>" . str_replace("{mode}", $requestDetails->mode, $otherCharge->other_charge_title) . "</th>";
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
                                    <tr>
                                        <th></th><?= $footerStatus ?>
                                    </tr>
                                    <tr>
                                        <th></th><?= $footerAction ?>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                        <div class="col-12 col-lg-12  ">
                            <a href="<?= base_url('fs-request-list'); ?>" class="btn btn-secondary btn-sm">Go Back</a>
                        </div>

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
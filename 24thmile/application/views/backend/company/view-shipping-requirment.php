<style type="text/css">
    .input-field div.error {
        position: relative;
        top: -1rem;
        left: 0rem;
        font-size: 0.8rem;
        color: #FF4081;
        -webkit-transform: translateY(0%);
        -ms-transform: translateY(0%);
        -o-transform: translateY(0%);
        transform: translateY(0%);
    }

    .input-field label.active {
        width: 100%;
    }

    p:empty::before {
        content: '- -';
    }
</style>


<!-- START CONTENT -->
<section id="content">

    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper">
        <!-- Search for small screen -->
        <div class="header-search-wrapper grey hide-on-large-only">
            <i class="mdi-action-search active"></i>
            <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title">Request for Freight Comparative Details</h5>
                    <ol class="breadcrumbs">
                        <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <!-- <li><a href="<?=base_url('admin/company-list');?>">Master</a></li> -->
                        <!-- <li><a href="<?=base_url("admin/view-company-details/$company_id");?>">Company</a></li> -->
                        <!-- <li ><a href="<?=base_url("admin/rfc-list/$company_id");?>">Request for Freight Comparative List</a></li> -->
                        <li class="active">Request for Freight Comparative Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->


    <!--start container-->
    <div class="container">
        <div class="section">
            <!-- <p class="caption">Edit Company</p> -->

            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
                <div class="row">
                    <div class="col s12 m12 l12 ">
                        <div class="card-panel">
                            <h4 class="header2">Shipment Details </h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="text-left">
                                            <address class="mb-1"><label>RFC ID:</label> <?= $requestDetails->request_id ?></address>
                                            <address class="mb-1"><label>RFC Date : </label>
                                                <?= printFormatedDate($requestDetails->created_at) ?></address>
                                            <address class="mb-1"><label>Freight Forwarder : </label>
                                                <?php if (!empty($ff_details->company_id)) { ?>
                                                    <a href="<?= base_url('admin/view-company-details/' . $ff_details->company_id) ?>" target="_blank"><?= $ff_details->name ?></a>
                                                <?php } else { ?>
                                                    <span>- -</span>
                                                <?php } ?>
                                            </address>
                                            <address>
                                                <label>Shipment Status:</label>
                                                <span class='status <?= str_replace(' ', '-', strtolower($requestDetails->status_title)) ?>'><?= $requestDetails->status_title ? $requestDetails->status_title : '- -' ?></span>
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
                        </div>

                        <div class="card-panel">
                            <div class="row">
                                <div class="col l6 rright">
                                    <div class="edibx">
                                        <h4 class="header2"><b>Consignor/Pick up</b></h4>
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
                                            <h4 class="header2"><b>Seller if other than Consignor</b></h4>
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

                                    </div>
                                </div>
                                <div class="col l6 rright">
                                    <div class="edibx">
                                        <h4 class="header2"><b>Consignee/Deliver To</b></h4>
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
                                            <h4 class="header2"><b>Buyer if other than Consignee</b></h4>
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

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-panel">

                            <div class="row">
                                <div class="col l4">
                                    <div class="edibx1">
                                        <label>Shipment Value: </label> <?= $requestDetails->shipment_value_currency . ' ' . $requestDetails->shipment_value; ?>

                                    </div>
                                </div>
                                <div class="col l4">
                                    <div class="edibx1">
                                        <label>Port of Loading :</label> <?= $requestDetails->port_loading_name ?>

                                    </div>
                                </div>
                                <div class="col l4">
                                    <div class="edibx1">
                                        <label>Port of Discharge :</label> <?= $requestDetails->port_discharge_name ?>

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col l4">
                                    <div class="edibx1">
                                        <label>Tentative Date of Dispatch :</label> <?= printFormatedDate($requestDetails->tentativ_date_dispatch); ?>
                                    </div>
                                </div>
                                <div class="col l4">
                                    <div class="edibx1">
                                        <label>Offer response on or before :</label> <?= printFormatedDate($requestDetails->response_end_date) ?>
                                    </div>
                                </div>
                                <div class="col l4">
                                    <div class="edibx1">
                                        <label>Expected Payment Term :</label> <?= $requestDetails->payment_term ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col  l12">
                                    <div class="edibx1">
                                        <label>Any Special Consideration for LCL</label>
                                        <div class="input-comment">
                                            <?= $requestDetails->special_consideration_lcl; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-panel">
                        <?php $this->load->view('backend/company/shipping_container_list', ['requestDetails' => $requestDetails]); ?>
                        <?php $this->load->view('backend/company/shipping_packaging_list', ['requestDetails' => $requestDetails]); ?>

                        </div>

                        <?php if (!empty($rfc_charges)) {
                            $rfc_charge_counter = 0;
                            ?>
                            <div class="card-panel">
                                        <div>
                                        <?php foreach ($rfc_charges as $key => $rfc_charge) { ?>
                                                <?php $sr_no = 1; ?>
                                                <?php if (!empty($rfc_charge->subCategory)) {
                                                    $categoryTotal = 0;
                                                    $otherChargesHeader = 1;
                                                    ?>
                                                    <h3><b><?= $rfc_charge->rfc_category_name ?></b><?= $transactionCurrencyHtml ?></h3>
                                                    <table id="<?="charges_category_$rfc_charge->id"?>" class="table">
                                                        <colgroup>
                                                        <col style="width:50px">
                                                            <col style="width:200px">
                                                            <col style="width:200px">
                                                            <col style="width:100px">
                                                            <col style="width:100px;">
                                                            <col style="width:100px;">
                                                        </colgroup>
                                                        <thead>
                                                            <tr>
                                                            <th>Sr.No.</th>
                                                            <th>Charges Title</th>
                                                            <th>Price Per Unit</th>
                                                            <th>Unit</th>
                                                            <th>Qty</th>
                                                            <th>Total Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($rfc_charge->subCategory as $key2 => $sub_rfc_charge) {
                                                                $categoryTotal +=$sub_rfc_charge->total;  ?>
                                                                <?php if ($sub_rfc_charge->unit == 'Container' && empty($sub_rfc_charge->ffChargesId)) { ?>
                                                                    <?php foreach ($requestDetails->container as $row) { ?>
                                                                        <?php $uniqueRowKey = uniqid(); ?>
                                                                        <tr>
                                                                            <td><?= $sr_no++; ?></td>

                                                                            <td class="text-left"><?= $sub_rfc_charge->rfcChargesTitle . ' ' . $row->container_size_title . ' ' . $row->container_type_name ?> </td>
                                                                            <td>
                                                                                <?= $sub_rfc_charge->charges ?>
                                                                            </td>
                                                                            <td>
                                                                            <?= $sub_rfc_charge->unit ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $sub_rfc_charge->qty ? $sub_rfc_charge->qty : 1 ?> <small><?= $sub_rfc_charge->unit ?></small>
                                                                            </td>
                                                                            <td>
                                                                                <?= $sub_rfc_charge->total ? $sub_rfc_charge->total : 0.00 ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <?php $uniqueRowKey = uniqid(); ?>
                                                                    <tr>
                                                                        <td><?= $sr_no++; ?></td>

                                                                        <td class="text-left"><?= $sub_rfc_charge->rfcChargesTitle ?> <?= $arrContainerType[$sub_rfc_charge->item_id] ? $arrContainerType[$sub_rfc_charge->item_id] : '' ?></td>
                                                                        <td>
                                                                            <?= $sub_rfc_charge->charges ?>
                                                                        </td>
                                                                        <td>
                                                                        <?= $sub_rfc_charge->unit ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= printFloatQuantity($sub_rfc_charge->qty ? $sub_rfc_charge->qty : 1) ?> <small><?= $sub_rfc_charge->unit ?></small>
                                                                        </td>
                                                                        <td>
                                                                            <?= $sub_rfc_charge->total ? $sub_rfc_charge->total : 0.00 ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>

                                                            <?php } //end for
                                                            ?>
                                                           
                                                            <?php foreach ($rfc_other_charges as $key => $other) {
                                                                if($other->category_id == $rfc_charge->id){
                                                                    $categoryTotal +=$other->total;
                                                                    ?>

                                                                    <?php if($otherChargesHeader){ $otherChargesHeader=0; ?>
                                                                        <tr class="other-charges"><th colspan="6" class="text-left">Other Charges</th></tr>
                                                                    <?php } ?>

                                                                     <tr>
                                                                        <td class='otherCharges-counter'></td>
                                                                        <td class="text-left"><?= $other->title ?></td>
                                                                        <td><?= $other->charges ?></td>
                                                                        <td><?= $other->unit ?></td>
                                                                        <td><?= $other->qty ?> <small><?= $other->unit ?></small></td>
                                                                        <td><?= $other->total ?></td>
                                                                    </tr>
                                                                    <?php }
                                                            
                                                            } ?>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="5" class="text-right">Total</th>
                                                                <th><?=number_format($categoryTotal,2,'.',',')?></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                <?php } ?>

                                            <?php } ?>
                                        </div>




                                        <!--start::other charges-->
                                        <div class="col  l12">
                                            <h4 class="header2"><b>Riders</b></h3>
                                            <div class="form-row">
                                                <?php foreach ($other_charges as $charge) { ?>

                                                    <?php if ($charge->other_charge_id == '1') { ?>
                                                        <div class="form-group col m3">

                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                            <div class="input-comment">

                                                                <div>
                                                                    <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] : '- -' ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($charge->other_charge_id == '2') { ?>
                                                        <div class="form-group col m2">
                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                            <div>
                                                                <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? printFormatedDate($other_charges_value_arr[$charge->other_charge_id]['value_1']) : '- -'; ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($charge->other_charge_id == '3' || $charge->other_charge_id == '4') { ?>
                                                        <div class="form-group col m2">
                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                            <div><?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? printFormatedDate($other_charges_value_arr[$charge->other_charge_id]['value_1']) : '- -' ?></div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($charge->other_charge_id == '5' || $charge->other_charge_id == '6') { ?>
                                                        <div class="form-group col m3">
                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                            <div><?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] : '- -' ?></div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($charge->other_charge_id == '7' || $charge->other_charge_id == '8') { ?>
                                                        <div class="form-group col m3">
                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                            <div class="input-group">
                                                                <span><?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] : '- -' ?></span> &nbsp;
                                                                <span><?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] ?> </span>

                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($charge->other_charge_id == '9') { ?>
                                                        <div class="form-group col m2">
                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                            <div>
                                                                <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] . ' Days' : '- -' ?>

                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($charge->other_charge_id == '10') { ?>
                                                        <div class="form-group col m2">
                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                            <div>
                                                                <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] . ' Days' : '- -' ?>

                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($charge->other_charge_id == '11') { ?>
                                                        <?php $uniqueRowKey = uniqid(); ?>
                                                        <div class="form-group col m2">
                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                            <div>
                                                                <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] . ' Days' : '- -' ?>

                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($charge->other_charge_id == '12') { ?>
                                                        <?php $uniqueRowKey = uniqid(); ?>
                                                        <div class="form-group col m2">
                                                            <label><?php echo  $charge->other_charge_title; ?> <?= $transactionCurrencyHtml ?>:</label>
                                                            <div>
                                                                <?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? $other_charges_value_arr[$charge->other_charge_id]['value_1'] : '- -' ?>

                                                            </div>
                                                        </div>
                                                    <?php } ?>



                                                    <!--[start::looping for the container]-->
                                                    <?php if ($charge->other_charge_id == '13') { ?>
                                                        <?php if ($requestDetails->shipment_id == '1') { ?>
                                                            <?php foreach ($requestDetails->container as $key => $row) { ?>
                                                                <div class="form-group col m3">
                                                                    <label><?php echo  $charge->other_charge_title; ?> <span>( <?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] ?>)</span> <?= $transactionCurrencyHtml ?>:</label>
                                                                    <div class="input-group">
                                                                        <!--<span style="padding:5px 2px; background-color:#CCCCCC;"> </span>-->
                                                                        <!--<span> <?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] ?></span>-->
                                                                        <span><?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_1'] ? number_format($other_charges_value_arr[$charge->other_charge_id][$key]['value_1'], 2) : '- -'; ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <div class="form-group col m2">
                                                                <label><?php echo  $charge->other_charge_title; ?> <span>( <?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] ?>)</span> <?= $transactionCurrencyHtml ?>:</label>
                                                                <div class="input-group">

                                                                    <span><?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? number_format($other_charges_value_arr[$charge->other_charge_id]['value_1'], 2) : '- -'; ?></span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>


                                                    <?php } ?>

                                                    <?php if ($charge->other_charge_id == '14') { ?>
                                                        <?php if ($requestDetails->shipment_id == '1') { ?>
                                                            <?php foreach ($requestDetails->container as $key => $row) { ?>
                                                                <div class="form-group col m3">
                                                                    <label><?php echo  $charge->other_charge_title; ?> <span>( <?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] ?>)</span> <?= $transactionCurrencyHtml ?>:</label>
                                                                    <div class="input-group">
                                                                        <!--<span style="padding:5px 2px; background-color:#CCCCCC;"><?= $row->container_size_title . ' ' . $row->container_type_name ?>  Container</span>-->
                                                                        <!--<span><?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_2'] ?></span>-->
                                                                        <span><?= $other_charges_value_arr[$charge->other_charge_id][$key]['value_1'] ? number_format($other_charges_value_arr[$charge->other_charge_id][$key]['value_1'], 2) : '- -'; ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <div class="form-group col m2">
                                                                <label><?php echo  $charge->other_charge_title; ?> <span>( <?= $other_charges_value_arr[$charge->other_charge_id]['value_2'] ?>)</span> <?= $transactionCurrencyHtml ?>:</label>
                                                                <div class="input-group">

                                                                    <span><?= $other_charges_value_arr[$charge->other_charge_id]['value_1'] ? number_format($other_charges_value_arr[$charge->other_charge_id]['value_1'], 2) : '- -'; ?></span>
                                                                </div>
                                                            </div>
                                                        <?php } ?>


                                                    <?php } ?>

                                                    <!--[end::looping for the container]-->


                                                    <?php if ($charge->other_charge_id == '15') { ?>
                                                        <div class="form-group col m4">
                                                            <label><?php echo str_replace("{mode}", $requestDetails->mode, $charge->other_charge_title); ?>:</label>
                                                            <?php
                                                            $arr_value_1 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_1']);
                                                            $arr_value_2 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_2']);
                                                            ?>
                                                            <div class="input-group">
                                                                <?php if (!empty($other_charges_value_arr[$charge->other_charge_id]['value_1']) && !empty($other_charges_value_arr[$charge->other_charge_id]['value_2'])) { ?>
                                                                    <span><?= $arr_value_1[0] ?></span> &nbsp;
                                                                    <span><?= $arr_value_1[1] ?></span>
                                                                    <span class="equal-sign"></span>
                                                                    <span><?= $arr_value_2[0] ?></span> &nbsp;
                                                                    <span><?= $arr_value_2[1] ?></span>
                                                                <?php } else { ?>

                                                                    <span>- -</span>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($charge->other_charge_id == '16') { ?>
                                                        <div class="form-group col m4">
                                                            <label><?php echo  $charge->other_charge_title; ?>:</label>
                                                            <?php
                                                            $arr_value_1 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_1']);
                                                            $arr_value_2 = explode('|', $other_charges_value_arr[$charge->other_charge_id]['value_2']);
                                                            ?>
                                                            <div class="input-group">
                                                                <?php if (!empty($other_charges_value_arr[$charge->other_charge_id]['value_1']) && !empty($other_charges_value_arr[$charge->other_charge_id]['value_2'])) { ?>
                                                                    <span><?= $arr_value_1[0] ?></span>&nbsp;
                                                                    <span><?= $arr_value_1[1] ?></span>
                                                                    <span class="equal-sign"></span>
                                                                    <span><?= $arr_value_2[0] ?></span>&nbsp;
                                                                    <span><?= $arr_value_2[1] ?></span>
                                                                <?php } else { ?>

                                                                    <span>- -</span>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>

                                        </div>
                                        <!--end::other charges-->

                                        <table class="table">
                                            <colgroup>
                                                <col style="width:90%x">
                                                <col style="width:10%">
                                            </colgroup>
                                            <tbody>
                                                <tr>

                                                    <td colspan="4" class="text-right">
                                                        <h4 class="header2">Total Quote Value<?= $transactionCurrencyHtml ?></h4>
                                                    </td>
                                                    <td class="text-right">
                                                        <h4 class="header2"> <?= number_format($requestDetails->total_quote_amount, 2) ?></h4>
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td colspan="4" class="text-right">
                                                        <h4 class="header2">Counter Rate<?= $transactionCurrencyHtml ?></h4>
                                                    </td>
                                                    <td class="text-right">
                                                        <h4 class="header2"><?= number_format($requestDetails->counter_rate, 2) ?></h4>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                    <?php } ?>
                       

                        <div class="card-panel">
                            <div class="row">
                                
                                <div class="col l12 text-center mt-5">
                                                <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-secondary btn-md">Go Back</a>
                                                
                                            </div>
                            </div>


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
</section>
<!-- END CONTENT -->

<!-- //////////////////////////////////////////////////////////////////////////// -->


<script type="text/javascript">
    $('#company_edit_form').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action');
        var FORMDATA = $(this).serialize();
        $.ajax({
                url: action,
                type: 'POST',
                dataType: 'json',
                data: FORMDATA,
            })
            .done(function(respo) {
                Materialize.toast('<span>' + respo.msg + '</span>', 5000);
                window.location.href = "<?php echo base_url('company') ?>";
            })
            .fail(function(respo) {
                console.log("error", respo);
            })
            .always(function(respo) {
                console.log("complete", respo);
            });

    });
</script>
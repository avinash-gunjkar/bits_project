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

    table.table tbody tr td {
        text-align: left;
    }

    @media (min-width: 840px) {
        .mdl-grid {
            padding: 8px;
            width: 100% !important;
        }
    }

    .breakup-details p {
        margin: 0;
    }

    label {
        font-weight: bold;
        margin: 0 10px 0 0;
    }

    div.editable {
        display: inline-block;
        padding: 2px 0;
    }



    div.editable-textarea {
        display: block;
    }

    div.editable-block {
        width: 100%;

    }

    div.editable-block input {
        width: 100%;
    }

    div.editable-textarea textarea {
        /* border: none;*/
        resize: none;
        width: 100%;
        height: auto;
    }

    table.table.items-table tr td {
        padding: 0;
    }

    table.table.items-table tr td input,
    table.table.items-table tr td select {
        border: none;
        width: 100%;
        padding: 0 5px;
        height: 25px;
    }

    input.decimal-numbers,
    span.total-qty,
    span.final-total {
        text-align: right;
    }

    span.total-qty,
    span.final-total {
        padding: 0 5px;
    }

    table.table.items-table tr td {
        position: relative;
    }

    .product-table tfoot td {
        padding: 0 15px;
    }

    /* table.table.items-table tr a.delete-row-btn {
        display: none;
    }



    table.table.items-table tr:hover a.delete-row-btn {
        position: absolute;
        display: block;
        right: -25px;
        top: 0;
        z-index: 9;
    } */

    /* table.product-table tr a.delete-product-row-btn {
        display: none;
    }

    table.product-table tr:hover a.delete-product-row-btn {
        position: absolute;
        display: block;
        right: -25px;
        top: 0;
        z-index: 9;
    } */

    table.table.no-border td,
    table.table.no-border {
        border: none;
    }

    .fix-width-60 {
        width: 60px;
        min-width: 60px;
        max-width: 60px;
    }

    .fix-width-80 {
        width: 80px;
        min-width: 80px;
        max-width: 80px;
    }

    .fix-width-600 {
        width: 500px;
        min-width: 500px;
        max-width: 500px;
    }

    table {
        counter-reset: srno;
    }

    table tr td.sr-no::before {
        counter-increment: srno;
        content: counter(srno);
    }

    #containerList .container {
        background: #ddd;
        margin: 15px 0;
        padding: 15px 15px;
    }

    .package {
        background: ghostwhite;
        margin: 10px 0;
        padding: 15px 15px;
    }

    ul.package-list {
        font-size: inherit;
        list-style: none;
        padding: 0;
    }

    body.dragging,
    body.dragging * {
        cursor: move !important;
    }

    .dragged {
        position: absolute;
        opacity: 0.5;
        z-index: 2000;
    }

    ul.package-list li.placeholder {
        position: relative;
        /** More li styles **/
    }

    ul.package-list li.placeholder:before {
        position: absolute;
        /** Define arrowhead **/

        content: "";
        width: 0;
        height: 0;
        margin-top: -5px;
        left: -5px;
        top: -4px;
        border: 5px solid transparent;
        border-left-color: red;
        border-right: none;
    }
</style>
<div class="wshipping-content-block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">

                        <center>
                            <h3 class="heading3-border">Shipment Documents Form</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="request_id" value="<?= $requestDetails->request_id ?>">
                            <table class="table no-border">
                                <colgroup>
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                </colgroup>
                                <tbody>
                                    <tr class="reset-lable-counter">
                                        <td colspan="4">
                                            <div class="container">
                                                <div class="row">


                                                    <div class="col-lg-3 px-0">
                                                        <div class="radio">
                                                            <label class="mr-3">Transaction :<sup>* </sup></label>

                                                            <label class="mr-3 ml-3"><input type="radio" aria-describedby="transaction-error" name="transaction" id="transaction_export" value="Export" <?= $requestDetails->transaction == "Export" ? 'checked' : ''; ?> <?= $requestDetails ? ' disabled ' : '' ?>> Export</label>&nbsp;
                                                            <label class="mr-3 ml-3"><input type="radio" aria-describedby="transaction-error" name="transaction" id="transaction_import" value="Import" <?= $requestDetails->transaction == "Import" ? 'checked' : ''; ?> <?= $requestDetails ? ' disabled ' : '' ?>> Import</label>&nbsp;
                                                            <span id="transaction-error" class="error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 px-0">
                                                        <div class="radio">
                                                            <label class="mr-3">Mode :<sup>* </sup></label>
                                                            <?php foreach ($modes as $mode) { ?>
                                                                <label class="mr-3 ml-3"><input type="radio" name="mode" aria-describedby="mode-error" class="mode" value="<?php echo $mode['id']; ?>" <?= $requestDetails->mode_id == $mode['id'] ? 'checked' : ''; ?> <?= $requestDetails ? ' disabled ' : '' ?>> <?php echo $mode['type']; ?></label>&nbsp;
                                                            <?php } ?>
                                                            <span id="mode-error" class="error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 px-0">
                                                        <div class="radio">
                                                            <label class="mr-3">Shipment Type :<sup>* </sup></label>
                                                            <?php foreach ($shipments as $shipment) { ?>
                                                                <label class="mr-3 ml-3"><input type="radio" name="shipment" aria-describedby="shipment-error" class="shipment" value="<?php echo $shipment['id']; ?>" <?= $requestDetails ? ' disabled ' : '' ?> <?= ($shipment['id'] == '1' && in_array($requestDetails->mode_id, ['1', '2'])) ? 'disabled="true"' : '' ?> <?= $requestDetails->shipment_id == $shipment['id'] ? 'checked' : ''; ?>> <?php echo $shipment['type']; ?></label>&nbsp;
                                                            <?php } ?>
                                                            <span id="shipment-error" class="error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 px-0">
                                                        <div class="radio">
                                                            <label class="mr-3">Payment Under:</label>

                                                            <label class="mr-3 ml-3"><input type="radio" name="shipment_under_payment" <?= $requestDetails ? ' disabled ' : '' ?> value="LUT BOND" <?= strcasecmp($requestDetails->shipment_under_payment, "LUT BOND") == 0 ? 'checked' : ''; ?>> LUT BOND</label>&nbsp;
                                                            <label class="mr-3 ml-3"><input type="radio" name="shipment_under_payment" <?= $requestDetails ? ' disabled ' : '' ?> value="IGST" <?= strcasecmp($requestDetails->shipment_under_payment, "IGST") == 0 ? 'checked' : ''; ?>> IGST</label>&nbsp;
                                                            <span id="shipment_under_payment-error" class="error"></span>

                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <h3>I] Pre-Shipment Document Details</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="sr-no" style="min-width: 100px;">Custom Invoice Number :</label>
                                            <input type="text" id="custom_invoice_number" name="other_details[invoice_number]" class="form-control requiredClass" placeholder="Invoice number" value="<?= htmlspecialchars($other_details->invoice_number) ?>">

                                        </td>
                                        <td>
                                            <label class="sr-no" style="min-width: 100px;">Date :</label>
                                            <input type="text" name="other_details[invoice_date]" id="invoice_date" class="date-picker form-control " placeholder="DD-MMM-YYYY" value="<?= printFormatedDate(date('Y-m-d')) ?>">

                                        </td>
                                        <td>
                                            <div>
                                                <label class="sr-no"> Buyer Reference / Purchase Order Number :</label>
                                                <div class=""><input type="text" class="form-control requiredClass" name="other_details[po_number]" id="#po_number" value="<?= htmlspecialchars($po_number) ?>"></div>
                                            </div>

                                        </td>
                                        <td>
                                            <div><label class="sr-no" style="min-width: 100px;">Date (if any):</label>
                                                <div><input type="text" class="form-control date-picker" name="other_details[po_date]" id="#po_date" value="<?= printFormatedDate($po_date) ?>"></div>
                                            </div>
                                        </td>

                                        <!-- <td>
                                            <label> Exporter's Referance : </label>
                                            <label style="min-width: 100px;">IEC No.</label>
                                                    <input type="text" class="form-control requiredClass" name="iec_no" id="#ice_no" value="<?= $iec_no ?>">
                                               
                                        </td>
                                        <td>
                                        <label style="min-width: 100px;">AD Code.</label>
                                                    <input type="text" class="form-control requiredClass" name="ad_code" id="#ad_code" value="<?= $ad_code ?>">
                                        </td> -->
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="sr-no">Exporter or Shipper : </label>
                                            <input type="text" name="other_details[exporter_company_name]" value="<?=htmlspecialchars($other_details->exporter_company_name)?>" class="form-control requiredClass " title="Company Name" placeholder="Company Name" >
                                            <input type="text" name="other_details[exporter_address_line_1]" value="<?=htmlspecialchars($other_details->exporter_address_line_1)?>" class="form-control requiredClass " title="Address line 1" placeholder="Address line 1" >
                                            <input type="text" name="other_details[exporter_address_line_2]" value="<?=htmlspecialchars($other_details->exporter_address_line_2)?>" class="form-control requiredClass " title="Address line 2" placeholder="Address line 2" >
                                            <input type="text" name="other_details[exporter_city]" value="<?=htmlspecialchars($other_details->exporter_city)?>" class="form-control requiredClass " title="City, State, Country" placeholder="City, State, Country" >
                                            <input type="text" name="other_details[exporter_pincode]" value="<?=htmlspecialchars($other_details->exporter_pincode)?>" class="form-control requiredClass " title="Pincode" placeholder="Pincode" >
                                            <input type="text" name="other_details[exporter_person_name]" value="<?=htmlspecialchars($other_details->exporter_person_name)?>" class="form-control " title="Contact Person Name" placeholder="Contact Person Name" >
                                            <input type="text" name="other_details[exporter_contact_number]" value="<?=htmlspecialchars($other_details->exporter_contact_number)?>" class="form-control " title="Contact Number" placeholder="Contact Number" >
                                            <!-- <textarea name="other_details[exporter]" class="form-control requiredClass wysihtml5-editor-no-controlls" placeholder="Enter company name,address,contact person details" rows="5"><?= $requestDetails ? "<b></b><br><br> Pincode:<br>Contact Person Name: <br>Contact Number: " : '' ?></textarea> -->
                                        </td>
                                        <td>
                                            <label class="sr-no">Consignee :</label>
                                            <input type="text" name="other_details[consignee_company_name]" value="<?=htmlspecialchars($other_details->consignee_company_name)?>" class="form-control requiredClass " title="Company Name" placeholder="Company Name" >
                                            <input type="text" name="other_details[consignee_address_line_1]" value="<?=htmlspecialchars($other_details->consignee_address_line_1)?>" class="form-control requiredClass " title="Address line 1" placeholder="Address line 1" >
                                            <input type="text" name="other_details[consignee_address_line_2]" value="<?=htmlspecialchars($other_details->consignee_address_line_2)?>" class="form-control requiredClass " title="Address line 2" placeholder="Address line 2" >
                                            <input type="text" name="other_details[consignee_city]" value="<?=htmlspecialchars($other_details->consignee_city)?>" class="form-control requiredClass " title="City, State, Country" placeholder="City, State, Country" >
                                            <input type="text" name="other_details[consignee_pincode]" value="<?=htmlspecialchars($other_details->consignee_pincode)?>" class="form-control requiredClass " title="Pincode" placeholder="Pincode" >
                                            <input type="text" name="other_details[consignee_person_name]" value="<?=htmlspecialchars($other_details->consignee_person_name)?>" class="form-control " title="Contact Person Name" placeholder="Contact Person Name" >
                                            <input type="text" name="other_details[consignee_contact_number]" value="<?=htmlspecialchars($other_details->consignee_contact_number)?>" class="form-control " title="Contact Number" placeholder="Contact Number" >
                                           
                                            <!-- <textarea name="other_details[consignee]" class="form-control requiredClass wysihtml5-editor-no-controlls" placeholder="Enter company name,address,contact person details" rows="5"><?= $requestDetails ? "<b>$requestDetails->consignee_company_name</b><br>$requestDetails->consignee_address_line_1 $requestDetails->consignee_address_line_2<br>$requestDetails->consignee_city_name Pincode:$requestDetails->consignee_pincode<br>Contact Person Name: $requestDetails->consignee_name<br>Contact Number: $requestDetails->consignee_phone" : '' ?></textarea> -->
                                        </td>
                                        <td>
                                            <label class="sr-no">Buyer (if other than Consignee) :</label>
                                            <input type="text" name="other_details[buyer_company_name]" value="<?=htmlspecialchars($other_details->buyer_company_name)?>" class="form-control " title="Company Name" placeholder="Company Name" >
                                            <input type="text" name="other_details[buyer_address_line_1]" value="<?=htmlspecialchars($other_details->buyer_address_line_1)?>" class="form-control " title="Address line 1" placeholder="Address line 1" >
                                            <input type="text" name="other_details[buyer_address_line_2]" value="<?=htmlspecialchars($other_details->buyer_address_line_2)?>" class="form-control " title="Address line 2" placeholder="Address line 2" >
                                            <input type="text" name="other_details[buyer_city]" value="<?=htmlspecialchars($other_details->buyer_city)?>" class="form-control " title="City, State, Country" placeholder="City, State, Country" >
                                            <input type="text" name="other_details[buyer_pincode]" value="<?=htmlspecialchars($other_details->buyer_pincode)?>" class="form-control " title="Pincode" placeholder="Pincode" >
                                            <input type="text" name="other_details[buyer_person_name]" value="<?=htmlspecialchars($other_details->buyer_person_name)?>" class="form-control " title="Contact Person Name" placeholder="Contact Person Name" >
                                            <input type="text" name="other_details[buyer_contact_number]" value="<?=htmlspecialchars($other_details->buyer_contact_number)?>" class="form-control " title="Contact Number" placeholder="Contact Number" >
                                           
                                           
                                            <!-- <textarea name="other_details[buyer]" class="form-control requiredClass wysihtml5-editor-no-controlls" placeholder="Enter company name,address,contact person details" rows="5"><?= $requestDetails ? "<b>$otherConsignee->company_name</b><br>$otherConsignee->address_line_1 $otherConsignee->address_line_2<br>$otherConsignee->city_name Pincode:$otherConsignee->pincode<br>Contact Person: $otherConsignee->name<br>Contact Number: $otherConsignee->phone" : '' ?></textarea> -->
                                        </td>
                                        <td>
                                            <label class="sr-no">Other Reference/Notify Party (if any) : </label>
                                            <input type="text" name="other_details[notify_party_company_name]" value="<?=htmlspecialchars($other_details->notify_party_company_name)?>" class="form-control " title="Company Name" placeholder="Company Name" >
                                            <input type="text" name="other_details[notify_party_address_line_1]" value="<?=htmlspecialchars($other_details->notify_party_address_line_1)?>" class="form-control " title="Address line 1" placeholder="Address line 1" >
                                            <input type="text" name="other_details[notify_party_address_line_2]" value="<?=htmlspecialchars($other_details->notify_party_address_line_2)?>" class="form-control " title="Address line 2" placeholder="Address line 2" >
                                            <input type="text" name="other_details[notify_party_city]" value="<?=htmlspecialchars($other_details->notify_party_city)?>" class="form-control " title="City, State, Country" placeholder="City, State, Country" >
                                            <input type="text" name="other_details[notify_party_pincode]" value="<?=htmlspecialchars($other_details->notify_party_pincode)?>" class="form-control " title="Pincode" placeholder="Pincode" >
                                            <input type="text" name="other_details[notify_party_person_name]" value="<?=htmlspecialchars($other_details->notify_party_person_name)?>" class="form-control " title="Contact Person Name" placeholder="Contact Person Name" >
                                            <input type="text" name="other_details[notify_party_contact_number]" value="<?=htmlspecialchars($other_details->notify_party_contact_number)?>" class="form-control " title="Contact Number" placeholder="Contact Number" >
                                           
                                            <!-- <textarea name="other_details[notify_party]" class="form-control requiredClass wysihtml5-editor-no-controlls" placeholder="Enter company name,address,contact person details" rows="5"></textarea> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="sr-no"> Country of Origin :</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[country_of_origin]" value="<?= htmlspecialchars($country_origin->countryName) ?>">
                                        </td>

                                        <td>
                                            <label class="sr-no"> Country of Final Destination :</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[country_of_final_destination]" value="<?= htmlspecialchars($country_detination->countryName) ?>">
                                        </td>

                                        <td>
                                            <label class="sr-no"> Port of Loading :</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[port_of_l]" value="<?= htmlspecialchars($requestDetails->port_loading_name) ?>">
                                        </td>

                                        <td>
                                            <label class="sr-no"> Port of Discharge :</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[port_of_d]" value="<?= htmlspecialchars($requestDetails->port_discharge_name) ?>">
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="sr-no"> Place of Receipt :</label>
                                            <input type="text" class="form-control requiredClass" name="other_details[place_of_receipt]" value="<?= htmlspecialchars($requestDetails->consignor_city_name) ?>">
                                        </td>

                                        <td>
                                            <label class="sr-no"> Final Destination :</label>

                                            <input type="text" class="form-control requiredClass" name="other_details[final_destination]" value="<?= htmlspecialchars($requestDetails->consignee_city_name) ?>">
                                        </td>

                                        <td>
                                            <label class="sr-no"> Pre-Carriage by : </label>
                                            <select class="form-control " name="other_details[pre_carriage_by]">

                                                <?php foreach (getPrecarriageByList() as $carriage) { ?>
                                                    <option value="<?= $carriage ?>"><?= $carriage ?></option>
                                                <?php } ?>
                                            </select>

                                        </td>


                                    </tr>

                                    <tr>
                                        <!-- <td >
                                            <label>Carrier:</label>
                                            <textarea name="carrier"  class="form-control requiredClass wysihtml5-editor-no-controlls" placeholder="Enter company name,address,contact person details" rows="5"><?= $requestDetails ? "<b>$forwarder->company_name</b><br>$forwarder->address_line_1 $forwarder->address_line_2<br>$forwarder->city_name Pincode:$forwarder->pincode<br>Contact Person: $forwarder->name<br>Email: $forwarder->email Phone: $forwarder->phone" : '' ?></textarea>
                                        </td> -->
                                        <td colspan="2">
                                            <label class="sr-no"> Terms / Method of Payment :</label>
                                            <textarea name="other_details[terms_method_of_payment]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="5"><?= "<b>Delivery Term:$requestDetails->delivery_term_name</b><br><b>Payment Term:</b>$requestDetails->payment_term <br>Letter Of Credit No & date" ?></textarea>
                                        </td>

                                        <td>
                                            <label class="sr-no"> Signature :</label>
                                            <img id="userPhotoPreview" src="<?= $documentData->signature ?>" style="height:50px;width: 150px; object-fit: contain;" />
                                            <div class="text-center mt-3">
                                                <div class="fileUpload btn btn-secondary">
                                                    <span>Select Signature</span>
                                                    <input type="file" class="upload preview" name="signature" data-previewTarget="#userPhotoPreview" id="profile_pic">
                                                    <!-- <label class="custom-file-label" for="profile_pic">Slect Sign</label> -->
                                                </div>
                                                <input id="clearSelectionBtn" type="button" class="btn btn-secondary btn-sm" value="Clear the Selection" style="display:none;">
                                            </div>
                                            <!-- <input type="text" class="form-control" name="" value="<?= $name_of_authorized_signatory ?>"> -->
                                        </td>
                                        <td>
                                            <label class="sr-no"> Name of Authorized Signatory :</label>
                                            <input type="text" class="form-control" name="other_details[name_of_authorized_signatory]" value="<?= htmlspecialchars($name_of_authorized_signatory) ?>">
                                            <label class="sr-no"> Designation :</label>
                                            <input type="text" class="form-control" name="other_details[designation]" value="<?= htmlspecialchars($designation) ?>">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                        <hr>
                                        <div class="row">
                                <div class="col-lg-12">
                                    <div id="containerList">
                                        <?php if (!empty($items)) { ?>
                                            <?php foreach ($items as $container_uid => $container) { ?>


                                                <div class="container" id="<?= $container_uid ?>">
                                                    <div><label>Container Number:</label><input type="text" name="items[<?= $container_uid ?>][container_number]" value="<?= htmlspecialchars($container->container_number) ?>">
                                                        <span class="pull-right">
                                                            <!-- <a href="javascript:void(0);" title="Move Package" class="text-secondary"><i class="fa fa-arrows-alt fa-lg"></i></a> -->
                                                            <!-- <a href="javascript:void(0);" title="Copy Package" class="text-secondary"><i class="fa fa-clone fa-lg"></i></a> -->
                                                            <a href="javascript:void(0);" title="Remove Container" class="text-secondary remove-container"><i class="fa fa-trash fa-lg"></i></a>
                                                        </span>
                                                    </div>
                                                    <ul class="package-list">
                                                        <?php if (!empty($container->packages)) { ?>
                                                            <?php foreach ($container->packages as $package_uid => $package) { ?>
                                                                <li class="package" id="<?= $package_uid ?>">
                                                                    <div class="package-details">
                                                                        <label>Package <input type="text" class="package-number" name="items[<?= $container_uid ?>][packages][<?= $package_uid ?>][package_number]" readonly></label>
                                                                        <label>Packing Type</label>
                                                                        <select name="items[<?= $container_uid ?>][packages][<?= $package_uid ?>][packing_type]">
                                                                            <?php foreach (getPackingTypeList() as $key => $packingType) {
                                                                                $packingType = (object)$packingType;
                                                                                 ?>
                                                                                <option value="<?= $packingType->type ?>" <?= $packingType->type == $package->packing_type ? ' selected ' : '' ?>><?= $packingType->type ?></option>
                                                                            <?php } ?>


                                                                        </select>
                                                                        <label>Net Weight (kg):</label><input type="text" class="net_wt" name="items[<?= $container_uid ?>][packages][<?= $package_uid ?>][net_wt]" value="<?= htmlspecialchars($package->net_wt) ?>">
                                                                        <label>Gross Weight (kg):</label><input type="text" class="gross_wt" name="items[<?= $container_uid ?>][packages][<?= $package_uid ?>][gross_wt]" value="<?= htmlspecialchars($package->gross_wt) ?>">
                                                                        <label>Dimension (L x W x H) Centimeter:</label><input type="text" name="items[<?= $container_uid ?>][packages][<?= $package_uid ?>][dimension]" placeholder="L x W x H" value="<?= htmlspecialchars($package->dimension) ?>">
                                                                        <span class="pull-right">
                                                                            <a href="javascript:void(0);" title="Move" class="text-secondary"><i class="fa fa-arrows-alt fa-lg"></i></a>
                                                                            <!-- <a href="javascript:void(0);" title="Copy" class="text-secondary clone-package"><i class="fa fa-clone fa-lg"></i></a> -->
                                                                            <a href="javascript:void(0);" title="Remove Package" class="text-secondary remove-package"><i class="fa fa-trash fa-lg"></i></a>
                                                                        </span>
                                                                    </div>
                                                                    <div class="product-list">
                                                                        <table id="products_<?= $package_uid ?>" class="product-table table">
                                                                            <thead>
                                                                                <th class="fix-width-60">Sr.No.</th>
                                                                                <th class="fix-width-600">Description of Goods</th>
                                                                                <th class="fix-width-60">Quantity</th>
                                                                                <th class="fix-width-80">Unit of Measure</th>
                                                                                <th class="fix-width-60"></th>

                                                                            </thead>
                                                                            <tbody>
                                                                                <?php if (!empty($package->products)) { ?>
                                                                                    <?php foreach ($package->products as $product_uid => $product) { ?>
                                                                                        <tr id="<?= $product_uid ?>">
                                                                                            <td class="fix-width-60 sr-no"></td>
                                                                                            <!-- <td class="fix-width-600"><textarea class="form-control requiredClass" name="name[{container_uid}][packages][{package_uid}]products[{product_uid}][description]" id="description_{product_uid}" rows="5" ></textarea></td> -->
                                                                                            <td class="fix-width-600"><input type="text" class="form-control requiredClass" name="items[<?= $container_uid ?>][packages][<?= $package_uid ?>][products][<?= $product_uid ?>][description]" id="description_<?= $product_uid ?>" value="<?= htmlspecialchars($product->description) ?>"></td>
                                                                                            <td class="fix-width-60"><input type="text" class="decimal-numbers qty form-control requiredClass" maxlength="12" name="items[<?= $container_uid ?>][packages][<?= $package_uid ?>][products][<?= $product_uid ?>][qty]" placeholder="0.00" value="<?= htmlspecialchars($product->qty) ?>"></td>
                                                                                            <td class="fix-width-80">
                                                                                                <select name="items[<?= $container_uid ?>][packages][<?= $package_uid ?>][products][<?= $product_uid ?>][unit]">
                                                                                                    <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                                                                                                        <option value="<?= $unitCode ?>" <?= $unitCode == $product->unit ? ' selected ' : '' ?>><?= $unitValue ?></option>
                                                                                                    <?php } ?>
                                                                                                </select>

                                                                                            </td>
                                                                                            <td><a class="text-secondary delete-product-row-btn" href="javascript:void(0);" title="Remove Line"><i class="fa fa-trash fa-lg "></i></a></td>
                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <td colspan="5" class="text-left">
                                                                                        <a class="btn btn-sm text-primary add-new-product"><i class="fa fa-plus"></i> Add new line</a>
                                                                                        <!-- <label>
                                                                                            <input type="file" class="import-lines" style="display: none;">
                                                                                            <a class="text-primary"><i class="fa fa-plus"></i> Import lines</a>
                                                                                        </label> -->
                                                                                    </td>
                                                                                </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                    </div>
                                                                </li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </ul>
                                                    <a href="javascript:void(0)" class="add-package text-primary">Add Package</a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <a href="javascript:void(0)" class="add-container text-primary">Add Container</a>
                                </div>
                            </div>
                                            <p><label style="min-width: 100px;">Package No.</label> <input type="text" readonly id="shipping_marks_package_no" value="<?= htmlspecialchars($other_details->shipping_marks_package_no) ?>" class="form-control requiredClass" style="width:400px;display:inline" name="other_details[shipping_marks_package_no]" maxlength="100">

                                            </p><br>
                                            <p><label style="min-width: 100px;">Weight:</label> <input type="text" readonly id="shipping_marks_weight" value="<?= htmlspecialchars($other_details->shipping_marks_weight) ?>" class="form-control requiredClass" style="width:400px;display:inline" name="other_details[shipping_marks_weight]" maxlength="60"></p>
                                        <input id="total_package_count" type="hidden" name="other_details[total_package_count]" value="<?=$other_details->total_package_count?>">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                            <hr>
                                            <h3>II] Post-Shipment Document Details</h3>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <label class="sr-no">Commercial Invoice Number :</label>
                                            <input type="text" class="form-control" name="other_details[commercial_invoice_number]" value="<?= htmlspecialchars($commercial_invoice_number) ?>">
                                        </td>
                                        <td>
                                            <label class="sr-no" style="min-width: 100px;">Date : </label>
                                            <input type="text" name="other_details[commercial_invoice_date]" id="commercial_invoice_date" class="date-picker form-control" value="<?= printFormatedDate($commercial_invoice_date) ?>">
                                        </td>
                                        <td>
                                            <label class="sr-no"> Shipping Bill Number : </label>
                                            <input type="text" class="form-control" name="other_details[shipping_bill_no]" id="#shipping_bill_no" value="<?= htmlspecialchars($shipping_bill_no) ?>">
                                        </td>
                                        <td>
                                            <label class="sr-no" style="min-width: 100px;">Date : </label>
                                            <input type="text" name="other_details[shipping_bill_date]" id="shipping_bill_date" class="date-picker form-control " value="<?= printFormatedDate($shipping_bill_date) ?>">
                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="airwaybill" style="<?= $requestDetails->mode_id != 2 ? 'display:none' : '' ?>">
                                            <label class="sr-no">Air Way Bill Number :</label>
                                            <input type="text" class="form-control" name="other_details[airway_bill_number]" value="<?= $airway_bill_number ?>">
                                        </td>
                                        <td class="airwaybill" style="<?= $requestDetails->mode_id != 2 ? 'display:none' : '' ?>">
                                            <label class="sr-no" style="min-width: 100px;">Date : </label>
                                            <input type="text" name="other_details[airway_bill_date]" id="airway_bill_date" class="date-picker form-control " value="<?= printFormatedDate($airway_bill_date) ?>">
                                        </td>
                                        <td class="billoflading" style="<?= $requestDetails->mode_id != 3 ? 'display:none' : '' ?>">
                                            <label class="sr-no"> Bill of Lading Number : </label>
                                            <input type="text" class="form-control " name="other_details[bill_of_lading]" id="#bill_of_lading" value="<?= $bill_of_lading ?>">
                                        </td>
                                        <td class="billoflading" style="<?= $requestDetails->mode_id != 3 ? 'display:none' : '' ?>">
                                            <label class="sr-no" style="min-width: 100px;">Date : </label>
                                            <input type="text" name="other_details[bill_of_lading_date]" id="bill_of_lading_date" class="date-picker form-control " value="<?= printFormatedDate($bill_of_lading_date) ?>">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="sr-no"> Vessel / Aircraft/ Voyage Number :</label>

                                            <input type="text" class="form-control" name="other_details[vessel_aircraft_voyage_no]" value="<?= htmlspecialchars($vessel_aircraft_voyage_no) ?>">
                                        </td>
                                    </tr>



                                </tbody>
                            </table>



                            <center>
                                <input type="submit" value="Save" name="submitBtn" class="btn btn-success">
                                <input type="submit" value="Cancel" name="submitBtn" class="btn btn-secondary">
                            </center>


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


<div id="containerTemplate" style="display: none;">
    <div class="container" id="{container_uid}">
        <div><label>Container Number:</label><input type="text" name="items[{container_uid}][container_number]">
            <span class="pull-right">
                <!-- <a href="javascript:void(0);" title="Move Package" class="text-secondary"><i class="fa fa-arrows-alt fa-lg"></i></a> -->
                <!-- <a href="javascript:void(0);" title="Copy Package" class="text-secondary"><i class="fa fa-clone fa-lg"></i></a> -->
                <a href="javascript:void(0);" title="Remove Container" class="text-secondary remove-container"><i class="fa fa-trash fa-lg"></i></a>
            </span>
        </div>
        <ul class="package-list" style="list-style: none;">
            <li class="package" id="{package_uid}">
                <div class="package-details">
                    <label>Package <input type="text" class="package-number" name="items[{container_uid}][packages][{package_uid}][package_number]"></label>
                    <label>Packing Type</label>
                    <select name="items[{container_uid}][packages][{package_uid}][packing_type]">
                        <?php foreach(getPackingTypeList() as $packingType){
                            $packingType = (object)$packingType;
                            echo "<option value='$packingType->type'>$packingType->type</option>";
                         }?>
                        
                    </select>
                    <label>Net Weight (Kg):</label><input type="text" class="net_wt" name="items[{container_uid}][packages][{package_uid}][net_wt]">
                    <label>Gross Weight (Kg):</label><input type="text" class="gross_wt" name="items[{container_uid}][packages][{package_uid}][gross_wt]">
                    <label>Dimension (L x W x H) Centimeter:</label><input type="text" name="items[{container_uid}][packages][{package_uid}][dimension]" placeholder="L x W x H">
                    <span class="pull-right">
                        <a href="javascript:void(0);" title="Move Package" class="text-secondary"><i class="fa fa-arrows-alt fa-lg"></i></a>
                        <!-- <a href="javascript:void(0);" title="Copy Package" class="text-secondary clone-package"><i class="fa fa-clone fa-lg"></i></a> -->
                        <a href="javascript:void(0);" title="Remove Package" class="text-secondary remove-package"><i class="fa fa-trash fa-lg"></i></a>
                    </span>
                </div>
                <div class="product-list">
                    <table id="products_{package_uid}" class="product-table table">
                        <thead>
                            <th class="fix-width-60">Sr.No.</th>
                            <th class="fix-width-600">Description of Goods</th>
                            <th class="fix-width-60">Quantity</th>
                            <th class="fix-width-80">Unit of Measure</th>
                            <th class="fix-width-60"></th>
                        </thead>
                        <tbody>
                            <tr id="{product_uid}">
                                <td class="fix-width-60 sr-no"></td>
                                <!-- <td class="fix-width-600"><textarea class="form-control requiredClass" name="name[{container_uid}][packages][{package_uid}]products[{product_uid}][description]" id="description_{product_uid}" rows="5" ></textarea></td> -->
                                <td class="fix-width-600"><input type="text" class="form-control requiredClass" name="items[{container_uid}][packages][{package_uid}][products][{product_uid}][description]" id="description_{product_uid}"></td>
                                <td class="fix-width-60"><input type="text" class="decimal-numbers qty form-control requiredClass" maxlength="12" name="items[{container_uid}][packages][{package_uid}][products][{product_uid}][qty]" placeholder="0.00" value=""></td>
                                <td class="fix-width-80">
                                    <select name="items[{container_uid}][packages][{package_uid}][products][{product_uid}][unit]">
                                        <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                                            <option value="<?= $unitCode ?>" <?= $unitCode == $item->unit ? ' selected ' : '' ?>><?= $unitValue ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                                <td>
                                    <a class="text-secondary delete-product-row-btn" href="javascript:void(0);" title="Remove Line"><i class="fa fa-trash fa-lg"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-left">
                                    <a class="btn btn-sm text-primary add-new-product"><i class="fa fa-plus"></i> Add new line</a>
                                    <!-- <label>
                                        <input type="file" class="import-lines" style="display: none;">
                                        <a class="text-primary"><i class="fa fa-plus"></i> Import lines</a>
                                    </label> -->
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </li>
        </ul>
        <a href="javascript:void(0)" class="add-package text-primary">Add Package</a>
    </div>
</div>

<script src="<?php echo base_url('assets/frontend/js/jquery-sortable.js'); ?>"></script>

<script>
    var adjustment;
    var from_container;
    var to_container;
    $(".package-list").sortable({
        group: 'package-list',
        handle: 'i.fa-arrows-alt',
        onDrop: function($item, container, _super, event) {
            to_container = $item.parents('.container').attr('id');
            console.log(from_container, to_container);
            let html = $item.html();
            var myRegExp = new RegExp(from_container, 'g');
            html = html.replace(myRegExp, to_container);
            $item.html(html);
            $item.removeClass(container.group.options.draggedClass).removeAttr("style")
            $("body").removeClass(container.group.options.bodyClass)

        },
        onDrag: function($item, position, _super, event) {

            $item.css(position)
        },
        onMousedown: function($item, _super, event) {
            from_container = $item.parents('.container').attr('id');


            return true;
        }
    });
</script>

<script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
    jQuery.validator.addClassRules("requiredClass", {
        required: true,
    });
    $("#documentForm").validate({

        onfocusout: function(e) {
            $(e).valid()
        },
        rules: {
            invoice_number: {
                required: true,
            },
            invoice_date: {
                required: true,
            },
            "other_details[iec_no]": {
                required: true,
            },
            "other_details[pan_no]": {
                required: true,
            },

        },
        messages: {}
    });

    const uid = function() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }

    $(document).ready(function() {

        // Start: Calculate total net_wt gross_wt
        $(document).on('blur', 'input.net_wt, input.gross_wt', function(e) {
            calculate_total_weight();
        });
        // End: Calculate total net_wt gross_wt

        // Delete row
        $(document).on('click', 'table.items-table a.delete-row-btn', function() {

            if (confirm("Are you sure you want to delete this line?")) {
                var tableId = '#itemstable'; //'#' + $(this).closest('table').attr('id');
                $(this).closest('tr').remove();
                caculateFinaltotal(tableId);
            }
        });

        // Delete Container
        $(document).on('click', '.remove-container', function() {

            if (confirm("Are you sure you want to delete this Container?")) {
                // var tableId = '#itemstable'; //'#' + $(this).closest('table').attr('id');
                $(this).closest('.container').remove();
                //caculateFinaltotal(tableId);
                update_package_number();
            }
        });
        // Delete Package
        $(document).on('click', '.remove-package', function() {

            if (confirm("Are you sure you want to delete this Package?")) {
                // var tableId = '#itemstable'; //'#' + $(this).closest('table').attr('id');
                $(this).closest('.package').remove();
                // caculateFinaltotal(tableId);
                update_package_number();
            }
        });

        // Clone Package
        // $(document).on('click', '.clone-package', function() {

        //     let package_to_copy = $(this).closest('.package').clone().html();
        //     console.log(package_to_copy)
        //     let old_package_id = $(package_to_copy).attr('id');
        //     var re = new RegExp(old_package_id, "g");
        //     package_to_copy = package_to_copy.replace(re, uid());
        //     let packingList = $(this).closest('div.container').find('.package-list');
        //     $(packingList).append(package_to_copy);
        // });

        // Delete product row
        $(document).on('click', 'table.product-table a.delete-product-row-btn', function() {

            if (confirm("Are you sure you want to delete this line?")) {
                var tableId = '#itemstable'; //'#' + $(this).closest('table').attr('id');
                $(this).closest('tr').remove();
                // caculateFinaltotal(tableId);

            }
        });


        $(document).on('click', 'table.items-table tfoot tr a.add-new-line-btn', function() {
            // var tableId = '#' + $(this).closest('table').attr('id');
            var packageRow = $('#item-table-row-template table tbody').html().replace(/{uid}/g, uid());
            let uid2 = uid();
            $('#itemstable > tbody').append(packageRow.replace(/{uid2}/g, uid2));
            init_wysihtml5('#description_' + uid2);
        });

        $(document).on('click', 'table.product-table tfoot tr a.add-new-product', function() {
            var tableId = '#' + $(this).closest('table').attr('id');

            let container_uid = $(this).closest('div.container').attr('id');
            let package_uid = $(this).closest('li.package').attr('id');
            let product_uid = uid();
            let productRow = $('#containerTemplate .package-list .product-list table tbody').html().replace(/{product_uid}/g, product_uid)
            productRow = productRow.replace(/{container_uid}/g, container_uid)
            productRow = productRow.replace(/{package_uid}/g, package_uid)

            $(tableId + ' > tbody').append(productRow);
            init_wysihtml5('#description_' + product_uid);
            console.log('container_uid:' + container_uid + ' package_uid:' + package_uid + ' product_uid:' + product_uid);
        });

        $(document).on('click', 'a.add-container', function() {
            let containerTemplate = $('#containerTemplate').html();
            let product_uid = uid();
            containerTemplate = containerTemplate.replace(/{container_uid}/g, uid());
            containerTemplate = containerTemplate.replace(/{package_uid}/g, uid());
            containerTemplate = containerTemplate.replace(/{product_uid}/g, product_uid);
            $('div#containerList').append(containerTemplate);
            init_wysihtml5('#description_' + product_uid);
            update_package_number();
        });
        $(document).on('click', 'a.add-package', function() {
            let container_uid = $(this).closest('div.container').attr('id');
            let packingList = $(this).closest('div.container').find('.package-list');
            let packageTemplate = $('#containerTemplate .package-list').html();
            let product_uid = uid();

            packageTemplate = packageTemplate.replace(/{container_uid}/g, container_uid);
            packageTemplate = packageTemplate.replace(/{package_uid}/g, uid());
            packageTemplate = packageTemplate.replace(/{product_uid}/g, product_uid);

            $(packingList).append(packageTemplate);

            init_wysihtml5('#description_' + product_uid);
            update_package_number();
        });
        update_package_number();
    });

    function update_package_number() {
        let totalPackages = $('#containerList ul li.package input.package-number').length
        let custom_invoice_number = $('#custom_invoice_number').val();
        $('#containerList ul li.package input.package-number').each(function(index) {

            $(this).val(custom_invoice_number + '-' + (index + 1) + '/' + totalPackages);
        });
        $('#total_package_count').val(totalPackages);
        $('#shipping_marks_package_no').val(custom_invoice_number + '-1/' + totalPackages + ' to ' + custom_invoice_number + '-' + totalPackages + '/' + totalPackages);
        calculate_total_weight();
    }

    function calculate_total_weight() {
        var total_net_wt = 0;
        var total_gross_wt = 0;
        $('#containerList ul li.package input.net_wt').each(function(index) {
            total_net_wt += parseFloat($(this).val()) || 0.0;
            console.log(total_net_wt);

        });
        $('#containerList ul li.package input.gross_wt').each(function(index) {
            total_gross_wt += parseFloat($(this).val()) || 0.0;
        });
        
        $('#shipping_marks_weight').val('Net :' + total_net_wt + ' Kg; Gross :' + total_gross_wt + ' Kg');

    }

    function caculateFinaltotal(tableId) {
        var finalTotal = 0;
        var totalQty = 0;

        $(tableId + ' tbody tr input.qty').each(function() {

            let qty = parseFloat($(this).val()) || 0.0
            totalQty += qty
        });

        $(tableId + ' > tfoot tr span.total-qty').text(totalQty.toFixed(2));


        var totalPackage_qty = 0;
        $(tableId + ' tbody tr input.package_qty').each(function() {

            let qty = parseFloat($(this).val()) || 0.0

            totalPackage_qty += qty
        });

        $(tableId + ' > tfoot tr span.total-package_qty').text(totalPackage_qty.toFixed(2));


        var totalNet_wt = 0;
        $(tableId + ' tbody tr ').each(function() {
            var tr = $(this);
            var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
            var net_wt_per_pk = parseFloat(tr.find('input.net_wt_per_pk').val()) || 0.0;
            totalNet_wt += package_qty * net_wt_per_pk;


        });

        $(tableId + ' tfoot tr span.total-net_wt_per_pk').text(totalNet_wt.toFixed(2));

        var totalGross_wt = 0;
        $(tableId + ' tbody tr ').each(function() {
            var tr = $(this);
            var package_qty = parseFloat(tr.find('input.package_qty').val()) || 0.0;
            var gross_wt_per_pk = parseFloat(tr.find('input.gross_wt_per_pk').val()) || 0.0;
            totalGross_wt += package_qty * gross_wt_per_pk;


        });

        $(tableId + ' tfoot tr span.total-gross_wt_per_pk').text(totalGross_wt.toFixed(2));

    }

    function init_wysihtml5(element) {
        return false;
        $(element).wysihtml5({
            toolbar: {
                "fa": true,
                "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
                "emphasis": true, //Italics, bold, etc. Default true
                "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                "html": false, //Button which allows you to edit the generated HTML. Default false
                "link": false, //Button to insert a link. Default true
                "image": false, //Button to insert an image. Default true,
                "color": false, //Button to change color of font  
                "blockquote": false, //Blockquote  
                //"size": <buttonsize> //default: none, other options are xs, sm, lg
            }
        });
    }

    /*start::import lines form excel file*/
    $(document).on("change", "input.import-lines", function(e) {

        var file_data = $(this).prop("files")[0]; // Getting the properties of file from file field
        var form_data = new FormData(); // Creating object of FormData class
        // var element = this;
        var tableId = '#' + $(this).closest('table.product-table').attr('id');
        let uuid1 = $(this).closest('table.product-table').attr('data-rowid');
        // var containerCounter = $(this).data('containercounter') || '';

        if (confirm("Are your sure" + ' Import from ' + file_data.name + "?")) {
            form_data.append("file", file_data);
            form_data.append("uuid1", uuid1);
            form_data.append("tableId", tableId);


            //                    console.log(file_data);
            insertProductItemsFile(form_data, tableId);
            return true;
        }
    });

    function insertProductItemsFile(form_data, tableId) {

        $.ajax({
            url: '<?php echo base_url('Seller_dms/ajaxAddPackageItem_from_excel'); ?>', //Server script to process data
            type: 'POST',
            // cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            //Ajax events
            success: function(html) {
                $(tableId + ' tbody ').append(html);
                caculateFinaltotal('#itemstable');
            }
        });
    }
    /*end::import lines form excel file*/
</script>
<!--start city autocomplete style-->
<style type="text/css">
    #country-list {
        float: left;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 740px;
        z-index: 1010;
        position: absolute;
    }

    #country-list li {
        padding: 10px;
        background: #FAFAFA;
        border-bottom: #F0F0F0 1px solid;
    }

    #country-list li:hover {
        background: #F0F0F0;
    }
</style>

<!--end city autocomplete style-->
<script>
    //start::city auto complete
    $('.from-profileCitySearch input.search-box').on('keyup', function(e) {
        var keyword = $(this).val();

        console.log(keyword);
        if (keyword !== "") {
            $.ajax({
                type: "POST",
                url: $('#base_url').val() + "ajax-city-list",
                data: 'keyword=' + keyword,
                beforeSend: function() {
                    $("#search-box").css("background", "#FFF url(" + $('#base_url').val() + "media/images/ajax-loader.gif) no-repeat 165px");
                },
                success: function(data) {
                    $(".from-profileCitySearch .cityId").val('');
                    $(".from-profileCitySearch .stateId").val('');
                    $(".from-profileCitySearch .countryId").val('');
                    $(".from-profileCitySearch .suggesstion-box").show();
                    $(".from-profileCitySearch .suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");
                }
            });
        } else {
            $(".from-profileCitySearch .cityId").val('');
            $(".from-profileCitySearch .stateId").val('');
            $(".from-profileCitySearch .countryId").val('');
            $(".from-profileCitySearch .suggesstion-box").hide();
        }
    });



    $(document).on('click', '.from-profileCitySearch .suggesstion-box ul li', function(e) {

        if ($(this).attr('data-cityId') != '0') {

            // $(".from-profileCitySearch .cityId").val($(this).attr('data-cityId'));
            // $(".from-profileCitySearch .stateId").val($(this).attr('data-stateId'));
            // $(".from-profileCitySearch .countryId").val($(this).attr('data-countryId'));
            // $("#transaction_currency").val($(this).attr('data-currency'));

            $('.from-profileCitySearch input.search-box').val($(this).text());

        } else {
            // $('#addNewCityModal #city_prefix').val('consignor');
            // $('#addNewCityModal').modal('show');
        }
        $(".from-profileCitySearch .suggesstion-box").hide();

    });
    //end::city auto complete

    $('#profile_pic').change(function() {
        $('#clearSelectionBtn').show();
        $('.fileUpload').hide();
    });

    $('#clearSelectionBtn').click(function() {
        $(this).hide();
        $('.fileUpload').show();
        $('span#profile_pic-error').hide();
        $('#profile_pic').val('');
        $('#userPhotoPreview').attr('src', '');
    });
    $('input[name="mode"]').change(function() {
        let mode = $('input[name="mode"]:checked').val();

        if (mode == 2) {
            $('.airwaybill').show();
        } else {
            $('.airwaybill').hide();
        }
        if (mode == 3) {
            $('.billoflading').show();
        } else {
            $('.billoflading').hide();
        }
    });
</script>
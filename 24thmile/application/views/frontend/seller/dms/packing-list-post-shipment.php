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
                            <h3 class="heading3-border">Packing List</h3>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td rowspan="3" colspan="2">
                                            <label for="">Exporter</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[exporter]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="10"><?= $other_details->exporter ?></textarea>
                                            </div>
                                        </td>

                                        <td>
                                            <div><label for="" style="min-width: 100px;">Invoice Number</label>
                                                <div class="editable">
                                                    <input type="text" class="form-control requiredClass" id="custom_invoice_number" name="other_details[invoice_number]" value="<?= htmlspecialchars($other_details->invoice_number) ?>">
                                                </div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">Date</label>
                                                <div class="editable">
                                                    <input type="text" name="other_details[invoice_date]" id="invoice_date" class="date-picker form-control requiredClass" value="<?= printFormatedDate($other_details->invoice_date) ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <label for="">Exporter's Referance</label>
                                            <div><label for="" style="min-width: 100px;">Import Export Code</label>
                                                <div class="editable"><input type="text" name="other_details[iec_no]" class="form-control requiredClass" value="<?= htmlspecialchars($other_details->iec_no) ?>"></div>
                                            </div>
                                            <div><label for="" style="min-width: 100px;">Authorized Dealer Code</label>
                                                <div class="editable"><input type="text" name="other_details[ad_code]" onkeyup="addHyphen(this)" class="form-control requiredClass" value="<?= formated_ad_code($other_details->ad_code) ?>"></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>

                                    <td colspan="2">
                                            <label>Buyer Reference</label>
                                            <div><label style="min-width: 100px;">Purchase Order Number and Date (if any)</label>
                                                <div class="editable"><input type="text" class="form-control requiredClass" name="other_details[po_number]" id="#po_number" value="<?= htmlspecialchars($other_details->po_number) ?>"></div>
                                                <div class="editable"><input type="text" class="form-control date-picker" name="other_details[po_date]" id="#po_date" class="date-picker" value="<?= printFormatedDate($other_details->po_date) ?>"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label>Other Reference/Notify Party (if any)</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[notify_party]" class="form-control wysihtml5-editor-no-controlls" rows="6"><?= $other_details->notify_party ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label for="">Consignee</label>

                                            <div class="editable-textarea">
                                                <textarea name="other_details[consignee]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="5"><?= $other_details->consignee ?></textarea>
                                            </div>

                                        </td>
                                        <td colspan="2">
                                            <label for="">Buyer (if other than Consignee)</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[buyer]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="5"><?= $other_details->buyer ?></textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label for="">Pre-Carriage by</label>
                                            <!-- <input type="text" name="other_details[pre_carriage]" class="form-control requiredClass" value="<?= $other_details->pre_carriage_by ?>"> -->
                                            <select class="form-control " name="other_details[pre_carriage_by]">

                                                <?php foreach (getPrecarriageByList() as $carriage) { ?>
                                                    <option value="<?= $carriage ?>" <?= $other_details->pre_carriage_by == $carriage ? 'selected' : '' ?>><?= $carriage ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <label for="">Place of Receipt</label>
                                            <input type="text" name="other_details[place_of_receipt]" class="form-control requiredClass" value="<?= htmlspecialchars($other_details->place_of_receipt) ?>">

                                        </td>
                                        <td>
                                            <label for="">Country of Origin</label>
                                            <input type="text" name="other_details[country_of_origin]" class="form-control requiredClass" value="<?= htmlspecialchars($other_details->country_of_origin) ?>">

                                        </td>
                                        <td>
                                            <label for="">Country of Final Destination</label>
                                            <input type="text" name="other_details[country_of_final_destination]" class="form-control requiredClass" value="<?= htmlspecialchars($other_details->country_of_final_destination) ?>">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Vessel / Aircraft/ Voyage Number</label>
                                            <input type="text" name="other_details[vessel_aircraft_voyage_no]" class="form-control" value="<?= htmlspecialchars($other_details->vessel_aircraft_voyage_no) ?>">

                                        </td>
                                        <td>
                                            <label for="">Port of Loading</label>
                                            <input type="text" name="other_details[port_of_l]" class="form-control requiredClass" value="<?= htmlspecialchars($other_details->port_of_l) ?>">

                                        </td>

                                        <td rowspan="2" colspan="2"><label for="">Terms / Method of Payment</label>
                                            <div class="editable-textarea">
                                                <textarea name="other_details[terms_method_of_payment]" class="form-control requiredClass wysihtml5-editor-no-controlls" rows="5"><?= $other_details->terms_method_of_payment ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Port of Discharge</label>
                                            <input type="text" name="other_details[port_of_d]" class="form-control requiredClass" value="<?= htmlspecialchars($other_details->port_of_d) ?>">

                                        </td>
                                        <td>
                                            <label for="">Final Destination</label>
                                            <input type="text" name="other_details[final_destination]" class="form-control requiredClass" value="<?= htmlspecialchars($other_details->final_destination) ?>">

                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <td colspan="4">
                                            <a href="<?= base_url('assets/frontend/excel-file-templates/packing-list-products-template.xlsx') ?>" class=" btn btn-sm btn-success">Download Add Lines Template</a>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
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
                                                                                            <td class="fix-width-60"><input type="text" class="decimal-numbers qty form-control requiredClass" maxlength="12" name="items[<?= $container_uid ?>][packages][<?= $package_uid ?>][products][<?= $product_uid ?>][qty]" placeholder="0.00" value="<?= $product->qty ?>"></td>
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

                            <table class="table table-bordered">
                                <colgroup>
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td class="text-left" colspan='4'><label for=""> Any Special Consideration for Shipment: </label>
                                            <div class="editable-textarea">
                                                <textarea cols="200" rows="4" class="form-control requiredClass" name="other_details[special_consideration]"><?= $other_details->special_consideration ?></textarea>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td colspan="4">
                                            <p>Shipping Bill Number: <input type="text" value="<?= htmlspecialchars($other_details->shipping_bill_no) ?>" class="form-control" style="width:200px;display:inline" name="other_details[shipping_bill_no]" maxlength="40"> dated <input type="text" value="<?= $other_details->shipping_bill_date ?>" class="form-control date-picker" style="width:200px;display:inline" name="other_details[shipping_bill_date]" maxlength="40">
                                            </p>
                                            <br>
                                            <p>
                                                Bill of Lading / Airway Bill Number: <input type="text" value="<?= htmlspecialchars($other_details->bol_awb_no) ?>" class="form-control" style="width:200px;display:inline" name="other_details[bol_awb_no]" maxlength="15"> dated <input type="text" value="<?= $other_details->bol_awb_dated ?>" class="form-control date-picker" style="width:200px;display:inline" name="other_details[bol_awb_dated]" maxlength="15">
                                            </p>
                                            <br>
                                            <p><label for="">Shipping Marks</label></p><br>
                                            <p><label style="min-width: 100px;">From:</label> <input type="text" class="form-control" style="display: inline; width:400px;" name="other_details[shipping_marks_from]" value="<?= htmlspecialchars($other_details->shipping_marks_from) ?>"></p><br>
                                            <p><label style="min-width: 100px;">To:</label> <input type="text" class="form-control" style="display: inline; width:400px;" name="other_details[shipping_marks_to]" value="<?= htmlspecialchars($other_details->shipping_marks_to) ?>"></p><br>

                                            <p><label style="min-width: 100px;">Package No.</label> <input type="text" readonly id="shipping_marks_package_no" value="<?= htmlspecialchars($other_details->shipping_marks_package_no) ?>" class="form-control requiredClass" style="width:300px;display:inline" name="other_details[shipping_marks_package_no]" maxlength="60">
                                                <input type="hidden" id="total_package_count" name="other_details[total_package_count]" value="<?= $other_details->total_package_count ?>">
                                            </p><br>
                                            <p><label for="" style="min-width: 100px;">Weight:</label> <input type="text" readonly id="shipping_marks_weight" value="<?= htmlspecialchars($other_details->shipping_marks_weight) ?>" class="form-control requiredClass" style="width:300px;display:inline" name="other_details[shipping_marks_weight]" maxlength="60"></p>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="editable-textarea">
                                                <textarea cols="30" class="form-control wysihtml5-editor-no-controlls" rows="10" name="other_details[declaration]"><?= $other_details->declaration ?></textarea>
                                            </div>

                                        </td>
                                        <td colspan="2">
                                        For <?= $documentData->for_consignor_company ?>
                                                            <br><br>
                                                            <input type="hidden" name="for_consignor_company" value="<?= $documentData->for_consignor_company ?>">
                                                            <div>
                                                                <div class="fileUpload btn btn-secondary">
                                                                    <span>Select Signature</span>
                                                                    <input type="file" class="upload preview" name="signature" data-previewTarget="#userPhotoPreview" id="profile_pic">
                                                                    <!-- <label class="custom-file-label" for="profile_pic">Slect Sign</label> -->
                                                                </div>
                                                                <input id="clearSelectionBtn" type="button" class="btn btn-secondary btn-sm" value="Clear the Selection" style="display:none;">
                                                                <img id="userPhotoPreview" src="<?= $documentData->signature ?>" style="height:50px;width: 150px; object-fit: contain;" />

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                <label>Authorized Signatory:</label>
                                                                </div>
                                                                <div class="col-lg-8">

                                                                    <input type="text" class="form-control " name="other_details[name_of_authorized_signatory]" value="<?= htmlspecialchars($other_details->name_of_authorized_signatory) ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">

                                                                    <label for="">Designation:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="text" name="other_details[designation]" class="form-control col-lg-6" value="<?= htmlspecialchars($other_details->designation) ?>">
                                                                </div>
                                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <center>
                                <input type="submit" value="Save" class="btn btn-success">
                                <!-- <input type="submit" value="Create Document" name="submitBtn" id="createDocumentBtn" class="btn btn-success"> -->
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
            update_package_number();

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
</script>


<script>
    //end::city auto complete
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
                //   caculateFinaltotal(tableId);
                update_package_number();
            }
        });
        // Delete Package
        $(document).on('click', '.remove-package', function() {

            if (confirm("Are you sure you want to delete this Package?")) {
                // var tableId = '#itemstable'; //'#' + $(this).closest('table').attr('id');
                $(this).closest('.package').remove();
                //  caculateFinaltotal(tableId);
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
                caculateFinaltotal(tableId);
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
</script>
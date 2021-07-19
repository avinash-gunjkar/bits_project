<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
<style>
    .steps .card-body {
        min-height: 250px;
        max-height: 250px;
    }

    .steps .card-body h5 {
        font-weight: bold;
    }
</style>
<!-- Tracking start -->
<div class="wshipping-content-block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                        <h3 class="heading3-border">Create Annual Contract</h3>

                        <form id="frmRequirement" name="frmRequirement" class="" action="" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="annual_contract_id" value="<?= $annualContractDetails->annual_contract_id ?>" />

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">

                                        <label class="mr-3">Title <sup>* </sup></label>
                                        <input type="text" name="annual_contract_title" class="form-control" value="<?= $annualContractDetails->annual_contract_title ?>">

                                    </div>
                                    <div class="col-lg-2">

                                        <label class="mr-3">Start Date <sup>* </sup></label>
                                        <input type="text" name="start_date" class="form-control date-picker" value="<?= printFormatedDate($annualContractDetails->start_date) ?>">

                                    </div>
                                    <div class="col-lg-2">

                                        <label class="mr-3">End Date <sup>* </sup></label>
                                        <input type="text" name="end_date" class="form-control date-picker" value="<?= printFormatedDate($annualContractDetails->end_date) ?>">

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row mb-3">
                                            <?php if (!empty($requestDetails->request_id)) { ?>
                                                <div class="col-12 col-lg-12">
                                                    <label>Contract ID : </label>
                                                    <?= $requestDetails->request_id ?>
                                                </div>
                                            <?php } ?>
                                            <div class="col-lg-6">

                                                <div class="radio">
                                                    <label class="mr-3">Transaction <sup>* </sup></label>

                                                    <label class="mr-3 ml-3"><input type="radio" aria-describedby="transaction-error" name="transaction" id="transaction_export" value="Export" <?= $requestDetails->transaction == "Export" ? 'checked' : ''; ?>> Export</label>&nbsp;
                                                    <label class="mr-3 ml-3"><input type="radio" aria-describedby="transaction-error" name="transaction" id="transaction_import" value="Import" <?= $requestDetails->transaction == "Import" ? 'checked' : ''; ?>> Import</label>&nbsp;
                                                    <span id="transaction-error" class="error"></span>
                                                </div>

                                            </div>

                                            <div class="col-lg-6">

                                                <div class="radio">
                                                    <label class="mr-3">Mode<sup>* </sup></label>
                                                    <?php foreach ($modes as $mode) { ?>
                                                        <label class="mr-3 ml-3"><input type="radio" name="mode" aria-describedby="mode-error" class="mode" value="<?php echo $mode['id']; ?>" <?= $requestDetails->mode_id == $mode['id'] ? 'checked' : ''; ?>> <?php echo $mode['type']; ?></label>&nbsp;
                                                    <?php } ?>
                                                    <span id="mode-error" class="error"></span>
                                                </div>

                                            </div>

                                            <!-- <div class="col-12 col-lg-3 mb-2">
                                                <label>Delivery Term <sup>* </sup></label>
                                                <select name="delivery_term" class="custom-select">
                                                    <option value="">Select</option>
                                                    <?php foreach ($delivery_terms as $delivery_term) { ?>
                                                        <option value="<?php echo $delivery_term['id']; ?>" <?= $requestDetails->delivery_term_id == $delivery_term['id'] ? 'selected' : ''; ?>><?php echo $delivery_term['name'] . ' (' . $delivery_term['description'] . ')'; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div> -->
                            <!-- <div class="col-12 col-lg-3 mb-2">
                                                <label>Shipment Type <sup>* </sup></label>
                                                <div class="input-comment">
                                                    <select name="shipment" id="shipment" class="custom-select">
                                                        <option value="">Select</option>
                                                        <?php foreach ($shipments as $shipment) { ?>
                                                            <option value="<?php echo $shipment['id']; ?>" <?= ($shipment['id'] == '1' && in_array($requestDetails->mode_id, ['1', '2'])) ? 'disabled="true"' : '' ?> <?= $requestDetails->shipment_id == $shipment['id'] ? 'selected' : ''; ?>><?php echo $shipment['type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div> -->
                            <!-- <div class="col-12 col-lg-3 mb-2">
                                                <label>Cargo <sup>* </sup></label>
                                                <div class="input-comment">
                                                    <select name="container_stuffing" id="container_stuffing" class="custom-select">
                                                        <option value="">Select</option>
                                                        <option value="Stackable" <?= $requestDetails->container_stuffing == "Stackable" || $requestDetails->container_stuffing == "" ? 'selected' : ''; ?>>Stackable</option>
                                                        <option value="Non-Stackable" <?= $requestDetails->container_stuffing == "Non-Stackable" ? 'selected' : ''; ?>>Non-Stackable</option>

                                                    </select>

                                                </div>
                                            </div> -->
                            <!-- <div class="col-12 col-lg-3 mb-2">
                                                <label>Cargo Nature<sup>* </sup></label>
                                                <div class="input-comment">
                                                    <select name="cargo_status" id="cargo_status" class="custom-select">
                                                        <option value="">Select</option>
                                                        <option value="Hazardous" <?= $requestDetails->cargo_status == "Hazardous" ? 'selected' : ''; ?>>Hazardous</option>
                                                        <option value="Non-Hazardous" <?= $requestDetails->cargo_status == "Non-Hazardous" || $requestDetails->cargo_status == "" ? 'selected' : ''; ?>>Non-Hazardous</option>

                                                    </select>

                                                </div>
                                            </div> -->
                            <!-- <div class="col-12 col-lg-3 hideLCL mb-2" style="<?= $requestDetails->shipment_id != 1 ? 'display:none' : '' ?>">
                                                <label for="stuffing"><span><?= ($requestDetails->transaction == "Import") ? "De-stuffing" : "Stuffing" ?></span><sup>* </sup></label>
                                                <div class="input-comment">
                                                    <select name="stuffing" id="stuffing" class="custom-select">
                                                        <option value="">Select</option>
                                                        <option value="Factory" <?= $requestDetails->stuffing == "Factory" ? 'selected' : ''; ?>>Factory</option>
                                                        <option value="Port" <?= $requestDetails->stuffing == "Port" ? 'selected' : ''; ?>>Port</option>
                                                    </select>
                                                </div>
                                            </div> -->


                            <!-- </div> -->


                            <!-- <div class="row mb-3 mode-sea">

                                            <div class="col-12 col-lg-4 loading-port-search ">
                                                <label>Port of Loading<sup>*</sup></label>
                                                <div class="input-comment">
                                                    <input type="text" class="form-control search-box" name="port_loading_name" id="port_loading_name" placeholder="Type port name" autocomplete="off" value="<?= $requestDetails->port_loading_name; ?>" />
                                                    <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                                    <input type="hidden" class="port_loading_id" id="port_loading_id" name="port_loading_id" value="<?= $requestDetails->port_loading_id; ?>">

                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4 discharge-port-search">
                                                <label>Port of Discharge<sup>*</sup></label>
                                                <div class="input-comment">
                                                    <input type="text" class="form-control search-box" name="port_discharge_name" id="port_discharge_name" placeholder="Type port name" autocomplete="off" value="<?= $requestDetails->port_discharge_name; ?>" />
                                                    <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                                    <input type="hidden" class="port_discharge_id" id="port_discharge_id" name="port_discharge_id" value="<?= $requestDetails->port_discharge_id; ?>">
                                                </div>
                                            </div>
                                        </div> -->

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class=" fileUpload btn btn-secondary btn-sm">
                                            <span>Import from Excel File</span>
                                            <input type="file" id="import_contract_template" name="import_contract_template" class="upload" />
                                        </div>
                                        <a href="<?= base_url('assets/frontend/excel-file-templates/annual-contract-template.xlsx?v=4') ?>" class="hideLCL btn btn-sm btn-success">Download Excel File Template</a>
                                        <!-- <span class="btn btn-small btn-secondary hideLCL mb-3 pull-right" id="add_more_container" >Add</span> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 table-responsive" style="max-height: 60vh;overflow-y:auto;">
                                    <table id="annualContractListTable" class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Loading Place</th>
                                                <th>Loading Country</th>
                                                <th>Port of Loading</th>
                                                <th>Delivery Place</th>
                                                <th>Destination Country</th>
                                                <th>Port of Discharge</th>
                                                <th>Mode</th>
                                                <th>Transaction</th>
                                                <th>Cargo Type</th>
                                                <th>Cargo Nature</th>
                                                <th>Shipment Type</th>
                                                <th>Currency</th>
                                                <th>Commodity</th>
                                                <th>Container Type</th>
                                                <th>Annual Volume per Container Type</th>
                                                <th>Tentative Gross Wt.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($annualContractDetails->routes) {
                                                foreach ($annualContractDetails->routes as $item) {
                                                    $this->load->view('frontend/ajax/ajaxAddContractRow', [
                                                        'containerCounter' => uniqid(),
                                                        'item_details' => $item,
                                                        'cargoTypeList' => $cargoTypeList,
                                                        'cargoNatureList' => $cargoNatureList,
                                                        'transactionList' => $transactionList,
                                                        'modeList' => $modeList,
                                                        'shipmentList' => $shipmentList
                                                    ]);
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12">
                                    <span class="btn btn-sm btn-secondary mb-3 pull-right" onclick="addNewRowAnnualContract()"><i class="fa fa-plus"></i> Add New Row</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <label class="mr-3">Terms and Conditions <sup>* </sup></label>
                                        <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-control editor"><?= $annualContractDetails->terms_and_conditions ?></textarea>

                                    </div>
                                </div>
                            </div>

                            <!--<input type="submit" name="submit" class="submit action-button" value="Save & Continue" />-->
                            <div class="col-lg-12 text-center">
                                <input type="submit" name="submit" class="btn btn-submit btn-md" value="Save" />
                                <input type="submit" name="submit" class="btn btn-submit btn-md" value="Save & continue" />
                                <a href="<?= base_url('fs-annual-contract-list'); ?>" class="btn btn-secondary btn-md">Cancel</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog content end -->
    </section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->



<script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script> -->


<script type="text/javascript">
    var session_user_id = '<?= $this->session->userdata("seller_logged_in")['id']; ?>';


    $("#import_contract_template").change(function(e) {

        var file_data = $(this).prop("files")[0]; // Getting the properties of file from file field
        var form_data = new FormData(); // Creating object of FormData class

        if (confirm("Are your sure" + ' Import from ' + file_data.name + "?")) {
            form_data.append("file", file_data);
            //                    console.log(file_data);
            uploadAnnualContractFile(form_data);
            return true;
        }
    });

    function uploadAnnualContractFile(form_data) {

        $.ajax({
            url: '<?php echo base_url('Cn_ajax/ajaxUploadAnnualContract'); ?>', //Server script to process data
            type: 'POST',
            //        cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            //Ajax events
            success: function(html) {
                $('#annualContractListTable tbody').append(html);
                if (html != '') {
                    toastr.success('File imported successfully.');

                } else {
                    toastr.error('Something went wrong.');
                }
            }
        });
    }

    function addNewRowAnnualContract() {

        $.ajax({
            url: '<?php echo base_url('Cn_ajax/ajaxAddNewRowAnnualContract'); ?>', //Server script to process data
            type: 'POST',
            //        cache: false,
            contentType: false,
            processData: false,
            //Ajax events
            success: function(html) {
                $('#annualContractListTable tbody').append(html);
                if (html != '') {
                    toastr.success('Row added');

                } else {
                    toastr.error('Something went wrong.');
                }
            }
        });
    }


    $(document).on('click', '.remove', function(e) {
        var currentElement = this;
        // console.log($(currentElement).parents('tr').find('strong:first').contents());

        if (confirm("Are your sure delete this row details?")) {
            return $(currentElement).parents('tr').remove();
        }
    });
</script>

<script type="text/javascript">
    jQuery.validator.addClassRules("requiredClass", {
        required: true,
    });
    $("#frmRequirement").validate({

        onfocusout: function(e) {
            $(e).valid()
        },
        rules: {
            mode: {
                required: true,
            },
            delivery_term: {
                required: true,
            },
            transaction: {
                required: true,
            },
            shipment: {
                required: true,
            },
            stuffing: {
                required: {

                    depends: function(element) {
                        return $('#shipment').val() == '1';
                    }
                }
            },
            shipment_value_currency: {
                required: true,
            },
            container_stuffing: {
                required: true,
            },
            cargo_status: {
                required: true,
            },
            consignor_name: {
                required: true,
            },
            consignor_company_name: {
                required: true,
            },
            consignor_email: {
                email: true,
            },
            consignor_phone: {
                required: true,
            },
            consignor_address_line_1: {
                required: true,
            },
            consignor_city_name: {
                required: true,
            },
            consignor_pincode: {
                required: true,
            },
            consignee_name: {
                required: true,
            },
            consignee_company_name: {
                required: true,
            },
            consignee_email: {
                email: true,
            },
            consignee_phone: {
                required: true,
            },
            consignee_address_line_1: {
                required: true,
            },
            consignee_city_name: {
                required: true,
            },
            consignee_pincode: {
                required: true,
            },
            shipment_value: {
                required: true,
            },
            tentativ_date_dispatch: {
                required: true,
            },
            tentativ_date_delivery: {
                required: true,
            },
            response_end_date: {
                required: true,
            },
            port_loading_name: {
                required: {

                    depends: function(element) {
                        return $('.mode:checked').val() == '2' || $('.mode:checked').val() == '3';
                    }
                },
            },
            port_discharge_name: {
                required: {

                    depends: function(element) {
                        return $('.mode:checked').val() == '2' || $('.mode:checked').val() == '3';
                    }
                },
            },
            'consignor_other[company_name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[email]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[address_line_1]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[city_name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[pincode]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[phone]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignee_other[company_name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[email]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[address_line_1]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[city_name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[pincode]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[phone]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },

        },
        messages: {}
    });
</script>
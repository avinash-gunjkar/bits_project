<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" /> -->
<style>
    .steps .card-body {
        min-height: 250px;
        max-height: 250px;
    }

    .steps .card-body h5 {
        font-weight: bold;
    }

    table {
        counter-reset: srno;
    }

    .sr-no::before {
        counter-increment: srno;
        content: counter(srno);
    }

    .table-sticky-header thead tr .header {
        position: sticky;
        top: 0;
    }

    .table-sticky-header thead tr .header2 {
        position: sticky;
        top: 32px;
    }

    .table-sticky-header thead {
        position: sticky;
        top: 0
    }

    @media (min-width: 840px) {
        .mdl-grid {
            padding: 8px 0px;
            width: 100% !important;
        }
    }

    
    /* .change-border-top {
	border-top: 4px solid #dee2e6 !important;
} */
</style>

<!-- Tracking start -->
<div class="wshipping-content-block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                        <h3 class="heading3-border">Annual Contract Comparative</h3>
                        <form id="searchForm" action="" method="get" class=" card-panel light-blue lighten-5">
                            <h6>Filter:</h6>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-row">
                                                <label for="">Transaction</label>
                                                <select name="transaction" id="transaction" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="Import" <?= $this->input->get('transaction') == "Import" ? ' selected="true" ' : '' ?>>Import</option>
                                                    <option value="Export" <?= $this->input->get('transaction') == "Export" ? ' selected="true" ' : '' ?>>Export</option>
                                                </select>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-row">
                                                <label>Mode</label>
                                                <select name="mode_id" id="mode" class="form-control">

                                                    <option value="3" <?= $this->input->get('mode_id') == "3" ? ' selected="true" ' : '' ?>>Sea</option>
                                                    <option value="2" <?= $this->input->get('mode_id') == "2" ? ' selected="true" ' : '' ?>>Air</option>
                                                    <option value="1" <?= $this->input->get('mode_id') == "1" ? ' selected="true" ' : '' ?>>Road</option>
                                                </select>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-row">
                                                <label>Shipment</label>
                                                <select name="shipment" id="shipment" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="1" <?= $this->input->get('shipment') == "1" ? ' selected="true" ' : '' ?>>FCL</option>
                                                    <option value="2" <?= $this->input->get('shipment') == "2" ? ' selected="true" ' : '' ?>>LCL</option>
                                                </select>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-row">
                                                <label>Service Provider</label>
                                                <select name="sp" id="serviceProvider" class="form-control">
                                                    <option value="">All</option>
                                                    <?php foreach($serviceProviderList as $serviceProvider){
                                                        $selectedSp = $this->input->get('sp') == $serviceProvider->ff_company_id?' selected="true" ':'';
                                                        echo  "<option value='$serviceProvider->ff_company_id' $selectedSp >$serviceProvider->ff_company_name</option>";
                                                    }?>
                                                   
                                                </select>

                                            </div>
                                        </td>
                                        <!-- <td style="width: 100px;">
                                            <div class="form-row">

                                                <label>From Date</label>

                                                <input type="text" class="date-picker form-control " id="fromDate" name="fromDate" value="<?= $this->input->get('fromDate') ?>">

                                            </div>
                                            </td> -->
                                                                <!-- <td style="width: 100px;">
                                            <div class="form-row">

                                                <label>To Date</label>
                                                <input type="text" class="date-picker form-control" id="toDate" name="toDate" value="<?= $this->input->get('toDate') ?>">
                                            </div>
                                            </td> -->
                                        <td>
                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <a class="btn btn-secondary" href="<?= base_url("fs-annual-contract-comparative/$annualContractDetails->id?mode_id=3") ?>">Cancel</a>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <form id="frmRequirement" name="frmRequirement" class="" action="" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="annual_contract_id" value="<?= $annualContractDetails->id ?>" />


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">

                                        <label class="mr-3">Annual Contract ID: </label>
                                        <span><?= $annualContractDetails->id ?></span>

                                    </div>
                                    <div class="col-lg-3">

                                        <label class="mr-3">Title:</label>
                                        <span><?= $annualContractDetails->annual_contract_title ?></span>
                                    </div>
                                    <div class="col-lg-2">

                                        <label class="mr-3">Start Date:</label>
                                        <span><?= printFormatedDate($annualContractDetails->start_date) ?></span>

                                    </div>
                                    <div class="col-lg-2">

                                        <label class="mr-3">End Date:</label>
                                        <span><?= printFormatedDate($annualContractDetails->end_date) ?></span>
                                    </div>
                                    <div class="col-lg-2">

                                    <label class="mr-3">Status:</label>
                                    <span class='status badge <?= str_replace(' ', '-', strtolower($annualContractDetails->fs_contract_status_title)) ?>'><?= $annualContractDetails->fs_contract_status_title ?></span>
                                    
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- <div class=" fileUpload btn btn-secondary btn-sm">
                                                <span>Import from Excel File</span>
                                                <input type="file" id="import_contract_template" name="import_contract_template" class="upload" />
                                                <div class="css-animated-loader" style="vertical-align:middle;height:15px;width:15px;display:none;"></div>
                                            </div> -->

                                        <a href="<?= base_url("fs-download-annual-contract-comparative/$annualContractDetails->id?mode_id=$mode_id") ?>" class="hideLCL btn btn-sm btn-success">Download Excel File</a>
                                        <a href="<?= base_url("fs-annual-contract-comparative/$annualContractDetails->id?mode_id=3") ?>" class="hideLCL btn btn-sm <?= $mode_id == '3' ? 'btn-primary' : 'btn-default' ?>">Sea</a>
                                        <a href="<?= base_url("fs-annual-contract-comparative/$annualContractDetails->id?mode_id=2") ?>" class="hideLCL btn btn-sm <?= $mode_id == '2' ? 'btn-primary' : 'btn-default' ?> ">Air</a>
                                        <a href="<?= base_url("fs-annual-contract-comparative/$annualContractDetails->id?mode_id=1") ?>" class="hideLCL btn btn-sm <?= $mode_id == '1' ? 'btn-primary' : 'btn-default' ?> ">Road</a>
                                        <input type="hidden" name="mode_id" id='mode_id' value="<?= $mode_id ?>">

                                        <!-- <span class="btn btn-small btn-secondary hideLCL mb-3 pull-right" id="add_more_container" >Add</span> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <table id="annualContractListTable" class="table-sticky-header  table-responsive table table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th class='header'>#</th>
                                                <th class='header'>Loading Place</th>
                                                <th class='header'>Loading Country</th>
                                                <th class='header'>Port of Loading</th>
                                                <th class='header'>Delivery Place</th>
                                                <th class='header'>Destination Country</th>
                                                <th class='header'>Port of Discharge</th>
                                                <th class='header'>Mode</th>
                                                <th class='header'>Transaction</th>
                                                <th class='header'>Cargo Type</th>
                                                <th class='header'>Cargo Nature</th>
                                                <th class='header'>Shipment Type</th>
                                                <th class='header'>Currency</th>
                                                <th class='header'>Volume per Annum</th>
                                                <th class='header'>Container Type</th>
                                                <th class='header'>Service Provider</th>
                                                <?php foreach ($rfcCategory as $category) {
                                                    // $colspan = count($category->subCategory);
                                                    echo "<th  class='header'>$category->rfc_category_name Total</th>";
                                                } ?>
                                                <th class='header'>Total</th>
                                                <th class='header'>Counter Rate</th>
                                                <th class='header'>Actions</th>
                                            </tr>

                                        </thead>
                                        <tbody >
                                            <?php if ($annualContractDetails->routes) {
                                                $lastRouteId = '';
                                                $changeBorderClass = '';
                                                foreach ($annualContractDetails->routes as $item) {
                                                    if (empty($lastRouteId)) {
                                                        $lastRouteId = $item->id;
                                                    } else if ($lastRouteId != $item->id) {
                                                        $changeBorderClass = 'change-border-top';
                                                        $lastRouteId = $item->id;
                                                    } else {
                                                        $changeBorderClass = '';
                                                    }
                                                    $this->load->view('frontend/ajax/ajaxContractComparative_Row', [
                                                        'containerCounter' => uniqid(),
                                                        'item_details' => $item,
                                                        'changeBorderClass' => $changeBorderClass,
                                                        'cargoTypeList' => $cargoTypeList,
                                                        'cargoNatureList' => $cargoNatureList,
                                                        'transactionList' => $transactionList,
                                                        'modeList' => $modeList,
                                                        'rfcCategory' => $rfcCategory,
                                                        'shipmentList' => $shipmentList
                                                    ]);
                                                }
                                            } ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- <div class="col-lg-12">
                                                <span class="btn btn-sm btn-secondary mb-3 pull-right" onclick="addNewRowAnnualContract()"><i class="fa fa-plus"></i> Add New Row</span>
                                            </div> -->
                            </div>


                            <!--<input type="submit" name="submit" class="submit action-button" value="Save & Continue" />-->
                            <div class="col-lg-12 text-center">
                                <!-- <input type="submit" name="submit" class="btn btn-submit btn-md" value="Save" /> -->
                                <!-- <input type="submit" name="submit" class="btn btn-submit btn-md" value="Save & continue" /> -->
                                <a href="<?= base_url("fs-download-annual-contract-comparative/$annualContractDetails->id?mode_id=$mode_id") ?>" class="hideLCL btn btn-sm btn-success">Download Excel File</a>
                                <a href="<?= base_url('fs-annual-contract-list'); ?>" class="btn btn-secondary btn-sm">Cancel</a>

                            </div>

                        </form>

                        <div class="row">
                        <div class="col-12">
                            <h3>Select Service Provider:</h3>
                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Quote status</th>
                                                <th>Is Accepts TnC?</th>
                                                <th>Note</th>
                                                <th>Awarded Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($serviceProviderList as $serviceProvider){?>
                                            <tr>
                                                <td class='sr-no'></td>
                                                <td><?=$serviceProvider->ff_company_name?></td>
                                                <td><?=$serviceProvider->ff_contract_status_title?></td>
                                                <td><?=$serviceProvider->accept_terms_and_conditions?'Yes':'No'?></td>
                                                <td><?=$serviceProvider->correction?></td>
                                                <td>
                                                    <?php echo printFormatedDateTime($serviceProvider->awarded_contract_dt);?>
                                                    
                                                </td>
                                                <td>
                                                    <?php if($serviceProvider->awarded_contract_dt) {
                                                        echo '<input type="button" class="btn btn-primary btn-sm" disabled value="Awarded" >';
                                                        
                                                     } else{?>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="ff_company_id" value="<?=$serviceProvider->ff_company_id?>">
                                                                <input type="submit" name="submitBtn" class="btn btn-primary btn-sm" value="Award Contract" >
                                                            </form>
                                                        <?php }?>
                                                    
                                                </td>
                                            </tr>
                                            <?php }?>
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



<script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script> -->

<script type="text/javascript">
    var session_user_id = '<?= $this->session->userdata("seller_logged_in")['id']; ?>';
    var ff_company_id = '<?= $this->session->userdata("seller_logged_in")['company_id']; ?>';
    var annual_contract_id = '<?= $annualContractDetails->id ?>';


    $("#import_contract_template").change(function(e) {

        var file_data = $(this).prop("files")[0]; // Getting the properties of file from file field
        var form_data = new FormData(); // Creating object of FormData class

        if (confirm("Are your sure" + ' Import from ' + file_data.name + "?")) {
            form_data.append("file", file_data);
            form_data.append("ff_company_id", ff_company_id);
            form_data.append("annual_contract_id", annual_contract_id);
            //                    console.log(file_data);
            uploadAnnualContractFile(form_data);
            return true;
        }
    });

    function uploadAnnualContractFile(form_data) {
        $('.fileUpload .css-animated-loader').show();
        $.ajax({
            url: '<?php echo base_url('Cn_ajax/ajax_ff_UploadAnnualContract'); ?>', //Server script to process data
            type: 'POST',
            //        cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            //Ajax events
            success: function(html) {
                // $('#annualContractListTable tbody').append(html);
                if (html == 'success') {
                    // toastr.success('File imported successfully.');
                    window.location.reload();
                } else {
                    toastr.error('Something went wrong.');
                }
                $('.fileUpload .css-animated-loader').hide();
            }
        });
    }

    $('.break-up-btn').click(function() {
        var trargetClass = $(this).attr('data-target');
        //$(tr).find('span.total').fadeToggle(100, 'swing');
        $('tr.' + trargetClass).fadeToggle(100, 'swing')
    });

    $(document).ready(function() {
        $('#annualContractListTable').DataTable({
      "pageLength": 50});
    });

    $('table.charges input.counter-offer').blur(function(e){
        var category = $(this).attr('data-category');
        var parentTableId = "#" + $(this).closest('table.charges').attr('id');
        var categoryTotal = 0.00;


        $(parentTableId + ' input[data-category="' + category + '"]').each(function() {
            
            var charges = parseFloat($(this).val()) || 0.0;
            categoryTotal += charges;
        });
        $(parentTableId + ' #' + category + '.counter-offer-category-total').text('Counter Offer: '+numberWithCommas(categoryTotal.toFixed(2).toString()));
      
        calculateFinalTotal(parentTableId);
    });

    function calculateFinalTotal(parentTableId) {
        var total_counter_offer = 0;
        $(parentTableId + ' input.counter-offer').each(function() {
            var counter_offer = parseFloat($(this).val()) || 0.00;
            total_counter_offer += counter_offer;
            console.log(counter_offer);
        });
        
        $(parentTableId + ' input.total-counter-offer').val(total_counter_offer.toFixed(2));
    }

</script>
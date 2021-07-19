<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
<style>
    .steps .card-body {
        min-height: 250px;
        max-height: 250px;
    }

    .steps .card-body h5 {
        font-weight: bold;
    }

    table.table {
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
</style>

<!-- Tracking start -->
<div class="wshipping-content-block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                        <h3 class="heading3-border">Create Annual Contract</h3>

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
                                                </td>
                                            -->
                                        <td>
                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <a class="btn btn-secondary" href="<?= base_url("ff-edit-annual-contract/$annualContractDetails->id?mode_id=3") ?>">Cancel</a>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>



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
                                    <span class='status badge <?= str_replace(' ', '-', strtolower($annualContractDetails->ff_contract_status_title)) ?>'><?= $annualContractDetails->ff_contract_status_title ?></span>
                                    <!-- <span><?= $annualContractDetails->ff_contract_status_title ?></span> -->
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if (strcasecmp($view, 'true') != 0) { ?>
                                        <div class=" fileUpload btn btn-secondary btn-sm">
                                            <span>Import from Excel File</span>
                                            <input type="file" id="import_contract_template" name="import_contract_template" class="upload" />
                                            <div class="css-animated-loader" style="vertical-align:middle;height:15px;width:15px;display:none;"></div>
                                        </div>
                                    <?php } ?>
                                    <a href="<?= base_url("ff-download-annual-contract-template/$annualContractDetails->id?mode_id=$mode_id") ?>" class="hideLCL btn btn-sm btn-success">Download Excel File Template</a>
                                    <a href="<?= base_url("ff-edit-annual-contract/$annualContractDetails->id?mode_id=3") ?>" class="hideLCL btn btn-sm <?= $mode_id == '3' ? 'btn-primary' : 'btn-default' ?>">Sea</a>
                                    <a href="<?= base_url("ff-edit-annual-contract/$annualContractDetails->id?mode_id=2") ?>" class="hideLCL btn btn-sm <?= $mode_id == '2' ? 'btn-primary' : 'btn-default' ?> ">Air</a>
                                    <a href="<?= base_url("ff-edit-annual-contract/$annualContractDetails->id?mode_id=1") ?>" class="hideLCL btn btn-sm <?= $mode_id == '1' ? 'btn-primary' : 'btn-default' ?> ">Road</a>
                                    <input type="hidden" name="mode_id" id='mode_id' value="<?= $mode_id ?>">
                                    <!-- <span class="btn btn-small btn-secondary hideLCL mb-3 pull-right" id="add_more_container" >Add</span> -->
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                            <div class="col-lg-12" >
                           
                                <table id="annualContractListTable" class="table-sticky-header table-responsive table table-hover table-sm">
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
                                            <th class='header'>Commodity</th>
                                            <th class='header'>Container Type</th>
                                            <th class='header'>Annual Volume per Container Type</th>
                                            <th class='header'>Tentative Gross Wt.</th>
                                            <?php foreach ($rfcCategory as $category) {
                                                // $colspan = count($category->subCategory);
                                                echo "<th  class='header'>$category->rfc_category_name Total</th>";
                                            } ?>
                                            <th class='header'>Total</th>
                                            <th class='header'>Counter Rate</th>
                                            <th class='header'>Actions</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php if ($annualContractDetails->routes) {
                                            foreach ($annualContractDetails->routes as $item) {
                                                $this->load->view('frontend/ajax/ajaxContractRFC_Row', [
                                                    'containerCounter' => uniqid(),
                                                    'item_details' => $item,
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
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                <form id="frmRequirement" name="frmRequirement" class="" action="" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label class="m-0"><input type="checkbox" name="accept_terms_and_conditions" id="accept_terms_and_conditions" <?= $annualContractDetails->accept_terms_and_conditions == 1 ? 'checked' : '' ?>> </label> <a href="javascript:void(0);" onclick="$('#modal_terms').modal('show')" class="text-primary">Accept Terms and Conditions <sup>*</sup> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<input type="submit" name="submit" class="submit action-button" value="Save & Continue" />-->
                                    <div class="col-lg-12 text-center">
                                        <?php if (strcasecmp($view, 'true') != 0) { ?>
                                            <input type="submit" name="submitBtn" class="btn btn-submit btn-md" value="Send Quote" />
                                        <?php } ?>
                                        <!-- <input type="submit" name="submit" class="btn btn-submit btn-md" value="Save & continue" /> -->
                                        <a href="<?= base_url('ff-annual-contract-list'); ?>" class="btn btn-secondary btn-md">Cancel</a>
                                    </div>
                                </form>
                            </div>
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

<div class="modal fade" id="modal_terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-100 w-75" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div>
                        <?= $annualContractDetails->terms_and_conditions ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="annual_contract_id" value="<?= $annualContractDetails->id ?>" />
                                <label class="mr-3"><b>Correction:</b></label>
                                <textarea name="correction" id="correction" class="form-control" maxlength="1000" placeholder="Type here..."><?= $annualContractDetails->correction ?></textarea>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <?php if (strcasecmp($view, 'true') != 0) { ?>
                        <input type="submit" class="btn btn-primary" name="submitBtn" value="Save Correction">
                    <?php } ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
        var mode_id = $('#mode_id').val();
        if (confirm("Are your sure" + ' Import from ' + file_data.name + "?")) {
            form_data.append("file", file_data);
            form_data.append("ff_company_id", ff_company_id);
            form_data.append("annual_contract_id", annual_contract_id);
            form_data.append("mode_id", mode_id);
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



    $(document).on('blur', 'input[name^="rfc_charges"]', function(e) {
        var category = $(this).attr('data-category');
        var parentTableId = "#" + $(this).parents('table').attr('id');
        var categoryTotal = 0.00;

        $(parentTableId + ' input[data-category="' + category + '"]').each(function() {
            console.log();
            var charges = parseFloat($(this).val()) || 0.0;
            categoryTotal += charges;
        });
        $(parentTableId + ' #' + category + '.category-total').text(numberWithCommas(categoryTotal.toFixed(2).toString()));
        // var qty = parseFloat(tr.find('input.qty').val()) || 0.0;
        // var total = (charges * qty).toFixed(2);
        // console.log(charges, qty, total);

        // tr.find('input.total').val(total);
        calculateFinalTotal(parentTableId);
    });





    function calculateFinalTotal(parentTableId) {
        var finalTotal = 0;
        var categoryTotal = 0;
        $(parentTableId + ' span.category-total').each(function() {
            categoryTotal = $(this).text();
            categoryTotal = categoryTotal.replace(/,/g, "");//remove coma from string
            finalTotal += parseFloat(categoryTotal) || 0.0
        });
        
        $(parentTableId + ' tfoot .total-charges').text(numberWithCommas(finalTotal.toFixed(2).toString()));
    }

    $('a.copy-counter-offer-single').click(function(){
        var tableRow = $(this).closest('tr');
        var inputCharges = $(tableRow).find('input.charges');
        var counterRate = $(tableRow).find('span.counter-rate');
        $(inputCharges).val($(counterRate).text().replace(/,/g, ""));
        $(inputCharges).focus();
        $(inputCharges).blur();
        
    });
</script>
<script>
    $(document).click(function() {
        $(".dropdown-menu.show").removeClass('show');
    });
</script>
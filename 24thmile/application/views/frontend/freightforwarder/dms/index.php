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

    .breakup-details p {
        margin: 0;
    }

    label {
        font-weight: bold;
        margin-right: 10px;
    }
</style>
<!-- Tracking start -->
<div class="wshipping-content-block">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                        <h3 class="heading3-border">Document Management </h3>
                        <div class="row">
                            <div class="col-lg-12">
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
                                                                <label><?= ($requestDetails->transaction == "Import") ? "De-stuffing" : "Stuffing" ?> :</label>
                                                                <?= $requestDetails->stuffing ?>
                                                            </address>

                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        <div class="form-group" style="display:none;">


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


                                        <div class="form-group" style="display:none;">
                                            <div class="row">
                                                <div class="col-12 col-lg-4">
                                                    <div class="edibx1">
                                                        <label>Shipment Value: </label> <?= $requestDetails->shipment_value_currency . ' ' . $requestDetails->shipment_value; ?>
                                                    </div>

                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="edibx1">
                                                        <label>Port of Loading :</label> <?= $requestDetails->port_loading_name ?>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="edibx1">
                                                        <label>Port of Discharge :</label> <?= $requestDetails->port_discharge_name ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row" style="display:none;">
                                            <div class="col-12 col-lg-4">
                                                <div class="edibx1">
                                                    <label>Tentative Date of Dispatch :</label> <?= printFormatedDate($requestDetails->tentativ_date_dispatch); ?>
                                                </div>
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
                                        <div class="row" style="display:none;">
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
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="shipping-form-block">
                                    <?= $this->session->flashdata('message') ?>
                                    <h3>Pre-Shipment Documents</h3>
                                    <div class="table-responsive">

                                        <table id="tableServerside" class="mdl-data-table" style="width:100%">
                                            <colgroup>
                                                <col width="10%">
                                                <col width="40%">
                                                <col width="20%">
                                                <col width="20%">
                                                <col width="10%">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th class="text-left">#</th>
                                                    <th class="text-left">Document</th>
                                                    <th class="text-left">Inv. No.</th>
                                                    <th class="text-left">Inv. Date</th>
                                                    <th class="text-left">Created on</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $counter=0; foreach ($documetTypeList['pre-shipment'] as $key => $documentType) { ?>
                                                    <?php $documentPermission =checkDocumentPermission($documentType->document,$requestDetails->transaction,$requestDetails->mode,$requestDetails->shipment,'FF');
                                                 if($documentPermission){ ?>
                                                    <tr>
                                                        <td>
                                                            <?= $counter=$counter + 1 ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= $documentType->name ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= $documentType->invoice_number ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= printFormatedDate($documentType->invoice_date) ?>
                                                        </td>

                                                        <td class="text-left">
                                                            <?= printFormatedDate($documentType->created_at) ?>
                                                        </td>

                                                        <td>
                                                        <?php if ($documentType->status == '0' && $documentPermission == 'edit') { ?>
                                                                <a class="btn btn-sm btn-primary" href="<?= base_url("ff-dms/create/$requestDetails->request_id/$documentType->document") ?>">Edit</a>
                                                                <form action="<?= base_url("ff-dms/deleteDocument/$requestDetails->request_id/$documentType->document") ?>" method="post" style="display: inline">
                                                                    <input type="hidden" name="request_id" value="<?= $requestDetails->request_id ?>" />
                                                                    <input type="hidden" name="documentType" value="<?= $documentType->document ?>" />
                                                                    <button type="Submit" name="submit-btn" class="delete-document-btn btn-sm btn btn-danger " style="border: none;cursor: pointer">Delete</button>
                                                                </form>
                                                            <?php } elseif ($documentType->status == '1') { //download link
                                                            ?>
                                                                <a class="btn btn-sm btn-warning" href="<?= base_url("ff-dms/download/$requestDetails->request_id/$documentType->document") ?>">Download</a>
                                                            <?php } else if($documentPermission == 'edit') { ?>
                                                                
                                                               

                                                                <a class="btn btn-sm btn-primary" href="<?= base_url("ff-dms/create/$requestDetails->request_id/$documentType->document") ?>">Create</a>
                                                            <?php } else { ?>
                                                                
                                                                <a class="btn btn-sm btn-danger disabled " aria-disabled="true" href="javascript:void(0);">Pending</a>
                                                               
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <h3 class="mt-3">Post-Shipment Documents</h3>
                                    <div class="table-responsive">

                                        <table id="tableServerside" class="mdl-data-table" style="width:100%">
                                            <colgroup>
                                                <col width="10%">
                                                <col width="40%">
                                                <col width="20%">
                                                <col width="20%">
                                                <col width="10%">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th class="text-left">#</th>
                                                    <th class="text-left">Document</th>
                                                    <th class="text-left">Inv. No.</th>
                                                    <th class="text-left">Inv. Date</th>
                                                    <th class="text-left">Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $counter = 0; foreach ($documetTypeList['post-shipment'] as $key => $documentType) { ?>
                                                    <?php $documentPermission =checkDocumentPermission($documentType->document,$requestDetails->transaction,$requestDetails->mode,$requestDetails->shipment,'FF');
                                                 if($documentPermission){ ?>
                                                    <tr>
                                                        <td>
                                                        <?= $counter=$counter + 1 ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= $documentType->name ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= $documentType->invoice_number ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= printFormatedDate($documentType->invoice_date) ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= printFormatedDate($documentType->created_at) ?>
                                                        </td>

                                                        <td>
                                                        <?php if ($documentType->status == '0' && $documentPermission == 'edit') { ?>
                                                                <a class="btn btn-sm btn-primary" href="<?= base_url("ff-dms/create/$requestDetails->request_id/$documentType->document") ?>">Edit</a>
                                                                <form action="<?= base_url("ff-dms/deleteDocument/$requestDetails->request_id/$documentType->document") ?>" method="post" style="display: inline">
                                                                    <input type="hidden" name="request_id" value="<?= $requestDetails->request_id ?>" />
                                                                    <input type="hidden" name="documentType" value="<?= $documentType->document ?>" />
                                                                    <button type="Submit" name="submit-btn" class="delete-document-btn btn-sm btn btn-danger " style="border: none;cursor: pointer">Delete</button>
                                                                </form>
                                                            <?php } elseif ($documentType->status == '1') { //download link
                                                            ?>
                                                                <a class="btn btn-sm btn-warning" href="<?= base_url("ff-dms/download/$requestDetails->request_id/$documentType->document") ?>">Download</a>
                                                            <?php } else if($documentPermission == 'edit') { ?>
                                                                
                                                               

                                                                <a class="btn btn-sm btn-primary" href="<?= base_url("ff-dms/create/$requestDetails->request_id/$documentType->document") ?>">Create</a>
                                                                <?php } else { ?>
                                                                
                                                                <a class="btn btn-sm btn-danger disabled " aria-disabled="true" href="javascript:void(0);">Pending</a>
                                                               
                                                            <?php } ?>

                                                        </td>
                                                    </tr>
                                                 <?php } ?>
                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>

                                    <h3 class="mt-3">Shipment Instructions Documents</h3>
                                    <div class="table-responsive">

                                        <table id="tableServerside" class="mdl-data-table" style="width:100%">
                                            <colgroup>
                                                <col width="10%">
                                                <col width="40%">
                                                <col width="20%">
                                                <col width="20%">
                                                <col width="10%">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th class="text-left">#</th>
                                                    <th class="text-left">Document</th>
                                                    <th class="text-left">Inv. No.</th>
                                                    <th class="text-left">Inv. Date</th>
                                                    <th class="text-left">Created On</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $counter=0; foreach ($documetTypeList['shipment_instructions'] as $key => $documentType) { ?>
                                                    <?php $documentPermission =checkDocumentPermission($documentType->document,$requestDetails->transaction,$requestDetails->mode,$requestDetails->shipment,'FF');
                                                 if($documentPermission){ ?>
                                                    <tr>
                                                        <td>
                                                        <?= $counter = $counter + 1; ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= $documentType->name ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= $documentType->invoice_number ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= printFormatedDate($documentType->invoice_date) ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?= printFormatedDate($documentType->created_at) ?>
                                                        </td>

                                                        <td>
                                                            <?php if ($documentType->status == '0' && $documentPermission == 'edit') { ?>
                                                                <a class="btn btn-sm btn-primary" href="<?= base_url("fs-dms/create/$requestDetails->request_id/$documentType->document") ?>">Edit</a>
                                                                <form action="<?= base_url("fs-dms/deleteDocument/$requestDetails->request_id/$documentType->document") ?>" method="post" style="display: inline">
                                                                    <input type="hidden" name="request_id" value="<?= $requestDetails->request_id ?>" />
                                                                    <input type="hidden" name="documentType" value="<?= $documentType->document ?>" />
                                                                    <button type="Submit" name="submit-btn" class="delete-document-btn btn-sm btn btn-danger " style="border: none;cursor: pointer">Delete</button>
                                                                </form>
                                                            <?php } elseif ($documentType->status == '1') { //download link
                                                            ?>
                                                                <a class="btn btn-sm btn-warning" href="<?= base_url("fs-dms/download/$requestDetails->request_id/$documentType->document") ?>">Download</a>
                                                            <?php } else if($documentPermission == 'edit') { ?>
                                                                
                                                               

                                                                <a class="btn btn-sm btn-primary" href="<?= base_url("fs-dms/create/$requestDetails->request_id/$documentType->document") ?>">Create</a>
                                                            <?php } else { ?>
                                                                
                                                                <a class="btn btn-sm btn-danger disabled " aria-disabled="true" href="javascript:void(0);">Pending</a>
                                                               
                                                            <?php } ?>

                                                        </td>
                                                       
                                                    </tr>
                                                <?php  } ?>
                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>

                                </div>
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

<script>
    $(document).click(function() {
        $(".dropdown-menu.show").removeClass('show');
    });

    $(document).on('click', '.delete-document-btn', function(e) {
        var currentElement = this;

        e.preventDefault();
        if (confirm("Are your sure you want to delete document?")) {
            $(currentElement).closest('form').submit();
            return true
        }


    });
</script>
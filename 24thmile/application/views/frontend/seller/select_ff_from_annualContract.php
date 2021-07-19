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
            <?php //vdebug($ff_list); 
            ?>
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <ul class="nav nav-tabs" role="tablist">

                        <li class="nav-item"><a class="nav-link " href="<?= base_url("select-ff-shipping-requirement/$request_id") ?>" aria-controls="selectFF">Select Freight Comparative </a></li>
                        <li class="nav-item"><a class="nav-link active " href="<?= base_url("select-ff-from-annual-contract/$request_id") ?>" aria-controls="useContract">Use Contract </a></li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="useContract">
                            <div id="message-block">
                                <?= $this->session->flashdata('message') ?>
                            </div>


                            <h3 class="heading3-border">Use Contract </h3>
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

                            <div class="form-group" style="margin-top: 20px;">
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

                            <form method="post" action="">

                                <!-- <div class="input-group mb-3">
                                    <select class=" chosen-select col" multiple="" name="sr_sector[]" data-placeholder="Select some sectors">
                                        <?php foreach ($sectors as $sector) { ?>
                                            <option <?= in_array($sector['id'], $filterData['sectors']) ? 'selected' : '' ?> value="<?php echo $sector['id']; ?>"><?php echo $sector['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="text" class="form-control" name="location" maxlength="15" placeholder="Location e.g. India" value="<?= $filterData['location'] ?>">
                                    <input type="text" class="form-control" name="name" maxlength="15" placeholder="Company Name" value="<?= $filterData['name'] ?>">
                                    <div class="input-group-append">
                                        <input type="submit" class="btn btn-submit btn-sm" name="btn_submit" value="Search">
                                        &nbsp;
                                        <a href="" class="btn btn-sm btn-secondary">Reset</a>
                                    </div>
                                </div> -->
                                <div class="clearfix mb-3">
                                    <input type="submit" class="btn btn-submit btn-sm" name="btn_submit" value="Save & Continue">
                                    &nbsp;
                                    <a href="<?= base_url('fs-request-list'); ?>" class="btn btn-secondary btn-sm">Cancel</a>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class='header'>#</th>
                                            <th class='header'>Service Provider</th>
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
                                            <th class='header'>Container Type</th>
                                            <!-- <th>Address</th> -->
                                            <!--<th>Transaction Currency</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ff_list as $ff) { ?>
                                            <tr>
                                                <td>
                                                    <!-- value = route_id|ff_company_id-->
                                                    <input type="checkbox" name="selected_route_id_ff_company_id[]" value="<?= "$ff->id|$ff->ff_company_id" ?>" <?= in_array($ff->ff_company_id, $selectedFFids) ? 'checked disabled' : '' ?>>
                                                </td>
                                                <td>
                                                    <?= $ff->ff_company_name; ?>
                                                </td>
                                                <td>
                                                    <?= $ff->loading_place; ?>
                                                </td>
                                                <td>
                                                    <?= $ff->loading_country; ?>

                                                </td>
                                                <td>
                                                    <?= $ff->port_loading_name; ?>
                                                </td>
                                                <td>
                                                    <?= $ff->discharge_place; ?>
                                                </td>
                                                <td>
                                                    <?= $ff->discharge_country; ?>
                                                </td>
                                                <td>
                                                    <?= $ff->port_discharge_name; ?>

                                                </td>
                                                <td>
                                                    <?= $ff->mode; ?>
                                                </td>
                                                <td>
                                                    <?= $ff->transaction; ?>
                                                </td>
                                                <td>
                                                    <?= $ff->container_stuffing; ?>
                                                </td>
                                                <td>
                                                    <?= $ff->cargo_status; ?>
                                                </td>
                                                <td>
                                                    <?= $ff->shipment; ?>
                                                </td>

                                                <td>
                                                    <?= $ff->currency; ?>
                                                </td>

                                                <td>
                                                    <?= $ff->container_type; ?>
                                                </td>



                                            </tr>
                                        <?php } ?>
                                        <?php if (empty($ff_list)) { ?>
                                            <tr>
                                                <td colspan="15">Data not available.</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <div class="clearfix">
                                    <input type="submit" class="btn btn-submit btn-sm" name="btn_submit" value="Save & Continue">
                                    &nbsp;
                                    <a href="<?= base_url('fs-request-list'); ?>" class="btn btn-secondary btn-sm">Cancel</a>
                                </div>

                            </form>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
<script type="text/javascript">
    $(".chosen-select").chosen();
</script>
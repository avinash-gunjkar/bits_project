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
    span.badge{
        position: inherit;
        color: #fff;
        border-radius: 5px;
    }
    span.badge.badge-success{
        background-color: #2e7d32;
    }
    span.badge.badge-info{
        background-color: #1e88e5;
    }
    span.badge.badge-warning{
        background-color: #ffa000;
    }
    span.badge.badge-danger{
        background-color: #e53935;
    }
    fieldset{
        display: none;
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
                    <h5 class="breadcrumbs-title">Shipment Tracking</h5>
                    <ol class="breadcrumbs">
                        <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <!-- <li><a href="<?=base_url('admin/company-list');?>">Master</a></li> -->
                       <?php if($company_id){?>
                        <li><a href="<?=base_url("admin/view-company-details/$company_id");?>">Company</a></li>
                        <li ><a href="<?=base_url("admin/booking-list/$company_id");?>">Booking List</a></li>
                       <?php }?>
                        <li class="active">Shipment Tracking</li>
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
                                            <address class="mb-1"><label>RFC ID:</label> <?= $bookedShipment->request_id ?></address>
                                            <address class="mb-1"><label>RFC Date : </label>
                                                <?= printFormatedDate($bookedShipment->created_at) ?></address>
                                            <address class="mb-1"><label>Freight Forwarder : </label>
                                                <?php if (!empty($ff_details->company_id)) { ?>
                                                    <a href="<?= base_url('admin/view-company-details/' . $ff_details->company_id) ?>" target="_blank"><?= $ff_details->name ?></a>
                                                <?php } else { ?>
                                                    <span>- -</span>
                                                <?php } ?>
                                            </address>
                                            <address>
                                                <label>Shipment Status:</label>
                                                <span class='status <?= str_replace(' ', '-', strtolower($bookedShipment->status_title)) ?>'><?= $bookedShipment->status_title ? $bookedShipment->status_title : '- -' ?></span>
                                                <span class="text-warning"> <?= $bookedShipment->status == 4 ? ' - Decision (Accept / Reject) Pending By Freight Forwarder' : '' ?></span>
                                            </address>
                                        </td>
                                        <td class="text-left">
                                            <address class="mb-1">
                                                <label>Transaction : </label>
                                                <?= $bookedShipment->transaction ?>
                                            </address>
                                            <address class="mb-1">
                                                <label>Mode : </label>
                                                <?= $bookedShipment->mode ?>
                                            </address>
                                            <address class="mb-1">
                                                <label>Delivery Term :</label>
                                                <?= $bookedShipment->delivery_term_name ?>
                                            </address>
                                            <address class="mb-1">
                                                <label>Shipment Type :</label><?= $bookedShipment->shipment ?>
                                            </address>
                                        </td>
                                        <td class="text-left">
                                            <address class="mb-1">
                                                <label>Cargo :</label> <?= $bookedShipment->container_stuffing ?>
                                            </address>
                                            <address class="mb-1">
                                                <label>Cargo Nature :</label>
                                                <?= $bookedShipment->cargo_status ?>

                                            </address>
                                            <?php if (!empty($bookedShipment->stuffing)) { ?>
                                                <address class="mb-1">
                                                    <label><?=($bookedShipment->transaction == "Import")?"De-stuffing":"Stuffing"?> :</label>
                                                    <?= $bookedShipment->stuffing ?>
                                                </address>

                                            <?php } ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    <div class="card-panel">
                        <h4 class="header2">Tracking Steps</h4>
                        
                                <!-- progressbar -->
                                <ul id="progressbar">

                                    <?php //vdebug(['bookedShipment'=>$bookedShipment,'stepData'=>$stepData,'currentStep'=>$currentStep,'shipmentProcessData'=>$shipmentProcessData]); 
                                    $loadedOn_arr[3] = 'Vessel';
                                    $loadedOn_arr[2] = 'Flight';
                                    $loadedOn_arr[1] = 'Truck';
                                    
                                    foreach ($stepData as $key => $steps) { ?>

                                        <li class="<?php echo (in_array($steps->id, $completedStep)) ? 'active' : '' ?> <?=($steps->id==$currentStep->step_id && $bookedShipment->status == 5)?' current-step ':''?>">
                                            <div class="step-label"><?php echo $steps->step_name; ?> <?= ($steps->id == 6 || $steps->id == 16) ? $loadedOn_arr[$bookedShipment->mode_id] : '' ?></div>
                                            <?php
                                            $data = [
                                                'bookedShipment' => $bookedShipment,
                                                'stepData' => $stepData,
                                                'currentStep' => $currentStep,
                                                'shipmentProcessData' => $shipmentProcessData,
                                                'key' => $key,
                                                'loadedOn_str' => $loadedOn_arr[$bookedShipment->mode_id],
                                                'skipComparative' => $skipComparative
                                            ];
                                            $this->load->view("backend/company/tracking-steps/step_$steps->id", $data) ?>
                                        </li>
                                    <?php } ?>
                                </ul>
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
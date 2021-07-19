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

    .action-button {
        background-color: #0088FF;
        border-color: #0088FF;
        color: #fff;
        border: 1px solid #0088FF;
        font-weight: 600;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
    }

    @media (min-width: 840px) {
        .mdl-grid {
            padding: 8px;
            width: 100% !important;
        }
    }

    ul#ui-id-1 {
        z-index: 9999 !important;
        padding: 3px !important;
        border: 1px solid #e2e9e6 !important;
        background: #fff !important;
        width: 16.5% !important;
        height: 200px !important;
        overflow: auto !important;
    }

    ul#ui-id-2 {
        z-index: 9999 !important;
        padding: 3px !important;
        border: 1px solid #e2e9e6 !important;
        background: #fff !important;
        width: 16.5% !important;
        height: 200px !important;
        overflow: auto !important;
    }

    /*.hideStepSection{
	opacity: 0; 
	display: none;
}*/
    .css-animated-loader {
        float: right;
    }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Tracking start -->
<div class="wshipping-content-block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">

                        <h3 class="heading3-border">Track your Shipment </h3>
                        <div class="shipping-form-block">
                            <form id="trackingFrm" name="trackingFrm" class="steps" action="<?php echo base_url('seller/upload_import_process_documents'); ?>" enctype="multipart/form-data" method="post">
                                <input type="hidden" name="request_id" value="<?php echo $bookedShipment->request_id; ?>">

                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-left">
                                                <address class="mb-1"><label>RFC ID:</label> <?= $bookedShipment->request_id ?></address>
                                                <address class="mb-1"><label>RFC Date : </label>
                                                    <?= printFormatedDate($bookedShipment->created_at) ?></address>
                                                <address class="mb-1"><label>Freight Forwarder : </label>
                                                    <a href="<?= base_url('company-details/' . $ff_details->company_id) ?>" target="_blank"><?= $ff_details->name ?></a>
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
                                                    </div>
                                                <?php } ?>
                                                </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <!-- <div class="row">
                                    <div class="col-12 col-lg-2">
                                        <label>RFC ID : </label>
                                        <?= $bookedShipment->request_id ?>
                                    </div>
                                    <div class="col-12 col-lg-2">
                                    <label>RFC Date : </label>
                                        <?= printFormatedDate($bookedShipment->created_at) ?>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label>Freight Forwarder : </label>
                                        <a href="<?= base_url('company-details/' . $ff_details->company_id) ?>" target="_blank"><?= $ff_details->name ?></a>
                                    </div>
                                </div> -->
                                <!-- <div class="row">


                                    <div class="col-12 col-lg-2 mb-2">
                                        <div class="edibx">
                                            <label>Mode : </label>
                                            <?= $bookedShipment->mode ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 mb-2">
                                        <div class="edibx">
                                            <label>Transaction : </label>
                                            <?= $bookedShipment->transaction ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 mb-2">
                                        <div class="edibx">
                                            <label>Delivery Term :</label>
                                            <?= $bookedShipment->delivery_term_name ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 mb-2">
                                        <div class="edibx">
                                            <label>Shipment Type :</label><?= $bookedShipment->shipment ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 mb-2">
                                        <div class="edibx">
                                            <label>Container Stuffing :</label> <?= $bookedShipment->container_stuffing ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 mb-2">
                                        <div class="edibx">
                                            <label>Cargo Status :</label>
                                            <?= $bookedShipment->cargo_status ?>
                                        </div>
                                    </div>
                                    <?php if (!empty($bookedShipment->stuffing)) { ?>
                                        <div class="col-12 col-lg-2 mb-2">
                                            <div class="edibx">
                                                <label>Stuffing :</label>
                                                <?= $bookedShipment->stuffing ?>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div> -->
                                <h3 class="heading3-border mt-5">Tracking Steps</h3>
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <?php $loadedOn_arr[3] = 'Vessel';
                                    $loadedOn_arr[2] = 'Flight';
                                    $loadedOn_arr[1] = 'Truck';
                                    // vdebug( [$currentStep,$completedStep]);
                                    //                                            vdebug(['bookedShipment'=>$bookedShipment,'stepData'=>$stepData,'currentStep'=>$currentStep,'shipmentProcessData'=>$shipmentProcessData,'key'=>$key]);
                                    foreach ($stepData as $key => $steps) { ?>
                                        <li class="<?php echo (in_array($steps->id, $completedStep)) ? 'active' : '' ?> <?=($steps->id==$currentStep->step_id && $bookedShipment->status == 5)?' current-step ':''?>" >
                                            <?php
                                            if (in_array($bookedShipment->delivery_term_id, ['3', '4', '5', '6', '7']) && $steps->id == 12) {
                                                $steps->step_name = str_replace('Pre', "Post", $steps->step_name);
                                            }
                                            ?>
                                            <div class="step-label"><?php echo $steps->step_name; ?> <?= ($steps->id == 16) ? $loadedOn_arr[$bookedShipment->mode_id] : '' ?></div>
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
                                            $this->load->view("frontend/seller/tracking-steps/step_$steps->id", $data) ?>
                                        </li>
                                    <?php } ?>
                                </ul>

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

<script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript">
    $('#trackingFrm').validate({
        rules: {
            'billl_of_lading': {
                extension: 'jpg|jpeg|png|pdf|docx|xlsx'
            },
            'commercial_invoice': {
                extension: 'jpg|jpeg|png|pdf|docx|xlsx'
            },
            'step1_import_packing_list': {
                extension: 'jpg|jpeg|png|pdf|docx|xlsx'
            },
            'certificate_of_origin': {
                extension: 'jpg|jpeg|png|pdf|docx|xlsx'
            },
            'step1_import_other_documents': {
                extension: 'jpg|jpeg|png|pdf|docx|xlsx'
            }
        },
        messages: {
            'billl_of_lading': {
                extension: 'Please select file with a valid extentions (.jpg, .jpeg, .png, .pdf, .docx, .xlsx).'
            },
            'commercial_invoice': {
                extension: 'Please select file with a valid extentions (.jpg, .jpeg, .png, .pdf, .docx, .xlsx).'
            },
            'step1_import_packing_list': {
                extension: 'Please select file with a valid extentions (.jpg, .jpeg, .png, .pdf, .docx, .xlsx).'
            },
            'certificate_of_origin': {
                extension: 'Please select file with a valid extentions (.jpg, .jpeg, .png, .pdf, .docx, .xlsx).'
            },
            'step1_import_other_documents': {
                extension: 'Please select file with a valid extentions (.jpg, .jpeg, .png, .pdf, .docx, .xlsx).'
            }
        }
    });

    $('.editbtn').click(function(e) {
        var $fieldset = $(this).parent('fieldset');

        $fieldset.find('.editableDataDiv').slideDown(300);
        $fieldset.find('.readonlyDataDiv').slideUp(300);
        $fieldset.find('input[type="submit"]').show();
        $fieldset.find('.editbtn').hide();
    });
    $('.cancelBtn').click(function() {
        window.location.reload();
    })
</script>
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
                            <form  class="steps" name="trackingFrm" id="trackingFrm" action="<?php echo base_url('freightforwarder/upload_import_process_documents'); ?>" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="request_id" value="<?php echo $bookedShipment->request_id; ?>">  
                            
                            <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-left">
                                                <address class="mb-1"><label>RFC ID:</label> <?= $bookedShipment->request_id ?></address>
                                                <address class="mb-1"><label>RFC Date : </label>
                                                    <?= printFormatedDate($bookedShipment->created_at) ?></address>
                                                <address class="mb-1"><label>Exporter-Importer:</label>
                                                <a href="<?= base_url('seller-company-details/' . $fs_details->company_id) ?>" target="_blank"><?= $fs_details->name ?></a>
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
                                <h3 class="heading3-border mt-5">Tracking Steps</h3>
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <?php $loadedOn_arr[3] = 'Vessel';
                                    $loadedOn_arr[2] = 'Flight';
                                    $loadedOn_arr[1] = 'Truck';
                                    
                                    foreach ($stepData as $key => $steps) { ?>
                                        <li class="<?php echo (in_array($steps->id, $completedStep)) ? 'active' : '' ?> <?=($steps->id==$currentStep->step_id && $bookedShipment->quote_status == 5)?' current-step ':''?>">
                                            <?php 
                                            if(in_array($bookedShipment->delivery_term_id, ['3', '4', '5', '6', '7']) && $steps->id==12){
                                                $steps->step_name = str_replace('Pre',"Post",$steps->step_name);
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
                                            $this->load->view("frontend/freightforwarder/tracking-steps/step_$steps->id", $data) ?>
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
            'Final_Bill_of_lading': {
                extension: 'jpg|jpeg|png|pdf|docx|xlsx'
            },
            'bill_of_entry': {
                extension: 'jpg|jpeg|png|pdf|docx|xlsx'
            },
            'invoice_confirm': {
                extension: 'jpg|jpeg|png|pdf|docx|xlsx'
            },
        },
        messages: {
            'Final_Bill_of_lading': {
                extension: 'Please select file with a valid extentions (.jpg, .jpeg, .png, .pdf, .docx, .xlsx).'
            },
            'bill_of_entry': {
                extension: 'Please select file with a valid extentions (.jpg, .jpeg, .png, .pdf, .docx, .xlsx).'
            },
            'invoice_confirm': {
                extension: 'Please select file with a valid extentions (.jpg, .jpeg, .png, .pdf, .docx, .xlsx).'
            },
        }
    });
    $('.editbtn').click(function(e){
        var $fieldset = $(this).parents('fieldset');
        
        $fieldset.find('.editableDataDiv').slideDown(300);
        $fieldset.find('.readonlyDataDiv').slideUp(300);
        $fieldset.find('input[type="submit"]').show();
        $fieldset.find('.editbtn').hide();
    });

    $('.cancelBtn').click(function(){
        
        window.location.reload();
    })

    $('input[name="boe_type"]').change(function(){
        var boe_type = $('input[name="boe_type"]:checked').val();
        console.log(boe_type);
        if(boe_type=='Bonded'){
            $('#RegularBOE').hide();
            $('#BondedBOE').show();
        }else{
            $('#RegularBOE').show();
            $('#BondedBOE').hide();
        }
    });

    $('input[name="step7_import_boe_type"]').change(function(){
        var boe_type = $('input[name="step7_import_boe_type"]:checked').val();
        console.log(boe_type);
        if(boe_type=='Bonded'){
            $('#step7_import_RegularBOE').hide();
            $('#step7_import_BondedBOE').show();
        }else{
            $('#step7_import_RegularBOE').show();
            $('#step7_import_BondedBOE').hide();
        }
    });

    $('input[name="step6_import_inbond"]').click(function(){
        $('input[name$="_inbond"]').attr('required',true);
        $('input[name$="_exbond"]').removeAttr('required');
        $('input[name$="_inbond"][type="file"]').removeAttr('required');
    });
    $('input[name="step6_import_exbond"]').click(function(){
        $('input[name$="_exbond"]').attr('required',true);
        $('input[name$="_inbond"]').removeAttr('required');
        $('input[name$="_exbond"][type="file"]').removeAttr('required');
    });
    
    $('input[name="step7_import_inbond"]').click(function(){
        $('input[name$="_inbond"]').attr('required',true);
        $('input[name$="_exbond"]').removeAttr('required');
        $('input[name$="_inbond"][type="file"]').removeAttr('required');
    });
    $('input[name="step7_import_exbond"]').click(function(){
        $('input[name$="_exbond"]').attr('required',true);
        $('input[name$="_inbond"]').removeAttr('required');
        $('input[name$="_exbond"][type="file"]').removeAttr('required');
    });

    $('.import-under-schment').change(function(){
        var selectedValue = $(this).val();
        var target = $(this).attr('data-target');
        if(selectedValue=='Advance Authorization'){
            $(target+' label').text('Advance Authorization license No.:');
            $(target).slideDown();
        }else if(selectedValue=='Export Promotion Capital Goods'){
            $(target+' label').text('Export Promotion Capital Goods license No.:');
            $(target).slideDown();
        }else{
            $(target).slideUp();
        }
    });

</script>
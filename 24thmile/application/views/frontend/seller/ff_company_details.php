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
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                        
                        <h3 class="heading3-border">Company Details </h3>
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Company Logo:</label>
                                <img id="logoPreview" src="<?= base_url('uploads/company/' . $companyDetails->company_logo); ?>" onerror="this.src='http://localhost/JB098/uploads/default.png'" style="height:50px;width: 50px; object-fit: contain;" alt="<?= $companyDetails->company_logo_original_name ?>">

                            </div>
                            <div class="col-lg-3">
                                <label>Company Name:</label> <?= $companyDetails->name ? $companyDetails->name : '- -' ?>
                            </div>
                            <div class="col-lg-3">
                                <label>Address:</label> <?= ($companyDetails->address_line_1 ? $companyDetails->address_line_1 : '- -') . ' ' . $companyDetails->address_line_2 ?>
                            </div>
                            <div class="col-lg-3">
                                <label>City:</label> <?= $companyDetails->city_name ? $companyDetails->city_name : '- -' ?>
                            </div>
                            <div class="col-lg-3">
                                <label>Pin Code:</label> <?= $companyDetails->pincode ? $companyDetails->pincode : '- -' ?>
                            </div>
                            <div class="col-lg-3">
                                <label>Transaction Currency:</label> <?= $companyDetails->transaction_currency ? $companyDetails->transaction_currency : '- -' ?>
                            </div>
                            <div class="col-lg-3">
                                <label>Website:</label>
                                <?php if (!empty($companyDetails->website)) { ?>
                                    <a href="<?= $companyDetails->website ?>" target="_blank"><?= $companyDetails->website ?></a>
                                <?php } else { ?>
                                    - -
                                <?php } ?>
                            </div>
                        </div>
                        <?php if (!empty($companyDetails->description)) { ?>
                            <h3>Company Description</h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?= $companyDetails->description ?>
                                </div>
                            </div>
                        <?php } ?>
                        <h3>Contact Person</h3>
                        <div class="row">

                            <div class="col-lg-3">
                                <label>Name:</label> <?= $companyDetails->head_salutation . ' ' . ($companyDetails->head_firstname ? $companyDetails->head_firstname : '- -') . ' ' . $companyDetails->head_lastname ?>
                            </div>
                            <div class="col-lg-3">
                                <label>Email:</label> <?= $companyDetails->head_email ? $companyDetails->head_email : '- -' ?>
                            </div>
                            <div class="col-lg-3">
                                <label>Phone:</label> <?= $companyDetails->head_country_code . ' ' . ($companyDetails->head_phone ? $companyDetails->head_phone : '- -') ?>
                            </div>
                            <div class="col-lg-3">
                                <label>Land Line:</label> <?= $companyDetails->head_landline ? $companyDetails->head_landline : '- -' ?>
                            </div>
                            <div class="col-lg-3">
                                <label>Fax:</label> <?= $companyDetails->head_fax ? $companyDetails->head_fax : '- -' ?>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <h3>KYC Documents</h3>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            
                                            <th>Document Name</th>
                                            <th>Document Number</th>
                                            <th>Document</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $isdata=false; foreach ($companyDetails->kyc_documents as $key => $document) { ?>
                                            <?php if($document['details']->status){ $isdata=true; ?>
                                            <tr>
                                                
                                                <td class="text-left"><?= $document['documnetName'] ?></td>
                                                <td class="text-left"><?= $document['details']->number ?></td>
                                                <td>
                                                    <div class=" text-center">
                                                        <a href="<?php echo base_url() . 'uploads/kyc_documents/' . $document['details']->file; ?>" target="_blank">
                                                            View Document
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php } ?>

                                        <?php if(!$isdata){?>
                                            <tr><td colspan="3">No data avilable</td></tr>
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
</div>
<!-- Blog content end -->
</section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->
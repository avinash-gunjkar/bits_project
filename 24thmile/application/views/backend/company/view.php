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
    p:empty::before{
        content: '- -';
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
        <?php $companyUrl = $companyProfile->role=='2'?"admin/company/exporter-importer":"admin/company/freight-forwarder"?>
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title">Company Details</h5>
                    <ol class="breadcrumbs">
                        <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                        </li>
                        <li><a href="<?= base_url($companyUrl) ?>">Master</a>
                        </li>
                        <li class="active">Company</li>
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
                            <h4 class="header2">Company Details <small>(<?=$companyProfile->role=='2'?"Exporter-Importer":"Freight Forwarder"?>)</small></h4>
                            <div class="row">
                                <div class="col l2 s6 m6">
                                    <img id="logoPreview" src="<?php echo base_url() . 'uploads/company/' . $companyProfile->company_logo; ?>" onerror='this.src="<?php echo base_url() . 'uploads/default.png'; ?>"' style="width: 100%; object-fit: contain;" />
                                </div>
                                <div class="col l5 s6 m6">
                                    <h6>
                                        <strtong><?= $companyProfile->name ?></strong>
                                    </h6>
                                    <address>
                                        <small><?= $companyProfile->address_line_1 . ' ' . $companyProfile->address_line_2 ?></small>
                                    </address>
                                    <address>
                                        <small><?= $companyProfile->city_name . ' Pincode:' . $companyProfile->pincode ?></small>
                                    </address>
                                </div>
                                <div class="col l5 s12 m6">
                                    <h6>Status: <?=$companyProfile->isActive=='1'?'<span class=" task-cat green">Active</span>':'<span class=" task-cat red">Inactive</span>'?></h6>
                                    
                                </div>


                                <div class="col l12 s12 m12">

                                    <div class="row">
                                        <div class="col l4 s12 m4">
                                            <h6>Industry Type:</h6>
                                            <p><?= implode(', ',$companyProfile->selected_industries) ?></p>
                                        </div>
                                        <div class="col l4 s12 m4">
                                            <h6>Industry Sector:</h6>
                                            <p><?= implode(', ',$companyProfile->selected_sectors) ?></p>
                                        </div>

                                   
                                        <div class="col l4 s12 m4">
                                            <h6>Website:</h6>
                                            <p><?= $companyProfile->website ?></p>
                                        </div>
                                        <div class="col l4 s12 m4">
                                            <h6>Transaction Currency:</h6>
                                            <p><?= $companyProfile->transaction_currency ?></p>
                                        </div>

                                   
                                        <div class="col l4 s12 m4">
                                            <h6>Average annual import:</h6>
                                            <p><?=$companyProfile->average_annual_import?></p>
                                        </div>
                                        <div class="col l4 s12 m4">
                                            <h6>Average annual export:</h6>
                                            <p><?=$companyProfile->average_annual_export?></p>
                                        </div>

                                    </div>
                                    

                                </div>

                                <div class="col l12 s12 m12">
                                    <h6>Company Profile Summary:</h6>
                                    <blockquote><?= $companyProfile->description ?></blockquote>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m12 l12 ">
                        <div class="card-panel">
                            <h4 class="header2">Company Head Details</h4>
                            <div class="row">
                                <div class="col l4 m4 s6">
                                    <h6>Head Name:</h6>
                                    <p><?= $companyProfile->head_firstname ?></p>
                                </div>
                                <div class="col l4 m4 s6">
                                <h6>Head Email Address:</h6>
                                    <p><?= $companyProfile->head_email ?></p>
                                </div>
                                
                                <div class="col l4 m4 s6">
                                <h6>Head Mobile:</h6>
                                    <p><?= $companyProfile->head_country_code.' '.$companyProfile->head_phone ?></p>
                                </div>
                                <div class="col l4 m4 s6">
                                <h6>Phone Number/Landline:</h6>
                                    <p><?= $companyProfile->head_landline ?></p>
                                </div>


                                <div class="col l4 m4 s6">
                                <h6>Fax Number:</h6>
                                    <p><?= $companyProfile->head_fax ?></p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m12 l12 ">
                        <div class="card-panel">
                            <h4 class="header2">KYC Documents</h4>
                            <div class="row">
                            <form id="uploadKYC" action="" method="post" enctype="multipart/form-data">
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <!--<th>Sr. No.</th>-->
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Document</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $showSaveBtn=false; foreach ($companyProfile->kyc_documents as $key=>$doc) { ?>
                                            
                                                <tr>
                                                    <!--<td></td>-->
                                                    <td><?= $doc['documnetName'] ?></td>
                                                    
                                                    <td>
                                                    <?php if( is_file('uploads/kyc_documents/' . $doc['details']->file) ){?>
                                                        <?= $doc['details']->number ? $doc['details']->number : '- -' ?>
                                                        <?php } else{ ?>
                                                            <input type="text" name="document_number[<?= $key ?>]"  value="<?= $doc['details']->number ?>">
                                                            <?php }?>
                                                    </td>

                                                    <td>
                                                    <?php if( is_file('uploads/kyc_documents/' . $doc['details']->file) ){?>

                                                        <a target="_blank" href="<?= base_url('uploads/kyc_documents/') . $doc['details']->file ?>"><?= $doc['details']->original_file_name ?></a>
                                                        <?php } else{ $showSaveBtn=true;?>
                                                            <input type="file" class="form-control preview <?= $doc['is_mandatory'] ? '' : '' ?> validImage" data-previewTarget="#kycPreview<?= $key ?>" name="kyc_documents[<?= $key ?>]" id="kyc_documents<?= $doc['type'] ?>"/>
                                                            
                                                            <input type="hidden"  name="doc_name[<?= $key ?>]" value="<?= $doc['type'] ?>"/>
                                                            <input type="hidden"  name="old_doc_name[<?= $key ?>]" value="<?= $doc['details']->file ?>"/>
                                                        <?php }?>
                                                        
                                                    </td>
                                                    <td><?= $doc['details']->status ? '<span class=" task-cat green">Approved</span>' : '<span class=" task-cat red">Approval Pending</span>' ?></td>
                                                </tr>
                                            

                                        <?php } ?>

                                    </tbody>
                                </table>
                                <?php if($showSaveBtn){?>
                                <button type="submit" class="btn btn-submit">Save</button>
                                <?php }?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m12 l12 ">
                        <div class="card-panel">
                            <h4 class="header2">Company Users</h4>
                            <div class="row">
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>User Role</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user_list as $key=>$user) { ?>
                                            
                                                <tr>
                                                    <td><?=$key+1?></td>
                                                    <td><?= $user->salutation.' '.$user->firstname.' '.$user->lastname ?></td>
                                                    <td><?= $user->email ? $user->email : '- -' ?></td>
                                                    <td><?= $user->country_code.' '.$user->phone ?></td>
                                                    <td><?= str_replace('_',' ',$user->company_role) ?></td>
                                                    <td><?= $user->isActive ? '<span class=" task-cat green">Active</span>' : '<span class=" task-cat red">Inactive</span>' ?></td>
                                                </tr>
                                            

                                        <?php } ?>
                                        <?php if(empty($user_list)){?>
                                <tr>
                                    <td colspan="6">No data available in table</td>
                                </tr>
                                <?php }?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12 ">
                        <div class="card-panel">
                            <h4 class="header2">Company Branches</h4>
                            <div class="row">
                            <table class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Branch Name</th>
                                  <th>Address</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Fax</th>
                                  <th>Contact Person</th>
                                  
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($branch_list as $key=>$branch) { ?>
                                <tr>
                                  <td><?=$key+1?></td>
                                  <td><?=$branch->branch_name?></td>
                                  <td><?=$branch->address_line_1?><br><?=$branch->address_line_2?></td>
                                  <td><?=$branch->email?></td>
                                  <td><?=$branch->phone?></td>
                                  <td><?=$branch->fax?></td>
                                  <td><?=$branch->contact_person?></td>
                                  
                                </tr>
                              <?php }?>
                             <?php if(empty($branch_list)){?>
                                <tr>
                                    <td colspan="7">No data available in table</td>
                                </tr>
                                <?php }?>
                          </tbody>
                      </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m12 l12 ">
                        <div class="card-panel">
                            <!--<h4 class="header2">KYC Documents</h4>-->
                            <div class="row">

                                <a href="<?= base_url($companyUrl) ?>" class="waves-effect waves-light blue btn">Company list</a>
                                <a href="<?= base_url('admin/rfc-list/'.$companyProfile->id) ?>" class="waves-effect waves-light deep-purple darken-4 btn">Request for Freight Comparative</a>
                                <a href="<?= base_url('admin/booking-list/'.$companyProfile->id) ?>" class="waves-effect waves-light lime darken-4 btn">Shipment Booking & tracking</a>
                            </div>
                        </div>
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
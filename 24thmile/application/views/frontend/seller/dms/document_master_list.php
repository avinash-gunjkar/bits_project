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

    table.table tbody tr th,table.mdl-data-table tr td {
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
        <form action="<?=base_url('fs-create-document-master-form')?>" method="get">
            <label for="">RFC ID:</label>
            <input type="text" maxlength="8" name="request_id" class="only-numbers">
            <input type="submit" value="Create New Information Form" class="btn bnt-sm btn-primary">
        </form>
    </div>
</div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="shipping-form-block">
                                    <?= $this->session->flashdata('message') ?>

                                    <div class="table-responsive" style="height:100vh;">

                                        <table id="tableServerside" class="mdl-data-table" style="width:100%">
                                            <!-- <colgroup>
                                                <col width="10%">
                                                <col width="40%">
                                                <col width="20%">
                                                <col width="20%">
                                                <col width="10%">
                                            </colgroup> -->
                                            <thead>
                                                <tr>
                                                   
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">RFC ID</th>
                                                    <th class="text-center">Transaction</th>
                                                    <th class="text-center">Exporter</th>
                                                    <th class="text-center">Consignee</th>
                                                    <th class="text-center">Buyer</th>
                                                    <th class="text-center">Created on</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($masterForms)){ ?>
                                                <?php foreach($masterForms as $masterForm){
                                                    $other_details = json_decode($masterForm->other_details) ?>
                                                    <tr>
                                                    <td class="text-center"><?=sprintf('DOC-%08d', $masterForm->id)?></td>
                                                    <td class="text-center"><?=$masterForm->request_id?$masterForm->request_id:'--'?></td>
                                                    <td class="text-center"><?=$masterForm->transaction?></td>
                                                    <td class="text-center"><?=$other_details->exporter_company_name?></td>
                                                    <td class="text-center"><?=$other_details->consignee_company_name?></td>
                                                    <td class="text-center"><?=$other_details->buyer_company_name?></td>
                                                    <td class="text-center"><?=printFormatedDate($masterForm->created_at)?></td>
                                                    <td class="text-center">
                                                        <div class='drplist'><a href='javascript:void(0);'>
                                                                <i class='fa fa-ellipsis-v' aria-hidden='true'></i></a>
                                                            <ul class='d-list'>
                                                                <li><a href="<?=base_url('fs-edit-document-master-form?mf='.$masterForm->id)?>" >Edit</a></li>
                                                                <li><a href="<?=base_url("fs-dms?mf=$masterForm->id".($masterForm->request_id?"&rq=$masterForm->request_id":''))?>" >Documents</a></li>
                                                                <li>
                                                                <form action="<?= base_url("fs-delete-document-master-form") ?>" method="post" style="display: inline">
                                                                    <input type="hidden" name="master_form_id" value="<?= $masterForm->id ?>" />
                                                                    <button type="Submit" name="submit-btn" class="delete-document-btn btn-sm btn btn-danger " style="border: none;cursor: pointer">Delete</button>
                                                                </form>
                                                                
                                                                
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php }?>
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
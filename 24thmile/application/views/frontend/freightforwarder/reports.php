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

    .dataTables_length .form-control.input-sm {
        margin: 0px 10px;
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
                        <h3 class="heading3-border"><?= $reportType ?> Report
                            <a style="float:right;" href="<?= base_url('ff-reports/' . $reportType . "?download=true&from_dt=$from_dt&to_dt=$to_dt") ?>" class="btn btn-primary btn-sm pull-right mt-2 mx-3">Download Xls Report</a>
                            <a style="float:right;" href="<?= base_url('ff-reports/' . $reportType . "?send=true&from_dt=$from_dt&to_dt=$to_dt") ?>" class="btn btn-success btn-sm pull-right mt-2 mx-3">Send Xls Report</a>
                        </h3>

                        <div class="col-12 col-lg-12">
                            <form method="get" action="">
                                <table class="table">
                                    <colgroup>
                                        <col style="width:250px">
                                        <col style="width:250px">
                                        <col>
                                    </colgroup>
                                    <tr>
                                        <td><label>From</label><input type="text" class="date-picker mx-3" name="from_dt" value="<?= $from_dt ?>" /></td>
                                        <td><label>To</label><input type="text" class="date-picker mx-3" name="to_dt" value="<?= $to_dt ?>" /></td>
                                        <td class="text-left"><input type="submit" class="btn btn-sm btn-secondary" name="btnSearch" value="Search"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div>
                                <?php if($reportType=='Import'){
                                    $this->load->view('frontend/freightforwarder/reports_import_template', ['shippig_requirment_list'=>$shippig_requirment_list]);
                                }else{
                                    $this->load->view('frontend/freightforwarder/reports_export_template', ['shippig_requirment_list'=>$shippig_requirment_list]);
                                }?>
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
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
    #tableServerside tr td {
        text-align: left;
    }
</style>
<!-- Tracking start -->
<div class="wshipping-content-block">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                        <h3 class="heading3-border">Online Bidding List </h3>

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
                      <select name="mode" id="mode" class="form-control">
                        <option value="">All</option>
                        <option value="1" <?= $this->input->get('mode') == "1" ? ' selected="true" ' : '' ?>>Road</option>
                        <option value="2" <?= $this->input->get('mode') == "2" ? ' selected="true" ' : '' ?>>Air</option>
                        <option value="3" <?= $this->input->get('mode') == "3" ? ' selected="true" ' : '' ?>>Sea</option>
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
                  <td style="width: 100px;">
                    <div class="form-row">

                      <label>From Date</label>
                     
                      <input type="text" class="date-picker form-control " id="fromDate" name="fromDate" value="<?= $this->input->get('fromDate') ?>">
                     
                    </div>
                  </td>
                  <td style="width: 100px;">
                    <div class="form-row">

                      <label>To Date</label>
                      <input type="text" class="date-picker form-control" id="toDate" name="toDate" value="<?= $this->input->get('toDate') ?>">
                    </div>
                  </td>
                  <td>
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a class="btn btn-secondary" href="<?= base_url("fs-booking-list") ?>">Cancel</a>

                  </td>
                </tr>
              </tbody>
            </table>
          </form>
                        <div class="table-responsive">
                           
                            <table id="tableServerside" class="mdl-data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-left">RFC ID</th>
                                        <th class="text-left">RFC Date</th>
                                        <th class="text-left">Transaction</th>
                                        <th class="text-left">Mode</th>
                                        <th class="text-left">Shipment</th>
                                        <th class="text-left">D.Term</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                      <td colspan="8">Empty</td>
                                   </tr>
                                </tbody>

                            </table>
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
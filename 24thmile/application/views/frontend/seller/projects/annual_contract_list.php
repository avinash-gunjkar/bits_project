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
            <h3 class="heading3-border">Annual Contract List <a href="<?=base_url('fs-create-annual-contract')?>" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"> Create New Annual Contract</i></a> </h3>

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
                      <a class="btn btn-secondary" href="<?= base_url("fs-annual-contract-list") ?>">Cancel</a>

                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
            <div class="table-responsive">
              <table id="tableServerside" class="mdl-data-table" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-left">Contract ID</th>
                    <th class="text-left">Title</th>
                    <th class="text-left">Strat Date</th>
                    <th class="text-left">End Date</th>
                    <th class="text-left">Created Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="7">Empty</td>
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

<script type="text/javascript">
  $(document).on('click', '.cancel-annual-contract-btn', function(e) {
    var currentElement = this;

    e.preventDefault();
    if (confirm("Are your sure you want to cancel Annual Contract?")) {
      $(currentElement).closest('form').submit();
      return true
    }


  });
  $(document).on('click', '.delete-annual-contract-btn', function(e) {
    var currentElement = this;

    e.preventDefault();
    if (confirm("Are your sure you want to delete Annual Contract?")) {
      $(currentElement).closest('form').submit();
      return true
    }


  });
</script>

<script>
  $(document).ready(function() {

    $('#tableServerside').DataTable({
      serverSide: true,
      "pageLength": 50,
      ajax: {
        url: '<?= base_url('seller/ajaxAnnualContract') ?>',
        type: 'POST',
        dataType: 'json',
        data: {
          'filter': {
            'transaction': $('#transaction').val(),
            'mode_id': $('#mode').val(),
            'shipment_id': $('#shipment').val(),
            'fromDate': $('#fromDate').val(),
            'toDate': $('#toDate').val(),
          }
        }
      },
      "order": [
        [0, "desc"]
      ],
      "columns": [{
          "data": "annual_contract_id"
        },
        {
          "data": "annual_contract_title"
        },
        {
          "data": "start_date"
        },
        {
          "data": "end_date"
        },
        {
          "data": "create_date"
        },
       
        {
          "data": "fs_contract_status_title",
          "orderable": false,
          "render": function(data, type, row, meta) {
              return "<span class='status badge " + slugify(row.fs_contract_status_title) + "'>" + row.fs_contract_status_title + "</span>";
           
          }
        },
        {
          "data": "",
          "orderable": false,
          "render": function(data, type, row, meta) {
           
            var editLink = "";
            var deleteLink = "";
            var cancelLink = "";
            var viewLink = "<li><a href='" + base_url + "fs-view-annual-contract/" + row.annual_contract_id + "' title='View'>View</a></li>";
            var selectFFLink = "<li><a href='" + base_url + "annual-contract-select-ff/" + row.annual_contract_id + "' title='Select FF'>Select FF</a></li>";
            var comparativeLink = "<li><a href='" + base_url + "fs-annual-contract-comparative/" + row.annual_contract_id + "?mode_id=3' title='Comparative'>Comparative</a></li>";
            
            if(row.status=='1'){
              editLink = "<li><a href='" + base_url + "fs-edit-annual-contract/" + row.annual_contract_id + "' title='Edit'>Edit</a></li>";
            }

            if (row.status == '1' || row.status == '2'|| row.status == '6') {
                deleteLink ='<li>\n\
                                  <form action="'+base_url+'fs-delete-annual-contract" method="post" style="display: inline">\n\
                                    <input type="hidden" name="annual_contract_id" value="'+ row.annual_contract_id +'" />\n\
                                    <button type="Submit" name="submit-btn" class="delete-annual-contract-btn " style="border: none;cursor: pointer">Delete</button>\n\
                                  </form>\n\
                                </li>'
            }
            if (row.status == '1' || row.status == '2') {
              cancelLink ='<li>\n\
                                  <form action="'+base_url+'fs-cancel-annual-contract" method="post" style="display: inline">\n\
                                    <input type="hidden" name="annual_contract_id" value="'+ row.annual_contract_id +'" />\n\
                                    <button type="Submit" name="submit-btn" class="cancel-annual-contract-btn " style="border: none;cursor: pointer">Cancel</button>\n\
                                  </form>\n\
                                </li>'
            }

            return "<div class='drplist'><a href='javascript:void(0);'>\n\
            <i class='fa fa-ellipsis-v' aria-hidden='true'></i></a>\n\
            <ul class='d-list'>" 
               
                + selectFFLink 
                + comparativeLink
                + editLink 
                + deleteLink
                + cancelLink
                + "</ul>\n\
          </div>\n\
          ";
          }
        }
        // { "data": "isActive" },
        // { "data": "id",

        //   "render": function ( data, type, row, meta ) {
        //     return '<a href="'+base_url+'admin/port/'+data+'">Edit</a>';
        //   } 
        // }
      ]

    });
  });
</script>
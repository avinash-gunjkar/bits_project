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
            <h3 class="heading3-border">Shipment Booking & Tracking</h3>

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
            <div class="table-responsive" style="padding-top: 15px;">
              
              <table id="tableServerside" class="mdl-data-table " style="width:100%">
                <thead>
                  <tr>
                    <th class="text-left">RFC ID</th>
                    <th class="text-left">RFC Date</th>
                    <th class="text-left">Transaction</th>
                    <th class="text-left">Mode</th>
                    <th class="text-left">Shipment</th>
                    <th class="text-left">D.Term</th>
                    <th class="text-left">Consignor</th>
                    <th class="text-left">Consignee</th>
                    <th class="text-right">G.W.(Kg)</th>
                    <th>Track Steps</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

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
  $(document).on('click', '.cancel-request-btn', function(e) {
    var currentElement = this;

    e.preventDefault();
    if (confirm("Are your sure you want to cancel request?")) {
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
        url: '<?= base_url('fs-ajaxBookingList') ?>',
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
        },
        
        beforeSend: function(){
        // Here, manually add the loading message.
        $('#tableServerside > tbody').html(
          '<tr class="odd">' +
            '<td valign="top" colspan="12" class="dataTables_empty">Loading&hellip;</td>' +
          '</tr>'
        );
      }
      },
      "order": [
        [0, "desc"]
      ],
      "columns": [{
          "data": "request_id",
          "searchable":true,
          "render": function(data, type, row, meta) {
            return row.annual_contract_id?'AFC'+row.request_id:row.request_id;
          }
        },
        {
          "data": "rfc_date","searchable":false
        },
        {
          "data": "transaction","searchable":true
        },
        {
          "data": "mode","searchable":true
        },
        {
          "data": "shipment","searchable":true
        },
        {
          "data": "delivery_term_name","searchable":true
        },
        {
          "data": "consignor_company_name","searchable":true
        },
        {
          "data": "consignee_company_name","searchable":true
        },

        //  { "data": "",

        //      "render": function ( data, type, row, meta ) {
        //        return row.shipment_value_currency+' '+row.shipment_value ;
        //      }
        //  }, 
        {
          "data": "totalGW",
          "orderable": false,
          "searchable":false
        },
        {
          "data": "trackingSteps",
          "orderable": false,
          "searchable":false
        },
        {
          "data": "status_title",
          "orderable": false,
          "searchable":false,
          "render": function(data, type, row, meta) {
            if (row.role == '3') {
              return "<span class='status badge " + slugify(row.quote_status_title) + "'>" + (row.quote_status == '5' ? row.tracking_status_title : row.quote_status_title) + "</span>"; //5-in process
            } else {
              return "<span class='status badge " + slugify(row.status_title) + "'>" + (row.status == '5' ? row.tracking_status_title : row.status_title) + "</span>"; //5-in process
            }
          }
        },
        {
          "data": "",
          "orderable": false,
          "searchable":false,
          "render": function(data, type, row, meta) {
            var comparativeLink = "";
            var trackShipment = "";
            var editLink = "";
            var copyToNewLink = "";
            var selectffLink = "";
            var cancelRequestLink = "";
            var shippingDocument = "";

            var viewLink = "<li><a href='" + base_url + "fs-view-shipping-requirement/" + row.request_id + "' title='View'>View</a></li>";
            
            var createDocuments = "<li><a href='" + base_url + "fs-dms/" + row.request_id + "' title='Create Documents'>Create Documents</a></li>";
            if (row.status == '3' || row.status == '4' || row.status == '5' || row.status == '6' || row.status == '7' || row.status == '8') {
              if (!row.skipComparative) {
                comparativeLink = "<li><a href='" + base_url + "quote-list/" + row.request_id + "' title='Comparative'>Comparative</a></li>";
              }
            }


            if (row.status == '5') {
              editLink = "<li><a href='" + base_url + "partial-edit-shipping-requirement/" + row.request_id + "' title='Partial Edit'>Partial Edit</a></li>";
            }

            if (row.status == '1' || row.status == '2') {
              selectffLink = "<li><a href='" + base_url + "select-ff-shipping-requirement/" + row.request_id + "'  title='Select FF'>Select FF</a></li>"
            }
            copyToNewLink = "<li><a href='" + base_url + "copy-to-new-request/" + row.request_id + "'  title='Copy to New Request'>Copy to New</a></li>"
            trackShipment = "<li><a href='" + base_url + "fs-track-shipment/" + row.request_id + "'  title='Track'>Track</a></li>"
            shippingDocument = "<li><a href='" + base_url + "fs-shipping-documents?rfc_id=" + row.request_id + "'  title='View Documents'>View Documents</a></li>"

            var statusArr = ['6', '7', '8'];
            if (statusArr.indexOf(row.status) == -1) {
              cancelRequestLink = '<li>\n\
                                <form action="' + base_url + 'cancel-shipping-requirement" method="post" style="display: inline">\n\
                                  <input type="hidden" name="request_id" value="' + row.request_id + '" />\n\
                                  <button type="Submit" name="submit-btn" class="cancel-request-btn " style="border: none;cursor: pointer">Cancel</button>\n\
                                </form>\n\
                              </li>'
            }

            return "<div class='drplist'><a href='javascript:void(0);'>\n\
            <i class='fa fa-ellipsis-v' aria-hidden='true'></i></a>\n\
            <ul class='d-list'>" +
              trackShipment +
              viewLink +
              editLink +
              comparativeLink +
              copyToNewLink +
              createDocuments +
              shippingDocument +
              cancelRequestLink +
              "</ul>\n\
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

<script>
  // $(document).ready(function() {
  //     $('#booking_list').DataTable({
  //         columnDefs: [{
  //             targets: [0, 1, 2],
  //             className: 'mdl-data-table__cell--non-numeric'
  //         }],
  //         "aaSorting": []
  //     });
  // });
</script>
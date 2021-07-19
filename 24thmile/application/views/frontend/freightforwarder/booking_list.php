
<style>
.comment-group {
    border-bottom:none;
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

.dataTables_length .form-control.input-sm { margin:0px 10px;}

@media (min-width: 840px){
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
                    <a class="btn btn-secondary" href="<?= base_url("ff-booking-list") ?>">Cancel</a>

                  </td>
                </tr>
              </tbody>
            </table>
          </form>
		  <div class="table-responsive">
		  <?php //echo '<pre>'; print_r($FreightEnquiry);?>
             <table id="tableServerside" class="mdl-data-table" style="width:100%">
					<thead>
						<tr>
							<th  class="text-left" >RFC ID</th>
							<th  class="text-left" >RFC Date</th>
							<th  class="text-left" >Transaction</th>
							<th  class="text-left" >Mode</th>
							<th  class="text-left" >Shipment</th>
							<th  class="text-left" >D.Term</th>
							<th  class="text-left" >Consignor</th>
							<th  class="text-left" >Consignee</th>
							<th  class="text-right" >G.W.(Kg)</th>
                            <th>Track Steps</th>
                            <th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $booking_list_ = []; foreach($booking_list_ as $requirment){ ?>
						<!-- <tr>
							<td><?php echo $requirment->request_id; ?></td>
							<td class="text-left"><?= printFormatedDate($requirment->created_at); ?></td>
							<td><?php echo $requirment->mode; ?></td>
							<td><?php echo $requirment->shipment; ?></td>
							<td><?php echo $requirment->delivery_term_name; ?></td>
							<td><?php echo $requirment->transaction; ?></td>
							<td><?php  echo wordwrap($requirment->consignor_company_name,15,'<br>');  ?></td>
							<td><?php  echo wordwrap($requirment->consignee_company_name,15,'<br>'); ?></td>
							<td class="text-right"><?php 
                                                        $totalGW = $this->seller_model->getTotalGrossWeight($requirment->request_id,$requirment->shipment_id==1?'container':'package'); 
                                                        echo $totalGW?$totalGW:'- -';
                                                        ?></td>
							<td>
                                                            <?=count($this->seller_model->getCompletedStep($requirment->transaction,$requirment->request_id)).'/'.count($this->seller_model->getSPSteps($requirment->transaction,$requirment->mode_id,$requirment->shipment_id,$requirment->delivery_term_id))?>
                                                        </td>
							<td>
                                                             <span class="status badge <?= str_replace(' ', '-', strtolower($requirment->quote_status_title) )?>">
                                                           <?= str_replace('_', ' ', $requirment->quote_status_title) ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="drplist"><a href="javascript:void(0);"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                                                <ul class="d-list">
                                                                    <li>
                                                                    <a href="<?php echo base_url('ff-track-shipment/'.$requirment->request_id); ?>" title="Track">Track</a>
                                                                   </li>
                                                                    <li>
                                                                    <a href="<?php echo base_url('view-request-details/'.$requirment->request_id); ?>" title="view / Messages">View / Messages</a>
                                                                    </li>
                                                                    
                                                                    <li> 
                                                                        <a href="<?php echo base_url('ff-shipping-documents?rfc_id='.$requirment->request_id); ?>" title="View Documents" >View Documents</a>
                                                                      </li>
                                                                </ul>
                                                            
                                                            </div>
                                                            
                                                        </td>
						</tr> -->
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
   <!-- Blog content end --> 
   </section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->


<script>
  $(document).ready(function() {

    $('#tableServerside').DataTable({
      serverSide: true,
      "pageLength": 50,
      ajax: {
        url: '<?= base_url('ff-ajaxBookingList') ?>',
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
          "searchable":true,
          "orderable": false,
          "render": function(data, type, row, meta) {
            if (row.role == '3') {
              return "<span class='status badge " + slugify(row.quote_status_title) + "'>" + (row.quote_status=='5'?row.tracking_status_title:row.quote_status_title) + "</span>";
            } else {
              return "<span class='status badge " + slugify(row.status_title) + "'>" + (row.status=='5'?row.tracking_status_title:row.status_title) + "</span>";

            }
          }
        },
        {
          "data": "",
          "orderable": false,
          "searchable":false,
          "render": function(data, type, row, meta) {
            var trackShipment = "";
            var shippingDocument = "";
            var viewLink = "<li><a href='" + base_url + "view-request-details/" + row.request_id + "' title='View'>View</a></li>";
          
            

           
            trackShipment = "<li><a href='" + base_url + "ff-track-shipment/" + row.request_id + "'  title='Track'>Track</a></li>"
            shippingDocument = "<li><a href='" + base_url + "ff-shipping-documents?rfc_id=" + row.request_id + "'  title='View Documents'>View Documents</a></li>"
            
           

            return "<div class='drplist'><a href='javascript:void(0);'>\n\
            <i class='fa fa-ellipsis-v' aria-hidden='true'></i></a>\n\
            <ul class='d-list'>" 
                + trackShipment 
                + viewLink 
                + shippingDocument
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

<!-- <script>
      $(document).ready(function() {
        $('#booking_list').DataTable( {
            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            "aaSorting": [] 
        }
    );
} );
</script> -->
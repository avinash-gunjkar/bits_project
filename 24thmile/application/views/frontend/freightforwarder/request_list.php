
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

@media (min-width: 840px){
	.mdl-grid {
		padding: 8px;
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
          <h3 class="heading3-border">List of Freight Inquires</h3>
          
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
                    <a class="btn btn-secondary" href="<?= base_url("ff-request-list") ?>">Cancel</a>

                  </td>
                </tr>
              </tbody>
            </table>
          </form>
                  <!--<a style="float:right;" href="<?php echo base_url('shipping-requirement'); ?>" class="mdl-button  mdl-button--raised mdl-button--colored">Request For Freight</a>-->
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
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody></tbody>
					
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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<link href="<?php echo base_url('assets/frontend/js/bs4-pop/bs4.pop.css');?>" rel="stylesheet" type="text/css"/>
   <script src="<?php echo base_url('assets/frontend/js/bs4-pop/bs4.pop.js');?>" type="text/javascript"></script>
   
<script type="text/javascript">
$(document).on('click','.reject-shipment-btn',function(e){
    var currentElement = this;
    
      e.preventDefault();
           bs4pop.confirm('Are your sure?',function(sure){},{
               title:'Reject Shipment.',
               hideRemove:true,
               btns:[{
                   label:'ok',
                   onClick(cb){
                       console.log( $(currentElement).closest('form'));
                      $(currentElement).closest('form').submit();
                   }
               },
               {
                   label:'Cancel',
                   className:'btn-secondary',
                   onClick(cb){
                       return e.preventDefault();
                   }
               }
           
        ]
               
           });
         
        
    
});
</script>


<script>
  $(document).ready(function() {

    $('#tableServerside').DataTable({
      serverSide: true,
      "pageLength": 50,
      ajax: {
        url: '<?= base_url('ff-ajaxRequestList') ?>',
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
            '<td valign="top" colspan="11" class="dataTables_empty">Loading&hellip;</td>' +
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
        // {
        //   "data": "trackingSteps",
        //   "orderable": false
        // },
        {
          "data": "status_title",
          "orderable": false,
          "searchable":true,
          "render": function(data, type, row, meta) {
            if (row.role == '3') {
              return "<span class='status badge " + slugify(row.quote_status_title) + "'>" + row.quote_status_title + "</span>";
            } else {
              return "<span class='status badge " + slugify(row.status_title) + "'>" + row.status_title + "</span>";

            }
          }
        },
        {
          "data": "",
          "orderable": false,
          "searchable":false,
          "render": function(data, type, row, meta) {
           
            var editRequest = "";
            var acceptRejectLink = "";
            var shippingDocument = "";
            var viewLink = "<li><a href='" + base_url + "view-request-details/" + row.request_id + "' title='View'>View</a></li>";
            
            var quoteStatusArr = ['1','2','3'];
            if(quoteStatusArr.indexOf(row.quote_status)>=0) {
                editRequest = "<li><a href='" + base_url + "edit-request-details/" + row.request_id + "'  title='Update Quote'>Update Quote</a></li>";
            }

           
           // trackShipment = "<li><a href='" + base_url + "ff-track-shipment/" + row.request_id + "'  title='Track'>Track</a></li>"
           // shippingDocument = "<li><a href='" + base_url + "fs-shipping-documents?rfc_id=" + row.request_id + "'  title='View Documents'>View Documents</a></li>"
            
            var quoteStatusArr2 = ['4'];
            if (quoteStatusArr2.indexOf(row.quote_status)>=0) { 
              acceptRejectLink ='<li>\n\
                                <form action="'+base_url+'view-request-details/'+ row.request_id +'" method="post" style="display: inline">\n\
                                  <input type="hidden" name="request_id" value="'+ row.request_id +'" />\n\
                                  <input type="hidden"  name="actionType" value="Accept">\n\
                                  <button type="Submit" name="submit_btn" value="Accept" class="accept-shipment-btn " style="border: none;cursor: pointer">Accept</button>\n\
                                </form>\n\
                              </li>'
                              +'<li>\n\
                                <form action="'+base_url+'view-request-details/'+ row.request_id +'" method="post" style="display: inline">\n\
                                  <input type="hidden" name="request_id" value="'+ row.request_id +'" />\n\
                                  <input type="hidden"  name="actionType" value="Reject">\n\
                                  <button type="Submit" name="submit_btn" value="Reject" class="reject-shipment-btn " style="border: none;cursor: pointer">Reject</button>\n\
                                </form>\n\
                              </li>'
                            }
            
           var downloadLink = "<li ><a href='"+base_url+"ff-download-rfc/"+row.request_id+"'>Download</a></li>"

            return "<div class='drplist'><a href='javascript:void(0);'>\n\
            <i class='fa fa-ellipsis-v' aria-hidden='true'></i></a>\n\
            <ul class='d-list'>" 
                + editRequest 
                + viewLink 
                + acceptRejectLink
                + downloadLink
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
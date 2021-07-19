<head>
  <link href="<?php echo base_url('assets/backend/js/plugins/data-tables/css/jquery.dataTables.min.css')?>" type="text/css" rel="stylesheet">

  <style type="text/css">
    form#company_add_form label {
      width: 100%;
    }
.total_shipment_amt{
    color:#fff; 
    padding: 12px; 
    background: linear-gradient(45deg,#2f627d,#98bee6)!important;
    box-shadow: 0px 0px 10px #6f6f6f;
  }

.total_invoice_amt{
  color:#fff; 
  background: linear-gradient(45deg,#058c73,#aceab4)!important;
  padding: 12px; 
  box-shadow: 0px 0px 10px #6f6f6f;
}

.total_meis_amt{
  color:#fff;
  background: linear-gradient(45deg,#561546,#f9b8e9)!important;
  padding: 12px; 
  box-shadow: 0px 0px 10px #6f6f6f;

}
  

  </style>
</head>
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
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Reports</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo base_url()?>">Dashboard</a></li>
                    <li><a >Master</a></li>
                    <li class="active">Reports</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
		
		<!--start container-->
        <div class="container">
			<div class="section">   
				<div class="row"> 
					<div class="col s12 m12 l12">
						<div class="card-panel">
							<!-- <h4 class="header2">Basic Form</h4> -->
							<div class="row">
							  <form class="col s12" id="company_add_form" action="<?php echo base_url('reports'); ?>" method="POST" novalidate="novalidate">
								<div class="row">
								  <div class="input-field col s3">
									<input id="from_date" name="from_date" type="text" class="datepicker validate" value="<?php echo !empty($from_date) ? date('d F,Y',strtotime($from_date)): '';?>">
									<label for="from_date" data-error="Please enter from date.">From Date</label>
								  </div>
								  <div class="input-field col s3">
									<input id="to_date" name="to_date" type="text" class="datepicker validate" value="<?php echo !empty($to_date) ? date('d F,Y',strtotime($to_date)): '';?>">
									<label for="to_date" data-error="Please enter to date. ">To Date</label>
								  </div>
								  <div class="input-field col s3">
									<select class="mdb-select md-form" name="ff_id" id="ff_id">
									  <option value="#" disabled selected>Choose Freight Forwarder</option>
									  <?php foreach($ff_list as $ff){ ?>
									  <option value="<?php echo $ff->id; ?>" <?php echo (!empty($ff_id) && $ff_id == $ff->id) ? 'selected': '';?> ><?php echo $ff->firstname.' '.$ff->lastname; ?></option>
									<?php } ?>
									</select>
								  </div>
								  <div class="input-field col s3">
									  <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit" value="doSubmit">Filter<i class="mdi-content-send right"></i>
									  </button>
									</div>
								</div>
							  </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        <!--start container-->
        <div class="container">
          <div class="section">  
            <div class="clearfix divider"></div>
            <!--DataTables example-->
			<?php //echo '<pre>';print_r($report_data); ?>
            <div id="table-datatables"> 
              <div class="row"> 
                <div class="col s12 m12 l12">
				  
				  
				  <div class="row">
				  <br/>
					<div class="col s4">
						<div class="total_shipment_amt"><h5>Total Shipment Amount </h5> 
              <h5><b><?php echo $report_val->tot_ship_value; ?></b> </h5></div>
					</div>
					<div class="col s4">
						<div class="total_invoice_amt"><h5>Total Invoice Amount </h5>
              <h5><b><?php echo $report_val->tot_inv_amount; ?></b></h5></div>
					</div>
					<div class="col s4">
						<div class="total_meis_amt">
              <h5>Total MEIS Amount </h5>
              <h5><b><?php echo $report_val->tot_meis_amount; ?></b></h5></div>
					</div>
					<br/>
				</div>
				<br/>
				<button id="export"  class="btn btn-suceess">Export to CSV</button>
				<br/>
            <div style="overflow-x:auto;">
              <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                <thead>
                  <tr>
                    <th>Consignment No</th>
      							<th>Custom Invoice No</th>
      							<th>Commercial Invoice No</th>
      							<th>Com. Inv. Date</th>
                    <th>Customer</th>
                    <th>Currency</th>
						      	<th>Shipment Value</th>
                    <th>SB No.</th>
                    <th>SB Date</th>
			              <th>BL No.</th>
                    <th>BL Date</th>
                    <th>ERBC No</th>
                    <th>DBK Amt.</th>
      							<th>DBK Status</th>
      							<th>MEIS Rate</th>
      							<th>MEIS Amt</th>
        						<th>MEIS Status</th>
                    <th>Service Provider</th>
      							<th>Bill Amt</th>
      							<th>Bill Status</th>
                    <th>Action</th>
                  </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Consignment No</th>
                            <th>Custom Invoice No</th>
                            <th>Commercial Invoice No</th>
                            <th>Com. Inv. Date</th>
							<th>Customer</th>
							<th>Currency</th>
							<th>Shipment Value</th>
                            <th>SB No.</th>
                            <th>SB Date</th>
							<th>BL No.</th>
                            <th>BL Date</th>
                            <th>ERBC No</th>
                            <th>DBK Amt.</th>
                            <th>DBK Status</th>
							<th>MEIS Rate</th>
							<th>MEIS Amt</th>
							<th>MEIS Status</th>
                            <th>Service Provider</th>
							<th>Bill Amt</th>
							<th>Bill Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                 
                    <tbody>

                        <?php //echo '<pre>';print_r($report_data); 
						foreach ($report_data as $report_d) { ?> 
                        <tr>
                            <td><?php echo $report_d->booked_id; ?></td>
                            <td><?php echo $report_d->custom_invoice_number; ?></td>
                            <td><?php echo $report_d->commercial_invoice_number; ?></td>
                            <td><?php echo date('d-M-Y',strtotime($report_d->commercial_invoice_date)); ?></td>
							<td><?php echo $report_d->firstname .' '.$report_d->lastname; ?></td>
                            <td><?php echo $report_d->shipment_value_currency; ?></td>
                            <td><?php echo $report_d->shipment_value; ?></td>
                            <td><?php echo $report_d->shipping_bill_number; ?></td>
                            <td><?php echo date('d-M-Y',strtotime($report_d->shipping_bill_date)); ?></td>
							<td><?php echo $report_d->bill_of_lading_number; ?></td>
                            <td><?php echo date('d-M-Y',strtotime($report_d->bill_of_lading_date)); ?></td>
                            <td><?php echo $report_d->ERBC_number; ?></td>
                            <td><?php echo $report_d->DBK_amount; ?></td>
                            <td><?php echo ($report_d->DBK_status == 1) ? 'Received' : 'Not Received'; ?></td>
							<td><?php echo $report_d->MEIS_rate; ?></td>
							<td><?php echo $report_d->MEIS_amount; ?></td>
                            <td><?php echo ($report_d->MEIS_status == 1) ? 'Received' : 'Not Received'; ?></td>
                            <td><?php echo $report_d->ffname .' '.$report_d->flname; ?></td>
							<td><?php echo $report_d->Bill_amount; ?></td>
                            <td><?php echo ($report_d->Bill_status == 1) ? 'Received' : 'Not Received'; ?></td>
                            <td></td>
                        </tr>
                        <?php  } ?> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div> 
        </div>
        <!--end contract-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

<script type="text/javascript">
    
    $('.toggleActive').click(function(event) { 
      var id = $(this).attr('id').split('-')[1];
      var isActive = $(this).prop("checked") ? 1 : 0 ;       
      var BasePath = "<?php echo base_url('shipment/changeStatus');?>"
      changeStatus(BasePath,id,isActive); 
       
     }); 

   $('#export').click(function() {
  var titles = [];
  var data = [];

  /*
   * Get the table headers, this will be CSV headers
   * The count of headers will be CSV string separator
   */
  $('.dataTable th').each(function() {
    titles.push($(this).text());
  });

  /*
   * Get the actual data, this will contain all the data, in 1 array
   */
  $('.dataTable td').each(function() {
    data.push($(this).text());
  });
  
  /*
   * Convert our data to CSV string
   */
  var CSVString = prepCSVRow(titles, titles.length, '');
  CSVString = prepCSVRow(data, titles.length, CSVString);

  /*
   * Make CSV downloadable
   */
  var downloadLink = document.createElement("a");
  var blob = new Blob(["\ufeff", CSVString]);
  var url = URL.createObjectURL(blob);
  downloadLink.href = url;
  downloadLink.download = "data.csv";

  /*
   * Actually download CSV
   */
  document.body.appendChild(downloadLink);
  downloadLink.click();
  document.body.removeChild(downloadLink);
});

   /*
* Convert data array to CSV string
* @param arr {Array} - the actual data
* @param columnCount {Number} - the amount to split the data into columns
* @param initial {String} - initial string to append to CSV string
* return {String} - ready CSV string
*/
function prepCSVRow(arr, columnCount, initial) {
  var row = ''; // this will hold data
  var delimeter = ','; // data slice separator, in excel it's `;`, in usual CSv it's `,`
  var newLine = '\r\n'; // newline separator for CSV row

  /*
   * Convert [1,2,3,4] into [[1,2], [3,4]] while count is 2
   * @param _arr {Array} - the actual array to split
   * @param _count {Number} - the amount to split
   * return {Array} - splitted array
   */
  function splitArray(_arr, _count) {
    var splitted = [];
    var result = [];
    _arr.forEach(function(item, idx) {
      if ((idx + 1) % _count === 0) {
        splitted.push(item);
        result.push(splitted);
        splitted = [];
      } else {
        splitted.push(item);
      }
    });
    return result;
  }
  var plainArr = splitArray(arr, columnCount);
  // don't know how to explain this
  // you just have to like follow the code
  // and you understand, it's pretty simple
  // it converts `['a', 'b', 'c']` to `a,b,c` string
  plainArr.forEach(function(arrItem) {
    arrItem.forEach(function(item, idx) {
      row += item + ((idx + 1) === arrItem.length ? '' : delimeter);
    });
    row += newLine;
  });
  return initial + row;
}
</script>
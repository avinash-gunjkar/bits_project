<head>
  <link href="<?php echo base_url('assets/backend/js/plugins/data-tables/css/jquery.dataTables.min.css')?>" type="text/css" rel="stylesheet">
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
                <h5 class="breadcrumbs-title">Booked Shipments</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo base_url()?>">Dashboard</a></li>
                    <li><a >Master</a></li>
                    <li class="active">Booked Shipments</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->

        <!--start container-->
        <div class="container">
          <div class="section">  
            <div class="clearfix divider"></div>
            <!--DataTables example-->
            <div id="table-datatables"> 
              <div class="row"> 
                <div class="col s12 m12 l12">
                  <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                    <thead>
                        <tr>
							<th>Consignment No.</th>
                            <th>Transaction</th>
                            <th>Exporter</th>
                            <th>Fright Forwarder</th>
							<th>Pickup City</th>
                            <th>Delivery City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                 
                    <tfoot>
                        <tr>
                            <th>Consignment No.</th>
                            <th>Transaction</th>
                            <th>Exporter</th>
                            <th>Fright Forwarder</th>
							<th>Pickup City</th>
                            <th>Delivery City</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                 
                    <tbody>

                        <?php //echo '<pre>'; print_r($booked_shipment); 
						foreach ($booked_shipment as $book_shipment) { ?> 
                        <tr>
                            <td><?php echo $book_shipment->booked_id ?></td>
                            <td><?php echo $book_shipment->transaction ?></td>
							<td><?php echo $book_shipment->firstname.' '.$book_shipment->lastname ?></td> 
                            <td><?php echo $book_shipment->ffname.' '.$book_shipment->flname ?></td>
							<td><?php echo $book_shipment->pickup_city ?></td> 
                            <td><?php echo $book_shipment->delivery_city ?></td> 
                            <td>
								<a title="Raise Invoice" href="<?php echo base_url('shipment/raise_invoice') ?>/<?php echo $book_shipment->booked_id ?>" class="btn-floating waves-effect waves-light light-blue lighten-2"><i class="mdi-action-assignment"></i></a>
                                <a class="btn-floating waves-effect waves-light red lighten-1"><i class="mdi-action-delete"></i></a>
                            </td> 
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

    function changeStatus(BasePath,id,isActive) {  
      $.ajax({
        url: BasePath,
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            isActive: isActive
            },
      })
      .done(function(respo) {
        Materialize.toast('<span>'+respo.msg+'</span>', 5000);  
        console.log("success",respo);
      })
      .fail(function(respo) {
        console.error("error",respo);
      })
      .always(function() {
        console.log("complete");
      });
      
    }
</script>
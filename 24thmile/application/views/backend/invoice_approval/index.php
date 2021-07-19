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
                <h5 class="breadcrumbs-title">Invoice Approval</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo base_url('dashboard')?>">Dashboard</a></li>
                    <li><a>Approval</a></li>
                    <li class="active">Invoice Approval</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">
<!--            <div class="right pt-10" style="padding: 10px">
                <a href="<?php echo base_url('create-invoice')?>" class="btn waves-effect waves-light " type="submit" name="action">Add Invoice<i class="mdi-content-add right"></i></a>              
            </div>  -->
            <div class="clearfix divider"></div>
            <!--DataTables example-->
            <div id="table-datatables"> 
              <div class="row"> 
                <div class="col s12 m12 l12">
                  <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Invoice to</td>
                            <td>Invoice from</td>
                            <td>Invoice Amount</td>
                            <td>Status</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                 
                 
                    <tbody>

                        <?php  if(!empty($invoice_list)){?>
                        <?php foreach ($invoice_list as $invoice) { ?> 
                        <tr>
                       <td><?=$invoice->inv_id?></td>
                       <td>
                           <b>Name: </b><?=$invoice->invToUserName?><br>
                           <b>Email: </b><?=$invoice->invToUserEmail?><br>
                           <b>Phone: </b><?=$invoice->invToUserPhoneNo?><br>
                           <b>Address: </b><?=$invoice->invToUserAddress?>
                       </td>
                       <td>
                           <b>Name: </b><?=$invoice->invFromUserName?><br>
                           <b>Email: </b><?=$invoice->invFromUserEmail?><br>
                           <b>Phone: </b><?=$invoice->invfromUserPhoneNo?><br>
                           <b>Address: </b><?=$invoice->invFromUserAddress?>
                       </td>
                       <td><?=$invoice->inv_total_amount?></td>
                       <td><?= ucwords(str_replace('_', ' ', $invoice->status))?></td>
                       <td>
                           <a class="btn btn-primary" href="<?=base_url('view-invoice-approval/'.$invoice->inv_id)?>" title="View">View</a>
                           
                       </td>
                        </tr>
                        <?php  }//end foreach ?> 
                      
                        <?php  }else{ ?> 
<!--                              <tr>
                            <td>No data available in table</td>
                        </tr>-->
                        <?php  }//end if ?> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div> 
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->

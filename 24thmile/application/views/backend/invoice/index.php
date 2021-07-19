<head>
  <link href="<?php echo base_url('assets/backend/js/plugins/data-tables/css/jquery.dataTables.min.css') ?>" type="text/css" rel="stylesheet">
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
          <h5 class="breadcrumbs-title"><?= ucwords($this->invoice_type) ?></h5>
          <ol class="breadcrumbs">
            <li><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            <li><a>Revenue</a></li>
            <li class="active"><?= ucwords($this->invoice_type) ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->


  <!--start container-->
  <div class="container">
    <div class="section">
      <div class="right pt-10" style="padding: 10px">
        <a href="<?php echo base_url('create/' . $this->invoice_type) ?>" class="btn waves-effect waves-light " type="submit" name="action">Create <?= ucwords($this->invoice_type) ?> <i class="mdi-content-add right"></i></a>
        <!--<a href="<?php echo base_url('create/invoice') ?>" class="btn waves-effect waves-light " type="submit" name="action">Create Invoice<i class="mdi-content-add right"></i></a>-->
      </div>
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
                  <td>Invoice Amount</td>
                  <td>Email Sent</td>
                  <td>Status</td>
                  <td>Actions</td>
                </tr>
              </thead>


              <tbody>

                <?php if (!empty($invoice_list)) { ?>
                  <?php foreach ($invoice_list as $invoice) { ?>
                    <tr>
                      <td><?= $invoice->inv_unique_id ?></td>
                      <td>
                        <!--<b>Customer Name: </b><?= $invoice->customer_name ?><br>-->
                        <b>Company Name: </b><?= $invoice->company_name ? $invoice->company_name : '- -' ?><br>
                        <b>Email: </b><?= $invoice->email ? $invoice->email : '- -' ?><br>
                        <!--                           <b>Contact No.: </b><?= $invoice->contact_no ?><br>-->
                        <!-- <b>Address: </b><?= $invoice->address . ' ' . $invoice->city_name . ' PIN:' . $invoice->pincode ?>-->
                      </td>

                      <td><?= $invoice->transaction_currency . ' ' . $invoice->grand_total ?></td>
                      <td><?= ucwords(str_replace('_', ' ', $invoice->sent_to_customer)) ?></td>
                      <td><?= ucwords(str_replace('_', ' ', $invoice->status)) ?></td>
                      <td>
                        <a class="btn btn-primary"  href="<?= base_url("edit/$invoice->inv_type/" . $invoice->inv_id) ?>" title="View">Edit</a>
                        <a class="btn btn-primary" target="_blank" href="<?= base_url("download/$invoice->inv_type/" . $invoice->inv_id) ?>" title="Download">Download</a>
                        <!-- <a class="btn btn-primary" href="<?= base_url("send-to-customer/$invoice->inv_type/" . $invoice->inv_id) ?>" title="Send Email">Send Email</a> -->
                        <a class="btn btn-primary modal-trigger" onclick="$('#modal1 form').attr('action','<?= base_url('send-to-customer/'.$invoice->inv_type.'/'. $invoice->inv_id) ?>')" href="#modal1" title="Send Email">Send Email</a>

                      </td>
                    </tr>
                  <?php  } //end foreach 
                  ?>

                <?php  } else { ?>
                  <!--                              <tr>
                            <td>No data available in table</td>
                        </tr>-->
                <?php  } //end if 
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!--end container-->

  <div id="modal1" class="modal">

    <form action="" method="POST">
    <div class="modal-content">
      <h4>Send Email</h4>
      <div class="row">
      <div class="input-field col s6">
        <input type="text" name="email_cc" id="email_cc" >
        <label for="invoice_date" >Cc</label>
    </div>
      </div>
    
    </div>
    <div class="modal-footer">
    <button class="btn cyan waves-effect waves-light right" type="submit">Send<i class="mdi-content-send right"></i></button> &nbsp;
    <button class="btn grey darken-2 waves-effect waves-light left modal-close" type="button">Cancle</button> 
    </div>
    </form>
                  
  </div>
</section>
<!-- END CONTENT -->

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
          <h5 class="breadcrumbs-title">Request for Freight Comparative List</h5>
          <ol class="breadcrumbs">
            <li><a href="<?php echo base_url('admin/dashboard') ?>">Dashboard</a></li>
            <?php if ($company_id) {  ?>
              <!-- <li><a href="<?= base_url('admin/company-list'); ?>">Master</a></li> -->
              <li><a href="<?php echo base_url('admin/view-company-details/' . $company_id) ?>">Company</a></li>
            <?php } ?>
            <li class="active">Request for Freight Comparative List</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->


  <!--start container-->
  <div class="container">
    <div class="section">
      <!-- <div class="right pt-10" style="padding: 10px">
                <a href="<?php echo base_url('company/add') ?>" class="btn waves-effect waves-light " type="submit" name="action">Add Company<i class="mdi-content-add right"></i></a>              
            </div>   -->
      <div class="row">
        <div class="col s12 m12 l12">
          <?php if (isset($companyProfile->name)) { ?>
            <h6>
              <b>Company:</b> <?= $companyProfile->name ?> <small>(<?= $companyProfile->role == '2' ? "Exporter-Importer" : "Freight Forwarder" ?>)</small>
            </h6>
          <?php } ?>
          <form id="searchForm" action="" method="get" class=" card-panel light-blue lighten-5">
            <h6>Filter:</h6>
            <table>
              <tbody>
                <tr>
                  <td>
                    <div class="input-field">

                      <select id="transaction" name="transaction">
                        <option value="">All</option>
                        <option value="Import" <?= $this->input->get('transaction') == "Import" ? ' selected="true" ' : '' ?>>Import</option>
                        <option value="Export" <?= $this->input->get('transaction') == "Export" ? ' selected="true" ' : '' ?>>Export</option>
                      </select>
                      <label for="">Transaction</label>
                    </div>
                  </td>
                  <td>
                    <div class="input-field">

                      <select id="mode" name="mode">
                        <option value="">All</option>
                        <option value="1" <?= $this->input->get('mode') == "1" ? ' selected="true" ' : '' ?>>Road</option>
                        <option value="2" <?= $this->input->get('mode') == "2" ? ' selected="true" ' : '' ?>>Air</option>
                        <option value="3" <?= $this->input->get('mode') == "3" ? ' selected="true" ' : '' ?>>Sea</option>
                      </select>
                      <label for="">Mode</label>
                    </div>
                  </td>
                  <td>
                    <div class="input-field">

                      <select id="shipment" name="shipment">
                        <option value="">All</option>
                        <option value="1" <?= $this->input->get('shipment') == "1" ? ' selected="true" ' : '' ?>>FCL</option>
                        <option value="2" <?= $this->input->get('shipment') == "2" ? ' selected="true" ' : '' ?>>LCL</option>
                      </select>
                      <label for="">Shipment</label>
                    </div>
                  </td>
                  <td>
                    <div class="input-field">

                      <input id="fromDate" type="text" class="datepicker-from" name="fromDate" value="<?= $this->input->get('fromDate') ?>">
                      <label for="" class="active">From Date</label>
                    </div>
                  </td>
                  <td>
                    <div class="input-field">

                      <input id="toDate" type="text" class="datepicker-to" name="toDate" value="<?= $this->input->get('toDate') ?>">
                      <label for="" class="active">To Date</label>
                    </div>
                  </td>
                  <td>
                    <button type="submit" class="btn waves-effect waves-light blue btn">Search</button>
                    <a class="btn grey darken-2" href="<?= base_url("admin/rfc-list/$company_id") ?>">Cancel</a>

                  </td>
                </tr>
              </tbody>
            </table>
          </form>

        </div>
      </div>
      <div class="clearfix divider"></div>
      <!--DataTables example-->
      <div id="table-datatables">
        <div class="row">
          <div class="col s12 m12 l12">

            <table id="tableServerside" class="responsive-table display" cellspacing="0">
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
                  <!--<th  class="text-right" >Shipment Value</th>-->
                  <th class="text-right">G.W.(Kg)</th>
                  <th class="text-right">Quotes</th>
                  <th class="text-right">Status</th>
                  <th>Actions</th>
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
  <!--end container-->
</section>
<!-- END CONTENT -->
<script>
  $(document).ready(function(){
     
     $('#tableServerside').DataTable( {
     serverSide: true, 
      ajax: {
         url: '<?=base_url('admin/ajaxRFCList'.($company_id?"/$company_id":''))?>',
         type: 'POST',
         dataType: 'json',
         data:{'filter':{
           'transaction':$('#transaction').val(),
           'mode_id':$('#mode').val(),
           'shipment_id':$('#shipment').val(),
           'fromDate':$('#fromDate').val(),
           'toDate':$('#toDate').val(),
         }}
     }, 
     "columns": [
     { "data": "request_id" },
     { "data": "rfc_date" },
     { "data": "transaction" },
     { "data": "mode" },
     { "data": "shipment" },
     { "data": "delivery_term_name" },
     { "data": "consignor_company_name" },
     { "data": "consignee_company_name" },
    
    //  { "data": "",
       
    //      "render": function ( data, type, row, meta ) {
    //        return row.shipment_value_currency+' '+row.shipment_value ;
    //      }
    //  }, 
     { "data": "totalGW","orderable":false },
     { "data": "requestCount","orderable":false },
     { "data": "status_title","orderable":false,
       "render":function(data,type,row,meta){
          if(row.role=='3'){
            return "<span class='status "+slugify(row.quote_status_title)+"'>"+row.quote_status_title+"</span>";
          }else{
            return "<span class='status "+slugify(row.status_title)+"'>"+row.status_title+"</span>";

          }
     } },
    { "data": "","orderable":false,
      "render":function(data,type,row,meta){
        var comparative = "";

       if(!row.skipComparative){
         comparative="<li>\n\
         <a href='"+base_url+"admin/view-comparative/" +row.fs_company_id+ '/' +row.request_id+"' title='Comparative'>Comparative</a>\n\
       </li>";
       }
        return "<div class='drplist'><a href='javascript:void(0);'>\n\
            <i class='mdi-navigation-more-vert' aria-hidden='true'></i></a>\n\
            <ul class='d-list'>\n\
               <li>\n\
                 <a href='"+base_url+"admin/view-shipping-requirement/" +row.fs_company_id + '/'+row.request_id+"' title='View'>View</a>\n\
               </li>"+comparative+"\n\
               </ul>\n\
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
     
 } );
     });
</script>
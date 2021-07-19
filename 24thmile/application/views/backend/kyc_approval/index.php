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
          <h5 class="breadcrumbs-title">KYC Documents Approval</h5>
          <ol class="breadcrumbs">
            <li><a href="<?php echo base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li><a>Master</a></li>
            <li class="active">KYC Documents Approval</li>
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
                <a href="<?php echo base_url('company/add') ?>" class="btn waves-effect waves-light " type="submit" name="action">Add Company<i class="mdi-content-add right"></i></a>              
            </div>  -->
    <div class="row">
    <div class="col s12 m12 l12">
    <form id="searchForm" action="" method="get" class=" card-panel light-blue lighten-5">
    <h6>Filter:</h6>
        <table>
          <tbody>
            <tr>
              <td>
                <div class="input-field">

                  <input type="text" placeholder="Type here company name..." name="filter_company_name" value="<?= $this->input->get('filter_company_name') ?>">
                  <label for="">Company Name</label>
                </div>
              </td>
              <td>
                <div class="input-field">

                  <select name="filter_status">
                    <option value="">All</option>
                    <option value="1" <?= $this->input->get('filter_status') == '1' ? ' selected="true" ' : '' ?>>Approved</option>
                    <option value="0" <?= $this->input->get('filter_status') == '0' ? ' selected="true" ' : '' ?>>Pending</option>
                  </select>
                  <label for="">Status</label>
                </div>
              </td>
              <td>
                <button type="submit" class="btn waves-effect waves-light blue btn">Search</button>
                <a class="btn grey darken-2" href="<?= base_url("admin/kyc-approval") ?>">Cancel</a>

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
            
            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Company Name</th>
                  <th>Document Name</th>
                  <th>Details/View Doc.</th>
                  <th>Status</th>
                </tr>
              </thead>


              <tbody>

                <?php foreach ($kyc_list as $key => $company) { ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td> <a target="_blank" href="<?=base_url('admin/view-company-details/'.$company->id)?>"> <?php echo $company->name ?></a></td>
                    <td><?php echo $company->document_name ?></td>
                    <td><?php echo $company->document_number ?> / 
                    <?php if( is_file('uploads/kyc_documents/' . $company->document_file) ){?>
                      <a target="_blank" href="<?= base_url('uploads/kyc_documents/' . $company->document_file) ?>">View</a>
                    <?php } else{?>
                      <span class="status red">Document not Available</span>
                    <?php }?>
                    </td>
                    <!--<td><a target="_blank" href="<?= base_url('uploads/kyc_documents/' . $company->document_file) ?>"><?php echo $company->original_file_name ?></a></td>-->
                    <td>

                      <div class="switch">
                        <label>
                          Pending
                          <input class="toggleActive" type="checkbox" id="company-<?php echo $company->document_id; ?>" <?php echo $company->document_status == 1 ? 'checked' : '' ?>>
                          <span class="lever"></span>
                          Approved
                        </label>
                      </div>
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
  <!--end container-->
</section>
<!-- END CONTENT -->

<!-- //////////////////////////////////////////////////////////////////////////// -->

<script type="text/javascript">
  $('.toggleActive').click(function(event) {
    event.preventDefault();
    var id = $(this).attr('id').split('-')[1];
    var isActive = $(this).prop("checked") ? 1 : 0;
    var BasePath = "<?php echo base_url('admin/kyc-approval-change-status'); ?>";
    changeStatus(BasePath, id, isActive);

  });

  function changeStatus(BasePath, id, isActive) {
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
        //        Materialize.toast('<span>'+respo.msg+'</span>', 5000);  
        if (respo.status == 1) {
          toastr["success"](respo.msg);
          $('#company-' + id).prop('checked', !!isActive);
        } else {
          toastr["error"](respo.msg);
        }
        console.log("success", respo);
      })
      .fail(function(respo) {
        console.error("error", respo);
      })
      .always(function() {
        console.log("complete");
      });

  }
</script>
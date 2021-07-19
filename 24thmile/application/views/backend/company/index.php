
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
                <h5 class="breadcrumbs-title">Company</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo base_url('admin/dashboard')?>">Dashboard</a></li>
                    <li><a >Master</a></li>
                    <li class="active">Company</li>
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
                <a href="<?=$addCompanyUrl?>" class="btn waves-effect waves-light " type="submit" name="action"><?=$addBtnTitle?><i class="mdi-content-add right"></i></a>              
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
                            <th>Type</th>
                            <th>Company Description</th>
                            <th>Status</th>
                            <th>Public Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                 
                    
                 
                    <tbody>

                        <?php foreach ($company_list as $key=>$company) { ?> 
                        <tr>
                            <td><?php echo $key+1 ?></td>
                            <td><?php echo $company['name'] ?></td> 
                            <td><?=$company['role']=='2'?"Exporter-Importer":"Freight Forwarder"?></td>
                            <td><?php
                            $characterLimit = 50;
                             echo (strlen($company['description'])>$characterLimit)?substr($company['description'],0,$characterLimit).'...':$company['description'];  
                             
                             ?></td>  
                            <td>
                                <div class="switch-vertical">
                                  <label>
                                    
                                    <input class="toggleActive" type="checkbox" id="company-<?php echo $company['id']; ?>" <?php echo $company['isActive'] ==1 ? 'checked' : '' ?>>
                                    <span class="lever"></span>
                                    <span class="off-text">Inactive</span>
                                    <span class="on-text">Active</span>
                                    
                                  </label>
                                </div>
                            </td>
                            <td>
                                <div class="switch-vertical">
                                  <label>
                                    
                                    <input class="togglePublicStatus" type="checkbox" id="blockCompany-<?php echo $company['id']; ?>" <?php echo $company['public_status'] ==1 ? 'checked' : '' ?>>
                                    <span class="lever"></span>
                                    <span class="off-text">Unblock</span>
                                    <span class="on-text">Block</span>
                                    
                                  </label>
                                </div>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/view-company-details/'.$company['id']) ?>" class="btn-floating waves-effect waves-light light-blue lighten-2" title="View"><i class="mdi-action-visibility"></i></a>
                                <!-- <a class="btn-floating waves-effect waves-light red lighten-1"><i class="mdi-action-delete"></i></a> -->
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
      var elementId = $(this).attr('id');
      var id = $(this).attr('id').split('-')[1];
      var isActive = $(this).prop("checked") ? 1 : 0 ;   
      var BasePath = "<?php echo base_url('admin/company/changeStatus');?>"
      changeStatus(BasePath,id,isActive,elementId); 
       
     }); 

     $('.togglePublicStatus').click(function(event) { 
        event.preventDefault();
      var elementId = $(this).attr('id');
      var id = $(this).attr('id').split('-')[1];
      var isActive = $(this).prop("checked") ? 1 : 0 ;   
      var BasePath = "<?php echo base_url('admin/company/changePublicStatus');?>"
      changeStatus(BasePath,id,isActive,elementId); 
       
     }); 

    function changeStatus(BasePath,id,isActive,elementId) {  
        
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
        
        //Materialize.toast('<span>'+respo.msg+'</span>', 5000);  
       
        console.log("success",respo);
        if(respo.status == 1){
             toastr["success"](respo.msg);
            $('#'+elementId).prop('checked',!!isActive);
        }else{
             toastr["error"](respo.msg);
        }
      
      })
      .fail(function(respo) {
        console.error("error",respo);
      })
      .always(function() {
        console.log("complete");
      });
      
    }
</script>
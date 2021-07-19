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
                <h5 class="breadcrumbs-title">Users</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo base_url('admin/dashboard')?>">Dashboard</a></li>
                    <!-- <li><a >Users</a></li> -->
                    <li class="active">Users</li>
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
                <a href="<?php echo base_url('admin/add-user')?>" class="btn waves-effect waves-light">Add User<i class="mdi-content-add right"></i></a>              
            </div>  
            <div class="clearfix divider"></div>
            <!--DataTables example-->
            <div id="table-datatables"> 
              <div class="row"> 
                <div class="col s12 m12 l12">
                  <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                 
                    
                    <tbody>

                        <?php foreach ($user_list as $user) { ?> 
                        <tr>
                            <td><?php echo $user['id'] ?></td>
                            <td><?php echo $user['firstname'].' '.$user['lastname']; ?></td> 
                            <td><?php echo $user['email']; ?></td>  
                            <td>
                                <div class="switch">
                                  <label>
                                    Inactive
                                    <input class="toggleActive" type="checkbox" id="user-<?php echo $user['id']; ?>" <?php echo $user['isActive'] ==1 ? 'checked' : '' ?>>
                                    <span class="lever"></span>
                                    Active
                                  </label>
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo base_url('admin/edit-user/'.$user['id']) ?>" class="btn-floating waves-effect waves-light light-blue lighten-2"><i class="mdi-editor-mode-edit"></i></a>
				<!--<a href="<?php echo base_url('user/kyc_document') ?>/<?php echo $user['id'] ?>" class="btn-floating waves-effect waves-light light-blue lighten-2"><i class="mdi-action-assignment"></i></a>-->
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
      var id = $(this).attr('id').split('-')[1];
      var isActive = $(this).prop("checked") ? 1 : 0 ;
      var BasePath = "<?php echo base_url('admin/user/changeStatus');?>"
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
        //Materialize.toast('<span>'+respo.msg+'</span>', 5000);  
        console.log("success",respo);
        if(respo.status == 1){
            toastr["success"](respo.msg);
         $('#user-'+id).prop('checked',!!isActive);
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
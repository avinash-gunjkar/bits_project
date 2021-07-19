
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
                <h5 class="breadcrumbs-title">Ports</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo base_url('admin/dashboard')?>">Dashboard</a></li>
                    <li><a >Master</a></li>
                    <li class="active">Ports</li>
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
                <!-- <a href="<?php echo base_url('port/add')?>" class="btn waves-effect waves-light " type="submit" name="action">Add Port of Loading<i class="mdi-content-add right"></i></a>               -->
            </div>  
            <div class="clearfix divider"></div>
            <!--DataTables example-->
            <div id="table-datatables"> 
              <div class="row"> 
                <div class="col s12 m12 l12">
                  <table id="portTable" class="responsive-table display" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Port Name</th>
                            <th>Identity</th>
                            <th>Port Type</th>
                            <th>ISO Country</th>
                            <!-- <th>is Active</th>
                            <th>Action</th> -->
                        </tr>
                    </thead>
                 <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>

          </div> 
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->


<script type="text/javascript">
    $(document).ready(function(){
     
    $('#portTable').DataTable( {
    serverSide: true, 
     ajax: {
        url: '<?=base_url('admin/ajaxPorts')?>',
        type: 'POST'
    }, 
    "columns": [
    { "data": "id" },
    { "data": "name" },
    { "data": "identity" },
    { "data": "type" },
    { "data": "iso_country" },
    // { "data": "isActive" },
    // { "data": "id",
      
    //   "render": function ( data, type, row, meta ) {
    //     return '<a href="'+base_url+'admin/port/'+data+'">Edit</a>';
    //   } 
    // }
  ]
    
} );
    });

    $('.toggleActive').click(function(event) { 
      var id = $(this).attr('id').split('-')[1];
      var isActive = $(this).prop("checked") ? 1 : 0 ;       
      var BasePath = "<?php echo base_url('port/changeStatus');?>"
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
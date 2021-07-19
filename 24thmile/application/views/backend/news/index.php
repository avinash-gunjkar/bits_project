<!-- START CONTENT -->
<section id="content">

  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper">
    <!-- Search for small screen -->
    <!-- <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div> -->
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title">News and Events</h5>
          <ol class="breadcrumbs">
            <li><a href="<?php echo base_url() ?>">Dashboard</a></li>
            <li><a>Master</a></li>
            <li class="active">News and Events</li>
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
        <a href="<?= base_url('admin/news-and-events/add') ?>" class="btn waves-effect waves-light " type="submit" name="action">Add News<i class="mdi-content-add right"></i></a>
      </div>
      <div class="clearfix divider"></div>
      <!--DataTables example-->
      <div id="table-datatables">
        <div class="row">
          <div class="col s12 m12 l12">
            <table id="serversideDatatable" class="responsive-table display" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Event Date</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
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

<script type="text/javascript">
  $(document).ready(function() {

    $('#serversideDatatable').DataTable({
      serverSide: true,
      ajax: {
        url: '<?= base_url('admin/ajaxNewsAndEvents') ?>',
        type: 'POST'
      },
      "columns": [{
          "data": "id",
          "render": function(data, type, row, meta) {
            
            return meta.row+1;
          }
        },
        {
          "data": "title"
        },
        {
          "data": "date"
        },
        {
          "data": "description",
          "render": function(data, type, row, meta) {
            return data.substr(0, 60);
          }
        },
        {
          "data": "status",
          "render": function(data, type, row, meta) {
           
            //return (data=='1')?'Active':'Inactive';
            var checked_str = (data=='1')?'checked':'';
            return '<div class="switch-vertical">'+
                                  '<label>'+
                                    '<input class="toggleActive" type="checkbox" id="item-'+row.id+'" '+checked_str+'>'+
                                    '<span class="lever"></span><span class="off-text">Inactive</span><span class="on-text">Active</span>'+
                                  '</label></div>';
          }
        },
        {
          "data": "id",

          "render": function(data, type, row, meta) {
            return '<a href="' + base_url + 'admin/news-and-events/edit/' + data + '">Edit</a>';
          }
        }
      ]

    });
  });

  $(document).on('click','.toggleActive',function(event) {
    event.preventDefault();
    var id = $(this).attr('id').split('-')[1];
    var isActive = $(this).prop("checked") ? 1 : 0;
    var BasePath = "<?php echo base_url('admin/news-and-events/changeStatus'); ?>"
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
        //Materialize.toast('<span>'+respo.msg+'</span>', 5000);  
        
        if (respo.status == 1) {
          toastr["success"](respo.msg);
          $('#item-' + id).prop('checked', !!isActive);
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
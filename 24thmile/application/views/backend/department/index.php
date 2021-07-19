<head>
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="assets/backend/js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="assets/backend/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="assets/backend/js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="assets/backend/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>
      <!-- //////////////////////////////////////////////////////////////////////////// -->

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
                <h5 class="breadcrumbs-title">Sector</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                    <li class="active">Sector View</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">
            <div class="divider"></div>
            
            <!--DataTables example-->
            <div id="table-datatables">
              <div class="row">
             <!--    <div class="col s12 m4 ">
                  <p>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function.</p>

                  <p>Searching, ordering, paging etc goodness will be immediately added to the table, as shown in this example.</p>
                </div> -->
                <div class="col s12 m12 ">
                  <table id="data-table-simple" class="responsive-table display highlight" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Sector</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                 
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Sector 1</td>
                            <td>
                              <i class="mdi-editor-border-color small"></i>
                              <i class="mdi-action-delete small"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Sector 2</td>
                            <td>  
                              <i class="mdi-editor-border-color small"></i>
                              <i class="mdi-action-delete small"></i>
                            </td></td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> 
            <br>
            <div class="divider"></div> 


           
          </div>

        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->




 

    <!-- ================================================
    Scripts
    ================================================ -->
    
    <script type="text/javascript">
        /*Show entries on click hide*/
        $(document).ready(function(){
            $(".dropdown-content.select-dropdown li").on( "click", function() {
                var that = this;
                setTimeout(function(){
                if($(that).parent().hasClass('active')){
                        $(that).parent().removeClass('active');
                        $(that).parent().hide();
                }
                },100);
            });
        });
    </script>
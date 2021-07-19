   <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }

  </style>


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
                <h5 class="breadcrumbs-title">Edit Port</h5>
                <ol class="breadcrumbs">
                  <li><a href="index.html">Dashboard</a>
                  </li>
                  <li><a href="#">Master</a>
                  </li>
                  <li class="active">Port</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <div class="section"> 
            <p class="caption">Edit Port</p>

            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l8 offset-l2">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="port_edit_form" action="<?php echo base_url('port/edit');?>/<?php echo $port_data['id'] ?>" method="POST">
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="port_name" name="port_name" type="text" class="validate" value="<?php echo $port_data['name']; ?>">
                            <label for="port_name">Port Name</label>
                          </div>
                        </div>

                        <div class="row">
                          <div class="input-field col s12">
                            <textarea id="port_description" name="port_description" class="materialize-textarea validate"><?php echo $port_data['description']; ?></textarea>
                            <label for="port_description">Port Description</label>
                          </div> 
                        </div>

                       <div class="row">
                          <div class="input-field col s12 m4 l4">
                              <input type="checkbox" id="loading" name="loading" value="1" 
                              <?php echo $retVal = ($port_data['isFor']==1 || $port_data['isFor']==3 ) ? 'checked="true";' : '' ; ?> 
                              >
                                  <label for="loading">Loading</label>
                         </div> 

                          <div class="input-field col s12 m4 l4">
                                <input type="checkbox" id="discharge" name="discharge" value="2"  
                                <?php echo $retVal = ($port_data['isFor']==2 || $port_data['isFor']==3 ) ? 'checked="true";' : '' ; ?> 
                                >
                                  <label for="discharge">Discharge</label>
                         </div>
                        </div>

                        <input type="hidden" name="port_id" value="<?php echo $port_data['id']; ?>">

                        <div class="row">
                            <div class="input-field col s12 center">
                              <button class="btn cyan waves-effect waves-light" type="submit" name="doEdit"  value="doEdit">Update Port<i class="mdi-content-send right"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div> 
              </div>
            </div>         
         </div>
      </div>
  </section>
  <!-- END CONTENT -->

<!-- //////////////////////////////////////////////////////////////////////////// -->


<script type="text/javascript">
    $('#port_edit_form').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action');
        var FORMDATA = $(this).serialize();
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'json',
            data: FORMDATA,
        })
        .done(function(respo) {
            Materialize.toast('<span>'+respo.msg+'</span>', 5000);  
            window.location.href = "<?php echo base_url('port') ?>";
        })
        .fail(function(respo) {
            console.log("error",respo);
        })
        .always(function(respo) {
            console.log("complete",respo);
        });
        
    });


    
</script>


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
                <h5 class="breadcrumbs-title">Edit Company</h5>
                <ol class="breadcrumbs">
                  <li><a href="index.html">Dashboard</a>
                  </li>
                  <li><a href="#">Master</a>
                  </li>
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
            <p class="caption">Edit Company</p>

            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l8 offset-l2">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="company_edit_form" action="<?php echo base_url('company/edit');?>/<?php echo $company_data['id'] ?>" method="POST">
                        <!-- <div class="row">
                          <div class="input-field col s12">
                            <input id="company_name" name="company_name" type="text" class="validate">
                            <label for="first_name">Company Name</label>
                          </div>
                        </div>  -->
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="company_name" name="company_name" type="text" class="validate" value="<?php echo $company_data['name']; ?>">
                            <label for="company_name">Company Name</label>
                          </div>
                        </div>

                        <div class="row">
                          <div class="input-field col s12">
                            <textarea id="company_description" name="company_description" class="materialize-textarea validate"><?php echo $company_data['description']; ?></textarea>
                            <label for="company_description">Company Description</label>
                          </div> 
                        </div>

                        <div class="row"> 
                            <div class="switch">
                              <label>
                                Inactive
                                <input type="checkbox" name="isActive" <?php echo $company_data['isActive'] ==1 ? 'checked' : '' ?>>
                                <span class="lever"></span>
                                Active
                              </label>
                            </div> 
                        </div>

                        <input type="hidden" name="company_id" value="<?php echo $company_data['id']; ?>">

                        <div class="row">
                            <div class="input-field col s12 center">
                              <button class="btn cyan waves-effect waves-light " type="submit" name="doEdit"  value="doEdit">Update Company<i class="mdi-content-send right"></i>
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
    $('#company_edit_form').submit(function(e) {
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
            window.location.href = "<?php echo base_url('company') ?>";
        })
        .fail(function(respo) {
            console.log("error",respo);
        })
        .always(function(respo) {
            console.log("complete",respo);
        });
        
    });


    
</script>


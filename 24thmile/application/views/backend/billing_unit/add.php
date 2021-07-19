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
                <h5 class="breadcrumbs-title"><?= $page_title ?></h5>
                <ol class="breadcrumbs">
                  <li><a href="index.html">Dashboard</a>
                  </li>
                  <li><a href="#">Master</a>
                  </li>
                  <li class="active"><?= $page_title ?></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->

        <!--start container-->
        <div class="container">
          <div class="section">
            <!-- <p class="caption">Add Unit</p> -->
            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l8 offset-l2">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="formData" action="<?php echo base_url('admin/billing-unit/add');?>" method="POST">
                        <div class="row">
                          <div class="input-field col s12">
                            <input type="hidden" name="id" value="<?=$recordDetails['id']?>">
                            <input id="name" name="name" type="text" class="validate" maxlength="20" value="<?=$recordDetails['name']?>" >
                            <label for="unit_type">Billing Unit Name</label>
                          </div>
                       </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="doSubmit" name="action">Add Billing Unit<i class="mdi-content-send right"></i>
                              </button>
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
  <script src="<?=base_url('assets/backend/js/plugins/jquery-validation/jquery.validate.min.js');?>"></script>
   <script type="text/javascript">
     $("#formData").validate({
       rules: {
         name: {
           required: true,
         }
       },
       //For custom messages
       messages: {
        name: {
           required: "This field is required.",
         }
       },
       errorElement: 'div',
       errorPlacement: function(error, element) {
         var placement = $(element).data('error');
         if (placement) {
           $(placement).append(error)
         } else {
           error.insertAfter(element);
         }
       }
     });
   </script>
   <!-- END CONTENT -->


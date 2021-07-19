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
                <h5 class="breadcrumbs-title">Edit Particulars</h5>
                <ol class="breadcrumbs">
                  <li><a href="index.html">Dashboard</a>
                  </li>
                  <li><a href="#">Master</a>
                  </li>
                  <li class="active">Edit Particulars</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->

        <!--start container-->
        <div class="container">
          <div class="section">
            <p class="caption">Edit Particulars</p>
            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="sellerreq_edit_form" action="<?php echo base_url('particular/edit');?>/<?php echo $freight_temp['id'] ?> " method="POST">
				          		<div class="row">
                          <div class="input-field col s12 m4 l4">
                            <input id="particular" name="particular" type="text" value="<?php echo $freight_temp['particular']; ?>" class="validate">
                            <label for="particular">Particular</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                           <select class="mdb-select md-form" name="rfc_category_id" id="rfc_category_id">
                              <option value="" disabled selected>Choose RFC Category</option>
                              <?php 

                              foreach($rfccategory_list as $rfccategory){ ?>
                              <option <?php echo ($rfccategory['id'] == $freight_temp['rfc_category_id']) ? 'selected' : ''; ?> value="<?php echo $rfccategory['id']; ?>"><?php echo $rfccategory['rfc_category_name']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                                                    <div class="input-field col s12 m4 l4">
                          <select class="mdb-select md-form" name="container" id="container">
                              <option value="" disabled selected>Choose Container</option>
                              <?php foreach($container_list as $container){ ?>
                              <option <?php echo ($container['id']== $freight_temp['container_id']) ? 'selected' : ''; ?> value="<?php echo $container['id']; ?>"><?php echo $container['type']; ?></option>
                            <?php } ?>
                            </select>
                          </div> 
                       </div>

                       <div class="row"> 
                            <div class="switch">
                              <label>
                                Inactive
                                <input type="checkbox" name="isActive" <?php echo $freight_temp['isActive'] ==1 ? 'checked' : '' ?>>
                                <span class="lever"></span>
                                Active
                              </label>
                            </div> 
                        </div>
                        <input type="hidden" name="sellerreq_id" value="<?php echo $freight_temp['id']; ?>">
                          <div class="row">
                            <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="doSubmit" name="action">Update Particular<i class="mdi-content-send right"></i>
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

<!-- //////////////////////////////////////////////////////////////////////////// -->


<script type="text/javascript">
    $('#sellerreq_edit_form').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action');
        var FORMDATA = $(this).serialize();
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'json',
            data: FORMDATA,
        })
        .done(this,function(respo) {

            if(respo.status==1){
                Materialize.toast('<span>Particular supdated successfully.</span>', 5000);
               
                window.location.href = "<?php echo base_url('Particular') ?>";

 
            }else{
                Materialize.toast('<span>Failed to updated Particular.</span>', 5000)
            }
        })
        .fail(function(respo) {
            console.log("error",respo);
        })
        .always(function(respo) {
            console.log("complete",respo);
        }); 
    });
</script>


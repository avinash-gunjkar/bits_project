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
                <h5 class="breadcrumbs-title">Edit Freight Template</h5>
                <ol class="breadcrumbs">
                  <li><a href="index.html">Dashboard</a>
                  </li>
                  <li><a href="#">Master</a>
                  </li>
                  <li class="active">Edit Freight Template</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->

        <!--start container-->
        <div class="container">
          <div class="section">
            <p class="caption">Edit Freight Template</p>
            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="sellerreq_edit_form" action="<?php echo base_url('freight/edit');?>/<?php echo $freight_temp['id'] ?> " method="POST">
						<div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="particular" name="particular" type="text" value="<?php echo $freight_temp['particular']; ?>" class="validate">
                            <label for="particular">Particular</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                           <select class="mdb-select md-form" name="shipment" id="shipment">
                              <option value="" disabled selected>Choose Shipment</option>
                              <?php foreach($shipment_list as $shipment){ ?>
                              <option <?php echo ($shipment['id']== $freight_temp['shipment_id']) ? 'selected' : ''; ?> value="<?php echo $shipment['id']; ?>"><?php echo $shipment['type']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                       </div>
					   <div class="row">
                          <div class="input-field col s12 m6 l6">
							<select class="mdb-select md-form" name="container" id="container">
                              <option value="" disabled selected>Choose Container</option>
                              <?php foreach($container_list as $container){ ?>
                              <option <?php echo ($container['id']== $freight_temp['container_id']) ? 'selected' : ''; ?> value="<?php echo $container['id']; ?>"><?php echo $container['type']; ?></option>
                            <?php } ?>
                            </select>
                          </div> 
                          <div class="input-field col s12 m6 l6">
                             <input id="no_of_container" name="no_of_container" type="text" value="<?php echo $freight_temp['no_of_container']; ?>" class="validate">
                             <label for="no_of_container">No of Container</label>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="company_unit" name="company_unit" type="text" value="<?php echo $freight_temp['comp_unit']; ?>" class="validate">
                            <label for="company_unit">Company Unit</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                            <select class="mdb-select md-form" name="mode" id="mode">
                              <option value="" disabled selected>Choose Mode</option>
                              <?php foreach($mode_list as $mode){ ?>
                              <option <?php echo ($mode['id']== $freight_temp['mode_id']) ? 'selected' : ''; ?> value="<?php echo $mode['id']; ?>"><?php echo $mode['type']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                       </div>
                       <div class="row">
                           <div class="input-field col s12 m6 l6">
							<select class="mdb-select md-form" name="delivery_term" id="delivery_term">
                              <option value="" disabled selected>Choose Delivery Term</option>
                              <?php foreach($deliveryterm_list as $deliveryterm){ ?>
                              <option <?php echo ($deliveryterm['id']== $freight_temp['deliver_term_id']) ? 'selected' : ''; ?> value="<?php echo $deliveryterm['id']; ?>"><?php echo $deliveryterm['name']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
						  <div class="input-field col s12 m6 l6">
                            <input id="amount" name="amount" type="text" class="validate" value="<?php echo $freight_temp['amount']; ?>">
                            <label for="amount" data-error="Please enter Amount.">Amount</label>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <select class="mdb-select md-form" name="company" id="company">
                              <option value="" disabled selected>Choose Company</option>
                              <?php foreach($company_list as $company){ ?>
                              <option <?php echo ($company['id']== $freight_temp['company_id']) ? 'selected' : ''; ?> value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                         <div class="input-field col s12 m6 l6">
                            <select class="mdb-select md-form" name="contract_id" id="contract_id">
                              <option value="" disabled selected>Choose Contract</option>
                              <?php foreach($contract_list as $contract){ ?>
                              <option <?php echo ($contract['id']== $freight_temp['contract_id']) ? 'selected' : ''; ?> value="<?php echo $contract['id']; ?>"><?php echo $contract['type']; ?></option>
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
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="doSubmit" name="action">Update Seller Requirement<i class="mdi-content-send right"></i>
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
                Materialize.toast('<span>Seller Requirement updated successfully.</span>', 5000);
               
                window.location.href = "<?php echo base_url('sellerreq') ?>";

 
            }else{
                Materialize.toast('<span>Failed to updated Seller Requirement.</span>', 5000)
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


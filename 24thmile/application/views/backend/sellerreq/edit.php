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
                <h5 class="breadcrumbs-title">Edit Seller Requirement</h5>
                <ol class="breadcrumbs">
                  <li><a href="index.html">Dashboard</a>
                  </li>
                  <li><a href="#">Master</a>
                  </li>
                  <li class="active">Seller Requirement</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->

        <!--start container-->
        <div class="container">
          <div class="section">
            <p class="caption">Edit Seller Requirement</p>
            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="sellerreq_edit_form" action="<?php echo base_url('sellerreq/edit');?>/<?php echo $sellerreq_data['id'] ?> " method="POST">
                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="user_name" name="user_name" type="text" class="disabled" value="<?php echo $sellerreq_data['user_id']; ?>" readonly>
                            <label for="user_name" >User name</label>
                          </div>
                           <div class="input-field col s12 m6 l6">
                           <select class="mdb-select md-form" name="deliver_term_id" id="deliver_term_id">
                              <option value="#" disabled selected>Choose your delivery term</option>
                              <?php foreach($deliveryterm_list as $deliveryterm){ ?>
                              <option value="<?php echo $deliveryterm['id']; ?>" 

                                <?php 
                                    echo ($deliveryterm['id']== $sellerreq_data['deliver_term_id']) ? 'selected' : '' ;
                                 ?>

                                ><?php echo $deliveryterm['name']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                       </div>

                        <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <textarea id="pickup_address" name="pickup_address" class="materialize-textarea validate"><?php echo $sellerreq_data['pickup_address']; ?></textarea>
                            <label for="pickup_address">Pickup Address</label>
                          </div> 
                           <div class="input-field col s12 m6 l6">
                            <textarea id="delivery_address" name="delivery_address" class="materialize-textarea validate"><?php echo $sellerreq_data['delivery_address']; ?></textarea>
                            <label for="delivery_address">Delivery Address</label>
                          </div>
                          </div>

                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="pickup_pin" name="pickup_pin" type="text" class="validate" value="<?php echo $sellerreq_data['pickup_pin']; ?>">
                            <label for="pickup_pin">Pickup Pin</label>
                          </div>
                           <div class="input-field col s12 m6 l6">
                            <input id="delivery_pin" name="delivery_pin" type="text" class="validate" value="<?php echo $sellerreq_data['delivery_pin']; ?>">
                            <label for="delivery_pin">Delivery Pin</label>
                          </div>
                       </div>
                       <div class="row">
                           <div class="input-field col s12 m12 l12">
                             <textarea id="material_description" name="material_description" class="materialize-textarea validate"><?php echo $sellerreq_data['material_description']; ?></textarea>
                            <label for="material_description">Material Description</label>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m4 l4">
                            <input id="material_quantity" name="material_quantity" type="text" class="validate" value="<?php echo $sellerreq_data['material_quantity']; ?>">
                            <label for="material_quantity">Material Quantity</label>
                          </div>
                           <div class="input-field col s12 m4 l4">
                            <input id="material_unit" name="material_unit" type="text" class="validate" value="<?php echo $sellerreq_data['material_unit']; ?>">
                            <label for="material_unit" >Material Unit</label>
                          </div>
                         <div class="input-field col s12 m4 l4">
                            <input id="invoice_value" name="invoice_value" type="text" class="validate" value="<?php echo $sellerreq_data['invoice_value']; ?>">
                            <label for="invoice_value">Invoice Value</label>
                          </div>
                       </div>
                  
  

                       <div class="row">
                          <div class="input-field col s12 m4 l4">
                            <select class="mdb-select md-form" name="packing_id" id="packing_id">
                              <option value="" disabled selected>Choose your Packing</option>
                              <?php foreach($packing_list as $packing){ ?>
                              <option value="<?php echo $packing['id']; ?>"

                                <?php 
                                    echo ($packing['id']== $sellerreq_data['packing_id']) ? 'selected' : '' ;
                                 ?>
                                ><?php echo $packing['type']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                         <div class="input-field col s12 m4 l4">
                            <select class="mdb-select md-form" name="contract_id" id="contract_id">
                              <option value="" disabled selected>Choose your Contract</option>
                              <?php foreach($contract_list as $contract){ ?>
                              <option value="<?php echo $contract['id']; ?>"
                                <?php 
                                    echo ($contract['id']== $sellerreq_data['contract_id']) ? 'selected' : '' ;
                                 ?>
                              ><?php echo $contract['type']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                          <div class="input-field col s12 m4 l4">
                            <select class="mdb-select md-form" name=" container_id" id="  container_id">
                              <option value="" disabled selected>Choose your Container</option>
                              <?php foreach($container_list as $container){ ?>
                              <option value="<?php echo $container['id']; ?>"
                                <?php 
                                    echo ($container['id']== $sellerreq_data['container_id']) ? 'selected' : '' ;
                                 ?>
                              ><?php echo $container['type']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="container_required" name="container_required" type="text" class="validate"  value="<?php echo $sellerreq_data['container_required']; ?>">
                            <label for="container_required">Container Required</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                            <input id="hs_code" name="hs_code" type="text" class="validate" value="<?php echo $sellerreq_data['hs_code']; ?>">
                            <label for="hs_code">HS Code</label>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="validity" name="validity" type="text" class="validate" value="<?php echo $sellerreq_data['validity']; ?>">
                            <label for="validity">Validity</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                            <input id="frequency" name="frequency" type="text" class="validate" value="<?php echo $sellerreq_data['frequency']; ?>"> 
                            <label for="frequency" >Frequency</label>
                          </div>
                       </div>

                       <div class="row">
                         <div class="input-field col s12 m4 l4">
                            <select class="mdb-select md-form" name="pol" id="pol">
                              <option value="" disabled selected>Choose your Port of Loading (POL)</option>
                              <?php foreach($pol_list as $pol){ ?>
                                <option value="<?php echo $pol['id']; ?>"
                                 <?php 
                                    echo ($pol['id']== $sellerreq_data['port_loading_id']) ? 'selected' : '' ;
                                 ?>
                                ><?php echo $pol['name']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                          <div class="input-field col s12 m4 l4">
                            <select class="mdb-select md-form" name="pod" id="pod">
                              <option value="" disabled selected>Choose your Port of Discharge (POD)</option>
                              <?php foreach($pod_list as $pod){ ?>
                                <option value="<?php echo $pod['id']; ?>"
                                  <?php 
                                    echo ($pod['id']== $sellerreq_data['port_discharge_id']) ? 'selected' : '' ;
                                 ?>
                                  ><?php echo $pod['name']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                          <div class="input-field col s12 m4 l4">
                            <input id="factory_or_port_stuffings" name="factory_or_port_stuffings" type="text" class="validate" value="<?php echo $sellerreq_data['factory_or_port_stuffings']; ?>">
                            <label for="factory_or_port_stuffings" data-error="Please enter Validity.">Factory or Port Stuffing</label>
                          </div>
                       </div>
                       <div class="row"> 
                            <div class="switch">
                              <label>
                                Inactive
                                <input type="checkbox" name="isActive" <?php echo $sellerreq_data['isActive'] ==1 ? 'checked' : '' ?>>
                                <span class="lever"></span>
                                Active
                              </label>
                            </div> 
                        </div>
                        <input type="hidden" name="sellerreq_id" value="<?php echo $sellerreq_data['id']; ?>">
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


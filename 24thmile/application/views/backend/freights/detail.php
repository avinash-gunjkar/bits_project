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
                <h5 class="breadcrumbs-title">Seller Requirement Details</h5>
                <ol class="breadcrumbs">
                  <li><a href="index.html">Dashboard</a>
                  </li>
                  <li><a href="#">Master</a>
                  </li>
                  <li class="active">Seller Requirement Details</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
          <div class="section">
            <p class="caption">Seller Requirement Details</p>
            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="sellerreq_detail_form" action="<?php echo base_url('sellerreq/index'); ?>" method="POST">
                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="user_name" name="user_name" type="text" class="disabled validate" value="<?php echo $sellerreq_data['user_id']; ?>" readonly>
                            <label for="user_name" >User name</label>
                          </div>
                           <div class="input-field col s12 m6 l6">
                           <select disabled="disabled" disabled="disabled" class="mdb-select md-form" name="deliver_term_id" id="deliver_term_id">
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
                            <textarea id="pickup_address" name="pickup_address" class="materialize-textarea validate" readonly><?php echo $sellerreq_data['pickup_address']; ?></textarea>
                            <label for="pickup_address">Pickup Address</label>
                          </div> 
                           <div class="input-field col s12 m6 l6">
                            <textarea id="delivery_address" name="delivery_address" class="materialize-textarea validate" readonly><?php echo $sellerreq_data['delivery_address']; ?></textarea>
                            <label for="delivery_address">Delivery Address</label>
                          </div>
                          </div>

                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="pickup_pin" name="pickup_pin" type="text" class="" value="<?php echo $sellerreq_data['pickup_pin']; ?>" readonly>
                            <label for="pickup_pin">Pickup Pin</label>
                          </div>
                           <div class="input-field col s12 m6 l6">
                            <input id="delivery_pin" name="delivery_pin" type="text" class="" value="<?php echo $sellerreq_data['delivery_pin']; ?>" readonly>
                            <label for="delivery_pin">Delivery Pin</label>
                          </div>
                       </div>
                       <div class="row">
                           <div class="input-field col s12 m12 l12">
                             <textarea id="material_description" name="material_description" class="materialize-textarea validate" readonly><?php echo $sellerreq_data['material_description']; ?></textarea>
                            <label for="material_description">Material Description</label>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m4 l4">
                            <input id="material_quantity" name="material_quantity" type="text" class="" value="<?php echo $sellerreq_data['material_quantity']; ?>" readonly>
                            <label for="material_quantity">Material Quantity</label>
                          </div>
                           <div class="input-field col s12 m4 l4">
                            <input id="material_unit" name="material_unit" type="text" class="" value="<?php echo $sellerreq_data['material_unit']; ?>" readonly>
                            <label for="material_unit" >Material Unit</label>
                          </div>
                         <div class="input-field col s12 m4 l4">
                            <input id="invoice_value" name="invoice_value" type="text" class="" value="<?php echo $sellerreq_data['invoice_value']; ?>" readonly>
                            <label for="invoice_value">Invoice Value</label>
                          </div>
                       </div>
                       <div class="row">
                          <div class="input-field col s12 m4 l4">
                            <select disabled="disabled" class="mdb-select md-form" name="packing_id" id="packing_id">
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
                            <select disabled="disabled" class="mdb-select md-form" name="contract_id" id="contract_id">
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
                            <select disabled="disabled" class="mdb-select md-form" name=" container_id" id="  container_id">
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
                            <input id="container_required" name="container_required" type="text" class=""  value="<?php echo $sellerreq_data['container_required']; ?>" readonly>
                            <label for="container_required">Container Required</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                            <input id="hs_code" name="hs_code" type="text" class="" value="<?php echo $sellerreq_data['hs_code']; ?>" readonly>
                            <label for="hs_code">HS Code</label>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="validity" name="validity" type="text" class="" value="<?php echo $sellerreq_data['validity']; ?>" readonly>
                            <label for="validity">Validity</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                            <input id="frequency" name="frequency" type="text" class="" value="<?php echo $sellerreq_data['frequency']; ?>" readonly> 
                            <label for="frequency" >Frequency</label>
                          </div>
                       </div>

                       <div class="row">
                         <div class="input-field col s12 m4 l4">
                            <select class="mdb-select md-form" name="pol" id="pol" disabled="disabled">
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
                            <select class="mdb-select md-form" name="pod" id="pod" disabled="disabled">
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
                            <input id="factory_or_port_stuffings" name="factory_or_port_stuffings" type="text" class="" value="<?php echo $sellerreq_data['factory_or_port_stuffings']; ?>" readonly>
                            <label for="factory_or_port_stuffings" >Factory or Port Stuffing</label>
                          </div>
                       </div>
                        <input type="hidden" name="sellerreq_id" value="<?php echo $sellerreq_data['id']; ?>">
                          <div class="row">
                            <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="" name="action">Back<i class="mdi-av-replay right"></i>
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
  //  $('#sellerreq_detail_form').submit(function(e) {
   //     window.location.href = "<?php echo base_url('sellerreq/index') ?>";
   // });
</script>


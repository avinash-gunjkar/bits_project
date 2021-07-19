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
                <h5 class="breadcrumbs-title">Add Seller Requirement</h5>
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
          <p class="caption">Add Seller Requirement</p>
          <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="sellerreq_add_form" action="<?php echo base_url('sellerreq/add');?>" method="POST">
                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="user_name" name="user_name" type="text" value="1" class="disabled validate" readonly>
                            <label for="user_name">User name</label>
                          </div>
                           <div class="input-field col s12 m6 l6">
                           <select class="mdb-select md-form" name="deliver_term_id" id="deliver_term_id">
                              <option value="#" disabled selected>Choose your delivery term</option>
                              <?php foreach($deliveryterm_list as $deliveryterm){ ?>
                              <option value="<?php echo $deliveryterm['id']; ?>"><?php echo $deliveryterm['name']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                       </div>

                        <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <textarea id="pickup_address" name="pickup_address" class="materialize-textarea validate"></textarea>
                            <label for="pickup_address">Pickup Address</label>
                          </div> 
                           <div class="input-field col s12 m6 l6">
                            <textarea id="delivery_address" name="delivery_address" class="materialize-textarea validate"></textarea>
                            <label for="delivery_address">Delivery Address</label>
                          </div>
                          </div>

                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="pickup_pin" name="pickup_pin" type="text" class="validate">
                            <label for="pickup_pin">Pickup Pin</label>
                          </div>
                           <div class="input-field col s12 m6 l6">
                            <input id="delivery_pin" name="delivery_pin" type="text" class="validate">
                            <label for="delivery_pin">Delivery Pin</label>
                          </div>
                       </div>
                       <div class="row">
                           <div class="input-field col s12 m12 l12">
                             <textarea id="material_description" name="material_description" class="materialize-textarea validate"></textarea>
                            <label for="material_description">Material Description</label>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m4 l4">
                            <input id="material_quantity" name="material_quantity" type="text" class="validate">
                            <label for="material_quantity" data-error="Please enter Material Quantity.">Material Quantity</label>
                          </div>
                           <div class="input-field col s12 m4 l4">
                            <input id="material_unit" name="material_unit" type="text" class="validate">
                            <label for="material_unit" >Material Unit</label>
                          </div>
                         <div class="input-field col s12 m4 l4">
                            <input id="invoice_value" name="invoice_value" type="text" class="validate">
                            <label for="invoice_value" data-error="Please enter invoice value.">Invoice Value</label>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m3 l3">
                            <select class="mdb-select md-form" name="packing_id" id="packing_id">
                              <option value="" disabled selected>Choose your Packing</option>
                              <?php foreach($packing_list as $packing){ ?>
                              <option value="<?php echo $packing['id']; ?>"><?php echo $packing['type']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                         <div class="input-field col s12 m3 l3">
                            <select class="mdb-select md-form" name="contract_id" id="contract_id">
                              <option value="" disabled selected>Choose your Contract</option>
                              <?php foreach($contract_list as $contract){ ?>
                              <option value="<?php echo $contract['id']; ?>"><?php echo $contract['type']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                          <div class="input-field col s12 m3 l3">
                            <select class="mdb-select md-form" name="container_id" id="container_id">
                              <option value="" disabled selected>Choose your Container</option>
                              <?php foreach($container_list as $container){ ?>
                              <option value="<?php echo $container['id']; ?>"><?php echo $container['type']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                          <input type="hidden" id="client_site_url" value="<?php echo base_url('container/getSelectedDocumentsIsArray'); ?>">

                          <div class="input-field col s12 m3 l3">
                            <select class="mdb-select md-form" name="dimension_id" id="dimension_id">
                              <option value="" disabled selected>Choose your Dimensions</option>
                              <!-- <?php foreach($dimension_list as $dimension){ ?>
                              <option value="<?php echo $dimension['id']; ?>"><?php echo $dimension['name']; ?></option>
                            <?php } ?> -->
                            </select>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="container_required" name="container_required" type="text" class="validate">
                            <label for="container_required">Container Required</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                            <input id="hs_code" name="hs_code" type="text" class="validate">
                            <label for="hs_code" data-error="Please enter HS Code.">HS Code</label>
                          </div>
                        </div>

                        <div class="row">
                          <div class="input-field col s12 m6 l6">
                            <input id="validity" name="validity" type="text" class="validate">
                            <label for="validity" data-error="Please enter Validity.">Validity</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                            <input id="frequency" name="frequency" type="text" class="validate">
                            <label for="frequency" data-error="Please enter Validity.">Frequency</label>
                          </div>
                       </div>

                       <div class="row">
                          <div class="input-field col s12 m4 l4">
                            <select class="mdb-select md-form" name="pol" id="pol">
                              <option value="" disabled selected>Choose your Port of Loading (POL)</option>
                              <?php foreach($pol_list as $pol){ ?>
                                <option value="<?php echo $pol['id']; ?>"><?php echo $pol['name']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                          <div class="input-field col s12 m4 l4">
                            <select class="mdb-select md-form" name="pod" id="pod">
                              <option value="" disabled selected>Choose your Port of Discharge (POD)</option>
                              <?php foreach($pod_list as $pod){ ?>
                                <option value="<?php echo $pod['id']; ?>"><?php echo $pod['name']; ?></option>
                            <?php } ?>
                            </select>
                          </div>
                          <div class="input-field col s12 m4 l4">
                            <input id="factory_or_port_stuffings" name="factory_or_port_stuffings" type="text" class="validate">
                            <label for="factory_or_port_stuffings" data-error="Please enter Validity.">Factory or Port Stuffing</label>
                          </div>
                       </div>

                          <div class="row">
                            <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="doSubmit" name="action">Add Seller Requirement<i class="mdi-content-send right"></i>
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
    $('#sellerreq_add_form').submit(function(e) {
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
                Materialize.toast('<span>Company add successfully.</span>', 5000);
                $("#sellerreq_add_form")[0].reset();
 
            }else{
                Materialize.toast('<span>Failed add company.</span>', 5000)
            }
        })
        .fail(function(respo) {
            console.log("error",respo);
        })
        .always(function(respo) {
            console.log("complete",respo);
        });
    });


  $("#container_id").change(function() {
   var e = $(this).val();
       
  var base_url = "<?php echo base_url('container/getSelectedDimensionArray'); ?>";
   $("#dimension_id").empty(); 
   $.ajax({
       url: base_url,
       type: "POST",
       dataType: 'json',
       data: {container_id: e},
       success: function(respo) {
          $('#dimension_id').append('<option value="#" selected="selected" disabled>Choose your Dimensions</option>')
           $.each(respo, function(key, value) {
              var $option = $("<option/>", {
                value: value.id,
                text: value.name
              });
              $("#dimension_id").append($option);
            });

           $('#dimension_id').material_select();
       }
   })
});

</script>


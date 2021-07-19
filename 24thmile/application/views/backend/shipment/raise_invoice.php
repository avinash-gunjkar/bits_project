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
                <h5 class="breadcrumbs-title">Raise Invoice</h5>
                <ol class="breadcrumbs">
                  <li><a href="index.html">Dashboard</a>
                  </li>
                  <li><a href="#">Master</a>
                  </li>
                  <li class="active">Raise Invoice</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <div class="section">

            <p class="caption">Raise Invoice</p>

            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l8 offset-l2">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="shipment_add_form" action="<?php echo base_url('shipment/raise_invoice');?>" method="POST">
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="total_amount" name="total_amount" type="text" class="validate">
                            <label for="total_amount" data-error="Please enter total amount.">Total Amount</label>
                          </div>
						  <div class="input-field col s12">
                            <input id="raise_amount" name="raise_amount" type="text" class="validate">
                            <label for="raise_amount" data-error="Please enter raise amount.">Raise Amount</label>
                          </div>
						  <div class="input-field col s12">
                            <input id="raise_against" name="raise_against" type="text" class="validate">
                            <label for="raise_against" data-error="Please enter raise against.">Raise Against</label>
                          </div>
						  <div class="input-field col s12">
                            <input id="balance_amount" name="balance_amount" type="text" class="validate">
                            <label for="balance_amount" data-error="Please enter balance amount.">Balance Amount</label>
                          </div>
						  <div class="input-field col s12">
                            <input id="gstin_number" name="gstin_number" type="text" class="validate">
                            <label for="gstin_number" data-error="Please enter balance amount.">GSTIN Number</label>
                          </div>
						  <div class="input-field col s12">
							<select name="payment_type">
							  <option value="" disabled selected>Select Payment Type</option>
							  <option value="Advance">Advance</option>
							  <option value="Full">Full</option>
							</select>
						  </div>
						  <div class="input-field col s12">
							<select name="invoice_type">
							  <option value="" disabled selected>Select Invoice Type</option>
							  <option value="Proforma">Proforma Invoice</option>
							  <option value="Tax">Tax Invoice</option>
							</select>
						  </div>
                       </div>
                          <div class="row">
                            <div class="input-field col s12">
							  <input type="hidden" name="book_id" value="<?php echo $this->uri->segment(3); ?>">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="doSubmit" name="action">Raise Invoice<i class="mdi-content-send right"></i>
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
    $('#shipment_add_form').submit(function(e) {
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
                Materialize.toast('<span>Invoice raised successfully.</span>', 5000);
                $("#shipment_add_form")[0].reset();
 
            }else{
                Materialize.toast('<span>Invoice raised to Fail.</span>', 5000)
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


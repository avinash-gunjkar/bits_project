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

#tableAddNewQuote {
    counter-reset: billedItem;
}
.item-counter::before{
    counter-increment:billedItem;
    content: counter(billedItem);
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
                <h5 class="breadcrumbs-title">Invoice Approval</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= base_url('dashboard')?>">Dashboard</a>
                  </li>
                  <li><a href="#">Approval</a>
                  </li>
                 
                  <li class="active">Invoice Approval</li>
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
            <!--Start:Basic Form-->
           
                
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <div class="col s12 m6 l6">
            <h5>Invoice From</h5>
            <div class="table-responsive">
            <table class="table" style="margin-bottom:0px;">
		
		<tr>
                    <th>Name</th>
                    <td>
                        <?=$invoice_details->invFromUserName?$invoice_details->invFromUserName:'- -'?>
                        
                    </td>
                </tr>
                <tr class="company-name-from">
                    <th>Company Name</th>
                    <td>
                        <?=$invoice_details->invFromCompanyName?$invoice_details->invFromCompanyName:'- -'?>
                    </td>
                </tr>
		<tr>
                    <th>Email ID</th>
                    <td><?=$invoice_details->invFromUserEmail?$invoice_details->invFromUserEmail:'- -'?></td>
                </tr>
		<tr>
                    <th>Phone</th>
                    <td><?=$invoice_details->invfromUserPhoneNo?$invoice_details->invfromUserPhoneNo:'- -'?></td>
                </tr>
		<tr>
                    <th>Address</th>
                    <td><?=$invoice_details->invFromUserAddress?$invoice_details->invFromUserAddress:'- -'?></td>
                </tr>
		<tr>
                    <th>Place of supply</th>
                    <td>
                        <select class="form-control" name="place_of_supply_from" id="place_of_supply_from" disabled="" >
                            <option value="">-Select-</option>
                             <?php foreach ($placeOfSupplyList as $place){?>
                            <option value="<?=$place->id?>" <?=($invoice_details->invFromPlaceOfSupply == $place->id)?' selected ':''?>><?=$place->name?> (#<?=$place->tin_number?>)</option>
                            <?php }?>
                            
                        </select>
                    </td>
                </tr>
		
		<tr>
                    <th>Bank Account No.</th>
                    <td>
                        <?=$invoice_details->bankAccountNumber?$invoice_details->bankAccountNumber:'- -'?>
                    </td>
                </tr>
		<tr>
                    <th>Bank Name</th>
                    <td>
                        <?=$invoice_details->bankName?$invoice_details->bankName:'- -'?>
                    </td>
                    
                </tr>
                <tr>
                    <th>Branch & city</th>
                    <td>
                        <?=$invoice_details->bankBranchCity?$invoice_details->bankBranchCity:'- -'?>
                    </td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td>
                       <?=$invoice_details->bankCodeIFSC?$invoice_details->bankCodeIFSC:'- -'?>
                    </td>
                </tr>
                <tr>
                    <th>GST No.</th>
                    <td>
                        <?=$invoice_details->invFromUserGSTNo?$invoice_details->invFromUserGSTNo:'- -'?>
                    </td>
                </tr>
                <tr>
                    <th>TAN</th>
                    <td>
                       <?=$invoice_details->tan_from?$invoice_details->tan_from:'- -'?>
                    </td>
                </tr>
                <tr>
                    <th>PAN</th>
                    <td>
                        <?=$invoice_details->pan_from?$invoice_details->pan_from:'- -'?>
                    </td>
                </tr>
                <tr>
                    <th>SAC Code</th>
                    <td>
                       <?=$invoice_details->sac_code_from?$invoice_details->sac_code_from:'- -'?>
                    </td>
                </tr>
                <tr>
                    <th>LUT No</th>
                    <td>
                        <?=$invoice_details->lut_no_from?$invoice_details->lut_no_from:'- -'?>
                    </td>
                </tr>
                <tr>
                    <th>MSME No</th>
                    <td>
                       <?=$invoice_details->msme_no_from?$invoice_details->msme_no_from:'- -'?>
                    </td>
                </tr>
            </table>
            </div>
          </div>
          <div class="col s12 m6 l6">
            <h5>Invoice To</h5>
            <div class="table-responsive">
            <table class="table" style="margin-bottom:0px;">
		
		<tr>
                    <th>Name</th>
                    <td>
                       <?=$invoice_details->invToUserName?$invoice_details->invToUserName:'- -'?>
                        
                    </td>
                </tr>
                <tr class="company-name-to" >
                    <th>Company Name</th>
                    <td>
                       <?=$invoice_details->invToCompanyName?$invoice_details->invToCompanyName:'- -'?>
                       
                    </td>
                </tr>
		<tr>
                    <th>Email ID</th>
                    <td><?=$invoice_details->invToUserEmail?$invoice_details->invToUserEmail:'- -'?></td>
                </tr>
		<tr>
                    <th>Phone</th>
                    <td><?=$invoice_details->invToUserPhoneNo?$invoice_details->invToUserPhoneNo:'- -'?></td>
                </tr>
		<tr>
                    <th>Address</th>
                    <td><?=$invoice_details->invToUserAddress?$invoice_details->invToUserAddress:'- -'?></td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>
                       <?=$invoice_details->city_to?$invoice_details->city_to:'- -'?>
                       
                    </td>
                </tr>
                <tr>
                    <th>State</th>
                    <td>
                        <?=$invoice_details->state_to?$invoice_details->state_to:'- -'?>
                       
                    </td>
                </tr>
                <tr>
                    <th>Pin</th>
                    <td>
                        <?=$invoice_details->pin_to?$invoice_details->pin_to:'- -'?>
                       
                    </td>
                </tr>
		<tr>
                    <th>Place of supply</th>
                    <td>
                        <select class="form-control" name="place_of_supply_to" id="place_of_supply_to" disabled="">
                            <option value="">-Select-</option>
                            <?php foreach ($placeOfSupplyList as $place){?>
                            <option value="<?=$place->id?>" <?=($invoice_details->invToPlaceOfSupply==$place->id)?' selected ':''?>><?=$place->name?> (#<?=$place->tin_number?>)</option>
                            <?php }?>
                            
                        </select>
                    </td>
                </tr>
		<tr>
                    <th>GST No.</th>
                    <td>
                        <?=$invoice_details->invToUserGSTNo?$invoice_details->invToUserGSTNo:'- -'?>
                    </td>
                </tr>
            </table>
            </div>
          </div>
                    </div>
            <div class="row">
        <div class="s12 m12 l12" style="margin-top:15px;">
          <p class="lead" style="font-size:16px;">Terms:</p>
          <table>
              <tr>
                  <th>Delivery</th>
                  <td><?=$invoice_details->term_delivery?$invoice_details->term_delivery:'- -'?></td>
                  <th>Payment</th>
                  <td><?=$invoice_details->term_payment?$invoice_details->term_payment:'- -'?></td>
                  <th>Reference</th>
                  <td><?=$invoice_details->term_reference?$invoice_details->term_reference:'- -'?></td>
              </tr>
          </table>
        </div>
        </div>
                    <div class="row">
        <div class="s12 m12 l12" style="margin-top:15px;">
          <p class="lead" style="font-size:16px;">Billed Items:</p>
          <div class="table-responsive" style="overflow-x: scroll;">
            <table class="table table-striped" id="tableAddNewQuote">
              <thead>
                <tr>
                  <th style="background-color:#414042; color:#FFFFFF;">Sr. No.</th>
                  <th style="background-color:#414042; color:#FFFFFF;">Particular</th>
<!--                  <th style="background-color:#414042; color:#FFFFFF;">Description</th>
                  <th style="background-color:#414042; color:#FFFFFF;">HSN Code</th>-->
                  <th style="background-color:#414042; color:#FFFFFF;">Amount</th>
                  <th style="background-color:#414042; color:#FFFFFF;">Tax %</th>
                  <th style="background-color:#414042; color:#FFFFFF;">Total Amount</th>
                </tr>
              </thead>
              <tbody>
                  
                  <?php if(!empty($invoice_details->billingItems)){?>
               <?php foreach ($invoice_details->billingItems as $key=>$item){?>
                  <?php $this->load->view('backend/ajax/invoiceItemRowView',['counter'=>$key+1,'item'=>$item]); ?>
                  <?php }?>
                  <?php }else{?>
                  <tr><td colspan="5">No data available in the table.</td></tr>
                  <?php }?>
              </tbody>
            </table>
          </div>
          <!--<div style="float:right; width:auto; margin-bottom:5px;"> <a href="javascript:void(0);" id="add_more_row" title="Add" style="display:block"><b>Add New Row...</b></a> </div>-->
          
        </div>
      </div>
                    <div class="row">
        <div class="col-xs-6">
          <p class="lead" style="font-size:16px;">Summary:</p>
          <div class="table-responsive">
            <table class="table">
                <tbody>
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>
                    <?=$invoice_details->inv_amount?$invoice_details->inv_amount:'- -'?>
                </td>
              </tr>
              <tr id="rowIGST">
                <th style="width:50%">IGST:</th>
                <td>
                   <?=$invoice_details->inv_tax?$invoice_details->inv_tax:'- -'?>
                </td>
              </tr>
			  <tr id="rowSGST">
                <th style="width:50%">SGST:</th>
                <td>
                   <?=$invoice_details->sgst_tax?$invoice_details->sgst_tax:'- -'?>
                </td>
              </tr>
			  <tr id="rowCGST">
                <th style="width:50%">CGST:</th>
                <td>
                   <?=$invoice_details->cgst_tax?$invoice_details->cgst_tax:'- -'?>
                </td>
              </tr>
              <tr>
                <th style="width:50%">Total Invoice:</th>
                <td>
                    <?=$invoice_details->inv_total_amount?$invoice_details->inv_total_amount:'- -'?>
                </td>
              </tr>
                </tbody>
            </table>
          </div>
        </div>
			
        <div class="col-xs-12"> 
            <form method="post" action="<?= base_url('')?>" style="display: inline">
                <input type="hidden" name="invoice_id" value="<?=$invoice_details->inv_id?>"/>
                <input type="hidden" name="status" value=''/>
                <input type="submit" class="btn btn-primary" name="buttonSubmit" value="Approve" >
            </form>
            <form method="post" action="" style="display: inline">
                <input type="hidden" name="invoice_id" value="<?=$invoice_details->inv_id?>"/>
                <input type="submit" class="btn btn-primary" name="buttonSubmit" value="Approve" >
            </form>
            
        
<!--        <input type="submit" class="btn btn-primary" name="buttonSubmit" id="buttonSaveAndApproval" value="Save & Submit For Approval" >-->
		
        <a href="<?= base_url('invoice')?>" class="btn btn-default">Cancel</a>
		
        </div>
      </div>
                  </div>
                </div> 
              </div>
            </div>   
               
             <!--End:Basic Form-->
         </div>
      </div>
  </section>
  <!-- END CONTENT -->


  <script type="text/javascript">
  
var funShowHideTaxSumm = function(){
	if($("#place_of_supply_from").val() === $("#place_of_supply_to").val() && $("#place_of_supply_to").val()!='' && $("#place_of_supply_from").val()!=''){
	$("#rowSGST").show();	
	$("#rowCGST").show();		
	$("#rowIGST").hide();
	}else{
	$("#rowSGST").hide();	
	$("#rowCGST").hide();		
	$("#rowIGST").show();	
	}
};
funShowHideTaxSumm();

  </script>
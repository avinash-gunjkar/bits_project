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
                <h5 class="breadcrumbs-title">Create Invoice</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= base_url('dashboard')?>">Dashboard</a>
                  </li>
                  <li><a href="#">Revenue</a>
                  </li>
                  <li><a href="<?= base_url('invoice')?>">Invoice</a>
                  </li>
                  <li class="active">Create Invoice</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <div class="section">

            <!--Start:Basic Form-->
            <form name="invoiceForm" id="invoiceForm" method="POST" action="">
                <input type="hidden" name="invoice_id" value="<?=$invoice_details->inv_id?>"/>
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
                    <th>Name<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="name_from" id="name_from" placeholder="Name" type="text" value="<?=$invoice_details->invFromUserName?>" maxlength="50">
                        
                    </td>
                </tr>
                <tr class="company-name-from">
                    <th>Company Name<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="companyName_from" id="companyName_from" placeholder="Company Name" type="text" value="<?=$invoice_details->invFromCompanyName?>" maxlength="50">
                       
                    </td>
                </tr>
		<tr>
                    <th>Email ID<sup>*</sup></th>
                    <td><input  class="form-control" name="email_from" id="email_from" placeholder="Email ID" type="email" value="<?=$invoice_details->invFromUserEmail?>" maxlength="50"></td>
                </tr>
		<tr>
                    <th>Phone<sup>*</sup></th>
                    <td><input  class="form-control" oninput="this.value = this.value.replace(/[^0-9+-]/g, '');" name="phone_from" id="phone_from" placeholder="Phone" type="text" value="<?=$invoice_details->invfromUserPhoneNo?>" maxlength="20"></td>
                </tr>
		<tr>
                    <th>Address<sup>*</sup></th>
                    <td><textarea  class="form-control" name="address_from" id="address_from" placeholder="Address" maxlength="500"><?=$invoice_details->invFromUserAddress?></textarea></td>
                </tr>
		<tr>
                    <th>Place of supply<sup>*</sup></th>
                    <td>
                        <select class="form-control" name="place_of_supply_from" id="place_of_supply_from" onchange="funShowHideTaxSumm();">
                            <option value="">-Select-</option>
                             <?php foreach ($placeOfSupplyList as $place){?>
                            <option value="<?=$place->id?>" <?=($invoice_details->invFromPlaceOfSupply == $place->id)?' selected ':''?>><?=$place->name?> (#<?=$place->tin_number?>)</option>
                            <?php }?>
                            
                        </select>
                    </td>
                </tr>
		
		<tr>
                    <th>Bank Account No.<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="bank_account_no_from" id="bank_account_no_from" placeholder="Bank Account No." type="text" value="<?=$invoice_details->bankAccountNumber?>" maxlength="20">
                    </td>
                </tr>
		<tr>
                    <th>Bank Name<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="bank_name_from" id="bank_name_from" placeholder="Bank Name" type="text" value="<?=$invoice_details->bankName?>" maxlength="50" >
                    </td>
                    
                </tr>
                <tr>
                    <th>Branch & city<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="bank_branch_from" id="bank_branch_from" placeholder="Branch & city" type="text" value="<?=$invoice_details->bankBranchCity?>" maxlength="50" >
                    </td>
                </tr>
                <tr>
                    <th>IFSC Code<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="bank_ifsc_code_from" id="bank_ifsc_code_from" placeholder="IFSC Code"  type="text"  value="<?=$invoice_details->bankCodeIFSC?>" maxlength="20" >
                    </td>
                </tr>
                <tr>
                    <th>GST No.<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="gst_no_from" id="gst_no_from" placeholder="GST No." type="text" value="<?=$invoice_details->invFromUserGSTNo?>" maxlength="20">
                    </td>
                </tr>
                <tr>
                    <th>TAN<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="tan_from" id="tan_from" placeholder="TAN"  type="text"  value="<?=$invoice_details->tan_from?>" maxlength="20" >
                    </td>
                </tr>
                <tr>
                    <th>PAN<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="pan_from" id="pan_from" placeholder="PAN"  type="text"  value="<?=$invoice_details->pan_from?>" maxlength="20" >
                    </td>
                </tr>
                <tr>
                    <th>SAC Code<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="sac_code_from" id="sac_code_from" placeholder="SAC Code"  type="text"  value="<?=$invoice_details->sac_code_from?>" maxlength="20" >
                    </td>
                </tr>
                <tr>
                    <th>LUT No<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="lut_no_from" id="lut_no_from" placeholder="LUT No"  type="text"  value="<?=$invoice_details->lut_no_from?>" maxlength="20" >
                    </td>
                </tr>
                <tr>
                    <th>MSME No<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="msme_no_from" id="msme_no_from" placeholder="MSME No"  type="text"  value="<?=$invoice_details->msme_no_from?>" maxlength="20" >
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
                    <th>Name<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="name_to" id="name_to" placeholder="Name" type="text" value="<?=$invoice_details->invToUserName?>" maxlength="50">
                        
                    </td>
                </tr>
                <tr class="company-name-to" >
                    <th>Company Name<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="companyName_to" id="companyName_to" placeholder="Company Name" type="text" value="<?=$invoice_details->invToCompanyName?>" maxlength="50">
                       
                    </td>
                </tr>
		<tr>
                    <th>Email ID<sup>*</sup></th>
                    <td><input  class="form-control" name="email_to" id="email_to" placeholder="Email ID" type="email" value="<?=$invoice_details->invToUserEmail?>" maxlength="50"></td>
                </tr>
		<tr>
                    <th>Phone<sup>*</sup></th>
                    <td><input  class="form-control" name="phone_to"  oninput="this.value = this.value.replace(/[^0-9+-]/g, '');" id="phone_to" placeholder="Phone" type="text" value="<?=$invoice_details->invToUserPhoneNo?>" maxlength="20"></td>
                </tr>
		<tr>
                    <th>Address<sup>*</sup></th>
                    <td><textarea  class="form-control" name="address_to" id="address_to" placeholder="Address" maxlength="500"><?=$invoice_details->invToUserAddress?></textarea></td>
                </tr>
                <tr>
                    <th>City<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="city_to" id="city_to" placeholder="City" type="text" value="<?=$invoice_details->city_to?>" maxlength="50">
                       
                    </td>
                </tr>
                <tr>
                    <th>State<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="state_to" id="state_to" placeholder="State" type="text" value="<?=$invoice_details->state_to?>" maxlength="50">
                       
                    </td>
                </tr>
                <tr>
                    <th>Pin<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="pin_to" id="pin_to" placeholder="PIN" type="text" value="<?=$invoice_details->pin_to?>" maxlength="50">
                       
                    </td>
                </tr>
		<tr>
                    <th>Place of supply<sup>*</sup></th>
                    <td>
                        <select class="form-control" name="place_of_supply_to" id="place_of_supply_to" onchange="funShowHideTaxSumm();">
                            <option value="">-Select-</option>
                            <?php foreach ($placeOfSupplyList as $place){?>
                            <option value="<?=$place->id?>" <?=($invoice_details->invToPlaceOfSupply==$place->id)?' selected ':''?>><?=$place->name?> (#<?=$place->tin_number?>)</option>
                            <?php }?>
                            
                        </select>
                    </td>
                </tr>
		<tr>
                    <th>GST No.<sup>*</sup></th>
                    <td>
                        <input  class="form-control" name="gst_no_to" id="gst_no_to" placeholder="GST No." type="text" value="<?=$invoice_details->invToUserGSTNo?>" maxlength="20">
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
                  <td><input type="text" name="term_delivery" value="<?=$invoice_details->term_delivery?>" maxlength="20"/></td>
                  <th>Payment</th>
                  <td><input type="text" name="term_payment" value="<?=$invoice_details->term_payment?>" maxlength="20"/></td>
                  <th>Reference</th>
                  <td><input type="text" name="term_reference" value="<?=$invoice_details->term_reference?>" maxlength="20"/></td>
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
                  <th style="background-color:#414042; color:#FFFFFF;">Action</th>
                </tr>
              </thead>
              <tbody>
                  
                  <?php if(!empty($invoice_details->billingItems)){?>
               <?php foreach ($invoice_details->billingItems as $key=>$item){?>
                  <?php $this->load->view('backend/ajax/invoiceItemRow',['counter'=>$key+1,'item'=>$item]); ?>
                  <?php }?>
                  <?php }else{?>
                   <?php $this->load->view('backend/ajax/invoiceItemRow',['counter'=>'1']); ?>
                  <?php }?>
              </tbody>
            </table>
          </div>
          <div style="float:right; width:auto; margin-bottom:5px;"> <a href="javascript:void(0);" id="add_more_row" title="Add" style="display:block"><b>Add New Row...</b></a> </div>
          
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
                    <input type="text" placeholder="0.00" class="subtotal" name="subtotal" id="subtotal" style="border:#FFFFFF;" readonly="" value="<?=$invoice_details->inv_amount?>" />
                </td>
              </tr>
              <tr id="rowIGST">
                <th style="width:50%">IGST:</th>
                <td>
                    <input type="text" placeholder="0.00" class="igst" name="igst" id="igst" style="border:#FFFFFF;" readonly="" value="<?=$invoice_details->inv_tax?>" />
                </td>
              </tr>
			  <tr id="rowSGST">
                <th style="width:50%">SGST:</th>
                <td>
                    <input type="text" placeholder="0.00" class="sgst" name="sgst" id="sgst" style="border:#FFFFFF;" readonly="" value="<?=$invoice_details->sgst_tax?>" />
                </td>
              </tr>
			  <tr id="rowCGST">
                <th style="width:50%">CGST:</th>
                <td>
                    <input type="text" placeholder="0.00" class="cgst" name="cgst" id="cgst" style="border:#FFFFFF;" readonly="" value="<?=$invoice_details->cgst_tax?>" />
                </td>
              </tr>
              <tr>
                <th style="width:50%">Total Invoice:</th>
                <td>
                    <input type="text" placeholder="0.00" class="total-invoice" name="totalInvoice" id="totalInvoice" style="border:#FFFFFF;" readonly="" value="<?=$invoice_details->inv_total_amount?>" />
                </td>
              </tr>
                </tbody>
            </table>
          </div>
        </div>
			
        <div class="col-xs-12"> 
        <input type="submit" class="btn btn-primary" name="buttonSubmit" id="buttonSave" value="Save" >
<!--        <input type="submit" class="btn btn-primary" name="buttonSubmit" id="buttonSaveAndApproval" value="Save & Submit For Approval" >-->
		
        <a href="<?= base_url('invoice')?>" class="btn btn-default">Cancel</a>
		
        </div>
      </div>
                  </div>
                </div> 
              </div>
            </div>   
                </form>
             <!--End:Basic Form-->
         </div>
      </div>
  </section>
  <!-- END CONTENT -->


  <script type="text/javascript">
  var itemcount = $('#tableAddNewQuote tbody tr').length;
$('#add_more_row').click(function(){
	itemcount++;
        $.ajax({
           type:'post',
           url:'<?php echo base_url('ajax-add-invoice-item-row'); ?>',
           //dataType:'json',
           data:{itemcount:itemcount},
           success:function(response){
              
               $('#tableAddNewQuote tbody').append(response);
           }
        });
	//$('.multi-packaging').append('<div class="form-group" style="padding: 10px; border: 1px solid #ccc;"><span><b>Package '+pckcount+'</b></span><div class="row"><div class="col-12 col-lg-4"><label>Material Description <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="material" required="required" /><span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle"></i></span></div></div><div class="col-12 col-lg-4"><label>HS Code <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="hs_code" required="required" /><span class="error1" style="display: none;"><i class="error-log fa fa-exclamation-triangle"></i></span> </div></div><div class="col-12 col-lg-4"><label>Type Of Packing <sup>* </sup></label><div class="input-comment"><select name="material_unit" class="form-control"><option value="">Select Packing</option><option>Wooden</option><option>Pallet</option><option>Box</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Net Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="net_weight" id="net_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Gross Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="gross_weight" id="gross_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Length: </label><div style="display: flex;"><input type="text" class="form-control" name="length" id="length" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Height: </label><div style="display: flex;"><input type="text" class="form-control" name="height" id="height" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div><div class="col-12 col-lg-4"><label>Width: </label><div style="display: flex;"><input type="text" class="form-control" name="width" id="width" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div></div>');
	
});

$(document).on('click','.remove-item',function(e){
    var currentElement = this;
    
      if(confirm("Are you sure delete this item.")){
          
            $(currentElement).closest('tr').remove();
              calculateTax();     
      }  
    
});
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
var calculateTax = function(){
        
        var subtotal = 0;
        var igst = 0;
         $('#tableAddNewQuote tbody tr').each(function(index){
                
                 
               var $tblrow = $(this);
 
                var amount = parseFloat($tblrow.find(".amount").val());
                var efectiveTaxRate = parseFloat($tblrow.find(".tax").val());
                var tax=0,total_amount=0;
                
                if($tblrow.find(".amount").val()==''){
                    amount = 0;
                    $tblrow.find(".amount").val('0.00');
                }
                if($tblrow.find(".tax").val()==''){
                    efectiveTaxRate = 0;
                    $tblrow.find(".tax").val('0.00');
                }
                
                
                tax = (amount * efectiveTaxRate) / 100;
                total_amount = tax + amount;
                subtotal +=amount;
                igst +=tax;
                //$tblrow.find(".tax").val(tax.toFixed(2));
                $tblrow.find(".total-amount").val(total_amount.toFixed(2));
            });
            $(".subtotal").val(subtotal.toFixed(2));
			$(".igst").val(igst.toFixed(2));
			var sgst = (igst / 2);
			$(".sgst").val(sgst.toFixed(2));
			var cgst = (igst / 2);			
			$(".cgst").val(cgst.toFixed(2));
			$(".total-invoice").val((subtotal+igst).toFixed(2));
			
			
			/**[end::warning msg display]**/			 				
		
        return 1;
    }
  </script>
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
                <h5 class="breadcrumbs-title"><?=$invoice_details->inv_id?'Edit':'Create'?>  <?= ucwords($this->invoice_type)?></h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= base_url('dashboard')?>">Dashboard</a>
                  </li>
                  <li><a href="#">Revenue</a>
                  </li>
                  <li><a href="<?= base_url($this->invoice_type)?>"><?= ucwords($this->invoice_type)?></a>
                  </li>
                  <li class="active"><?=$invoice_details->inv_id?'Edit ':'Create '?> <?= ucwords($this->invoice_type)?></li>
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
            
                
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <form name="invoiceForm" id="invoiceForm" method="POST" action="">
                          <input type="hidden" name="invoice_id" value="<?=$invoice_details->inv_id?>" />
                          
                        <div class="row">
                            <div class="col s12">
                                <img src="<?=base_url('/assets/frontend/images/tecs-pdf-logo.png')?>" style="width:300px; "> 
                            </div>
                            <div class="input-field col s6">
                                <label>Invoice No.: <?=$invoice_details->inv_unique_id?$invoice_details->inv_unique_id:$tmp_invoice_number?></label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="invoice_date" autocomplete="off" id="invoice_date" class="datepicker" placeholder="DD-MMM-YYYY" value="<?=printFormatedDate($invoice_details->invoice_date?$invoice_details->invoice_date:date('Y-m-d'))?>">
                                <label for="invoice_date" class="active" >Invoice Date</label>
                            </div>
                            <input type="hidden" name="invoice_type" id="invoice_type" value="<?=$invoice_type?>"/>
<!--                            <div class="input-field col s6">
                                <input type="radio" id="invoice_type_proforma" name="invoice_type" value="Proforma" <?=$invoice_details->inv_type=="Proforma"||empty($invoice_details->inv_type)?" checked ":''?> ><label for="invoice_type_proforma">Proforma</label>
                                <input type="radio" id="invoice_type_invoice" name="invoice_type" value="Invoice" <?=$invoice_details->inv_type=="Invoice"?" checked ":''?>><label for="invoice_type_invoice">Invoice</label>

                            </div>-->
                            <div class="input-field col s6">
                                <select id="to_company_id" name="to_company_id" required="" class="validate" aria-required="true">
                                    <option value="">Select</option>
                                   <?php foreach ($company_list as $key=>$company){?>
                                    <?php if(!empty(trim($company['name']))){?>
                                      <option value="<?=$company['id']?>" data-index="<?=$key?>" <?=$invoice_details->company_id==$company['id']?' selected ':''?>><?=$company['name']?></option>
                                      <?php }?>
                                       <?php }?>
                                     <option value="">Other</option>
                                </select>
                                <label for="to_company_id">Select Company</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="customer_name"  required="" class="validate" aria-required="true" name="customer_name" type="text" maxlength="50" value="<?=$invoice_details->customer_name?>">
                              <label for="customer_name" >Customer</label>
                              
                            </div>
                            <div class="input-field col s6">
                             <input required="" class="validate" aria-required="true" id="company_name" name="company_name" type="text" maxlength="50" value="<?=$invoice_details->company_name?>">
                              <label for="company_name" >Company Name</label>
                            </div>
                            <div class="input-field col s6">
                             <input  required="" class="validate" aria-required="true" id="address" name="address" type="text" maxlength="100" value="<?=$invoice_details->address?>">
                              <label for="address" >Address</label>
                            </div>
                            <div class="input-field col s6 profileCitySearch">
                                <input id="city_name" class="search-box validate" required="" aria-required="true" name="city_name" type="text" placeholder="Type City Name" autocomplete="off" maxlength="100" value="<?=$invoice_details->city_name?>">
                              <label for="address" >City</label>
                                <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                <input type="hidden" class="cityId" id="city_id" name="city_id" value="<?php echo $invoice_details->city_id?>">
                                <input type="hidden" class="stateId" id="state_id" name="state_id" value="<?php echo $invoice_details->state_id?>">
                                <input type="hidden" class="countryId" id="country_id" name="country_id" value="<?php echo $invoice_details->country_id?>">

                            </div>
                            <div class="input-field col s6">
                             <input id="pincode" name="pincode" type="text" maxlength="10" value="<?=$invoice_details->pincode?>">
                              <label for="pincode" >PIN</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="contact_number" required="" aria-required="true" class="validate" name="contact_number" type="text" maxlength="15" value="<?=$invoice_details->contact_no?>">
                              <label for="contact_number" >Contact No.</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="email" required="" aria-required="true" class="validate" name="email" type="email" maxlength="60" value="<?=$invoice_details->email?>">
                              <label for="email" >Email.</label>
                            </div>
                            <div class="input-field col s6">
                                <input  required="" aria-required="true" class="validate" id="gst_tax_no" name="gst_tax_no" type="text" maxlength="20" value="<?=$invoice_details->gst_tax_no?>">
                              <label for="gst_tax_no" >GST/TAX No.</label>
                            </div>
                           
                            <div class="input-field col s6 tax">
                                <select name="tax_type" id="tax_type" >
                                    <option <?=$invoice_details->tax_type=="Not Applicable"?" selected ":""?>>Not Applicable</option>
                                    <option <?=$invoice_details->tax_type=="CGST/SGST"?" selected ":""?>>CGST/SGST</option>
                                    <option <?=$invoice_details->tax_type=="IGST"?" selected ":""?>>IGST</option>
                                </select>
                              <label for="tax_type" >Tax Type</label>
                            </div>
                            <div class="input-field col s6">
                                <input required="" aria-required="true" class="validate" type="text" id="transaction_currency" name="transaction_currency" maxlength="4" value="<?=$invoice_details->transaction_currency?$invoice_details->transaction_currency:'INR'?>" />
                             
                              <label for="transaction_currency" >Currency</label>
                            </div>
                           
                            <div class="input-field col s12">
                                <input id="terms" name="terms" required="" aria-required="true" class="validate" type="text" maxlength="150" value="<?=$invoice_details->term?>">
                              <label for="terms" >Terms</label>
                            </div>
                            
                        </div>
                          <div class="row proforma-invoice-div">
                              <h5>Link Proforma Invoices</h5>
                              <div class="col s12 proforma-invoice-list">
                                  
                                  <?php $this->load->view('backend/ajax/linkProformaInvoice',['proformaNotLinkedList'=>$invoice_details->proformaNotLinkedList,'proformaLinkedList'=>$invoice_details->proformaLinkedList]);?>
                                  
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
                  <th style="background-color:#414042; color:#FFFFFF;">Amount</th>
                  <th style="background-color:#414042; color:#FFFFFF;">Action</th>
                </tr>
              </thead>
              <tbody>
                  
                  <?php if(!empty($invoice_details->billingItems)){?>
               <?php foreach ($invoice_details->billingItems as $key=>$item){?>
                  <?php $this->load->view('backend/ajax/invoiceItemRow',['item'=>$item]); ?>
                  <?php }?>
                  <?php }else{?>
                   <?php $this->load->view('backend/ajax/invoiceItemRow'); ?>
                  <?php }?>
              </tbody>
            </table>
          </div>
          <div style="float:right; width:auto; margin-bottom:5px;"> <a href="javascript:void(0);" id="add_more_row" title="Add" style="display:block"><b>Add New Row...</b></a> </div>
          
        </div>
      </div>
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <td>TOTAL</td><td><input type="text" readonly="" placeholder="0.00" name="total" id="total" style="border: none;" value="<?=$invoice_details->total_amount?>"></td>
                                </tr>
                                
                               
                                
                                    <tr class="igst-tax" style="<?=$invoice_details->tax_type=='IGST'?'':'display:none'?>" >
                                        <td>IGST <input  aria-required="true" class="validate" type="text" maxlength="5" name="igst_percent" id="igst_percent" style="width:50px;margin-left: 20px;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?=$invoice_details->igst_percent?$invoice_details->igst_percent:'18'?>">%</td><td><input placeholder="0.00" name="igst_tax" id="igst_tax" type="text" readonly="" style="border: none;" value="<?=$invoice_details->igst_tax?>"></td>
                                    </tr>
                                
                                    <tr class="cgst-tax" style="<?=$invoice_details->tax_type!='IGST'?'':'display:none'?>">
                                        <td>CGST <input required="" aria-required="true" class="validate" type="text" maxlength="5"  name="cgst_percent" id="cgst_percent" style="width:50px;margin-left: 20px;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?=$invoice_details->cgst_percent?$invoice_details->cgst_percent:'9'?>">%</td><td><input placeholder="0.00"  name="cgst_tax" id="cgst_tax" type="text" readonly="" style="border: none;" value="<?=$invoice_details->cgst_tax?>"></td>
                                    </tr>
                                    <tr class="sgst-tax" style="<?=$invoice_details->tax_type!='IGST'?'':'display:none'?>">
                                        <td>SGST <input type="text" required="" aria-required="true" class="validate" maxlength="5" name="sgst_percent" id="sgst_percent" style="width:50px;margin-left: 20px;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?=$invoice_details->sgst_percent?$invoice_details->sgst_percent:'9'?>">%</td><td><input placeholder="0.00" name="sgst_tax" id="sgst_tax" type="text" readonly="" style="border: none;" value="<?=$invoice_details->sgst_tax?>"></td>
                                    </tr>
                              
                                
                                <tr>
                                    <td>GRAND TOTAL</td><td><input placeholder="0.00" name="grand_total" id="grand_total" type="text" readonly="" style="border: none;" value="<?=$invoice_details->grand_total?>"></td>
                                </tr>
                            </table>
                        </div>
                          
                        <div class="row">
                            <div class="input-field col s12">
                                <a href="<?= base_url($this->invoice_type)?>" class="btn cyan waves-effect waves-light  right ">Cancel</a> 
                              <button class="btn cyan waves-effect waves-light right" type="submit">Save<i class="mdi-content-send right"></i>
                              </button> 
                            </div>
                        </div>
                      </form>
                  </div>
                </div> 
              </div>
            </div>   
               
             <!--End:Basic Form-->
         </div>
      </div>
  </section>
  <!-- END CONTENT -->
<!--Start:: add City Modal -->
<div class="modal fade" id="addNewCityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add City</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="addCityFrm" name="addCityFrm"  method="post" action="">
          <div class="form-group">
              <input type="hidden" name="city_prefix" value="" id="city_prefix">
          <div class="row">
              <div class="col-lg-4">
        <label for="country">Country</label>
        <input type="text" class="form-control alpha-num-space" placeholder="Country" id="country" name="country" maxlength="50" required="" value="<?=$invoice_details->country_id?>">
      </div>
          <div class="col-lg-4">
        <label for="state">State</label>
        <input type="text" class="form-control alpha-num-space" placeholder="State" id="state" name="state" maxlength="50" required <?=$invoice_details->state_id?>>
      </div>
          <div class="col-lg-4">
        <label for="city">City</label>
        <input type="text" class="form-control alpha-num-space" placeholder="City" id="city" name="city" maxlength="50" required <?=$invoice_details->city_id?>>
      </div>
          </div>
          </div>
              </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--End:: add City Modal -->

  <script type="text/javascript">
      var company_list = <?= json_encode($company_list)?>;
      
     $('#to_company_id').change(function(){
         var index = $('#to_company_id option:selected').attr('data-index');
         
         if(index){
                $('#customer_name').val(((company_list[index].head_salutation?company_list[index].head_salutation:'')+' '+(company_list[index].head_firstname?company_list[index].head_firstname:'')).trim());
                $('#company_name').val((company_list[index].name?company_list[index].name:'').trim());
                $('#address').val(((company_list[index].address_line_1?company_list[index].address_line_1:'')+' '+(company_list[index].address_line_2?company_list[index].address_line_2:'')).trim());
                $('#contact_number').val((company_list[index].head_phone?company_list[index].head_phone:'').trim());
                $('#city_name').val((company_list[index].city_name?company_list[index].city_name:'').trim());
                $('#city_id').val((company_list[index].city_id?company_list[index].city_id:'').trim());
                $('#state_id').val((company_list[index].state_id?company_list[index].state_id:'').trim());
                $('#country_id').val((company_list[index].country_id?company_list[index].country_id:'').trim());
                $('#pincode').val((company_list[index].pincode?company_list[index].pincode:'').trim());
                $('#email').val((company_list[index].head_email?company_list[index].head_email:'').trim());
                var gst_tax_no = '';
                if(company_list[index].gst_tax_doc_details){
                    gst_tax_no = company_list[index].gst_tax_doc_details.number?company_list[index].gst_tax_doc_details.number:'';
                }
                
                $('#gst_tax_no').val(gst_tax_no.trim());
                $('#transaction_currency').val(company_list[index].transaction_currency?(company_list[index].transaction_currency).trim():'INR');
                
                
                $('#customer_name,#company_name,#address,#contact_number,#city_name,#pincode,#email,#gst_tax_no,#transaction_currency').change();
                getProformaInvoiceList(company_list[index].id);
             }else{
               $('#customer_name,#company_name,#address,#contact_number,#city_name,#city_id,#state_id,#country_id,#transaction_currency,#pincode,#email,#gst_tax_no').val('');
                $('#customer_name,#company_name,#address,#contact_number,#city_name,#pincode,#email,#gst_tax_no,#transaction_currency').change();
                
             }
     }); 

//$('input[name="invoice_type"]').change(function(){
//  
//    if($(this).val()=="invoice"){
//        $('.tax,.cgst-tax,.sgst-tax,.igst-tax').show();
//    }else{
//        $('#cgst_percent').val('');
//        $('#sgst_percent').val('');
//        $('#igst_percent').val('');
//        $('#cgst_tax').val('');
//        $('#sgst_tax').val('');
//        $('#igst_tax').val('');
//        $('#tax_type').val('Not Applicable');
//        $('#tax_type').material_select();
//        $('.tax,.cgst-tax,.sgst-tax,.igst-tax').hide();
//    }
//})

$('#tax_type').change(function(){
  console.log($(this).val());
    if($(this).val()=="IGST"){
       $('.igst-tax').show();
       $('.cgst-tax,.sgst-tax').hide();
       $("#cgst_percent").attr('required', false);
       $("#sgst_percent").attr('required', false);
       $("#igst_percent").attr('required', true);
    }else{
      $('.igst-tax').hide();
       $('.cgst-tax,.sgst-tax').show();
       $("#cgst_percent").attr('required', true);
       $("#sgst_percent").attr('required', true);
       $("#igst_percent").attr('required', false);
    }
})


function getProformaInvoiceList(company_id){
    var inv_id = $('#invoice_id').val();
    $.ajax({
            type:'post',
            url:'<?php echo base_url('ajax-get-proforma-invoice-list'); ?>',
            data:{company_id:company_id,inv_id:inv_id},
            success: function(response){
                console.log(response);
                $('.proforma-invoice-div .proforma-invoice-list').html(response);
            }
        });
}
    
  var itemcount = $('#tableAddNewQuote tbody tr').length;
$('#add_more_row').click(function(){
	
     addInvoiceItemRow();
	//$('.multi-packaging').append('<div class="form-group" style="padding: 10px; border: 1px solid #ccc;"><span><b>Package '+pckcount+'</b></span><div class="row"><div class="col-12 col-lg-4"><label>Material Description <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="material" required="required" /><span class="error1" style="display: none;"> <i class="error-log fa fa-exclamation-triangle"></i></span></div></div><div class="col-12 col-lg-4"><label>HS Code <sup>* </sup></label><div class="input-comment"><input type="text" class="form-control" name="hs_code" required="required" /><span class="error1" style="display: none;"><i class="error-log fa fa-exclamation-triangle"></i></span> </div></div><div class="col-12 col-lg-4"><label>Type Of Packing <sup>* </sup></label><div class="input-comment"><select name="material_unit" class="form-control"><option value="">Select Packing</option><option>Wooden</option><option>Pallet</option><option>Box</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Net Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="net_weight" id="net_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Gross Weight: </label><div style="display: flex;"><input type="text" class="form-control" name="gross_weight" id="gross_weight" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>1 set</option><option>1 lot</option><option>KG</option><option>Liter</option><option>Cub meter</option></select></div></div><div class="col-12 col-lg-4"><label>Length: </label><div style="display: flex;"><input type="text" class="form-control" name="length" id="length" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div><div class="row"><div class="col-12 col-lg-4"><label>Height: </label><div style="display: flex;"><input type="text" class="form-control" name="height" id="height" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div><div class="col-12 col-lg-4"><label>Width: </label><div style="display: flex;"><input type="text" class="form-control" name="width" id="width" required="required"/><select class="form-control" name="weight_uom" style="width: 80px;"><option selected disabled>UOM</option><option>Cm</option><option>Inch</option><option>meter</option><option>foot</option></select></div></div></div></div>');
	
});
$(document).on('click','.proforma-invoice-list input[type="checkbox"]',function(){
    console.log($(this).val(),$(this).prop('checked'));
    var proforma_invoice_id = $(this).val();
    if($(this).prop('checked')){
        addInvoiceItemRow(proforma_invoice_id);
    }else{
        $('.proforma-'+proforma_invoice_id).remove();
        calculateTax(); 
    }
    
})

function addInvoiceItemRow(invoice_id=''){
       $.ajax({
           type:'post',
           url:'<?php echo base_url('ajax-add-invoice-item-row'); ?>',
           //dataType:'json',
           data:{invoice_id:invoice_id},
           success:function(response){
              $('#tableAddNewQuote tbody').append(response);
               calculateTax(); 
           }
        });
}

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

$('#cgst_percent,#sgst_percent,#igst_percent').blur(function(){
    calculateTax();
})
$('#tax_type').change(function(){
    calculateTax();
})


var calculateTax = function(){
        
        var subtotal = 0;
        var cgst_percent = parseFloat($('#cgst_percent').val())||0 ;
        var sgst_percent = parseFloat($('#sgst_percent').val())||0 ;
        var igst_percent = parseFloat($('#igst_percent').val())||0 ;
        var cgst_tax=0;
        var sgst_tax=0;
        var igst_tax=0;
        var grand_total = 0;
        var tax_type = $('#tax_type').val();
         $('#tableAddNewQuote tbody tr').each(function(index){
                
                 
               var $tblrow = $(this);
 
                var amount = parseFloat($tblrow.find(".amount").val())||0;
               subtotal+=amount;
                
            });
            cgst_tax = (subtotal*cgst_percent)/100;
            sgst_tax = (subtotal*sgst_percent)/100;
            igst_tax = (subtotal*igst_percent)/100;
            
           if(tax_type=='IGST'){
                grand_total = subtotal+igst_tax;
            }else{
                grand_total = subtotal+cgst_tax+sgst_tax;
            }
            
            $("#total").val(subtotal.toFixed(2));
            $("#cgst_tax").val(cgst_tax.toFixed(2));
            $("#sgst_tax").val(sgst_tax.toFixed(2));
            $("#igst_tax").val(igst_tax.toFixed(2));
            $("#grand_total").val(grand_total.toFixed(2));
			
			
			/**[end::warning msg display]**/			 				
		
        return 1;
    }
  </script>
  
   <!--[strat::city]-->
<style type="text/css">
#country-list{float:left;list-style:none;margin:0;padding:0;width:740px; z-index:1010; position:absolute;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
</style>
<script type="text/javascript">
    var session_user_id = '<?=$this->session->userdata("seller_logged_in")['id'];?>';
    $('#addNewCityModal button[type="submit"]').click(function(e){
    
    var city = $('#addNewCityModal #city').val();
    var state = $('#addNewCityModal #state').val();
    var country = $('#addNewCityModal #country').val();
    e.preventDefault();
    $('#addCityFrm').validate({
        rules:{
            country:{required:true},
            state:{required:true},
            city:{required:true},
        }
    });
    if(!$('#addCityFrm').valid()){
        return false;
    }
    $.ajax({
           type:'post',
           url:'<?php echo base_url('ajax-add-city'); ?>',
           //dataType:'json',
           data:{country:country,state:state,city:city,session_user_id:session_user_id},
           success:function(response){
              var json_response = JSON.parse(response);
              console.log(city_prefix,json_response);
              $('#city_id').val(json_response.city_id);
              $('#state_id').val(json_response.state_id);
              $('#country_id').val(json_response.country_id);
              $('#city_name').val(json_response.city_name);
              $("#transaction_currency").val(json_response.currency);
              $('#addNewCityModal').modal('hide');
           }
        });
} );

$('.profileCitySearch input.search-box').on('keyup',function(e){
        var keyword = $(this).val();
        console.log(keyword);
        if(keyword!==""){
		$.ajax({
		type: "POST",
		url: '<?php echo base_url('ajax-city-list'); ?>',
		data:'keyword='+keyword,
		beforeSend: function(){
			$("#search-box").css("background","#FFF url("+$('#base_url').val()+"media/images/ajax-loader.gif) no-repeat 165px");
		},
		success: function(data){
			$(".profileCitySearch .cityId").val('');
			$(".profileCitySearch .stateId").val('');
			$(".profileCitySearch .countryId").val('');
			$(".profileCitySearch .suggesstion-box").show();
			$(".profileCitySearch .suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
                }else{
                $(".profileCitySearch .cityId").val('');
                $(".profileCitySearch .stateId").val('');
                $(".profileCitySearch .countryId").val('');
                $(".profileCitySearch .suggesstion-box").hide();
            }
    });
    
    $('.profileCitySearch input.search-box').on('blur',function(e){
        ($(".profileCitySearch .cityId").val())?'':$(".profileCitySearch input.search-box").val('');
        
    });
    
     $(document).on('click','.profileCitySearch .suggesstion-box ul li',function(e){
          if($(this).attr('data-cityId')!='0'){
         $(".profileCitySearch .cityId").val($(this).attr('data-cityId'));
         $(".profileCitySearch .stateId").val($(this).attr('data-stateId'));
         $(".profileCitySearch .countryId").val($(this).attr('data-countryId'));
         $("#transaction_currency").val($(this).attr('data-currency'));
        
         $('.profileCitySearch input.search-box').val($(this).text());
        }else{
         
          $('#addNewCityModal #city_prefix').val('');
             $('#addNewCityModal').modal('show');
         }     
            $(".profileCitySearch .suggesstion-box").hide(); 
     });

</script>
<!--[end::city]-->


   <script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
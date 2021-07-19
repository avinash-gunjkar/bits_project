	<style>
.comment-group {
    border-bottom:none;
	padding: none;
}
.comment-img {
    position: initial !important;
}
.comment-img img {
    max-width: 80%;
    border-radius: 0% !important;
}
.section-title {
    text-align: left;
    padding-bottom: 0px;
    padding-top: 45px;
}
.wshipping-content-block {
    /*padding: 0px 0px;*/
}
.error{
	  color:red;
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
   <!-- Tracking start -->
   <div class="wshipping-content-block">
       <!--<div class="row promo-box" style="background-image: url('<?php echo base_url('assets/frontend/images/bg-header.jpg'); ?>');background-repeat: no-repeat;background-position: center;">
		   <div class="container">
			   <div class="row">-->
				 <!-- <div class="col-12 col-lg-4">
					<br/>-->
					<!--<span style="font-size:22px;color: #f25859;"><?php echo $myProfile->company_name; ?></span>-->
					<!--<span class="text-white">( <i><?php echo ($myProfile->role == 2) ? 'Seller':'Freight Forwarder'; ?></i> ) </span>-->
<!-- 					 <div class="section-title wow fadeInUp">
						<div class="comment-img">
						<?php if($myProfile->profile_pic){ ?>
						<img src="<?php //echo $myProfile->profile_pic; ?>" alt="" />
						<?php }else{ ?>
						<img src="<?php //echo base_url('assets/frontend/images/comment-pic1.jpg'); ?>" alt="" />
						<?php } ?>
						</div>
						 <h4 class="text-white" style="margin-top:0px !important;margin-bottom:40px !important;"><?php //echo $myProfile->company_name; ?></h4>
					 </div> -->
				  <!--</div>-->
				  <!--<div class="col-12 col-lg-8">
					 <div class="wow fadeInUp pt10 pull-right">
						<a href="<?php echo base_url('my-profile'); ?>"><span class="custom-btn-reg cbtn-yellow text-uppercase cbtn-shadow" style="margin-top: 20px;">My Profile</span></a>
						<a href="<?php echo base_url('request-list'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">RFC</span></a>
						<a href="<?php echo base_url('shipment-list'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">Shipments</span></a>
					 </div>
				  </div>-->
	<!--		   </div>
		   </div>
       </div>
	   <br/>-->
	   <div class="container">
       
       <div class="row">
          <div class="col-12 col-lg-12">
             <div class="tracking-block">
             <?php if($this->session->flashdata('error')){?>
                        <div class="">
                            <div class="col-lg-12 alert alert-danger">
                            <?=$this->session->flashdata('error')?>
                                </div>
                            </div>
                        <?php }?>
                <ul class="nav nav-tabs" role="tablist">
                	<?php $activeTab = $this->session->userdata('companyActiveTab') ? $this->session->userdata('companyActiveTab') : 'profile' ; ?>
                  <li class="nav-item"><a class="nav-link <?php echo ($activeTab == 'profile') ? 'active' : '' ; ?>" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile </a></li>
                  <li class="nav-item"><a class="nav-link <?php echo ($activeTab == 'kyc') ? 'active' : '' ; ?>" href="#kyc" aria-controls="kyc" role="tab" data-toggle="tab">KYC Document </a></li>
               </ul>
               <div class="tab-content">
				  <div role="tabpanel" class="tab-pane <?php echo ($activeTab == 'profile') ? 'active' : '' ; ?>" id="profile">		
                                      <div class="put-reference-number">
        <form name="profileForm" id="profileForm" action="<?php echo base_url('ff-company-profile'); ?>" method="post" enctype="multipart/form-data">
             <h3>Freight Forwarder - Details</h3>
             <div class="row">


             <div class="col-6">
                <div class="form-row mb-3">
                    <div class="col">
                        <label>Company Name <sup>*</sup></label>
                        <input type="text" class="form-control" name="company_name" id="company_name"  placeholder="Company Name" maxlength="50" value="<?php echo $companyProfile->name?>" >
                    </div>
                </div> 
        <div class="form-row mb-3">
        <div class="col">
        <label>Address Line 1 <sup>*</sup></label>
        <input type="text" class="form-control" name="address_line_1" id="address_line_1" placeholder="Address Line 1" maxlength="50" value="<?php echo $companyProfile->address_line_1?>">
        </div>
        </div>
        <div class="form-row mb-3">
        <div class="col">
        <label>Address Line 2 </label>
        <input type="text" class="form-control" name="address_line_2" id="address_line_2" placeholder="Address Line 2" maxlength="50" value="<?php echo $companyProfile->address_line_2?>" >
        </div>
        </div>
        <div class="form-row mb-3">
        <div class="col profileCitySearch">
        <label>City <sup>*</sup></label>
        <input type="text" class="form-control search-box" name="city_name" id="city_name" placeholder="Type City Name" autocomplete="off" value="<?php echo $companyProfile->city_name?>" >
        <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
        <input type="hidden" class="cityId" id="city_id" name="city_id" value="<?php echo $companyProfile->city_id?>">
        <input type="hidden" class="stateId" id="state_id" name="state_id" value="<?php echo $companyProfile->state_id?>">
        <input type="hidden" class="countryId" id="country_id" name="country_id" value="<?php echo $companyProfile->country_id?>">
        </div>

        
        </div>


        <!-- <div class="form-row mb-3">
        <div class="col">
        <label>State</label>
        <input type="text" class="form-control" placeholder="State" >
        </div>

        <div class="col">
        <label>Country</label>
        <input type="text" class="form-control" placeholder="Country" >
        </div>
        </div>-->

        <div class="form-row mb-3">
            <div class="col">
        <label>Pin code <sup>*</sup></label>
        <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Pincode" maxlength="6" value="<?= $companyProfile->pincode?>">
        </div>
        <div class="col">
        <label>Transaction Currency <sup>*</sup></label>
        <input type="text" class="form-control" name="transaction_currency" readonly="" value="<?= $companyProfile->transaction_currency?>" id="transaction_currency" placeholder="Transaction Currency"  maxlength="6">
        </div>
        </div>



        </div>

        <div class="col-6">
            <div class="form-row mb-3" style="display:none">
        <div class="col">
        <label>Industry Type</label>
        <select class="custom-select" name="industry_types[]" id="industry_types" multiple="">
         <?php foreach($industries as $industry){ ?>
            <option <?php echo (in_array($industry['id'],['2']) )? 'selected' : ''; ?> value="<?php echo $industry['id']; ?>"><?php echo $industry['title']; ?></option>
         <?php } ?>
        </select>
        </div>
        </div>

        <div class="form-row mb-3">
        <div class="col">
        <!--<label>Industry Sector</label>-->
        <label>Expertise Sector</label>
        <select class="custom-select chosen-select" name="sectors[]" id="sectors" multiple="">
        <?php foreach($sectors as $sector){ ?>
                <option <?php echo (in_array($sector['id'], $companyProfile->sectors) )? 'selected' : ''; ?> value="<?php echo $sector['id']; ?>"><?php echo $sector['name']; ?></option>
         <?php } ?>
        </select>
        </div>
        </div>


        <div class="form-row mb-3">
        <div class="col">
        <label>Company Logo</label>
        <div class="input-group ">
        <div class="custom-file">
            <input type="file" class="custom-file-input preview" data-previewTarget="#logoPreview" name="company_logo" id="company_logo" aria-describedby="company_logo-error">
        <label class="custom-file-label" for="company_logo">Choose file</label>
        </div>
        </div>
            <span id="company_logo-error" class="error"></span>
        </div>
            <div class="col mt-4">
                <img id="logoPreview" src="<?php echo base_url().'uploads/company/'.$companyProfile->company_logo; ?>" onerror='this.src="<?php echo base_url().'uploads/default.png';?>"' style="height:50px;width: 50px; object-fit: contain;"/>
                 <input id="clearSelectionBtn" type="button" class="btn btn-secondary btn-sm" value="Clear the Selection" style="display:none;" >
            </div>   
        </div>

        <div class="form-row mb-3">
        <div class="col">
        <label>Website</label>
        <input type="text" class="form-control" name="website" id="website" placeholder="http://www.example.com"  maxlength="40" value="<?= $companyProfile->website?>">
        </div>
        </div>

        </div>

        <div class="col-12">
<!--        <div class="form-row mb-3">
        <div class="col-6 pr-3">
        <label>GST/Tax No</label>
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile02">
        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
        </div>
        </div>

        <div class="col-6 pl-3">
        <label>COI/Proprietorship/LLP</label>
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile02">
        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
        </div>
        </div>

        </div>-->


<!--        <div class="form-row mb-3">
        <div class="col-6 pr-3">
        <label>PAN / Income Tax  *</label>
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile02">
        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
        </div>
        </div>

        <div class="col-6 pl-3">
        <label>Import Export Code</label>
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile02">
        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
        </div>
        </div>

        </div>-->




<!--        <div class="form-row mb-3">
        <div class="col-6 pr-3">
        <label>IATA Detail</label>
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile02">
        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
        </div>
        </div>

        <div class="col-6 pl-3">
        <label>Transaction Currency *</label>
        <input type="text" class="form-control"  placeholder="Company Name" >
        </div>

        </div>-->

        <div class="form-row mb-3">


        <div class="col-12 ">
        <label>Company Profile Summary </label>
        <textarea class="form-control" name="description" id="description" placeholder="Company Profile Summary..." maxlength="1000" style="height:200px;"><?= $companyProfile->description?></textarea>
        </div>

        </div>

        <h3>Freight Seller - Contacts</h3>

        <div class="form-row mb-3">
        <div class="col-6 pr-3">
        <label>Head Name <sup>*</sup></label>
        <div class="custom-file">
            <input type="text" class="form-control" name="head_firstname" id="head_firstname" maxlength="50"  placeholder="Head Name" value="<?= $companyProfile->head_firstname?>" >

        </div>
        </div>

            <div class="col-6 pr-3">
        <label>Head Email Address <sup>*</sup></label>
        <div class="custom-file">
            <input type="text" class="form-control" name="head_email" placeholder="Head Email Address" maxlength="50" value="<?= $companyProfile->head_email?>" >

        </div>
        </div>
        

        </div>


        <div class="form-row mb-3">
        
        <div class="col-6 pr-3">
        <label>Head Mobile Number <sup>*</sup></label>
        <div class="input-group">
        <div class="input-group-prepend">
            <select class="custom-select" name="head_country_code" id="head_country_code">
              <?php foreach (getCountryDialCodes() as $countryDial){ ?>
                <option value="<?=$countryDial->dial_code?>" <?=$companyProfile->head_country_code==$countryDial->dial_code||(empty($companyProfile->head_country_code) && $countryDial->dial_code=='+91' )?' selected ':''?>><?=$countryDial->dial_code?></option>
                <?php }?>
          </select>
        </div>
        <input type="text" class="form-control" name="head_phone" aria-describedby="head_phone-error"  placeholder="Head Mobile/Phone Number" maxlength="15" value="<?= $companyProfile->head_phone?>">
      </div>
        <span id="head_phone-error" class="error"></span>
        </div>

            <div class="col-6 pr-3">
        <label>Phone Number/Landline</label>
        <div class="custom-file">
            <input type="text" class="form-control" name="head_landline" id="head_landline" maxlength="20" placeholder="Phone Number/Landline" value="<?= $companyProfile->head_landline?>">

        </div>
        </div>
        </div>


        <div class="form-row mb-3">
        

        <div class="col-6 pr-3">
        <label>Fax Number</label>
        <input type="text" class="form-control" name="head_fax" id="head_fax" maxlength="20" placeholder="Fax Number" value="<?= $companyProfile->head_fax?>">
        </div>

        </div>


        <div class="form-row mb-3">
        <div class="col-3 pr-3">
        <button class="btn btn-submit btn-block" type="submit">Save</button>
        </div>
        </div>









        </div>







        </div>
        </form>
                     
					
					 </div>
                 </div>
				
                 <div role="tabpanel" class="tab-pane <?php echo ($activeTab == 'kyc') ? 'active' : '' ; ?>" id="kyc">
                  <div class="put-track-number">
                
                  <form id="uploadKYC" action="<?php echo base_url('ff-kyc-documents'); ?>" method="post" enctype="multipart/form-data">
				    <div class="col-12 col-md-12 col-lg-12">
                                        <?php foreach ($companyProfile->kyc_documents as $key=>$document){?>
					
						 <div class="row" >
						   <div class="col-3">
							<label><?=$document['documnetName']?> <?=$document['is_mandatory']?'*':''?></label>
                                                        <input class="form-control <?=$document['is_mandatory']?'requiredClass':''?> " type="text" name="document_number[<?=$key?>]"  value="<?=$document['details']->number?>">
                                                        
                                                        
                                                          
							<!--<span id="doc_type[]-error" class="">Only .jpg,.jpeg,.png,.bmp are allow.</span>-->
						   </div>
                                                     <div class="col-4">
                                                         <label>File</label>
                                                         <input type="file" class="form-control preview <?=$document['is_mandatory']?'requiredClass':''?> validImage" data-previewTarget="#kycPreview<?=$key?>" name="kyc_documents[<?=$key?>]" id="kyc_documents<?=$document['type']?>"/>
							<input type="hidden"  name="doc_name[<?=$key?>]" value="<?=$document['type']?>"/>
							<input type="hidden"  name="old_doc_name[<?=$key?>]" value="<?=$document['details']->file?>"/>
                                                       
                                                     </div>
                                                     <div class="col-3 text-center">
                                                         <img id="kycPreview<?=$key?>" src="<?php echo base_url().'uploads/kyc_documents/'.$document['details']->file;?>" onerror='this.src="<?php echo base_url().'uploads/default.png';?>"' style="width: 50px; height: 50px; object-fit: contain;" />
                                                        
                                                     </div>
                                                     <div class="col-2 text-center">
                                                         <label>Status</label>
                                                         <?=$document['details']->status=='1'?'<label class="row text-success">Approved</label>':'<label class="row text-danger">Approval Pending</label>'?>
                                                         
                                                     </div>
						   
						 </div>   
                         <hr /> 
					  
                                        <?php } ?>
                                        
						
					   <button type="submit" class="btn btn-submit">Save</button>
				   </div>
                  </form>
				 
                 </div>
                </div>
				
              </div> 
             </div>
          </div>
       </div>
     </div>
   </div>
   <!-- Blog content end --> 
   
</section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->
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
        <input type="text" class="form-control alpha-num-space" placeholder="Country" id="country" name="country" maxlength="50" required="">
      </div>
          <div class="col-lg-4">
        <label for="state">State</label>
        <input type="text" class="form-control alpha-num-space" placeholder="State" id="state" name="state" maxlength="50" required>
      </div>
          <div class="col-lg-4">
        <label for="city">City</label>
        <input type="text" class="form-control alpha-num-space" placeholder="City" id="city" name="city" maxlength="50" required>
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
  <script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js');?>"></script>
   <script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>



   <script>
   $(".chosen-select").chosen();

$.validator.messages.extension = "Please upload only .jpg,.jpeg,.png,.bmp,.pdf are allow.";

$.validator.addMethod('filesize', function (value, element, param) {
	//alert(element.files[0].size);
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than 1MB.');

$.validator.addMethod('cusLength', function (value, element, param) {
	alert(element.length);
    return this.optional(element) || (element.length <= param)
}, 'File size must be less than {0}');

$.validator.addMethod("valueNotEquals", function(value, element, arg){
  	return arg !== value;
}, "Value must not equal arg.");

 $.validator.addMethod('validUrl', function(value, element) {
    var url = $.validator.methods.url.bind(this);
    return url(value, element) || url('http://' + value, element);
  }, 'Please enter a valid URL');

jQuery.validator.addClassRules("requiredClass", {
  required: true,
});

jQuery.validator.addClassRules("validImage", {
  extension: "jpg,jpeg,pdf,png,bmp",
  filesize: 1000000,
});


$("#uploadKYC").validate({
    onfocusout: function(e) {
        $(e).valid()
    },
    rules: {
		'kyc_documents[]': {
			
			extension: "jpg,jpeg,pdf,png",
			filesize: 1000000,
		}
    },
    messages: {
		'kyc_documents[]': {
			
			extension : "Please enter a value with a valid extension(.jpg,.jpeg,.pdf,.png).",
			filesize: "File size must be less than 1MB."
		}
    }
}); 




$("#profileForm").validate({
    onfocusout: function(e) {
        $(e).valid()
    },
    rules: {
        company_name: {
            required: true,
            minlength: 3,
	    maxlength: 50
        },
	address_line_1: {
            required: true,
            minlength: 10
        },
	
	city_name: {
            required: true
        },
	pincode: {
            required: true,
             minlength: {
                    param:6,
                    depends: function (element) {
                        return $('#country_id').val()=='101';
                    }
                },
            maxlength: {
                    param:6,
                    depends: function (element) {
                        return $('#country_id').val()=='101';
                    }
                },
            number: {
               param:6,
               depends: function (element) {
                   return $('#country_id').val()=='101';
               }
           }
        },
	head_firstname: {
            required: true
        },
	head_email: {
            required: true,
            email:true
        },
	head_phone: {
            required: true
        },
        
		
        company_logo: {
                extension: "jpg,jpeg,png,bmp",
                filesize: 100000,//100kb
        },
        website: {
                validUrl:true
        }
		
    },
    messages: {
        company_name: {
            required: "Please enter company name.",
            minlength: "Enter minimum 3 characeters.",
            maxlength: "Enter maximum 25 characeters."
        },
	address_line_1: {
            required: "Please enter address line 1.",
            minlength: "Enter minimum 10 characeters.",
        },
        
        city_name: {
            required: "Please enter city name.",
        },
        pincode: {
            required: "Please enter pin code.",
        },
        head_firstname: {
            required: "Please enter Admin Head Name.",
        },
        head_email: {
            required: "Please enter email.",
            email: "Please enter valid email.",
        },
        head_phone: {
            required: "Please enter Mobile/Phone Number.",
        },
        
        company_logo: {
                extension : "Please upload only .jpg,.jpeg,.png,.bmp are allow.",
                filesize: "File size must be less than 100KB."
        },
        website:{
            validUrl:"Please enter a valid URL."
        }
    }
});


$('#company_logo').change(function(){
    $('#clearSelectionBtn').show();
});

$('#clearSelectionBtn').click(function(){
    $(this).hide();
    $('#company_logo-error').hide();
    $('#company_logo').val('');
    $('#logoPreview').attr('src','');
});

// $('.fastselect').fastselect();
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
		url: $('#base_url').val()+"ajax-city-list",
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
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
    padding: 0px 0px;
}
.error{
	  color:red;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
   <!-- Tracking start -->
   <div class="wshipping-content-block">
       
	   <div class="container">
       <div class="row">
          <div class="col-12 col-lg-12">
              <div class="tracking-block">
                  <div class="tab-content">
                        <h2><?=$pageheading?></h2>
                      
              <!--<a class="btn btn-info btn-sm" href="<?= base_url('add-branch')?>">Add new</a>-->
              
              <div class="put-reference-number">
        <form name="profileForm" id="profileForm" action="" method="post" enctype="multipart/form-data">
<!--             <h3>User Details</h3>-->
             <div class="row">
                 <input type="hidden" name="branch_id" value="<?php echo $branch_details->id?>">

             <div class="col-12">
                <div class="form-row mb-3">
                    <div class="col">
                        <label>Branch Name <sup>*</sup></label>
                        <input type="text" class="form-control" name="branch_name" id="branch_name"  placeholder="Branch Name" maxlength="50" value="<?php echo $branch_details->branch_name?>" >
                    </div>
                    <div class="col">
                        <label>Address line 1 <sup>*</sup></label>
                        <input type="text" class="form-control" name="address_line_1" id="address_line_1"  placeholder="Address line 1" maxlength="50" value="<?php echo $branch_details->address_line_1?>" >
                    </div>
                     <div class="col">
                        <label>Address line 2 <sup>*</sup></label>
                        <input type="text" class="form-control" name="address_line_2" id="address_line_2"  placeholder="Address line 2" maxlength="50" value="<?php echo $branch_details->address_line_2?>" >
                    </div>
                </div> 
            </div>
                 
             <div class="col-12">
                <div class="form-row mb-3">
                    <div class="col profileCitySearch">
                    <label>City <sup>*</sup></label>
                    <input type="text" class="form-control search-box" name="city_name" id="city_name" placeholder="Type City Name" autocomplete="off" value="<?php echo $branch_details->city_name?>" >
                    <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                    <input type="hidden" class="cityId" id="city_id" name="city_id" value="<?php echo $branch_details->city_id?>">
                    <input type="hidden" class="stateId" id="state_id" name="state_id" value="<?php echo $branch_details->state_id?>">
                    <input type="hidden" class="countryId" id="country_id" name="country_id" value="<?php echo $branch_details->country_id?>">
                    </div>
                    <div class="col">
                            <label>Pin code <sup>*</sup></label>
                        <input type="text" class="form-control" name="pincode" id="pincode"  placeholder="Pin code" maxlength="10" value="<?php echo $branch_details->pincode?>" >
                    </div>
                     <div class="col">
                        <label>Branch Email Address <sup>*</sup></label>
                        <input type="email" class="form-control" name="email" id="email"  placeholder="Branch Email Address" maxlength="50" value="<?php echo $branch_details->email?>" >
                    </div>
                </div> 
            </div>
                 <div class="col-12">
                <div class="form-row mb-3">
                    <div class="col">
                    <label>Transaction Currency <sup>*</sup></label>
                    <input type="text" class="form-control" name="transaction_currency" readonly="" value="<?= $branch_details->transaction_currency?>" id="transaction_currency" placeholder="Transaction Currency"  maxlength="6">
                    </div>
                    <div class="col">
                        <label>Branch phone number <sup>*</sup></label>
                       <input type="text" class="form-control" name="phone" id="phone"  placeholder="Branch phone number" maxlength="20" value="<?php echo $branch_details->phone?>" >
                    </div>
                    <div class="col">
                            <label>Branch fax number</label>
                        <input type="text" class="form-control" name="fax" id="fax"  placeholder="Branch fax number" maxlength="20" value="<?php echo $branch_details->fax?>" >
                    </div>
                     
                </div> 
            </div>
                 <div class="col-12 col-lg-12">
                 <h3>Primary Contact person details</h3>
                 </div>
                  <div class="col-12">
                <div class="form-row mb-3">
                    <div class="col">
                        <label>Name <sup>*</sup></label>
                       <input type="text" class="form-control" name="contact_person" id="contact_person"  placeholder="Name" maxlength="50" value="<?php echo $branch_details->contact_person?>" >
                    </div>
                    <div class="col">
                            <label>Designation <sup>*</sup></label>
                            <select class="custom-select" name="contact_person_designation">
                            <option value="" selected="">Select</option>
                            <?php foreach($designtnData as $desData){ ?>
                                <option <?php echo ($branch_details->contact_person_designation == $desData->id)? 'selected' : ''; ?> value="<?php echo $desData->id; ?>"><?php echo $desData->designation; ?></option>
                         <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                            <label>Phone <sup>*</sup></label>
                             <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select class="custom-select" name="contact_country_code" id="contact_country_code">
                                  <?php foreach (getCountryDialCodes() as $countryDial){ ?>
                                    <option value="<?=$countryDial->dial_code?>" <?=$branch_details->contact_country_code==$countryDial->dial_code?' selected ':''?>><?=$countryDial->dial_code?></option>
                                    <?php }?>
                              </select>
                            </div>
                            <input type="text" class="form-control" name="contact_person_phone"  placeholder="Phone Number" maxlength="15" value="<?php echo $branch_details->contact_person_phone?>">
                          </div>
                            <span id="contact_person_phone-error" class="error"></span>
                    </div>
                    <div class="col">
                            <label>Email <sup>*</sup></label>
                        <input type="text" class="form-control" name="contact_person_email" id="contact_person_email"  placeholder="Email" maxlength="50" value="<?php echo $branch_details->contact_person_email?>" >
                    </div>
                    
                </div> 
            </div>
                 
                 <div class="col-12">
                              <button type="submit" class="btn btn-submit">Save</button>
                              <a href="<?= base_url('company-branch/'.$type);?>" class="btn btn-secondary ">Cancel</a>
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
   

$("#profileForm").validate({
    onfocusout: function(e) {
        $(e).valid()
    },
    rules: {
        branch_name: {
            required: true,
            minlength: 3,
	    maxlength: 50
        },
	address_line_1: {
            required: true,
            minlength: 10
        },
	address_line_2: {
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
        email: {
            required: true,
            email:true
        },
	phone: {
            required: true
        },
	contact_person: {
            required: true
        },
	contact_person_designation: {
            required: true
        },
	contact_person_email: {
            required: true,
            email:true
        },
	contact_person_phone: {
            required: true
        },
        
	
		
    },
    messages: {
        branch_name: {
            required: "Please enter branch name.",
            minlength: "Enter minimum 3 characeters.",
            maxlength: "Enter maximum 25 characeters."
        },
	address_line_1: {
            required: "Please enter address line 1.",
            minlength: "Enter minimum 10 characeters.",
        },
        address_line_2: {
            required: "Please enter address line 2.",
            minlength: "Enter minimum 10 characeters.",
        },
        city_name: {
            required: "Please enter city name.",
        },
        pincode: {
            required: "Please enter pin code.",
        },
        email:{
            required:"Please enter branch email address."
        },
        phone:{
            required:"Please enter branch phone number."
        },
        contact_person: {
            required: "Please enter name.",
        },
        contact_person_designation: {
            required: "Please select designation."
        },
        contact_person_email: {
            required: "Please enter email.",
            email: "Please enter valid email.",
        },
        contact_person_phone: {
            required: "Please enter phone number.",
        },
       
    }
});  
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
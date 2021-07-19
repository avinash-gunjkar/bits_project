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
                      <h2>Company User Details</h2>
              <!--<a class="btn btn-info btn-sm" href="<?= base_url('add-branch')?>">Add new</a>-->
              
              <div class="put-reference-number">
        <form name="profileForm" id="profileForm" action="<?php echo base_url('add-company-user'); ?>" method="post" enctype="multipart/form-data">
<!--             <h3>User Details</h3>-->
             <div class="row">
            <input type="hidden" name="user_id" value="<?php echo $user_details->user_id?>">

             <div class="col-12">
                <div class="form-row mb-3">
                    <div class="col">
                        <label>Salutation <sup>*</sup> </label>
                        <select class="custom-select" name="salutation">
                        <option value="">Select Salutation</option>
                        <option value="Mr." <?php echo $user_details->salutation == 'Mr.'?'selected':''; ?> >Mr.</option>
                        <option value="Mrs." <?php echo $user_details->salutation == 'Mrs.'?'selected':''; ?>>Mrs.</option>
                        <option value="Ms." <?php echo $user_details->salutation == 'Ms.'?'selected':''; ?>>Ms.</option>
                        <option value="Miss" <?php echo $user_details->salutation == 'Miss'?'selected':''; ?>>Miss</option>
                       </select>
                    </div>
                    <div class="col">
                        <label>First Name <sup>*</sup></label>
                        <input type="text" class="form-control" name="firstname" id="firstname"  placeholder="First Name" maxlength="50" value="<?php echo $user_details->firstname?>" >
                    </div>
                     <div class="col">
                        <label>Last Name <sup>*</sup></label>
                        <input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Last Name" maxlength="50" value="<?php echo $user_details->lastname?>" >
                    </div>
                </div> 
            </div>
             <div class="col-12">
                <div class="form-row mb-3">
                    <div class="col">
                        <label>Designation <sup>*</sup></label>
                        <select class="custom-select" name="designation_id">
                            <option value="" selected="">Select</option>
                            <?php foreach($designtnData as $desData){ ?>
                                <option <?php echo ($user_details->designation_id == $desData->id)? 'selected' : ''; ?> value="<?php echo $desData->id; ?>"><?php echo $desData->designation; ?></option>
                         <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                            <label>Mobile Number <sup>*</sup></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="custom-select" name="country_code" id="country_code">
                                <?php foreach (getCountryDialCodes() as $countryDial){ ?>
                                    <option value="<?=$countryDial->dial_code?>" <?=$user_details->country_code==$countryDial->dial_code ||(empty($user_details->country_code) && $countryDial->dial_code=='+91' )?' selected ':''?>><?=$countryDial->dial_code?></option>
                                    <?php }?>
                              </select>
                            </div>
                            <input aria-describedby="phone-error" type="text" class="form-control" name="phone"  placeholder="Mobile Number" maxlength="15" value="<?php echo $user_details->phone?>">
                          </div>
                            <span id="phone-error" class="error"></span>
                    </div>
                     <div class="col">
                        <label>Email Address <sup>*</sup></label>
                        <input type="text" class="form-control" name="email" id="email"  placeholder="Email Address" maxlength="50" value="<?php echo $user_details->email?>" >
                    </div>
                </div> 
            </div>
                 <div class="col-12">
                <div class="form-row mb-3">
                    <div class="col">
                        <label>Branch</label>
                        <select class="custom-select" name="branch_id">
                            <option value="" selected="">Select</option>
                            <?php foreach($branch_list as $branch){ ?>
                                <option <?php echo ($user_details->branch_id == $branch->id)? 'selected' : ''; ?> value="<?php echo $branch->id; ?>"><?php echo $branch->branch_name; ?></option>
                         <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <label>Supervisor</label>
                        <select class="custom-select" name="supervisor_id">
                            <option value="" selected="">Select</option>
                            <?php foreach($supervisor_list as $supervisor){ ?>
                                <option <?php echo ($user_details->supervisor_id == $supervisor->id)? 'selected' : ''; ?> value="<?php echo $supervisor->id; ?>"><?php echo $supervisor->supervisor_name; ?></option>
                         <?php } ?>
                        </select>
                    </div>
                    <!-- <div class="col">
                        <label>Role</label>
                        <select class="custom-select" name="role">
                            <option value="" selected="">Select Role</option>
                            <?php foreach($roles as $role){ ?>
                                <option <?php echo ($user_details->role == $role->id)? 'selected' : ''; ?> value="<?php echo $role->id; ?>"><?php echo $role->role; ?></option>
                         <?php } ?>
                        </select>
                    </div> -->
                    
                </div> 
            </div>
                 <div class="col-6" >
                     <div class="form-row mb-3">
                        <div class="col">
                        <label>User Photo</label>
                        <div class="input-group ">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input preview" data-previewTarget="#userPhotoPreview" name="profile_pic" id="profile_pic" aria-describedby="profile_pic-error">
                        <input type="hidden" class="custom-file-input" name="old_profile_pic" id="old_profile_pic" value="<?php echo $user_details->profile_pic; ?>">
                        <label class="custom-file-label" for="profile_pic">Choose file</label>
                        </div>
                        </div>
                        <span id="profile_pic-error" class="error"></span>
                        </div>
                        <div class="col mt-4">
                            <label>&nbsp;</label>
                            <img id="userPhotoPreview" src="<?php echo base_url().'uploads/users/'.$user_details->profile_pic; ?>" onerror=" this.src='<?php echo base_url().'uploads/users/placeholder-user.jpg' ?>'" style="height:50px;width: 50px; object-fit: contain;"/>
                        </div>   
                        </div>
                 </div>
                 <div class="col-12">
                              <button type="submit" class="btn btn-submit">Save</button>
                              <a href="<?= base_url('company-users');?>" class="btn btn-secondary ">Cancel</a>
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
  <script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js');?>"></script>
  <script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
  <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>-->
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
   
   <script type="text/javascript">
      
	


$.validator.addMethod('filesize', function (value, element, param) {
	//alert(element.files[0].size);
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');

    $("#profileForm").validate({
    onfocusout: function(e) {
        $(e).valid()
    },
    rules: {
        salutation:{
            required: true,
        },
        firstname:{
            required: true,
        },
        lastname:{
            required: true,
        },
        designation_id:{
            required: true,
        },
        phone:{
            required: true,
        },
        email:{
            required: true,
            email:true
        },
        profile_pic: {

                extension: "jpg|jpeg|png|bmp",
                filesize: 20000,//20kb
        }
    },
    messages: {
		profile_pic: {
			extension : "Please upload only .jpg,.jpeg,.png,.bmp are allow",
			filesize: "File size must be less than 20kb."
		}
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
         $(".profileCitySearch .cityId").val($(this).attr('data-cityId'));
         $(".profileCitySearch .stateId").val($(this).attr('data-stateId'));
         $(".profileCitySearch .countryId").val($(this).attr('data-countryId'));
         $("#transaction_currency").val($(this).attr('data-currency'));
         $(".profileCitySearch .suggesstion-box").hide();
         $('.profileCitySearch input.search-box').val($(this).text());
     });

</script>
<!--[end::city]-->
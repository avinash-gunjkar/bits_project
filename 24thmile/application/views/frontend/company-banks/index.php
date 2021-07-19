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
  
  .tabhade {
	display: flex;
	/* flex-wrap: ; */
	justify-content: space-between;
}

.tabhade a.btn{ display: inline-table;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
   <!-- Tracking start -->
   <div class="wshipping-content-block">
       
	   <div class="container">
       <div class="row">
          <div class="col-12 col-lg-12">
              <div class="tracking-block">
                  <div class="tab-content">
                    <div class="text-right tabhade">
                     <h2><?=$pageheading?></h2>
              		<a class="btn btn-info btn-sm mb-3" href="<?= base_url('add-bank/'.$type)?>">Add new</a>
                  	</div>
                  
             
              <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Bank Name</th>
                                  <!-- <th>Bank Address</th> -->
                                  <th>Account Number</th>
                                  <th>IFSC Code</th>
                                  <th>Swift Code</th>
                                  <th>AD Number</th>
                                  <th>Created Date</th>
                                  <th>Action</th>
                                  
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($bank_list as $key=>$bank) { ?>
                                <tr>
                                  <td><?=$key+1?></td>
                                  <td><?=$bank->bank_name?></td>
                                  <!-- <td><?=$bank->bank_address?></td> -->
                                  <td><?=$bank->account_number?></td>
                                  <td><?=$bank->ifsc_code?></td>
                                  <td><?=$bank->swift_code?></td>
                                  <td><?=$bank->ad_code?></td>
                                  <td><?=$bank->created_at?></td>
                                  
                                  <td>
                                      <a href="<?= base_url("edit-bank/$type/$bank->id")?>"   title="Edit"  class="fa fa-pencil fa-lg text-info" ></a>
                                      <a href="<?= base_url("delete-bank/$type/$bank->id")?>"  title="Delete" class="fa fa-trash fa-lg text-danger deleteConfirm" ></a>
                                  </td>
                                </tr>
                              <?php }?>
                             <?php if(empty($bank_list)){?>
                                <tr>
                                    <td colspan="8">No data available in table</td>
                                </tr>
                                <?php }?>
                          </tbody>
                      </table>
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
   
   <!--Start:: confirm dialog box-->
   <link href="<?php echo base_url('assets/frontend/js/bs4-pop/bs4.pop.css');?>" rel="stylesheet" type="text/css"/>
   <script src="<?php echo base_url('assets/frontend/js/bs4-pop/bs4.pop.js');?>" type="text/javascript"></script>
   <script>
       $('.deleteConfirm').click(function(e){
           e.preventDefault();
           bs4pop.confirm('Are your sure?',function(sure){},{
               title:'Delete Bank details.',
               hideRemove:true,
               btns:[{
                   label:'ok',
                   onClick(cb){
                       return location.href= e.target;
                   }
               },
               {
                   label:'Cancel',
                   className:'btn-secondary',
                   onClick(cb){
                       return e.preventDefault();
                   }
               }
           
        ]
               
           });
       });
    </script>
    <!--End:: confirm dialog box-->
     <script>  
   $("#country").chosen().on("change", function(event, params) {
		  if (params.selected) {
			$('#state').empty();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('seller/getAjaxState'); ?>",
				data:{countryN:params.selected},
				success: function(response){
					var res = JSON.parse(response);
					$('#state').append('<option value="" disabled selected>Select State</option>');
					$.each(res, function(key, value) {   
						 $('#state')
							 .append($("<option></option>")
										.attr("value",value.state_name)
										.text(value.state_name)); 
					});
				}
			});
		  }
		});
		
$('#state').change(function(){
	var state = $(this).val();
	$('#city').empty();
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('seller/getAjaxCity'); ?>",
		data:{state:state},
		success: function(response){
			var res = JSON.parse(response);
			$('#city').append('<option value="" disabled selected>Select City</option>');
			$.each(res, function(key, value) {   
				 $('#city')
					 .append($("<option></option>")
								.attr("value",value.city_name)
								.text(value.city_name)); 
			});
		}
	});
});   

$("#uploadKYC").validate({
    onfocusout: function(e) {
        $(e).valid()
    },
    rules: {
		'kyc_documents[]': {
			required: true,
			extension: "jpg,jpeg,pdf,doc",
			filesize: 5,
		}
    },
    messages: {
		'kyc_documents[]': {
			required: "Please select file",
			extension : "Please enter a value with a valid extension.",
			filesize: "File size must be less than 5."
		}
    }
}); 

$("#changePasswordForm").validate({
    onfocusout: function(e) {
        $(e).valid()
    },
    rules: {
		password: {
			minlength : 8,
			maxlength: 10
		},
		confirm_password: {
			minlength : 8,
			maxlength: 10,
			equalTo : "#password"
		}
    },
    messages: {
		password: {
			required: "Please enter password",
			minlength : "Password should not be small",
			maxlength: "Enter maximum 10 characeters"
		},
		confirm_password: {
			required: "Please enter confirm password",
			minlength : "Confirm Password should not be small",
			maxlength: "Enter maximum 10 characeters",
			equalTo : "Confirm Password not match with password"
		}
    }
});  
  </script>
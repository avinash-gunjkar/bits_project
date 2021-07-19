 <!-- Customer login Start -->
   <div class="wshipping-content-block" style="background-image: url('<?php echo base_url('assets/frontend/images/login-bg-01.jpg'); ?>');">
     <div class="container">
      <div class="customer-login">
         <div class="row">
          <div class="col-12 col-md-3 col-lg-3">
		  </div>
          <div class="col-12 col-md-6 col-lg-6" style="background-color: #e8e8e8ed;">
             <div class="customer-login-block">
               <h2>Change Your Password </h2>
               <form id="changePasswordForm" action="<?php echo base_url('login/change_password'); ?>" method="post">
                   <div class="form-group">
                     <label>Password: </label>
                     <input type="password" name="password" id="password" class="form-control" maxlength="15"/>
                   </div>
				   <div class="form-group">
                     <label>Confirm Password: </label>
                     <input type="password" name="confirm_password" class="form-control" maxlength="15"/>
                   </div>
			<input type="hidden" name="email" class="form-control" value="<?php echo $_GET['reset_code']; ?>"/>
                   <button type="submit" class="btn btn-submit">Submit </button>
                 </form> 
             </div> 
          </div>
		  <div class="col-12 col-md-3 col-lg-3">
		  </div>
        </div>       
      </div>
     </div>
   </div>
   <!-- Customer login end -->
   
  <script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js');?>"></script>
   <script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
   <script>
   $("#changePasswordForm").validate({
    onfocusout: function(e) {
        $(e).valid()
    },
    rules: {
		password: {
                    required:true,
			minlength : 8,
			maxlength: 15
		},
		confirm_password: {
                    required:true,
			minlength : 8,
			maxlength: 15,
			equalTo : "#password"
		}
    },
    messages: {
		password: {
			required: "Please enter password.",
			minlength : "Password should not be small.",
			maxlength: "Enter maximum 15 characeters."
		},
		confirm_password: {
			required: "Please enter confirm password.",
			minlength : "Confirm Password should not be small.",
			maxlength: "Enter maximum 15 characeters.",
			equalTo : "Confirm Password not match with password."
		}
    }
}); 

   </script>
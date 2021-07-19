  <style>
  .error{
	  color:red;
  }
  </style>
 <!-- Customer login Start -->
   <div class="wshipping-content-block" style="background-image: url('<?php echo base_url('assets/frontend/images/login-bg-01.jpg'); ?>');">
     <div class="container">
       <div class="customer-login">
         <div class="row justify-content-center">
          
          <div class="col-12 col-md-4 col-lg-4">
             <div class="customer-login-block">
               <h4>Login To Your Account</h4>
                 <form action="<?php echo base_url('login/seller_login'); ?>" method="post" id="loginForm">
                   <div class="form-group">
                     <!--<label>Email Address: </label>-->
                     <input type="text" name="email" class="form-control"  placeholder="Enter Email" maxlength="50"/>
                   </div>
                   <div class="form-group">
                     <!--<label>Password: </label>-->
                     <input type="password" name="password" class="form-control"  placeholder="Password" maxlength="15"/>
                   </div>
                    <div class="form-group">            
             <div class="custom-control custom-checkbox custom-control-inline">
              <input type="checkbox" class="custom-control-input"  name="remember" id="remember">
              <label class="custom-control-label" for="remember">Remember Me</label>
            </div>
                   
                   
                  
                   <!--<div class="checkbox">
                     <input type="checkbox" name="remember" id="remember" class="css-checkbox" />
           		     <label for="remember" class="css-label">Remember me </label>
                     </div>-->
                    
         	<a href="<?php echo base_url('forgot-password'); ?>" title="" class="forgot-pass">Forgot your password? </a>
         
                   </div>
                   <div class="form-group">
                   <button type="submit" class="btn btn-submit btn-block">Login </button>
                   </div>
                   
                    <div class="form-group text-center">
                  Not Yet Account? <a href="<?php echo base_url('signup'); ?>" title="" class="forgotpass">Create new account</a>
                   </div>
                   
                 </form> 
             </div> 
          </div>
		 
        </div>       
      </div>
     </div>
   </div>
   <!-- Customer login end -->
   <script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js');?>"></script>
   <script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
   <script>
   $("#loginForm").validate({
    onfocusout: function(e) {
        $(e).valid()
    },
    rules: {
        email: {
            required: true,
            email: true,
            maxlength : 50
        },
        password: {
                required: true,
                minlength : 8
        }
    },
    messages: {
        email: {
            required: "Please enter email.",
            email: "Please enter valid email.",
        },
        password: {
                required: "Please enter password.",
                minlength : "Password should not be small."
        }
    }
});
   </script>
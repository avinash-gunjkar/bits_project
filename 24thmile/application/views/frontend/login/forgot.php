 <!-- Customer login Start -->
   <div class="wshipping-content-block" style="background-image: url('<?php echo base_url('assets/frontend/images/login-bg-01.jpg'); ?>');">
     <div class="container">
      <div class="customer-login">
         <div class="row justify-content-center">
       
          <div class="col-12 col-md-4 col-lg-4" >
             <div class="customer-login-block">
               <h4>Forgot Your Password </h4>
                 <form action="<?php echo base_url('login/forgot'); ?>" method="post">
                   <div class="form-group">
                     <!--<label>Email address: </label>-->
                     <input type="email" name="email" class="form-control"  placeholder="Enter Email" maxlength="50"/>
                   </div>
                   <div class="form-group">
                   <div class="checkbox text-right">
                     <a href="<?php echo base_url('signin'); ?>" title="" class="forgotpass">Sign In</a>
                   </div>
                   </div>
                     <div class="form-group">
                   <button type="submit" class="btn btn-submit btn-block">Submit </button>
                   </div>
                 </form> 
             </div> 
          </div>
		 
        </div>       
      </div>
     </div>
   </div>
   <!-- Customer login end -->
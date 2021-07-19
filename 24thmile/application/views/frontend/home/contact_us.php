 <style>
 .wshipping-content-block {
    background-color: #fafafa;
}
.contact-form label{
	font-size: 12px;
    margin-bottom: 0px;
}
.contact-form .form-control{
	margin-bottom: 5px;
}
 </style>

  <!-- Breadcroumbs start -->
   <div class="wshipping-content-block wshipping-breadcroumb inner-bg-1">
     <div class="container">
       <div class="row">
          <div class="col-12 col-lg-7">
             <h1>Contact Us </h1>
             <a href="<?php echo base_url() ?>" title="Home">Home </a> / Contact Us
          </div>
          <div class="col-12 col-lg-5 text-right"><!--<h4>We freight to all ____ the world
The best logistic _______,  <span>FAST </span> and  <span>SAFELY! </span></h4>--></div>
       </div>
     </div>
   </div>
   <!-- Breadcroumbs end -->

 <!-- Contact Section Start -->
   <div class="wshipping-content-block" style="padding: 40px 0;">
     <div class="container">
       <div class="row flex-lg-row-reverse">
          <div class="col-12 col-lg-6">
                          <div class="">
                <div class="address-block">
                <h3 class="heading3-border">Office Address</h3>
                   <ul>
                     <li class="address-icon"> 103, Chandrang Silver, Javalkarnagar,<br> Pimple Gurav, Pune-411 061. INDIA</li>
                     <li class="phone-icon">  +91 7709065277</li>
                     
                     <li class="email-icon"> <a href="mailto:sales@24thmile.com" title="">sales@24thmile.com</a></li>
                   </ul>
                </div>
             </div>
          </div>
          <div class="col-12 col-lg-6 ">
				<p>Feel free to talk to our online representative at any time you please using our Live Chat system on our website or one of the below instant messaging programs.</p>
				<p>Please be patient while waiting for response. (24/7 Support!) Phone General Inquiries:   +91 7709065277</p>
          </div>
       </div>
     </div>
   </div>
   <!-- Contact Section end -->
  
  <div class="container">
       <div class="row ">
          <div class="col-12 col-lg-6">
               <div class="contact-form">
                  <h3 class="heading3-border">Your Query / Feedback </h3>
                  <form action="<?=base_url('contact-us/#feedbackForm')?>" id="feedbackForm" method="post">
                   <div class="form-group">
                      <div class="row">
                        <div class="col-12 col-lg-6">
                        <label>Full Name<sup>*</sup></label>
                        <input type="text" maxlength="40" class="form-control" placeholder="Full Name" name="fullname" value="<?=set_value('fullname')?>"/>
                        <?php echo form_error('fullname'); ?>
                        </div> 
                        <div class="col-12 col-lg-6">
                        <label>Company Name<sup>*</sup></label>
                        <input type="text"  class="form-control" maxlength="50" placeholder="Company Name" name="companyName"  value="<?=set_value('companyName')?>"/>
                        <?php echo form_error('companyName'); ?>
                        </div> 
                      </div>   
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-12 col-lg-6">
                        <label>Email-ID<sup>*</sup></label>
                         <input type="email" maxlength="40"  class="col-xs-12 col-md-12 form-control" placeholder="Email" name="email" value="<?=set_value('email')?>"/>
                         <?php echo form_error('email'); ?>
                        </div>
                       
                        <div class="col-12 col-lg-6">
						 <label>Mobile <sup>*</sup></label> 
						 <div class="input-group">
                            <div class="input-group-prepend" style="width:60px;">
                                <select class="custom-select" name="country_dial_code" id="country_dial_code">
                                    <?php foreach (getCountryDialCodes() as $countryDial){ ?>
                                    <option value="<?=$countryDial->dial_code?>" <?=(($countryDial->dial_code=='+91' && empty(set_value('country_dial_code'))) || set_value('country_dial_code')==$countryDial->dial_code )?' selected ':''?>><?=$countryDial->dial_code?></option>
                                    <?php }?>
                              </select>
                            </div>
                            <input type="text" aria-describedby="mobile-error" class="form-control only-numbers" name="mobile"  placeholder="Mobile Number" maxlength="15" value="<?=set_value('mobile')?>">
						  </div>
						  <?php echo form_error('mobile'); ?>
                         <!-- <input type="text" class="col-xs-12 col-md-12 form-control" placeholder="Phone Number" maxlength="10" pattern="[1-9]{1}[0-9]{9}" name="phone" /> -->
                        </div>  
                      </div>   
                    </div>
                    <div class="form-group">
                    	<label>Message <sup>*</sup></label>
                        <textarea class="form-control" maxlength="999" placeholder="Message (max 999 characters)" name="message"><?=set_value('message')?></textarea>
                        <?php echo form_error('message'); ?>
                    </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-submit" name="contact">Submit</button>
                     </div>
                 </form>
              </div>  
          </div>  
          <div class="col-12 col-lg-6 contact-form" >
          	<h3 class="heading3-border">Locate the Address</h3>
            <div class="map address ">
              <div class="overlay" onClick="style.pointerEvents='none'"></div>
            	<a href="https://www.google.com/maps?ll=18.59921,73.817874&z=16&t=m&hl=en-US&gl=IN&mapclient=embed&cid=5437172396523968519" target="_BLANK">
            		<img src="<?php echo base_url('assets/frontend/images/map.png');?>" class="img-responsive" style="border: 4px solid #f2f1f1; box-shadow: 0px 0px 10px #2b2b2b; height: 285px; width: 100%;"></a>
            </div> 
          </div>
        </div>  
      </div>  


   <!-- Map start --> 
  
   <!-- Map end -->

   
   <script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js');?>"></script>
   <script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
   <script>
   $("#feedbackForm_").validate({
    onfocusout: function(e) {
        $(e).valid()
    },
    rules: {
      fullname: {
            required:true,
        },
      companyName: {
            required:true,
        },
        email: {
                required: true,
                email:true
        },
        mobile: {
                required: true,
        },
        message: {
                required: true,
        },
       
    },
    messages: {
      fullname: {
            required: "Please enter Full Name.",
        },
      companyName: {
            required: "Please enter Company Name.",
        },
        email: {
                required: "Please enter Email-ID.",
                email:"Please enter valid Email-ID."
        },
        mobile: {
                required: "Please enter Mobile.",
        },
        message: {
          required: "Please enter Message.",
        },
    }
});
   </script>
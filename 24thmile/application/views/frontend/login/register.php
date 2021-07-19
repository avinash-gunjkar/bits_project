<style>
    .otp-input {
        border-right: none;

    }

    .otp-btn {
        cursor: pointer;
        border-left: none;
        background-color: transparent;
    }

    .otp-btn-resend {
        border-left: none;
        cursor: not-allowed;
        background-color: transparent;
    }
    label.error{
        display: block;
    }
</style>
<!-- Customer Registration Start -->
<div class="wshipping-content-block" style="background-image: url('<?php echo base_url('assets/frontend/images/login-bg.jpg'); ?>'); background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="customer-login">
            <div class="row justify-content-center">
                <!--<div class="col-12 col-md-6 col-lg-6">
             <div class="customer-login-left">
                <div class="login-icon"><i class="fa fa-user-plus"></i></div>
                <h4>Welcome To new account </h4>
                <p>Lorem Ipsum is simply _____ text of the printing ___ typesetting industry. </p>
                <a href="<?php echo base_url('signin'); ?>">Already have an account</a>
             </div>
          </div>-->

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="customer-login-block Registers">
                        <h4><b>Sign Up</b></h4>
                        <!--<div ><b style="font-size:18px;">I am a </b> &nbsp;&nbsp;<span class="custom-btn-reg cbtn-theme text-uppercase cbtn-shadow" id="seller">Seller</span><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" id="freight_forwarder">Freight Forwarder</span></div>-->



                        <form action="<?php echo base_url('signup'); ?>" method="post" id="registerForm">
                            <div class="form-group">
                                <b style="font-size:18px;">I am a </b>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="user_type" checked class="custom-control-input" value="Seller">
                                    <label class="custom-control-label" for="customRadioInline1">Seller</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="user_type" <?= set_value('user_type') == "Freight Forwarder"?"checked":""?> class="custom-control-input" value="Freight Forwarder">
                                    <label class="custom-control-label" for="customRadioInline2">Freight Forwarder</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <!--<label>First Name: </label>-->
                                <input type="text" class="form-control" name="firstname" value="<?=set_value('firstname')?>" placeholder="First Name" maxlength="25" />
                                
                                <label id="firstname-error" class="error" for="firstname"><?php echo form_error('firstname'); ?></label>
                            </div>

                            <div class="form-group">
                                <!--   <label>Last Name: </label>-->
                                <input type="text" class="form-control" name="lastname" value="<?=set_value('lastname')?>" placeholder="Last Name" maxlength="25" />
                                <label id="lastname-error" class="error" for="lastname"><?php echo form_error('lastname'); ?></label>
                            </div>


                            <div class="form-group">


                                <!-- <label>Email: </label>-->
                                <input type="email" class="form-control" name="email" value="<?=set_value('email')?>" placeholder="Email" maxlength="50" />
                                <label id="email-error" class="error" for="email"><?php echo form_error('email'); ?></label>
                            </div>
                            <div class="form-group">
                                <!--<label>Phone: </label>-->
                                <input type="text" class="form-control" name="phone" value="<?=set_value('phone')?>" id="phone" placeholder="Mobile" maxlength="15" />
                                <label id="phone-error" class="error" for="phone"><?php echo form_error('phone'); ?></label>

                            </div>

                            <!-- <div class="form-group">
                       <div class="input-group">
                           <input autocomplete="off" type="text" class="form-control otp-input" name="otp" id="otp" maxlength="6" placeholder="OTP" >
                           <div class="input-group-append">
                               <span class="input-group-text text-primary otp-btn" id="btn_sendOtp">Send OTP</span>
                            <--<a href='javascript:void(0);' id=""  class="text-info float-right"></a>-->
                            <!-- <span id="loader" class="input-group-text text-gray otp-btn-resend" style="display: none;"></span>
                          </div>
                       </div>
                       <label id="otp-error" class="error" for="otp" style="display:none"></label>
                       
                    </div> -->

                            <div class="form-group">

                                <!--  <label>Password: </label>-->
                                <input autocomplete="off" type="password" class="form-control" name="password" value="<?=set_value('password')?>" id="password" maxlength="15" placeholder="Password" />
                                <label id="password-error" class="error" for="password"><?php echo form_error('password'); ?></label>
                            </div>

                            <div class="form-group">
                                <!--<label>Confirm Password: </label>-->
                                <input autocomplete="off" type="password" class="form-control" name="confirm_password" value="<?=set_value('confirm_password')?>" maxlength="15" placeholder="Confirm Password" />
                                <label id="confirm_password-error" class="error" for="confirm_password"><?php echo form_error('confirm_password'); ?></label>
                            </div>

                            <div class="form-group">
                                
                                <div>

                                    <img class="captcha-image" style="max-width:150px;" src="<?= base_url() . 'captcha' ?>"><i class="fa fa-refresh refresh-captcha text-primary" title="Refresh Captcha"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- <label for="captcha">Please Enter the Captcha Text</label><br> -->
                                <input type="text" id="captcha" autocomplete="off" placeholder="Please Enter the Captcha Text" class="form-control" name="captcha_challenge"  required>
                                <label id="captcha_challenge-error" class="error" for="captcha_challenge"><?php echo form_error('captcha_challenge'); ?></label>
                            </div>
                            <div class="form-group">

                                <button type="submit" class="btn btn-submit btn-block">Registration </button>
                            </div>
                            <div class="form-group text-center">
                                <a href="<?php echo base_url('signin'); ?>" title="" class="forgotpass">Already have an account?</a></div>


                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Customer Registration end -->
<script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $("#registerForm").validate({

            onfocusout: function(e) {
                $(e).valid()
            },
            rules: {
                firstname: {
                    required: true,
                    minlength: 3,
                    maxlength: 25
                },
                lastname: {
                    required: true,
                    minlength: 3,
                    maxlength: 25
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },
                phone: {
                    required: true,
                    maxlength: 12,
                    minlength: 10
                },
                // otp:{
                //     required: true,
                //     number:true
                // },
                password: {
                    required: true,
                    minlength: 8,
                    // maxlength: 10
                },
                confirm_password: {
                    minlength: 8,
                    //  maxlength: 10,
                    equalTo: "#password"
                },
                captcha_challenge: {
                    remote: $('#base_url').val() + 'validate-captcha-text'
                }
            },
            messages: {
                firstname: {
                    required: "Please enter a first name.",
                    minlength: "Enter minimum 3 characeters.",
                    maxlength: "Enter maximum 25 characeters."
                },
                lastname: {
                    required: "Please enter a last name.",
                    minlength: "Enter minimum 3 characeters.",
                    maxlength: "Enter maximum 25 characeters."
                },
                email: {
                    required: "Please enter an email.",
                    email: "Please enter a valid email.",
                    maxlength: "Enter maximum 50 characeters."
                },
                phone: {
                    required: "Please enter a mobile.",
                    maxlength: "Please enter maximum 12 digits.",
                    minlength: "Please enter minimum 10 digits."
                },
                // otp:{
                //     required: 'Please enter an OTP.',
                // },
                password: {
                    required: "Please enter a password.",
                    minlength: "Password should not be small.",
                    // maxlength: "Enter maximum 15 characeters."
                },
                confirm_password: {
                    required: "Please enter a confirm password.",
                    minlength: "Confirm Password should not be small.",
                    // maxlength: "Enter maximum 15 characeters.",
                    equalTo: "Confirm Password not match with password."
                },
                captcha_challenge: {
                    remote: 'Invalid captcha.'
                }
            }
        });
    });

    $('#btn_sendOtp').click(function() {

        if ($("#registerForm input[name='phone']").valid()) {
            //send otp
            showLoader(90);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('send-otp'); ?>",
                data: {
                    phone: $("#registerForm input[name='phone']").val(),
                    email: $("#registerForm input[name='email']").val()
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    console.log(res);
                    if (res.result.msg === '1') {

                    }
                }
            });
        }

    });

    function showLoader(time) {

        $('#btn_sendOtp').hide();
        $('#loader').text('Resend (' + time + ' s)');
        $('#loader').show();

        var x = setInterval(function() {
            time--
            $('#loader').text('Resend (' + time + ' s)');
            if (time <= 0) {
                clearInterval(x);
                $('#btn_sendOtp').show();
                $('#btn_sendOtp').text('Resend');
                $('#loader').hide();
            }
        }, 1000);




    }


    $('.custom-btn-reg').click(function() {
        //if(!$(this).hasClass('red'))
        //$(this).addClass('red');
        if ($(this).attr('id') == 'freight_forwarder') {
            $('.custom-btn-reg').addClass('cbtn-white');
            $('.custom-btn-reg').css('color', '#000 !important');
            $('.custom-btn-reg').removeClass('cbtn-theme');
            $('#freight_forwarder').addClass('cbtn-theme');
            $('#freight_forwarder').css('color', '#fff !important');
            $('#user_type').val('Freight Forwarder');
        } else {
            $('.custom-btn-reg').addClass('cbtn-white');
            $('.custom-btn-reg').css('color', '#000 !important');
            $('.custom-btn-reg').removeClass('cbtn-theme');
            $('#seller').addClass('cbtn-theme');
            $('#seller').css('color', '#fff !important');
            $('#user_type').val('Seller');
        }
    });
</script>

<!--Start:refresh captcha-->
<script>
    var refreshButton = document.querySelector(".refresh-captcha");
refreshButton.onclick = function() {
    document.querySelector("#captcha").value = '';
  document.querySelector(".captcha-image").src = $('#base_url').val()+'captcha?' + Date.now();
}
</script>
<!--End:refresh captcha-->
<!--   <script src="https://cdn.jsdelivr.net/npm/disableautofill/src/jquery.disableAutoFill.min.js"></script>
   <script>$('#registerForm').disableAutoFill();</script>-->
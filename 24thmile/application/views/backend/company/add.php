   <style type="text/css">
     .input-field div.error {
       position: relative;
       top: -1rem;
       left: 0rem;
       font-size: 0.8rem;
       color: #FF4081;
       -webkit-transform: translateY(0%);
       -ms-transform: translateY(0%);
       -o-transform: translateY(0%);
       transform: translateY(0%);
     }

     .input-field label.active {
       width: 100%;
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
             <h5 class="breadcrumbs-title"><?= $page_title ?></h5>
             <ol class="breadcrumbs">
               <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
               <!-- <li><a href="<?= base_url('admin/users') ?>">Users</a></li> -->
               <li class="active"><?= $page_title ?></li>
             </ol>
           </div>
         </div>
       </div>
     </div>
     <!--breadcrumbs end-->


     <!--start container-->
     <div class="container">
       <div class="section">

         <!--<p class="caption">Add User</p>-->

         <!--<div class="divider"></div>-->
         <!--Basic Form-->
         <div id="basic-form" class="section">
           <div class="row">
             <div class="col s12 m12 l12 ">
               <div class="card-panel">
                 <!-- <h4 class="header2">Basic Form</h4> -->
                 <div class="row">
                   <form class="col s12" id="registerForm" action="" method="POST">
                     
                     <div class="row">
                       <div class="input-field col s6">
                         <input id="firstname" name="firstname" type="text" aria-required="true" aria-describedby="firstname-error" maxlength="25" value="<?=set_value('firstname')?>">
                         <label for="firstname">First Name <sup>*</sup></label>
                         <div id="firstname-error" class="error"><?= form_error('firstname'); ?></div>
                       </div>

                       <div class="input-field col s6">
                         <input id="lastname" name="lastname" type="text" aria-required="true" aria-describedby="lastname-error" maxlength="25" value="<?=set_value('lastname')?>">
                         <label for="lastname">Last Name <sup>*</sup></label>
                         <div id="lastname-error" class="error"><?= form_error('lastname'); ?></div>
                       </div>
                  </div>
                  <div class="row">
                       <div class="input-field col s6">
                         <input id="email" name="email" type="text" aria-required="true" aria-describedby="email-error" maxlength="50" value="<?=set_value('email')?>">
                         <label for="email">Email <sup>*</sup></label>
                         <div id="email-error" class="error"><?= form_error('email'); ?></div>
                       </div>
                       <div class="input-field col s6">
                         <input id="phone" name="phone" type="text" maxlength="15" aria-describedby="phone-error" value="<?=set_value('phone')?>">
                         <label for="phone">Phone <sup>*</sup></label>
                         <div id="phone-error" class="error"><?= form_error('phone'); ?></div>
                       </div>
                  </div>

                  <div class="row">
                       <div class="input-field col s6">
                         <input id="company_name" name="company_name" type="text" aria-required="true" maxlength="80" value="<?=set_value('company_name')?>">
                         <label for="email">Company Name</label>
                       </div>
                       
                  </div>
                  

                     <div class="row">
                       <div class="col s12">
                         <button class="btn cyan waves-effect waves-light right" type="submit">Save<i class="mdi-content-send right"></i>
                        </button>
                        <a href="<?=$backUrl;?>" class="btn greay waves-effect waves-light" >Cancle</a>
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
   </section>
   <script src="<?=base_url('assets/backend/js/plugins/jquery-validation/jquery.validate.min.js');?>"></script>
   <script type="text/javascript">
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
            },
       errorElement: 'div',
       errorPlacement: function(error, element) {
         var placement = $(element).data('error');
         if (placement) {
           $(placement).append(error)
         } else {
           error.insertAfter(element);
         }
       }
        });
    });
   </script>
   <!-- END CONTENT -->
	<style>
	    .comment-group {
	        border-bottom: none;
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

	    .error {
	        color: red;
	    }
	</style>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
	<!-- Tracking start -->
	<div class="wshipping-content-block">

	    <div class="container">
	        <div class="row">
	            <div class="col-12 col-lg-12">
	                <div class="tracking-block">
	                    <ul class="nav nav-tabs" role="tablist">
	                        <?php $activeTab = $this->session->userdata('profileActiveTab') ? $this->session->userdata('profileActiveTab') : 'profile'; ?>
	                        <li class="nav-item"><a class="nav-link <?php echo ($activeTab == 'profile') ? 'active' : ''; ?>" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile </a></li>
	                        <li class="nav-item"><a class="nav-link <?php echo ($activeTab == 'setting') ? 'active' : ''; ?>" href="#setting" aria-controls="setting" role="tab" data-toggle="tab">Settings </a></li>
	                    </ul>
	                    <div class="tab-content">
	                        <div role="tabpanel" class="tab-pane <?php echo ($activeTab == 'profile') ? 'active' : ''; ?>" id="profile">
	                            <div class="put-reference-number">
	                                <form name="profileForm" id="profileForm" action="<?php echo base_url('fs-my-profile'); ?>" method="post" enctype="multipart/form-data">
	                                    <!--             <h3>User Details</h3>-->
	                                    <div class="row">


	                                        <div class="col-12">
	                                            <div class="form-row mb-3">
	                                                <div class="col">
	                                                    <label>Salutation</label>
	                                                    <select class="custom-select" name="salutation">
	                                                        <option value="">Select Salutation</option>
	                                                        <option value="Mr." <?php echo $myProfile->salutation == 'Mr.' ? 'selected' : ''; ?>>Mr.</option>
	                                                        <option value="Mrs." <?php echo $myProfile->salutation == 'Mrs.' ? 'selected' : ''; ?>>Mrs.</option>
	                                                        <option value="Ms." <?php echo $myProfile->salutation == 'Ms.' ? 'selected' : ''; ?>>Ms.</option>
	                                                        <option value="Miss" <?php echo $myProfile->salutation == 'Miss' ? 'selected' : ''; ?>>Miss</option>
	                                                    </select>
	                                                </div>
	                                                <div class="col">
	                                                    <label>First Name</label>
	                                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" maxlength="25" value="<?php echo $myProfile->firstname ?>">
	                                                </div>
	                                                <div class="col">
	                                                    <label>Last Name</label>
	                                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" maxlength="25" value="<?php echo $myProfile->lastname ?>">
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="col-12">
	                                            <div class="form-row mb-3">
	                                                <div class="col">
	                                                    <label>Designation</label>
	                                                    <select class="custom-select" name="designation_id">
	                                                        <option value="" selected="">Select</option>
	                                                        <?php foreach ($designtnData as $desData) { ?>
	                                                            <option <?php echo ($myProfile->designation_id == $desData->id) ? 'selected' : ''; ?> value="<?php echo $desData->id; ?>"><?php echo $desData->designation; ?></option>
	                                                        <?php } ?>
	                                                    </select>
	                                                </div>
	                                                <div class="col">
	                                                    <label>Mobile Number</label>
	                                                    <div class="input-group mb-3">
	                                                        <div class="input-group-prepend">
	                                                            <select class="custom-select" name="country_code" id="country_code">
	                                                                <?php foreach (getCountryDialCodes() as $countryDial) { ?>
	                                                                    <option value="<?= $countryDial->dial_code ?>" <?= $myProfile->country_code == $countryDial->dial_code || (empty($myProfile->country_code) && $countryDial->dial_code == '+91') ? ' selected ' : '' ?>><?= $countryDial->dial_code ?></option>
	                                                                <?php } ?>


	                                                            </select>
	                                                        </div>
	                                                        <input type="text" class="form-control" name="phone" placeholder="Mobile Number" maxlength="15" value="<?php echo $myProfile->phone ?>">
	                                                    </div>
	                                                </div>
	                                                <div class="col">
	                                                    <label>Email Address</label>
	                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" maxlength="50" value="<?php echo $myProfile->email ?>">
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="col-6">
	                                            <div class="form-row mb-3">
	                                                <div class="col">
	                                                    <label>User Photo</label>
	                                                    <div class="input-group ">
	                                                        <div class="custom-file">
	                                                            <input type="file" class="custom-file-input preview" name="profile_pic" data-previewTarget="#userPhotoPreview" id="profile_pic">
	                                                            <input type="hidden" class="custom-file-input" name="old_profile_pic" id="old_profile_pic" value="<?php echo $myProfile->profile_pic; ?>">
	                                                            <!--<label class="btn btn-default" for="profile_pic">Change User Photo</label>-->
	                                                            <?php if (empty($myProfile->profile_pic)) { ?>
	                                                                <label class="custom-file-label" for="profile_pic">Choose Photo</label>
	                                                            <?php } else { ?>
	                                                                <label class="custom-file-label" for="profile_pic">Change Photo</label>
	                                                            <?php } ?>

	                                                        </div>
	                                                    </div>
	                                                    <span id="profile_pic-error" class="error"></span>
	                                                </div>
	                                                <div class="col mt-4">
	                                                    <label>&nbsp;</label>
	                                                    <img id="userPhotoPreview" src="<?php echo base_url() . 'uploads/users/' . $myProfile->profile_pic; ?>" onerror=" this.src='<?php echo base_url() . 'uploads/users/placeholder-user.jpg' ?>'" style="height:50px;width: 50px; object-fit: contain;" />
	                                                    <input id="clearSelectionBtn" type="button" class="btn btn-secondary btn-sm" value="Clear the Selection" style="display:none;">
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="col-12">
	                                            <button type="submit" class="btn btn-submit">Save</button>
	                                        </div>
	                                    </div>
	                                </form>

	                            </div>
	                        </div>


	                        <div role="tabpanel" class="tab-pane <?php echo ($activeTab == 'setting') ? 'active' : ''; ?>" id="setting">
	                            <h3>Change Password </h3>
	                            <div class="">
	                                <form action="<?php echo base_url('seller/change_password'); ?>" method="post" id="changePasswordForm">

	                                    <div class="row">
	                                        <div class="col-12">
	                                            <div class="form-row mb-3">

	                                                <div class="col-lg-3">
	                                                    <label>New Password</label>
	                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password" maxlength="15">
	                                                </div>

	                                            </div>
	                                            <div class="form-row mb-3">
	                                                <div class="col-lg-3">
	                                                    <label>Confirm Password</label>
	                                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm New Password" maxlength="15">
	                                                </div>
	                                            </div>


	                                        </div>
	                                        <div class="col-12">
	                                            <button type="submit" class="btn btn-submit">Save</button>
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
	</div>
	<!-- Blog content end -->

	</section><!-- sidebar_dashboard-->
	</div> <!-- sidebar_dashboard-->

	<script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>




	<script type="text/javascript">
	    $.validator.addMethod('filesize', function(value, element, param) {
	        //alert(element.files[0].size);
	        return this.optional(element) || (element.files[0].size <= param)
	    }, 'File size must be less than {0}');

	    $.validator.addMethod('cusLength', function(value, element, param) {
	        alert(element.length);
	        return this.optional(element) || (element.length <= param)
	    }, 'File size must be less than {0}');

	    $.validator.addMethod("valueNotEquals", function(value, element, arg) {
	        return arg !== value;
	    }, "Value must not equal arg.");


	    $("#changePasswordForm").validate({
	        onfocusout: function(e) {
	            $(e).valid()
	        },
	        rules: {
	            password: {
	                required: true,
	                minlength: 8,
	                maxlength: 15
	            },
	            confirm_password: {
	                required: true,
	                minlength: 8,
	                maxlength: 15,
	                equalTo: "#password"
	            }
	        },
	        messages: {
	            password: {
	                required: "Please enter new password.",
	                minlength: "Password should not be small.",
	                maxlength: "Enter maximum 15 characeters."
	            },
	            confirm_password: {
	                required: "Please confirm new password.",
	                minlength: "Confirm Password should not be small.",
	                maxlength: "Enter maximum 15 characeters.",
	                equalTo: "Confirm Password not match with password."
	            }
	        }
	    });


	    $("#profileForm").validate({
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
	                number: true,
	                maxlength: 15,
	                minlength: 10
	            },

	            profile_pic: {
	                //                required: {
	                //                                depends: function(element) {
	                //                                                            return ($("#old_profile_pic").val()) ? false : true ;
	                //                                                          }
	                //                },
	                extension: "jpg,jpeg,png,bmp",
	                filesize: 100000,
	            }

	        },
	        messages: {
	            firstname: {
	                required: "Please enter first name.",
	                minlength: "Enter minimum 3 characeters.",
	                maxlength: "Enter maximum 25 characeters."
	            },
	            lastname: {
	                required: "Please enter last name.",
	                minlength: "Enter minimum 3 characeters.",
	                maxlength: "Enter maximum 25 characeters."
	            },
	            email: {
	                required: "Please enter email.",
	                email: "Please enter valid email.",
	                maxlength: "Enter maximum 50 characeters."
	            },
	            phone: {
	                required: "Please enter mobile.",
	                number: "Please enter a valid number.",
	                maxlength: "Please enter maximum 15 digits.",
	                minlength: "Please enter minimum 10 digits."
	            },
	            profile_pic: {
	                required: "Please select file.",
	                extension: "Please upload only .jpg,.jpeg,.png,.bmp are allow.",
	                filesize: "File size must be less than 100KB."
	            }
	        }
	    });

	    $('#profile_pic').change(function() {
	        $('#clearSelectionBtn').show();
	    });

	    $('#clearSelectionBtn').click(function() {
	        $(this).hide();
	        $('span#profile_pic-error').hide();
	        $('#profile_pic').val('');
	        $('#userPhotoPreview').attr('src', '');
	    });

	    // $('.fastselect').fastselect();
	</script>
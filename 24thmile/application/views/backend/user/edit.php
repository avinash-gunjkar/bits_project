   <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
[type="checkbox"]+label {
    padding-left: 22px !important;
}
td, th {
    padding: 7px 8px !important;
	border:1px solid #ccc;
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
                <h5 class="breadcrumbs-title">Edit User</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?= base_url('admin/dashboard')?>">Dashboard</a>
                  </li>
                  <li><a href="<?= base_url('admin/users')?>">Users</a>
                  </li>
                  <li class="active"><?=$page_title?></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <div class="section"> 
            <p class="caption">Edit User</p>

            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l10">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="sector_add_form" action="<?php echo base_url('sector/add');?>" method="POST">
                        <div class="row">
                          <div class="input-field col s6">
                            <input id="firstname" name="firstname" type="text" class="validate" value="<?php echo $user_data['firstname']; ?>">
                            <label for="firstname" data-error="Please enter first name.">First Name</label>
                          </div>
						  <div class="input-field col s6">
                            <input id="lastname" name="lastname" type="text" class="validate" value="<?php echo $user_data['lastname']; ?>">
                            <label for="lastname" data-error="Please enter last name.">Last Name</label>
                          </div>
                        </div>
						<div class="row">
                          <div class="input-field col s6">
							<label for="gender" style="margin-top: -15px;">Gender</label>
							<?php if(!empty($user_profile)){ ?>
                            <p>
								<input class="with-gap" name="gender" type="radio" <?php echo ($user_profile->gender == 'Male') ? 'checked' : ''; ?> id="test3" value="Male"/>
								<label for="test3">Male</label>
								<input class="with-gap" name="gender" type="radio" id="test4" <?php echo ($user_profile->gender == 'Female') ? 'checked' : ''; ?> value="Female"/>
								<label for="test4">Female</label>
							</p>
							<?php }else{ ?>
							 <p>
								<input class="with-gap" name="gender" type="radio" id="test3" value="Male"/>
								<label for="test3">Male</label>
								<input class="with-gap" name="gender" type="radio" id="test4" value="Female"/>
								<label for="test4">Female</label>
							</p>
							<?php } ?>
                          </div>
						  <div class="input-field col s6">
                            <div class="file-field input-field">
							  <div class="btn">
								<span>File</span>
								<input type="file" value="<?php echo empty($user_profile->profile_pic)? '' : $user_profile->profile_pic; ?>">
							  </div>
							  <div class="file-path-wrapper">
								<input class="file-path validate" type="text" >
							  </div>
							</div>
                          </div>
                        </div>
						<div class="row">
                          <div class="input-field col s6">
                            <input id="email" name="email" type="text" class="validate" value="<?php echo $user_data['email']; ?>">
                            <label for="email" data-error="Please enter email.">Email</label>
                          </div>
						  <div class="input-field col s6">
                            <input id="lastname" name="lastname" type="text" class="validate" value="<?php echo $user_data['phone']; ?>">
                            <label for="lastname" data-error="Please enter phone number.">Phone</label>
                          </div>
                        </div>
						<div class="row">
                          <div class="input-field col s12">
                            <textarea id="address" name="address" class="materialize-textarea validate"><?php echo empty($user_profile->address)? '' : $user_profile->address; ?></textarea>
                            <label for="email" data-error="Please enter valid address.">Address</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s6">
                            <input id="company" name="company" type="text" class="validate" value="<?php echo $user_data['company_name']; ?>">
                            <label for="company" data-error="Please enter company.">Company Name</label>
                          </div>
                          <div class="input-field col s6">
                            <select name="role">
							  <option value="" disabled selected>Select User Role</option>
							  <?php foreach($roles as $role){ ?>
							  <option <?php echo ($role->id == $user_data['role'] ) ? 'selected' : ''; ?> value="<?php echo $role->id; ?>"><?php echo $role->role; ?></option>
							  <?php } ?>
							</select>
                          </div>
                        </div>
						<div class="row">
						  <div class="input-field col s12">
							  <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="doSubmit" name="action">Update User<i class="mdi-content-send right"></i>
							  </button>
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
  <!-- END CONTENT -->

<!-- //////////////////////////////////////////////////////////////////////////// -->

<script type="text/javascript">
    $('#sector_edit_form').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action');
        var FORMDATA = $(this).serialize();
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'json',
            data: FORMDATA,
        })
        .done(function(respo) {
            Materialize.toast('<span>'+respo.msg+'</span>', 5000);  
            window.location.href = "<?php echo base_url('sector') ?>";
        })
        .fail(function(respo) {
            console.log("error",respo);
        })
        .always(function(respo) {
            console.log("complete",respo);
        });
    });    
</script>
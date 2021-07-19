<div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form" action="<?php echo base_url('login/register'); ?>" method="post">
        <div class="row">
          <div class="input-field col s12 center">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/backend/images/Logo-Temgire.png') ?>" alt="" class=" responsive-img valign"></a>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="firstname" name="firstname" type="text">
            <label for="firstname" class="center-align">First Name</label>
          </div>
        </div>
		<div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="lastname" name="lastname" type="text">
            <label for="lastname" class="center-align">Last Name</label>
          </div>
        </div>
		<div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input id="email" name="email" type="email">
            <label for="email" class="center-align">Email Id</label>
          </div>
        </div>
		<div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" name="username" type="text">
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" name="password" type="password">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" class="btn waves-effect waves-light col s12">Register Now</button>
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account? <a href="<?php echo base_url('login'); ?>">Login</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
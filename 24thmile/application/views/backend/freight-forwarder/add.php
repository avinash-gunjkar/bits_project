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
               <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
               </li>
               <li><a href="<?= base_url('admin/users') ?>">Users</a>
               </li>
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
                   <form class="col s12" id="user_add_form" action="<?php echo base_url('admin/add-user'); ?>" method="POST">
                     <input type="hidden" name="user_id" value="<?= $user_details->id ?>" />
                     <div class="row">
                       <div class="input-field col s6">
                         <input id="firstname" name="firstname" type="text" required maxlength="25" value="<?= $user_details->firstname ?>">
                         <label for="firstname">First Name</label>
                       </div>

                       <div class="input-field col s6">
                         <input id="lastname" name="lastname" type="text" required maxlength="25" value="<?= $user_details->lastname ?>">
                         <label for="lastname">Last Name</label>
                       </div>
                  </div>
                  <div class="row">
                       <div class="input-field col s6">
                         <input id="email" name="email" type="text" required maxlength="50" value="<?= $user_details->email ?>">
                         <label for="email">Email</label>
                       </div>
                       <div class="input-field col s6">
                         <input id="phone" name="phone" type="text" maxlength="15" value="<?= $user_details->phone ?>">
                         <label for="phone">Phone</label>
                       </div>
                       </div>
                  <div class="row">
                       <div class="input-field col s6">
                         <input id="password" name="password" required type="password" maxlength="15">
                         <label for="password">Password</label>
                       </div>
                       <div class="input-field col s6">
                         <select id="role" name="role">
                           <option value="5" <?= $user_details->role == '5' ? ' selected ' : '' ?>>Sub Admin</option>
                         </select>
                         <label for="role">Role</label>
                       </div>
                     </div>

                     <div class="row">
                       <div>
                         <?php foreach ($app_previlage_list as $AppGrp) { ?>
                           <?php if (!empty($AppGrp->app_list)) { ?>
                             <ul class="col l14 s112 m4">
                               <li><?= $AppGrp->app_grp_name ?></li>
                               <li>
                                 <ul>
                                   <?php foreach ($AppGrp->app_list as $App) { ?>
                                     <li class="collection-item "><input type="checkbox" id="app_privilages<?= $App->app_id ?>" name="app_privilages[]" value="<?= $App->app_id ?>" <?= in_array($App->app_id, $user_app_previlage_id_list) ? ' checked ' : '' ?> /><label for="app_privilages<?= $App->app_id ?>"><?= $App->app_name ?></label></li>
                                   <?php } ?>
                                 </ul>
                               </li>
                             </ul>
                           <?php } ?>

                         <?php } ?>
                       </div>

                     </div>
                     <div class="row">
                       <div class="input-field col s12">
                         <button class="btn cyan waves-effect waves-light right" type="submit">Save<i class="mdi-content-send right"></i>
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
   <script src="<?=base_url('assets/backend/js/plugins/jquery-validation/jquery.validate.min.js');?>"></script>
   <script type="text/javascript">
     $("#user_add_form").validate({
       rules: {
         firstname: {
           required: true,
         },
         lastname: {
           required: true,
         },
         phone: {
           required: true,
         },
         password: {
           required: true,
         },
         email: {
           required: true,
           email: true,
         },
       },
       //For custom messages
       messages: {
        firstname: {
           required: "Enter a First Name",
         },
         lastname: {
           required: "Enter a Last Name",
         },
         password: {
           required: "Enter a Password",
         },
         phone: {
           required: "Enter a Phone",
         },
         email: {
           required: "Enter an Email",
         },
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
   </script>
   <!-- END CONTENT -->
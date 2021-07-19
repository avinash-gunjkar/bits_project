 <div class="main-wrapper-dashboard">
<!-- <header id="header_dashboard">
	 <div class="header-top-area">
        <div class="container-fluid">
           <div class="row">
              <div class="col-12 col-lg-8 col-xs-8">
                 <div class="top-contact">
                    <a href="#"><i class="fa fa-envelope"></i> sales@24thmile.com</a>
                    <a href="tel:+7709065277"><i class="fa fa-phone"></i> +91 7709065277</a>
                 </div>   
              </div>
              <div class="col-12 col-lg-4 col-xs-4  d-flex justify-content-center justify-content-lg-end">
				<?php $seller_data = $this->session->userdata('seller_logged_in'); ?>
                 <div class="top-menu">
                   <ul>
                  <?php if(empty($seller_data)){ ?>				   
                                      <li><a href="<?php echo base_url('signin'); ?>"><i class="fa fa-sign-in"></i>Login </a></li>
                                      
                  <?php }else{ ?>
                  <?php if($seller_data['role'] == 3){ ?>
                  <li><a href="<?php echo base_url('freight-forwarder-dashboard'); ?>"><i class="fa fa-user"></i> <?php echo $seller_data['firstname'].' '.$seller_data['lastname']; ?> </a></li>
                  <?php }else{ ?>
                  <li><a href="<?php echo base_url('my-profile'); ?>"><i class="fa fa-user"></i> <?php echo $seller_data['firstname'].' '.$seller_data['lastname']; ?> </a></li>
                  <?php } ?>
                  <li><a href="<?php echo base_url('signout'); ?>"><i class="fa fa-sign-out"></i>Logout </a></li>
                  <?php } ?>
                   </ul>  
                 </div>
                 <div class="language">
                   <ul>
                    <li><a href="#" title="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/frontend/images/flag-1.png'); ?>" alt="" /> EN </a>
                      <ul class="dropdown-menu">
                            <li><a href="index.html" title=""><img src="<?php echo base_url('assets/frontend/images/flag-1.png'); ?>" alt="" /> EN </a></li>
                            <li><a href="index.html" title=""><img src="<?php echo base_url('assets/frontend/images/flag-2.png'); ?>" alt="" /> TR </a></li>
                            <li><a href="index.html" title=""><img src="<?php echo base_url('assets/frontend/images/flag-3.png'); ?>" alt="" /> BR </a></li>
                            <li><a href="index.html" title=""><img src="<?php echo base_url('assets/frontend/images/flag-4.png'); ?>" alt="" /> SR </a></li>
                         </ul>
                    </li>
                   </ul>
                 </div>
              </div>
           </div>
        </div>
     </div>
 </header>  -->
 
<section class="Dashborad_section">
<?php $seller_data = $this->session->userdata('seller_logged_in');
    $userPrefix = $seller_data['role']=='3'?'ff-':'fs-';
    $userRollTitle = $seller_data['role']=='3'?'Freight Forwarder':'Seller';
?>
<div class="dashboard_header clearfix">
 <div class="dash-logo"> <div class="logo">
           <a href="<?php echo base_url(); ?>" title="W-shipping"><img  src="<?php echo base_url('assets/frontend/images/logo-v6.png'); ?>" alt="W-shipping" /></a>
         </div></div>
 <ul>
 
 <li class="dropdown"><a class=" dropdown-toggle text-capitalize" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $seller_data['firstname'].' '.$seller_data['lastname'].' ('.$userRollTitle.')'; ?> 
         <img  src="<?php echo base_url('uploads/users/'.$seller_data['profile_pic']); ?>" alt="user" /></a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url($userPrefix.'my-profile'); ?>"><i class="flaticon-user-3"></i> My Profile</a>
      <a class="dropdown-item" href="#"><i class="flaticon-settings-6"></i>Setting</a>
      <a class="dropdown-item" href="<?php echo base_url('signout'); ?>"><i class="flaticon-locked-4"></i>Logout</a>
     </div>
 
 
 </li>
 
<!-- <li><a href="javascript:void(0)"> <i class="flaticon-alarm"></i></a></li>-->
 
 </ul>
</div>
<div class="dashboard-left-panel">
	
   <div id="accordions">
  <div class="card">
    <div class="card-header" id="headingOne">
      
        <a  href="<?= base_url($userPrefix.'my-profile');?>"class="" data-toggle=""  aria-expanded="true" aria-controls="collapseOne">
        <i class="flaticon-user-3"></i> My Profile</a><span class="caret"></span>
      
    </div>

<!--    <div id="collapseOnes" class="" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
         <ul>
            <li> 
            <a href="javascript:void(0)"><i class="fa fa-circle-thin" aria-hidden="true"></i> Settings</a></li>
            
            </ul>
      </div>
    </div>-->
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
 
        <a class=" " data-toggle="" data-target="#collapseTwos" aria-expanded="false" aria-controls="collapseTwo">
          <i class="flaticon-menu-3"></i>Company</a><span class="caret"></span>
      
    </div>
    <div id="collapseTwos" class="" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
       <ul>
            <li> <a href="<?= base_url($userPrefix.'company-profile');?>"><i class="fa fa-circle-thin" aria-hidden="true"></i> Company Profile</a></li>
             <li> <a href="<?= base_url('company-branch');?>"> <i class="fa fa-circle-thin" aria-hidden="true"></i> Company Branch Office</a></li>
              <li> <a href="javascript:void(0)"> <i class="fa fa-circle-thin" aria-hidden="true"></i> Company Users</a></li>
           </ul>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      
        <a class="" data-toggle="" data-target="#collapseThrees" aria-expanded="false" aria-controls="collapseThrees">
         <i class="flaticon-placeholder-2"></i> Shipping & Deliver</a> <span class="caret"></span>
      
    </div>
    <div id="collapseThrees" class="" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
       <ul>
            <li> <a href="javascript:void(0)"><i class="fa fa-circle-thin" aria-hidden="true"></i> Request</a></li>
            <li> <a href="javascript:void(0)"><i class="fa fa-circle-thin" aria-hidden="true"></i> Freight Pickup & 
Drop Addresses </a></li>
            </ul>
      </div>
    </div>
  </div>
</div> 
    
   
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" ></script>
<script>
$('.dropdown-toggle').dropdown();
</script>




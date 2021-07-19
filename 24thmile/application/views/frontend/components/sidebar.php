<body class="sidebar-open">
  <style>
  .sticky {
	position: fixed;
    top: 0;
    width: 100%;
    background: #fff !important;
    z-index: 100;
}

  </style>
   <!-- Main Wrapper Start --> 
   <div class="main-wrapper">
 <header id="header">
     <!-- Header top area start -->
	 <div class="header-top-area">
        <div class="container-fluid">
           <div class="row">
              <div class="col-12 col-lg-4 col-xs-12">
                 <div class="top-contact">
                    <a href="mailto:sales@24thmile.com"><i class="fa fa-envelope"></i> sales@24thmile.com</a>
                    <a href="tel:+7709065277"><i class="fa fa-phone"></i> +91 7709065277</a>
                    
                 </div>   
              </div>
              <div class="col-12 col-lg-8 col-xs-12  d-flex justify-content-center justify-content-lg-end">
				<?php $seller_data = getLoginUserDetails();
                                
                                $userPrefix = $seller_data->role=='3'?'ff-':'fs-';?>
                 <div class="top-menu">
                   <ul>
                   <?php foreach(getSocialLinks() as $social){ ?>
                  <li><a target="_blank" href="<?=$social['social_value']?>"><i class="fa <?=$social['statusck']?>"></i></a></li>
                <?php }?>
                  <?php if(empty($seller_data)){ ?>				   
                                      <li><a href="<?php echo base_url('signin'); ?>"><i class="fa fa-sign-in"></i>Login </a></li>
                                      
                  <?php }else{ ?>
                  <?php if($seller_data->role == 3){ ?>
                  <li><a href="<?php echo base_url($userPrefix.'my-profile'); ?>"><i class="fa fa-user"></i> <?php echo $seller_data->firstname.' '.$seller_data->lastname; ?> </a></li>
                  <?php }else{ ?>
                  <li><a href="<?php echo base_url($userPrefix.'my-profile'); ?>"><i class="fa fa-user"></i> <?php echo $seller_data->firstname.' '.$seller_data->lastname; ?> </a></li>
                  <?php } ?>
                  <li><a href="<?php echo base_url('signout'); ?>"><i class="fa fa-sign-out"></i>Logout </a></li>
                  <?php } ?>
                   </ul>  
                 </div>
                 <!--<div class="language">
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
                 </div>-->
              </div>
           </div>
        </div>
     </div>
     <!-- Header top area End -->
    
     <!-- Header area start -->
	 <div class="header-area" id="myHeader">
       <div class="container-fluid"> 
       <div class="row">
         <!-- Site logo Start --> 
         <div class="logo">
           <a href="<?php echo base_url(); ?>" title="W-shipping"><img  src="<?php echo base_url('assets/frontend/images/logo-v6.png?v=1.1'); ?>" alt="W-shipping" /></a>
         </div>
         <!-- Site logo end -->
         <div class="mobile-menu-wrapper"></div>
         <!-- Search Start -->
         <div class="dropdown header-search-bar">
           <form action="index.html">
             <span class="" data-toggle="dropdown"><i class="fa fa-search" aria-hidden="true"></i></span>
             <input type="search" placeholder="kyewords.." class="dropdown-menu search-box" />
           </form>
         </div>
         <!-- Search End -->
        
         <!-- Main menu start -->
         <nav class="mainmenu ml-auto">
           <ul id="navigation">
              <li class="<?=$activeMenu=='home'?'nav-active':''?>"><a href="<?php echo base_url(); ?>" >Home</a></li>
			  <li class="<?=$activeMenu=='about-us'?'nav-active':''?>"><a href="<?php echo base_url('about-us'); ?>">About Us </a></li>
              <li class="<?=$activeMenu=='services'?'nav-active':''?>"><a href="<?php echo base_url('services');?>">Services </a>
                 <ul>
                    <li><a href="<?php echo base_url('booking-tracking-status-report');?>">Freight Comparative, Booking & Tracking</a></li>
                    <li><a href="<?php echo base_url('export-import-process-outsourcing-consultancy');?>">Export-Import Process Outsourcing & Consultancy</a></li>
                    <li><a href="<?php echo base_url('other-outsourcing-consultancy');?>">Other Outsourcing and Consultancy Services</a></li>
                 </ul>
              </li>
              <li class="<?=$activeMenu=='process'?'nav-active':''?>"><a href="<?php echo base_url('process'); ?>">Process </a>
              </li>
              <li class="<?=$activeMenu=='news-event'?'nav-active':''?>"><a href="<?php echo base_url('news-event'); ?>">News & Events </a>
              </li>
              <li class="<?=$activeMenu=='contact-us'?'nav-active':''?>"><a href="<?php echo base_url('contact-us'); ?>">Contact Us </a></li>
           </ul>
         </nav>
         <!-- Main menu end -->   
       </div>
       </div>
     </div>
     <!-- Header area End -->
   </header>  
  <!-- Preloader start -->
  <!-- <div class="wshipping-site-preloader-wrapper">
      <div class="spinner">
         <div class="double-bounce1"></div>
         <div class="double-bounce2"></div>
      </div>
   </div>-->
   <!-- Preloader End -->
   
   <script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("header");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > 100) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>
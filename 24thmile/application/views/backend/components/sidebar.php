  <style>
      header .brand-logo {
          padding: 0px 20px !important;
      }
    
  </style>
  <!-- START HEADER -->
  <header id="header" class="page-topbar">
      <!-- start header nav-->
      <input type="hidden" id="BASEURL" name="<?php echo base_url(); ?>">
      <div class="navbar-fixed">
          <nav class="navbar-color">
              <div class="nav-wrapper">
                  <ul class="left">
                      <li>
                          <h1 class="logo-wrapper"><a href="<?php echo base_url('admin/dashboard'); ?>" class="brand-logo darken-1"><img src="<?php echo base_url('assets/backend/images/Logo-Temgire.png') ?>" alt="materialize logo"></a> <span class="logo-text">24thMile.com</span></h1>
                      </li>
                  </ul>
                  <!--  <div class="header-search-wrapper hide-on-med-and-down">
                        <i class="mdi-action-search"></i>
                        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize"/>
                    </div> -->
                  <!--<ul class="right hide-on-med-and-down">
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"  data-activates="translation-dropdown"><img src="<?php echo base_url('assets/backend/images/Vinayak-temgire.jpg') ?>" alt="USA"  style="width: 50px;
    border-radius: 50%;"/></a>
                        </li>
                      <!--   <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge">5</small></i>
                        
                        </a>
                        </li>                        
                        <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                        </li> 
                    </ul>-->
                  <!-- translation-button -->
                  <!-- <ul id="translation-dropdown" class="dropdown-content">
                       <li>
                        <a href="#!"><img src="<?php echo base_url('assets/backend/images/flag-icons/United-States.png') ?>" alt="English" />  <span class="language-select">English</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="<?php echo base_url('assets/backend/images/flag-icons/France.png') ?>" alt="French" />  <span class="language-select">French</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="<?php echo base_url('assets/backend/images/flag-icons/China.png') ?>" alt="Chinese" />  <span class="language-select">Chinese</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="<?php echo base_url('assets/backend/images/flag-icons/Germany.png') ?>" alt="German" />  <span class="language-select">German</span></a>
                      </li>  
                      <li>
                        <a href="#">
                            Profile</a>
                        </li>
                        <li><a href="#">
                             Settings</a>
                        </li>
                        <li><a href="#">
                            Help</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#">
                            Lock</a>
                        </li>
                        <li><a href="<?php echo base_url('login/logout'); ?>">
                            Logout</a>
                        </li>                     
                    </ul>-->
                  <!-- notifications-dropdown -->
                  <!-- <ul id="notifications-dropdown" class="dropdown-content">
                      <li>
                        <h5>NOTIFICATIONS <span class="new badge">5</span></h5>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="#!"><i class="mdi-action-add-shopping-cart"></i> A new order has been placed!</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-stars"></i> Completed the task</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-settings"></i> Settings updated</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-editor-insert-invitation"></i> Director meeting started</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-trending-up"></i> Generate monthly report</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                      </li>
                    </ul> -->


              </div>
          </nav>
      </div>
      <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
      <!-- START WRAPPER -->
      <div class="wrapper">

          <!-- START LEFT SIDEBAR NAV-->
          <aside id="left-sidebar-nav">
              <ul id="slide-out" class="side-nav fixed leftside-navigation">
                  <li class="user-details cyan darken-2">
                      <div class="row">
                          <div class="col col s4 m4 l4">
                              <img src="<?php echo base_url('assets/backend/images/Vinayak-temgire.jpg') ?>" alt="" class="circle responsive-img valign profile-image">
                          </div>
                          <div class="col col s8 m8 l8">
                              <ul id="profile-dropdown" class="dropdown-content">

                                  <li><a href="<?php echo base_url('admin/logout'); ?>"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                  </li>
                              </ul>
                              <?php $userdata = $this->session->userdata('logged_in'); ?>
                              <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $userdata['firstname'] . ' ' . $userdata['lastname']; ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                              <p class="user-roal">Administrator</p>
                          </div>
                      </div>
                  </li>
                  <li class="bold"><a href="<?php echo base_url('admin/dashboard'); ?>" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                  </li>
                  <!--			<li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-account-box"></i> Users</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="<?php echo base_url('user'); ?>">Users List</a></li>
                                <li><a href="<?php echo base_url('role') ?>">Roles</a></li>
                            </ul>
                        </div>
                    </li>  
                </ul>
            </li> 			-->
                  <!--			<li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-account-box"></i> Revenue</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="<?php echo base_url('invoice'); ?>">Invoice</a></li>
                            </ul>
                        </div>
                    </li>  
                </ul>
            </li> -->

                  <?php
                    //$this->load->model('app_previlages');

                    $app_list = getApplist();

                    ?>
                  <?php foreach ($app_list as $app_grp) { ?>
                      <?php if (!empty($app_grp->app_list)) { ?>
                          <li class="no-padding">
                              <ul class="collapsible collapsible-accordion">
                                  <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="<?= $app_grp->icon_class ?>"></i> <?= $app_grp->app_grp_name ?></a>
                                      <div class="collapsible-body">
                                          <ul>
                                              <?php foreach ($app_grp->app_list as $app) { ?>
                                                  <li><a href="<?php echo base_url($app->url); ?>"><?= $app->app_name ?></a></li>
                                              <?php } //end for app list
                                                ?>
                                          </ul>
                                      </div>
                                  </li>
                              </ul>
                          </li>
                      <?php } //end if
                        ?>
                  <?php } //end for appgrp
                    ?>
                   <li class="no-padding" style="height: 200px;"></li>
                  <!--            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-account-box"></i> Approval</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="<?php echo base_url('invoice-approval'); ?>">Invoice Approval</a></li>
                                <li><a href="<?php echo base_url('kyc-approval') ?>">KYC Approval</a></li>
                            </ul>
                        </div>
                    </li>  
                </ul>
            </li> -->
                  <!--            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-social-domain"></i> Master</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="<?php echo base_url('company') ?>">Company</a></li>
                                <li><a href="<?php echo base_url('kyc-approval') ?>">KYC Approval</a></li>
                                <li><a href="<?php echo base_url('container') ?>">Container</a></li>
                                <li><a href="<?php echo base_url('contract') ?>">Contract</a></li>
                                <li><a href="<?php echo base_url('deliverterm') ?>">Deliver Term</a></li>
                                <li><a href="<?php echo base_url('mode') ?>">Mode</a></li>
                                <li><a href="<?php echo base_url('packing') ?>">Packing</a></li>
                                <li><a href="<?php echo base_url('rate') ?>">Rate</a></li>
                                <li><a href="<?php echo base_url('sector') ?>">Sector</a></li>
                                <li><a href="<?php echo base_url('shipment') ?>">Shipment</a></li>
                                <li><a href="<?php echo base_url('port') ?>">Port</a></li>
                                <li><a href="<?php echo base_url('sellerreq') ?>">Seller Requirement</a></li>
                                <li><a href="<?php echo base_url('document') ?>">Document</a></li>
                                <li><a href="<?php echo base_url('dimension') ?>">Dimension</a></li>
                                <li><a href="<?php echo base_url('sectorwisedocument') ?>">Sector Wise Document</a></li>
				<li><a href="<?php echo base_url('freight') ?>">Freight Template</a></li>
                            </ul>
                        </div>
                    </li>  
                </ul>
            </li> -->
                  <!--			<li class="bold"><a href="<?php echo base_url('shipment/booked_shipments'); ?>" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Booked Shipments</a></li>
			<li class="bold"><a href="<?php echo base_url('reports'); ?>" class="waves-effect waves-cyan"><i class="mdi-action-list"></i> Reports</a></li>-->
              </ul>
              
              <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating hide-on-large-only btn-medium waves-effect waves-light cyan"><i class="mdi-navigation-menu"></i></a>
          </aside>
          <!-- END LEFT SIDEBAR NAV-->

          <!-- //////////////////////////////////////////////////////////////////////////// -->
<body class="sidebar-open">
  <!--class="sidebar-open"-->
  <div class="main-wrapper-dashboard">


    <section class="Dashborad_section">
      <?php $seller_data = getLoginUserDetails();

      $userPrefix = $seller_data->role == '3' ? 'ff-' : 'fs-';
      $userRollTitle = $seller_data->role == '3' ? 'Freight Forwarder' : 'Exporter-Importer';
      ?>
      <div class="dashboard_header clearfix">
        <div class="dash-logo">
          <div class="logo">
            <a href="<?php echo base_url(); ?>" title="W-shipping"><img src="<?php echo base_url('assets/frontend/images/logo-v6.png?v=1.1'); ?>" alt="W-shipping" /></a>
          </div>

          <a href="javascript:void(0)" class="sidebar-toggle"> <i class="fa fa-bars"></i></a>

        </div>
        <ul>

          <li class="dropdown"><a class=" dropdown-toggle text-capitalize" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <p style="float:left;margin: 0;">
                <span style="display:block;"><?php echo $seller_data->firstname . ' ' . $seller_data->lastname ?>
                </span>
                <span style="display:block;font-size: 12px; color:#cbcbcb;line-height: 1.1;">
                  <?= '(' . $userRollTitle . ')'; ?>
                </span>
              </p>

              <img src="<?php echo base_url('uploads/users/' . $seller_data->profile_pic); ?>" onerror=" this.src='<?php echo base_url() . 'uploads/users/placeholder-user.jpg' ?>'" alt="user" />
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="<?php echo base_url($userPrefix . 'my-profile'); ?>"><i class="flaticon-user-3"></i> My Profile</a>
              <!--<a class="dropdown-item" href="#"><i class="flaticon-settings-6"></i>Setting</a>-->
              <a class="dropdown-item" href="<?php echo base_url('signout'); ?>"><i class="flaticon-locked-4"></i>Logout</a>
            </div>


          </li>

          <!-- <li><a href="javascript:void(0)"> <i class="flaticon-alarm"></i></a></li>-->

        </ul>
      </div>
      <div class="dashboard-left-panel">

        <div id="accordions">
          <div class="card">
            <div class="card-header <?= $leftmenuActive == "dashboard" ? 'active' : ''; ?>" id="dashboard">

              <a href="<?= base_url($userPrefix . 'dashboard'); ?>" class="" data-toggle="" aria-expanded="true" aria-controls="collapseOne">
                <i class="fa fa-dashboard"></i><span>Dashboard</span></a>

            </div>

          </div>
          <div class="card">
            <div class="card-header <?= $leftmenuActive == "my-profile" ? 'active' : ''; ?>" id="headingOne">

              <a href="<?= base_url($userPrefix . 'my-profile'); ?>" class="" data-toggle="" aria-expanded="true" aria-controls="collapseOne">
                <i class="fa fa-user-circle-o"></i><span>My Profile</span></a>

            </div>

          </div>
          <div class="card">
            <div class="card-header  <?= $leftmenuActive == "company-profile" ? 'active' : ''; ?>" id="headingTwo">

              <a class=" " data-toggle="" data-target="#collapseTwos" aria-expanded="false" aria-controls="collapseTwo">
                <i class="fa fa-building"></i><span>Company </span></a><span class="caret"></span>

            </div>
            <div id="collapseTwos" class="" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <ul>
                  <li class="li_header">Company</li>
                  <li> <a href="<?= base_url($userPrefix . 'company-profile'); ?>" class="<?= $leftSubMenuActive == 'company-profile' ? 'leftSubMenuActive' : '' ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <span>Company Profile</span> </a></li>
                  <li> <a href="<?= base_url('company-branch/branch'); ?>" class="<?= $leftSubMenuActive == 'company-branch' ? 'leftSubMenuActive' : '' ?>"> <i class="fa fa-angle-right" aria-hidden="true"></i> Company Branch Office</a></li>
                  <li> <a href="<?= base_url('company-branch/consignee'); ?>" class="<?= $leftSubMenuActive == 'consignee-address' ? 'leftSubMenuActive' : '' ?>"> <i class="fa fa-angle-right" aria-hidden="true"></i> Consignee Address Management</a></li>
                  <li> <a href="<?= base_url('company-users'); ?>" class="<?= $leftSubMenuActive == 'company-users' ? 'leftSubMenuActive' : '' ?>"> <i class="fa fa-angle-right" aria-hidden="true"></i> Company Users</a></li>
                  <li> <a href="<?= base_url('company-banks'); ?>" class="<?= $leftSubMenuActive == 'company-banks' ? 'leftSubMenuActive' : '' ?>"> <i class="fa fa-angle-right" aria-hidden="true"></i> Company Banks</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header <?= $leftmenuActive == "shipping" ? 'active' : ''; ?>" id="headingThree">

              <a class="" data-toggle="" data-target="#collapseThrees" aria-expanded="false" aria-controls="collapseThrees">
                <i class="fa fa-map-marker"></i><span> Shipping & Deliver </span></a> <span class="caret"></span>

            </div>
            <div id="collapseThrees" class="" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <ul>
                  <li class="li_header">Shipping & Deliver</li>
                  <?php if ($userPrefix == 'ff-') { ?>
                    <li> <a href="<?= base_url($userPrefix . 'request-list'); ?>" class="<?= $leftSubMenuActive == 'request-list' ? 'leftSubMenuActive' : '' ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Freight Inquires</a></li>
                  <?php } else { ?>
                    <li> <a href="<?= base_url($userPrefix . 'request-list'); ?>" class="<?= $leftSubMenuActive == 'request-list' ? 'leftSubMenuActive' : '' ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Request for Freight Comparative</a></li>
                  <?php } ?>


                  <li> <a href="<?= base_url($userPrefix . 'booking-list'); ?>" class="<?= $leftSubMenuActive == 'booking-list' ? 'leftSubMenuActive' : '' ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Shipment Booking & Tracking</a></li>
                  <li> <a href="<?= base_url($userPrefix . 'shipping-documents'); ?>" class="<?= $leftSubMenuActive == 'document-management' ? 'leftSubMenuActive' : '' ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Document Management System</a></li>

                </ul>
              </div>
            </div>

          </div>
          <div class="card">
            <div class="card-header <?= $leftmenuActive == "projects" ? 'active' : ''; ?>" id="headingThree">
              <a class="" data-toggle="" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThrees">
                <i class="fa fa-cubes "></i><span> Projects </span></a> <span class="caret"></span>
            </div>
            <div id="collapseFour" class="" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <ul>
                  <li class="li_header">Projects</li>

                  <li> <a href="<?= base_url($userPrefix . 'annual-contract-list') ?>" class="<?= $leftSubMenuActive == 'annual-contract' ? 'leftSubMenuActive' : '' ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> Annual Contract</a></li>
                  <!-- <li> <a href="<?= base_url($userPrefix . 'online-bidding-list') ?>" class="<?= $leftSubMenuActive == 'online-bidding' ? 'leftSubMenuActive' : '' ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> Online Bidding</a></li> -->

                </ul>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header <?= $leftmenuActive == "reports" ? 'active' : ''; ?>" id="headingThree">
              <a class="" data-toggle="" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThrees">
                <i class="fa fa-list "></i><span> Reports </span></a> <span class="caret"></span>
            </div>
            <div id="collapseFour" class="" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <ul>
                  <li class="li_header">Reports</li>

                  <li> <a href="<?= base_url($userPrefix . 'reports/Export') ?>" class="<?= $leftSubMenuActive == 'export-report' ? 'leftSubMenuActive' : '' ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> Export Shipment Status Report</a></li>
                  <li> <a href="<?= base_url($userPrefix . 'reports/Import') ?>" class="<?= $leftSubMenuActive == 'import-report' ? 'leftSubMenuActive' : '' ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> Import Shipment Status Report</a></li>

                </ul>
              </div>
            </div>
          </div>

          <?php if ($userPrefix == 'fs-') { ?>
          <div class="card">
            <div class="card-header <?= $leftmenuActive == "documents-master-list" ? 'active' : ''; ?>" id="documents">

              <a href="<?= base_url($userPrefix . 'document-master-list'); ?>" class="" title="Documents" data-toggle="" aria-expanded="true" aria-controls="collapseOne">
                <i class="fa fa-newspaper-o"></i><span>Document Master</span></a>

            </div>

          </div>
            <?php }?>


        </div>
        </div>



        <script src="<?php echo base_url('assets/frontend/js/jquery-3.3.1.slim.min.js'); ?>"></script>
        <!-- Popper.JS -->
        <script src="<?php echo base_url('assets/frontend/js/popper.min.js'); ?>"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script> -->
        <!-- Bootstrap JS -->
        <script src="<?php echo base_url('assets/frontend/js/bootstrap.min.js'); ?>"></script>
        <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" ></script> -->
        <script>
          $('.dropdown-toggle').dropdown();

          /*$(".menuBtn").click(function(e) {
              $("body").toggleClass("menuOpen");
          	$(this).toggleClass("iconchnage")
          });*/


          $(".sidebar-toggle").click(function(e) {
            $("body").toggleClass("sidebar-open");
          });
        </script>
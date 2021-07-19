 <style>
   .wshipping-content-block {
     padding: 0px 0px;
   }

   .info-box {
     display: block;
     min-height: 90px;
     background: #fff;
     width: 100%;
     box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
     border-radius: 2px;
     margin-bottom: 15px;
   }

   .bg-aqua {
     background-color: #00c0ef !important;
   }

   .info-box-icon {
     border-top-left-radius: 2px;
     border-top-right-radius: 0;
     border-bottom-right-radius: 0;
     border-bottom-left-radius: 2px;
     display: block;
     float: left;
     height: 90px;
     width: 90px;
     text-align: center;
     font-size: 45px;
     line-height: 90px;
     background: rgba(0, 0, 0, 0.2);
     color: white;
   }

   .info-box-content {
     padding: 5px 10px;
     margin-left: 90px;
   }

   .info-box-text {
     text-transform: uppercase;
   }

   .progress-description,
   .info-box-text {
     display: block;
     font-size: 14px;
     white-space: nowrap;
     overflow: hidden;
     text-overflow: ellipsis;
   }

   .info-box-number {
     display: block;
     font-weight: bold;
     font-size: 18px;
   }

   .info-box small {
     font-size: 14px;
   }

   .bg-red {
     background-color: #dd4b39 !important;
   }

   .bg-green {
     background-color: #00a65a !important;
   }

   .bg-yellow {
     background-color: #f39c12 !important;
   }

   .dashboard-icon-link {
     text-decoration: none;
     color: inherit;
   }

   .dashboard-icon-link:hover {
     text-decoration: none;
     /*color: inherit;*/
   }

   .card table tr td {
     background-color: #fff !important;
   }

   .card table tr th a {
     color: #212529;
     font-size: 1rem;
   }

   .card table tr th {
     background-color: #fff;
   }

   h5.card-title {
     margin: 10px;
     font-weight: bold;
     font-size: 16px;
   }
   #bookingShipmentStatus table th,#bookingShipmentStatus table td {
     text-align: center;
   }
   .select-wrapper.custome-select{
     display: inline-block;
     width: 100px;
     margin: 0 5px;
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
           <h5 class="breadcrumbs-title">Dashboard</h5>
           <ol class="breadcrumbs">
             <!-- <li><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li><a href="#">Pages</a></li> -->
             <!-- <li class="active">Dashboard</li> -->
           </ol>
         </div>
       </div>
     </div>
   </div>
   <!--breadcrumbs end-->


   <!--start container-->
   <div class="container">
     <div class="section">

       <div class="wshipping-content-block shipping-block">
         <div class="container">
           <div class="row">
             <h5 class="">Users</h5>
             <div class="col l4 m3 s12">
               <a class="dashboard-icon-link" href="<?= base_url('admin/company/freight-forwarder') ?>">
                 <div class="info-box">
                   <span class="info-box-icon purple darken-4"><i class="mdi-action-account-circle"></i></span>

                   <div class="info-box-content">
                     <span class="info-box-text">Freight Forwarder</span>
                     <span class="info-box-number"><?= $userCounts->ff_count ? $userCounts->ff_count : '0' ?></span>
                   </div>
                   <!-- /.info-box-content -->
                 </div>
                 <!-- /.info-box -->
               </a>
             </div>
             <div class="col l4 m3 s12">
               <a class="dashboard-icon-link" href="<?= base_url('admin/company/exporter-importer') ?>">
                 <div class="info-box">
                   <span class="info-box-icon pink darken-4"><i class="mdi-action-account-circle"></i></span>

                   <div class="info-box-content">
                     <span class="info-box-text">Exporter-Importer</span>
                     <span class="info-box-number"><?= $userCounts->ff_count ? $userCounts->fs_count : '0' ?></span>
                   </div>
                   <!-- /.info-box-content -->
                 </div>
                 <!-- /.info-box -->
               </a>
             </div>
           </div>
           <div class="row">

             <h5 class="">Shipments</h5>
             <div class="col l4 m3 s12 ">

               <div class="info-box">
                 <span class="info-box-icon blue darken-4"><i class="fa mdi-maps-directions-ferry"></i></span>

                 <div class="info-box-content">
                   <span class="info-box-text">LCL</span>
                   <span class="info-box-number"><?= $numberOfAwardedRequests->lcl_count ? $numberOfAwardedRequests->lcl_count : '0' ?></span>
                   <span><a href="<?= base_url('admin/rfc-list?shipment=2') ?>">Inquiry(<?= $numberOfAwardedRequests->lcl_inquiry_count ?>)</a> | <a href="<?= base_url('admin/booking-list?shipment=2') ?>">Booking(<?= $numberOfAwardedRequests->lcl_booking_count ?>)</a></span>
                 </div>
                 <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->

             </div>
             <div class="col l4 m3 s12">

               <div class="info-box">
                 <span class="info-box-icon blue darken-4"><i class="fa mdi-maps-directions-ferry"></i></span>

                 <div class="info-box-content">
                   <span class="info-box-text">FCL</span>
                   <span class="info-box-number"><?= $numberOfAwardedRequests->fcl_count ? $numberOfAwardedRequests->fcl_count : '0' ?></span>
                   <span><a href="<?= base_url('admin/rfc-list?shipment=1') ?>">Inquiry(<?= $numberOfAwardedRequests->fcl_inquiry_count ?>)</a> | <a href="<?= base_url('admin/booking-list?shipment=1') ?>">Booking(<?= $numberOfAwardedRequests->fcl_booking_count ?>)</a></span>
                 </div>
                 <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->

             </div>
             <div class="col l4 m3 s12">

               <div class="info-box">
                 <span class="info-box-icon blue lighten-1"><i class=" mdi-maps-flight"></i></span>

                 <div class="info-box-content">
                   <span class="info-box-text">Air</span>
                   <span class="info-box-number"><?= $numberOfAwardedRequests->air_count ? $numberOfAwardedRequests->air_count : '0' ?></span>
                   <span><a href="<?= base_url('admin/rfc-list?mode=2') ?>">Inquiry(<?= $numberOfAwardedRequests->air_inquiry_count ?>)</a> | <a href="<?= base_url('admin/booking-list?mode=2') ?>">Booking(<?= $numberOfAwardedRequests->air_booking_count ?>)</a></span>
                 </div>
                 <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->

             </div>
             <div class="col l4 m3 s12">

               <div class="info-box">
                 <span class="info-box-icon blue darken-4"><i class="fa mdi-maps-directions-ferry"></i></span>

                 <div class="info-box-content">
                   <span class="info-box-text">Sea</span>
                   <span class="info-box-number"><?= $numberOfAwardedRequests->sea_count ? $numberOfAwardedRequests->sea_count : '0' ?></span>
                   <span><a href="<?= base_url('admin/rfc-list?mode=3') ?>">Inquiry(<?= $numberOfAwardedRequests->sea_inquiry_count ?>)</a> | <a href="<?= base_url('admin/booking-list?mode=3') ?>">Booking(<?= $numberOfAwardedRequests->sea_booking_count ?>)</a></span>
                 </div>
                 <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->

             </div>
             <div class="col l4 m3 s12">

               <div class="info-box">
                 <span class="info-box-icon bg-green"><i class="mdi-maps-local-shipping"></i></span>

                 <div class="info-box-content">
                   <span class="info-box-text">Road</span>
                   <span class="info-box-number"><?= $numberOfAwardedRequests->road_count ? $numberOfAwardedRequests->road_count : '0' ?></span>
                   <span><a href="<?= base_url('admin/rfc-list?mode=1') ?>">Inquiry(<?= $numberOfAwardedRequests->road_inquiry_count ?>)</a> | <a href="<?= base_url('admin/booking-list?mode=1') ?>">Booking(<?= $numberOfAwardedRequests->road_booking_count ?>)</a></span>
                 </div>
                 <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->

             </div>



           </div>
           <div class="row">
             <div class="col l6">
               <div class="card">
                 <div class="card-content">
                   <h5>Export</h5>

                   <table class="collection bordered">
                     <tbody>
                       <tr>
                         <th class="text-left"><a href="#">New Inquire</a></th>
                         <td><span style="font-size: 22px"><?= $newInquireCount->export ? $newInquireCount->export : '0' ?></span></td>
                       </tr>
                       <tr>
                         <th class="text-left"><a href="#">Shipment is in Process</a></th>
                         <td><span style="font-size: 22px"><?= $shipmentInProcessCount->export ? $shipmentInProcessCount->export : '0' ?></span></td>
                       </tr>
                       <tr>
                         <th class="text-left"><a href="#">Completed Shipment & Payment Pending</a></th>
                         <td><span style="font-size: 22px"><?= $completedShipmentPaymentPendingCount->export ? $completedShipmentPaymentPendingCount->export : '0' ?></span></td>
                       </tr>
                       <tr>
                         <th class="text-left"><a href="#">Completed Shipment</a></th>
                         <td><span style="font-size: 22px"><?= $completedShipmentCount->export ? $completedShipmentCount->export : '0' ?></span></td>
                       </tr>
                     </tbody>
                   </table>

                 </div>
               </div>
             </div>
             <div class="col l6">
               <div class="card">
                 <div class="card-content">
                   <h5>Import</h5>
                   <table class="collection bordered">
                     <tbody>
                       <tr>
                         <th class="text-left"><a href="#">New Inquire</a></th>
                         <td><span style="font-size: 22px"><?= $newInquireCount->import ? $newInquireCount->import : '0' ?></span></td>
                       </tr>
                       <tr>
                         <th class="text-left"><a href="#">Shipment is in Process</a></th>
                         <td><span style="font-size: 22px"><?= $shipmentInProcessCount->import ? $shipmentInProcessCount->import : '0' ?></span></td>
                       </tr>
                       <tr>
                         <th class="text-left"><a href="#">Completed Shipment & Payment Pending</a></th>
                         <td><span style="font-size: 22px"><?= $completedShipmentPaymentPendingCount->import ? $completedShipmentPaymentPendingCount->import : '0' ?></span></td>
                       </tr>
                       <tr>
                         <th class="text-left"><a href="#">Completed Shipment</a></th>
                         <td><span style="font-size: 22px"><?= $completedShipmentCount->import ? $completedShipmentCount->import : '0' ?></span></td>
                       </tr>
                     </tbody>
                   </table>
                 </div>
               </div>
             </div>

           </div>

           <div class="row" id="bookingShipmentStatus">
           <div class="l12 mt-4">
             <div class="card">
               <div class="card-content">
                 <h5>Booking Shipment Status</h5>
                 <table class="collection bordered">
                   <thead>
                     <tr>
                       <th> 
                         <span>Financial Year:</span> 
                         <select name="finyear" id="finyear" class="custome-select" >
                           <?php
                            foreach (getFinancialYearList() as $year) {
                              $url = base_url("fs-dashboard?finyear=$year");
                              $selected = $finyear == $year->value ? 'selected' : '';
                              echo "<option value='$year->value' $selected >$year->label</option>";
                            }
                            ?>
                         </select>
                       </th>
                       <?php
                        foreach ($bookedShipmentStatusCount->import as $statusTitle => $count) {

                          echo "<th>$statusTitle</th>";
                        }
                        ?>
                     </tr>
                   </thead>
                   <tbody>
                     <tr>
                       <td>Export</td>
                       <?php foreach ($bookedShipmentStatusCount->export as $statusTitle => $count) {

                          echo "<td>$count</td>";
                        } ?>
                     </tr>
                     <tr>
                       <td>Import</td>
                       <?php foreach ($bookedShipmentStatusCount->import as $statusTitle => $count) {

                          echo "<td>$count</td>";
                        } ?>
                     </tr>

                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
         </div>
       </div>
     </div>

   </div>
   <!--end container-->
 </section>
 <!-- END CONTENT -->
 <script>
   $('#finyear').change(function(){
    var finyear = $('#finyear').val();
    window.location = base_url+'admin/dashboard?finyear='+finyear+'#bookingShipmentStatus';
   });
 </script>
 <!-- //////////////////////////////////////////////////////////////////////////// -->
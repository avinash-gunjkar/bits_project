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
   .bg-dark-blue {
     background-color: #0D47A1 !important;
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
 </style>
 <div class="wshipping-content-block">

 <div class="tracking-block">
          
          <!--class="tab-content"-->
          <div class="wshipping-content-block shipping-block">
            <div class="container">
             <h3>Dashboard</h3>
              

              <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-12 ">

                  <div class="info-box">
                    <span class="info-box-icon bg-dark-blue"><i class="fa fa-ship"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">LCL</span>
                      <span class="info-box-number"><?= $numberOfAwardedRequests->lcl_count ? $numberOfAwardedRequests->lcl_count : '0' ?></span>
                      <span><a class="text-info" href="<?= base_url('ff-request-list?shipment=2') ?>">Inquiry(<?= $numberOfAwardedRequests->lcl_inquiry_count ?>)</a> | <a class="text-info" href="<?= base_url('ff-booking-list?shipment=2') ?>">Booking(<?= $numberOfAwardedRequests->lcl_booking_count ?>)</a></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->

                </div>
                <div class="col-lg-4 col-md-3 col-sm-12">

                  <div class="info-box">
                    <span class="info-box-icon bg-dark-blue"><i class="fa fa-ship"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">FCL</span>
                      <span class="info-box-number"><?= $numberOfAwardedRequests->fcl_count ? $numberOfAwardedRequests->fcl_count : '0' ?></span>
                      <span><a class="text-info" href="<?= base_url('ff-request-list?shipment=1') ?>">Inquiry(<?= $numberOfAwardedRequests->fcl_inquiry_count ?>)</a> | <a class="text-info" href="<?= base_url('ff-booking-list?shipment=1') ?>">Booking(<?= $numberOfAwardedRequests->fcl_booking_count ?>)</a></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->

                </div>
                <div class="col-lg-4 col-md-3 col-sm-12">

                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class=" fa fa-plane"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Air</span>
                      <span class="info-box-number"><?= $numberOfAwardedRequests->air_count ? $numberOfAwardedRequests->air_count : '0' ?></span>
                      <span><a class="text-info" href="<?= base_url('ff-request-list?mode=2') ?>">Inquiry(<?= $numberOfAwardedRequests->air_inquiry_count ?>)</a> | <a class="text-info" href="<?= base_url('ff-booking-list?mode=2') ?>">Booking(<?= $numberOfAwardedRequests->air_booking_count ?>)</a></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->

                </div>
                <div class="col-lg-4 col-md-3 col-sm-12">

                  <div class="info-box">
                    <span class="info-box-icon bg-dark-blue"><i class="fa fa-ship"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Sea</span>
                      <span class="info-box-number"><?= $numberOfAwardedRequests->sea_count ? $numberOfAwardedRequests->sea_count : '0' ?></span>
                      <span><a class="text-info" href="<?= base_url('ff-request-list?mode=3') ?>">Inquiry(<?= $numberOfAwardedRequests->sea_inquiry_count ?>)</a> | <a class="text-info" href="<?= base_url('ff-booking-list?mode=3') ?>">Booking(<?= $numberOfAwardedRequests->sea_booking_count ?>)</a></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->

                </div>
                <div class="col-lg-4 col-md-3 col-sm-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-truck"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Road</span>
                      <span class="info-box-number"><?= $numberOfAwardedRequests->road_count ? $numberOfAwardedRequests->road_count : '0' ?></span>
                      <span><a class="text-info" href="<?= base_url('ff-request-list?mode=1') ?>">Inquiry(<?= $numberOfAwardedRequests->road_inquiry_count ?>)</a> | <a class="text-info" href="<?= base_url('ff-booking-list?mode=1') ?>">Booking(<?= $numberOfAwardedRequests->road_booking_count ?>)</a></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>


              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <h5>Export</h5>
                      
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="text-left">New Inquire</td>
                            <td><span style="font-size: 22px"><?= $newInquireCount->export?$newInquireCount->export: '0' ?></span></td>
                          </tr>
                          <tr>
                            <td class="text-left">Shipment is in Process</td>
                            <td><span style="font-size: 22px"><?= $shipmentInProcessCount->export?$shipmentInProcessCount->export:'0' ?></span></td>
                          </tr>
                          <tr>
                            <td class="text-left">Completed Shipment & Payment Pending</td>
                            <td><span style="font-size: 22px"><?= $completedShipmentPaymentPendingCount->export?$completedShipmentPaymentPendingCount->export:'0' ?></span></td>
                          </tr>
                          <tr>
                            <td class="text-left">Completed Shipment</td>
                            <td><span style="font-size: 22px"><?= $completedShipmentCount->export?$completedShipmentCount->export:'0' ?></span></td>
                          </tr>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                    <h5>Import</h5>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="text-left">New Inquire</td>
                            <td><span style="font-size: 22px"><?= $newInquireCount->import?$newInquireCount->import:'0' ?></span></td>
                          </tr>
                          <tr>
                            <td class="text-left">Shipment is in Process</td>
                            <td><span style="font-size: 22px"><?= $shipmentInProcessCount->import?$shipmentInProcessCount->import:'0' ?></span></td>
                          </tr>
                          <tr>
                            <td class="text-left">Completed Shipment & Payment Pending</td>
                            <td><span style="font-size: 22px"><?= $completedShipmentPaymentPendingCount->import?$completedShipmentPaymentPendingCount->import:'0' ?></span></td>
                          </tr>
                          <tr>
                            <td class="text-left">Completed Shipment</td>
                            <td><span style="font-size: 22px"><?= $completedShipmentCount->import?$completedShipmentCount->import:'0' ?></span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row" id="bookingShipmentStatus">
           <div class="col-lg-12 mt-4">
             <div class="card">
               <div class="card-body">
                 <h3>Booking Shipment Status</h3>
                 <table class="table">
                   <thead>
                     <tr>
                       <th> Financial Year:
                         <select name="finyear" id="finyear" class="custome-select">
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


 </section><!-- sidebar_dashboard-->
 </div> <!-- sidebar_dashboard-->

 <script>
   $('#finyear').change(function(){
    var finyear = $('#finyear').val();
    window.location = base_url+'ff-dashboard?finyear='+finyear+'#bookingShipmentStatus';
   });
 </script>
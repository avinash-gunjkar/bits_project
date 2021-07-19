<!-- Footer start -->
   <footer class="site-footer">
     <!-- Footer Top start -->
     <div class="footer-top-area wow fadeInUp">
       <div class="container">
         <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
              <div class="footer-wiz footer-menu">
                  <h3 class="footer-wiz-title">Quick Links </h3>
                  <ul>
                     <li><a href="<?php echo base_url('about-us'); ?>">About Us</a></li>
                     <li><a href="<?php echo base_url('services'); ?>">Services </a></li>
                     <li><a href="<?php echo base_url('contact-us'); ?>">Contact Us </a></li>
                  </ul>
               </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
               <div class="footer-wiz footer-menu">
                  <h3 class="footer-wiz-title">Usefull Links </h3>
                  <ul>
                    <li><a href="<?php echo base_url('signin'); ?>">Login</a></li>
                     <li><a href="<?php echo base_url('terms-conditions'); ?>">Terms & Conditions </a></li>
                  </ul>
               </div> 
            </div>
            <div class="col-12 col-md-6 col-lg-4">
               <div class="footer-wiz">
                  <h3 class="footer-wiz-title">contact us</h3>
                  <ul class="footer-contact">
                     <li><i class="fa fa-envelope"></i> sales@24thmile.com </li>
                     <li><i class="fa fa-fax"></i> +91 7709065277 </li>
                  </ul>
                   <div class="top-social bottom-social">
                 <a href="#"><i class="fa fa-facebook"></i></a>
                 <a href="#"><i class="fa fa-twitter"></i></a>
                 <a href="#"><i class="fa fa-youtube"></i></a>
                 <a href="#"><i class="fa fa-rss"></i></a>
              </div>
               </div>
            </div>
         </div>
      </div>
    </div>
    <!-- footer top end -->
   
    <!-- copyright start -->
    <div class="footer-bottom-area">
      <div class="container">
         <div class="row">
            <div class="col-12 col-lg-6">Copyright © 2019  <span>24thmile.com</span>. All Rights Reserved </div>
            <div class="col-12 col-lg-6 text-right">Design & Development By:  <a href="https://www.bottleneck.co.in/" title="Bottleneck Solutions" target="_blank">Bottleneck Solutions </a></div>
          </div>
       </div>     
     </div>
     <!-- copyright end -->
   </footer> 
   <!-- Footer end -->
   </div>
   <!-- Main Wrapper end -->
  
   <!-- Start scroll top -->
   <div class="scrollup"><i class="fa fa-angle-up"></i></div>
   <!-- End scroll top -->
  <!-- jQuery -->
     <script src="<?php echo base_url('assets/frontend/js/jquery-2.1.3.min.js'); ?>"></script>
    <!-- Tether JS -->
   <script src="<?php echo base_url('assets/frontend/js/js.js'); ?>"></script>
   
   <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.material.min.js"></script>
<script>

   $(document).ready(function() {
    $('#request_list').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
    } );
} );
   </script>
 </body>
 </html>
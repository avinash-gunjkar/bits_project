
    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>Copyright © 2019 <a class="grey-text text-lighten-4" href="<?php echo base_url(); ?>" target="_blank">24thmile.com</a> All rights reserved.</span>
        <!-- <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="https://bottleneck.co.in/">Bottleneck Solutions</a></span> -->
        </div>
    </div>
  </footer>
  <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->

      
    <!--materialize js-->
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/materialize.min.js')?>"></script>
    <!--prism
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/prism/prism.js')?>"></script>-->
    <!--scrollbar-->
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js')?>"></script>
    <!-- chartist -->
    <!-- <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins/chartist-js/chartist.min.js')?>"></script>    -->

    <!-- <script src="<?php echo base_url('assets/frontend/js/jquery-datetime-picker/jquery.datetimepicker.full.min.js')?>" type="text/javascript"></script> -->
    
    <!-- data-tables -->
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins/data-tables/js/jquery.dataTables.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins/data-tables/data-tables-script.js?v=1.0')?>"></script>
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins.js?v=1.2')?>"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/custom-script.js?v=1.0')?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins/jquery-validation/jquery.validate.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/custom-validation.js')?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/toastr.min.js'); ?>"></script>
     
 <script>   
    <?php if($this->session->flashdata('success')){ ?>
Command: toastr["success"]("<?php echo $this->session->flashdata('success'); ?>")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
<?php }
if($this->session->flashdata('error')){ ?>
Command: toastr["error"]("<?php echo $this->session->flashdata('error'); ?>")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
<?php } ?>
    </script>
</body>

</html>
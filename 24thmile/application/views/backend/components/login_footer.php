<!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins/jquery-1.11.2.min.js') ?>"></script>
  <!--materialize js-->
  <script type="text/javascript" src="<?php echo base_url('assets/backend/js/materialize.js') ?>"></script>
  <!--prism-->
  <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins/prism/prism.js') ?>"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>

      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins.js') ?>"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="<?php echo base_url('assets/backend/js/custom-script.js') ?>"></script>
 <script src="<?php echo base_url('assets/frontend/js/toastr.min.js'); ?>"></script>
 <script>   
    <?php if($this->session->flashdata('success')){ ?>
Command: toastr["success"]("<?php echo $this->session->flashdata('success'); ?>")

toastr.options = {
  "closeButton": true,
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
  "closeButton": true,
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
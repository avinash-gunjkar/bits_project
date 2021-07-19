<!-- Footer start -->
   <footer class="site-footer">
     <!-- Footer Top start -->
     <div class="footer-top-area wow fadeInUp">
       <div class="container">
         <div class="row">
            <div class="col-12 col-md-9 col-lg-9 text-right">
              <div class="footer-wiz footer-menu" style="margin: 15px 0px;">
                   
                  <ul>
                     <li style="display: inline;margin-right: 10px;"><a href="<?php echo base_url('about-us'); ?>">About Us</a></li>
                     <li style="display: inline;margin-right: 10px;"><a href="<?php echo base_url('services'); ?>">Services </a></li>
                     <li style="display: inline;margin-right: 10px;"><a href="<?php echo base_url('process'); ?>">Process </a></li>
                     <li style="display: inline;margin-right: 10px;"><a href="<?php echo base_url('news-event'); ?>">News & Events </a></li>
                     <li style="display: inline;margin-right: 10px;"><a href="<?php echo base_url('contact-us'); ?>">Contact Us </a></li>
                     <li style="display: inline;margin-right: 10px;"><a href="<?php echo base_url('terms-conditions'); ?>">Terms and Conditions </a></li>
                  </ul>
               </div>
            </div>

            <div class="col-12 col-md-3 col-lg-3">
               <div class="footer-wiz" > 
   
                <div class="top-social bottom-social pull-right" style="margin: 15px;">
                <?php foreach(getSocialLinks() as $social){ ?>
                  <a target="_blank" href="<?=$social['social_value']?>"><i class="fa <?=$social['statusck']?>"></i></a>
                <?php }?>
                
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
            <div class="col-12 col-lg-12 text-center">Copyright © 2019  <span>24thmile </span>. All Rights Reserved </div>
            <!-- <div class="col-12 col-lg-6 text-right">
              <a href="http://24thmile.campuslama.com/terms-conditions" title="Bottleneck Solutions">Terms and Conditions </a></div> -->
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
    <!--<script src="<?php echo base_url('assets/frontend/js/moment.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/frontend/js/bootstrap-datetimepicker.min.js'); ?>"></script>-->
    <link href="<?php echo base_url('assets/frontend/js/bootstrap-tagsinput-latest/bootstrap-tagsinput.css')?>" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url('assets/frontend/js/bootstrap-tagsinput-latest/bootstrap-tagsinput.min.js')?>" type="text/javascript"></script>
    
    <script src="<?php echo base_url('assets/frontend/js/toastr.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/dataTables.material.min.js'); ?>"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.material.min.js"></script> -->
    
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/js/gijgo/css/gijgo.min.css'); ?>" />
    <script src="<?php echo base_url('assets/frontend/js/gijgo/js/gijgo.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/frontend/js/jquery-datetime-picker/jquery.datetimepicker.full.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/frontend/js/numeric-js/jquery.numeric.js');?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/custom.js?v=1.16');?>"></script>
   
    <script src="<?php echo base_url('assets/frontend/js/bootstrap3-wysiwyg-master/dist/bootstrap3-wysihtml5.all.js');?>"></script>
   
<script type="text/javascript">
        $(document).ready(function () {
            $(".editor").editor();
            $('.dataTable').dataTable();
          
            $(document).click(function() {
        $(".dropdown-menu.show").removeClass('show');
    });
        });
        $('.wysihtml5-editor').wysihtml5({
  toolbar: {
    "fa":true,
    "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
    "emphasis": true, //Italics, bold, etc. Default true
    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
    "html": false, //Button which allows you to edit the generated HTML. Default false
    "link": false, //Button to insert a link. Default true
    "image": false, //Button to insert an image. Default true,
    "color": false, //Button to change color of font  
    "blockquote": false, //Blockquote  
    //"size": <buttonsize> //default: none, other options are xs, sm, lg
  }
});

$('.wysihtml5-editor-no-controlls').wysihtml5({
  toolbar: {
    "stylesheets": ['<?=base_url('assets/frontend/js/bootstrap3-wysiwyg-master/dist/editor.css')?>'],
    "fa":true,
    "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
    "emphasis": false, //Italics, bold, etc. Default true
    "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
    "html": false, //Button which allows you to edit the generated HTML. Default false
    "link": false, //Button to insert a link. Default true
    "image": false, //Button to insert an image. Default true,
    "color": false, //Button to change color of font  
    "blockquote": false, //Blockquote  
    //"size": <buttonsize> //default: none, other options are xs, sm, lg
  }
});

    </script>
    <input type="hidden" name="base_url" id="base_url" value="<?= base_url()?>">
    
<script>
   $('#message').on('input',function(){
                     var messageLength = $(this).val().length;
                     $('#messageLength').html(messageLength+'/1000');
                   });
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
  "timeOut": "8000",
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

   $(document).ready(function() {
    $('#request_list').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ],
        "aaSorting": [[ 0, 'desc' ]] 
    }
    );
} );
   </script>
 </body>
 </html>
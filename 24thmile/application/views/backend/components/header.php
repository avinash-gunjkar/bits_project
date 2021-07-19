<!DOCTYPE html>
<html lang="en">
<?php
   if($this->session->userdata('logged_in')!=TRUE){
       header("Location: ".base_url().'login');
   }
   
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>24thMile Admin Panel</title>

  <!-- Favicons-->
  <link rel="icon" href="<?php echo base_url('assets/backend/images/Logo-Temgire.png') ?>" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('assets/backend/images/favicon/apple-touch-icon-152x152.png') ?>">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="<?php echo base_url('assets/backend/css/materialize.min.css')?>" type="text/css" rel="stylesheet">
  <link href="<?php echo base_url('assets/backend/css/style.min.css')?>" type="text/css" rel="stylesheet">
  <!-- Custome CSS-->    
  <link href="<?php echo base_url('assets/backend/css/custom/custom-style.css?v=1.3')?>" type="text/css" rel="stylesheet">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="<?php echo base_url('assets/backend/js/plugins/prism/prism.css')?>" type="text/css" rel="stylesheet">
  <link href="<?php echo base_url('assets/backend/js/plugins/perfect-scrollbar/perfect-scrollbar.css')?>" type="text/css" rel="stylesheet">
  <link href="<?php echo base_url('assets/backend/js/plugins/chartist-js/chartist.min.css')?>" type="text/css" rel="stylesheet">
  <link href="<?php echo base_url('assets/backend/js/plugins/data-tables/css/jquery.dataTables.min.css')?>" type="text/css" rel="stylesheet">

 <!-- jQuery Library -->
  <script type="text/javascript" src="<?php echo base_url('assets/backend/js/plugins/jquery-1.11.2.min.js')?>"></script> 
  
     <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/toastr.min.css'); ?>" />
     
     <script src="<?=base_url('assets/backend/js/plugins/gijgo/js/gijgo.min.js');?>"></script>
     <link rel="stylesheet" href="<?=base_url('assets/backend/js/plugins/gijgo/css/gijgo.min.css')?>">
     
     <!-- <link href="<?php echo base_url('assets/frontend/js/jquery-datetime-picker/jquery.datetimepicker.min.css')?>" rel="stylesheet" type="text/css"/> -->
     <script>
        var base_url = '<?=base_url();?>';
     </script>
</head>
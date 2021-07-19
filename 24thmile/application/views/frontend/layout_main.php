<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('frontend/components/header');
    $this->load->view($sidebar?$sidebar:'frontend/components/sidebar');
//    $this->load->view('frontend/components/sidebar_dashboard');
    $this->load->view($page);
    $this->load->view('frontend/components/footer');
?>
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('backend/components/header');
    $this->load->view('backend/components/sidebar');
    $this->load->view($page);
    $this->load->view('backend/components/footer');
?>
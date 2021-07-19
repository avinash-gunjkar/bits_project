<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('backend/components/login_header');
    $this->load->view($page);
    $this->load->view('backend/components/login_footer');
?>
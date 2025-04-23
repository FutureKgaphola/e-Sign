<?php
class Logout extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function logout()
    {
        // Destroy the session
        $this->session->sess_destroy();

        // Redirect to the login page
        redirect(base_url());
    }
}
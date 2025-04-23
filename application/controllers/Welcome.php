<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]
class Welcome extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		
        $this->load->library('session');
        // Load any other libraries or models you need here
        if($this->session->userdata('logged_in')) {
           // User is logged in, proceed with the request
			redirect('dashboard');
        }
		
    }
	public function index()
	{
		$this->load->database();
		$this->load->view('welcome_message');
	}
	public function demo()
	{
		$this->load->view('pages/about');
	}
}

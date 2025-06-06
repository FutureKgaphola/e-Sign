<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');
        // Load any other libraries or models you need here
        if(!$this->session->userdata('logged_in')) {
           // User is logged in, proceed with the request
			redirect(base_url());
        }
		
    }
    public function index()
    {
            $users = $this->User_model->get_all_users();
            $inten = $this->User_model->get_user_employment('intern');
            $permanent = $this->User_model->get_user_employment('permanent');
            $contractor = $this->User_model->get_user_employment('contractor');
            $late_intern = $this->User_model->get_late_intern();
            $late_permanent = $this->User_model->get_late_permanent();
            $late_contractor= $this->User_model->get_late_contractor();

            if ($users) {
                $data['users'] = ['status' => 'success', 'data' => $users, 'intern' => $inten, 'permanent' => $permanent,'contractor'=>$contractor, 'late_intern' => $late_intern, 'late_permanent' => $late_permanent,'late_contractor' => $late_contractor];
            } else {
                $data['users'] = ['status' => 'success', 'data' => $users, 'intern' => $inten, 'permanent' => $permanent,'contractor'=>$contractor, 'late_intern' => $late_intern, 'late_permanent' => $late_permanent,'late_contractor' => $late_contractor];
            }
            $this->load->view('pages/admin/dashboard',$data);
    }
}
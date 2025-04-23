<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('User_model');
    }

    // public function index() {
    //     $this->load->view('welcome_message');
    // }
    
    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($username === 'admin' && $password === '1234') {
            $this->session->set_userdata([
                'logged_in' => TRUE,
                'username' => $username,
            ]);
            
            $users = $this->User_model->get_all_users();
            $inten = $this->User_model->get_user_employment('intern');
            $permanent = $this->User_model->get_user_employment('permanent');
            $late_intern = $this->User_model->get_late_intern();
            $late_permanent = $this->User_model->get_late_permanent();
            if ($users) {
                $data['users'] = ['status' => 'success', 'data' => $users, 'intern' => $inten, 'permanent' => $permanent, 'late_intern' => $late_intern, 'late_permanent' => $late_permanent];
            } else {
                $data['user'] = ['status' => 'success', 'data' => $users, 'intern' => $inten, 'permanent' => $permanent, 'late_intern' => $late_intern, 'late_permanent' => $late_permanent];
            }
            $this->load->view('pages/admin/dashboard',$data);
        } else {
            $data['error'] = 'Invalid username or password';
            $this->load->view('welcome_message', $data);
        }
    }
}

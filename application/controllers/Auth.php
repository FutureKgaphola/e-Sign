<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('User_model');
    }
    
    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('pass_word');

        $Is_succes=$this->User_model->login_Admin($username, $password);
        if(!$Is_succes){
            $data['error'] = 'Invalid username or password';
            $this->load->view('welcome_message', $data);
            return;
        }

        $this->session->set_userdata([
            'logged_in' => TRUE,
            'username' => $username,
        ]);
        
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

    public function create_admin(){
       try {
        $username = $this->input->post('username');
        $password = $this->input->post('pass_word');
        $emailAdmin=$this->input->post('emailAdmin');
        $IsCreated=$this->User_model->create_admin($username,$password,$emailAdmin);
        if($IsCreated){
            echo json_encode(['status' => 'success', 'message' => 'Admin created successfully']);
        }
       } catch (\Throwable $th) {
        echo $th->getMessage();
       }catch(PDOException $e){
        echo $e->getMessage();
       }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignRegister extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('welcome_message');
    }
    public function sign(){
        try {

            $empnum = $this->input->post('empnum');
            $this->load->model('Sign');
            $employee = new Sign;
            $employee->setEmployeeNumber($empnum);
            $employee->saveToDataBase();
            $data['sign_success']='You have signed in succesfully for today';
            $this->load->view('welcome_message',$data);
        } catch (\Throwable $th) {
            $data['sign_error']=$th->getMessage();
            $this->load->view('welcome_message',$data);
        }
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('User_model');
    }
    public function get_user() {
        $userId = $this->input->post('userid');
        $user = $this->User_model->get_user_by_id($userId);
        echo json_encode($user);
    }

    public function add_user() {
        try {
            $empnum=$this->input->post('emp_noAdd');
            if(ctype_digit($empnum) && strlen($empnum) === 6 && $empnum!=="000000"){
                $data = [
                    'emp_no'=>$this->input->post('emp_noAdd'),
                    'name' => $this->input->post('nameAdd'),
                    'position'=> $this->input->post('positionAdd'),
                    'empStatus'=>$this->input->post('empStatusAdd'),
                ];
               $inserted= $this->User_model->add_user($data);
               if($inserted){
                redirect('/dashboard');
               }
            }else{
                $this->session->set_userdata([
                    'error' => "Invalid Employee number format. 6 numeric digits required." ,
                ]);
                redirect('/dashboard');
            }
        } catch (PDOException $e) {
            $this->session->set_userdata([
                'error' =>  str_contains( $e->getMessage(),'Duplicate entry') ? "User already exist with the employee number" : $e->getMessage() ,
            ]);
            redirect('/dashboard');
        }
    }
    public function update_attendence(){
        try {
            $empnum =$this->input->post('empnum');
        if (ctype_digit($empnum) && strlen($empnum) === 6 && $empnum!=="000000") {
            $updated="";
            $results=$this->User_model->get_user_by_id($empnum);

            if(is_null($results['signed_in']) && is_null($results['signed_out']) && $results['attendance']=='absent'){
                $updated= $this->User_model->update_signInRegister($empnum);
                if($updated){
                $this->session->set_userdata([
                    'sign_success' => "You have signed in succesfully for today",
                ]);
                }
            }

            if(!is_null($results['signed_in']) && !is_null($results['signed_out']) && $results['attendance']=='absent'){
                $updated= $this->User_model->update_signInRegister($empnum);
                if($updated){
                $this->session->set_userdata([
                    'sign_success' => "You have signed in succesfully for today",
                ]);
                }
            }
            if(!is_null($results['signed_in']) && !is_null($results['signed_out']) && $results['attendance']=='present'){
                $updated= $this->User_model->update_signOutRegister($empnum);
                if($updated){
                $this->session->set_userdata([
                    'sign_success' => "Thank you for your attendence today",
                ]);
                }
            }

            if(!is_null($results['signed_in']) && is_null($results['signed_out']) && $results['attendance']=='present'){
                $updated= $this->User_model->update_signOutRegister($empnum);
                if($updated){
                $this->session->set_userdata([
                    'sign_success' => "Thank you for your attendence today",
                ]);
                }
            }
          
            redirect(base_url());
        } else {
            throw new InvalidArgumentException("Employee number must be exactly 6 digits and numeric.");
        }    
        } catch (\Throwable $th) {
            $this->session->set_userdata([
                'sign_error' => $th->getMessage() ,
            ]);
            redirect(base_url());
        }catch(PDOException $e){
            $this->session->set_userdata([
                'sign_error' => $e->getMessage() ,
            ]);
            redirect(base_url());
        }
    }

    public function update_user() {
        $data = [
            'id'=>$this->input->post('userid'),
            'emp_no'=>$this->input->post('emp_no'),
            'name' => $this->input->post('name'),
            'position'=> $this->input->post('position'),
            'empStatus'=>$this->input->post('empStatus'),
        ];
       $this->User_model->update_user($data);
       redirect('/dashboard');
    }

    public function open_delete_user() {
        $userId = $this->input->post('userid');
        echo json_encode( $userId);
    }

    public function delete_user() {
        $userId = $this->input->post('usef');
        $this->User_model->delete_user($userId);
        redirect('/dashboard');
    }
}

?>
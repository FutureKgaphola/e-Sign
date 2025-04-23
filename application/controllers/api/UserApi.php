<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserApi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        $users = $this->User_model->get_all_users();

        if ($users) {
            $this->_json(['status' => 'success', 'data' => $users]);
        } else {
            $this->_json(['status' => 'error', 'message' => 'No users found'], 404);
        }
    }

    public function show($id = null)
    {
        if (!$id) {
            show_404();
        }

        $user = $this->User_model->get_user_by_id($id);

        if ($user) {
            $this->_json(['status' => 'success', 'data' => $user]);
        } else {
            $this->_json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }

    private function _json($data, $status = 200)
    {
        $this->output
            ->set_status_header($status)
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}

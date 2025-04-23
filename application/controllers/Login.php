<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function submit()
    {

        $email = $this->input->post('email', TRUE); // XSS filtering
        $password = $this->input->post('password', TRUE);
        echo  $email .$password ;
        // Example logic
        if ($email === 'admin@example.com' && $password === 'secret') {
            // echo json_encode([
            //     'success' => true,
            //     'message' => 'Welcome back!'
            // ]);
            // echo 'trying to load dashboard';
            $this->load->view('pages/admin/dashboard');
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid credentials.'
            ]);
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/RestController.php');

class Auth extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function login_post()
    {
        if (auth_check()) {
            $data = array(
                'result' => 1
            );
            $this->custom_response($data, 200);
        }
        //validate inputs
        $this->form_validation->set_rules('email', trans("email_address"), 'required|xss_clean|max_length[100]');
        $this->form_validation->set_rules('password', trans("password"), 'required|xss_clean|max_length[30]');
        
        $this->run_validation();
        
        if ($this->auth_model->login()) {
            $data = array(
                'result' => 1
            );
            $this->custom_response($data, 200);
        } else {
            $data = array(
                'result' => 0,
                'message' => 'Wrong email or password'
            );
            $this->custom_response($data, 422);
        }
    }

    public function logout_post() {
        $this->auth_model->logout();
        $this->custom_response(null, 200);
    }

    public function register_post() {
        //validate inputs
        $this->form_validation->set_rules('username', trans("username"), 'required|xss_clean|min_length[4]|max_length[100]');
        $this->form_validation->set_rules('email', trans("email_address"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('password', trans("password"), 'required|xss_clean|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('confirm_password', trans("password_confirm"), 'required|xss_clean|matches[password]');

        $this->run_validation();

        $email = $this->input->post('email', true);
        $username = $this->input->post('username', true);

        //is email unique
        if (!$this->auth_model->is_unique_email($email)) {
            $this->custom_response(null, 409, trans("msg_email_unique_error"));
        }
        //is username unique
        if (!$this->auth_model->is_unique_username($username)) {
            $this->custom_response(null, 409, trans("msg_username_unique_error"));
        }
        //register
        $user_id = $this->auth_model->register();
        if ($user_id) {
            $user = get_user($user_id);
            //update slug
            $this->auth_model->update_slug($user->id);
            if ($this->general_settings->email_verification != 1) {
                $this->auth_model->login_direct($user);
                $this->custom_response($user, 201);
            }
        } else {
            $this->custom_response(null, 409, trans("msg_error"));
        }
    }
}
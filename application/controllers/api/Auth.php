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
            echo json_encode($data);
            exit();
        }
        //validate inputs
        $this->form_validation->set_rules('email', trans("email_address"), 'required|xss_clean|max_length[100]');
        $this->form_validation->set_rules('password', trans("password"), 'required|xss_clean|max_length[30]');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            $this->load->view('partials/_messages');
        } else {
            if ($this->auth_model->login()) {
                $data = array(
                    'result' => 1
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'result' => 0,
                    'error_message' => $this->load->view('partials/_messages', '', true)
                );
                echo json_encode($data);
            }
            reset_flash_data();
        }
    }

    public function logout_post() {
        $this->auth_model->logout();
        echo "logouted";
    }

    public function my_get() {
        $this->response([
            'user' => $this->session->get_userdata()
        ],200);
    }
}
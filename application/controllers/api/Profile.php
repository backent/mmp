<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/RestController.php');

class Profile extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function my_get() {
        $this->auth_api();
    	$this->custom_response(user(), 200);
    }

    public function profile_get($slug) {
        $data = $this->auth_model->get_user_by_slug($slug);
        if (!isset($data)) {
	        $this->custom_response(null, 404);
        }
        $this->custom_response($data, 200);
    }

}
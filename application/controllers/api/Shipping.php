<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/RestController.php');


class Shipping extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth_api();
        $this->cart_model->calculate_cart_total();
    }

    public function index_get() {
        $shipping_address = $this->cart_model->get_sess_cart_shipping_address();
        $shipping_items = $this->cart_model->get_sess_cart_shipping_items();
        $this->custom_response([
            "shipping_address" => $shipping_address,
            "shipping_items" => $shipping_items
        ], 200);
    }


    // require:
    //     - product_id
    //     - product_quantity
    // optional:
    //     - variation_option_ids[]

    public function add_post() {

        $this->form_validation->set_rules('shipping_city_id', "shipping_city_id", 'required|xss_clean|max_length[4]');

        $this->run_validation();

        $shipping_address = $this->cart_model->set_sess_cart_shipping_address();
        $shipping_items = $this->cart_model->set_sess_cart_shipping_items();

        $this->custom_response(null, 200);
    }


}
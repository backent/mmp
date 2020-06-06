<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/RestController.php');


class Order extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth_api();
    }

    public function index_get() {
        $params = $this->get_params();

        $skip = array_key_exists('skip', $params) ? $params['skip'] : 0;
        $limit = array_key_exists('limit', $params) ? $params['limit'] : 5;
        $id = array_key_exists('id', $params) ? $params['id'] : null;


        if ($id !== null) {
            $this->db->where('buyer_id', user()->id);
            $data = $this->order_model->get_order($id);
        } else {
            $data = $this->order_model->get_paginated_orders(user()->id, $limit, $skip);
        }

        $this->custom_response($data, 200);

    }

    public function checkout_post() {
        $order_id = $this->order_model->add_order_offline_payment("Bank Transfer");
        $order = $this->order_model->get_order($order_id);
        if (!empty($order)) {
            //decrease product quantity after sale
            // $this->order_model->decrease_product_quantity_after_sale($order);
            //send email
            if ($this->general_settings->send_email_buyer_purchase == 1) {
                $email_data = array(
                    'email_type' => 'new_order',
                    'order_id' => $order_id
                );
                $this->session->set_userdata('mds_send_email_data', json_encode($email_data));
            }
            $this->cart_model->unset_sess_cart_shipping_items();
            $this->custom_response($order, 200);

        } else {
            $this->custom_response(null, 500);
        }


    }

    


}
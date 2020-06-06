<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/RestController.php');


class Cart extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth_api();
        $this->cart_model->calculate_cart_total();
    }

    public function list_get() {
    	$items = $this->cart_model->get_sess_cart_items();
        $total = $this->cart_model->get_sess_cart_total();
    	$this->custom_response([
            "items" => $items,
            "total" => $total,
            "shipping_address" => $this->cart_model->get_sess_cart_shipping_address()


        ], 200);
    }


    // require:
    //     - product_id
    //     - product_quantity
    // optional:
    //     - variation_option_ids[]

    public function add_post() {

    	$this->form_validation->set_rules('product_id', "Product", 'required|xss_clean');
        $this->form_validation->set_rules('product_quantity', "Quantity", 'required|xss_clean');

        $this->run_validation();

    	$product_id = $this->input->post('product_id', true);
		$product = $this->product_model->get_product_by_id($product_id);
        $variation_ids = $this->input->post('variation_ids', true);

		if (!empty($product)) {

			if ($product->status != 1) {
                $this->custom_response(null, 200, trans("msg_error_cart_unapproved_products"));
			} else {

				$result = $this->cart_model->api_add_to_cart($product);
				if ($result === false) {
                    $this->custom_response(null, 200, "Out of Stock!");
				}
					$this->custom_response($result, 200);
			}

		}
		else {
            $this->custom_response(null, 404);
		}
    }

    
    public function remove_delete($id) {
    	$cart = $this->cart_model->get_sess_cart_items();
        $selected_item = null;
        foreach ($cart as $key => $item) {
            if ($item->cart_item_id == $id) {
                $selected_item = $item;
                break;                
            }
        }

        if (!isset($selected_item)) {
            $this->custom_response(null, 404);
        }

        $cart = array_filter($cart, function($item) use ($id) {
            return $item->cart_item_id !== $id;
        });

        $cart = array_values($cart);
        $this->session->set_userdata('mds_shopping_cart', $cart);

        $this->custom_response($cart, 200);


    }



}
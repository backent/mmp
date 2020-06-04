<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/RestController.php');


class Product extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }


    public function products_get() {
    	$data = [];
    	$data[] = $this->product_model->get_products();
    	$this->response($data, 200);

    }

}
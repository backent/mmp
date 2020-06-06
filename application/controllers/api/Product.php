<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/RestController.php');


class Product extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }


    public function product_get() {
        $params = $this->get_params();
        
        $skip = array_key_exists('skip', $params) ? $params['skip'] : 0;
        $limit = array_key_exists('limit', $params) ? $params['limit'] : 5;
        $category = array_key_exists('category', $params) ? $params['category'] : null;
        $id = array_key_exists('id', $params) ? $params['id'] : null;
        if (!isset($id)) {
            $this->db->limit($limit);
            $this->db->offset($skip);
        }

        //get data

        if (isset($id)) {
            $data = $this->product_model->get_product_by_id($id);
        }
        elseif (isset($category)) {
            $data = $this->product_model->get_products_by_categories($category);
        } else {
    	   $data = $this->product_model->get_products();
        }


        //get variation
        if (gettype($data) == 'object') {
            $data = $this->product_model->with_variation($data); 
            $data = $this->product_model->with_images($data); 
        } elseif (gettype($data) == 'array') {
            $data = array_map(function($item){
                return $this->product_model->with_variation($item);
            }, $data);

            $data = array_map(function($item){
                return $this->product_model->with_images($item);
            }, $data);

        }

    	$this->custom_response($data, 200);

    }


    // public function product_post() {
    //    $this->load->model('upload_model');
    //     $temp_path = $this->upload_model->upload_temp_image('file');
    //     var_dump($temp_path);
    //     exit;
    // }

}
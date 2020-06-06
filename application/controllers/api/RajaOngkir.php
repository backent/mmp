<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/RestController.php');

class RajaOngkir extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get($type)
    {
        $params = $this->get_params();
        $province = array_key_exists('province', $params) ? $params['province'] : null;
        if ($type == 'province') {
            $provinces_json = __CURL_RAJA_ONGKIR('GET', '/province');
            $data = json_decode($provinces_json, true)['rajaongkir']['results'];
            $this->custom_response($data, 200);
        } elseif ($type == 'city') {
            $city_json = __CURL_RAJA_ONGKIR('GET', '/city?province=' . $province);
            $data = json_decode($city_json, true)['rajaongkir']['results'];
            $this->custom_response($data, 200);
        } else {
            $this->custom_response(null, 404);
        }


    }

    public function post_post() {
        
    }

}
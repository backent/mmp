<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_controller extends Home_Core_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function sample()
	{

		$data['title'] = 'Ccc';
		$data['description'] = 'Ddd';
		$data['keywords'] = 'Eee';
		$data["site_settings"] = get_site_settings();

		$this->load->view('partials/_header', $data);
		$this->load->view('test/test');
		$this->load->view('partials/_footer');
	}

	public function detail($id)
	{
		echo "tes";
		echo $id;
		die();
	}


}

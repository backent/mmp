<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_admin_controller extends Admin_Core_Controller
{
	public function __construct()
	{
		parent::__construct();
		//check user
		if (!is_admin()) {
			redirect(admin_url() . 'login');
		}
	}


	/**
	 * Test
	 */
	// public function tests_old()
	// {
	// 	$data['title'] = trans("tests");
	// 	$data['tests'] = $this->test_model->get_tests_all();
	// 	$data['admin_settings'] = get_admin_settings();

	// 	$this->load->view('admin/includes/_header', $data);
	// 	$this->load->view('admin/test/tests', $data);
	// 	$this->load->view('admin/includes/_footer');
	// }

	public function tests()
  {
      $data['title'] = trans("tests");
      $data['form_action'] = admin_url() . "tests";
      $data['list_type'] = "tests";
      //get paginated tests
      $pagination = $this->paginate(admin_url() . 'tests', $this->test_model->get_paginated_tests_count('tests'));
      $data['tests'] = $this->test_model->get_paginated_tests($pagination['per_page'], $pagination['offset']);
      $data['admin_settings'] = get_admin_settings();

      $this->load->view('admin/includes/_header', $data);
      $this->load->view('admin/test/tests', $data);
      $this->load->view('admin/includes/_footer');
  }

	/**
	 * Add Test
	 */
	public function add_test()
	{
		$data['title'] = trans("add_test");
		$data['admin_settings'] = get_admin_settings();
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/test/add_test', $data);
		$this->load->view('admin/includes/_footer');
	}


	/**
	 * Add Test Post
	 */
	public function add_test_post()
	{
		if ($this->test_model->add_test()) {
			//last id
			$last_id = $this->db->insert_id();

			$this->session->set_flashdata('success_form', trans("msg_test_added"));
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('form_data', $this->test_model->input_values());
			$this->session->set_flashdata('error_form', trans("msg_error"));
			redirect($this->agent->referrer());
		}
	}


	/**
	 * Update Test
	 */
	public function update_test($id)
	{
		$data['title'] = trans("update_test");
		$data['admin_settings'] = get_admin_settings();
		//get test
		$data['test'] = $this->test_model->get_test($id);
		if (empty($data['test'])) {
			redirect($this->agent->referrer());
		}

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/test/update_test', $data);
		$this->load->view('admin/includes/_footer');
	}


	/**
	 * Update Test Post
	 */
	public function update_test_post()
	{
		//test id
		$id = $this->input->post('id', true);

		$this->test_model->update_test($id);
		redirect(admin_url() . 'tests');
	}


	/**
	 * Delete Test Post
	 */
	public function delete_test_post()
	{
		$id = $this->input->post('id', true);
		$this->test_model->delete_test($id);
	}

	//get tests by language
	public function get_tests_by_lang()
	{
		$lang_id = $this->input->post('lang_id', true);
		if (!empty($lang_id)):
			$tests = $this->test_model->get_tests_by_lang($lang_id);
			foreach ($tests as $item) {
				echo '<option value="' . $item->id . '">' . $item->name . '</option>';
			}
		endif;
	}

	/**
   * Delete Selected Products
   */
  public function delete_selected_tests()
  {
      $test_ids = $this->input->post('test_ids', true);
      $this->test_model->delete_multi_tests($test_ids);

      //reset cache
      reset_cache_data_on_change();
  }

	// //get subtests
	// public function get_subtests()
	// {
	// 	$parent_id = $this->input->post('parent_id', true);
	// 	$subtests = $this->test_model->get_subtests_by_parent_id($parent_id);
	// 	foreach ($subtests as $item) {
	// 		echo '<option value="' . $item->id . '">' . $item->name . '</option>';
	// 	}
	// }


	/*
	*-------------------------------------------------------------------------------------------------
	* CUSTOM FIELDS
	*-------------------------------------------------------------------------------------------------
	*/

	/**
	 * Add Custom Field
	 */
	// public function add_custom_field()
	// {
	// 	$data['title'] = trans("add_custom_field");
	// 	$data['tests'] = $this->test_model->get_parent_tests();
	// 	$data['admin_settings'] = get_admin_settings();

	// 	$this->load->view('admin/includes/_header', $data);
	// 	$this->load->view('admin/test/add_custom_field', $data);
	// 	$this->load->view('admin/includes/_footer');
	// }


	/**
	 * Add Custom Field Post
	 */
	// public function add_custom_field_post()
	// {
	// 	if ($this->field_model->add_field()) {
	// 		//last id
	// 		$last_id = $this->db->insert_id();
	// 		//add field name
	// 		$this->field_model->add_field_name($last_id);
	// 		redirect(admin_url() . 'custom-field-options/' . $last_id);
	// 	} else {
	// 		$this->session->set_flashdata('form_data', $this->field_model->input_values());
	// 		$this->session->set_flashdata('error', trans("msg_error"));
	// 		redirect($this->agent->referrer());
	// 	}
	// }


	/**
	 * Update Custom Field
	 */
	// public function update_custom_field($id)
	// {
	// 	$data['title'] = trans("update_custom_field");
	// 	//get field
	// 	$data['field'] = $this->field_model->get_field($id);
	// 	$data['admin_settings'] = get_admin_settings();
	// 	if (empty($data['field'])) {
	// 		redirect(admin_url() . "custom-fields");
	// 	}
	// 	$data['tests'] = $this->test_model->get_parent_tests();
	// 	$data['field_tests'] = $this->field_model->get_field_tests($data['field']->id);

	// 	$this->load->view('admin/includes/_header', $data);
	// 	$this->load->view('admin/test/update_custom_field', $data);
	// 	$this->load->view('admin/includes/_footer');
	// }


	/**
	 * Update Custom Field Post
	 */
	// public function update_custom_field_post()
	// {
	// 	//field id
	// 	$id = $this->input->post('id', true);
	// 	if ($this->field_model->update_field($id)) {
	// 		//update field name
	// 		$this->field_model->update_field_name($id);
	// 		$this->session->set_flashdata('success', trans("msg_updated"));
	// 		redirect($this->agent->referrer());
	// 	} else {
	// 		$this->session->set_flashdata('error', trans("msg_error"));
	// 		redirect($this->agent->referrer());
	// 	}
	// }


	/**
	 * Custom Fields
	 */
	// public function custom_fields()
	// {
	// 	$data['title'] = trans("custom_fields");
	// 	$data['fields'] = $this->field_model->get_fields();
	// 	$data['admin_settings'] = get_admin_settings();

	// 	$this->load->view('admin/includes/_header', $data);
	// 	$this->load->view('admin/test/custom_fields', $data);
	// 	$this->load->view('admin/includes/_footer');
	// }

	/**
	 * Delete Custom Field Post
	 */
	// public function delete_custom_field_post()
	// {
	// 	$id = $this->input->post('id', true);
	// 	if ($this->field_model->delete_field($id)) {
	// 		$this->session->set_flashdata('success', trans("msg_custom_field_deleted"));
	// 	} else {
	// 		$this->session->set_flashdata('error', trans("msg_error"));
	// 	}
	// }

	/**
	 * Add Remove Custom Fields Filters
	 */
	// public function add_remove_custom_field_filters_post()
	// {
	// 	$id = $this->input->post('id', true);
	// 	if ($this->field_model->add_remove_custom_field_filters($id)) {
	// 		$this->session->set_flashdata('success', trans("msg_updated"));
	// 	} else {
	// 		$this->session->set_flashdata('error', trans("msg_error"));
	// 	}
	// 	redirect($this->agent->referrer());
	// }

	/**
	 * Custom Field Options
	 */
	// public function custom_field_options($id)
	// {
	// 	$data['title'] = trans("add_custom_field");
	// 	//get field
	// 	$data['field'] = $this->field_model->get_field($id);

	// 	if (empty($data['field'])) {
	// 		redirect(admin_url() . 'custom-fields');
	// 	}

	// 	$data['field_name'] = $this->field_model->get_field_name_by_lang($id, $this->selected_lang->id);
	// 	$data['parent_tests'] = $this->test_model->get_parent_tests();
	// 	$data['options'] = $this->field_model->get_field_all_options($id);
	// 	$data['field_tests'] = $this->field_model->get_field_tests($id);

	// 	$this->load->view('admin/includes/_header', $data);
	// 	$this->load->view('admin/test/custom_field_options', $data);
	// 	$this->load->view('admin/includes/_footer');
	// }

	//add custom field optiom
	// public function add_custom_field_option_post()
	// {
	// 	$field_id = $this->input->post("field_id");
	// 	$this->field_model->add_field_option($field_id);
	// 	redirect($this->agent->referrer());
	// }

	/**
	 * Update Custom Field Option Post
	 */
	// public function update_custom_field_option_post()
	// {
	// 	$this->field_model->update_field_options();
	// 	redirect($this->agent->referrer());
	// }

	//delete custom field optiom
	// public function delete_custom_field_option()
	// {
	// 	$common_id = $this->input->post("common_id");
	// 	$this->field_model->delete_custom_field_option($common_id);
	// }

	//add test to custom field
	// public function add_test_to_custom_field()
	// {
	// 	$this->field_model->add_test_to_field();
	// 	redirect($this->agent->referrer());
	// }

	//delete test from a custom field
	// public function delete_custom_field_test()
	// {
	// 	$field_id = $this->input->post("field_id");
	// 	$test_id = $this->input->post("test_id");
	// 	$this->field_model->delete_test_from_field($field_id, $test_id);
	// 	redirect($this->agent->referrer());
	// }
}

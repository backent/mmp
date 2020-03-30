<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends CI_Model
{
	//input values
	public function input_values()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'created_at' => date('Y-m-d H:i:s')
		);

		return $data;
	}

	//add test
	public function add_test()
	{
		$data = $this->input_values();
		return $this->db->insert('tests', $data);
	}

	//update test
	public function update_test($id)
	{
		$id = clean_number($id);
		$data = $this->input_values();
		$this->db->where('id', $id);
		return $this->db->update('tests', $data);
	}

	//delete test
	public function delete_test($id)
	{
		$id = clean_number($id);
		return $this->db->delete('tests', array('id' => $id));
	}

	//delete multi test
	public function delete_multi_tests($product_ids)
	{
		if (!empty($product_ids)) {
			foreach ($product_ids as $id) {
				$this->delete_test($id);
			}
		}
	}

	//get test
	public function get_test($id)
	{
		$id = clean_number($id);
		$this->db->where('id', $id);
		$query = $this->db->get('tests');
		return $query->row();
	}


	//get all tests
	public function get_tests_all()
	{
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get('tests');
		return $query->result();
	}

	//filter by values
	public function filter_tests()
	{
		$data['q'] = trim($this->input->get('q', true));
		$this->db->like('tests.name', $data['q']);
	}

	//get paginated tests count
	public function get_paginated_tests_count()
	{
		$this->filter_tests();
		$query = $this->db->get('tests');
		return $query->num_rows();
	}

	//get paginated tests
	public function get_paginated_tests($per_page, $offset)
	{
		$this->filter_tests();
		$this->db->limit($per_page, $offset);
		$query = $this->db->get('tests');
		return $query->result();
	}

	//get all tests ordered by name
	public function get_tests_ordered_by_name()
	{
		$this->db->join('tests_lang', 'tests_lang.test_id = tests.id');
		$this->db->select('tests.*, tests_lang.lang_id as lang_id, tests_lang.name as name, tests.parent_id as join_parent_id, (SELECT slug From tests WHERE id = join_parent_id) as parent_slug');
		$this->db->where('tests_lang.lang_id', $this->selected_lang->id);
		$this->db->order_by('tests_lang.name');
		$query = $this->db->get('tests');
		return $query->result();
	}


}

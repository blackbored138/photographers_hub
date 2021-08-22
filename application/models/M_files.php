<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_files extends CI_Model {

	public function add_zip_file($data){
		$this->db->insert('ci_zip_files', $data);
		return $this->db->affected_rows();

	}
}
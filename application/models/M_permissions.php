<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permissions extends CI_Model {

   

	public function get_users_list($client_id = 0){
		$multiplewhere = array(
		'users.user_status' => 1,
		'users.user_type !=' => 1,
		'user_types.status' => 1
		);
		
	 	if($client_id > 0)
			$multiplewhere = array('module_access.user_id' => $client_id,'module_access.status' => 1);

		$this->db->select('users.user_name,users.user_email,users.user_id,user_types.user_type');
		$this->db->where($multiplewhere);
		$this->db->join('user_types','user_types.ut_id = users.user_type','left');
		return $this->db->get('users')->result();
	}

	public function all_modules(){
		$multiplewhere = array(
		'modules.status' => 1
		);
		
	 	
		$this->db->select('modules.module_id,modules.module_name,modules.module_url');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		return $this->db->get('modules')->result();
	}
    
	public function modules_allocated($user_id){
		$multiplewhere = array(
		'modules.status' => 1,
		'module_access.status' => 1,
		'module_access.user_id' => $user_id
		);
		
	 	
		$this->db->select('modules.module_id,modules.module_name,modules.module_url');
		$this->db->distinct();
		$this->db->join('module_access','module_access.module_id = modules.module_id','left');
		$this->db->where($multiplewhere);
		return $this->db->get('modules')->result();
	}
    
	public function list_modules_access($module_id,$user_id){
		$module_id = (int) magicfunction($module_id,'d');
		$user_id = (int) magicfunction($user_id,'d');
		
		$multiplewhere = array(
		'module_access.module_id' => $module_id,
		'module_access.user_id' => $user_id
		);
		
	 	
		$this->db->select('module_access.status');
		$this->db->where($multiplewhere);
		return $this->db->get('module_access')->row();
	}

	public function check_module_access_exists($user_id,$module_id){
		$multiplewhere = array('module_access.module_id' => $module_id,'module_access.user_id' => $user_id);
		$this->db->select( 'status');
		$this->db->where($multiplewhere);
		return $this->db->get('module_access')->num_rows();
	}
    
	public function change_permission_status($data_insert,$status){
		
		$data = array('status' => $status );
		$multiplewhere = array('module_access.module_id' => $data_insert['module_id'],'module_access.user_id' => $data_insert['user_id']);
		$this->db->set($data);
		$this->db->where($multiplewhere);
		$this->db->update('module_access');
		return $this->db->affected_rows();

	}

	public function insert_module_permission($data){
		$this->db->insert('module_access', $data);
		return $this->db->affected_rows();

	}
}
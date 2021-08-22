<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

    public function save_registration($data){
        $this->db->insert('users',$data);		
        return $this->db->affected_rows();
    }    

    public function add_user_log($data){
        $this->db->insert('user_logs',$data);		
        return $this->db->affected_rows();
    }       
    
    public function login($user, $pass) {
		$this->db->select('user_id,user_name, user_email,
         user_mobile, user_token, user_photo, user_type');
		$this->db->from('users');	
		$this->db->where('users.user_name', $user);
		$this->db->where('users.user_password', md5($pass));
		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}


	public function get_login_history($user_id,$login_date = 0){
		$multiplewhere = array(
			'user_logs.user_id' => $user_id
			);
			if (strtotime($login_date) !== false)
				$multiplewhere['DATE(user_logs.login_time)'] = $login_date;

			$this->db->select('user_logs.*');
			$this->db->where($multiplewhere);
			return $this->db->get('user_logs')->result_array();
	}
	/* ***********************************
	 * 
	 * Start of Password Section
	 * 
	 * ***********************************/
	public function check_password($password,$user_id){
		$result = $this->db->get_where('users', array('user_id' => $user_id,'user_password' => $password,'user_status' => '1'));

    	if($result->num_rows() > 0){
    		$result = $result->row_array();
    		return true;
    	}
    	else {
    		return false;
    	}
    }

	public function update_password($password,$id){
        $this->db->set('user_password', $password); 
        $this->db->where('user_id', $id);
        $result = $this->db->update('users');
		return $this->db->affected_rows();

    }

	public function update_profile($data,$id){
        $this->db->where('user_id', $id);
        $result = $this->db->update('users',$data);
		return $this->db->affected_rows();

    }

	public function update_photo($image,$id){
        $this->db->set('user_photo',$image);
		$this->db->where('user_id', $id);
		$this->db->update('users');
		return $this->db->affected_rows();

    }

	
	/* ***********************************
	 * 
	 * End of Password Section
	 * 
	 * ***********************************/


	public function modules_allocated($user_id = 0){
		$multiplewhere = array(
		'modules.status' => 1
		);
		
	 	if($user_id > 0)
			$multiplewhere = array('module_access.user_id' => $user_id,'module_access.status' => 1);

		$this->db->select('modules.module_name,modules.module_url');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		$this->db->join('modules','modules.module_id = module_access.module_id','left');
		return $this->db->get('module_access')->result();
	}

	public function all_modules(){
		$multiplewhere = array(
		'modules.status' => 1
		);
		
	 	
		$this->db->select('modules.module_name,modules.module_url');
		$this->db->distinct();
		$this->db->where($multiplewhere);
		return $this->db->get('modules')->result();
	}
    
}
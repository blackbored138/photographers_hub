<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_feedbacks extends CI_Model {

   

	public function get_feedbacks_by_type($feedback_type = 0){
		$multiplewhere = array(
		'ci_feedbacks.feedback_type' => $feedback_type,
		'ci_feedbacks.status' => 1
		);
		
	 	
		$this->db->select('ci_feedbacks.feedback_id,ci_feedbacks.feedback,ci_feedbacks.feedback_type,
		ci_feedbacks.created_at,ci_feedbacks.updated_at,
		ci_feedbacks_types.type_name,ci_feedback_labels.label_name,ci_feedback_labels.label_color');
		$this->db->where($multiplewhere);
		$this->db->join('ci_feedbacks_types','ci_feedbacks_types.type_id = ci_feedbacks.feedback_type','left');
		$this->db->join('ci_feedback_labels','ci_feedback_labels.label_id = ci_feedbacks.feedback_label','left');
		$this->db->order_by('ci_feedbacks.feedback_id','desc');
		return $this->db->get('ci_feedbacks')->result();
	}

	public function get_feedback_types($client_id = 0){
		$multiplewhere = array(
		'ci_feedbacks_types.status' => 1
		);
		
	 	
		$this->db->select('ci_feedbacks_types.type_id,ci_feedbacks_types.type_name,ci_feedbacks_types.type_color');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_feedbacks_types')->result();
	}

	public function get_feedback_labels($client_id = 0){
		$multiplewhere = array(
		'ci_feedback_labels.status' => 1
		);
		
	 	
		$this->db->select('ci_feedback_labels.label_id,ci_feedback_labels.label_name,ci_feedback_labels.label_color');
		$this->db->where($multiplewhere);
		return $this->db->get('ci_feedback_labels')->result();
	}


	public function add_backlog($data){
		$this->db->insert('ci_feedbacks',$data);	
        $last_id = $this->db->insert_id();
	
        return $last_id;
	}

	public function update_backlog($data,$id){
		$this->db->update('ci_feedbacks', $data, array('feedback_id' => $id));
		return $this->db->affected_rows();
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
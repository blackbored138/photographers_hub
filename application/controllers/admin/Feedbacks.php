<?php
defined('BASEPATH') or exit('No direct script access allowed');

class feedbacks extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');

        $this->load->model('M_users');
        $this->load->model('M_feedbacks');
    }

    public function index()
    {
        $data = $this->data;
        $data['feedback_types'] = $this->M_feedbacks->get_feedback_types();
        $data['feedback_labels'] = $this->M_feedbacks->get_feedback_labels();
        $this->template->views('admin/feedbacks/index', $data);
    }

    public function add_backlog()
    {
        $backlog = $this->input->post('backlog', TRUE);
        $user_id = (int) magicfunction($this->session->userdata('user_id'), 'd');
        $backlog_label = (int) magicfunction($this->input->post('backlog_label'), 'd');

        if ($user_id < 1) :
            $response['msg'] = 'User could not be identified';
            $response['status'] = 'error';
            echo json_encode($response);
            exit();
        endif;
        if ($backlog_label < 1) :
            $response['msg'] = 'Label could not be identified';
            $response['status'] = 'error';
            echo json_encode($response);
            exit();
        endif;

        if (strlen($backlog) < 1) :
            $response['msg'] = 'Please enter something to add';
            $response['status'] = 'error';
            echo json_encode($response);
            exit();
        endif;

        $data_insert = array(
            'feedback' => $backlog,
            'feedback_type' => 0,
            'feedback_label' => $backlog_label,
            'created_by' => $user_id,
            'created_at' => date("Y-m-d h:m:s"),
            'updated_at' => date("Y-m-d h:m:s"),
            'status' => 1,
        );
        $feedback_response = $this->M_feedbacks->add_backlog($data_insert);
        if ($feedback_response > 0) :
            $response['msg'] = 'Backlog added';
            $response['status'] = 'success';
            echo json_encode($response);
            exit();
        else :
            $response['msg'] = 'Backlog could not be added';
            $response['status'] = 'error';
            echo json_encode($response);
            exit();
        endif;
    }

    public function change_feedback_status()
    {
        $feedback_type = (int)magicfunction($this->input->post('f_type'), 'd');
        $feedback_id = (int)magicfunction($this->input->post('f_id'), 'd');
        
        if ($feedback_type < 1) :
            $response['msg'] = 'Feedback type could not be identified';
            $response['status'] = 'error';
            echo json_encode($response);
            exit();
        endif;
        if ($feedback_id < 1) :
            $response['msg'] = 'Feedback could not be identified';
            $response['status'] = 'error';
            echo json_encode($response);
            exit();
        endif;

        $data_update = array(
            'feedback_type' => $feedback_type,
            'updated_at' => date("Y-m-d h:m:s"),
            'status' => 1,
        );
        $feedback_response = $this->M_feedbacks->update_backlog($data_update,$feedback_id);
        
        if ($feedback_response > 0) :
            $response['msg'] = 'Backlog updated';
            $response['status'] = 'success';
            echo json_encode($response);
            exit();
        else :
            $response['msg'] = 'Backlog could not be updated';
            $response['status'] = 'error';
            echo json_encode($response);
            exit();
        endif;
    }


    public function list_backlogs()
    {
        $data = $this->data;

        $feedback_type = (int)magicfunction($this->input->post('feedback_type'), 'd');
        $data['feedback_types'] = $this->M_feedbacks->get_feedback_types();
        $data['backlog'] = $this->M_feedbacks->get_feedbacks_by_type($feedback_type);
        $this->load->view('admin/feedbacks/ajax/list_backlogs', $data);
    }


    public function update_profile()
    {
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|required|numeric');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'errors' => validation_errors()
            );
            $this->session->set_flashdata('errors', $data['errors']);
            redirect(base_url('profile'), 'refresh');
        }

        $old_password = $this->input->post('user_password', TRUE);
        $user_id = magicfunction(ss('user_id'), 'd');

        $password_exists = $this->M_users->check_password(md5($old_password), $user_id);

        if (!$password_exists) :
            $data = array(
                'errors' => "Entered Password is incorrect !"
            );
            $this->session->set_flashdata('errors', $data['errors']);
            redirect(base_url('profile'), 'refresh');
        endif;

        $data = array(
            'user_name' => $this->input->post('user_name', TRUE),
            'user_email' => $this->input->post('user_email', TRUE),
            'user_mobile' => $this->input->post('user_mobile', TRUE)
        );

        $changeProfile = $this->M_users->update_profile($data, $user_id);

        if ($changeProfile < 1) :
            $this->session->set_flashdata('errors', 'User details could not be changed,Please try again!');
            redirect(base_url('profile'));
        endif;

        $this->session->set_userdata($data);
        $this->session->set_flashdata('success', 'User details has been changed!');
        redirect(base_url('profile'));
    }


    public function change_password()
    {
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
        $this->form_validation->set_rules('retyped_password', 'Retyped Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'errors' => validation_errors()
            );
            $this->session->set_flashdata('errors', $data['errors']);
            redirect(base_url('profile'), 'refresh');
        }

        $old_password = $this->input->post('old_password', TRUE);
        $user_id = magicfunction(ss('user_id'), 'd');

        $password_exists = $this->M_users->check_password(md5($old_password), $user_id);

        if (!$password_exists) :
            $data = array(
                'errors' => "Entered Password is not your last password !"
            );
            $this->session->set_flashdata('errors', $data['errors']);
            redirect(base_url('profile'), 'refresh');
        endif;

        $new_password = $this->input->post('new_password', TRUE);
        $retyped_password = $this->input->post('retyped_password', TRUE);

        if ($new_password != $retyped_password) :
            $data = array(
                'errors' => "Old Password and Retyped Passwords doesnt match !"
            );
            $this->session->set_flashdata('errors', $data['errors']);
            redirect(base_url('profile'), 'refresh');
        endif;

        $changePassword = $this->M_users->update_password(md5($new_password), $user_id);

        if ($changePassword < 1) :
            $this->session->set_flashdata('errors', 'Password could not be changed,Please try again!');
            redirect(base_url('profile'));
        endif;

        $this->session->set_flashdata('success', 'Password has been changed!');
        redirect(base_url('profile'));
    }


    public function login_history()
    {
        $user_id = (int) magicfunction($this->session->userdata('user_id'), 'd');
        if ($user_id > 0) :
            $login_history = $this->M_users->get_login_history($user_id);
            $i = 0;
            foreach ($login_history as $logs) :
                $records['logs'][$i]['date'] = date('Y-m-d', strtotime($logs['login_time']));
                $records['logs'][$i]['time'] = date('H:i', strtotime($logs['login_time']));
                $records['logs'][$i]['login_ip'] = $logs['login_ip'];
                $records['logs'][$i]['login_device'] = $logs['login_device'];
                $records['logs'][$i]['login_os'] = $logs['login_os'];
                $records['logs'][$i]['login_browser'] = $logs['login_browser'];
                $i++;
            endforeach;
            $records['length'] = sizeof($login_history);
            echo json_encode($records);
        endif;
    }





    /***********
     * 
     * 
     * Feedbacks Master CRUDs in GROCERY
     * 
     * 
     * *************/



     /*****************Feedback Labels******************************/
     public function feedback_labels(){
        $added_by =  magicfunction($this->session->userdata('user_id'),'d');
        $timestamp =  date("Y-m-d H:m:s");

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap-v4');

        $crud->set_table('ci_feedback_labels');       
        $crud->set_subject('Feedback Labels ');
        $crud->set_relation('status','status','status');
        $crud->field_type('created_by', 'hidden', $added_by);
        $crud->field_type('created_at', 'hidden',$timestamp);
        $crud->field_type('updated_at', 'hidden',$timestamp);
        $crud->columns('label_name','label_color');

        
       
      
        $crud->callback_delete(array($this,'feedback_label_log_before_delete'));
        

        $crud->unset_clone(); 
        $output = $crud->render();
        $this->feedback_label_example_output($output);
     }

     public function feedback_label_example_output($output = null)
     {
        $output->modules_allocated = $this->data['modules_allocated'];
        $this->template->views('admin/feedbacks/labels_contents.php',(array)$output);
 
     }

     public function feedback_label_log_before_delete($primary_key)
	{
		$timestamp = date('Y-m-d h:m:s');
		$this->db->where('label_id',$primary_key);
		$data = $this->db->get('ci_feedback_labels')->row();
		$data->status = 3;
		$data->updated_at = $timestamp;

		if(empty($data))
			return false;
		
		$this->db->where('label_id', $primary_key);
   		$this->db->update('ci_feedback_labels', $data);

		return true;
	}

     /*****************Feedback Types******************************/

     public function feedback_types(){
        $added_by =  magicfunction($this->session->userdata('user_id'),'d');
        $timestamp =  date("Y-m-d H:m:s");

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap-v4');

        $crud->set_table('ci_feedbacks_types');       
        $crud->set_subject('Feedback Types ');
        $crud->set_relation('status','status','status');
        $crud->field_type('created_by', 'hidden', $added_by);
        $crud->field_type('created_at', 'hidden',$timestamp);
        $crud->field_type('updated_at', 'hidden',$timestamp);
        $crud->columns('type_name','type_color');

        
       
      
        $crud->callback_delete(array($this,'feedback_types_log_before_delete'));
        

        $crud->unset_clone(); 
        $output = $crud->render();
        $this->feedback_types_example_output($output);
     }

     public function feedback_types_example_output($output = null)
     {
        $output->modules_allocated = $this->data['modules_allocated'];
        $this->template->views('admin/feedbacks/types_contents.php',(array)$output);
 
     }

     public function feedback_types_log_before_delete($primary_key)
	{
		$timestamp = date('Y-m-d h:m:s');
		$this->db->where('type_id',$primary_key);
		$data = $this->db->get('ci_feedbacks_types')->row();
		$data->status = 3;
		$data->updated_at = $timestamp;

		if(empty($data))
			return false;
		
		$this->db->where('type_id', $primary_key);
   		$this->db->update('ci_feedbacks_types', $data);

		return true;
	}

         /*****************Feedback Status******************************/

         public function feedback_status(){
            $this->load->library('grocery_CRUD');
            $crud = new grocery_CRUD();
            $crud->set_theme('bootstrap-v4');
    
            $crud->set_table('ci_feedback_status');       
            $crud->set_subject('Feedback Status ');

            $crud->columns('f_status');
    
            
           
          
           // $crud->callback_delete(array($this,'feedback_status_log_before_delete'));
            
    
            $crud->unset_clone(); 
            $crud->unset_delete(); 
            $output = $crud->render();
            $this->feedback_status_example_output($output);
         }
    
         public function feedback_status_example_output($output = null)
         {
            $output->modules_allocated = $this->data['modules_allocated'];
            $this->template->views('admin/feedbacks/status_contents.php',(array)$output);
     
         }
    
        
}

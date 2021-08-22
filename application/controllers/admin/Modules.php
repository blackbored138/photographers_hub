<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class modules extends MY_Controller {

    function __construct()

    {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('captcha');
    $this->load->library('session');
    $this->load->model('M_permissions');
    }

    public function index(){
        $added_by =  magicfunction($this->session->userdata('user_id'),'d');
        $timestamp =  date("Y-m-d H:m:s");

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap-v4');

        $crud->set_table('modules');       
        $crud->set_subject('Modules ');
        $crud->set_relation('status','status','status');
        $crud->field_type('created_by', 'hidden', $added_by);
        $crud->field_type('created_at', 'hidden',$timestamp);
        $crud->field_type('updated_at', 'hidden',$timestamp);
        $crud->columns('module_name','module_url');

        
       
      
        $crud->callback_delete(array($this,'modules_log_before_delete'));
        

        $crud->unset_clone(); 
        $output = $crud->render();
        $this->modules_example_output($output);
      }

      public function modules_example_output($output = null)
      {
         $output->modules_allocated = $this->data['modules_allocated'];
         $this->template->views('admin/modules/modules_contents.php',(array)$output);
  
      }
 
      public function modules_log_before_delete($primary_key)
     {
         $timestamp = date('Y-m-d h:m:s');
         $this->db->where('module_id',$primary_key);
         $data = $this->db->get('modules')->row();
         $data->status = 3;
         $data->updated_at = $timestamp;
 
         if(empty($data))
             return false;
         
         $this->db->where('module_id', $primary_key);
            $this->db->update('modules', $data);
 
         return true;
     }

 

}
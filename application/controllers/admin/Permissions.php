<?php
defined('BASEPATH') or exit('No direct script access allowed');

class permissions extends MY_Controller
{

  function __construct()

  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('captcha');
    $this->load->library('session');
    $this->load->model('M_permissions');
  }

  public function index()
  {
    $data = $this->data;
    $this->template->views('admin/permissions/users_list', $data);
  }

  public function permission_json()
  {
    $user_id = (int) magicfunction($this->session->userdata('user_id'), 'd');


    $records['data'] = $this->M_permissions->get_users_list();
    $data = array();
    $i = 0;
    $j = 1;
    foreach ($records['data']   as $row) {
      $user_id = magicfunction($row->user_id, 'e');
      $data[] = array(
        ++$i,
        $row->user_name,
        $row->user_email,
        $row->user_type,
        '<a href="' . base_url() . 'list_permissions/' . $user_id . '" title="Add Permissions" class="btn btn-secondary"><i class="fas fa-th-list"></i></a>'

      );
    }
    $this->response(200, $data);
  }


  public function list_permissions($user_id)
  {
    $user_id = (int) magicfunction($user_id, 'd');

    if ($user_id > 1) :
      $data = $this->data;
      $data["menusList"] = $this->M_permissions->all_modules();
      $data["user_id"] = magicfunction($user_id,'e');

      $this->template->views('admin/permissions/permission_list', $data);
    endif;
  }

  public function change_module_permission(){
    $module_id = (int) magicfunction($this->input->post('module_id',TRUE),'d');
    $user_id = (int) magicfunction($this->input->post('user_id',TRUE),'d');
    $status = (int) $this->input->post('status',TRUE);

    if($module_id > 0 && $user_id > 0 && $status < 2):
    $check = $this->M_permissions->check_module_access_exists($user_id,$module_id);
    $data_insert = array(
      'module_id' => $module_id,
      'user_id' => $user_id,
      'status' => 1
    );

    if($check < 1){
        $result = $this->M_permissions->insert_module_permission($data_insert);
    }else{
        $result = $this->M_permissions->change_permission_status($data_insert,$status);
    }
    
    if($result > 0):
      $response['msg'] = 'Permission updated';
      $response['status'] = 'success';
      echo json_encode($response);
      exit();
    else:
      $response['msg'] = 'Something went wrong';
      $response['status'] = 'error';
      echo json_encode($response);
      exit();
    endif;

  endif;

  }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class profile extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');

        $this->load->model('M_users');
    }

    public function index()
    {
        $data = $this->data;
        $this->template->views('admin/profile/index', $data);
    }

    public function update_profile()
    {
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|required|numeric');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array( 'status' =>'error','msg' => validation_errors());
            echo json_encode($data); exit();
        }

        $old_password = $this->input->post('user_password', TRUE);
        $user_id = magicfunction(ss('user_id'), 'd');

        $password_exists = $this->M_users->check_password(md5($old_password), $user_id);

        if (!$password_exists) :
            $data = array( 'status' =>'error','msg' => 'Entered Password is incorrect !');
            echo json_encode($data); exit();
        endif;

        $data = array(
            'user_name' => $this->input->post('user_name', TRUE),
            'user_email' => $this->input->post('user_email', TRUE),
            'user_mobile' => $this->input->post('user_mobile', TRUE)
        );

        $changeProfile = $this->M_users->update_profile($data, $user_id);

        if ($changeProfile < 1) :
            $data = array( 'status' =>'error','msg' => 'User details could not be changed,Please try again !');
            echo json_encode($data); exit();
        endif;

        $this->session->set_userdata($data);
        $data = array( 'status' =>'success','msg' => 'User details has been changed !');
        echo json_encode($data); exit();
    }


    public function change_password()
    {
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
        $this->form_validation->set_rules('retyped_password', 'Retyped Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array( 'status' =>'error','msg' => validation_errors());
            echo json_encode($data); exit();
        }

        $old_password = $this->input->post('old_password', TRUE);
        $user_id = magicfunction(ss('user_id'), 'd');

        $password_exists = $this->M_users->check_password(md5($old_password), $user_id);

        if (!$password_exists) :
           $data = array( 'status' =>'error','msg' => 'Entered Password is not your last password !');
            echo json_encode($data); exit();
        endif;

        $new_password = $this->input->post('new_password', TRUE);
        $retyped_password = $this->input->post('retyped_password', TRUE);

        if ($new_password != $retyped_password) :
            $data = array( 'status' =>'error','msg' => 'New password and Retyped passwords doesnt match !');
            echo json_encode($data); exit();
        endif;

        $changePassword = $this->M_users->update_password(md5($new_password), $user_id);

        if ($changePassword < 1) :
            $data = array( 'status' =>'error','msg' => 'Password could not be changed,Please try again !');
            echo json_encode($data); exit();
        endif;

        $data = array( 'status' =>'success','msg' => 'Password has been changed !');
        echo json_encode($data); exit();
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

                if($i == 7) break;
            endforeach;
            //$records['length'] = sizeof($login_history);
            $records['length'] = $i;
            echo json_encode($records);
        endif;
    }

    public function list_logs()
    {
        $data = $this->data;

        $this->template->views('admin/profile/log_list', $data);
    }

    public function list_logs_json()
    {
        $user_id = (int) magicfunction($this->session->userdata('user_id'), 'd');

        if ($user_id > 0) :
            $login_date = $this->input->get('login_date');

        $records['data'] = $this->M_users->get_login_history($user_id,$login_date); //lq();
        $data = array();
        $i = 0;
        $j = 1;
        foreach ($records['data']   as $row) {

            $data[] = array(
                ++$i,
                date('Y-m-d ', strtotime($row['login_time'])) .' @ '. date('H:i ', strtotime($row['login_time'])),
                $row['login_os'],
                $row['login_browser'],
                $row['login_ip'],
                $row['login_device']
            );

        }
        $this->response(200,$data);
    endif;
    }

    public function update_profile_image(){
        $user_id = (int) magicfunction($this->session->userdata('user_id'), 'd');
		$data = $_POST['photo'];

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name = time().'.png';
        $up_response = file_put_contents('uploads/users/profile_images/'.$image_name, $data);

		$qry_response = $this->M_users->update_photo($image_name,$user_id);
        
        if($qry_response > 0):
            $this->session->set_userdata(array('user_photo' => $image_name));
		    $data = array( 'status' =>'success','msg' => 'Profile photo successfully uploaded !');
            echo json_encode($data); exit();
        endif;

        $data = array( 'status' =>'error','msg' => 'Profile photo could not be uploaded !');
        echo json_encode($data); exit();
    }
}

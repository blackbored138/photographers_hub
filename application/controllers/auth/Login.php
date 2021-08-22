<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
        $vals = array(
            'word'   => rand(1000, 9999),
            'img_path'      => './captcha/',
            'img_url'       => base_url() . '/captcha/',
            'word_length'   => 5,
            'img_width'     => '350',
            'img_height'    => 50,

            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(204, 204, 204),
                'grid' => array(51, 122, 184),
                'text' => array(0, 0, 0)
            )
        );


        $cap = create_captcha($vals);

        $data = array(
            'captcha_time'  => $cap['time'],
            'ip_address'    => $this->input->ip_address(),
            'word'          => $cap['word']
        );

        $data['captchaimage'] = $cap['image'];
        $this->session->set_flashdata('captcha_content', $data['word']);

        $this->load->view('auth/login', $data);
    }


    public function formValidation()
    {

    }

    public function login()
    {
        $this->form_validation->set_rules('user_name', 'Username', 'required|min_length[4]|max_length[15]');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('user_captcha', 'Captcha', 'required|min_length[4]|max_length[4]');

        if ($this->form_validation->run() == FALSE) :
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('login');
        endif;

        if ($this->input->post('device_type') == '' || $this->input->post('device_os') == '' || $this->input->post('device_browser') == '') :
            $this->session->set_flashdata('error_msg', 'Some data seems to be missing,Try again');
            redirect('login');
        endif;

        if (!$this->check_captcha_matches($this->input->post('user_captcha', TRUE))) :
            $this->session->set_flashdata('error_msg', 'Captchas doesnt match');
            redirect('login');
        endif;

        $username = trim($this->input->post('user_name', TRUE));
        $password = trim($this->input->post('user_password', TRUE));

        $data = $this->M_users->login($username, $password);

        
        if ($data == false) {
            $this->session->set_flashdata('error_msg', 'Username or Password is wrong.');
            redirect('login');
        }

        $log_data = array(
            'user_id'  => $data->user_id,
            'login_ip'    => $this->input->ip_address(),
            'login_time'  => date("Y-m-d h:m:s"),
            'login_device'  => $this->input->post('device_type', TRUE),
            'login_os'  => $this->input->post('device_os', TRUE),
            'login_browser'  => $this->input->post('device_browser', TRUE)
        );

        $log_info = $this->M_users->add_user_log($log_data);

        $token = rand(100000, 9999999);
        $tokenEnc = md5($token);
        $session = [
            'user_id' => magicfunction($data->user_id, 'e'),
            'user_type_display' => $data->user_type,
            'user_name' => $data->user_name,
            'user_photo' => $data->user_photo,
            'user_email' => $data->user_email,
            'user_mobile' => $data->user_mobile,
            'enc_token' => $tokenEnc,
            'userdata' => $data,
            'login_status' => "1"
        ];
        $this->session->set_userdata($session);
        redirect('adminhome?sec_token=' . $tokenEnc);
    }

    function check_captcha_matches($user_captcha)
    {
        $captcha = $this->session->flashdata('captcha_content');
        $captcha_verification = ($captcha == $user_captcha) ? true : false;
        return $captcha_verification;
    }

    public function refresh_captcha()
    {

        $vals = array(
            'word'   => rand(1000, 9999),
            'img_path'      => './captcha/',
            'img_url'       => base_url() . '/captcha/',
            'word_length'   => 5,
            'img_width'     => '350',
            'img_height'    => 50,

            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(204, 204, 204),
                'grid' => array(51, 122, 184),
                'text' => array(0, 0, 0)
            )
        );


        $cap = create_captcha($vals);
        $data = array(
            'captcha_time'  => $cap['time'],
            'ip_address'    => $this->input->ip_address(),
            'word'          => $cap['word']
        );

        $captchaimage = $cap['image'];
        $this->session->set_flashdata('captcha_content', $data['word']);

        echo $captchaimage;
    }



    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}

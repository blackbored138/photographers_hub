<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct()

    {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('captcha');
    $this->load->library('session');

    $this->load->model('M_users');

    }

    public function index(){
        $vals = array(
            'word'   => rand(1000,9999),
            'img_path'      => './captcha/',
            'img_url'       => base_url().'/captcha/',
            'word_length'   => 5,
            'img_width'     => '320',
            'img_height'    => 50,
    
            'colors'        => array(
                'background' => array(23, 162, 184),
                'border' => array(255, 255, 255),
                'grid' => array(23, 162, 184),
                'text' => array(255, 255, 255)
            )
        );
    
    
            $captcha = create_captcha($vals);
    
            $data = array(
                    'captcha_time'  => $captcha['time'],
                    'ip_address'    => $this->input->ip_address(),
                    'word'          => $captcha['word']
            );
    
            $data['captchaimage'] = $captcha['image'];
            $this->session->set_flashdata('captcha_content', $data['word']);

        $this->load->view('auth/register', $data);

    }

    public function register_user(){
        
        if(!$this->validate_register_form())
            redirect('register');

            $token = rand(100000,9999999);
			$tokenEnc = md5($token);
            $site_name = ($this->input->post('user_site_name') == '') ? 'empty': $this->input->post('user_site_name', TRUE);
        
            $data_insert = array(
            'user_name' => $this->input->post('user_name', TRUE),
            'user_password' => md5($this->input->post('user_password', TRUE)),
            'user_email' => $this->input->post('user_email', TRUE),
            'user_mobile' => $this->input->post('user_mobile', TRUE),
            'user_token' => $tokenEnc,
            'created_at' => date("Y-m-d h:m:s"),
            'updated_at' => date("Y-m-d h:m:s"),
            'approved_on' => date("Y-m-d h:m:s"),
            'user_status' => 1,
            'user_type' => 2,
            'user_photo' => 'avatar.png',
            'user_site_name' => $site_name
           
            );    

        $data_insert = $this->security->xss_clean($data_insert);
        $result = $this->M_users->save_registration($data_insert);

        if($result)
            echo 'Inserted';
        else
            echo 'Error';    

    }

    function validate_register_form(){

        $this->form_validation->set_rules('full_name', 'Full name', 'trim|required');
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|required|numeric');
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
        $this->form_validation->set_rules('user_retyped_password', 'Retyped Password', 'trim|required');
        $this->form_validation->set_rules('user_captcha', 'Captcha', 'trim|required|numeric');
        $this->form_validation->set_rules('user_site_name', 'Site name', 'trim');

            if ($this->form_validation->run() == FALSE):
                if($this->input->is_ajax_request()):
                    $message['status'] = '500';
                    $message['msg'] = validation_errors();
                    echo json_encode($message); exit();
                else:
                    $this->session->set_flashdata('error_msg', validation_errors());
                endif;
                return false;
            endif;

            $user_captcha = $this->input->post('user_captcha', TRUE);
            if(!$this->check_captcha_matches($user_captcha)):
                if($this->input->is_ajax_request()):
                    $message['status'] = '500';
                    $message['msg'] = 'Captchas doesnt match';
                    echo json_encode($message); exit();
                endif;    
            endif;

            $user_password = $this->input->post('user_password', TRUE);
            $user_retyped_password = $this->input->post('user_retyped_password', TRUE);
            if($user_password != $user_retyped_password):
                if($this->input->is_ajax_request()):
                    $message['status'] = '500';
                    $message['msg'] = 'Passwords doesnt match';
                    echo json_encode($message); exit();
            else:
                $this->session->set_flashdata('error_msg', 'Passwords doesnt match');
            endif;
            return false;
        endif;

        if($this->input->is_ajax_request()):
            $message['status'] = '200';
            $message['msg'] = 'Please wait ...';
            echo json_encode($message); exit();
        else:
            $this->session->set_flashdata('success_msg', 'Registered Successfully');
            return true;
        endif;

    }


    function check_captcha_matches($user_captcha){
       $captcha = $this->session->flashdata('captcha_content');
       $captcha_verification = ($captcha == $user_captcha)?true:false;
       return $captcha_verification;
    }


    public function refresh_captcha(){
        $vals = array(
            'word'   => rand(1000,9999),
            'img_path'      => './captcha/',
            'img_url'       => base_url().'/captcha/',
            'word_length'   => 5,
            'img_width'     => '320',
            'img_height'    => 50,
    
            'colors'        => array(
                'background' => array(23, 162, 184),
                'border' => array(255, 255, 255),
                'grid' => array(23, 162, 184),
                'text' => array(255, 255, 255)
            )
        );
    
    
            $captcha = create_captcha($vals);		
            $data = array(
                    'captcha_time'  => $captcha['time'],
                    'ip_address'    => $this->input->ip_address(),
                    'word'          => $captcha['word']
            );
    
            $captchaimage = $captcha['image'];
            $this->session->set_flashdata('captcha_content', $data['word']);
            echo $captchaimage;
    }


}
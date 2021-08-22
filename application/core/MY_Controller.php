<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

    class MY_Controller extends CI_Controller

    {
        function __construct()

        {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');

        auth_check();
        check_access();
        $this->load->model('M_users');
        $user_id = magicfunction(ss('user_id'),'d');
        $this->data['modules_allocated'] = (ss('user_type_display') == 1 ) ? 
                                            $this->M_users->all_modules() : 
                                            $this->M_users->modules_allocated($user_id);
         
        }


    function response($status,$data)
        {
            header("HTTP/1.1 ".$status);
            
            $response['status']=$status;
            $response['data']=$data;
            
            $json_response = json_encode($response);
            echo $json_response;
            exit();
        }

    }





    class HOME_Controller extends CI_Controller
{
    function __construct()

    {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');

    $this->load->model('M_clients');

    }

    function client_details($id = 0){
        $client_details = $this->M_clients->get_client_details($id);
        $this->data['theme'] = $theme = $client_details->theme_path;
        $this->data['client_details'] = $client_details;
        $this->data['theme_path'] = 'home/'.$theme;

    }
}
?>
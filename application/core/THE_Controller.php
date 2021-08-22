<?php

    class THE_Controller extends CI_Controller

    {
        function __construct()

        {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('M_users');
        $user_id = magicfunction(ss('user_id'),'d');
        $this->data['modules_allocated'] = (ss('user_type_display') == 1 ) ? 
                                            $this->M_users->all_modules() : 
                                            $this->M_users->all_modules();
         
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
?>
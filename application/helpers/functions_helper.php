<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 //encryption decryption
 if (!function_exists('magicfunction_with_key')){
    function magicfunction_with_key($string, $action) {
   
        $secret_key = (strtotime(date('Y-m-d h:i'))); 

        $secret_iv = 'eldhose_encrypt_and_decrypt_20210217';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key );
        $iv = substr(hash( 'sha256', $secret_iv ), 0, 16 );
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
           // $output = $output . $secret_key;
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
        return $output;
}
}


//encryption decryption
if (!function_exists('magicfunction')){
    function magicfunction($string, $action) {

        $secret_key = '@@s-m-c-i-m-20210217@#';
        $secret_iv = 'smcim_encrypt_and_decrypt_20210217';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key );
        $iv = substr(hash( 'sha256', $secret_iv ), 0, 16 );
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
        return $output;
}
}

if (!function_exists('lq')) {
    function lq($db_instance = 'db'){
        $ci =& get_instance();
        echo $ci->$db_instance->last_query();
        exit();
    }
}

if (!function_exists('ss')) {
    function ss($param){
        $ci =& get_instance();
        return $ci->session->userdata($param);
        
    }
}

if (!function_exists('auth_check')) {
    function auth_check()
    {
        // Get a reference to the controller object
        $ci =& get_instance();
        if(!$ci->session->has_userdata('login_status'))
        {
            redirect('login', 'refresh');
        }

       // if(!check_for_token()){
       //     $ci->session->set_flashdata('errors', 'Your session is over!');
       //     redirect(base_url('admin/auth/login'));

       // }
    }
}

if (!function_exists('check_access')) {
    function check_access()
    {
        // Get a reference to the controller object
        $ci = & get_instance();
        $menu_url = $ci->router->fetch_class();
        $user_id = magicfunction($ci->session->userdata('user_id'),'d');
        if($user_id == 1)
            return;  
        if($menu_url == 'home')
            return;
        $multiplewhere = array('module_access.status' => 1,'modules.status' => 1,
        'modules.module_url' => $menu_url,'module_access.user_id' => $user_id);
        $ci->db->where($multiplewhere);
        $ci->db->join('modules','modules.module_id = module_access.module_id');
        $access = $ci->db->get('module_access')->row_array();
        //echo $access['access']; exit();
       // echo $ci->db->last_query(); exit();
        if(empty($access))
            redirect_to_error(); 

        if($access['status'] == 0)
            redirect_to_error(); 

        
        

    }
}

function encrypt_data($result,$indexes){
	$i = 0;
	while($i < count($result)):
		foreach($indexes as $index):
			$result[$i]->$index = magicfunction($result[$i]->$index,'e');
		endforeach;		
			$i++;
	endwhile; 


	return $result;
}

function check_post()
{
	$CI = & get_instance();  
	if($CI->input->post())
		return;
	else
		exit();	
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

 function redirect_to_error()
	{
        $template = 'not_found';
        $ci = & get_instance();
		if (empty($templates_path))
		{
			$templates_path = VIEWPATH;
		}
        $templates_path .= $template.'.php';
        //echo $templates_path; exit();
        include($templates_path);
        exit();
	
        //exit();
    }

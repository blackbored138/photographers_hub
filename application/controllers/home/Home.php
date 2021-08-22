<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends HOME_Controller {

    function __construct()

    {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('captcha');
    $this->load->library('session');

    }

    public function index($id = 0){
      $this->client_details($id);
      $data = $this->data;

      $this->template->user_views($data["theme_path"] . '/home', $data);
      }

      
      public function user_home($id = 0){
          if($id == 0):
            echo '404'; exit();
          endif;

        $data = $this->data;

		$this->template->user_views($data["theme_path"] . '/home', $data);

      }


}
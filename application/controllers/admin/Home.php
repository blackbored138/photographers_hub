<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends MY_Controller {

    function __construct()

    {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('captcha');
    $this->load->library('session');
    }

    public function index(){
        $data = $this->data;
		$this->template->views('admin/home', $data);
      }

    public function profile(){
        $data = array();
		$this->template->views('admin/site_settings/index', $data);
      }



}
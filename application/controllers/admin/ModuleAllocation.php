<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class moduleAllocation extends MY_Controller {

    function __construct()

    {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('captcha');
    $this->load->library('session');
    $this->load->model('M_permissions');
    }

    public function index(){
       
      }

 

}
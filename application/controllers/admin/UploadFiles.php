<?php
defined('BASEPATH') or exit('No direct script access allowed');

class uploadfiles extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');

        $this->load->model('M_users');
        $this->load->model('M_files');
    }

    public function index()
    {
        $data = $this->data;
        $this->template->views('admin/uploadfiles/index', $data);
    }


    public function add_file_upload()
    {
        $data = $this->data;
        $this->template->views('admin/uploadfiles/add_file_upload', $data);
    }

    public function save_zip_file(){ 
        $this->form_validation->set_rules('zip_title', 'Zip Title', 'trim|required');
        $this->form_validation->set_rules('zip_description', 'Zip Description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array( 'status' =>'error','msg' => validation_errors());
            echo json_encode($data); exit();
        }


        $file_type = $_FILES["zip_file"]["type"];

        $user_id = magicfunction(ss('user_id'), 'd');

        $config['upload_path']          = './uploads/zips/';
        $config['allowed_types']        = 'zip';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('zip_file')):
                $data = array( 'status' =>'error','msg' => $this->upload->display_errors());
                echo json_encode($data); exit();
        endif;
       
        $file_data =  $this->upload->data();
        $data_insert = array('zip_name' => $file_data['file_name'],
        'zip_size' => $file_data['file_size'],
        'zip_title' => $this->input->post('zip_title'),
        'zip_description' => $this->input->post('zip_description'),
        'created_by' => $user_id,
        'created_at' => date('Y-m-d h:m:s'),
        'status' => 1
    );

    $addZip = $this->M_files->add_zip_file($data_insert);
    if ($addZip < 1) :
        @unlink($file_data['full_path']);  

        $data = array( 'status' =>'error','msg' => 'Zip file could not be added,Please try again !');
        echo json_encode($data); exit();
    endif;

        $data = array( 'status' =>'success','msg' => 'File Uploaded Successfully !');
        echo json_encode($data); exit();


    }

    public function file_details(){
        $data = $this->data;
        $this->template->views('admin/uploadfiles/files_details', $data);
    }

    public function view_uploaded_images(){
        $data = $this->data;
        $this->template->views('admin/uploadfiles/view_images', $data);
    }

    

}

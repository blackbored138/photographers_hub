<?php
defined('BASEPATH') or exit('No direct script access allowed');

class export extends MY_Controller
{

    function __construct()

    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->library('session');

        $this->load->helper('download');

        $this->load->library('zip');
        $this->load->model('M_users');
    }

    public function index()
    {
        $tables = $this->db->list_tables();

        $data = $this->data;

        $data['title'] = 'Export Database';
        $data['tables'] = $tables;
        $this->template->views('admin/export/index', $data);
    }


    public function dbexport()
    {
        $this->load->dbutil();

        $db_format = array(
            'format' => 'zip',
            'filename' => 'my_db_backup.sql',
            'add_insert' => TRUE,
            'newline' => "\n"
        );

        $backup =  $this->dbutil->backup($db_format);
        $dbname = 'backup-db-on-' . date('Y-m-d h:m:s') . '.zip';
        $save = FCPATH . '/uploads/db_backup/' . $dbname;

        //write_file($save, $backup);
        force_download($dbname, $backup);
    }


    public function tbexport($tb_name = NULL)
    {
        if ($tb_name === NULL)
            redirect(base_url('admin/export?token=') . $this->session->userdata('enc_sess_token'));

        $this->load->dbutil();

        $db_format = array(
            'tables'        => array($tb_name),
            'format' => 'zip',
            'filename' => $tb_name . '.sql',
            'add_insert' => TRUE,
            'newline' => "\n"
        );

        $backup =  $this->dbutil->backup($db_format);
        $dbname = $tb_name.'backup-on-' . date('Y-m-d h:m:s') . '.zip';
        $save = FCPATH . '/uploads/db_backup/' . $dbname;
        //write_file($save, $backup);
        force_download($dbname, $backup);
    }

    

}

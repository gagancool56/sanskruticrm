<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LookupController extends CI_Controller
{
    public $lookup_type;
    function __construct()
    {
        parent::__construct();
        $this->load->model('lookupmodel', 'lookupmodel');
        $this->lookup_type = ucfirst(strtolower($_POST['TYPE']));
    }

    function index()
    {
        $this->lookupmodel->find($this->lookup_type);
    }

    function tableHeader()
    {
        $this->lookupmodel->tableHeader($this->lookup_type);
    }
}

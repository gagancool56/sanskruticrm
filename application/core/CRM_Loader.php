<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CRM_Loader extends CI_Loader
{
    function __construct()
    {
        parent::__construct();
    }

    function page($filename, $data = array())
    {
        $data['total_products'] = 10;
        cins()->load->view('inc/header', $data);
        cins()->load->view($filename, $data);
        cins()->load->view('inc/footer', $data);
    }

    function vpage($filename)
    {
        global $data;
        // pr($data,1);
        cins()->load->view('inc/' . $filename, $data);
    }

    function subforms($filename, $data = array())
    {
        cins()->load->view('subforms/' . $filename, $data);
    }
}

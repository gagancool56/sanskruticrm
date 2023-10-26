<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdkmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function save_navigation()
    {
        $status = $this->_save_navigation();
    }

    private function _save_navigation()
    {
        $TABLE = 'NAV';
        $this->db->trans_start();
        pr($_POST, 1);
        $this->db->trans_complete();
    }
}

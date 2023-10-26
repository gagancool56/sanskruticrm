<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CRMappmodel extends CI_Model
{
    private $viewerjs;
    private $rowdata;
    private $rowdata_class;
    private $viewerjs_class;
    function __construct()
    {
        parent::__construct();
    }

    function add_rowdata($key, $val, $class = false)
    {
        $class ? $this->rowdata_class[$key] = $val : $this->rowdata[$key] = $val;
    }

    function view_rowdata($class = false)
    {
        return $class ? $this->rowdata_class : $this->rowdata;
    }

    function add_viewerjs($key, $val, $class)
    {
        $class ? $this->viewerjs_class[$key] = $val : $this->viewerjs[$key] = $val;
    }

    function get_viewerjs($class = false)
    {
        return $class ? $this->viewerjs_class : $this->viewerjs;
    }

    function include_formjs()
    {
        global $FORMROW;
        if (!empty($FORMROW->jsfile)) {
            foreach (explode(",", $FORMROW->jsfile) as $file) {
                echo '<script src="' . asset_url($file . '.js', 'assets/frontend/') . '"></script>';
            }
        }
    }
}

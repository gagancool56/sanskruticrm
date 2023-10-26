<?php
class Test extends CI_Controller
{
    function __construct()
    {
    }
    function index(){
        pr(show_record_redirect_url('1','party'),1);
    }
}

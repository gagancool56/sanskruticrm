<?php
include_once APPPATH . '/third_party/mpdf/mpdf.php';

class Pdf extends Mpdf
{
    function __construct()
    {
        parent::__construct();
    }
}

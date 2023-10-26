<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('pr')) {
    function pr($data, $die = 0)
    {
        echo '<pre>';
        print_r($data);
        echo '<br>line no:' . debug_backtrace()[0]['line'] . '<br>';
        echo 'File: ' . debug_backtrace()[0]['file'];
        echo '</pre>';
        $die ? die() : '';
    }
}

if (!function_exists('cins')) {
    function cins()
    {
        $CI = &get_instance();
        return $CI;
    }
}

if (!function_exists('precontroller')) {
    function precontroller()
    {
        global $data;
        $data['navigation'] = cins()->commonmodel->navigation();
    }
}

if (!function_exists('get_form_list')) {
    function get_form_list()
    {
        return cins()->systemqueriesmodel->get_form_list();
    }
}

if (!function_exists('record_saved_message')) {
    function record_saved_message($prefix = 'Record')
    {
        return $prefix . ' saved successfully!';
    }
}

if (!function_exists('record_revised_message')) {
    function record_revised_message($prefix = 'Record')
    {
        return $prefix . ' revised successfully!';
    }
}

if (!function_exists('show_record_redirect_url')) {
    function show_record_redirect_url($id, $table)
    {
        global $KFORMID, $KNAVID;
        return base_url() . 'crmform/' . $KFORMID . '/' . $KNAVID . '/?method=view&' . $table . 'id=' . $id;
    }
}

if (!function_exists('add_viewerjs')) {
    function add_viewerjs($key, $value, $class = false)
    {
        return cins()->crmappmodel->add_viewerjs($key, $value, $class);
    }
}

if (!function_exists('get_viewerjs')) {
    function get_viewerjs($class = false)
    {
        return cins()->crmappmodel->get_viewerjs($class);
    }
}

if (!function_exists('add_rowdata')) {
    function add_rowdata($key, $value)
    {
        return cins()->crmappmodel->add_rowdata($key, $value);
    }
}

if (!function_exists('view_rowdata')) {
    function view_rowdata($class = false)
    {
        return cins()->crmappmodel->view_rowdata($class);
    }
}

if (!function_exists('include_formjs')) {
    function include_formjs()
    {
        cins()->crmappmodel->include_formjs();
    }
}

if (!function_exists('system_queries')) {
    function system_queries($key)
    {
        cins()->systemqueriesmodel->system_queries($key);
    }
}

if (!function_exists('process_query')) {
    function process_query(&$query)
    {
        cins()->systemqueriesmodel->process_query($query);
    }
}

if (!function_exists('prepare_insert')) {
    function prepare_insert($TABLE, $TDATA, $CREATEDBY = false, $SKIPPERARR = array(), $GRID = false, $INDEX = '')
    {
        return cins()->commonmodel->prepare_insert($TABLE, $TDATA, $CREATEDBY, $SKIPPERARR, $GRID, $INDEX);
    }
}

if (!function_exists('prepare_update')) {
    function prepare_update($TABLE, $TDATA, $UPDATEDBY = false, $SKIPPERARR = array(), $GRID = false, $INDEX = '')
    {
        return cins()->commonmodel->prepare_update($TABLE, $TDATA, $UPDATEDBY, $SKIPPERARR, $GRID, $INDEX);
    }
}

if (!function_exists('check_login')) {
    function check_login()
    {
        cins()->users_auth->check_login();
    }
}

if (!function_exists('form_actions')) {
    function form_actions($TABLE, $row)
    {
        cins()->commonmodel->form_actions($TABLE, $row);
    }
}

if (!function_exists('cmpdf')) {
    function cmpdf($ORIENTATION = 'P', $marginLeft = 5, $marginRight = 5, $marginTop = 10, $marginBottom = 10, $marginHeader = 5, $marginFooter = 5)
    {
        global $CI;
        cins()->load->library('pdf');
        cins()->mpdf = new mpdf(
            "", //Mode
            "A4-" . $ORIENTATION, //Page size
            0, //Default font size
            $marginLeft,
            $marginRight,
            $marginTop,
            $marginBottom,
            $marginHeader,
            $marginFooter,
            $ORIENTATION
        );
        cins()->mpdf->keepColumns = true;
    }
}

if (!function_exists('ini_pdf')) {
    function ini_pdf()
    {
        $ret = '<html>
            <style>
                /* mPDF CUSTOM CSS START. */
                    .ltable {
                        width: 100%;
                        border: 1px solid #0000;
                        border-collapse: collapse;
                    }

                    .ltable th {
                        border-right: 1px solid #0000;
                        border-bottom: 1px solid #0000;
                        border-collapse: collapse;
                    }

                    .ltable td {
                        border-right: 1px solid #0000;
                        border-collapse: collapse;
                    }
                    .border{
                        border: 1px solid #0000;
                        border-collapse: collapse;
                    }
                    .noborder{
                        border: none;
                    }
                    .text-center{
                        text-align: center;
                    }
                /* mPDF CUSTOM CSS END. */
            </style>
        <body>';
        return $ret;
    }
}

if (!function_exists('sqldate')) {
    function sqldate($date, $existingformat = false, $format = false)
    {
        $myDateTime = DateTime::createFromFormat($existingformat, $date);
        return $myDateTime->format('Y-m-d');
    }
}
if (!function_exists('AddHierarchy')) {
    function AddHierarchy($table)
    {
        cins()->users_auth->AddHierarchy($table);
    }
}

if (!function_exists('navigationList')) {
    function navigationList()
    {
        return cins()->commonmodel->navigationList();
    }
}

if (!function_exists('amountInWords')) {
    function amountInWords(float $amount)
    {
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(
            0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
        );
        $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($x < $count_length) {
            $get_divider = ($x == 2) ? 10 : 100;
            $amount = floor($num % $get_divider);
            $num = floor($num / $get_divider);
            $x += $get_divider == 10 ? 1 : 2;
            if ($amount) {
                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
       ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
       ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
            } else $string[] = null;
        }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
        return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise . ' only';
    }
}

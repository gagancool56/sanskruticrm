<?php defined('BASEPATH') or exit('No direct script access allowed');
if (!function_exists('asset_url')) {
    function asset_url($path = '', $prefix = 'assets/')
    {
        if (empty($path)) {
            $url = base_url($prefix);
        } else {
            $url = base_url($prefix  . $path);
        }
        return $url;
    }
}

if (!function_exists('report_url')) {
    function report_url($reportid, $url)
    {
        if (!empty($url)) {
            $url = base_url('crmreport/' . $reportid . '/' . $url);
        } else {
            $url = base_url();
        }
        return $url;
    }
}

if (!function_exists('business_info')) {
    function business_info($key)
    {
        $msg = '';
        switch ($key) {
            case 'address':
                $msg = '1101, 11th Floor, Real Tech Park, Sec 30A, Vashi, Navi Mumbai Maharashtra 400703 IN';
                break;
            case 'email':
                $msg = 'contact@sanskrutiagrofarm.com';
                break;
            case 'phone':
                $msg = '+91 88281 85708';
                break;
            case 'buname':
                $msg = 'Organic Nest';
                break;
        }
        return $msg;
    }
}

if (!function_exists('crm_start_form')) {
    function crm_start_form($class = '', $id = 'crm-validate')
    {
        global $data, $KNAVID, $KFORMID;
        $hiddenFields = array("KNAVID" => $KNAVID, "FORMID" => $KFORMID, "TYPE" => $data['type']);
        foreach (cins()->input->get() as $key => $val) {
            $hiddenFields['CRM_' . strtoupper($key)] = $val;
        }
        $attr = array("class" => $class, "id" => $id);
        echo form_open_multipart("", $attr, $hiddenFields);
        echo '<div class="alert alert-success form-success-msg hidden mt-5"></div>';
        echo '<div class="alert alert-danger form-danger-msg hidden mt-5"></div>';

        cins()->load->view('component/formmenu');
    }
}

if (!function_exists('crm_close_form')) {
    function crm_close_form()
    {
        echo form_close();
        cins()->load->view('component/finder');
    }
}

if (!function_exists('crm_start_report_form')) {
    function crm_start_report_form($class = '', $id = 'crm-report-validate')
    {
        global $data;
        $hiddenFields = array("NA[XREPORTID]" => @$data['reportrow']->xreportid);
        $attr = array("class" => $class, "id" => $id);
        echo form_open_multipart("", $attr, $hiddenFields);
    }
}

if (!function_exists('crm_close_report_form')) {
    function crm_close_report_form()
    {
        echo form_close();
    }
}

if (!function_exists('form_lookup')) {
    function form_lookup($type, $input_id, $input_descr, $label_descr = '', $showid = true)
    {
        $html = '<div class="row lookup-container">';
        if (!empty($label_descr)) {
            $html .= form_label($label_descr);
        }

        if (!empty($input_id) && $showid == true) {
            $html .= '<div class="col-md-3"><input type="text" name="' . $input_id . '" value="" class="form-control lookup-id" readonly></div>';
            $html .= '<div class="col-md-8"><input type="text" name="' . $input_descr . '" value="" class="form-control lookup-descr" readonly></div>';
        } else {
            $html .= '<div class="col-md-11 ">
            <input type="text" name="' . $input_id . '" value="" class="form-control lookup-id hidden" readonly>
            <input type="text" name="' . $input_descr . '" value="" class="form-control lookup-descr" readonly>
            </div>';
        }

        $html .= '<div class="col-md-1 p-0"><button type="button" name="" class="btn btn-primary px-0 py-2 text-bold lookup" data-type="' . $type . '"><i class="icon material-icons md-more_vert p-0 m-0"></i></button></div>';
        $html .= '</div>';

        echo $html;
    }
}

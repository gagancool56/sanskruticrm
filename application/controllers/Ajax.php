<?php defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CRM_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function crmaction()
    {
        $type = strtolower($this->input->post('TYPE'));
        if ($type == 'login') {
            $this->users_auth->login();
            return;
        }

        $KNAVID = $this->input->post('KNAVID');
        $res = $this->db->where('descr', strtolower($type))->where('navid', $KNAVID)->get('navfeatures');
        if ($res->num_rows() > 0) {
            $nav = $res->row();
            $functionName = $nav->functionname;
            $this->load->model($nav->modelname, 'modelname');
            $this->modelname->{$functionName}();
        }
    }

    function crmajax()
    {
        $data = $_POST['data'];
        $res = $this->db->where('descr', 'view')->where('navid', $data['KNAVID'])->get('navfeatures');
        if ($res->num_rows() > 0) {
            $nav = $res->row();
            $functionName = $data['TYPE'];
            $this->load->model($nav->modelname, 'modelname');
            if (method_exists($this->modelname, $functionName)) {
                $this->modelname->{$functionName}();
            } else {
                echo  'Method doesn\'t exists';
                return;
            }
        }
    }

    function finder()
    {
        global $KNAVID, $KFORMID;
        $KNAVID = $_POST['knavid'];
        $KFORMID = $_POST['formid'];

        $res = $this->db->where('descr', 'find')->where('navid', $KNAVID)->get('navfeatures');
        if ($res->num_rows() > 0) {
            $res = $res->row();
            $this->load->model('Administrator/findermodel', 'findermodel');
            $this->findermodel->find($res);
        }
    }

    function update_session()
    {
        $this->session->set_userdata('FROMDATE', $_POST['fromdate']);
        $this->session->set_userdata('TODATE', $_POST['todate']);
    }

    function report()
    {
        $this->load->model('Administrator/Reportsmodel', 'report');
        $postdata = $_POST['NA'];
        $data = $this->report->process_report($postdata);
        echo json_encode(array('success' => true, 'data' => $data));
    }
}

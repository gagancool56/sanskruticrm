<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Systemqueriesmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_form_list()
    {
        $res = $this->db->get('formdata');
        if ($res->num_rows() > 0) {
            return $res->result();
        }
    }

    function process_query(&$query)
    {
        $query = str_replace('{%userid%}', $this->users_auth->USERID, $query);
    }

    function system_queries($key)
    {
        switch (strtoupper($key)) {
            case 'SYS_ITEMS':
                $res = $this->db->select('itemid,descr,rate')->where('active', 'Y')->get('item');
                $html = '<option value="">Select Item</option>';
                if ($res->num_rows() > 0) {
                    foreach ($res->result() as $row) {
                        $html .= '<option value="' . $row->itemid . '" data-rate="' . $row->rate . '">' . $row->descr . '</option>';
                    }
                }
                echo $html;
                break;
            case 'SYS_PARTY':
                if ($this->users_auth->SUPER != 'Y') {
                    AddHierarchy('party');
                }

                $supptype = array('CUS', 'SCC', 'CSS');
                $this->db->select('partyid,descr')->where_in('supptype', $supptype)->where('active', 'Y')->order_by('descr');
                $res = $this->db->get('party');

                $html = '<option value="">Select Party</option>';
                if ($res->num_rows() > 0) {
                    foreach ($res->result() as $row) {
                        $html .= '<option value="' . $row->partyid . '">' . $row->descr . '</option>';
                    }
                }

                echo $html;
                break;
            case 'SYS_USERS':
                if ($this->users_auth->SUPER != 'Y') {
                    $this->db->where('userid', $this->users_auth->USERID);
                }

                $this->db->select('userid,descr')->where('active', 'Y')->order_by('descr');
                $res = $this->db->get('users');

                $html = '';
                if ($res->num_rows() > 0) {
                    foreach ($res->result() as $row) {
                        $html .= '<option value="' . $row->userid . '"' . ($this->users_auth->USERID == $row->userid ? "selected" : "") . ' >' . $row->descr . '</option>';
                    }
                }

                echo $html;
                break;
            case 'SYS_USERLEVEL':
                $this->db->select('userlevelid,descr')->where('active', 'Y')->order_by('descr');
                $res = $this->db->get('userlevel');
                $html = '<option value="" selected>Select value</option>';
                if ($res->num_rows() > 0) {
                    foreach ($res->result() as $row) {
                        $html .= '<option value="' . $row->userlevelid . '">' . $row->descr . '</option>';
                    }
                }

                echo $html;
                break;
            case 'SYS_YESNO':
                $res['Y'] = 'Yes';
                $res['N'] = 'No';
                $html = '<option value="">Select value</option>';
                foreach ($res as $key => $val) {
                    $html .= '<option value="' . $key . '">' . $val . '</option>';
                }

                echo $html;
                break;
            case 'SYS_NAVFEATURE':
                $res['add'] = 'Add';
                $res['view'] = 'View';
                $res['revise'] = 'Revise';
                $res['find'] = 'Find';
                $html = '<option value="">Select value</option>';
                foreach ($res as $key => $val) {
                    $html .= '<option value="' . $key . '">' . $val . '</option>';
                }

                echo $html;
                break;
        }
    }
}

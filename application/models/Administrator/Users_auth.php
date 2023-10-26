<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_auth extends CI_Model
{
    public $USERID = '';
    public $USERLEVEL = '';
    public $SUPER = '';
    public $USERNAME = '';
    public $USERDISPLAYNAME = '';
    function __construct()
    {
        parent::__construct();
        $this->USERID();
        $this->USERLEVEL();
        $this->SUPER();
        $this->USERNAME();
        $this->USERDISPLAYNAME();
    }

    function check_login()
    {
        if (empty($this->USERID)) {
            redirect(base_url());
        }
    }

    function login()
    {
        $success = $this->_login();
        if ($success === true) {
            echo json_encode(array('success' => true, 'message' => 'login successfully!'));
        } else {
            echo json_encode(array('success' => false, 'message' => $success));
        }
    }

    private function _login()
    {
        $postdata = $this->input->post();
        $this->db->where('username', strtoupper($postdata['USERNAME']));
        $this->db->where('password', $postdata['PASSWORD']);
        $res = $this->db->get('users');
        if ($res->num_rows() > 0) {
            $row = $res->row();

            // Return if userid is not active.
            if ($row->active != 'Y') return 'Userid is inactive';

            $this->session->set_userdata('USERID', $row->userid);
            $this->session->set_userdata('USERNAME', $row->username);
            $this->session->set_userdata('USERDISPLAYNAME', $row->descr);
            $this->session->set_userdata('USERLEVEL', $row->userlevel);
            $this->session->set_userdata('SUPER', $row->super);
            return true;
        } else {
            return 'Credentials mismatch!';
        }
    }

    function USERID()
    {
        return $this->USERID = $this->session->userdata('USERID');
    }

    function USERLEVEL()
    {
        return $this->USERLEVEL = $this->session->userdata('USERLEVEL');
    }

    function USERNAME()
    {
        return $this->USERNAME = $this->session->userdata('USERNAME');
    }

    function USERDISPLAYNAME()
    {
        return $this->USERDISPLAYNAME = $this->session->userdata('USERDISPLAYNAME');
    }

    function SUPER()
    {
        $this->SUPER = $this->session->userdata('SUPER');
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url());
    }

    public $heirarchyUserids = array();
    function getHierarchyUserid($userid = '')
    {
        if (!empty($userid)) {
            $res = $this->db->select('userid')->where('hod', $userid)->or_where('userid', $userid)->get('users');
            if ($res->num_rows() > 0) {
                $this->heirarchyUserids = array_column($res->result_array(), 'userid');
            }
        }
    }

    function AddHierarchy($table)
    {
        // If a user is super then return no hierarchy required.
        if ($this->users_auth->SUPER == 'Y') return;

        $this->getHierarchyUserid($this->USERID);
        $this->db->where_in($table . '.created_by', $this->heirarchyUserids);
    }

    function ROW()
    {
        return $this->db->where('userid', $this->USERID)->get('users')->row();
    }
}

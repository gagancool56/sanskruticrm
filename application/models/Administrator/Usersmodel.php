<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usersmodel extends CI_Model
{
    public $userid = '';
    function __construct()
    {
        parent::__construct();
    }

    function view()
    {
        global $data;

        $userid = $_REQUEST['userid'];
        if (!empty($userid)) {
            $res = $this->db->where('userid', $userid)->get('users');
            if ($res->num_rows() > 0) {
                $data['is_record'] = true;
                $row = $res->row();
                add_viewerjs("USERS", $row);
            }
        }
    }

    function save()
    {
        $status = $this->_save_users();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_saved_message(), 'redirecturl' => show_record_redirect_url($this->userid, 'user')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _save_users()
    {
        $this->db->trans_start();

        $TABLE = 'USERS';
        $insert = prepare_insert($TABLE, $_POST[$TABLE], true, array());
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->insert('users', $insert)) {
            return $this->db->error();
        }
        $this->userid = $this->db->insert_id();

        $this->db->trans_complete();
        return true;
    }

    function revise()
    {
        $status = $this->_revise_users();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_saved_message(), 'redirecturl' => show_record_redirect_url($this->userid, 'user')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _revise_users()
    {
        $this->db->trans_start();
        $this->userid = $this->input->post('CRM_USERID');
        $TABLE = 'USERS';
        $insert = prepare_update($TABLE, $_POST[$TABLE], true, array());
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->where('userid', $this->userid)->update('users', $insert)) {
            return $this->db->error();
        }

        $this->db->trans_complete();
        return true;
    }
}

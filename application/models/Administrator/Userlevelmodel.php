<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userlevelmodel extends CI_Model
{
    public $userid = '';
    function __construct()
    {
        parent::__construct();
    }

    function view()
    {
        global $data;

        $userlevelid = $_REQUEST['userlevelid'];
        if (!empty($userlevelid)) {
            $res = $this->db->where('userlevelid', $userlevelid)->get('userlevel');
            if ($res->num_rows() > 0) {
                $data['is_record'] = true;
                $row = $res->row();
                add_viewerjs("USERLEVEL", $row);
            }
        }
    }

    function save()
    {
        $status = $this->_save_userlevel();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_saved_message(), 'redirecturl' => show_record_redirect_url($this->userlevelid, 'userlevel')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _save_userlevel()
    {
        $this->db->trans_start();

        $TABLE = 'USERLEVEL';
        $insert = prepare_insert($TABLE, $_POST[$TABLE], true, array());
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->insert('userlevel', $insert)) {
            return $this->db->error();
        }
        $this->userlevelid = $this->db->insert_id();

        $this->db->trans_complete();
        return true;
    }

    function revise()
    {
        $status = $this->_revise_userlevel();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_saved_message(), 'redirecturl' => show_record_redirect_url($this->userlevelid, 'userlevel')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _revise_userlevel()
    {
        $this->db->trans_start();
        $this->userlevelid = $this->input->post('CRM_USERLEVELID');
        $TABLE = 'USERLEVEL';
        $insert = prepare_update($TABLE, $_POST[$TABLE], true, array());
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->where('userlevelid', $this->userlevelid)->update('userlevel', $insert)) {
            return $this->db->error();
        }

        $this->db->trans_complete();
        return true;
    }
}

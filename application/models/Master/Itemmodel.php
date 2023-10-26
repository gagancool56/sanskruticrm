<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Itemmodel extends CI_Model
{
    public $itemid = '';
    function __construct()
    {
        parent::__construct();
    }

    function view()
    {
        global $data;

        $itemid = $_REQUEST['itemid'];
        if (!empty($itemid)) {
            $res = $this->db->where('itemid', $itemid)->get('item');
            if ($res->num_rows() > 0) {
                $data['is_record'] = true;
                $row = $res->row();
                add_viewerjs("ITEM", $row);
            }
        }
    }

    function save()
    {
        $status = $this->_save_item();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_saved_message(), 'redirecturl' => show_record_redirect_url($this->itemid, 'item')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _save_item()
    {
        $this->db->trans_start();

        $TABLE = 'ITEM';
        $insert = prepare_insert($TABLE, $_POST[$TABLE], true, array());
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->insert('item', $insert)) {
            return $this->db->error();
        }
        $this->itemid = $this->db->insert_id();

        $this->db->trans_complete();
        return true;
    }

    function revise()
    {
        $status = $this->_revise_item();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_revised_message(), 'redirecturl' => show_record_redirect_url($this->itemid, 'item')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _revise_item()
    {
        $this->db->trans_start();

        $TABLE = 'ITEM';
        $this->itemid = $this->input->post('CRM_ITEMID');
        $insert = prepare_update($TABLE, $_POST[$TABLE], true, array());
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->where('itemid', $this->itemid)->update('item', $insert)) {
            return $this->db->error();
        }

        $this->db->trans_complete();
        return true;
    }
}

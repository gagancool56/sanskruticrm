<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userrightsmodel extends CI_Model
{
    public $userid = '';
    function __construct()
    {
        parent::__construct();
    }

    function view()
    {
        global $data;

        $userrightid = $_REQUEST['userrightid'];
        if (!empty($userrightid)) {
            $res = $this->db->where('userrightid', $userrightid)->get('userright');
            if ($res->num_rows() > 0) {
                $data['is_record'] = true;
                $row = $res->row();
                add_viewerjs("USERRIGHT", $row);
            }

            $res = $this->db->where('userrightid', $userrightid)->get('userrightdet');
            if ($res->num_rows() > 0) {
                foreach ($res->result() as $row) {
                    $filterdata = array();
                    foreach ($row as $key => $val) {
                        $filterdata['USERRIGHTDET[' . strtoupper($key) . '][]'] = $val;
                    }
                    $result[] = $filterdata;
                }
                add_rowdata("USERRIGHTDET", $result);
            }
        }
    }

    function save()
    {
        $status = $this->_save_userrights();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_saved_message(), 'redirecturl' => show_record_redirect_url($this->userrightid, 'userright')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _save_userrights()
    {
        $this->db->trans_start();
        $TABLE = 'USERRIGHT';
        $insert = prepare_insert($TABLE, $_POST[$TABLE], false, array());
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->insert('userright', $insert)) {
            return $this->db->error();
        }
        $this->userrightid = $this->db->insert_id();

        $TABLE = 'USERRIGHTDET';
        if (!isset($_POST[$TABLE])) {
            return 'Please select one navigation atleast.';
        }
        $USERRIGHTDET = $_POST[$TABLE];

        for ($i = 0; $i < count($USERRIGHTDET['NAVID']); $i++) {
            if (empty($USERRIGHTDET['NAVID'][$i])) continue;

            // Inserting into table if sodetid is empty START.
            $insert = prepare_insert($TABLE, $USERRIGHTDET, false, array('DESCR'), true, $i);
            if ($insert['success'] === false) {
                return $insert['data'];
            }

            $insert = $insert['data'];
            $insert['USERRIGHTID'] =  $this->userrightid;
            if (!$this->db->insert('userrightdet', $insert)) {
                return $this->db->error();
            }
        }

        $this->db->trans_complete();
        return true;
    }

    function revise()
    {
        $status = $this->_revise_userrights();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_revised_message(), 'redirecturl' => show_record_redirect_url($this->userrightid, 'userright')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _revise_userrights()
    {
        $this->db->trans_start();
        $this->userrightid = $this->input->post('CRM_USERRIGHTID');

        $TABLE = 'USERRIGHT';
        $insert = prepare_update($TABLE, $_POST[$TABLE], false, array());
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->where('userrightid', $this->userrightid)->update('userright', $insert)) {
            return $this->db->error();
        }

        $TABLE = 'USERRIGHTDET';
        if (!isset($_POST[$TABLE])) {
            return 'Please select one navigation atleast.';
        }
        $USERRIGHTDET = $_POST[$TABLE];

        if (!$this->db->where('userrightid', $this->userrightid)->delete('userrightdet')) {
            return $this->db->error();
        }

        for ($i = 0; $i < count($USERRIGHTDET['NAVID']); $i++) {
            if (empty($USERRIGHTDET['NAVID'][$i])) continue;

            // Inserting into table if sodetid is empty START.
            $insert = prepare_insert($TABLE, $USERRIGHTDET, false, array('DESCR'), true, $i);
            if ($insert['success'] === false) {
                return $insert['data'];
            }

            $insert = $insert['data'];
            $insert['USERRIGHTID'] =  $this->userrightid;
            if (!$this->db->insert('userrightdet', $insert)) {
                return $this->db->error();
            }
        }

        $this->db->trans_complete();
        return true;
    }
}

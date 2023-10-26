<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partymodel extends CI_Model
{
    public $partyid = '';
    function __construct()
    {
        parent::__construct();
    }

    function view()
    {
        global $data;

        $partyid = $_REQUEST['partyid'];
        if (!empty($partyid)) {
            AddHierarchy('party');
            $res = $this->db->where('partyid', $partyid)->get('party');
            if ($res->num_rows() > 0) {
                $data['is_record'] = true;
                $row = $res->row();
                add_viewerjs("PARTY", $row);

                $res = $this->db->where('partyid', $partyid)->get('partycon');
                if ($res->num_rows() > 0) {
                    $data['is_record'] = true;
                    $row = $res->row();
                    add_viewerjs("PARTYCON", $row);
                }

                $res = $this->db->where('partyid', $partyid)->get('partyadd');
                if ($res->num_rows() > 0) {
                    $data['is_record'] = true;
                    $row = $res->row();
                    add_viewerjs("PARTYADD", $row);
                }
            }
        }
    }

    function save()
    {
        $status = $this->_save_party();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_saved_message(), 'redirecturl' => show_record_redirect_url($this->partyid, 'party')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _save_party()
    {
        $this->db->trans_start();

        $TABLE = 'PARTY';
        $insert = prepare_insert($TABLE, $_POST[$TABLE], true, array());
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->insert('party', $insert)) {
            return $this->db->error();
        }
        $this->partyid = $this->db->insert_id();

        $TABLE = 'PARTYADD';
        $_POST[$TABLE]['partyid'] =  $this->partyid;

        if (!empty($_POST[$TABLE])) {
            if (!$this->db->insert('partyadd', $_POST[$TABLE])) {
                return $this->db->error();
            }
        }

        $TABLE = 'PARTYCON';
        $_POST[$TABLE]['partyid'] =  $this->partyid;
        if (!empty($_POST[$TABLE])) {
            if (!$this->db->insert('partycon', $_POST[$TABLE])) {
                return $this->db->error();
            }
        }


        $this->db->trans_complete();
        return true;
    }

    function revise()
    {
        $status = $this->_revise_party();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_revised_message(), 'redirecturl' => show_record_redirect_url($this->partyid, 'party')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _revise_party()
    {
        $this->db->trans_start();
        $this->partyid = $this->input->post('CRM_PARTYID');

        $TABLE = 'PARTY';
        $insert = prepare_update($TABLE, $_POST[$TABLE], true, array());
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->where('partyid', $this->partyid)->update('party', $insert)) {
            return $this->db->error();
        }

        $TABLE = 'PARTYADD';
        $_POST[$TABLE]['partyid'] =  $this->partyid;

        if (!empty($_POST[$TABLE])) {
            if (!$this->db->where('partyid', $this->partyid)->update('partyadd', $_POST[$TABLE])) {
                return $this->db->error();
            }
        }

        $TABLE = 'PARTYCON';
        $_POST[$TABLE]['partyid'] =  $this->partyid;
        if (!empty($_POST[$TABLE])) {
            if (!$this->db->where('partyid', $this->partyid)->update('partycon', $_POST[$TABLE])) {
                return $this->db->error();
            }
        }


        $this->db->trans_complete();
        return true;
    }
}

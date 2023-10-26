<?php defined('BASEPATH') or exit('No direct script access allowed');
class Partylookup extends CI_Model
{
    function get(&$parent)
    {
        $parent->table = 'partyvw';
        $parent->column_order = array('partyid', 'descr', 'phone1', 'phone2');
        $parent->column_search = array('partyid', 'descr', 'phone1', 'phone2');
        $parent->order = array('partyid' => 'desc');
        $parent->parentcolumn = 'partyid';
    }

    function query()
    {
        if ($this->users_auth->SUPER != 'Y') {
            AddHierarchy('partyvw');
        }
        $supptype = array('CUS', 'SCC', 'CSS');
        $this->db->where_in('supptype', $supptype);
        $this->db->where('active', 'Y');
    }

    function tableHeader()
    {
        return array('Sr.No', 'Party ID', 'Party Name', 'Phone No', 'Alt Phone No');
    }
}

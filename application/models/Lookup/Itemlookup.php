<?php defined('BASEPATH') or exit('No direct script access allowed');
class Itemlookup extends CI_Model
{
    function get(&$parent)
    {
        $parent->table = 'item';
        $parent->column_order = array('itemid', 'descr', 'rate');
        $parent->column_search = array('itemid', 'descr', 'rate');
        $parent->order = array('itemid' => 'desc');
        $parent->parentcolumn = 'itemid';
    }

    function query()
    {
        $this->db->where('active', 'Y');
    }

    function tableHeader()
    {
        return array('Sr.No', 'Item Id', 'Item Name', 'Item Rate');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Commonmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function navigation($USERID = '', $LEVELCODE = '')
    {
        $data = [];

        // Permission wise navigation if not super user.
        if ($this->users_auth->SUPER != 'Y') {
            $this->db->select('userrightdet.navid');
            $this->db->where('userrightdet.active', 'Y');
            $this->db->where('userlevel', $this->users_auth->USERLEVEL);
            $this->db->from('userright');
            $this->db->join('userrightdet', 'userright.userrightid=userrightdet.userrightid');
            $res = $this->db->get();
            $navids = array('');

            if ($res->num_rows() > 0) {
                $navids = array_column($res->result_array(), 'navid');
            }

            $this->db->where_in('navid', $navids);
        }

        $res = $this->db->where('active', 'Y')->get('nav');
        if ($res->num_rows() > 0) {
            $menuArr = $res->result_array();
            for ($i = 0; $i < count($menuArr); $i++) {
                if ($menuArr[$i]['parentid'] == 0) {
                    $data[$i] = $menuArr[$i];
                }
                $class = '';
                for ($j = 0; $j < count($menuArr); $j++) {
                    if ($menuArr[$i]['navid'] == $menuArr[$j]['parentid']) {
                        $data[$i]['submenu'][] = $menuArr[$j];
                        $class = "has-submenu";
                    }
                }

                if ($menuArr[$i]['parentid'] == 0) {
                    $data[$i]['class'] = $class;
                }
            }
        }
        return $data;
    }

    function prepare_insert($TABLE, $TDATA, $CREATEDBY = false, $SKIPPERARR = array(), $GRID = false, $INDEX = '')
    {
        // pr($INDEX, 1);
        $tempData['success'] = array();
        $tempData['success'] = false;
        $tableDesc = $this->db->field_data(strtolower($TABLE));
        if ($GRID) {
            $tempData['success'] = true;
            foreach ($TDATA as $key => $val) {
                if (!in_array($key, $SKIPPERARR)) {
                    $tempData['data'][$key] = $val[$INDEX];

                    foreach ($tableDesc as $row) {
                        if (strtoupper($row->name) == $key) {
                            if ($row->type == 'date') {
                                $tempData['data'][$key] = date('Y-m-d', strtotime($val[$INDEX]));
                                continue;
                            }
                        }
                    }
                }
            }
        } else {
            // pr($TDATA, 1);
            $tempData['success'] = true;
            foreach ($TDATA as $key => $val) {
                if (!in_array($key, $SKIPPERARR)) {
                    $tempData['data'][$key] = $val;

                    foreach ($tableDesc as $row) {
                        if (strtoupper($row->name) == $key) {
                            if ($row->type == 'date') {
                                $tempData['data'][$key] = date('Y-m-d', strtotime($val));
                                continue;
                            }
                        }
                    }
                }
            }
        }

        if ($CREATEDBY) {
            $this->db->set('CREATED_BY', $this->users_auth->USERID);
        }
        // pr($tempData, 1);

        return $tempData;
    }

    function prepare_update($TABLE, $TDATA, $UPDATEDBY = false, $SKIPPERARR = array(), $GRID = false, $INDEX = '')
    {
        // pr($INDEX, 1);
        $tempData['success'] = array();
        $tempData['success'] = false;
        $tableDesc = $this->db->field_data(strtolower($TABLE));
        if ($GRID) {
            $tempData['success'] = true;
            foreach ($TDATA as $key => $val) {
                if (!in_array($key, $SKIPPERARR)) {
                    $tempData['data'][$key] = $val[$INDEX];

                    foreach ($tableDesc as $row) {
                        if (strtoupper($row->name) == $key) {
                            if ($row->type == 'date') {
                                $tempData['data'][$key] = date('Y-m-d', strtotime($val[$INDEX]));
                                continue;
                            }
                        }
                    }
                }
            }
        } else {
            // pr($TDATA, 1);
            $tempData['success'] = true;
            foreach ($TDATA as $key => $val) {
                if (!in_array($key, $SKIPPERARR)) {
                    $tempData['data'][$key] = $val;

                    foreach ($tableDesc as $row) {
                        if (strtoupper($row->name) == $key) {
                            if ($row->type == 'date') {
                                $tempData['data'][$key] = date('Y-m-d', strtotime($val));
                                continue;
                            }
                        }
                    }
                }
            }
        }

        if ($UPDATEDBY) {
            $this->db->set('UPDATED_BY', $this->users_auth->USERID);
        }
        // pr($tempData, 1);

        return $tempData;
    }

    function form_actions($TABLE, $row)
    {
        global $data;
        $actions = '';
        switch (strtoupper($TABLE)) {
            case 'SO':
                $actions .= '<li><a class="dropdown-item cancelso" data-table="' . $TABLE . '" data-id="' . $row->soid . '">Cancel Sale Order</a></li>';
                $actions .= '<li><a class="dropdown-item printcontroller" data-table="' . $TABLE . '" data-id="' . $row->soid . '">Print Sale Order</a></li>';
                break;
        }

        $data['actions'] = $actions;
    }

    function navigationList()
    {
        $res = $this->db->select('navid,descr')->get('nav');
        if ($res->num_rows() > 0) {
            return $res;
        }
    }
}

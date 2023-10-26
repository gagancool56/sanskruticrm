<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportsmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function process_report($postdata)
    {
        $sqlstring = $this->process_sql_string($postdata);
        if (!empty($sqlstring)) {
            $res = $this->db->query($sqlstring);
            if ($res->num_rows() > 0) {
                $result = $res->result();
                return $this->process_html($result, $postdata);
            } else {
                return $this->process_html('', $postdata);
            }
        }
    }

    public $xreportdrillrow;
    function process_html($data = array(), $postdata)
    {
        if (empty($data)) {
            return '<h1 class="text-center">No Data Found!</h1>';
        }

        $res = $this->db->select('grid_columns,display_columns')->where('xreportid', $postdata['XREPORTID'])->get('xreport');
        if ($res->num_rows() > 0) {
            $res = $res->row();
            $DISPLAY_COLUMNS = explode(',', $res->display_columns);
            $GRID_COLUMNS = explode(',', $res->grid_columns);
        }

        // Checking and setting if the report is drillable START.
        $res = $this->db->where('xreportid', $postdata['XREPORTID'])->get('xreportdrill');
        if ($res->num_rows() > 0) {
            $this->xreportdrillrow = $res->row();
        }
        // Checking and setting if the report is drillable END.

        $html = '<table class="table table-bordered grid-report-table display" style="max-height: 400px;">';

        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Sr No.</th>';
        foreach ($DISPLAY_COLUMNS as $col) {
            $html .= '<th>' . $col . '</th>';
        }
        $html .= '</tr>';
        $html .= '</thead>';


        $html .= '<tbody>';
        $count = 1;
        foreach ($data as $row) {
            $html .= '<tr>';
            $html .= '<td>' .  $count++ . '</td>';
            foreach ($row as $key => $val) {
                if (!in_array($key, $GRID_COLUMNS)) continue;
                $html .= '<td>' .  $this->makeColumnDrillable($key, $val, $row) . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;
    }

    function makeColumnDrillable($column, $val, $row)
    {
        if (empty($this->xreportdrillrow) || $column != $this->xreportdrillrow->columns) {
            return $val;
        } else {
            return '<a href="' . base_url($this->xreportdrillrow->url . $this->xreportdrillrow->value_column . '=' . $row->{$this->xreportdrillrow->value_column}) . '" target="_blank">' . $val . '</a>';
        }
    }

    function process_sql_string($postdata)
    {
        $res = $this->db->select('sql_string')->where('xreportid', $postdata['XREPORTID'])->get('xreport');
        $sqlstring = '';
        if (!empty($res)) {
            $sqlstring = $res->row('sql_string');
            foreach ($postdata as $key => $val) {
                switch (strtoupper($key)) {
                    case 'STARTDATE':
                    case 'ENDDATE':
                        $sqlstring = str_replace('{%' . $key . '%}', '"' . sqldate($val, 'd-m-Y') . '"', $sqlstring);
                        break;
                    default:
                        $sqlstring = str_replace('{%' . $key . '%}', '"' . $val . '"', $sqlstring);
                        break;
                }
            }
        }
        return $sqlstring;
    }
}

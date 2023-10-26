<?php defined('BASEPATH') or exit('No direct script access allowed');
class Lookupmodel extends CI_Model
{
    public $table;
    public $column_order;
    public $column_search;
    public $order;
    public $parentcolumn;

    function __construct()
    {
        parent::__construct();
    }

    function tableHeader($LOOKUPTYPE)
    {
        // Loading relevant model and calling the method get from lookup.
        $this->load->model('Lookup/' . $LOOKUPTYPE . 'lookup', 'lookup', $this);
        $header = $this->lookup->tableHeader();

        $html = '<tr>';
        foreach ($header as $head) {
            $html .= '<th>' . $head . '</th>';
        }
        $html .= '</tr>';
        echo json_encode(array('tableHeader' => $html));
    }

    function find($LOOKUPTYPE)
    {
        // Loading relevant model and calling the method get from lookup.
        $this->load->model('Lookup/' . $LOOKUPTYPE . 'lookup', 'lookup', $this);
        $this->lookup->get($this);

        $data = $row = array();
        // Fetch member's records
        $rowData = $this->getRows($_POST);

        $i = $_POST['start'];
        foreach ($rowData as $row) {
            $i++;
            $tempData = [];
            $tempData[] = $i;
            foreach ($this->column_order as $col) {
                $tempData[] = $row->{$col};
            }

            $data[] = $tempData;
            // pr($data, 1);
            // $data[] = array($i, $temp);
        }

        // pr($data, 1);
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->countAll(),
            "recordsFiltered" => $this->countFiltered($_POST),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows($postData)
    {
        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
     */
    public function countAll()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData)
    {

        $this->lookup->query();
        $this->db->from($this->table);

        $i = 0;
        // loop searchable columns 
        foreach ($this->column_search as $item) {
            // if datatable send POST for search
            if ($postData['search']['value']) {
                // first loop
                if ($i === 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }

                // last loop
                if (count($this->column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gateentrymodel extends CI_Model
{
    public $grid = '';
    function __construct()
    {
        parent::__construct();
    }

    function view()
    {
        global $data;
        $grid = $_REQUEST['grid'];

        if (!empty($grid)) {
            // AddHierarchy('gr');
            $res = $this->db->select('gr.*,party_id2descr(partyid)descr_partyid')->where('grid', $grid)->get('gr');

            if ($res->num_rows() > 0) {
                $data['is_record'] = true;
                $row = $res->row();
                add_viewerjs("GR", $row);
                $res = $this->db->select('grdet.*,item_id2descr(itemid)descr_itemid')->where('grid', $grid)->get('grdet');
                if ($res->num_rows() > 0) {
                    foreach ($res->result() as $row) {
                        $filterdata = array();
                        foreach ($row as $key => $val) {
                            $filterdata['GRDET[' . strtoupper($key) . '][]'] = $val;
                        }
                        $result[] = $filterdata;
                    }
                    // pr($result, 1);
                    add_rowdata("GRDET", $result);
                }
            }
        }
    }

    function save()
    {
        $status = $this->_save_order();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_saved_message(), 'redirecturl' => show_record_redirect_url($this->grid, 'gr')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _save_order()
    {
        $this->db->trans_start();

        $TABLE = 'GR';
        $insertdata = $_POST[$TABLE];
        if (empty($insertdata['PARTYID']) || empty($insertdata['DESCR_PARTYID'])) {
            return 'Please select party.';
        }

        $insert = prepare_insert($TABLE, $insertdata, true, array('DESCR_PARTYID'));
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];

        if (!$this->db->insert('gr', $insert)) {
            return $this->db->error();
        }
        $this->grid = $this->db->insert_id();

        $TABLE = 'GRDET';
        if (empty($_POST[$TABLE]['ITEMID'][0])) {
            return 'Please select one item atlest.';
        }
        // pr($_POST, 1);

        for ($i = 0; $i < count($_POST[$TABLE]['ITEMID']); $i++) {
            if (empty($_POST[$TABLE]['ITEMID'][$i])) continue;

            $insert = prepare_insert($TABLE, $_POST[$TABLE], false, array('DESCR_ITEMID'), true, $i);
            // pr($insert,1);
            if ($insert['success'] === false) {
                return $insert['data'];
            }

            $insert = $insert['data'];
            $insert['GRID'] =  $this->grid;

            // pr($insert);

            if (!$this->db->insert('grdet', $insert)) {
                return $this->db->error();
            }
            // print_r($this->db->last_query());
        }

        $this->db->trans_complete();
        return true;
    }

    function revise()
    {
        $status = $this->_revise_order();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_revised_message(), 'redirecturl' => show_record_redirect_url($this->grid, 'so')));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }

    private function _revise_order()
    {
        $this->db->trans_start();
        $this->grid = $this->input->post('CRM_GRID');

        $TABLE = 'GR';
        $insertdata = $_POST[$TABLE];
        if (empty($insertdata['PARTYID']) || empty($insertdata['DESCR_PARTYID'])) {
            return 'Please select party.';
        }

        $insert = prepare_update($TABLE, $insertdata, true, array('DESCR_PARTYID'));
        if ($insert['success'] === false) {
            return $insert['data'];
        }
        $insert = $insert['data'];
        // pr($insert,1);
        if (!$this->db->where('grid', $this->grid)->update('gr', $insert)) {
            return $this->db->error();
        }

        $TABLE = 'GRDET';
        if (empty($_POST[$TABLE]['ITEMID'][0])) {
            return 'Please select one item atlest.';
        }
        $SODET = $_POST[$TABLE];
        // pr($_POST, 1);

        $EXISTINGSODETIDS = array_column($this->sodetrows(), 'grdetid');
        $INSERTEDUPDATEDSODETIDS = array();

        for ($i = 0; $i < count($SODET['ITEMID']); $i++) {
            if (empty($SODET['ITEMID'][$i])) continue;

            // Inserting into table if sodetid is empty START.
            if (empty($SODET['SODETID'][$i])) {
                $insert = prepare_insert($TABLE, $SODET, false, array('DESCR_ITEMID'), true, $i);
                if ($insert['success'] === false) {
                    return $insert['data'];
                }

                $insert = $insert['data'];
                $insert['SOID'] =  $this->soid;
                if (!$this->db->insert('sodet', $insert)) {
                    return $this->db->error();
                }
                // Inserting into table if sodetid is empty END.
                $INSERTEDUPDATEDSODETIDS[] = $this->db->insert_id();
            } else {
                // Updating the existing data of sodetid is not empty START.
                $insert = prepare_update($TABLE, $SODET, false, array('DESCR_ITEMID'), true, $i);
                // pr($insert,1);
                if ($insert['success'] === false) {
                    return $insert['data'];
                }

                $insert = $insert['data'];
                if (!$this->db->where('sodetid', $insert['SODETID'])->update('sodet', $insert)) {
                    return $this->db->error();
                }
                // Updating the existing data of sodetid is not empty START.
                $INSERTEDUPDATEDSODETIDS[] = $insert['SODETID'];
            }
            // print_r($this->db->last_query());
        }

        // Delete sodet rows.
        foreach ($EXISTINGSODETIDS as $sodetid) {
            if (!in_array($sodetid, $INSERTEDUPDATEDSODETIDS)) {
                if (!$this->db->where('sodetid', $sodetid)->delete('sodet')) {
                    return $this->db->error();
                }
            }
        }

        $this->db->trans_complete();
        return true;
    }

    function sodetrows()
    {
        $res = $this->db->select('sodetid')->where('soid', $this->soid)->get('sodet');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        }
    }

    function cancelso()
    {
        $status = $this->_cancelso();
        if ($status === true) {
            echo json_encode(array('success' => true, 'message' => record_saved_message()));
        } else {
            echo json_encode(array('success' => false, 'message' => $status));
        }
    }


    function _cancelso()
    {
        $data = $_POST['data'];
        $update = array('ORDERSTATUS' => 'CANCELLED');
        if (!$this->db->where('soid', $data['SOID'])->update('so', $update)) {
            return $this->db->error();
        }
        return true;
    }

    function print_sale_order($soid)
    {
        cmpdf();
        $html = ini_pdf();
        ini_set('display_errors', 1);
        $html .= $this->_print_sale_order($soid);
        // $html = $this->load->view('login', '',true);
        // pr($html, 1);

        $this->mpdf->WriteHTML('<watermarkimage src="images/background.png" alpha="0.4" size="200,250" />');
        $this->mpdf->SetTitle("Sale Order");
        $this->mpdf->SetHeader("Sale Order");
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output('saleorder-' . $soid . '.pdf', 'I');
    }

    function _print_sale_order($soid)
    {
        $sorow = $this->db->where('soid', $soid)->get('sovw')->row_array();
        $partyrow = $this->db->where('partyid', $sorow['partyid'])->get('partyvw')->row_array();
        $sodetrow = $this->db->select('sodet.*,item_id2descr(itemid)itemname')->where('soid', $soid)->get('sodet')->result_array();

        ob_start();

?>
        <div class="text-center">
            <h1>Sale Invoice</h1>
        </div>
        <table class="ltable">
            <tbody>
                <tr>
                    <td width="50%">
                        <b>Sanskruti Agro Farm</b><br>
                        1101, Real Tech Park, Sec 30A,<br>
                        Vashi, Navi Mumbai, MH, 400703<br>
                        Contact: +91 88281 85708<br>
                        E-Mail: contact@sanskrutiagrofarm.com
                    </td>
                    <td width="50%">
                        <table class="ltable" style="height: max-content;">
                            <tbody>
                                <tr class="border">
                                    <td width="50%">Invoice No: <br><?= 'SAF-' . $sorow['soid'] ?></td>
                                    <td width="50%">Order Date: <br><?= nice_date($sorow['orderdate'], 'd-m-Y') ?></td>
                                </tr>
                                <tr class="border">
                                    <td width="50%">Delivery Date: <br><?= $sorow['deliverydate'] ?></td>
                                    <td width="50%">Terms of Payment:<br> <?= $sorow['paymentstatus'] ?></td>
                                </tr>
                                <tr class="border">
                                    <td width="50%">Reference No. & Date.:<br>&nbsp;</td>
                                    <td width="50%">Order Due Date:<br>&nbsp;</td>
                                </tr>
                                <tr class="border">
                                    <td width="50%">Buyer’s Order No.:<br>&nbsp;</td>
                                    <td width="50%">Destination: <br><?= $sorow['agent_name'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="border">
                    <td width="50%">
                        Buyer (Bill to)<br>
                        <b><?= $partyrow['descr'] ?></b><br>
                        <?= $partyrow['addressline1'] ?><br>
                        <?= $partyrow['addressline2'] ?>,<?= $partyrow['pincode'] ?><br>
                        Contact: <?= $partyrow['phone1'] ?><br>
                        E-Mail: <?= $partyrow['email'] ?><br>
                    <td width="50%">
                        <table class="ltable" style="height: max-content;">
                            <tbody>
                                <tr class="border">
                                    <td width="50%">Dispatch By:<br>&nbsp;</td>
                                    <td width="50%">Sales Agent:<br> <?= $sorow['agent_name'] ?></td>
                                </tr>
                                <tr class="border">
                                    <td width="50%">Dispatch through:<br>&nbsp;</td>
                                    <td width="50%">Destination: <br> <?= $partyrow['addressline2'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Item Details START. -->
        <table class="ltable">
            <thead>
                <tr>
                    <th align="center">Sr.</th>
                    <th align="center">Item ID</th>
                    <th align="center">Item Name</th>
                    <th align="center">Quantity</th>
                    <th align="center">Rate</th>
                    <th align="center">Discount</th>
                    <th align="center">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach ($sodetrow as $sodet) { ?>
                    <tr>
                        <td align="center" width="5%"><?= $sr++ ?></td>
                        <td align="center" width="10%"><?= $sodet['itemid'] ?></td>
                        <td align="center" width="45%"><?= $sodet['itemname'] ?></td>
                        <td align="right" width="10%"><?= $sodet['quantity'] ?></td>
                        <td align="right" width="10%"><?= $sodet['rate'] ?></td>
                        <td align="right" width="10%"><?= $sodet['discount'] ?></td>
                        <td align="right" width="10%"><?= $sodet['amount'] ?></td>
                    </tr>

                <?php }
                for ($i = $sr; $i < 20; $i++) { ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr class="border">
                    <td colspan="3" align="center">Total</td>
                    <td class="noborder" align="center"><?= array_sum(array_column($sodetrow, 'quantity')) ?></td>
                    <td colspan="3" align="right"><?= number_format(array_sum(array_column($sodetrow, 'amount')), 2); ?></td>
                </tr>
            </tfoot>
        </table>
        <div class="border">
            <p>Amount Chargeable (in words)</p>
            <p><?= amountInWords($sorow['amount']) ?></p>
        </div>
        <div class="border text-center">
            <p>Company’s Bank Details</p>
            <p>Account Name: -- SANSKRUTI AGRO FARM</p>
            <p>Account Number: -- 921020056876697</p>
            <p>IFSC Code: -- UTIB0004827</p>
        </div>
        <p class="text-center">THIS IS COMPUTER GENERATED INVOICE NO SIGNATURE REQUIRED</p>

<?php
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}

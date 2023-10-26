<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CRMController extends CRM_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		global $data;
		if (!$this->session->userdata('USERID')) {
			$this->load->view('login', $data);
			return;
		}

		// if ($this->users_auth->SUPER != 'Y') {
		// 	$this->db->where('created_by', $this->users_auth->USERID);
		// }

		if (isset($_SESSION['FROMDATE']) && isset($_SESSION['TODATE'])) {
			$this->db->where('orderdate>=', sqldate($_SESSION['FROMDATE'], 'd/m/Y', 'Y-m-d'));
			$this->db->where('orderdate<=', sqldate($_SESSION['TODATE'], 'd/m/Y', 'Y-m-d'));
		} else {
			$this->db->where('orderdate', date('Y-m-d'));
		}
		$this->db->where('orderstatus <>', 'CANCELLED');

		$this->db->order_by('soid', 'desc');
		$res = $this->db->get('sovw');

		if ($res->num_rows() > 0) {
			$res = $res->result_array();
			$pendingOrders = 0;
			$paidOrders = 0;
			// pr($res, 1);
			foreach ($res as $row) {
				if ($row['paymentstatus'] == 'Paid')
					$paidOrders += $row['amount'];
				if ($row['paymentstatus'] == 'Pending')
					$pendingOrders += $row['amount'];
			}
			$dashdata['totalOrders'] = count($res);
			$dashdata['totalPaid'] = number_format($paidOrders, 2);
			$dashdata['totalPending'] = number_format($pendingOrders, 2);
			$dashdata['totalRevenue'] = number_format(array_sum(array_column($res, 'amount')), 2);
			$dashdata['sorows'] = $res;
			$data['dashdata'] = $dashdata;
			// pr($data, 1);
		}

		$this->load->page('index', $data);
	}

	function crmform($FORMID, $NAVID)
	{
		check_login();
		global $data, $KNAVID, $KFORMID, $FORMROW;
		$KNAVID = $NAVID;
		$KFORMID = $FORMID;

		$res = $this->db->where('formid', $FORMID)->get('formdata');
		if ($res->num_rows() > 0) {
			$form = $FORMROW = $res->row();

			// Calling view method START.
			if (in_array(strtolower(@$_REQUEST['method']), array('view', 'revise'))) {
				$this->call_model('view', $KNAVID);
			}
			// Calling view method END.

			$type = !empty(@$_GET['method']) ? strtolower($_GET['method']) : 'view';
			$data['type'] = $type;
			$data['knavid'] = $KNAVID;
			$data['formid'] = $KFORMID;

			// Setting the header for datatable finder.
			$res = $this->db->where('navid', $KNAVID)->where('descr', 'find')->get('navfeatures');
			$navrow = $this->db->where('navid', $KNAVID)->get('nav');
			if ($res->num_rows() > 0) {
				$row = $res->row();
				$navrow = $navrow->row();
				$data['finderName'] = ucwords($navrow->descr);
				$data['finderHeader'] = explode(',', $row->visiblecolumns_descr);
			}

			$this->load->page($form->formurl, $data);
		} else {
			echo 'View is not defined!';
			return;
		}
	}

	function call_model($type, $KNAVID)
	{
		$res = $this->db->where('descr', strtolower($type))->where('navid', $KNAVID)->get('navfeatures');
		if ($res->num_rows() > 0) {
			$nav = $res->row();
			$functionName = $nav->functionname;
			$this->load->model($nav->modelname, 'modelname');
			$this->modelname->{$functionName}();
		}
	}

	function logout()
	{
		$this->users_auth->logout();
	}

	function report()
	{
		global $data;
		$res = $this->db->select('xreportid,descr,url')->get('xreport');
		if ($res->num_rows() > 0) {
			$data['reports'] = $res->result();
			$this->load->page('report/report', $data);
		}
	}

	function crmreport($xreportid, $template)
	{
		global $data;
		$data['is_report'] = true;
		$res = $this->db->where('xreportid', $xreportid)->get('xreport');
		if ($res->num_rows() > 0) {
			$data['reportrow'] = $res->row();
			$this->load->page('report/' . $template, $data);
		}
	}
}

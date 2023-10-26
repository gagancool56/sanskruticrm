<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CRM_Precontroller extends CI_Controller
{
	function __construct()
	{
	}
	public function index()
	{
		global $data, $KNAVID, $KFORMID;

		if (isset($_POST['FORMID']))
			$KFORMID = $_POST['FORMID'];
		if (isset($_POST['KNAVID']))
			$KNAVID = $_POST['KNAVID'];

		$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'view';
		$get = $_GET;
		if ($method == 'view') {
			$get['method'] = "revise";
		}

		$jdata = 'var site_url="' . base_url() . '";';
		$jdata .= 'var CRM_METHOD="' . strtoupper($method) . '";';
		if (cins()->users_auth->USERID) {
			$jdata .= 'var CRM_FINDERINNEWTAB="' . cins()->users_auth->ROW()->finderinnewtab . '";';
		}
		$jdata .= 'var current_url="' . current_url() . "/?" . http_build_query($get) . '";';
		$jdata .= 'var previous_url="' . base_url(@$_SERVER['PATH_INFO']) . '";';
		$jdata .= 'var crm={};';

		if (uri_string() == '' || uri_string() == 'dashboard') {
			$jdata .= 'var is_dashboard=true;';
		} else {
			$jdata .= 'var is_dashboard=false;';
		}

		$data['jdata'] = $jdata;
	}
}

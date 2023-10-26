<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrintController extends CRM_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function showprint($TABLE, $ID)
	{
		switch (strtoupper($TABLE)) {
			case 'SO':
				$this->load->model('Sale/Saleordermodel', 'sale');
				$this->sale->print_sale_order($ID);
				break;
		}
	}
}

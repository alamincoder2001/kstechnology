<?php defined('BASEPATH') or exit('No direct script access allowed');

class BarcodeController extends CI_Controller
{
	public function barcode_create($id)
	{
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		Zend_Barcode::render('Code128', 'image', array('text' => $id, 'barHeight' => 20, 'font' => 1), array());
	}
}

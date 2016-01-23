<?php
require_once(APPPATH . 'controllers/common.php');
class Frontend extends Common {
	
	/**
	* index
	*/
	public function index() {
		$this->arrCommon['mode'] = MODE_HOMEPAGE;
		
		// Get products
		$arrConditions = array(
			'status'	=>	1,
			'delete_flg'=>	0,
			'start'		=>	0,
			'end'		=>	12
		);
		$this->arrCommon['products'] = $this->products_model->search($arrConditions);
		
		
		$this->loadPage();
	}
}
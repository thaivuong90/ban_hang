<?php
class Apis extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('common','security'));
	}

	/**
	 * getList
	 * Enter description here ...
	 */
	public function getList() {

		$table = safe_data('table');
		$value = safe_data('value');
		$arrConditions = array();
		switch($table) {
				
			case 'categories':
			case 'titles':
				$arrConditions['delete_flg']	=	0;
				$arrConditions['status']		=	1;
				$arrConditions['parent']		=	$value;
				$this->db->select('id,name,order_by,parent');
				$this->db->where($arrConditions);
				$arrOutput = $this->db->get($table)->result_array();

				$maxOrderBy = getMaxValue('order_by',$table,$arrConditions) + 1;
				$html = '<option value="'.$maxOrderBy.'">--- Tự sắp xếp ---</option>';
				foreach($arrOutput as $output) {
					$html.='<option value="'.$output['order_by'].'">'.$output['name'].'</option>';
				}
				echo $html;
				break;
			case 'modules':
				$arrConditions['delete_flg']	=	0;
				$arrConditions['parent']		=	$value;
				$this->db->select('id,name,order_by,parent');
				$this->db->where($arrConditions);
				$arrOutput = $this->db->get($table)->result_array();

				$maxOrderBy = getMaxValue('order_by',$table,$arrConditions) + 1;
				$html = '<option value="'.$maxOrderBy.'">--- Tự sắp xếp ---</option>';
				foreach($arrOutput as $output) {
					$html.='<option value="'.$output['order_by'].'">'.$output['name'].'</option>';
				}
				echo $html;
				break;	
		}
	}
}
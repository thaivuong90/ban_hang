<?php

class menus_model extends CI_Model {

	/**
	 * search
	 */
	public function search($arrConditions = array(), $mode = '') {
		$SQL = '     SELECT             ';
		if ($mode == 'count') {
			$SQL .= '     COUNT(*) AS cnt             ';
		} else {
			$SQL .= '         b.id,             ';
			$SQL .= '         b.name,             ';
			$SQL .= '         DATE_FORMAT(b.create_at,\'%d-%m-%Y %H:%i:%S\') AS create_at,             ';
			$SQL .= '         b.status,             ';
			$SQL .= '         b.delete_flg,             ';
			$SQL .= '         b.order_by,             ';
			$SQL .= '         b.url,             ';
			$SQL .= '         u.username AS create_by             ';
		}
		$SQL .= '     FROM menus b             ';
		if ($mode != 'count') {
			$SQL .= '     LEFT OUTER JOIN users u             ';
			$SQL .= '     ON             ';
			$SQL .= '         u.id = b.create_by             ';
		}
		$SQL .= '    WHERE 1 = 1           ';
		if (isset($arrConditions['delete_flg']) && is_numeric($arrConditions['delete_flg'])) {
			$SQL .= '    AND b.delete_flg = '.$arrConditions['delete_flg'];
		}
		if (isset($arrConditions['id'])) {
			$SQL .= '    AND b.id =  ' . $arrConditions['id'];
		}
		if(isset($arrConditions['name'])) {
			$SQL .= '    AND b.encode LIKE '.$this->db->escape('%'.$arrConditions['name'].'%');
		}
		if (isset($arrConditions['datefrom']) && isset($arrConditions['dateto'])) {
			$SQL .= '    AND substr(b.create_at,1,8) >=  ' . $arrConditions['datefrom'];
			$SQL .= '    AND substr(b.create_at,1,8) <=  ' . $arrConditions['dateto'];
		}
		if (isset($arrConditions['status'])) {
			$SQL .= '    AND b.status =  ' . $arrConditions['status'];
		}
		if (isset($arrConditions['create_by'])) {
			$SQL .= '    AND b.create_by =  ' . $arrConditions['create_by'];
		}

		$SQL .= ' ORDER BY b.order_by';

		if (isset($arrConditions['start']) && isset($arrConditions['end'])) {
			$SQL .= ' LIMIT ' . $this->db->escape($arrConditions['start']) . ',' . $arrConditions['end'];
		}

		if ($mode == 'count') {
			$result = $this->db->query($SQL)->row_array();
			return $result['cnt'];
		}
		if ($mode == 'detail') {
			return $this->db->query($SQL)->row_array();
		}
		return $this->db->query($SQL)->result_array();
	}

	/**
	 * getAll
	 *
	 * Get 1 record trong $table voi dieu kien $wheres, sap xep theo $orderBy
	 *
	 * @param type $table
	 * @param type $arrWheres
	 * @param type $arrOrderBy
	 */
	public function getOne($arrWheres = array()) {

		if(count($arrWheres) > 0) {
			$this->db->where($arrWheres);
		}

		return $this->db->get('menus')->row_array();
	}

	/**
	 * getInsertUpdate
	 *
	 * @param type $arrData
	 * @return boolean
	 */
	public function getInsertUpdate($arrData = array()) {

		$this->db->trans_start();
		if($arrData['data']['order_by'] > 0) {
			$sql.= "	UPDATE menus 	";
			$sql.= "	SET order_by = order_by + 1 	";
			$sql.= "	where order_by >=  	".$arrData['data']['order_by'];
			$this->db->query($sql);
		} else {
			$arrData['data']['order_by'] = getMaxValue('order_by','menus') + 1;
				
		}
		if(!isset($arrData['data']['id']) || $arrData['data']['id'] == '') {
			setTime($arrData['data'], MODE_ADD);
			$this->db->insert('menus', $arrData['data']);

		} else {
			setTime($arrData, MODE_EDIT);
			$this->db->where('id', $arrData['data']['id']);
			$this->db->update('menus', $arrData['data']);
		}



		if ($this->db->trans_complete()) {
			return true;
		}
	}

	/**
	 * getDelete
	 */
	public function getDelete($mode) {

		$this->db->trans_start();
		$arrCheck = $this->input->post('checkAll');
		for ($i = 0; $i < count($arrCheck); $i++) {

			$arrBrandCategory = array(
                'category_id' => $arrCheck[$i]
			);
			$arrCategory = array(
                'id' => $arrCheck[$i]
			);

			if ($mode == MODE_DELETE) {
				$arrDt = array(
                    'delete_flg' => 1
				);
				setTime($arrDt, MODE_DELETE);
				$this->db->update('menus', $arrDt, $arrCategory);
			} else {
				$this->db->delete('menus', $arrCategory);
				$this->db->delete('brand_category', $arrBrandCategory);
			}
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	/**
	 * getDelete
	 */
	public function getRefresh() {
		$this->db->trans_start();
		$arrCheck = $this->input->post('checkAll');

		for ($i = 0; $i < count($arrCheck); $i++) {
			$arrBrands = array(
                'id' => $arrCheck[$i]
			);
			$arrDt = array(
                'delete_flg' => 0
			);
			setTime($arrDt, MODE_EDIT);
			$this->db->update('menus', $arrDt, $arrBrands);
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	private function setIcon(&$arrOutput = array(),$icon) {
		if($icon != '') {
			$arrOutput['icon'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$icon;
		} else {
			$arrOutput['icon'] = ICON;
		}
	}


}

?>

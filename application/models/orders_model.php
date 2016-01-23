<?php

class Orders_model extends CI_Model {

	/**
	 * getSQL
	 * @param type $arrConditions
	 * @return string
	 */
	public function search($arrConditions = array(),$mode = '') {
		$SQL = '     SELECT             ';
		if ($mode == 'count') {
			$SQL .= '     COUNT(*) AS cnt             ';
		} else {
			$SQL .= '         b.id,             ';
			$SQL .= '         b.order_id,             ';
			$SQL .= '         b.total_qty,             ';
			$SQL .= '         b.total_money,             ';
			$SQL .= '         CONCAT(b.tax_rt,"%")  AS tax_rt,             ';
			$SQL .= '         b.msg,             ';
			$SQL .= '         b.status,             ';
			$SQL .= '         b.delete_flg,             ';
			$SQL .= '         DATE_FORMAT(b.create_at,\'%d-%m-%Y %H:%i:%S\') AS create_at,             ';
			$SQL .= '         DATE_FORMAT(b.delivery_at,\'%d-%m-%Y %H:%i:%S\') AS delivery_at,             ';
			$SQL .= '         b.delete_flg,             ';

			if ($mode == 'detail') {
				$SQL .= '         do.product_id,             ';
				$SQL .= '         do.qty,             ';
				$SQL .= '         do.price,             ';
				$SQL .= '         do.sub_total,             ';
				$SQL .= '         p.name as product_name,             ';
			}

			$SQL .= '         u.name  as customer_name,             ';
			$SQL .= '         u.address  as customer_address,             ';
			$SQL .= '         u.phone  as customer_phone             ';
		}
		$SQL .= '     FROM orders b             ';
		if ($mode == 'detail') {
			$SQL .= '     LEFT OUTER JOIN detail_orders do             ';
			$SQL .= '     ON             ';
			$SQL .= '         do.order_id = b.order_id             ';
			$SQL .= '     LEFT OUTER JOIN products p             ';
			$SQL .= '     ON             ';
			$SQL .= '         p.id = do.product_id             ';
		}
		if ($mode != 'count') {
			$SQL .= '     LEFT OUTER JOIN users u             ';
			$SQL .= '     ON             ';
			$SQL .= '         u.id = b.create_by             ';
		}
		$SQL .= '    WHERE 1 = 1           ';
		if (isset($arrConditions['delete_flg']) && is_numeric($arrConditions['delete_flg'])) {
			$SQL .= '    AND b.delete_flg = '.$arrConditions['delete_flg'];
		}
		if(isset($arrConditions['name'])) {
			$SQL .= '    AND u.encode LIKE '.$this->db->escape('%'.$arrConditions['name'].'%');
		}
		if(isset($arrConditions['id'])) {
			$SQL .= '    AND b.id = '.$this->db->escape($arrConditions['id']);
		}
		if(isset($arrConditions['order_id'])) {
			$SQL .= '    AND b.order_id = '.$this->db->escape($arrConditions['order_id']);
		}
		if(isset($arrConditions['status'])) {
			$SQL .= '    AND b.status = '.$this->db->escape($arrConditions['status']);
		}
		if (isset($arrConditions['datefrom']) && isset($arrConditions['dateto'])) {
			$SQL .= '    AND substr(b.create_at,1,8) >=  ' . $this->db->escape(cnvDateToString($arrConditions['datefrom']));
			$SQL .= '    AND substr(b.create_at,1,8) <=  ' . $this->db->escape(cnvDateToString($arrConditions['dateto']));
		}
		if (isset($arrConditions['deliveryfrom']) && isset($arrConditions['deliveryto'])) {
			$SQL .= '    AND substr(b.delivery_at,1,8) >=  ' . $this->db->escape(cnvDateToString($arrConditions['deliveryfrom']));
			$SQL .= '    AND substr(b.delivery_at,1,8) <=  ' . $this->db->escape(cnvDateToString($arrConditions['deliveryto']));
		}
		$SQL .= ' ORDER BY b.create_at DESC';

		if (isset($arrConditions['start']) && isset($arrConditions['end'])) {
			$SQL .= ' LIMIT ' . $this->db->escape($arrConditions['start']) . ',' . $arrConditions['end'];
		}

		if ($mode == 'count') {
			$result = $this->db->query($SQL)->row_array();
			return $result['cnt'];
		}
		return $this->db->query($SQL)->result_array();
	}

	/**
	 * getInsertUpdate
	 *
	 * @param type $arrData
	 * @return boolean
	 */
	public function getInsertUpdate($arrData = array()) {

		$this->db->trans_start();
		unset($arrData['data']['customer_name']);
		unset($arrData['data']['customer_address']);
		unset($arrData['data']['customer_phone']);
		if(!isset($arrData['data']['id']) || $arrData['data']['id'] == '') {
			setTime($arrData['data'], MODE_ADD);
			$this->db->insert('orders', $arrData['data']);
		} else {
			setTime($arrData, MODE_EDIT);
			$this->db->where('id', $arrData['data']['id']);
			$this->db->update('orders', $arrData['data']);
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
			$this->db->update('orders', $arrDt, $arrBrands);
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	/**
	 * getDelete
	 */
	public function getDelete($mode = '') {
		$this->db->trans_start();
		$arrCheck = $this->input->post('checkAll');

		for ($i = 0; $i < count($arrCheck); $i++) {
			$arrWhere = array(
                'id' => $arrCheck[$i]
			);
			if ($mode == MODE_DELETE) {
				$arrDt = array(
                    'delete_flg' => 1
				);
				setTime($arrDt, MODE_DELETE);
				$this->db->update('orders', $arrDt, $arrWhere);
			} else if ($mode == MODE_DELETE_DB) {
				$this->db->delete('orders', $arrWhere);
			}
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

}

?>

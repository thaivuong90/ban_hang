<?php
/**
 * Common_model
 *
 * Lop model su dung cho toan project
 */
class Common_model extends CI_Model
{
	/**
	 * deleteDb
	 */
	public function deleteDb($table = '',$arrCheck = array()) {
		$this->db->trans_start();
		$cnt = count($arrCheck);
		for($i = 0; $i < $cnt; $i++) {

			// Xóa data tại bảng role_module
			if($table == 'modules') {
				$this->db->where('module_id',$arrCheck[$i]);
				$this->db->delete('role_module');
			}

			// Xóa data tại bảng brand_category
			if($table == 'categories') {
				$this->db->where('category_id',$arrCheck[$i]);
				$this->db->delete('brand_category');
			}

			// Xóa data tại bảng brand_category
			if($table == 'brands') {
				$this->db->where('brand_id',$arrCheck[$i]);
				$this->db->delete('brand_category');
			}

			$this->db->where('id',$arrCheck[$i]);
			$this->db->delete($table);
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	/**
	 * refresh
	 */
	public function updateDeleteFlg($table = '',$arrCheck = array(),$delete_flg = 0) {
		$this->db->trans_start();
		$cnt = count($arrCheck);
		for($i = 0; $i < $cnt; $i++) {
			$arrEdit['delete_flg'] = $delete_flg;
			setTime($arrEdit,MODE_EDIT);
			$this->db->where('id',$arrCheck[$i]);
			$this->db->update($table,$arrEdit);
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	/**
	 * updateStatus
	 */
	public function updateStatus($table = '',$arrCheck = array(),$status = 1) {
		$this->db->trans_start();
		$cnt = count($arrCheck);
		for($i = 0; $i < $cnt; $i++) {
			$arrEdit['status'] = $status;
			setTime($arrEdit,MODE_EDIT);
			$this->db->where('id',$arrCheck[$i]);
			$this->db->update($table,$arrEdit);
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	/**
	 * dashboard
	 */
	public function getInfoDashboard() {
		$SQL = '';
		$SQL.= ' SELECT ';
		$SQL.= ' ( ';
		$SQL.= ' 	SELECT COUNT(*) ';
		$SQL.= ' 	FROM orders ';
		$SQL.= ' ) AS order_cnt, ';
		$SQL.= ' ( ';
		$SQL.= ' 	SELECT SUM(orders.total_money) ';
		$SQL.= ' 	FROM orders ';
		$SQL.= ' ) AS order_sales, ';
		$SQL.= ' ( ';
		$SQL.= ' 	SELECT COUNT(*) ';
		$SQL.= ' 	FROM users ';
		$SQL.= ' 	WHERE role_id = 3  ';
		$SQL.= ' ) AS customers, ';
		$SQL.= ' ( ';
		$SQL.= ' 	SELECT COUNT(*) ';
		$SQL.= ' 	FROM online ';
		$SQL.= ' 	WHERE visit_at BETWEEN  20150108202430 AND 20150108202930 ';
		$SQL.= ' ) AS online ';
		$SQL.= ' FROM DUAL ';

		$rs = $this->db->query($SQL)->row_array();

		// Get lastest orders
		$SQL2 = '';
		$SQL2 .= ' SELECT ';
		$SQL2 .= ' 	o.order_id, ';
		$SQL2 .= ' 	u.name AS customer_name, ';
		$SQL2 .= ' 	DATE_FORMAT(o.create_at,\'%d-%m-%Y %H:%i:%S\') AS create_at, ';
		$SQL2 .= ' 	o.total_money, ';
		$SQL2 .= ' 	o.status ';
		$SQL2 .= ' FROM orders o ';
		$SQL2 .= ' LEFT JOIN users u ';
		$SQL2 .= ' ON ';
		$SQL2 .= ' 	u.id = o.create_by ';
		$SQL2 .= ' WHERE o.status = 1 ';
		$rs['lastest_orders'] = $this->db->query($SQL2)->result_array();
		
		return $rs;
	}
}
?>

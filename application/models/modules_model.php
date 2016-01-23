<?php
class Modules_model extends CI_Model {

	/**
	 * search
	 */
	public function search($arrConditions = array(),$mode = '') {

		$SQL = '    SELECT            ';
		if($mode == 'count') {
			$SQL .= '    COUNT(*)  AS cnt           ';
		} else {
			$SQL .= '        m.id,           ';
			$SQL .= '        m.name,           ';
			$SQL .= '        DATE_FORMAT(m.create_at,\'%d-%m-%Y %H:%i:%S\') AS create_at ,           ';
			$SQL .= '        m.status,           ';
			$SQL .= '        u.username     AS create_by,           ';
			$SQL .= '        m.delete_flg,             ';
			$SQL .= '        m.order_by,             ';
			$SQL .= '        m1.name        AS parent,          ';
			$SQL .= '        m.icon        AS icon,          ';
			$SQL .= '        m.is_group        AS is_group,          ';
			$SQL .= '        m.url        AS url,          ';
			$SQL .= '        m.parent      ,          ';
			$SQL .= '        m1.name AS parent_name,           ';
			$SQL .= '        m.delete_flg    AS delete_flg          ';
		}
		$SQL .= '    FROM modules m           ';
		$SQL .= '    LEFT OUTER JOIN users u           ';
		$SQL .= '    ON           ';
		$SQL .= '        u.id = m.create_by           ';
		$SQL .= '    LEFT OUTER JOIN modules m1           ';
		$SQL .= '    ON           ';
		$SQL .= '        m1.id = m.parent           ';
		$SQL .= '    WHERE 1 = 1           ';
		if (isset($arrConditions['delete_flg']) && $arrConditions['delete_flg'] == 1) {
			$SQL .= '    AND m.delete_flg = 1           ';
		} else {
			$SQL .= '    AND m.delete_flg = 0           ';
		}
		if(isset($arrConditions['id'])) {
			$SQL .= '    AND m.id =  '.$this->db->escape($arrConditions['id']);
		}
		if(isset($arrConditions['name'])) {
			$SQL .= '    AND m.encode LIKE '.$this->db->escape('%'.$arrConditions['name'].'%');
		}
		if(isset($arrConditions['datefrom']) && isset($arrConditions['dateto'])) {
			$SQL .= '    AND substr(m.create_at,1,8) >=  '.$this->db->escape(cnvDateToString($arrConditions['datefrom']));
			$SQL .= '    AND substr(m.create_at,1,8) <=  '.$this->db->escape(cnvDateToString($arrConditions['dateto']));
		}
		if(isset($arrConditions['status'])) {
			$SQL .= '    AND m.status =  '.$this->db->escape($arrConditions['status']);
		}
		if(isset($arrConditions['parent'])) {
			$SQL .= '    AND m.parent =  '.$this->db->escape($arrConditions['parent']);
		}
		if(isset($arrConditions['create_by'])) {
			$SQL .= '    AND m.create_by =  '.$this->db->escape($arrConditions['create_by']);
		}

		$SQL .= ' ORDER BY m.order_by ';

		if(isset($arrConditions['start']) && isset($arrConditions['end'])) {
			$SQL .= ' LIMIT '.$this->db->escape($arrConditions['start']).','.$arrConditions['end'];
		}
		if($mode == 'count') {
			$result = $this->db->query($SQL)->row_array();
			return $result['cnt'];
		}
		if ($mode == 'detail') {
			$arrOutput = $this->db->query($SQL)->row_array();
			return $arrOutput;
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

		return $this->db->get('modules')->row_array();
	}

	/**
	 * getInsertUpdate
	 *
	 * @param type $arrData
	 * @return boolean
	 */
	public function getInsertUpdate($arrData = array()) {
		$arrBase = array();
		if(isset($arrData['data']['base'])) {
			$arrBase = $arrData['data']['base'];
		}
		$this->db->trans_start();
		$sql = '';
		if($arrData['data']['order_by'] > 0) {
			$sql.= "	UPDATE modules 	";
			$sql.= "	SET order_by = order_by + 1 	";
			$sql.= "	where order_by >=  	".$arrData['data']['order_by'].' AND parent = '.$arrData['data']['parent'];
			$this->db->query($sql);
		} else {
			$arrData['data']['order_by'] = getMaxValue('order_by','modules',array('parent' => $arrData['data']['parent'])) + 1;
		}

		$this->db->select('icon');
		$icon = $this->db->get_where('modules',array('id' => $arrData['data']['parent']))->row_array();
		if(!isset($arrData['data']['id']) || $arrData['data']['id'] == '') {
			setTime($arrData['data'], MODE_ADD);
			if(!isset($arrData['data']['is_group']) || $arrData['data']['is_group'] != 1) {
				$this->setIcon($arrData['data'],$icon['icon']);
			}
			unset($arrData['data']['base']);
			$this->db->insert('modules',$arrData['data']);
			$parent_id = $this->db->insert_id();
			// Insert base modules
			$orderBy = getMaxValue('order_by','modules',array('parent' => $parent_id));
			$cntBase = count($arrBase);
			if($cntBase > 0) {
				for($i = 0; $i < $cntBase; $i++) {
					$name = '';
					$url  = '';
					$status = 0;
					switch($arrBase[$i]) {

						case MODE_ADD:
							$name = 'Đăng ký '.strtolower($arrData['data']['name']);
							$url  = $arrData['data']['url'].'/'.MODE_ADD;
							$status = 1;
							break;

						case MODE_EDIT:
							$name = 'Chỉnh sửa '.strtolower($arrData['data']['name']);
							$url  = $arrData['data']['url'].'/'.MODE_EDIT;
							break;

						case MODE_DELETE:
							$name = 'Xóa '.strtolower($arrData['data']['name']);
							$url  = $arrData['data']['url'].'/'.MODE_DELETE;
							break;

						case MODE_SEARCH:
							$name = 'Tìm kiếm '.strtolower($arrData['data']['name']);
							$url  = $arrData['data']['url'].'/'.MODE_SEARCH;
							break;

						case MODE_ENABLE:
							$name = 'Hiển thị '.strtolower($arrData['data']['name']);
							$url  = $arrData['data']['url'].'/'.MODE_ENABLE;
							break;

						case MODE_DISABLE:
							$name = 'Ẩn '.strtolower($arrData['data']['name']);
							$url  = $arrData['data']['url'].'/'.MODE_DISABLE;
							break;

						case MODE_TRASH:
							$name = $arrData['data']['name'].' đã xóa';
							$url  = $arrData['data']['url'].'/'.MODE_TRASH;
							$status = 1;
							break;

						case MODE_REFRESH:
							$name = 'Phục hồi '.strtolower($arrData['data']['name']);
							$url  = $arrData['data']['url'].'/'.MODE_REFRESH;
							break;

						case MODE_DESTROY:
							$name = 'Hủy '.strtolower($arrData['data']['name']);
							$url  = $arrData['data']['url'].'/'.MODE_DESTROY;
							break;
					}
					$orderBy ++;
					$arrSub = array(
                        'name'          =>  $name,
                        'encode'        =>  friendlyUrl($name),
                        'url'           =>  $url,
                        'status'        =>  $status,
                        'delete_flg'    =>  0,
                        'parent'        =>  $parent_id,
                        'is_group'      =>  0,
                        'icon'          =>  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ICON,
                    	'order_by'		=>	$orderBy
					);
					setTime($arrSub,MODE_ADD);
					$this->db->insert('modules',$arrSub);
				}
			}
		} else {
			setTime($arrData, MODE_EDIT);
			if($arrData['data']['is_group'] != 1) {
				$this->setIcon($arrData['data'],$icon['icon']);
			}
			$this->db->where('id',$arrData['data']['id']);
			$this->db->update('modules',$arrData['data']);
		}
		if($this->db->trans_complete()) {
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

			$arrRoleModule = array(
                'module_id' => $arrCheck[$i]
			);
			$arrModule = array(
                'id' => $arrCheck[$i]
			);
			if ($mode == MODE_DELETE) {
				$arrDt = array(
                    'delete_flg' => 1
				);
				setTime($arrDt, MODE_DELETE);
				$this->db->update('modules', $arrDt, $arrModule);
			} else if ($mode == MODE_DELETE_DB) {
				$this->db->delete('modules', $arrModule);
				$this->db->delete('role_module', $arrRoleModule);
			}

		}
		if($this->db->trans_complete()) {
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
			$this->db->update('modules', $arrDt, $arrBrands);
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

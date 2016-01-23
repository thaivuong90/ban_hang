<?php
class Roles_model extends CI_Model {

	/**
	 * search
	 */
	public function search($arrConditions = array(),$mode = '') {

		$SQL =   '     SELECT             ';
		if($mode == 'count') {
			$SQL .=   '     COUNT(*) AS cnt             ';
		} else {
			$SQL .=   '         b.id,             ';
			$SQL .=   '         b.name,             ';
			$SQL .=   '         DATE_FORMAT(b.create_at,\'%d-%m-%Y %H:%i:%S\') AS create_at,             ';
			$SQL .=   '         b.status,             ';
			$SQL .=   '         u.username AS create_by,             ';
			$SQL .= '           b.delete_flg             ';
		}
		$SQL .=   '     FROM roles b             ';
		$SQL .=   '     LEFT OUTER JOIN users u             ';
		$SQL .=   '     ON             ';
		$SQL .=   '         u.id = b.create_by             ';
		$SQL .= '    WHERE 1 = 1           ';
		if (isset($arrConditions['delete_flg']) && $arrConditions['delete_flg'] == 1) {
			$SQL .= '    AND b.delete_flg = 1           ';
		} else {
			$SQL .= '    AND b.delete_flg = 0           ';
		}
		if(isset($arrConditions['id'])) {
			$SQL .= '    AND b.id =  '.$this->db->escape($arrConditions['id']);
		}
		if(isset($arrConditions['datefrom']) && isset($arrConditions['dateto'])) {
			$SQL .= '    AND substr(b.create_at,1,8) >=  '.$this->db->escape(cnvDateToString($arrConditions['datefrom']));
			$SQL .= '    AND substr(b.create_at,1,8) <=  '.$this->db->escape(cnvDateToString($arrConditions['dateto']));
		}
		if(isset($arrConditions['status'])) {
			$SQL .= '    AND b.status =  '.$this->db->escape(isset($arrConditions['status']));
		}
		if(isset($arrConditions['create_by'])) {
			$SQL .= '    AND b.create_by =  '.$this->db->escape($arrConditions['create_by']);
		}

		$SQL .= ' ORDER BY b.create_at DESC ';

		if(isset($arrConditions['start']) && isset($arrConditions['end'])) {
			$SQL .= ' LIMIT '.$this->db->escape($arrConditions['start']).','.$arrConditions['end'];
		}

		if($mode == 'count') {
			$result = $this->db->query($SQL)->row_array();
			return $result['cnt'];
		}
		if ($mode == 'detail') {
			$arrOutput = array_merge($this->db->query($SQL)->row_array(),$this->getAccessUrl($arrConditions['id']));
			return $arrOutput;
		}
		return $this->db->query($SQL)->result_array();

	}

	/**
	 * getAccessUrl
	 * @param type $arrOutput
	 * @param type $role_id
	 */
	public function getAccessUrl($role_id = '') {
		
		$arrOutput = array();
		
		$this->db->select('modules.id as module_id,CONCAT(\'' . base_url() . '\',modules.url) AS url');
		$this->db->from('modules');
		$this->db->join('role_module','role_module.module_id = modules.id');
		$this->db->where('role_module.role_id',$role_id);
		$arrOutput['modules']    = $this->db->get()->result_array();
		$arrOutput['url_access'] = array();
		$cnt = count($arrOutput['modules']);
		for($i = 0; $i < $cnt; $i++) {
			$arrOutput['url_access'][] = $arrOutput['modules'][$i]['url'];
			$arrOutput['selected_modules'][] = $arrOutput['modules'][$i]['module_id'];
		}
		
		return $arrOutput;
	}

	/**
	 * getInsertUpdate
	 *
	 * @param type $arrData
	 * @return boolean
	 */
	public function getInsertUpdate($arrData = array()) {

		$this->db->trans_start();
		if(!isset($arrData['data']['id']) || $arrData['data']['id'] == '') {
			setTime($arrData['data'], MODE_ADD);
			$this->db->insert('roles',$arrData['data']);
			$role_id = $this->db->insert_id();
			if(isset($arrData['data']['modules'])) {
				$cnt = count($arrData['data']['modules']);
				for($i = 0; $i < $cnt; $i++) {
					$arrRoleModule = array(
                        'role_id'   =>  $role_id,
                        'module_id' =>  $arrData['data']['modules'][$i]
					);
					$this->db->insert('role_module',$arrRoleModule);
				}
			}
		} else {
			setTime($arrData, MODE_EDIT);

			// Insert to role_module tbl
			$this->db->where(array('role_id' => $arrData['data']['id']));
			$this->db->delete('role_module');
			if(isset($arrData['data']['modules'])) {
				$cnt = count($arrData['data']['modules']);
				for($i = 0; $i < $cnt; $i++) {
					$arrRoleModule = array(
                        'role_id'   =>  $arrData['data']['id'],
                        'module_id' =>  $arrData['data']['modules'][$i]
					);
					$this->db->insert('role_module',$arrRoleModule);
				}
			}

			// Insert to roles tbl
			$this->db->where('id',$arrData['data']['id']);
			unset($arrData['data']['modules']);
			$this->db->update('roles',$arrData['data']);



		}
		if($this->db->trans_complete()) {
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
			$arrRoleModule = array(
                'role_id' => $arrCheck[$i]
			);
			$arrRole = array(
                'id' => $arrCheck[$i]
			);
			if ($mode == MODE_DELETE) {
				$arrDt = array(
                    'delete_flg' => 1
				);
				setTime($arrDt, MODE_DELETE);
				$this->db->update('roles', $arrDt, $arrRole);
			} else if ($mode == MODE_DELETE_DB) {
				$this->db->delete('roles', $arrRole);
				$this->db->delete('role_module', $arrRoleModule);
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
			$this->db->update('roles', $arrDt, $arrBrands);
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}
}
?>

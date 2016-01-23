<?php
class advs_model extends CI_Model {

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
			$SQL .=   '         b.url,             ';
			$SQL .=   '         b.file_id,             ';
			$SQL .=   '         b.desc,             ';
			$SQL .=   '         b.start_at,             ';
			$SQL .=   '         b.finish_at,             ';
			$SQL .=   '         DATE_FORMAT(b.create_at,\'%d-%m-%Y %H:%i:%S\') AS create_at,             ';
			$SQL .=   '         b.status,             ';
			$SQL .=   '         u.username AS create_by,             ';
			$SQL .= '           b.delete_flg,             ';
			$SQL .= '         CASE             ';
			$SQL .= '         WHEN f.path IS NOT NULL THEN CONCAT(\'' . base_url() . '\',f.path,f.filename)               ';
			$SQL .= '         ELSE CONCAT(\'' . base_url() . '\',\''.NO_IMG_URL.'\')           ';
			$SQL .= '         END   AS file_url           ';
		}
		$SQL .=   '     FROM advs b             ';
		$SQL .=   '     LEFT OUTER JOIN users u             ';
		$SQL .=   '     ON             ';
		$SQL .=   '         u.id = b.create_by             ';
		$SQL .= '     LEFT OUTER JOIN files f             ';
		$SQL .= '     ON             ';
		$SQL .= '         f.id = b.file_id             ';
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
			$arrOutput = $this->db->query($SQL)->row_array();
			return $arrOutput;
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

		if(!isset($arrData['data']['id']) || $arrData['data']['id'] == '') {
			setTime($arrData['data'], MODE_ADD);
			$this->db->insert('advs',$arrData['data']);
		} else {
			setTime($arrData, MODE_EDIT);
			// Insert to advs tbl
			$this->db->where('id',$arrData['data']['id']);
			$this->db->update('advs',$arrData['data']);

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
			$this->db->where('id', $arrCheck[$i]);
			$this->db->update('advs', array('delete_flg' => 1));
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
			$this->db->update('advs', $arrDt, $arrBrands);
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}
}
?>

<?php

class News_model extends CI_Model {

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
			$SQL .= '         b.order_by,             ';
			$SQL .= '         b.delete_flg,             ';
			$SQL .= '         b.title_id,             ';
			$SQL .= '         b.content,             ';
			$SQL .= '         b.meta_title,             ';
			$SQL .= '         b.meta_keywords,             ';
			$SQL .= '         b.meta_desc,             ';
			$SQL .= '         u.username AS create_by,             ';
			$SQL .= '         DATE_FORMAT(b.publish_at,\'%d-%m-%Y %H:%i:%S\') AS publish_at,             ';
			$SQL .= '         b.publish_by,             ';
			$SQL .= '         CASE WHEN p.username IS NOT NULL THEN p.username ELSE \'-\' END AS publish_by,             ';
			$SQL .= '         t.name  as title_name,             ';
			$SQL .= '         CASE WHEN b.img IS NOT NULL THEN CONCAT(\''.base_url().'\',\''.UPLOAD_NEWS_PATH.'\',b.img) ELSE CONCAT(\''.base_url().'\',\''.NO_IMG_URL.' \') END AS file_url              ';
		}
		$SQL .= '     FROM news b             ';
		if ($mode != 'count') {
			$SQL .= '     LEFT OUTER JOIN users u             ';
			$SQL .= '     ON             ';
			$SQL .= '         u.id = b.create_by             ';
			$SQL .= '     LEFT OUTER JOIN users p             ';
			$SQL .= '     ON             ';
			$SQL .= '         p.id = b.publish_by             ';
			$SQL .= '     LEFT OUTER JOIN titles t             ';
			$SQL .= '     ON             ';
			$SQL .= '         t.id = b.title_id             ';
		}
		$SQL .= '    WHERE 1 = 1           ';
		if (isset($arrConditions['delete_flg']) && is_numeric($arrConditions['delete_flg'])) {
			$SQL .= '    AND b.delete_flg = '.$arrConditions['delete_flg'];
		}
		if(isset($arrConditions['name'])) {
			$SQL .= '    AND b.encode LIKE '.$this->db->escape('%'.$arrConditions['name'].'%');
		}
		if(isset($arrConditions['title_id'])) {
			$SQL .= '    AND b.title_id = '.$this->db->escape($arrConditions['title_id']);
		}
		if(isset($arrConditions['status'])) {
			$SQL .= '    AND b.status = '.$this->db->escape($arrConditions['status']);
		}
		if (isset($arrConditions['datefrom']) && isset($arrConditions['dateto'])) {
			$SQL .= '    AND substr(b.create_at,1,8) >=  ' . $this->db->escape(cnvDateToString($arrConditions['datefrom']));
			$SQL .= '    AND substr(b.create_at,1,8) <=  ' . $this->db->escape(cnvDateToString($arrConditions['dateto']));
		}
		if (isset($arrConditions['publishfrom']) && isset($arrConditions['publishto'])) {
			$SQL .= '    AND substr(b.publish_at,1,8) >=  ' . $this->db->escape(cnvDateToString($arrConditions['publishfrom']));
			$SQL .= '    AND substr(b.publish_at,1,8) <=  ' . $this->db->escape(cnvDateToString($arrConditions['publishto']));
		}
		$SQL .= ' ORDER BY b.order_by DESC';

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
	 * getInsertUpdate
	 *
	 * @param type $arrData
	 * @return boolean
	 */
	public function getInsertUpdate($arrData = array()) {

		$this->db->trans_start();
		if($arrData['data']['order_by'] > 0) {
			$sql.= "	UPDATE news 	";
			$sql.= "	SET order_by = order_by + 1 	";
			$sql.= "	where order_by >=  	".$arrData['data']['order_by'];
			$this->db->query($sql);
		} else {
			$arrData['data']['order_by'] = getMaxValue('order_by','news') + 1;

		}

		if(!isset($arrData['data']['id']) || $arrData['data']['id'] == '') {
			setTime($arrData['data'], MODE_ADD);
			if(!isset($arrData['data']['publish_at']) || $arrData['data']['publish_at'] == '') {
				$arrData['data']['publish_at'] = $arrData['data']['create_at'];
				if(isset($arrData['data']['status']) && $arrData['data']['status'] == 1) {
					$arrData['data']['publish_by'] = getCurrentUserId();
				}
			}
			$this->db->insert('news', $arrData['data']);
		} else {
			setTime($arrData, MODE_EDIT);
			if(isset($arrData['data']['status']) && $arrData['data']['status'] == 1) {
				$arrData['data']['publish_by'] = getCurrentUserId();
			}
			$this->db->where('id', $arrData['data']['id']);
			$this->db->update('news', $arrData['data']);
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
			$this->db->update('news', $arrDt, $arrBrands);
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
			$arrFilesWhere = array(
                'owner_id' => $arrCheck[$i],
                'table_id' => 'news'
                );
                $arrWhere = array(
                'id' => $arrCheck[$i]
                );
                if ($mode == MODE_DELETE) {
                	$arrDt = array(
                    'delete_flg' => 1
                	);
                	setTime($arrDt, MODE_DELETE);
                	$this->db->update('news', $arrDt, $arrWhere);
                } else if ($mode == MODE_DELETE_DB) {
                	$this->db->delete('news', $arrWhere);
                	deleteFiles($arrFilesWhere);
                }
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

}

?>

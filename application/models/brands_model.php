<?php

class Brands_model extends CI_Model {

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
			$SQL .= '         b.meta_title,             ';
			$SQL .= '         b.meta_keywords,             ';
			$SQL .= '         b.meta_desc,             ';
			$SQL .= '         b.desc,             ';
			$SQL .= '         u.username AS create_by,             ';
			$SQL .= '         CASE WHEN b.img IS NOT NULL THEN CONCAT(\''.base_url().'\',\''.UPLOAD_BRANDS_PATH.'\',b.img) ELSE CONCAT(\''.base_url().'\',\''.NO_IMG_URL.' \') END AS file_url              ';
		}
		$SQL .= '     FROM brands b             ';
		$SQL .= '     LEFT OUTER JOIN users u             ';
		$SQL .= '     ON             ';
		$SQL .= '         u.id = b.create_by             ';
		if (isset($arrConditions['category_id'])) {
			$SQL .= '     LEFT OUTER JOIN brand_category bc             ';
			$SQL .= '     ON             ';
			$SQL .= '         bc.brand_id = b.id             ';
		}
		$SQL .= '    WHERE 1 = 1           ';
		if (isset($arrConditions['delete_flg']) && $arrConditions['delete_flg'] == 1) {
			$SQL .= '    AND b.delete_flg = 1           ';
		} else {
			$SQL .= '    AND b.delete_flg = 0           ';
		}
		if (isset($arrConditions['id'])) {
			$SQL .= '    AND b.id =  ' . $this->db->escape($arrConditions['id']);
		}
		if(isset($arrConditions['name'])) {
			$SQL .= '    AND b.encode LIKE '.$this->db->escape('%'.$arrConditions['name'].'%');
		}
		if (isset($arrConditions['datefrom']) != '' && isset($arrConditions['dateto']) != '') {
			$SQL .= '    AND substr(b.create_at,1,8) >=  ' . $this->db->escape(cnvDateToString($arrConditions['datefrom']));
			$SQL .= '    AND substr(b.create_at,1,8) <=  ' . $this->db->escape(cnvDateToString($arrConditions['dateto']));
		}
		if (isset($arrConditions['status'])) {
			$SQL .= '    AND b.status =  ' . $this->db->escape($arrConditions['status']);
		}
		if (isset($arrConditions['category_id'])) {
			$SQL .= '    AND bc.category_id =  ' . $this->db->escape($arrConditions['category_id']);
		}
		if (isset($arrConditions['create_by'])) {
			$SQL .= '    AND b.create_by =  ' . $this->db->escape($arrConditions['create_by']);
		}

		$SQL .= ' ORDER BY b.order_by DESC ';

		if (isset($arrConditions['start']) && isset($arrConditions['end'])) {
			$SQL .= ' LIMIT ' . $this->db->escape($arrConditions['start']) . ',' . $arrConditions['end'];
		}

		if ($mode == 'count') {
			$result = $this->db->query($SQL)->row_array();
			return $result['cnt'];
		}
		if ($mode == 'detail') {
			$arrOutput = $this->db->query($SQL)->row_array();
			$categories = $this->db->get_where('brand_category',array('brand_id' => $arrConditions['id']))->result_array();
			foreach($categories as $output) {
				$arrOutput['categories'][] = $output['category_id'];
			}
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
		$sql = '';
		if($arrData['data']['order_by'] > 0) {
			$sql.= "	UPDATE brands 	";
			$sql.= "	SET order_by = order_by + 1 	";
			$sql.= "	where order_by >=  	".$arrData['data']['order_by'];
			$this->db->query($sql);
		} else {
			$arrData['data']['order_by'] = getMaxValue('order_by','brands') + 1;

		}

		if (!isset($arrData['data']['id']) || $arrData['data']['id'] == '') {
			setTime($arrData['data'], MODE_ADD);
			$arrTmp = $arrData['data']['categories'];
			unset($arrData['data']['categories']);

			if ($this->db->insert('brands', $arrData['data'])) {
				$cnt = count($arrTmp);

				if($cnt > 0) {
					$insert_id = $this->db->insert_id();
					$arrCategories = array();
					for ($i = 0; $i < $cnt; $i++) {
						$arr = array(
                            'brand_id'      => $insert_id,
                            'category_id'   => $arrTmp[$i]
						);

						array_push($arrCategories, $arr);
					}

					$this->db->insert_batch('brand_category', $arrCategories);

				}
			}
		} else {
			setTime($arrData, MODE_EDIT);
			$arrTmp = $arrData['data']['categories'];
			unset($arrData['data']['categories']);

			$this->db->where('id', $arrData['data']['id']);
			if ($this->db->update('brands', $arrData['data'])) {
				$cnt = count($arrTmp);
				if ($cnt > 0) {
					$this->db->delete('brand_category', array('brand_id' => $arrData['data']['id']));
					$arrCategories = array();
					for ($i = 0; $i < $cnt; $i++) {
						$arr = array(
                            'brand_id'    => $arrData['data']['id'],
                            'category_id' => $arrTmp[$i]
						);
						array_push($arrCategories, $arr);
					}
					$this->db->insert_batch('brand_category', $arrCategories);
				}
			}
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
                'table_id' => 'brands'
                );
                $arrBrandCategory = array(
                'brand_id' => $arrCheck[$i]
                );
                $arrBrands = array(
                'id' => $arrCheck[$i]
                );
                if ($mode == MODE_DELETE) {
                	$arrDt = array(
                    'delete_flg' => 1
                	);
                	setTime($arrDt, MODE_DELETE);
                	$this->db->update('brands', $arrDt, $arrBrands);
                } else if ($mode == MODE_DELETE_DB) {
                	$this->db->delete('brands', $arrBrands);
                	$this->db->delete('brand_category', $arrBrandCategory);
                	deleteFiles($arrFilesWhere);
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
			$this->db->update('brands', $arrDt, $arrBrands);
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	public function import($arrData) {

		$this->db->trans_start();
		foreach($arrData as $data) {
			setTime($data,MODE_ADD);
			$this->db->insert('brands',$data);
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

}

?>

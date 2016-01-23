<?php

class Products_model extends CI_Model {

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
			$SQL .= '         b.price,             ';
			$SQL .= '         b.delete_flg,             ';
			$SQL .= '         b.order_by,             ';
			$SQL .= '         b.discount,             ';
			$SQL .= '         b.order_by,             ';
			$SQL .= '         b.desc,             ';
			$SQL .= '         b.category_id,             ';
			$SQL .= '         b.brand_id,             ';
			$SQL .= '         b.meta_title,             ';
			$SQL .= '         b.meta_keywords,             ';
			$SQL .= '         b.meta_desc,             ';
			$SQL .= '         \'\' AS other_file_url,             ';
			$SQL .= '         DATE_FORMAT(b.create_at,\'%d-%m-%Y %H:%i:%S\') AS create_at,             ';
			$SQL .= '        DATE_FORMAT(b.publish_at,\'%d-%m-%Y %H:%i:%S\') AS publish_at,             ';
			$SQL .= '         b.status,             ';
			$SQL .= '         u.username AS create_by,             ';
			$SQL .= '( ';
			$SQL .= '	SELECT CASE WHEN pi.filename IS NOT NULL THEN CONCAT(\''.base_url().'\',\''.UPLOAD_PRODUCTS_PATH.'\',pi.filename) ELSE CONCAT(\''.base_url().'\',\''.NO_IMG_URL.'\') END ';
			$SQL .= '	FROM product_images pi ';
			$SQL .= '	WHERE pi.product_id = b.id LIMIT 0,1 ';
			$SQL .= ') AS file_url ';
		}
		$SQL .= '     FROM products b             ';
		$SQL .= '     LEFT OUTER JOIN users u             ';
		$SQL .= '     ON             ';
		$SQL .= '         u.id = b.create_by             ';
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
		if (isset($arrConditions['datefrom']) && isset($arrConditions['dateto'])) {
			$SQL .= '    AND substr(b.create_at,1,8) >=  ' . $this->db->escape(cnvDateToString($arrConditions['datefrom']));
			$SQL .= '    AND substr(b.create_at,1,8) <=  ' . $this->db->escape(cnvDateToString($arrConditions['dateto']));
		}
		if (isset($arrConditions['publishfrom']) && isset($arrConditions['publishto'])) {
			$SQL .= '    AND substr(b.publish_at,1,8) >=  ' . $this->db->escape(cnvDateToString($arrConditions['publishfrom']));
			$SQL .= '    AND substr(b.publish_at,1,8) <=  ' . $this->db->escape(cnvDateToString($arrConditions['publishto']));
		}
		if (isset($arrConditions['status'])) {
			$SQL .= '    AND b.status =  ' . $this->db->escape($arrConditions['status']);
		}
		if (isset($arrConditions['category_id'])) {
			$SQL .= '    AND b.category_id =  ' . $this->db->escape($arrConditions['category_id']);
		}
		if (isset($arrConditions['brand_id'])) {
			$SQL .= '    AND b.brand_id =  ' . $this->db->escape($arrConditions['brand_id']);
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
			$this->db->select('filename,file_id');
			$arrOutput['images'] = $this->db->get_where('product_images',array('product_id' => $arrConditions['id']))->result_array();
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
	public function getOne( $arrWheres = array()) {

		if(count($arrWheres) > 0) {
			$this->db->where($arrWheres);
		}
		$arrOutput = $this->db->get('products')->row_array();
		$arrOutput['publish_at'] = cnvStringToDate($arrOutput['publish_at'], 'dd-mm-yyyy');
		$files = $this->db->get_where('files',array('owner_id' => $arrWheres['id'],'table_id' => 'products'))->row_array();
		if(count($files) > 0) {
			$arrOutput['file_url'] = base_url($files['path_thumb'].$files['file_thumb']);
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
		$sql = '';
		if($arrData['data']['order_by'] > 0) {
			$sql.= "	UPDATE products 	";
			$sql.= "	SET order_by = order_by + 1 	";
			$sql.= "	where order_by >=  	".$arrData['data']['order_by'];
			$this->db->query($sql);
		} else {
			$arrData['data']['order_by'] = getMaxValue('order_by','products') + 1;

		}
		
		// Price
		if(!isset($arrData['data']['price']) || $arrData['data']['price'] != '') {
			$arrData['data']['price'] = str_replace('.','', $arrData['data']['price']);
		}
		
		// Add to tbl products
		$productId = '';
		if (isset($arrData['data']['id']) && is_numeric($arrData['data']['id'])) {
			setTime($arrData['data'], MODE_EDIT);
			$arrData['data']['publish_at'] = $arrData['data']['publish_at'].'000000';
			$this->db->where('id', $arrData['data']['id']);
			$this->db->update('products', $arrData['data']);
			$productId = $arrData['data']['id'];
		} else {
			setTime($arrData['data'], MODE_ADD);
			$arrData['data']['publish_at'] = $arrData['data']['publish_at'].'000000';
			$this->db->insert('products', $arrData['data']);
			$productId = $this->db->insert_id();
		}
		
		// Insert image
		$cntUpload  = count($_FILES['upload']['name']);
		$removeList = $this->input->post('removeList');
		$removeDB   = $this->input->post('removeDb');
		$arrRemoveList = array();
		$arrRemoveDb = array();
		if($removeList != '') {
			$arrRemoveList = explode(',', $removeList);
		}
		if($removeDB != '') {
			$arrRemoveDb = explode(',', $removeDB);
		}
		if($cntUpload > 0) {
			for($i = 0; $i < $cntUpload; $i++) {
				
				if(!checkExistsInArray($arrRemoveList,$i)) {
					if($_FILES['upload']['name'][$i] != '') {
						
						$ext = pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);
						$filename = time().'_'.random_string().'.'.$ext;
						$_FILES['file']['name']     =   $_FILES['upload']['name'][$i];
			            $_FILES['file']['type']     =   $_FILES['upload']['type'][$i];
			            $_FILES['file']['tmp_name'] =   $_FILES['upload']['tmp_name'][$i];
			            $_FILES['file']['error']    =   $_FILES['upload']['error'][$i];
			            $_FILES['file']['size']     =   $_FILES['upload']['size'][$i];
			            
			            $arrConfig = array(
			            	'upload_path'	=>	'./'.UPLOAD_PRODUCTS_PATH,
			            	'allowed_types'	=>	ALLOWED_IMG_TYPES,
			            	'max_size'		=>	MAX_UPLOAD_FILE_SIZE,
			            	'max_width'		=>	1000,
			            	'max_height'	=>	1000,
			            	'filename'		=>	$filename,
			            	'overwrite'		=>	true
			            );
			            $upload = uploadFile($arrConfig,false);
			            if($upload['uploadCode'] == 1) {
			            	// Add to tbl files
			            	$arrImgData = array(
			            		'product_id'	=>	$productId,
								'filename'		=>	$filename,
								'size'			=>	$_FILES['upload']['size'][$i],
							);
							$this->db->insert('product_images',$arrImgData);
			            }
					}
				} 
			}
		}
		
		// Remove image when edit
		if(count($arrRemoveDb) > 0) {
			for($i = 0; $i < count($arrRemoveDb); $i++) {
				$this->db->where('file_id',$arrRemoveDb[$i]);
				$imageInfo = $this->db->get_where('product_images')->row_array();
				
				$this->db->where('file_id',$arrRemoveDb[$i]);
				$this->db->delete('product_images');
				
				// Remove from dir
				if(file_exists('./'.UPLOAD_PRODUCTS_PATH.$imageInfo['filename'])) {
					unlink('./'.UPLOAD_PRODUCTS_PATH.$imageInfo['filename']);
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
	public function getDelete($mode) {
		$this->db->trans_start();
		$arrCheck = $this->input->post('checkAll');
		for ($i = 0; $i < count($arrCheck); $i++) {

			$arrProduct = array(
                'id' => $arrCheck[$i]
			);
			if ($mode == MODE_DELETE) {
				$arrDt = array(
                    'delete_flg' => 1
				);
				setTime($arrDt, MODE_DELETE);
				$this->db->update('products', $arrDt, $arrProduct);
			} else if ($mode == MODE_DELETE_DB) {
				$this->db->delete('products', $arrProduct);
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
			$this->db->update('products', $arrDt, $arrBrands);
		}
		if ($this->db->trans_complete()) {
			return true;
		}
	}

}

?>

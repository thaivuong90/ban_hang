<?php

/**
 * cnvNullToString
 *
 * Chuyen doi null thanh string
 *
 */
if (!function_exists('cnvNullToString')) {

	function cnvNullToString($strInput, $strOutput) {

		if ($strInput == null || !isset($strInput)) {
			return $strOutput;
		}

		return $strInput;
	}

}

/**
 * cutString
 *
 * @param $strInput chuỗi đầu vào
 * @param $limit giới hạn cắt chuỗi
 *
 * Cắt chuỗi
 */
if (!function_exists('cutString')) {

	function cutString($strInput, $limit) {

		if (strlen($strInput) <= $limit)
		return $strInput;
		$html = substr($strInput, 0, $limit);
		//$html = substr($html, 0, strrpos($html, ' '));
		return $html.'...';
	}

}

/**
 *
 * cnvStringToDate
 *
 * Tạo chuỗi với định dạng bất kì
 *
 */
if (!function_exists('cnvStringToDate')) {

	function cnvStringToDate($strInput = '', $strFormat = 'dd-mm-yyyy hh:ii:ss') {
		$output = '';
		if($strInput != '') {
			$output = str_replace('yyyy', substr($strInput, 0, 4), $strFormat);
			$output = str_replace('mm', substr($strInput, 4, 2), $output);
			$output = str_replace('dd', substr($strInput, 6, 2), $output);
			$output = str_replace('hh', substr($strInput, 8, 2), $output);
			$output = str_replace('ii', substr($strInput, 10, 2), $output);
			$output = str_replace('ss', substr($strInput, 12, 2), $output);
		}

		return $output;
	}

}

/**
 *
 * cnvDateToString
 *
 * Tạo ngày thành chuỗi
 *
 */
if (!function_exists('cnvDateToString')) {

	function cnvDateToString($strInput = '') {

		$output = '';
		$output.= substr($strInput, 6, 4);
		$output.= substr($strInput, 3, 2);
		$output.= substr($strInput, 0, 2);
		$output.= substr($strInput, 11, 2);
		$output.= substr($strInput, 14, 2);
		$output.= substr($strInput, 17, 2);

		return $output;
	}

}

/**
 *
 * getCurrentDt
 *
 * Lấy ngày giờ hiện tại hệ thống
 *
 */
if (!function_exists('getCurrentDt')) {

	function getCurrentDt() {

		$output = date('YmdHis', strtotime('-8 hour', strtotime(date('Y-m-d H:i:s'))));

		return $output;
	}

}

/**
 *
 * getCurrentDt
 *
 * Lấy ngày giờ hiện tại hệ thống
 *
 */
if (!function_exists('getSettingInfo')) {

	function getSettingInfo($item) {

		// get the CI object
		$CI = & get_instance();

		$CI->db->select($item);
		$settings = $CI->db->get('settings')->row_array();
		if($item == 'system_id') {
			return isset($settings[$item]) ? ($settings[$item] + 1) : 1;
		}

		return $settings[$item];
	}

}

/**
 *
 * getCurrentDt
 *
 * Lấy ngày giờ hiện tại hệ thống
 *
 */
if (!function_exists('getCurrentUserId')) {

	function getCurrentUserId($getName = false) {

		// get the CI object
		$CI = & get_instance();
		$CI->load->library('session');
		$CI->load->helper('cookie');
		if($CI->session->userdata('user_id') != null || $CI->session->userdata('user_id') != '') {
			if($getName) {
				return $CI->session->userdata('user_name');
			}
			return $CI->session->userdata('user_id');
		}
		if(get_cookie('user_id',true) != null) {
			if($getName) {
				return get_cookie('user_name',true);
			}
			return get_cookie('user_id',true) != null;
		}
	}

}

/**
 *
 * getValueFromDb
 *
 * Get giá trị nào đó từ table
 *
 */
if (!function_exists('getValueFromDB')) {

	function getValueFromDB($field, $alias = '', $table = '', $arrWheres = array()) {

		if ($alias == '') {
			$alias = $field;
		}

		// get the CI object
		$CI = & get_instance();
		if ($alias != '') {
			$CI->db->select($field . ' AS ' . $alias);
		} else {
			$CI->db->select($field);
		}

		$CI->db->where($arrWheres);
		$arrOutput = $CI->db->get($table)->row_array();

		if (!isset($arrOutput[$alias]) || $arrOutput[$alias] == '') {

			switch ($alias) {

				case 'file_url':
					return NO_IMG_URL;
					break;

				default:
					return '-';
					break;
			}
		}

		return $arrOutput[$alias];
	}

}

/**
 *
 * getValueFromDb
 *
 * Get giá trị nào đó từ table
 *
 */
if (!function_exists('getMaxValue')) {

	function getMaxValue($field, $table = '',$wheres = array()) {

		// get the CI object
		$CI = & get_instance();

		$CI->db->select('MAX(' . $field . ') AS MAX_VL ');
		if(count($wheres) > 0) {
			$CI->db->where($wheres);
		}
		$arrOutput = $CI->db->get($table)->row_array();

		return $arrOutput['MAX_VL'] != NULL ? $arrOutput['MAX_VL'] : 0;
	}

}

/**
 *
 * getValueFromDb
 *
 * Get giá trị nào đó từ table
 *
 */
if (!function_exists('getCount')) {

	function getCount($table = '', $where = array()) {

		// get the CI object
		$CI = & get_instance();

		$CI->db->where($where);

		return $CI->db->count_all_results($table);
	}

}

if (!function_exists('my_set_select')) {

	function my_set_select($field = '', $value = '', $compareTo = '') {
		// get the CI object
		$CI = & get_instance();
		if (is_array($compareTo) && count($compareTo) > 0) {

			foreach ($compareTo as $item) {
				if (isset($item['category_id']) && $item['category_id'] == $value) {
					return ' selected="selected"';
				}
				if (isset($item['module_id']) && $item['module_id'] == $value) {
					return ' selected="selected"';
				}
			}
		}
		if ($CI->input->post()) {
			return set_select($field, $value);
		} else if ($compareTo == $value) {
			return ' selected="selected"';
		}
	}

}

if (!function_exists('my_set_checkbox')) {

	function my_set_value($field = '', $input) {
		// get the CI object
		$CI = & get_instance();

		if ($CI->input->post()) {
			return set_value($field, $input, true);
		} else {

			return html_entity_decode($input);
		}
	}

}

if (!function_exists('my_set_checkbox')) {

	function my_set_checkbox($field = '', $value = '', $compareTo = '') {
		// get the CI object
		$CI = & get_instance();

		if ($CI->input->post()) {
			return set_checkbox($field, $value);
		} else if ($compareTo == $value) {

			return ' checked="checked"';
		}
	}

}

if (!function_exists('my_set_checkbox')) {

	function my_set_radio($field = '', $value = '', $compareTo = '') {
		// get the CI object
		$CI = & get_instance();

		if ($CI->input->post()) {
			return set_radio($field, $value);
		} else if ($compareTo == $value) {

			return ' checked="checked"';
		}
	}

}

if (!function_exists('safe_data')) {

	function safe_data($strInput = '') {
		// get the CI object
		$CI = & get_instance();
		$value = $CI->input->post($strInput);
		if(is_array($value)) {
			return $CI->input->post($strInput);
		}

		if($value != '') {
			return xss_clean(html_escape($CI->input->post($strInput)));
		}
	}

}

if (!function_exists('replaceUnicode')) {

	function replaceUnicode($str) {

		$unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		);
		foreach ($unicode as $nonUnicode => $uni) {
			$str = preg_replace("/($uni)/i", $nonUnicode, $str);
		}
		$kq = str_replace("'", "''", $str);

		return url_title(strtolower($kq));
	}

}

if (!function_exists('setTime')) {

	function setTime(&$arrOutput = array(), $mode = '') {
		if(isset($arrOutput['name']) && $arrOutput['name'] != '') {
			$arrOutput['encode'] = replaceUnicode($arrOutput['name']);
		}
		if(isset($arrOutput['password']) && $arrOutput['password'] != '') {
			$arrOutput['password'] = md5($arrOutput['password']);
		}

		switch ($mode) {

			case MODE_ADD:
				$arrOutput['create_at'] = getCurrentDt();
				$arrOutput['create_by'] = getCurrentUserId();
				break;

			case MODE_EDIT:
				$arrOutput['update_at'] = getCurrentDt();
				$arrOutput['update_by'] = getCurrentUserId();
				break;

			case MODE_DELETE:
				$arrOutput['delete_at'] = getCurrentDt();
				$arrOutput['delete_by'] = getCurrentUserId();
				break;
		}
	}

}

if (!function_exists('deleteFiles')) {
	function deleteFiles($arrWheres = array()) {

		// get the CI object
		$CI = & get_instance();

		$fileInfo = $CI->db->get_where('files', $arrWheres)->row_array();
		if (count($fileInfo) > 0) {
			$filePath = './' . $fileInfo['path'] . $fileInfo['filename'];
			$thumb = './' . $fileInfo['path_thumb'] . $fileInfo['file_thumb'];
			if (file_exists($filePath) || file_exists($thumb)) {

				unlink($filePath);
				unlink($thumb);
			}
		}
		if($CI->db->delete('files',$arrWheres)) {
			return true;
		}
	}
}

if (!function_exists('createMultiLevel')) {
	function createMultiLevel(&$output = array(), $arrConditions = array(), $model = '',$leftMenu = false) {

		// get the CI object
		$CI = & get_instance();

		if(!isset($arrConditions['parent']) && !isset($arrConditions['id'])) {
			$arrConditions['parent'] = 0;
		}

		$arrParents = $CI->$model->search($arrConditions);
		foreach($arrParents as $parent) {
			$arrConditions['parent'] = $parent['id'];
			$cnt = $CI->$model->search($arrConditions,MODE_CNT);
			if($cnt > 0) {
				$output[] = array(
                    'id'        =>  $parent['id'],
                    'name'      =>  !$leftMenu ? $parent['icon'].$parent['name'] : $parent['name'],
                    'is_group'  =>  isset($parent['is_group']) ? $parent['is_group'] : 0,
                    'url'       =>  isset($parent['url']) ? $parent['url'] : 0,
                    'status'    =>  $parent['status'],
                    'delete_flg'=>  $parent['delete_flg'],
                	'parent'	=>	isset($parent['parent_id']) ? $parent['parent_id'] : 0
				);
				$arrCons = array();
				$arrCons['parent'] = $parent['id'];
				createMultiLevel($output,$arrCons,$model,$leftMenu);
			} else {
				$output[] = array(
                    'id'        =>  $parent['id'],
                    'name'      =>  !$leftMenu ? $parent['icon'].$parent['name'] : $parent['name'],
                    'is_group'  =>  isset($parent['is_group']) ? $parent['is_group'] : 0,
                    'url'       =>  isset($parent['url']) ? $parent['url'] : 0,
                    'status'    =>  $parent['status'],
                    'delete_flg'=>  $parent['delete_flg'],
                	'parent'	=>	isset($parent['parent_id']) ? $parent['parent_id'] : 0
				);

			}
		}

	}
}
if (!function_exists('convertNumberToText')) {

	function convertNumberToText($number) {
		if($number > 1000) {
			if(strlen($number) <= 4 && strlen($number) > 3) {
				return $number / 1000 . 'K';
			}
			if(strlen($number) <= 9 && strlen($number) > 7) {
				return $number / 1000000 . 'Tr';
			}
			if(strlen($number) > 9) {
				return $number / 1000000000 . 'Tỉ';
			}
		}
		return $number;
	}
}
//if (!function_exists('createLeftMenu')) {
//
//	function createLeftMenu(&$output = array(), $arrConditions = array(),$isChild = false) {
//
//		// get the CI object
//		$CI = & get_instance();
//
//		if(!isset($arrConditions['parent']) && !isset($arrConditions['id'])) {
//			$arrConditions['parent'] = 0;
//		}
//
//		$arrParents = $CI->modules_model->search($arrConditions);
//		foreach($arrParents as $parent) {
//			$arrConditions['parent'] = $parent['id'];
//			$cnt = $CI->modules_model->search($arrConditions,MODE_CNT);
//			if($cnt > 0) {
//				if($parent['is_group'] == 1) {
//					$output .= '<h3>'.$parent['name'].'</h3>';
//					$output .= '<div class="box-left-menu">';
//					createLeftMenu($output,array('parent' => $parent['id'],'status' => 1));
//					$output .= '</div>';
//				} else {
//					$output .= '<ul><li><a href="'.base_url($parent['url']).'" ><span class="arrow-icon"></span>'.$parent['name'].'</a><ul class="child">';
//					createLeftMenu($output,array('parent' => $parent['id'],'status' => 1),true);
//					$output .= '</ul></li></ul>';
//				}
//			} else {
//				if($parent['is_group'] == 1) {
//					$output .= '<h3>'.$parent['name'].'</h3>';
//				} else if($isChild) {
//					$output .= '<li><a href="'.base_url($parent['url']).'" ><span class="arrow-icon"></span>'.$parent['name'].'</a>';
//					$output .= '</li>';
//				} else {
//					$output .= '<ul><li><a href="'.base_url($parent['url']).'" ><span class="arrow-icon"></span>'.$parent['name'].'</a>';
//					$output .= '</li></ul>';
//				}
//
//			}
//		}
//
//	}
//}

if (!function_exists('createLeftMenu')) {

	function createLeftMenu(&$output = '', $arrConditions = array(),$isChild = false,$model = 'modules_model') {

		// get the CI object
		$CI = & get_instance();

		if(!isset($arrConditions['parent']) && !isset($arrConditions['id'])) {
			$arrConditions['parent'] = 0;
		}

		$arrParents = $CI->$model->search($arrConditions);
		foreach($arrParents as $parent) {
			$url = '';

			// Set url
			if($model == 'categories_model') {
				$url = base_url('frontend/categories/'.$parent['id']);
			} else {
				$url = base_url($parent['url']);
			}

			$arrConditions['parent'] = $parent['id'];
			$cnt = $CI->$model->search($arrConditions,MODE_CNT);

			if(!$isChild) {
				$output .= '<ul>';
			}
			if($cnt > 0) {

				if($parent['parent'] == 0) {
					$output .= '<li class="first"><a class="be-head" href="'.$url.'" >'.$parent['name'].'</a><ul>';
				} else {
					$output .= '<li><a href="'.$url.'" >'.$parent['name'].'</a><ul>';
				}
				createLeftMenu($output,array('parent' => $parent['id'],'status' => 1),true,$model);
				$output .= '</ul></li>';


			} else {
				$output .= '<li><a href="'.$url.'" >'.$parent['name'].'</a></li>';
			}
			if(!$isChild) {
				$output .= '</ul>';
			}

		}

	}
}

/**
 * removeHttpUrl
 */
if (!function_exists('removeHttpUrl')) {
	function removeHttpUrl($url) {
		$url = str_replace('http://','',$url);
		$url = str_replace('.','_',$url);
		$url = str_replace('/','',$url);
		return $url;
	}
}

/**
 * removeHttpUrl
 */
if (!function_exists('formarCurrency')) {
	function formarCurrency($price) {
		return number_format($price, 0 , ',', '.');
	}
}
if (!function_exists('convertBase64ToImg')) {
	function convertBase64ToImg($base64img,$filename){
        $data = str_replace('data:image/jpeg;base64,', '', $base64img);
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = base64_decode($data);
        $file = UPLOAD_DIR.UPLOAD_PRODUCT_DIR. $filename;
        $success = file_put_contents($file, $data);
    }
}

/**
     * upload
     * 
     * @param type $arrInput
     * @param type $strMode
     * @param type $isResize
     * @return int
     */
if (!function_exists('uploadFile')) {
    function uploadFile($arrInput = array(), $isResize = false) {
        
        // get the CI object
        $CI =& get_instance();
		
        // Create folder if not exist
        if(!is_dir($arrInput['upload_path'])) {
            mkdir('./'.$arrInput['upload_path'],777,true);
        }
        
        // Config upload
        $arrOutput                  = array();
        $config['upload_path']      = $arrInput['upload_path'];
        $config['allowed_types']    = $arrInput['allowed_types'];
        $config['max_size']         = $arrInput['max_size'];
        $config['max_width']        = $arrInput['max_width'];
        $config['max_height']       = $arrInput['max_height'];
        $config['file_name']        = $arrInput['filename'];
        $config['overwrite']        = $arrInput['overwrite'];
        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);
        
        if (!$CI->upload->do_upload('file')) {
            
            $arrOutput['uploadCode']  = 0;  
            $arrOutput['errorUpload'] = strip_tags($CI->upload->display_errors());
            
        } else {
            
            if($isResize) {
                
                $CI->load->library('image_lib');
                // Create folder if not exist
                if(!file_exists('./'.$arrInput['resize_path'])) {
                    mkdir('./'.$arrInput['resize_path'],0777,true);
                }
               
                $confResize['image_library']    = 'gd2';
                $confResize['source_image']     = $arrInput['upload_path'].'/'.$arrInput['filename'];
                $confResize['create_thumb']     = TRUE;
                $confResize['maintain_ratio']   = TRUE;
                $confResize['width']            = $arrInput['resize_width'];
                $confResize['new_image']        = $arrInput['resize_path'];
                $confResize['resize_name']	    = $arrInput['filename'];

                $CI->image_lib->initialize($confResize);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
            }
            
            $data = $CI->upload->data(); 
            
            $arrOutput['uploadCode'] = 1;
        }
        return $arrOutput;
    }
}
if (!function_exists('checkExistsInArray')) {
	function checkExistsInArray($arrCheck = array(),$value) {
		$cnt = count($arrCheck);
		if($cnt > 0) {
			for($i = 0; $i < $cnt; $i++) {
				if($arrCheck[$i] == $value) {
					return true;
				}
			}
		}
		return false;
	}
	
}

?>

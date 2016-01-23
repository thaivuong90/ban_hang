<?php
class Settings_model extends CI_Model {
	
	/**
	 * 
	 * getOne
	 */
	public function getOne($arrWheres = array()) {
		$SQL = '';
		$SQL .=   '  SELECT             ';
		$SQL .=   '      t.*,            ';
		$SQL .= '        CASE WHEN t.ico IS NOT NULL THEN CONCAT(\''.base_url().'\',\''.UPLOAD_ICO_PATH.'\',t.ico) ELSE \''.NO_IMG_URL.' \' END AS ico_url,              ';
		$SQL .= '        CASE WHEN t.logo IS NOT NULL THEN CONCAT(\''.base_url().'\',\''.UPLOAD_LOGO_PATH.'\',t.logo) ELSE \''.NO_IMG_URL.' \' END AS file_url              ';
		$SQL .=   '  FROM settings t            ';
		$SQL .=   '  WHERE 1 = 1           ';
		if(isset($arrWheres['system_id']) && $arrWheres['system_id'] != '') {
			$SQL .=   '      AND t.system_id = '.$arrWheres['system_id'];
		}
        $arrOutput = $this->db->query($SQL)->row_array();
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
        if(isset($arrData['data']['system_id']) && $arrData['data']['system_id'] != '') {
        	$this->db->where('system_id',$arrData['data']['system_id']);
        	$this->db->update('settings',$arrData['data']);
        } else {
        	$this->db->insert('settings',$arrData['data']);
        }
        if ($this->db->trans_complete()) {
            return true;
        }
    }
}
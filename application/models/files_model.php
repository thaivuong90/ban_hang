<?php

class Files_model extends CI_Model {

	/**
	 * search
	 */
	public function getFolders($arrConditions = array()) {
		$output = array();
		// Get folders root
		$output = array_merge($this->getFolderInFolder($arrConditions),$this->getFilesInFolder($arrConditions));
		return $output;
	}

	/**
	 * getFolderInFolder
	 * @param unknown_type $arrConditions
	 */
	public function getFolderInFolder($arrConditions = array()) {
		$sql = '';
		$sql.= '   SELECT f.id,f.name,f.status,f.delete_flg, \'d\' AS type ';
		$sql.= '   FROM folders f ';
		$sql.= '   WHERE f.parent_path = \''.$arrConditions['path'].'\'';
		return $this->db->query($sql)->result_array();
	}
	/**
	 * search
	 */
	public function getFilesInFolder($arrConditions = array()) {
		$sql = '';
		$sql.= '   SELECT    ';
		$sql.= '       f.id,   ';
		$sql.= '       f.filename,   ';
		$sql.= '       CASE   ';
		$sql.= '       WHEN f.path = \''.$arrConditions['path'].'\' THEN  CONCAT(\'' . base_url() . '\',f.path,f.filename)  ';
		$sql.= '       WHEN CONCAT(\'f.path\',\'thumb\') = \''.$arrConditions['path'].'\' THEN  CONCAT(\'' . base_url() . '\',\'f.path\',\'thumb\',f.filename)  ';
		$sql.= '       END AS IMG_URL,   ';
		$sql.= '       \'f\' AS type   ';
		$sql.= '   FROM files f   ';
		$sql.= '   WHERE f.path = \''.$arrConditions['path'].'\' OR CONCAT(\'f.path\',\'thumb\') = \''.$arrConditions['path'].'\' ';
		return $this->db->query($sql)->result_array();
	}

	/**
	 * getInsertUpdate
	 *
	 * @param type $arrData
	 * @return boolean
	 */
	public function getInsertUpdate($arrData = array()) {

		$this->db->trans_start();
		setTime($arrData['data'], MODE_ADD);
		$this->db->insert('files', $arrData['data']);
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	/**
	 * getInsertUpdate
	 *
	 * @param type $arrData
	 * @return boolean
	 */
	public function getCreateFolder($arrData = array()) {

		$this->db->trans_start();
		setTime($arrData['data'], MODE_ADD);
		$this->db->insert('folders', $arrData['data']);
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	/**
	 * getInsertUpdate
	 *
	 * @param type $arrData
	 * @return boolean
	 */
	public function getRenameFolder($arrData = array()) {

		$this->db->trans_start();
		setTime($arrData['data'], MODE_ADD);
		
		// Update folders
		$this->db->where($arrData['wheres']);
		$this->db->update('folders', $arrData['data']);
		
		// Update files
		$this->db->where('path',$arrData['wheres']['parent_path'].$arrData['wheres']['name'].'/');
		$this->db->update('files', array('path' => $arrData['wheres']['parent_path'].$arrData['data']['name'].'/'));
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	/**
	 * getRemoveFolder
	 * @param unknown_type $arrData
	 */
	public function getRemoveFolder($arrData) {
		$this->db->trans_start();
		// Remove files
		$this->db->where('path',$arrData['wheres']['path']);
		$this->db->delete('files');
		// Remove folders
		$this->db->where('id',$arrData['wheres']['id']);
		$this->db->delete('folders');
		if ($this->db->trans_complete()) {
			return true;
		}
	}

	/**
	 * getRemoveFile
	 * @param unknown_type $arrData
	 */
	public function getRemoveFile($arrData) {
		$this->db->trans_start();
		
		$info = $this->db->get_where('files',$arrData['wheres'])->row_array();
		if(count($info) > 0) {
			if(file_exists('./'.$info['path'].$info['filename'])) {
				unlink('./'.$info['path'].$info['filename']);
			}
			if(file_exists('./'.$info['path'].'thumb/'.$info['filename'])) {
				unlink('./'.$info['path'].'thumb/'.$info['filename']);
			}
			$this->db->where($arrData['wheres']);
			$this->db->delete('files');
		} else {
			return false;
		}

		if ($this->db->trans_complete()) {
			return true;
		}
	}

}

?>

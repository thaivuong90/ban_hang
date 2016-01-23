<?php

class Users_model extends CI_Model {

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
            $SQL .= '         b.phone,             ';
            $SQL .= '         b.address,             ';
            $SQL .= '         b.email,             ';
            $SQL .= '         DATE_FORMAT(b.create_at,\'%d-%m-%Y %H:%i:%S\') AS create_at,             ';
            $SQL .= '         b.status,             ';
            $SQL .= '         b.username,             ';
            $SQL .= '         b.role_id,             ';
            $SQL .= '         u.username AS create_by,             ';
            $SQL .= '         b.delete_flg,             ';
            $SQL .= '         CASE WHEN b.img IS NOT NULL THEN CONCAT(\''.base_url().'\',\''.UPLOAD_USER_PATH.'\',b.img) ELSE CONCAT(\''.base_url().'\',\''.NO_IMG_URL.' \') END AS file_url,              ';
            $SQL .= '         DATE_FORMAT(b.lastlogin,\'%d-%m-%Y %H:%i:%S\') AS lastlogin             ';
        }
        $SQL .= '     FROM users b             ';
        $SQL .= '     LEFT OUTER JOIN users u             ';
        $SQL .= '     ON             ';
        $SQL .= '         u.id = b.create_by             ';
        $SQL .= '    WHERE 1 = 1 ';
        if(isset($arrConditions['current_role_id']) && $arrConditions['current_role_id'] != SUPPORT) {
             $SQL .= '   AND b.role_id != '.SUPPORT;
        }
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
        if(isset($arrConditions['username'])) {
            $SQL .= '    AND b.username LIKE '.$this->db->escape('%'.$arrConditions['username'].'%');
        }
        if (isset($arrConditions['datefrom']) && isset($arrConditions['dateto'])) {
            $SQL .= '    AND substr(b.create_at,1,8) >=  ' . $this->db->escape(cnvDateToString($arrConditions['datefrom']));
            $SQL .= '    AND substr(b.create_at,1,8) <=  ' . $this->db->escape(cnvDateToString($arrConditions['dateto']));
        }
        if (isset($arrConditions['status'])) {
            $SQL .= '    AND b.status =  ' . $this->db->escape($arrConditions['status']);
        }
        if (isset($arrConditions['create_by'])) {
            $SQL .= '    AND b.create_by =  ' . $this->db->escape($arrConditions['create_by']);
        }
        if (isset($arrConditions['role_id'])) {
            $SQL .= '    AND b.role_id =  ' . $this->db->escape($arrConditions['role_id']);
        }

        $SQL .= ' ORDER BY b.create_at DESC ';

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
        
        return $this->db->get('users')->row_array();
    }

    /**
     * getInsertUpdate
     * 
     * @param type $arrData
     * @return boolean
     */
    public function getInsertUpdate($arrData = array()) {

        $this->db->trans_start();
        if (!isset($arrData['data']['id']) || $arrData['data']['id'] == '') {
            setTime($arrData['data'], MODE_ADD);
            $this->db->insert('users', $arrData['data']);
        } else {
            setTime($arrData, MODE_EDIT);
            $this->db->where('id',$arrData['data']['id']);
            $this->db->update('users', $arrData['data']);
        }
        if ($this->db->trans_complete()) {
            return true;
        }
    }
    
    /**
     * changePassword
     */
    public function changePassword($arrData) {
        $this->db->trans_start();
        setTime($arrData, MODE_EDIT);
        $this->db->where($arrData['wheres']);
        $this->db->update('users', $arrData['data']);
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
        if (is_numeric($id)) {
            $arrCheck[] = $id;
        }

        for ($i = 0; $i < count($arrCheck); $i++) {

            $arrUser = array(
                'id' => $arrCheck[$i]
            );
            if ($mode == MODE_DELETE) {
                $arrDt = array(
                    'delete_flg' => 1
                );
                setTime($arrDt, MODE_DELETE);
                $this->db->update('users', $arrDt, $arrUser);
            } else if ($mode == MODE_DELETE_DB) {
                $this->db->delete('users', $arrUser);
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
            $this->db->update('users', $arrDt, $arrBrands);
        }
        if ($this->db->trans_complete()) {
            return true;
        }
    }

}

?>

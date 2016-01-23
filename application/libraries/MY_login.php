<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * MY_login
 * 
 * Class xử lý đăng nhập
 */
class MY_login {
    
    
    /**
     * login
     * 
     * Phương thức đăng nhập
     * 
     * @param type $arrOutput
     * @param type $arrInput
     * @param type $strRedirect
     * @param type $strMode
     */
    function login(&$arrOutput = array(), $arrInput = array(),$strRedirect = '', $strMode = '') {
        
        // get the CI object
        $CI =& get_instance();
        
        $CI->load->helper('cookie');
        $CI->load->library('session');
        $CI->load->model('common_model');
        
        if($strMode == 'account') {
            
            $CI->db->where('username', $arrInput['username']);
            $CI->db->where('password', $arrInput['password']);
            $CI->db->where('status'  , 1);
            
            $arrUserInfo = $CI->db->get('users')->row_array();
            if($arrUserInfo != null && count($arrUserInfo) > 0) {
                
               if($this->checkAllowLogin($arrUserInfo['role_id'])) {
                   
                    if($arrInput['remember'] == 1) {
                        
                        set_cookie('user_id',$arrUserInfo['id'], 86500);

                    } else {
                        
                        $CI->session->set_userdata('user_id',$arrUserInfo['id']);
                    }

                    // Update last login
                    $CI->db->where('id',$arrUserInfo['id']);
                    $CI->db->update('users',array('lastlogin' => getCurrentDt()));
                    
                    // Redirect to admin panel
                    redirect($strRedirect);
                    
               } else {
                   $arrOutput['errLogin'] = LTV0055;
               }
            } else {

                $arrOutput['errLogin'] = LTV0001;

            }
        } 
    }
    
    /**
     * checkLogin
     * 
     * Kiểm tra đăng nhập
     * 
     * @param type $arrOutput
     * @param type $strBackUrl
     * @return type
     */
    function checkLogin(&$arrOutput = array(), $strBackUrl = '') {
        
        // get the CI object
        $CI =& get_instance();
        
        $CI->load->library('session');
        $CI->load->helper('cookie','url');
        $CI->load->model('users_model');
        
        $currentUrl = uri_string();
        if($currentUrl == URL_ADMIN_LOGIN 
                || $currentUrl == URL_ADMIN_FORGOTPASSWORD) {
            
            return false;
            
        }
        
        if($CI->session->userdata('user_id') == null && get_cookie('user_id',true) == null) {
            
            redirect($strBackUrl);
            
        } else if($CI->session->userdata('user_id') != null) {
            
            $arrOutput['user_id'] = $CI->session->userdata('user_id');
            
        } else if(get_cookie('user_id',true) != null) {
            
            $arrOutput['user_id'] = get_cookie('user_id',true);
        }
        
        $arrConditions = array(
        	'id'	=>	$arrOutput['user_id']
        );
        $arrUsers = $CI->users_model->search($arrConditions,'detail');
        $arrOutput['username']     = $arrUsers['username'];
        $arrOutput['realname']     = $arrUsers['name'];
        $arrOutput['role_id']      = $arrUsers['role_id'];
        $arrOutput['avatar']       = $arrUsers['file_url'];
        
        return true;
    }
    
    /**
     * checkAllowLogin
     * 
     * @param type $role
     * @return boolean
     */
    private function checkAllowLogin($role = '') {
        // get the CI object
        $CI =& get_instance();
        $CI->db->select('COUNT(*) AS cnt');
        $CI->db->from('modules');
        $CI->db->join('role_module','role_module.module_id = modules.id');
        $CI->db->where('role_module.role_id',$role);
        $CI->db->where('modules.url',URL_ADMIN_LOGIN);
        $result = $CI->db->get()->row_array();
        if($result['cnt'] > 0) {
            return true;
        }
        return false;
    }
}
?>

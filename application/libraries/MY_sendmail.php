<?php
class MY_sendmail {
    
    /**
     * sendMail
     * 
     * @param type $arrInput
     * @return boolean
     */
    function sendMail($arrInput = array()) {
        
        // get the CI object
        $CI =& get_instance();
        $CI->load->model('common_model');
        
        $mailSettings = $CI->settings_model->getOne();
        $config = array(
                'protocol' =>  $mailSettings['protocol'],
                'smtp_host' => $mailSettings['host'],
                'smtp_port' => $mailSettings['port'],
                'smtp_user' => $mailSettings['mailuser'],
                'smtp_pass' => $mailSettings['mailpassword'],
                'mailtype'  => $mailSettings['mailtype'], 
                'starttls'  => $mailSettings['mail_starttls'] == 1 ? true : false
        );
        $CI->load->library('email',$config);
        $CI->email->set_newline("\r\n");
        $CI->email->from($mailSettings['mailuser'], $arrInput['subject']);
        $CI->email->to($arrInput['to']);  
        $CI->email->subject($arrInput['subject']);
        $CI->email->message($arrInput['content']);  

        if($CI->email->send()){
            return true;
        }
        else
        {
            return false;
        }
    }
    
}
?>

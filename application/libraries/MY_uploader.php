<?php
class MY_uploader {
    
    /**
     * upload
     * 
     * @param type $arrInput
     * @param type $strMode
     * @param type $isResize
     * @return int
     */
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
            
            if($isResize && !isset($arrInput['ico_file'])) {
                
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
            } else {
            	
            	$CI->load->library('image_lib');
               
                $confResize['image_library']    = 'gd2';
                $confResize['source_image']     = $arrInput['upload_path'].'/'.$arrInput['filename'];
                $confResize['create_thumb']     = TRUE;
                $confResize['maintain_ratio']   = TRUE;
                $confResize['width']            = 48;
                $confResize['new_image']        = $arrInput['upload_path'];
                $confResize['resize_name']	    = $arrInput['ico_file'];

                $CI->image_lib->initialize($confResize);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                
                if(file_exists('./'.$arrInput['upload_path'].'/'.$arrInput['filename'])) {
                	unlink('./'.$arrInput['upload_path'].'/'.$arrInput['filename']);
                }
            }
            
            $data = $CI->upload->data(); 
            
            $arrOutput['uploadCode'] = 1;
        }
        return $arrOutput;
    }
    
    /**
     * uploadManyFiles
     * 
     * @param type $arrInput
     * @param type $isResize
     * @return type
     */
    function uploadManyFiles($arrInput = array(), $isResize = false)
    {
        // get the CI object
        $CI =& get_instance();
        
        $arrOutput = array();
        
        $CI->load->library('upload');
        
        for($i = 0; $i < $arrInput['totalFiles']; $i++)     
        {      
            $_FILES['file']['name']     =   $_FILES[$key]['name'][$i];
            $_FILES['file']['type']     =   $_FILES[$key]['type'][$i];
            $_FILES['file']['tmp_name'] =   $_FILES[$key]['tmp_name'][$i];
            $_FILES['file']['error']    =   $_FILES[$key]['error'][$i];
            $_FILES['file']['size']     =   $_FILES[$key]['size'][$i];

            $config['allowed_types']    =   $arrInput[$i]['allowed_types'];
            $config['upload_path']      =   $arrInput[$i]['upload_path'];
            $config["file_name"]        =   $arrInput[$i]['file_name'];
            $config['max_size']         =   $arrInput[$i]['max_size'];
            $config['max_width']        =   $arrInput[$i]['max_width'];
            $config['max_height']       =   $arrInput[$i]['max_height'];
            $config['overwrite']        =   $arrInput[$i]['overwrite'];
            
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload("file"))
            {
                if($isResize) {
                    
                    $CI->load->library('image_lib');
                    
                    $confResize['image_library']    =   'gd2';
                    $confResize['source_image']     =   $arrInput[$i]['upload_path'];
                    $confResize['create_thumb']     =   TRUE;
                    $confResize['maintain_ratio']   =   TRUE;
                    $confResize['width']            =   $arrInput['resize_width'];
                    $confResize['height']           =   $arrInput['resize_height'];
                    $confResize['new_image']        =   $arrInput['resize_path'];
                    
                    $this->image_lib->initialize($confResize);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    
                }

                $arrOutput['upload_code'] = 1;
                
            } else {
                
                $arrOutput['upload_code'] = 0;
            }

        }
        return $file_name_string;
    }
    
}
?>

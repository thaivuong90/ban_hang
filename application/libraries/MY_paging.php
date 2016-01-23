<?php
class MY_paging {
    
    function createPagination($totalRows,$limit,$segment,$uri = '') {
        
        // get the CI object
        $CI =& get_instance();
        
        $CI->load->model('common_model');
        $CI->load->library('pagination');
        
        $config['base_url']         = base_url($CI->uri->segment(1).'/'.$CI->uri->segment(2).'/'.$uri);
        $config['total_rows']       = $totalRows;
        $config['per_page']         = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment']      = $segment;
        
//        $config['first_tag_open']   = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = "<li>";
//        $config['first_tag_close']  = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
//        $config['cur_tag_open']     = "<li class='current'>";
//        $config['cur_tag_close']    = "</li>";
        
        $config['first_link']       = '‹ Trang đầu';
        $config['last_link']        = 'Trang cuối ›';
        $config['next_link']        = 'Trang kế  ››';
        $config['prev_link']        = '‹‹ Trang trước';
        
        $CI->pagination->initialize($config);
        
        return $CI->pagination->create_links();
    } 
    
}
?>

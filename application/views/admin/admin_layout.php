<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trang quản trị</title>
<link rel="shortcut icon" type="image/png" href="<?php //echo $settings['ico_url'] ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/admin_style.css"); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("datepickr-master/src/datepickr.min.css"); ?>" />
<script type="text/javascript" src="<?php echo base_url("js/jquery-1.7.1.min.js") ?>" ></script>
<script type="text/javascript" src="<?php echo base_url("js/custom.js") ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('tiny_mce/jquery.tinymce.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('tiny_mce/tiny_mce.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('tiny_mce/tiny_mce_src.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo base_url("datepickr-master/src/datepickr.min.js"); ?>" ></script>
<script type="text/javascript">
	
    $(document).ready(function(){
    	datepickr('.calendar-icon', { altInput: document.getElementById('calendar-input'), dateFormat: 'd-m-Y' });
    	datepickr('.startat-icon', { altInput: document.getElementById('startat-input'), dateFormat: 'd-m-Y' });
    	datepickr('.finishat-icon', { altInput: document.getElementById('finishat-input'), dateFormat: 'd-m-Y' });
    	datepickr('#datefrom', { dateFormat: 'd-m-Y' });
    	datepickr('#dateto', { dateFormat: 'd-m-Y' });
    	datepickr('#publishfrom', { dateFormat: 'd-m-Y' });
    	datepickr('#publishto', { dateFormat: 'd-m-Y' });
    	datepickr('#deliveryfrom', { dateFormat: 'd-m-Y' });
    	datepickr('#deliveryto', { dateFormat: 'd-m-Y' });
        $("textarea.editor").tinymce({
            mode: "textareas",
            theme: "advanced",
            language:'en',
            width: "100%",
            height: "450",
            plugins : "youtubeIframe,table",
            theme_advanced_buttons1: "newdocument,separator,bold,italic,underline,strikethrough,separator,justifyleft, justifycenter,justifyright,justifyfull,separator,cut,copy,paste,pastetext,pasteword,separator,help",
            theme_advanced_buttons2: "bullist,numlist,separator,outdent,indent,blockquote,separator,undo,redo,separator,link,unlink,anchor,image,cleanup,help,code,separator,forecolor,backcolor,youtubeIframe,table",
            theme_advanced_buttons3: "",
            theme_advanced_buttons4: "",
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left",
            valid_elements : '*[*]',
            //valid_elements: "iframe[src|title|width|height|allowfullscreen|frameborder|class|id],object[classid|width|height|codebase|*],param[name|value|_value|*],embed[type|width|height|src|*]"
        });
       
       setTimeout(function(){
           $("p.success").fadeOut();
           $("div.error").fadeOut();
       },4000);
       $("span.close").click(function(){
          $("p.success").fadeOut();
          $("div.error").fadeOut();
       });
    });
</script>

</head>

<body>
<div id="wrapper">
    <div id="header">
    	<div id="header_left">
            <h2>
            	<a href="<?php echo base_url(URL_ADMIN_INDEX); ?>" title="<?php echo $settings['webtitle']; ?>">
            	<?php echo $settings['webtitle']; ?>
            	</a>
            </h2>
        </div><!-- End #header_left -->
        <div id="header_right">
            <ul>
                <li>
                    <a href="<?php echo base_url(URL_ADMIN_USER.'/profile'); ?>" >
                            <img src="<?php echo $avatar; ?>" width="30" />
                            <strong><?php echo $realname; ?></strong></a>
                </li>
                <li><a href="<?php echo base_url(URL_ADMIN_USER.'/changePassword'); ?>">Đổi mật khẩu</a></li>
                <li><a href="<?php echo base_url(); ?>" target="_blank" >Trang chủ</a></li>
                <li><a href="<?php echo base_url(URL_ADMIN_USER.'/logout'); ?>" onclick="return doConfirm('<?php echo LTV0008; ?>');">Thoát</a></li>
                
            </ul>
        </div>
    </div>
    <div id="columns">
    	<?php $this->load->view('admin/left_menu'); ?>
        <div id="right_column">
            <h3>
                <div class="header">
                    <img src="<?php echo base_url("img/icons/icon-48-generic.png") ?>" />
                    <span><?php echo $boxHeader; ?></span>
                </div>
				
                <div class="action_button">
                	<?php if($deleteDbFlg): ?>
                    <a href="javascript:void(0)" title="Hủy" onclick="return doSubmit('<?php echo $backUrl.'/'.MODE_DELETE_DB ?>');">
                        <span class="icon_remove" title="Hủy">
                        </span>
                        <span class="icon_remove_text">Hủy</span>
                    </a>
                    <?php endif; ?>
                	<?php if($refreshFlg): ?>
                    <a href="javascript:void(0)" title="Thùng rác" onclick="return doSubmit('<?php echo $backUrl.'/'.MODE_REFRESH ?>');" >
                        <span class="icon_refresh" title="Phục hồi">
                        </span>
                        <span class="icon_refresh_text">Phục hồi</span>
                    </a>
                    <?php endif; ?>
                    <?php if($trashFlg): ?>
                    <a href="<?php echo $backUrl.'/'.MODE_TRASH; ?>" title="Thùng rác">
                        <span class="<?php echo $trash_class; ?>" title="Thùng rác">
                        </span>
                        <span class="icon_trash_text">Thùng rác</span>
                    </a>
                    <?php endif; ?>
                    <?php if($visibleFlg): ?>
                    <a href="javascript:void(0)" title="Hiển thị" onclick="return doSubmit('<?php echo $backUrl.'/'.MODE_ENABLE ?>');">
                        <span class="icon_status_enable" title="Hiển thị">
                        </span>
                        <span class="icon_enable_text">Hiển thị</span>
                    </a>
                    <?php endif; ?>
                    <?php if($hiddenFlg): ?>
                    <a href="javascript:void(0)" title="Ẩn" onclick="return doSubmit('<?php echo $backUrl.'/'.MODE_DISABLE ?>');">
                        <span class="icon_status_disable" title="Ẩn">
                        </span>
                        <span class="icon_disable_text">Ẩn</span>
                    </a>
                    <?php endif; ?>
                    <?php if($deleteFlg): ?>
                    <a href="javascript:void(0)" title="Xóa" onclick="return doSubmit('<?php echo $backUrl.'/'.MODE_DELETE ?>');">
                        <span class="icon_remove" title="Xóa">
                        </span>
                        <span class="icon_remove_text">Xóa</span>
                    </a>
                    <?php endif; ?>
                    <?php if($addFlg): ?>
                    <a href="<?php echo $backUrl.'/'.MODE_ADD; ?>" title="Thêm mới">
                        <span class="icon_insert" title="Đăng ký">
                        </span>
                        <span class="icon_insert_text">Đăng ký</span>
                    </a>
                    <?php endif; ?>
                    <?php if($destroyOrderFlg): ?>
                    <a href="javascript:void(0)" title="Hủy đơn hàng" onclick="return onDestroyOrder('<?php echo current_url(); ?>')">
                        <span class="icon_order_destroy" title="Hủy đơn hàng">
                        </span>
                        <span class="icon_order_destroy_text">Hủy ĐH</span>
                    </a>
                    <?php endif; ?>
                    <?php if($replyFlg): ?>
                    <a href="<?php echo $backUrl.'/'.MODE_REPLY.'/'.$form_data['id']; ?>" title="Trả lời thư">
                        <span class="icon_reply_mail" title="Trả lời thư">
                        </span>
                        <span class="icon_reply_mail_text">Trả lời</span>
                    </a>
                    <?php endif; ?>
                    <?php if($sendFlg): ?>
                    <a href="javascript:void(0)" title="Gửi" onclick="return doSubmit('<?php echo current_url(); ?>');">
                        <span class="icon_send_mail" title="Gửi">
                        </span>
                        <span class="icon_send_mail_text">Gửi</span>
                    </a>
                    <?php endif; ?>
                    <?php if($sentFlg): ?>
                    <a href="<?php echo $backUrl.'/'.MODE_SENT; ?>" title="Thư đã gửi">
                        <span class="icon_sent_mail" title="Thư đã gửi">
                        </span>
                        <span class="icon_sent_mail_text">Thư đã gửi</span>
                    </a>
                    <?php endif; ?>
                    <?php if($printOrderFlg): ?>
                    <a href="javascript:void(0)" title="In đơn hàng" onclick="return doPrint('<?php echo base_url(URL_ADMIN_ORDERS.'/'.MODE_PRINT.'/'.$form_data[0]['id']) ?>')">
                        <span class="icon_print" title="In đơn hàng">
                        </span>
                        <span class="icon_print_text">In ĐH</span>
                    </a>
                    <?php endif; ?>
                    <?php if($saveFlg): ?>
                    <a class="icon_save_link" href="javascript:void(0)" title="Lưu dữ liệu" onclick="return doSubmit('<?php echo current_url(); ?>');">
                        <span class="icon_save" title="Lưu dữ liệu">
                        </span>
                        <span class="icon_save_text">Lưu</span>
                    </a>
                    <?php endif; ?>
                    <?php if($backFlg): ?>
                    <a href="<?php echo $backUrl; ?>" title="Quay lại">
                        <span class="icon_back" title="Quay lại">
                        </span>
                        <span class="icon_back_text">Quay lại</span>
                    </a>
                    <?php endif; ?>
                </div>
            </h3>
            <input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
            <?php 
                if($this->session->userdata('msgType') != null) {
                    $this->load->view('admin/messages_view'); 
                } else if(isset($message)) {
                    $this->load->view('admin/messages_view', $message); 
                }
            ?>
            <?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
            <?php $this->load->view($layout); ?>
            <div id="hidden-area">
				<input type="hidden" name="count" id="count" value="0" />
				<input type="hidden" name="removeList" id="removeList" value="" />
				<input type="hidden" name="removeDb" id="removeDb" value="" />
				<input type="hidden" name="file_id" id="file_id" value="" />
			</div>
            <?php echo form_close(); ?>
        </div><!-- End #left_column -->
    </div>
    
</div>
</body>
</html>

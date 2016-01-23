<div id="system_login">
	<h3 class="be-head">Quên mật khẩu</h3>
    <?php echo form_open(current_url()); ?>
    <div class="login_form">
        <div class="wrap-row" style="border-bottom:none;">
            <label>E-mail:</label>
            <input type="text" id="email" name="email" size="40" maxlength="100" placeholder="Vui lòng nhập" value="" class="focus <?php if(isset($err_email) && $err_email != '') echo 'error'; ?>" />
            <?php echo form_error('email','<span class="error" style="padding-left:100px">','</span>'); ?>
        </div>
        <div class="wrap-row"  style="border-bottom:none;">
            <label>TK đăng nhập:</label>
            <input type="text" id="username" name="username" size="40" maxlength="40" placeholder="Vui lòng nhập" value="" class="focus <?php if(isset($err_username) && $err_username != '') echo 'error'; ?>" />
            <?php echo form_error('username','<span class="error" style="padding-left:100px">','</span>'); ?>
        </div>
        <p style="margin-bottom: 0px">
            <label></label>
            <input type="submit" name="login" id="login" value="Gửi lại mật khẩu" onclick="return system_login('<?php echo base_url(); ?>');" />

        </p>
        <p style="padding:4px 0px;margin-bottom: 0px">
            <label></label>
            <a href="<?php echo base_url("admin/users/login"); ?>" title="Đăng nhập" style="color:#000;">Đăng nhập</a>
        </p>
        <div class="login_icon">
            <img src="<?php echo base_url("img/icons/user-icon.png") ?>" width="80px" height="80px" />
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
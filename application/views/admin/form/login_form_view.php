<div id="system_login">
	<h3 class="be-head">Đăng nhập</h3>
    <?php echo form_open(current_url()); ?>
    <div class="login_form">
        <p>
            <label>Tên đăng nhập:</label>
            <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="Vui lòng nhập" />
            <?php echo form_error('username','<span class="error" style="padding-left:100px">','</span>'); ?>
        </p>
        <p>
            <label>Mật khẩu:</label>
            <input type="password" name="password" id="password" value="<?php echo set_value('password') ?>" placeholder="Vui lòng nhập" />
        	<?php echo form_error('password','<span class="error" style="padding-left:100px">','</span>'); ?>
        </p>
        <p style="margin-bottom: 0px">
            <label></label>
            <input type="submit" name="login" id="login" value="Đăng nhập" onclick="return system_login('<?php echo base_url(); ?>');" />

        </p>
        <p style="padding:4px 0px;margin-bottom: 0px">
            <label></label>
            <input type="checkbox" name="remember" id="remember" <?php echo set_checkbox('remember', 1); ?> value="1" style="float:left;" /> <label for="remember" style="margin-top: 0px;margin-left: 5px;">Duy trì đăng nhập</label>
        </p>
        <p style="padding:4px 0px;margin-bottom: 0px">
            <label></label>
            <a href="<?php echo base_url("admin/users/forgotPassword"); ?>" title="Quên mật khẩu" style="color:#000;">Quên mật khẩu?</a>
        </p>
        <?php if($errLogin != ''): ?>
        <p style="padding:4px 0px;margin-bottom: 0px">
            <label></label>
            <a href="javascript:void(0)" title="Quên mật khẩu" style="font-weight: bold;"><?php echo $errLogin; ?></a>
        </p>
        <?php endif; ?>
        <div class="login_icon">
            <img src="<?php echo base_url("img/icons/user-icon.png") ?>" width="80px" height="80px" />
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
    <div id="form">
            <div class="wrap-row">
                <label>Mật khẩu cũ: </label>
                <input type="password" id="input-small"  maxlength="30" name="oldpassword" class="small <?php if(isset($err_oldpassword) && $err_oldpassword != '') echo 'error'; ?>" value="<?php echo set_value('oldpassword') ?>" />
                    (*) (Tối đa 30 kí tự)                
                    <?php echo form_error('oldpassword','<span class="error">','</span>'); ?>
            </div>
            <div class="wrap-row">
                <label>Mật khẩu mới: </label>
                <input type="password" id="input-small" maxlength="30" name="password" class="small <?php if(isset($err_password) && $err_password != '') echo 'error'; ?>" value="<?php echo set_value('password') ?>" />
                    (*) (Tối đa 30 kí tự)                
                    <?php echo form_error('password','<span class="error">','</span>'); ?>
                
            </div>
            <div class="wrap-row">
                <label>Nhập lại mật khẩu: </label>
                <input type="password" id="input-small" maxlength="30" name="confpass" class="small <?php if(isset($err_confpass) && $err_confpass != '') echo 'error'; ?>" value="<?php echo set_value('confpass') ?>" />
                    (*) (Tối đa 30 kí tự)                
                    <?php echo form_error('confpass','<span class="error">','</span>'); ?>
                
            </div>
            <p style="border:none;padding-bottom:0px;">
                <label></label>
                <span>(*):Bắt buộc nhập</span>
            </p>
    </div>
<?php echo form_close(); ?>
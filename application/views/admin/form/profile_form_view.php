<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
    <div id="form">
            <input type="hidden" name="id" value="<?php echo $user_id ?>" />
            <div class="wrap-row">
                <label>Họ tên: </label>
                <input type="text" id="input-small" maxlength="50" name="realname" class="small" value="<?php echo set_value('realname',$form_data['name']) ?>" />
                    (*) (Tối đa 50 kí tự)                
            </div>
            <div class="wrap-row">
                <label>Địa chỉ: </label>
                <input type="text" id="input-small" maxlength="100" name="address" class="small" value="<?php echo set_value('address', $form_data['address']);  ?>" />
                    (*) (Tối đa 100 kí tự)                
                
            </div>
            <div class="wrap-row">
                <label>Điện thoại: </label>
                <input type="text" id="input-small" maxlength="20" name="phone" class="small" value="<?php echo set_value('phone',$form_data['phone']); ?>" />
                    (*) (Tối đa 20 kí tự)                
                
            </div>
            <div class="wrap-row">
                <label>E-mail: </label>
                <input type="text" id="input-small" maxlength="50" name="email" class="small" value="<?php echo set_value('email',$form_data['email']); ?>" />
                    (*) (Tối đa 50 kí tự)                
                
            </div>
            <div class="wrap-row">
                    <label>Ảnh đại diện: </label>
                    <img id="preview" width="90" style="cursor: pointer" src="<?php echo $form_data['file_url']; ?>" />
                </div>
            <p style="border:none;padding-bottom:0px;">
                <label></label>
                <span>(*):Bắt buộc nhập</span>
            </p>
    </div>
<?php echo form_close(); ?>
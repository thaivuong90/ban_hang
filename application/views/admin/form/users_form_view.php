
<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
        <div id="form">
                <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>" />
                <input type="hidden" name="username_rules" value="required|callback_check_exist[username]" />
                <input type="hidden" name="name_rules" value="required" />
                <input type="hidden" name="email_rules" value="required|valid_email|callback_check_exist[email]" />
                <?php if($this->uri->segment(3) == 'add'): ?>
                <input type="hidden" name="password_rules" value="required" />
                <input type="hidden" name="confpass_rules" value="required|matches[password]" />
                <?php endif; ?>
                <div class="wrap-row">
                    <label>Họ tên tài khoản: </label>
                    <input type="text" id="input-small" maxlength="50" name="name" maxlength="50" class="small <?php if(isset($err_name) && $err_name != '') echo 'error'; ?>" value="<?php echo my_set_value('name',$form_data['name']) ?>" />
                    (*) (Tối đa 50 kí tự)
					<?php echo form_error('name','<span class="error">','</span>'); ?>                    
                </div>
                <div class="wrap-row">
                    <label>Địa chỉ: </label>
                    <input type="text" id="input-small" maxlength="100" name="address" class="small <?php if(isset($err_address) && $err_address != '') echo 'error'; ?>" value="<?php echo set_value('address', $form_data['address']);  ?>" />
                        (Tối đa 100 kí tự)                
					
                </div>
                <div class="wrap-row">
                    <label>Điện thoại: </label>
                    <input type="text" id="input-small" maxlength="20" name="phone" class="small <?php if(isset($err_phone) && $err_phone != '') echo 'error'; ?>" value="<?php echo set_value('phone',$form_data['phone']); ?>" />
                        (Tối đa 20 kí tự)                

                </div>
                <div class="wrap-row">
                    <label>E-mail: </label>
                    <input type="text" id="input-small" maxlength="50" name="email" class="small <?php if(isset($err_email) && $err_email != '') echo 'error'; ?>" value="<?php echo set_value('email',$form_data['email']); ?>" />
                        (*) (Tối đa 50 kí tự)                
                        <?php echo form_error('email','<span class="error">','</span>'); ?>  

                </div>
                <div class="wrap-row">
                    <label>Ảnh đại diện: </label>
                    <img id="preview" width="96" title="Click vào để chọn hình"  style="cursor: pointer" src="<?php echo $form_data['file_url']; ?>"  onclick="return openManager('<?php echo base_url(); ?>','users');" />
                    <input type="hidden" name="file_id" id="file_id" value="<?php echo $form_data['file_id']; ?>" />
                </div>
                <div class="wrap-row">
                    <label>Quyền hạn: </label>
                    <?php
                        $arrSelected = $this->input->post('role_id');
                        if(count($arrSelected) == 0) {
                            if(isset($form_data['role_id'])) {
                                $arrSelected = $form_data['role_id'];
                            }
                        }
                    ?>
                    <?php echo form_dropdown('role_id',$list_roles,$arrSelected,array('class' => $arrSelected)); ?>
                    <?php echo form_error('role_id','<span class="error">','</span>'); ?>   
                </div>
                <div class="wrap-row">
                    <label>Tên đăng nhập: </label>
                    <input type="text" id="input-small" maxlength="50" name="username" maxlength="50" class="small <?php if(isset($err_username) && $err_username != '') echo 'error'; ?>" value="<?php echo my_set_value('username',$form_data['username']) ?>" />
                    (*) (Tối đa 50 kí tự)
                                        <?php if(isset($err_username) && $err_username != ''): ?>
                                        <span class="error"><?php echo $err_username; ?></span>
                                        <?php endif; ?>
                    
                </div>
                <div class="wrap-row">
                    <label>Mật khẩu: </label>
                    <input type="password" id="input-small" maxlength="30" name="password" class="small <?php if(isset($err_password) && $err_password != '') echo 'error'; ?>" value="<?php echo set_value('password'); ?>" />
                        (*) (Tối đa 30 kí tự)                
                        <?php if(isset($err_password) && $err_password != ''): ?>
                                        <span class="error"><?php echo $err_password; ?></span>
                                        <?php endif; ?>

                </div>
                <div class="wrap-row">
                    <label>Nhập lại mật khẩu: </label>
                    <input type="password" id="input-small" maxlength="30" name="confpass" class="small <?php if(isset($err_confpass) && $err_confpass != '') echo 'error'; ?>" value="<?php echo set_value('confpass'); ?>" />
                        (*) (Tối đa 30 kí tự)                
                        <?php if(isset($err_confpass) && $err_confpass != ''): ?>
                                        <span class="error"><?php echo $err_confpass; ?></span>
                                        <?php endif; ?>

                </div>
                <div class="wrap-row">
                    <label style="margin-top: 5px;"></label>
                    <input type="checkbox" name="status" id="status" value="1" <?php echo my_set_checkbox('status',$form_data['status'],1) ?> />
                    <label for="status" style="float:none;">Đã kích hoạt</label>
                </div>
                <p style="border:none;padding-bottom:0px;">
                    <label></label>
                    <span>(*):Bắt buộc nhập</span>
                </p>
        </div>
<?php echo form_close(); ?>
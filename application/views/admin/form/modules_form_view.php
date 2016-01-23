
<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
        <div id="form">
                <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>" />
                <div class="wrap-row">
                    <label>Tên chức năng: </label>
                    <input type="text" id="input-small" maxlength="50" name="name" maxlength="50" class="small <?php if(isset($err_name) && $err_name != '') echo 'error'; ?>" value="<?php echo my_set_value('name',$form_data['name']) ?>" />
                    (*) (Tối đa 50 kí tự)
                    <?php echo form_error('name','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>URL: </label>
                    <input type="text" id="input-small" maxlength="50" name="url" maxlength="50" class="small <?php if(isset($err_url) && $err_url != '') echo 'error'; ?>" value="<?php echo my_set_value('url',$form_data['url']) ?>" />
                    (*) (Tối đa 50 kí tự)
                    <?php echo form_error('url','<span class="error">','</span>'); ?>
                    
                </div>
                <div class="wrap-row">
                    <label style="margin-top: 5px;"></label>
                    <input type="checkbox" name="is_group" id="is_group" value="1" <?php echo my_set_checkbox('is_group',$form_data['is_group'],1) ?> />
                    <label for="is_group" style="float:none;">Nhóm chức năng</label>
                </div>
                <div class="wrap-row">
                    <label>Chọn chức năng cha: </label>
                    <?php
                        $arrSelected = $this->input->post('parent');
                        if(count($arrSelected) == 0) {
                            if(isset($form_data['parent_id'])) {
                                $arrSelected = $form_data['parent_id'];
                            }
                        }
                    ?>
                    <?php echo form_dropdown('parent',$parents,$arrSelected,array('onchange' => 'return callAjax(&quot;modules&quot;,this.value);')); ?>
                   <?php echo form_error('parent','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label style="margin-top: 5px;">Chức năng cơ bản</label>
                    <select name="base[]" style="height:150px;" multiple>
                        <option value="add">Đăng ký</option>
                        <option value="edit">Chỉnh sửa</option>
                        <option value="delete">Xóa</option>
                        <option value="search">Tìm kiếm</option>
                        <option value="enable">Hiển thị</option>
                        <option value="disable">Ẩn</option>
                        <option value="trash">Thùng rác</option>
                        <option value="refresh">Phục hồi</option>
                        <option value="destroy">Hủy</option>
                    </select>
                </div>
                <div class="wrap-row">
                    <label>Trước mục: </label>
					<?php 
						echo form_dropdown('order_by',$orderBy,($form_data['order_by'] + 1),array('id' => 'order_by'));
					?>                    
                </div>
                <div class="wrap-row">
                    <label style="margin-top: 5px;"></label>
                    <input type="checkbox" name="status" id="status" value="1" <?php echo my_set_checkbox('status',$form_data['status'],1) ?> />
                    <label for="status" style="float:none;">Hiển thị</label>
                </div>
                <p style="border:none;padding-bottom:0px;">
                    <label></label>
                    <span>(*):Bắt buộc nhập</span>
                </p>
        </div>
<?php echo form_close(); ?>
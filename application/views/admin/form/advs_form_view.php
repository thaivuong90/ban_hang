
<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
        <div id="form">
                <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>" />
                <div class="wrap-row">
                    <label>Tên đăng ký: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'name','max_length' => 50,'class' => 'small '.$errClass,'value' => my_set_value('name',$form_data['name']))); ?>
                    (*) (Tối đa 50 kí tự)
                    <?php echo form_error('name','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Đường dẫn liên kết: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'url','max_length' => 50,'class' => 'small '.$errClass,'value' => my_set_value('url',$form_data['url']))); ?>
                	<?php echo form_error('url','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Ngày bắt đầu: </label>
                    <?php echo form_input(array('id' => 'startat-input','name' => 'start_at','max_length' => 50,'class' => 'small  no-input','value' => my_set_value('start_at',$form_data['start_at']),'readonly' => true)); ?>
                    <span class="startat-icon"></span>
                </div>
                <div class="wrap-row">
                    <label>Ngày kết thúc: </label>
                    <?php echo form_input(array('id' => 'finishat-input','name' => 'finish_at','max_length' => 50,'class' => 'small no-input','value' => my_set_value('finish_at',$form_data['finish_at']),'readonly' => true)); ?>
                    <span class="finishat-icon"></span>
                </div>
                <div class="wrap-row">
                    <label>Hình ảnh: </label>
                    <img id="preview" title="Click vào để chọn hình" style="cursor: pointer" src="<?php echo $form_data['file_url']; ?>"  onclick="return openManager('<?php echo base_url(); ?>','advs');" />
                    <input type="hidden" name="file_id" id="file_id" value="<?php echo $form_data['file_id']; ?>" />
                </div>
                <div class="wrap-row">
                    <label>Thông tin thêm: </label>
                    <textarea id="textarea" name="desc" cols="108" rows="25" class="editor"><?php echo my_set_value('desc', $form_data['desc']) ?></textarea>
                </div>
                <div class="wrap-row">
                    <label style="margin-top: 5px;"></label>
                    <input type="checkbox" name="status" id="status" value="1" <?php echo my_set_checkbox('status',$form_data['status'],1) ?> />
                    <label for="status" style="float:none;">Hiện trên trang chủ</label>
                </div>
                <p style="border:none;padding-bottom:0px;">
                    <label></label>
                    <span>(*):Bắt buộc nhập</span>
                </div>
        </div>
<?php echo form_close(); ?>
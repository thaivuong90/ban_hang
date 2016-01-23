
<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
        <div id="form">
                <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>" />
                <div class="wrap-row">
                    <label>Tên menu: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'name','max_length' => 50,'class' => 'small ','value' => my_set_value('name',$form_data['name']))); ?>
                    (*) (Tối đa 50 kí tự)
                    <?php echo form_error('name','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Đường dẫn: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'url','max_length' => 50,'class' => 'small ','value' => my_set_value('url',$form_data['url']))); ?>
                    (*) (Tối đa 50 kí tự)
                    <?php echo form_error('url','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Chuyển hướng: </label>
					<?php 
						echo form_dropdown('target',array('_self' => 'Không mở tab mới','_blank' => 'Mở ở tab mới'),set_select('target'));
					?>                    
                </div>
                <div class="wrap-row">
                    <label>Trước mục: </label>
					<?php 
						echo form_dropdown('order_by',$orderBy,$form_data['order_by'] + 1);
					?>                    
                </div>
                <div class="wrap-row">
                    <label style="margin-top: 5px;"></label>
                    <input type="checkbox" name="status" id="status" value="1" <?php echo my_set_checkbox('status',$form_data['status'],1) ?> />
                    <label for="status" style="float:none;">Hiện trên trang chủ</label>
                </div>
                <p style="border:none;padding-bottom:0px;">
                    <label></label>
                    <span>(*):Bắt buộc nhập</span>
                </p>
        </div>
<?php echo form_close(); ?>
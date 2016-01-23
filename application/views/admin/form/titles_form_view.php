
<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
        <div id="form">
                <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>" />
                <input type="hidden" name="name_rules" value="required|callback_check_exist[name]" />
                <input type="hidden" name="parent_rules" value="required" />
                <input type="hidden" name="status_rules" value="required" />
                <div class="wrap-row">
                    <label>Tên chủ đề: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'name','max_length' => 50,'class' => 'small','value' => my_set_value('name',$form_data['name']))); ?>
                    (*) (Tối đa 50 kí tự)
                    <?php echo form_error('name','<span class="error">','</span>'); ?>
                    
                </div>
                <div class="wrap-row">
                    <label>Chọn chủ đề chính: </label>
                    <?php
                        $arrSelected = $this->input->post('parent');
                        if(count($arrSelected) == 0) {
                            if(isset($form_data['parent'])) {
                                $arrSelected = $form_data['parent'];
                            }
                        }
                    ?>
                    <?php echo form_dropdown('parent',$parents,$arrSelected,array('class' => $arrSelected,'onchange' => 'return callAjax(&quot;titles&quot;,this.value);')); ?>
                    <?php echo form_error('parent','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Trước mục: </label>
					<?php 
						echo form_dropdown('order_by',$orderBy,($form_data['order_by'] + 1),array('id' => 'order_by'));
					?>                    
                </div>
                <div class="wrap-row">
                    <label>Meta title: </label>
                    <input type="text" id="input-small" maxlength="65" name="meta_title" class="small" value="<?php echo my_set_value('meta_title',$form_data['meta_title']) ?>" />
                    (Tối đa 65 kí tự)
                    <?php echo form_error('meta_title','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Meta keywords: </label>
                    <?php echo form_textarea(array('name' => 'meta_keywords','max_length' => 50,'cols' => 66,'rows' => 4),my_set_value('meta_keywords',$form_data['meta_keywords'])) ?>
                </div>
                <div class="wrap-row">
                    <label>Meta description: </label>
                    <?php echo form_textarea(array('name' => 'meta_desc','max_length' => 300,'cols' => 66,'rows' => 10),my_set_value('meta_desc',$form_data['meta_desc'])) ?>
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
                </p>
        </div>
<?php echo form_close(); ?>
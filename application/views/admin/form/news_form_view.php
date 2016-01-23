
<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
        <div id="form">
                <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>" />
                <div class="wrap-row">
                    <label>Tựa đề: </label>
                    
                    <?php
                        $errClass = '';
                        if(isset($err_name) && $err_name != '') {
                            $errClass = 'error';
                        }
                    ?>
                    <?php echo form_input(array('id' => 'input-small','name' => 'name','max_length' => 50,'class' => 'small '.$errClass,'value' => my_set_value('name',$form_data['name']))); ?>
                    (*) (Tối đa 50 kí tự)
                     <?php echo form_error('name','<span class="error">','</span>'); ?>
                    
                </div>
                <div class="wrap-row">
                    <label>Chọn chủ đề: </label>
                    <?php 
                        unset($parents[0]);
                        $arrChoose = $this->input->post('title_id');
                        if(count($arrChoose) == 0) {
                            if(isset($form_data['title_id'])) {
                                $arrChoose = $form_data['title_id'];
                            }
                        }
                    ?>
                    <?php echo form_dropdown('title_id',$title_id,$arrChoose); ?>
                    <?php echo form_error('title_id','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Trước mục: </label>
					<?php 
						echo form_dropdown('order_by',$orderBy,($form_data['order_by'] + 1));
					?>                    
                </div>
                <div class="wrap-row">
                    <label>Ngày xuất bản: </label>
                    <input type="text" id="calendar-input" maxlength="50" name="publish_at" class="small no-input" value="<?php echo my_set_value('publish_at',$form_data['publish_at']) ?>" />
                    <span class="calendar-icon"></span>
                </div>
                <div class="wrap-row">
                    <label>Ảnh mô tả: </label>
                    <img id="preview" width="96" style="cursor: pointer" src="<?php echo $form_data['file_url']; ?>"  onclick="return openManager('<?php echo base_url(); ?>','news');" />
                    <input type="hidden" name="file_id" id="file_id" value="<?php echo $form_data['file_id']; ?>" />
                </div>
                <div class="wrap-row">
                    <label>Nội dung: </label>
                    <textarea id="textarea" name="content" cols="108" rows="25" class="editor"><?php echo my_set_value('content', $form_data['content']) ?></textarea>
                    <?php echo form_error('content','<span class="error">','</span>'); ?>
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
                    <label for="status" style="float:none;">Xuất bản</label>
                </div>
                <p style="border:none;padding-bottom:0px;">
                    <label></label>
                    <span>(*):Bắt buộc nhập</span>
                </p>
        </div>
<?php echo form_close(); ?>
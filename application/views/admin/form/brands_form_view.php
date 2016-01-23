<ul class="tab">
	<li><a class="active" href="javascript:void(0)" onclick="return showTab(this,'tab1');">Thông tin hiển thị</a></li>
	<li><a href="javascript:void(0)" onclick="return showTab(this,'tab2');">SEO</a></li>
	<li><a href="javascript:void(0)" onclick="return showTab(this,'tab3');">Thông tin thêm</a></li>
</ul>
<div id="tab1" class="tab-view first-child">
	<div id="form">
                <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>" />
                <div class="wrap-row">
                    <label>Tên nhà cung cấp: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'name','max_length' => 50,'class' => 'small','value' => my_set_value('name',$form_data['name']))); ?>
                    (*) (Tối đa 50 kí tự)
                    <?php echo form_error('name','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Chọn danh mục: </label>
                    <?php 
                        unset($parents[0]);
                        $arrChoose = $this->input->post('categories');
                        if(count($arrChoose) == 0) {
                            if(isset($form_data['categories'])) {
                                $arrChoose = $form_data['categories'];
                            }
                        }
                        unset($categories['']);
                    ?>
                    <?php echo form_multiselect('categories[]',$categories,$arrChoose,array('style' => 'height:200px;')); ?>
                    <?php echo form_error('categories[]','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Trước mục: </label>
					<?php 
						echo form_dropdown('order_by',$orderBy,($form_data['order_by'] + 1));
					?>                    
                </div>
                <div class="wrap-row">
                    <label style="margin-top: 5px;"></label>
                    <input type="checkbox" name="status" id="status" value="1" <?php echo my_set_checkbox('status',$form_data['status'],1) ?> />
                    <label for="status" style="float:none;">Hiện trên trang chủ</label>
                </div>
                <div class="wrap-row">
                    <label>Logo: </label>
                    <img id="preview" width="96" style="cursor: pointer" src="<?php echo $form_data['file_url']; ?>" />
                </div>
                <p style="border:none;padding-bottom:0px;">
                    <label></label>
                    <span>(*):Bắt buộc nhập</span>
                </p>
        </div>
</div>
<div id="tab2" class="tab-view">
		<div id="form">
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
        </div>
</div>
<div id="tab3" class="tab-view">
	<br/>
    <textarea id="textarea" name="desc" cols="108" rows="25" class="editor"><?php echo my_set_value('desc', $form_data['desc']) ?></textarea>
</div>
        

<ul class="tab">
	<li><a class="active" href="javascript:void(0)" onclick="return showTab(this,'tab1');">Thông tin hiển thị</a></li>
	<li><a href="javascript:void(0)" onclick="return showTab(this,'tab2');">SEO</a></li>
	<li><a href="javascript:void(0)" onclick="return showTab(this,'tab3');">Thông số kĩ thuật</a></li>
	<li><a href="javascript:void(0)" onclick="return showTab(this,'tab4');">Hình ảnh</a></li>
	<li><a href="javascript:void(0)" onclick="return showTab(this,'tab5');">Thông tin thêm</a></li>
</ul>
<div id="tab1" class="tab-view first-child">
        <div id="form">
                <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>" />
                <div class="wrap-row">
                    <label>Tên sản phẩm: </label>
                    <input type="text" id="input-small" maxlength="50" name="name" class="small <?php if(isset($err_name) && $err_name != '') echo 'error'; ?>" value="<?php echo my_set_value('name',$form_data['name']) ?>" />
                    (*) (Tối đa 50 kí tự)
					<?php echo form_error('name','<span class="error">','</span>'); ?>                    
                </div>
                <div class="wrap-row">
                    <label>Chọn danh mục: </label>
                    <?php
                        $arrSelected = $this->input->post('category_id');
                        if(count($arrSelected) == 0) {
                            if(isset($form_data['category_id'])) {
                                $arrSelected = $form_data['category_id'];
                            }
                        }
                    ?>
                    <?php echo form_dropdown('category_id',$category_id,$arrSelected); ?>
                    <?php echo form_error('category_id','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Chọn nhà cung cấp: </label>
                    <?php
                        $arrSelected = $this->input->post('brand_id');
                        if(count($arrSelected) == 0) {
                            if(isset($form_data['brand_id'])) {
                                $arrSelected = $form_data['brand_id'];
                            }
                        }
                    ?>
                    <?php echo form_dropdown('brand_id',$brand_id,$arrSelected); ?>
                    <?php echo form_error('brand_id','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Trước mục: </label>
					<?php 
						echo form_dropdown('order_by',$orderBy,($form_data['order_by'] + 1));
					?>                    
                </div>
                <div class="wrap-row">
                    <label>Ngày hiệu lực: </label>
                    <input type="text" id="calendar-input" maxlength="20" name="publish_at" class="small no-input" readonly="true" value="<?php echo my_set_value('publish_at',$form_data['publish_at']) ?>" />
                    <span class="calendar-icon"></span>
                </div>
                <div class="wrap-row">
                    <label>Đơn giá: </label>
                    <input type="text" id="input-small" maxlength="20" name="price" class="small <?php if(isset($err_price) && $err_price != '') echo 'error'; ?>" value="<?php echo my_set_value('price',$form_data['price']) ?>" />
                    (Tối đa 20 kí tự)
                                        <?php if(isset($err_price) && $err_price != ''): ?>
                                        <span class="error"><?php echo $err_price; ?></span>
                                        <?php endif; ?>
                </div>
                <div class="wrap-row">
                    <label>Giảm giá: </label>
                    <input type="text" id="input-small" maxlength="3" name="discount" class="small <?php if(isset($err_discount) && $err_discount != '') echo 'error'; ?>" value="<?php echo my_set_value('discount',$form_data['discount']) ?>" />
                    (Tối đa 3 kí tự)
                                        <?php if(isset($err_discount) && $err_discount != ''): ?>
                                        <span class="error"><?php echo $err_discount; ?></span>
                                        <?php endif; ?>
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
	<p>Tab 3</p>
</div>
<div id="tab4" class="tab-view">
	<table width="100%">
		<tr>
			<td><a href="javascript:void(0)" onclick="return createUploadField(); ">Chọn hình ảnh</a> (*.jpg,*.png,*.jpeg,*.gif, tối đa 500KB)</td>
			<td id="upload_field">
			</td>
		</tr>
	</table>
	<h4>Các hình ảnh đã tải lên:</h4>
	<ul id="uploaded">
		<?php if(isset($form_data['images']) && count($form_data['images']) > 0): ?>
		<?php foreach($form_data['images'] as $img): ?>
		<li id="li_edit<?php echo $img['file_id']; ?>">
			<span onclick="return removeFromDb(<?php echo $img['file_id']; ?>);" title="Xóa" class="remove-folder"></span>
			<a href="javascript:void(0)" title="Click vào hình để làm ảnh đại diện" onclick="return pickImg(this,<?php echo $img['file_id']; ?>);">
				<img src="<?php echo base_url(UPLOAD_PRODUCTS_PATH.$img['filename']); ?>" alt="<?php echo base_url(UPLOAD_PRODUCTS_PATH.$img['filename']); ?>" />
			</a>
		</li>
		<?php endforeach; ?>
		<?php endif; ?>
	</ul>
</div>
<div id="tab5" class="tab-view">
	<br/>
	<textarea id="textarea" name="desc" class="editor"><?php echo my_set_value('desc', $form_data['desc']) ?></textarea>
</div>

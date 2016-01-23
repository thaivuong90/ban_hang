<form id="form" action="<?php echo $submitUrl; ?>" method="post">
   
<div id="form">
    <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>" />
    <div class="wrap-row">
        <label>Tên quyền: </label>
        <input type="text" name="name" value="<?php echo my_set_value('name',$form_data['name']) ?>" maxlength="50"  />
        (*) (Tối đa 50 kí tự)
        <?php echo form_error('name','<span class="error">','</span>'); ?>                          
    </div>
    <div class="wrap-row">
        <label>Quyền truy cập: </label>
        <?php 
            unset($modules[0]);
            $arrChoose = $this->input->post('modules');
            if(count($arrChoose) == 0) {
                if(isset($form_data['selected_modules'])) {
                    $arrChoose = $form_data['selected_modules'];
                }
            }
        ?>
        <?php echo form_multiselect('modules[]',$modules,$arrChoose,array('style' => 'height:200px;')); ?>
        <?php echo form_error('modules[]','<span class="error">','</span>'); ?>
    </div>
    <div class="wrap-row">
        <label style="margin-top: 5px;"></label>
        <input type="checkbox" name="status" id="status" value="1" <?php echo my_set_checkbox('status',$form_data['status'],1) ?> />
        <label for="status" style="float:none;">Đang hoạt động</label>
    </div>
    <p style="border:none;padding-bottom:0px;">
        <label></label>
        <span>(*):Bắt buộc nhập</span>
    </p>
</div>
</form>
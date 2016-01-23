
<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
        <div id="form">
                <input type="hidden" name="system_id" value="<?php echo $settings['system_id']; ?>" />
                <div class="wrap-row">
                    <label>Tên trang web: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'webtitle','max_length' => 50,'class' => 'small ','value' => my_set_value('webtitle',$settings['webtitle']))); ?>
                    (*) (Tối đa 50 kí tự)
                    <?php echo form_error('webtitle','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Đường dẫn website: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'baseurl','max_length' => 100,'class' => 'small ','value' => my_set_value('baseurl',$settings['baseurl']))); ?>
                    (*) (Tối đa 100 kí tự)
                    <?php echo form_error('baseurl','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Thẻ meta-keywords: </label>
                    <?php echo form_textarea(array('name' => 'keywords','max_length' => 50,'cols' => 66,'rows' => 4),my_set_value('keywords',$settings['keywords'])) ?>
                </div>
                <div class="wrap-row">
                    <label>Thẻ meta-description: </label>
                    <?php echo form_textarea(array('name' => 'desc','max_length' => 300,'cols' => 66,'rows' => 10),my_set_value('desc',$settings['desc'])) ?>
                </div>
                <div class="wrap-row">
                    <label>Logo: </label>
                    <img id="logo_preview" title="Click vào để chọn hình"  style="cursor: pointer" src="<?php echo $settings['file_url']; ?>"  onclick="return openManager('<?php echo base_url(); ?>','logo','logo_preview','logo_id');" />
                    <input type="hidden" name="logo_id" id="logo_id" value="<?php echo $settings['logo_id']; ?>" />
                </div>
                <div class="wrap-row">
                    <label>Icon: </label>
                    <img id="ico_preview" title="Click vào để chọn hình"  style="cursor: pointer" src="<?php echo $settings['ico_url']; ?>"  onclick="return openManager('<?php echo base_url(); ?>','ico','ico_preview','ico_id');" />
                    <input type="hidden" name="ico_id" id="ico_id" value="<?php echo $settings['ico_id']; ?>" />
                </div>
                <div class="wrap-row">
                    <label>Mail protocol: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'protocol','max_length' => 100,'class' => 'small ','value' => my_set_value('protocol',$settings['protocol']))); ?>
                    (*) (Tối đa 100 kí tự)
                    <?php echo form_error('protocol','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Mail port: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'port','max_length' => 10,'class' => 'small ','value' => my_set_value('port',$settings['port']))); ?>
                    (*) (Tối đa 10 kí tự)
                    <?php echo form_error('port','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Mail host: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'host','max_length' => 120,'class' => 'small ','value' => my_set_value('host',$settings['host']))); ?>
                    (*) (Tối đa 120 kí tự)
                    <?php echo form_error('host','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Mail user: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'mailuser','max_length' => 100,'class' => 'small ','value' => my_set_value('mailuser',$settings['mailuser']))); ?>
                    (*) (Tối đa 100 kí tự)
                     <?php echo form_error('mailuser','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Mail password: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'mailpassword','max_length' => 100,'class' => 'small ','value' => my_set_value('mailpassword',$settings['mailpassword']))); ?>
                    (*) (Tối đa 100 kí tự)
                    <?php echo form_error('mailpassword','<span class="error">','</span>'); ?>
                </div>
                <div class="wrap-row">
                    <label>Mail starttls: </label>
             		<?php echo form_checkbox(array('id' => 'starttls', 'name' => 'starttls'),1,my_set_checkbox('starttls',1, $settings['starttls'])); ?>
                    <label for="starttls" style="float:none;">Có</label>
                </div>
                <div class="wrap-row">
                    <label>Mail type: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'mailtype','max_length' => 20,'class' => 'small ','value' => my_set_value('mailtype',$settings['mailtype']))); ?>
                    (*) (Tối đa 20 kí tự)
                    <?php echo form_error('mailtype','<span class="error">','</span>'); ?>
                </div>
                <p style="border:none;padding-bottom:0px;">
                    <label></label>
                    <span>(*):Bắt buộc nhập</span>
                </p>
        </div>
<?php echo form_close(); ?>
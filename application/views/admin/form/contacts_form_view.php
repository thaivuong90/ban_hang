
<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
        <div id="form">
                <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>" />
                <input type="hidden" name="content_rules" value="required" />
                <div class="wrap-row">
                    <label>Người gửi: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'author','max_length' => 50,'class' => 'small no-input','value' => $form_data['author'],'readonly' => true)); ?>
                </div>
                <div class="wrap-row">
                    <label>E-mail: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'email','max_length' => 50,'class' => 'small no-input','value' => $form_data['email'],'readonly' => true)); ?>
                </div>
                <div class="wrap-row">
                    <label>Chủ đề: </label>
                    <?php echo form_input(array('id' => 'input-small','name' => 'subject','max_length' => 50,'class' => 'small no-input','value' => $form_data['subject'],'readonly' => true)); ?>
                </div>
                <div class="wrap-row">
                    <label>Nội dung: </label>
                    <?php if($mode == MODE_REPLY): ?>
                    <?php echo form_textarea(array('id' => 'reply_mail','name' => 'content','rows' => 6,'cols' => 100,'placeholder' => 'Tối đa 300 kí tự')); ?>
                    <span id="content_mail">
                    	********************************** Trả lời cho liên lạc: ********************************<br>
                    	Gửi từ <?php echo $form_data['email']; ?> vào ngày <?php echo cnvStringToDate($form_data['create_at'],'dd-mm-yyyy hh:ii:ss'); ?><br><br>
	                    <?php echo $form_data['content']; ?>
	                </span>
	                <?php echo form_error('content','<span class="error">','</span>'); ?>
                    <?php else: ?>
                    <?php echo form_textarea(array('name' => 'content','rows' => 4,'cols' => 100,'readonly' => true,'class' => 'no-input'),$form_data['content']); ?>
                    <?php endif; ?>
                </div>
                
        </div>
<?php echo form_close(); ?>
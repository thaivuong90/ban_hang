<?php
    if($this->session->flashdata('msgType') != null && $this->session->flashdata('content') != null) {

        $msgType = $this->session->flashdata('msgType');
        $content = $this->session->flashdata('content');
    }
?>
<?php if($msgType == 'success'): ?>
<p class="success">
    <img src="<?php echo base_url("img/icons/success.png"); ?>" />
    <span><?php echo $content; ?></span>
    <span class="close">Đóng</span>
</p>
<?php endif; ?>
<?php if($msgType == 'error'): ?>
<div class="error">
    <img src="<?php echo base_url("img/icons/delete.png"); ?>" />
    <p><?php echo $content; ?></p>
    <span class="close">Đóng</span>
</div>
<?php endif; ?>


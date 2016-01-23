<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>File Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Image Manager" />
        <script type="text/javascript" src="<?php echo base_url("js/custom.js") ?>" ></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/files.css"); ?>" />
    </head>
    <body>
    	<?php echo form_open_multipart(current_url(),array('id' => 'form')); ?>
    	<input type="hidden" name="root" id="root" value= "<?php echo $root; ?>" />
    	<input type="hidden" name="myPreview" id="myPreview" value= "<?php echo $myPreview; ?>" />
    	<input type="hidden" name="mode" id="mode" value= "" />
    	<input type="hidden" name="new_folder_name" id="new_folder_name" value= "" />
    	<input type="hidden" name="old_folder_name" id="old_folder_name" value= "" />
        <div id="directory">
        	<div id="dtop">
        		<strong>Thư mục:</strong>
        		<input type="text" name="path" id="path" value= "<?php echo $path; ?>" size="57" readonly="readonly" />
        		<a href="javascript:void(0)" title="Quay lại" class="bFolder" onclick="return backFolder();" style="<?php echo $style; ?>" ></a>
        		<a href="javascript:void(0)" title="Tạo thư mục" class="cFolder" onclick="return createFolder();" ></a>
        		<a href="javascript:void(0)" title="Tải hình ảnh" class="uFile" onclick="return openDialog('upload_images');" ></a>
        		<a href="javascript:void(0)" title="Chọn hình ảnh" class="dFile" onclick="return selectAll();" ></a>
        		<input type="file" name="file[]" id="upload_images" style="display:none" onchange="return uploadAuto();" multiple />
        	</div>
        	<?php if(isset($errorUpload) && count($errorUpload) > 0):?>
        	<?php for($i = 0; $i < count($errorUpload); $i++):?>
        	<p style="color:#F00;font-weight:bold;">
        		<?php echo 'Lỗi upload file '.$errorUpload[$i]['file']. ':'.$errorUpload[$i]['error']; ?>
        	</p>
        	<?php endfor; ?>
        	<?php endif; ?>
        	<ul class="tree-map">
        		<?php if(isset($folders) && count($folders) > 0): ?>
        		<?php foreach($folders as $f): ?>
	        		<?php if($f['type'] == 'd'):?>
	        		<li class="lifolder">
	        			<span class='remove-folder' onclick="return removeFolder(<?php echo $f['id']; ?>,'<?php echo $f['name']; ?>');" title="Xóa thư mục"></span>
	        			<span class='edit-folder' onclick="return renameFolder('<?php echo $f['name']; ?>');"  title="Sửa thư mục"></span>
	        			<a href="javascript:void(0)" class="dfolder" onclick="return sendFile('<?php echo $f['name']; ?>',<?php echo $f['id']; ?>,event);">
	        				<img src="<?php echo base_url('/img/icons/folder_icon.png'); ?>" title="Folder" width="76" height="71" />
	        				<span class="dname"><?php echo $f['name']; ?></span>
	        			</a>
	        		</li>
	        		<?php else: ?>
	        		<li class="lifolder">
	        			<span class='remove-folder' onclick="return removeFile(<?php echo $f['id']; ?>,'<?php echo $f['filename']; ?>');" title="Xóa tập tin"></span>
	        			<a href="javascript:void(0)" id="img<?php echo $f['id']; ?>" class="dimg" onclick="return sendFile('<?php echo $f['IMG_URL']; ?>',<?php echo $f['id']; ?>,event);">
	        				<img src="<?php echo $f['IMG_URL']; ?>" title="<?php echo $f['IMG_URL']; ?>" alt="<?php echo $f['IMG_URL']; ?>" width="76px" height="71px" />
	        				<span class="dname"><?php echo cutString($f['filename'],30); ?></span>
	        				<input type="hidden" value= "<?php echo $f['id']; ?>" />
	        			</a>
	        		</li>
	        		<?php endif; ?>
        		<?php endforeach; ?>
        		<?php endif; ?>
        	</ul>
        </div>
        <?php echo form_close(); ?>
    </body>
</html>

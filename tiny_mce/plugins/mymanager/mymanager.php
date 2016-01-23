<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
    <head>
        <meta charset="utf-8" />
        <title>File Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Image Manager" />
		<link href="css/style.css" rel="stylesheet" />
		<script type="text/javascript">
			function passData(src) {

				opener.document.f1.src.value = src;
				self.close();
			}
		
		</script>
    </head>
    <body>
    	<?php $base_url = "http://" . $_SERVER['SERVER_NAME']; ?>
        <div id="directory">
        	<h3>
        		<span>Danh sách tập tin hoặc thư mục:</span>
        		<a href="javascript:void(0)" class="dback" title="Quay lại">Quay lại</a>
        	</h3>
        	<ul class="tree-map">
        		<li>
        			<a href="javascript:void(0)" class="dfolder">
        				<img src="<?php echo $base_url.'/img/icons/folder_icon.png'; ?>" title="Folder" />
        				<span class="dname">Folder 1</span>
        			</a>
        		</li>
        		<li>
        			<a href="javascript:void(0)" class="dfolder">
        				<img src="<?php echo $base_url.'/img/icons/folder_icon.png'; ?>" title="Folder" />
        				<span class="dname">Folder 1</span>
        			</a>
        		</li>
        		<li>
        			<a href="javascript:void(0)" class="dfolder">
        				<img src="<?php echo $base_url.'/img/icons/folder_icon.png'; ?>" title="Folder" />
        				<span class="dname">Folder 1</span>
        			</a>
        		</li>
        		<li>
        			<a href="javascript:void(0)" class="dimg">
        				<img src="<?php echo $base_url.'/upload/system_1/products/thumb/20151205155228_iphone-6-plus-64gb-2-400x534_thumb.png'; ?>" 
        				title="Test" height="71px"  onclick="return passData(this.src);" />
        				<span class="dname">Image 1</span>
        			</a>
        		</li>
        		<li>
        			<a href="javascript:void(0)" class="dimg">
        				<img src="<?php echo $base_url.'/upload/system_1/products/thumb/20151205155228_iphone-6-plus-64gb-2-400x534_thumb.png'; ?>" title="Test" height="71px" />
        				<span class="dname">Image 1</span>
        			</a>
        		</li>
        		<li>
        			<a href="javascript:void(0)" class="dimg">
        				<img src="<?php echo $base_url.'/upload/system_1/products/thumb/20151205155228_iphone-6-plus-64gb-2-400x534_thumb.png'; ?>" title="Test" height="71px" />
        				<span class="dname">Image 1</span>
        			</a>
        		</li>
        		<li>
        			<a href="javascript:void(0)" class="dimg">
        				<img src="<?php echo $base_url.'/upload/system_1/products/thumb/20151205155228_iphone-6-plus-64gb-2-400x534_thumb.png'; ?>" title="Test" height="71px" />
        				<span class="dname">Image 1</span>
        			</a>
        		</li>
        		<li>
        			<a href="javascript:void(0)" class="dimg">
        				<img src="<?php echo $base_url.'/upload/system_1/products/thumb/20151205155228_iphone-6-plus-64gb-2-400x534_thumb.png'; ?>" title="Test" height="71px" />
        				<span class="dname">Image 1</span>
        			</a>
        		</li>
        		<li>
        			<a href="javascript:void(0)" class="dimg">
        				<img src="<?php echo $base_url.'/upload/system_1/products/thumb/20151205155228_iphone-6-plus-64gb-2-400x534_thumb.png'; ?>" title="Test" height="71px" />
        				<span class="dname">Image 1</span>
        			</a>
        		</li>
        	</ul>
        </div>
</html>

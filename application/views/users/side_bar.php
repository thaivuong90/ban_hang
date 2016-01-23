<?php if($categories != ''): ?>
<div class="left-block">
<h3><span class="icon_red_arrow"></span> Danh mục sản phẩm</h3>
<?php echo $categories; ?>
</div>
<?php endif; ?>

<div class="left-block">
<?php if(isset($brands) && count($brands) > 0): ?>
<h3><span class="icon_red_arrow"></span> Hãng sản xuất</h3>
<ul class="category">
	<?php foreach($brands as $brand): ?>
	<li><a href="<?php echo base_url('frontend/brands/'.$brand['id']); ?>"><?php echo $brand['name']; ?></a></li>
	<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

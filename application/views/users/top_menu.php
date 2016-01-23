<?php if(isset($top_nav) && count($top_nav) > 0): ?>
<ul class="top-nav">
	<?php foreach($top_nav as $nav): ?>
	<li>
		<a href="<?php echo $nav['url']; ?>" title="<?php echo $nav['name']; ?>"><?php echo $nav['name']; ?></a>
	</li>
	<?php endforeach; ?>
	<li class="li-search">
		<?php echo form_open(base_url('search')); ?>
		<input type="text" name="keyword" id="keyword" />
		<input type="submit" name="search" value="" id="search" />
		<?php echo form_close(); ?>
	</li>
</ul>
		<?php endif; ?>
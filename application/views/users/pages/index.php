<?php if(isset($products)): ?>
<div class="right-block">
	<h3 class="black-head">
		<span class="icon_red"></span>
		Xe máy
	</h3>
	<?php $index = 1; ?>
	<?php foreach($products as $product): ?>
	<div class="block <?php if($index % 4 == 0) echo 'no-margin-right';?>">
		<h4><a href="#" title="<?php echo $product['name']; ?>"><?php echo cutString($product['name'],24); ?></a></h4>
		<div class="block-img">
			<a href="#" title="<?php echo $product['name']; ?>">
			<?php if($product['file_url'] != base_url(NO_IMG_URL)): ?>
			<img src="<?php echo $product['file_url']; ?>" alt="<?php echo $product['file_url']; ?>" width="180" height="185" />
			<?php endif; ?>
			</a>
		</div>
		<div class="price">
			<span class="price-num"><?php echo formarCurrency($product['price']); ?> đ</span>
			<button id="addToCart">Đặt hàng</button>
		</div>
	</div>
	<?php $index++; ?>
	<?php endforeach; ?>
</div>
<?php endif; ?>
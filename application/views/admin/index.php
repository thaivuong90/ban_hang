<div id="dashboard">
	<div class="info-block">
		<h4>Tổng đơn hàng</h4>
		<div class="info-fast info-cart">
			<span class="info-qty">
			<?php if(isset($dashboard['order_cnt'])) echo convertNumberToText($dashboard['order_cnt']); ?>
			</span>
		</div>
			<a class="view-more" href="<?php echo base_url(URL_ADMIN_ORDER); ?>" title="Xem thêm">Xem thêm...</a>
	</div>
	<div class="info-block">
		<h4>Tổng doanh thu</h4>
		<div class="info-fast info-sale">
			<span class="info-qty">
			<?php if(isset($dashboard['order_sales'])) echo convertNumberToText($dashboard['order_sales']); ?>
			</span>
		</div>
			<a class="view-more" href="<?php echo base_url(URL_ADMIN_ORDER); ?>" title="Xem thêm">Xem thêm...</a>
	</div>
	<div class="info-block">
		<h4>Số lượng khách hàng</h4>
		<div class="info-fast info-customer">
			<span class="info-qty">
			<?php if(isset($dashboard['customers'])) echo convertNumberToText($dashboard['customers']); ?>
			</span>
		</div>
			<a class="view-more" href="<?php echo base_url(URL_ADMIN_USER); ?>" title="Xem thêm">Xem thêm...</a>
	</div>
	<div class="info-block" style="margin-right:0px">
		<h4>Khách đang online</h4>
		<div class="info-fast info-online">
			<span class="info-qty">
			<?php if(isset($dashboard['online'])) echo convertNumberToText($dashboard['online']); ?>
			</span>
		</div>
			<a class="view-more" href="javascript:void(0)" title="Xem thêm"></a>
	</div>
</div>
<div id="last-orders">
	<h4>Đơn hàng mới nhất</h4>
	<table class="last-orders">
		<thead>
			<tr>
				<th>Số đơn hàng</th>
				<th>Khách hàng</th>
				<th>Trạng thái</th>
				<th>Ngày đăng ký</th>
				<th>Tổng tiền(vnđ)</th>
			</tr>
		</thead>
		<tbody>
			<?php if(isset($dashboard['lastest_orders']) && count($dashboard['lastest_orders']) > 0): ?>
			<?php foreach($dashboard['lastest_orders'] as $order): ?>
			<tr>
				<td><?php echo $order['order_id']; ?></td>
				<td><?php echo $order['customer_name']; ?></td>
				<td>Chưa xác nhận</td>
				<td><?php echo $order['create_at']; ?></td>
				<td><?php echo number_format($order['total_money'], 0 , ',', '.'); ?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="5">0 đơn hàng</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
<div id="chart">
	<h4>Biểu đồ</h4>

</div>
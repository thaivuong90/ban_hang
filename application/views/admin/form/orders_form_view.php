
<?php echo form_open_multipart($submitUrl,array('id' => 'form')); ?>
        <div id="form">
                <input type="hidden" name="id" value="<?php echo $form_data[0]['id']; ?>" />
                <input type="hidden" name="status" id="status" value="<?php echo $form_data[0]['status']; ?>" />
                <div id="proccess">
                    <?php if($form_data[0]['status'] != 6): ?>
                    <ul class="step">
                        <li id="step-1"><a href="javascript:void(0)" onclick="return updateOrder(1);" >Chưa xác nhận</a></li>
                        <li id="step-2"><a href="javascript:void(0)" onclick="return updateOrder(2);">Đã xác nhận</a></li>
                        <li id="step-3"><a href="javascript:void(0)" onclick="return updateOrder(3);">Đang giao hàng</a></li>
                        <li id="step-4"><a href="javascript:void(0)" onclick="return updateOrder(4);">Đã giao hàng</a></li>
                        <li id="step-5"><a href="javascript:void(0)" onclick="return updateOrder(5);">Đã thanh toán</a></li>
                    </ul>
                    <?php endif; ?>
                    <?php if($form_data[0]['status'] == 1): ?>
                    <img id="status_bar" src="<?php echo base_url('img/process/step1.png') ?>" alt="Chưa xác nhận" />
                    <?php elseif($form_data[0]['status'] == 2): ?>
                    <img id="status_bar" src="<?php echo base_url('img/process/step2.png') ?>" alt="Đã xác nhận" />
                    <?php elseif($form_data[0]['status'] == 3): ?>
                    <img id="status_bar" src="<?php echo base_url('img/process/step3.png') ?>" alt="Đang giao" />
                    <?php elseif($form_data[0]['status'] == 4): ?>
                    <img id="status_bar" src="<?php echo base_url('img/process/step4.png') ?>" alt="Đã giao" />
                    <?php elseif($form_data[0]['status'] == 5): ?>
                    <img id="status_bar" src="<?php echo base_url('img/process/step5.png') ?>" alt="Đã thanh toán" />
                    <?php elseif($form_data[0]['status'] == 6): ?>
                    <img id="status_bar" src="<?php echo base_url('img/process/step6.png') ?>" alt="Hủy" />
                    <?php endif; ?>
                </div>
                <table class="order_table">
                    <tbody>
                        <tr>
                            <th>Số đơn hàng: </th>
                            <td>
                                <?php echo form_input(array('name' => 'order_id','readonly' => true,'class' => 'no-input','value' => $form_data[0]['order_id'],'style' => 'width:97%')); ?>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Khách hàng: </th>
                            <td>
                                <?php echo form_input(array('name' => 'customer_name','readonly' => true,'class' => 'no-input','value' => $form_data[0]['customer_name'],'style' => 'width:97%')); ?>
                            </td>
                            <th>
                                Địa chỉ: 
                            </th>
                            <td>
                                <?php echo form_input(array('name' => 'customer_address','readonly' => true,'class' => 'no-input','value' => $form_data[0]['customer_address'],'style' => 'width:97%')); ?>
                            </td>
                            <th>
                               Điện thoại: 
                            </th>
                            <td>
                                <?php echo form_input(array('name' => 'customer_phone','readonly' => true,'class' => 'no-input','value' => $form_data[0]['customer_phone'],'style' => 'width:92%')); ?>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: text-top">Ghi chú: </th>
                            <td colspan="5">
                                <?php echo form_textarea(array('rows' => 3,'cols' => 119,'class' => 'no-input','readonly' => true),$form_data[0]['msg']); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <label style="">Chi tiết đơn hàng:</label>
                <div id="scroll">
                <table class="list" id="myTable">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th style="text-align: center">Số lượng đặt</th>
                            <th style="text-align: center">Đơn giá (VNĐ)</th>
                            <th style="text-align: center">Thành tiền (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php if(isset($form_data) && count($form_data) > 0): ?>
                        <?php $i=0;foreach($form_data as $rows): ?>
                        <tr>
                            <td ><?php $i++; echo $i; ?></td>
                            <td >
                                <?php echo $rows["product_id"]; ?>
                            </td>
                            <td><?php echo $rows['product_name']; ?></td>
                            <td style="text-align: center;"><?php echo $rows['qty']; ?></td>
                            <td style="text-align: center;"><?php echo number_format($rows['price'], 0, ',', '.'); ?></td>
                            <td style="text-align: center;"><?php echo number_format($rows['sub_total'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <tr>
                            <td colspan="2"></td>
                            <td style="text-align: right;"><b>Tổng số lượng đặt:</b></td>
                            <td style="text-align: center;background: #b0ffb0"><?php echo $rows['total_qty']; ?></td>
                            <td style="text-align: right;"><b>Tổng tiền thanh toán:</b></td>
                            <td style="text-align: center;background: #b0ffb0"><?php echo number_format($form_data[0]['total_money'], 0, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                </table>
                    </div>
                
        </div>
<?php echo form_close(); ?>
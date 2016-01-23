<div id="list">
    <?php if($mode == MODE_INIT || $mode == MODE_SEARCH): ?>
    <div class="search">
       
        <div class="search_form">
            <table class="search-table">
                <tr>
                    <td>
                        Số đơn hàng:
                    </td>
                    <td>
                        <input type="text" id="search_order_id" name="search_order_id" value="<?php echo set_value('search_order_id') ?>" style="width: 323px;"  />
                    </td>
                    <td>
                        Ngày đặt hàng:
                    </td>
                    <td>
                        <?php echo form_input(array('id' => 'datefrom','name' => 'datefrom','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('datefrom'))); ?>~
                        <?php echo form_input(array('id' => 'dateto','name' => 'dateto','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('dateto'))); ?>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        Trạng thái:
                    </td>
                    <td>
                        <?php
                            $options = array(
                                ''         =>  '---',
                                ORDER_ID_1  =>  ORDER_STEP_1,
                                ORDER_ID_2  =>  ORDER_STEP_2,
                                ORDER_ID_3  =>  ORDER_STEP_3,
                                ORDER_ID_4  =>  ORDER_STEP_4,
                                ORDER_ID_5  =>  ORDER_STEP_5,
                            );
                        ?>
                        <?php echo form_dropdown('search_status', $options); ?>
                    </td>
                    <td>
                        Ngày giao hàng:
                    </td>
                    <td>
                        <?php echo form_input(array('name' => 'deliveryfrom','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('publishfrom'))); ?>~
                        <?php echo form_input(array('name' => 'deliveryto','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('publishto'))); ?>
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="center">
                        <?php $this->load->view('admin/search_button'); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php endif; ?>
    <table class="list" id="myTable">
        <thead>
            <tr>
                <th style="width:16px;"><input type="checkbox" name="checkAll" onclick="return checkAllRow();" /></th>
                <th>STT</th>
                <th>Số đơn hàng</th>
                <th style="text-align: center">Khách hàng</th>
                <th style="text-align: center">Số lượng đặt</th>
                <th style="text-align: center">Tiền thanh toán</th>
                <th style="text-align: center">Thuế VAT</th>
                <th style="text-align: center">Ngày đặt hàng</th>
                <th style="text-align: center">Ngày giao hàng</th>
                <th style="text-align: center;">Trạng thái</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tbody">
            <input type="hidden" name="index" id="index" value="0" />
            <?php if($data!=null): ?>
            <?php $i=0;foreach($data as $rows): ?>
            <input type="hidden" name="delete_flg_<?php echo $rows['id'] ?>" value="<?php echo $rows['delete_flg']; ?>" />
            <tr>
                <td ><input type="checkbox" class="remove-chk" name="checkAll[]" value="<?php echo $rows["id"]; ?>" /></td>
                <td ><?php $i++; echo $i; ?></td>
                <td >
                    <?php echo $rows["order_id"]; ?>
                </td>
                <td style="text-align: center;"><?php echo $rows['customer_name']; ?></td>
                <td style="text-align: center;"><?php echo $rows['total_qty']; ?></td>
                <td style="text-align: center;"><?php echo number_format($rows['total_money'], 0, ',', '.'); ?></td>
                <td style="text-align: center;"><?php echo $rows['tax_rt']; ?></td>
                <td style="text-align: center;"><?php echo $rows['create_at']; ?></td>
                <td style="text-align: center;"><?php echo $rows['delivery_at']; ?></td>
                <td style="text-align: center;">
                    
                    <?php if($rows["status"]==1): ?>
                    <span style="color:#939393">Chưa xác nhận</span>
                    <?php elseif($rows["status"]==2): ?>
                    <span style="color:#004080">Đã xác nhận</span>
                    <?php elseif($rows["status"]==3): ?>
                    <span style="color:#ff8000">Đang giao hàng</span>
                    <?php elseif($rows["status"]==4): ?>
                    <span style="color:#804040">Đã giao hàng</span>
                    <?php elseif($rows["status"]==5): ?>
                    <span style="color:#008000">Đã thanh toán</span>
                    <?php elseif($rows["status"]==6): ?>
                    <span style="color:#ff0000">Đã hủy</span>
                    <?php endif; ?>
                </td>
                <td >
                    <a class="edit_icon" title="Sửa" href="<?php echo base_url('admin/orders/edit/'.$rows['id']) ?>"></a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr >
                <td colspan="11" style="text-align: center">(Chưa có dữ liệu)</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
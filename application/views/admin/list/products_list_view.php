<div id="list">
    <div class="search">
        <div class="search_form">
            <table class="search-table">
                <tr>
                    <td>
                        Tên sản phẩm:
                    </td>
                    <td>
                        <?php echo form_input(array('name' => 'search_name','style' => 'width: 323px','value' => set_value('search_name'))); ?>
                    </td>
                    <td>
                        Nhà cung cấp:
                    </td>
                    <td>
                        <?php echo form_dropdown('brand_id', $brand_id) ?>
                        
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        Ngày đăng ký:
                    </td>
                    <td>
                        <?php echo form_input(array('id' => 'datefrom','name' => 'datefrom','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('datefrom'))); ?>~
                        <?php echo form_input(array('id' => 'dateto','name' => 'dateto','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('dateto'))); ?>
                        
                    </td>
                    <td>
                        Theo danh mục:
                    </td>
                    <td>
                        <?php echo form_dropdown('category_id', $category_id) ?>
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        Trạng thái:
                    </td>
                    <td>
                        <?php echo form_radio(array('name' => 'search_status','id' => 'enable','value' => 1,'class' => 'status-radio','' => set_radio('search_status', 1))); ?><label class="status-lbl" for="enable">Hoạt động</label>
                        <?php echo form_radio(array('name' => 'search_status','id' => 'disable','value' => 0,'class' => 'status-radio','' => set_radio('search_status', 0))); ?><label class="status-lbl" for="disable">Đã dừng</label>
                    </td>
                    <td>
                       
                    </td>
                    <td>
                        
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
    <input type="hidden" name="param" id="param" value="" />
    <table class="list">
        <thead>
                <tr>
                <th style="width:16px;"><input type="checkbox" name="checkAll" onclick="return checkAllRow();" /></th>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th style="text-align: center">Hình ảnh</th>
                <th style="text-align: center">Đơn giá</th>
                <th style="text-align: center">Khuyến mãi</th>
                <th style="text-align: center">Ngày đăng ký</th>
                <th style="text-align: center">Tài khoản đăng ký</th>
                <th style="width:60px;">Trạng thái</th>
                <th style="width:20px;"></th>
            </tr>
        </thead>
        <tbody>
            <?php if($data!=null): ?>
            <?php $i=0;foreach($data as $rows): ?>
            <input type="hidden" name="delete_flg_<?php echo $rows['id'] ?>" value="<?php echo $rows['delete_flg']; ?>" />
            <tr>
                <th><input type="checkbox" class="remove-chk" name="checkAll[]" value="<?php echo $rows['id']; ?>" /></th>
                <td><?php $i++; echo $i; ?></td>
                <td><?php echo $rows["name"]; ?></td>
                <td style="text-align: center">
                    <img src="<?php echo $rows['file_url'] ?>" alt="<?php echo $rows['file_url'] ?>" width="75" />
                </td>
                <td><?php echo number_format($rows["price"], 0 , ',', '.'); ?></td>
                <td><?php echo number_format($rows["discount"], 0 , ',', '.'); ?></td>
                <td style="text-align: center"><?php echo $rows['create_at']; ?></td>
                <td style="text-align: center"><?php echo $rows['create_by']; ?></td>
                <td style="text-align: center;">
                    <?php if($rows["status"]==1): ?>
                    <img src="<?php echo base_url('img/icons/success.png') ?>" />
                    <?php else: ?>
                    <img src="<?php echo base_url('img/icons/delete.png') ?>" />
                    <?php endif; ?>
                </td>
                <td><a class="edit_icon" title="Sửa" href="<?php echo base_url("admin/products/edit/".$rows["id"]); ?>"></a></td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="11" style="text-align: center">(Chưa có dữ liệu)</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if(isset($page_links)): ?>
    <div id="pager">
        <div class="pager">
            <?php echo $page_links; ?>
        </div>
        <span class="count">
        <?php
            echo 'Có tất cả '.$totalRows.' dòng dữ liệu';
        ?>
        </span>
    </div>
    <?php endif; ?>
</div>
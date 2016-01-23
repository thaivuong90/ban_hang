<div id="list">
    <?php if($mode == MODE_INIT || $mode == MODE_SEARCH): ?>
    <div class="search">
       
        <div class="search_form">
            <table class="search-table">
                <tr>
                    <td>
                        Tên chủ đề:
                    </td>
                    <td>
                        <input type="text" id="search_name" name="search_name" value="<?php echo set_value('search_name') ?>" style="width: 323px;"  />
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
                <th>Tên chủ đề</th>
                <th style="text-align: center">Ngày đăng ký</th>
                <th style="text-align: center">Tài khoản đăng ký</th>
                <th >Trạng thái</th>
                <th ></th>
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
                    
                    <?php echo $rows["name"]; ?>
                </td>
                <td style="text-align: center;"><?php echo $rows['create_at']; ?></td>
                <td style="text-align: center;"><?php echo $rows['create_by']; ?></td>
                <td style="text-align: center;">
                    
                    <?php if($rows["status"]==1): ?>
                    <img src="<?php echo base_url('img/icons/success.png') ?>" />
                    <?php else: ?>
                    <img src="<?php echo base_url('img/icons/delete.png') ?>" />
                    <?php endif; ?>
                </td>
                <td >
                    <a class="edit_icon" title="Sửa" href="<?php echo base_url('admin/titles/edit/'.$rows['id']) ?>"></a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr >
                <td colspan="9" style="text-align: center">(Chưa có dữ liệu)</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
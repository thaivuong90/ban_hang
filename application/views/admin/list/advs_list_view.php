<div id="list">
    <input type="hidden" name="param" id="param" value="" />
    <table class="list">
        <thead>
                <tr>
                <th style="width:16px;"><input type="checkbox" name="checkAll" onclick="return checkAllRow();" /></th>
                <th>STT</th>
                <th>Tên đăng ký</th>
                <th>Hình ảnh</th>
                <th>Liên kết</th>
                <th style="text-align: center">Ngày đăng ký</th>
                <th style="text-align: center">Tài khoản đăng ký</th>
                <th style="width:60px;">Trạng thái</th>
                <th style="width:20px;"></th>
                <th style="width:16px;"></th>
            </tr>
        </thead>
        <tbody>
            <?php if($data!=null): ?>
            <?php $i=0;foreach($data as $rows): ?>
            <input type="hidden" name="delete_flg_<?php echo $rows['id'] ?>" value="<?php echo $rows['delete_flg']; ?>" />
            <tr>
                <th><input type="checkbox" class="remove-chk" name="checkAll[]" value="<?php echo $rows["id"]; ?>" /></th>
                <td><?php $i++; echo $i; ?></td>
                <td><?php echo $rows["name"]; ?></td>
                <td>
                	<img width="200" src="<?php echo $rows["file_url"]; ?>" /></td>
                <td><?php echo $rows["url"]; ?></td>
                <td style="text-align: center"><?php echo $rows['create_at']; ?></td>
                <td style="text-align: center"><?php echo $rows['create_by']; ?></td>
                <td style="text-align: center;">
                    <?php if($rows["status"]==1): ?>
                    <img src="<?php echo base_url('img/icons/success.png') ?>" />
                    <?php else: ?>
                    <img src="<?php echo base_url('img/icons/delete.png') ?>" />
                    <?php endif; ?>
                </td>
                <td><a class="edit_icon" title="Sửa" href="<?php echo base_url("admin/slides/edit/".$rows["id"]); ?>"></a></td>
                <td>
                <a class="delete_icon" title="Xóa" href="<?php echo base_url("admin/slides/delete/".$rows["id"]); ?>" onclick="return doConfirm('<?php echo LTV0008 ?>');" ></a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="9" style="text-align: center">(Chưa có dữ liệu)</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if(isset($page_links)): ?>
    <div id="pager">
        <div class="pager">
            <?php echo $page_links; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
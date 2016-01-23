<div id="list">
    <?php echo form_open_multipart(uri_string(),array('id' => 'form')); ?>
    <div class="search">
        <div class="search_form">
            
            <table class="search-table">
                <tr>
                    <td>
                        <input type="file" name="import" /> <input type="submit" id="submit" name="submit" value="Tải lên" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        (Yêu cầu tập tin có đuôi *.xls,*.xlsx,*.csv hoặc file *.zip, kích thước tối đa 5MB)
                    </td>
                    <td>
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
                <th>Tên tập tin</th>
                <th style="text-align: center">Loại tập tin</th>
                <th style="text-align: center">Kích cỡ</th>
                <th style="text-align: center">Ngày tải lên</th>
                <th style="text-align: center">Người tải</th>
                <th style="width:60px;">Trạng thái</th>
                <th style="width:20px;"></th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($data) && $data!=null): ?>
            <?php $i=0;foreach($data as $rows): ?>
            <input type="hidden" name="delete_flg_<?php echo $rows['id'] ?>" value="<?php echo $rows['delete_flg']; ?>" />
            <tr>
                <th><input type="checkbox" class="remove-chk" name="checkAll[]" value="<?php echo $rows['id']; ?>" /></th>
                <td><?php $i++; echo $i; ?></td>
                <td><?php echo $rows["name"]; ?></td>
                <td style="text-align: center"><?php echo $rows["ext"]; ?></td>
                <td style="text-align: center"><?php echo $rows["size"]; ?></td>
                <td style="text-align: center"><?php echo $rows['create_at']; ?></td>
                <td style="text-align: center"><?php echo $rows['create_by']; ?></td>
                <td style="text-align: center;">
                    <?php if($rows["status"]==1): ?>
                    <img src="<?php echo base_url('img/icons/success.png') ?>" />
                    <?php else: ?>
                    <img src="<?php echo base_url('img/icons/delete.png') ?>" />
                    <?php endif; ?>
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
    <div id="pager">
        
        <div class="pager">
            <?php if(isset($page_links)) echo $page_links; ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
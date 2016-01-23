<div id="list">
    <div class="search">
        <div class="search_form">
            <table class="search-table">
                <tr>
                    <td>
                        Tên tài khoản
                    </td>
                    <td>
                        <?php echo form_input(array('name' => 'search_name','style' => 'width: 323px','value' => set_value('search_name'))); ?>
                    </td>
                    <td>
                        Tên đăng nhập:
                    </td>
                    <td>
                        <?php echo form_input(array('name' => 'search_username','style' => 'width: 323px','value' => set_value('search_username'))); ?>
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
                        Quyền hạn :
                    </td>
                    <td>
                        <?php echo form_dropdown('role_id', $list_roles) ?>
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
                </tr>
                <tr>
                    <td colspan="4" align="center">
                        <?php $this->load->view('admin/search_button'); ?>
                    </td>
                </tr>
            </table>
        </div>
        <?php echo form_close(); ?>
    </div>
     <?php echo form_open(uri_string(),array('id' => 'form')); ?>
    <input type="hidden" name="param" id="param" value="" />
    <table class="list">
        <thead>
                <tr>
                <th style="width:16px;"><input type="checkbox" name="checkAll" onclick="return checkAllRow();" /></th>
                <th>STT</th>
                <th>Tên tài khoản</th>
                <th style="text-align: center">Ảnh đại diện</th>
                <th style="text-align: center">Ngày đăng ký</th>
                <th style="text-align: center">Lần cuối đăng nhập</th>
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
                <th><input type="checkbox" class="remove-chk" name="checkAll[]" value="<?php echo $rows['id']; ?>" /></th>
                <td><?php $i++; echo $i; ?></td>
                <td><?php echo $rows["name"]; ?></td>
                <td style="text-align: center">
                    <img src="<?php echo $rows['file_url'] ?>" width="90" />
                </td>
                <td style="text-align: center"><?php echo $rows['create_at']; ?></td>
                <td style="text-align: center"><?php echo $rows['lastlogin']; ?></td>
                <td style="text-align: center;">
                    <?php if($rows["status"]==1): ?>
                    <img src="<?php echo base_url('img/icons/success.png') ?>" />
                    <?php else: ?>
                    <img src="<?php echo base_url('img/icons/delete.png') ?>" />
                    <?php endif; ?>
                </td>
                <td><a class="edit_icon" title="Sửa" href="<?php echo base_url("admin/users/edit/".$rows["id"]); ?>"></a></td>
                <td>
                <a class="delete_icon" title="Xóa" href="<?php echo base_url("admin/users/delete/".$rows["id"]); ?>" onclick="return doConfirm('<?php echo LTV0008 ?>');" ></a>
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
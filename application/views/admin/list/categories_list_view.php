<div id="list">
    <?php if($mode == MODE_INIT || $mode == MODE_SEARCH): ?>
    <div class="search">
       
        <div class="search_form">
            <table class="search-table">
                <tr>
                    <td>
                        Tên danh mục:
                    </td>
                    <td>
                        <?php echo form_input(array('name' => 'search_name','style' => 'width: 323px','value' => set_value('search_name'))); ?>
                    </td>
                    <td>
                        Trạng thái:
                    </td>
                    <td>
                        <?php echo form_radio(array('name' => 'search_status','id' => 'enable','value' => 1,'class' => 'status-radio','' => set_radio('search_status', 1))); ?><label class="status-lbl" for="enable">Hoạt động</label>
                        <?php echo form_radio(array('name' => 'search_status','id' => 'disable','value' => 0,'class' => 'status-radio','' => set_radio('search_status', 0))); ?><label class="status-lbl" for="disable">Đã dừng</label>
                    </td>
                    <td></td>
                    
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
                        Theo nhóm:
                    </td>
                    <td>
                        <?php echo form_dropdown('parent', $parents) ?>
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
    <?php endif; ?>
    <table class="list" id="myTable">
        <thead>
            <tr>
                <th style="width:16px;"><input type="checkbox" name="checkAll" onclick="return checkAllRow();" /></th>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th style="text-align: center">Ngày đăng ký</th>
                <th style="text-align: center">Tài khoản đăng ký</th>
                <th >Mục cha</th>
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
                <td style="width:1%;"><input type="checkbox" class="remove-chk" name="checkAll[]" value="<?php echo $rows["id"]; ?>" /></td>
                <td style="width:3%;"><?php $i++; echo $i; ?></td>
                <td style="width:30%;">
                    
                    <?php echo $rows["name"]; ?>
                </td>
                <td style="text-align: center;width:12%;"><?php echo $rows['create_at']; ?></td>
                <td style="text-align: center;width:12%;"><?php echo $rows['create_by']; ?></td>
                <td style="text-align: center;width:12%;">
                    
                    <?php echo $rows['parent']; ?>
                </td>
                <td style="text-align: center;width:8%;" >
                    
                    <?php if($rows["status"]==1): ?>
                    <img src="<?php echo base_url('img/icons/success.png') ?>" />
                    <?php else: ?>
                    <img src="<?php echo base_url('img/icons/delete.png') ?>" />
                    <?php endif; ?>
                </td>
                <td style="width:2%;">
                    <a class="edit_icon" title="Sửa" href="<?php echo base_url('admin/categories/edit/'.$rows['id']) ?>"></a>
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
        <span class="count">
        <?php
            echo 'Có tất cả '.$totalRows.' dòng dữ liệu';
        ?>
        </span>
    </div>
    <?php endif; ?>
</div>
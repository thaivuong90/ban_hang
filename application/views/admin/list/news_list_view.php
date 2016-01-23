<div id="list">
    <?php if($mode == MODE_INIT || $mode == MODE_SEARCH): ?>
    <div class="search">
       
        <div class="search_form">
            <table class="search-table">
                <tr>
                    <td>
                        Tựa đề bài viết:
                    </td>
                    <td>
                        <input type="text" id="search_name" name="search_name" value="<?php echo set_value('search_name') ?>" style="width: 323px;"  />
                    </td>
                    <td>
                        Ngày đăng ký:
                    </td>
                    <td>
                        <?php echo form_input(array('id' => 'datefrom', 'name' => 'datefrom','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('datefrom'))); ?>~
                        <?php echo form_input(array('id' => 'dateto', 'name' => 'dateto','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('dateto'))); ?>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        Xuất bản:
                    </td>
                    <td>
                        <?php echo form_radio(array('name' => 'search_status','id' => 'enable','value' => 1,'class' => 'status-radio','' => set_radio('search_status', 1))); ?><label class="status-lbl" for="enable">Có</label>
                        <?php echo form_radio(array('name' => 'search_status','id' => 'disable','value' => 0,'class' => 'status-radio','' => set_radio('search_status', 0))); ?><label class="status-lbl" for="disable">Chưa</label>
                    </td>
                    <td>
                        Ngày xuất bản:
                    </td>
                    <td>
                        <?php echo form_input(array('id' => 'publishfrom','name' => 'publishfrom','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('publishfrom'))); ?>~
                        <?php echo form_input(array('id' => 'publishto','name' => 'publishto','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('publishto'))); ?>
                        
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
                <th>Tựa đề</th>
                <th style="text-align: center">Chủ đề</th>
                <th style="text-align: center">Ngày đăng ký</th>
                <th style="text-align: center">Tài khoản đăng ký</th>
                <th style="text-align: center">Ngày xuất bản</th>
                <th style="text-align: center">Tài khoản xuất bản</th>
                <th >Xuất bản</th>
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
                <td style="text-align: center;"><?php echo $rows['title_name']; ?></td>
                <td style="text-align: center;"><?php echo $rows['create_at']; ?></td>
                <td style="text-align: center;"><?php echo $rows['create_by']; ?></td>
                <td style="text-align: center;"><?php echo $rows['publish_at']; ?></td>
                <td style="text-align: center;"><?php echo $rows['publish_by']; ?></td>
                <td style="text-align: center;">
                    
                    <?php if($rows["status"]==1): ?>
                    <img src="<?php echo base_url('img/icons/success.png') ?>" />
                    <?php else: ?>
                    <img src="<?php echo base_url('img/icons/delete.png') ?>" />
                    <?php endif; ?>
                </td>
                <td >
                    <a class="edit_icon" title="Sửa" href="<?php echo base_url('admin/news/edit/'.$rows['id']) ?>"></a>
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
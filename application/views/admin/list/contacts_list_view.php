<div id="list">
    <?php if($mode == MODE_INIT || $mode == MODE_SEARCH): ?>
    <div class="search">
       
        <div class="search_form">
            <table class="search-table">
                <tr>
                    <td>
                        E-mail:
                    </td>
                    <td>
                        <?php echo form_input(array('name' => 'search_email','style' => 'width: 323px','value' => set_value('search_email'))); ?>
                    </td>
                    <td>
                        Trạng thái:
                    </td>
                    <td>
                        <?php echo form_radio(array('name' => 'search_status','id' => 'enable','value' => 0,'class' => 'status-radio','' => set_radio('search_status', 0))); ?><label class="status-lbl" for="enable">Chưa đọc</label>
                        <?php echo form_radio(array('name' => 'search_status','id' => 'disable','value' => 1,'class' => 'status-radio','' => set_radio('search_status', 1))); ?><label class="status-lbl" for="disable">Đã đọc</label>
                        <?php echo form_radio(array('name' => 'search_status','id' => 'reply','value' => 2,'class' => 'status-radio','' => set_radio('search_status', 2))); ?><label class="status-lbl" for="reply">Đã trả lời</label>
                    </td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td>
                        Ngày gởi:
                    </td>
                    <td>
                        <?php echo form_input(array('id' => 'datefrom','name' => 'datefrom','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('datefrom'))); ?>~
                        <?php echo form_input(array('id' => 'dateto','name' => 'dateto','style' => 'width: 150px','placeholder' => 'dd-mm-yyyy','value' => set_value('dateto'))); ?>
                        
                    </td>
                    <td>
                        Tên người gởi:
                    </td>
                    <td>
                        <?php echo form_input(array('name' => 'search_author','style' => 'width: 323px','value' => set_value('search_author'))); ?>
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
        	<?php if($mode == MODE_SENT): ?>
        	<tr>
                <th style="width:16px;"><input type="checkbox" name="checkAll" onclick="return checkAllRow();" /></th>
                <th>STT</th>
                <th>Khách hàng</th>
                <th>Gửi đến e-mail</th>
                <th style="text-align: center">Ngày gởi</th>
                <th style="text-align: center">Nội dung</th>
                <th >Trạng thái</th>
                <th ></th>
            </tr>
        	<?php else: ?>
            <tr>
                <th style="width:16px;"><input type="checkbox" name="checkAll" onclick="return checkAllRow();" /></th>
                <th>STT</th>
                <th>Người gởi</th>
                <th>E-mail</th>
                <th style="text-align: center">Ngày gởi</th>
                <th style="text-align: center">Nội dung</th>
                <th >Trạng thái</th>
                <th ></th>
            </tr>
            <?php endif; ?>
        </thead>
        <tbody id="tbody">
            <?php if($data!=null): ?>
            <?php $i=0;foreach($data as $rows): ?>
            <input type="hidden" name="delete_flg_<?php echo $rows['id'] ?>" value="<?php echo $rows['delete_flg']; ?>" />
            <tr>
                <td style="width:1%;"><input type="checkbox" class="remove-chk" name="checkAll[]" value="<?php echo $rows["id"]; ?>" /></td>
                <td style="width:3%;"><?php $i++; echo $i; ?></td>
                <td style="width:10%;">
                    
                    <?php echo $rows["author"]; ?>
                </td>
                <td style="width:10%;">
                    
                    <?php echo $rows["email"]; ?>
                </td>
                <td style="text-align: center;width:12%;"><?php echo $rows['create_at']; ?></td>
                <td style="text-align: center;width:30%;"><?php echo $rows['content']; ?></td>
                <td style="text-align: center;width:8%;" ><?php echo $rows['status']; ?></td>
                <td style="width:2%;">
                    <a class="edit_icon" title="Trả lời" href="<?php echo base_url('admin/contacts/edit/'.$rows['id']) ?>"></a>
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
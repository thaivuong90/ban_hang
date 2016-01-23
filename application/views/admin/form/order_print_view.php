<!DOCTYPE html>
<html>
<head>
	<title>In đơn hàng</title>
        <script type="text/javascript">
            function init() {
                window.print();
            }
        </script>
        <style type="text/css">
            /*============================ Orders =========================== */
            div#order_wrapper {
                width:500px;
                height:550px;
                margin: 40px auto;
                border:1px solid #ccc;
                overflow: hidden;
            }
            div#order_header {
                overflow: hidden;
            }
            div#order_header p{
                text-align: center;
            }
            p#order_comp_name {
                font-weight: 600;
            }
            p#order_type_name {
                font-weight: bold;
            }
            div#order_customer {
                overflow: hidden;
            }
            div#order_customer p {
                text-align: center;
            }
            div#order_detail {
                
            }
            div#order_detail table {
                border:1px solid #ccc;
                border-collapse: collapse;
                width:90%;
                margin: 0px auto;
            }
            div#order_detail table th,div#order_detail table td {
                border:1px solid #ccc;
            }
            p#order_money_char {
                text-align: center;
            }
            div#order_sign {
                overflow: hidden;
            }
            div#order_sign_left {
                float:left;
                overflow: hidden;
                width:30%;
                margin-left: 50px;
            }
            div#order_sign_left span {
                font-weight: bold;
            }
            div#order_sign_right { 
                float:right;
                overflow: hidden;
                width:30%;
                margin-right: 50px;
            }
            div#order_sign_right span{
                display: block;
            }
            
        </style>
</head>
<body onload="return init();">

    <div id="order_wrapper">
        <div id="order_header">
            <p id="order_comp_name">CÔNG TY TMCP & GIẢI PHÁP KHÔNG GIAN XANH</p>
            <p id="order_comp_addr">ĐC: Số 273-275, Đường 9A, Khu Trung Sơn, Tp.HCM, Việt Nam</p>
            <p id="order_comp_phone">ĐT:8 54316469</p>
            <p id="order_type_name">HÓA ĐƠN BÁN HÀNG</p>
        </div>
        <div id="order_customer">
            <p>
                <label>Tên khách hàng:</label>
                <i><b><?php echo $form_data[0]['customer_name'] ?></b></i>
            </p>
            <p>
                <label>Địa chỉ:</label>
                <i><b><?php echo $form_data[0]['customer_address'] ?></b></i>
                <label>ĐT:</label>
                <i><b><?php echo $form_data[0]['customer_phone'] ?></b></i>
            </p>
        </div>
        <div id="order_detail">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên hàng</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($form_data as $data): ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td width="30%"><?php echo $data['product_name']; ?></td>
                        <td align="center"><?php echo $data['qty']; ?></td>
                        <td align="right"><?php echo number_format($data['price'], 0, ',', '.'); ?></td>
                        <td align="right"><?php echo number_format($data['sub_total'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td align="right" colspan="4"><i><b>Tổng cộng:</b></i></td>
                        <td align="right"><?php echo number_format($data['total_money'], 0, ',', '.'); ?></td>
                    </tr>
                </tbody>
            </table>
            <p id="order_money_char">Thành tiền viết bằng chữ:........................................................................</p>
        </div>
        <div id="order_sign">
            <div id="order_sign_left">
                <span>KHÁCH HÀNG</span>
            </div>
            <div id="order_sign_right">
                <span style="font-size: 12px;"><?php echo $form_data[0]['print_date']; ?></span>
                <span><strong>&nbsp;&nbsp;CHỦ CỬA HÀNG</strong></span>
            </div>
        </div>
        
    </div><!-- End #order_wrapper -->

</body>
</html>

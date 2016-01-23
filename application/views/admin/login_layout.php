<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yêu cầu đăng nhập</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/admin_style.css"); ?>" />
<script type="text/javascript" src="<?php echo base_url("js/jquery-1.7.1.min.js") ?>" ></script>
<script type="text/javascript" src="<?php echo base_url("js/custom.js") ?>" ></script>
<style type="text/css">
        div#system_login
        {
            width:430px;
            margin:200px auto;
            position:relative;
            border:2px solid #d2d2d2;
            border-top:none;
        }
        div.login_form
        {
            color:#fff;
            padding:15px;
            position:relative;
            border-radius:5px;
        }
        div.login_form p
        {
            overflow:hidden;
            margin-bottom:10px;
            position:relative;
        }
        div.login_form label
        {
            width:100px;
            float:left;
            font-weight:bold;
            margin-top:5px;
            color:#000;
        }
        div.login_form input[type="text"],div.login_form input[type="password"]
        {
            border:1px solid #d2d2d2;
            padding:5px 6px;
            width:200px;
        }
        div.login_form input[type="submit"]
        {
            background:#a80000;
            color:#fff;
            border:1px solid #a80000;
            padding:5px 8px;
            cursor:pointer;
            border-radius:5px;
        }
        div.login_form input[type="submit"]:active
        {
            background:#8a0000;
        }
        div.login_icon
        {
            position:absolute;
            right:8px;
            top:10px;
        }
        span.cookie
        {
            margin-left:5px;
            position:absolute;
            right:175px;
            top:0px;
        }
        span.login_msg
        {
            position:absolute;
            left:0px;
            top:-21px;
            display:none;
           
        }
        span.login_msg img
        {
            margin-bottom:-3px;
        }
    </style>
</head>

<body>
<div id="wrapper">
    <div id="columns">
    	<?php $this->load->view($layout); ?>
    </div>
    
</div>
</body>
</html>

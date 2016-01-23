<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo $settings['ico_url']; ?>" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="content-language" content="vi" />
<title><?php echo $settings['webtitle']; ?></title>
<meta name="keywords" content="<?php echo $settings['keywords']; ?>" />
<meta name="description" content="<?php echo $settings['desc']; ?>" />
<meta name='revisit-after' content='1 days' />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/style.css"); ?>" />
</head>

<body id="body" onload="equalHeight();">
<div id="wrapper">
	<div id="header">
		<a class="logo">
			<img src="<?php echo $settings['file_url']; ?>" alt="<?php echo $settings['file_url']; ?>" />
		</a>
		<?php $this->load->view('users/top_menu'); ?>
	</div><!--  End #header -->
	<?php $this->load->view('users/slide'); ?>
	<div id="main">
		<div id="left-col">
			<?php $this->load->view('users/side_bar'); ?>
		</div><!-- End #left-col -->
		<div id="right-col">
			<?php $this->load->view($pages); ?>
		</div><!-- End #right-col -->
	</div><!-- End #main -->
	<div id="footer">
		<ul id="bot-nav">
			<li>
				<a href="#">Giới thiệu</a>
				<ul>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Giới thiệu</a>
				<ul>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Giới thiệu</a>
				<ul>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Giới thiệu</a>
				<ul>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Giới thiệu</a>
				<ul>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Giới thiệu</a>
				<ul>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
				</ul>
			</li>
			<li class="no-border">
				<a href="#">Giới thiệu</a>
				<ul>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
					<li>
						<a href="#">Level 1</a>
					</li>
				</ul>
			</li>
		</ul>
	</div><!-- End #footer -->
</div><!-- End #wrapper -->
<p class="copyright">Copyright &copy; 2016</p>
</body>
</html>

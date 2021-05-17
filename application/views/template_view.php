<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>WM Главная</title>
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
		<script src="/js/jquery-1.6.2.js" type="text/javascript"></script>
        <script src="/js/script.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo" onclick="return location.href = '/'">
				<p>Helperi’o</p>
				</div>
				<div id="menu">
					<ul>
						<li><a href="/">Салаааам</a></li>
						<li><a href="/guest/page/1">Гостевая</a></li>
					</ul>
					<br class="clearfix" />
				</div>
				<div id="profile">
					<p>Poogiloy</p>
					<a href="#">Выход</a>
				</div>
			</div>
			<div id="page"> 
                
				<div id="content">
					<div class="box">
						<?php include 'application/views/'.$content_view; ?>
					</div>
					<br class="clearfix" />
				</div>
				<br class="clearfix" />
			</div>
			
		</div>
	</body>
</html>
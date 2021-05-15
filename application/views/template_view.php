<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>WM Главная</title>
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
		<script src="/js/jquery-1.6.2.js" type="text/javascript"></script>
        <script src="/js/script.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo" onclick="return location.href = '/'">
				</div>
				<div id="menu">
					<ul>
						<li><a href="/">Главная</a></li>
						<li><a href="/forum/page/1">Форум</a></li>
						<?php 
							if (isset($_SESSION['id_role']) && ($_SESSION['id_role'] == 1)) {
								echo '<li><a href="/user/aboba/1">Админка</a></li>';
							}
							if (empty($_SESSION['login'])) { 
								echo '<li><a href="/user/register">Регистрация</a></li>';
								echo '<li><a href="/user/login">Логин</a></li>';
						}
						//var_dump($_SESSION);
						?>
						<?php if (!empty($_SESSION['login'])) { 
							echo '<li><a href="/user/profile">' . $_SESSION['login'] . '</a></li>';
							echo '<li><a href="/user/leave">Выход</a></li>';
						}
						?>
					</ul>
					<br class="clearfix" />
				</div>
			</div>
			<div id="page">
				<div id="sidebar">
					<div class="side-box">	
						<h3>Основное меню</h3>
						<ul class="list">
							<li><a href="/">Главная</a></li>
							<li><a href="/forum/page/1">Форум</a></li>
							<?php if (empty($_SESSION['login'])) { 
							echo '<li><a href="/user/register">Регистрация</a></li>';
							echo '<li><a href="/user/login">Логин</a></li>';
						}
						?>
						</ul>
					</div>
				</div>
                
				<div id="content">
					<div class="box">
						<?php include 'application/views/'.$content_view; ?>
					</div>
					<br class="clearfix" />
				</div>
				<br class="clearfix" />
			</div>
			
		</div>
		<div id="footer">
			<a href="/">WM Тест</a></a>
		</div>
	</body>
</html>
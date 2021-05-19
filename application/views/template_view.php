<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>WM Главная</title>
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<style>	
			* {
				
				margin: 0;
				padding: 0;
			}

			a {
				text-decoration: underline;
				color: #353535;
			}

			a:hover {
				text-decoration: none;
			}

			body {
				line-height: 1.75em;
				overflow: hidden;

			}

			body,input {
				font-family: Kreon, serif;
			}

			br.clearfix {
				clear: both;
			}

			h1,h2,h3,h4 {
				text-transform: uppercase;
				font-weight: normal;
				color: #353535;
				margin-bottom: 1em;
			}

			h1 {
				font-size: 1.75em;
			}

			h2  {
				font-size: 1.5em;
			}

			h3 {
				font-size: 1.25em;
			}

			h4 {
				font-size: 1em;
			}
			p {
				margin-bottom: 1.5em;
			}

			ul {
				margin-bottom: 1.5em;
			}

			ul h4 {
				margin-bottom: 0.35em;
			}

			a {
				color: #353535;
			}

			#content {
				padding: 0 0 0 10px;
				width: 615px;
				margin: 0 0 0 285px;
			}

			#header{

				background-color: #598FFC;
				height: 130px;
				position: relative;
				display: flex;
				align-items: center;
				justify-content: space-between;
			}
			#header p {
				margin: 0%;
			}

			#logo {
				width: 330px;
				margin-left: 120px;
				font-family: Roboto;
				font-style: normal;
				font-weight: bold;
				font-size: 74px;
				line-height: 87px;
				color: #FFF;
				cursor: pointer;
			}
			#profile{
				width: 286px;
				margin-right: 120px;
				display: flex;
				justify-content: center;
				flex-direction: column;
				align-items: flex-end;
			}
			#profile p{
				color: #FFF;
				font-size: 1.7em;
				font-family: Roboto;
				font-weight: bold;
			}
			#profile a{
				color: #FFF;
				font-size: 1em;
				font-family: Roboto;
			}
			a{
				color: #FFF;
				text-decoration: none;
			}
			a:hover{
				text-decoration: underline;
			}

			#menu {
				line-height: 57px;
				height: 57px;
				font-family: "Roboto", sans-serif;
			}

			#menu a {
				color: #fff;
				text-decoration: none;
				font-size: 1.7em;
			}

			#menu a:hover {
				text-decoration: underline;
			}

			#menu ul {
				padding: 0 20px 0 20px;
				list-style: none;
			}

			#menu ul li {
				display: inline;
				padding: 10px 10px 10px 10px;
				margin: 0 8px 0 8px;
			}

			#page {

				margin: 0;
				height: calc(100vh - 130px);

			}


			#sidebar ul {
				list-style: none;
			}

			#sidebar ul li {
				border-top: solid 1px #e3e3e3;
				padding: 10px 0 10px 0;
			}
			#sidebar, .message, #new_message{
				position: relative;
				left: -20px;
				top: -20px;
				float: left;
				width: 240px;
				background: #f3f3f3;
				padding: 20px;
				border: solid 1px #e3e3e3;
				margin: 0 10px 0 0;
			}

			.message, #new_message{
				width: 600px;
				margin-bottom: 20px;
			}
			.message .name{
				float: left;
				font-size: 1.5em;
			}
			.message .date{
				float: right;
			}
			.message .title_mess{
				float: left;
				width: 100%;
				border-bottom: solid 1px #e3e3e3;
				font-size: 1em;
			}
			.message .file_mess img{
				float: left;
				max-width: 150px;
				max-height: 150px;
				margin: 3px;
			}

			#wrapper {
				width: 100%;
				position: relative;
				background: #FFF;
				margin: 0 auto 0 auto;
				border: solid 1px #f3f3f3;
				border-top: 0;
			}
			#new_name, #new_text, #new_file, #new_sub{
				float:left;
				width: 575px;
				padding: 5px;
				margin: 5px;
			}
			#new_name{
				font-size: 1.1em;
			}
			#new_text{
				height: 150px;
			}
			#new_file{
				width: 250px;
			}
			.navigation{
				text-align: center;
				font-size: 1.3em;
			}
			.navigation a{
				padding: 0px 5px 0px 5px;
			}
			.navigation a:hover{
				text-decoration: none;
			}
			.navigation a.active_page{
				font-size: 1.5em;
				text-decoration: none;
				font-weight: bold;
			}
			.login_page{
				display: flex;
			}

		</style>
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
						<?php
						//var_dump($_SESSION);
						if ($_SESSION['id_role'] == '1') { //админ
							echo '<li><a href="/">Главная</a></li>';
							echo '<li><a href="/admin/tickets">Тикеты</a></li>';
							echo '<li><a href="/admin/users">Пользователи</a></li>';
							echo '<li><a href="/user/profile">Профиль</a></li>';
						}

						if ($_SESSION['id_role'] == '2') { //сотрудник
							echo '<li><a href="/">Главная</a></li>';
							echo '<li><a href="/ticket/browse">Список тикетов</a></li>';
							echo '<li><a href="/user/profile">Профиль</a></li>';
						}

						if ($_SESSION['id_role'] == '3') { //пользователь
							echo '<li><a href="/">Главная</a></li>';
							echo '<li><a href="/ticket/create">Создать тикет</a></li>';
							echo '<li><a href="/ticket/browse">Список тикетов</a></li>';
							echo '<li><a href="/user/profile">Профиль</a></li>';
						}
						//<li><a href="/">Главная</a></li>
						//<li><a href="/guest/page/1">Гостевая</a></li>
						?>
					</ul>
					<br class="clearfix" />
				</div>
				<div id="profile">
					<p><?php echo $_SESSION['login']; ?></p>
					<a href="/user/leave">Выход</a>
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
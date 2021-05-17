<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
<style>
.login_page{
	position:absolute;
	left:50%;
	top:50%;
	margin-right: -50%;
	transform:translate(-50%, -50%);
	display: flex;
    flex-direction: column;
    align-items: center;
	box-shadow: 0px 1px 54px rgba(0, 0, 0, 0.15);
	width: 600px;
	height: 600px;
}
.input{
	margin-bottom:40px;
	width: 389px;
	height: 57px;
	background: rgba(239, 238, 238, 0.4);
	border-radius: 7px;
	border: none;
	text-align: center;
	
}
button{
	width: 197px;
	height: 57px;
	border-radius: 7px;
	border: none;
	background-color:#598FFC;
	color: white;
	font-family: Roboto;
	font-style: normal;
	font-weight: bold;
	font-size: 25px;
	line-height: 29px;
}
.plane{
	background-color:#598FFC;
	width: 600px;
	height: 130px;
	text-align: center;
	color: white;
	display: flex;
    align-items: center;
    justify-content: center;
	font-family: Roboto;
	font-style: normal;
	font-weight: bold;
	font-size: 42px;
	line-height: 49px;
}

a{
	color: rgba(37, 50, 84, 0.7);
	padding-top: 15px;
	font-family: Roboto;
	font-style: normal;
	font-weight: normal;
	font-size: 14px;
	line-height: 16px;	
}
</style>
<form action="/user/loginAction" method="post" class="login_page">
	<div class="login_page">
		<div class="plane">
			Авторизация
		</div>
		<input class="input" name="login" placeholder="Введите логин" style="margin-top:73px;" autocomplete="off">
		<input class="input" name="password" placeholder="Введите пароль" autocomplete="off">
		<button type="submit">Войти</button>
		<a href="/user/register">Регистрация</a>
	</div>
</form>
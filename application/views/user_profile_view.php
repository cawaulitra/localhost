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
.name{
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 25px;
    line-height: 29px;

    color: rgba(37, 50, 84, 0.7);
}
.data{
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 30px;
    line-height: 35px;

    color: #253254;
}
.text{
    display: flex;
    flex-direction: row;
    align-items: baseline;

}
.text2{
    display: flex;
    flex-direction: row;
    align-items: baseline;

}
.content{
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>
<form action="/user/registerAction" method="post" class="login_page">
	<div class="login_page">
		<div class="plane">
			Профиль
		</div>
        <span class="content">
            <div class="text">
                <p class="name">Логин</p>
                <p class="data"><?php echo $_SESSION['login']?></p>
                <a>Изменить</a>
            </div>
            <div class="text2">
                <p class="name">ФИО</p>
                <p class="data"><?php echo $_SESSION['name']?></p>
                <a>Изменить</a>
            </div>
            <a class="password">Изменить пароль</a>
        </span>
	</div>
</form>
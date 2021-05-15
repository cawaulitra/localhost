<style>
    input, select, textarea, form li {
        font-size: 16px;
		list-style: none;
		width: 300px;
    }
	
	textarea {
		height: 150px; 
		resize: none;
	}
	
	p {
		font-size: 32px;
		font-weight: 900;
	}
</style>
<script>
	function check() {
		var login = document.getElementById('login').value;
		var password = document.getElementById('password').value;
		var password_confirm = document.getElementById('password_confirm').value;
		var email = document.getElementById('email').value;
        if (((login.length) > 0) && (password.length > 0) && (password_confirm.length > 0) && (email.length > 0))
		{ 
            document.getElementById('submit').disabled = false;
        } 
		else 
		{ 
            document.getElementById('submit').disabled = true;
        }
    }
	
	function verify() {
		var login = document.getElementById('login').value;
		var password = document.getElementById('password').value;
		var password_confirm = document.getElementById('password_confirm').value;
		var email = document.getElementById('email').value;
        if (((login.length) > 0) || (password.length > 0) || (password_confirm.length > 0) || (email.length > 0))
		{ 
            alert ("Ваша форма обрабатывается.");
        }
		
		else {
			alert ("Заполните все отмеченные поля и попробуйте ещё раз.");
		}
    }
</script>
<p>Регистрация</p>
<?php 	
	if (!empty($_POST)) {
		if ($_POST['error'][0] != "Регистрация успешна!") {
			echo "Произошли технические шоколадки.</br>";
			foreach ($_POST['error'] as $err) {
				echo "$err </br>";
			}
		}
		else {
			echo $_POST['error'][0];
		}
	}
	//var_dump ($data);
?>
<form action="/user/RegisterSuccess" method="post">
	<ul>
		<li>
			<input name="login" type="text" placeholder="Логин*" oninput="check()" id="login">
		</li>
		<li>
			<input name="password" type="password" placeholder="Пароль*" oninput="check()" id="password">
		</li>
		<li>
			<input name="password_confirm" type="password" placeholder="Повторите пароль*" oninput="check()" id="password_confirm">
		</li>
		<li>
			<input name="email" type="text" placeholder="E-Mail*" oninput="check()" id="email">
		</li>
		<li>
			<button type="submit" id="submit" onclick="verify()" disabled>Отправить</button>
		</li>
	</ul>
</form>
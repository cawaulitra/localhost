<?php
	session_start();
	//var_dump ($_POST);
	//if (empty($_POST['success']));
?>
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
        if (((login.length) > 0) && (password.length > 0))
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
        if (((login.length) > 0) || (password.length > 0))
		{ 
            alert ("Ваша форма обрабатывается.");
        }
		
		else {
			alert ("Заполните все отмеченные поля и попробуйте ещё раз.");
		}
    }
</script>
<p>Логин</p>
<form action="/user/LoginTry" method="post">
	<ul>
		<li>
			<input name="login" type="text" placeholder="Логин*" oninput="check()" id="login">
		</li>
		<li>
			<input name="password" type="password" placeholder="Пароль*" oninput="check()" id="password">
		</li>
		<li>
			<button type="submit" id="submit" onclick="verify()" disabled>Отправить</button>
		</li>
	</ul>
</form>
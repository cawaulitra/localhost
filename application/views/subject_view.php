<style>
	.comment {
		border: 2px solid gray;
		border-radius: 20px;
		padding: 8px;
		margin-bottom: 10px;
        min-height: 150px;
	}	

	.comment a {
		text-decoration: none;
	}

    .comment-action {
        margin-top: 50px;
    }

    .comment-action textarea {
        width: 540px;
        height: 260px;
        resize: none;
        padding: 10px;
        border-radius: 5px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .comment-action li {
        list-style-type: none;
    }   
</style>
<pre>
    <?php 	
	//var_dump ($_SESSION);
	//var_dump ($data['comment-allow']);
	//echo ($data[0]['id_subject']); 
	//var_dump ($data);
	//var_dump ($data['files']);
	//echo date("Y-m-d H:i:s");
	?>
</pre>
<?php
	if (isset($_SESSION['success-subject-activate'])) {
		if ($_SESSION['success-subject-activate'] == TRUE) {
			echo "Приватность темы изменена.";
			unset($_SESSION['success-subject-activate']);
		}
		else {
			echo "Приватность темы НЕ ИЗМЕНЕНА.";
			unset($_SESSION['success-subject-activate']);
		}
	}

	if ($_SESSION['id_role'] == 1) {
		echo 
		"<form action='/forum/activate/". $data[0]['id_subject'] ."' method='post'>
		<input type='text' name='id_subject' readonly hidden value="; echo ($data[0]['id_subject']); echo">
			<input type='checkbox' name='activate' id='activate'"; 	
				if (isset($data['subject-active'])) {
					if (($data['subject-active']) == 1) {
						echo "checked";
						}
					} 		
				echo "> Включить тему?<br>
			<input type='submit' name='sub' value='Изменить'>
		</form>";
	}
?>

<h1>Тема</h1>
<?php
	if (isset($_SESSION['success_comment'])) {
        if ($_SESSION['success_comment'] == TRUE) {
            echo "<br><br><h3>Комментарий добавлен!</h3>";
            unset($_SESSION['success_comment']);
        }

        else {
            echo "Что-то пошло не так.<br>";
            unset($_SESSION['success_comment']);
        }
    }
	if (isset($_SESSION['success_file'])) {
        if ($_SESSION['success_file'] == TRUE) {
            echo "<h3>Файл добавлен!</h3><br><br>";
            unset($_SESSION['success_file']);
        }

        else {
            echo "Файл не добавлен.<br>";
            unset($_SESSION['success_file']);
        }
    }
	if (isset($data['subject-active'])) {
		if (($data['subject-active']) == 1) {
			echo "Тема открыта.";
		}
		else echo "Тема закрыта.";
	}
?>
<div class = 'container'>
<?php
	if (isset($data['comments'])) {
		foreach ($data['comments'] as $comments) {
			echo "
					<div class = 'row comment'>
						<div class = 'col-3 ab'>
							<div class = 'col-sm'>Автор:                    </div>
							<div class = 'col-sm'>" . $comments['login'] .  "</div>
							<div class = 'col-sm'>Дата:                     </div>
							<div class = 'col-sm'>" . $comments['date'] .   "</div>
						</div>
						<div class = 'col-9'>
							<div class = 'col-sm comment-text'><p>" . $comments['text'] . "</div>";
						if (isset ($data['files'])) {
							foreach ($data['files'] as $file) {
								if ($comments['id'] == $file['comment_id']) echo "<div class = 'col-sm comment-text'><p><a href='/file/download/". $file['file_id'] ."'>" . $file['link'] . "</a></div>";
							}
						}
					echo "</div></div>";
		}
	}
	else echo "<div class = 'row'><p>Похоже, тут ничего нет. Хочешь быть первым?</div>";
?>
</div>
<?php
	if ((isset($data['comment-allow']) && isset($data['subject-active']) && isset($_SESSION['active'])) || $_SESSION['id_role'] == 1) {
		if (($data['comment-allow'] == TRUE && $data['subject-active'] == TRUE && $_SESSION['active'] == TRUE) || $_SESSION['id_role'] == 1) {
			echo "
			<div class='comment-action'>
				<form action='/forum/addComment' method='post' enctype='multipart/form-data'>
					<ul>
						<li>
							Ваше имя: "; echo $_SESSION['login']; echo "
						</li>
						<li>
							<textarea placeholder='Что думаешь по этому поводу?' name='textbox'></textarea>
						</li>
						<li>
							<input type='text' name='id_subject' readonly hidden value="; echo ($data[0]['id_subject']); echo">
						</li>
						<li>
							<input type='file' name='file[]' id='file' multiple>
						</li>
						<br>
						<li>
							<input type='submit' name='sub' value='Отправить'>
						</li>
					</ul>
				</form>
			</div>
			";
		}
	}
?>

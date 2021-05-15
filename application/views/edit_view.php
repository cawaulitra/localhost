<style>
    form > ul li {
        list-style: none;
        margin: 5px;
    }

    .text {
        width: 250px;
    }
</style>
<h1>Редактирование пользователя</h1>
<pre>
<?php //var_dump ($data); ?>
</pre>
<?php 
    if (isset($_SESSION['success'])) {
        if ($_SESSION['success'] == TRUE) {
            echo "Данные изменены!<br>";
            unset($_SESSION['success']);
        }

        else {
            echo "Что-то пошло не так.<br>";
            unset($_SESSION['success']);
        }
    }

    if (isset($_SESSION['password_fail'])) {
        echo "Пароль НЕ изменён.";
        unset($_SESSION['password_fail']);
    }
    echo "
        <form action='/user/editAttempt/".$data['id']."' method='post'>
            <ul>
                <li>
                    <input name='id' type='text' placeholder='id' id='id' value='". $data['id'] ."' hidden class='text'>
                </li>
                <li>
                    <input name='login' type='text' placeholder='Логин' id='login' value='". $data['login'] ."' class='text'>
                </li>
                <li>
                    <input name='email' type='text' placeholder='E-Mail' id='email' value='". $data['email'] ."' class='text'>
                </li>
                <li>
                    <input name='fio' type='text' placeholder='ФИО' id='fio' value='". $data['fio'] ."' class='text'>
                </li>
                <li>
                    <select name='id_role' id='id_role' class='text'>";
                    if ($data['id_role'] == 1) {
                        echo "<option selected='selected'>
                                Администратор
                            </option>";
                    }
                    else {
                        echo "<option>
                                Администратор
                            </option>";
                    }
                    if ($data['id_role'] == 2) {
                        echo "<option selected='selected'>
                                Автор
                            </option>";
                    }
                    else {
                        echo "<option>
                                Автор
                            </option>";
                    }
                    if ($data['id_role'] == 3) {
                        echo "<option selected='selected'>
                                Пользователь
                            </option>";
                    }
                    else {
                        echo "<option>
                                Пользователь
                            </option>";
                    }
                    echo "</select>
                </li>
                <li>
                    <input name='active' type='checkbox'"; if ($data['active?'] == 1) echo "checked";
                    echo "> Учётная запись активна?
                </li>
                <li>
                    <input name='password' type='password' placeholder='Новый пароль' id='password' class='text'>
                </li>
                <li>
                    <input name='password_confirm' type='password' placeholder='Повторите пароль' id='password_confirm' class='text'>
                </li>
                <br>
                <li>
                    <button type='submit' id='submit'>Изменить</button>
                </li>
            </ul>
        </form>
    ";
?>
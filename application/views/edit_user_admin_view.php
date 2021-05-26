<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
<style>
    .login_page{
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0px 1px 54px rgba(0, 0, 0, 0.15);
        width: 900px;
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
        width: 900px;
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

    .user_profile_content a{
        padding: 5px 20px;
        height: 27px;
        border-radius: 7px;
        border: none;
        background-color:#598FFC;
        color: white;
        padding-top: 15px;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 16px;
        cursor: pointer;
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
        margin-left: 30px;
        color: #253254;
    }
    .text, .text2, .text3 {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: baseline;
        justify-content: flex-start;
    }

    .user_profile_content{
        box-sizing: border-box;
        padding: 63px 55px 63px 55px;
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-content: space-between;
        justify-content: space-around;
        align-items: flex-start;
    }
    input{
        margin-left: 5%;
    }
    .user_profile_content p{
        margin-left: 15px;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 25px;
        line-height: 30px;
        color: #253254;
    }

    .types, .user, .new_type_ul {
        list-style-type: none;
    }

    .user_profile_content > .user > .user > li > *  {
        width: 200px;
    }

    .select {
        margin-left: 16px;
    }

    .types {
        width: 300px;
    }

    .overflow {
        background-color: #E6E6E6;
        height: 230px;
        overflow: auto;
    }

    .checkbox {
        margin-right: 5px;
    }

    .new_type {
        width: 100px;
        height: 30px;
        border-radius: 5px;
        border: none;
        background-color: #598FFC;
        color: white;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 17px;
        line-height: 20px;
        margin-left: 8px;
        margin-top: 10px;
    }

    .submit {
       margin-top: 20px;
       margin-left: 15px;
    }

    .new_type_ul {
        position: relative;
        left: 130px;
        bottom: 130px;
    }
</style>
<div class="login_page">
        <div class="plane">
        <form action="/admin/edit_userAction" method="post">
                Редактирование профиля
        </div>
        <?php 
            //var_dump($data['allowed_type']);
            /*if (isset($_SESSION['success'])) {
                if (isset($_SESSION['success']['new_type'])) {
                    if ($_SESSION['success']['new_type'] == true) {
                        echo "Новый тип вопроса создан!";
                    }
                    else echo "Что-то пошло не так.";
                }
                if (isset($_SESSION['success']['edit_user'])) {
                    if ($_SESSION['success']['edit_user'] == true) {
                        echo "Пользователь изменён!";
                    }
                    else echo "Что-то пошло не так.";
                }
                unset($_SESSION['success']);
            }*/
        ?>
        <div class="user_profile_content">
            <div class="user">
                    <?php
                        if(isset($data['user'])) {
                            echo "
                            <p>Параметры пользователя:</p>
                            <ul class='user'>  
                                <li><input name='id' placeholder='ID' value=". $data['user']['id'] ." hidden></input></li>
                                <li><input name='login' placeholder='Логин' value=". $data['user']['login'] ."></input></li>
                                <li><input name='name' placeholder='Имя' value=". $data['user']['name'] ."></input></li>
                                <li><input name='password' placeholder='Новый пароль'></input></li>
                                <li><input name='password_confrim' placeholder='Повторите пароль'></input></li>
                                <li>
                                    <select name='id_role' class='select'>";
                                    if ($data['user']['id_role'] == 3) {
                                        echo "<option selected='selected'>Пользователь</option>";
                                    }
                                    else echo "<option>Пользователь</option>";

                                    if ($data['user']['id_role'] == 2) {
                                        echo "<option selected='selected'>Сотрудник</option>";
                                    }
                                    else echo "<option>Сотрудник</option>";

                                    if ($data['user']['id_role'] == 1) {
                                        echo "<option selected='selected'>Администратор</option>";
                                    }
                                    else echo "<option>Администратор</option>";
                                    echo "
                                    </select>
                                </li>
                                <li><button class='submit' type='submit'>Изменить профиль</submit></li>
                                </ul>
                            </div>
                        ";
                        }
                    ?>
            <?php
                if (isset($data['user']['id_role'])) {
                    if ($data['user']['id_role'] == 2) {
                        echo "
                        <div class='overflow'>
                            <p>Разрешенные темы:</p>
                            <ul class='types'>";
                                foreach ($data['type'] as $type) {
                                    if(isset($data['allowed_type'])) {
                                        foreach ($data['allowed_type'] as $allowed_type) {
                                            if (!in_array($type['id'], $allowed_type)) {
                                                $find = 0;
                                            }
                                            else {
                                                $find = 1;
                                                break;
                                            }	
                                        }

                                        if ($find == 0) echo "<li><label><input name='type[". $type['id'] ."]' type='checkbox' class='checkbox'></input>". $type['name'] ."</label></li>";
                                        if ($find == 1) echo "<li><label><input name='type[". $type['id'] ."]' type='checkbox' class='checkbox' checked='checked'></input>". $type['name'] ."</label></li>";
                                    }
                                    else echo "<li><label><input name='type[". $type['id'] ."]' type='checkbox' class='checkbox'></input>". $type['name'] ."</label></li>";
                                    }
                                    echo "
                            </ul>
                        </div>
                        </form>
                    </div>
                    <form action='/admin/new_typeAction' method='post'>
                        <ul class='new_type_ul'>
                            <li><input name='type_name' placeholder='новая тема'></input></li>
                            <li><button class='new_type' type='submit'>Создать</button></li>
                        </ul>
                    </form>";   
                                }
                    }
        ?>
</div>

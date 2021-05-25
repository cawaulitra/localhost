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
        align-items: center;
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

    .types, .user {
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
    }

    .submit {
        margin-top: 50px;
    }
</style>
<div class="login_page">
    <form>
        <div class="plane">
                Редактирование профиля
        </div>
        <div class="user_profile_content">
            <div class="user">
                <p>Параметры пользователя:</p>
                <ul class="user">
                    <li><input placeholder="Новый логин"></input></li>
                    <li><input placeholder="Новое фио"></input></li>
                    <li><input placeholder="Новый пароль"></input></li>
                    <li><input placeholder="Повторите пароль"></input></li>
                    <li>
                        <select class="select">
                            <option>Пользователь</option>
                            <option>Сотрудник</option>
                            <option>Администратор</option>
                        </select>
                    </li>
                </ul>
            </div>
            <div class="overflow">
                <p>Разрешенные темы:</p>
                <input placeholder="новая тема"></input>
                <button class="new_type">Создать</button>
                <ul class="types">
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                    <li><label><input type="checkbox" class="checkbox"></input>Биология</label></li>
                </ul>
            </div>
            <button class="submit">Изменить профиль</submit>
        </div>
    </form>
</div>

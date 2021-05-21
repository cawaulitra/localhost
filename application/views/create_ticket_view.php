<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
<style>
.content-create{
    display: flex;
    flex-direction: column;
    align-content: center;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0px 1px 49px rgba(0, 0, 0, 0.14);
    width: 800px;
    padding: 50px;
}
.text{
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 50px;
    line-height: 59px;

    /* identical to box height */

    color: #070651;

}
.plane{
    display: flex;
    flex-wrap: nowrap;
    align-items: baseline;
    justify-content: space-between;
    padding: 0 50px;
}
.create_form{
    margin: 40px;
    display: flex;
    padding-left: 50px;
}
.radio{
    display: flex;
    flex-direction: column;
}
.main-opis{
    display: flex;
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 25px;
    line-height: 29px;
    color: #070651;
    flex-direction: column;
    flex-wrap: wrap;
}
.radio{
    padding-left: 50px;
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 25px;
    line-height: 29px;

    color: #070651;
}
textarea{
    resize: none;
    height: 70px;
}
button{
    background: #598FFC;
    border-radius: 7px;
    width: 287px;
    height: 57px;
    border: none;
    margin-top: 50px;
    color: white;
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 25px;
    line-height: 29px;
}
</style>
<?php //var_dump ($data); ?>
<div class="content-create">
    <div class="plane">
        <p class="text">Создание тикета</p>
    </div>
    <?php 
    if (isset($_SESSION['success'])) {
        if ($_SESSION['success'] == true) {
            echo "Тикет успешно создан! <br>";
        }
        else {
            echo "Что-то пошло не так. <br>";
            foreach ($_SESSION['message'] as $msg) echo $msg; 
        }
    }
    
    unset($_SESSION['success']);
    unset($_SESSION['message']);
    ?>
    <div class="create_form">
        <div class="main-opis">
            <form class="main-opis" method="post" action="/ticket/createAction">
            <p>Название: </p>
            <input id="title" name="title">
            <p>Описание:</p>
            <textarea cols="25" id="text" name="text"></textarea>
            <p:>Дополнительно</p>
            <input type="file">
            <br>
            <button type="submit">Создать</button>
        </div>
            <div class="radio">
                <p>Тип вопроса</p>
                <select id="id_type" name="id_type">
                    <option>---</option>
                    <?php 
                        if (isset($data)) {
                            foreach ($data['ticket_types'] as $type) {
                                echo "<option>" . $type['name'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </form>
    </div>
</div>
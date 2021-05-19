<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
<style>
.content-create{
    display: flex;
    flex-direction: column;
    align-content: center;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0px 1px 49px rgba(0, 0, 0, 0.14);
    width: 600px;
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

</style>
<div class="content-create">
    <div class="plane">
        <p class="text">Создание тикета</p>
    </div>
    <div class="create_form">
        <div class="main-opis">
            <p>Название:</p>
            <input>
            <p>Описание:</p>
            <textarea></textarea>
            <p:>Дополнительно</p>
            <input type="file">
        </div>
        <div class="radio">
            <p>Тип вопроса</p>
            <select>
                <option>dwadwadfwaf</option>
                <option>dwadwadfwaf</option>
                <option>dwadwadfwaf</option>
                <option>dwadwadfwaf</option>
                <option>dwadwadfwaf</option>
                <option>dwadwadfwaf</option>
            </select>
        </div>
    </div>
</div>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
<style>
span{
    display: flex;
    flex-direction: row;
    align-content: stretch;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: baseline;

}
.main-content{
    display: flex;
    flex-direction: row;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0px 1px 49px rgba(0, 0, 0, 0.04);
    padding: 70px;
}
.info{
    display: flex;
    flex-direction: column;
}
.chat-all{
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    padding-left: 150px;
}
span h2{
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 25px;
    line-height: 29px;

    color: #070651;

}
span p{
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 20px;
    line-height: 23px;

    color: #070651;
}
span h1{
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 45px;
    line-height: 50px;
    /* identical to box height */


    color: #070651;
}
.chat{
    width: 275px;
    height: 400px;
    background: #FFFFFF;
    box-shadow: inset 0px 1px 26px rgba(0, 0, 0, 0.03);
}
.text{
    word-wrap: break-word;
    width: 350px;
}
</style>
<div class="main-content">
    <div class="info">
        <span><h1>ID 123</h1><h2 style="    padding-left: 20px;">Название тикета</h2></span>
        <span><p class="text">afwfwifwjauifuwaifiuwafiuwauifuiawjfoiwajioufjuwiafuighuiseahguiheugheuhgueguehugeughuehugeugeughuafafwfwifwjauifuwaifiuwafiuwauifuiawjfoiwajioufjuwiafuighuiseahguiheugheuhgueguehugeughuehugeugeughuafafwfwifwjauifuwaifiuwafiuwauifuiawjfoiwajioufjuwiafuighuiseahguiheugheuhgueguehugeughuehugeugeughuaf</p></span>
        <span class="images-info"></span>
        <span class="creator-info"><h2>Автор: </h2><p>Автор Папа Дядя Паша</p></span>
        <span class="worker-info"><h2>Сотрудник: </h2><p>Сотрудник Андрей</p></span>
    </div>
    <div class="chat-all">
        <span class="status"><!--Статус-->Ожидание</span>
        <span class="chat"></span>
        <span ><input></span>
        <span><button>Отправить</button></span>
    </div>
</div>
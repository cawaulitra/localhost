<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
<style>
.content-ticket{
    display: flex;
    flex-direction: column;
    align-content: center;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0px 1px 49px rgba(0, 0, 0, 0.14);
    width: 1294px;
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
.a{
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 20px;
    line-height: 23px;
    text-decoration-line: underline;

    color: #070651;
}
.ticket{
    padding: 0 25px;
}
table{
    table-layout: fixed;
    width:100%
}
td{
    word-wrap:break-word;
}
</style>
<div class="content-ticket">
    <div class="plane">
    <p class="text">Список тикетов</p>
    <input name="search" placeholder="Введите название...">
    </div>
    <div class="ticket">
        <table cellspacing="30px" width="1294px">
        <tr>
            <td valign="middle" width="80px"><p><?php echo "52" ?></p></td>
            <td valign="middle" width="650px"><p><?php echo "Titlewdcket" ?></p><td>
            <td valign="middle" width="100px"><p><?php echo "Ожидание" ?></p></td>
            <td valign="middle" width="100px"><p><a class="edit">Редактировать</a></p></td>
            <td valign="middle" width="100px"><p><a class="delete">Удалить</a></p></td>
        </tr>
        </table>
        <!--<Пагинация>-->
    </div>

    

</div>
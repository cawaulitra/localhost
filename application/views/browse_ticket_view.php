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
    max-height: 600px;
    overflow-y: scroll;
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
.content-ticket a{
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
.content-ticket table{
    table-layout: fixed;
    width:100%
}
.content-ticket td{
    word-wrap:break-word;
}

.status_1 {
    color: #B7B7B7;
}

.status_2 {
    color: #F6C972;
}

.status_3 {
    color: #33AD64;
}

.status_1, .status_2, .status_3 {
    font-weight: bold;
    font-size: 20px;
}
</style>
<div class="content-ticket">
    <div class="plane">
    <p class="text">Список тикетов</p>
    <input name="search" placeholder="Введите название..."> <!-- тут будет поиск аджакс с заполнением тега <table></table> -->
    </div>
    <div class="ticket">
        <table cellspacing="30px" width="1294px">
        <tr>
            <td width="80px"><?php echo "52" ?></td>
            <td width="500px"><?php echo "Titlewdcket" ?></td>
            <td width="120px" class="status_3"><?php echo "Выполнен" ?></td>
        </tr>
        <tr>
            <td width="80px"><?php echo "52" ?></td>
            <td width="500px"><?php echo "Titlewdcket" ?></td>
            <td width="120px" class="status_2"><?php echo "В процессе" ?></td>
        </tr>
        <tr>
            <td width="80px"><?php echo "52" ?></td>
            <td width="500px"><?php echo "Titlewdcket" ?></td>
            <td width="120px" class="status_1"><?php echo "Ожидание" ?></td>
        </tr>
        </table>
        <!--<Пагинация>-->
    </div>
</div>
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
#curr {
    color: red;
}

#diff {
    color: #598FFC;
}

</style>
<div class="content-ticket">
    <div class="plane">
    <p class="text">Список тикетов</p>
    </div>
    <div class="ticket">
        <div class="pagination">
            <?php
                //var_dump($data);
                for ($i = 1; $i <= $data[0]; $i++)
                {
                    if ($i != $data[1]) {
                        echo "<a href='/ticket/browse/$i' id='diff'>$i</a>"; //неактивная
                    }
                    else {
                        echo "<a href='/ticket/browse/$i' id='curr'>$i</a>"; //активная
                    }
                }
            ?>
        </div>
        <table cellspacing="30px" width="1294px">
            <?php
                if (isset($data['tickets'])) {
                    foreach ($data['tickets'] as $ticket) {
                            echo "<tr>";
                            echo "<td width='80px'>". $ticket['id'] ."</td>";
                            echo "<td width='500px'><a href='/ticket/view/". $ticket['id'] ."'>". $ticket['title'] ."</a></td>";
                            if ($ticket['id_status'] == 1) {
                                echo "<td width='120px' class='status_1'>Ожидание</td>";
                            }
                            elseif ($ticket['id_status'] == 2) {
                                echo "<td width='120px' class='status_2'>В процессе</td>";
                            }
                            elseif ($ticket['id_status'] == 3) {
                                echo "<td width='120px' class='status_3'>Выполнен</td>";
                            }
                            else {
                                echo "<td width='120px'>---</td>";
                            }
                            echo "</tr>";
                        }
                    }
                else echo "Список пуст.";
            ?>
        </table>
        <!--<Пагинация>-->
    </div>
</div>
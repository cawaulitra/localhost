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

#curr {
    color: red;
}

#diff {
    color: #598FFC;
}

</style>
<div class="content-ticket">
    <div class="plane">
    <p class="text">Список пользователь</p>
    </div>
    <div class="ticket">
        <table cellspacing="30px" width="1294px">
            <?php
                foreach ($data['users'] as $user) {
                    echo "<tr>";
                    echo "<td width='50px'>" . $user['id'] . "</td>";
                    echo "<td width='200px'><a href='/admin/view_user/". $user['id'] ."'>" . $user['login'] . "</a></td>";
                    echo "<td width='200px'>" . $user['name'] . "</td>";

                    if ($user['id_role'] == 1) { //админ
                        echo "<td width='100px'>Администратор</td>";
                        echo "<td width='120px'><a href='/admin/edit_user/". $user['id'] ."'>Редактировать</a></td>";
                        echo "<td width='100px'></td>";
                    }
                    if ($user['id_role'] == 2) { //сотрудник
                        echo "<td width='100px'>Сотрудник</td>";
                        echo "<td width='120px'><a href='/admin/edit_user/". $user['id'] ."'>Редактировать</a></td>";
                        echo "<td width='100px'><a href='/admin/statistics/". $user['id'] ."'>Статистика</a></td>";
                    }

                    if ($user['id_role'] == 3) { //юзверь
                        echo "<td width='100px'>Пользователь</td>";
                        echo "<td width='120px'><a href='/admin/edit_user/". $user['id'] ."'>Редактировать</a></td>";
                        echo "<td width='100px'></td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
        <div class="pagination">
            <?php
                for ($i = 1; $i <= $data[0]; $i++)
                {
                    if ($i != $data[1]) {
                        echo "<a href='/admin/users/$i' id='diff'>$i</a>"; //неактивная
                    }
                    else {
                        echo "<a href='/admin/users/$i' id='curr'>$i</a>"; //активная
                    }
                }
            ?>
        </div>
    </div>
</div>
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
        <?php
        //var_dump ($data);
            if (isset($data)) {
                if (isset($data['success'])) {
                    echo "У вас нет прав для просмотра этого тикета.";
                }
                else {
                    echo "<span><h1>". $data['ticket']['id'] ."</h1><h2 style='padding-left: 20px;'>". $data['ticket']['title'] ."</h2></span>";
                    echo "<span><p class='text'>". $data['ticket']['text'] ."</p></span>";
                    echo "<span class='images-info'></span>";
                    echo "<span class='creator-info'><h2>Автор: </h2><p>". $data['ticket']['author'] ."</p></span>";
                    echo "<span class='worker-info'><h2>Сотрудник: </h2><p>". $data['ticket']['employee'] ."</p></span>";
                }
            }
        ?>
    </div>
    <div class="chat-all">
        <?php
            if (isset($data)) {
                if (isset($data['success'])) {
                    echo "";
                }
                else {
                    echo 
                    "<span class='status'><!--Статус-->Ожидание</span>
                    <form action='/ticket/chat' id='chat_form' method='post'>
                    <div class='chat'>";
                        for($i = 0; $i < count($data['messages']); $i++){
                            echo($data['messages'][$i]."<br />");
                        }
                    echo "</div>";
                    echo "<input id='post_id' type='hidden' name='message_id' value='".$data['id'][count($data['id']) - 1]."' />";
                    echo "<input type='text' name='text' />
                    <input type='submit' value='Отправить'>
                </form>
                <!-- <span ><input></span>
                <span><button>Отправить</button></span> -->
                    ";
                }
            }
        ?>
    </div>
</div>
<script>
    let server_id = 0;
    let post_input = document.getElementById('post_id');
    let post_id = post_input.value;
    const req = () => {
        $.ajax({
            url: '/ticket/timer',
            type: 'GET',
            success: (res) => {
                server_id = res;
            }
        });
        server_id = Number(server_id);
        post_id = Number(post_id);
    }
    req();
    let form = document.getElementById('chat_form');
    let timerId = setTimeout(function tick() {
        req();
        console.log(server_id);
        console.log(post_id);
        if (server_id === post_id) location.reload();
        timerId = setTimeout(tick, 2000);
    }, 2000);
</script>
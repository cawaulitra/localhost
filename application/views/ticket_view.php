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
.message_container{
    overflow-y: scroll;
    border: 1px solid grey;
    border-radius: 5px;
    padding: 5px;
    width: 30vw;
    max-height: 500px;
    display: flex;
    flex-direction: column;
}
.send_block{
    margin: 10px 0 0 0;
    display: flex;
    align-items: center;
}
.inp_text{
    margin: 0 10px 0 0;
    width: calc(30vw - 50px);
    height: 60px;
    resize: none;
}
.chat_submit_btn{
    width: 50px;
}
.message_is_their{
    max-width: 60%;
    min-width: 30%;
    margin: 5px;
    padding-right: 5px;
    padding-left: 5px;
    background-color: rgba(50, 50, 50, 0.35);
    border: 1px solid grey;
    border-radius: 5px;
    text-align: left;
    align-self: flex-start;
}
.message_is_my{
    max-width: 60%;
    min-width: 30%;
    margin: 5px;
    padding-right: 5px;
    padding-left: 5px;
    background-color: rgba(50, 50, 50, 0.35);
    border: 1px solid grey;
    border-radius: 5px;
    text-align: right;
    align-self: flex-end;
}
.text{
    word-wrap: break-word;
    width: 350px;
}
button a{
    text-decoration: none;
    color: rgba(50, 50, 50, 0.35);
    height: 60px;
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
                    //var_dump($data);
                    echo "<span><h1>". $data['ticket']['id'] ."</h1><h2 style='padding-left: 20px;'>". $data['ticket']['title'] ."</h2></span>";
                    echo "<span><p class='type'>Тема: ". $data['ticket']['name'] ."</p></span>";
                    echo "<span><p class='text'>". $data['ticket']['text'] ."</p></span>";
                    echo "<span class='images-info'></span>";
                    echo "<span class='creator-info'><h2>Автор: </h2><p>". $data['ticket']['author'] ."</p></span>";
                    echo "<span class='worker-info'><h2>Сотрудник: </h2><p>". $data['ticket']['employee'] ."</p></span>";
                }
            }
        ?>
        <button type="submit"><a href="model/close_ticket/<?php echo $data['ticket']['id'];?>">Закрыть тикет</a></button>
    </div>
    <div class="chat-all">
        <p><?php 
            if ($data['ticket']['id_status'] == 1) echo "Ожидание";
            if ($data['ticket']['id_status'] == 2) echo "В процессе";
            if ($data['ticket']['id_status'] == 3) echo "Выполнен";
        ?></p>
        <form onsubmit="return false;" id='chat_form'>
            <div class="message_container" id="message_container">

            </div>
            <div style='display: none' id='inp_post_id'></div>
            <div class="send_block">
                <textarea class="inp_text" id="inp_text" placeholder="Сообщение" name="text"></textarea>
                <input class="chat_submit_btn" id="submit_btn" type="submit" value="send" onclick="req2(); return false;">
            </div>
        </form>
    </div>
</div>
<script>
    let message_container = document.getElementById('message_container');
    let post_input = document.getElementById('inp_post_id');
    let inp_text = document.getElementById('inp_text');
    let submit_btn = document.getElementById('submit_btn');

    let data_server_send = {
        "messages" : [],
        "id" : [],
    }

    const req1 = () => {
        const write = () => {
            message_container.innerHTML = "";
            for(let i = 0; i < data_server_send.messages.length; i++){
                if(data_server_send.id_user[i] === data_server_send.my_id)
                    message_container.innerHTML += `<div class="message_is_my">${data_server_send.messages[i]}</div>`;
                else
                    message_container.innerHTML += `<div class="message_is_their">${data_server_send.messages[i]}</div>`;
            }
            post_input.innerText = data_server_send.id[data_server_send.length];
        }

        $.ajax({
            url: '/ticket/chatAct',
            type: 'GET',
            success: (res) => {
                data_server_send = JSON.parse(res);
                write();
            },
        });
    }
    req1();

    let post_id = post_input.textContent || post_input.innerText;
    let server_id = post_input.textContent || post_input.innerText;

    let data_view = {
        post_id: post_id
    };
    let data_server = {
        "messages" : [],
        "id_what" : 0,
        "server_id" : 0,
        "is_new" : false,
    };

    const req2 = () => {
        let text_is = inp_text.value;
        let data_text = {
            text: text_is
        };
        inp_text.value = "";

        const write2 = () => {
            message_container.innerHTML = "";
            for(let i = 0; i < data_server_send.messages.length; i++){
                if(data_server_send.id_user[i] === data_server_send.my_id)
                    message_container.innerHTML += `<div class="message_is_my">${data_server_send.messages[i]}</div>`;
                else
                    message_container.innerHTML += `<div class="message_is_their">${data_server_send.messages[i]}</div>`;
            }
            post_input.innerText = data_server_send.id[data_server_send.length];
        }

        $.ajax({
            url: '/ticket/chatAct',
            type: 'POST',
            data: data_text,
            success: (res) => {
                data_server_send = JSON.parse(res);
                write2();
            },
        });
    }

    const req = () => {
        $.ajax({
            url: '/ticket/timer',
            type: 'POST',
            data: data_view,
            success: (res) => {
                data_server = JSON.parse(res);
            },
        });
        server_id = Number(data_server.server_id);
        data_view.post_id = server_id;
        if(data_server.is_new){
            message_container.innerHTML = "";
            for(let i = 0; i < data_server.messages.length; i++){
                if(data_server_send.id_user[i] === data_server_send.my_id)
                    message_container.innerHTML += `<div class="message_is_my">${data_server.messages[i]}</div>`;
                else
                    message_container.innerHTML += `<div class="message_is_their">${data_server.messages[i]}</div>`;
            }
        }
    }
    
    let timerId = setTimeout(function tick() {
        req();
        timerId = setTimeout(tick, 2000);
    }, 2000);
</script>
<form onsubmit="return false;" id='chat_form'>
    <div id="message_container">

    </div>
    <div style='display: none' id='inp_post_id'></div>
    <input id="inp_text" type="text" placeholder="Сообщение" name="text" />
    <input id="submit_btn" type="submit" value="send" onclick="req2(); return false;">
</form>
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
                message_container.innerHTML += `${data_server_send.messages[i]}<br/>`;
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
                message_container.innerHTML += `${data_server_send.messages[i]}<br/>`;
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
        console.log(data_server);
        data_view.post_id = server_id;
        if(data_server.is_new){
            message_container.innerHTML = "";
            for(let i = 0; i < data_server.messages.length; i++){
                message_container.innerHTML += `${data_server.messages[i]}<br/>`;
            }
        }
    }
    
    let timerId = setTimeout(function tick() {
        req();
        timerId = setTimeout(tick, 2000);
    }, 2000);
</script>
<form action="/ticket/chat" id='chat_form' method="post">
    <div id="message_container">
        
    </div>
    <input id='inp_post_id' type='hidden' name='message_id' />
    <input type="submit" value="send">
</form>
<script>
    let server_id = 0;
    let post_input = document.getElementById('inp_post_id');
    let post_id = post_input.value;

    let data_view = post_id;
    let data_server = {
        "messages": [],
    };
    const req = () => {
        $.ajax({
            url: '/ticket/timer',
            type: 'GET',
            data: data_view,
            success: (res) => {
                data_server = JSON.stringify(res);
            }
        });
        server_id = Number(server_id);
        post_id = Number(post_id);
        let message_container = document.getElementById('message_container');
        console.log(data_server)
        for(let i = 0; i < data_server['messages'].length; i++){
            message_container.innerHTML += `${data_server['messages'][i]}<br/>`;
        }
    }
    req();
    let form = document.getElementById('chat_form');
    let timerId = setTimeout(function tick() {
        req();
        console.log(server_id);
        console.log(post_id);
        if (server_id !== post_id) console.log("WE ARE HERE");
        timerId = setTimeout(tick, 2000);
    }, 2000);
</script>
<form action="/ticket/chat" id='chat_form' method="post">
    <div>
        <?php 
            for($i = 0; $i < count($data['messages']); $i++){
                echo($data['messages'][$i]."<br />");
            }
        ?>
    </div>
    <?php echo("<input id='post_id' type='hidden' name='message_id' value='".$data['id'][count($data['id']) - 1]."' />") ?>
    <input type="text" name="text" />
    <input type="submit" value="send">
</form>
<script>
    let server_id = 0;
    let post_input = document.getElementById('post_id');
    let post_id = post_input.value;
    const req = () => {
        $.ajax({
            url: '../../js/timer.php',
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
        if(server_id !== post_id) form.submit();
        timerId = setTimeout(tick, 2000);
    }, 2000);
</script>
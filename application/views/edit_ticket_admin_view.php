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

.edit {
    color: black;
}
</style>
<div class="main-content">
    <div class="info">
        <?php
        var_dump ($data);
            if (isset($data)) {
                //var_dump($data);
                echo "<span><h1>". $data['ticket']['id'] ."</h1><h2 style='padding-left: 20px;'>". $data['ticket']['title'] ."</h2></span>";
                echo "<span><p class='type'>Тема: ". $data['ticket']['name'] ."</p></span>";
                echo "<span><p class='text'>". $data['ticket']['text'] ."</p></span>";
                echo "<span class='images-info'></span>";
                echo "<span class='creator-info'><h2>Автор: </h2><p>". $data['ticket']['author'] ."</p></span>";
                echo "<span class='worker-info'><h2>Сотрудник: </h2><select>"
                    if (isset($data['']))
                echo "</select></span>";
            }
        ?>
    </div>
</div>

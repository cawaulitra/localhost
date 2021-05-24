<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
<style>
    .login_page{
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0px 1px 54px rgba(0, 0, 0, 0.15);
        width: 600px;
        height:500px;
    }
    .input{
        margin-bottom:40px;
        width: 389px;
        height: 57px;
        background: rgba(239, 238, 238, 0.4);
        border-radius: 7px;
        border: none;
        text-align: center;

    }
    button{
        width: 197px;
        height: 57px;
        border-radius: 7px;
        border: none;
        background-color:#598FFC;
        color: white;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 25px;
        line-height: 29px;
    }
    .plane{
        background-color:#598FFC;
        width: 600px;
        height: 130px;
        text-align: center;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 42px;
        line-height: 49px;
    }

    .user_profile_content a{
        padding: 5px 20px;
        height: 27px;
        border-radius: 7px;
        border: none;
        background-color:#598FFC;
        color: white;
        padding-top: 15px;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 16px;
        cursor: pointer;
    }
    .name{
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 25px;
        line-height: 29px;

        color: rgba(37, 50, 84, 0.7);
    }
    .data{
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 30px;
        line-height: 35px;
        margin-left: 30px;
        color: #253254;
    }
    .text{
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: baseline;
        justify-content: flex-start;
        padding: 20px;
    }
    .text2{
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: baseline;
        justify-content: flex-start;
    }
    .user_profile_content{
        box-sizing: border-box;
        padding: 63px 55px 63px 55px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    input{
        margin-left: 5%;
    }
    .user_profile_content p{
        margin-left: 15px;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 25px;
        line-height: 30px;

        color: #253254;
    }
</style>
<div class="login_page">
    <div class="plane">
        <?php
        echo $data['stat'][0]['user'];
        ?>
    </div>
    <div class="user_profile_content">
        <div class="text">
            <p class="name">Выполнено тикетов:</p>
            <p><?php echo $data['stat'][0]['count_tickets'];?></p>
        </div>
        <div class="text2">
            <p class="name">Среднее время овета:</p>
            <p><?php echo $data['stat'][0]['avg_time'];?></p>
        </div>
        <a class="password">Изменить профиль</a>
    </div>
</div>

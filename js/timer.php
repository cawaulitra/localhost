<?php
    $mysqli = new mysqli("localhost", "root", "usbw", "billing");
    if ($mysqli->connect_error){
        die('Error');
    }
    $mysqli->set_charset('utf8');

    $string = "SELECT `id` FROM `messages`";
    $res = $mysqli->query($string);
    $row = $res->fetch_assoc();
    while ($row = $res->fetch_assoc()) {
        $server_id = $row['id'];
    }

    echo $server_id;
?>
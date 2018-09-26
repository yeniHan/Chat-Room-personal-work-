<?php

session_start();
$user_id = $_SESSION["user_id"];

$servername = "localhost";
$dbname = "chatroom";
$username = "root";
$password = "";

try{
    $dataConn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);

    $sql = "SELECT `lastMsgId` FROM `users` WHERE `user_id` = :user_id";
    $sta = $dataConn->prepare($sql);
    $sta->bindParam(":user_id", $user_id);
    $sta->execute();
    $row = $sta->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);

    $dataConn = null;
    $sta = null;
    
}catch(PDOException $e){
    echo "ERROR: Problem with the server.";
}



?>
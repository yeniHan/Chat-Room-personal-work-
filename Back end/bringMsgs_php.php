<?php
$json = file_get_contents("php://input");
$assArr = json_decode($json, true);

$user_id = $assArr["user_id"];
$fromLastMsgOrNot = $assArr["fromLastMsgOrNot"];

$dataConn = new PDO("mysql:host=localhost;dbname=mydb;", "root", "");
$sql2 = "SELECT `id`, `user_id`, `msg`, `time`, `private`, `receiver` FROM `msgs` WHERE `id` > :lastMsgId;";
$lastMsgId = -1;

if($fromLastMsgOrNot === true){
    $sql1 = "SELECT `lastMsgId` FROM `users` WHERE `user_id` = :user_id"; 
    $sta1 = $dataConn -> prepare($sql1);
    $sta1 -> execute([":user_id" => $user_id]);
    $assArr = $sta1 -> fetch(PDO::FETCH_ASSOC);
    $lastMsgId = $assArr["lastMsgId"];
    if($lastMsgId === null) $lastMsgId = -1;
    else $lastMsgId = (int) $lastMsgId;

}
$sta2 = $dataConn -> prepare($sql2);
$sta2 -> execute([":lastMsgId" => $lastMsgId]);
$assArrOfAssArrs = $sta2 -> fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($assArrOfAssArrs);
echo $json;

$dataConn = null;
$sta1 = null;
$sta2 = null;


?>
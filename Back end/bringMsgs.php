<?php
session_start();

$json = file_get_contents("php://input");

$dataObj = json_decode($json, true);
$lastMsgId = $dataObj["lastMsgId"];
$lastMsgId === ""? $lastMsgId : 0;

$user_id = $_SESSION["user_id"];

$response = new stdClass();
$response->status = "OK";
$response->message = null;
$response->msgs = null;

if(isset($lastMsgId)){

    $servername = "localhost";
    $dbname = "chatroom";
    $username = "root";
    $password = "";
    
    try{
        $dataConn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);

        $sql = "SELECT `id`, `user_id`, `msg`, `time`, `private`, `receiver` FROM `msgs` WHERE `id` >= :lastMsgId;";
        $sta = $dataConn -> prepare($sql);
        $sta->bindValue(":lastMsgId", $lastMsgId);
        $sta->execute();
        $obj = $sta->fetchAll(PDO::FETCH_ASSOC);

        $response->msgs = json_encode($obj);

        $dataConn = null;
        $sta = null;

    }catch(PDOException $e){
        $response->status = "ERROR";
        $response->message = "Problem with the server.";    
    }
}else{
    $response->status = "ERROR";    
    $response->message = "Failed to receive all necessary data for execution.";
}

echo json_encode($response);

?>
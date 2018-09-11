<?php
$json = file_get_contents("php://input");

$msgObj = json_decode($json, true); 
$user_id = $msgObj["user_id"];
$msg = $msgObj["msg"];

$tz = "Asia/Seoul";
$timestamp = time();
$time = new DateTime("now");
$time -> setTimestamp($timestamp);
$time = $time -> format("Y-d-j h:i:s");

$private = $msgObj["private"];
$receiver = $msgObj["receiver"];

if(isset($user_id) && isset($msg)){
    
    $dataConn = new PDO("mysql:host=localhost;dbname=chatroom;", "root", "");
    $sql = "INSERT INTO `msgs` (`user_id`, `msg`, `time`, `private`, `receiver`) VALUES (:user_id, :msg, :time, :private, :receiver);";
    
    $sta = $dataConn -> prepare($sql);
    $sta -> execute([":user_id"=> $user_id, ":msg" => $msg, ":time" => $time, ":private"=> $private, ":receiver" => $receiver]);
	
	$dataConn = null;
	$sta = null;

}
else{
    echo "Failed to write a mgs.";
}

?>
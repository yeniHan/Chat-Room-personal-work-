<?php
$json = file_get_contents("php://input");

$msgObj = json_decode($json, true); 
$user_id = $msgObj["user_id"];
$msg = $msgObj["msg"];
$private = $msgObj["private"];
$receiver = $msgObj["receiver"];

$response = "OK";

if(isset($user_id) && isset($msg)){
    
    $servername = "localhost";
    $dbname = "chatroom";
    $username = "root";
    $password = "";
    
    try{

        $dataConn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
        $sql = "INSERT INTO `msgs` (`user_id`, `msg`, `private`, `receiver`) VALUES (:user_id, :msg, :private, :receiver);";
        
        $sta = $dataConn -> prepare($sql);
        $sta -> execute([":user_id"=> $user_id, ":msg" => $msg, ":private"=> $private, ":receiver" => $receiver]);
        
	    $dataConn = null;
        $sta = null;

    }catch(PDOException $e){
        $response = "ERROR: Problem with our server.";
    }

}
else{
    $response = "Failed to write a mgs.";
}

echo $response;

?>
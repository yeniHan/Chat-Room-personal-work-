<?php

$json = file_get_contents("php://input"); 
$dataObj = json_decode($json, true);

$servername = "localhost";
$dbname = "chatroom";
$username = "root";
$password = "";

try{
    $dataConn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);

    $sql = "SELECT `user_id` FROM `users`;";
    $sta = $dataConn -> prepare($sql);
    $sta -> execute();
    $obj = $sta -> fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($obj);

    $dataConn = null;
    $sta = null;

}catch(PDOException $e){
    echo "Failed to get the member list.";
}



?>
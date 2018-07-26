<?php

$dataConn = new PDO("mysql:host=localhost;dbname=mydb;", "root", "");

$sql = "SELECT `user_id` FROM `users`;";

$sta = $dataConn -> prepare($sql);

$sta -> execute();

$assArrOfassArrs = $sta -> fetchAll(PDO::FETCH_ASSOC);

$dataConn = null;
$sta = null;

$json = json_encode($assArrOfassArrs);
if($json !== "[]"){
    echo $json;
}else{
    echo "Failed to get the member list.";
}


?>
<?php

$idAndPw = file_get_contents("php://input");
$assArr = json_decode($idAndPw, true);

if(isset($assArr["user_id"])&& isset($assArr["pw"])){
    $user_id =  $assArr["user_id"];
    $pw = $assArr["pw"];
    $dataConn = new PDO('mysql:host=localhost;dbname=chatroom;', 'root', '');
    $sql = "SELECT `id`, `user_id`, `pw` FROM `users`;";

    $sta = $dataConn -> prepare($sql);

    $sta = $dataConn -> prepare($sql);
    $sta -> execute();

    $assArrOfAssArrs = $sta ->fetchAll(PDO::FETCH_ASSOC);
    $matchOrNot = "NO_MATCH";
    for($i = 0; $i < count($assArrOfAssArrs); $i++){
        $thisAssArr = $assArrOfAssArrs[$i];
        $thisuser_id = $thisAssArr['user_id'];
        $thispw = $thisAssArr['pw'];
        if($user_id === $thisuser_id && $pw === $thispw){
            $matchOrNot = "IDPW_MATCH";
            break;
        }
        else if($user_id === $thisuser_id && $pw !== $thispw){
            $matchOrNot = "ID_MATCH";
            break;
        }
    }
    echo $matchOrNot;
}
else{
    echo "ERROR: Failed to get the user's ID and PASSWORD.";
}

?>
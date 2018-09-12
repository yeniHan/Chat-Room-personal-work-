<?php

$idAndPw = file_get_contents("php://input");
$assArr = json_decode($idAndPw, true);

$user_id =  $assArr["user_id"];
$pw = $assArr["pw"];

$response = "OK";

if(isset($user_id)&& isset($pw)){

    $servername = "localhost";
    $dbname = "chatroom";
    $username = "root";
    $password = "";

    try{
        $dataConn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);

        //In the case where the user id exists but the password is not matched,
        //the page'll inform this to the user. 

        $sql1 = "SELECT `id` FROM `users` WHERE `user_id` = :user_id;";    
        $sta1 = $dataConn->prepare($sql1);
        $sta1->bindParam(":user_id", $user_id);
        $sta1->execute();
        $rows1 = $sta1->fetchAll();
        
        $sql2 = "SELECT `id` FROM `users` WHERE `user_id` = :user_id AND `pw` = :pw;";            
        $sta2 = $dataConn->prepare($sql2);
        $sta2->bindParam(":user_id", $user_id);
        $sta2->bindParam(":pw", $pw);
        $sta2->execute();
        $rows2 = $sta2->fetchAll();

        //If the user_id exists but the password is not matched,
        if(count($rows1) === 1 && count($rows2) === 0){
            $response = "ERROR: PW_NOT_MATCH";
        //If the user_id doesn't exist,
        }else if((count($rows1) === 0)){
           $response = "ERROR: NO_MATCH";
        }

        $dataConn = null;
        $sta1 = null;
        $sta2 = null;

    }catch(PDOException $e){
        $response = "ERROR: Problem with our server.";
    }
}
else{
    $response = "ERROR: Failed to receive the necessary data from the front-end.";
}

echo $response;
?>
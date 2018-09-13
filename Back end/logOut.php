<?php
session_start();

$json = file_get_contents("php://input"); 
$dataObj = json_decode($json, true);
$user_id = $_SESSION["user_id"];

$response = "OK";


if( isset($user_id) && ($user_id !== "")){

    $servername = "localhost";
    $dbname = "chatroom";
    $username = "root";
    $password = "";
    
    try{
        $dataConn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);

        //For the functionality by which a user can choose 
        //whether the user'll read only the messages except for the messages which the user has read or not. 
        //when the user logs in next time.

        //Get the id of the message which the user read last.
        $sql1 = "SELECT `id` FROM `msgs` ORDER BY `id` DESC LIMIT 1;";
        $sta1 = $dataConn -> prepare($sql1);
        $sta1 -> execute();
        $row1 = $sta1->fetch(PDO::FETCH_ASSOC);
        $lastMsgId = $row1["id"];

        echo "lastMsgId". $lastMsgId;
        
        //Store the id to the account information of the user.
        $sql2 = "UPDATE `users` SET `lastMsgId` = :lastMsgId WHERE `user_id` = :user_id;";
        $sta2 = $dataConn->prepare($sql2);
        $sta2->bindParam(":user_id", $user_id);        
        $sta2->bindParam(":lastMsgId", $lastMsgId);
        $sta2->execute();

		$dataConn = null;
        $sta1 = null;
        $sta2 = null;

        session_destroy();
			
    }catch(PDOException $e){
        $response = "ERROR: Problem with the server.";
    }
}else{
    $response = "ERROR: Failed to receive the data for the logout.";    
}

// echo $response;
?>

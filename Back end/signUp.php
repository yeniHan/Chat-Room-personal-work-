<?php
    $json = file_get_contents("php://input");

    $dataObj = json_decode($json, true);

    $user_id = $dataObj["user_id"]; 
    $eMail = $dataObj["eMail"];
    $pw = $dataObj["pw"];

    $response = "OK";

    if(isset($user_id) && isset($eMail) && isset($pw)){
        try{
            $servername = "localhost";
            $dbname = "chatroom";
            $username = "root";
            $password = "";

            $dataConn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);

            //Every user should have a unique 'uesr_id', check if the user_id is being used by another user.
            $sql1 = "SELECT `id` FROM `users` WHERE `user_id` = :user_id";
            $sta1 = $dataConn->prepare($sql1);
            $sta1->bindParam(":user_id", $user_id);
            $sta1->execute();
            $rows = $sta1->fetchAll();

            if(count($rows) !== 0){

                $response = "ERROR: This 'user_id' exists.";

            //If not, allow the user to sign up.
            }else{

                $sql2 = "INSERT INTO `users` ( `user_id`, `pw`, `eMail`) VALUES ( :user_id, :pw, :eMail);";
                $sta2 = $dataConn->prepare($sql2);
                $sta2->bindParam(":user_id", $user_id);
                $sta2->bindParam(":pw", $pw);
                $sta2->bindParam(":eMail", $eMail);
                $sta2->execute();
            }
            
            $dataConn = null;
            $sta1 = null;
            $sta2 = null;

        }catch(PDOException $e){
            $response = "ERROR: Problem with our server.";
        }

    }else{
        $response = "ERROR: All necessary data were not sent.";
    }

    echo $response;
?>
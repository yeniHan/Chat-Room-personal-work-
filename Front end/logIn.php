<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in page</title>
    <link rel="stylesheet" type="text/css" href="CSS/logIn.css">
</head>
<body>
    <div id="container">
        <div id="title">Log In</div>
        <p id="instruction">Please log-in first.</p>
        <input id="useridInput" type="text" placeholder="ID">
        <input id="pwInput" type="password" placeholder="PASSWORD">
        <button id="logInButton">Log In</button>
        <div id="clickableSignUpBox">Don't have an acount?<a href="signUp.html" id="clickableSignUp"> Sign Up</a></div>
    </div>
    
<script>
    var logInButton = document.getElementById("logInButton");
    logInButton.addEventListener("click", checkIdAndPw);
    var useridInput = document.getElementById("useridInput");
    var pwInput = document.getElementById("pwInput");

    function checkIdAndPw(){
        var user_id = useridInput.value;
        var pw = pwInput.value;

        var xhr = new XMLHttpRequest();        
        xhr.onreadystatechange = function () {
            if(xhr.readyState === 4 && xhr.status === 200){
                var response = xhr.responseText;
                if(response === "OK"){ 
                    window.location.href = "./chatRoom.php";
                }
                else if(response === "ERROR: PW_NOT_MATCH"){
                    alert("Please insert the right password.");
                }
                else if(response === "ERROR: NO_MATCH"){
                    alert("This ID doesn't exist. Please sign up first.");
                }else{
                    console.log(response);
                }                 
            }
        }
        xhr.open("POST", "../Back end/logIn.php");
        xhr.send('{"user_id":"' + user_id + '",' + '"pw":"' + pw + '"}'); 
    }

</script>  
</body>
</html>
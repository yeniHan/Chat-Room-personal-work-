<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to ChatRoom</title>
    <link rel="stylesheet" type="text/css" href="CSS/chatroom.css">
</head>
<body>
    <button id="logOutButton">Log Out</button>
    <input type="hidden" id="lastMsgIdInput"/>
    <div id="biggestContainer">
        <div id="memberListBox">
            <p id="title">Members</p>
            <div id="memberList">
            </div>
            <div id="textBox">
                <div id="name">Private Chat</div>
                <p id="instruction">To start a private chat, choose the person to talk with in the private mode.</p>
                <input id="hiddenInputForPrivateMSGReceiver" type="hidden" value="">
                <div id="displaySelectedId">Friend ID:</div>
                <button id="startButton">Start</button>
            </div>
        </div>
        <div id="container">
            <p id="welcomeMsg">Hello, <?php echo $_SESSION["user_id"] . "!"; ?></p>
            <div id="msgDisplayBox"><div id="question">Do you want to read from the last message that you read? <p><span id="yes">Yes </span>/<span id="no"> No</span></p></div></div>
            <div id="msgInputContainer">
                <textarea id="msgInput" name="msg" row= "5" col="50" ></textarea>
                <div id="sendButtonContainer"><button id="sendButton">Send</button>
                    <label for="privateChkBox">Private Mode</label><input id="privateChkBox" type="checkbox">
                </div>
            </div>
        </div>
    </div>
 <script>
    var msgDisplayBox = document.getElementById("msgDisplayBox");
    var user_id = "<?php echo $_SESSION["user_id"];?>";
    var lastMsgIdInput = document.getElementById("lastMsgIdInput");
    var fromLastMsgYes = document.getElementById("yes");
    var fromLastMsgNo = document.getElementById("no");
    fromLastMsgYes.addEventListener("click", () => {
        getMsgs(lastMsgIdInput.value);
        setInterval(getMsgs, 2000);
    });
    fromLastMsgNo.addEventListener("click", () => {
        lastMsgIdInput.value = "";        
        getMsgs(lastMsgIdInput.value);
        setInterval(getMsgs, 2000);
    });  
    

    var p = new Promise((resolve, reject)=>{
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if(this.readyState === 4 && this.status === 200){
                var lastMsgId = JSON.parse(xhr.responseText)["lastMsgId"];
                lastMsgIdInput.value = lastMsgId;
                setTimeout(() => { resolve(lastMsgId);}, 500);                
            }
        }
        xhr.open("POST", "../Back end/hasLastMsgId.php");
        xhr.send();
    });
    
    p.then(function(lastMsgId){
        if(lastMsgId !== null){
            document.getElementById("question").style.display = "block";
        }else{            
            getMsgs();
            setInterval(()=>{
                getMsgs();
            }, 2000);
        }
    });
    
	 

    function getMsgs (){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            msgDisplayBox.innerHTML = ""; 
            if(xhr.readyState === 4 && xhr.status === 200){
                var json = xhr.responseText;
                var obj = JSON.parse(json);
                if(obj["status"] === "OK"){
                    let msgs_json = obj["msgs"];
                    let msgs_obj = JSON.parse(msgs_json);

                for(var i = 0; i< msgs_obj.length; i++){
					var newHTML = "";  
                    var thisMsgObj = msgs_obj[i];
                    var thisUser_id = thisMsgObj["user_id"];                  
                    var thisMsg = thisMsgObj.msg;
                    var thisTime = thisMsgObj.time;
                    var thisPrivate = thisMsgObj.private;
                    var thisReceiver = thisMsgObj.receiver;
                    if(thisPrivate === "1" && (user_id === thisUser_id ||user_id === thisReceiver)){
                        newHTML = "<div class='bubbleContainer'><div class='privateBubbleTail'></div>" + "<div class='privateBubble'>" + "<span class='name'>"  + thisUser_id  + "</span>" + " " + thisMsg + 
                            "<div class='dt'>" + thisTime + "</div></div></div>";
                    }
                    else if(thisPrivate === "0" && user_id === thisUser_id) {
                        newHTML = "<div class='bubbleContainer'><div class='myBubbleTail'></div>" + "<div class='myBubble'>" + "<span class='name'>"  + thisUser_id  + "</span>" + " " + thisMsg + 
                            "<div class='dt'>" + thisTime + "</div></div></div>";
                    }
                    else if(thisPrivate === "0" && user_id !== thisUser_id){  
                        newHTML = "<div class='bubbleContainer'><div class='othersBubbleTail'></div>" + "<div class='othersBubble'>" + "<span class='name'>"  + thisUser_id  + "</span>" + " " + thisMsg + 
                        "<div class='dt'>" + thisTime + "</div></div></div>";
                    }
                    msgDisplayBox.innerHTML += newHTML; 
                    msgDisplayBox.scrollTop = msgDisplayBox.scrollHeight;
                }
                }else{
                    console.log(obj["message"]);
                }
            }
        }
        xhr.open("POST", "../Back end/bringMsgs.php");
        var obj = {
            lastMsgId: lastMsgIdInput.value
        };
        var json = JSON.stringify(obj);
        xhr.send(json);

        // setInterval( getMsgs, 2000);        
    }
 

    var sendButton = document.getElementById("sendButton");
    sendButton.addEventListener("click", writeMsg);
    var privateChkBox = document.getElementById("privateChkBox");

    function writeMsg(){
        var newMsg = document.getElementById("msgInput").value;
        var isPrivate = privateChkBox.checked;
        var idOfPrivateMSGReceiver = hiddenInputForPrivateMSGReceiver.value;

        if(newMsg === ""){
            alert("Please write a message.");
        }
        else{
            var xhr = new XMLHttpRequest();
            var obj = {};
            obj["user_id"] = user_id;
            obj["msg"] = newMsg;
            obj["private"] = isPrivate;
            
            if(isPrivate === false){
                obj["receiver"] = null;
            }
            else if(isPrivate === true && idOfPrivateMSGReceiver === ""){
                alert("To start a private conversation, please click the ID of the person " + 
                "to talk with in the private mode in the member list.");
            }
            else{ 
                obj["receiver"] = idOfPrivateMSGReceiver;
            }

            var json = JSON.stringify(obj);
            
            xhr.onreadystatechange = function () {
                if(xhr.readyState === 4 && xhr.status === 200){ 
                    if(xhr.responseText !== "OK"){
                        console.log(xhr.responseText);
                    }  
                }
            }
            xhr.open("POST", "../Back end/writeNewMsg.php");
            xhr.send(json);
            document.getElementById("msgInput").value = "";
        }
    }

    var memberList = document.getElementById("memberList");
    window.onload = displayMemberList();

    function displayMemberList(){
        memberList.innerHTML = "";
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if(xhr.readyState === 4 && xhr.status === 200){

                var json = xhr.responseText;
                var arrOfObjs = JSON.parse(json);

                for(var i = 0; i < arrOfObjs.length; i++){
                    var thisObj = arrOfObjs[i];
                    var thisUser_id = thisObj["user_id"];
                    memberList.innerHTML += '<p class="user_idInMemberList">' + thisUser_id + '</p>';
                }

                var listOfUser_ids = document.getElementsByClassName("user_idInMemberList");
                for(var i = 0; i < listOfUser_ids.length ; i++){
                    var thisUser_id = listOfUser_ids[i];
                    thisUser_id.addEventListener("click", storeId);
                }
            }
        }
        xhr.open("POST", "../Back end/getMemberList.php");
        xhr.send();
        newMsg = "";
    }
    
    var hiddenInputForPrivateMSGReceiver = document.getElementById("hiddenInputForPrivateMSGReceiver");
    var displaySelectedId = document.getElementById("displaySelectedId");
    
    function storeId(){
        var selectedId = this.innerHTML;
        hiddenInputForPrivateMSGReceiver.value = selectedId;
        displaySelectedId.innerHTML = "Friend ID: " + selectedId;
    }

    var startButton = document.getElementById("startButton");
    startButton.addEventListener("click", showConfirmMsg);

    function showConfirmMsg(){
        confirm("Do you want to ask for a private chat to the user?");
    }

    var logOutButton = document.getElementById("logOutButton");
    logOutButton.addEventListener("click", logOut);

    function logOut(){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if(xhr.readyState === 4 && xhr.status === 200){
				window.location.href = "logIn.php";
            }
        }
        xhr.open("POST", "../Back end/logOut.php");
        xhr.send();
    }



</script>   
</body>
</html>
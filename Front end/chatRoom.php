<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to ChatRoom</title>
</head>
<style>
	#memberList{
        overflow-y: scroll;
        height: 20.58em;
    }
   .bubbleContainer{
        display: flex;
    }
    .myBubble{
        display: inline-block;
        color: black;
        background: #fff349;
        width: auto;
        min-width: 387px;
        margin: 6px;
        border-radius: 6px;
        opacity: 0.7;
        padding: 3px 3px 6px 10px;
    }
    .myBubbleTail{
        display: inline-block;
        width: 0px;
        height: 0px;
        opacity: 0.7;
        position: relative;
        top: 15px;
        left: 6px;
        border-top: 4px solid transparent;
        border-right: 8px solid green;
        border-bottom: 4px solid transparent   
    }
    .othersBubble{
        display: inline-block;
        background: #ffeaef;
        color: black;
        width: auto;
        min-width: 387px;
        margin: 4px;
        border-radius: 6px;
        opacity: 0.7;
        padding: 3px 3px 6px 10px;
    }
    .othersBubbleTail{
        display: inline-block;
        width: 0px;
        height: 0px;
        opacity: 0.7;        
        position: relative;
        top: 12px;
        left: 6px;
        border-top: 5px solid transparent;
        border-right: 10px solid blue;
        border-bottom: 5px solid transparent;
    }
    .privateBubble{
        display: inline-block;
        background: #ff7373;
        color: black;
        width: auto;
        min-width: 387px;
        margin: 4px;
        border-radius: 6px;
        opacity: 0.7;
        padding: 3px 3px 6px 10px;
    }
    .privateBubbleTail{
        display: inline-block;
        width: 0px;
        height: 0px;
        opacity: 0.7;        
        position: relative;
        top: 12px;
        left: 6px;
        border-top: 5px solid transparent;
        border-right: 10px solid red;
        border-bottom: 5px solid transparent;
    }
    .name{
        color: blue;
        font-weight: bold;
        margin-right: 12px;
    }
    .dt{
        color: rgb(58, 58, 58);
        margin-left: 20px;
        font-size: 0.6em;
    }
    #memberListBox{
        background: rgb(255, 223, 228);
        border: 1px solid red;
        width: 16em;
    }
    #title{
        background: pink;
        margin: 0;
        border-bottom: 1px solid red;
    }
    #name{
        color: red;
    }
    .user_idInMemberList{
       cursor: pointer;   
       color: blue;      
    }
    #textBox{
        background: white;
        border-top: 1px solid red;
        height: 172px;
    }
    #startButton{
        margin-top: -1.5em;
        margin-left: 13em;
        margin-bottom: 1em;
        margin-right: 1em;
    }
    #container{
        border-bottom: 1px solid red;
        border-top: 1px solid red;
        border-right: 1px solid red;
        width: 35em;
    }
    #welcomeMsg{
        background: pink;
        margin: 0;
        padding: 0 1em;
        border-bottom: 1px solid red;
    }
    #biggestContainer{
        display: flex;
        height: 33em;
        margin: 3em 18em;
    }
    #msgInputContainer{

    }
    #msgInput{
        width: 549px;
        height: 78px;
        position: relative;
        top: 2.6em;
    }
    #sendButtonContainer{
        position: relative;
        top: -5em;
        color: red;
        background: white;
        width: 205px;
    }
    #msgDisplayBox{
        overflow-y: scroll;
        height: 29.9em;
        font-size: 0.8em;
    }
    #logOutButton{
        position: relative;
        top: -73px;
        left: 1091px;
        color: white;
        background: blue;
        font-weight: bold;
    }
    #question{
        padding: 8em;
        text-align: center;
    }
    #yes, #no{
        cursor: pointer;
    }

</style>
<body>
    <div id="biggestContainer">
        <input id="hiddenInputForId" type="hidden" value="">
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
            <p id="welcomeMsg">Hello, <?php $user_id = $_REQUEST["user_id"]; echo $user_id . "!"; ?></p>
            <div id="msgDisplayBox"><div id="question">Do you want to read from the last message that you read? <p><span id="yes">Yes </span>/<span id="no"> No</span></p></div></div>
            <div id="msgInputContainer">
                <textarea id="msgInput" name="msg" row= "5" col="50" ></textarea>
                <div id="sendButtonContainer"><button id="sendButton">Send</button>
                    <label for="privateChkBox">Private Mode</label><input id="privateChkBox" type="checkbox">
                </div>
            </div>
        </div>
    </div>
    <button id="logOutButton">Log Out</button>
    <input type="hidden" id="hiddenInputForFromLastMsgOrNot"  value="false">
 <script>
    var msgDisplayBox = document.getElementById("msgDisplayBox");
    var user_id = <?php echo $user_id;?>;
    var fromLastMsgYes = document.getElementById("yes");
    var fromLastMsgNo = document.getElementById("no");
    fromLastMsgYes.addEventListener("click", displayMsgs);
    fromLastMsgNo.addEventListener("click", displayMsgs);
    var fromLastMsgOrNot;
	 
    function displayMsgs(){
        if(this.id === "yes") fromLastMsgOrNot = true;
        else fromLastMsgOrNot = false; 
        if(fromLastMsgOrNot !== undefined) {
            getMsgs();
            setInterval(getMsgs, 2000);
        }
    }
	 
    function getMsgs(){

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if(xhr.readyState === 4 && xhr.status === 200){
                var json = xhr.responseText;
                var arrOfObjs = JSON.parse(json);
                msgDisplayBox.innerHTML = "";
                              
                for(var i = 0; i< arrOfObjs.length; i++){
					var newHTML = "";  
                    var thisMsgObj = arrOfObjs[i];
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
            }
        }
        xhr.open("POST", "../Back end/bringMsgs.php");
        xhr.send('{"user_id":' + '"' + user_id + '", "fromLastMsgOrNot":' + fromLastMsgOrNot + '}');
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
				window.location.href = "logIn.html";
            }
        }
        xhr.open("POST", "../Back end/logOut.php");
        xhr.send('{"user_id":"' + user_id + '", "lastMsgId":' + lastMsgId + "}");
    }



</script>   
</body>
</html>
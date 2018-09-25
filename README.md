#PP02. Chatroom

This is my second work which I finished during my learning process at "w-coding" academy.

I used PHP for back-end and MySQL for databas. 

Functionality:

1. Signup and Login/out:
   *Data validation check
   For example, when a user tries to sign up, if the entered id is already benig used by another user, 
   signup isn't allowed.
   
2. Private Chat
  1) A user select another user to send a "private" message which'll be not visible to other users in the chatting room
    in the user list.
  2) Check the "Private" check box and type the message to send. 
  3) Click "Send" button. 
  
3. Reading only unread messages
  If a user left the app by clicking "Log out" button, the data about the message which the user read last'll be stored in the DB.
  So, when the suer revisits the app, the app'll ask if the user wants to read only unread message and show the only messages that the       user wants.
  
  i)When leaving the app,
  1) Click "Log out" button. 
  ii)When revisiting the app,
  1) Click Yes/No in the question dialog asking if the user want to read the only unread messages.
  
 
 *To see how each function works, 
 Please import "DB.sql". By logging in with any of the existing accounts, you can see how the functions works more conviniently. 
 
 [Accounts]
 +---------+-----------+
| user_id | pw        |
+---------+-----------+
| admin   | adminpw   |
| sheldon | sheldonpw |
| leonard | leonardpw |
| howard  | howardpw  |
| laj     | lajpw     |
+---------+-----------+

For "2. Private Chat" function: Use "leonard" or "sheldon" account.
For "3. Rdading only unread messages" function: Use "sheldon" account.




PS. The used dialogue was extracted from the script of series 01 episode 03 of "The Big Bang Theory".

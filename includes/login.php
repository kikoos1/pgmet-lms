<?php include 'db.php';
include "functions.php";
session_start();
if(isset($_POST['log']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = mysqli_real_escape_string($conn,$password);
    $username = mysqli_real_escape_string($conn,$username);
    $password = md5($password,true);
   Login($username,$password);


            
}
    

?>
<!DOCTYPE HTML>
<html lang = "bg">
    <meta charset = "UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <head><title>Оналй обучение|Вход</title></head>
    <body>
        <link rel = "stylesheet" type = "text/css" href = "styles/login.css">
    <header><h3 class = "title">Вход</h3></header>
        <main>
        <div>
            <br>
            <form action = "" method = "post">
            <a>Потр.име: </a><input type = "text" name = "username">
                <br>
                <a>Парола: </a><input type = "password" name = "password">
                <br>
                <button type = "submit"name = "log">Вход</button>
                
            </form>
            </div>
        </main>
    </body>
</html>
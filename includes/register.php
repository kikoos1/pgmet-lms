
<?php include "db.php";
include "functions.php";
session_start();
global $user;
if(isset($_POST['reg']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $password = mysqli_real_escape_string($conn,$password);
    $username = mysqli_real_escape_string($conn,$username);
	$password = md5($password,true);
   Register($username,$password,$email,$name,$class);
}

?>
<!DOCTYPE HTML>
<html lang = "bg">
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
<head><title>Онлайн обучение|Регистрация</title></head>
    <body>
        <link rel = "stylesheet" type = "text/css" href = "styles/register.css">
    <header><h3 class = "title">Регистрация</h3></header>
        <main>
            <div>
                <br>
         <div class = "reg">
            <form action = "" method = "post">
           <a>Потр.име:</a><input type = "text" name = "username">
            <br>
            <a>Парола:</a><input type = "password" name = "password">
            <br>
            <a>Email:</a><input type = "email" name = "email">
            <br>
            <a>Име:</a><input type = "text" name = "name">
            <br>
            <label for="">Клас</label>
            <<select name="class"><?php Get_Classes();?></select>
            <button type = "submit" name = "reg">Регистрирай се</button>
                <a href = "login.php">Имаш профил</a>
            
            </form>
                </div>
            </div>
        
        </main>
       
    
    </body>
</html>

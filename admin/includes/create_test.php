<?php 
session_start();
include "../../includes/db.php";
include "../../includes/functions.php";
if(isset($_SESSION['admin']))
{
    if(isset($_POST['create']))
    {
        $name = $_POST['test_name'];
        $cat =$_POST['cat'];
        $author = $_POST['author'];
        $class = $_POST['class'];
        $date = $_POST['date'];
        Create_test($name,$author,$date,$class,$cat);
    }
}
else
{
    header("Location:../../index.php");
}
if(isset($_SESSION['q_id']))
{
    session_unset($_SESSION['q_id']);
}


?>
<!DOCTYPE html>
<html lang = "bg-EN">
<meta charset = "utf-8">
    <head><title>Създай тест</title></head>
    <body>
        <link rel = "stylesheet" type = "text/css" href = "styles/test.css">
    <header><h3 class = "title">Създай тест</h3></header>
        <main>
            
            <br>
            <div >
                <div class = "test_create" align = "center">
                <form action = "" method = "post">
        <input type = "text" placeholder = "Име на теста" name = "test_name">
            <br>
            <h4>Категория</h4>
            <select name = 'cat'>
           <?php Get_Cats();?>
            </select>
            <br>
            <h4>Автор</h4>
                    <input type = 'text' name = 'author'>
                    <br><br>
                    <label for="class">Клас</label>
                    <select name = 'class'>
           <?php Get_Classes();?>
            </select>
                    <br><br>
                    <input type="date" name="date">
                    <br/><br/>
                    <button type = "submit" name = "create">Създай тест</button>
                    </form>
            </div>
                </div>
        </main>
    </body>

</html>
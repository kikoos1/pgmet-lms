<?php 
include "../../includes/db.php";
include "../../includes/functions.php";
session_start();
if(!isset($_SESSION['admin']))
{
    die("Трябва да влезеш като администратор <a href = '../../index.php'>Върни се към началната страница</a>");
}

?>
<!DOCTYPE HTML>
<html lang = "bg-EN">
<meta charset = "utf-8">
    <head><title>Онлайн обучение|Мойте тестове</title></head>
    <body>
    <div class = "table">
        <table>
        <tr>
            <th><a>ID</a></th>
            <th><a>Име</a></th>
            <th><a>Дата</a></th>
            <th><a>Автор</a></th>
            <th>Редактирай</th>
            </tr>
            <?php Get_tests();?>
        </table>
        </div>
        <a href = 'create_test.php'>Създай тест</a>
    </body>
</html>
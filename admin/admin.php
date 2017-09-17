<?php 
session_start();
if(!isset($_SESSION['admin']))
{
    echo "Трябва да си влязъл";
}
else
{
    $username = $_SESSION['admin'];


?>
<!DOCTYPE html>
<html lang = "bg-EN">
<meta charset = "utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <head><title>Онлайн обучение</title></head>
    <body>
        <link rel ="stylesheet" type = "text/css" href = "styles/admin.css">
    <header>
        <!-----Navigation Menu--->
        <section id = "navigation">
            <a href = "../my_posts.php">Уроци</a>
            <a href = "includes/my_test.php">Тестове</a>
            <a href="includes/my_cats.php">Категории</a>
            <a href = "includes/users.php">Потребители</a>
            <a href = "../includes/my_profile.php">Моят профил</a>
        </section>
        
        </header>
    <h1 id = "hello" style = "width:300px;margin:10px;"><?php echo "Добре дошъл $username.";?></h1>
    </body>

</html>
<?php }

?>
<?php include "../../includes/db.php";
session_start();
if(!isset($_SESSION['admin']))
{
    die("Трябва да влезеш като администратор <a href = '../../index.php'>Върни се към началната страница</a>");
}
function Categories()
{
    global $conn;
    $query = "Select * from categories";
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        die('Възникна грешка,моля опитайте по късно'.mysqli_error($conn));
    }else
    {
        while($row=mysqli_fetch_assoc($result))
        {
            $categorie = $row['cat_name'];
            echo"<option name = 'opt'>".$categorie."</option>";
        }
    }
}
?>
<!DOCTYPE HTML>
<html lang = "bg-EN">
<meta charset = 'utf-8'  name="viewport" content="width=device-width, initial-scale=1.0">
    <head><title>Създай урок</title>
    <link href = "styles/">
    </head>
    <body>
 
        <h3 id = "title">Създай урок</h3>
        <form action = "make_post.php" method = "post" enctype="multipart/form-data">
    <label for = "post_title">Заглави на урока: </label><input type = "text" name = "post_title">
            <br><br>
            <label for = "post_author">Автор: </label><input type = "text" name = "post_author">
            <br><br>
            <label for = "post_date">Дата: </label><input type = "date" name = "post_date">
            <br><br>
           Категория <select name = 'opt'>
                <?php Categories();?>
            </select>
            <br><br>
            <label for = "post_content">Съдъражие:</label>
            <br>
            <textarea name = 'post_content'></textarea>
            <br><br>
            <button type = "submit" id = "post" name = "post" size = "100%">Качи урок</button>       
        </form>
   
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea',
                        plugins:'media image imagetools textcolor'
                        });</script>
    </body>
</html>
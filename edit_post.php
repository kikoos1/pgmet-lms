
<?php include "includes/db.php";
include "includes/functions.php";
session_start();
if(!isset($_GET['p_id']))
{
    die('Невалиден пост');
}
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
function get_content()
{
    global $conn;
    $p_id = $_GET['p_id'];
    $query = "Select * from  posts WHERE post_id = '$p_id'";
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        die('Възникна грешка '.mysqli_error($conn));
    }
    else
    {
       while( $row = mysqli_fetch_assoc($result))
       {
        $title = $row['post_name'];
        $author = $row['post_author'];
        $date = $row['post_date'];
        $picture = $row['post_picture'];
        $content = $row['post_content'];
        $categoy = $row['post_cat'];
        ?>
<h3 id = "title">Редактирай  урок</h3>
        <form action = "" method = "post" enctype="multipart/form-data">
    <label for = "post_title">Заглави на урока: </label><input type = "text" name = "post_title" value = '<?php echo $title;?>'>
            <br><br>
            <label for = "post_author">Автор: </label><input type = "text" name = "post_author" value = '<?php echo $author?>'>
            <br><br>
            <label for = "post_date">Дата: </label><input type = "date" name = "post_date" value = '<?php echo $date;?>'>
            <br><br>
            <label for = "post_picture">Снимка: </label><input type= "file" name = "post_picture" >
            <br><br>
            <img src = '<?php echo $picture;?>' width="100">
            <br><br>
           Категория <select name = 'opt'>
                <?php Categories();?>
            </select>
            <br><br>
            <label for = "post_content">Съдъражие:</label>
            <br>
            <textarea name = 'post_content'><?php echo $content;?></textarea>
            <br><br>
            <button type = "submit" id = "post" name = "update" size = "100%">Качи урок</button>       
        </form>
            <?php
       }
    }
}
if(isset($_POST['update']))
{
    $title = $_POST['post_title'];
    $author = $_POST['post_author'];
    $date = $_POST['post_date'];
    $picture = $_FILES['post_picture']['name'];
    $tmp_img = $_FILES['post_picture']['tmp_name'];
    $category = $_POST['opt'];
    $content = $_POST['post_content'];
    $id = $_GET['p_id']; 
    Update_Content($title,$author,$date,$picture,$content,$category,$id,$tmp_img);
}


?>
<!DOCTYPE HTML>
<html lang = "bg-EN">
<meta charset = 'utf-8'  name="viewport" content="width=device-width, initial-scale=1.0">
    <head><title>Редактирай урок</title>
    <link href = "styles/">
    </head>
    <body>
 <?php get_content();?>
        
   
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea',
                        plugins:'media image imagetools textcolor'
                        });</script>
    </body>
</html>
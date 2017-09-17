<?php 
include "includes/db.php";
if(isset($_GET['p_id']))
{
    $id = $_GET['p_id'];
    $query = "Select * from posts Where post_id ='$id' ";
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        die("Грешка при свързването с базата данни");
    }
    else
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $title = $row['post_name'];
            
            $date = $row['post_date'];
            $author = $row['post_author'];
            $content = $row['post_content'];
            
        }
    }
}

?>
<!DOCTYPE HTML>
<html lang = "bg-EN">
<meta charset = "utf-8"  name="viewport" content="width=device-width, initial-scale=1.0">
    <head><link rel  = "stylesheet" type = "text/css" href = "styles/post.css"></head>
    <body>
        <header>
            <h3 id= "title"><?php echo $title;?></h3>
            <br>
            <h3 id = "date"><?php echo $date;?></h3>
            <h3 id= "author"><?php echo $author;?></h3>
            <h3 id = "category"></h3>
            <section id = "content">
            <?php echo $content;?>
            
            </section>
        </header>
        
    </body>   
</html>
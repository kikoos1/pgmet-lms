<?php
session_start();
include "includes/db.php";
    if(isset($_SESSION['admin']))
    {
        $author = $_SESSION['admin'];
        $get_posts_by_author = "Select * from posts";
        $get_posts = mysqli_query($conn,$get_posts_by_author);
        if(!$get_posts)
        {
            die("Грешка при изпълнението на заявката " . mysqli_error($conn));
        }else
        {
            ?>
        
<!DOCTYPE HTML>
<html lang = "bg-EN">
<meta charset = 'utf-8'  name="viewport" content="width=device-width, initial-scale=1.0">
    <head><title>Мойте уроци</title><link rel = "stylesheet" type = "text/css" href = "styles\my_posts.css"></head>
    <body>
        <header><h3 id = "title">Мойте уроци</h3></header>
        <main>
		<table>
			<tr>
				<th><a>ID</a></th>
				<th><a>Заглавие</a></th>
				<th><a>Дата</a></th>
				<th><a>Автор</a></th>
				<th><a>Съдържание</a></th>
				<th><a>Категория</a></th>
                <th><a>Редактирай</a></th>
                <th><a>Изтрии</a></th>
			</tr>
            <?php
                while($row = mysqli_fetch_assoc($get_posts))
            {
                $p_id = $row['post_id'];
                $p_title = $row['post_name'];
                $p_date = $row['post_date'];
                $p_author = $row['post_author'];
                $p_content = $row['post_content'];
                $p_category =$row['post_cat'];
                    ?>
				<tr>
					<td><a > <?php echo $p_id;?></a></td>
					<td><a > <?php echo $p_title;?></a></td>
					<td><a > <?php echo $p_date;?></a></td>
					<td><a > <?php echo $p_author;?></a></td>
					<td><a style = "width:100%;"> <?php echo $p_content;?></a></td>
					<td><a > <?php echo $p_category;?></a></td>
                    <td><a href = "edit_post.php?p_id=<?php echo $p_id;?>">Редактирай</a></td>
                    <td><a href = "includes/del_post.php?p_id=<?php echo $p_id;?>">Изтрии</a></td>
				</tr>
				
            <?php
            }
                ?>
				</table>
            <br><br><br><br>
            <a href = "admin/includes/create_post.php">Създай урок</a>
        </main>
    </body>

</html>
<?php
        }
    }
       else
       {
           die("Трябва да си влязъл  като администратор за да създаваш уроци");
       }
    
?>



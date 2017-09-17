
<!DOCTYPE html>
<html lang = "bg-EN">
<meta charset = "utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
<head><title>Система за онлайн обучение</title>
<link rel = "stylesheet" type = "text/css" href = "styles/main.css">
</head>
    <body>
    <header><h1  id = "title">Система за онлайн обучение</h1></header>
        <main>
		<!--Navigation--->
		<section id = "navigation">
		<a href = "index.php">Начало</a>
		<a href = "includes/post.php">Постове</a>
		<a href = "includes/tests.php">Тестове</a>
		<a  id = 'log' href = "includes/login.php">Вход</a>
		<a id = 'reg' href = "includes/register.php">Регистрация</a>
		<?php 
		session_start();
		if(isset($_SESSION['logged']))
		{
			?>
			<a id = "profile" style = "float:right;"href = "includes/session_destroy.php">Изход</a>
			<a id = "profile "style = "float:right;"href = "includes/my_profile.php">Моят профил</a>
			<?php
		}else if(isset($_SESSION['admin']))
        {
            ?>
            <a id = "profile" style = "float:right;"href = "includes/session_destroy.php">Изход</a>
			<a id = "profile "style = "float:right;"href = "admin/admin.php">Админ</a>
           
            <?php
        }
		?>
		</section>
			<!---Post align-->
			<section id = "posts">
                <?php include "includes/db.php";
	if(isset($_GET['p_cat']))
	{
			$cat = $_GET['p_cat'];
			$query = "Select * FROM posts WHERE post_cat = '$cat' ORDER  by post_id DESC";
			$get_posts = mysqli_query($conn,$query);
			if(!$get_posts)
			{
				echo "Няма намерени резултати";
			}
			else{
				while($row = mysqli_fetch_assoc($get_posts))
				{
						 $title = $row['post_name'];
        $author = $row['post_author'];
        $date = $row['post_date'];
        $picture = $row['post_picture'];
        $content = $row['post_content'];
        $id = $row['post_id'];
        ?>
                <a href = "post.php?p_id=<?php echo $id?>">
                <h3 id = "post_title"><?php echo $title;?></h3>
					<h4 id = "post_author"><?php echo $author;?></h4>
					<h4 id = "post_date"><?php echo $date?></h4>
					<img id = "post_img" src = "<?php echo $picture;?>" width="100">
					<h4 id = "post_content"><?php echo substr($content,0,50)?></h4>
                </a>
                <?php
						
				}
			}
	}
	else if(isset($_POST['find']))
	{
		$cat = $_POST['search'];
			$query = "Select * FROM posts WHERE post_name = '$cat' ORDER by post_id DESC";
			$get_posts = mysqli_query($conn,$query);
			if(!$get_posts)
			{
				echo "Няма намерени резултати";
			}
			else{
				while($row = mysqli_fetch_assoc($get_posts))
				{
						 $title = $row['post_name'];
        $author = $row['post_author'];
        $date = $row['post_date'];
        $picture = $row['post_picture'];
        $content = $row['post_content'];
        $id = $row['post_id'];
        ?>
                <a href = "post.php?p_id=<?php echo $id?>">
                <h3 id = "post_title"><?php echo $title;?></h3>
					<h4 id = "post_author"><?php echo $author;?></h4>
					<h4 id = "post_date"><?php echo $date?></h4>
					<img id = "post_img" src = "<?php echo $picture;?>" width="100">
					<h4 id = "post_content"><?php echo substr($content,0,50)?></h4>
                </a>
                <?php
						
				}
			}
		
	}else
	{
		header('Location:index.php');
	}
?>


 
    
					
			</section>
			<!---Sidebar-->
			<section id = "sidebar">
			<section id = "search">
			<form action = "search.php" method = "post">
			<input type = "text" placeholder = "Намери пост" name = "search">
			<button type = "submit" name = "find">Намери</button>
			</form>
			<h4 id ="categories">Категории</h4>
			<?php 
				function Categories()
				{
					global $conn;
					$query = "Select * from categories";
					$result = mysqli_query($conn,$query);
					if(!$result)
					{
						die(mysqli_error($conn));
					}else{
						while($row = mysqli_fetch_assoc($result))
						{
							$category = $row['cat_name'];
							$id = $row['cat_id'];
							?>
								<li><a href = "search.php?cat=<?php echo $category;?>"><?php echo $category;?></a></li>
							<?php
						}
					}
				}
			?>
			<ul>
				<?php Categories();?>
			</ul>
			</section>
			</section>
        </main>
    </body>
    <footer><?php include "includes/footer.php";?></footer>
</html>
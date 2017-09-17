<?php include "../../includes/db.php";
	session_start();

	if(! isset($_SESSION['admin']))
	{
		die('Трябва да си влязъл като администратор');
	}
	if(isset($_POST['create']))
	{
		$name = $_POST['cat_name'];
		Create($name,$_SESSION['admin']);
	}
	function Create($name,$author)
	{
		global $conn;
		$query = "INSERT INTO categories(cat_name,cat_author)";
		$query .= "VALUES('$name','$author')";
		$result = mysqli_query($conn,$query);
		if(!$result)
		{
			die(mysqli_error($conn));
		}else{
			echo "<h3 id = 'succ'>Категорията е създадена успешно.";
		}
	}
	function Get_Cats()
	{
		$author = $_SESSION['admin'];
		global $conn;
		$query = "Select * From categories WHERE cat_author = '$author'";
		$cats = mysqli_query($conn,$query);
		if(!$cats)
		{
			echo "Няма намерени категории";
		}else{
			while($row = mysqli_fetch_assoc($cats))
			{
				$id = $row['cat_id'];
				$name = $row['cat_name'];
				$author = $row['cat_author'];
				?>
					<tr>
						<td><a><?php echo $id;?></a></td>
						<td><a><?php echo $name;?></a></td>
						<td><a><?php echo $author;?></a></td>
					</tr>
				<?php
			}
		}
	}
?>
<!DOCTYPE HTML>
<html lang = "bg-EN">
<head><title>Мойте категории</title><link rel = "stylesheet" type = "text/css" href = "styles/category.css"></head>
<body>
	<header>
		<h3 id = "title">Мойте категории</h3>
	</header>
	<main>
		<section id = "my_cats">
			<table>
			<tr>
				<th><a>ID</a></th>
				<th><a>Име</a></th>
				<th><a>Създател</a></th>
				</tr>
				<?php Get_Cats();?>
			</table>
		</section>
		<section id = "create_cat">
                <form action = "" method = "post">
                    <label>Име на категория: </label><input type = "text" name = "cat_name">
                    <br><br>
                    <button type = "submit" name = "create">Създай</button>
                </form>
            </section>
	</main>
</body>
	
</html>
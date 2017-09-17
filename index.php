<?php
include "includes/db.php";
include "includes/functions.php";
session_start();

function Check_user()
{
    if(isset($_SESSION['user']))
    {
        echo "<a href = 'includes/my_profile.php'>Моят профил</a>";
        echo "<a href = 'includes/session_destroy.php'>Изход</a>";
        
    }else if(isset($_SESSION['admin']))
    { 
        echo "<a href = 'admin/admin.php'>Админ</a>";
        echo "<a href = 'includes/session_destroy.php'>Изход</a>";
    }
}


function Categories()
{
    global $conn;
    $query = 'Select * from categories';
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        die('Възникна грешка моле опитайте по късно.Информация за грешката: '.mysqli_error($conn));
    }else
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $name = $row['cat_name'];
            ?>
<li><a href = "search.php?p_cat=<?php echo $name;?>"><?php echo $name;?></a></li>
<?php
        }
    }
}

?>

<!DOCTYPE html>
<html lang = "bg-EN">
<meta charset = "utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
<head><title>Система за онлайн обучение</title>
<link rel = "stylesheet" type = "text/css" href = "styles/main.css">
</head>
    <body>
    <header><h1  id = "title">Система за онлайн обучение</h1>
    <section id = "navigation">
		<a href = "#">Начало</a>
		<a href = "includes/results.php">Резултати</a>
		<a href = "includes/tests.php">Тестове</a>
		<a href = "includes/login.php">Вход</a>
		<a href = "includes/register.php">Регистрация</a>
            <?php Check_user();?>
            
        </section>
        <section id = "sidebar">
			<section id = "search">
			<form action = "search.php" method = "post">
			<input type = "text" placeholder = "Намери пост" name = "search">
			<button type = "submit" name = "find">Намери</button>
			</form>
			<h4 id ="categories">Категории</h4>
			<ul>
				<?php Categories();?>
			</ul>
			</section>
			</section></header>
        <main>
		
			<section id = "posts">
				
			</section>
			
            
			
        </main>
    </body>
    <script>
        start = 0;
window.onscroll = function()
{
    Scroll();
}
window.onload = function()
{
   Get_Posts();
}
function Scroll()
{
    var wrap = document.getElementById('posts');
    var contentHeight = wrap.offsetHeight;
    var yoffset = window.pageYOffset;
    var y = yoffset + window.innerHeight;
    if(y >= contentHeight)
        {
            Get_Posts();
            
        }
        

}
function Get_Posts()
{
    var request = Request();
    request.onreadystatechange  =function()
    {
        if(this.readyState == 4 & this.status == 200  )
        {
            var data  = request.responseText;
            document.getElementById('posts').innerHTML += data;
        }
    }
    request.open("GET",'includes/functions.php?start='+start);
    request.send();
    start+=5;
}
function Request()
    {
        var request = new XMLHttpRequest();
        try
            {
                request = new XMLHttpRequest();
            }
        catch(e)
            {
                try
                    {
                        request = new ActiveXObject("MICROSOFT.XMLHTP");
                    }catch(err)
                        {
                            console.log(err);
                        }
            }
                    return request;
    }
</script>
    <footer><?php include "includes/footer.php";?></footer>
</html>
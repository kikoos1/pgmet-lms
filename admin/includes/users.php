<?php
    include "../../includes/db.php";
global $password;
    function Users()
    {
        global $conn;
       $query = "Select * From users where rank = 'user'";
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        die('Възникна грешка' . mysqli_error($conn));
    }else
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $id = $row['usr_id'];
            $username = $row['username'];
            $email = $row['email'];
            $name = $row['name'];
            $password = $row['password'];
                ?>
<tr>
  
    <td name = 'id'><?php echo $id;?></td>
    <td name = 'username'><?php echo $username;?></td>
    <td><?php echo $email;?></td>
    <td><?php echo $name;?></td>   
    <td><a href = 'users.php?make&usr_id=<?php echo $id;?>'>Направи Админ</a></td>
    <td><a href = 'users.php?del&usr_id=<?php echo $id;?>'>Изтрии акаунт</a></td>
    
</tr>
<?php
        }
    }
    }
function Make_Admin($usr)
{
    global $conn;
    $query = "UPDATE users Set rank = 'admin' where usr_id = '$usr'";
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        die('Възникна грешка моля опитайте по късно' . mysqli_error($conn));
    }
}
function Del_User($user_id)
{
    $id = $user_id;
    global $conn;
    $query = "Delete From users Where usr_id = '$id'";
    $delete = mysqli_query($conn,$query);
}
if(isset($_GET['make']))
{
    $usr_id = $_GET['usr_id'];
    Make_Admin($usr_id);
}
if(isset($_GET['del']))
{
    $id = $_GET['usr_id'];
    Del_User($id);
}
?>

<!DOCTYPE HTML>
<html lnag = 'bg'>
    <meta charset = 'UTF-8'>
    <head><title>Потребители</title>
        <link rel = 'stylesheet' type = 'text/css' href = 'styles/users.css'>
    </head>
    <body>
        <header>
            <h3 id = 'title'>Потребители</h3>
        </header>
        <main>
           <table>
			<tr>
				<th><a>ID</a></th>
				<th><a>Потр.име</a></th>
                <th><a>Email</a></th>
                <th><a>Име</a></th>
                <th><a>Действие</a></th>
				</tr>
                
				<?php Users();?>
                   
			</table>
        </main>
    </body>
</html>
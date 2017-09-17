
<!DOCTYPE html>
<html lang = 'bg'>
<meta charset = 'utf-8'  name="viewport" content="width=device-width, initial-scale=1.0">
    <head><title>Моят профил</title></head>
    <body>
        <header><h3 id = 'title'>Моят профил</h3></header>
        <main>
            <section id = 'personal_inf'>
                <?php include 'functions.php'; 
                session_start();
                if(isset($_SESSION['user']))
                {
                     get_User($_SESSION['user']);
                }
                else if(isset($_SESSION['admin']))
                {
                    get_User($_SESSION['admin']);
                }
                if(isset($_POST['update'])&& isset($_SESSION['user']))
                {
                    $usern = $_POST['username'];
                    $email = $_POST['email'];
                    $name = $_POST['name'];
                    $username = $_SESSION['logged'];
                    Update_User($usern,$email,$name,$username);
                }
                else if(isset($_POST['update'])&& isset($_SESSION['admin']))
                {
                    $usern = $_POST['username'];
                    $pass = $_POST['password'];
                    $pass = md5($pass,true);
                    $email = $_POST['email'];
                    $name = $_POST['name'];
                    $img = $_FILES['profile_pic']['name'];
                    $img_temp = $_FILES['profile_pic']['tmp_name'];   
                    $move = move_uploaded_file($img_tmp,"users/$img");
                    $location = "users/".$img;
                    $username = $_SESSION['admin'];
                    Update_User($usern,$email,$name,$location,$username);
                }
               
                ?>
            </section>
        </main>
    </body>
</html>
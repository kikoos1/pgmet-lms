<?php
 include "db.php";
 




 function Update_Content($name,$auth,$dat,$cont,$cat,$id)
 {
         global $conn;
         $title = $name;
         $author = $auth;
         $date = $dat;
         
             
         $category = $cat;
         $content = $cont;
         $p_id = $id;
       

         $query = "Update posts Set ";
         $query .= "post_name = '$title',";
         $query .= "post_author = '$author',";
         $query .= "post_date = '$date',";
         $query .= "post_content = '$content',";
         $query .= "post_cat = '$category'";
         $query .= "Where post_id = '$p_id'";
         $result = mysqli_query($conn,$query);
         if(!$result)
         {
             die('Възникна грешка '. mysqli_error($conn));
             
         }else
         {
             ?>
<script>alert('Урокът е обновен успешно');</script>
<?php
             header('Location:../my_posts.php');
         }
 }
  function get_User($usern)
{
    global $conn;
    $query = "Select * from users where username ='$usern' ";
    $user = mysqli_query($conn,$query);
    if(!$user)
    {
        die("Възникна грешка" . mysqli_error($conn));
    }
    else
    {
    $row = mysqli_fetch_assoc($user);
        
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
            $name = $row['name'];
            $rank = $row['rank'];
           
            ?>
<form action = 'my_profile.php' enctype="multipart/form-data" method = 'post'>
    <br>
    <label for = 'username'>Потр.име</label>
    <input type = 'text' name = 'username' value ='<?php echo $username;?>'>
    <input type = 'submit' name = 'name' value = 'Обнови информацията'>
    <br>

    <br>
    
    <label for = 'email'>Email</label>
    <input type = 'email' name = 'email' value ='<?php echo $email;?>'>
    <input type = 'submit' name = 'name' value = 'Обнови информацията'>
   
    <br>
   
     <label for = 'name'>Име</label>
    <input type = 'text' name = 'name' value ='<?php echo $name;?>'>
    <br>
    <input type = 'submit' name = 'name' value = 'Обнови информацията'>
</form>
<form action="my_profile.php" method="post">
    <label for = 'password'>Парола</label>
    <input type = 'password' name = 'password' value =''>
    <input type = 'submit' name = 'name' value = 'Обнови информацията'>

    </form>
<?php
        }
    }

 function Update_User($usern,$password = null,$email,$name,$usr_id)
{
  if($password == null)
  {
      $update = Query("Update users set username = '$usern',email = '$email',name = '$name' where usr_id = '$usr_id'");
  }else
  {
    $pass = md5($password,true);
    $update = Query("Update users set username = '$usern',password = '$pass'email = '$email',name = '$name'  where usr_id = '$usr_id");
  }
        
}
function Get_Tests()
{
    global $conn;
    
    $result = Query("Select * from tests ",false);
    while($r = mysqli_fetch_assoc($result))
    {
        $id = $r['test_id'];
        $name = $r['name'];
        $author = $r['author'];
        $date = $r['date'];
        $class = $r['class']
    ?>
                    <tr>
						<td><a><?php echo $id;?></a></td>
						<td><a><?php echo $name;?></a></td>
						<td><a><?php echo $author;?></a></td>
                        <td><a><?php echo $date;?></a></td>
					</tr>
<?php
    }
}
function Get_Cats()
    {
        global $conn;
        $query = "Select * from categories";
        $result = mysqli_query($conn,$query);
        if(!$result)
        {
            die(mysqli_error($conn));
        }
        while($r = mysqli_fetch_assoc($result))
        {
            $category = $r['cat_name'];
            ?>
    <option><?php echo $category;?></option>
<?php
        }
}
function Add_quest($quest_id,$question,$opt_a,$opt_b,$opt_c,$opt_d,$corr_ans,$test_id)
{
    global $conn;
    $query = "Insert into questions(q_id,question,option_a,option_b,option_c,option_d,corr_ans,test_id)";
    $query .="Values('$quest_id','$question','$opt_a','$opt_b','$opt_c','$opt_d','$corr_ans','$test_id')"; 
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        die(mysqli_error($conn));
    }
}
function Get_test($id,$q_id)
{

  
    $last_id = Get_last_id($id);
  
   if($q_id > $last_id)
   {
       ?>
       <button onclick = "Send_ans();">Завърши</button>
       <?php
   }else
   {
    $result = Query("Select * from questions where q_id=$q_id and test_id = $id");
    $r = mysqli_fetch_assoc($result);
   
        $question = $r['question'];
        $opt_a = $r['option_a'];
        $opt_b = $r['option_b'];
        $opt_c = $r['option_c'];
        $opt_d = $r['option_d'];
        ?>
        <h3><?php echo $question?></h3>
        <input type = 'radio' id = 'opt_a' value="a"><?php echo $opt_a?><br>
        <input type = 'radio' id = 'opt_b' value="b"><?php echo $opt_b?><br>
        <input type = 'radio' id = 'opt_c' value="c"><?php echo $opt_c?><br>
        <input type = 'radio' id = 'opt_d' value="d"><?php echo $opt_d?><br>
        <button id = 'back' onclick = "Down()">Назад</button>
        <button id = 'next' onclick = "UP()">Напред</button>
        <?php
    
   }

    
}
function Query($query,$return = false)
{
    global $conn;
    $query = $query;
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        if($return = true)
        {
            return $result;
        }else
        {
            echo mysqli_error($conn);
        }
        
    }else
    {
        return $result;
    }
   
       
}
function Register($username,$password,$email,$name,$class)
{
global $conn;
    $regiter =  Query("Insert into users (username,password,email,name,rank,class) Value('$username','$password','$email','$name','user','$class')");
     $last_id = mysqli_insert_id($conn);
    if($regiter)
    {
        $_SESSION['user']=$last_id;
        header("Location:../index.php");
    }
 
 
}
function Check_ans($test_id,$ans)
{
  $last_id = Get_last_id($test_id);
   
    $wrong = 0;
    for( $i = 1;$i<=$last_id;$i++)
    {
        $result = Query("Select * from questions where q_id=$i and test_id=$test_id");
        $r = mysqli_fetch_assoc($result);
        $corr_ans = $r['corr_ans'];
        if($ans->{$i}!= $corr_ans )
        {
            $wrong++;
        }
      
    }
    $result = $last_id-$wrong;
    echo "Верни отговори: ".$result."/".$last_id."<br>";
    ?>
    <form action="includes/insert_result.php" method = 'post'>
    <input type="hidden" name = 'result' value = "<?php echo $result."/".$last_id?>">
    <input type="hidden" name = 'test_id' value = "<?php echo $test_id?>">
    <input type="submit" value="Продължи" name = "res">
    </form>
    <?php
}
function Get_last_id($test_id)
{
    $l_id = Query("Select Count(q_id) as q_id from questions where test_id=$test_id");
    $r=mysqli_fetch_assoc($l_id);
    $last_id = $r['q_id'];
    return $last_id;

}
function Insert_result($test_id,$score,$user_id,$class)
{
  $last_id = Get_last_id($test_id);
    $result = Query("Insert Into results(user_id,test_id,score,class,last_id) Values('$user_id','$test_id','$score','$class','$last_id')");
}
function Get_Classes()
{
    $result = Query("Select * from classes");
    $r = mysqli_fetch_assoc($result);
    $class = $r['class_name'];
    echo "<option value = '$class'>".$class."</option>";
}
function Create_Class($name)
{
    $result = Query("Insert into classes (class_name) Values('$name')");
}
function Filter($class)
{
    $result = Query("Select * from users where class = $class");
}
function Login($username,$password)
{
    $result = Query("Select * from users where username = '$username' and password = '$password'");
    $r = mysqli_fetch_assoc($result);
    $rank = $r['rank'];
   
        if($rank == "admin")
        {
            $_SESSION['admin']=$username;
            header("Location:../index.php");
        }else if($rank == "user")
        {
            header("Location:../index.php");
            $_SESSION['user']= $username;
        }
    
}
if(isset($_GET['start']))
{
    
        Get_posts($_GET['start']);
}
function Get_posts($start)
{
    global $conn;
    $query = "Select * from posts ORDER by post_id DESC limit 5 offset $start";
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        die("An error occured " . mysqli_error($conn));
    }else
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $id = $row['post_id'];
            $title = $row['post_name'];
            $author = $row['post_author'];
            $date = $row['post_date'];
            $category = $row['post_cat'];
            $content = $row['post_content'];
            ?>
 <a href = "post.php?p_id=<?php echo $id?>">
                <h3 id = "post_title"><?php echo $title;?></h3></a>
					<h4 id = "post_author"><?php echo $author;?></h4>
					<h4 id = "post_date"><?php echo $date?></h4>
					<h4 id = "post_content"><?php echo substr($content,0,50)?></h4>
                
<?php
        }
    }
    }
    function Create_test($name,$author,$date,$class,$cat)
    {
        $result = Query("Insert into tests (name,author,date,class,category) Values('$name','$author','$date','$class','$cat')");

        if($result)
        {
           $l_id = Query("Select * from tests where name = '$name' and class = '$class' and date = '$date'");
           $r = mysqli_fetch_assoc($l_id);
           $id = $r['test_id'];
           echo $id;
            header("Location:../includes/questions.php?id=".$id);
        }
    }
 function Get_tests_for_today()
 {
     $date = date("Y-m-d");
     $result = Query("Select * from tests",true);
    if(!$result)
    {
        echo "Няма тестове за днес";
    }else
    {
        while($r = mysqli_fetch_assoc($result))
        {
            $id = $r['test_id'];
            $name = $r['name'];
           ?>
           <a id = 'test'href = "../test.html?id=<?php echo $id?>"><?php echo $name ?></a>
           <?php
        }

       
    }
 }


?>
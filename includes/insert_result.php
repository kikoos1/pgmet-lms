<?php
session_start();
include "functions.php";
if(isset($_POST['res']))
{
    $score = $_POST['result'];
    $test_id = $_POST['test_id'];
    $username = $_SESSION['user'];
    $result  = Query("Select * from users where id = '$username'");
    $r = mysqli_fetch_assoc($result);
    $class = $r['class'];
    Insert_result($test_id,$score,$username,$class);
    header("Location:results.php");
}
?>
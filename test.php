<?php
session_start();
include "includes/db.php";
include "includes/functions.php";
    if(!isset($_SESSION['user']))
    {
        if(!isset($_SESSION['admin']))
        {
            die("Трябва да влезеш за да правиш тест");
        }
      
    }
   
    if(isset($_REQUEST['id']))
    {
        global $test_id;
         $test_id = $_REQUEST['id'];
         $q_id = $_REQUEST['q_id'];
         Get_test($test_id,$q_id);
         global $test_id;
         
         
    }
    if(isset($_REQUEST['answ']))
    {
            $ans = $_REQUEST['answ'];
            $id = $_REQUEST['test_id'];
            $answ =make_json($ans);

            Check_ans($id,$answ);
      

    }
    function make_json($value)
    {
        return json_decode(stripslashes($value));
    }
    
?>
<!Doctype html>
<html lang = 'bg'>
<meta charset = 'utf-8' name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
    <title></title>
    </head>
    <body>
    </body>
    <footer>
    
    </footer>
</html>
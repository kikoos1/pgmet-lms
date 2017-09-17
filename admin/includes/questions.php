<?php
session_start();
include "../../includes/functions.php";
if(!isset($_SESSION['admin']))
   {
       die('Трябва да си влязъл');
   }
   if(!isset($_GET['id'] ))
   {
       if(!isset($_REQUEST['id']))
       {
        echo "НЕваилиден тест";
       }
       
   }
   else
   {
       global  $test_id;
       $test_id= $_GET['id'];
   }
   if(isset($_POST['create']))
   {
       global $test_id;
       $quest = $_POST['question'];
       $opt_a = $_POST['opt_a'];
       $opt_b = $_POST['opt_b'];
       $opt_c = $_REQUEST['opt_c'];
       $opt_d = $_POST['opt_d'];
       $corr_ans = $_REQUEST['corr_ans'];
       $result = Query("Select * from questions where test_id=$test_id Order by q_id DESC",true);
       if(!$result)
       {
        $q_id = 1;
       }else
       {
           $r = mysqli_fetch_assoc($result);
           $q_id = $r['q_id'];
           $q_id +=1;
       }
       
       Add_quest( $q_id, $quest,$opt_a,$opt_b,$opt_c, $opt_d, $corr_ans,$test_id);
      

   }else if(isset($_POST['stop']))
   {

   }


?>
<!Doctype html>
<html lang = 'bg'>
<meta charset = 'utf-8' name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
    <title>Добави въпрос</title>
    </head>
    <style>
     #opt_a,#opt_b, #opt_c, #opt_d,#select,#buttons
        {
            display:none;
            margin:0px;
            padding:0px;
            top:0px;
        }
        #next
        {
             background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
        }
        #create
        {
            background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
        }
        #stop
        {
            background-color: blue; /* blue */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
        }
        #next:hover
        {
            cursor:pointer;
        }
        #create:hover
        {
            cursor:pointer;
        }
        #stop:hover
        {
            cursor:pointer;
        }
        
    </style>
    <body>
    <form action="" method="post">
            <div id = 'question'>
        <label for = 'question'>Въпрос:</label>
            <textarea name = 'question' required>
                
            </textarea>
            <a id = 'next' onclick = "UP();">Напред >></a>
                </div>
            <br/>
            <div id = 'opt_a'>
            <label for = 'question'>Отговор А:</label>
            <textarea name = 'opt_a' required>
                
            </textarea>
                <a id = 'next' onclick = "Down();"> Назад</a>
                <a id = 'next' onclick = "UP();">Напред >></a>
                </div>
            <br/>
            <div id = 'opt_b'>
            <label for = 'question'>Отговор Б:</label>
            <textarea name = 'opt_b' required>
                
            </textarea>
                 <a id = 'next' onclick = "Down();"> Назад</a>
                  <a id = 'next' onclick = "UP();">Напред >></a>
                </div>
            <br/>
             <div id = 'opt_c'>
            <label for = 'question'>Отговор В:</label>
            <textarea name = 'opt_c' required>
                
            </textarea>
                  <a id = 'next' onclick = "Down();"> Назад</a>
                  <a id = 'next' onclick = "UP();">Напред >></a>
            </div>
            <br/>    
                  <div id = 'opt_d'>
            <label for = 'question'>Отговор Г:</label>
            <textarea name = 'opt_d' required>
                
            </textarea>
                       <a id = 'next' onclick = "Down();"> Назад</a>
                        <a id = 'next' onclick = "UP();">Напред >></a>
            </div>
            <br/>  
            <div id = 'select'>
            <label>Правилен отговор</label>
            <select name = 'corr_ans'>
            <option>a</option>
                <option>b</option>
                <option>c</option>
                <option>d</option>
            </select>
                <br/>
                 <a id = 'next' onclick = "Down();"> Назад</a>
                  <a id = 'next' onclick = "UP();">Напред >></a>
                </div>
            <br/>
            <div id = 'buttons' onload = "Change_Html(['question','opt_a','opt_b','opt_c','opt_d'],['questions','option_a','option_b','option_c','option_d']);">
                <a id = 'questions'>Въпрос</a>
                <br>
                <a id = 'option_a'>Отг А:</a>
                <br>
                <a id = 'option_b'>ОТГ Б:</a>
                <br>
                <a id = 'option_c'> ОТГ В:</a>
                <br>
                <a id = 'option_d'>ОТГ Г:</a>
                <br>
                <a id = 'next' onclick = "Down();"> Назад</a>
                <br>
                <br>
        <button type = "submit" name = 'create' id = "create">Добави</button>
            <button  type = "submit "id = "stop">Завърши</button>
                </div>
                </form>
                   
        
    </body>
    <footer>
    
    </footer>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea',
                        plugins:'media image imagetools textcolor'
                        });</script>
    <script src = 'js/core.js';></script>
</html>
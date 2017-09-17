<?php
include "functions.php";
if(isset($_REQUEST['startt']))
{
    if(isset($_REQUEST['class']))
    {
        $class = $_REQUEST['class'];
        $start = $_REQUEST['startt'];
        if($class == "")
        {
            Get_resultss($start);
        }else
        {
            Get_resultss($start,$class);
        }
        
       
        
    }else{
        $start = $_REQUEST['startt'];
        Get_resultss($start);
    }
  
}

function Get_resultss($start,$class = null)
{
    if($class == null)
    {
        $result = Query("Select * from results Order by id Limit 5 Offset $start");
    }else
    {
        $result = Query("Select * from results where class = '$class' ");
    }
    while($r = mysqli_fetch_assoc($result))
    {
        $user_id = $r['user_id'];
        $test_id = $r['test_id'];
        $class = $r['class'];
        $id = $r['id'];
        $score = $r['score'];
        $last_id = $r['last_id'];
        $usern = Query("Select * from users where usr_id= $user_id");
        while($rr = mysqli_fetch_assoc($usern))
        {
            $username = $rr['username'];
            $name = $rr['name'];
            $class = $rr['class'];
        }
        
        $test_info = Query("Select * from tests where test_id = $test_id");
        while($t_info = mysqli_fetch_assoc($test_info))
        {
            $test_name = $t_info['name'];
            $date = $t_info['date'];
        }
        
        ?>
       <tr>
                        <td><a><?php echo $id;?></a></td>
                        <td><a><?php echo $username;?></a></td>
						<td><a><?php echo $name;?></a></td>
                        <td><a><?php echo $class;?></a></td>
                        <td><a><?php echo $test_name;?></a></td>
						<td><a><?php echo $date;?></a></td>
						<td><a><?php echo $score."/".$last_id;?></a></td>
					</tr>
        <?php

    }

}

?>
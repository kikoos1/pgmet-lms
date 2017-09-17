<?php
include 'db.php';
if(isset($_GET['p_id']))
{
    $id = $_GET['p_id'];
    $query ="Delete   from posts Where post_id = '$id'";
    $delete = mysqli_query($conn,$query);
    if(!$delete)
    {
        die('Възникна грешка ' . mysqli_error($conn));
    }else
    {
        ?>
<script>alert('Урокът е изтрит успешно');</script>
<?php
        header('Location:../my_posts.php');
    }
}
?>
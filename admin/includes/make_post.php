<?php 
include "../../includes/db.php";
if(isset($_POST['post']))
{
    $title = $_POST['post_title'];
    $author = $_POST['post_author'];
    $category = $_POST['opt'];
    $date = $_POST['post_date'];
    
    $content  = $_POST['post_content'];
    mysqli_real_escape_string($conn,$content);    
    
    $create_post = "Insert Into posts(post_name,post_author,post_date,post_content,post_cat)";
    $create_post .="Values('$title','$author','$date','$content','$category')";
    $result = mysqli_query($conn,$create_post);
    if(!$result)
    {
        echo "An error occured while creating the post" . mysqli_error($conn);
    }
    else
    {
        ?>
<script>alert('Урокът е създаден успешно');</script>
<?php
        header('location:../../my_posts.php');
    }
    
}
?>
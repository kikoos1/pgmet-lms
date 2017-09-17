<?php include "functions.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тестове</title>
</head>
<body>
    <section id = 'test_nav'>
            <select id="test"><?php Get_Classes(); ?></select>
    </section>
    <section id = "tests">
      <?php Get_tests_for_today(); ?>
    </section>
</body>
<script src='../js/core.js'></script>
</html>
<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: http://my-final-project-coffeeshop/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/fonts.css">
    <link rel="stylesheet" href="./styles/auth.css">
    <title>Личный кабинет</title>
</head>
<body>
    <?php
     require_once ("./components/navbar.php");
    ?>
    <div class="main-registr">

        <ul class="breadcrumbs">
            <li><a href="index.php">Главная</a></li>
            <li><span>Мой кабинет</span></li>
        </ul>
        <div class="all-registr">
            <h3>Мой кабинет</h3>
            <form action="">
                <button id="btn-logout" name="logout" value="1">Выйти</button>
            </form>
        </div>
    </div>


    <?php
        require_once ("./components/footer.php"); 
    ?> 
</body>
</html>

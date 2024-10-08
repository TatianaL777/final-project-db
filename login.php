<?php
session_start();
?>

<?php
   include_once ('./api/auth/authController.php');
if (($_SERVER['REQUEST_METHOD'] === 'POST')) {
    $pass = md5($_POST['password']);

    $user = $authController->login(
        $_POST['login'],
        $pass 
    );
    // print_r($user);
    if (!isset($user['error'])) {
        $message = 'Вход выполнен';
        $_SESSION['userId'] =$user['userId'];
        $_SESSION['login'] =$user['login'];
        $_SESSION['name'] =$user['name'];
        $_SESSION['role'] =$user['role'];
        $_SESSION['phone'] =$user['phone'];
        $_SESSION['email'] =$user['email'];
        $_SESSION['basketId'] =$user['basketId'];
        $_SESSION['isAuth'] = true;
        } else {
        $message = $user['error'];
        }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/fonts.css">
    <link rel="stylesheet" href="./styles/auth.css">
    <title>Вход в личный кабинет</title>
</head>
<body>
    <?php
        require_once ("./components/navbar.php"); 
    ?>
    <div class="main-registr">

        <ul class="breadcrumbs">
            <li><a href="index.php">Главная</a></li>
            <li><span>Вход</span></li>
        </ul>
    
        <div class="all-registr">
            <h3>Вход в личный кабинет</h3>
            <form class="registr" action="" method="POST">
                <input class="text-registr" type="text" placeholder="Введите логин" name="login" required><br>
                <input class="text-registr" type="password" placeholder="Введите пароль" name="password" required><br>
                <a class="pass-link" href="#">Забыли пароль?</a><br>
                <button id="btn-auth" name="auth">Войти</button>
                <?php
                if (isset($message)) {
                    echo "<p>$message</p>";
                }
                ?>
            </form>
        </div>
    </div>


    <?php
        require_once ("./components/footer.php"); 
    ?> 
</body>
</html>
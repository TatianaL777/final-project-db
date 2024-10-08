<?php
session_start();
?>
<?php
   include_once ('./api/auth/authController.php');
if (($_SERVER['REQUEST_METHOD'] === 'POST')) {
    $pass = md5($_POST['password']);
    
    //из POST при отправке формы (нажатие на button)
    $user = $authController->register(
        $_POST['login'],
        $_POST['userName'],
        $_POST['phone'],
        $_POST['email'],
        $pass 
    );
    
    // print_r($user);
    
    // как в БД наименования
    $_SESSION['userId'] =$user['userId'];
    $_SESSION['login'] =$user['login'];
    $_SESSION['name'] =$user['name'];
    $_SESSION['role'] =$user['role'];
    $_SESSION['phone'] =$user['phone'];
    $_SESSION['email'] =$user['email'];
    $_SESSION['basketId'] =$user['basketId'];
    if (isset($_SESSION['userId'])) {
        $message = 'Вы зарегистрировались!';
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
    <title>Регистрация нового пользователя</title>
</head>
<body>
    <?php
        require_once ("./components/navbar.php"); 
    ?> 

    <div class="main-registr">

        <ul class="breadcrumbs">
            <li><a href="index.php">Главная</a></li>
            <li><span>Регистрация</span></li>
        </ul>
    
        <div class="all-registr">
            <h3>Регистрация нового пользователя </h3>
            <form class="registr" action="" method="POST">
                <input class="text-registr" type="text" placeholder="Введите логин" name="login" required><br>
                <input class="text-registr" type="text" placeholder="Введите имя" name="userName" required><br>
                <input class="text-registr" type="text" placeholder="Введите телефон" name="phone" required><br>
                <input class="text-registr" type="text" placeholder="Введите email" name="email" required><br>
                <input class="text-registr" type="password" placeholder="Введите пароль" name="password" required><br>
                
                <?php
                if (isset($message)) {
                    echo "<p>$message</p>";
                }
                ?>
    
                <button id="btn-registr">Pегистрация</button>
            </form>
        </div>
    </div>
    
    <?php
        require_once ("./components/footer.php"); 
    ?> 

</body>
</html>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/fonts.css">
    <link rel="stylesheet" href="./styles/index.css">
    <title>ПроCoffee Магазин кофе с доставкой</title>
</head>
<body>
    
    <?php
        require_once ("./components/navbar.php"); 
    ?> 
        <section class="hero-section">
            <div class="hero-slogan">
                <h1>ПроCoffee</h1>
                <h2>Вкус любимого кофе!</h2>
                <h2>Мы предлагаем широкий выбор кофе из разных стран мира специально для Вас</h2>
            </div>
        </section>
    <?php
        require_once ("./components/footer.php"); 
    ?> 
</body>
</html>
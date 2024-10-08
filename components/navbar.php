<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <link rel="stylesheet" href="../styles/fonts.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <title>Components-navbar</title>
</head>
<body>
    <header>
        <nav class="header-all">
            <nav class="nav-header">
                <ul class="nav-header-menu">
                    <li><a href="index.php">ГЛАВНАЯ</a></li>
                    <li class="catalog"><a href="catalogCoffeeBeans.php">КАТАЛОГ</a>
                        <ul class="nav-catalog-list">
                            <li><a href="catalogCoffeeBeans.php">Кофе зерновой</a></li>
                            <li><a href="catalogCoffeeGround.html">Кофе молотый</a></li>
                        </ul>
                    </li>
                    <li><a href="#">КАК КУПИТЬ</a></li>
                </ul>
            </nav>
            <div class="header-logo">
                <a href="index.php">
                    <img src="../img-project-coffee/coffee-logo-img/coffeelogo.png" alt="логотип компании">
                </a>
            </div>
            <nav  class="nav-header">
                <ul class="nav-header-menu">
                    <li><a href="basket.php">КОРЗИНА</a></li>
                    <?
                    if ($_SESSION['isAuth'] === true) {
                    $name = $_SESSION['name'];
                    echo "
                    <li><a href='profile.php'>$name</a></li>
                    ";
            
                    } else {
                    echo "
                    <li><a href='login.php'>ВХОД</a></li>
                    <li><a href='registration.php'>РЕГИСТРАЦИЯ</a></li>
                    ";
                    }
                    ?>
                </ul>
            </nav>
            <div class="search">
                <button type="submit" class="header-search material-symbols-outlined">search</button>
            </div>
        </nav>
    </header>
</body>
</html>
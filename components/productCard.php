<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/fonts.css">
    <link rel="stylesheet" href="../styles/productCard.css">
    <title>Карточка товара</title>
</head>
<body>
    <div class="prod-card">
        <!-- for data base -->
        
        <!-- img -->
        <img src="../img-project-coffee/coffee-cardProduct-img/LavazzaEGusto.png" alt="кофе">
        
        <!-- header -->
        <h4><a href="#">Lavazza Crema E Gusto Espresso Classico, 1 кг</a></h4>

        <!-- description -->
        <p>Крепкий, насыщенный вкус, густая пенка. Пряные ноты</p>
        
        <!-- composition -->
        <!-- для отрисовки карточки делаем $composition, ч/з php? код echo $composition -->
        <h5>Состав: арабика, робуста</h5>

        <!-- weight -->
        <!-- для отрисовки карточки делаем $weight, ч/з php? код echo $weight -->
        <h5>Вес: 1 кг</h5>
        
        <!-- price -->
        <!-- для отрисовки карточки делаем $price, ч/з php? код echo $price -->

        <h5>Цена: 1600 руб</h5>

        <form action="" method="GET">
            <!-- value=$article -->
            <button id="addBasket" name="addToBasket" value="$article">В корзину</button>
        </form>
    </div>
</body>
</html>
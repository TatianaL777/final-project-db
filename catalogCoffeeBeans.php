<?php
session_start();
include_once ("./api/basket/basketController.php");
include_once ("./api/catalog/catalogController.php");
?>

<!-- добавление товара в корзину. обработчик -->
<?php
if (isset($_GET['addToBasket'])) {
    
    $userBasket = $basketController->getOne($_SESSION['basketId']);
    $inBasket = false;
    foreach ($userBasket as $index => $productInBasket) {
        if ($_GET['addToBasket']== $productInBasket['article']) {
            $inBasket = true;
        }
    }
    if ($inBasket) {
        echo "<script> alert ('Такой товар уже есть в корзине')</script>";
    } else {
        $basketId = $_SESSION['basketId'];
        $res = $basketController -> addOne($_SESSION['basketId'], $_GET['addToBasket'], 1);
        // print_r($res);
        //можно дописать в alert '... в корзину $basketId' - покажет в какую именно корзину добавился товар
        echo "<script> alert ('Товар добавлен в корзину')</script>";

    }

}
//print_r($userBasket);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/fonts.css">
    <link rel="stylesheet" href="./styles/catalog.css">
    <link rel="stylesheet" href="./styles/productCard.css">
    <title>Каталог</title>
</head>
<body>
     
     <?php
        require_once ("./components/navbar.php"); 
    ?> 
    
    <?php
    if ($_SESSION["role"] == "admin") {
        echo "<a href='catalogAdd.php'> Добавить товар </a><br>";
        echo "<a href='catalogDelete.php'> Удалить товар </a><br>";
        echo "<a href='orders.php'> Заказы </a>";
    }
    ?>
    
    <section class="main-catalog">
        <div class="all-catalog">
            <ul class="breadcrumbs">
                <li><a href="index.php">Главная</a></li>
                <li><a href="catalogCoffeeBeans.php">Каталог</a></li>
                <li><span>Кофе зерновой</span></li>
            </ul>
            <h3>Кофе зерновой</h3>
            <div class="catalog-block">
                <?php
                
                //из api catalogController получаем ф-ю getAll
                $productsCoffee = $catalogController->getAll();
                // print_r($productsCoffee);

               //перебираем массив с товарами

                foreach ($productsCoffee as $key => $coffee) {
                    $imgSrc = $coffee["imgSrc"];
                    $article = $coffee["id"];
                    $header = $coffee["header"];
                    $description = $coffee["description"];
                    $composition = $coffee["composition"];
                    $weight = $coffee["weight"];
                    $price = $coffee["price"];
                    echo "
                        <div class='prod-card'>
                            <img src ='$imgSrc' alt='фото товара'>
                            <h4><a href='#'>$header</a></h4>
                            <p>$description</p>
                            <h5>Состав: $composition</h5>
                            <h5>Вес: $weight кг</h5>
                            <h5>Цена: $price руб</h5>
                            <form action = '' method='GET'>
                              <button id='addBasket' name='addToBasket' value='$article'>В корзину</button>
                            </form>
                        </div>
                        ";
                    }
                ?> 
            </div>
        </div>
    </section>
    
    <?php
        require_once ("./components/footer.php"); 
    ?> 
    
</body>
</html>
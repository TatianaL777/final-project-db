<?php 
session_start();
include ("./api/basket/basketController.php");
include ("./api/orders/ordersController.php");
?>

<?php 
if (isset($_GET['delFromBasket'])) {
    
        $basketId = $_SESSION['basketId'];
        $res = $basketController -> deleteOne($_SESSION['userId'], $_GET['delFromBasket']);
        //print_r($res);
        echo "<script> alert ('Товар удален из корзины')</script>";
}

//обработчик заказа
if (isset($_GET['order'])) {
    $basket = $basketController->getOne($_SESSION['basketId']);
    foreach ($basket as $key => $value) {
        $article = $value['article'];
        $getKey = "count$article";
        $count = $_GET["$getKey"];
        
        $basket[$key]['count'] = $count;
    }

    $res = $ordersController->addOne($_SESSION['userId'], $basket, $_GET['userName'], $_GET['adress'], $_GET['phone'], $_GET['payOffline']);
    echo "<script> alert('Заказ оформлен') </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/fonts.css">
    <link rel="stylesheet" href="./styles/basket.css">
    <link rel="stylesheet" href="./styles/productCard.css">
    <title>Корзина</title>
</head>
<body>
    
        <?php
            require_once ("./components/navbar.php"); 
            ?> 
        <form action="" method="GET">

        <section class="main-basket">
            <div class="all-basket">
                <ul class="breadcrumbs">
                    <li><a href="index.php">Главная</a></li>
                    <li><span>Корзина</span></li>
                </ul>
                <h3>Корзина</h3>
                <div class="basket-block">
                    <?php
                        //из api basketController получаем ф-ю getOne
                        $basket = $basketController->getOne($_SESSION['basketId']);
                        // print_r($basket); 

                        //перебираем basket одного пользователя, к-ый авторизовался
                        foreach ($basket as $key => $coffee) {
                            $imgSrc = $coffee["imgSrc"];
                            //тк в запросе переименован id на article (ассоц массив)
                            $article = $coffee["article"];
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
                                    <h5>Цена: <span class='price' id='price$article'>$price</span> руб</h5>
                                    
                                    <div class='total-summ-product'>
                                        <input class='count' id='count$article' type='text' name='count$article' value='1'/>
                                    </div>
                                    
                                    <div class='delete'>
                                       <button class='delBasket' name='delFromBasket' value='$article'>Удалить</button>
                                    </div>
                                </div>
                                ";
                        }
                    ?>
                </div>
                <!-- общая стоимость заказа -->
                <div class="basket-checkout">
                    <h4>Итого: <span id="basketSumm">0</span> рублей</h4>
                    <button id="placeOrder">Оформить заказ</button>
                </div>
            </div>
        </section>
        
        <!-- модальное окно заказа-->
        <div id="modalOrder" class="hiden">
            <div id="modalOrderForm" class="all-order-modal">
                <input class="text-order" type="text" name="userName" placeholder="Имя">
                <input class="text-order" type="text" name="adress" placeholder="Адрес">
                <input class="text-order" type="text" name="phone" placeholder="Телефон">
                    <select class="text-order" name="payOffline">
                        <option value="1">Оплата при получении</option>
                        <option value="0">Оплата онлайн</option>
                    </select> 
                <button id="btn-order" class="make-order" name="order" value="buy">Заказать</button>
            </div>
        </div>
        
        <?php
            require_once ("./components/footer.php"); 
        ?> 

    </form>
    
    <script src="./scripts/basket.js"></script>
</body>
</html>


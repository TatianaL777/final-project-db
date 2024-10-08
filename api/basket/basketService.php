<?php
require_once ("./api/db.php");
class BasketService 
{
    protected $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }

    //получение корзины пользователя
    public function getOne($basketId)
    {
        $query = "SELECT PC.id AS article, BTPC.basketId AS basketId, PC.header, PC.description, PC.composition, PC.weight, PC.price, 
        PC.imgSrc, BTPC.count 
        FROM `productsCoffee` AS PC, `basketToProductsCoffee` AS BTPC
        WHERE BTPC.productsCoffeeId = PC.id AND BTPC.basketId = $basketId
        ";
        $res = mysqli_query($this->connection, $query);
        // print_r($res);
        // print_r($this->connection);

        $userBasket = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($userBasket, $row);

                // print_r($row);
            }
        }
        // print_r($userBasket);
        return $userBasket;
    }

    //добавить товар в корзину
    public function addOne($basketId, $productsCoffeeId, $count) 
    {
        //проверяем, есть ли уже такая запись
            $query = "
            SELECT *
            FROM `basketToProductsCoffee`
            WHERE `basketId` = $basketId AND `productsCoffeeId` = $productsCoffeeId
            ";

        $res = mysqli_query($this->connection, $query);
        if ($res->num_rows > 0) {
            return ['error' => "Ошибка! Такой товар уже был добавлен в корзину"];
        }
        
        //добавляем товар в корзину
        $query = "
        INSERT INTO `basketToProductsCoffee`(`basketId`, `productsCoffeeId`, `count`)
        VALUES ($basketId, $productsCoffeeId, $count)";

        $res = mysqli_query($this->connection, $query);

        //делаем запрос на получение той строки, кото-ую мы ТОЛЬКО что добавили (возвращаем)
        if ($res == 1) 
        {
            $query = "
            SELECT *
            FROM `basketToProductsCoffee`
            WHERE
            `basketId` = $basketId AND `productsCoffeeId` = $productsCoffeeId AND `count` = $count
            ";

            $res = mysqli_query($this->connection, $query);
            $row = [];
            if ($res->num_rows > 0) {
                $row = mysqli_fetch_assoc($res);
            }
            return $row;
        }
    }

    //удалить товар из корзины
    public function deleteOne($userId, $productsCoffeeId) {
        //получаем товар, к-ый удаляем и id записи в basketToProductsCoffee (BTPCid)
        //если что-то не работает исполь-м print_r - аргументы функции, переменные, резы и тд
        // print_r($userId, $productsCoffeeId);
        $query = "
        SELECT BTPC.id AS BTPCid, PC.id, PC.header, PC.description, PC.composition, PC.weight, PC.price, PC.imgSrc
        FROM `basketToProductsCoffee` AS BTPC, `basket`, `productsCoffee` AS PC
        WHERE BTPC.productsCoffeeId = $productsCoffeeId AND BTPC.basketId = basket.id AND basket.userId = $userId AND BTPC.productsCoffeeId = PC.id;
        ";

        $res = mysqli_query($this->connection, $query);

        $row = []; //созд перемен row до условия, чтоб она была до конца условия
        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
        } else {
            return ["error" => "Ошибка! Запись не найдена"];
        } 

        //удаляем строку
       $basketToProductsCoffee = $row["BTPCid"];
       $query = "
       DELETE 
       FROM `basketToProductsCoffee`
       WHERE id = $basketToProductsCoffee;
       ";
       $res = mysqli_query($this->connection, $query);
       return $row;
    }
    
}

$basketService = new BasketService($connection);

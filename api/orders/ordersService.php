<?php
require_once ("./api/db.php");
require_once ("./api/orders/order.php");
require_once ("./api/catalog/product.php");

class ordersService {
    protected $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }
     //все заказы всех пользователей получить
     public function getAll() 
    {
         $query = "
        SELECT O.id, O.userId, O.adress, O.phone, O.payOffline, O.completed, O.userName, PC.id AS article, PC.header, PC.weight, PC.price, 
        OTPC.count 
        FROM `orders` AS O, `users` AS U, `ordersToProductsCoffee` AS OTPC, `productsCoffee` AS PC 
        WHERE O.id = OTPC.orderId AND U.id = O.userId AND PC.id = OTPC.productsCoffeeId ORDER BY o.id ASC;
         ";

        $res = mysqli_query($this->connection, $query);

        //создали пустой массив
        //создаем новый заказ туда все добавляем
        //создаем новый товар, добавляем в заказ
        $orders = []; 
        $counter = 0;

        if ($res->num_rows > 0) {
            //пустой заказ -заглушка. он сотрется после цикла тк выше стоит
            $newOrder = new Order(-1, "", "", "","", "", []); 
            //к заказу добавили одежду
            while ($row = mysqli_fetch_assoc($res)) {
                $counter +=1;
                //проверка на то, что заказ с таким номером уже существует
                if($newOrder->id !== $row["id"]) {
                    //Добавляем сформированный заказ
                    //сравниваем id первый заказ с заглушкой(-1), чтоб его не пушить
                    if($newOrder->id !== -1){    
                        array_push($orders, $newOrder);
                    }
                    //формирую новый заказ без продуктов
                    $newOrder = new Order($row["id"], $row["userName"], $row["adress"], $row["phone"], $row["payOffline"], $row["completed"], []);
                }
                //сформировать продукт и добавить в новый заказ
                $newProduct = new Product ($row["article"], $row["header"], $row["description"], $row["composition"], $row["weight"], $row["price"], $row["imgSrc"], $row["count"]);

                array_push($newOrder->products, $newProduct);
                
                if($res->num_rows === $counter) {    
                    array_push($orders, $newOrder);
                }
                
            }
        }
        return $orders;
        // print_r($res);
    }
    
    
    //добавить один
    public function addOne($userId, $products, $userName, $adress, $phone, $payOffline)
    {
        //добавить заказ
        $query = "
            INSERT
            INTO `orders`(`userId`, `userName`, `adress`, `phone`, `payOffline`, `completed`)
            VALUES ($userId, '$userName', '$adress', '$phone', $payOffline, false)
            ";

        $res = mysqli_query($this->connection, $query);
        //получить заказ его id
        $query = "
            SELECT *
            FROM orders AS O
            WHERE O.userId = $userId AND O.userName = '$userName' AND O.adress = '$adress' AND O.phone = '$phone'AND O.payOffline = $payOffline
            ";
        
        $res = mysqli_query($this->connection, $query);

        if ($res->num_rows === 0) {
            return ['error' => "Ошибка! Заказ не был добавлен!"];
        }
         //получили заказ и его id чтоб цеплять на него одежду
         $order = mysqli_fetch_assoc($res);

        //перебрать массив с продуктами
        // print_r($products);
        foreach ($products as $value) {
            $productsCoffeeId = $value['article'];
            $count = $value['count'];
            $orderId= $order['id'];
            
            $query = "
            INSERT
            INTO `ordersToProductsCoffee`(`orderId`, `productsCoffeeId`, `count`)
            VALUES ($orderId, $productsCoffeeId, $count)
            ";
        
        $res = mysqli_query($this->connection, $query);
            }
    }

    // обновить один
    public function updateOne($orderId)
    {
        $query = "
        UPDATE `orders` 
        SET `completed`= 1 
        WHERE id = $orderId;
        ";

        $res = mysqli_query($this->connection, $query); //выполняет запрос именно эта строка. конекшн-к БД.
        // print_r($res);

        //Проверяем, что запрос выполнился и строка с новыми параметрами  существует
        
        //делаем запрос. это просто стр с запросом как в SQL. Она ничего не далает
        $query = "
        SELECT * 
        FROM `orders` 
        WHERE id = $orderId AND `completed` = 1;
        ";
        
        //уже выполняем запрос
        $res = mysqli_query($this->connection, $query);
        
        //проверяем
        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
            return $row;
            // echo "Количество товара поменялось!";
        } else {
            return ["error" => "Ошибка при обновлении данных!"];
            // echo "Запрос не выполнен!";
        }
    }
}

$ordersService = new ordersService($connection);
    

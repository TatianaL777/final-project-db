<?php
require_once("ordersService.php");
class OrdersController 
{
    protected $ordersService;
    function __construct($ordersService) {
        $this->ordersService = $ordersService;
    }

    //функции

    //получить все заказы всех пользователей
    public function getAll()
    {
        $responce = $this->ordersService->getAll();
        return $responce;
    
    }

    //получить все заказы одного пол-ля
    public function getOne($userId)
    {
        $responce = $this->ordersService->getOne($userId);
        return $responce;
  
        // echo "you get $id order";
    }
    
    //добавить один заказ. добавляются по одному товары
    //что поставить как аргументы у меня
    public function addOne($userId, $products, $userName, $adress, $phone, $payOffline)
    {
        //products - это массив с товарами из корзины
        $responce = $this->ordersService->addOne($userId, $products, $userName, $adress, $phone, $payOffline);
        return $responce;
    }

    
    //обновить один. меняем количество
    public function updateOne($orderId)
    {
       $responce = $this->ordersService->updateOne($orderId);
       return $responce;
    }
   
   //удалить один заказ 
   public function deleteOne($orderId)
   {
       $responce = $this->ordersService->deleteOne($orderId);
       return $responce;
   }
}

$ordersController = new OrdersController($ordersService); 
